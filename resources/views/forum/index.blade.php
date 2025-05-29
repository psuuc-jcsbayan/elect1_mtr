@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">

    <div class="col-md-8 fade-in-up">

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><span class="text-primary">ForumHub</span> Discussions</h1>
        <a href="{{ route('forum.create') }}" class="btn btn-primary">➕ New Thread</a>
      </div>

      <!-- Category Filter Dropdown -->
      <form method="GET" action="{{ route('forum.index') }}" class="mb-3 d-flex align-items-center gap-2">
        <label for="category_filter" class="fw-semibold mb-0">Filter by Category:</label>
        <select name="category" id="category_filter" class="form-select w-auto" onchange="this.form.submit()">
          <option value="" {{ request('category') == '' ? 'selected' : '' }}>All Categories</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
              {{ $category->name === 'General' ? 'Others' : $category->name }}
            </option>
          @endforeach
        </select>
        <noscript><button type="submit" class="btn btn-primary">Filter</button></noscript>
      </form>

      <div class="mb-3">
        <div class="btn-group" role="group">
          <a href="{{ route('forum.index', array_merge(request()->all(), ['filter' => 'recent'])) }}" 
             class="btn btn-outline-secondary {{ ($filter ?? '') === 'recent' ? 'active' : '' }}">
              🕒 Recent
          </a>
          <a href="{{ route('forum.index', array_merge(request()->all(), ['filter' => 'viewed'])) }}" 
             class="btn btn-outline-secondary {{ ($filter ?? '') === 'viewed' ? 'active' : '' }}">
              👀 Most Viewed
          </a>
          <a href="{{ route('forum.index', array_merge(request()->all(), ['filter' => 'replies'])) }}" 
             class="btn btn-outline-secondary {{ ($filter ?? '') === 'replies' ? 'active' : '' }}">
              💬 Most Replies
          </a>
        </div>
      </div>

      @forelse($threads as $thread)
        <div class="card mb-3">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="card-title">
                <a href="{{ route('forum.show', $thread) }}">{{ $thread->title }}</a>
              </h5>
              <span class="badge bg-primary">🏷️ {{ $thread->category->name === 'General' ? 'Others' : $thread->category->name }}</span>
            </div>
            <p class="card-text">{{ Str::limit($thread->content, 200) }}</p>
            <div class="d-flex justify-content-between">
              <small class="text-muted">
                👤 {{ $thread->user->name }} • {{ $thread->created_at->diffForHumans() }}
              </small>
              <div>
                <span class="badge bg-light text-dark">💬 {{ $thread->replies_count }} replies</span>
                <span class="badge bg-light text-dark">👀 {{ $thread->view_count }} views</span>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="alert alert-info">
          No threads found. Be the first to start a discussion!
        </div>
      @endforelse

      {{ $threads->appends(request()->except('page'))->links() }}
    </div>

    <div class="col-md-4 fade-in-up" style="animation-delay: 0.15s;">
      <div class="card shadow-sm">
        <div class="card-header fw-semibold">✨ Categories</div>
        <div class="card-body p-0">
          <ul class="list-group list-group-flush">
            @foreach($categories as $category)
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('forum.index', ['category' => $category->id]) }}" class="stretched-link text-decoration-none text-dark">
                  {{ $category->name === 'General' ? 'Others' : $category->name }}
                </a>
                <span class="badge bg-primary rounded-pill">{{ $category->threads_count ?? 0 }}</span>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
