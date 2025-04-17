<x-app-layout>
    <x-slot name="title">
        {{ __('Edit Product') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Product</h2>
    </x-slot>

    <div class="py-6 px-4 max-w-xl mx-auto">
    <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block">Product Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="border rounded p-2 w-full" required>
            </div>

            <div class="mb-4">
                <label class="block">Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="border rounded p-2 w-full" required>
            </div>

            <div class="mt-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity (Stock)</label>
                <input type="number" name="quantity" id="quantity" min="0" value="{{ old('quantity', $product->quantity) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label class="block">Product Image</label>
                <input type="file" name="image" class="border rounded p-2 w-full" accept="image/*">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="mt-2 h-20" alt="Product Image">
                @endif
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update Product</button>
        </form>
    </div>
</x-app-layout>
