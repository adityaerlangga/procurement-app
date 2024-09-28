<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = [
        'image_url',
        'price_formatted'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : Storage::url('uploads/default.jpeg');
    }

    public function getPriceFormattedAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
