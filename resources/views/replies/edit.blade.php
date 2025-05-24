@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto mt-6 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold">Edit Reply</h2>

    <form action="{{ route('replies.update', $reply) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mt-4">
        <label for="body" class="block font-medium text-gray-700">Edit Reply</label>
        <textarea id="body" name="body" rows="4" class="w-full p-2 border rounded-md" required>{{ old('body', $reply->body) }}</textarea>
    </div>

    <div class="relative">
            <button type="submit" style="display: block; background: black; color: white; padding: 10px 20px; border-radius: 8px;">
Update Reply            </button>
        </div>
</form>

</div>
@endsection
