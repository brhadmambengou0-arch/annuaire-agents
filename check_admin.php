<?php

require_once __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;

// Simuler une connexion admin pour test
$user = User::where('email', 'admin@institution.sn')->first();

if ($user) {
    echo "✅ Admin trouvé :\n";
    echo "  - Email: {$user->email}\n";
    echo "  - Rôle: " . ($user->role ?? 'null') . "\n";
    echo "  - ID: {$user->id}\n";

    // Vérifier si le rôle est 'admin'
    if ($user->role === 'admin') {
        echo "✅ Rôle admin OK - Le bouton devrait être visible\n";
    } else {
        echo "❌ Rôle incorrect - Correction en cours...\n";
        $user->role = 'admin';
        $user->save();
        echo "✅ Rôle corrigé à 'admin'\n";
    }
} else {
    echo "❌ Admin non trouvé - Création en cours...\n";
    User::create([
        'name' => 'Administrateur',
        'email' => 'admin@institution.sn',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);
    echo "✅ Admin créé : admin@institution.sn / password\n";
}

echo "\n📋 Instructions :\n";
echo "1. Connectez-vous avec : admin@institution.sn / password\n";
echo "2. Allez sur /annuaire\n";
echo "3. Le bouton '+ Ajouter un agent' devrait maintenant être visible\n";