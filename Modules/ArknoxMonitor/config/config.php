<?php

return [
    'route_prefix'        => 'arknox-monitor',
    'base_rent'           => 7.00,
    'free_queries'        => 0,
    'overage_rate'        => 0.001,
    'exclude_connections' => [],

    // URL path prefixes whose requests are never counted (no leading slash needed)
    'exclude_paths'       => [
        'cron/run',              // scheduler trigger — automated, not a user visit
        'api/attendance',        // device polling
    ],
];
