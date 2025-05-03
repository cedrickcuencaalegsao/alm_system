<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookHaven | User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->

</head>
@include('shared.css.profile')
<body>
    <div class="profile-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <div class="profile-image-container">
                        <img src="{{ route('user.image', Auth::user()->image ?? 'default.jpg') }}"
                            class="rounded-circle profile-image" alt="Profile Picture" id="profileImage">
                        <label for="profilePicture" class="image-upload-btn" title="Change Profile Picture">
                            <i class="fas fa-camera"></i>
                        </label>
                        @error('image')
                            <div class="text-danger mt-2 text-center">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-9">
                    <h2 class="fw-bold text-white">Hello, {{ Auth::user()->firstname }}!</h2>
                    <p class="text-white opacity-75">Manage your account details and preferences</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        @if (session('success'))
                            <div id="updateSuccess" class="alert alert-success mb-4 d-flex align-items-center">
                                <i class="fas fa-check-circle me-3 fs-4"></i>
                                <div>{{ session('success') }}</div>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger mb-4 d-flex align-items-center">
                                <i class="fas fa-exclamation-circle me-3 fs-4"></i>
                                <div>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <form id="profileForm" action="{{ route('update.profile') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" class="d-none" id="profilePicture" name="image" accept="image/*">
                            <div class="mb-4">
                                <h5 class="section-title">Personal Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                id="firstName" name="first_name" value="{{ Auth::user()->firstname }}"
                                                placeholder="First Name">
                                            <label for="firstName">First Name</label>
                                            @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                id="lastName" name="last_name" value="{{ Auth::user()->lastname }}"
                                                placeholder="Last Name">
                                            <label for="lastName">Last Name</label>
                                            @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="section-title">Contact Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                name="email" value="{{ Auth::user()->email }}" placeholder="Email">
                                            <label for="email">Email Address</label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input type="tel"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                id="phone" name="phone"
                                                value="{{ Auth::user()->contactnumber }}" placeholder="Phone Number">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="section-title">Address</h5>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" value="{{ Auth::user()->address }}"
                                        placeholder="Your full address">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="section-title">Change Password</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password"
                                                class="form-control @error('current_password') is-invalid @enderror"
                                                id="currentPassword" name="current_password"
                                                placeholder="Current Password">
                                            <span class="input-group-text password-toggle"
                                                onclick="togglePassword('currentPassword')">
                                                <i class="fas fa-eye" id="currentPasswordIcon"></i>
                                            </span>
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            <input type="password"
                                                class="form-control @error('new_password') is-invalid @enderror"
                                                id="newPassword" name="new_password" placeholder="New Password">
                                            <span class="input-group-text password-toggle"
                                                onclick="togglePassword('newPassword')">
                                                <i class="fas fa-eye" id="newPasswordIcon"></i>
                                            </span>
                                            @error('new_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="alert-feedback mt-2" id="passwordStrength"></div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="userID" value="{{ Auth::user()->userID }}">
                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <a href="/home" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Home
                                </a>
                                <button type="submit" class="btn btn-brown">
                                    <i class="fas fa-save me-2"></i>Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JavaScript -->
    @include('shared.js.profile')
</body>

</html>
