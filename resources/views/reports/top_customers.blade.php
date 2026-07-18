@extends('layouts.app')

@section('title', 'Top Customers Report')

@section('content_header')
    <h1>Top Customers</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header" style="background-color: #2e7d8c; color: white;">
        <h3 class="card-title">Top {{ $limit }} Customers by Spend</h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Total Orders</th>
                    <th>Total Spent</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $index => $customer)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->total_orders }}</td>
                        <td>${{ number_format($customer->total_spent, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No customer data available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<a href="{{ route('reports.index') }}" class="btn btn-secondary">← Back to Reports</a>
@stop