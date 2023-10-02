<?php
return [
    'NUM_PER_PAGE' => 10,
    'IMG_USER_PATH' => 'public/user/',

    'PERMISSION' => [
        'VIEW_DASHBOARD' => 1,

        'VIEW_USER' => 100,
        'CREATE_USER' => 101,
        'EDIT_USER' => 102,
        'DELETE_USER' => 103,
        'LOCK_USER' => 104,

        'VIEW_ROLE' => 200,
        'CREATE_ROLE' => 201,
        'EDIT_ROLE' => 202,
        'DELETE_ROLE' => 203,

        'VIEW_CATEGORY' => 300,
        'CREATE_CATEGORY' => 301,
        'EDIT_CATEGORY' => 302,
        'DELETE_CATEGORY' => 303,

        'VIEW_MEDICINE' => 400,
        'CREATE_MEDICINE' => 401,
        'EDIT_MEDICINE' => 402,
        'DELETE_MEDICINE' => 403,

        'VIEW_PRESCRIPTION' => 500,
        'CREATE_PRESCRIPTION' => 501,
        'EDIT_PRESCRIPTION' => 502,
        'DELETE_PRESCRIPTION' => 503,

        'VIEW_SCHEDULE' => 600,
        'CREATE_SCHEDULE' => 601,
        'EDIT_SCHEDULE' => 602,
        'DELETE_SCHEDULE' => 603,

        'VIEW_FRAME' => 700,
        'CREATE_FRAME' => 701,
        'EDIT_FRAME' => 702,
        'DELETE_FRAME' => 703,

        'VIEW_APPOINTMENT' => 800,
        'CREATE_APPOINTMENT' => 801,
        'EDIT_APPOINTMENT' => 802,
        'DELETE_APPOINTMENT' => 803,
    ],

    'ROLE' => [
        'ADMIN' => 1,
        'USER' => 2,
        'DOCTOR' => 3,
        'RECEPTIONIST' => 4,
        'PHAMARCIST' => 5,
    ]
];