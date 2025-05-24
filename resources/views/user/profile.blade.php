@extends('layouts.app', ['title' => 'My Tickets'])

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold mb-8">My Tickets</h1>

    @if($tickets->isEmpty())
    <div class="bg-white p-6 rounded-lg shadow text-center">
        <p class="text-gray-600">You haven't booked any tickets yet.</p>
        <a href="{{ route('explore') }}" class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
            Browse Events
        </a>
    </div>
    @else
    <div class="space-y-6">
        @foreach($tickets as $ticket)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex flex-col md:flex-row justify-between">
                    <div class="md:w-2/3">
                        <h2 class="text-xl font-bold">{{ $ticket->event->title }}</h2>
                        <div class="mt-2 text-gray-600">
                            <span class="font-medium">Quantity:</span> {{ $ticket->quantity }} tickets
                        </div>
                        <div class="mt-1 text-gray-600">
                            <span class="font-medium">Total Price:</span> ${{ number_format($ticket->total_price, 2) }}
                        </div>
                        <div class="mt-1 text-gray-600">
                            <span class="font-medium">Status:</span>
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $ticket->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="md:w-1/3 mt-4 md:mt-0 md:text-right">
                        <div class="text-gray-600">
                            <span class="font-medium">Event Date:</span>
                            {{ $ticket->event->date_time->format('M d, Y g:i A') }}
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('events.show', $ticket->event->id) }}"
                                class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                View Event
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection