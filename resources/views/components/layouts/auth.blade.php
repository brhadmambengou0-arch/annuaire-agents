<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title ?? 'ANINF — Annuaire Numérique' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen" style="background:linear-gradient(160deg,#f0fbff,#daf5ff);color:#0f2f5b;">
    <main class="min-h-screen flex items-center justify-center" style="padding:2rem;">
        <div style="width:100%;max-width:540px;background:white;border-radius:16px;box-shadow:0 16px 36px rgba(19,80,121,.16);overflow:hidden;">
            {{ $slot }}
        </div>
    </main>
    @livewireScripts
</body>
</html>