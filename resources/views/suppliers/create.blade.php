@extends('layouts.app')
@section('title', 'Add Supplier')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-plus mr-2"></i>Add New Supplier</h3>
    </div>
    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Company Name *</label>
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
                        <label>Contact Person</label>
                        <input type="text" name="contact_person" class="form-control"
                               value="{{ old('contact_person') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone *</label>
                        <input type="text" name="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Save Supplier
            </button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary ml-2">Cancel</a>
        </div>
    </form>
</div>
@endsection