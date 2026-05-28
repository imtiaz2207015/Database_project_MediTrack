<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediTrack | @yield('title')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">

    <style>
        /* ── Base Font ── */
        * { font-family: 'Inter', sans-serif; }
        h1,h2,h3,h4,h5,h6,
        .brand-text,
        .nav-sidebar .nav-link p { font-family: 'Poppins', sans-serif; }

        /* ── Sidebar ── */
        .main-sidebar {
            background: linear-gradient(180deg, #1e2a3a 0%, #162032 100%) !important;
            box-shadow: 3px 0 15px rgba(0,0,0,0.2);
        }
        .brand-link {
            background: linear-gradient(135deg, #2e7d8c, #1a5276) !important;
            border-bottom: 1px solid rgba(255,255,255,0.1) !important;
            padding: 18px 15px !important;
        }
        .brand-text {
            font-size: 1.3rem !important;
            letter-spacing: 1px;
            color: #e8f4f8 !important;
        }

        /* Sidebar nav links */
        .nav-sidebar .nav-link {
            color: #a8c4d0 !important;
            border-radius: 8px !important;
            margin: 2px 8px !important;
            transition: all 0.25s ease;
        }
        .nav-sidebar .nav-link:hover {
            background: rgba(46,125,140,0.25) !important;
            color: #e8f4f8 !important;
            transform: translateX(3px);
        }
        .nav-sidebar .nav-link.active {
            background: linear-gradient(135deg, #2e7d8c, #1a6b7a) !important;
            color: #ffffff !important;
            box-shadow: 0 3px 10px rgba(46,125,140,0.4);
        }
        .nav-sidebar .nav-link .nav-icon { color: inherit !important; }
        .nav-header {
            color: #5a8a99 !important;
            font-size: 0.68rem !important;
            letter-spacing: 1.5px;
            padding: 12px 16px 4px !important;
        }

        /* User panel */
        .user-panel {
            border-bottom: 1px solid rgba(255,255,255,0.07) !important;
        }
        .user-panel .info a {
            color: #c8dfe8 !important;
            font-size: 0.9rem;
        }

        /* ── Top Navbar ── */
        .main-header.navbar {
            background: #ffffff !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border-bottom: 1px solid #e8f0f5 !important;
        }
        .main-header .nav-link { color: #4a6274 !important; }
        .main-header .nav-link:hover { color: #2e7d8c !important; }

        /* ── Content Area ── */
        .content-wrapper {
            background: #f0f5f8 !important;
        }
        .content-header {
            background: transparent;
            padding: 18px 20px 8px !important;
        }
        .content-header h1 {
            font-size: 1.5rem !important;
            color: #1e2a3a !important;
            font-weight: 600;
        }
        .breadcrumb {
            background: transparent !important;
        }
        .breadcrumb-item a { color: #2e7d8c !important; }
        .breadcrumb-item.active { color: #6c8a96 !important; }

        /* ── Cards ── */
        .card {
            border: none !important;
            border-radius: 12px !important;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07) !important;
            margin-bottom: 20px;
        }
        .card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e8f0f5 !important;
            border-radius: 12px 12px 0 0 !important;
            padding: 14px 20px !important;
        }
        .card-title {
            color: #1e2a3a !important;
            font-weight: 600 !important;
            font-size: 1rem !important;
        }
        .card-footer {
            background: #fafcfd !important;
            border-top: 1px solid #e8f0f5 !important;
            border-radius: 0 0 12px 12px !important;
        }

        /* ── Small Stat Boxes ── */
        .small-box {
            border-radius: 12px !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
            overflow: hidden;
        }
        .small-box h3 {
            font-family: 'Poppins', sans-serif !important;
            font-weight: 700 !important;
        }
        .small-box .icon { opacity: 0.25 !important; }
        .small-box-footer {
            background: rgba(0,0,0,0.12) !important;
            transition: background 0.2s;
        }
        .small-box-footer:hover { background: rgba(0,0,0,0.2) !important; }

        /* Custom box colors */
        .bg-mediblue   { background: linear-gradient(135deg, #2e7d8c, #1a5f6e) !important; color:#fff !important; }
        .bg-medigreen  { background: linear-gradient(135deg, #27ae60, #1e8449) !important; color:#fff !important; }
        .bg-medipurple { background: linear-gradient(135deg, #7d3c98, #6c3483) !important; color:#fff !important; }
        .bg-mediorange { background: linear-gradient(135deg, #e67e22, #ca6f1e) !important; color:#fff !important; }

        /* ── Tables ── */
        .table thead.thead-dark th {
            background: linear-gradient(135deg, #1e2a3a, #2c3e50) !important;
            color: #c8dfe8 !important;
            font-size: 0.8rem !important;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border: none !important;
            font-weight: 500;
        }
        .table tbody tr:hover { background: #eef6f8 !important; }
        .table td { color: #2c3e50 !important; vertical-align: middle !important; }
        .table-striped tbody tr:nth-of-type(odd) { background: #f7fbfc !important; }

        /* ── Buttons ── */
        .btn-primary {
            background: linear-gradient(135deg, #2e7d8c, #1a6b7a) !important;
            border: none !important;
            border-radius: 7px !important;
            font-weight: 500;
            box-shadow: 0 3px 8px rgba(46,125,140,0.3) !important;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #256b79, #145a67) !important;
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(46,125,140,0.4) !important;
        }
        .btn-warning {
            background: linear-gradient(135deg, #f39c12, #d68910) !important;
            border: none !important;
            border-radius: 7px !important;
            color: #fff !important;
        }
        .btn-danger {
            background: linear-gradient(135deg, #e74c3c, #cb4335) !important;
            border: none !important;
            border-radius: 7px !important;
        }
        .btn-info {
            background: linear-gradient(135deg, #2980b9, #1a6fa0) !important;
            border: none !important;
            border-radius: 7px !important;
            color: #fff !important;
        }
        .btn-secondary {
            background: linear-gradient(135deg, #6c8a96, #5a7a86) !important;
            border: none !important;
            border-radius: 7px !important;
            color: #fff !important;
        }
        .btn-success {
            background: linear-gradient(135deg, #27ae60, #1e8449) !important;
            border: none !important;
            border-radius: 7px !important;
        }
        .btn { transition: all 0.2s ease !important; }
        .btn:hover { transform: translateY(-1px); }

        /* ── Badges ── */
        .badge {
            border-radius: 6px !important;
            padding: 4px 8px !important;
            font-weight: 500 !important;
            font-size: 0.75rem !important;
        }

        /* ── Forms ── */
        .form-control {
            border: 1.5px solid #dce8ed !important;
            border-radius: 8px !important;
            color: #2c3e50 !important;
            font-size: 0.9rem !important;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            border-color: #2e7d8c !important;
            box-shadow: 0 0 0 3px rgba(46,125,140,0.15) !important;
        }

        /* ── Alerts ── */
        .alert {
            border: none !important;
            border-radius: 10px !important;
            font-weight: 500;
        }
        .alert-success {
            background: #d4edda !important;
            color: #1e6b30 !important;
        }
        .alert-danger {
            background: #fde8e6 !important;
            color: #922b21 !important;
        }

        /* ── Footer ── */
        .main-footer {
            background: #ffffff !important;
            border-top: 1px solid #e8f0f5 !important;
            color: #6c8a96 !important;
            font-size: 0.85rem;
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f0f5f8; }
        ::-webkit-scrollbar-thumb { background: #2e7d8c; border-radius: 3px; }

        /* ── Card variants ── */
        .card-primary   > .card-header { border-left: 4px solid #2e7d8c !important; }
        .card-success   > .card-header { border-left: 4px solid #27ae60 !important; }
        .card-danger    > .card-header { border-left: 4px solid #e74c3c !important; }
        .card-warning   > .card-header { border-left: 4px solid #f39c12 !important; }
        .card-info      > .card-header { border-left: 4px solid #2980b9 !important; }

        /* ── Pagination ── */
        .page-link {
            color: #2e7d8c !important;
            border-radius: 6px !important;
            margin: 0 2px;
            border-color: #dce8ed !important;
        }
        .page-item.active .page-link {
            background: #2e7d8c !important;
            border-color: #2e7d8c !important;
            color: #fff !important;
        }

        /* ── Smooth transitions ── */
        .content-wrapper,
        .main-sidebar,
        .main-header { transition: all 0.3s ease; }
    </style>

    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    {{-- Top Navbar --}}
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item mr-2">
                <span class="nav-link text-muted" style="font-size:0.85rem">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    {{ now()->format('d M Y') }}
                </span>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-toggle="dropdown">
                    <div style="width:32px;height:32px;background:linear-gradient(135deg,#2e7d8c,#1a5f6e);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:600;font-size:0.85rem;margin-right:8px;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span style="color:#2c3e50;font-weight:500">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right"
                     style="border-radius:10px;border:none;box-shadow:0 5px 20px rgba(0,0,0,0.12)">
                    <div class="px-3 py-2 border-bottom">
                        <small class="text-muted">Signed in as</small>
                        <div style="color:#1e2a3a;font-weight:600">{{ Auth::user()->email }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger mt-1">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    {{-- Sidebar --}}
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <span class="brand-text">
                <i class="fas fa-clinic-medical mr-2"></i>MediTrack
            </span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div style="width:36px;height:36px;background:linear-gradient(135deg,#2e7d8c,#1a5f6e);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:1rem;flex-shrink:0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="info ml-2">
                    <a href="#" class="d-block" style="color:#c8dfe8;font-weight:500;font-size:0.9rem">
                        {{ Auth::user()->name }}
                    </a>
                    <small style="color:#5a8a99">Pharmacist</small>
                </div>
            </div>

            <nav class="mt-1">
                <ul class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-header">INVENTORY</li>

                    <li class="nav-item">
                        <a href="{{ route('medicines.index') }}"
                           class="nav-link {{ request()->routeIs('medicines.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-pills"></i>
                            <p>Medicines</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}"
                           class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Categories</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('suppliers.index') }}"
                           class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>Suppliers</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('stock-adjustments.index') }}"
                           class="nav-link {{ request()->routeIs('stock-adjustments.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>Stock Adjustments</p>
                        </a>
                    </li>

                    <li class="nav-header">REPORTS</li>

                    <li class="nav-item">
                        <a href="{{ route('reports.index') }}"
                         class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                           <i class="nav-icon fas fa-chart-pie"></i>
                           <p>Reports</p>
                       </a>
                    </li>

                    <li class="nav-header">TRANSACTIONS</li>

                    <li class="nav-item">
                        <a href="{{ route('sales.index') }}"
                           class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>Sales</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('purchases.index') }}"
                           class="nav-link {{ request()->routeIs('purchases.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Purchases</p>
                        </a>
                    </li>

                    <li class="nav-header">PEOPLE</li>

                    <li class="nav-item">
                        <a href="{{ route('prescriptions.index') }}"
                          class="nav-link {{ request()->routeIs('prescriptions.*') ? 'active' : '' }}">
                           <i class="nav-icon fas fa-file-medical"></i>
                           <p>Prescriptions</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('customers.index') }}"
                           class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Customers</p>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>

    {{-- Content --}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="fas fa-home"></i> Home
                                </a>
                            </li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <strong>
            <i class="fas fa-clinic-medical mr-1" style="color:#2e7d8c"></i>
            MediTrack Pharmacy Management System
        </strong>
        <div class="float-right">v1.0</div>
    </footer>

    <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>

@stack('scripts')
</body>
</html>