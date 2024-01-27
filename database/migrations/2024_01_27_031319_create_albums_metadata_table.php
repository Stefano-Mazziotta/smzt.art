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
        Schema::create('albums_metadata', function (Blueprint $table) {
           $table->id();
            $table->unsignedBiginteger('label_id')->unsigned();
            $table->unsignedBiginteger('album_id')->unsigned();
            $table->timestamps();

            $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums_metadata');
    }
};
