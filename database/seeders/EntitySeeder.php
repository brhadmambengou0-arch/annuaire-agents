<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entity;
use Illuminate\Support\Str;

class EntitySeeder extends Seeder
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

        // 3. Direction des Affaires Générales
        Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Service Étude et Développement',
            'code' => 'DAG',
            'type' => 'direction',
            'parent_id' => $da->id,
            'ordre' => 3,
            'is_active' => true,
        ]);
         // 4. Direction de l'Audit de la Qualité et de la Stratégie Organisationnelle
        Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction de l\'Audit de la Qualité et de la Stratégie Organisationnelle',
            'code' => 'DAQSO',
            'type' => 'direction',
            'parent_id' => $da->id,
            'ordre' => 3,
            'is_active' => true,
        ]);
           // 5. Direction de l'Audit de la Qualité et de la Stratégie Organisationnelle
        Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction de l\'Audit de la Qualité et de la Stratégie Organisationnelle',
            'code' => 'DAQSO',
            'type' => 'direction',
            'parent_id' => $da->id,
            'ordre' => 3,
            'is_active' => true,
        ]);
                // 6. Direction des fréquences et de l'Audio vusuel
        Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction des fréquences et Audio vusuel',
            'code' => 'DFA',
            'type' => 'direction',
            'parent_id' => $da->id,
            'ordre' => 6,
            'is_active' => true, 
        ]);
            Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction de la Communicationet et du Marcketing',
            'code' => 'DCM',
            'type' => 'direction',
            'parent_id' => $da->id,
            'ordre' => 8,
            'is_active' => true, 
        ]);
            $drh = Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction des Ressources Humaines',
            'code' => 'DRH',
            'type' => 'direction',
            'parent_id' => $da->id,
            'ordre' => 9,
            'is_active' => true, 
        ]);
           Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction Financière',
            'code' => 'DF',
            'type' => 'direction',
            'parent_id' => $da->id,
            'ordre' => 10,
            'is_active' => true, 
        ]);
       // 3. Direction 
        $dag = Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction des Affaires Générales',
            'code' => 'DAG',
            'type' => 'direction',
            'ordre' => 3,
            'is_active' => true,
        ]);
    }
}