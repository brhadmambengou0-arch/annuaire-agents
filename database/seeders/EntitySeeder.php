<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntitySeeder extends Seeder
{
    public function run(): void
    {
        // 6 Directions racines
        $drh  = DB::table('entities')->insertGetId(['nom' => 'Direction des Ressources Humaines',       'code' => 'DRH',       'type' => 'direction', 'ordre' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);
        $daf  = DB::table('entities')->insertGetId(['nom' => 'Direction Administrative et Financière',  'code' => 'DAF',       'type' => 'direction', 'ordre' => 2, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);
        $dsi  = DB::table('entities')->insertGetId(['nom' => "Direction des Systèmes d'Information",   'code' => 'DSI',       'type' => 'direction', 'ordre' => 3, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);
        $djc  = DB::table('entities')->insertGetId(['nom' => 'Direction Juridique et du Contentieux',  'code' => 'DJC',       'type' => 'direction', 'ordre' => 4, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);
        $dcom = DB::table('entities')->insertGetId(['nom' => 'Direction de la Communication',          'code' => 'DCOM',      'type' => 'direction', 'ordre' => 5, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);
        $dag  = DB::table('entities')->insertGetId(['nom' => 'Direction des Affaires Générales',       'code' => 'DAG',       'type' => 'direction', 'ordre' => 6, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);

        // Services DRH
        $srm = DB::table('entities')->insertGetId(['nom' => 'Service Recrutement et Mobilité', 'code' => 'DRH-SRM', 'type' => 'service', 'parent_id' => $drh, 'ordre' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);
        $sfc = DB::table('entities')->insertGetId(['nom' => 'Service Formation Continue',      'code' => 'DRH-SFC', 'type' => 'service', 'parent_id' => $drh, 'ordre' => 2, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);

        // Services DSI
        $sdev   = DB::table('entities')->insertGetId(['nom' => 'Service Développement et Applications', 'code' => 'DSI-SDEV',   'type' => 'service', 'parent_id' => $dsi, 'ordre' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);
        $sinfra = DB::table('entities')->insertGetId(['nom' => 'Service Infrastructure et Réseaux',    'code' => 'DSI-SINFRA', 'type' => 'service', 'parent_id' => $dsi, 'ordre' => 2, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);

        // Départements DRH-SRM
        DB::table('entities')->insert(['nom' => 'Département Gestion des Carrières', 'code' => 'DRH-SRM-DGC', 'type' => 'departement', 'parent_id' => $srm, 'ordre' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('entities')->insert(['nom' => 'Département Relations Sociales',    'code' => 'DRH-SRM-DRS', 'type' => 'departement', 'parent_id' => $srm, 'ordre' => 2, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);

        // Département DRH-SFC
        DB::table('entities')->insert(['nom' => 'Département GPEC', 'code' => 'DRH-SFC-GPEC', 'type' => 'departement', 'parent_id' => $sfc, 'ordre' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);

        $this->command->info('✅ 6 directions + services + départements créés.');
    }
}