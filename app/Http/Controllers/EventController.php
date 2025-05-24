<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::where('date_time', '>=', now())
            ->orderBy('date_time', 'asc')
            ->take(4)
            ->get();

        return view('home', compact('upcomingEvents'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // validasi lainnya
        ]);

        $eventData = $request->except('image');

        if ($request->hasFile('image')) {
            $eventData['image_url'] = Event::uploadImage($request->file('image'));
        }

        Event::create($eventData);

        return redirect()->route('home')->with('success', 'Event created!');
    }

    public function home()
    {
        $featuredEvents = Event::where('date_time', '>=', now())
            ->orderBy('date_time', 'asc')
            ->take(4)
            ->get();

        return view('home', compact('featuredEvents'));
    }

    public function explore()
    {
        $events = Event::where('date_time', '>=', now())
            ->orderBy('date_time', 'asc')
            ->paginate(6); // 6 event per halaman

        $categories = Event::select('category')->distinct()->pluck('category');

        return view('explore', compact('events', 'categories'));
    }


    public function show($id)
    {
        $event = Event::findOrFail($id);
    return view('events.show', compact('event'));
    }
}
