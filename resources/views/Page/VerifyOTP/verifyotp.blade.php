@extends('shared.layout.guess')

@section('title', 'Verify OTP')

@section('custom_css')
    <style>
        .otp-input {
            letter-spacing: .35rem;
            font-size: 1.4rem;
            text-align: center;
        }

        .small-note {
            font-size: .9rem;
            color: #6c757d;
        }

        /* Keep the same visual proportions as the send OTP/login card */
        .vh-100 {
            min-height: 100vh;
        }

        .login-image {
            min-height: 100%;
            object-fit: cover;
            border-radius: 1rem 0 0 1rem;
        }

        .otp-card {
            border-radius: 1.2rem;
        }
    </style>
@endsection

@section('content')
    <div class="vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card border-0 shadow-lg overflow-hidden otp-card">
                        <div class="row g-0">
                            <div class="col-md-6 d-none d-md-block">
                                <img src="{{ route('login.image') }}" alt="Verify OTP"
                                    class="img-fluid login-image w-100 h-100">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body p-4 p-md-5">
                                    <div class="text-center mb-3">
                                        <h4 class="fw-bold mb-1">Verify your email</h4>
                                        <p class="text-muted small">Enter the 6-digit code we sent to your email.</p>
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

                                    <form method="POST" action="{{ route('verify.otp') }}">
                                        @csrf

                                        {{-- include email from request OR session so controller can identify the user --}}
                                        @if (request()->has('email'))
                                            <input type="hidden" name="email" value="{{ request('email') }}">
                                        @elseif(session('otp_email'))
                                            <input type="hidden" name="email" value="{{ session('otp_email') }}">
                                        @endif

                                        <div class="mb-3">
                                            <label for="otp" class="form-label">One-time code</label>
                                            <input id="otp" name="otp" type="text" inputmode="numeric"
                                                pattern="[0-9]{6}" maxlength="6"
                                                class="form-control otp-input @error('otp') is-invalid @enderror"
                                                value="{{ old('otp') }}" placeholder="______" required autofocus />
                                            @error('otp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="d-grid">
                                            <button class="btn btn-primary" type="submit">Verify</button>
                                        </div>
                                    </form>

                                    <div class="text-center mt-3 small-note">
                                        Didn't receive the code? <a href="{{ route('view.send.otp') }}">Resend OTP</a>
                                    </div>
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
        // Show success modal when OTP is verified on the server
        @if (session('otp_verified'))
            var otpSuccessModal = new bootstrap.Modal(document.getElementById('otpSuccessModal'));
            otpSuccessModal.show();
        @endif
    </script>
@endpush

<!-- Success modal shown after OTP verification; OK takes user to update password page -->
<div class="modal fade" id="otpSuccessModal" tabindex="-1" aria-labelledby="otpSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="otpSuccessModalLabel">Verified</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your OTP has been verified successfully. Click OK to continue to set a new password.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="otp-success-ok">OK</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var okBtn = document.getElementById('otp-success-ok');
            if (okBtn) {
                okBtn.addEventListener('click', function() {
                    // Navigate to the update password view
                    window.location.href = "{{ route('view.update.password') }}";
                });
            }
        });
    </script>
@endpush
