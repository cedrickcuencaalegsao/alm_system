<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookHaven | @yield('title')</title>
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-fluid">
        <!-- Search Bar -->
        <div class="search-wrapper">
            <div class="d-flex align-items-center justify-content-between">
                <div class="search-container">
                    <div class="input-group">
                        <span class="input-group-text border-0" style="background-color: #FDF5E6;">
                            <i class="bi bi-search" style="color: #8B4513;"></i>
                        </span>
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Search books...">
                    </div>
                </div>

                <div class="action-buttons">
                    <button class="btn action-btn position-relative">
                        <i class="bi bi-cart3"></i>
                        <span class="cart-badge">3</span>
                    </button>
                    <div class="dropdown">
                        <button class="btn action-btn ms-3" type="button" id="profileDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-list"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-person me-2"></i>Profile
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
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
            </div>
        </div>
        <div class="row">
            <!-- Category Sidebar -->
            <div class="sidebar-wrapper" style="background-color: #FDF5E6;">
                <div class="sidebar-title mb-4">
                    <h4 class="fw-bold text-center" style="color: #8B4513;">
                        <i class="bi bi-book-half me-2"></i>
                        BookHaven
                    </h4>
                </div>
                <div class="category-container">
                    <div class="text-center small text-muted">Category List</div>
                    <!-- All Books -->
                    <div class="category-btn">
                        <a href="{{ route('view.home') }}" class="btn {{ !request()->category ? 'active' : '' }}">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-collection me-2"></i>
                                    <span class="category-title">All Books</span>
                                    <span class="category-badge">{{ count($books) }}</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    @foreach ($categories as $categoryName => $count)
                        <div class="category-btn">
                            <a href="{{ route('view.home', ['category' => $categoryName]) }}"
                                class="btn {{ request()->category === $categoryName ? 'active' : '' }}">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-book me-2"></i>
                                        <span class="category-title">{{ $categoryName }}</span>
                                        <span class="category-badge">{{ $count }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <style>
        .search-wrapper {
            position: fixed;
            top: 0;
            right: 0;
            width: 85%;
            padding: 1rem 2rem;
            background-color: white;
            z-index: 1000;
            border-bottom: 1px solid rgba(139, 69, 19, 0.1);
        }

        .search-container {
            width: 400px;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .action-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #FDF5E6;
            color: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            border: none;
        }

        .action-btn:hover {
            background-color: rgba(0, 0, 0, 0.05);
            color: #000;
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.7rem;
            font-weight: 500;
        }

        .search-wrapper {
            position: fixed;
            top: 0;
            right: 0;
            width: 85%;
            padding: 1rem 2rem;
            background-color: white;
            z-index: 1000;
            border-bottom: 1px solid rgba(139, 69, 19, 0.1);
        }

        .search-container {
            max-width: 400px;
            margin-right: 1rem;
        }

        .search-container .input-group {
            background-color: #FDF5E6;
            border-radius: 50px;
            overflow: hidden;
        }

        .search-container .form-control {
            background-color: #FDF5E6;
            padding: 0.7rem 1rem;
        }

        .search-container .form-control:focus {
            background-color: #FDF5E6;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 10px;
        }

        .dropdown-item {
            padding: 8px 20px;
            color: #666;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #FDF5E6;
            color: #8B4513;
        }

        .dropdown-item.text-danger:hover {
            background-color: #fff5f5;
        }

        .dropdown-divider {
            margin: 0.5rem 0;
            border-color: rgba(139, 69, 19, 0.1);
        }

        .category-btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .category-btn a {
            width: 100%;
            background-color: transparent;
            border: 1px solid #8B4513;
            color: #8B4513;
            padding: 0.6rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .category-btn a:hover,
        .category-btn a.active {
            background-color: #8B4513;
            color: white;
            transform: translateY(-2px);
        }

        .category-title {
            color: inherit;
            font-size: 0.9rem;
            font-weight: 500;
            margin: 0 0.5rem;
        }

        .category-badge {
            background-color: rgba(139, 69, 19, 0.1);
            color: inherit;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            font-size: 0.75rem;
            margin-left: auto;
        }

        .category-btn .bi {
            font-size: 0.9rem;
            color: inherit;
            opacity: 0.9;
        }

        .category-container {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 1rem 0;
        }

        /* Update sidebar styles to match */
        .sidebar-wrapper {
            width: 15%;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 1.5rem 1rem;
            background-color: white;
            border-right: 1px solid rgba(139, 69, 19, 0.1);
        }

        .sidebar-title h4 {
            margin-bottom: 0.5rem;
        }

        .sidebar-title .bi {
            font-size: 1.2rem;
            opacity: 1;
        }



        .main-content {
            margin-top: 80px;
            margin-left: 15%;
            padding: 2rem;
            min-height: 100vh;
            width: 85%;
        }

        @media (max-width: 768px) {
            .sidebar-wrapper {
                width: 100%;
                position: relative;
            }

            .main-content {
                width: 100%;
                margin-left: 0;
            }
        }
    </style>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
