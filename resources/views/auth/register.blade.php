<x-layouts.aninf-guest>
    <x-slot name="title">Demande d'accès — ANINF</x-slot>

    <div class="w-full" style="max-width:420px;">
        <div class="rounded-2xl" style="background:#fff;border:1px solid #d0e8f8;overflow:hidden;
             box-shadow:0 2px 4px rgba(13,79,124,.04),0 8px 32px rgba(13,79,124,.07);">

            <div class="text-center px-8 pt-8 pb-5">
                <div class="flex items-center justify-center mx-auto mb-4 rounded-full"
                     style="width:62px;height:62px;background:#1a7fc1;border:3px solid #e8f4fd;">
                    <svg style="width:28px;height:28px;fill:#fff;" viewBox="0 0 24 24">
                        <path d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-9-2V7H4v3H1v2h3v3h2v-3h3v-2H6zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <h1 class="aninf-display font-semibold mb-1" style="font-size:21px;color:#0d4f7c;">
                    Demande d'accès
                </h1>
                <p style="font-size:13px;color:#7aaecc;">Créer un compte agent ANINF</p>
            </div>

            <div class="px-8 pb-8">
                @if($errors->any())
                    <div class="rounded-xl px-4 py-3 mb-4" style="background:#fef2f2;border:0.5px solid #fecaca;color:#dc2626;font-size:13px;">
                        @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-4">
                        <label style="display:block;font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.07em;color:#4a7fa0;margin-bottom:6px;">Nom complet *</label>
                        <input name="name" type="text" value="{{ old('name') }}" required autofocus
                               placeholder="Prénom NOM"
                               style="width:100%;height:44px;border:1px solid #d0e8f8;border-radius:10px;padding:0 12px;font-size:13px;color:#0d4f7c;background:#f9fcff;outline:none;font-family:'DM Sans',sans-serif;"
                               onfocus="this.style.borderColor='#1a7fc1';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.1)'"
                               onblur="this.style.borderColor='#d0e8f8';this.style.boxShadow='none'" />
                    </div>

                    <div class="mb-4">
                        <label style="display:block;font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.07em;color:#4a7fa0;margin-bottom:6px;">Email *</label>
                        <input name="email" type="email" value="{{ old('email') }}" required
                               placeholder="votre.email@aninf.ga"
                               style="width:100%;height:44px;border:1px solid #d0e8f8;border-radius:10px;padding:0 12px;font-size:13px;color:#0d4f7c;background:#f9fcff;outline:none;font-family:'DM Sans',sans-serif;"
                               onfocus="this.style.borderColor='#1a7fc1';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.1)'"
                               onblur="this.style.borderColor='#d0e8f8';this.style.boxShadow='none'" />
                    </div>

                    <div class="mb-4">
                        <label style="display:block;font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.07em;color:#4a7fa0;margin-bottom:6px;">Mot de passe *</label>
                        <input name="password" type="password" required
                               placeholder="Minimum 8 caractères"
                               style="width:100%;height:44px;border:1px solid #d0e8f8;border-radius:10px;padding:0 12px;font-size:13px;color:#0d4f7c;background:#f9fcff;outline:none;font-family:'DM Sans',sans-serif;"
                               onfocus="this.style.borderColor='#1a7fc1';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.1)'"
                               onblur="this.style.borderColor='#d0e8f8';this.style.boxShadow='none'" />
                    </div>

                    <div class="mb-6">
                        <label style="display:block;font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.07em;color:#4a7fa0;margin-bottom:6px;">Confirmation *</label>
                        <input name="password_confirmation" type="password" required
                               placeholder="Répétez le mot de passe"
                               style="width:100%;height:44px;border:1px solid #d0e8f8;border-radius:10px;padding:0 12px;font-size:13px;color:#0d4f7c;background:#f9fcff;outline:none;font-family:'DM Sans',sans-serif;"
                               onfocus="this.style.borderColor='#1a7fc1';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.1)'"
                               onblur="this.style.borderColor='#d0e8f8';this.style.boxShadow='none'" />
                    </div>

                    <button type="submit"
                            class="w-full"
                            style="height:46px;background:#1a7fc1;color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:600;font-family:'DM Sans',sans-serif;cursor:pointer;"
                            onmouseover="this.style.opacity='.9'" onmouseout="this.style.opacity='1'">
                        Créer mon compte
                    </button>
                </form>

                <div class="text-center mt-5" style="font-size:13px;color:#8ab2c8;">
                    Déjà un compte ?
                    <a href="{{ route('login') }}" style="font-weight:500;color:#1a7fc1;text-decoration:none;">
                        Se connecter
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.aninf-guest>