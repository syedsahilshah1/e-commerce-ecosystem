@extends('layouts.app')
@section('title', 'Register')

@section('styles')
<style>
    .auth-container {
        max-width: 500px;
        margin: 4rem auto;
        padding: 2.5rem;
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
    }

    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-header h1 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .auth-header p {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .auth-footer {
        margin-top: 2rem;
        text-align: center;
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    .auth-footer a {
        color: var(--primary-light);
        text-decoration: none;
        font-weight: 600;
    }

    .role-selection {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 1.5rem;
    }

    .role-option {
        border: 1px solid var(--border);
        padding: 1rem;
        border-radius: var(--radius-sm);
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
    }

    .role-option input {
        position: absolute;
        opacity: 0;
    }

    .role-option:has(input:checked) {
        border-color: var(--primary);
        background: rgba(124, 58, 237, 0.1);
    }

    .role-option i {
        display: block;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        color: var(--text-muted);
    }

    .role-option:has(input:checked) i {
        color: var(--primary-light);
    }
</style>
@endsection

@section('content')
<div class="auth-container animate">
    <div class="auth-header">
        <h1>Create Account</h1>
        <p>Join the NOBLER community today</p>
    </div>

    @if($errors->any())
        <div class="alert alert-error" style="margin-bottom: 1.5rem;">
            <ul style="list-style: none;">
                @foreach($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        
        <div class="role-selection">
            <label class="role-option">
                <input type="radio" name="role" value="customer" checked>
                <i class="fas fa-shopping-bag"></i>
                <span>Customer</span>
            </label>
            <label class="role-option">
                <input type="radio" name="role" value="provider">
                <i class="fas fa-store"></i>
                <span>Provider</span>
            </label>
        </div>

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" class="form-input" required placeholder="John Doe" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" class="form-input" required placeholder="name@example.com" value="{{ old('email') }}">
        </div>

        <div class="grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-input" required placeholder="••••••••">
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-input" required placeholder="••••••••">
            </div>
        </div>

        <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1.5rem;">
            By creating an account, you agree to our <a href="#" style="color: var(--primary-light);">Terms of Service</a> and <a href="#" style="color: var(--primary-light);">Privacy Policy</a>.
        </p>

        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
            Create Account <i class="fas fa-user-plus"></i>
        </button>
    </form>

    <div class="auth-footer">
        Already have an account? <a href="{{ route('login') }}">Sign In</a>
    </div>
</div>
@endsection
