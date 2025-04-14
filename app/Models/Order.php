<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;
use App\Models\User;

class Order extends Model
{
    protected $fillable = [
        'buyer_id',
        'seller_id',
        'product_id',
        'quantity',
        'total_price',
        'status',
    ];

    /**
     * Get the product associated with the order.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the buyer who placed the order.
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * Get the seller who listed the product.
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * Trigger notification when the order status is updated.
     */
    protected static function booted()
    {
        static::updated(function ($order) {
            // Send email notification if the order status changes
            if (in_array($order->status, ['accepted', 'rejected'])) {
                $order->buyer->notify(new \App\Notifications\OrderStatusUpdated($order));
            }
        });
    }
}
