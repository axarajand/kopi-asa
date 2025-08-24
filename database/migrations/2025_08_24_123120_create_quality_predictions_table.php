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
        Schema::create('tb_quality_predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plantation_id')->constrained('tb_plantations')->onDelete('cascade');
            $table->foreignId('variety_id')->constrained('tb_varieties')->onDelete('cascade');
            $table->foreignId('predicted_by_user_id')->constrained('tb_users')->onDelete('cascade');
            
            $table->string('processing_method');
            $table->decimal('moisture', 4, 2);
            $table->string('color');
            
            $table->string('predicted_ph_range');
            $table->string('predicted_ph_desc');
            $table->decimal('predicted_quality_score', 5, 2);
            $table->string('predicted_quality_desc');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quality_predictions');
    }
};
