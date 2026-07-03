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
                    <th>#</th>
                    <th>Supplier</th>
                    <th>Contact Person</th>
                    <th>Phone</th>
                    <th>Total Purchases</th>
                    <th>Total Spent (৳)</th>
                    <th>Last Purchase</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $row->supplier }}</strong></td>
                    <td>{{ $row->contact_person ?? '—' }}</td>
                    <td>{{ $row->phone }}</td>
                    <td><span class="badge badge-info">{{ $row->total_purchases }}</span></td>
                    <td><strong>৳ {{ number_format($row->total_spent, 2) }}</strong></td>
                    <td>
                        {{ $row->last_purchase
                            ? \Carbon\Carbon::parse($row->last_purchase)->format('d M Y')
                            : '—' }}
                    </td>
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