<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.dashboard', compact('events'));
    }

    public function createEvent()
    {
        return view('admin.events.create');
    }

    public function storeEvent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date',
            'location' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $eventData = $request->except('image');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/events');
            $eventData['image_url'] = str_replace('public/', '', $path);
        }

        Event::create($eventData);

        return redirect()->route('admin.dashboard')->with('success', 'Event created successfully');
    }

    public function destroyEvent(Event $event)
    {
        if ($event->image_url) {
            Storage::delete('public/' . $event->image_url);
        }

        $event->delete();

        return back()->with('success', 'Event deleted successfully');
    }
}
