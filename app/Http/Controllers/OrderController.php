<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('checkout', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|string',
            // Add payment method validation if form has it, otherwise default
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty!');
        }

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // Create Order
        $order = \App\Models\Order::create([
            'user_id' => auth()->id() ?? 1, // Fallback to 1 or handle guest checkout if needed
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'shipping_address' => $request->address . ', ' . $request->city,
            'payment_method' => $request->payment_method ?? 'COD',
            'payment_status' => 'pending',
        ]);

        // Create Order Items
        foreach ($cart as $id => $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id, // Cart key is product ID
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'size' => $item['size'] ?? null,   // Assuming cart stores size
                'color' => $item['color'] ?? null, // Assuming cart stores color
            ]);
            
            // Optional: Decrement stock
            $product = \App\Models\Product::find($id);
            if ($product) {
                $product->decrement('stock', $item['quantity']);
            }
        }

        // Clear the cart
        session()->forget('cart');
        
        return redirect()->route('customer.dashboard')->with('success', 'Order placed successfully! Track your order here.');
    }
}
