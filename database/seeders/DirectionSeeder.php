<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entity;
use Illuminate\Support\Str;

class DirectionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Créer la Direction Générale
        $dg = Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction Générale',
            'code' => 'DG',
            'type' => 'direction',
            'ordre' => 1,
            'is_active' => true,
        ]);

        // 2. Créer la Direction des Applications
        $da = Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction des Applications',
            'code' => 'DA',
            'type' => 'direction',
            'ordre' => 2,
            'is_active' => true,
        ]);
        // 2. Créer la Direction des Applications
        Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Service Etude et Développement',
            'code' => 'SED',
            'type' => 'service',
            'ordre' => 7,
            'is_active' => true,
            'parent_id' => $da->id,
        ]);
        // 2. Créer la Direction des Applications
        Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => "Service de système d'information",
            'code' => 'SSI',
            'type' => 'service',
            'ordre' => 7,
            'is_active' => true,
            'parent_id' => $da->id,
        ]);
         // 2. Créer la Direction des Applications
        Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => "Service de prestatation et Usager",
            'code' => 'SPU',
            'type' => 'service',
            'ordre' => 7,
            'is_active' => true,
            'parent_id' => $da->id,
        ]);
         // 3. Direction des Affaires Générales
        $dag = Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction des Affaires Générales',
            'code' => 'DAG',
            'type' => 'direction',
            'ordre' => 3,
            'is_active' => true,
        ]);

              Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => "Approvisionnement ",
            'code' => 'APPRO',
            'type' => 'service',
            'ordre' => 3,
            'is_active' => true,
            'parent_id' => $dag->id,
        ]);
    Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => "Moyen Géneraux ",
            'code' => 'MG',
            'type' => 'service',
            'ordre' => 3,
            'is_active' => true,
            'parent_id' => $dag->id,
        ]);
            Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => "Docummentation  ",
            'code' => 'DOC',
            'type' => 'service',
            'ordre' => 3,
            'is_active' => true,
            'parent_id' => $dag->id,
        ]);
        // 4. Direction de Audit de la qualité et de la stratégie organisationnelle
        $daqso = Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction Audit de la qualité et de la stratégie organisationnelle',
            'code' => 'DAQSO',
            'type' => 'direction',
            'ordre' => 4,
            'is_active' => true,
        ]); 
        Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => "Audit et qualité ",
            'code' => 'SAQ',
            'type' => 'service',
            'ordre' => 4,
            'is_active' => true,
            'parent_id' => $daqso->id,
        ]);
         Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => "Stratégie organisationnelle ",
            'code' => 'SO',
            'type' => 'service',
            'ordre' => 4,
            'is_active' => true,
            'parent_id' => $daqso->id,
        ]);
        // 5. Direction des Génerale des Systèmes d'Information
        $dgsi = Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction des Génerale des Systèmes Information',
            'code' => 'DGSI',
            'type' => 'direction',
            'ordre' => 5,
            'is_active' => true,
        ]); 
         Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => "Cordination des directions ",
             'code' => 'CD',
            'type' => 'service',
            'ordre' => 5,
            'is_active' => true,
            'parent_id' => $dgsi->id,
        ]);
       
        // 6. Direction des fréquences et de l'Audio vusuel
        $dav = Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction des fréquences et de l\'Audio vusuel',
            'code' => 'DAV',
            'type' => 'direction',
            'ordre' => 6,
            'is_active' => true,
        ]); 
            Entity::create([
                'id' => (string) Str::uuid(),
                'nom' => "Fréquences ",
                'code' => 'FREQ',
                'type' => 'service',
                'ordre' => 6,
                'is_active' => true,
                'parent_id' => $dav->id,
            ]);
            Entity::create([
                'id' => (string) Str::uuid(),
                'nom' => "Audio vusuel ",
                'code' => 'AV',
                'type' => 'service',
                'ordre' => 6,
                'is_active' => true,
                'parent_id' => $dav->id,
            ]); 
             // 8. Direction de la Communication et du Marcketing 
        $dcm = Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction de la Communication et du Marcketing',
            'code' => 'DCM',
            'type' => 'direction',
            'ordre' => 8,
            'is_active' => true,
        ]);
            Entity::create([
                'id' => (string) Str::uuid(),
                'nom' => "Communication Digitale ",
                'code' => 'DM',
                'type' => 'service',
                'ordre' => 8,
                'is_active' => true,
                'parent_id' => $dcm->id,
            ]);
            Entity::create([
                'id' => (string) Str::uuid(),
                'nom' => "Marcketing ",
                'code' => 'MKT',
                'type' => 'service',
                'ordre' => 8,
                'is_active' => true,
                'parent_id' => $dcm->id,
            ]);
            Entity::create([
                'id' => (string) Str::uuid(),
                'nom' => "Relation Publique ",
                'code' => 'SRP',
                'type' => 'service',
                'ordre' => 8,
                'is_active' => true,
                'parent_id' => $dcm->id,
            ]);
                // 9. Direction des Ressources Humaines
        $drh = Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction des Ressources Humaines',
            'code' => 'DRH',
            'type' => 'direction',
            'ordre' => 9,
            'is_active' => true,
        ]);
        Entity::create([
                'id' => (string) Str::uuid(),
                'nom' => "Service de la Gestion des Carrières ",
                'code' => 'GC',
                'type' => 'service',
                'ordre' => 9,
                'is_active' => true,
                'parent_id' => $drh->id,
            ]);
            Entity::create([
                'id' => (string) Str::uuid(),
                'nom' => "Renumération et Capital Social ",
                'code' => 'RP',
                'type' => 'service',
                'ordre' => 9,
                'is_active' => true,
                'parent_id' => $drh->id,
            ]);
                     // 10. Direction Financière
        $df = Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction Financière',
            'code' => 'DF',
            'type' => 'direction',
            'ordre' => 10,
            'is_active' => true,
        ]);
          Entity::create([
                'id' => (string) Str::uuid(),
                'nom' => "Trésor ",
                'code' => 'TRS',
                'type' => 'service',
                'ordre' => 10,
                'is_active' => true,
                'parent_id' => $df->id,
            ]);
            Entity::create([
                'id' => (string) Str::uuid(),
                'nom' => "Agent Comptable ",
                'code' => 'ACC',
                'type' => 'service',
                'ordre' => 10,
                'is_active' => true,
                'parent_id' => $df->id,
            ]);
}
}