@extends('shared.layout.guess')
@section('title', 'Register')

@section('content')
    <div class="vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="notification-container">
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
                        @endif
                    </div>
                    <div class="card border-0 shadow-lg overflow-hidden">
                        <div class="row g-0">
                            <!-- Left side image -->
                            <div class="col-md-6 d-none d-md-block">
                                <img src="{{ route('login.image') }}" alt="Register"
                                    class="img-fluid login-image w-100 h-100"
                                    style="object-fit: cover; border-radius: 1rem 0 0 1rem;">
                            </div>

                            <div class="col-md-6">
                                <div class="card-body p-5">
                                    <!-- Register Form -->
                                    <form method="POST" action="{{ route('register') }}" id="registrationForm">
                                        @csrf
                                        <!-- Phase 1: Personal Information -->
                                        <div class="form-section" id="section1">
                                            <div class="text-center mb-4">
                                                <h4 class="fw-bold mb-1">Personal Information</h4>
                                                <p class="text-muted small">Step 1 of 3</p>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label small">First Name</label>
                                                <input type="text" class="form-control" name="firstname"
                                                    value="{{ old('firstname') }}" placeholder="Enter your first name">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label small">Last Name</label>
                                                <input type="text" class="form-control" name="lastname"
                                                    value="{{ old('lastname') }}" placeholder="Enter your last name">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label small">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email') }}" placeholder="name@example.com">
                                            </div>

                                            <button type="button" class="btn btn-primary w-100 mb-3"
                                                onclick="nextSection(1)">
                                                Next Step
                                            </button>

                                            <p class="text-center mb-0 small">
                                                Already have an account?
                                                <a href="{{ route('login.page') }}" class="text-decoration-none">Sign In</a>
                                            </p>
                                        </div>

                                        <!-- Phase 2: Contact Information -->
                                        <div class="form-section d-none" id="section2">
                                            <div class="text-center mb-4">
                                                <h4 class="fw-bold mb-1">Contact Information</h4>
                                                <p class="text-muted small">Step 2 of 3</p>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label small">Address</label>
                                                <input type="text" class="form-control" name="address"
                                                    value="{{ old('address') }}" placeholder="Enter your address">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label small">Contact Number</label>
                                                <input type="text" class="form-control" name="contactnumber"
                                                    value="{{ old('contactnumber') }}"
                                                    placeholder="Enter your contact number">
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-secondary w-45"
                                                    onclick="previousSection(2)">
                                                    Previous
                                                </button>
                                                <button type="button" class="btn btn-primary w-45"
                                                    onclick="nextSection(2)">
                                                    Next Step
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Phase 3: Security -->
                                        <div class="form-section d-none" id="section3">
                                            <div class="text-center mb-4">
                                                <h4 class="fw-bold mb-1">Security</h4>
                                                <p class="text-muted small">Step 3 of 3</p>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label small">Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Enter your password">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label small">Confirm Password</label>
                                                <input type="password" class="form-control" name="password_confirmation"
                                                    placeholder="Confirm your password">
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-secondary w-45"
                                                    onclick="previousSection(3)">
                                                    Previous
                                                </button>
                                                <button type="submit" class="btn btn-primary w-45">
                                                    Create Account
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

        .btn-secondary {
            background-color: #E9ECEF;
            border-color: #E9ECEF;
            color: var(--dark-brown);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .btn-secondary:hover {
            background-color: #DDE0E3;
            border-color: #DDE0E3;
        }

        .form-section {
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }

        .form-section.d-none {
            opacity: 0;
        }

        .login-image {
            min-height: 500px;
            max-height: 100%;
            transition: transform 0.3s ease;
        }

        .w-45 {
            width: 45% !important;
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

        .notification-container {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050;
            width: 100%;
            max-width: 400px;
        }

        .notification-toast {
            position: relative;
            min-width: 300px;
            max-width: 100%;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            opacity: 0;
            transition: all 0.3s ease;
            margin-bottom: 10px;
            transform: translateY(-20px);
            pointer-events: none;
        }

        .notification-toast.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .toast-header {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            background: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

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
            font-size: 0.875rem;
        }

        .btn-close-custom span {
            font-weight: 500;
        }

        .btn-close-custom:hover {
            opacity: 0.7;
        }

        .error-toast {
            border-left: 4px solid #dc3545;
        }

        .success-toast {
            border-left: 4px solid #198754;
        }

        /* Theme specific colors */
        .success-toast {
            border-left: 4px solid var(--primary-brown);
        }

        .success-toast .text-success {
            color: var(--primary-brown) !important;
        }

        .success-toast .bi-check-circle-fill {
            color: var(--primary-brown) !important;
        }
    </style>

    <script>
        function nextSection(currentSection) {
            const current = document.getElementById(`section${currentSection}`);
            const next = document.getElementById(`section${currentSection + 1}`);

            current.style.opacity = '0';
            setTimeout(() => {
                current.classList.add('d-none');
                next.classList.remove('d-none');
                setTimeout(() => {
                    next.style.opacity = '1';
                }, 50);
            }, 300);
        }

        function previousSection(currentSection) {
            const current = document.getElementById(`section${currentSection}`);
            const previous = document.getElementById(`section${currentSection - 1}`);

            current.style.opacity = '0';
            setTimeout(() => {
                current.classList.add('d-none');
                previous.classList.remove('d-none');
                setTimeout(() => {
                    previous.style.opacity = '1';
                }, 50);
            }, 300);
        }

        function closeToast(toastId) {
            const toast = document.getElementById(toastId);
            if (toast) {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 300);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const toasts = document.querySelectorAll('.notification-toast');
            toasts.forEach(toast => {
                toast.style.display = 'block';
                // Force a reflow
                toast.offsetHeight;
                toast.classList.add('show');

                // Auto hide after 5 seconds
                setTimeout(() => {
                    closeToast(toast.id);
                }, 5000);
            });
        });
    </script>
@endsection
