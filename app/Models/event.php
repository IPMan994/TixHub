<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'location',
        'date_time',
        'description',
        'image_url' // Pastikan ini sudah ada
    ];

    // Method untuk handle upload gambar
    public static function uploadImage($image)
    {
        $filename = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('public/events', $filename);
        return 'events/' . $filename;
    }
}
