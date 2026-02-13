@extends('layouts.app')
@section('title', 'Exclusive Collections')

@section('styles')
<style>
    :root {
        --glass: rgba(255, 255, 255, 0.03);
        --glass-border: rgba(255, 255, 255, 0.08);
    }

    .collections-page {
        min-height: 100vh;
        background: radial-gradient(circle at 0% 0%, rgba(124, 58, 237, 0.05) 0%, transparent 50%),
                    radial-gradient(circle at 100% 100%, rgba(6, 182, 212, 0.05) 0%, transparent 50%);
        padding-bottom: 10rem;
    }

    .hero-visual {
        text-align: center;
        padding: 10rem 2rem 6rem;
        position: relative;
        overflow: hidden;
    }

    .hero-visual h1 {
        font-size: clamp(3rem, 10vw, 6rem);
        font-weight: 950;
        letter-spacing: -4px;
        line-height: 0.9;
        margin-bottom: 2rem;
        background: linear-gradient(180deg, var(--text-main) 0%, rgba(255,255,255,0.4) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .category-bento {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 1.5rem;
        padding: 0 2rem;
    }

    .bento-item {
        grid-column: span 4;
        background: var(--glass);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 40px;
        padding: 3rem;
        position: relative;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 400px;
    }

    /* Asymmetric Layout */
    .bento-item:nth-child(1) { grid-column: span 8; }
    .bento-item:nth-child(4) { grid-column: span 7; }
    .bento-item:nth-child(5) { grid-column: span 5; }

    .bento-item:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: var(--primary-light);
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 30px 60px rgba(0,0,0,0.4);
    }

    .bento-item::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at center, var(--primary) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.5s;
        z-index: 0;
        pointer-events: none;
    }

    .bento-item:hover::before {
        opacity: 0.1;
    }

    .cat-icon {
        font-size: 3.5rem;
        margin-bottom: 2rem;
        position: relative;
        z-index: 1;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: transform 0.5s;
    }

    .bento-item:hover .cat-icon {
        transform: rotate(-10px) scale(1.1);
    }

    .cat-info {
        position: relative;
        z-index: 1;
    }

    .cat-info h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        letter-spacing: -1px;
    }

    .sub-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 1.5rem;
    }

    .pill {
        background: rgba(255,255,255,0.05);
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-muted);
        text-decoration: none;
        border: 1px solid transparent;
        transition: all 0.3s;
    }

    .pill:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary-light);
    }

    .explore-btn {
        margin-top: 2rem;
        width: fit-content;
        background: white;
        color: black;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s;
    }

    .bento-item:hover .explore-btn {
        background: var(--primary);
        color: white;
    }

    @media (max-width: 1024px) {
        .bento-item { grid-column: span 6 !important; }
    }

    @media (max-width: 768px) {
        .bento-item { grid-column: span 12 !important; }
        .hero-visual h1 { font-size: 4rem; }
    }
</style>
@endsection

@section('content')
<div class="collections-page">
    <div class="hero-visual animate">
        <p style="color: var(--primary-light); font-weight: 800; text-transform: uppercase; letter-spacing: 4px; margin-bottom: 1rem;">Curation Excellence</p>
        <h1>COLLECTIONS</h1>
        <p style="font-size: 1.25rem; color: var(--text-muted); max-width: 600px; margin: 0 auto;">
            Our vault is categorized by aesthetic intent. Explore the boundaries of premium lifestyle.
        </p>
    </div>

    <div class="category-bento">
        @php
            $icons = ['Clothing' => 'fa-shirt', 'Electronics' => 'fa-microchip', 'Accessories' => 'fa-hat-wizard', 'Home' => 'fa-house-user', 'Beauty' => 'fa-sparkles'];
        @endphp

        @foreach($categories as $category)
        <div class="bento-item animate">
            <div class="cat-top">
                <i class="fas {{ $icons[$category->name] ?? 'fa-cube' }} cat-icon"></i>
                <div class="cat-info">
                    <h2>{{ $category->name }}</h2>
                    <p style="color: var(--text-muted);">Exclusive curated {{ strtolower($category->name) }} artifacts.</p>
                </div>
            </div>

            <div class="cat-bottom">
                @if($category->children->count() > 0)
                <div class="sub-pills">
                    @foreach($category->children as $child)
                    <a href="{{ route('category.show', $child->slug) }}" class="pill">
                        {{ $child->name }}
                    </a>
                    @endforeach
                </div>
                @endif
                
                <a href="{{ route('category.show', $category->slug) }}" class="explore-btn">
                    Explore Drop <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
