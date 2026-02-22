@extends('layouts.app')

@section('title', 'Foodpanda App - Home')

@section('content')
<!-- Hero Section -->
<div class="gradient-bg text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Delicious Food, Delivered Fast!</h1>
        <p class="text-xl text-white/80 mb-8">Order from the best local restaurants with Single Sign-On</p>
        @guest
            <a href="{{ route('login') }}" class="bg-white text-pink-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Login with SSO
            </a>
            <p class="mt-4 text-sm text-white/60">Already logged in to Ecommerce? You'll be automatically authenticated!</p>
        @else
            <a href="{{ route('dashboard') }}" class="bg-white text-pink-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                Start Ordering
            </a>
        @endguest
    </div>
</div>

<!-- SSO Info Banner -->
<div class="bg-blue-50 border-b border-blue-200">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="flex items-center justify-center space-x-2 text-blue-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>This app uses SSO authentication. Login once at the Auth Server and access both Ecommerce and Foodpanda!</span>
        </div>
    </div>
</div>

<!-- Featured Restaurants -->
<div class="max-w-7xl mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Popular Restaurants</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($restaurants as $restaurant)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <img src="{{ $restaurant['image'] }}" alt="{{ $restaurant['name'] }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $restaurant['name'] }}</h3>
                        <span class="flex items-center bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            {{ $restaurant['rating'] }}
                        </span>
                    </div>
                    <p class="text-gray-500 text-sm mb-2">{{ $restaurant['cuisine'] }} · {{ $restaurant['delivery_time'] }}</p>
                    <p class="text-gray-600 mb-4">{{ $restaurant['description'] }}</p>
                    @auth
                        <a href="{{ route('menu', $restaurant['id']) }}" class="block w-full bg-pink-600 text-white text-center px-4 py-2 rounded-lg hover:bg-pink-700 transition">
                            View Menu
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

<!-- Switch to Ecommerce Banner -->
<div class="bg-green-50 border-t border-green-200">
    <div class="max-w-7xl mx-auto px-4 py-8 text-center">
        <h3 class="text-xl font-bold text-gray-900 mb-2">Need to Shop? Try Ecommerce!</h3>
        <p class="text-gray-600 mb-4">Already logged in here? You'll be automatically logged in to Ecommerce too!</p>
        <a href="http://localhost:8001" target="_blank" class="inline-flex items-center bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Go to Ecommerce
        </a>
    </div>
</div>
@endsection
