<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('You are logged in!') }}
            </h2>

            <!-- Categories Navigation
            <nav class="space-x-4">
                <a href="{{ route('threads.index', ['category' => 'general']) }}" 
                   class="text-black hover:underline">
                    General
                </a>
                <a href="{{ route('threads.index', ['category' => 'technology']) }}" 
                   class="text-black hover:underline">
                    Technology
                </a>
                <a href="{{ route('threads.index', ['category' => 'entertainment']) }}" 
                   class="text-black hover:underline">
                    Entertainment
                </a>
            </nav>
        </div> -->
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
