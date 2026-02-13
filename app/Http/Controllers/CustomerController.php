<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ensure only customers access this (optional, but good practice)
        // If Admins/Providers want to buy, they can see their own orders too!
        // So no strict role check needed unless we want to separate dashboards purely.
        
        $orders = Order::with('items.product') // Eager load items and products
                       ->where('user_id', $user->id)
                       ->latest()
                       ->get();

        return view('customer.dashboard', compact('orders'));
    }

    public function requestReturn(Request $request, $id)
    {
        $request->validate([
            'return_reason' => 'required|string|max:1000'
        ]);

        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        if ($order->status !== 'delivered') {
            return back()->with('error', 'Only delivered orders can be returned.');
        }

        if ($order->return_status) {
            return back()->with('error', 'A return has already been requested for this order.');
        }

        $order->update([
            'return_status' => 'requested',
            'return_reason' => $request->return_reason
        ]);

        return back()->with('success', 'Return request submitted successfully. We will review it shortly.');
    }
}
