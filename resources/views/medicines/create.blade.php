@extends('layouts.app')
@section('title', 'Add Medicine')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-plus mr-2"></i>Add New Medicine</h3>
    </div>
    <form action="{{ route('medicines.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Medicine Name *</label>
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
                        <label>Generic Name</label>
                        <input type="text" name="generic_name" class="form-control"
                               value="{{ old('generic_name') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Brand</label>
                        <input type="text" name="brand" class="form-control"
                               value="{{ old('brand') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Category *</label>
                        <select name="category_id"
                                class="form-control @error('category_id') is-invalid @enderror" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Supplier *</label>
                        <select name="supplier_id"
                                class="form-control @error('supplier_id') is-invalid @enderror" required>
                            <option value="">-- Select Supplier --</option>
                            @foreach($suppliers as $sup)
                                <option value="{{ $sup->id }}"
                                    {{ old('supplier_id') == $sup->id ? 'selected' : '' }}>
                                    {{ $sup->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Dosage Form *</label>
                        <select name="dosage_form" class="form-control" required>
                            @foreach(['tablet','capsule','syrup','injection','cream','drops','other'] as $form)
                                <option value="{{ $form }}"
                                    {{ old('dosage_form') == $form ? 'selected' : '' }}>
                                    {{ ucfirst($form) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Strength</label>
                        <input type="text" name="strength" class="form-control"
                               value="{{ old('strength') }}" placeholder="e.g. 500mg">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Price (৳) *</label>
                        <input type="number" name="price" step="0.01"
                               class="form-control @error('price') is-invalid @enderror"
                               value="{{ old('price') }}" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Batch Number</label>
                        <input type="text" name="batch_number" class="form-control"
                               value="{{ old('batch_number') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Stock Quantity *</label>
                        <input type="number" name="stock_quantity" class="form-control"
                               value="{{ old('stock_quantity', 0) }}" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Reorder Level *</label>
                        <input type="number" name="reorder_level" class="form-control"
                               value="{{ old('reorder_level', 10) }}" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Expiry Date *</label>
                        <input type="date" name="expiry_date"
                               class="form-control @error('expiry_date') is-invalid @enderror"
                               value="{{ old('expiry_date') }}" required>
                        @error('expiry_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control"
                                  rows="3">{{ old('description') }}</textarea>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Save Medicine
            </button>
            <a href="{{ route('medicines.index') }}" class="btn btn-secondary ml-2">Cancel</a>
        </div>
    </form>
</div>
@endsection