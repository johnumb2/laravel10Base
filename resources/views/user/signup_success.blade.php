@extends('layouts.app')

@section('title', 'Signup Successful')
@extends('layouts.nav')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sign Up Successful!</div>
                    <div class="card-body">
                        <h5 class="card-title">Welcome to our budgeting app!</h5>
                        <p class="card-text">Your registration has been successfully completed.</p>

                        <!-- Modify the following link as per your requirements -->
                        <a href="{{ route('home') }}" class="btn btn-primary">Go to Dashboard</a>

                        <!-- Inform users, if email verification is required -->
                        @if (config('auth.verification.enabled'))
                            <p class="mt-3">We've sent a verification email to your registered email address. Please verify your email to continue.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
