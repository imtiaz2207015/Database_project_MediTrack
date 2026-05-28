@extends('layouts.app')
@section('title', 'Categories')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-tags mr-2"></i>All Categories</h3>
        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Category
        </a>
    </div>

    <div class="card-body border-bottom pb-3">
        <form method="GET" action="{{ route('categories.index') }}" class="form-inline">
            <input type="text" name="search" class="form-control form-control-sm mr-2"
                   placeholder="Search categories..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-info btn-sm mr-2">
                <i class="fas fa-search"></i> Search
            </button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-times"></i> Clear
            </a>
        </form>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Medicines</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $category->name }}</strong></td>
                    <td>{{ $category->description ?? '—' }}</td>
                    <td>
                        <span class="badge badge-info">{{ $category->medicines_count }}</span>
                    </td>
                    <td>
                        <a href="{{ route('categories.show', $category) }}"
                           class="btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('categories.edit', $category) }}"
                           class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('categories.destroy', $category) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Delete {{ $category->name }}?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">No categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $categories->links() }}</div>
</div>
@endsection