<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgentSeeder extends Seeder
{
    public function run(): void
    {
        $agents = [
            ['entity_code' => 'DRH',      'fonction_code' => 'DIRECTEUR',      'telephone_interne' => '101', 'bureau' => 'A-101'],
            
            ['entity_code' => 'DRH-SRM',  'fonction_code' => 'CHEF_SERVICE',   'telephone_interne' => '201', 'bureau' => 'A-201'],
            ['entity_code' => 'DAF',      'fonction_code' => 'DIRECTEUR',      'telephone_interne' => '301', 'bureau' => 'B-301'],
            ['entity_code' => 'DAF',      'fonction_code' => 'COMPTABLE',      'telephone_interne' => '302', 'bureau' => 'B-302'],
            ['entity_code' => 'DSI',      'fonction_code' => 'DIRECTEUR',      'telephone_interne' => '401', 'bureau' => 'C-401'],
            
            ['entity_code' => 'DJC',      'fonction_code' => 'DIRECTEUR',      'telephone_interne' => '501', 'bureau' => 'D-501'],
            ['entity_code' => 'DJC',      'fonction_code' => 'JURISTE',        'telephone_interne' => '502', 'bureau' => 'D-502'],
            ['entity_code' => 'DCOM',     'fonction_code' => 'DIRECTEUR',      'telephone_interne' => '601', 'bureau' => 'E-601'],
          
            ['entity_code' => 'DAG',      'fonction_code' => 'DIRECTEUR',      'telephone_interne' => '701', 'bureau' => 'F-701'],
            ['entity_code' => 'DAG',      'fonction_code' => 'SECRETAIRE',     'telephone_interne' => '702', 'bureau' => 'F-702'],
            ['entity_code' => 'DAG',      'fonction_code' => 'AGENT',          'telephone_interne' => '703', 'bureau' => 'F-703'],
        ];

        foreach ($agents as $index => $data) {
            $number = $index + 1;
            $data['matricule'] = $this->makeMatricule($number);
            $data['nom']       = 'NOM' . $number;
            $data['prenom']    = 'PRENOM' . $number;
            $data['email']     = "nom{$number}@institution.sn";
            $data['telephone'] = '+241 77 00 00 ' . str_pad($number, 2, '0', STR_PAD_LEFT);

            $entity   = DB::table('entities')->where('code', $data['entity_code'])->first();
            $fonction = DB::table('fonctions')->where('code', $data['fonction_code'])->first();

            if (!$entity || !$fonction) {
                continue;
            }

            DB::table('agents')->insertOrIgnore([
                'matricule'           => $data['matricule'],
                'nom'                 => $data['nom'],
                'prenom'              => $data['prenom'],
                'email'               => $data['email'],
                'telephone'           => $data['telephone'],
                'telephone_interne'   => $data['telephone_interne'],
                'bureau'              => $data['bureau'],
                'entity_Uuuuid'       => $entity->Uuuuid,
                'fonction_Uuuuid'     => $fonction->Uuuuid,
                'is_active'           => true,
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);
        }

        $this->command->info(' 15 agents créés.');
    }

    private function makeMatricule(int $number): string
    {
        return 'AG' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
