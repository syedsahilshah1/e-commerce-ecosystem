@extends('layouts.app')
@section('title', $product->name)

@section('styles')
<style>
    .product-detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        margin-top: 1rem;
    }

    .detail-image-container {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 500px;
        position: relative;
    }

    .detail-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: var(--radius);
    }

    .detail-image-container .placeholder {
        font-size: 5rem;
        color: var(--text-muted);
    }

    .detail-image-container .sale-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: var(--secondary);
        color: white;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
    }

    /* Detail Info */
    .detail-info .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.82rem;
        margin-bottom: 1rem;
    }

    .detail-info .breadcrumb a {
        color: var(--text-muted);
        text-decoration: none;
    }

    .detail-info .breadcrumb a:hover { color: var(--primary-light); }

    .detail-info .breadcrumb .sep {
        color: var(--text-muted);
        font-size: 0.6rem;
    }

    .detail-category-tag {
        display: inline-block;
        padding: 0.3rem 0.9rem;
        background: rgba(124, 58, 237, 0.1);
        border: 1px solid rgba(124, 58, 237, 0.2);
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--primary-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
    }

    .detail-info h1 {
        font-size: 2.2rem;
        font-weight: 800;
        letter-spacing: -1px;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .detail-rating {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .detail-rating .stars { color: var(--warning); }
    .detail-rating .reviews { color: var(--text-muted); }

    .detail-price-block {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        padding: 1.25rem;
        background: var(--card-bg);
        border-radius: var(--radius-sm);
        border: 1px solid var(--border);
    }

    .detail-current-price {
        font-size: 2.2rem;
        font-weight: 800;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .detail-old-price {
        font-size: 1.2rem;
        text-decoration: line-through;
        color: var(--text-muted);
    }

    .detail-savings {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
        font-size: 0.8rem;
        font-weight: 700;
        padding: 0.3rem 0.8rem;
        border-radius: 50px;
    }

    .detail-description {
        color: var(--text-secondary);
        font-size: 1rem;
        line-height: 1.8;
        margin-bottom: 2rem;
    }

    /* Size Selector */
    .option-label {
        font-weight: 600;
        font-size: 0.88rem;
        margin-bottom: 0.75rem;
        display: block;
        color: var(--text-secondary);
    }

    .size-options {
        display: flex;
        gap: 0.6rem;
        margin-bottom: 1.5rem;
    }

    .size-chip {
        padding: 0.5rem 1.25rem;
        border: 1px solid var(--border);
        border-radius: var(--radius-xs);
        cursor: pointer;
        transition: all 0.2s;
        background: transparent;
        color: var(--text-main);
        font-family: 'Inter', sans-serif;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .size-chip:hover, .size-chip.active {
        border-color: var(--primary);
        color: var(--primary-light);
        background: rgba(124, 58, 237, 0.1);
    }

    /* Quantity */
    .quantity-control {
        display: flex;
        align-items: center;
        gap: 0;
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius-xs);
        width: fit-content;
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .qty-btn {
        width: 42px;
        height: 42px;
        border: none;
        background: transparent;
        color: var(--text-main);
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qty-btn:hover { background: rgba(124, 58, 237, 0.1); }

    #qty-display {
        width: 50px;
        text-align: center;
        font-weight: 600;
        font-size: 1rem;
        border-left: 1px solid var(--border);
        border-right: 1px solid var(--border);
        padding: 0.5rem;
    }

    /* Actions */
    .detail-actions {
        display: flex;
        gap: 0.75rem;
    }

    .detail-actions .btn { padding: 1rem 2rem; }

    .stock-info {
        margin-top: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
    }

    .stock-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--success);
        display: inline-block;
    }

    /* Related */
    .related-section {
        margin-top: 6rem;
    }

    @media (max-width: 768px) {
        .product-detail-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        .detail-info h1 { font-size: 1.6rem; }
        .detail-current-price { font-size: 1.8rem; }
    }
</style>
@endsection

@section('content')
<main>
    <div class="product-detail-grid animate">
        <!-- IMAGE -->
        <div class="detail-image-container">
            @if($product->old_price && $product->old_price > $product->price)
                <span class="sale-badge">
                    -{{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}% OFF
                </span>
            @endif
            @if($product->image)
                <img id="main-product-image" src="{{ $product->image }}" alt="{{ $product->name }}" style="width: 100%; height: auto; object-fit: cover; border-radius: var(--radius);">
            @else
                <i class="fas fa-image placeholder"></i>
            @endif

            @if($product->gallery && $product->gallery->count() > 0)
            <div class="gallery-thumbs" style="display: flex; gap: 10px; margin-top: 1rem; overflow-x: auto; padding-bottom: 5px;">
                <img src="{{ $product->image }}" 
                     class="thumb active" 
                     style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px; cursor: pointer; border: 2px solid var(--primary);" 
                     onclick="switchImage(this, '{{ $product->image }}')">
                @foreach($product->gallery as $item)
                <img src="{{ $item->image_url }}" 
                     class="thumb" 
                     style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px; cursor: pointer; border: 2px solid transparent;" 
                     onclick="switchImage(this, '{{ $item->image_url }}')">
                @endforeach
            </div>
            @endif
        </div>

        <!-- INFO -->
        <div class="detail-info">
            <div class="breadcrumb">
                <a href="/">Home</a>
                <i class="fas fa-chevron-right sep"></i>
                <a href="/category/{{ $product->category->slug }}">{{ $product->category->name }}</a>
                <i class="fas fa-chevron-right sep"></i>
                <span style="color: var(--text-secondary);">{{ $product->name }}</span>
            </div>

            <span class="detail-category-tag">{{ $product->category->name }}</span>
            <h1>{{ $product->name }}</h1>

            <div class="detail-rating">
                <span class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= round($product->rating))
                            <i class="fas fa-star"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </span>
                <span class="reviews">{{ $product->rating }} ({{ $product->reviews_count }} reviews)</span>
            </div>

            <div class="detail-price-block">
                <span class="detail-current-price">${{ number_format($product->price, 2) }}</span>
                @if($product->old_price)
                    <span class="detail-old-price">${{ number_format($product->old_price, 2) }}</span>
                    <span class="detail-savings">
                        Save ${{ number_format($product->old_price - $product->price, 2) }}
                    </span>
                @endif
            </div>

            <p class="detail-description">{{ $product->description }}</p>

            <span class="option-label">Select Size</span>
            <div class="size-options">
                <button class="size-chip active" onclick="selectSize(this)">S</button>
                <button class="size-chip" onclick="selectSize(this)">M</button>
                <button class="size-chip" onclick="selectSize(this)">L</button>
                <button class="size-chip" onclick="selectSize(this)">XL</button>
            </div>

            @if($product->colors && count($product->colors) > 0)
            <span class="option-label">Select Color</span>
            <div class="color-options" style="display: flex; gap: 0.8rem; margin-bottom: 2rem;">
                @foreach($product->colors as $index => $color)
                <button class="color-chip {{ $index === 0 ? 'active' : '' }}" 
                        style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid {{ $index === 0 ? 'var(--primary)' : 'var(--border)' }}; background: {{ $color }}; cursor: pointer; transition: all 0.2s;" 
                        onclick="selectColor(this, '{{ $color }}')"></button>
                @endforeach
            </div>
            @endif

            <span class="option-label">Quantity</span>
            <div class="quantity-control">
                <button class="qty-btn" onclick="changeQty(-1)">−</button>
                <span id="qty-display">1</span>
                <button class="qty-btn" onclick="changeQty(1)">+</button>
            </div>

            <div class="detail-actions" style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 0.8rem;">
                <form action="/cart/add" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" id="qty-input" value="1">
                    <button type="submit" class="btn btn-outline btn-lg" style="width: 100%; font-size: 0.9rem;">
                        Add To Cart
                    </button>
                </form>
                
                <form action="/cart/add" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" id="qty-input-buy" value="1">
                    <input type="hidden" name="checkout" value="1">
                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; font-size: 0.9rem; background: #84cc16; color: #fff;">
                        Buy Now
                    </button>
                </form>

                <button class="btn btn-outline btn-lg" style="width: 55px; padding: 0;">
                    <i class="far fa-heart"></i>
                </button>
            </div>

            <div class="stock-info">
                @if($product->stock > 0)
                    <span class="stock-dot"></span>
                    <span style="color: var(--success);">In Stock</span>
                    <span style="color: var(--text-muted);">({{ $product->stock }} available)</span>
                @else
                    <span class="stock-dot" style="background: var(--secondary);"></span>
                    <span style="color: var(--secondary);">Out of Stock</span>
                @endif
            </div>
        </div>
    </div>

    <!-- REVIEWS SECTION -->
    <section class="animate animate-delay-1" style="margin-top: 4rem; padding-top: 3rem; border-top: 1px solid var(--border);">
        <div class="section-header" style="text-align: left; margin-bottom: 2rem;">
            <h2 style="font-size: 2rem; font-weight: 800;">Customer Reviews</h2>
            <div style="display: flex; align-items: center; gap: 1rem; margin-top: 0.5rem;">
                <span class="stars" style="color: var(--warning); font-size: 1.2rem;">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="{{ $i <= round($product->rating) ? 'fas' : 'far' }} fa-star"></i>
                    @endfor
                </span>
                <span style="color: var(--text-secondary); font-weight: 600;">{{ $product->rating }} out of 5</span>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 4rem;">
            <!-- Leave a Review -->
            <div>
                <div style="background: var(--card-bg); padding: 2rem; border-radius: var(--radius); border: 1px solid var(--border); position: sticky; top: 100px;">
                    <h3 style="margin-bottom: 1.5rem; font-size: 1.3rem;">Share Your Feedback</h3>
                    @auth
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div style="margin-bottom: 1.5rem;">
                            <label class="option-label">Your Rating</label>
                            <div class="rating-input" style="display: flex; gap: 10px; font-size: 1.5rem; color: var(--text-muted); cursor: pointer;">
                                <input type="hidden" name="rating" id="selected-rating" value="5">
                                <i class="fas fa-star" data-value="1" onclick="setRating(1)"></i>
                                <i class="fas fa-star" data-value="2" onclick="setRating(2)"></i>
                                <i class="fas fa-star" data-value="3" onclick="setRating(3)"></i>
                                <i class="fas fa-star" data-value="4" onclick="setRating(4)"></i>
                                <i class="fas fa-star" data-value="5" onclick="setRating(5)" style="color: var(--warning);"></i>
                            </div>
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <label class="option-label">Comment</label>
                            <textarea name="comment" rows="4" style="width: 100%; background: var(--bg); border: 1px solid var(--border); border-radius: 12px; padding: 1rem; color: var(--text-main); font-family: inherit; resize: none;" placeholder="What did you like or dislike?" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Post Review</button>
                    </form>
                    @else
                    <p style="color: var(--text-secondary); text-align: center; padding: 1rem;">Please <a href="/login" style="color: var(--primary-light); font-weight: 600;">login</a> to leave a review.</p>
                    @endauth
                </div>
            </div>

            <!-- Review List -->
            <div>
                @if($product->reviews->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: 2rem;">
                        @foreach($product->reviews->sortByDesc('created_at') as $review)
                        <div style="background: var(--card-bg); padding: 2rem; border-radius: var(--radius); border: 1px solid var(--border); transition: transform 0.3s ease;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 45px; height: 45px; border-radius: 50%; background: var(--gradient-primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">
                                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h5 style="margin: 0; font-size: 1rem;">{{ $review->user->name }}</h5>
                                        <small style="color: var(--text-muted);">{{ $review->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <div style="color: var(--warning); font-size: 0.9rem;">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                            <p style="color: var(--text-secondary); line-height: 1.7; margin: 0;">{{ $review->comment }}</p>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 5rem 2rem; background: var(--card-bg); border-radius: var(--radius); border: 2px dashed var(--border);">
                        <i class="far fa-comments" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1.5rem;"></i>
                        <h3 style="color: var(--text-main);">No reviews yet</h3>
                        <p style="color: var(--text-secondary);">Be the first to share your thoughts about this product!</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- RELATED PRODUCTS -->
    @if($relatedProducts->count() > 0)
    <section class="related-section animate animate-delay-2">
        <div class="section-header">
            <h2 class="section-title">You May Also Like</h2>
            <p class="section-subtitle">Similar products from this collection</p>
        </div>
        <div class="product-grid">
            @foreach($relatedProducts as $rel)
            <div class="product-card">
                <div class="product-image">
                    @if($rel->image)
                        <img src="{{ $rel->image }}" alt="{{ $rel->name }}">
                    @else
                        <i class="fas fa-image placeholder-icon"></i>
                    @endif
                </div>
                <div class="product-info">
                    <h3 class="product-name">
                        <a href="/product/{{ $rel->id }}">{{ $rel->name }}</a>
                    </h3>
                    <div class="product-price-row">
                        <span class="current-price">${{ number_format($rel->price, 2) }}</span>
                        @if($rel->old_price)
                            <span class="old-price">${{ number_format($rel->old_price, 2) }}</span>
                        @endif
                    </div>
                    <a href="/product/{{ $rel->id }}" class="btn btn-outline btn-sm" style="width: 100%; margin-top: 0.75rem;">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</main>
@endsection

@section('scripts')
<script>
    function switchImage(el, url) {
        document.getElementById('main-product-image').src = url;
        document.querySelectorAll('.thumb').forEach(t => t.style.borderColor = 'transparent');
        el.style.borderColor = 'var(--primary)';
    }

    function selectSize(el) {
        document.querySelectorAll('.size-chip').forEach(c => c.classList.remove('active'));
        el.classList.add('active');
    }

    function selectColor(el, hex) {
        document.querySelectorAll('.color-chip').forEach(c => {
            c.classList.remove('active');
            c.style.borderColor = 'var(--border)';
        });
        el.classList.add('active');
        el.style.borderColor = 'var(--primary)';
    }

    function setRating(val) {
        document.getElementById('selected-rating').value = val;
        document.querySelectorAll('.rating-input i').forEach(star => {
            const starValue = parseInt(star.getAttribute('data-value'));
            if (starValue <= val) {
                star.style.color = 'var(--warning)';
            } else {
                star.style.color = 'var(--text-muted)';
            }
        });
    }

    function changeQty(delta) {
        const display = document.getElementById('qty-display');
        const input = document.getElementById('qty-input');
        const inputBuy = document.getElementById('qty-input-buy');
        let val = parseInt(display.textContent) + delta;
        if (val < 1) val = 1;
        if (val > {{ $product->stock }}) val = {{ $product->stock }};
        display.textContent = val;
        input.value = val;
        if(inputBuy) inputBuy.value = val;
    }
</script>
@endsection
