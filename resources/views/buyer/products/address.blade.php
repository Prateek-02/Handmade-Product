<x-app-layout>
    <x-slot name="title">
        {{ __('Shipping Address') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Shipping Address') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $product->name }}</h3>

            <form method="POST" action="{{ route('buyer.order.place', $product->id) }}">
                @csrf
                <input type="hidden" name="quantity" value="{{ request('quantity') }}">

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea name="address" rows="3" required class="w-full mt-1 rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" name="city" required class="w-full mt-1 rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">State</label>
                        <input type="text" name="state" required class="w-full mt-1 rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pincode</label>
                        <input type="text" name="pincode" required class="w-full mt-1 rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <button type="submit" class="mt-6 bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                    Place Order
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
