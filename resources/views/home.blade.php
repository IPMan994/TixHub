@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="bg-indigo-700 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Discover Amazing Events</h1>
                <p class="text-lg mb-6">Join us for unforgettable experiences and create your own events.</p>
                <a href="{{ route('explore') }}" class="bg-white text-indigo-700 px-6 py-3 rounded-md hover:bg-gray-100 transition">Get Started</a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Upcoming Events -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6 border-b pb-2">Upcoming Events</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($upcomingEvents as $event)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <!-- <div class="h-48 event-image" style="background-image: url('{{ $event->image_url ? asset('storage/' . $event->image_url) : asset('images/default-event.jpg') }}')"> -->
                        @if(!$event->image_url)
                        <div class="w-full h-full flex items-center justify-center bg-gray-200">
                            <span class="text-gray-500">Default Event Image</span>
                        </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="text-sm font-semibold text-indigo-600 mb-1">{{ $event->date_time->format('M d') }}</div>
                        <h3 class="font-bold text-lg mb-1">{{ $event->title }}</h3>
                        <p class="text-gray-600">{{ $event->location }}</p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm text-gray-500">{{ $event->category }}</span>
                            <a href="#" class="text-indigo-600 text-sm font-medium">Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Other Sections -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6 border-b pb-2">Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <!-- <div class="h-40 event-image mb-4" style="background-image: url('{{ asset('images/event-category-1.jpg') }}')"></div> -->
                    <h3 class="font-bold text-lg">Kategori Event 1</h3>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <!-- <div class="h-40 event-image mb-4" style="background-image: url('{{ asset('images/event-category-2.jpg') }}')"></div> -->
                    <h3 class="font-bold text-lg">Kategori Event 2</h3>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <!-- <div class="h-40 event-image mb-4" style="background-image: url('{{ asset('images/event-category-3.jpg') }}')"></div> -->
                    <h3 class="font-bold text-lg">Kategori Event 3</h3>
                </div>
            </div>
        </div>

        <!-- Create Your Own Event -->
        <div class="mb-12 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">Buat Event Kamu Sendiri</h2>
            <!-- <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <p class="text-gray-700 mb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
            <button class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                Buat Events
            </button>
        </div>
    </div>
@endsection