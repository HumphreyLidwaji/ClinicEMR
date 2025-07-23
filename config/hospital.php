<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Hospital Configuration
    |--------------------------------------------------------------------------
    |
    | These values are pulled from your .env file. You can override the defaults
    | here, or update the values in .env:
    |
    |   HOSPITAL_CODE
    |   HOSPITAL_NAME
    |   HOSPITAL_ADDRESS
    |   HOSPITAL_PHONE
    |   HOSPITAL_EMAIL
    |
    */

    'code'    => env('HOSPITAL_CODE', 'UNKNOWN'),
    'name'    => env('HOSPITAL_NAME', 'Your Hospital'),
    'address' => env('HOSPITAL_ADDRESS', ''),
    'phone'   => env('HOSPITAL_PHONE', ''),
    'email'   => env('HOSPITAL_EMAIL', ''),
];
