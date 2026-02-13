@extends('layouts.app')
@section('title', 'Shipping Information')

@section('styles')
<style>
    .info-container {
        max-width: 800px;
        margin: 4rem auto;
        line-height: 1.8;
    }
    .info-header {
        text-align: center;
        margin-bottom: 4rem;
    }
    .info-header h1 {
        font-size: 3rem;
        font-weight: 900;
        margin-bottom: 1rem;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .info-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2.5rem;
        margin-bottom: 2rem;
        transition: transform 0.3s;
    }
    .info-card:hover {
        transform: translateY(-5px);
        border-color: var(--primary-light);
    }
    .info-card h2 {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 1.5rem;
        color: var(--primary-light);
    }
    .info-card i {
        font-size: 1.5rem;
    }
    .shipping-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-top: 1.5rem;
    }
    .shipping-method {
        background: var(--bg);
        padding: 1.5rem;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border);
    }
    .shipping-method h4 {
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }
    .shipping-method p {
        font-size: 0.9rem;
        color: var(--text-muted);
    }
</style>
@endsection

@section('content')
<main class="info-container">
    <div class="info-header animate">
        <h1>Global Shipping</h1>
        <p>Premium logistics for a premium lifestyle. We deliver excellence to your doorstep.</p>
    </div>

    <div class="info-card animate animate-delay-1">
        <h2><i class="fas fa-truck-fast"></i> Delivery Methods</h2>
        <p>At NOBLER, we partner with the world's most reliable couriers including DHL, FedEx, and UPS to ensure your premium items arrive safely and on time.</p>
        
        <div class="shipping-grid">
            <div class="shipping-method">
                <h4>Standard Delivery</h4>
                <p>3-5 Business Days</p>
                <p style="color: var(--success); font-weight: 700;">Free over $100</p>
            </div>
            <div class="shipping-method">
                <h4>Express Plus</h4>
                <p>1-2 Business Days</p>
                <p style="color: var(--secondary); font-weight: 700;">$24.99 Flat Rate</p>
            </div>
        </div>
    </div>

    <div class="info-card animate animate-delay-2">
        <h2><i class="fas fa-globe-americas"></i> International Orders</h2>
        <p>We ship to over 50 countries worldwide. International shipping usually takes 7-14 business days depending on customs processing in your region.</p>
        <p style="margin-top: 1rem; color: var(--text-muted); font-style: italic;">Note: Import duties and taxes are calculated at checkout for most regions to provide a seamless experience.</p>
    </div>

    <div class="info-card animate animate-delay-3">
        <h2><i class="fas fa-box"></i> Order Tracking</h2>
        <p>Every order from NOBLER comes with a unique tracking ID. You will receive an automated email as soon as your package leaves the provider's facility.</p>
        <div style="margin-top: 2rem; text-align: center;">
            <a href="/customer/dashboard" class="btn btn-primary">Track My Active Orders</a>
        </div>
    </div>
</main>
@endsection
