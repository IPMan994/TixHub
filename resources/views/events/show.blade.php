<!-- resources/views/events/show.blade.php -->
@extends('layouts.app')

@section('title', $event->title . ' - TixHub')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('explore') }}" class="flex items-center text-indigo-600 hover:text-indigo-800">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Events
        </a>
    </div>

    <!-- Event Detail -->
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ $event->location }}</span>
                    </div>

                    <div class="prose max-w-none">
                        <h3 class="text-xl font-semibold mb-4">About This Event</h3>
                        <p>{{ $event->description }}</p>

                        <h3 class="text-xl font-semibold mt-8 mb-4">Event Details</h3>
                        <ul>
                            <li><strong>Date:</strong> {{ $event->date_time->format('l, F j, Y') }}</li>
                            <li><strong>Time:</strong> {{ $event->date_time->format('g:i A') }}</li>
                            <li><strong>Category:</strong> {{ $event->category }}</li>
                        </ul>
                    </div>
                </div>

                <!-- Booking Sidebar -->
                <div class="md:w-1/3">
                    <div class="bg-gray-50 p-6 rounded-lg sticky top-4">
                        <h3 class="text-xl font-bold mb-4">Book Tickets</h3>

                        <div class="space-y-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Select Date</label>
                                <input type="date" class="w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ticket Type</label>
                                <select class="w-full rounded-md border-gray-300 shadow-sm">
                                    <option>General Admission - $50</option>
                                    <option>VIP - $100</option>
                                    <option>Premium - $150</option>
                                </select>
                            </div>

                            <form action="{{ route('events.book', $event->id) }}" method="POST">
                                @csrf
                                <div class="space-y-4 mb-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Quantity (max 5)</label>
                                        <input type="number" name="quantity" min="1" max="5" value="1"
                                            class="w-full rounded-md border-gray-300 shadow-sm" required>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full bg-indigo-600 text-white py-3 rounded-md hover:bg-indigo-700 transition font-medium">
                                    Book Now ($50 per ticket)
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection