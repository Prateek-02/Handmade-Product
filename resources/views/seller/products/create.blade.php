<x-app-layout>
    <x-slot name="title">
        {{ __('Add New Product') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Product</h2>
    </x-slot>

    <div class="py-10 px-4 max-w-3xl mx-auto">
        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-100 text-red-700 p-4 rounded">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Product Form --}}
        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded p-6">
            @csrf

            {{-- Product Name --}}
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Product Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Enter product name"
                    required
                    autofocus
                >
            </div>

            {{-- Product Price --}}
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-semibold mb-2">Price (₹)</label>
                <input
                    type="number"
                    step="0.01"
                    name="price"
                    id="price"
                    value="{{ old('price') }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Enter price"
                    required
                >
            </div>

            {{-- Product Quantity --}}
            <div class="mb-6">
                <label for="quantity" class="block text-gray-700 font-semibold mb-2">Quantity</label>
                <input
                    type="number"
                    name="quantity"
                    id="quantity"
                    value="{{ old('quantity') }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Enter quantity"
                    required
                >
            </div>
            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-semibold mb-2">Product Image</label>
                <input
                    type="file"
                    name="image"
                    id="image"
                    accept="image/*"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
            </div>

            {{-- Buttons --}}
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-6 rounded">
                    Add Product
                </button>
                <a href="{{ route('seller.products.index') }}" class="text-indigo-600 hover:underline text-sm">
                    ← Back to Product List
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
