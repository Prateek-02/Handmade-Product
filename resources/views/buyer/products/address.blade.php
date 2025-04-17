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
                        <label class="block text-sm font-medium text-gray-700" for="address">Address</label>
                        <textarea 
                            name="address" 
                            rows="3" 
                            id="address" 
                            required 
                            class="w-full mt-1 rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="city">City</label>
                        <input 
                            type="text" 
                            name="city" 
                            id="city"
                            value="{{ old('city') }}" 
                            required 
                            class="w-full mt-1 rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('city')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="state">State</label>
                        <input 
                            type="text" 
                            name="state" 
                            id="state"
                            value="{{ old('state') }}" 
                            required 
                            class="w-full mt-1 rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('state')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="pincode">Pincode</label>
                        <input 
                            type="text" 
                            name="pincode" 
                            id="pincode"
                            value="{{ old('pincode') }}" 
                            required 
                            class="w-full mt-1 rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('pincode')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
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
