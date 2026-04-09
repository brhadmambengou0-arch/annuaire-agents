<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    public function up(): void
    {
        // Change column type to UUID using raw SQL
        DB::statement('ALTER TABLE agents ALTER COLUMN entity_id TYPE uuid USING entity_id::uuid');
    }

    public function down(): void
    {
        // Change back to bigint
        DB::statement('ALTER TABLE agents ALTER COLUMN entity_id TYPE bigint USING entity_id::text::bigint');
    }
};
