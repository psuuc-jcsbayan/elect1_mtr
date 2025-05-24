@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-6 px-6"> <!-- Added px-6 for left/right padding -->
        
       <!-- Header with "Create New Thread" Button -->
<div class="flex justify-between items-center mb-6">
    <h1 class="text-xl font-semibold text-black">Forum Threads</h1> <!-- Changed text color to black -->
    @auth
        <button type="submit" style="display: block; background: black; color: white; padding: 10px 20px; border-radius: 8px;">
            <a href="{{ route('threads.create') }}" 
               class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                + Create New Thread
            </a>
        </button>
    @endauth
</div>


        <!-- Display Threads -->
        @forelse ($threads as $thread)
            <div class="bg-white shadow-md rounded-lg p-6 mb-6"> <!-- Increased padding for better spacing -->
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3">
                    <img src="https://i.pravatar.cc/40?u={{ optional($thread->user)->id ?: 'default' }}" 
     class="w-10 h-10 rounded-full" alt="User Avatar">
                        <div>
                            <div class="font-semibold text-gray-900">{{ $thread->user->name }}</div>
                            <span class="text-sm text-gray-500">
                                {{ $thread->created_at->diffForHumans() }} • Public
                            </span>
                        </div>
                    </div>

                   <!-- Edit & Delete Thread Buttons (Only for Thread Owner) -->
                    @if(auth()->check() && auth()->id() == $thread->user_id)
                    <div class="relative">
                        <button onclick="this.nextElementSibling.classList.toggle('hidden')" class="text-gray-500 hover:text-gray-700">⋮</button>
                        <div class="absolute right-0 bg-white border rounded-lg shadow-lg p-2 hidden">
                            <a href="{{ route('threads.edit', $thread) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                            <form action="{{ route('threads.destroy', $thread) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100">Delete</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
                <h2 class="text-lg font-semibold text-gray-900">{{ $thread->title }}</h2>
                <p class="text-gray-700 mt-2">{{ $thread->body }}</p>

                <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                    <div class="flex space-x-3">
                        <span class="flex items-center">
                            <i class="fas fa-comment text-blue-500 mr-1"></i> 
                            {{ $thread->replies->count() }} Replies
                        </span>
                    </div>
                    <a href="{{ route('threads.show', $thread) }}" 
                       class="text-blue-500 font-medium hover:underline">
                        View Thread
                    </a>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center">No threads found in this category.</p>
        @endforelse

        <!-- Pagination -->
        <div class="mt-4">
            {{ $threads->links() }}
        </div>
    </div>
@endsection
