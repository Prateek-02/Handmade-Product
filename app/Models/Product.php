<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'price',
        'quantity',
        'image',
    ];

    /**
     * Get the seller (user) who owns the product.
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Also keep the original relationship if needed elsewhere.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Users who have wishlisted this product.
     */
    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'product_user_wishlist')->withTimestamps();
    }
}
