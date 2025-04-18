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
    <style>
        :root {
            --primary-brown: #8B4513;
            --secondary-brown: #A0522D;
            --light-brown: #DEB887;
            --lightest-brown: #F5EBE0;
            --dark-brown: #654321;
            --accent-brown: #CD853F;
        }

        body {
            background-color: var(--lightest-brown);
            color: #333;
            font-family: 'Poppins', sans-serif;
            background-image: linear-gradient(to bottom, rgba(245, 235, 224, 0.7), rgba(245, 235, 224, 0.9)),
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23a0522d' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .btn-brown {
            background-color: var(--primary-brown);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 30px;
            transition: all 0.3s ease;
            font-weight: 500;
            box-shadow: 0 4px 8px rgba(139, 69, 19, 0.2);
        }

        .btn-brown:hover {
            background-color: var(--dark-brown);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(139, 69, 19, 0.3);
        }

        .btn-outline-secondary {
            color: var(--secondary-brown);
            border-color: var(--secondary-brown);
            border-radius: 30px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: var(--secondary-brown);
            color: white;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--light-brown), var(--accent-brown));
            padding: 4rem 0 5rem;
            border-bottom: none;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: -50px;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .form-control {
            border: 1px solid rgba(206, 212, 218, 0.7);
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            border-color: var(--accent-brown);
            box-shadow: 0 0 0 0.25rem rgba(205, 133, 63, 0.25);
            background-color: white;
        }

        .form-label {
            font-weight: 500;
            color: var(--dark-brown);
            margin-bottom: 8px;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        }

        .card:hover {
            box-shadow: 0 20px 40px rgba(139, 69, 19, 0.12);
            transform: translateY(-5px);
        }

        .card-body {
            padding: 2.5rem;
        }

        .section-title {
            color: var(--primary-brown);
            font-weight: 600;
            position: relative;
            padding-bottom: 12px;
            margin-bottom: 25px;
            font-size: 1.4rem;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(to right, var(--primary-brown), var(--accent-brown));
            border-radius: 3px;
        }

        .profile-image-container {
            position: relative;
            width: 160px;
            height: 160px;
            margin: 0 auto;
            z-index: 1;
        }

        .profile-image {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .profile-image:hover {
            transform: scale(1.03);
        }

        .image-upload-btn {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background-color: var(--primary-brown);
            color: white;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }

        .image-upload-btn:hover {
            background-color: var(--accent-brown);
            transform: scale(1.1) rotate(15deg);
        }

        .input-group-text {
            background-color: var(--light-brown);
            color: var(--dark-brown);
            border: 1px solid rgba(206, 212, 218, 0.7);
            border-radius: 10px 0 0 10px;
        }

        .input-group .form-control {
            border-radius: 0 10px 10px 0;
        }

        .password-toggle {
            cursor: pointer;
            color: var(--primary-brown);
            border-radius: 0 10px 10px 0;
        }

        .form-floating .form-control {
            height: calc(3.5rem + 2px);
            padding: 1rem 0.75rem;
            border-radius: 10px;
        }

        .form-floating label {
            padding: 1rem 0.75rem;
        }

        .alert-feedback {
            display: none;
            font-size: 14px;
            margin-top: 8px;
            padding: 8px 12px;
            border-radius: 8px;
        }

        .alert-success {
            color: #0f5132;
            background-color: #d1e7dd;
            border-color: #badbcc;
        }

        .alert {
            border-radius: 10px;
            padding: 1rem;
            border-left: 4px solid;
        }

        .alert-success {
            border-left-color: #0f5132;
        }

        .row g-3 {
            --bs-gutter-y: 1rem;
        }

        /* Animation for section entries */
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

        .mb-4 {
            animation: fadeInUp 0.5s ease forwards;
        }

        .mb-4:nth-child(2) {
            animation-delay: 0.1s;
        }

        .mb-4:nth-child(3) {
            animation-delay: 0.2s;
        }

        .mb-4:nth-child(4) {
            animation-delay: 0.3s;
        }
    </style>
</head>

<body>
    {{-- {{ dd(Auth::user()->image) }} --}}
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
    <script>
        // Preview profile picture before upload
        document.getElementById('profilePicture').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);

                // Add a console log for debugging
                console.log('File selected:', e.target.files[0].name);
            }
        });

        // Auto-hide success message after 5 seconds
        const successMessage = document.querySelector('.alert-success');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.transition = 'opacity 1s ease';
                successMessage.style.opacity = '0';
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 1000);
            }, 5000);
        }

        // Toggle password visibility
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = document.getElementById(inputId + 'Icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }

        // Password strength indicator
        document.getElementById('newPassword').addEventListener('input', function() {
            const password = this.value;
            const strengthDiv = document.getElementById('passwordStrength');
            strengthDiv.style.display = 'block';

            // Check password strength
            if (password.length === 0) {
                strengthDiv.style.display = 'none';
            } else if (password.length < 6) {
                strengthDiv.className = 'alert-feedback alert-danger';
                strengthDiv.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i> Password is too short';
            } else if (!/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/[0-9]/.test(password)) {
                strengthDiv.className = 'alert-feedback alert-warning';
                strengthDiv.innerHTML =
                    '<i class="fas fa-exclamation-triangle me-1"></i> Medium (add uppercase, lowercase and numbers)';
            } else {
                strengthDiv.className = 'alert-feedback alert-success';
                strengthDiv.innerHTML = '<i class="fas fa-check-circle me-1"></i> Strong password';
            }
        });
    </script>
</body>

</html>
