<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Notifications\OrderStatusUpdated;

class OrderController extends Controller
{
    /**
     * Show the order form for a specific product.
     */
    public function orderForm(Product $product)
    {
        return view('buyer.products.order', compact('product'));
    }

    /**
     * Show the address form after selecting quantity.
     */
    public function addressForm(Request $request, Product $product)
    {
        $quantity = $request->input('quantity');

        if (!$quantity || $quantity < 1 || $quantity > $product->quantity) {
            return redirect()->route('buyer.order.form', $product->id)->withErrors(['quantity' => 'Invalid quantity.']);
        }

        return view('buyer.products.address', compact('product', 'quantity'));
    }

    /**
     * Place an order after address submission.
     */
    public function placeOrder(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->quantity,
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|digits:6',
        ]);

        $quantity = $request->quantity;
        $totalPrice = $product->price * $quantity;

        // Create the order
        $order = Order::create([
            'buyer_id' => Auth::id(),
            'seller_id' => $product->user_id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'status' => 'pending',
        ]);

        // Reduce the product stock
        $product->decrement('quantity', $quantity);

        // Notify the buyer
        Auth::user()->notify(new OrderStatusUpdated($order));

        // Redirect to order confirmation page
        return redirect()->route('buyer.order.confirmation', $order->id);
    }

    /**
     * Display order history for the logged-in buyer.
     */
    public function myOrders()
    {
        $orders = Order::with('product')
            ->where('buyer_id', Auth::id())
            ->latest()
            ->get();

        return view('buyer.orders.index', compact('orders'));
    }

    /**
     * Show confirmation page after placing an order.
     */
    public function confirmation(Order $order)
    {
        // Ensure the user is the owner of the order
        if ($order->buyer_id !== Auth::id()) {
            abort(403);
        }

        return view('buyer.orders.confirmation', compact('order'));
    }
}
