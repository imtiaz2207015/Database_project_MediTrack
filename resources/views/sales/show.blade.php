@extends('layouts.app')
@section('title', 'Sale Details')

@section('content')
<div class="card">
<div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title"><i class="fas fa-receipt mr-2"></i>Sale #{{ $sale->id }}</h3>
    <div>
        <a href="{{ route('sales.invoice', $sale) }}" class="btn btn-success btn-sm">
            <i class="fas fa-file-invoice mr-1"></i> Print Invoice
        </a>
        <a href="{{ route('sales.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Customer:</strong> {{ $sale->customer->name ?? 'Walk-in' }}</p>
                <p><strong>Served By:</strong> {{ $sale->user->name ?? '—' }}</p>
                <p><strong>Date:</strong> {{ $sale->created_at->format('d M Y, h:i A') }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_',' ',$sale->payment_method)) }}</p>
                <p><strong>Status:</strong>
                    <span class="badge badge-{{ $sale->status === 'completed' ? 'success' : 'warning' }}">
                        {{ ucfirst($sale->status) }}
                    </span>
                </p>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Medicine</th>
                    <th>Qty</th>
                    <th>Unit Price (৳)</th>
                    <th>Subtotal (৳)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->saleItems as $i => $item)
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
                <tr><td colspan="4" class="text-right"><strong>Total:</strong></td><td>{{ number_format($sale->total_amount, 2) }}</td></tr>
                <tr><td colspan="4" class="text-right"><strong>Discount:</strong></td><td>{{ number_format($sale->discount, 2) }}</td></tr>
                <tr class="table-success"><td colspan="4" class="text-right"><strong>Paid:</strong></td><td><strong>{{ number_format($sale->paid_amount, 2) }}</strong></td></tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection