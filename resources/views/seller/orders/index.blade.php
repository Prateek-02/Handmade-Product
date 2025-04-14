{{-- resources/views/seller/orders/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Product Orders') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($orders->count() > 0)
            <div class="bg-white shadow rounded p-6">
                <table class="min-w-full table-auto text-left">
                    <thead>
                        <tr>
                            <th class="p-3 border-b">Buyer</th>
                            <th class="p-3 border-b">Product</th>
                            <th class="p-3 border-b">Quantity</th>
                            <th class="p-3 border-b">Total Price</th>
                            <th class="p-3 border-b">Status</th>
                            <th class="p-3 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="p-3 border-b">{{ $order->buyer->name ?? 'N/A' }}</td>
                                <td class="p-3 border-b">{{ $order->product->name ?? 'N/A' }}</td>
                                <td class="p-3 border-b">{{ $order->quantity }}</td>
                                <td class="p-3 border-b">₹{{ $order->total_price }}</td>
                                <td class="p-3 border-b capitalize">{{ $order->status }}</td>
                                <td class="p-3 border-b">
                                    @if ($order->status === 'pending')
                                        <form action="{{ route('seller.orders.update', $order->id) }}" method="POST" class="flex gap-2">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="action" value="accept">
                                            <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">Accept</button>
                                        </form>

                                        <form action="{{ route('seller.orders.update', $order->id) }}" method="POST" class="mt-1">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Reject</button>
                                        </form>
                                    @else
                                        <span class="text-gray-500 italic">No actions</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-4 bg-yellow-100 text-yellow-700 rounded">
                No orders yet on your products.
            </div>
        @endif
    </div>
</x-app-layout>
