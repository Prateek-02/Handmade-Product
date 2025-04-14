<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = auth()->user()->wishlist()->with('seller')->get();
        return view('buyer.wishlist.index', compact('wishlist'));
    }

    public function toggle(Product $product)
    {
        $user = auth()->user();
        if ($user->hasInWishlist($product->id)) {
            $user->wishlist()->detach($product->id);
        } else {
            $user->wishlist()->attach($product->id);
        }

        return back()->with('success', 'Wishlist updated successfully!');
    }
}
