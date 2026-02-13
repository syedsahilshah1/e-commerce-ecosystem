<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return view('categories', compact('categories'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->with('children')->firstOrFail();
        
        // Get products from this category AND its subcategories
        $categoryIds = $category->children()->pluck('id')->push($category->id);
        $products = Product::whereIn('category_id', $categoryIds)->paginate(12);
        
        $allCategories = Category::whereNull('parent_id')->with('children')->get();
        
        return view('category', compact('category', 'products', 'allCategories'));
    }
}
