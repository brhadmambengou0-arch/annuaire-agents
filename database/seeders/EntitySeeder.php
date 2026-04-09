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

        // 3. Créer le Service Étude et Développement (rattaché à la DA)
        Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Service Étude et Développement',
            'code' => 'SED',
            'type' => 'service',
            'parent_uuid' => $da->id,
            'ordre' => 1,
            'is_active' => true,
        ]);

        // 4. Créer le Service Maintenance (rattaché à la DA)
        Entity::create([
            'id' => (string) Str::uuid(),
            'nom' => 'Service Maintenance',
            'code' => 'SM',
            'type' => 'service',
            'parent_uuid' => $da->id,
            'ordre' => 2,
            'is_active' => true,
        ]);
    }
}