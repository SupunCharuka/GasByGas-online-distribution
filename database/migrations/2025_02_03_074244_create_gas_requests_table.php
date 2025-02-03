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
        Schema::create('gas_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('outlet_id')->constrained()->onDelete('cascade'); 
            $table->integer('quantity'); 
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending'); 
            $table->string('token')->unique(); 
            $table->timestamp('expected_pickup_date')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gas_requests');
    }
};
