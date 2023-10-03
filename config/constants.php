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

    'PERMISSION_BY_ROLE' => [
        'ADMIN' => '1,100,101,102,103,104,200,201,202,203,300,301,302,303,400,401,402,403,500,501,502,503,600,601,602,603,700,701,702,703,800,801,802,803',
        'PATIENT' => '',
        'DOCTOR' => '1,500,501,502,503,600,601,602,603,800,801,802,803',
        'RECEPTIONIST' => '1,100,101,102,103,104,800,801,802,803',
        'PHAMARCIST' => '1,400,401,402,403',
    ],

    'ROLE' => [
        'ADMIN' => 1,
        'PATIENT' => 2,
        'DOCTOR' => 3,
        'RECEPTIONIST' => 4,
        'PHAMARCIST' => 5,
    ]
];