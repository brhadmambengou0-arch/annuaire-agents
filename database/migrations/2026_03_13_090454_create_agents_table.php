<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('matricule', 20)->unique();
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('email', 150)->unique()->nullable();
            $table->string('telephone', 25)->nullable();
            $table->string('telephone_interne', 10)->nullable();
            $table->foreignUuid('entity_id');
            $table->foreignUuid('fonction_id');
            $table->string('photo_url')->nullable();
            $table->string('bureau', 50)->nullable();
            $table->date('date_prise_fonction')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Index pour les performances
            $table->index(['nom', 'prenom']);
            $table->index('matricule');
            $table->index('entity_id');
            $table->index('is_active');
        });

        Schema::table('agents', function (Blueprint $table) {
            $table->foreign('entity_id')
                ->references('id')
                ->on('entities')
                ->onDelete('set null');
            $table->foreign('fonction_id')
                ->references('id')
                ->on('fonctions')
                ->onDelete('set null');
       });

        // Index full-text PostgreSQL pour la recherche rapide
        if (DB::getDriverName() === 'pgsql') {
            DB::statement("
                CREATE INDEX agents_search_uuidx ON agents
                USING gin(to_tsvector('french', nom || ' ' || prenom || ' ' || COALESCE(email, '')))
            ");
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};