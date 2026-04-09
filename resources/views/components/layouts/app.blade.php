@props(['title' => 'ANINF'])

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        :root { --sky: #0ea5e9; --sky-dark: #0369a1; --sky-light: #e0f2fe; --gray: #64748b; --gray-light: #f1f5f9; --border: #e2e8f0; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: #f0f9ff; color: #334155; }
        .navbar { background: var(--sky-dark); padding: 0 2rem; display: flex; align-items: center; justify-content: space-between; height: 60px; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 8px rgba(0,0,0,0.15); }
        .navbar-brand { color: #fff; font-size: 1.1rem; font-weight: 700; text-decoration: none; letter-spacing: 0.02em; }
        .navbar-nav { display: flex; align-items: center; gap: 0.5rem; }
        .nav-link { color: rgba(255,255,255,0.85); text-decoration: none; padding: 0.4rem 0.9rem; border-radius: 6px; font-size: 0.88rem; transition: background 0.15s; }
        .nav-link:hover, .nav-link.active { background: rgba(255,255,255,0.15); color: #fff; }
        .nav-badge { background: rgba(255,255,255,0.2); color: #fff; font-size: 0.7rem; padding: 0.15rem 0.5rem; border-radius: 20px; margin-left: 0.3rem; font-weight: 600; }
        .nav-divider { width: 1px; height: 20px; background: rgba(255,255,255,0.2); margin: 0 0.5rem; }
        .nav-user { color: rgba(255,255,255,0.8); font-size: 0.85rem; }
        .btn-logout { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: #fff; padding: 0.35rem 0.8rem; border-radius: 6px; font-size: 0.82rem; cursor: pointer; transition: background 0.15s; }
        .btn-logout:hover { background: rgba(255,255,255,0.2); }
        .flash { padding: 0.75rem 1.5rem; font-size: 0.88rem; text-align: center; }
        .flash-success { background: #d1fae5; color: #065f46; border-bottom: 1px solid #6ee7b7; }
        .flash-error { background: #fee2e2; color: #991b1b; border-bottom: 1px solid #fca5a5; }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="{{ route('annuaire.index') }}" class="navbar-brand">ANINF</a>
    <div class="navbar-nav">
        <a href="{{ route('annuaire.index') }}" class="nav-link {{ request()->routeIs('annuaire.*') ? 'active' : '' }}">Annuaire</a>
        @auth
            @if(auth()->user()->role === 'admin')
                <div class="nav-divider"></div>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Tableau de bord <span class="nav-badge">Admin</span></a>
                <a href="{{ route('admin.entities') }}" class="nav-link {{ request()->routeIs('admin.entities') ? 'active' : '' }}">Entités</a>
                <a href="{{ route('admin.fonctions') }}" class="nav-link {{ request()->routeIs('admin.fonctions') ? 'active' : '' }}">Fonctions</a>
            @else
                <div class="nav-divider"></div>
                <a href="{{ route('agent.profile') }}" class="nav-link {{ request()->routeIs('agent.profile') ? 'active' : '' }}">Mon profil</a>
            @endif
            <div class="nav-divider"></div>
            <span class="nav-user">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Déconnexion</button>
            </form>
        @endauth
    </div>
</nav>

@if(session('success'))
    <div class="flash flash-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="flash flash-error">{{ session('error') }}</div>
@endif

<main>{{ $slot }}</main>

@livewireScripts
</body>
</html>
