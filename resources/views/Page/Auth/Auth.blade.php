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

    <!-- Custom CSS and JS -->
    @include('shared.css.auth')
    @include('shared.js.auth')
@endsection
