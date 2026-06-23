<?php

return [
    'office_start_time' => '09:00',   // expected check-in time
    'late_threshold'    => '09:30',   // after this = late
    'half_day_cutoff'   => '13:00',   // checkout before this = half day
    'checkout_grace'    => 5,         // minutes after Wi-Fi disconnect before marking checkout
];
