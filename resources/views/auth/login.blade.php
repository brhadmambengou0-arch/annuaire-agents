<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Annuaire des Agents</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        :root {
            --sky:        #0ea5e9;
            --sky-dark:   #0284c7;
            --sky-deeper: #0369a1;
            --sky-light:  #e0f2fe;
            --sky-pale:   #f0f9ff;
            --white:      #ffffff;
            --text:       #0c1a27;
            --text-muted: #5a7a8e;
            --border:     #bae6fd;
            --error:      #ef4444;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            background: var(--sky-pale);
        }

        /* ── PANNEAU GAUCHE (décoratif) ── */
        .left-panel {
            display: none;
            width: 45%;
            background: linear-gradient(160deg, var(--sky-deeper) 0%, var(--sky) 100%);
            position: relative;
            overflow: hidden;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
        }

        @media (min-width: 900px) { .left-panel { display: flex; } }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
            top: -120px;
            left: -120px;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            bottom: -80px;
            right: -80px;
        }

        .left-logo {
            width: 64px;
            height: 64px;
            background: var(--white);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--sky-deeper);
            margin-bottom: 2rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            position: relative;
            z-index: 1;
        }

        .left-title {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 2rem;
            color: var(--white);
            text-align: center;
            line-height: 1.2;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .left-subtitle {
            font-size: 0.95rem;
            color: rgba(255,255,255,0.65);
            text-align: center;
            line-height: 1.6;
            max-width: 300px;
            position: relative;
            z-index: 1;
        }

        .left-dots {
            display: flex;
            gap: 0.5rem;
            margin-top: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .left-dots span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,0.35);
        }

        .left-dots span:first-child { background: var(--white); width: 24px; border-radius: 4px; }

        /* ── PANNEAU DROIT (formulaire) ── */
        .right-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
        }

        /* Header mobile (logo visible seulement sur petit écran) */
        .mobile-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
        }

        @media (min-width: 900px) { .mobile-logo { display: none; } }

        .mobile-logo-icon {
            width: 52px;
            height: 52px;
            background: var(--sky);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            color: var(--white);
            margin-bottom: 0.75rem;
        }

        .mobile-logo-text {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--sky-deeper);
        }

        /* Titre du formulaire */
        .form-heading {
            margin-bottom: 0.4rem;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.6rem;
            color: var(--text);
        }

        .form-subheading {
            font-size: 0.88rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        /* Status message */
        .status-msg {
            background: var(--sky-light);
            border: 1px solid var(--border);
            color: var(--sky-deeper);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
        }

        /* Champs */
        .field { margin-bottom: 1.25rem; }

        .field label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.4rem;
            letter-spacing: 0.01em;
        }

        .field input[type="email"],
        .field input[type="password"] {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            background: var(--white);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .field input:focus {
            border-color: var(--sky);
            box-shadow: 0 0 0 3px rgba(14,165,233,0.15);
        }

        .field-error {
            font-size: 0.78rem;
            color: var(--error);
            margin-top: 0.35rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        /* Remember me */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .remember-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--sky);
            cursor: pointer;
        }

        .remember-row label {
            font-size: 0.85rem;
            color: var(--text-muted);
            cursor: pointer;
        }

        /* Bouton submit */
        .btn-login {
            width: 100%;
            padding: 0.78rem;
            background: linear-gradient(135deg, var(--sky-deeper), var(--sky));
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
            letter-spacing: 0.02em;
        }

        .btn-login:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .btn-login:active { transform: translateY(0); }

        /* Lien mot de passe oublié */
        .forgot-link {
            display: block;
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.83rem;
            color: var(--sky);
            text-decoration: none;
            transition: color 0.15s;
        }

        .forgot-link:hover { color: var(--sky-dark); text-decoration: underline; }

        /* Footer discret */
        .login-footer {
            margin-top: 2.5rem;
            text-align: center;
            font-size: 0.72rem;
            color: var(--text-muted);
            opacity: 0.7;
        }
    </style>
</head>
<body>

    <!-- Panneau gauche décoratif -->
    <div class="left-panel">
        <div class="left-logo">AN</div>
        <div class="left-title">Annuaire<br>Numérique</div>
        <div class="left-subtitle">
            Accédez à l'annuaire centralisé des agents de l'institution en toute sécurité.
        </div>
        <div class="left-dots">
            <span></span><span></span><span></span>
        </div>
    </div>

    <!-- Panneau droit — formulaire -->
    <div class="right-panel">
        <div class="login-box">

            <!-- Logo visible sur mobile -->
            <div class="mobile-logo">
                <div class="mobile-logo-icon">AN</div>
                <div class="mobile-logo-text">Annuaire Numérique</div>
            </div>

            <h1 class="form-heading">Connexion</h1>
            <p class="form-subheading">Entrez vos identifiants pour accéder à l'annuaire.</p>

            <!-- Status session -->
            @if(session('status'))
            <div class="status-msg">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="field">
                    <label for="email">Adresse e-mail</label>
                    <input id="email" type="email" name="email"
                           value="{{ old('email') }}"
                           required autofocus autocomplete="username"
                           placeholder="exemple@institution.sn" />
                    @error('email')
                    <div class="field-error">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div class="field">
                    <label for="password">Mot de passe</label>
                    <input id="password" type="password" name="password"
                           required autocomplete="current-password"
                           placeholder="••••••••" />
                    @error('password')
                    <div class="field-error">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Se souvenir de moi -->
                <div class="remember-row">
                    <input id="remember_me" type="checkbox" name="remember">
                    <label for="remember_me">Se souvenir de moi</label>
                </div>

                <!-- Bouton connexion -->
                <button type="submit" class="btn-login">
                    Se connecter
                </button>

                <!-- Mot de passe oublié -->
                @if (Route::has('password.request'))
                <a class="forgot-link" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
                @endif

            </form>

            <div class="login-footer">
                © {{ date('Y') }} — Annuaire Numérique des Agents de l'Institution
            </div>

        </div>
    </div>

</body>
</html>