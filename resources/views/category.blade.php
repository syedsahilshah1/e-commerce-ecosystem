@extends('layouts.app')
@section('title', $category->name)

@section('styles')
<style>
    .category-hero {
        background: linear-gradient(135deg, rgba(124, 58, 237, 0.15), rgba(10, 10, 15, 0.95));
        border-radius: var(--radius);
        padding: 3rem;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }

    .category-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: rgba(124, 58, 237, 0.08);
        border-radius: 50%;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
        font-size: 0.85rem;
    }

    .breadcrumb a {
        color: var(--text-muted);
        text-decoration: none;
        transition: color 0.2s;
    }

    .breadcrumb a:hover { color: var(--primary-light); }

    .breadcrumb .separator { color: var(--text-muted); }

    .breadcrumb .current { color: var(--text-secondary); }

    .category-hero h1 {
        font-size: 2.5rem;
        font-weight: 800;
        letter-spacing: -1px;
        position: relative;
    }

    .category-hero p {
        color: var(--text-muted);
        margin-top: 0.5rem;
        font-size: 1rem;
    }

    .category-layout {
        display: grid;
        grid-template-columns: 240px 1fr;
        gap: 2rem;
    }

    .category-sidebar {
        position: sticky;
        top: 90px;
        height: fit-content;
    }

    .sidebar-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.25rem;
        margin-bottom: 1.25rem;
    }

    .sidebar-card h3 {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--border);
    }

    .sidebar-link {
        display: block;
        padding: 0.55rem 0.75rem;
        border-radius: var(--radius-xs);
        color: var(--text-secondary);
        text-decoration: none;
        font-size: 0.88rem;
        transition: all 0.2s;
        margin-bottom: 0.15rem;
    }

    .sidebar-link:hover, .sidebar-link.active {
        background: rgba(124, 58, 237, 0.1);
        color: var(--primary-light);
    }

    .sidebar-link.active { font-weight: 600; }

    .sub-link {
        padding-left: 1.5rem;
        font-size: 0.82rem;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
    }

    @media (max-width: 768px) {
        .category-layout { grid-template-columns: 1fr; }
        .category-sidebar { position: static; }
        .category-hero h1 { font-size: 1.8rem; }
    }
</style>
@endsection

@section('content')
<main>
    <div class="category-hero animate">
        <div class="breadcrumb">
            <a href="/">Home</a>
            <span class="separator"><i class="fas fa-chevron-right" style="font-size: 0.6rem;"></i></span>
            <a href="/categories">Categories</a>
            <span class="separator"><i class="fas fa-chevron-right" style="font-size: 0.6rem;"></i></span>
            <span class="current">{{ $category->name }}</span>
        </div>
        <h1>{{ $category->name }}</h1>
        <p>{{ $products->total() }} products in this collection</p>
    </div>

    <div class="category-layout">
        <!-- SIDEBAR -->
        <aside class="category-sidebar animate">
            <div class="sidebar-card">
                <h3>Categories</h3>
                @foreach($allCategories as $cat)
                    <a href="/category/{{ $cat->slug }}" 
                       class="sidebar-link {{ $category->slug == $cat->slug ? 'active' : '' }}">
                        {{ $cat->name }}
                    </a>
                    @if($cat->children->count() > 0)
                        @foreach($cat->children as $child)
                            <a href="/category/{{ $child->slug }}" 
                               class="sidebar-link sub-link {{ $category->slug == $child->slug ? 'active' : '' }}">
                                {{ $child->name }}
                            </a>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </aside>

        <!-- PRODUCTS -->
        <div>
            @if($products->count() > 0)
            <div class="product-grid animate animate-delay-1">
                @foreach($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        @if($product->old_price && $product->old_price > $product->price)
                            <span class="product-badge">Sale</span>
                        @endif
                        @if($product->image)
                            <img src="{{ $product->image }}" alt="{{ $product->name }}">
                        @else
                            <i class="fas fa-image placeholder-icon"></i>
                        @endif
                    </div>
                    <div class="product-info">
                        <span class="product-category">{{ $product->category->name ?? $category->name }}</span>
                        <h3 class="product-name">
                            <a href="/product/{{ $product->id }}">{{ $product->name }}</a>
                        </h3>
                        <div class="product-rating">
                            <span class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($product->rating))
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </span>
                            <span class="count">({{ $product->reviews_count }})</span>
                        </div>
                        <div class="product-price-row">
                            <span class="current-price">${{ number_format($product->price, 2) }}</span>
                            @if($product->old_price)
                                <span class="old-price">${{ number_format($product->old_price, 2) }}</span>
                            @endif
                        </div>
                        <div class="card-actions">
                            <form action="/cart/add" method="POST" style="flex: 1;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-primary btn-sm" style="width: 100%;">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="pagination-wrapper">
                {{ $products->links() }}
            </div>
            @else
            <div style="text-align: center; padding: 5rem 0;">
                <i class="fas fa-box-open" style="font-size: 3rem; color: var(--border); margin-bottom: 1.5rem;"></i>
                <h2>No products yet</h2>
                <p style="color: var(--text-muted); margin-top: 0.5rem;">This category is coming soon.</p>
                <a href="/shop" class="btn btn-primary" style="margin-top: 1.5rem;">Browse All Products</a>
            </div>
            @endif
        </div>
    </div>
</main>
@endsection
