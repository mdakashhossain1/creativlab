<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $webinar->title }}</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body { margin: 0; padding: 0; }
        img { max-width: 100%; }
        {!! $webinar->page_css !!}

        /* Flash toast */
        .wb-toast { position: fixed; top: 20px; right: 20px; z-index: 99999; padding: 14px 22px; border-radius: 8px; font-family: sans-serif; font-size: 15px; font-weight: 600; box-shadow: 0 4px 20px rgba(0,0,0,.25); animation: wb-fadein .3s ease; max-width: 360px; }
        .wb-toast-success { background: #10b981; color: #fff; }
        .wb-toast-error   { background: #ef4444; color: #fff; }
        @keyframes wb-fadein { from { opacity:0; transform:translateY(-12px); } to { opacity:1; transform:translateY(0); } }
    </style>
</head>
<body>

{{-- Flash messages as a floating toast --}}
@if(session('message'))
<div class="wb-toast {{ session('alert-type') === 'error' ? 'wb-toast-error' : 'wb-toast-success' }}" id="wb-toast">
    {{ session('message') }}
</div>
<script>setTimeout(function(){ var t = document.getElementById('wb-toast'); if(t) t.remove(); }, 4000);</script>
@endif

{{-- GrapesJS built content — registration URL and CSRF injected via PHP str_replace --}}
@php
    $registerUrl = route('webinar.register', $webinar->slug);
    $csrfToken   = csrf_token();
    $html = $webinar->page_html ?? '';
    $html = str_replace('__WB_REGISTER_URL__', $registerUrl, $html);
    $html = str_replace('__WB_CSRF_TOKEN__',   $csrfToken,   $html);
@endphp
{!! $html !!}

</body>
</html>
