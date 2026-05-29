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

    <div class="card-body pb-0">
        <div class="p-3 mb-3" style="background:#1e2a3a;border-radius:8px">
            <small style="color:#5a8a99;letter-spacing:1px">SQL QUERY USED</small>
            <pre style="color:#a8c4d0;font-size:0.78rem;margin:6px 0 0">SELECT s.name AS supplier, s.contact_person, s.phone,
       COUNT(p.id) AS total_purchases,
       SUM(p.total_amount) AS total_spent,
       MAX(p.purchase_date) AS last_purchase
FROM suppliers s
LEFT JOIN purchases p ON s.id = p.supplier_id
GROUP BY s.id, s.name, s.contact_person, s.phone
ORDER BY total_spent DESC</pre>
        </div>
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
                    <td><span class="badge badge-info">{{ $row->total_purchases ?? 0 }}</span></td>
                    <td><strong>৳ {{ number_format($row->total_spent ?? 0, 2) }}</strong></td>
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