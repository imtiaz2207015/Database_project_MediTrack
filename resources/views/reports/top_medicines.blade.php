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

    <div class="card-body pb-0">
        <div class="p-3 mb-3" style="background:#1e2a3a;border-radius:8px">
            <small style="color:#5a8a99;letter-spacing:1px">SQL QUERY USED</small>
            <pre style="color:#a8c4d0;font-size:0.78rem;margin:6px 0 0">SELECT m.name, m.generic_name, c.name AS category,
       SUM(si.quantity) AS total_qty_sold,
       SUM(si.subtotal) AS total_revenue,
       COUNT(DISTINCT si.sale_id) AS times_sold
FROM sale_items si
JOIN medicines m ON si.medicine_id = m.id
JOIN categories c ON m.category_id = c.id
JOIN sales s ON si.sale_id = s.id
WHERE s.status = 'completed'
GROUP BY m.id, m.name, m.generic_name, c.name
ORDER BY total_qty_sold DESC
LIMIT {{ $limit }}</pre>
        </div>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Rank</th>
                    <th>Medicine</th>
                    <th>Category</th>
                    <th>Form</th>
                    <th>Times Sold</th>
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
                    <td>
                        <strong>{{ $row->medicine_name }}</strong>
                        @if($row->generic_name)
                            <br><small class="text-muted">{{ $row->generic_name }}</small>
                        @endif
                    </td>
                    <td><span class="badge badge-info">{{ $row->category }}</span></td>
                    <td>{{ ucfirst($row->dosage_form) }}</td>
                    <td><span class="badge badge-primary">{{ $row->times_sold }}</span></td>
                    <td><strong>{{ number_format($row->total_qty_sold) }}</strong></td>
                    <td><strong class="text-success">{{ number_format($row->total_revenue, 2) }}</strong></td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No sales data found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection