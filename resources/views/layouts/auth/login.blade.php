<x-layouts.aninf-guest>
    <x-slot name="title">Connexion — ANINF</x-slot>

    <div class="w-full" style="max-width:420px;">
        <div class="rounded-2xl" style="background:#fff;border:1px solid #d0e8f8;overflow:hidden;
             box-shadow:0 2px 4px rgba(13,79,124,.04),0 8px 32px rgba(13,79,124,.07);">

            <!-- En-tête -->
            <div class="text-center px-8 pt-8 pb-5">
                <div class="flex items-center justify-center mx-auto mb-4 rounded-full"
                     style="width:62px;height:62px;background:#1a7fc1;border:3px solid #e8f4fd;">
                    <svg style="width:28px;height:28px;fill:#fff;" viewBox="0 0 24 24">
                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                    </svg>
                </div>
                <h1 class="aninf-display font-semibold mb-1" style="font-size:21px;color:#0d4f7c;">
                    Connexion au portail
                </h1>
                <p style="font-size:13px;color:#7aaecc;">Annuaire Numérique des Agents de l'ANINF</p>
            </div>

            <div class="px-8 pb-8">
                <!-- Bannière sécurisée -->
                <div class="flex items-center gap-3 rounded-xl px-3 py-2.5 mb-5"
                     style="background:#e8f4fd;border:0.5px solid #b0d8f0;">
                    <div class="rounded-full flex-shrink-0"
                         style="width:8px;height:8px;background:#1a7fc1;box-shadow:0 0 0 3px rgba(26,143,209,.2);"></div>
                    <span style="font-size:11px;font-weight:500;color:#0d6fa8;">
                        Accès sécurisé — réservé aux agents habilités de l'ANINF
                    </span>
                </div>

                <!-- Erreurs -->
                @if($errors->any())
                    <div class="rounded-xl px-4 py-3 mb-4" style="background:#fef2f2;border:0.5px solid #fecaca;color:#dc2626;font-size:13px;">
                        @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" style="display:block;font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.07em;color:#4a7fa0;margin-bottom:6px;">
                            Identifiant (email)
                        </label>
                        <div style="position:relative;">
                            <svg style="position:absolute;left:11px;top:50%;transform:translateY(-50%);width:14px;height:14px;fill:#b0cfe0;" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                            <input id="email" name="email" type="email"
                                   value="{{ old('email') }}" required autofocus
                                   placeholder="votre.email@aninf.ga"
                                   style="width:100%;height:44px;border:1px solid {{ $errors->has('email') ? '#fca5a5' : '#d0e8f8' }};
                                          border-radius:10px;padding:0 12px 0 34px;font-size:13px;color:#0d4f7c;
                                          background:#f9fcff;outline:none;font-family:'DM Sans',sans-serif;"
                                   onfocus="this.style.borderColor='#1a7fc1';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.1)'"
                                   onblur="this.style.borderColor='#d0e8f8';this.style.boxShadow='none'" />
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-4">
                        <label for="password" style="display:block;font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.07em;color:#4a7fa0;margin-bottom:6px;">
                            Mot de passe
                        </label>
                        <div style="position:relative;">
                            <svg style="position:absolute;left:11px;top:50%;transform:translateY(-50%);width:14px;height:14px;fill:#b0cfe0;" viewBox="0 0 24 24">
                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                            </svg>
                            <input id="password" name="password" type="password"
                                   required placeholder="••••••••••"
                                   style="width:100%;height:44px;border:1px solid #d0e8f8;
                                          border-radius:10px;padding:0 12px 0 34px;font-size:13px;color:#0d4f7c;
                                          background:#f9fcff;outline:none;font-family:'DM Sans',sans-serif;"
                                   onfocus="this.style.borderColor='#1a7fc1';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.1)'"
                                   onblur="this.style.borderColor='#d0e8f8';this.style.boxShadow='none'" />
                        </div>
                    </div>

                    <!-- Souvenir + oublié -->
                    <div class="flex items-center justify-between mb-5">
                        <label class="flex items-center gap-2 cursor-pointer" style="font-size:13px;color:#5a8aa8;">
                            <input type="checkbox" name="remember" style="accent-color:#1a7fc1;width:14px;height:14px;" />
                            Se souvenir de moi
                        </label>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               style="font-size:13px;font-weight:500;color:#1a7fc1;text-decoration:none;">
                                Mot de passe oublié ?
                            </a>
                        @endif
                    </div>

                    <!-- Bouton connexion -->
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2"
                            style="height:46px;background:#1a7fc1;color:#fff;border:none;border-radius:10px;
                                   font-size:14px;font-weight:600;font-family:'DM Sans',sans-serif;cursor:pointer;"
                            onmouseover="this.style.opacity='.9'"
                            onmouseout="this.style.opacity='1'"
                            onmousedown="this.style.transform='scale(.98)'"
                            onmouseup="this.style.transform='scale(1)'">
                        <svg style="width:15px;height:15px;fill:rgba(255,255,255,.8);" viewBox="0 0 24 24">
                            <path d="M11 7L9.6 8.4l2.6 2.6H2v2h10.2l-2.6 2.6L11 17l5-5-5-5zm9 12h-8v2h8c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-8v2h8v14z"/>
                        </svg>
                        Se connecter
                    </button>
                </form>

                <!-- Séparateur -->
                <div class="flex items-center gap-3 my-4">
                    <div class="flex-1" style="height:0.5px;background:#d0e8f8;"></div>
                    <span style="font-size:11px;color:#b0cfe0;">ou</span>
                    <div class="flex-1" style="height:0.5px;background:#d0e8f8;"></div>
                </div>

                <div class="text-center" style="font-size:13px;color:#8ab2c8;">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}"
                       style="font-weight:500;color:#1a7fc1;text-decoration:none;">
                        Demander un accès
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.aninf-guest>