@extends('layouts.app')

@section('title', 'Restaurants - Foodpanda App')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">All Restaurants</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($restaurants as $restaurant)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <img src="{{ $restaurant['image'] }}" alt="{{ $restaurant['name'] }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $restaurant['name'] }}</h3>
                        <span class="flex items-center bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                            ★ {{ $restaurant['rating'] }}
                        </span>
                    </div>
                    <p class="text-gray-500 text-sm mb-2">{{ $restaurant['cuisine'] }} · {{ $restaurant['delivery_time'] }}</p>
                    <p class="text-gray-600 mb-4">{{ $restaurant['description'] }}</p>
                    @auth
                        <a href="{{ route('menu', $restaurant['id']) }}" class="block w-full bg-pink-600 text-white text-center px-4 py-2 rounded-lg hover:bg-pink-700 transition">
                            View Menu & Order
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full bg-gray-200 text-gray-600 text-center px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                            Login to Order
                        </a>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
