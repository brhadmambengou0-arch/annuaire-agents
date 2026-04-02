<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Supprimer l'index existant
        DB::statement('DROP INDEX IF EXISTS sessions_user_id_index');
        
        // 2. Modifier le type de colonne avec USING pour la conversion
        DB::statement('ALTER TABLE sessions ALTER COLUMN user_id TYPE UUID USING (user_id::text)::uuid');
    }

    public function down(): void
    {
        // Revenir en arrière si nécessaire
        DB::statement('ALTER TABLE sessions ALTER COLUMN user_id TYPE BIGINT USING user_id::bigint');
        DB::statement('CREATE INDEX sessions_user_id_index ON sessions(user_id)');
    }
};