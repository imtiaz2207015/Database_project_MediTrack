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
  * { font-family: 'Inter', sans-serif; }
h1,h2,h3,h4,h5,h6,
.brand-text,
.nav-sidebar .nav-link p { font-family: 'Poppins', sans-serif; }

/* ── Sidebar ── */
.main-sidebar {
    background: linear-gradient(180deg, #1a1f36 0%, #12162a 100%) !important;
    box-shadow: 3px 0 15px rgba(0,0,0,0.3);
}
.brand-link {
    background: linear-gradient(135deg, #1a1f36, #12162a) !important;
    border-bottom: 1px solid rgba(240,192,64,0.2) !important;
    padding: 18px 15px !important;
}
.brand-text {
    font-size: 1.3rem !important;
    letter-spacing: 1px;
    color: #f0c040 !important;
}

.sidebar {
    overflow-y: auto;
    height: calc(100vh - 120px);
}
.sidebar::-webkit-scrollbar { width: 3px; }
.sidebar::-webkit-scrollbar-track { background: transparent; }
.sidebar::-webkit-scrollbar-thumb { background: rgba(240,192,64,0.3); border-radius: 3px; }

.nav-sidebar .nav-link {
    color: #8892b0 !important;
    border-radius: 8px !important;
    margin: 2px 8px !important;
    transition: all 0.25s ease;
}
.nav-sidebar .nav-link:hover {
    background: rgba(240,192,64,0.1) !important;
    color: #f0c040 !important;
    transform: translateX(3px);
}
.nav-sidebar .nav-link.active {
    background: #f0c040 !important;
    color: #1a1f36 !important;
    font-weight: 600;
    box-shadow: 0 3px 10px rgba(240,192,64,0.3);
}
.nav-sidebar .nav-link .nav-icon { color: inherit !important; }
.nav-header {
    color: #f0c040 !important;
    font-size: 0.68rem !important;
    letter-spacing: 1.5px;
    padding: 12px 16px 4px !important;
}

.user-panel {
    border-bottom: 1px solid rgba(240,192,64,0.15) !important;
}
.user-panel .info a { color: #ccd6f6 !important; font-size: 0.9rem; }

/* ── Top Navbar ── */
.main-header.navbar {
    background: #ffffff !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    border-bottom: 1px solid #e8e8e8 !important;
}
.main-header .nav-link { color: #44403c !important; }
.main-header .nav-link:hover { color: #1a1f36 !important; }

/* ── Content Area ── */
.content-wrapper {
    background: #f5f7fa !important;
    overflow-y: auto;
    height: calc(100vh - 57px);
}
.content-wrapper::-webkit-scrollbar { width: 5px; }
.content-wrapper::-webkit-scrollbar-track { background: #f5f7fa; }
.content-wrapper::-webkit-scrollbar-thumb { background: #1a1f36; border-radius: 3px; }

.content-header { background: transparent; padding: 18px 20px 8px !important; }
.content-header h1 { font-size: 1.5rem !important; color: #1a1f36 !important; font-weight: 600; }
.breadcrumb { background: transparent !important; }
.breadcrumb-item a { color: #1a1f36 !important; }
.breadcrumb-item.active { color: #8892b0 !important; }

/* ── Cards ── */
.card {
    border: none !important;
    border-radius: 12px !important;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07) !important;
    margin-bottom: 20px;
}
.card-header {
    background: #ffffff !important;
    border-bottom: 1px solid #e8e8e8 !important;
    border-radius: 12px 12px 0 0 !important;
    padding: 14px 20px !important;
}
.card-title { color: #1a1f36 !important; font-weight: 600 !important; font-size: 1rem !important; }
.card-footer {
    background: #f5f7fa !important;
    border-top: 1px solid #e8e8e8 !important;
    border-radius: 0 0 12px 12px !important;
}

/* ── Stat Boxes ── */
.small-box { border-radius: 12px !important; box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important; overflow: hidden; }
.small-box h3 { font-family: 'Poppins', sans-serif !important; font-weight: 700 !important; }
.small-box .icon { opacity: 0.2 !important; }
.small-box-footer { background: rgba(0,0,0,0.12) !important; transition: background 0.2s; }
.small-box-footer:hover { background: rgba(0,0,0,0.22) !important; }

.bg-mediblue   { background: linear-gradient(135deg, #1a1f36, #2d3561) !important; color:#f0c040 !important; }
.bg-medigreen  { background: linear-gradient(135deg, #f0c040, #d4a020) !important; color:#1a1f36 !important; }
.bg-medipurple { background: linear-gradient(135deg, #2d3561, #1a1f36) !important; color:#fff !important; }
.bg-mediorange { background: linear-gradient(135deg, #dc2626, #b91c1c) !important; color:#fff !important; }

/* ── Tables ── */
.table thead.thead-dark th {
    background: linear-gradient(135deg, #1a1f36, #2d3561) !important;
    color: #f0c040 !important;
    font-size: 0.8rem !important;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    border: none !important;
    font-weight: 500;
}
.table tbody tr:hover { background: #eef0f8 !important; }
.table td { color: #1a1f36 !important; vertical-align: middle !important; }
.table-striped tbody tr:nth-of-type(odd) { background: #f7f8fc !important; }

/* ── Buttons ── */
.btn-primary {
    background: linear-gradient(135deg, #1a1f36, #2d3561) !important;
    border: none !important; border-radius: 7px !important;
    font-weight: 500; color: #f0c040 !important;
    box-shadow: 0 3px 8px rgba(26,31,54,0.3) !important;
}
.btn-primary:hover {
    background: linear-gradient(135deg, #2d3561, #1a1f36) !important;
    transform: translateY(-1px);
    box-shadow: 0 5px 12px rgba(26,31,54,0.4) !important;
}
.btn-warning {
    background: linear-gradient(135deg, #f0c040, #d4a020) !important;
    border: none !important; border-radius: 7px !important; color: #1a1f36 !important;
    font-weight: 600;
}
.btn-danger {
    background: linear-gradient(135deg, #dc2626, #b91c1c) !important;
    border: none !important; border-radius: 7px !important; color: #fff !important;
}
.btn-info {
    background: linear-gradient(135deg, #2d3561, #1a1f36) !important;
    border: none !important; border-radius: 7px !important; color: #f0c040 !important;
}
.btn-secondary {
    background: linear-gradient(135deg, #64748b, #475569) !important;
    border: none !important; border-radius: 7px !important; color: #fff !important;
}
.btn-success {
    background: linear-gradient(135deg, #f0c040, #d4a020) !important;
    border: none !important; border-radius: 7px !important; color: #1a1f36 !important;
    font-weight: 600;
}
.btn { transition: all 0.2s ease !important; }
.btn:hover { transform: translateY(-1px); }

/* ── Badges ── */
.badge { border-radius: 6px !important; padding: 4px 8px !important; font-weight: 500 !important; font-size: 0.75rem !important; }

/* ── Forms ── */
.form-control {
    border: 1.5px solid #dde1f0 !important;
    border-radius: 8px !important;
    color: #1a1f36 !important;
    font-size: 0.9rem !important;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.form-control:focus {
    border-color: #1a1f36 !important;
    box-shadow: 0 0 0 3px rgba(26,31,54,0.12) !important;
}

/* ── Alerts ── */
.alert { border: none !important; border-radius: 10px !important; font-weight: 500; }
.alert-success { background: #fef9e7 !important; color: #78520a !important; }
.alert-danger { background: #fee2e2 !important; color: #991b1b !important; }

/* ── Footer ── */
.main-footer {
    background: #ffffff !important;
    border-top: 1px solid #e8e8e8 !important;
    color: #8892b0 !important;
    font-size: 0.85rem;
}

/* ── Scrollbar ── */
::-webkit-scrollbar { width: 6px; height: 6px; }
::-webkit-scrollbar-track { background: #f5f7fa; }
::-webkit-scrollbar-thumb { background: #1a1f36; border-radius: 3px; }

/* ── Card variants ── */
.card-primary   > .card-header { border-left: 4px solid #1a1f36 !important; }
.card-success   > .card-header { border-left: 4px solid #f0c040 !important; }
.card-danger    > .card-header { border-left: 4px solid #dc2626 !important; }
.card-warning   > .card-header { border-left: 4px solid #f0c040 !important; }
.card-info      > .card-header { border-left: 4px solid #2d3561 !important; }

/* ── Pagination ── */
.page-link { color: #1a1f36 !important; border-radius: 6px !important; margin: 0 2px; border-color: #dde1f0 !important; }
.page-item.active .page-link { background: #1a1f36 !important; border-color: #1a1f36 !important; color: #f0c040 !important; }

/* ── Smooth transitions ── */
.main-sidebar, .main-header { transition: all 0.3s ease; }

/* Fix double scroll */
body.sidebar-mini .content-wrapper { overflow-y: auto !important; height: calc(100vh - 57px) !important; }
body.sidebar-mini .sidebar { overflow-y: auto !important; height: calc(100vh - 120px) !important; }
    </style>

    @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
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
                    <div style="width:32px;height:32px;background:linear-gradient(135deg,#1a1f36,#2d3561);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:600;font-size:0.85rem;margin-right:8px;">
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
<a href="{{ route('profile.edit') }}" class="dropdown-item mt-1">
    <i class="fas fa-user-edit mr-2" style="color:#2e7d8c"></i> My Profile
</a>
<a href="{{ route('profile.edit') }}#update-password-form" class="dropdown-item">
    <i class="fas fa-key mr-2" style="color:#f39c12"></i> Change Password
</a>
<div class="dropdown-divider"></div>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="dropdown-item text-danger">
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
                <div style="width:36px;height:36px;background:linear-gradient(135deg,#1a1f36,#2d3561);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:1rem;flex-shrink:0">
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
            <i class="fas fa-clinic-medical mr-1" style="color:#f0c040"></i>
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

<script>
    $(document).ready(function() {
        // Disable AdminLTE scroll control
        $('body').removeClass('layout-fixed');
        
        // Prevent body from scrolling
        $('body, html').css({
            'overflow': 'hidden',
            'height': '100%'
        });
    });
</script>

@stack('scripts')
</body>
</html>