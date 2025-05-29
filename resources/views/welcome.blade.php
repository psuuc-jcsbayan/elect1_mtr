@extends('layouts.app')

@section('title', 'Welcome to ForumHub')

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 class="display-4 fw-bold mb-4">👋 Welcome to <span class="text-primary">ForumHub</span></h1>

            <p class="lead mb-4">
                A vibrant community where you can ask questions, share insights, and discuss ideas. Whether you're a tech enthusiast or just looking to connect — you're welcome here.
            </p>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">
                    🔐 Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-4">
                    📝 Register
                </a>
            </div>

            <hr class="my-5">

            <p class="text-muted">Already a member? <a href="{{ route('login') }}">Log in here</a>.</p>

        </div>
    </div>
</div>
@endsection
