@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Event Image -->
        <div class="h-96 w-full relative">
            <img src="{{ $event->image_url ? asset('storage/'.$event->image_url) : asset('images/default-event.jpg') }}" 
                 alt="{{ $event->title }}"
                 class="w-full h-full object-cover">
        </div>

        <!-- Event Content -->
        <div class="p-8">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Main Content -->
                <div class="md:w-2/3">
                    <h1 class="text-3xl font-bold mb-2">{{ $event->title }}</h1>
                    <div class="flex items-center text-gray-600 mb-6">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ $event->location }}</span>
                    </div>

                    <div class="prose max-w-none mb-8">
                        <h3 class="text-xl font-semibold mb-4">About This Event</h3>
                        <p>{{ $event->description }}</p>
                    </div>

                    <!-- Benefits -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Regular Benefits -->
                        <div class="border rounded-lg p-4">
                            <h4 class="font-semibold text-lg mb-2">Regular Ticket (${{ number_format($event->regular_price, 2) }})</h4>
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach(explode("\n", $event->regular_benefits) as $benefit)
                                    @if(trim($benefit))
                                        <li>{{ $benefit }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        
                        <!-- VIP Benefits -->
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <h4 class="font-semibold text-lg mb-2">VIP Ticket (${{ number_format($event->vip_price, 2) }})</h4>
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach(explode("\n", $event->vip_benefits) as $benefit)
                                    @if(trim($benefit))
                                        <li>{{ $benefit }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Booking Sidebar -->
                <div class="md:w-1/3">
                    <div class="bg-gray-50 p-6 rounded-lg sticky top-4">
                        <h3 class="text-xl font-bold mb-4">Book Tickets</h3>
                        
                        <form action="{{ route('tickets.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            
                            <div class="space-y-4 mb-6">
                                <!-- Ticket Type -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Ticket Type</label>
                                    <select name="ticket_type" class="w-full rounded-md border-gray-300 shadow-sm">
                                        <option value="regular">Regular - ${{ number_format($event->regular_price, 2) }}</option>
                                        <option value="vip">VIP - ${{ number_format($event->vip_price, 2) }}</option>
                                    </select>
                                </div>
                                
                                <!-- Quantity -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity (max 5)</label>
                                    <input type="number" name="quantity" min="1" max="5" value="1" 
                                           class="w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                
                                <!-- Date -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Date</label>
                                    <p class="text-gray-900">{{ $event->date_time->format('l, F j, Y') }}</p>
                                </div>
                                
                                <!-- Time -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Time</label>
                                    <p class="text-gray-900">{{ $event->date_time->format('g:i A') }}</p>
                                </div>
                            </div>

                            <button type="submit" 
                                    class="w-full bg-indigo-600 text-white py-3 rounded-md hover:bg-indigo-700 transition font-medium">
                                Book Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection