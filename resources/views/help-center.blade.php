@extends('layouts.app')
@section('title', 'Help Center')

@section('styles')
<style>
    .help-container {
        max-width: 1000px;
        margin: 4rem auto;
    }
    .help-header {
        text-align: center;
        margin-bottom: 5rem;
    }
    .help-header h1 {
        font-size: 3.5rem;
        font-weight: 900;
        margin-bottom: 1.5rem;
    }
    .search-hero {
        max-width: 600px;
        margin: 0 auto;
        position: relative;
    }
    .search-hero input {
        width: 100%;
        padding: 1.5rem 2rem 1.5rem 3.5rem;
        background: var(--card-bg);
        border: 2px solid var(--border);
        border-radius: 50px;
        color: var(--text-main);
        font-size: 1.1rem;
        outline: none;
        transition: all 0.3s;
    }
    .search-hero input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 30px rgba(124, 58, 237, 0.2);
    }
    .search-hero i {
        position: absolute;
        left: 1.5rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 1.2rem;
    }
    .faq-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 4rem;
    }
    .faq-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2rem;
        transition: all 0.3s;
    }
    .faq-card:hover {
        border-color: var(--primary-light);
        background: var(--card-bg-hover);
    }
    .faq-card i {
        font-size: 2rem;
        color: var(--primary);
        margin-bottom: 1.5rem;
        display: block;
    }
    .faq-card h3 {
        margin-bottom: 1rem;
        font-size: 1.25rem;
    }
    .faq-card p {
        color: var(--text-muted);
        font-size: 0.95rem;
        line-height: 1.6;
    }
    .contact-banner {
        background: var(--gradient-primary);
        border-radius: var(--radius);
        padding: 3rem;
        margin-top: 5rem;
        text-align: center;
        color: white;
    }
    .contact-banner h2 { margin-bottom: 1rem; font-size: 2rem; }
</style>
@endsection

@section('content')
<main class="help-container">
    <div class="help-header animate">
        <h1>How can we help you?</h1>
        <div class="search-hero">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search for articles, orders, or policies...">
        </div>
    </div>

    <div class="faq-grid">
        <div class="faq-card animate animate-delay-1">
            <i class="fas fa-shopping-basket"></i>
            <h3>Ordering & Payments</h3>
            <p>Learn about payment methods, promotional codes, and how to track your order lifecycle.</p>
        </div>
        <div class="faq-card animate animate-delay-1">
            <i class="fas fa-undo-alt"></i>
            <h3>Returns & Refunds</h3>
            <p>Our 30-day premium return policy ensures you only keep what you truly love.</p>
        </div>
        <div class="faq-card animate animate-delay-2">
            <i class="fas fa-user-shield"></i>
            <h3>Account Security</h3>
            <p>Managing your profile, password security, and provider status verifications.</p>
        </div>
        <div class="faq-card animate animate-delay-2">
            <i class="fas fa-store"></i>
            <h3>Selling on NOBLER</h3>
            <p>Information for providers on listing products, managing orders, and payout schedules.</p>
        </div>
    </div>

    <div class="contact-banner animate animate-delay-3">
        <h2>Still need assistance?</h2>
        <p style="margin-bottom: 2rem; opacity: 0.9;">Our premium support team is available 24/7 to solve your queries.</p>
        <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
            <a href="mailto:support@nobler.com" class="btn" style="background: white; color: var(--primary);">Email Support</a>
            <button class="btn btn-outline" style="border-color: white; color: white;" onclick="document.getElementById('chatbot-toggle').click()">Live Chat Now</button>
        </div>
    </div>
</main>
@endsection
