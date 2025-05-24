@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto mt-8 px-6 bg-white shadow-lg rounded-lg p-8"> <!-- Added padding and structured layout -->
    
    <!-- Thread Title -->
    <h2 class="text-2xl font-bold text-gray-900">{{ $thread->title }}</h2>
    
    <!-- Thread Body -->
    <p class="text-gray-700 mt-4 leading-relaxed">{{ $thread->body }}</p>
    
    <!-- Thread Author -->
    <div class="flex items-center space-x-4 mt-4">
        <img src="https://i.pravatar.cc/60?u={{ $thread->user->id }}" 
             class="w-14 h-14 rounded-full border border-gray-300" alt="User Avatar">
        <p class="text-sm text-gray-500">
            Posted by <span class="font-semibold text-gray-800">{{ $thread->user->name ?? 'Anonymous' }}</span> • {{ $thread->created_at->diffForHumans() }}
        </p>
    </div>

    <!-- Delete Thread Button (Only for Thread Owner) -->
    @if(auth()->id() == $thread->user_id)
        <form action="{{ route('threads.destroy', $thread) }}" method="POST" 
              onsubmit="return confirm('Are you sure you want to delete this thread?');" class="mt-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:underline font-semibold">
                Delete Thread
            </button>
        </form>
    @endif

    <hr class="my-6">

    <!-- Replies Section -->
    <h3 class="text-xl font-semibold text-gray-900">Replies ({{ $thread->replies->count() }})</h3>

    <div class="mt-6 space-y-6">
        @forelse ($thread->replies as $reply)
            <div class="bg-gray-100 p-5 rounded-lg flex items-start space-x-4">
                <img src="https://i.pravatar.cc/60?u={{ $reply->user->id }}" 
                     class="w-14 h-14 rounded-full border border-gray-300" alt="User Avatar">

                <div class="flex-1">
                    <p class="text-gray-800 leading-relaxed">{{ $reply->body }}</p>
                    <p class="text-sm text-gray-500 mt-2">
                        - <span class="font-semibold text-gray-800">{{ $reply->user->name ?? 'Unknown' }}</span> • {{ $reply->created_at->diffForHumans() }}
                    </p>

                    <div class="flex space-x-4 mt-3 text-sm">
                        <!-- Edit Reply Button (Only for reply owner) -->
                        @if(auth()->id() == $reply->user_id)
                            <a href="{{ route('replies.edit', $reply) }}" class="text-blue-500 hover:underline font-semibold">Edit</a>
                        @endif

                        <!-- Delete Reply Button (Only for reply owner or thread owner) -->
                        @if(auth()->id() == $reply->user_id || auth()->id() == $thread->user_id)
                            <form action="{{ route('replies.destroy', $reply) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this reply?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline font-semibold">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center">No replies yet. Be the first to comment!</p>
        @endforelse
    </div>

    <!-- Reply Form -->
      @auth
    <form action="{{ route('replies.store', $thread->id) }}" method="POST" class="mt-4">
        @csrf
        <textarea name="body" rows="3" class="w-full p-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required></textarea>
        <div class="relative">
            <button type="submit" style="display: block; background: black; color: white; padding: 10px 20px; border-radius: 8px;">
Reply            </button>
        </div>
    </form>
    @else
    <p class="mt-4 text-gray-600">
        <a href="{{ route('login') }}" class="text-blue-500 font-semibold hover:underline">Log in</a> to post a reply.
    </p>
    @endauth
</div>
@endsection
