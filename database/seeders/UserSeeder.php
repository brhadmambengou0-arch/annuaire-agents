<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insertOrIgnore([
            [
                'uuid'       => (string) Str::uuid(),
                'name'       => 'Administrateur',
                'email'      => 'admin@institution.sn',
                'password'   => Hash::make('password'),
                'role'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid'       => (string) Str::uuid(),
                'name'       => 'Consultant',
                'email'      => 'consultant@institution.sn',
                'password'   => Hash::make('password'),
                'role'       => 'consultant',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->command->info('✅ 2 comptes créés : admin + consultant');
    }
}
