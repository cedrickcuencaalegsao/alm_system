<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookStore | @yield('title')</title>
    <!-- Add Bootstrap CSS and Icons -->
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
            <button class="btn action-btn ms-3">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </div>
</div>
    <div class="row">
        <!-- Category Sidebar -->
        <div class="sidebar-wrapper" style="background-color: #FDF5E6;">
            <div class="sidebar-title mb-4">
                <h4 class="fw-bold text-center" style="color: #8B4513;">
                    <i class="bi bi-book-half me-2"></i>
                    BookStore
                </h4>
            </div>
            <div class="category-container">
                <div class="text-center small text-muted">Category List</div>
                <!-- All Books -->
                <div class="category-btn">
                    <button class="btn active">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-collection me-2"></i>
                                <span class="category-title">All Books</span>
                                <span class="category-badge">124</span>
                            </div>
                        </div>
                    </button>
                </div>

                <!-- Fiction -->
                <div class="category-btn">
                    <button class="btn">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-book me-2"></i>
                                <span class="category-title">Fiction</span>
                                <span class="category-badge">45</span>
                            </div>
                        </div>
                    </button>
                </div>
                <div class="category-btn">
                    <button class="btn">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-book me-2"></i>
                                <span class="category-title">Fiction</span>
                                <span class="category-badge">45</span>
                            </div>
                        </div>
                    </button>
                </div>
                <div class="category-btn">
                    <button class="btn">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-book me-2"></i>
                                <span class="category-title">Fiction</span>
                                <span class="category-badge">45</span>
                            </div>
                        </div>
                    </button>
                </div>
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
.sidebar-wrapper {
    width: 15%;
    min-height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    padding: 1.5rem 1rem;
}

/* .sidebar-title {
    padding: 1rem 0;
    border-bottom: 2px solid rgba(139, 69, 19, 0.1);
} */

.sidebar-title h4 {
    margin-bottom: 0.5rem;
}

.sidebar-title .bi {
    font-size: 1.2rem;
    opacity: 1;
}

.category-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    padding: 1rem 0;
}

.category-btn {
    width: 100%;
    margin-bottom: 0.5rem;
}

.category-btn button {
    width: 100%;
    background: transparent;
    border: none;
    padding: 15px 20px;
    transition: all 0.2s ease;
    border-radius: 50px;
    box-shadow: 0 2px 4px rgba(139, 69, 19, 0.05); 
}

.category-badge {
    background-color: rgba(139, 69, 19, 0.1);
    color: #8B4513;
    padding: 4px 12px;
    border-radius: 20px; 
    font-size: 0.75rem;
    font-weight: 500;
    min-width: 32px;
    text-align: center;
}

.category-btn button:hover, 
.category-btn button.active {
    background-color: rgba(222, 184, 135, 0.2);
    transform: translateX(5px);
}

.category-title {
    color: #666;
    font-weight: 500;
    font-size: 0.95rem;
}

.category-badge {
    background-color: rgba(139, 69, 19, 0.1);
    color: #8B4513;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
    min-width: 32px;
    text-align: center;
}

.bi {
    font-size: 1rem;
    color: #8B4513;
    opacity: 0.7;
}

.category-btn button:hover, 
.category-btn button.active {
    background-color: rgba(222, 184, 135, 0.2);
}

.category-btn button:hover .category-title,
.category-btn button.active .category-title {
    color: #8B4513;
}

.category-btn button:hover .bi,
.category-btn button.active .bi {
    opacity: 1;
}

.main-content {
    margin-top:80px;
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
