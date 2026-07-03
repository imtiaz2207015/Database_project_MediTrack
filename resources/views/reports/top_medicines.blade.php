@extends('layouts.app')
@section('title', 'Top Selling Medicines')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <i class="fas fa-trophy mr-2"></i>Top Selling Medicines
        </h3>
        <div class="d-flex">
            <form method="GET" class="form-inline mr-3">
                <select name="limit" class="form-control form-control-sm mr-2">
                    @foreach([5,10,20,50] as $l)
                        <option value="{{ $l }}" {{ $limit == $l ? 'selected' : '' }}>
                            Top {{ $l }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-info btn-sm">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </form>
            <a href="{{ route('reports.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Rank</th>
                    <th>Medicine</th>
                    <th>Dosage Form</th>
                    <th>Strength</th>
                    <th>Total Qty Sold</th>
                    <th>Total Revenue (৳)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $row)
                <tr>
                    <td>
                        @if($i == 0)
                            <span class="badge" style="background:#f39c12;color:#fff">🥇 1</span>
                        @elseif($i == 1)
                            <span class="badge" style="background:#6c8a96;color:#fff">🥈 2</span>
                        @elseif($i == 2)
                            <span class="badge" style="background:#cd7f32;color:#fff">🥉 3</span>
                        @else
                            <span class="badge badge-secondary">{{ $i + 1 }}</span>
                        @endif
                    </td>
                    <td><strong>{{ $row->name }}</strong></td>
                    <td>{{ ucfirst($row->dosage_form) }}</td>
                    <td>{{ $row->strength }}</td>
                    <td><strong>{{ number_format($row->total_quantity_sold) }}</strong></td>
                    <td><strong class="text-success">৳ {{ number_format($row->total_revenue, 2) }}</strong></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No sales data found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection