<?php
/**
 * Created by PhpStorm.
 * User: lacasera
 * Date: 10/21/19
 * Time: 11:22 PM
 */

return [
    'cloudinary' => [
        'apiKey' => env('CLOUDINARY_API_KEY', ''),
        'apiSecret' => env('CLOUDINARY_API_SECRET', ''),
        'cloudName' => env('CLOUDINARY_CLOUD_NAME', '')
    ]
];