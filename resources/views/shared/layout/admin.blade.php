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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<style>

</style>

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
                <a href="{{ route('view.dashboard') }}"
                    class="sidebar-link @if (request()->routeIs('admin.dashboard')) active @endif">
                    <i class="bi bi-house"></i>
                    Dashboard
                </a>
            </div>

            <div class="sidebar-item">
                <a href="{{ route('view.manage.user') }}"
                    class="sidebar-link @if (request()->routeIs('admin.users*')) active @endif">
                    <i class="bi bi-people"></i>
                    Users
                </a>
            </div>

            <div class="sidebar-item">
                <a href="{{ route('view.manage.books') }}"
                    class="sidebar-link @if (request()->routeIs('admin.products*')) active @endif">
                    <i class="bi bi-book"></i>
                    Books
                    {{-- <span class="sidebar-badge">New</span> --}}
                </a>
            </div>

            <div class="sidebar-item">
                <a href="{{ route('view.manage.orders') }}"
                    class="sidebar-link @if (request()->routeIs('admin.orders*')) active @endif">
                    <i class="bi bi-cart"></i>
                    Orders
                </a>
            </div>

            <div class="sidebar-item">
                <a href="{{ route('view.manage.reports') }}"
                    class="sidebar-link @if (request()->routeIs('admin.reports*')) active @endif">
                    <i class="bi bi-graph-up"></i>
                    Reports
                </a>
            </div>
            <div class="sidebar-item">
                <form action="{{ route('logout') }}" method="POST" style="margin: 0; padding: 0;">
                    @csrf

                    <button type="submit" class="sidebar-link w-100 text-danger"
                        style="border: none; background: transparent;">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
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
    {{-- @if (session('success'))
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
    @endif --}}

    <!-- Error Alert -->
    @if (session('error'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true"
                data-bs-delay="5000">
                <div class="toast-header bg-danger text-white">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                        aria-label="Close"></button>
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
