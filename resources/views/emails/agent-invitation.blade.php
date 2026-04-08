<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur ANINF</title>
    <style>
        body { font-family: 'DM Sans', sans-serif; line-height: 1.6; color: #334155; margin: 0; padding: 0; background-color: #f8fafc; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #0369a1 0%, #0ea5e9 100%); padding: 2rem; text-align: center; color: white; }
        .header h1 { margin: 0; font-size: 1.8rem; font-weight: 700; }
        .header p { margin: 0.5rem 0 0 0; opacity: 0.9; }
        .content { padding: 2rem; }
        .welcome { font-size: 1.2rem; font-weight: 600; color: #0369a1; margin-bottom: 1rem; }
        .credentials { background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 8px; padding: 1.5rem; margin: 1.5rem 0; }
        .credentials h3 { margin: 0 0 1rem 0; color: #0369a1; font-size: 1rem; }
        .credential-item { display: flex; margin-bottom: 0.5rem; }
        .credential-label { font-weight: 600; min-width: 120px; color: #475569; }
        .credential-value { font-family: monospace; background: white; padding: 0.25rem 0.5rem; border-radius: 4px; border: 1px solid #e2e8f0; }
        .instructions { background: #fef3c7; border: 1px solid #fbbf24; border-radius: 8px; padding: 1rem; margin: 1.5rem 0; }
        .instructions h3 { margin: 0 0 0.5rem 0; color: #92400e; }
        .btn { display: inline-block; background: #0369a1; color: white; text-decoration: none; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; margin: 1rem 0; }
        .btn:hover { background: #0284c7; }
        .footer { background: #f8fafc; padding: 1.5rem; text-align: center; border-top: 1px solid #e2e8f0; }
        .footer p { margin: 0; color: #64748b; font-size: 0.9rem; }
        .security { background: #fee2e2; border: 1px solid #fca5a5; border-radius: 8px; padding: 1rem; margin: 1rem 0; }
        .security h3 { margin: 0 0 0.5rem 0; color: #dc2626; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>ANINF</h1>
            <p>Annuaire Numérique des Agents</p>
        </div>

        <div class="content">
            <div class="welcome">
                Bienvenue {{ $agent->prenom }} {{ $agent->nom }} !
            </div>

            <p>
                Votre compte agent a été créé avec succès sur la plateforme ANINF.
                Vous pouvez maintenant accéder à l'annuaire numérique des agents de l'institution.
            </p>

            <div class="credentials">
                <h3>Vos identifiants de connexion</h3>
                <div class="credential-item">
                    <span class="credential-label">Email :</span>
                    <span class="credential-value">{{ $agent->email }}</span>
                </div>
                <div class="credential-item">
                    <span class="credential-label">Mot de passe :</span>
                    <span class="credential-value">{{ $tempPassword }}</span>
                </div>
            </div>

            <div class="security">
                <h3> Sécurité</h3>
                <p><strong>Important :</strong> Ce mot de passe est temporaire. Vous devrez le changer lors de votre première connexion pour des raisons de sécurité.</p>
            </div>

            <div class="instructions">
                <h3> Instructions de connexion</h3>
                <ol>
                    <li>Cliquez sur le bouton "Se connecter" ci-dessous</li>
                    <li>Utilisez votre email et le mot de passe temporaire fourni</li>
                    <li>Changez immédiatement votre mot de passe dans votre profil</li>
                    <li>Explorez l'annuaire et consultez les informations des agents</li>
                </ol>
            </div>

            <div style="text-align: center;">
                <a href="{{ $loginUrl }}" class="btn">Se connecter à ANINF</a>
            </div>

            <p>
                Si vous avez des questions ou besoin d'assistance, n'hésitez pas à contacter
                l'administrateur système de votre institution.
            </p>

            <p style="color: #64748b; font-size: 0.9rem;">
                <strong>Matricule :</strong> {{ $agent->matricule }}<br>
                <strong>Fonction :</strong> {{ $agent->fonction->libelle ?? 'Non définie' }}<br>
                <strong>Entité :</strong> {{ $agent->entity->nom ?? 'Non définie' }}
            </p>
        </div>

        <div class="footer">
            <p>
                © {{ date('Y') }} — ANINF · Annuaire Numérique des Agents<br>
                République Gabonaise 
            </p>
        </div>
    </div>
</body>
</html>