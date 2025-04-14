<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Notifications\OrderStatusUpdated;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::whereHas('product', function ($query) {
            $query->where('user_id', auth()->id());
        })->with(['product', 'buyer'])->get();

        return view('seller.orders.index', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Ensure only the seller who owns the product can update the order
        if ($order->product->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Update order status based on the action
        if ($request->action === 'accept') {
            $order->status = 'accepted';
        } elseif ($request->action === 'reject') {
            $order->status = 'rejected';
        }

        $order->save();

        // Send a unified status update notification to the buyer
        $order->buyer->notify(new OrderStatusUpdated($order));

        return redirect()->back()->with('success', 'Order status updated and buyer notified!');
    }
}
