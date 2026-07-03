@extends('layouts.app')
@section('title', 'Low Stock Report')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <i class="fas fa-boxes mr-2"></i>Low Stock Report
        </h3>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Medicine</th>
                    <th>Category</th>
                    <th>Supplier</th>
                    <th>Stock</th>
                    <th>Reorder Level</th>
                    <th>Expiry Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $row)
                    @php
                        $expiry = \Carbon\Carbon::parse($row->expiry_date);
                        $isExpired = $expiry->isPast();
                        $isExpiringSoon = !$isExpired && $expiry->lte(now()->addDays(90));
                    @endphp
                    <tr class="{{ $isExpired ? 'table-dark' : ($isExpiringSoon ? 'table-warning' : 'table-danger') }}">
                        <td>{{ $i + 1 }}</td>
                        <td>
                            <strong>{{ $row->name }}</strong>
                            @if($row->generic_name)
                                <br><small>{{ $row->generic_name }}</small>
                            @endif
                        </td>
                        <td>{{ $row->category_name }}</td>
                        <td>{{ $row->supplier_name }}</td>
                        <td><strong>{{ $row->stock_quantity }}</strong></td>
                        <td>{{ $row->reorder_level }}</td>
                        <td>{{ $expiry->format('d M Y') }}</td>
                        <td>
                            @if($isExpired)
                                <span class="badge badge-dark">Expired</span>
                            @elseif($isExpiringSoon)
                                <span class="badge badge-warning">⏰ Expiring Soon</span>
                            @else
                                <span class="badge badge-danger">⚠ Low Stock</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No low stock medicines found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection