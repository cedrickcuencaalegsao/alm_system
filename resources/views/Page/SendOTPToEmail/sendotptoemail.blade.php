@extends('shared.layout.guess')

@section('content')
    <div class="vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card border-0 shadow-lg overflow-hidden">
                        <div class="row g-0">
                            <!-- Left side image -->
                            <div class="col-md-6 d-none d-md-block">
                                <img src="{{ route('login.image') }}" alt="Send OTP" class="img-fluid login-image w-100 h-100"
                                    style="object-fit: cover; border-radius: 1rem 0 0 1rem;">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body p-4 p-md-5">
                                    <!-- Logo -->
                                    <div class="text-center mb-4">
                                        <h4 class="fw-bold mb-1">Send OTP to Email</h4>
                                        <p class="text-muted small">Enter your email address to receive a One-Time Password
                                            (OTP)</p>
                                    </div>

                                    <!-- Display Validation Errors -->
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <!-- Send OTP Form -->
                                    <form method="POST" action="{{ route('send.otp') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-labelsmall fw-medium">Email</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" placeholder="Email Address">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100 mb-4">
                                            Send OTP
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- The success message from the controller will be placed here --}}
                    @if (session('otp_sent'))
                        {{ session('otp_sent') }}
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        onclick="window.location.href='{{ route('view.verify.otp') }}'">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Ensure you have Bootstrap's JavaScript included in your layout file --}}
    <script>
        // Check if the 'otp_sent' session flash message exists
        @if (session('otp_sent'))
            // If it exists, create a new Bootstrap modal instance and show it
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @endif
    </script>
@endpush
