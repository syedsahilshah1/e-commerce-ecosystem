@extends('layouts.app')

@section('title', 'Vendor Dashboard')

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
        display: flex;
        align-items: center;
        gap: 10px;
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
    
    .btn-primary, .btn-danger {
        text-decoration: none;
        display: inline-block;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn-danger { background: #ef4444; color: white; margin-left: 0.5rem; }
    .text-danger { color: #ef4444; }
    .text-success { color: #10b981; }
</style>
@endsection

@section('content')
<main class="dashboard-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-size: 1.8rem;">My Shop Dashboard</h1>
        <a href="{{ route('provider.products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Product</a>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <h3>My Products</h3>
            <p>{{ $totalProducts }}</p>
        </div>
        <div class="stat-card">
            <h3>Orders Received</h3>
            <p>{{ $ordersCount }}</p>
        </div>
    </div>

    <!-- Recent Sales -->
    <section class="admin-section" style="margin-bottom: 2rem;">
        <h2><i class="fas fa-shopping-cart"></i> Recent Sales</h2>
        @if(isset($recentOrders) && $recentOrders->count() > 0)
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Order Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->order->user->name ?? 'Guest' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                    <td>{{ $item->created_at->format('M d, H:i') }}</td>
                    <td>
                        <div style="margin-bottom: 0.5rem;">
                            <span class="badge" style="background: rgba(124, 58, 237, 0.1); color: var(--primary); padding: 4px 8px; border-radius: 4px; font-weight: 600;">
                                {{ ucfirst($item->order->status) }}
                            </span>
                        </div>
                        <form action="{{ route('provider.orders.updateStatus', $item->order->id) }}" method="POST" style="display: flex; gap: 4px; flex-wrap: wrap;">
                            @csrf
                            @if($item->order->status == 'pending')
                                <button type="submit" name="status" value="accepted" class="btn btn-sm btn-primary" style="font-size: 0.7rem; padding: 4px 8px;">Accept</button>
                            @elseif($item->order->status == 'accepted')
                                <button type="submit" name="status" value="preparing" class="btn btn-sm btn-ghost" style="font-size: 0.7rem; padding: 4px 8px;">Preparing</button>
                            @elseif($item->order->status == 'preparing')
                                <button type="submit" name="status" value="on the way" class="btn btn-sm btn-outline" style="font-size: 0.7rem; padding: 4px 8px;">On Way</button>
                            @elseif($item->order->status == 'on the way')
                                <button type="submit" name="status" value="delivered" class="btn btn-sm btn-primary" style="font-size: 0.7rem; padding: 4px 8px;">Delivered</button>
                            @endif
                            
                            @if($item->order->status != 'delivered' && $item->order->status != 'cancelled')
                                <button type="submit" name="status" value="cancelled" class="btn btn-sm btn-danger" style="font-size: 0.7rem; padding: 4px 8px;">Cancel</button>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p style="color: var(--text-muted); text-align: center; padding: 2rem;">No orders received yet.</p>
        @endif
    </section>

    <!-- Return Requests -->
    <section class="admin-section" style="margin-bottom: 2rem; border-color: var(--secondary);">
        <h2 style="color: var(--secondary);"><i class="fas fa-undo"></i> Return Requests</h2>
        @if(isset($returnRequests) && $returnRequests->count() > 0)
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($returnRequests as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->order->user->name }}</td>
                    <td style="font-size: 0.85rem; max-width: 250px;">{{ $item->order->return_reason }}</td>
                    <td>
                        <span class="badge" style="background: rgba(244, 63, 94, 0.1); color: var(--secondary); padding: 4px 8px; border-radius: 4px; font-weight: 600;">
                            {{ strtoupper($item->order->return_status ?? 'Requested') }}
                        </span>
                    </td>
                    <td>
                        @if($item->order->return_status == 'requested')
                        <form action="{{ route('provider.orders.updateReturnStatus', $item->order->id) }}" method="POST" style="display: flex; gap: 4px;">
                            @csrf
                            <button type="submit" name="return_status" value="approved" class="btn btn-sm btn-primary" style="background: var(--success); font-size: 0.7rem;">Approve</button>
                            <button type="submit" name="return_status" value="rejected" class="btn btn-sm btn-danger" style="font-size: 0.7rem;">Reject</button>
                        </form>
                        @elseif($item->order->return_status == 'approved')
                        <form action="{{ route('provider.orders.updateReturnStatus', $item->order->id) }}" method="POST">
                            @csrf
                            <button type="submit" name="return_status" value="completed" class="btn btn-sm btn-ghost" style="color: var(--success); font-size: 0.7rem;">Mark Received</button>
                        </form>
                        @else
                            <span style="font-size: 0.8rem; color: var(--text-muted);">No actions</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p style="color: var(--text-muted); text-align: center; padding: 2rem;">No return requests found.</p>
        @endif
    </section>

    <!-- Products List -->
    <section class="admin-section">
        <h2><i class="fas fa-box"></i> My Products</h2>
        @if($products->count() > 0)
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        <img src="{{ $product->image ?? 'https://via.placeholder.com/40' }}" style="width: 40px; height: 40px; border-radius: 4px; object-fit: cover;">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>
                        <span class="{{ $product->stock < 5 ? 'text-danger' : 'text-success' }}">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td>
                       <a href="{{ route('provider.products.edit', $product->id) }}" class="btn-primary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Edit</a>
                       <form action="{{ route('provider.products.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this product?');">
                           @method('DELETE')
                           @csrf
                           <button type="submit" class="btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Delete</button>
                       </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 1rem;">
            {{ $products->links() }}
        </div>
        @else
        <div style="text-align: center; padding: 2rem;">
            <p style="color: var(--text-muted); margin-bottom: 1rem;">You haven't listed any products yet.</p>
            <a href="{{ route('provider.products.create') }}" class="btn btn-outline">Create First Product</a>
        </div>
        @endif
    </section>
</main>
@endsection
