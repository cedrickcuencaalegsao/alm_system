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
                                <div class="card-body p-4 p-md-5">
                                    <!-- Logo -->
                                    <div class="text-center mb-4">
                                        <h4 class="fw-bold mb-1">Welcome Back</h4>
                                        <p class="text-muted small">Please sign in to continue</p>
                                    </div>

                                    <!-- Login Form -->
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label small fw-medium">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') }}" placeholder="name@example.com">
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label small fw-medium">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Enter your password">
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100 mb-4">
                                            Sign In
                                        </button>

                                        <p class="text-center mb-0 small">
                                            Don't have an account?
                                            <a href="{{ Route('register.page') }}" class="text-decoration-none fw-medium">
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

    <!-- Modal Notifications -->
    @if ($errors->any())
        <div class="modal-notification error-modal" id="errorModal">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="bi bi-exclamation-circle-fill text-danger me-2"></i>
                    <strong class="text-danger">Error</strong>
                    <button type="button" class="btn-close-custom ms-auto" onclick="closeModal('errorModal')">
                        <i class="bi bi-x-lg text-danger"></i>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ($errors->all() as $error)
                        <div class="modal-message">{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="modal-backdrop" id="errorBackdrop" onclick="closeModal('errorModal')"></div>
    @endif

    @if (session('success'))
        <div class="modal-notification success-modal" id="successModal">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <strong class="text-success">Success</strong>
                    <button type="button" class="btn-close-custom ms-auto" onclick="closeModal('successModal')">
                        <i class="bi bi-x-lg text-success"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-message">{{ session('success') }}</div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop" id="successBackdrop" onclick="closeModal('successModal')"></div>
    @endif

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-brown: #8B4513;
            --light-brown: #DEB887;
            --dark-brown: #654321;
            --subtle-brown: #F5DEB3;
            --hover-brown: #7d3c0f;
        }

        .bg-light {
            background-color: var(--subtle-brown) !important;
        }

        .card {
            border-radius: 1.2rem;
            background-color: #fff;
        }

        .btn-primary {
            background-color: var(--primary-brown);
            border-color: var(--primary-brown);
            padding: 0.85rem 1rem;
            border-radius: 0.6rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--hover-brown);
            border-color: var(--hover-brown);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.25);
        }

        .form-control {
            padding: 0.85rem 1rem;
            border-radius: 0.6rem;
            border: 1px solid #e2e2e2;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-brown);
            box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.1);
        }

        a {
            color: var(--primary-brown);
            transition: color 0.2s ease;
        }

        a:hover {
            color: var(--hover-brown);
        }

        .form-check-input:checked {
            background-color: var(--primary-brown);
            border-color: var(--primary-brown);
        }

        /* Modal Notification Styles */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }

        .modal-notification {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.9);
            z-index: 1050;
            max-width: 400px;
            width: 90%;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-notification.show {
            opacity: 1;
            visibility: visible;
            transform: translate(-50%, -50%) scale(1);
        }

        .modal-content {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            display: flex;
            align-items: center;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .modal-header i {
            font-size: 1.3rem;
        }

        .modal-header strong {
            font-size: 1.1rem;
            font-weight: 600;
            margin-left: 0.5rem;
        }

        .modal-body {
            padding: 1.25rem;
        }

        .modal-message {
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .modal-message:last-child {
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
            transition: opacity 0.2s ease;
        }

        .btn-close-custom:hover {
            opacity: 0.7;
        }

        .error-modal .modal-content {
            border-top: 4px solid #dc3545;
        }

        .success-modal .modal-content {
            border-top: 4px solid var(--primary-brown);
        }

        .success-modal .text-success {
            color: var(--primary-brown) !important;
        }

        .success-modal .bi-check-circle-fill {
            color: var(--primary-brown) !important;
        }

        .login-image {
            min-height: 500px;
            max-height: 100%;
            transition: transform 0.5s ease;
        }

        .login-image:hover {
            transform: scale(1.02);
        }

        .fw-medium {
            font-weight: 500;
        }

        /* Mobile Responsive Styles */
        @media (max-width: 767.98px) {
            .vh-100 {
                min-height: 100vh;
                height: auto;
                padding: 2rem 0;
            }

            .card {
                border-radius: 1.2rem;
                margin: 0 1rem;
            }

            .card-body {
                padding: 1.8rem !important;
            }

            .form-control {
                font-size: 16px; /* Prevents zoom on iOS */
            }

            .btn-primary {
                padding: 0.85rem;
            }

            .modal-notification {
                width: 85%;
            }
        }

        @media (min-width: 768px) {
            .card {
                border-radius: 1.2rem;
            }
        }

        .shadow-lg {
            box-shadow: 0 1.5rem 3rem rgba(139, 69, 19, 0.15) !important;
        }

        .text-muted {
            color: #8B7355 !important;
        }

        .fw-bold {
            color: var(--dark-brown);
        }
    </style>
    <script>
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            const backdrop = document.getElementById(modalId.replace('Modal', 'Backdrop'));
            if (modal) {
                modal.classList.remove('show');
                setTimeout(() => {
                    modal.style.visibility = 'hidden';
                    if (backdrop) backdrop.style.display = 'none';
                }, 300);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const modals = document.querySelectorAll('.modal-notification');
            const backdrops = document.querySelectorAll('.modal-backdrop');

            if (modals.length > 0) {
                modals.forEach(modal => {
                    modal.style.visibility = 'visible';
                    modal.offsetHeight; // Force reflow
                    modal.classList.add('show');
                });

                backdrops.forEach(backdrop => {
                    backdrop.style.display = 'block';
                });

                setTimeout(() => {
                    modals.forEach(modal => {
                        const modalId = modal.id;
                        closeModal(modalId);
                    });
                }, 5000);
            }
        });
    </script>
@endsection
