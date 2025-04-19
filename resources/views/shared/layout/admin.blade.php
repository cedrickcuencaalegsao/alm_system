<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard | @yield('title')</title>
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @include('shared.css.style')
</head>

<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <a class="sidebar-brand" href="{{ route('view.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Admin Panel
            </a>
        </div>

        <div class="sidebar-nav">
            <div class="sidebar-item">
                <a href="{{ route('view.dashboard') }}" class="sidebar-link @if(request()->routeIs('admin.dashboard')) active @endif">
                    <i class="bi bi-house"></i>
                    Dashboard
                </a>
            </div>

            <div class="sidebar-item">
                <a href="#" class="sidebar-link @if(request()->routeIs('admin.users*')) active @endif">
                    <i class="bi bi-people"></i>
                    Users
                </a>
            </div>

            <div class="sidebar-item">
                <a href="#" class="sidebar-link @if(request()->routeIs('admin.products*')) active @endif">
                    <i class="bi bi-box"></i>
                    Products
                    <span class="sidebar-badge">New</span>
                </a>
            </div>

            <div class="sidebar-item">
                <a href="#" class="sidebar-link @if(request()->routeIs('admin.orders*')) active @endif">
                    <i class="bi bi-cart"></i>
                    Orders
                </a>
            </div>

            <div class="sidebar-item">
                <a href="#" class="sidebar-link @if(request()->routeIs('admin.reports*')) active @endif">
                    <i class="bi bi-graph-up"></i>
                    Reports
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="header d-flex align-items-center">
            <button class="toggle-sidebar d-md-none" id="sidebarToggle">
                <i class="bi bi-list fs-4"></i>
            </button>

            <div class="d-flex align-items-center ms-auto">
                <div class="dropdown user-dropdown">
                    <button class="dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-2 d-none d-lg-inline-block">{{ Auth::user()->name ?? 'Administrator' }}</span>
                        <i class="bi bi-person-circle fs-5"></i>
                    </button>
                    <ul class="dropdown-menu shadow" aria-labelledby="userDropdown">
                        <li>
                            <div class="dropdown-item fw-bold text-muted small py-2">
                                <span>Signed in as</span><br>
                                <strong>{{ Auth::user()->email ?? 'admin@example.com' }}</strong>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="content">
            <!-- Page Header -->
            <div class="mb-4">
                <h3 class="mb-2">@yield('page-title', 'Dashboard')</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        @yield('breadcrumbs')
                    </ol>
                </nav>
            </div>

            <!-- Content Area -->
            @yield('content')
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="5000">
            <div class="toast-header bg-success text-white">
                <i class="bi bi-check-circle me-2"></i>
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif

    <!-- Error Alert -->
    @if(session('error'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="5000">
            <div class="toast-header bg-danger text-white">
                <i class="bi bi-exclamation-circle me-2"></i>
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('error') }}
            </div>
        </div>
    </div>
    @endif

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @include('shared.js.script')
</body>
</html>
