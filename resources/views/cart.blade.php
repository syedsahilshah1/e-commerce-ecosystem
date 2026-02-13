@extends('layouts.app')
@section('title', 'Shopping Cart')

@section('styles')
<style>
    .cart-container {
        max-width: 1200px;
        margin: 3rem auto;
    }

    .cart-table {
        width: 100%;
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        border-collapse: collapse;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .cart-table th, .cart-table td {
        padding: 1.5rem;
        text-align: left;
        border-bottom: 1px solid var(--border);
    }

    .cart-table th {
        background: rgba(255, 255, 255, 0.02);
        color: var(--text-muted);
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
    }

    .cart-item-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .cart-item-info img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 12px;
    }

    .qty-input {
        background: var(--bg);
        border: 1px solid var(--border);
        color: var(--text-main);
        padding: 0.5rem;
        border-radius: 6px;
        width: 60px;
        text-align: center;
    }

    .cart-summary {
        display: flex;
        justify-content: flex-end;
        margin-top: 2rem;
    }

    .summary-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2rem;
        width: 350px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    .remove-btn {
        background: none;
        border: none;
        color: var(--secondary);
        cursor: pointer;
        font-size: 0.9rem;
        transition: opacity 0.2s;
    }

    .remove-btn:hover { opacity: 0.7; }
</style>
@endsection

@section('content')
<main class="cart-container">
    <h1 style="margin-bottom: 2rem; font-weight: 800;">Your Shopping Bag</h1>

    @if(count($cart) > 0)
        <table class="cart-table animate">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                <tr>
                    <td>
                        <div class="cart-item-info">
                            <img src="{{ $item['image'] ?? 'https://via.placeholder.com/80' }}" alt="">
                            <div>
                                <h3 style="font-size: 1.1rem; margin-bottom: 4px;">{{ $item['name'] }}</h3>
                                <p style="color: var(--text-muted); font-size: 0.85rem;">Premium Selection</p>
                            </div>
                        </div>
                    </td>
                    <td>${{ number_format($item['price'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.update') }}" method="POST" style="display: flex; gap: 10px;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $id }}">
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="qty-input">
                            <button type="submit" class="btn btn-ghost btn-sm">Update</button>
                        </form>
                    </td>
                    <td style="font-weight: 700;">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $id }}">
                            <button type="submit" class="remove-btn"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="cart-summary animate animate-delay-1">
            <div class="summary-card">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div class="summary-row" style="color: var(--text-muted); font-size: 0.9rem;">
                    <span>Shipping</span>
                    <span>Calculated at checkout</span>
                </div>
                <div class="summary-row" style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border); font-weight: 800; font-size: 1.4rem;">
                    <span>Total</span>
                    <span style="color: var(--primary-light);">${{ number_format($total, 2) }}</span>
                </div>
                
                <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg" style="width: 100%; margin-top: 1.5rem;">
                    Proceed to Checkout <i class="fas fa-arrow-right"></i>
                </a>
                <a href="{{ route('shop') }}" style="display: block; text-align: center; margin-top: 1rem; color: var(--text-muted); font-size: 0.9rem; text-decoration: none;">
                    Continue Shopping
                </a>
            </div>
        </div>
    @else
        <div style="text-align: center; padding: 6rem 0;" class="animate">
            <i class="fas fa-shopping-bag" style="font-size: 5rem; color: var(--border); margin-bottom: 2rem;"></i>
            <h2>Your cart is currently empty.</h2>
            <p style="color: var(--text-muted); margin-top: 1rem;">Discover our latest premium arrivals.</p>
            <a href="{{ route('shop') }}" class="btn btn-primary" style="margin-top: 2rem;">Explore Shop</a>
        </div>
    @endif
</main>
@endsection
