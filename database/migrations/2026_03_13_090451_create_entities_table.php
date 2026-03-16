<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 150);
            $table->string('code', 30)->unique();
            $table->enum('type', ['direction', 'service', 'departement']);
            $table->foreignId('parent_id')
                  ->nullable()
                  ->constrained('entities')
                  ->nullOnDelete();
            $table->text('description')->nullable();
            $table->smallInteger('ordre')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};