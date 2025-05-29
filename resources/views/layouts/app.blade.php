<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'ForumHub')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        @keyframes fadeInUp {
          from {opacity: 0; transform: translate3d(0, 20px, 0);}
          to {opacity: 1; transform: none;}
        }
        .fade-in-up {
          opacity: 0;
          animation-fill-mode: forwards;
          animation-name: fadeInUp;
          animation-duration: 0.5s;
          animation-timing-function: ease;
        }
        .fade-in-up-delay {
          animation-delay: 0.2s;
        }
        .card:hover {
          box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
          transform: translateY(-3px);
          transition: all 0.3s ease;
        }
        a.text-decoration-none:hover {
          text-decoration: underline;
        }
        .reply-card {
          background-color: #f8f9fa;
        }
        .reply-card.alt {
          background-color: #ffffff;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">ForumHub</a>
      <div>
        @auth
          <span class="me-3">👤 {{ auth()->user()->name }}</span>
          <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-secondary">Logout</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary me-2">Login</a>
          <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Register</a>
        @endauth
      </div>
    </div>
  </nav>

  <main>
    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
