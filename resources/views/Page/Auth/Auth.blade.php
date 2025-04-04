@extends('shared.layout.guess')
@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header text-white text-center py-4" style="background-color: #8B4513;">
                    <h3 class="mb-0">Welcome Back!</h3>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="#">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #DEB887;"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" name="email" id="email"  
                                    placeholder="Enter your email">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #DEB887;"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" name="password" id="password" 
                                    placeholder="Enter your password">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <a href="#" class="text-decoration-none" style="color: #8B4513;">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn w-100 mb-3 text-white" style="background-color: #8B4513;">Sign In</button>

                        <div class="text-center">
                            <span class="text-muted">Don't have an account?</span>
                            <a href="{{Route('register.page')}}" class="text-decoration-none ms-1" style="color: #8B4513;">
                                Create Account
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection