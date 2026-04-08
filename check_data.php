<?php

require_once __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Entity;
use App\Models\Fonction;
use App\Models\Agent;

echo "Vérification des données...\n\n";

// Vérifier les entités
$entitiesCount = Entity::count();
echo " Entités : $entitiesCount\n";

if ($entitiesCount === 0) {
    echo "Aucune entité trouvée - Lancement du seeder...\n";
    $exitCode = 0;
    system('php artisan db:seed --class=EntitySeeder', $exitCode);
    if ($exitCode === 0) {
        echo " Entités créées\n";
    } else {
        echo " Erreur lors de la création des entités\n";
    }
} else {
    echo " Entités présentes\n";
    $directions = Entity::where('type', 'direction')->get();
    foreach ($directions as $dir) {
        echo "  - {$dir->nom} ({$dir->code})\n";
    }
}

// Vérifier les fonctions
$fonctionsCount = Fonction::count();
echo "\n Fonctions : $fonctionsCount\n";

if ($fonctionsCount === 0) {
    echo " Aucune fonction trouvée - Lancement du seeder...\n";
    $exitCode = 0;
    system('php artisan db:seed --class=FonctionSeeder', $exitCode);
    if ($exitCode === 0) {
        echo " Fonctions créées\n";
    } else {
        echo " Erreur lors de la création des fonctions\n";
    }
} else {
    echo " Fonctions présentes\n";
    $fonctions = Fonction::orderBy('niveau')->get();
    foreach ($fonctions as $fonc) {
        echo "  - {$fonc->libelle} (niveau {$fonc->niveau})\n";
    }
}

// Vérifier les agents
$agentsCount = Agent::count();
echo "\n Agents : $agentsCount\n";

if ($agentsCount === 0) {
    echo "  Aucun agent trouvé (normal pour commencer)\n";
} else {
    echo " Agents présents\n";
}

echo "\n Maintenant tu peux :\n";
echo "1. Te connecter : admin@institution.sn / password\n";
echo "2. Aller sur /annuaire\n";
echo "3. Cliquer sur '+ Ajouter un agent'\n";
echo "4. Remplir le formulaire avec les entités et fonctions disponibles\n";