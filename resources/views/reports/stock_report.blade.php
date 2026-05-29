@extends('layouts.app')
@section('title', 'Full Stock Report')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <i class="fas fa-boxes mr-2"></i>Full Stock Report
        </h3>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body pb-0">
        <div class="p-3 mb-3" style="background:#1e2a3a;border-radius:8px">
            <small style="color:#5a8a99;letter-spacing:1px">SQL QUERY USED — CASE WHEN</small>
            <pre style="color:#a8c4d0;font-size:0.78rem;margin:6px 0 0">SELECT m.name, m.stock_quantity, m.reorder_level, m.expiry_date,
       CASE
           WHEN m.expiry_date &lt; CURDATE() THEN 'Expired'
           WHEN m.stock_quantity &lt;= m.reorder_level THEN 'Low Stock'
           WHEN m.expiry_date &lt;= DATE_ADD(CURDATE(), INTERVAL 90 DAY) THEN 'Expiring Soon'
           ELSE 'Good'
       END AS status
FROM medicines m
JOIN categories c ON m.category_id = c.id
JOIN suppliers s ON m.supplier_id = s.id
ORDER BY CASE WHEN status = 'Expired' THEN 1
              WHEN status = 'Low Stock' THEN 2
              WHEN status = 'Expiring Soon' THEN 3 ELSE 4 END</pre>
        </div>
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
                    <th>Price (৳)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $row)
                <tr class="{{ $row->status === 'Expired' ? 'table-dark' : ($row->status === 'Low Stock' ? 'table-danger' : ($row->status === 'Expiring Soon' ? 'table-warning' : '')) }}">
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <strong>{{ $row->name }}</strong>
                        @if($row->generic_name)
                            <br><small>{{ $row->generic_name }}</small>
                        @endif
                    </td>
                    <td>{{ $row->category }}</td>
                    <td>{{ $row->supplier }}</td>
                    <td><strong>{{ $row->stock_quantity }}</strong></td>
                    <td>{{ $row->reorder_level }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->expiry_date)->format('d M Y') }}</td>
                    <td>{{ number_format($row->price, 2) }}</td>
                    <td>
                        @if($row->status === 'Expired')
                            <span class="badge badge-dark">Expired</span>
                        @elseif($row->status === 'Low Stock')
                            <span class="badge badge-danger">⚠ Low Stock</span>
                        @elseif($row->status === 'Expiring Soon')
                            <span class="badge badge-warning">⏰ Expiring Soon</span>
                        @else
                            <span class="badge badge-success">✓ Good</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">No data found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection