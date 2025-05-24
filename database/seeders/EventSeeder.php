<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Event::create([
            'title' => 'Flow "Anime Shibari 2024 - 2025"',
            'category' => 'Anime',
            'location' => 'Tasikmalaya',
            'date_time' => Carbon::create(2024, 4, 14, 18, 0, 0),
            'description' => 'Anime convention featuring cosplay and special guests'
        ]);

        Event::create([
            'title' => 'Konser Jazz',
            'category' => 'Music',
            'location' => 'Jakarta',
            'date_time' => Carbon::create(2024, 5, 20, 19, 30, 0),
            'description' => 'Evening of smooth jazz performances'
        ]);

        Event::create([
            'title' => 'Festival Kuliner',
            'category' => 'Food',
            'location' => 'Bandung',
            'date_time' => Carbon::create(2024, 6, 15, 10, 0, 0),
            'description' => 'Food festival with various local cuisines'
        ]);

        Event::create([
            'title' => 'Pameran Seni Modern',
            'category' => 'Art',
            'location' => 'Yogyakarta',
            'date_time' => Carbon::create(2024, 7, 5, 9, 0, 0),
            'description' => 'Modern art exhibition featuring local artists'
        ]);

        Event::create([
            'title' => 'Konser Jazz Malam',
            'category' => 'Music',
            'location' => 'Gedung Kesenian Jakarta',
            'date_time' => now()->addDays(7),
            'description' => 'Konser jazz dengan musisi ternama dari dalam dan luar negeri',
            'image_url' => 'events/jazz-concert.jpg'
        ]);

        File::copy(
            public_path('images/default-event.jpg'),
            storage_path('app/public/events/default-event.jpg')
        );

        Event::create([
            'title' => 'Konser Jazz',
            'image_url' => 'events/default-event.jpg',
            // field lainnya
        ]);
    }
}
