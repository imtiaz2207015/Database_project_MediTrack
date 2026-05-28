@extends('layouts.app')
@section('title', 'Suppliers')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-truck mr-2"></i>All Suppliers</h3>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Supplier
        </a>
    </div>

    <div class="card-body border-bottom pb-3">
        <form method="GET" action="{{ route('suppliers.index') }}" class="form-inline">
            <input type="text" name="search" class="form-control form-control-sm mr-2"
                   placeholder="Search name, phone, email..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-info btn-sm mr-2">
                <i class="fas fa-search"></i> Search
            </button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-times"></i> Clear
            </a>
        </form>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Company Name</th>
                    <th>Contact Person</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Medicines</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $supplier)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $supplier->name }}</strong></td>
                    <td>{{ $supplier->contact_person ?? '—' }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>{{ $supplier->email ?? '—' }}</td>
                    <td><span class="badge badge-info">{{ $supplier->medicines_count }}</span></td>
                    <td>
                        <a href="{{ route('suppliers.show', $supplier) }}"
                           class="btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('suppliers.edit', $supplier) }}"
                           class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('suppliers.destroy', $supplier) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Delete {{ $supplier->name }}?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No suppliers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $suppliers->links() }}</div>
</div>
@endsection