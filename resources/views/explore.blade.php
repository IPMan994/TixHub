<!-- resources/views/explore.blade.php -->
@extends('layouts.app')

@section('title', 'Explore Events - TixHub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Filter Section -->
    <div class="mb-8 bg-white p-6 rounded-lg shadow-sm">
        <h2 class="text-xl font-semibold mb-4">Filter by Category</h2>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('explore') }}"
                class="px-4 py-2 rounded-full text-sm font-medium 
                      {{ !request('category') ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                All Categories
            </a>
            @foreach($categories as $category)
            <a href="{{ route('explore', ['category' => $category]) }}"
                class="px-4 py-2 rounded-full text-sm font-medium 
                      {{ request('category') == $category ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                {{ $category }}
            </a>
            @endforeach
        </div>
    </div>

    <!-- Events Grid -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-6">Upcoming Events</h2>

        @if($events->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500">No upcoming events found.</p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <!-- Event Image -->
                <div class="h-48 w-full relative overflow-hidden">
                    <img src="{{ $event->image_url ? asset('storage/'.$event->image_url) : asset('images/default-event.jpg') }}"
                        alt="{{ $event->title }}"
                        class="w-full h-full object-cover hover:scale-105 transition duration-300">
                    <div class="absolute top-2 right-2 bg-indigo-600 text-white px-2 py-1 rounded text-xs font-semibold">
                        {{ $event->category }}
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <div class="text-white text-sm font-medium">
                            {{ $event->date_time->format('D, M j') }} • {{ $event->date_time->format('g:i A') }}
                        </div>
                    </div>
                </div>

                <!-- Event Content -->
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">{{ $event->title }}</h3>
                    <div class="flex items-center text-gray-600 mb-4">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $event->location }}
                    </div>

                    <p class="text-gray-600 mb-4 line-clamp-2">
                        {{ $event->description }}
                    </p>

                    <div class="flex justify-between items-center">
                        <span class="text-indigo-600 font-medium">
                            {{ $event->date_time->format('M j, Y') }}
                        </span>
                        <a href="{{ route('events.show', $event->id) }}"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition flex items-center">
                            Lihat Event
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Pagination -->
        <div class="mt-8">
            {{ $events->links() }}
        </div>
    </div>
</div>
@endsection