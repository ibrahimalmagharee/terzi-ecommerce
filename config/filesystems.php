<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        'designs' => [
            'driver' => 'local',
            'root' => public_path('assets/images/products/designs/'),
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],

        'fabrics' => [
            'driver' => 'local',
            'root' => public_path('assets/images/products/fabrics/'),
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],

        'about' => [
            'driver' => 'local',
            'root' => public_path('assets/images/vendors/about/'),
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],

        'logo' => [
            'driver' => 'local',
            'root' => public_path('assets/images/vendors/logo/'),
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],

        'logo_site' => [
            'driver' => 'local',
            'root' => public_path('assets/images/logo_site/'),
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],

        'profile' => [
            'driver' => 'local',
            'root' => public_path('assets/images/vendors/profile/'),
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],

        'headerCover' => [
            'driver' => 'local',
            'root' => public_path('assets/images/vendors/headerCover/'),
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],

        'aboutSite' => [
            'driver' => 'local',
            'root' => public_path('assets/images/aboutSite/'),
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],

        'topHeader' => [
            'driver' => 'local',
            'root' => public_path('assets/images/index/topHeader/'),
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],

        'bottomHeader' => [
            'driver' => 'local',
            'root' => public_path('assets/images/index/bottomHeader/'),
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],

        'fabricSlider' => [
            'driver' => 'local',
            'root' => public_path('assets/images/index/fabricSlider/'),
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],

        'contentCenterDesign' => [
            'driver' => 'local',
            'root' => public_path('assets/images/index/contentCenterDesign/'),
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
