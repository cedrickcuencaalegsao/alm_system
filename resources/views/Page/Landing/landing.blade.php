@extends('shared.layout.guess')

@section('title', 'Home')

@include('shared.css.landingPage')
@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#" aria-label="BookHaven Home">BookHaven</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home" aria-current="page">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#books">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-brown" href="{{ route('login.page') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="display-4 fw-bold mb-4">Discover Your Next Great Read</h1>
                    <p class="lead mb-5">Explore our carefully curated collection of books, from timeless classics to
                        contemporary masterpieces.</p>
                    <div class="d-flex gap-3">
                        <a href="#books" class="btn btn-brown">Browse Books</a>
                        <a href="#about" class="btn btn-outline-dark">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ route('login.image') }}" alt="Books Collection" class="img-fluid rounded-4 shadow"
                        loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Bestselling Books Section -->
    <section class="py-5" id="books">
        <div class="container">
            <h2 class="text-center mb-5">Bestselling Books</h2>
            <div class="row g-4">
                @foreach ($bestSellingBooks as $book)
                    <div class="col-md-3">
                        <div class="card book-card h-100">
                            <div class="position-relative overflow-hidden">
                                <img src=" {{ route('default.image') }}" class="card-img-top" alt="{{ $book['bookname'] }}"
                                    loading="lazy" onerror="this.classList.add('book-img-skeleton'); this.onerror=null;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $book['bookname'] }}</h5>
                                <p class="card-text text-muted">{{ $book['author'] }}</p>
                                <span class="price-badge">${{ number_format($book['bookprice'], 2) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-4">About BookHaven</h2>
                    <p class="lead mb-5">BookHaven is a modern library management system designed to streamline the
                        process of book lending, tracking, and discovery for both readers and administrators.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="about-card text-center">
                        <i class="bi bi-book about-icon"></i>
                        <h4>Digital Catalog</h4>
                        <p>Access our extensive collection of books through an intuitive digital catalog system.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="about-card text-center">
                        <i class="bi bi-people about-icon"></i>
                        <h4>User-Friendly</h4>
                        <p>Easy-to-use interface for borrowing, returning, and managing your reading journey.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="about-card text-center">
                        <i class="bi bi-graph-up about-icon"></i>
                        <h4>Smart Analytics</h4>
                        <p>Track your reading history and get personalized book recommendations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark text-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5 class="mb-3">Contact Us</h5>
                    <div class="footer-contact">
                        <p><i class="bi bi-envelope-fill me-2"></i>
                            <a href="mailto:contact@bookhaven.com">contact@bookhaven.com</a>
                        </p>
                        <p><i class="bi bi-envelope-fill me-2"></i>
                            <a href="mailto:support@bookhaven.com">support@bookhaven.com</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <h5 class="mb-3">Follow Us</h5>
                    <div class="footer-social-links d-flex justify-content-center">
                        <a href="#" target="_blank" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" target="_blank" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" target="_blank" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" target="_blank" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <h5 class="mb-3">BookHaven</h5>
                    <p class="mb-0">&copy; 2025 BookHaven.</p>
                    <small>All rights reserved.</small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to top button -->
    <a href="#" class="back-to-top" aria-label="Back to top">
        <i class="bi bi-arrow-up"></i>
    </a>

    <!-- Custom JavaScript -->
    @include('shared.js.landingPage')
@endsection
