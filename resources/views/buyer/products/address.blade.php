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
                        <textarea name="address" rows="3" required pattern="^[A-Za-z0-9\s,.'-]{5,}$" title="Address must be at least 5 characters long and can include letters, numbers, spaces, and certain punctuation." class="w-full mt-1 rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        @error('address')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" name="city" required pattern="[A-Za-z\s]+" title="City name should only contain letters." class="w-full mt-1 rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('city')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">State</label>
                        <input type="text" name="state" required pattern="[A-Za-z\s]+" title="State name should only contain letters." class="w-full mt-1 rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('state')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pincode</label>
                        <input type="text" name="pincode" required pattern="\d{6}" title="Pincode must be exactly 6 digits." class="w-full mt-1 rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('pincode')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="mt-6 bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                    Place Order
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
