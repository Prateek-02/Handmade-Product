<x-app-layout>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buyer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-200 text-green-800 rounded-lg shadow-md">
                {{ session('success') }}
            </div>
        @endif

        {{-- 📦 Order History Card --}}
        <div class="p-6 bg-gradient-to-r from-blue-100 to-blue-300 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold mb-2 text-gray-800">My Order History</h3>
            <p class="text-sm text-gray-700 mb-4">View all orders you’ve placed so far.</p>
            <a href="{{ route('buyer.orders') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow transition duration-300 transform hover:scale-105">
                View Order History
            </a>
        </div>
    </div>
</x-app-layout>
