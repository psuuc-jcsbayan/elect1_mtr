@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Forum Threads</h1>
                <a href="{{ route('forum.create') }}" class="btn btn-primary">Create Thread</a>
            </div>

            <div class="mb-3">
                <div class="btn-group" role="group">
                    <a href="{{ route('forum.index', ['filter' => 'recent']) }}" class="btn btn-outline-secondary {{ $filter === 'recent' ? 'active' : '' }}">Recent</a>
                    <a href="{{ route('forum.index', ['filter' => 'viewed']) }}" class="btn btn-outline-secondary {{ $filter === 'viewed' ? 'active' : '' }}">Most Viewed</a>
                    <a href="{{ route('forum.index', ['filter' => 'replies']) }}" class="btn btn-outline-secondary {{ $filter === 'replies' ? 'active' : '' }}">Most Replies</a>
                </div>
            </div>

            @foreach($threads as $thread)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">
                                <a href="{{ route('forum.show', $thread) }}">{{ $thread->title }}</a>
                            </h5>
                            <span class="badge bg-secondary">{{ $thread->category->name }}</span>
                        </div>
                        <p class="card-text">{{ Str::limit($thread->content, 200) }}</p>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">
                                Posted by {{ $thread->user->name }} {{ $thread->created_at->diffForHumans() }}
                            </small>
                            <div>
                                <span class="badge bg-light text-dark">{{ $thread->replies_count }} replies</span>
                                <span class="badge bg-light text-dark">{{ $thread->view_count }} views</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $threads->links() }}
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($categories as $category)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $category->name }}
                                <span class="badge bg-primary rounded-pill">{{ $category->threads_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection