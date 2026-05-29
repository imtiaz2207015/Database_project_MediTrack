@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-mediblue">
            <div class="inner">
                <h3>{{ $totalMedicines }}</h3>
                <p>Total Medicines</p>
            </div>
            <div class="icon"><i class="fas fa-pills"></i></div>
            <a href="{{ route('medicines.index') }}" class="small-box-footer">View All <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-medigreen">
            <div class="inner">
                <h3>৳ {{ number_format($totalRevenue, 2) }}</h3>
                <p>Total Revenue</p>
            </div>
            <div class="icon"><i class="fas fa-dollar-sign"></i></div>
            <a href="{{ route('sales.index') }}" class="small-box-footer">View Sales <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
         <div class="small-box bg-medipurple">
            <div class="inner">
                <h3>{{ $totalSales }}</h3>
                <p>Completed Sales</p>
            </div>
            <div class="icon"><i class="fas fa-cash-register"></i></div>
            <a href="{{ route('sales.index') }}" class="small-box-footer">View All <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-mediorange">
            <div class="inner">
                <h3>{{ $lowStock->count() }}</h3>
                <p>Low Stock Alerts</p>
            </div>
            <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
            <a href="{{ route('medicines.index') }}" class="small-box-footer">Check Now <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar mr-2"></i>Monthly Revenue (Last 6 Months)</h3>
            </div>
            <div class="card-body">
                <canvas id="salesChart" height="120"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-clock mr-2"></i>Expiring Within 90 Days</h3>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($expiringSoon as $med)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $med->name }}</span>
                        <span class="badge badge-warning">
                            {{ \Carbon\Carbon::parse($med->expiry_date)->format('d M Y') }}
                        </span>
                    </li>
                    @empty
                    <li class="list-group-item text-muted">No medicines expiring soon.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-exclamation-triangle mr-2"></i>Low Stock Medicines</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr><th>Medicine</th><th>Stock</th><th>Reorder Level</th></tr>
                    </thead>
                    <tbody>
                        @forelse($lowStock as $med)
                        <tr>
                            <td>{{ $med->name }}</td>
                            <td><span class="badge badge-danger">{{ $med->stock_quantity }}</span></td>
                            <td>{{ $med->reorder_level }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-muted text-center">All stock levels are fine!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-receipt mr-2"></i>Recent Sales</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr><th>#</th><th>Customer</th><th>Amount</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($recentSales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->customer->name ?? 'Walk-in' }}</td>
                            <td>৳ {{ number_format($sale->paid_amount, 2) }}</td>
                            <td>
                                <span class="badge badge-{{ $sale->status === 'completed' ? 'success' : ($sale->status === 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($sale->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-muted text-center">No sales yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const ctx = document.getElementById('salesChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach($monthlySales as $ms)
                "{{ date('F', mktime(0,0,0,$ms->month,1)) }}",
            @endforeach
        ],
        datasets: [{
            label: 'Revenue (৳)',
            data: [
                @foreach($monthlySales as $ms)
                    {{ $ms->total }},
                @endforeach
            ],
            backgroundColor: 'rgba(60,141,188,0.8)',
            borderColor: 'rgba(60,141,188,1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: { y: { beginAtZero: true } }
    }
});
</script>
@endpush

{{-- Below are snippets from related views for reference --}}

{{-- resources/views/customers/index.blade.php --}}