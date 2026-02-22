<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Foodpanda App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100">
    <!-- Navigation -->
    <nav class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="ml-2 text-xl font-bold text-white">Foodpanda App</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('restaurants') }}" class="text-white hover:text-gray-200 transition">Restaurants</a>
                    @auth
                        <a href="{{ route('orders') }}" class="text-white hover:text-gray-200 transition relative">
                            My Orders
                            @if(count(session('orders', [])) > 0)
                                <span class="absolute -top-2 -right-2 bg-yellow-400 text-gray-800 text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                    {{ count(session('orders', [])) }}
                                </span>
                            @endif
                        </a>
                        <span class="text-white">{{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-white text-pink-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                            Login with SSO
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Foodpanda App - SSO Demo</p>
            <p class="text-sm text-gray-400 mt-2">
                Connected to 
                <a href="{{ config('sso.auth_server_url') }}" class="text-pink-400 hover:underline" target="_blank">SSO Auth Server</a>
            </p>
        </div>
    </footer>
</body>
</html>
