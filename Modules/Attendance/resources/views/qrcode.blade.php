@extends('admin.master_layout')
@section('title')<title>{{ __('Download Attendance App') }}</title>@endsection
@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Download Attendance App') }}</h3>
    <p class="crancy-header__text">{{ __('Attendance') }} >> {{ __('Download App') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="crancy-body">
                    <div class="crancy-dsinner">

                        <div class="card border-0 shadow-sm p-4 mt-3">
                            <div class="text-center mb-4">
                                <h4 class="mb-1">CreativLab Attendance App</h4>
                                <p class="text-muted" style="font-size:14px;">
                                    Install the desktop app on Windows PCs to automatically track office attendance via Wi-Fi.
                                </p>
                            </div>

                            <div class="row g-4">

                                {{-- Windows Download Card --}}
                                <div class="col-md-6">
                                    <div class="p-4 rounded h-100" style="background:#f0f4ff; border:2px solid #6366f1;">
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            <div style="width:48px;height:48px;background:#6366f1;border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                                <i class="fab fa-windows text-white fa-xl"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-0">Windows</h5>
                                                <small class="text-muted">Desktop Installer</small>
                                            </div>
                                        </div>

                                        <ul class="list-unstyled mb-4" style="font-size:13px;color:#374151;">
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Runs silently in the background</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Auto-starts on Windows login</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Detects office Wi-Fi automatically</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Syncs attendance without any action</li>
                                        </ul>

                                        <div>
                                            <div class="mb-2">
                                                <span class="badge bg-success">v1.0.0</span>
                                                <span class="text-muted ms-2" style="font-size:12px;">Windows 10/11 · 64-bit</span>
                                            </div>
                                            <a href="https://github.com/mdakashhossain1/creativlab/releases/latest/download/CreativLab-Attendance-Setup-1.0.0.exe"
                                               class="crancy-btn w-100 text-center d-block" style="text-decoration:none;">
                                                <i class="fas fa-download me-2"></i>Download Installer (.exe)
                                            </a>
                                            <p class="text-muted mt-2 mb-0" style="font-size:11px;">
                                                <i class="fas fa-shield-alt me-1 text-success"></i>
                                                Signed installer — run <code>trust-cert.ps1</code> once as Admin to bypass SmartScreen
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Android Placeholder --}}
                                <div class="col-md-6">
                                    <div class="p-4 rounded h-100" style="background:#f8fafc; border:2px dashed #cbd5e1;">
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            <div style="width:48px;height:48px;background:#e2e8f0;border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                                <i class="fab fa-android fa-xl" style="color:#94a3b8;"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-0 text-muted">Android</h5>
                                                <small class="text-muted">APK Coming Soon</small>
                                            </div>
                                        </div>

                                        <ul class="list-unstyled mb-4" style="font-size:13px;color:#94a3b8;">
                                            <li class="mb-2"><i class="fas fa-clock me-2"></i>GPS-based location check-in</li>
                                            <li class="mb-2"><i class="fas fa-clock me-2"></i>Background attendance tracking</li>
                                            <li class="mb-2"><i class="fas fa-clock me-2"></i>Push notifications</li>
                                            <li class="mb-2"><i class="fas fa-clock me-2"></i>Works on Android 8+</li>
                                        </ul>

                                        <div>
                                            <button class="btn btn-secondary w-100" disabled>
                                                <i class="fas fa-hourglass-half me-2"></i>Coming Soon
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{-- Setup Instructions --}}
                            <div class="mt-4 p-3 rounded" style="background:#fffbeb; border:1px solid #fcd34d;">
                                <h6 class="mb-2"><i class="fas fa-info-circle text-warning me-2"></i>First-Time Setup (Windows)</h6>
                                <ol class="mb-0 ps-3" style="font-size:13px;color:#374151;">
                                    <li>Download and run the installer above</li>
                                    <li>Right-click <code>trust-cert.ps1</code> → <strong>Run as Administrator</strong> (one-time, removes SmartScreen warning)</li>
                                    <li>The app starts automatically at login and runs in the system tray</li>
                                    <li>Click the tray icon to open the dashboard and link your device</li>
                                </ol>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
