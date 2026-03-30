<?php

use GuzzleHttp\Pool;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nom', 150);
            $table->string('code', 30)->unique();
            $table->enum('type', ['direction', 'service', 'departement','pool']);
            $table->foreignUuid('parent_uuid');
            $table->text('description')->nullable();
            $table->smallInteger('ordre')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('entities', function (Blueprint $table) {
          $table->foreign('parent_uuid')
              ->references('id')
              ->on('entities')
              ->onDelete('set null');
       });
    }

    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};