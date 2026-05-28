@extends('layouts.app')
@section('title', 'Edit Customer')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Edit Customer</h3>
    </div>
    <form action="{{ route('customers.update', $customer) }}" method="POST">
        @csrf @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Full Name *</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', $customer->name) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control"
                               value="{{ old('phone', $customer->phone) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email', $customer->email) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control"
                                  rows="3">{{ old('address', $customer->address) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save mr-1"></i> Update Customer
            </button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary ml-2">Cancel</a>
        </div>
    </form>
</div>
@endsection