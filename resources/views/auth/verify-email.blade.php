<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification e-mail — Annuaire des Agents</title>
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
            --success:    #22c55e;
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

        /* ── CARTE ── */
        .verify-card {
            width: 100%;
            max-width: 460px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 8px 40px rgba(14,165,233,0.1);
            overflow: hidden;
        }

        /* Bandeau haut */
        .card-header {
            background: linear-gradient(135deg, var(--sky-deeper) 0%, var(--sky) 100%);
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .card-header::before {
            content: '';
            position: absolute;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
            top: -70px; right: -70px;
        }

        .card-header::after {
            content: '';
            position: absolute;
            width: 130px; height: 130px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            bottom: -40px; left: 1.5rem;
        }

        /* Icône enveloppe animée */
        .envelope-wrap {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 72px; height: 72px;
            background: rgba(255,255,255,0.2);
            border: 2px solid rgba(255,255,255,0.35);
            border-radius: 20px;
            margin: 0 auto 1.25rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-6px); }
        }

        .card-header h1 {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--white);
            margin-bottom: 0.5rem;
            position: relative; z-index: 1;
        }

        .card-header p {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.65);
            line-height: 1.6;
            max-width: 320px;
            margin: 0 auto;
            position: relative; z-index: 1;
        }

        /* Corps */
        .card-body { padding: 2rem 2.5rem 2.5rem; }

        /* Message de succès renvoi */
        .success-banner {
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            background: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: 10px;
            padding: 0.9rem 1rem;
            margin-bottom: 1.5rem;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .success-banner-icon {
            width: 20px; height: 20px;
            background: var(--success);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .success-banner p {
            font-size: 0.85rem;
            color: #166534;
            line-height: 1.5;
        }

        /* Étapes visuelles */
        .steps {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            margin-bottom: 2rem;
            padding: 1.25rem;
            background: var(--sky-pale);
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        .step-icon {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: var(--sky-light);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--sky-deeper);
        }

        .step-text {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.4;
        }

        .step-text strong {
            display: block;
            color: var(--text);
            font-weight: 600;
            font-size: 0.82rem;
        }

        /* Bouton renvoyer */
        .btn-resend {
            width: 100%;
            padding: 0.78rem;
            background: linear-gradient(135deg, var(--sky-deeper), var(--sky));
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: 0.92rem;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-resend:hover { opacity: 0.9; transform: translateY(-1px); }
        .btn-resend:active { transform: translateY(0); }

        /* Déconnexion */
        .logout-row {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1.25rem;
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: none;
            border: none;
            font-size: 0.83rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--text-muted);
            cursor: pointer;
            transition: color 0.15s;
            padding: 0.3rem 0.5rem;
            border-radius: 6px;
        }

        .btn-logout:hover { color: var(--error, #ef4444); }

        /* Footer */
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

    <div class="verify-card">

        <!-- Bandeau -->
        <div class="card-header">
            <div class="envelope-wrap">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
            </div>
            <h1>Vérifiez votre e-mail</h1>
            <p>Un lien de vérification a été envoyé à votre adresse e-mail. Consultez votre boîte de réception.</p>
        </div>

        <!-- Corps -->
        <div class="card-body">

            {{-- Message succès renvoi --}}
            @if(session('status') == 'verification-link-sent')
            <div class="success-banner">
                <div class="success-banner-icon">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <p>Un nouveau lien de vérification a été envoyé à votre adresse e-mail.</p>
            </div>
            @endif

            {{-- Étapes --}}
            <div class="steps">
                <div class="step">
                    <div class="step-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div class="step-text">
                        <strong>Ouvrez votre boîte e-mail</strong>
                        Cherchez un message de notre part
                    </div>
                </div>
                <div class="step">
                    <div class="step-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    </div>
                    <div class="step-text">
                        <strong>Cliquez sur le lien de vérification</strong>
                        Le lien est valable 60 minutes
                    </div>
                </div>
                <div class="step">
                    <div class="step-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="step-text">
                        <strong>Accédez à l'annuaire</strong>
                        Votre compte sera activé automatiquement
                    </div>
                </div>
            </div>

            {{-- Bouton renvoyer --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-resend">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="23 4 23 10 17 10"/>
                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/>
                    </svg>
                    Renvoyer le lien de vérification
                </button>
            </form>

            {{-- Déconnexion --}}
            <div class="logout-row">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                        Se déconnecter
                    </button>
                </form>
            </div>

        </div>

        <div class="card-footer">
            © {{ date('Y') }} — Annuaire Numérique des Agents de l'Institution
        </div>

    </div>

</body>
</html>