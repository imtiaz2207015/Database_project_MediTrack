@extends('layouts.app')
@section('title', 'New Stock Adjustment')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-boxes mr-2"></i>New Stock Adjustment
        </h3>
    </div>
    <form action="{{ route('stock-adjustments.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Medicine *</label>
                        <select name="medicine_id" class="form-control" required>
                            <option value="">-- Select Medicine --</option>
                            @foreach($medicines as $med)
                                <option value="{{ $med->id }}">
                                    {{ $med->name }} — Current Stock: {{ $med->stock_quantity }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Adjustment Type *</label>
                        <select name="type" class="form-control" required>
                            <option value="increase">⬆ Increase Stock</option>
                            <option value="decrease">⬇ Decrease Stock</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Quantity *</label>
                        <input type="number" name="quantity" class="form-control"
                               min="1" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Reason</label>
                        <input type="text" name="reason" class="form-control"
                               placeholder="e.g. Damaged stock, Donation, Correction..."
                               value="{{ old('reason') }}">
                    </div>
                </div>

            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Save Adjustment
            </button>
            <a href="{{ route('stock-adjustments.index') }}" class="btn btn-secondary ml-2">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection