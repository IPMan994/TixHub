@extends('layouts.app')

@section('title', 'Create New Event')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Create New Event</h1>
        
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Basic Info Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Basic Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Event Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Event Title*</label>
                        <input type="text" id="title" name="title" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    
                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category*</label>
                        <select id="category" name="category" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Category</option>
                            <option value="Music">Music</option>
                            <option value="Sports">Sports</option>
                            <option value="Art">Art</option>
                            <option value="Food">Food</option>
                            <option value="Technology">Technology</option>
                        </select>
                    </div>
                    
                    <!-- Date & Time -->
                    <div>
                        <label for="date_time" class="block text-sm font-medium text-gray-700 mb-1">Date & Time*</label>
                        <input type="datetime-local" id="date_time" name="date_time" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    
                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location*</label>
                        <input type="text" id="location" name="location" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    
                    <!-- Event Image -->
                    <div class="md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Event Image</label>
                        <input type="file" id="image" name="image" accept="image/*"
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                </div>
            </div>
            
            <!-- Pricing Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Pricing</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Regular Price -->
                    <div>
                        <label for="regular_price" class="block text-sm font-medium text-gray-700 mb-1">Regular Price*</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" id="regular_price" name="regular_price" min="0" step="0.01" required
                                   class="block w-full pl-7 pr-12 py-2 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                    
                    <!-- VIP Price -->
                    <div>
                        <label for="vip_price" class="block text-sm font-medium text-gray-700 mb-1">VIP Price*</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" id="vip_price" name="vip_price" min="0" step="0.01" required
                                   class="block w-full pl-7 pr-12 py-2 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Benefits Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Ticket Benefits</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Regular Benefits -->
                    <div>
                        <label for="regular_benefits" class="block text-sm font-medium text-gray-700 mb-1">Regular Ticket Benefits*</label>
                        <textarea id="regular_benefits" name="regular_benefits" rows="4" required
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        <p class="mt-1 text-sm text-gray-500">Separate each benefit with a new line</p>
                    </div>
                    
                    <!-- VIP Benefits -->
                    <div>
                        <label for="vip_benefits" class="block text-sm font-medium text-gray-700 mb-1">VIP Ticket Benefits*</label>
                        <textarea id="vip_benefits" name="vip_benefits" rows="4" required
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        <p class="mt-1 text-sm text-gray-500">Separate each benefit with a new line</p>
                    </div>
                </div>
            </div>
            
            <!-- Description Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Event Description</h2>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Detailed Description*</label>
                    <textarea id="description" name="description" rows="6" required
                              class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Event
                </button>
            </div>
        </form>
    </div>
</div>
@endsection