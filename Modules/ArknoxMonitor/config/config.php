<?php

return [
    'route_prefix'        => 'arknox-monitor',
    'secret'              => env('ARKNOX_MONITOR_SECRET'),
    'base_rent'           => 7.00,
    'free_queries'        => 0,
    'overage_rate'        => 0.001,
    'exclude_connections' => [],

    // URL path prefixes whose requests are never counted (no leading slash needed)
    'exclude_paths'       => [
        'cron/run',              // scheduler trigger — automated, not a user visit
        'api/attendance',        // device polling
    ],

    // Cloudflare R2 usage tracking
    'r2' => [
        'disk'            => 'r2',          // filesystem disk name in config/filesystems.php
        'bucket'          => env('CLOUDFLARE_R2_BUCKET', 'arknox-technology'),
        'public_url'      => env('CLOUDFLARE_R2_PUBLIC_URL', 'https://pub-2bea445fd1a2421ab98ba5b40a2e02db.r2.dev'),

        // R2 free tier thresholds (per calendar month)
        'free_storage_gb'  => 10,           // 10 GB storage free
        'free_class_a_ops' => 1_000_000,    // 1M PUT/DELETE/LIST ops free
        'free_class_b_ops' => 10_000_000,   // 10M GET/HEAD ops free

        // R2 overage pricing (USD)
        'price_storage_gb' => 0.015,        // per GB over free tier
        'price_class_a'    => 4.50,         // per million Class A ops over free tier
        'price_class_b'    => 0.36,         // per million Class B ops over free tier
        // egress is always free on R2
    ],
];
