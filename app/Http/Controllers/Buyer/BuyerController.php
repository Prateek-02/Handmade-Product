<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class BuyerController extends Controller
{
    // 🏠 Buyer Home with Search, Filter & Sort Functionality
    public function home(Request $request)
    {
        $search = $request->input('search');
        $priceOrder = $request->input('price_order'); // 'asc' or 'desc'
        $stock = $request->input('stock'); // 'in' or 'out'

        $products = Product::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->when($stock === 'in', function ($query) {
                $query->where('quantity', '>', 0);
            })
            ->when($stock === 'out', function ($query) {
                $query->where('quantity', '=', 0);
            })
            ->when(in_array($priceOrder, ['asc', 'desc']), function ($query) use ($priceOrder) {
                $query->orderBy('price', $priceOrder);
            }, function ($query) {
                $query->latest(); // default sort by latest
            })
            ->get();

        return view('buyer.home', compact('products'));
    }

    // 👤 Buyer Dashboard
    public function dashboard()
    {
        $products = Product::where('quantity', '>', 0)->latest()->get();
        return view('buyer.dashboard', compact('products'));
    }

    // 🛍️ Show All Products to Buyer
    public function products()
    {
        $products = Product::where('quantity', '>', 0)->latest()->get();
        return view('buyer.products.index', compact('products'));
    }
}
