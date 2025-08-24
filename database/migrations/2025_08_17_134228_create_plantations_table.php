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
            $table->foreignId('user_id')->constrained('tb_users')->onDelete('cascade');
            
            // Identity & Location
            $table->string('name');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('village');
            $table->string('postal_code');
            $table->text('address_detail')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            
            // Climate Data
            $table->decimal('avg_temperature', 5, 2)->nullable();
            $table->decimal('avg_humidity', 5, 2)->nullable();
            $table->integer('yearly_precipitation')->nullable();

            // Topography Data
            $table->integer('altitude')->nullable();
            $table->decimal('slope_gradient', 5, 2)->nullable();
            $table->string('slope_aspect')->nullable();

            // Soil Data
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
