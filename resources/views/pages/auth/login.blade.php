<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Annuaire Institutionnel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0369a1 0%, #0ea5e9 100%);
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
        }

        .login-card {
            background: #fff;
            border-radius: 12px;
            padding: 2.5rem;
            width: 100%; max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }

        .login-header { text-align: center; margin-bottom: 2rem; }
        .login-header h1 { font-size: 1.4rem; font-weight: 700; color: #0369a1; margin-bottom: 0.3rem; }
        .login-header p { font-size: 0.85rem; color: #64748b; }
        .login-divider { width: 40px; height: 3px; background: #0ea5e9; margin: 0.75rem auto 0; border-radius: 2px; }

        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 0.4rem; }
        .form-control {
            width: 100%; padding: 0.65rem 0.9rem;
            border: 1px solid #e2e8f0; border-radius: 8px;
            font-size: 0.9rem; color: #334155;
            transition: border-color 0.15s, box-shadow 0.15s;
            outline: none;
        }
        .form-control:focus { border-color: #0ea5e9; box-shadow: 0 0 0 3px rgba(14,165,233,0.15); }
        .form-error { font-size: 0.78rem; color: #dc2626; margin-top: 0.3rem; }

        .btn-primary {
            width: 100%; padding: 0.75rem;
            background: #0369a1; color: #fff;
            border: none; border-radius: 8px;
            font-size: 0.95rem; font-weight: 600; cursor: pointer;
            transition: background 0.15s;
        }
        .btn-primary:hover { background: #0284c7; }

        .login-footer { text-align: center; margin-top: 1.5rem; font-size: 0.8rem; color: #94a3b8; }
        .login-info {
            background: #f0f9ff; border: 1px solid #bae6fd;
            border-radius: 8px; padding: 0.9rem; margin-bottom: 1.5rem;
            font-size: 0.82rem; color: #0369a1;
        }
        .login-info strong { display: block; margin-bottom: 0.3rem; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h1>Annuaire Institutionnel</h1>
            <p>Connectez-vous pour accéder à l'annuaire</p>
            <div class="login-divider"></div>
        </div>

        {{-- Comptes de test --}}
        <div class="login-info">
            <strong>Comptes de démonstration :</strong>
            Admin : admin@institution.sn / password<br>
            Consultant : consultant@institution.sn / password
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Adresse email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="form-control" placeholder="votre@email.sn" required autofocus>
                @error('email') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Mot de passe</label>
                <input id="password" type="password" name="password"
                       class="form-control" placeholder="••••••••" required>
                @error('password') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn-primary">Se connecter</button>
        </form>

        <div class="login-footer">
            Annuaire Numérique des Agents &copy; {{ date('Y') }}
        </div>
    </div>
    @livewireScripts
</body>
</html>