@extends('layouts.app')
@section('title', 'Add Customer')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-plus mr-2"></i>Add New Customer</h3>
    </div>
    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Full Name *</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control"
                               value="{{ old('phone') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Save Customer
            </button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary ml-2">Cancel</a>
        </div>
    </form>
</div>
@endsection