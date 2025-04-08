@extends('shared.layout.guess')
@section('title', 'Login')

@section('content')
    <div class="vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card border-0 shadow-lg overflow-hidden">
                        <div class="row g-0">
                            <!-- Left side image -->
                            <div class="col-md-6 d-none d-md-block">
                                <img src="{{ route('login.image') }}" alt="Login" class="img-fluid login-image w-100 h-100"
                                    style="object-fit: cover; border-radius: 1rem 0 0 1rem;">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body p-5">
                                    <!-- Logo -->
                                    <div class="text-center mb-4">
                                        <h4 class="fw-bold mb-1">Welcome Back</h4>
                                        <p class="text-muted small">Please sign in to continue</p>
                                    </div>

                                    <!-- Alerts -->
                                    @if ($errors->any())
                                        <div class="notification-toast error-toast" id="errorToast">
                                            <div class="toast-header">
                                                <i class="bi bi-exclamation-circle-fill text-danger me-2"></i>
                                                <strong class="text-danger">Error</strong>
                                                <button type="button" class="btn-close-custom ms-auto"
                                                    onclick="closeToast('errorToast')">
                                                    <span class="me-1 text-danger">Close</span>
                                                    <i class="bi bi-x-lg text-danger"></i>
                                                </button>
                                            </div>
                                            <div class="toast-body">
                                                @foreach ($errors->all() as $error)
                                                    <div class="toast-message">{{ $error }}</div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const toast = document.getElementById('errorToast');
                                                toast.classList.add('show');
                                                setTimeout(() => {
                                                    toast.classList.remove('show');
                                                }, 5000);
                                            });
                                        </script>
                                    @endif

                                    @if (session('success'))
                                        <div class="notification-toast success-toast" id="successToast">
                                            <div class="toast-header">
                                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                <strong class="text-success">Success</strong>
                                                <button type="button" class="btn-close-custom ms-auto"
                                                    onclick="closeToast('successToast')">
                                                    <span class="me-1 text-success">Close</span>
                                                    <i class="bi bi-x-lg text-success"></i>
                                                </button>
                                            </div>
                                            <div class="toast-body">
                                                <div class="toast-message">{{ session('success') }}</div>
                                            </div>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const toast = document.getElementById('successToast');
                                                toast.classList.add('show');
                                                setTimeout(() => {
                                                    toast.classList.remove('show');
                                                }, 5000);
                                            });
                                        </script>
                                    @endif

                                    <!-- Login Form -->
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label small">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') }}" placeholder="name@example.com">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label small">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Enter your password">
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="form-check">
                                                <input type="checkbox" name="remember" class="form-check-input"
                                                    id="remember">
                                                <label class="form-check-label small" for="remember">
                                                    Remember me
                                                </label>
                                            </div>
                                            <a href="#" class="text-decoration-none small">Forgot password?</a>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100 mb-3">
                                            Sign In
                                        </button>

                                        <p class="text-center mb-0 small">
                                            Don't have an account?
                                            <a href="{{ Route('register.page') }}" class="text-decoration-none">
                                                Create Account
                                            </a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-brown: #8B4513;
            --light-brown: #DEB887;
            --dark-brown: #654321;
            --subtle-brown: #F5DEB3;
        }

        .bg-light {
            background-color: var(--subtle-brown) !important;
        }

        .card {
            border-radius: 1rem;
            background-color: #fff;
        }

        .btn-primary {
            background-color: var(--primary-brown);
            border-color: var(--primary-brown);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: var(--dark-brown);
            border-color: var(--dark-brown);
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.25);
        }

        .form-control:focus {
            border-color: var(--primary-brown);
            box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.1);
        }

        a {
            color: var(--primary-brown);
        }

        a:hover {
            color: var(--dark-brown);
        }

        .form-check-input:checked {
            background-color: var(--primary-brown);
            border-color: var(--primary-brown);
        }

        .notification-toast {
            position: fixed;
            left: 50%;
            top: 20px;
            transform: translateX(-50%) translateY(-100%);
            min-width: 300px;
            max-width: 400px;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 1050;
            pointer-events: none;
        }

        /* Add this new style for the show class */
        .notification-toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
            pointer-events: auto;
        }

        /* Update toast-body styling */
        .toast-body {
            padding: 12px 16px;
            color: #333;
        }

        .toast-message {
            margin-bottom: 8px;
        }

        .toast-message:last-child {
            margin-bottom: 0;
        }

        .btn-close-custom {
            background: transparent;
            border: none;
            padding: 0;
            margin: 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            display: flex;
            align-items: center;
            font-size: 0.875rem;
        }

        .btn-close-custom span {
            font-weight: 500;
        }

        .btn-close-custom:hover {
            opacity: 0.7;
        }

        .toast-header {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            background: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .toast-header i {
            font-size: 1.2rem;
        }

        .toast-header strong {
            font-size: 1rem;
        }

        .error-toast {
            border-left: 4px solid #dc3545;
        }

        .success-toast {
            border-left: 4px solid #198754;
        }

        .login-image {
            min-height: 500px;
            max-height: 100%;
            transition: transform 0.3s ease;
        }

        @media (min-width: 768px) {
            .card {
                border-radius: 0 1rem 1rem 0;
            }
        }

        @media (max-width: 767px) {
            .card {
                border-radius: 1rem;
            }
        }

        .success-toast {
            border-left: 4px solid var(--primary-brown);
        }

        .success-toast .text-success {
            color: var(--primary-brown) !important;
        }

        .success-toast .bi-check-circle-fill {
            color: var(--primary-brown) !important;
        }

        /* Add subtle brown border to form controls */
        .form-control {
            border-color: #DEB887;
        }

        /* Add brown tint to the card shadow */
        .shadow-lg {
            box-shadow: 0 1rem 3rem rgba(139, 69, 19, 0.175) !important;
        }

        /* Text colors */
        .text-muted {
            color: #8B7355 !important;
        }

        .fw-bold {
            color: var(--dark-brown);
        }

        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        }

        .btn-primary {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .card {
            border-radius: 1rem;
        }

        .alert {
            border: none;
            border-radius: 0.5rem;
        }
    </style>
    <script>
        function closeToast(toastId) {
            const toast = document.getElementById(toastId);
            if (toast) {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 300); // Match the transition duration
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const toasts = document.querySelectorAll('.notification-toast');
            toasts.forEach(toast => {
                toast.style.display = 'block';
                // Force a reflow
                toast.offsetHeight;
                toast.classList.add('show');

                setTimeout(() => {
                    closeToast(toast.id);
                }, 5000);
            });
        });
    </script>
@endsection
