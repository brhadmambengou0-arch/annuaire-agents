<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Annuaire Agents')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="flex h-screen bg-gray-100 font-sans">

    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-md flex-shrink-0">
        <div class="p-4 border-b">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 mx-auto">
        </div>
        <ul class="p-4 space-y-2">
            <li><a href="{{ route('dashboard') }}" class="block p-2 rounded hover:bg-pink-100 text-pink-700 font-medium">Dashboard</a></li>
            <li><a href="{{ route('annuaire.index') }}" class="block p-2 rounded hover:bg-pink-100 text-pink-700 font-medium">Annuaire</a></li>
            <li><a href="{{ route('profile') }}" class="block p-2 rounded hover:bg-pink-100 text-pink-700 font-medium">Profil</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-md p-4 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold text-pink-700">@yield('page-title', 'Dashboard')</h2>
            </div>
            <div class="flex items-center space-x-4">
                <span class="font-medium">{{ auth()->user()->name ?? 'Utilisateur' }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-pink-600 text-white px-3 py-1 rounded hover:bg-pink-700">Déconnexion</button>
                </form>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-6 overflow-auto">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white shadow-inner p-4 text-center text-gray-500">
            &copy; {{ date('Y') }} Annuaire Agents. Tous droits réservés.
        </footer>
    </div>

    @livewireScripts
</body>
</html>