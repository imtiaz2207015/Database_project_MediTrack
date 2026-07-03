@extends('layouts.app')
@section('title', 'Sales Summary Report')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <i class="fas fa-chart-bar mr-2"></i>Sales Summary Report
        </h3>
        <div class="d-flex align-items-center">
            <form method="GET" class="form-inline mr-3">
                <input type="date" name="start_date" value="{{ $startDate }}" class="form-control form-control-sm mr-2">
                <input type="date" name="end_date" value="{{ $endDate }}" class="form-control form-control-sm mr-2">
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
                    <th>Date</th>
                    <th>Payment Method</th>
                    <th>Transactions</th>
                    <th>Gross Sales (৳)</th>
                    <th>Discount (৳)</th>
                    <th>Collected (৳)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $row)
                <tr>
                    <td><strong>{{ \Carbon\Carbon::parse($row->sale_date)->format('d M Y') }}</strong></td>
                    <td><span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $row->payment_method)) }}</span></td>
                    <td>{{ $row->total_transactions }}</td>
                    <td>{{ number_format($row->total_sales, 2) }}</td>
                    <td class="text-danger">{{ number_format($row->total_discount, 2) }}</td>
                    <td><strong class="text-success">{{ number_format($row->total_collected, 2) }}</strong></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        No sales data for this date range.
                    </td>
                </tr>
                @endforelse
            </tbody>
            @if(count($data) > 0)
            <tfoot style="background:#f7fbfc">
                <tr>
                    <td colspan="2"><strong>TOTAL</strong></td>
                    <td><strong>{{ collect($data)->sum('total_transactions') }}</strong></td>
                    <td><strong>৳ {{ number_format(collect($data)->sum('total_sales'), 2) }}</strong></td>
                    <td class="text-danger"><strong>৳ {{ number_format(collect($data)->sum('total_discount'), 2) }}</strong></td>
                    <td class="text-success"><strong>৳ {{ number_format(collect($data)->sum('total_collected'), 2) }}</strong></td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>
@endsection