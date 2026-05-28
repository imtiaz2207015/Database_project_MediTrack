@extends('layouts.app')
@section('title', 'Stock Adjustments')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-boxes mr-2"></i>Stock Adjustments</h3>
        <a href="{{ route('stock-adjustments.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> New Adjustment
        </a>
    </div>

    <div class="card-body border-bottom pb-3">
        <form method="GET" action="{{ route('stock-adjustments.index') }}" class="form-inline">
            <input type="text" name="search" class="form-control form-control-sm mr-2"
                   placeholder="Search medicine..." value="{{ request('search') }}">
            <select name="type" class="form-control form-control-sm mr-2">
                <option value="">All Types</option>
                <option value="increase" {{ request('type') === 'increase' ? 'selected' : '' }}>Increase</option>
                <option value="decrease" {{ request('type') === 'decrease' ? 'selected' : '' }}>Decrease</option>
            </select>
            <button type="submit" class="btn btn-info btn-sm mr-2">
                <i class="fas fa-search"></i> Search
            </button>
            <a href="{{ route('stock-adjustments.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-times"></i> Clear
            </a>
        </form>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Medicine</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Reason</th>
                    <th>Done By</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($adjustments as $adj)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $adj->medicine->name }}</strong></td>
                    <td>
                        @if($adj->type === 'increase')
                            <span class="badge badge-success">
                                <i class="fas fa-arrow-up"></i> Increase
                            </span>
                        @else
                            <span class="badge badge-danger">
                                <i class="fas fa-arrow-down"></i> Decrease
                            </span>
                        @endif
                    </td>
                    <td><strong>{{ $adj->quantity }}</strong></td>
                    <td>{{ $adj->reason ?? '—' }}</td>
                    <td>{{ $adj->user->name ?? '—' }}</td>
                    <td>{{ $adj->created_at->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('stock-adjustments.destroy', $adj) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Delete and reverse this adjustment?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        No adjustments found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $adjustments->links() }}</div>
</div>
@endsection