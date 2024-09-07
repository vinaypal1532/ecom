@extends('frontend.layouts.app')

@section('title', 'User Login - Fruitables')

@section('content')
<div class="container-fluid page-header">           

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="mt-3 text-center">
                            <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                        </div>
                        <div class="mt-3 text-center">
                            <p>Don't have an account? <a href="{{ route('customerregister') }}">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
