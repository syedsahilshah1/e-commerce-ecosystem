@extends('layouts.app')
@section('title', 'Home')

@section('styles')
<style>
    /* ===== HERO ===== */
    .hero {
        height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background: 
            linear-gradient(135deg, rgba(10, 10, 15, 0.7) 0%, rgba(124, 58, 237, 0.15) 50%, rgba(10, 10, 15, 0.7) 100%),
            url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
        background-size: cover;
        background-position: center;
        border-radius: 24px;
        margin-bottom: 5rem;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 120px;
        background: linear-gradient(to top, var(--bg), transparent);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 700px;
        padding: 0 2rem;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(124, 58, 237, 0.15);
        border: 1px solid rgba(124, 58, 237, 0.3);
        padding: 0.4rem 1.2rem;
        border-radius: 50px;
        font-size: 0.8rem;
        color: var(--primary-light);
        font-weight: 600;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(10px);
    }

    .hero-content h1 {
        font-size: 4rem;
        font-weight: 900;
        margin-bottom: 1.2rem;
        letter-spacing: -2px;
        line-height: 1.1;
        background: linear-gradient(135deg, #fff 30%, var(--primary-light));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-content p {
        font-size: 1.15rem;
        color: var(--text-secondary);
        max-width: 500px;
        margin: 0 auto 2.5rem;
        line-height: 1.7;
    }

    .hero-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* ===== FEATURES BAR ===== */
    .features-bar {
        display: grid;
        grid-template_columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-bottom: 5rem;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.25rem;
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        transition: all 0.3s;
    }

    .feature-item:hover {
        border-color: var(--border-light);
        transform: translateY(-2px);
    }

    .feature-item i {
        font-size: 1.4rem;
        color: var(--primary-light);
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(124, 58, 237, 0.1);
        border-radius: 10px;
        flex-shrink: 0;
    }

    .feature-item h4 {
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.15rem;
    }

    .feature-item p {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    /* ===== CATEGORIES ===== */
    .categories-scroll {
        display: flex;
        gap: 2rem;
        overflow-x: auto;
        padding: 2rem 1rem;
        margin: 0 -1rem 3rem;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .categories-scroll::-webkit-scrollbar { display: none; }

    .category-card {
        min-width: 200px;
        background: var(--card-bg);
        border: 1px solid var(--border);
        padding: 2.5rem 1.5rem;
        border-radius: var(--radius);
        text-align: center;
        text-decoration: none;
        color: var(--text-main);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--gradient-primary);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .category-card:hover {
        border-color: var(--primary);
        transform: translateY(-10px);
        box-shadow: var(--shadow-glow);
    }

    .category-card:hover::before { opacity: 1; }

    .category-icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(124, 58, 237, 0.1);
        border-radius: 18px;
        font-size: 1.6rem;
        color: var(--primary-light);
        transition: all 0.3s;
    }

    .category-card:hover .category-icon {
        background: var(--gradient-primary);
        color: white;
    }

    .category-card span {
        font-weight: 700;
        font-size: 1rem;
        display: block;
    }

    /* ===== PRODUCT GRID ===== */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2.5rem;
        padding: 1.5rem 0.5rem;
        margin: 0 -0.5rem 4rem;
    }

    .product-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-8px);
        border-color: var(--border-light);
        box-shadow: var(--shadow), var(--shadow-glow);
    }

    .product-card .product-image {
        height: 300px;
        background: var(--bg-secondary);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    .product-card .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.08);
    }

    .product-info {
        padding: 1.5rem;
    }

    /* ===== CTA BANNER ===== */
    .cta-banner {
        background: linear-gradient(135deg, var(--primary-dark) 0%, #4338ca 100%);
        border-radius: var(--radius);
        padding: 5rem 3rem;
        text-align: center;
        margin: 6rem 0;
        position: relative;
        overflow: hidden;
    }

    @media (max-width: 1024px) {
        .features-bar { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .hero-content h1 { font-size: 2.8rem; }
        .product-grid { grid-template-columns: 1fr 1fr; gap: 1rem; }
        .features-bar { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="home-wrapper">
    <!-- HERO -->
    <section class="hero animate">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fas fa-sparkles"></i> New Collection 2026
            </div>
            <h1>Elegance Redefined</h1>
            <p>Discover our curated collection of luxury items designed for the modern individual who values quality and style.</p>
            <div class="hero-buttons">
                <a href="/shop" class="btn btn-primary btn-lg">
                    <i class="fas fa-shopping-bag"></i> Shop Now
                </a>
                <a href="/categories" class="btn btn-outline btn-lg">
                    Explore Categories
                </a>
                @auth
                    @if(auth()->user()->isCustomer())
                        <a href="{{ route('customer.dashboard') }}" class="btn btn-outline btn-lg" style="border-width: 2px;">
                            <i class="fas fa-truck-fast"></i> My Orders
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <div class="features-bar animate animate-delay-1">
        <div class="feature-item">
            <i class="fas fa-truck"></i>
            <div>
                <h4>Free Shipping</h4>
                <p>On orders over $50</p>
            </div>
        </div>
        <div class="feature-item">
            <i class="fas fa-shield-halved"></i>
            <div>
                <h4>Secure Payment</h4>
                <p>100% encrypted</p>
            </div>
        </div>
        <div class="feature-item">
            <i class="fas fa-rotate-left"></i>
            <div>
                <h4>Easy Returns</h4>
                <p>30-day return policy</p>
            </div>
        </div>
        <div class="feature-item">
            <i class="fas fa-headset"></i>
            <div>
                <h4>24/7 Support</h4>
                <p>Expert assistance</p>
            </div>
        </div>
    </div>

    <!-- CATEGORIES -->
    <section class="animate animate-delay-2" style="margin-bottom: 5rem;">
        <div class="section-header">
            <h2 class="section-title">Shop by Category</h2>
            <p class="section-subtitle">Browse our handpicked collections</p>
        </div>
        <div class="categories-scroll">
            @foreach($categories as $category)
            <a href="/category/{{ $category->slug }}" class="category-card">
                <div class="category-icon">
                    @if($category->slug == 'electronics')
                        <i class="fas fa-microchip"></i>
                    @elseif($category->slug == 'accessories')
                        <i class="fas fa-gem"></i>
                    @elseif($category->slug == 'clothing')
                        <i class="fas fa-shirt"></i>
                    @else
                        <i class="fas fa-tag"></i>
                    @endif
                </div>
                <span>{{ $category->name }}</span>
                <small style="color: var(--text-muted); font-size: 0.8rem; margin-top: 0.25rem; display: block;">{{ $category->products_count }} products</small>
            </a>
            @endforeach
        </div>
    </section>

    <!-- FEATURED PRODUCTS -->
    <section class="animate animate-delay-3" style="margin-bottom: 5rem;">
        <div class="section-header">
            <h2 class="section-title">Featured Products</h2>
            <p class="section-subtitle">Trending items hand-picked for you</p>
        </div>
        <div class="product-grid">
            @foreach($products as $product)
            <div class="product-card">
                <div class="product-image">
                    @if($product->old_price && $product->old_price > $product->price)
                        <span class="product-badge">
                            -{{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}%
                        </span>
                    @endif
                    @if($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}">
                    @else
                        <i class="fas fa-image placeholder-icon" style="font-size: 3rem; color: var(--text-muted);"></i>
                    @endif
                </div>
                <div class="product-info">
                    <span class="product-category" style="font-size: 0.75rem; color: var(--primary-light); font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.4rem; display: block;">{{ $product->category->name }}</span>
                    <h3 class="product-name" style="font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem; line-height: 1.4;">
                        <a href="/product/{{ $product->id }}" style="text-decoration: none; color: inherit;">{{ $product->name }}</a>
                    </h3>
                    <div class="product-rating" style="display: flex; align-items: center; gap: 0.4rem; margin-bottom: 0.75rem; font-size: 0.8rem;">
                        <span class="stars" style="color: var(--warning);">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($product->rating))
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </span>
                        <span class="count" style="color: var(--text-muted);">({{ $product->reviews_count }})</span>
                    </div>
                    <div class="product-price-row" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                        <span class="current-price" style="font-size: 1.25rem; font-weight: 700;">${{ number_format($product->price, 2) }}</span>
                        @if($product->old_price)
                            <span class="old-price" style="font-size: 0.9rem; text-decoration: line-through; color: var(--text-muted);">${{ number_format($product->old_price, 2) }}</span>
                        @endif
                    </div>
                    <div class="card-actions" style="display: flex; gap: 0.5rem;">
                        <form action="/cart/add" method="POST" style="flex: 1;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-primary btn-sm" style="width: 100%;">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </form>
                        <a href="/product/{{ $product->id }}" class="btn btn-outline btn-sm" title="View" style="width: 42px; padding: 0;">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align: center;">
            <a href="/shop" class="btn btn-outline btn-lg">
                View All Products <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>

    <!-- MISSION & VISION -->
    <section class="animate animate-delay-3" style="margin-bottom: 5rem;">
        <div class="mission-vision-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            <div class="mv-card" style="background: var(--card-bg); padding: 3rem; border-radius: var(--radius); border: 1px solid var(--border); text-align: center; position: relative; overflow: hidden;">
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: var(--gradient-primary);"></div>
                <div class="icon-circle" style="width: 80px; height: 80px; background: rgba(124, 58, 237, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 2rem; color: var(--primary-light);">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 style="font-size: 1.8rem; margin-bottom: 1rem;">Our Mission</h3>
                <p style="color: var(--text-secondary); line-height: 1.8;">To empower individuals through fashion and technology, providing accessible luxury that inspires confidence and creativity in every aspect of life.</p>
            </div>
            <div class="mv-card" style="background: var(--card-bg); padding: 3rem; border-radius: var(--radius); border: 1px solid var(--border); text-align: center; position: relative; overflow: hidden;">
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: var(--secondary);"></div>
                <div class="icon-circle" style="width: 80px; height: 80px; background: rgba(244, 63, 94, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 2rem; color: var(--secondary);">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 style="font-size: 1.8rem; margin-bottom: 1rem;">Our Vision</h3>
                <p style="color: var(--text-secondary); line-height: 1.8;">To become the global standard for ethical luxury, where innovation meets tradition, creating a sustainable future for style enthusiasts worldwide.</p>
            </div>
        </div>
    </section>

    <!-- FLASH SALES & SUNDAY OFFER -->
    <section class="animate" style="margin-bottom: 5rem;">
        <div style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%); padding: 3rem; border-radius: var(--radius); border: 1px solid rgba(124, 58, 237, 0.3); display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 2rem;">
            <div style="flex: 1; min-width: 300px;">
                <div style="display: inline-flex; align-items: center; gap: 10px; background: rgba(244, 63, 94, 0.2); color: #fb7185; padding: 0.5rem 1rem; border-radius: 50px; font-weight: 700; font-size: 0.8rem; margin-bottom: 1rem; text-transform: uppercase; letter-spacing: 1px;">
                    <i class="fas fa-bolt"></i> Flash Sale Ending Soon
                </div>
                <h2 style="font-size: 3rem; font-weight: 900; margin-bottom: 1rem; line-height: 1.1;">Exclusive <span style="color: var(--secondary);">Sunday</span> Offer</h2>
                <p style="color: rgba(255,255,255,0.7); max-width: 500px; line-height: 1.8; margin-bottom: 2rem;">Every Sunday we unlock ultra-premium products at wholesale prices. Don't miss this window to upgrade your lifestyle for less.</p>
                
                <div id="countdown" style="display: flex; gap: 1rem; margin-bottom: 2rem;">
                    <div style="text-align: center;">
                        <span id="hours" style="display: block; font-size: 2.22rem; font-weight: 800; background: rgba(255,255,255,0.1); width: 65px; height: 65px; border-radius: 12px; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255,255,255,0.1);">00</span>
                        <small style="font-size: 0.7rem; color: rgba(255,255,255,0.5); text-transform: uppercase; margin-top: 5px; display: block;">Hrs</small>
                    </div>
                    <div style="text-align: center;">
                        <span id="minutes" style="display: block; font-size: 2.22rem; font-weight: 800; background: rgba(255,255,255,0.1); width: 65px; height: 65px; border-radius: 12px; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255,255,255,0.1);">00</span>
                        <small style="font-size: 0.7rem; color: rgba(255,255,255,0.5); text-transform: uppercase; margin-top: 5px; display: block;">Min</small>
                    </div>
                    <div style="text-align: center;">
                        <span id="seconds" style="display: block; font-size: 2.22rem; font-weight: 800; background: rgba(255,255,255,0.1); width: 65px; height: 65px; border-radius: 12px; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255,255,255,0.1);">00</span>
                        <small style="font-size: 0.7rem; color: rgba(255,255,255,0.5); text-transform: uppercase; margin-top: 5px; display: block;">Sec</small>
                    </div>
                </div>

                <a href="/shop" class="btn btn-primary btn-lg" style="box-shadow: 0 10px 20px rgba(124, 58, 237, 0.3);">Access Deals Now</a>
            </div>
            
            <div style="flex: 1; min-width: 300px; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                @foreach($sundaySaleProducts as $product)
                <div class="sale-item" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 10px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <img src="{{ $product->image }}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; margin-bottom: 0.8rem;">
                    <div style="color: white; font-weight: 700; font-size: 0.85rem; margin-bottom: 0.3rem;">{{ $product->name }}</div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="color: var(--secondary); font-weight: 800; font-size: 1rem;">${{ number_format($product->price, 2) }}</span>
                        @if($product->old_price)
                            <span style="color: rgba(255,255,255,0.4); text-decoration: line-through; font-size: 0.75rem;">${{ number_format($product->old_price, 2) }}</span>
                        @endif
                    </div>
                </div>
                @endforeach
                
                @if($sundaySaleProducts->count() == 0)
                <div style="grid-column: span 2; position: relative; width: 100%; max-width: 400px; height: 350px; background: rgba(124, 58, 237, 0.1); border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-gift" style="font-size: 8rem; color: var(--primary-light); opacity: 0.4;"></i>
                    <div style="position: absolute; bottom: 40px; left: 40px; background: white; color: black; padding: 1rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                        <h4 style="margin: 0;">Up to 70% Off</h4>
                        <p style="margin: 0; font-size: 0.8rem; color: #666;">Stay Tuned for Sunday Deals</p>
                    </div>
                 </div>
                @endif
            </div>
        </div>
    </section>

    <script>
        function updateCountdown() {
            const now = new Date();
            const target = new Date();
            target.setDate(now.getDate() + (7 - now.getDay()) % 7);
            target.setHours(23, 59, 59, 0);
            
            const diff = target - now;
            const h = Math.floor(diff / (1000 * 60 * 60));
            const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const s = Math.floor((diff % (1000 * 60)) / 1000);
            
            if(document.getElementById('hours')) {
                document.getElementById('hours').innerText = h < 10 ? '0' + h : h;
                document.getElementById('minutes').innerText = m < 10 ? '0' + m : m;
                document.getElementById('seconds').innerText = s < 10 ? '0' + s : s;
            }
        }
        setInterval(updateCountdown, 1000);
        updateCountdown();
    </script>

    <!-- CTA BANNER -->
    @guest
    <section class="cta-banner">
        <h2>Join the NOBLER Family</h2>
        <p>Get exclusive deals, early access to new arrivals, and insider styling tips.</p>
        <a href="/register" class="btn btn-lg" style="background: white; color: var(--primary-dark); font-weight: 700;">
            Create Account <i class="fas fa-arrow-right"></i>
        </a>
    </section>
    @endguest
</div>
@endsection
