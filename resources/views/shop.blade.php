@extends('layouts.app')
@section('title', 'Shop Premium Collection')

@section('styles')
<style>
    .shop-layout {
        max-width: 1400px;
        margin: 3rem auto;
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 3rem;
        padding: 0 2rem;
    }

    /* Sidebar Filters */
    .filter-sidebar {
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .filter-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .filter-title {
        font-size: 0.9rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 1.25rem;
        color: var(--primary-light);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .filter-item a {
        color: var(--text-secondary);
        text-decoration: none;
        font-size: 0.95rem;
        transition: color 0.2s;
        display: flex;
        justify-content: space-between;
    }

    .filter-item a:hover, .filter-item.active a {
        color: var(--primary-light);
    }

    /* main grid */
    .shop-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .sort-select {
        background: var(--card-bg);
        border: 1px solid var(--border);
        color: var(--text-main);
        padding: 0.6rem 1rem;
        border-radius: var(--radius-sm);
        outline: none;
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
        transition: transform 0.3s, border-color 0.3s;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-8px);
        border-color: var(--primary-light);
    }

    .product-image {
        aspect-ratio: 4/5;
        overflow: hidden;
        background: #1a1a1a;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .product-card:hover .product-image img {
        transform: scale(1.1);
    }

    .product-details {
        padding: 1.5rem;
    }

    .product-category {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: var(--primary-light);
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: block;
    }

    .product-name {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: var(--text-main);
        display: block;
        text-decoration: none;
    }

    .product-price {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--text-main);
    }

    .pagination-container {
        margin-top: 4rem;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 992px) {
        .shop-layout { grid-template-columns: 1fr; margin: 1rem auto; gap: 1.5rem; }
        .filter-sidebar { 
            position: relative; 
            top: 0; 
            overflow-x: auto; 
            display: flex; 
            gap: 0.75rem; 
            padding-bottom: 0.5rem;
            scrollbar-width: none;
            margin-bottom: 0;
        }
        .filter-sidebar::-webkit-scrollbar { display: none; }
        
        .filter-card { 
            background: transparent; 
            border: none; 
            padding: 0; 
            margin: 0; 
            flex-shrink: 0;
        }

        .filter-title { display: none; }
        
        .filter-list { 
            flex-direction: row; 
            gap: 0.5rem; 
        }

        .filter-item {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 50px;
            padding: 0.5rem 1.25rem;
            white-space: nowrap;
        }

        .filter-item a { font-size: 0.85rem; }
        .filter-item.active { border-color: var(--primary); background: rgba(124, 58, 237, 0.1); }
        .filter-item.active a { color: var(--primary-light); font-weight: 700; }

        .shop-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .shop-header h1 { font-size: 1.8rem; }
        .product-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 1rem; }
        .product-details { padding: 1rem; }
        .product-name { font-size: 0.9rem; }
    }
</style>
@endsection

@section('content')
<main class="shop-layout">
    <!-- Filters Sidebar -->
    <aside class="filter-sidebar">
        <div class="filter-card">
            <h3 class="filter-title"><i class="fas fa-th-large"></i> Categories</h3>
            <ul class="filter-list">
                <li class="filter-item {{ !request('category') ? 'active' : '' }}">
                    <a href="{{ route('shop', array_merge(request()->except('category', 'page'))) }}">All Drops</a>
                </li>
                @foreach($categories as $cat)
                <li class="filter-item {{ request('category') == $cat->slug ? 'active' : '' }}">
                    <a href="{{ route('shop', array_merge(request()->except('page'), ['category' => $cat->slug])) }}">
                        {{ $cat->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </aside>

    <!-- Product Feed -->
    <section>
        <div class="shop-header animate">
            <div>
                <h1 style="font-size: 2.5rem; font-weight: 900; margin-bottom: 0.5rem;">The Gallery</h1>
                <p style="color: var(--text-muted);">Explore our latest drops and exclusive collaborations.</p>
            </div>
            
            <form action="{{ route('shop') }}" method="GET" id="sort-form">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <select name="sort" class="sort-select" onchange="this.form.submit()">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Top Rated</option>
                </select>
            </form>
        </div>

        <div class="product-grid">
            @forelse($products as $product)
            <article class="product-card animate">
                <a href="{{ route('product.show', $product->id) }}" class="product-image">
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/400x500' }}" alt="{{ $product->name }}">
                </a>
                <div class="product-details">
                    <span class="product-category">{{ $product->category->name ?? 'Collection' }}</span>
                    <a href="{{ route('product.show', $product->id) }}" class="product-name">{{ $product->name }}</a>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="product-price">${{ number_format($product->price, 2) }}</span>
                        <div style="color: #ffb800; font-size: 0.8rem;">
                            <i class="fas fa-star"></i> {{ number_format($product->rating, 1) }}
                        </div>
                    </div>
                </div>
            </article>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 5rem;">
                <i class="fas fa-search" style="font-size: 4rem; color: var(--border); margin-bottom: 2rem;"></i>
                <h2>No products found</h2>
                <p style="color: var(--text-muted); margin-top: 1rem;">Try adjusting your filters or category selection.</p>
                <a href="{{ route('shop') }}" class="btn btn-primary" style="margin-top: 2rem;">Show All Products</a>
            </div>
            @endforelse
        </div>

        <div class="pagination-container">
            {{ $products->links() }}
        </div>
    </section>
</main>
@endsection
