@extends('layouts.app')
@section('title', 'Category Details')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-tag mr-2"></i>{{ $category->name }}</h3>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    <div class="card-body">
        <p><strong>Description:</strong> {{ $category->description ?? '—' }}</p>
        <p><strong>Total Medicines:</strong> {{ $category->medicines->count() }}</p>

        <h5 class="mt-4">Medicines in this Category</h5>
        <table class="table table-bordered table-sm">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Price (৳)</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                @forelse($category->medicines as $med)
                <tr>
                    <td>{{ $med->name }}</td>
                    <td>{{ $med->brand ?? '—' }}</td>
                    <td>{{ number_format($med->price, 2) }}</td>
                    <td>{{ $med->stock_quantity }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-muted text-center">No medicines in this category.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection