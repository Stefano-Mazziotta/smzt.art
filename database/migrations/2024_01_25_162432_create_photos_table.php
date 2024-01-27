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
        Schema::create('photos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('location_id')->index();
            $table->unsignedBigInteger('camera_id')->index();
            $table->unsignedBigInteger('film_id')->index();
            $table->string('title', 60);
            $table->string('description', 120);
            $table->integer('width');
            $table->integer('height');
            $table->timestamps();
            
            $table->foreign('location_id')->references('id')->on('locations')->cascadeOnDelete();
            $table->foreign('camera_id')->references('id')->on('cameras')->cascadeOnDelete();
            $table->foreign('film_id')->references('id')->on('films')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
