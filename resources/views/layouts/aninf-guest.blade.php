<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title ?? 'ANINF — Annuaire Numérique' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .aninf-display { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col" style="background:#f4f8fd;">

    <!-- Topbar -->
    <header class="w-full flex items-center justify-between px-6 flex-shrink-0"
            style="height:60px;background:#fff;border-bottom:1.5px solid #d0e8f8;">
        <a href="/" class="flex items-center gap-3" style="text-decoration:none;">
            <div class="flex items-center justify-center rounded-xl"
                 style="width:36px;height:36px;background:#1a7fc1;flex-shrink:0;">
                <svg style="width:18px;height:18px;fill:#fff;" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/>
                </svg>
            </div>
            <div>
                <div class="aninf-display font-semibold" style="font-size:15px;color:#0d4f7c;line-height:1.1;">ANINF</div>
                <div class="hidden sm:block uppercase tracking-widest" style="font-size:9px;color:#7aaecc;">
                    Agence Nationale de l'Infrastructure Numérique
                </div>
            </div>
        </a>
        <span class="text-xs font-medium px-3 py-1 rounded-full"
              style="background:#e8f4fd;color:#0d6fa8;border:0.5px solid #b0d8f0;">
            Espace Agents
        </span>
    </header>

    <!-- Bande décorative -->
    <div style="height:3px;background:linear-gradient(90deg,#1a7fc1,#7dd3f8 60%,#f4f8fd);flex-shrink:0;"></div>

    <!-- Contenu -->
    <main class="flex-1 flex items-center justify-center px-4 py-8">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="text-center py-4 flex-shrink-0"
            style="font-size:11px;color:#aac8dc;border-top:0.5px solid #d0e8f8;background:#fff;">
        <div class="flex items-center justify-center gap-2">
            <div class="flex gap-0.5 items-center">
                <div style="width:5px;height:11px;border-radius:1px;background:#009e60;"></div>
                <div style="width:5px;height:11px;border-radius:1px;background:#fcd116;"></div>
                <div style="width:5px;height:11px;border-radius:1px;background:#3a75c4;"></div>
            </div>
            © {{ date('Y') }} — ANINF · Annuaire Numérique des Agents · République Gabonaise
        </div>
    </footer>

    @livewireScripts
</body>
</html>