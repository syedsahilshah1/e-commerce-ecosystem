<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Update product average rating
        $product = Product::find($request->product_id);
        $avgRating = Review::where('product_id', $product->id)->avg('rating');
        $count = Review::where('product_id', $product->id)->count();

        $product->update([
            'rating' => round($avgRating, 1),
            'reviews_count' => $count
        ]);

        return back()->with('success', 'Thank you for your review!');
    }
}
