<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $tickets = auth()->user()->tickets()->with('event')->latest()->get();
        return view('user.profile', compact('tickets'));
    }

    public function bookTicket(Request $request, Event $event)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:5',
        ]);

        // Cek apakah user sudah booking event ini sebelumnya
        $existingTicket = auth()->user()->tickets()
            ->where('event_id', $event->id)
            ->first();

        if ($existingTicket) {
            return back()->with('error', 'You have already booked this event');
        }

        // Hitung total harga (contoh: $50 per tiket)
        $pricePerTicket = 50;
        $totalPrice = $request->quantity * $pricePerTicket;

        // Buat tiket
        auth()->user()->tickets()->create([
            'event_id' => $event->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'confirmed'
        ]);

        return redirect()->route('user.profile')->with('success', 'Ticket booked successfully');
    }
}
