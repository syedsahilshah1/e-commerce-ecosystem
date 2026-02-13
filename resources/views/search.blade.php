@extends('layouts.app')
@section('title', 'Search Results')

@section('styles')
<style>
    .search-container {
        max-width: 1400px;
        margin: 4rem auto;
        padding: 0 2rem;
    }
    .search-meta {
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--border);
    }
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }
    .product-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        transition: transform 0.3s;
    }
    .product-card:hover { border-color: var(--primary-light); transform: translateY(-5px); }
    .product-image { aspect-ratio: 4/5; overflow: hidden; }
    .product-image img { width: 100%; height: 100%; object-fit: cover; }
    .product-details { padding: 1.5rem; }
</style>
@endsection

@section('content')
<main class="search-container">
    <div class="search-meta animate">
        <h1 style="font-size: 2.5rem; font-weight: 900;">Search Results</h1>
        <p style="color: var(--text-muted); margin-top: 0.5rem;">
            Showing results for <span style="color: var(--primary-light); font-weight: 700;">"{{ $searchTerm }}"</span>
            ({{ $products->count() }} items found)
        </p>
    </div>

    @if($products->count() > 0)
    <div class="product-grid">
        @foreach($products as $product)
        <article class="product-card animate">
            <a href="{{ route('product.show', $product->id) }}" class="product-image">
                <img src="{{ $product->image ?? 'https://via.placeholder.com/400x500' }}" alt="">
            </a>
            <div class="product-details">
                <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--primary-light); font-weight: 700; display: block; margin-bottom: 0.5rem;">
                    {{ $product->category->name ?? 'Premium' }}
                </span>
                <a href="{{ route('product.show', $product->id) }}" style="font-size: 1.1rem; font-weight: 600; color: var(--text-main); text-decoration: none; display: block; margin-bottom: 0.5rem;">
                    {{ $product->name }}
                </a>
                <span style="font-size: 1.25rem; font-weight: 800;">${{ number_format($product->price, 2) }}</span>
            </div>
        </article>
        @endforeach
    </div>
    
    <div style="margin-top: 4rem; display: flex; justify-content: center;">
        {{ $products->appends(['q' => $searchTerm])->links() }}
    </div>
    @else
    <div style="text-align: center; padding: 10rem 0;" class="animate">
        <i class="fas fa-search-minus" style="font-size: 5rem; color: var(--border); margin-bottom: 2rem;"></i>
        <h2>No items match your search</h2>
        <p style="color: var(--text-muted); margin-top: 1rem;">Try different keywords or explore our trending collections.</p>
        <div style="margin-top: 3rem; display: flex; justify-content: center; gap: 1rem;">
            <a href="{{ route('shop') }}" class="btn btn-primary">Browse All Product</a>
            <a href="{{ route('home') }}" class="btn btn-outline">Back to Home</a>
        </div>
    </div>
    @endif
</main>
@endsection
