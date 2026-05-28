@extends('layouts.app')
@section('title', 'Customer Details')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-user mr-2"></i>{{ $customer->name }}</h3>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Phone:</strong> {{ $customer->phone ?? '—' }}</p>
                <p><strong>Email:</strong> {{ $customer->email ?? '—' }}</p>
                <p><strong>Address:</strong> {{ $customer->address ?? '—' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Total Sales:</strong>
                    <span class="badge badge-success">{{ $customer->sales->count() }}</span>
                </p>
                <p><strong>Total Spent:</strong>
                    ৳ {{ number_format($customer->sales->sum('paid_amount'), 2) }}
                </p>
            </div>
        </div>

        <h5>Purchase History</h5>
        <table class="table table-bordered table-sm">
            <thead class="thead-light">
                <tr>
                    <th>Sale #</th>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Total (৳)</th>
                    <th>Payment</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customer->sales as $sale)
                <tr>
                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->created_at->format('d M Y') }}</td>
                    <td>{{ $sale->saleItems->count() }}</td>
                    <td>{{ number_format($sale->paid_amount, 2) }}</td>
                    <td>{{ ucfirst($sale->payment_method) }}</td>
                    <td>
                        <span class="badge badge-{{ $sale->status === 'completed' ? 'success' : 'warning' }}">
                            {{ ucfirst($sale->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted text-center">No sales yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection