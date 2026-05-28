@extends('layouts.app')
@section('title', 'Prescriptions')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <i class="fas fa-file-medical mr-2"></i>All Prescriptions
        </h3>
        <a href="{{ route('prescriptions.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Prescription
        </a>
    </div>

    <div class="card-body border-bottom pb-3">
        <form method="GET" action="{{ route('prescriptions.index') }}" class="form-inline flex-wrap">
            <input type="text" name="search" class="form-control form-control-sm mr-2 mb-2"
                   placeholder="Search doctor or customer..." value="{{ request('search') }}">
            <input type="date" name="date_from" class="form-control form-control-sm mr-2 mb-2"
                   value="{{ request('date_from') }}">
            <input type="date" name="date_to" class="form-control form-control-sm mr-2 mb-2"
                   value="{{ request('date_to') }}">
            <button type="submit" class="btn btn-info btn-sm mr-2 mb-2">
                <i class="fas fa-search"></i> Search
            </button>
            <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary btn-sm mb-2">
                <i class="fas fa-times"></i> Clear
            </a>
        </form>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Doctor</th>
                    <th>Doctor Phone</th>
                    <th>Linked Sale</th>
                    <th>Prescribed Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prescriptions as $pres)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $pres->customer->name }}</strong></td>
                    <td>
                        <i class="fas fa-user-md mr-1 text-info"></i>
                        {{ $pres->doctor_name }}
                    </td>
                    <td>{{ $pres->doctor_phone ?? '—' }}</td>
                    <td>
                        @if($pres->sale)
                            <span class="badge badge-success">
                                Sale #{{ $pres->sale_id }}
                            </span>
                        @else
                            <span class="badge badge-secondary">No sale linked</span>
                        @endif
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($pres->prescribed_date)->format('d M Y') }}
                    </td>
                    <td>
                        <a href="{{ route('prescriptions.show', $pres) }}"
                           class="btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('prescriptions.edit', $pres) }}"
                           class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('prescriptions.destroy', $pres) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this prescription?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        No prescriptions found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $prescriptions->links() }}</div>
</div>
@endsection