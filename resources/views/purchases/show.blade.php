@extends('layouts.app')
@section('title', 'Purchase Details')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-shopping-cart mr-2"></i>Purchase #{{ $purchase->id }}</h3>
        <a href="{{ route('purchases.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Supplier:</strong> {{ $purchase->supplier->name }}</p>
                <p><strong>Recorded By:</strong> {{ $purchase->user->name ?? '—' }}</p>
                <p><strong>Purchase Date:</strong>
                    {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d M Y') }}
                </p>
            </div>
            <div class="col-md-6">
                <p><strong>Status:</strong>
                    <span class="badge badge-{{ $purchase->status === 'received' ? 'success' : 'warning' }}">
                        {{ ucfirst($purchase->status) }}
                    </span>
                </p>
                <p><strong>Total Amount:</strong> ৳ {{ number_format($purchase->total_amount, 2) }}</p>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Medicine</th>
                    <th>Quantity</th>
                    <th>Unit Price (৳)</th>
                    <th>Subtotal (৳)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchase->purchaseItems as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->medicine->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price, 2) }}</td>
                    <td>{{ number_format($item->subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td colspan="4" class="text-right"><strong>Grand Total:</strong></td>
                    <td><strong>৳ {{ number_format($purchase->total_amount, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection