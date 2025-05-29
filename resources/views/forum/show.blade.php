@extends('layouts.app')

@section('title', $thread->title . ' - ForumHub')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <!-- Thread Card -->
      <div class="card mb-4 fade-in-up">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="card-title fw-bold">{{ $thread->title }}</h1>
            <span class="badge bg-primary rounded-pill px-3 fs-6">
              🏷️ {{ $thread->category->name === 'General' ? 'Others' : $thread->category->name }}
            </span>
          </div>

          <div class="d-flex justify-content-between mb-3 text-muted small">
            <div>
              👤 Posted by <strong>{{ $thread->user->name }}</strong> • {{ $thread->created_at->diffForHumans() }}
            </div>
            <div>
              👀 {{ $thread->view_count }} views
            </div>
          </div>

          <div class="card-text mb-4" style="white-space: pre-wrap;">
            {!! nl2br(e($thread->content)) !!}
          </div>

          @can('update', $thread)
          <div class="btn-group" role="group" aria-label="Thread actions">
            <a href="{{ route('forum.edit', $thread) }}" class="btn btn-outline-secondary btn-sm">
              ✏️ Edit
            </a>
            <form action="{{ route('forum.destroy', $thread) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">
                🗑️ Delete
              </button>
            </form>
          </div>
          @endcan
        </div>
      </div>

      <!-- Replies Section -->
      <h3 class="mb-3">💬 Replies ({{ $thread->replies->count() }})</h3>

      @foreach($replies as $index => $reply)
<div class="card mb-3 {{ $index % 2 === 0 ? 'bg-primary' : 'bg-white' }} ms-3">
    <div class="card-body">
        <p>{{ $reply->content }}</p>
        <small class="text-muted">
            Posted by {{ $reply->user->name }} • {{ $reply->created_at->diffForHumans() }}
        </small>

        <div class="mt-2 d-flex gap-2">
            @can('update', $reply)
            <a href="{{ route('forum.reply.edit', $reply) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            @endcan

            @can('delete', $reply)
            <form action="{{ route('forum.reply.destroy', $reply) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reply?');" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
            @endcan

            @auth
                @unless(auth()->user()->id === $reply->user_id)
                <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="collapse" data-bs-target="#reportForm{{ $reply->id }}" aria-expanded="false" aria-controls="reportForm{{ $reply->id }}">
                    Report
                </button>
                @endunless
            @endauth
        </div>

        {{-- Report form toggle --}}
        <div class="collapse mt-2" id="reportForm{{ $reply->id }}">
            <form action="{{ route('forum.reply.report', $reply) }}" method="POST">
                @csrf
                <div class="mb-2">
                    <textarea name="reason" class="form-control @error('reason') is-invalid @enderror" rows="2" placeholder="Reason for reporting this reply..." required></textarea>
                    @error('reason')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-sm btn-danger">Submit Report</button>
            </form>
        </div>
    </div>
</div>
@endforeach

      <!-- Post a Reply from Guest POV -->
      @auth
      <div class="card mt-4">
        <div class="card-header fw-semibold">💬 Post a Reply</div>
        <div class="card-body">
          <form method="POST" action="{{ route('forum.reply.store', $thread) }}">
            @csrf
            <div class="mb-3">
              <textarea
                class="form-control @error('content') is-invalid @enderror"
                id="content"
                name="content"
                rows="4"
                placeholder="Share your thoughts..."
                required
              >{{ old('content') }}</textarea>
              @error('content')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">Post Reply</button>
          </form>
        </div>
      </div>
      @else
      <div class="alert alert-info mt-4 rounded-3">
        Please <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">login</a> to post a reply.
      </div>
      @endauth

    </div>
  </div>
</div>
@endsection
