<x-app-layout>
    <x-slot name="title">
        {{ __('My Wishlist') }}
    </x-slot>

    <x-slot name="header" class="text-2xl font-semibold text-gray-800">My Wishlist</x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        @foreach($wishlist as $product)
            <div class="p-4 border border-gray-300 rounded-lg shadow-lg mb-4 flex gap-4 items-center bg-gradient-to-r from-purple-100 to-blue-100 transition-transform transform hover:scale-105 duration-300">
                {{-- Product Image --}}
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded-lg shadow-md">

                <div class="flex-1">
                    <h2 class="text-lg font-bold text-gray-800 hover:text-blue-600 transition duration-300">{{ $product->name }}</h2>
                    <p class="text-gray-600">{{ Str::limit($product->description, 80) }}</p>
                    <p class="text-gray-800 font-semibold">Price: ₹{{ number_format($product->price, 2) }}</p>

                    <div class="mt-2 flex gap-2">
                        <form action="{{ route('buyer.wishlist.toggle', $product->id) }}" method="POST">
                            @csrf
                            <button class="inline-block text-red-600 hover:bg-red-100 px-4 py-2 rounded-lg transition duration-300" type="submit">Remove from Wishlist</button>
                        </form>

                        <form action="{{ route('buyer.cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-block text-green-600 hover:bg-green-100 px-4 py-2 rounded-lg transition duration-300">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
