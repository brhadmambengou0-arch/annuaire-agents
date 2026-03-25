<x-layouts.auth>
    <x-slot name="title">Connexion — ANINF</x-slot>

    <div class="w-full" style="max-width:420px;">
        <div class="rounded-2xl overflow-hidden"
             style="background:#fff;border:1px solid #d0e8f8;box-shadow:0 2px 4px rgba(13,79,124,.04),0 8px 32px rgba(13,79,124,.07);">

            {{-- En-tête --}}
            <div class="text-center px-8 pt-8 pb-6">
                <div class="flex items-center justify-center mx-auto mb-4 rounded-full"
                     style="width:68px;height:68px;background:#1a7fc1;border:3px solid #e8f4fd;box-shadow:0 4px 16px rgba(26,143,209,.25);">
                    <svg class="w-8 h-8 fill-white" viewBox="0 0 24 24">
                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                    </svg>
                </div>
                <h1 class="font-display font-semibold mb-1" style="font-size:22px;color:#0d4f7c;">Connexion au portail</h1>
                <p class="text-sm" style="color:#7aaecc;">Annuaire Numérique des Agents de l'ANINF</p>
            </div>

            <div class="px-8 pb-8">
                {{-- Bannière sécurisée --}}
                <div class="flex items-center gap-3 rounded-xl px-3 py-2.5 mb-6"
                     style="background:#e8f4fd;border:0.5px solid #b0d8f0;">
                    <div class="rounded-full flex-shrink-0"
                         style="width:8px;height:8px;background:#1a7fc1;box-shadow:0 0 0 3px rgba(26,143,209,.2);"></div>
                    <span class="text-xs font-medium" style="color:#0d6fa8;">
                        Accès sécurisé — réservé aux agents habilités de l'ANINF
                    </span>
                </div>

                {{-- Erreurs de validation --}}
                @if($errors->any())
                    <div class="rounded-xl px-4 py-3 mb-4 text-sm"
                         style="background:#fef2f2;border:0.5px solid #fecaca;color:#dc2626;">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                {{-- Formulaire --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Identifiant --}}
                    <div class="mb-4">
                        <label for="email" class="block text-xs font-semibold uppercase tracking-widest mb-1.5"
                               style="color:#4a7fa0;">
                            Identifiant (email)
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4" style="fill:#b0cfe0;" viewBox="0 0 24 24">
                                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                            </svg>
                            <input id="email" name="email" type="email"
                                   value="{{ old('email') }}" required autofocus autocomplete="username"
                                   placeholder="votre.email@aninf.ga"
                                   class="w-full pl-9 pr-3 rounded-xl text-sm transition outline-none"
                                   style="height:46px;border:1px solid #d0e8f8;background:#f9fcff;color:#0d4f7c;font-family:'DM Sans',sans-serif;"
                                   onfocus="this.style.borderColor='#1a7fc1';this.style.background='#fff';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.12)'"
                                   onblur="this.style.borderColor='#d0e8f8';this.style.background='#f9fcff';this.style.boxShadow='none'" />
                        </div>
                    </div>

                    {{-- Mot de passe --}}
                    <div class="mb-4">
                        <label for="password" class="block text-xs font-semibold uppercase tracking-widest mb-1.5"
                               style="color:#4a7fa0;">
                            Mot de passe
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4" style="fill:#b0cfe0;" viewBox="0 0 24 24">
                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                            </svg>
                            <input id="password" name="password" type="password"
                                   required autocomplete="current-password"
                                   placeholder="••••••••••"
                                   class="w-full pl-9 pr-3 rounded-xl text-sm transition outline-none"
                                   style="height:46px;border:1px solid #d0e8f8;background:#f9fcff;color:#0d4f7c;font-family:'DM Sans',sans-serif;"
                                   onfocus="this.style.borderColor='#1a7fc1';this.style.background='#fff';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.12)'"
                                   onblur="this.style.borderColor='#d0e8f8';this.style.background='#f9fcff';this.style.boxShadow='none'" />
                        </div>
                    </div>

                    {{-- Se souvenir + mot de passe oublié --}}
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center gap-2 text-sm cursor-pointer" style="color:#5a8aa8;">
                            <input type="checkbox" name="remember" style="accent-color:#1a7fc1;width:14px;height:14px;" />
                            Se souvenir de moi
                        </label>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-sm font-medium transition"
                               style="color:#1a7fc1;"
                               onmouseover="this.style.textDecoration='underline'"
                               onmouseout="this.style.textDecoration='none'">
                                Mot de passe oublié ?
                            </a>
                        @endif
                    </div>

                    {{-- Bouton connexion --}}
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 font-semibold rounded-xl transition"
                            style="height:48px;background:#1a7fc1;color:#fff;border:none;font-size:15px;font-family:'DM Sans',sans-serif;letter-spacing:.02em;cursor:pointer;"
                            onmouseover="this.style.opacity='.9'"
                            onmouseout="this.style.opacity='1'"
                            onmousedown="this.style.transform='scale(.98)'"
                            onmouseup="this.style.transform='scale(1)'">
                        <svg class="w-4 h-4 fill-white opacity-80" viewBox="0 0 24 24">
                            <path d="M11 7L9.6 8.4l2.6 2.6H2v2h10.2l-2.6 2.6L11 17l5-5-5-5zm9 12h-8v2h8c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-8v2h8v14z"/>
                        </svg>
                        Se connecter
                    </button>
                </form>

                {{-- Séparateur --}}
                <div class="flex items-center gap-3 my-5">
                    <div class="flex-1" style="height:0.5px;background:#d0e8f8;"></div>
                    <span class="text-xs" style="color:#b0cfe0;">ou</span>
                    <div class="flex-1" style="height:0.5px;background:#d0e8f8;"></div>
                </div>

                <div class="text-center text-sm" style="color:#8ab2c8;">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}"
                       class="font-medium transition"
                       style="color:#1a7fc1;"
                       onmouseover="this.style.textDecoration='underline'"
                       onmouseout="this.style.textDecoration='none'">
                        Demander un accès
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
