@extends('layouts.app')
@section('title', 'Prescription Details')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <i class="fas fa-file-medical mr-2"></i>Prescription Details
        </h3>
        <div>
            <a href="{{ route('prescriptions.edit', $prescription) }}"
               class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('prescriptions.index') }}"
               class="btn btn-secondary btn-sm ml-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <button onclick="window.print()" class="btn btn-info btn-sm ml-2">
                <i class="fas fa-print"></i> Print
            </button>
        </div>
    </div>

    <div class="card-body" id="printable">
        <div class="row">
            <div class="col-md-6">
                <h5 style="color:#2e7d8c;border-bottom:2px solid #2e7d8c;padding-bottom:6px">
                    <i class="fas fa-user mr-2"></i>Patient Information
                </h5>
                <p><strong>Name:</strong> {{ $prescription->customer->name }}</p>
                <p><strong>Phone:</strong> {{ $prescription->customer->phone ?? '—' }}</p>
                <p><strong>Address:</strong> {{ $prescription->customer->address ?? '—' }}</p>
            </div>
            <div class="col-md-6">
                <h5 style="color:#2e7d8c;border-bottom:2px solid #2e7d8c;padding-bottom:6px">
                    <i class="fas fa-user-md mr-2"></i>Doctor Information
                </h5>
                <p><strong>Doctor:</strong> {{ $prescription->doctor_name }}</p>
                <p><strong>Phone:</strong> {{ $prescription->doctor_phone ?? '—' }}</p>
                <p><strong>Date:</strong>
                    {{ \Carbon\Carbon::parse($prescription->prescribed_date)->format('d M Y') }}
                </p>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <h5 style="color:#2e7d8c;border-bottom:2px solid #2e7d8c;padding-bottom:6px">
                    <i class="fas fa-notes-medical mr-2"></i>Prescription Notes
                </h5>
                <div class="p-3" style="background:#f7fbfc;border-radius:8px;min-height:80px">
                    {{ $prescription->notes ?? 'No notes provided.' }}
                </div>
            </div>
        </div>

        @if($prescription->sale)
        <div class="row mt-4">
            <div class="col-md-12">
                <h5 style="color:#2e7d8c;border-bottom:2px solid #2e7d8c;padding-bottom:6px">
                    <i class="fas fa-receipt mr-2"></i>Linked Sale — #{{ $prescription->sale_id }}
                </h5>
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Medicine</th>
                            <th>Qty</th>
                            <th>Unit Price (৳)</th>
                            <th>Subtotal (৳)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prescription->sale->saleItems as $item)
                        <tr>
                            <td>{{ $item->medicine->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->unit_price, 2) }}</td>
                            <td>{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Total Paid:</strong></td>
                            <td><strong>৳ {{ number_format($prescription->sale->paid_amount, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection