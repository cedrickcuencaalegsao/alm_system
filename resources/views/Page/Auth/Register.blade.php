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
    <!-- CSS -->
    @include('shared.css.register')
    <!-- JS -->
    @include('shared.js.register')

@endsection
