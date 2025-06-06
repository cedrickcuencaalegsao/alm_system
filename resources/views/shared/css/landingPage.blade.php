<style>
    :root {
        --primary-brown: #8B4513;
        --light-brown: #DEB887;
        --dark-brown: #654321;
        --subtle-brown: #F5DEB3;
        --text-brown: #3E2723;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-brown);
        line-height: 1.6;
    }

    /* Navbar Styles */
    .navbar {
        background-color: rgba(255, 255, 255, 0.98);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        padding: 12px 0;
    }

    .navbar.scrolled {
        padding: 8px 0;
    }

    .navbar-brand {
        color: var(--primary-brown);
        font-weight: 700;
        font-size: 1.6rem;
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover {
        transform: scale(1.05);
    }

    .nav-link {
        color: var(--text-brown);
        font-weight: 500;
        position: relative;
        padding: 8px 16px;
        transition: color 0.3s ease;
    }

    .nav-link:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: var(--primary-brown);
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .nav-link:hover:after {
        width: 70%;
    }

    .nav-link:hover {
        color: var(--primary-brown);
    }

    .nav-link.btn-brown {
        color: var(--primary-brown);
        background-color: transparent;
        padding: 10px 24px;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 600;
        font-size: 0.95rem;
        border: 2px solid var(--primary-brown);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-left: 8px;
    }

    .nav-link.btn-brown:hover {
        background-color: var(--primary-brown);
        color: white;
        box-shadow: 0 4px 12px rgba(139, 69, 19, 0.3);
        transform: translateY(-3px);
    }

    .nav-link.btn-brown:active {
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(139, 69, 19, 0.2);
    }

    /* Mobile Menu Styles */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            position: fixed;
            top: 0;
            left: -100%;
            width: 80%;
            height: 100vh;
            background-color: #fff;
            padding: 2rem;
            transition: all 0.4s cubic-bezier(0.77, 0, 0.175, 1);
            z-index: 1000;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.15);
            overflow-y: auto;
        }

        .navbar-collapse.show {
            left: 0;
        }

        .navbar-nav {
            margin-top: 3rem;
        }

        .nav-item {
            margin-bottom: 1.2rem;
        }

        .navbar-toggler {
            z-index: 1001;
            border: none;
            padding: 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
            outline: none;
        }

        /* Hamburger animation */
        .navbar-toggler .navbar-toggler-icon {
            transition: all 0.3s ease;
        }

        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
            transform: rotate(90deg);
        }

        /* Overlay when menu is open */
        .navbar-collapse::before {
            content: '';
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.4s ease;
            backdrop-filter: blur(3px);
        }

        .navbar-collapse.show::before {
            opacity: 1;
        }

        .nav-link.btn-brown {
            display: inline-block;
            margin-top: 10px;
            text-align: center;
        }
    }

    /* Hero Section */
    .hero-section {
        background-color: var(--subtle-brown);
        padding: 140px 0 120px;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: url('data:image/svg+xml;utf8,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M96,95 L4,95 L4,5 L96,5 L96,95 Z" stroke="rgba(139,69,19,0.1)" fill="none" stroke-width="2"/></svg>');
        opacity: 0.4;
        background-size: 40px 40px;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: linear-gradient(45deg, rgba(139, 69, 19, 0.1) 0%, rgba(255, 255, 255, 0.1) 100%);
    }

    .hero-content {
        position: relative;
        z-index: 1;
        animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-content h1 {
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        color: var(--dark-brown);
    }

    /* Button Styles */
    .btn-brown {
        background-color: var(--primary-brown);
        border: none;
        color: white;
        padding: 12px 28px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-brown:hover {
        background-color: var(--dark-brown);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .btn-brown:active {
        transform: translateY(-1px);
    }

    .btn-outline-dark {
        font-weight: 600;
        border-width: 2px;
        transition: all 0.3s ease;
    }

    .btn-outline-dark:hover {
        background-color: var(--text-brown);
        border-color: var(--text-brown);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    /* Card Styles */
    .book-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        height: 100%;
        transform-origin: center bottom;
    }

    .book-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
    }

    .price {
        color: var(--primary-brown);
        font-size: 1.25rem;
        font-weight: 600;
    }

    .price-badge {
        background-color: var(--subtle-brown);
        color: var(--primary-brown);
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-block;
        margin-top: 12px;
        box-shadow: 0 2px 4px rgba(139, 69, 19, 0.15);
    }

    .book-card .card-img-top {
        height: 240px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .book-card:hover .card-img-top {
        transform: scale(1.05);
    }

    .book-card .card-body {
        padding: 1.5rem;
    }

    .book-card .card-title {
        margin-bottom: 0.5rem;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .book-card .text-muted {
        font-size: 0.9rem;
        margin-bottom: 0.8rem;
    }

    /* Features Section */
    .about-section {
        padding: 100px 0;
        background-color: #fcf9f5;
    }

    .about-card {
        padding: 2rem;
        border-radius: 12px;
        background: white;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
    }

    .about-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .about-icon {
        font-size: 2.5rem;
        color: var(--primary-brown);
        margin-bottom: 1.5rem;
        display: inline-block;
    }

    /* Section headings */
    section h2 {
        position: relative;
        font-weight: 700;
        color: var(--dark-brown);
        margin-bottom: 3rem;
        padding-bottom: 1rem;
    }

    section h2:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 80px;
        height: 3px;
        background: var(--primary-brown);
        transform: translateX(-50%);
    }

    /* Footer */
    footer {
        background: linear-gradient(to right, var(--dark-brown), var(--primary-brown));
        position: relative;
    }

    footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(to right, var(--light-brown), var(--primary-brown));
    }

    .footer-social-links a {
        color: white;
        font-size: 1.5rem;
        margin: 0 12px;
        transition: all 0.3s ease;
        opacity: 0.9;
    }

    .footer-social-links a:hover {
        color: var(--subtle-brown);
        transform: translateY(-3px);
        opacity: 1;
    }

    .footer-contact {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 1.5rem;
    }

    .footer-contact p {
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .footer-contact a {
        color: white;
        text-decoration: none;
        transition: color 0.3s ease;
        margin-left: 8px;
    }

    .footer-contact a:hover {
        color: var(--subtle-brown);
        text-decoration: underline;
    }

    /* Bestselling section */
    #books {
        padding: 100px 0;
        background-color: white;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .hero-section {
            padding: 100px 0 80px;
        }

        .hero-content {
            text-align: center;
            margin-bottom: 3rem;
        }

        .hero-content h1 {
            font-size: 2.5rem;
        }

        .hero-content .d-flex {
            justify-content: center;
            flex-wrap: wrap;
        }

        .hero-content .btn {
            margin: 0.5rem;
        }

        .book-card {
            margin-bottom: 1.5rem;
        }

        .about-card {
            margin-bottom: 2rem;
        }

        .footer-contact {
            text-align: center;
        }

        .footer-social-links {
            justify-content: center;
            margin: 1.5rem 0;
        }

        .col-md-4.text-end {
            text-align: center !important;
            margin-top: 2rem;
        }

        section {
            padding: 60px 0;
        }

        section h2 {
            margin-bottom: 2rem;
        }
    }

    @media (max-width: 576px) {
        .navbar-brand {
            font-size: 1.3rem;
        }

        .nav-link.btn-brown {
            padding: 8px 20px;
            font-size: 0.85rem;
            display: block;
            margin: 1rem auto;
            text-align: center;
            width: 80%;
        }

        .hero-content h1 {
            font-size: 2rem;
        }

        .hero-content p {
            font-size: 1rem;
        }

        .btn-brown,
        .btn-outline-dark {
            padding: 10px 20px;
            font-size: 0.9rem;
            width: 100%;
            margin: 0.5rem 0;
        }

        .hero-content .d-flex {
            flex-direction: column;
        }

        .about-card {
            padding: 1.5rem;
        }
    }

    /* Accessibility improvements */
    .visually-hidden {
        position: absolute;
        width: 1px;
        height: 1px;
        margin: -1px;
        padding: 0;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }

    /* Focus styles for better accessibility */
    a:focus,
    button:focus {
        outline: 3px solid rgba(139, 69, 19, 0.5);
        outline-offset: 2px;
    }

    /* Add smooth scrolling */
    html {
        scroll-behavior: smooth;
        scroll-padding-top: 80px;
        /* Adjust based on navbar height */
    }

    /* Back to top button */
    .back-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: var(--primary-brown);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 99;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .back-to-top.show {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top:hover {
        background: var(--dark-brown);
        transform: translateY(-3px);
    }

    /* Loading animation */
    .book-img-skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% {
            background-position: 200% 0;
        }

        100% {
            background-position: -200% 0;
        }
    }
</style>
