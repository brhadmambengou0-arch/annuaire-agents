<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@institution.sn'],
            [
                'name' => 'Administrateur',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'consultant@institution.sn'],
            [
                'name' => 'Consultant',
                'password' => Hash::make('password'),
                'role' => 'consultant',
            ]
        );

        $this->command->info('✅ 2 comptes créés ou mis à jour : admin + consultant');
    }
}
