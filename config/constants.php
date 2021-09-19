<?php

return [
    'available_languages'       => [
        'en_US'         => 'English',
        'pt_PT'         => 'Português',
    ],
    'primary_language'  => 'en_US',
    'datetime'  => [
        'date_format'           => 'Y-m-d',
        'datetime_format'       => 'Y-m-d H:i:s',
        'datetime_local_format' => 'Y-m-d\TH:i',
        'time_local_format'     => 'H:i',
        'time_format'           => 'H:i:s',
        'timestamp_format'      => 'Y-m-d H:i:s',
    ],
    'number'    => [
        'decimal_point'         => '.',
        'thousands_separator'   => ',',
        'precision'             => 2,
    ],
    'pagination'    => [
        'default_items'     => 10,
    ],
    'status'    => [
        'P'         => 'global.status.pending',
        'A'         => 'global.status.active',
        'R'         => 'global.status.rejected',
        'S'         => 'global.status.suspended',
        'I'         => 'global.status.inactive',
    ],
];
