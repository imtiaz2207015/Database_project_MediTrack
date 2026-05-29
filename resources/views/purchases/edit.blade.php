@extends('layouts.app')
@section('title', 'Edit Purchase')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Edit Purchase #{{ $purchase->id }}</h3>
    </div>
    <form action="{{ route('purchases.update', $purchase) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label><strong>Purchase ID</strong></label>
                        <input type="text" class="form-control" value="#{{ $purchase->id }}" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><strong>Supplier</strong></label>
                        <input type="text" class="form-control" value="{{ $purchase->supplier->name }}" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><strong>Total Amount</strong></label>
                        <input type="text" class="form-control" value="৳ {{ number_format($purchase->total_amount, 2) }}" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Status *</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="">-- Select Status --</option>
                            <option value="pending" {{ $purchase->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="received" {{ $purchase->status === 'received' ? 'selected' : '' }}>Received</option>
                            <option value="cancelled" {{ $purchase->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <hr>
            <h5>Purchase Items</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Medicine</th>
                            <th style="width: 10%">Quantity</th>
                            <th style="width: 15%">Unit Price</th>
                            <th style="width: 15%">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchase->purchaseItems as $item)
                            <tr>
                                <td>{{ $item->medicine->name }} ({{ $item->medicine->strength }})</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-right">৳ {{ number_format($item->unit_price, 2) }}</td>
                                <td class="text-right"><strong>৳ {{ number_format($item->subtotal, 2) }}</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row mt-3">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <h5>
                        Grand Total: <strong>৳ {{ number_format($purchase->total_amount, 2) }}</strong>
                    </h5>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Update Purchase
            </button>
            <a href="{{ route('purchases.index') }}" class="btn btn-secondary ml-2">Cancel</a>
        </div>
    </form>
</div>
@endsection
