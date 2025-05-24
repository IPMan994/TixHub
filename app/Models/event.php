<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date_time',
        'location',
        'category',
        'regular_price',
        'vip_price',
        'regular_benefits',
        'vip_benefits',
        'image_url'
    ];

    protected $casts = [
        'date_time' => 'datetime',
        'regular_price' => 'decimal:2',
        'vip_price' => 'decimal:2'
    ];

    // Method untuk handle upload gambar
    public static function uploadImage($image)
    {
        $filename = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('public/events', $filename);
        return 'events/' . $filename;
    }
}
