@php
    $settings = Modules\GlobalSetting\App\Models\GlobalSetting::get()->keyBy('key');
    $setting_logo = Modules\GlobalSetting\App\Models\GlobalSetting::where('key','favicon')->first();
    $seo_setting = Modules\SeoSetting\App\Models\SeoSetting::where('id', 1)->first();
    $logoPath =  $setting_logo->value ?? null;
    $isSvg = $logoPath && pathinfo($logoPath, PATHINFO_EXTENSION) === 'svg';

    // Get PWA icons from database
    $pwaIcons = Modules\GlobalSetting\App\Models\PwaIconSetting::getActiveIcons();

@endphp
{
    "name": "{{ $settings->get('app_name')->value ?? config('app.name', 'My App') }}",
    "short_name": "{{ $settings->get('app_name')->value ?? config('app.name', 'My App') }}",
    "description": "{{ $seo_setting?->seo_title ?? config('app.name', 'My App') }}",
    "start_url": "/",
    "display": "standalone",
    "background_color": "#ffffff",
    "theme_color": "#000000",
    "orientation": "any",
    "scope": "/",
    "lang": "en",
    "icons": [
        @foreach($pwaIcons as $icon)
        {
            "src": "{{ $icon->icon_path ? asset($icon->icon_path) : asset('/images/icons/logo-' . $icon->icon_size . '.png') }}",
            "sizes": "{{ $icon->icon_size }}",
            "type": "{{ $icon->icon_type }}",
            "purpose": "{{ $icon->purpose }}"
        }@if(!$loop->last),@endif
        @endforeach
    ]
}


