@extends('layouts.app')

@section('title', 'Dashboard - Foodpanda App')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <!-- Welcome Section -->
    <div class="bg-white shadow-xl rounded-2xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ $user->name }}!</h1>
                <p class="mt-2 text-gray-600">You're logged in via SSO. Ready to order some delicious food?</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Email: {{ $user->email }}</p>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-pink-100 text-pink-800">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    SSO Authenticated
                </span>
            </div>
        </div>
    </div>

    <!-- SSO Status Card -->
    <div class="bg-gradient-to-r from-pink-600 to-rose-600 rounded-2xl p-8 text-white mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Single Sign-On Active</h2>
                <p class="text-white/80">You can now access Ecommerce without logging in again!</p>
            </div>
            <a href="http://localhost:8001" target="_blank" class="bg-white text-pink-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Go to Ecommerce
            </a>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Current Order</p>
                    <p class="text-2xl font-bold text-gray-900">{{ count(session('orders', [])) }} items</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Restaurants</p>
                    <p class="text-2xl font-bold text-gray-900">{{ count($restaurants) }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">SSO Status</p>
                    <p class="text-2xl font-bold text-pink-600">Active</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Restaurants Section -->
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Order from Restaurants</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($restaurants as $restaurant)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <img src="{{ $restaurant['image'] }}" alt="{{ $restaurant['name'] }}" class="w-full h-40 object-cover">
                <div class="p-5">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $restaurant['name'] }}</h3>
                        <span class="flex items-center bg-green-100 text-green-800 px-2 py-0.5 rounded text-sm">
                            ★ {{ $restaurant['rating'] }}
                        </span>
                    </div>
                    <p class="text-gray-500 text-sm mb-3">{{ $restaurant['cuisine'] }} · {{ $restaurant['delivery_time'] }}</p>
                    <a href="{{ route('menu', $restaurant['id']) }}" class="block w-full bg-pink-600 text-white text-center px-3 py-2 rounded-lg hover:bg-pink-700 transition text-sm">
                        Order Now
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
