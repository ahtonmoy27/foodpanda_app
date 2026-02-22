@extends('layouts.app')

@section('title', $restaurant['name'] . ' - Menu')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <!-- Restaurant Header -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
        <img src="{{ $restaurant['image'] }}" alt="{{ $restaurant['name'] }}" class="w-full h-48 object-cover">
        <div class="p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $restaurant['name'] }}</h1>
                    <p class="text-gray-500 mt-1">{{ $restaurant['cuisine'] }} · {{ $restaurant['delivery_time'] }}</p>
                </div>
                <span class="flex items-center bg-green-100 text-green-800 px-3 py-1 rounded-lg">
                    <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    {{ $restaurant['rating'] }}
                </span>
            </div>
            <p class="text-gray-600 mt-4">{{ $restaurant['description'] }}</p>
        </div>
    </div>

    <!-- Menu Items -->
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Menu</h2>
    <div class="space-y-4">
        @foreach($menuItems as $item)
            <div class="bg-white rounded-xl shadow-lg p-6 flex justify-between items-center hover:shadow-xl transition">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $item['name'] }}</h3>
                    <p class="text-gray-600 text-sm">{{ $item['description'] }}</p>
                    <p class="text-xl font-bold text-pink-600 mt-2">${{ number_format($item['price'], 2) }}</p>
                </div>
                <form action="{{ route('order.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                    <input type="hidden" name="restaurant_id" value="{{ $restaurant['id'] }}">
                    <button type="submit" class="bg-pink-600 text-white px-6 py-2 rounded-lg hover:bg-pink-700 transition">
                        Add to Order
                    </button>
                </form>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        <a href="{{ route('restaurants') }}" class="text-pink-600 hover:text-pink-700 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Restaurants
        </a>
    </div>
</div>
@endsection
