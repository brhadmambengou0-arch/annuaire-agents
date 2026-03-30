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
        .font-display { font-family: 'Playfair Display', serif; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #b0d8f0; border-radius: 4px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="flex flex-col min-h-screen" style="background:#f0f6fc;">

    {{-- TOPBAR --}}
    <header class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-6"
            style="height:60px;background:#fff;border-bottom:1.5px solid #c8e1f5;">
        <div class="flex items-center gap-3">
            <a href="{{ route('annuaire.index') }}" class="flex items-center gap-3 no-underline">
                <div class="flex items-center justify-center rounded-xl flex-shrink-0"
                     style="width:38px;height:38px;background:#1a7fc1;">
                    <svg class="w-5 h-5 fill-white" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/>
                    </svg>
                </div>
                <div>
                    <div class="font-display font-semibold leading-none" style="font-size:16px;color:#0d4f7c;">ANINF</div>
                    <div class="uppercase tracking-widest hidden md:block" style="font-size:10px;color:#7aaecc;">Annuaire numérique des agents</div>
                </div>
            </a>
        </div>
        <div class="flex items-center gap-3">
            @if(auth()->user()->role === 'admin')
                <span class="text-xs font-medium px-3 py-1 rounded-full hidden sm:inline"
                      style="background:#e8f4fd;color:#0d6fa8;border:0.5px solid #b0d8f0;">Admin</span>
            @endif
            <div class="flex items-center gap-2 text-sm" style="color:#4a7fa0;">
                <div class="flex items-center justify-center rounded-full font-semibold text-xs text-white"
                     style="width:32px;height:32px;background:#1a7fc1;flex-shrink:0;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <span class="hidden md:inline">{{ auth()->user()->name }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="flex items-center gap-1.5 text-xs px-3 py-1.5 rounded-lg transition"
                        style="color:#7aaecc;border:0.5px solid #d0e8f8;background:#fff;cursor:pointer;"
                        onmouseover="this.style.background='#f0f7fd'"
                        onmouseout="this.style.background='#fff'">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                    </svg>
                    <span class="hidden sm:inline">Déconnexion</span>
                </button>
            </form>
        </div>
    </header>

    <div class="fixed z-40" style="top:60px;left:0;right:0;height:3px;background:linear-gradient(90deg,#1a7fc1,#7dd3f8 60%,#fff);"></div>

    <div class="flex" style="margin-top:63px;min-height:calc(100vh - 63px);">

        {{-- SIDEBAR --}}
        <aside class="sidebar-scroll flex flex-col flex-shrink-0 overflow-y-auto"
               style="width:240px;background:#fff;border-right:1px solid #d0e8f8;position:sticky;top:63px;height:calc(100vh - 63px);">
            <div class="p-3" style="border-bottom:0.5px solid #e0eff8;">
                <div class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:#4a7fa0;">Vue d'ensemble</div>
                <div class="grid grid-cols-2 gap-1.5">
                    <div class="rounded-lg p-2" style="background:#f0f7fd;">
                        <div class="font-semibold text-lg leading-none" style="color:#0d4f7c;">{{ \App\Models\Agent::where('is_active',true)->count() }}</div>
                        <div class="text-xs uppercase tracking-wide mt-0.5" style="color:#7aaecc;">Agents</div>
                    </div>
                    <div class="rounded-lg p-2" style="background:#f0f7fd;">
                        <div class="font-semibold text-lg leading-none" style="color:#0d4f7c;">{{ \App\Models\Entity::roots()->count() }}</div>
                        <div class="text-xs uppercase tracking-wide mt-0.5" style="color:#7aaecc;">Directions</div>
                    </div>
                </div>
            </div>
            <nav class="flex-1 p-2">
                <div class="text-xs font-semibold uppercase tracking-widest px-2 py-2" style="color:#7aaecc;">Structures</div>
                <a href="{{ route('annuaire.index') }}"
                   class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm mb-0.5"
                   style="color:#3a6a8a;{{ request()->routeIs('annuaire.index') && !request()->entity_id ? 'background:#e8f4fd;color:#0d4f7c;font-weight:500;' : '' }}">
                    <svg class="w-3.5 h-3.5 fill-current flex-shrink-0" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                    Toutes les directions
                </a>
                @foreach(\App\Models\Entity::roots()->with('childrenRecursive')->get() as $direction)
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                                class="w-full flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm mb-0.5 text-left"
                                style="color:#3a6a8a;background:none;border:none;cursor:pointer;">
                            <div class="w-2 h-2 rounded-full flex-shrink-0" style="background:#1a7fc1;"></div>
                            <span class="flex-1 truncate">{{ $direction->nom }}</span>
                            <svg class="w-3 h-3 fill-current flex-shrink-0 transition-transform" :class="open?'rotate-180':''" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>
                        </button>
                        <div x-show="open" x-cloak>
                            @foreach($direction->children as $child)
                                <a href="{{ route('annuaire.index', ['entity_id' => $child->id]) }}"
                                   class="flex items-center gap-2 px-2 py-1 rounded-lg text-xs mb-0.5 ml-4"
                                   style="color:#5a8aa8;">
                                    <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#7dd3f8;"></div>
                                    <span class="truncate">{{ $child->nom }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                @if(auth()->user()->role === 'admin')
                    <div class="text-xs font-semibold uppercase tracking-widest px-2 mt-3 mb-1" style="color:#7aaecc;padding-top:10px;border-top:0.5px solid #e0eff8;">Administration</div>
                    <a href="{{ route('admin.entities') }}"
                       class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm mb-0.5"
                       style="color:#3a6a8a;{{ request()->routeIs('admin.entities') ? 'background:#e8f4fd;color:#0d4f7c;' : '' }}">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10z"/></svg>
                        Gérer les structures
                    </a>
                    <a href="{{ route('admin.fonctions') }}"
                       class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm mb-0.5"
                       style="color:#3a6a8a;{{ request()->routeIs('admin.fonctions') ? 'background:#e8f4fd;color:#0d4f7c;' : '' }}">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg>
                        Référentiel fonctions
                    </a>
                @endif
            </nav>
        </aside>

        {{-- CONTENU --}}
        <main class="flex-1 min-w-0">{{ $slot }}</main>
    </div>

    {{-- TOAST --}}
    <x-toast />

    @livewireScripts
</body>
</html>
