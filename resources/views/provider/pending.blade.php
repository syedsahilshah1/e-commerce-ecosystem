@extends('layouts.app')

@section('title', 'Account Pending')

@section('content')
<main style="max-width: 600px; margin: 4rem auto; text-align: center; padding: 0 1.5rem;">
    <div style="background: var(--card-bg); padding: 3rem; border-radius: var(--radius); border: 1px solid var(--border);">
        <i class="fas fa-clock" style="font-size: 3rem; color: #ffc107; margin-bottom: 1.5rem;"></i>
        <h1 style="font-size: 1.5rem; margin-bottom: 1rem;">Application Under Review</h1>
        <p style="color: var(--text-muted); line-height: 1.6; margin-bottom: 2rem;">
            Thank you for registering as a Service Provider. Your account is currently pending approval from our administrators. 
            Once approved, you will be able to access your dashboard and start listing your services.
        </p>
        <a href="/" class="btn btn-outline">Return Home</a>
    </div>
</main>
@endsection
