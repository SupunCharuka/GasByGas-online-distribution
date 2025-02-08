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
        Schema::table('gas_requests', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('gas_requests', function (Blueprint $table) {
            $table->enum('status', ['pending', 'completed', 'cancelled', 'scheduled'])->default('pending')->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gas_requests', function (Blueprint $table) {
            $table->dropColumn('status'); // Drop new column
        });

        Schema::table('gas_requests', function (Blueprint $table) {
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending')->after('quantity');
        });
    }
};
