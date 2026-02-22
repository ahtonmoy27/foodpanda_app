@extends('layouts.app')

@section('title', 'My Orders - Foodpanda App')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">My Order</h1>
    
    @if(count($orders) > 0)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="divide-y divide-gray-200">
                @php $total = 0; @endphp
                @foreach($orders as $order)
                    @php $total += $order['item']['price'] * $order['quantity']; @endphp
                    <div class="p-6 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $order['item']['name'] }}</h3>
                            <p class="text-gray-500 text-sm">{{ $order['item']['description'] }}</p>
                            <p class="text-sm text-gray-400 mt-1">Quantity: {{ $order['quantity'] }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xl font-bold text-pink-600">${{ number_format($order['item']['price'] * $order['quantity'], 2) }}</p>
                            <p class="text-sm text-gray-500">${{ number_format($order['item']['price'], 2) }} each</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="bg-gray-50 p-6">
                <div class="flex justify-between items-center">
                    <span class="text-xl font-bold text-gray-900">Total:</span>
                    <span class="text-2xl font-bold text-pink-600">${{ number_format($total, 2) }}</span>
                </div>
                <button class="mt-4 w-full bg-pink-600 text-white py-3 px-4 rounded-lg hover:bg-pink-700 transition font-semibold">
                    Place Order (Demo)
                </button>
            </div>
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">No items in your order</h2>
            <p class="text-gray-600 mb-6">Browse restaurants and add items to your order!</p>
            <a href="{{ route('restaurants') }}" class="bg-pink-600 text-white px-6 py-3 rounded-lg hover:bg-pink-700 transition inline-block">
                Browse Restaurants
            </a>
        </div>
    @endif
</div>
@endsection
