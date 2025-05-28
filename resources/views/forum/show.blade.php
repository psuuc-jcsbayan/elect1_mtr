@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="card-title">{{ $thread->title }}</h1>
                        <span class="badge bg-primary">🏷️ {{ $thread->category->name === 'General' ? 'Others' : $thread->category->name }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <small class="text-muted">
                            👤 Posted by {{ $thread->user->name }} • {{ $thread->created_at->diffForHumans() }}
                        </small>
                        <small class="text-muted">👀 {{ $thread->view_count }} views</small>
                    </div>
                    
                    <div class="card-text mb-4">
                        {!! nl2br(e($thread->content)) !!}
                    </div>
                    
                    @can('update', $thread)
                        <div class="btn-group">
                            <a href="{{ route('forum.edit', $thread) }}" class="btn btn-sm btn-outline-secondary">✏️ Edit</a>
                            <form action="{{ route('forum.destroy', $thread) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">🗑️ Delete</button>
                            </form>
                        </div>
                    @endcan
                </div>
            </div>

            <h3 class="mb-3">💬 Replies ({{ $thread->replies->count() }})</h3>

            @foreach($replies as $index => $reply)
                <div class="card mb-3 ms-{{ $index % 2 === 0 ? '0' : '3' }}" 
                     style="background-color: {{ $index % 2 === 0 ? '#f8f9fa' : '#ffffff' }};">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <strong>👤 {{ $reply->user->name }}</strong>
                                <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                            </div>
                            @can('update', $reply)
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('forum.reply.edit', $reply) }}" class="btn btn-outline-secondary">✏️</a>
                                    <form action="{{ route('forum.reply.destroy', $reply) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">🗑️</button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                        <p class="card-text mt-2">{!! nl2br(e($reply->content)) !!}</p>
                        @auth
                            @unless(auth()->user()->id === $reply->user_id)
                                <form action="{{ route('forum.reply.report', $reply) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">⚠️ Report</button>
                                </form>
                            @endunless
                        @endauth
                    </div>
                </div>
            @endforeach

            @auth
                <div class="card">
                    <div class="card-header">💬 Post a Reply</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('forum.reply.store', $thread) }}">
                            @csrf
                            <div class="mb-3">
                                <textarea class="form-control @error('content') is-invalid @enderror" 
                                          id="content" name="content" rows="3" 
                                          placeholder="Share your thoughts..." required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Post Reply</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    Please <a href="{{ route('login') }}">login</a> to post a reply.
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection