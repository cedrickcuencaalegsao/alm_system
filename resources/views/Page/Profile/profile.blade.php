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
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-brown: #8B4513;
            --secondary-brown: #A0522D;
            --light-brown: #DEB887;
            --lightest-brown: #F5EBE0;
            --dark-brown: #654321;
        }

        body {
            background-color: var(--lightest-brown);
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .btn-brown {
            background-color: var(--primary-brown);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-brown:hover {
            background-color: var(--dark-brown);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            background-color: var(--light-brown);
            padding: 3rem 0;
            border-bottom: 3px solid var(--primary-brown);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--secondary-brown);
            box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.25);
        }

        .form-label {
            font-weight: 500;
            color: var(--dark-brown);
        }

        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
        }

        .section-title {
            color: var(--primary-brown);
            font-weight: 600;
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, var(--primary-brown), var(--light-brown), transparent);
        }

        .profile-image-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .image-upload-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: var(--primary-brown);
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .image-upload-btn:hover {
            background-color: var(--dark-brown);
            transform: scale(1.1);
        }

        .input-group-text {
            background-color: var(--light-brown);
            color: var(--dark-brown);
            border: 1px solid #ced4da;
        }

        .password-toggle {
            cursor: pointer;
            color: var(--primary-brown);
        }

        .form-floating .form-control {
            height: calc(3.5rem + 2px);
            padding: 1rem 0.75rem;
        }

        .form-floating label {
            padding: 1rem 0.75rem;
        }

        .alert-feedback {
            display: none;
            font-size: 14px;
            margin-top: 5px;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .alert-success {
            color: #0f5132;
            background-color: #d1e7dd;
            border-color: #badbcc;
        }
    </style>
</head>

<body>
    <div class="profile-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <div class="profile-image-container">
                        <img src="{{ route('login.image') }}" class="rounded-circle profile-image" alt="Profile Picture"
                            id="profileImage">
                        <label for="profilePicture" class="image-upload-btn" title="Change Profile Picture">
                            <i class="fas fa-camera"></i>
                        </label>
                        <input type="file" class="d-none" id="profilePicture" accept="image/*">
                    </div>
                </div>
                <div class="col-md-9">
                    <h2 class="fw-bold text-dark">Hello, {{ Auth::user()->firstname }}!</h2>
                    <p class="text-muted">Update your personal information and settings</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <div id="updateSuccess" class="alert alert-success mb-4" style="display: none;">
                            <i class="fas fa-check-circle me-2"></i> Your profile has been updated successfully!
                        </div>

                        <form id="profileForm" action="#" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <h5 class="section-title">Personal Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="firstName" name="first_name"
                                                value="{{ Auth::user()->firstname }}" placeholder="First Name">
                                            <label for="firstName">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="lastName" name="last_name"
                                                value="{{ Auth::user()->lastname }}" placeholder="Last Name">
                                            <label for="lastName">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="section-title">Contact Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ Auth::user()->email }}" placeholder="Email">
                                            <label for="email">Email Address</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input type="tel" class="form-control" id="phone" name="phone"
                                                value="{{ Auth::user()->contactnumber }}" placeholder="Phone Number">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="section-title">Address</h5>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ Auth::user()->address }}" placeholder="Your full address">
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="section-title">Change Password</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="currentPassword"
                                                name="current_password" placeholder="Current Password">
                                            <span class="input-group-text password-toggle"
                                                onclick="togglePassword('currentPassword')">
                                                <i class="fas fa-eye" id="currentPasswordIcon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="newPassword"
                                                name="new_password" placeholder="New Password">
                                            <span class="input-group-text password-toggle"
                                                onclick="togglePassword('newPassword')">
                                                <i class="fas fa-eye" id="newPasswordIcon"></i>
                                            </span>
                                        </div>
                                        <div class="alert-feedback mt-2" id="passwordStrength"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
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
            }
        });

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

        // Form submission with validation
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Simulate form submission (replace with actual form submission)
            setTimeout(function() {
                document.getElementById('updateSuccess').style.display = 'block';
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

                // Hide success message after 3 seconds
                setTimeout(function() {
                    document.getElementById('updateSuccess').style.display = 'none';
                }, 3000);
            }, 1000);
        });
    </script>
</body>

</html>
