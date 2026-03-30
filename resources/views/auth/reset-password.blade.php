<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe — Annuaire des Agents</title>
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
            align-items: center;
            justify-content: center;
            background: var(--sky-pale);
            padding: 2rem;
        }

        /* ── CARTE CENTRALE ── */
        .reset-card {
            width: 100%;
            max-width: 480px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 8px 40px rgba(14,165,233,0.1);
            overflow: hidden;
        }

        /* Bandeau haut coloré */
        .card-header {
            background: linear-gradient(135deg, var(--sky-deeper) 0%, var(--sky) 100%);
            padding: 2.5rem 2.5rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
            top: -60px; right: -60px;
        }

        .card-header::after {
            content: '';
            position: absolute;
            width: 120px; height: 120px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            bottom: -30px; left: 2rem;
        }

        .header-icon {
            width: 52px; height: 52px;
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.35);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.1rem;
            position: relative; z-index: 1;
        }

        .card-header h1 {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.55rem;
            color: var(--white);
            margin-bottom: 0.4rem;
            position: relative; z-index: 1;
        }

        .card-header p {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.65);
            line-height: 1.55;
            position: relative; z-index: 1;
        }

        /* Corps du formulaire */
        .card-body {
            padding: 2rem 2.5rem 2.5rem;
        }

        /* Champs */
        .field { margin-bottom: 1.2rem; }

        .field label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.4rem;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
        }

        .field input {
            width: 100%;
            padding: 0.72rem 1rem 0.72rem 2.5rem;
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

        .field input[readonly] {
            background: var(--sky-pale);
            color: var(--text-muted);
        }

        .field-error {
            font-size: 0.78rem;
            color: var(--error);
            margin-top: 0.35rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        /* Séparateur */
        .section-label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            margin: 1.5rem 0 1.1rem;
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

        /* Indicateur de force */
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

        /* Bouton */
        .btn-reset {
            width: 100%;
            padding: 0.8rem;
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
            margin-top: 1.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-reset:hover { opacity: 0.9; transform: translateY(-1px); }
        .btn-reset:active { transform: translateY(0); }

        /* Lien retour */
        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            margin-top: 1.25rem;
            font-size: 0.83rem;
            color: var(--sky);
            text-decoration: none;
            transition: color 0.15s;
        }

        .back-link:hover { color: var(--sky-dark); }

        .card-footer {
            padding: 1rem 2.5rem;
            border-top: 1px solid var(--border);
            text-align: center;
            font-size: 0.72rem;
            color: var(--text-muted);
            opacity: 0.7;
        }
    </style>
</head>
<body>

    <div class="reset-card">

        <!-- Bandeau haut -->
        <div class="card-header">
            <div class="header-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            </div>
            <h1>Nouveau mot de passe</h1>
            <p>Choisissez un mot de passe fort pour sécuriser votre compte.</p>
        </div>

        <!-- Formulaire -->
        <div class="card-body">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email (pré-rempli, lecture seule) -->
                <div class="field">
                    <label for="email">Adresse e-mail</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </span>
                        <input id="email" type="email" name="email"
                               value="{{ old('email', $request->email) }}"
                               required autofocus autocomplete="username"
                               placeholder="votre@email.com" />
                    </div>
                    @error('email')
                    <div class="field-error">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="section-label">Nouveau mot de passe</div>

                <!-- Nouveau mot de passe -->
                <div class="field">
                    <label for="password">Mot de passe</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </span>
                        <input id="password" type="password" name="password"
                               required autocomplete="new-password"
                               placeholder="••••••••"
                               oninput="updateStrength(this.value)" />
                    </div>
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

                <!-- Confirmation -->
                <div class="field">
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </span>
                        <input id="password_confirmation" type="password"
                               name="password_confirmation"
                               required autocomplete="new-password"
                               placeholder="••••••••" />
                    </div>
                    @error('password_confirmation')
                    <div class="field-error">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn-reset">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    Réinitialiser le mot de passe
                </button>

            </form>

            <a href="{{ route('login') }}" class="back-link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                Retour à la connexion
            </a>
        </div>

        <div class="card-footer">
            © {{ date('Y') }} — Annuaire Numérique des Agents de l'Institution
        </div>

    </div>

    <script>
        function updateStrength(val) {
            const bars = ['bar1','bar2','bar3','bar4'].map(id => document.getElementById(id));
            let score = 0;
            if (val.length >= 8)           score++;
            if (/[A-Z]/.test(val))         score++;
            if (/[0-9]/.test(val))         score++;
            if (/[^A-Za-z0-9]/.test(val))  score++;
            const colors = ['#ef4444','#f97316','#eab308','#22c55e'];
            bars.forEach((bar, i) => {
                bar.style.background = i < score ? colors[score - 1] : 'var(--border)';
            });
        }
    </script>

</body>
</html>