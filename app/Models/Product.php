<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description', 'price', 'old_price', 'image', 'colors', 'category_id', 'stock', 'rating', 'reviews_count', 'is_on_sunday_sale'
    ];

    protected $casts = [
        'colors' => 'array',
        'is_on_sunday_sale' => 'boolean'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gallery()
    {
        return $this->hasMany(ProductGallery::class);
    }
}
