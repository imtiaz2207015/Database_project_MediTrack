@extends('layouts.app')
@section('title', 'Supplier Purchase Report')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <i class="fas fa-truck mr-2"></i>Supplier Purchase Report
        </h3>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Supplier</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Total Orders</th>
                    <th>Total Purchase Amount (৳)</th>
                    <th>Medicine Supplied</th>
                    <th>Current Stock</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $row)
                <tr>
                    <td><strong>{{ $row->supplier_name }}</strong></td>
                    <td>{{ $row->phone }}</td>
                    <td>{{ $row->email }}</td>
                    <td><span class="badge badge-info">{{ $row->total_orders }}</span></td>
                    <td><strong>৳ {{ number_format($row->total_purchase_amount, 2) }}</strong></td>
                    <td>{{ $row->medicine_name }}</td>
                    <td>{{ $row->stock_quantity }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No data found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection