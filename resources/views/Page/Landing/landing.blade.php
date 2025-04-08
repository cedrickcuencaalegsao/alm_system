<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHaven - Your Literary Haven</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-brown: #8B4513;
            --light-brown: #DEB887;
            --dark-brown: #654321;
            --subtle-brown: #F5DEB3;
            --text-brown: #3E2723;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            color: var(--text-brown);
        }

        /* Navbar Styles */
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: var(--primary-brown);
            font-weight: 700;
            font-size: 1.5rem;
        }

        .nav-link {
            color: var(--text-brown);
            font-weight: 500;
        }

        .nav-link:hover {
            color: var(--primary-brown);
        }

        .nav-link.btn-brown {
            color: var(--primary-brown);
            background-color: transparent;
            padding: 10px 30px;
            border-radius: 8px;
            transition: all 0.25s ease;
            font-weight: 500;
            font-size: 0.95rem;
            border: 1.5px solid var(--primary-brown);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .nav-link.btn-brown:hover {
            background-color: var(--primary-brown);
            color: white;
            box-shadow: 0 4px 12px rgba(139, 69, 19, 0.2);
            transform: translateY(-2px);
        }

        .nav-link.btn-brown:active {
            transform: translateY(0);
            box-shadow: 0 2px 6px rgba(139, 69, 19, 0.1);
        }

        /* Hero Section */
        .hero-section {
            background-color: var(--subtle-brown);
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: linear-gradient(45deg, rgba(139, 69, 19, 0.1), transparent);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        /* Button Styles */
        .btn-brown {
            background-color: var(--primary-brown);
            border: none;
            color: white;
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-brown:hover {
            background-color: var(--dark-brown);
            color: white;
            transform: translateY(-2px);
        }

        /* Card Styles */
        .book-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 12px;
            overflow: hidden;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .price {
            color: var(--primary-brown);
            font-size: 1.25rem;
            font-weight: 600;
        }

        /* Add to existing styles */
        .price-badge {
            background-color: var(--subtle-brown);
            color: var(--primary-brown);
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
            margin-top: 8px;
        }

        .book-card .card-body {
            padding: 1.5rem;
        }

        .book-card .card-title {
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .book-card .text-muted {
            font-size: 0.9rem;
        }

        /* Features Section */
        .feature-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background-color: var(--subtle-brown);
            color: var(--primary-brown);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .price-badge {
            background-color: var(--subtle-brown);
            color: var(--primary-brown);
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
            margin-top: 8px;
        }

        .book-card .card-body {
            padding: 1.5rem;
        }

        .book-card .card-title {
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .book-card .text-muted {
            font-size: 0.9rem;
        }

        .footer-social-links a {
            color: white;
            font-size: 1.5rem;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .footer-social-links a:hover {
            color: var(--subtle-brown);
        }

        .footer-contact {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 1rem;
        }

        .footer-contact a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-contact a:hover {
            color: var(--subtle-brown);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">BookHaven</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
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
                    <img src="{{ route('login.image') }}" alt="Books Collection" class="img-fluid rounded-4 shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Bestselling Books Section -->
    <section class="py-5" id="books">
        <div class="container">
            <h2 class="text-center mb-5">Bestselling Books</h2>
            <div class="row g-4">

                <div class="col-md-3">
                    <div class="card book-card h-100">
                        <img src="{{ route('login.image') }}" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="card-title">The Great Adventure</h5>
                            <p class="card-text text-muted">John Doe</p>
                            <span class="price-badge">$19.99</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card book-card h-100">
                        <img src="{{ route('login.image') }}" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="card-title">The Great Adventure</h5>
                            <p class="card-text text-muted">John Doe</p>
                            <span class="price-badge">$19.99</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card book-card h-100">
                        <img src="{{ route('login.image') }}" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="card-title">The Great Adventure</h5>
                            <p class="card-text text-muted">John Doe</p>
                            <span class="price-badge">$19.99</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card book-card h-100">
                        <img src="{{ route('login.image') }}" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="card-title">The Great Adventure</h5>
                            <p class="card-text text-muted">John Doe</p>
                            <span class="price-badge">$19.99</span>
                        </div>
                    </div>
                </div>


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
                    <div class="footer-social-links">
                        <a href="#" target="_blank"><i class="bi bi-facebook"></i></a>
                        <a href="#" target="_blank"><i class="bi bi-twitter"></i></a>
                        <a href="#" target="_blank"><i class="bi bi-instagram"></i></a>
                        <a href="#" target="_blank"><i class="bi bi-linkedin"></i></a>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
