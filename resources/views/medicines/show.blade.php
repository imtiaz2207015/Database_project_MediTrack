@extends('layouts.app')
@section('title', 'Medicine Details')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <i class="fas fa-pills mr-2"></i>{{ $medicine->name }}
        </h3>
        <div>
            <a href="{{ route('medicines.edit', $medicine) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('medicines.index') }}" class="btn btn-secondary btn-sm ml-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-sm">
                    <tr>
                        <td width="40%"><strong>Generic Name</strong></td>
                        <td>{{ $medicine->generic_name ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Brand</strong></td>
                        <td>{{ $medicine->brand ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Category</strong></td>
                        <td>{{ $medicine->category->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Supplier</strong></td>
                        <td>{{ $medicine->supplier->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Dosage Form</strong></td>
                        <td>{{ ucfirst($medicine->dosage_form) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Strength</strong></td>
                        <td>{{ $medicine->strength ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Batch Number</strong></td>
                        <td>{{ $medicine->batch_number ?? '—' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered table-sm">
                    <tr>
                        <td width="40%"><strong>Price</strong></td>
                        <td>৳ {{ number_format($medicine->price, 2) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Stock</strong></td>
                        <td>
                            @if($medicine->stock_quantity <= $medicine->reorder_level)
                                <span class="badge badge-danger">
                                    {{ $medicine->stock_quantity }} ⚠ Low Stock
                                </span>
                            @else
                                <span class="badge badge-success">
                                    {{ $medicine->stock_quantity }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Reorder Level</strong></td>
                        <td>{{ $medicine->reorder_level }}</td>
                    </tr>
                    <tr>
                        <td><strong>Expiry Date</strong></td>
                        <td>
                            @php $exp = \Carbon\Carbon::parse($medicine->expiry_date); @endphp
                            <span class="badge {{ $exp->isPast() ? 'badge-dark' : ($exp->diffInDays() < 90 ? 'badge-warning' : 'badge-secondary') }}">
                                {{ $exp->format('d M Y') }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Description</strong></td>
                        <td>{{ $medicine->description ?? '—' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <h5 class="mt-4">Recent Sales of this Medicine</h5>
        <table class="table table-sm table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Sale #</th>
                    <th>Qty Sold</th>
                    <th>Unit Price (৳)</th>
                    <th>Subtotal (৳)</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medicine->saleItems->take(10) as $item)
                <tr>
                    <td>{{ $item->sale->id }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price, 2) }}</td>
                    <td>{{ number_format($item->subtotal, 2) }}</td>
                    <td>{{ $item->sale->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-muted text-center">No sales yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection@extends('layouts.app')
@section('title', 'Medicine Details')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-pills mr-2"></i>{{ $medicine->name }}</h3>
        <div>
            <a href="{{ route('medicines.edit', $medicine) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('medicines.index') }}" class="btn btn-secondary btn-sm ml-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-sm">
                    <tr><td><strong>Generic Name</strong></td><td>{{ $medicine->generic_name ?? '—' }}</td></tr>
                    <tr><td><strong>Brand</strong></td><td>{{ $medicine->brand ?? '—' }}</td></tr>
                    <tr><td><strong>Category</strong></td><td>{{ $medicine->category->name }}</td></tr>
                    <tr><td><strong>Supplier</strong></td><td>{{ $medicine->supplier->name }}</td></tr>
                    <tr><td><strong>Dosage Form</strong></td><td>{{ ucfirst($medicine->dosage_form) }}</td></tr>
                    <tr><td><strong>Strength</strong></td><td>{{ $medicine->strength ?? '—' }}</td></tr>
                    <tr><td><strong>Batch Number</strong></td><td>{{ $medicine->batch_number ?? '—' }}</td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered table-sm">
                    <tr><td><strong>Price</strong></td><td>৳ {{ number_format($medicine->price, 2) }}</td></tr>
                    <tr>
                        <td><strong>Stock</strong></td>
                        <td>
                            @if($medicine->stock_quantity <= $medicine->reorder_level)
                                <span class="badge badge-danger">{{ $medicine->stock_quantity }} ⚠ Low Stock</span>
                            @else
                                <span class="badge badge-success">{{ $medicine->stock_quantity }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr><td><strong>Reorder Level</strong></td><td>{{ $medicine->reorder_level }}</td></tr>
                    <tr>
                        <td><strong>Expiry Date</strong></td>
                        <td>
                            @php $exp = \Carbon\Carbon::parse($medicine->expiry_date); @endphp
                            <span class="badge {{ $exp->isPast() ? 'badge-dark' : ($exp->diffInDays() < 90 ? 'badge-warning' : 'badge-secondary') }}">
                                {{ $exp->format('d M Y') }}
                            </span>
                        </td>
                    </tr>
                    <tr><td><strong>Description</strong></td><td>{{ $medicine->description ?? '—' }}</td></tr>
                </table>
            </div>
        </div>

        <h5 class="mt-4">Recent Sales of this Medicine</h5>
        <table class="table table-sm table-bordered">
            <thead class="thead-light">
                <tr><th>Sale #</th><th>Qty Sold</th><th>Unit Price</th><th>Subtotal</th><th>Date</th></tr>
            </thead>
            <tbody>
                @forelse($medicine->saleItems->take(10) as $item)
                <tr>
                    <td>{{ $item->sale->id }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>৳ {{ number_format($item->unit_price, 2) }}</td>
                    <td>৳ {{ number_format($item->subtotal, 2) }}</td>
                    <td>{{ $item->sale->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-muted text-center">No sales yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection