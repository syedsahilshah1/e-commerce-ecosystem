<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->take(8)->get();
        $categories = Category::whereNull('parent_id')->withCount('products')->get();
        $sundaySaleProducts = Product::where('is_on_sunday_sale', true)->take(4)->get();
        
        return view('home', compact('products', 'categories', 'sundaySaleProducts'));
    }

    public function shop(Request $request)
    {
        $query = Product::with('category');
        
        if ($request->has('category') && $request->category) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $categoryIds = $category->children()->pluck('id')->push($category->id);
                $query->whereIn('category_id', $categoryIds);
            }
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12);
        $categories = Category::whereNull('parent_id')->get();
        
        return view('shop', compact('products', 'categories'));
    }

    public function about()
    {
        return view('about');
    }

    public function shipping()
    {
        return view('shipping');
    }

    public function helpCenter()
    {
        return view('help-center');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('q', '');
        $products = collect();

        if ($searchTerm) {
            $products = Product::with('category')
                ->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                ->paginate(12);
        }
            
        return view('search', compact('products', 'searchTerm'));
    }
}
