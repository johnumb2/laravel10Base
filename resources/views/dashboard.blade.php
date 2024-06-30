
@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
        <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        {graph 1}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        {graph 2}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        {graph 3}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        {graph 4}
                    </div>
                </div>
            </div>
        </div>
@endsection
