<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Modern UI</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-100 min-h-screen flex items-center justify-center px-4 py-12">

  <div class="w-full max-w-5xl bg-white/70 backdrop-blur-md rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row transition-all duration-300 hover:shadow-[0_20px_25px_-5px_rgba(0,0,0,0.1)]">
    
    <!-- Left Column: Image -->
    <div class="hidden md:block md:w-1/2">
      <img src="https://i.pinimg.com/736x/5d/8d/e1/5d8de1ed5865fe770a804beaa6d26097.jpg" 
           alt="Login Image" 
           class="w-full h-full object-cover"
           onerror="this.onerror=null; this.src='https://via.placeholder.com/800x600?text=Image+Not+Found';">
    </div>

    <!-- Right Column: Login Form -->
    <div class="w-full md:w-1/2 p-10 space-y-8">
      <div class="text-center">
        <h2 class="text-4xl font-bold text-gray-800">Welcome back 👋</h2>
        <p class="mt-2 text-sm text-gray-600">
          Or <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-500 font-medium transition">create a new account</a>
        </p>
      </div>

      <form class="space-y-6" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="space-y-4">
          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
            <input id="email" name="email" type="email" autocomplete="email" required 
                   value="{{ old('email') }}"
                   class="w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-gray-500 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm transition"
                   placeholder="you@example.com">
          </div>

          <!-- Password -->
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required
                   class="w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-gray-500 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm transition"
                   placeholder="••••••••">
          </div>

          <!-- Role -->
          <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Login as</label>
            <select id="role" name="role" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm transition">
              <option value="user">Regular User</option>
              <option value="admin">Administrator</option>
            </select>
          </div>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
          <div class="rounded-xl bg-red-100 border border-red-400 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc pl-5 space-y-1">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <!-- Submit Button -->
        <div>
          <button type="submit" 
                  class="w-full flex justify-center items-center gap-2 py-3 px-4 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:-translate-y-0.5">
            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
            </svg>
            Sign in
          </button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
