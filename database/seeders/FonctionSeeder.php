<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fonction;

class FonctionSeeder extends Seeder
{
    public function run(): void
    {
        $fonctions = [
            ['code' => 'AGENT',             'libelle' => 'Agent',                   'niveau' => 1],
            ['code' => 'SECRETAIRE',        'libelle' => 'Secrétaire',              'niveau' => 1],
           
        
            ['code' => 'COMPTABLE',         'libelle' => 'Comptable',               'niveau' => 2],
              
            ['code' => 'CHEF_SERVICE',      'libelle' => 'Chef de Service',         'niveau' => 3],
            ['code' => 'JURISTE',           'libelle' => 'Juriste',                 'niveau' => 3],
            ['code' => 'CONSEILLER',        'libelle' => 'Conseiller',              'niveau' => 4],
            
            ['code' => 'DIRECTEUR',         'libelle' => 'Directeur',               'niveau' => 5],
            ['code' => 'DIRECTEUR_GENERAL', 'libelle' => 'Directeur Général',       'niveau' => 6],
        ];

        foreach ($fonctions as $f) {
            Fonction::firstOrCreate(
                ['code' => $f['code']],
                array_merge($f, ['is_active' => true])
            );
        }

        
    }
}
