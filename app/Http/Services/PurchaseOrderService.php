<?php

namespace App\Services;

use Illuminate\Support\Str;

class PurchaseOrderService
{
    public static function a()
    {
        return Str::random(10);
    }
}