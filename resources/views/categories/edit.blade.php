@extends('layouts.app')
@section('title', 'Edit Category')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Edit Category</h3>
    </div>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>Category Name *</label>
                <input type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save mr-1"></i> Update Category
            </button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary ml-2">Cancel</a>
        </div>
    </form>
</div>
@endsection