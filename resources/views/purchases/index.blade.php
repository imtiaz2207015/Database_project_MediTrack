@extends('layouts.app')
@section('title', 'Purchases')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-shopping-cart mr-2"></i>All Purchases</h3>
        <a href="{{ route('purchases.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> New Purchase
        </a>
    </div>

    <div class="card-body border-bottom pb-3">
        <form method="GET" action="{{ route('purchases.index') }}" class="form-inline flex-wrap">
            <input type="text" name="search" class="form-control form-control-sm mr-2 mb-2"
                   placeholder="Search supplier..." value="{{ request('search') }}">
            <select name="status" class="form-control form-control-sm mr-2 mb-2">
                <option value="">All Status</option>
                <option value="received"  {{ request('status') === 'received'  ? 'selected' : '' }}>Received</option>
                <option value="pending"   {{ request('status') === 'pending'   ? 'selected' : '' }}>Pending</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit" class="btn btn-info btn-sm mr-2 mb-2">
                <i class="fas fa-search"></i> Search
            </button>
            <a href="{{ route('purchases.index') }}" class="btn btn-secondary btn-sm mb-2">
                <i class="fas fa-times"></i> Clear
            </a>
        </form>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Supplier</th>
                    <th>Recorded By</th>
                    <th>Total (৳)</th>
                    <th>Status</th>
                    <th>Purchase Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->id }}</td>
                    <td><strong>{{ $purchase->supplier->name }}</strong></td>
                    <td>{{ $purchase->user->name ?? '—' }}</td>
                    <td>{{ number_format($purchase->total_amount, 2) }}</td>
                    <td>
                        <span class="badge badge-{{ $purchase->status === 'received' ? 'success' : ($purchase->status === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($purchase->status) }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('purchases.show', $purchase) }}"
                           class="btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
                        <form action="{{ route('purchases.destroy', $purchase) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this purchase and reverse stock?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No purchases found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $purchases->links() }}</div>
</div>
@endsection