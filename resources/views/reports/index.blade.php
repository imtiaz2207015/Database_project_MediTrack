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
                <p class="text-muted">View total sales, revenue and discounts broken down by month.</p>
                <p><strong>SQL Used:</strong>
                    <code>GROUP BY MONTH, SUM, COUNT</code>
                </p>
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
                <p><strong>SQL Used:</strong>
                    <code>JOIN, GROUP BY, ORDER BY, LIMIT</code>
                </p>
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
                    <i class="fas fa-tags mr-2"></i>Revenue by Category
                </h3>
            </div>
            <div class="card-body">
                <p class="text-muted">See which medicine categories generate the most revenue.</p>
                <p><strong>SQL Used:</strong>
                    <code>JOIN, GROUP BY, SUM</code>
                </p>
            </div>
            <div class="card-footer">
                <a href="{{ route('reports.category-revenue') }}" class="btn btn-info btn-block">
                    <i class="fas fa-eye mr-1"></i> View Report
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-boxes mr-2"></i>Full Stock Report
                </h3>
            </div>
            <div class="card-body">
                <p class="text-muted">Complete stock status with expiry and low stock alerts.</p>
                <p><strong>SQL Used:</strong>
                    <code>CASE WHEN, CURDATE(), DATE_ADD</code>
                </p>
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
                <p class="text-muted">Total spending per supplier and last purchase date.</p>
                <p><strong>SQL Used:</strong>
                    <code>LEFT JOIN, GROUP BY, MAX</code>
                </p>
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