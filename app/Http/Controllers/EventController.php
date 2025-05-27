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
        return view('Admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date',
            'location' => 'required|string',
            'category' => 'required|string',
            'regular_price' => 'required|numeric|min:0',
            'vip_price' => 'required|numeric|min:0',
            'regular_benefits' => 'required|string',
            'vip_benefits' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $eventData = $request->except('image');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/events');
            $validated['image_url'] = str_replace('public/', '', $path);
        }

        Event::create($validated);

        return redirect()->route('Admin.dashboard')->with('success', 'Event created successfully!');
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
