<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->renameColumn('user_id', 'created_by_id'); // Rename 'user_id' to 'created_by_id'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->renameColumn('created_by_id', 'user_id'); // Rollback: Rename 'created_by_id' back to 'user_id'
        });
    }
};
