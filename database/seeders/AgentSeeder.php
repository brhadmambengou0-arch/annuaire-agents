<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgentSeeder extends Seeder
{
    public function run(): voUuuuid
    {
        $agents = [
            ['matricule' => 'MAT001', 'nom' => 'DIALLO',  'prenom' => 'Amadou',   'email' => 'amadou.diallo@institution.sn',   'telephone' => '+221 77 100 00 01', 'telephone_interne' => '101', 'bureau' => 'A-101', 'entity_code' => 'DRH',      'fonction_code' => 'DIRECTEUR'],
            ['matricule' => 'MAT002', 'nom' => 'NDIAYE',  'prenom' => 'Fatou',    'email' => 'fatou.ndiaye@institution.sn',    'telephone' => '+221 77 100 00 02', 'telephone_interne' => '102', 'bureau' => 'A-102', 'entity_code' => 'DRH',      'fonction_code' => 'SOUS_DIRECTEUR'],
            ['matricule' => 'MAT003', 'nom' => 'SOW',     'prenom' => 'Ibrahima', 'email' => 'ibrahima.sow@institution.sn',    'telephone' => '+221 77 100 00 03', 'telephone_interne' => '201', 'bureau' => 'A-201', 'entity_code' => 'DRH-SRM',  'fonction_code' => 'CHEF_SERVICE'],
            ['matricule' => 'MAT004', 'nom' => 'FALL',    'prenom' => 'Mariama',  'email' => 'mariama.fall@institution.sn',    'telephone' => '+221 77 100 00 04', 'telephone_interne' => '301', 'bureau' => 'B-301', 'entity_code' => 'DAF',      'fonction_code' => 'DIRECTEUR'],
            ['matricule' => 'MAT005', 'nom' => 'TRAORE',  'prenom' => 'Moussa',   'email' => 'moussa.traore@institution.sn',   'telephone' => '+221 77 100 00 05', 'telephone_interne' => '302', 'bureau' => 'B-302', 'entity_code' => 'DAF',      'fonction_code' => 'COMPTABLE'],
            ['matricule' => 'MAT006', 'nom' => 'BA',      'prenom' => 'Oumar',    'email' => 'oumar.ba@institution.sn',        'telephone' => '+221 77 100 00 06', 'telephone_interne' => '401', 'bureau' => 'C-401', 'entity_code' => 'DSI',      'fonction_code' => 'DIRECTEUR'],
            ['matricule' => 'MAT007', 'nom' => 'DIOP',    'prenom' => 'Aissatou', 'email' => 'aissatou.diop@institution.sn',   'telephone' => '+221 77 100 00 07', 'telephone_interne' => '411', 'bureau' => 'C-411', 'entity_code' => 'DSI-SDEV', 'fonction_code' => 'INFORMATICIEN'],
            ['matricule' => 'MAT008', 'nom' => 'MBAYE',   'prenom' => 'Cheikh',   'email' => 'cheikh.mbaye@institution.sn',    'telephone' => '+221 77 100 00 08', 'telephone_interne' => '412', 'bureau' => 'C-412', 'entity_code' => 'DSI-SDEV', 'fonction_code' => 'INFORMATICIEN'],
            ['matricule' => 'MAT009', 'nom' => 'SARR',    'prenom' => 'Rokhaya',  'email' => 'rokhaya.sarr@institution.sn',    'telephone' => '+221 77 100 00 09', 'telephone_interne' => '501', 'bureau' => 'D-501', 'entity_code' => 'DJC',      'fonction_code' => 'DIRECTEUR'],
            ['matricule' => 'MAT010', 'nom' => 'GUEYE',   'prenom' => 'Babacar',  'email' => 'babacar.gueye@institution.sn',   'telephone' => '+221 77 100 00 10', 'telephone_interne' => '502', 'bureau' => 'D-502', 'entity_code' => 'DJC',      'fonction_code' => 'JURISTE'],
            ['matricule' => 'MAT011', 'nom' => 'TOURE',   'prenom' => 'Seydou',   'email' => 'seydou.toure@institution.sn',    'telephone' => '+221 77 100 00 11', 'telephone_interne' => '601', 'bureau' => 'E-601', 'entity_code' => 'DCOM',     'fonction_code' => 'DIRECTEUR'],
            ['matricule' => 'MAT012', 'nom' => 'DIOUF',   'prenom' => 'Ndèye',    'email' => 'ndeye.diouf@institution.sn',     'telephone' => '+221 77 100 00 12', 'telephone_interne' => '602', 'bureau' => 'E-602', 'entity_code' => 'DCOM',     'fonction_code' => 'COMMUNICANT'],
            ['matricule' => 'MAT013', 'nom' => 'CISSE',   'prenom' => 'Lamine',   'email' => 'lamine.cisse@institution.sn',    'telephone' => '+221 77 100 00 13', 'telephone_interne' => '701', 'bureau' => 'F-701', 'entity_code' => 'DAG',      'fonction_code' => 'DIRECTEUR'],
            ['matricule' => 'MAT014', 'nom' => 'NIANG',   'prenom' => 'Coumba',   'email' => 'coumba.niang@institution.sn',    'telephone' => '+221 77 100 00 14', 'telephone_interne' => '702', 'bureau' => 'F-702', 'entity_code' => 'DAG',      'fonction_code' => 'SECRETAIRE'],
            ['matricule' => 'MAT015', 'nom' => 'KANE',    'prenom' => 'Joseph',   'email' => 'joseph.kane@institution.sn',     'telephone' => '+221 77 100 00 15', 'telephone_interne' => '703', 'bureau' => 'F-703', 'entity_code' => 'DAG',      'fonction_code' => 'AGENT'],
        ];

        foreach ($agents as $data) {
            $entity   = DB::table('entities')->where('code', $data['entity_code'])->first();
            $fonction = DB::table('fonctions')->where('code', $data['fonction_code'])->first();

            if (!$entity || !$fonction) continue;

            DB::table('agents')->insertOrIgnore([
                'matricule'           => $data['matricule'],
                'nom'                 => $data['nom'],
                'prenom'              => $data['prenom'],
                'email'               => $data['email'],
                'telephone'           => $data['telephone'],
                'telephone_interne'   => $data['telephone_interne'],
                'bureau'              => $data['bureau'],
                'entity_Uuuuid'           => $entity->Uuuuid,
                'fonction_Uuuuid'         => $fonction->Uuuuid,
                'is_active'           => true,
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);
        }

        $this->command->info(' 15 agents créés.');
    }
}
