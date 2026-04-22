<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AF Resource Exchange | Command Hub</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --af-blue: #003087; --af-dark: #002157; --af-silver: #E1E1E1; }
        body { background-color: #f4f7f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; }
        
        /* Top Nav */
        .navbar-af { background-color: var(--af-blue); border-bottom: 4px solid var(--af-dark); height: 70px; }
        
        /* Sidebar */
        .sidebar { min-width: 280px; max-width: 280px; background: #212529; color: white; min-height: calc(100vh - 70px); position: sticky; top: 70px; }
        .sidebar .nav-link { color: #adb5bd; padding: 1.2rem; border-bottom: 1px solid #343a40; font-size: 0.95rem; }
        .sidebar .nav-link:hover { background: #343a40; color: white; }
        .sidebar .nav-link.active { background: var(--af-blue); color: white; border-left: 5px solid var(--af-silver); }
        
        /* Account Circle */
        .account-circle { width: 35px; height: 35px; background: var(--af-silver); color: var(--af-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; border: 2px solid white; }
    </style>
</head>
<body>
    <!-- Top Command Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-af sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold tracking-tighter" href="{{ route('welcome') }}">
                U.S. AIR FORCE | <span class="text-info">RESOURCE EXCHANGE</span>
            </a>
            
            <div class="ms-auto d-flex align-items-center">
                @auth
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#" role="button" data-bs-toggle="dropdown">
                            <div class="account-circle me-2">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2 shadow border-0">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Account Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger fw-bold">LOGOUT / DISCONNECT</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">LOGIN</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Persistent Sidebar -->
        <nav class="sidebar">
            <div class="p-3 text-uppercase small fw-bold text-muted tracking-widest">Command Menu</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}" href="{{ route('welcome') }}">🏠 Main Menu / Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('items.index') ? 'active' : '' }}" href="{{ route('items.index') }}">📦 Equipment Catalog</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">🪖 My Possessions</a>
                </li>
                @if(Auth::user()->role == 'lender')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('items.create') ? 'active' : '' }}" href="{{ route('items.create') }}">➕ List New Gear (AI)</a>
                </li>
                @endif
                <!-- NEW REVIEW/APPEAL LINK -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('reviews.create') ? 'active' : '' }}" href="{{ route('reviews.create') }}">📢 Submit Review/Appeal</a>
                </li>
                @endauth
            </ul>
            <div class="mt-auto p-4 small text-muted">
                Node Status: <span class="text-success">● Secure</span>
            </div>
        </nav>

        <!-- Main Content Area -->
        <main class="flex-grow-1 p-4" style="background: #f4f7f9;">
            {{ $slot }}
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>