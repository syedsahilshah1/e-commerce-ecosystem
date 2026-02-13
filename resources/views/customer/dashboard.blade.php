@extends('layouts.app')

@section('title', 'My Orders')

@section('styles')
<style>
    .dashboard-container {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 0 1rem;
    }
    .order-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    .order-header {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid var(--border-light);
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }
    .status-badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        text-transform: uppercase;
        font-weight: 700;
    }
    .status-pending { background: rgba(255, 193, 7, 0.2); color: #ffc107; }
    .status-accepted { background: rgba(124, 58, 237, 0.2); color: var(--primary-light); }
    .status-preparing { background: rgba(6, 182, 212, 0.2); color: #06b6d4; }
    .status-on-the-way { background: rgba(59, 130, 246, 0.2); color: #3b82f6; }
    .status-delivered { background: rgba(16, 185, 129, 0.2); color: #10b981; }
    .status-cancelled { background: rgba(244, 63, 94, 0.2); color: #ef4444; }

    /* Progress Tracker Styles */
    .progress-tracker {
        display: flex;
        justify-content: space-between;
        margin: 1.5rem 0 2rem;
        position: relative;
    }
    .progress-tracker::before {
        content: '';
        position: absolute;
        top: 15px;
        left: 0;
        right: 0;
        height: 2px;
        background: var(--border);
        z-index: 1;
    }
    .tracker-step {
        position: relative;
        z-index: 2;
        text-align: center;
        flex: 1;
    }
    .step-dot {
        width: 32px;
        height: 32px;
        background: var(--card-bg);
        border: 2px solid var(--border);
        border-radius: 50%;
        margin: 0 auto 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        color: var(--text-muted);
        transition: all 0.3s;
    }
    .tracker-step.active .step-dot {
        border-color: var(--primary);
        color: var(--primary);
        background: rgba(124, 58, 237, 0.1);
        box-shadow: 0 0 10px rgba(124, 58, 237, 0.3);
    }
    .tracker-step.completed .step-dot {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }
    .step-label {
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
    }
    .tracker-step.active .step-label { color: var(--text-main); }

    .order-items { width: 100%; border-collapse: collapse; }
    .order-items td { padding: 0.5rem 0; color: var(--text-secondary); }
    .order-items td:last-child { text-align: right; color: var(--text-main); font-weight: 600; }
</style>
@endsection

@section('content')
<main class="dashboard-container">
    <h1 style="margin-bottom: 2rem;">Order History</h1>

    @if($orders->count() > 0)
        @foreach($orders as $order)
        <div class="order-card animate">
            <div class="order-header">
                <div>
                    <span style="display:block; font-size: 0.8rem; color: var(--text-muted);">ORDER PLACED</span>
                    <span style="font-weight: 600;">{{ $order->created_at->format('M d, Y') }}</span>
                </div>
                <div>
                    <span style="display:block; font-size: 0.8rem; color: var(--text-muted);">TOTAL</span>
                    <span style="font-weight: 600;">${{ number_format($order->total_amount, 2) }}</span>
                </div>
                <div>
                    <span style="display:block; font-size: 0.8rem; color: var(--text-muted);">ORDER # {{ $order->id }}</span>
                </div>
                <div style="text-align: right;">
                    <span class="status-badge status-{{ str_replace(' ', '-', strtolower($order->status)) }}">{{ $order->status }}</span>
                </div>
            </div>

            @if($order->status != 'cancelled')
            @php
                $steps = ['pending', 'accepted', 'preparing', 'on the way', 'delivered'];
                $currentStep = array_search(strtolower($order->status), $steps);
            @endphp
            <div class="progress-tracker">
                @foreach($steps as $index => $step)
                <div class="tracker-step {{ $index < $currentStep ? 'completed' : ($index == $currentStep ? 'active' : '') }}">
                    <div class="step-dot">
                        @if($index < $currentStep)
                            <i class="fas fa-check"></i>
                        @else
                            {{ $index + 1 }}
                        @endif
                    </div>
                    <div class="step-label">{{ ucfirst($step) }}</div>
                </div>
                @endforeach
            </div>
            @else
            <div style="text-align: center; padding: 1rem; color: #ef4444; font-weight: 600;">
                <i class="fas fa-ban"></i> This order has been cancelled.
            </div>
            @endif
            
            <table class="order-items">
                @foreach($order->items as $item)
                <tr>
                    <td style="width: 60px;">
                        <img src="{{ $item->product->image ?? 'https://via.placeholder.com/50' }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                    </td>
                    <td>
                        <div style="font-weight: 500; color: var(--text-main);">{{ $item->product->name }}</div>
                        <div style="font-size: 0.85rem;">Qty: {{ $item->quantity }} @if($item->color) <span style="margin-left: 10px; color: var(--text-muted);">Color: {{ $item->color }}</span> @endif</div>
                    </td>
                    <td>${{ number_format($item->price, 2) }}</td>
                </tr>
                @endforeach
            </table>

            @if($order->status == 'delivered')
                <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border-light);">
                    @if(!$order->return_status)
                        <button onclick="toggleReturnForm({{ $order->id }})" class="btn btn-outline btn-sm">
                            <i class="fas fa-undo"></i> Return Order
                        </button>
                        
                        <div id="return-form-{{ $order->id }}" style="display: none; margin-top: 1rem; animation: slideDown 0.3s ease;">
                            <form action="{{ route('customer.order.return', $order->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Reason for Return</label>
                                    <textarea name="return_reason" class="form-input" placeholder="Please explain why you're returning this order..." required style="min-height: 80px;"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Submit Return Request</button>
                            </form>
                        </div>
                    @else
                        <div style="display: flex; align-items: center; justify-content: space-between; background: rgba(124, 58, 237, 0.05); padding: 1rem; border-radius: var(--radius-sm); border: 1px dashed var(--primary);">
                            <div>
                                <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">RETURN STATUS</span>
                                <span style="font-weight: 700; color: var(--primary-light);">{{ strtoupper($order->return_status) }}</span>
                            </div>
                            <div style="font-size: 0.85rem; color: var(--text-secondary); max-width: 60%;">
                                <strong>Reason:</strong> {{ $order->return_reason }}
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
        @endforeach
    @else
        <div style="text-align: center; padding: 4rem;">
            <h3>No orders yet</h3>
            <p style="color: var(--text-muted); margin-bottom: 1.5rem;">Start shopping to see your orders here.</p>
            <a href="{{ route('shop') }}" class="btn btn-primary">Start Shopping</a>
        </div>
    @endif
</main>
@endsection

@section('scripts')
<script>
    function toggleReturnForm(orderId) {
        const form = document.getElementById('return-form-' + orderId);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>
@endsection
