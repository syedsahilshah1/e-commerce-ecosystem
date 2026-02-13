@extends('layouts.app')
@section('title', 'About NOBLER')

@section('styles')
<style>
    .about-hero {
        text-align: center;
        padding: 8rem 2rem;
        background: linear-gradient(to bottom, rgba(124, 58, 237, 0.05), transparent);
    }
    .about-hero h1 {
        font-size: 5rem;
        font-weight: 900;
        margin-bottom: 1.5rem;
    }
    .about-section {
        max-width: 1000px;
        margin: 5rem auto;
        padding: 0 2rem;
        line-height: 1.8;
    }
    .mission-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        margin-top: 5rem;
    }
    .value-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        padding: 3rem;
        border-radius: var(--radius);
        text-align: center;
    }
    .value-card i {
        font-size: 3rem;
        color: var(--primary-light);
        margin-bottom: 2rem;
    }
</style>
@endsection

@section('content')
<div class="about-hero animate">
    <h1>Our Heritage</h1>
    <p style="font-size: 1.5rem; color: var(--text-muted); max-width: 800px; margin: 0 auto;">
        Defining the intersection of avant-garde design and uncompromising quality since 2026.
    </p>
</div>

<div class="about-section">
    <div style="text-align: center; margin-bottom: 5rem;" class="animate">
        <h2 style="font-size: 2.5rem; margin-bottom: 2rem;">The NOBLER Philosophy</h2>
        <p style="font-size: 1.2rem; color: var(--text-secondary);">
            NOBLER was founded on a simple principle: Luxury should be an experience, not just a label. 
            We partner with the world's most innovative providers to bring you artifacts that stand the test of time.
        </p>
    </div>

    <div class="mission-grid">
        <div class="value-card animate animate-delay-1">
            <i class="fas fa-microchip"></i>
            <h3>Innovation First</h3>
            <p style="margin-top: 1rem; color: var(--text-muted);">We integrate the latest technology into every aspect of our platform, from dynamic AI support to seamless checkout experiences.</p>
        </div>
        <div class="value-card animate animate-delay-2">
            <i class="fas fa-feather"></i>
            <h3>Ethical Luxury</h3>
            <p style="margin-top: 1rem; color: var(--text-muted);">Our providers are strictly vetted for ethical manufacturing and sustainable practices, ensuring luxury with a conscience.</p>
        </div>
    </div>

    <div style="margin-top: 8rem; text-align: center;" class="animate">
        <h3 style="font-size: 1.5rem;">Created by **syedDev**</h3>
        <p style="color: var(--text-muted); margin-top: 1rem;">Building the future of premium digital commerce.</p>
    </div>
</div>
@endsection
