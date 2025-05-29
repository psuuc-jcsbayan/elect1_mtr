@extends('layouts.admin')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="display-5 fw-bold text-dark">
                <i class="bi bi-bar-chart-line me-2"></i> Admin Dashboard
            </h1>
            <a href="{{ route('forum.index') }}" class="btn btn-primary btn-lg shadow-sm">
                <i class="bi bi-arrow-left me-2"></i> Visit Forum
            </a>
        </div>

        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow h-100 transition-all">
                    <div class="card-body text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                            <i class="bi bi-chat-square-text-fill text-primary fs-2"></i>
                        </div>
                        <h5 class="card-title text-uppercase fw-semibold text-muted">Threads</h5>
                        <p class="card-text display-4 fw-bold text-primary">{{ $threadsCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow h-100 transition-all">
                    <div class="card-body text-center">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                            <i class="bi bi-chat-left-quote-fill text-success fs-2"></i>
                        </div>
                        <h5 class="card-title text-uppercase fw-semibold text-muted">Replies</h5>
                        <p class="card-text display-4 fw-bold text-success">{{ $repliesCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow h-100 transition-all">
                    <div class="card-body text-center">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                            <i class="bi bi-people-fill text-info fs-2"></i>
                        </div>
                        <h5 class="card-title text-uppercase fw-semibold text-muted">Users</h5>
                        <p class="card-text display-4 fw-bold text-info">{{ $usersCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow h-100 transition-all">
                    <div class="card-body text-center">
                        <div class="bg-danger bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                            <i class="bi bi-exclamation-triangle-fill text-danger fs-2"></i>
                        </div>
                        <h5 class="card-title text-uppercase fw-semibold text-muted">Reports</h5>
                        <p class="card-text display-4 fw-bold text-danger">{{ $reportsCount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .transition-all {
            transition: transform 0.2s ease-in-out;
        }
        .transition-all:hover {
            transform: translateY(-5px);
        }
        .card {
            border-radius: 10px;
        }
        .card-body {
            padding: 2rem;
        }
    </style>
@endsection