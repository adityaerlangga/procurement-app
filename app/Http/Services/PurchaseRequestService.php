<?php

namespace App\Services;

use Illuminate\Support\Str;

class PurchaseRequestService
{
    public static function a()
    {
        return Str::random(10);
    }
}