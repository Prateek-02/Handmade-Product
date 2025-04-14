<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Products</h2>
    </x-slot>

    <div class="py-8 px-4 max-w-4xl mx-auto">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6">
            <a href="{{ route('seller.products.create') }}"
               class="inline-block bg-yellow-500 hover:bg-yellow-400 text-gray-500 font-bold py-2 px-4 rounded">
                + Add New Product
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            @forelse($products as $product)
                <div class="border-b pb-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                 class="w-20 h-20 object-cover rounded border">
                        @else
                            <div class="w-20 h-20 flex items-center justify-center bg-gray-200 text-gray-500 rounded border">
                                No Image
                            </div>
                        @endif

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600">Price: ₹{{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>

                    <div class="flex space-x-2">
                        <a href="{{ route('seller.products.edit', $product) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Edit</a>

                        <form action="{{ route('seller.products.destroy', $product) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">No products found. Start by adding a new product.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
