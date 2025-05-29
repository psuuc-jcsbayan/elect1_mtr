<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - Modern UI</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-pink-100 via-purple-100 to-indigo-100 min-h-screen flex items-center justify-center px-4 py-12">

  <div class="w-full max-w-5xl bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl flex flex-col md:flex-row overflow-hidden">
    
    <!-- Left Image -->
    <div class="hidden md:block md:w-1/2">
      <img src="https://i.pinimg.com/originals/9c/4c/e5/9c4ce58a890c2b9ac1a0834e3e117e09.jpg" 
           alt="Register Image" 
           class="w-full h-full object-cover rounded-l-3xl"
           onerror="this.onerror=null; this.src='https://via.placeholder.com/800x600?text=Image+Not+Found';">
    </div>

    <!-- Right Form -->
    <div class="w-full md:w-1/2 p-10 space-y-8">
      <div class="text-center">
        <h2 class="text-4xl font-bold text-gray-800">Create your account</h2>
        <p class="mt-2 text-sm text-gray-600">
          Already have an account? 
          <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500 font-medium transition">Login here</a>.
        </p>
      </div>

      <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
          <input type="text" name="name" id="name" value="{{ old('name') }}" required
                 class="w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-gray-500 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm transition"
                 placeholder="Your Name">
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input type="email" name="email" id="email" value="{{ old('email') }}" required
                 class="w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-gray-500 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm transition"
                 placeholder="you@example.com">
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <input type="password" name="password" id="password" required
                 class="w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-gray-500 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm transition"
                 placeholder="••••••••">
        </div>

        <!-- Confirm Password -->
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
          <input type="password" name="password_confirmation" id="password_confirmation" required
                 class="w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-gray-500 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm transition"
                 placeholder="••••••••">
        </div>

        
              <!-- Role -->
      <div>
        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
        <select name="role" id="role" required
                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm transition">
          <option value="user" selected>User</option>
        </select>
      </div>

      <!-- Errors -->
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
                  class="w-full flex justify-center items-center py-3 px-4 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:-translate-y-0.5">
            Register
          </button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
