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
    'tmp_upload_dir' => 'tmp_uploads' . DIRECTORY_SEPARATOR,
    'upload_dir' => 'uploads' . DIRECTORY_SEPARATOR,

    // notification
    'create' => ['title' => 'success', 'message' => 'Created successfully'],
    'update' => ['title' => 'success', 'message' => 'Updated successfully'],
    'delete' => ['title' => 'success', 'message' => 'Deleted successfully'],
];