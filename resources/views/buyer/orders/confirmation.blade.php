<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold mb-6 text-center text-green-600">🎉 Order Placed Successfully!</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Details -->
            <div class="border rounded p-4">
                <h3 class="text-lg font-bold mb-3">🛍️ Product Details</h3>
                <img src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name }}" class="w-full h-52 object-cover rounded mb-3">
                <p><strong>Name:</strong> {{ $order->product->name }}</p>
                <p><strong>Price:</strong> ₹{{ number_format($order->product->price, 2) }}</p>
                <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                <p><strong>Total:</strong> ₹{{ number_format($order->total_price, 2) }}</p>
            </div>

            <!-- Shipping Address -->
            <div class="border rounded p-4">
                <h3 class="text-lg font-bold mb-3">📦 Shipping Address</h3>
                <p><strong>Address:</strong> {{ $order->address }}</p>
                <p><strong>City:</strong> {{ $order->city }}</p>
                <p><strong>State:</strong> {{ $order->state }}</p>
                <p><strong>Pincode:</strong> {{ $order->pincode }}</p>
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('buyer.orders') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                📄 View My Orders
            </a>
        </div>
    </div>
</x-app-layout>
