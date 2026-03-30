public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'two_factor_secret')) {
            $table->text('two_factor_secret')->nullable();
        }
        if (!Schema::hasColumn('users', 'two_factor_recovery_codes')) {
            $table->text('two_factor_recovery_codes')->nullable();
        }
        if (!Schema::hasColumn('users', 'two_factor_confirmed_at')) {
            $table->timestamp('two_factor_confirmed_at')->nullable();
        }
    });
}