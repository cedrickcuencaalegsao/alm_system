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
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Search books...">
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
                        <i class="bi bi-book-half me-2"></i>
                        BookHaven
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
        <div class="notification-toast error-toast" id="errorToast">
            <div class="toast-header">
                <i class="bi bi-exclamation-circle-fill text-danger me-2"></i>
                <strong class="text-danger">Error</strong>
                <button type="button" class="btn-close-custom ms-auto" onclick="closeToast('errorToast')">
                    <span class="me-1 text-danger">Close</span>
                    <i class="bi bi-x-lg text-danger"></i>
                </button>
            </div>
            <div class="toast-body">
                <div class="toast-message">{{ session('error') }}</div>
            </div>
        </div>
    @endif

    <style>
        .category-container {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 1rem 0;
            height: calc(100vh - 150px);
            /* Adjust based on header height */
        }

        .scrollable-categories {
            flex-grow: 1;
            overflow-y: auto;
            padding-right: 5px;
            margin-top: 1rem;
            padding-left: 5px;
            padding-bottom: 1rem;
            padding-top: 5px;
        }

        .scrollable-categories::-webkit-scrollbar {
            width: 4px;
        }

        .scrollable-categories::-webkit-scrollbar-track {
            background: rgba(241, 241, 241, 0.5);
            border-radius: 10px;
        }

        .scrollable-categories::-webkit-scrollbar-thumb {
            background: rgba(139, 69, 19, 0.5);
            border-radius: 10px;
        }

        .scrollable-categories::-webkit-scrollbar-thumb:hover {
            background: #8B4513;
        }

        .category-btn a.active {
            background-color: #8B4513;
            color: white;
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
            padding: 0.5rem;
        }

        .dropdown-item {
            padding: 0.7rem 1rem;
            color: #666;
            transition: all 0.2s ease;
            border-radius: 8px;
            margin-bottom: 0.2rem;
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

        .cart-badge {
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.7rem;
            font-weight: 500;
            margin-left: 0.5rem;
        }

        .category-btn {
            width: 100%;
            margin-bottom: 0.75rem;
            position: relative;
            padding-top: 10px;
            padding-right: 10px;
        }

        .category-btn a {
            width: 100%;
            background-color: rgba(253, 245, 230, 0.5);
            border: 1px solid rgba(139, 69, 19, 0.2);
            color: #8B4513;
            padding: 0.85rem 1rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
            position: relative;
            overflow: visible;
        }

        .category-btn a:hover,
        .category-btn a.active {
            background-color: #8B4513;
            color: white;
            border-color: #8B4513;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(139, 69, 19, 0.2);
        }

        .category-title {
            color: inherit;
            font-size: 0.95rem;
            font-weight: 500;
            margin: 0 0.5rem;
        }

        .category-badge {
            background-color: #dc3545;
            color: white;
            padding: 0.25rem 0.7rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            position: absolute;
            top: -5px;
            right: -5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            min-width: 24px;
            text-align: center;
            line-height: 1;
            z-index: 2;
        }

        .category-btn a:hover .category-badge,
        .category-btn a.active .category-badge {
            background-color: #c82333;
        }

        .category-btn .bi {
            font-size: 1rem;
            color: inherit;
            opacity: 0.9;
        }

        .category-divider {
            margin: 1rem 0;
            padding: 0 0.5rem;
            position: relative;
            text-align: left;
        }

        .category-divider span {
            display: inline-block;
            font-size: 0.8rem;
            color: #8B4513;
            letter-spacing: 0.5px;
            font-weight: 500;
            opacity: 0.7;
            background: #FDF5E6;
            padding-right: 0.75rem;
            position: relative;
            z-index: 1;
        }

        .category-divider::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: rgba(139, 69, 19, 0.15);
            z-index: 0;
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

        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .sidebar-wrapper {
                width: 100%;
                position: relative;
                min-height: auto;
                padding: 1rem;
                border-right: none;
                border-bottom: 1px solid rgba(139, 69, 19, 0.1);
            }

            .main-content {
                width: 100%;
                margin-left: 0;
                margin-top: 0;
                padding: 1rem;
            }

            .search-wrapper {
                width: 100%;
                padding: 1rem;
                position: relative;
            }

            .search-container {
                max-width: 100%;
                margin-right: 0;
            }

            .action-btn {
                width: 40px;
                height: 40px;
                background-color: #FDF5E6;
                color: #8B4513;
                border: none;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .action-btn i {
                font-size: 1.2rem;
            }

            .dropdown-menu {
                width: 100%;
                margin-top: 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .search-wrapper {
                padding: 0.75rem;
            }

            .search-container .form-control {
                padding: 0.6rem 0.9rem;
            }

            .action-btn {
                width: 35px;
                height: 35px;
            }

            .action-btn i {
                font-size: 1.1rem;
            }
        }

        /* Success Modal Styles */
        .success-modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }

        .success-icon-circle {
            width: 80px;
            height: 80px;
            background-color: #d4edda;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .success-icon-circle i {
            font-size: 40px;
            color: #28a745;
        }

        .success-message {
            font-size: 1.1rem;
            color: #333;
            margin-top: 15px;
        }

        .modal-footer {
            border-top: none;
            justify-content: center;
        }

        .btn-success {
            background-color: #8B4513;
            border-color: #8B4513;
        }

        .btn-success:hover {
            background-color: #693310;
            border-color: #693310;
        }

        /* Toast Notification Styles */
        .notification-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 2000;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 350px;
            overflow: hidden;
            animation: slideInRight 0.5s ease-out;
        }

        @keyframes slideInRight {
            0% {
                transform: translateX(100%);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .notification-toast .toast-header {
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .notification-toast .toast-body {
            padding: 1rem;
        }

        .notification-toast .toast-message {
            font-size: 0.95rem;
        }

        .success-toast {
            border-left: 4px solid #28a745;
        }

        .error-toast {
            border-left: 4px solid #dc3545;
        }

        .btn-close-custom {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            font-size: 0.85rem;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('section[id]');
            const categoryLinks = document.querySelectorAll('.category-link');

            // Show success modal on page load if success message exists
            const successModal = document.getElementById('successModal');
            if (successModal) {
                const modal = new bootstrap.Modal(successModal);
                modal.show();
            }

            // Function to update active state
            function updateActiveLink() {
                let current = '';

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (pageYOffset >= (sectionTop - 300)) {
                        current = '#' + section.getAttribute('id');
                    }
                });

                categoryLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === current) {
                        link.classList.add('active');
                    }
                });
            }

            // Update active state on scroll
            window.addEventListener('scroll', updateActiveLink);

            // Update active state on page load
            updateActiveLink();

            // Handle click events on category links
            categoryLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetSection = document.querySelector(targetId);

                    if (targetSection) {
                        const offsetTop = targetSection.offsetTop - 100; // Adjust offset as needed
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });

                        // Update active state
                        categoryLinks.forEach(l => l.classList.remove('active'));
                        this.classList.add('active');
                    }
                });
            });
        });

        function closeToast(toastId) {
            const toast = document.getElementById(toastId);
            if (toast) {
                toast.style.animation = 'slideOutRight 0.5s ease-out forwards';
                setTimeout(() => {
                    toast.remove();
                }, 500);
            }
        }

        // Auto-close toasts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const toasts = document.querySelectorAll('.notification-toast');
            toasts.forEach(toast => {
                setTimeout(() => {
                    if (toast) {
                        toast.style.animation = 'slideOutRight 0.5s ease-out forwards';
                        setTimeout(() => {
                            toast.remove();
                        }, 500);
                    }
                }, 5000);
            });
        });

        // Add slideOutRight animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideOutRight {
                0% {
                    transform: translateX(0);
                    opacity: 1;
                }
                100% {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
