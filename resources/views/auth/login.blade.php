<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANINF — Connexion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #f0f9ff;
            overflow: hidden;
        }

        /* ── PANNEAU GAUCHE ── */
        .left-panel {
            width: 44%;
            background: #0369a1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2.5rem 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .left-panel::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 280px; height: 280px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            pointer-events: none;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -60px; left: -60px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            pointer-events: none;
        }
        .deco-ring {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.07);
            pointer-events: none;
        }
        .deco-1 { width: 200px; height: 200px; top: 30%; left: 5%; }
        .deco-2 { width: 110px; height: 110px; top: 15%; right: 10%; }
        .deco-3 { width: 60px;  height: 60px;  bottom: 28%; right: 18%; }

        .brand-logo {
            position: relative;
            z-index: 2;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: white;
            border: none;
            border-radius: 12px;
            padding: 10px 14px;
            margin-bottom: 1.5rem;
            box-shadow: 0 3px 12px rgba(0,0,0,0.12);
        }
        .brand-logo img {
            width: 55px;
            height: 55px;
            object-fit: contain;
            flex-shrink: 0;
        }
        .brand-name {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            color: #0369a1;
            letter-spacing: 0.06em;
            line-height: 1;
        }
        .brand-sub {
            font-size: 0.62rem;
            color: #64748b;
            font-weight: 400;
            line-height: 1.4;
            margin-top: 3px;
        }

        .left-content { position: relative; z-index: 2; }
        .left-content h1 {
            font-family: 'Sora', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: white;
            line-height: 1.25;
            margin-bottom: 0.5rem;
        }
        .left-content h1 em { font-style: normal; color: #7dd3fc; }
        .left-content p {
            color: rgba(255,255,255,0.68);
            font-size: 0.78rem;
            line-height: 1.55;
            max-width: 280px;
        }

        .features {
            position: relative;
            z-index: 2;
            margin-top: 1.8rem;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 10px;
            transition: background 0.2s;
        }
        .feature-item:hover { background: rgba(255,255,255,0.07); }
        .feature-icon {
            width: 32px; height: 32px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .feature-text strong {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: white;
        }
        .feature-text span {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.5);
        }

        .stats-bar {
            position: relative;
            z-index: 2;
            display: flex;
            background: rgba(0,0,0,0.18);
            border-radius: 12px;
            overflow: hidden;
        }
        .stat-item { flex: 1; text-align: center; padding: 10px 0; }
        .stat-item + .stat-item { border-left: 1px solid rgba(255,255,255,0.1); }
        .stat-num {
            font-family: 'Sora', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            line-height: 1;
        }
        .stat-lbl { font-size: 0.68rem; color: rgba(255,255,255,0.55); margin-top: 2px; }

        /* ── PANNEAU DROIT ── */
        .right-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: #f8fafc;
            overflow-y: auto;
        }
        .login-box { width: 100%; max-width: 390px; }

        .welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #e0f2fe;
            color: #0369a1;
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            margin-bottom: 1rem;
        }
        .login-title {
            font-family: 'Sora', sans-serif;
            font-size: 1.7rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }
        .login-subtitle {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 1.6rem;
        }
        .login-subtitle strong { color: #0284c7; font-weight: 600; }

        .alert-error {
            background: #fff5f5;
            border: 1px solid #fed7d7;
            border-left: 4px solid #ef4444;
            border-radius: 10px;
            padding: 0.8rem 1rem;
            font-size: 0.82rem;
            color: #c53030;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
        }

        .form-group { margin-bottom: 1rem; }
        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 5px;
        }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute;
            left: 12px; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
            display: flex;
        }
        .form-input {
            width: 100%;
            padding: 0.68rem 1rem 0.68rem 2.5rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.87rem;
            color: #0f172a;
            background: white;
            transition: all 0.2s;
            outline: none;
            font-family: 'DM Sans', sans-serif;
        }
        .form-input::placeholder { color: #b0bec5; }
        .form-input:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14,165,233,0.12);
        }
        .form-input.has-error { border-color: #ef4444; }
        .form-error {
            color: #ef4444;
            font-size: 0.74rem;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .password-toggle {
            position: absolute;
            right: 11px; top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            display: flex;
            padding: 3px;
            transition: color 0.2s;
        }
        .password-toggle:hover { color: #0ea5e9; }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.3rem;
            margin-top: 0.3rem;
        }
        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.82rem;
            color: #64748b;
            cursor: pointer;
        }
        .checkbox-label input { accent-color: #0ea5e9; width: 14px; height: 14px; }
        .forgot-link {
            font-size: 0.8rem;
            color: #0284c7;
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-link:hover { text-decoration: underline; }

        /* ── BOUTONS CÔTE À CÔTE ── */
        .btn-row { display: flex; gap: 10px; }

        .btn-login {
            flex: 1;
            padding: 0.75rem 1rem;
            background: linear-gradient(135deg, #0369a1, #0ea5e9);
            color: white;
            border: none;
            border-radius: 10px;
            font-family: 'Sora', sans-serif;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(14,165,233,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14,165,233,0.4);
        }
        .btn-login:active { transform: translateY(0); }

        .btn-register {
            flex: 1;
            padding: 0.75rem 1rem;
            background: white;
            color: #0284c7;
            border: 1.5px solid #bae6fd;
            border-radius: 10px;
            font-family: 'Sora', sans-serif;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
        }
        .btn-register:hover {
            background: #e0f2fe;
            border-color: #0ea5e9;
            color: #0369a1;
            transform: translateY(-2px);
        }
        .btn-register:active { transform: translateY(0); }

        .login-footer {
            margin-top: 1.6rem;
            text-align: center;
            font-size: 0.72rem;
            color: #94a3b8;
            padding-top: 1.2rem;
            border-top: 1px solid #f1f5f9;
            line-height: 1.6;
        }
        .login-footer strong { color: #0284c7; font-weight: 600; }

        .stats-bar {
            position: relative;
            z-index: 2;
            display: flex;
            background: rgba(0,0,0,0.18);
            border-radius: 12px;
            overflow: hidden;
        }
        .stat-item { flex: 1; text-align: center; padding: 10px 0; }
        .stat-item + .stat-item { border-left: 1px solid rgba(255,255,255,0.1); }
        .stat-num {
            font-family: 'Sora', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            line-height: 1;
        }
        .stat-lbl { font-size: 0.68rem; color: rgba(255,255,255,0.55); margin-top: 2px; }

        /* ── TABLETTE ── */
        @media (max-width: 1024px) {
            .left-panel { width: 40%; padding: 2rem; }
            .left-content h1 { font-size: 1.5rem; }
            .brand-logo img { width: 70px; height: 70px; }
        }

        /* ── MOBILE LARGE ── */
        @media (max-width: 900px) {
            body { overflow: auto; flex-direction: column; }
            .left-panel {
                width: 100%;
                padding: 1.5rem;
                min-height: auto;
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }
            .left-panel .features { display: none; }
            .left-content h1 { font-size: 1.4rem; }
            .left-content p { display: none; }
            .stats-bar {
                display: flex !important;
                margin-top: 0.8rem;
                width: 100%;
            }
            .stat-item { padding: 10px 0; }
            .stat-num { font-size: 1.3rem; }
            .stat-lbl { font-size: 0.68rem; }
            .right-panel {
                padding: 2rem 1.5rem;
                background: #f0f9ff;
                min-height: auto;
            }
        }

        /* ── MOBILE ── */
        @media (max-width: 600px) {
            .left-panel { padding: 1.2rem; }
            .brand-logo {
                padding: 12px 16px;
                gap: 12px;
            }
            .brand-logo img { width: 55px; height: 55px; }
            .brand-name { font-size: 1.2rem; }
            .brand-sub { font-size: 0.62rem; }
            .left-content h1 { font-size: 1.2rem; }
            .stat-num { font-size: 1.2rem; }
            .right-panel { padding: 1.5rem 1rem; }
            .login-title { font-size: 1.4rem; }
            .btn-row { flex-direction: column; }
        }

        /* ── TRES PETIT MOBILE ── */
        @media (max-width: 380px) {
            .brand-logo img { width: 45px; height: 45px; }
            .brand-name { font-size: 1rem; }
            .login-title { font-size: 1.2rem; }
            .right-panel { padding: 1rem 0.8rem; }
        }
    </style>
</head>
<body>

    {{-- PANNEAU GAUCHE --}}
    <div class="left-panel">
        <div class="deco-ring deco-1"></div>
        <div class="deco-ring deco-2"></div>
        <div class="deco-ring deco-3"></div>

        <div>
            {{-- LOGO PROPRE SANS DUPLICATION --}}
            <div class="brand-logo">
                <img src="{{ asset('images/log2.png') }}" alt="Logo ANINF">
                <div>
                    <div class="brand-name">ANINF</div>
                    <div class="brand-sub">Agence Nationale des Infrastructure<br>Numériques et des Fréquences</div>
                </div>
            </div>

            <div class="left-content">
                <h1>Annuaire <em>Numérique</em><br>des Agents</h1>
                <p>Plateforme centralisée de consultation et gestion des agents de l'institution. Trouvez rapidement un collègue, son service et ses coordonnées.</p>
            </div>

            <div class="features">
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg width="15" height="15" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <strong>Recherche en temps réel</strong>
                        <span>Par nom, matricule, service ou fonction</span>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg width="15" height="15" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <strong>Structure hiérarchique</strong>
                        <span>Directions, Services, Départements</span>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg width="15" height="15" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0110 0v4"/>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <strong>Accès sécurisé par rôle</strong>
                        <span>Administrateur et Consultant</span>
                    </div>
                </div>
            </div>

            <div class="stats-bar">
                <div class="stat-item">
                    <div class="stat-num">15+</div>
                    <div class="stat-lbl">Agents</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num">6</div>
                    <div class="stat-lbl">Directions</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num">13</div>
                    <div class="stat-lbl">Fonctions</div>
                </div>
            </div>
        </div>
    </div>

    {{-- PANNEAU DROIT --}}
    <div class="right-panel">
        <div class="login-box">

            <div class="welcome-badge">
                <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                Espace Agents ANINF
            </div>

            <div class="login-title">Bienvenue</div>
            <div class="login-subtitle">
                Connectez-vous avec vos identifiants <strong>ANINF</strong> pour accéder à l'annuaire.
            </div>

            @if ($errors->any())
            <div class="alert-error">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:1px;">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <div>@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" x-data="{ showPass: false }">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </span>
                        <input id="email" name="email" type="email"
                               value="{{ old('email') }}"
                               placeholder="votre.nom@aninf.ga"
                               class="form-input {{ $errors->has('email') ? 'has-error' : '' }}"
                               autocomplete="email" required autofocus>
                    </div>
                    @error('email')<div class="form-error"><svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg>{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0110 0v4"/>
                            </svg>
                        </span>
                        <input id="password" name="password"
                               :type="showPass ? 'text' : 'password'"
                               placeholder="••••••••"
                               class="form-input {{ $errors->has('password') ? 'has-error' : '' }}"
                               autocomplete="current-password" required>
                        <button type="button" class="password-toggle" @click="showPass = !showPass">
                            <template x-if="!showPass">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </template>
                            <template x-if="showPass">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                            </template>
                        </button>
                    </div>
                    @error('password')<div class="form-error"><svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg>{{ $message }}</div>@enderror
                </div>

                <div class="remember-row">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember"> Se souvenir de moi
                    </label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Mot de passe oublié ?</a>
                    @endif
                </div>

                {{-- BOUTONS CÔTE À CÔTE --}}
                <div class="btn-row">
                    <button type="submit" class="btn-login">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3"/>
                        </svg>
                        Se connecter
                    </button>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-register">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="8.5" cy="7" r="4"/>
                            <line x1="20" y1="8" x2="20" y2="14"/>
                            <line x1="23" y1="11" x2="17" y2="11"/>
                        </svg>
                        S'inscrire
                    </a>
                    @endif
                </div>
            </form>

            <div class="login-footer">
                <p>© {{ date('Y') }} <strong>ANINF</strong> — Tous droits réservés</p>
                <p>Agence Nationale des Infrastructures Numériques et des Fréquences</p>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>