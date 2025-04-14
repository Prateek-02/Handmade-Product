<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight bg-gradient-to-r from-blue-500 to-teal-600 bg-clip-text text-transparent">
            {{ __('Welcome to Buyer Home') }}
        </h2>
    </x-slot>

    <!-- Hero Banner Image -->
    <div class="relative w-full h-64 md:h-72 lg:h-80 overflow-hidden">
        <img src="{{ asset('images/marketplace-banner.jpg') }}" alt="Handmade Marketplace" 
             class="w-full h-full object-cover object-center" 
             onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/70 to-purple-900/50 flex items-center justify-center">
            <div class="text-center px-4">
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-2 drop-shadow-lg">Discover Unique Handmade Products</h1>
                <p class="text-white text-base md:text-lg max-w-2xl mx-auto drop-shadow-md">Support artisans and find one-of-a-kind treasures</p>
            </div>
        </div>
    </div>

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-gradient-to-b from-gray-50 to-white">
        <!-- Search & Filter Section -->
        <div class="mb-6 grid md:grid-cols-2 gap-4">
            <!-- Search Bar -->
            <form method="GET" action="{{ route('buyer.home') }}" class="flex gap-2 w-full">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition duration-300 ease-in-out"
                       placeholder="Search for handmade products...">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Search
                </button>
            </form>

            <!-- Filter Options -->
            <form method="GET" action="{{ route('buyer.home') }}" class="flex gap-2 flex-wrap items-center">
                <input type="hidden" name="search" value="{{ request('search') }}">
                
                <select name="price_order" class="px-3 py-2 border rounded-md text-sm text-gray-700">
                    <option value="">Sort by Price</option>
                    <option value="asc" {{ request('price_order') === 'asc' ? 'selected' : '' }}>Low to High</option>
                    <option value="desc" {{ request('price_order') === 'desc' ? 'selected' : '' }}>High to Low</option>
                </select>

                <select name="stock" class="px-3 py-2 border rounded-md text-sm text-gray-700">
                    <option value="">Stock</option>
                    <option value="in" {{ request('stock') === 'in' ? 'selected' : '' }}>In Stock</option>
                    <option value="out" {{ request('stock') === 'out' ? 'selected' : '' }}>Out of Stock</option>
                </select>

                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg shadow hover:shadow-md text-sm">
                    Apply Filters
                </button>
            </form>
        </div>

        <!-- Products Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-indigo-800 bg-gradient-to-r from-indigo-100 to-purple-100 px-4 py-3 rounded-lg shadow-sm border-l-4 border-indigo-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                    Available Products
                </h3>
                @if(!$products->isEmpty())
                <span class="text-sm text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full border border-indigo-200">
                    {{ $products->count() }} {{ Str::plural('item', $products->count()) }} found
                </span>
                @endif
            </div>
        </div>

        @if($products->isEmpty())
            <div class="bg-yellow-50 text-yellow-800 px-6 py-4 rounded-lg mb-6 border border-yellow-200 shadow-sm flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-base">No products{{ request('search') ? ' found for "' . request('search') . '"' : ' available' }}. Try different filters or check back later!</span>
            </div>
        @else
            <div class="grid gap-6 md:grid-cols-3 lg:grid-cols-4">
                @foreach($products as $product)
                    <div class="group bg-white shadow-md hover:shadow-xl rounded-xl flex flex-col transform hover:-translate-y-2 transition-all duration-300 ease-in-out border border-gray-100 overflow-hidden">
                        <!-- Product Image -->
                        <div class="relative overflow-hidden rounded-t-xl h-48">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-contain group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-100 text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 opacity-50 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-2 right-2">
                                <span class="bg-indigo-600 text-white text-xs px-2 py-1 rounded-full shadow-md">
                                    ₹{{ number_format($product->price, 2) }}
                                </span>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="flex-1 flex flex-col p-4">
                            <h4 class="text-lg font-bold text-gray-800 group-hover:text-indigo-600 transition duration-300">{{ $product->name }}</h4>
                            <p class="text-gray-600 my-2 flex-grow text-sm">{{ Str::limit($product->description, 80) }}</p>
                            <div class="mt-auto pt-3 border-t border-gray-100">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>In stock: <span class="font-medium">{{ $product->quantity }}</span></span>
                                    </div>
                                    <div class="text-xs text-gray-500 italic">Handmade</div>
                                </div>
                                <a href="{{ route('buyer.order.form', $product->id) }}" 
                                   class="inline-block w-full text-center bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out text-sm font-medium">
                                    Place Order
                                </a>

                                <!-- Wishlist Button -->
                                <form action="{{ route('buyer.wishlist.toggle', $product->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    <button type="submit" 
                                            class="inline-block w-full text-center bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out text-sm font-medium">
                                        {{ auth()->user()->hasInWishlist($product->id) ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
