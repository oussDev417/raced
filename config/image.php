<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD" and "Imagick" drivers. The default is
    | "GD" which is the most common and widely supported.
    |
    */

    'driver' => 'gd',

    /*
    |--------------------------------------------------------------------------
    | Image Storage Paths
    |--------------------------------------------------------------------------
    |
    | Define the paths where images should be stored for different purposes.
    |
    */

    'paths' => [
        'gallery' => 'images/gallery',
        'partners' => 'images/partners',
        'testimonials' => 'images/testimonials',
        'about' => 'images/about',
        'settings' => 'images/settings',
    ],

    /*
    |--------------------------------------------------------------------------
    | Image Dimensions
    |--------------------------------------------------------------------------
    |
    | Define standard dimensions for different image types.
    |
    */

    'dimensions' => [
        'thumbnail' => [
            'width' => 300,
            'height' => 200,
        ],
        'medium' => [
            'width' => 600,
            'height' => 400,
        ],
        'large' => [
            'width' => 1200,
            'height' => 800,
        ],
        'partner_logo' => [
            'width' => 200,
            'height' => 100,
        ],
    ],

]; 