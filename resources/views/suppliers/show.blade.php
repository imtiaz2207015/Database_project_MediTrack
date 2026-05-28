@extends('layouts.app')
@section('title', 'Supplier Details')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-truck mr-2"></i>{{ $supplier->name }}</h3>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Contact Person:</strong> {{ $supplier->contact_person ?? '—' }}</p>
                <p><strong>Phone:</strong> {{ $supplier->phone }}</p>
                <p><strong>Email:</strong> {{ $supplier->email ?? '—' }}</p>
                <p><strong>Address:</strong> {{ $supplier->address ?? '—' }}</p>
            </div>
        </div>

        <h5 class="mt-4">Medicines from this Supplier</h5>
        <table class="table table-bordered table-sm">
            <thead class="thead-light">
                <tr><th>Name</th><th>Category</th><th>Price (৳)</th><th>Stock</th></tr>
            </thead>
            <tbody>
                @forelse($supplier->medicines as $med)
                <tr>
                    <td>{{ $med->name }}</td>
                    <td>{{ $med->category->name ?? '—' }}</td>
                    <td>{{ number_format($med->price, 2) }}</td>
                    <td>{{ $med->stock_quantity }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-muted text-center">No medicines.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection