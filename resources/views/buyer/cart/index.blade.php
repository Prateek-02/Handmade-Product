<x-app-layout>
    <x-slot name="title">
        {{ __('My Cart') }}
    </x-slot>

    <x-slot name="header" class="text-2xl font-semibold text-gray-800">My Cart</x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        @if($cartItems->count())
            @foreach($cartItems as $item)
                <div class="p-4 border border-gray-300 rounded-lg shadow-lg mb-4 flex gap-4 items-center bg-gradient-to-r from-green-100 to-blue-100 transition-transform transform hover:scale-105 duration-300">
                    <img src="{{ asset('storage/' . $item->product->image) }}" class="w-24 h-24 object-cover rounded-lg shadow-md">
                    <div class="flex-1">
                        <h2 class="font-bold text-lg text-gray-800 hover:text-blue-600 transition duration-300">{{ $item->product->name }}</h2>
                        <p class="text-gray-700">Quantity: <span class="font-medium text-blue-600">{{ $item->quantity }}</span></p>
                        <p class="text-gray-700">Price: <span class="font-medium text-blue-600">₹{{ number_format($item->product->price, 2) }}</span></p>
                        
                        <div class="flex items-center gap-4 mt-2">
                            <form action="{{ route('buyer.cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline transition duration-300">Remove</button>
                            </form>

                            <!-- 🛒 Order this product -->
                            <a href="{{ route('buyer.order.address', $item->product->id) }}"
                               class="text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-md transition duration-300 shadow-md">
                                Buy This Item
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- 🧾 Cart-wide order -->
            <div class="text-center mt-8">
                <a href="{{ route('buyer.cart.address') }}"
                   class="inline-block bg-gradient-to-r from-indigo-600 to-blue-600 hover:bg-gradient-to-l text-white px-8 py-3 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:scale-105">
                    Buy All Items in Cart
                </a>
            </div>
        @else
            <div class="text-center text-gray-600 text-lg mt-10">Your cart is empty.</div>
        @endif
    </div>
</x-app-layout>
