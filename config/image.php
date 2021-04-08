<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'imagick',

    /*
    |--------------------------------------------------------------------------
    | Default Image Quality
    |--------------------------------------------------------------------------
    |
    | Define optionally the quality of the image.
    | It is normalized for all file types to a range from 0 (poor quality,
    | small file) to 100 (best quality, big file). Quality is only applied if
    | you're encoding JPG format since PNG compression is lossless and does
    | not affect image quality. The default value is 90.
    |
    | From 1 to 100 %
    |
    */

    'quality' => 90,

];
