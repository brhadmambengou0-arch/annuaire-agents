<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title ?? 'ANINF — Annuaire-agents' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@500;600&display=swap');
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col" style="background:#f4f8fd;">

    {{-- Topbar --}}
    <header class="fixed top-0 left-0 right-0 z-50 h-16 bg-white flex items-center justify-between px-6"
            style="border-bottom: 1.5px solid #d0e8f8;">
        <a href="{{ route('annuaire.index') }}" class="flex items-center gap-3 no-underline" aria-label="Accueil ANINF">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl" style="background:#1a7fc1;">
                <svg class="w-5 h-5 fill-white" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/></svg>
            </div>
            <div>
                <div class="font-display text-base font-semibold leading-none" style="color:#0d4f7c;">ANINF</div>
                <div class="text-xs uppercase tracking-widest" style="color:#7aaecc; font-size:10px;">
                    Agence Nationale des infrastructures Numérique et des Frequences
                </div>
            </div>
        </a>
        <span class="text-xs font-medium px-3 py-1 rounded-full" style="background:#e8f4fd; color:#0d6fa8; border:0.5px solid #b0d8f0;">
            Espace Agents
        </span>
    </header>

    {{-- Bande bleue décorative --}}
    <div class="fixed z-40" style="top:64px; left:0; right:0; height:3px; background:linear-gradient(90deg,#1a7fc1,#7dd3f8 60%,#fff);"></div>

    {{-- Contenu principal --}}
    <main class="flex-1 flex items-center justify-center pt-20 pb-8 px-4">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="text-center py-4" style="font-size:11.5px; color:#aac8dc; border-top:0.5px solid #d0e8f8; background:#fff;">
        <div class="flex items-center justify-center gap-2">
            {{-- Drapeau Gabon --}}
            <div class="flex gap-0.5 items-center">
                <div class="w-1.5 h-3 rounded-sm" style="background:#009e60;"></div>
                <div class="w-1.5 h-3 rounded-sm" style="background:#fcd116;"></div>
                <div class="w-1.5 h-3 rounded-sm" style="background:#3a75c4;"></div>
            </div>
            © {{ date('Y') }} — ANINF · Annuaire Numérique des Agents · République Gabonaise
        </div>
    </footer>

    @livewireScripts
</body>
</html>
