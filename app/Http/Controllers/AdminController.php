<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $pendingProviders = User::where('role', 'provider')->where('status', 'pending')->get();
        $approvedProviders = User::where('role', 'provider')->where('status', 'approved')->get();
        
        // Basic stats
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $allProducts = Product::with('user')->latest()->get();
        
        return view('admin.dashboard', compact('pendingProviders', 'approvedProviders', 'totalUsers', 'totalProducts', 'totalOrders', 'allProducts'));
    }

    public function approveProvider($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $provider = User::findOrFail($id);
        if ($provider->role !== 'provider') {
            return back()->with('error', 'User is not a provider.');
        }
        
        $provider->update(['status' => 'approved']);
        return back()->with('success', 'Provider approved successfully.');
    }

    public function rejectProvider($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $provider = User::findOrFail($id);
        if ($provider->role !== 'provider') {
            return back()->with('error', 'User is not a provider.');
        }

        // Delete the provider and their products (cascade set in migration)
        $provider->delete();
        
        return back()->with('success', 'Provider rejected and deleted.');
    }

    public function toggleSundaySale($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $product = Product::findOrFail($id);
        $product->update([
            'is_on_sunday_sale' => !$product->is_on_sunday_sale
        ]);

        return back()->with('success', 'Sunday Sale status updated for ' . $product->name);
    }
}
