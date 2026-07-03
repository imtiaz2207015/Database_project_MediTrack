@extends('layouts.app')
@section('title', 'Reports')

@section('content')
<div class="row">

    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar mr-2"></i>Monthly Sales Report
                </h3>
            </div>
            <div class="card-body">
                <p class="text-muted">View total sales, revenue and discounts broken down by day and payment method.</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('reports.monthly-sales') }}" class="btn btn-primary btn-block">
                    <i class="fas fa-eye mr-1"></i> View Report
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-trophy mr-2"></i>Top Selling Medicines
                </h3>
            </div>
            <div class="card-body">
                <p class="text-muted">Find the most sold medicines by quantity and revenue.</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('reports.top-medicines') }}" class="btn btn-success btn-block">
                    <i class="fas fa-eye mr-1"></i> View Report
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i>Top Customers
                </h3>
            </div>
            <div class="card-body">
                <p class="text-muted">See which customers have spent the most and how often they order.</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('reports.top-customers') }}" class="btn btn-info btn-block">
                    <i class="fas fa-eye mr-1"></i> View Report
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-boxes mr-2"></i>Low Stock Report
                </h3>
            </div>
            <div class="card-body">
                <p class="text-muted">Medicines that have dropped at or below their reorder level.</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('reports.stock') }}" class="btn btn-warning btn-block">
                    <i class="fas fa-eye mr-1"></i> View Report
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-truck mr-2"></i>Supplier Purchase Report
                </h3>
            </div>
            <div class="card-body">
                <p class="text-muted">Total purchases and medicines supplied per supplier.</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('reports.suppliers') }}" class="btn btn-danger btn-block">
                    <i class="fas fa-eye mr-1"></i> View Report
                </a>
            </div>
        </div>
    </div>

</div>
@endsection