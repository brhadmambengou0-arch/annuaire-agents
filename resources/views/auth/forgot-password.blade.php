<x-layouts.aninf-guest>
    <x-slot name="title">Mot de passe oublié — ANINF</x-slot>

    <div class="w-full" style="max-width:420px;">
        <div class="rounded-2xl" style="background:#fff;border:1px solid #d0e8f8;overflow:hidden;
             box-shadow:0 2px 4px rgba(13,79,124,.04),0 8px 32px rgba(13,79,124,.07);">

            <div class="text-center px-8 pt-8 pb-5">
                <div class="flex items-center justify-center mx-auto mb-4 rounded-full"
                     style="width:62px;height:62px;background:#e8f4fd;border:3px solid #d0e8f8;">
                    <svg style="width:28px;height:28px;fill:#1a7fc1;" viewBox="0 0 24 24">
                        <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                </div>
                <h1 class="aninf-display font-semibold mb-2" style="font-size:21px;color:#0d4f7c;">
                    Réinitialisation
                </h1>
                <p style="font-size:13px;color:#7aaecc;line-height:1.5;">
                    Entrez votre email pour recevoir un lien de réinitialisation.
                </p>
            </div>

            <div class="px-8 pb-8">
                @if(session('status'))
                    <div class="rounded-xl px-4 py-3 mb-4 flex items-center gap-2"
                         style="background:#f0fdf4;border:0.5px solid #bbf7d0;color:#166534;font-size:13px;">
                        <div style="width:7px;height:7px;border-radius:50%;background:#22c55e;flex-shrink:0;"></div>
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="rounded-xl px-4 py-3 mb-4" style="background:#fef2f2;border:0.5px solid #fecaca;color:#dc2626;font-size:13px;">
                        @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-5">
                        <label style="display:block;font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.07em;color:#4a7fa0;margin-bottom:6px;">Adresse email *</label>
                        <input name="email" type="email" value="{{ old('email') }}" required autofocus
                               placeholder="votre.email@aninf.ga"
                               style="width:100%;height:44px;border:1px solid #d0e8f8;border-radius:10px;padding:0 12px;font-size:13px;color:#0d4f7c;background:#f9fcff;outline:none;font-family:'DM Sans',sans-serif;"
                               onfocus="this.style.borderColor='#1a7fc1';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.1)'"
                               onblur="this.style.borderColor='#d0e8f8';this.style.boxShadow='none'" />
                    </div>
                    <button type="submit"
                            class="w-full"
                            style="height:46px;background:#1a7fc1;color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:600;font-family:'DM Sans',sans-serif;cursor:pointer;"
                            onmouseover="this.style.opacity='.9'" onmouseout="this.style.opacity='1'">
                        Envoyer le lien
                    </button>
                </form>

                <div class="text-center mt-5" style="font-size:13px;">
                    <a href="{{ route('login') }}" style="font-weight:500;color:#1a7fc1;text-decoration:none;">
                        ← Retour à la connexion
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.aninf-guest>
