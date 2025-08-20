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
            
            // Plantation Identity & Location (provided by farmer)
            $table->string('name');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('village');
            $table->string('postal_code');
            $table->text('address_detail')->nullable();
            
            // Coordinates for API calls, this is more accurate
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

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
