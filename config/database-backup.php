<?php

return [
    'google_drive' => [
        'credentials_path' => env('GOOGLE_DRIVE_CREDENTIALS', storage_path('app/google-drive/credentials.json')),
        'folder_id' => env('GOOGLE_DRIVE_FOLDER_ID'),
    ],
];