<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — Annuaire des Agents</title>
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

        /* ── PANNEAU GAUCHE ── */
        .left-panel {
            display: none;
            width: 42%;
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
            width: 480px; height: 480px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
            top: -100px; left: -100px;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 320px; height: 320px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            bottom: -60px; right: -60px;
        }

        .left-logo {
            width: 64px; height: 64px;
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
            position: relative; z-index: 1;
        }

        .left-title {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 2rem;
            color: var(--white);
            text-align: center;
            line-height: 1.2;
            margin-bottom: 1rem;
            position: relative; z-index: 1;
        }

        .left-subtitle {
            font-size: 0.92rem;
            color: rgba(255,255,255,0.65);
            text-align: center;
            line-height: 1.65;
            max-width: 280px;
            position: relative; z-index: 1;
        }

        .left-steps {
            margin-top: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            position: relative; z-index: 1;
            width: 100%;
            max-width: 280px;
        }

        .left-step {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .step-num {
            width: 26px; height: 26px;
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.35);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--white);
            flex-shrink: 0;
        }

        .step-text {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.75);
        }

        /* ── PANNEAU DROIT ── */
        .right-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            overflow-y: auto;
        }

        .register-box {
            width: 100%;
            max-width: 440px;
            padding: 2rem 0;
        }

        /* Logo mobile */
        .mobile-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
        }

        @media (min-width: 900px) { .mobile-logo { display: none; } }

        .mobile-logo-icon {
            width: 52px; height: 52px;
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

        /* Titre */
        .form-heading {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.6rem;
            color: var(--text);
            margin-bottom: 0.4rem;
        }

        .form-subheading {
            font-size: 0.88rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        /* Grille 2 colonnes pour nom + email */
        .fields-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 500px) { .fields-grid { grid-template-columns: 1fr; } }

        /* Champs */
        .field { margin-bottom: 1.15rem; }

        .field label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.4rem;
        }

        .field input {
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

        /* Séparateur mot de passe */
        .section-label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            margin: 1.5rem 0 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* Indicateur de force du mot de passe */
        .password-strength {
            display: flex;
            gap: 4px;
            margin-top: 0.5rem;
        }

        .strength-bar {
            height: 3px;
            flex: 1;
            border-radius: 2px;
            background: var(--border);
            transition: background 0.3s;
        }

        /* Bouton submit */
        .btn-register {
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
            margin-top: 1.5rem;
        }

        .btn-register:hover { opacity: 0.9; transform: translateY(-1px); }
        .btn-register:active { transform: translateY(0); }

        /* Lien connexion */
        .login-link {
            display: block;
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .login-link a {
            color: var(--sky);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.15s;
        }

        .login-link a:hover { color: var(--sky-dark); text-decoration: underline; }

        .login-footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.72rem;
            color: var(--text-muted);
            opacity: 0.7;
        }
    </style>
</head>
<body>

    <!-- Panneau gauche -->
    <div class="left-panel">
        <div class="left-logo">AN</div>
        <div class="left-title">Créer un<br>compte</div>
        <div class="left-subtitle">Rejoignez l'annuaire numérique centralisé de l'institution.</div>

        <div class="left-steps">
            <div class="left-step">
                <div class="step-num">1</div>
                <div class="step-text">Renseignez vos informations</div>
            </div>
            <div class="left-step">
                <div class="step-num">2</div>
                <div class="step-text">Créez un mot de passe sécurisé</div>
            </div>
            <div class="left-step">
                <div class="step-num">3</div>
                <div class="step-text">Accédez à l'annuaire</div>
            </div>
        </div>
    </div>

    <!-- Panneau droit -->
    <div class="right-panel">
        <div class="register-box">

            <!-- Logo mobile -->
            <div class="mobile-logo">
                <div class="mobile-logo-icon">AN</div>
                <div class="mobile-logo-text">Annuaire Numérique</div>
            </div>

            <h1 class="form-heading">Créer un compte</h1>
            <p class="form-subheading">Remplissez les informations ci-dessous pour vous inscrire.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nom -->
                <div class="field">
                    <label for="name">Nom complet</label>
                    <input id="name" type="text" name="name"
                           value="{{ old('name') }}"
                           required autofocus autocomplete="name"
                           placeholder="Jean Dupont" />
                    @error('name')
                    <div class="field-error">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="field">
                    <label for="email">Adresse e-mail</label>
                    <input id="email" type="email" name="email"
                           value="{{ old('email') }}"
                           required autocomplete="username"
                           placeholder="jean.dupont@institution.sn" />
                    @error('email')
                    <div class="field-error">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="section-label">Sécurité</div>

                <!-- Mot de passe -->
                <div class="field">
                    <label for="password">Mot de passe</label>
                    <input id="password" type="password" name="password"
                           required autocomplete="new-password"
                           placeholder="••••••••"
                           oninput="updateStrength(this.value)" />
                    <div class="password-strength">
                        <div class="strength-bar" id="bar1"></div>
                        <div class="strength-bar" id="bar2"></div>
                        <div class="strength-bar" id="bar3"></div>
                        <div class="strength-bar" id="bar4"></div>
                    </div>
                    @error('password')
                    <div class="field-error">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Confirmation mot de passe -->
                <div class="field">
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                    <input id="password_confirmation" type="password"
                           name="password_confirmation"
                           required autocomplete="new-password"
                           placeholder="••••••••" />
                    @error('password_confirmation')
                    <div class="field-error">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn-register">
                    Créer mon compte
                </button>

            </form>

            <div class="login-link">
                Déjà inscrit ? <a href="{{ route('login') }}">Se connecter</a>
            </div>

            <div class="login-footer">
                © {{ date('Y') }} — Annuaire Numérique des Agents de l'Institution
            </div>

        </div>
    </div>

    <script>
        function updateStrength(val) {
            const bars = [
                document.getElementById('bar1'),
                document.getElementById('bar2'),
                document.getElementById('bar3'),
                document.getElementById('bar4'),
            ];
            let score = 0;
            if (val.length >= 8)  score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const colors = ['#ef4444', '#f97316', '#eab308', '#22c55e'];
            bars.forEach((bar, i) => {
                bar.style.background = i < score ? colors[score - 1] : 'var(--border)';
            });
        }
    </script>

</body>
</html>