<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Handmade Marketplace</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Hero Section with Background Image -->
    <div class="min-h-screen flex flex-col justify-center items-center text-center px-4 relative">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('https://images.unsplash.com/photo-1607082349566-187342175e2f?ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80');">
            <div class="absolute inset-0 bg-indigo-900 bg-opacity-70"></div>
        </div>
        
        <!-- Content -->
        <div class="relative z-10 max-w-4xl">
            <div class="mb-8">
                <img src="https://cdn-icons-png.flaticon.com/512/1250/1250615.png" alt="Marketplace Logo" class="w-24 h-24 mx-auto mb-4">
            </div>
            
            <h1 class="text-5xl font-bold text-white mb-4 animate-pulse">Welcome to Handmade Marketplace 🧶</h1>
            <p class="text-xl text-indigo-100 mb-10">A place where creativity meets customers.</p>

            @auth
                <div class="bg-white bg-opacity-90 p-6 rounded-lg shadow-lg mb-8">
                    <p class="mb-4">Hi <strong>{{ Auth::user()->name }}</strong>! You're logged in as <strong>{{ Auth::user()->role }}</strong>.</p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @if (Auth::user()->role === 'buyer')
                            <a href="{{ route('buyer.dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md shadow-md transform hover:scale-105 transition duration-300">
                                Go to Buyer Dashboard
                            </a>
                        @elseif (Auth::user()->role === 'seller')
                            <a href="{{ route('seller.dashboard') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-md shadow-md transform hover:scale-105 transition duration-300">
                                Go to Seller Dashboard
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="bg-gray-700 hover:bg-gray-800 text-white px-6 py-3 rounded-md shadow-md transform hover:scale-105 transition duration-300">
                                Go to Dashboard
                            </a>
                        @endif

                        {{-- Logout Form --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-md shadow-md transform hover:scale-105 transition duration-300">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="flex gap-4 justify-center">
                    <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-md shadow-lg transform hover:scale-105 transition duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-indigo-700 px-8 py-3 rounded-md shadow-lg transform hover:scale-105 transition duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z" />
                            <path d="M16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                        </svg>
                        Register
                    </a>
                </div>
            @endauth
        </div>

        <!-- Feature Cards -->
        @guest
        <div class="relative z-10 mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                <img src="https://images.unsplash.com/photo-1509631179647-0177331693ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Handmade Products" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-indigo-700 mb-2">Unique Handmade Products</h3>
                    <p class="text-gray-600">Discover one-of-a-kind items crafted with passion and skill.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Sell Your Crafts" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-indigo-700 mb-2">Sell Your Crafts</h3>
                    <p class="text-gray-600">Turn your passion into profit by reaching customers worldwide.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                <img src="https://images.unsplash.com/photo-1522204523234-8729aa6e3d5f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Support Artisans" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-indigo-700 mb-2">Support Artisans</h3>
                    <p class="text-gray-600">Every purchase directly supports independent creators and their craft.</p>
                </div>
            </div>
        </div>
        @endguest

        <footer class="mt-16 text-sm text-white relative z-10">
            &copy; {{ date('Y') }} Handmade Marketplace. All rights reserved.
        </footer>
    </div>
</body>
</html>
