<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Mail\OrderStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProviderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Pending Status Check
        if ($user->status === 'pending') {
            return view('provider.pending');
        }

        // Fetch Provider's Products
        $products = Product::where('user_id', $user->id)->latest()->paginate(10);
        
        // Stats
        $totalProducts = Product::where('user_id', $user->id)->count();
        
        // Orders (Items sold by this provider)
        $orderItemsQuery = OrderItem::whereHas('product', function($query) use ($user) {
            $query->where('user_id', $user->id);
        });

        $ordersCount = (clone $orderItemsQuery)->distinct('order_id')->count('order_id');

        // Recent Orders
        $recentOrders = $orderItemsQuery->with(['order.user', 'product'])->latest()->take(5)->get();

        // Return Requests
        $returnRequests = OrderItem::whereHas('product', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->whereHas('order', function($query) {
            $query->whereNotNull('return_status');
        })->with(['order.user', 'product'])->latest()->get();

        return view('provider.dashboard', compact('products', 'totalProducts', 'ordersCount', 'recentOrders', 'returnRequests'));
    }

    public function updateReturnStatus(Request $request, $id)
    {
        $request->validate([
            'return_status' => 'required|in:approved,rejected,completed'
        ]);

        $user = Auth::user();
        
        $orderItem = OrderItem::whereHas('product', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('order_id', $id)->first();

        if (!$orderItem) {
            abort(403);
        }

        $orderItem->order->update([
            'return_status' => $request->return_status
        ]);

        return back()->with('success', 'Return status updated to ' . ucfirst($request->return_status));
    }

    public function create()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('provider.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|url',
            'colors' => 'nullable|array',
            'gallery' => 'nullable|array',
        ]);

        $product = new Product($request->all());
        $product->user_id = Auth::id();
        $product->save();

        if ($request->has('gallery')) {
            foreach ($request->gallery as $url) {
                if ($url) {
                    ProductGallery::create([
                        'product_id' => $product->id,
                        'image_url' => $url,
                    ]);
                }
            }
        }

        return redirect()->route('provider.dashboard')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        // Ensure ownership
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('provider.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'colors' => 'nullable|array',
        ]);

        $product->update($request->all());

        return redirect()->route('provider.dashboard')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $product->delete();

        return back()->with('success', 'Product deleted.');
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,preparing,delivered,on the way,cancelled'
        ]);

        $user = Auth::user();
        
        // Find the order item owned by this provider to authorize the action
        $orderItem = OrderItem::whereHas('product', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('order_id', $id)->first();

        if (!$orderItem) {
            return back()->with('error', 'You are not authorized to update this order.');
        }

        // Update the main order status
        $orderItem->order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Order status updated to ' . ucfirst($request->status));
    }
}
