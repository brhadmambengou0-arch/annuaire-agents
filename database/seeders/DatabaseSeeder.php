<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            FonctionSeeder::class,
            EntitySeeder::class,
            UserSeeder::class,
            AgentSeeder::class,
        ]);

        $this->command->info('');
        $this->command->info('🎉 Base de données peuplée avec succès !');
        $this->command->info('admin@institution.sn / password');
        $this->command->info('consultant@institution.sn / password');
    }
}