@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>📊 Admin Dashboard</h1>
            <div class="btn-group">
                <a href="{{ route('forum.index') }}" class="btn btn-outline-secondary">
                    ← Return to Forum
                </a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Threads</h5>
                        <p class="card-text display-4">{{ $threadsCount }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Replies</h5>
                        <p class="card-text display-4">{{ $repliesCount }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text display-4">{{ $usersCount }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Reports</h5>
                        <p class="card-text display-4">{{ $reportsCount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection