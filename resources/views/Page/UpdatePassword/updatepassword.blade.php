@extends('shared.layout.guess')

@section('title', 'Update Password')

@section('custom_css')
    <style>
        .form-card {
            border-radius: 1.2rem;
        }

        .small-note {
            font-size: .9rem;
            color: #6c757d;
        }
    </style>
@endsection

@section('content')
    <div class="vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card border-0 shadow-lg overflow-hidden form-card">
                        <div class="row g-0">
                            <div class="col-md-6 d-none d-md-block">
                                <img src="{{ route('login.image') }}" alt="Update Password"
                                    class="img-fluid login-image w-100 h-100">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body p-4 p-md-5">
                                    <div class="text-center mb-3">
                                        <h4 class="fw-bold mb-1">Set a new password</h4>
                                        <p class="text-muted small">Choose a strong password and confirm it.</p>
                                    </div>

                                    @if (session('status'))
                                        <div class="alert alert-success">{{ session('status') }}</div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('update.password') }}">
                                        @csrf

                                        @if (session('reset_email'))
                                            <input type="hidden" name="email" value="{{ session('reset_email') }}">
                                        @else
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email') }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label class="form-label">New password</label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror" required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Confirm new password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                required>
                                        </div>

                                        <div class="d-grid">
                                            <button class="btn btn-primary" type="submit">Update Password</button>
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
@endsection

@push('scripts')
    <script>
        // Show password-updated modal when server sets the flag
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('password_updated'))
                var pwdModal = new bootstrap.Modal(document.getElementById('passwordUpdatedModal'));
                pwdModal.show();
            @endif

            var okBtn = document.getElementById('password-updated-ok');
            if (okBtn) {
                okBtn.addEventListener('click', function() {
                    window.location.href = "{{ route('login.page') }}";
                });
            }
        });
    </script>
@endpush

<!-- Password updated success modal -->
<div class="modal fade" id="passwordUpdatedModal" tabindex="-1" aria-labelledby="passwordUpdatedModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordUpdatedModalLabel">Password updated</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your password was successfully updated. Click OK to go to the login page.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Stay</button>
                <button type="button" class="btn btn-primary" id="password-updated-ok">OK</button>
            </div>
        </div>
    </div>
</div>
