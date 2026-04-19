<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Booking App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fb;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .card {
            border-radius: 14px;
        }

        .table thead th {
            white-space: nowrap;
        }

        .stat-card {
            border: 0;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            border-radius: 14px;
        }

        .soft-badge {
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 999px;
        }

        .nav-link.active-link {
            font-weight: 700;
            color: #fff !important;
            border-bottom: 2px solid #fff;
        }

        .page-title {
            font-weight: 700;
            margin-bottom: 0;
        }

        .toolbar-card {
            border: 0;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            border-radius: 14px;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }

        .empty-state h5 {
            margin-top: 12px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">Vehicle Booking</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                @auth
                    <ul class="navbar-nav ms-auto align-items-lg-center">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('dashboard') ? 'active-link' : '' }}" href="/dashboard">Dashboard</a>
                        </li>

                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('vehicles*') ? 'active-link' : '' }}" href="/vehicles">Vehicles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('drivers*') ? 'active-link' : '' }}" href="/drivers">Drivers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('bookings*') ? 'active-link' : '' }}" href="/bookings">Bookings</a>
                            </li>
                        @endif

                        @if(auth()->user()->role === 'approver')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('approvals*') ? 'active-link' : '' }}" href="/approvals">Approvals</a>
                            </li>
                        @endif

                        <li class="nav-item ms-lg-3">
                            <span class="badge bg-secondary soft-badge">
                                {{ auth()->user()->name }} - {{ ucfirst(auth()->user()->role) }}
                            </span>
                        </li>

                        <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
                            </form>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>