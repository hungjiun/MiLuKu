<?php

namespace App\Modules\File\Constants;

class FileConstant
{
    const DEFAULT_CONFIG = [
        'maxSizeInBytes' => 10 * 1024,
        'prefix' => '',
    ];

    const ALLOWED_IMAGE_MIME_TYPES = [
        'image/png' => 'png',
        'image/jpeg' => 'jpeg',
        'image/gif' => 'gif',
    ];
}
