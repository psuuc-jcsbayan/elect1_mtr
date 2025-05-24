<nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-500 to-blue-700 shadow-md border-b border-blue-600">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <x-application-logo class="h-9 w-auto text-white" />
                </a>

                <!-- Navigation Links -->
                <div class="hidden sm:flex space-x-4 ml-10">
                    <a href="{{ route('threads.index') }}" 
                       class="px-4 py-2 text-white font-semibold hover:text-gray-200 hover:underline {{ request('category') ? '' : 'underline' }}">
                        All Categories
                    </a>
                    <a href="{{ route('threads.index', ['category' => 'general']) }}" 
                       class="px-4 py-2 text-white font-semibold hover:text-gray-200 hover:underline {{ request('category') === 'general' ? 'underline' : '' }}">
                        General
                    </a>
                    <a href="{{ route('threads.index', ['category' => 'technology']) }}" 
                       class="px-4 py-2 text-white font-semibold hover:text-gray-200 hover:underline {{ request('category') === 'technology' ? 'underline' : '' }}">
                        Technology
                    </a>
                    <a href="{{ route('threads.index', ['category' => 'entertainment']) }}" 
                       class="px-4 py-2 text-white font-semibold hover:text-gray-200 hover:underline {{ request('category') === 'entertainment' ? 'underline' : '' }}">
                        Entertainment
                    </a>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex items-center space-x-6">
                <div class="relative">
                    <button @click="open = !open" class="flex items-center text-white hover:text-gray-200 focus:outline-none">
                        <span class="mr-2 font-medium">{{ Auth::user()->name }}</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Log Out</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="sm:hidden">
                <button @click="open = !open" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="sm:hidden bg-blue-600 border-t border-blue-700">
        <div class="p-2 space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-white hover:bg-blue-700">Dashboard</a>
            <a href="{{ route('threads.index', ['category' => 'general']) }}" class="block px-4 py-2 text-white hover:bg-blue-700">General</a>
            <a href="{{ route('threads.index', ['category' => 'technology']) }}" class="block px-4 py-2 text-white hover:bg-blue-700">Technology</a>
            <a href="{{ route('threads.index', ['category' => 'entertainment']) }}" class="block px-4 py-2 text-white hover:bg-blue-700">Entertainment</a>
            <a href="{{ route('threads.index') }}" class="block px-4 py-2 text-white hover:bg-blue-700">All Categories</a>
        </div>

        <!-- Mobile User Options -->
        <div class="border-t border-blue-700 pt-4">
            <div class="px-4">
                <div class="text-white font-medium">{{ Auth::user()->name }}</div>
                <div class="text-gray-200 text-sm">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-white hover:bg-blue-700">Profile</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-white hover:bg-blue-700">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>
