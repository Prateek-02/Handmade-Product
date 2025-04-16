{{-- resources/views/buyer/orders/index.blade.php --}}
<x-app-layout>
    <x-slot name="title">
        {{ __('My Orders') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($orders->count() > 0)
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="min-w-full table-auto text-left">
                    <thead>
                        <tr>
                            <th class="border-b p-3">Product</th>
                            <th class="border-b p-3">Seller</th>
                            <th class="border-b p-3">Quantity</th>
                            <th class="border-b p-3">Total Price</th>
                            <th class="border-b p-3">Status</th>
                            <th class="border-b p-3">Ordered At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="border-b p-3">{{ $order->product->name ?? 'N/A' }}</td>
                                <td class="border-b p-3">{{ $order->product->user->name ?? 'N/A' }}</td>
                                <td class="border-b p-3">{{ $order->quantity }}</td>
                                <td class="border-b p-3">₹{{ $order->total_price }}</td>
                                <td class="border-b p-3 capitalize">{{ $order->status }}</td>
                                <td class="border-b p-3">{{ $order->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-4 bg-yellow-100 text-yellow-800 rounded">
                You haven't placed any orders yet.
            </div>
        @endif
    </div>
</x-app-layout>
