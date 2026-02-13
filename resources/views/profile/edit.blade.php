@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container" style="max-width: 800px; margin: 3rem auto; padding: 0 1rem;">
    <h1 style="margin-bottom: 2rem;">My Profile</h1>

    <!-- Profile Details Form -->
    <div class="card" style="background: var(--card-bg); padding: 2rem; border-radius: var(--radius); border: 1px solid var(--border); margin-bottom: 2rem;">
        <h2 style="font-size: 1.25rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border); padding-bottom: 0.5rem;">Personal Information</h2>
        
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
            </div>

            <div style="text-align: right; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
        </form>
    </div>

    <!-- Password Update Form -->
    <div class="card" style="background: var(--card-bg); padding: 2rem; border-radius: var(--radius); border: 1px solid var(--border);">
        <h2 style="font-size: 1.25rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border); padding-bottom: 0.5rem;">Change Password</h2>
        
        <form action="{{ route('profile.password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" class="form-input" required>
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" class="form-input" required>
            </div>

            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-input" required>
            </div>

            <div style="text-align: right; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-outline" style="border-color: var(--warning); color: var(--warning);">Change Password</button>
            </div>
        </form>
    </div>
</div>
@endsection
