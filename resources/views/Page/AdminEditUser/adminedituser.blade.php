@extends('shared.layout.admin')

@section('title', 'Edit User')

@section('page-title', 'User Management')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('view.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('view.manage.user') }}">User Management</a></li>
    <li class="breadcrumb-item active">Edit User</li>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit User Profile</h5>
            <span
                class="badge {{ $user->getIsAdmin() ? 'bg-info' : 'bg-warning' }} text-white">{{ $user->getIsAdmin() ? 'Administrator' : 'Customer' }}</span>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('save.edit.user') }}">
                @csrf

                <!-- Personal Information -->
                <h6 class="text-primary mb-3 border-bottom pb-2">Personal Information</h6>
                <input type="hidden" name="user_id" value="{{ $user->getUserID() }}">
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="firstname" value="{{ $user->getFirstName() }}"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lastname" value="{{ $user->getLastName() }}"
                            required>
                    </div>
                </div>

                <!-- Contact Information -->
                <h6 class="text-primary mb-3 border-bottom pb-2">Contact Information</h6>
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->getEmail() }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact Number</label>
                        <input type="text" class="form-control" name="contactnumber"
                            value="{{ $user->getContactNumber() }}">
                        <div class="form-text">Optional, include country code</div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" value="{{ $user->getAddress() }}">
                    <div class="form-text">Complete mailing address</div>
                </div>

                <!-- Account Settings -->
                <h6 class="text-primary mb-3 border-bottom pb-2">Account Settings</h6>
                <div class="mb-4">
                    <label class="form-label d-block">User Role</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="roleUser" value="User"
                            {{ !$user->getIsAdmin() ? 'checked' : '' }}>
                        <label class="form-check-label" for="roleUser">Customer</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="roleAdmin" value="Admin"
                            {{ $user->getIsAdmin() ? 'checked' : '' }}>
                        <label class="form-check-label" for="roleAdmin">Administrator</label>
                    </div>
                </div>

                <!-- Password Change (Optional) -->
                <h6 class="text-primary mb-3 border-bottom pb-2">Change Password <span
                        class="text-muted small">(optional)</span></h6>
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" name="password">
                        <div class="form-text">Leave blank to keep current password</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between align-items-center mt-4 pt-2 border-top">
                    <a href="{{ route('view.manage.user') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Back to Users
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
