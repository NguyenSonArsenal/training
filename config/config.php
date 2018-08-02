<?php

return [
    'role_type' => [
        1 => 'super',
        2 => 'admin'
    ],
    'admin' => [
        'super' => 1,
        'admin' => 2
    ],
    'test' => 1,
    // guard
    'backend_guard' => 'admins',
    // config #
    'tmp_upload_dir' => 'tmp_uploads/',
    'upload_dir' => 'uploads/',
];