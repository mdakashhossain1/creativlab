<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Modules\ArknoxMonitor\App\Services\R2StorageService;
use Modules\ArknoxMonitor\App\Services\R2UsageBuffer;

/**
 * Central upload service — all file uploads in the app route through here.
 *
 * Every upload goes to Cloudflare R2 and is automatically tracked by
 * R2UsageBuffer (flushed to arknox_r2_daily / arknox_r2_monthly at
 * request termination by ArknoxMonitorServiceProvider).
 *
 * Returns a full R2 URL (https://pub-....r2.dev/path/file.ext) which is
 * safe to store in the DB and safe to pass to asset() — Laravel's asset()
 * passes absolute URLs through unchanged.
 */
class UploadManager
{
    public function __construct(private R2StorageService $r2) {}

    /**
     * Upload an UploadedFile to R2 and return the full public URL.
     *
     * @param  UploadedFile  $file       The incoming request file
     * @param  string        $directory  Target directory, e.g. 'uploads/custom-images'
     * @param  array         $options    Optional: ['prefix' => 'partner', 'format' => 'webp', 'quality' => 80]
     * @return string                    Full R2 URL, e.g. https://pub-xxx.r2.dev/uploads/custom-images/partner-2026-01-01.webp
     */
    public function upload(UploadedFile $file, string $directory, array $options = []): string
    {
        $ext      = $options['format'] ?? $file->getClientOriginalExtension();
        $prefix   = $options['prefix'] ?? Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $quality  = $options['quality'] ?? 90;
        $dir      = trim($directory, '/');
        $filename = Str::slug($prefix) . date('-Y-m-d-H-i-s-') . rand(1000, 9999) . '.' . strtolower($ext);
        $path     = $dir . '/' . $filename;

        // Use Intervention Image when a specific output format is requested
        if (isset($options['format'])) {
            $encoded = \Intervention\Image\Facades\Image::make($file)
                ->encode($ext, $quality);
            $this->r2->put($path, (string) $encoded);
        } else {
            $this->r2->putFileAs($dir, $file, $filename);
        }

        return $this->r2->url($path);
    }

    /**
     * Delete a file — handles full R2 URLs, legacy local relative paths, or null.
     *
     * Full R2 URL  → strips the base URL, deletes from R2
     * Relative path → tries to delete from local disk (legacy), then R2
     */
    public function delete(?string $pathOrUrl): void
    {
        if (!$pathOrUrl) return;

        if (str_starts_with($pathOrUrl, 'http://') || str_starts_with($pathOrUrl, 'https://')) {
            $baseUrl = rtrim(config('filesystems.disks.r2.url', ''), '/');
            $relative = ltrim(str_replace($baseUrl, '', $pathOrUrl), '/');
            try { $this->r2->delete($relative); } catch (\Throwable) {}
            return;
        }

        // Legacy local relative path — delete locally and attempt R2 cleanup
        $localPath = public_path($pathOrUrl);
        if (file_exists($localPath)) {
            @unlink($localPath);
        }
        try { $this->r2->delete($pathOrUrl); } catch (\Throwable) {}
    }

    /**
     * Returns the full R2 public URL for a stored path.
     * Passes full URLs through unchanged.
     */
    public function url(string $pathOrUrl): string
    {
        if (str_starts_with($pathOrUrl, 'http')) {
            return $pathOrUrl;
        }
        return $this->r2->url($pathOrUrl);
    }
}
