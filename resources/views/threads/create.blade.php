@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="flex items-center justify-center min-h-screen py-10"> <!-- Added top padding -->

    <div class="flex items-center justify-center h-screen">
        <div class="w-96 bg-white shadow-lg rounded-x5 p-6"> <!-- Fixed width for square container -->
            <h1 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Create a New Thread</h1>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('threads.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" 
                        class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category" 
                        class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div style = "padding: 10px 10px;" >
                    <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
                    <textarea name="body" id="body" rows="5" 
                        class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('body') }}</textarea>
                </div>

               
                <div class="flex justify-center">
            <button type="submit" style="display: block; background: black; color: white; padding: 10px 20px; border-radius: 8px;">
Post Thread            </button>
        </div>

            </form>
        </div>
    </div>
@endsection
