@extends('layouts.app')
@section('title', 'Sales')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-cash-register mr-2"></i>All Sales</h3>
        <a href="{{ route('sales.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> New Sale
        </a>
    </div>

    <div class="card-body border-bottom pb-3">
        <form method="GET" action="{{ route('sales.index') }}" class="form-inline flex-wrap">
            <input type="text" name="search" class="form-control form-control-sm mr-2 mb-2"
                   placeholder="Search customer..." value="{{ request('search') }}">
            <select name="status" class="form-control form-control-sm mr-2 mb-2">
                <option value="">All Status</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="pending"   {{ request('status') === 'pending'   ? 'selected' : '' }}>Pending</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <select name="payment_method" class="form-control form-control-sm mr-2 mb-2">
                <option value="">All Payments</option>
                <option value="cash"           {{ request('payment_method') === 'cash'           ? 'selected' : '' }}>Cash</option>
                <option value="card"           {{ request('payment_method') === 'card'           ? 'selected' : '' }}>Card</option>
                <option value="mobile_banking" {{ request('payment_method') === 'mobile_banking' ? 'selected' : '' }}>Mobile Banking</option>
            </select>
            <select name="sort_by" class="form-control form-control-sm mr-2 mb-2">
                <option value="created_at"   {{ $sortBy === 'created_at'   ? 'selected' : '' }}>Sort: Date</option>
                <option value="total_amount" {{ $sortBy === 'total_amount' ? 'selected' : '' }}>Sort: Amount</option>
            </select>
            <select name="sort_dir" class="form-control form-control-sm mr-2 mb-2">
                <option value="desc" {{ $sortDir === 'desc' ? 'selected' : '' }}>↓ Newest</option>
                <option value="asc"  {{ $sortDir === 'asc'  ? 'selected' : '' }}>↑ Oldest</option>
            </select>
            <button type="submit" class="btn btn-info btn-sm mr-2 mb-2">
                <i class="fas fa-search"></i> Search
            </button>
            <a href="{{ route('sales.index') }}" class="btn btn-secondary btn-sm mb-2">
                <i class="fas fa-times"></i> Clear
            </a>
        </form>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Served By</th>
                    <th>Total (৳)</th>
                    <th>Discount (৳)</th>
                    <th>Paid (৳)</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                <tr>
                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->customer->name ?? 'Walk-in' }}</td>
                    <td>{{ $sale->user->name ?? '—' }}</td>
                    <td>{{ number_format($sale->total_amount, 2) }}</td>
                    <td>{{ number_format($sale->discount, 2) }}</td>
                    <td><strong>{{ number_format($sale->paid_amount, 2) }}</strong></td>
                    <td>{{ ucfirst(str_replace('_', ' ', $sale->payment_method)) }}</td>
                    <td>
                        <span class="badge badge-{{ $sale->status === 'completed' ? 'success' : ($sale->status === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($sale->status) }}
                        </span>
                    </td>
                    <td>{{ $sale->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('sales.show', $sale) }}"
                           class="btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
                        <form action="{{ route('sales.destroy', $sale) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this sale and restore stock?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted py-4">No sales found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $sales->links() }}</div>
</div>
@endsection