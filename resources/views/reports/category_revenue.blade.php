@extends('layouts.app')
@section('title', 'Revenue by Category')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <i class="fas fa-tags mr-2"></i>Revenue by Category
        </h3>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body pb-0">
        <div class="p-3 mb-3" style="background:#1e2a3a;border-radius:8px">
            <small style="color:#5a8a99;letter-spacing:1px">SQL QUERY USED</small>
            <pre style="color:#a8c4d0;font-size:0.78rem;margin:6px 0 0">SELECT c.name AS category,
       COUNT(DISTINCT m.id) AS total_medicines,
       SUM(si.quantity) AS total_sold,
       SUM(si.subtotal) AS total_revenue
FROM categories c
JOIN medicines m ON c.id = m.category_id
JOIN sale_items si ON m.id = si.medicine_id
JOIN sales s ON si.sale_id = s.id
WHERE s.status = 'completed'
GROUP BY c.id, c.name
ORDER BY total_revenue DESC</pre>
        </div>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Total Medicines</th>
                    <th>Total Qty Sold</th>
                    <th>Total Revenue (৳)</th>
                    <th>Revenue Bar</th>
                </tr>
            </thead>
            <tbody>
                @php $maxRevenue = collect($data)->max('total_revenue') ?: 1; @endphp
                @forelse($data as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $row->category }}</strong></td>
                    <td><span class="badge badge-info">{{ $row->total_medicines }}</span></td>
                    <td>{{ number_format($row->total_sold) }}</td>
                    <td><strong>৳ {{ number_format($row->total_revenue, 2) }}</strong></td>
                    <td style="width:200px">
                        @php $pct = round(($row->total_revenue / $maxRevenue) * 100); @endphp
                        <div style="background:#e8f0f5;border-radius:4px;height:18px">
                            <div style="background:linear-gradient(135deg,#2e7d8c,#1a6b7a);width:{{ $pct }}%;height:100%;border-radius:4px;transition:width 0.3s"></div>
                        </div>
                        <small class="text-muted">{{ $pct }}%</small>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No data found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection