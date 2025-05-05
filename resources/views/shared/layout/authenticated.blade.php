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
        <div class="search-wrapper">
            <div class="d-flex align-items-center justify-content-between">
                <div class="search-container">
                    <div class="input-group">
                        <span class="input-group-text border-0" style="background-color: #FDF5E6;">
                            <i class="bi bi-search" style="color: #8B4513;"></i>
                        </span>
                        <form action="{{ route('search') }}" method="GET">
                            <input type="text" class="form-control border-0 shadow-none"
                                placeholder="Search books..." name="query">
                        </form>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btn action-btn" type="button" id="profileDropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-list"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('view.profile', encrypt(Auth::user()->userID)) }}">
                                <i class="bi bi-person me-2"></i>Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('view.cart', encrypt(Auth::user()->userID)) }}">
                                <i class="bi bi-cart3 me-2"></i>Cart
                                <span class="cart-badge">{{ $cartCount ?? 0 }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('view.orders', encrypt(Auth::user()->userID)) }}">
                                <i class="bi bi-box-seam me-2"></i>Orders
                                <span class="cart-badge">{{ $userOrders ?? 0 }}</span>
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
        <div class="row">
            <div class="sidebar-wrapper" style="background-color: #FDF5E6;">
                <div class="sidebar-title mb-4">
                    <h4 class="fw-bold text-center" style="color: #8B4513;">
                        <a href="{{ route('view.home') }}" style="text-decoration: none; color: #8B4513;">
                            <i class="bi bi-book-half me-2"></i>
                            BookHaven
                        </a>
                    </h4>
                </div>
                <div class="category-container">
                    <div class="text-center small text-muted mb-2">Category List</div>
                    <div class="scrollable-categories">
                        <div class="category-btn mt-2">
                            <a href="#best-selling" class="btn category-link" data-section="best-selling">
                                <div class="d-flex align-items-center w-100">
                                    <i class="bi bi-star me-2"></i>
                                    <span class="category-title">Best Sellers</span>
                                </div>
                                <span class="category-badge">{{ count($books['bestSelling']) }}</span>
                            </a>
                        </div>

                        <div class="category-btn">
                            <a href="#all-books" class="btn category-link" data-section="all-books">
                                <div class="d-flex align-items-center w-100">
                                    <i class="bi bi-collection me-2"></i>
                                    <span class="category-title">All Books</span>
                                </div>
                                <span class="category-badge">{{ count($books['allBooks']) }}</span>
                            </a>
                        </div>

                        <div class="category-divider my-3">
                            <span class="text-muted small">Book Categories</span>
                        </div>

                        @foreach ($books['byCategory'] as $categoryName => $categoryBooks)
                            <div class="category-btn">
                                <a href="#category-{{ Str::slug($categoryName) }}" class="btn category-link"
                                    data-section="category-{{ Str::slug($categoryName) }}">
                                    <div class="d-flex align-items-center w-100">
                                        <i class="bi bi-book me-2"></i>
                                        <span class="category-title">{{ $categoryName }}</span>
                                    </div>
                                    <span class="category-badge">{{ count($categoryBooks) }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    @if (session('success'))
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header success-modal-header">
                        <h5 class="modal-title" id="successModalLabel">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>Success
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <div class="success-icon-circle">
                                <i class="bi bi-check-lg"></i>
                            </div>
                        </div>
                        <p class="success-message text-center">{{ session('success') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Continue
                            Shopping</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Error Toast -->
    @if (session('error'))
        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header error-modal-header">
                        <h5 class="modal-title" id="errorModalLabel">
                            <i class="bi bi-x-circle-fill text-danger me-2"></i>Error
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <div class="error-icon-circle">
                                <i class="bi bi-x-lg"></i>
                            </div>
                        </div>
                        <p class="error-message text-center">{{ session('error') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close Error</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('shared.css.authenticated')
    @include('shared.js.authenticated')
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
`
