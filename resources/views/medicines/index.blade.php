@extends('layouts.app')
@section('title', 'Medicines')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-pills mr-2"></i>All Medicines</h3>
        <a href="{{ route('medicines.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Medicine
        </a>
    </div>

    <div class="card-body border-bottom pb-3">
        <form method="GET" action="{{ route('medicines.index') }}" class="form-inline flex-wrap">
            <input type="text" name="search" class="form-control form-control-sm mr-2 mb-2"
                   placeholder="Search name, brand, batch..." value="{{ request('search') }}">

            <select name="category_id" class="form-control form-control-sm mr-2 mb-2">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <select name="dosage_form" class="form-control form-control-sm mr-2 mb-2">
                <option value="">All Forms</option>
                @foreach(['tablet','capsule','syrup','injection','cream','drops','other'] as $form)
                    <option value="{{ $form }}" {{ request('dosage_form') == $form ? 'selected' : '' }}>
                        {{ ucfirst($form) }}
                    </option>
                @endforeach
            </select>

            <select name="sort_by" class="form-control form-control-sm mr-2 mb-2">
                <option value="name"           {{ $sortBy === 'name'           ? 'selected' : '' }}>Sort: Name</option>
                <option value="price"          {{ $sortBy === 'price'          ? 'selected' : '' }}>Sort: Price</option>
                <option value="stock_quantity" {{ $sortBy === 'stock_quantity' ? 'selected' : '' }}>Sort: Stock</option>
                <option value="expiry_date"    {{ $sortBy === 'expiry_date'    ? 'selected' : '' }}>Sort: Expiry</option>
            </select>

            <select name="sort_dir" class="form-control form-control-sm mr-2 mb-2">
                <option value="asc"  {{ $sortDir === 'asc'  ? 'selected' : '' }}>↑ Ascending</option>
                <option value="desc" {{ $sortDir === 'desc' ? 'selected' : '' }}>↓ Descending</option>
            </select>

            <button type="submit" class="btn btn-info btn-sm mr-2 mb-2">
                <i class="fas fa-search"></i> Search
            </button>
            <a href="{{ route('medicines.index') }}" class="btn btn-secondary btn-sm mb-2">
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
                    <th>Category</th>
                    <th>Form</th>
                    <th>Strength</th>
                    <th>Price (৳)</th>
                    <th>Stock</th>
                    <th>Expiry</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medicines as $med)
                <tr class="{{ $med->stock_quantity <= $med->reorder_level ? 'table-danger' : '' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <strong>{{ $med->name }}</strong>
                        @if($med->generic_name)
                            <br><small class="text-muted">{{ $med->generic_name }}</small>
                        @endif
                        @if($med->brand)
                            <br><small class="text-muted">{{ $med->brand }}</small>
                        @endif
                    </td>
                    <td><span class="badge badge-info">{{ $med->category->name }}</span></td>
                    <td>{{ ucfirst($med->dosage_form) }}</td>
                    <td>{{ $med->strength ?? '—' }}</td>
                    <td>{{ number_format($med->price, 2) }}</td>
                    <td>
                        @if($med->stock_quantity <= $med->reorder_level)
                            <span class="badge badge-danger">{{ $med->stock_quantity }} ⚠</span>
                        @else
                            <span class="badge badge-success">{{ $med->stock_quantity }}</span>
                        @endif
                    </td>
                    <td>
                        @php $expiry = \Carbon\Carbon::parse($med->expiry_date); @endphp
                        <span class="badge {{ $expiry->isPast() ? 'badge-dark' : ($expiry->diffInDays() < 90 ? 'badge-warning' : 'badge-secondary') }}">
                            {{ $expiry->format('d M Y') }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('medicines.show', $med) }}"
                           class="btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('medicines.edit', $med) }}"
                           class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('medicines.destroy', $med) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Delete {{ $med->name }}?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">
                        No medicines found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        {{ $medicines->links() }}
    </div>
</div>
@endsection