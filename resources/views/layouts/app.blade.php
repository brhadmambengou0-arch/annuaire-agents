<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuaire des Agents</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow p-4">
        <h1 class="text-xl font-bold">Annuaire Numérique des Agents</h1>
    </nav>

    <!-- Contenu principal -->
    <main class="p-4">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>