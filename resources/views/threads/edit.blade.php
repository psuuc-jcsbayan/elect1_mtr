@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto mt-6 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold">Edit Thread</h2>

    <form action="{{ route('threads.update', $thread) }}" method="POST">
    @csrf
        @method('PUT')

        <div class="mt-4">
            <label for="title" class="block font-medium text-gray-700">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $thread->title) }}" 
                   class="w-full p-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mt-4">
            <label for="body" class="block font-medium text-gray-700">Body</label>
            <textarea id="body" name="body" rows="4" 
                      class="w-full p-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>{{ old('body', $thread->body) }}</textarea>
        </div>

        <div class="relative">
            <button type="submit" style="display: block; background: black; color: white; padding: 10px 20px; border-radius: 8px;">
                Update Thread
            </button>
        </div>
    </form>
</div>
@endsection
