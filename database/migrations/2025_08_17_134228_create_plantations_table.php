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
        Schema::create('tb_plantations', function (Blueprint $table) {
            $table->id();
            // Foreign key relationship to the 'tb_users' table
            $table->foreignId('user_id')->constrained('tb_users')->onDelete('cascade'); 
            // Main Plantation Details
            $table->string('name');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('village');
            $table->text('address_detail')->nullable();
            $table->string('postal_code')->nullable();
            $table->integer('altitude');
            $table->decimal('slope_gradient', 5, 2)->nullable();
            $table->string('slope_aspect')->nullable();
            $table->decimal('soil_ph', 4, 2)->nullable();
            $table->string('soil_texture')->nullable();
            $table->string('organic_matter')->nullable();
            $table->string('drainage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantations');
    }
};
