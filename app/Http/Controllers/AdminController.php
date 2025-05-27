<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            // Perbaikan: gunakan Auth::check() dan Auth::user()
            if (!Auth::check() || !Auth::user()->isAdmin) { // Ubah isAdmin() menjadi isAdmin
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.dashboard');
    }

    public function createEvent()
    {
        return view('Admin.events.create');
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

        return redirect()->route('Admin.dashboard')->with('success', 'Event created successfully');
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
