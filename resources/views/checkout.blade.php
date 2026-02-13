@extends('layouts.app')
@section('title', 'Checkout')

@section('styles')
<style>
    .checkout-container {
        max-width: 1200px;
        margin: 3rem auto;
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 2.5rem;
    }

    .checkout-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2.5rem;
        height: fit-content;
    }

    .checkout-card h2 {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.4rem;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .form-full { grid-column: span 2; }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        color: var(--text-secondary);
    }

    .summary-total {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px dashed var(--border);
        display: flex;
        justify-content: space-between;
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--text-main);
    }

    .cart-item-preview {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 1.25rem;
    }

    .cart-item-preview img {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        object-fit: cover;
    }

    .cart-item-preview .details { font-size: 0.9rem; }
    .cart-item-preview .name { font-weight: 600; display: block; }
    .cart-item-preview .qty { color: var(--text-muted); }

    @media (max-width: 992px) {
        .checkout-container { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<main class="checkout-container">
    <!-- SHIPPING & BILLING FORM -->
    <div class="checkout-card animate">
        <h2><i class="fas fa-shipping-fast"></i> Shipping Information</h2>
        
        <form action="{{ route('checkout.place') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group form-full">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-input" value="{{ auth()->user()->name ?? '' }}" required placeholder="John Doe">
                </div>
                
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-input" value="{{ auth()->user()->email ?? '' }}" required placeholder="john@example.com">
                </div>
                
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" class="form-input" required placeholder="+1 (555) 000-0000">
                </div>
                
                <div class="form-group form-full">
                    <label>Shipping Address</label>
                    <input type="text" name="address" class="form-input" required placeholder="123 Luxury Lane">
                </div>
                
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-input" required placeholder="Beverly Hills">
                </div>
                
                <div class="form-group">
                    <label>Payment Method</label>
                    <select name="payment_method" class="form-input" style="appearance: auto;">
                        <option value="COD">Cash on Delivery</option>
                        <option value="Stripe" disabled>Credit Card (Stripe) - Coming Soon</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin-top: 2rem;">
                <i class="fas fa-check-circle"></i> Complete Purchase
            </button>
        </form>
    </div>

    <!-- ORDER SUMMARY SIDEBAR -->
    <div class="checkout-card animate animate-delay-1" style="background: rgba(124, 58, 237, 0.03);">
        <h2><i class="fas fa-shopping-bag"></i> Order Summary</h2>
        
        <div style="margin-bottom: 2rem;">
            @foreach($cart as $id => $item)
            <div class="cart-item-preview">
                <img src="{{ $item['image'] ?? 'https://via.placeholder.com/50' }}" alt="">
                <div class="details">
                    <span class="name">{{ $item['name'] }}</span>
                    <span class="qty">Qty: {{ $item['quantity'] }} &times; ${{ number_format($item['price'], 2) }}</span>
                </div>
                <div style="margin-left: auto; font-weight: 600;">
                    ${{ number_format($item['price'] * $item['quantity'], 2) }}
                </div>
            </div>
            @endforeach
        </div>

        <div class="summary-item">
            <span>Subtotal</span>
            <span>${{ number_format($total, 2) }}</span>
        </div>
        <div class="summary-item">
            <span>Shipping</span>
            <span style="color: var(--success);">FREE</span>
        </div>
        <div class="summary-item">
            <span>Tax (GST)</span>
            <span>$0.00</span>
        </div>

        <div class="summary-total">
            <span>Total Payable</span>
            <span style="color: var(--primary-light);">${{ number_format($total, 2) }}</span>
        </div>

        <p style="margin-top: 2rem; font-size: 0.8rem; color: var(--text-muted); text-align: center;">
            <i class="fas fa-shield-alt"></i> Secure transaction powered by NOBLER
        </p>
    </div>
</main>
@endsection
