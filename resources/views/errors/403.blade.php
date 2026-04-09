<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — Accès refusé</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; background: linear-gradient(135deg, #fef2f2 0%, #ffffff 50%, #fff7ed 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; color: #0f172a; }
        .error-container { text-align: center; max-width: 600px; padding: 2rem; }
        h1 { font-family: 'Sora', sans-serif; font-size: 5rem; font-weight: 700; background: linear-gradient(135deg, #dc2626 0%, #f87171 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 1rem; }
        .error-code { font-size: 8rem; font-weight: 700; color: #fee2e2; margin: 0; }
        p { font-size: 1.1rem; color: #64748b; margin-bottom: 2rem; line-height: 1.6; }
        .error-icon { font-size: 4rem; margin-bottom: 2rem; }
        a { display: inline-block; padding: 0.8rem 2rem; background: linear-gradient(135deg, #0284c7 0%, #0ea5e9 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.2s; margin: 0 0.5rem; }
        a:hover { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(2, 132, 199, 0.3); }
        .secondary { background: #e0f2fe; color: #0369a1; }
        .secondary:hover { background: #bae6fd; }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon"></div>
        <div class="error-code">403</div>
        <h1>Accès refusé</h1>
        <p>Vous n'avez pas les permissions nécessaires pour accéder à cette ressource. Cette action est réservée aux administrateurs.</p>
        <div>
            <a href="{{ url('/') }}">Accueil</a>
            <a href="{{ route('annuaire.index') }}" class="secondary">Annuaire</a>
        </div>
    </div>
</body>
</html>
