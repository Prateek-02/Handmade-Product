<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seller Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    You're logged in as a <strong>Seller</strong>!
                </div>
            </div>

            {{-- Dashboard Features --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <!-- My Products -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">My Products</h3>
                    <p class="text-sm text-gray-600 mb-4">View and manage all the products you've listed.</p>
                    <a href="{{ route('seller.products.index') }}" class="text-indigo-600 hover:underline">View Products</a>
                </div>

                <!-- Add New Product -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Add New Product</h3>
                    <p class="text-sm text-gray-600 mb-4">Create a new product listing to start selling.</p>
                    <a href="{{ route('seller.products.create') }}" class="text-indigo-600 hover:underline">Add Product</a>
                </div>

                <!-- Orders Received -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Orders Received</h3>
                    <p class="text-sm text-gray-600 mb-4">Check the orders customers have placed.</p>
                    <a href="{{ route('seller.orders') }}" class="text-indigo-600 hover:underline">View Orders</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
