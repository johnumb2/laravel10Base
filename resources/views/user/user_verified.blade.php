@extends('layouts.app')

@section('title', 'Email Verification')
@extends('layouts.nav')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Email Verification
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Success!</h5>
                        <p class="card-text">Your email has been successfully verified.</p>
                        <a href="#" class="btn btn-primary">Go to homepage<a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
