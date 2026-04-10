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
            'ordre' => 11,
            'is_active' => true,
        ]);

        // 2. Créer la Direction des Applications
        $da = Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction des Applications',
            'code' => 'DAP',
            'type' => 'direction',
            'ordre' => 7,
            'is_active' => true,
        ]);

        // 3. Créer le Service SSI (rattaché à la DA)
        Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Service SSI',
            'code' => 'SSI',
            'type' => 'service',
            'parent_uuid' => $da->id,
            'ordre' => 7,
            'is_active' => true,
        ]);

        // 4. Créer le Service SED(rattaché à la DA)
        Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Service SED',
            'code' => 'SED',
            'type' => 'service',
            'parent_uuid' => $da->id,
            'ordre' => 7,
            'is_active' => true,
        ]);
         // 4. Créartion du service Archive (rattaché à la DIR)
        Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Service Archive',
            'code' => 'SA',
            'type' => 'service',
            'parent_uuid' => $da->id,
            'ordre' => 1,
            'is_active' => true,
        ]);
         // 1. Créer la Direction des Affaires Générales
        $dg = Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Direction des Affaires Générales',
            'code' => 'DAG',
            'type' => 'direction',
            'ordre' => 3,
            'is_active' => true,
        ]);
         // 1. Créer la Direction des Affaires Générales
        $dg = Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Approvisionnement',
            'code' => 'DAG',
            'type' => 'service',
            'ordre' => 3,
            'is_active' => true,
        ]);
    }
}