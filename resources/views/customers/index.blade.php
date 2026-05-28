@extends('layouts.app')
@section('title', 'Customers')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-users mr-2"></i>All Customers</h3>
        <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Customer
        </a>
    </div>

    <div class="card-body border-bottom pb-3">
        <form method="GET" action="{{ route('customers.index') }}" class="form-inline flex-wrap">
            <input type="text" name="search" class="form-control form-control-sm mr-2 mb-2"
                   placeholder="Search name, phone, email..." value="{{ request('search') }}">
            <select name="sort_by" class="form-control form-control-sm mr-2 mb-2">
                <option value="name"       {{ $sortBy === 'name'       ? 'selected' : '' }}>Sort: Name</option>
                <option value="created_at" {{ $sortBy === 'created_at' ? 'selected' : '' }}>Sort: Newest</option>
            </select>
            <select name="sort_dir" class="form-control form-control-sm mr-2 mb-2">
                <option value="asc"  {{ $sortDir === 'asc'  ? 'selected' : '' }}>↑ Asc</option>
                <option value="desc" {{ $sortDir === 'desc' ? 'selected' : '' }}>↓ Desc</option>
            </select>
            <button type="submit" class="btn btn-info btn-sm mr-2 mb-2">
                <i class="fas fa-search"></i> Search
            </button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary btn-sm mb-2">
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
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Total Sales</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $customer->name }}</strong></td>
                    <td>{{ $customer->phone ?? '—' }}</td>
                    <td>{{ $customer->email ?? '—' }}</td>
                    <td>{{ $customer->address ?? '—' }}</td>
                    <td><span class="badge badge-success">{{ $customer->sales_count }}</span></td>
                    <td>
                        <a href="{{ route('customers.show', $customer) }}"
                           class="btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('customers.edit', $customer) }}"
                           class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('customers.destroy', $customer) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Delete {{ $customer->name }}?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No customers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $customers->links() }}</div>
</div>
@endsection