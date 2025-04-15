<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookHaven | User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-brown: #8B4513;
            --secondary-brown: #A0522D;
            --light-brown: #DEB887;
        }

        .btn-brown {
            background-color: var(--primary-brown);
            color: white;
        }

        .btn-brown:hover {
            background-color: var(--secondary-brown);
            color: white;
        }

        .profile-header {
            background-color: var(--light-brown);
            padding: 2rem 0;
        }

        .form-control:focus {
            border-color: var(--secondary-brown);
            box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.25);
        }
    </style>
</head>

<body class="bg-light">
    <div class="profile-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <div class="position-relative">
                        <img src="{{ route('login.image') }}" class="rounded-circle img-thumbnail mb-3"
                            alt="Profile Picture" id="profileImage">
                        <label for="profilePicture"
                            class="btn btn-sm btn-brown position-absolute bottom-0 start-50 translate-middle-x">
                            Change Photo
                        </label>
                        <input type="file" class="d-none" id="profilePicture" accept="image/*">
                    </div>
                </div>
                <div class="col-md-9">
                    <h2 class="text-dark">Edit Profile</h2>
                    <p class="text-muted">Update your personal information</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            {{-- {{ dd($userData) }} --}}
            <div class="col-md-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="#" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">Personal Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="first_name"
                                            value="{{ Auth::user()->firstname }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="last_name"
                                            value="{{ Auth::user()->lastname }}">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">Contact Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ Auth::user()->email }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            value="{{ Auth::user()->contactnumber }}">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">Address</h5>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ Auth::user()->address }}">
                                    </div>

                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">Password</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="currentPassword" class="form-label">Current Password</label>
                                        <input type="password" class="form-control" id="currentPassword"
                                            name="current_password">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="newPassword" class="form-label">New Password</label>
                                        <input type="password" class="form-control" id="newPassword"
                                            name="new_password">
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="button" class="btn btn-light me-2"
                                    onclick="window.location.href='/home'">Cancel</button>
                                <button type="submit" class="btn btn-brown">Save Changes</button>
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
    </script>
</body>

</html>
