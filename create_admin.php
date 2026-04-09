<?php

require_once __DIR__.'/../../vendor/autoload.php';

$app = require_once __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Créer ou mettre à jour l'admin
User::updateOrCreate(
    ['email' => 'admin@institution.sn'],
    [
        'name' => 'Administrateur',
        'password' => Hash::make('password'),
        'role' => 'admin',
    ]
);

echo "✅ Admin créé/mis à jour : admin@institution.sn (mot de passe: password)\n";