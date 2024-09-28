<?php

namespace App\Services;

use Illuminate\Support\Str;

class VendorService
{
    public static function a()
    {
        return Str::random(10);
    }
}