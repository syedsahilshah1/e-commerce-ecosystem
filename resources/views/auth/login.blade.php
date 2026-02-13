@extends('layouts.app')
@section('title', 'Login')

@section('styles')
<style>
    .auth-container {
        max-width: 450px;
        margin: 5rem auto;
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

    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: var(--text-secondary);
        cursor: pointer;
    }

    .remember-me input {
        width: 16px;
        height: 16px;
        accent-color: var(--primary);
    }
</style>
@endsection

@section('content')
<div class="auth-container animate">
    <div class="auth-header">
        <h1>Welcome Back</h1>
        <p>Login to your NOBLER account</p>
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

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" class="form-input" required autofocus placeholder="name@example.com" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-input" required placeholder="••••••••">
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <label class="remember-me">
                <input type="checkbox" name="remember">
                Remember me
            </label>
            <a href="#" style="font-size: 0.85rem; color: var(--primary-light); text-decoration: none;">Forgot Password?</a>
        </div>

        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
            Sign In <i class="fas fa-sign-in-alt"></i>
        </button>
    </form>

    <div class="auth-footer">
        Don't have an account? <a href="{{ route('register') }}">Create Account</a>
    </div>
</div>
@endsection
