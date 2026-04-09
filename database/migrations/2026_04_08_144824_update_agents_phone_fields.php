<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->renameColumn('telephone', 'telephone_professionnel');
            $table->renameColumn('telephone_interne', 'telephone_prive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->renameColumn('telephone_professionnel', 'telephone');
            $table->renameColumn('telephone_prive', 'telephone_interne');
        });
    }
};
