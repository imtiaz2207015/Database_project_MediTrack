@extends('layouts.app')
@section('title', 'Add Prescription')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-file-medical mr-2"></i>Add New Prescription
        </h3>
    </div>
    <form action="{{ route('prescriptions.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Customer *</label>
                        <select name="customer_id" class="form-control" required>
                            <option value="">-- Select Customer --</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} — {{ $customer->phone }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Linked Sale (optional)</label>
                        <select name="sale_id" class="form-control">
                            <option value="">-- No Sale Linked --</option>
                            @foreach($sales as $sale)
                                <option value="{{ $sale->id }}"
                                    {{ old('sale_id') == $sale->id ? 'selected' : '' }}>
                                    Sale #{{ $sale->id }}
                                    — {{ $sale->customer->name ?? 'Walk-in' }}
                                    — ৳{{ number_format($sale->paid_amount, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Doctor Name *</label>
                        <input type="text" name="doctor_name" class="form-control"
                               value="{{ old('doctor_name') }}"
                               placeholder="Dr. Full Name" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Doctor Phone</label>
                        <input type="text" name="doctor_phone" class="form-control"
                               value="{{ old('doctor_phone') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Prescribed Date *</label>
                        <input type="date" name="prescribed_date" class="form-control"
                               value="{{ old('prescribed_date', date('Y-m-d')) }}" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Notes / Medicines Prescribed</label>
                        <textarea name="notes" class="form-control" rows="4"
                                  placeholder="List medicines, dosage instructions, special notes...">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Save Prescription
            </button>
            <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary ml-2">Cancel</a>
        </div>
    </form>
</div>
@endsection