@extends('layouts.app')
@section('title', 'Monthly Sales Report')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <i class="fas fa-chart-bar mr-2"></i>Monthly Sales Report
        </h3>
        <div class="d-flex align-items-center">
            <form method="GET" class="form-inline mr-3">
                <select name="year" class="form-control form-control-sm mr-2">
                    @for($y = date('Y'); $y >= date('Y') - 3; $y--)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
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

    {{-- SQL Query Display --}}
    <div class="card-body pb-0">
        <div class="p-3 mb-3" style="background:#1e2a3a;border-radius:8px">
            <small style="color:#5a8a99;letter-spacing:1px">SQL QUERY USED</small>
            <pre style="color:#a8c4d0;font-size:0.78rem;margin:6px 0 0">SELECT MONTH(created_at) AS month_num, MONTHNAME(created_at) AS month_name,
       COUNT(*) AS total_sales, SUM(total_amount) AS gross_amount,
       SUM(discount) AS total_discount, SUM(paid_amount) AS net_revenue
FROM sales
WHERE YEAR(created_at) = {{ $year }} AND status = 'completed'
GROUP BY MONTH(created_at), MONTHNAME(created_at)
ORDER BY month_num ASC</pre>
        </div>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Month</th>
                    <th>Total Sales</th>
                    <th>Gross Amount (৳)</th>
                    <th>Total Discount (৳)</th>
                    <th>Net Revenue (৳)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $row)
                <tr>
                    <td><strong>{{ $row->month_name }} {{ $year }}</strong></td>
                    <td><span class="badge badge-info">{{ $row->total_sales }}</span></td>
                    <td>{{ number_format($row->gross_amount, 2) }}</td>
                    <td class="text-danger">{{ number_format($row->total_discount, 2) }}</td>
                    <td><strong class="text-success">{{ number_format($row->net_revenue, 2) }}</strong></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        No sales data for {{ $year }}.
                    </td>
                </tr>
                @endforelse
            </tbody>
            @if(count($data) > 0)
            <tfoot style="background:#f7fbfc">
                <tr>
                    <td><strong>TOTAL</strong></td>
                    <td><strong>{{ collect($data)->sum('total_sales') }}</strong></td>
                    <td><strong>৳ {{ number_format(collect($data)->sum('gross_amount'), 2) }}</strong></td>
                    <td class="text-danger"><strong>৳ {{ number_format(collect($data)->sum('total_discount'), 2) }}</strong></td>
                    <td class="text-success"><strong>৳ {{ number_format(collect($data)->sum('net_revenue'), 2) }}</strong></td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>
@endsection