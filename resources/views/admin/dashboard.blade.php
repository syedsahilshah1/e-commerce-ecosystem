@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('styles')
<style>
    .dashboard-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: var(--card-bg);
        padding: 1.5rem;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        text-align: center;
    }

    .stat-card h3 {
        color: var(--text-muted);
        font-size: 0.9rem;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .stat-card p {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-light);
    }

    .admin-section {
        background: var(--card-bg);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .admin-section h2 {
        margin-bottom: 1.5rem;
        border-bottom: 1px solid var(--border);
        padding-bottom: 1rem;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table th, .admin-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid var(--border);
    }

    .admin-table th {
        color: var(--text-muted);
        font-weight: 600;
    }

    .badge {
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .badge.warning {
        background: rgba(255, 193, 7, 0.2);
        color: #ffc107;
    }

    .btn-success, .btn-danger, .btn-primary {
        padding: 0.4rem 0.8rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        transition: opacity 0.2s;
        text-decoration: none;
        display: inline-block;
        font-size: 0.85rem;
    }

    .btn-success { background: #10b981; color: white; }
    .btn-danger { background: #ef4444; color: white; margin-left: 0.5rem; }
    .btn-primary { background: var(--primary); color: white; }

    .btn-success:hover, .btn-danger:hover { opacity: 0.9; }
</style>
@endsection

@section('content')
<main class="dashboard-container">
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Pending Requests</h3>
            <p>{{ $pendingProviders->count() }}</p>
        </div>
        <div class="stat-card">
            <h3>Active Providers</h3>
            <p>{{ $approvedProviders->count() }}</p>
        </div>
        <div class="stat-card">
             <h3>Total Users</h3>
             <p>{{ $totalUsers }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Products</h3>
            <p>{{ $totalProducts }}</p>
        </div>
    </div>

    <!-- PENDING PROVIDERS SECTION -->
    <section class="admin-section">
        <h2>Pending Provider Approvals</h2>
        @if($pendingProviders->count() > 0)
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th> <!-- Added Status Column -->
                    <th>Requested At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingProviders as $provider)
                <tr>
                    <td>{{ $provider->name }}</td>
                    <td>{{ $provider->email }}</td>
                    <td>{{ ucfirst($provider->role) }}</td>
                    <td><span class="badge warning">{{ ucfirst($provider->status) }}</span></td>
                    <td>{{ $provider->created_at->diffForHumans() }}</td>
                    <td>
                        <form action="{{ route('admin.approve', $provider->id) }}" method="POST" style="display:inline;">
                             @csrf
                             <button type="submit" class="btn-success">Approve</button>
                        </form>
                        <form action="{{ route('admin.reject', $provider->id) }}" method="POST" style="display:inline;">
                             @csrf
                             <button type="submit" class="btn-danger">Reject</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p style="color: var(--text-muted); text-align: center; padding: 1rem;">No pending requests at the moment.</p>
        @endif
    </section>

    <!-- APPROVED PROVIDERS SECTION -->
     <section class="admin-section">
        <h2>Manage Active Providers</h2>
        @if($approvedProviders->count() > 0)
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Products Active</th>
                    <th>Joined</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($approvedProviders as $provider)
                <tr>
                    <td>{{ $provider->name }}</td>
                    <td>{{ $provider->email }}</td>
                    <td>{{ $provider->products->count() }}</td>
                    <td>{{ $provider->created_at->format('M d, Y') }}</td>
                    <td>
                        <!-- <a href="#" class="btn-primary">Edit</a> -->
                        <form action="{{ route('admin.reject', $provider->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this provider? All their products will be deleted too.');">
                            @csrf
                            <button type="submit" class="btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No active providers found.</p>
        @endif
    </section>
    <!-- SUNDAY SALE MANAGEMENT SECTION -->
    <section class="admin-section" style="margin-top: 3rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h2>Sunday Sale Management</h2>
            <div style="background: var(--gradient-primary); color: white; padding: 0.5rem 1rem; border-radius: var(--radius); font-size: 0.85rem; font-weight: 700;">
                <i class="fas fa-calendar-alt"></i> Active for Next Sunday
            </div>
        </div>
        
        @if($allProducts->count() > 0)
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Provider</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Sunday Sale</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allProducts as $product)
                <tr>
                    <td style="display: flex; align-items: center; gap: 10px;">
                        <img src="{{ $product->image }}" style="width: 40px; height: 40px; border-radius: 6px; object-fit: cover;">
                        <div>
                            <div style="font-weight: 600;">{{ $product->name }}</div>
                            <small style="color: var(--text-muted);">{{ $product->category->name }}</small>
                        </div>
                    </td>
                    <td>{{ $product->user->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>
                        @if($product->old_price)
                            <span style="color: var(--secondary);">-{{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}%</span>
                        @else
                            <span style="color: var(--text-muted);">N/A</span>
                        @endif
                    </td>
                    <td>
                        @if($product->is_on_sunday_sale)
                            <span class="badge" style="background: rgba(16, 185, 129, 0.2); color: #10b981;">ENABLED</span>
                        @else
                            <span class="badge" style="background: rgba(156, 163, 175, 0.2); color: #9ca3af;">DISABLED</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.toggleSundaySale', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-primary" style="background: {{ $product->is_on_sunday_sale ? '#ef4444' : 'var(--primary)' }};">
                                {{ $product->is_on_sunday_sale ? 'Disable Sale' : 'Enable Sale' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No products available to manage.</p>
        @endif
    </section>
</main>
@endsection
