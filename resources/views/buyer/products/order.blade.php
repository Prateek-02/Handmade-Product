{{-- resources/views/buyer/products/order.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Order Product') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-blue-100 to-purple-100 shadow-lg rounded-lg p-6">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-lg mb-4">
            <h3 class="text-3xl font-bold mb-2 text-indigo-800">{{ $product->name }}</h3>
            <p class="mb-2 text-gray-800">{{ $product->description }}</p>
            <p class="mb-4 text-lg text-green-600 font-semibold">Price: ₹{{ number_format($product->price, 2) }}</p>
            <p class="mb-4 text-sm text-gray-600">Available Quantity: 
                <span class="font-medium text-blue-600">{{ $product->quantity }}</span>
            </p>

            <form method="GET" action="{{ route('buyer.order.address', $product->id) }}">
                @csrf
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->quantity }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('quantity')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" 
                    class="bg-gradient-to-r from-indigo-600 to-blue-600 hover:bg-gradient-to-l text-white px-6 py-3 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Continue to Address
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
