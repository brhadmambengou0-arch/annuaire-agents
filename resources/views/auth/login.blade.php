<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Annuaire Agents</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

<div class="w-full max-w-md bg-white rounded shadow p-8 space-y-6">
    <!-- Logo -->
    <div class="text-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 mx-auto mb-4">
        <h1 class="text-2xl font-bold text-pink-700">Connexion</h1>
    </div>

    <!-- Formulaire -->
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full mt-1 p-2 border rounded focus:outline-none focus:ring focus:border-pink-300">
            @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div x-data="{ show: false }">
            <label for="password" class="block font-medium text-gray-700">Mot de passe</label>
            <div class="relative">
                <input :type="show ? 'text' : 'password'" id="password" name="password" required
                       class="w-full mt-1 p-2 border rounded focus:outline-none focus:ring focus:border-pink-300">
                <button type="button" @click="show = !show"
                        class="absolute right-2 top-2 text-gray-500 hover:text-pink-700">
                    <span x-text="show ? 'Masquer' : 'Afficher'"></span>
                </button>
            </div>
            @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Bouton connexion -->
        <div>
            <button type="submit"
                    class="w-full bg-pink-600 text-white py-2 rounded hover:bg-pink-700 transition">
                Se connecter
            </button>
        </div>

        <!-- Lien inscription -->
        <div class="text-center text-sm text-gray-500">
            Pas encore de compte ? 
            <a href="{{ route('register') }}" class="text-pink-600 hover:underline">Inscription</a>
        </div>
    </form>
</div>

@livewireScripts
<script src="https://unpkg.com/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
</body>
</html>