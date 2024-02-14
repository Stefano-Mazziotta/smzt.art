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
        Schema::table('albums_metadata', function (Blueprint $table) {
            $table->dropForeign(['label_id']);
            $table->dropForeign(['album_id']);
        });

        Schema::rename('albums_metadata', 'albums_labels');

        Schema::table('albums_labels', function (Blueprint $table) {
            $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('albums_labels', function (Blueprint $table) {
            $table->dropForeign(['label_id']);
            $table->dropForeign(['album_id']);
        });

        Schema::rename('albums_labels', 'albums_metadata');

        Schema::table('albums_metadata', function (Blueprint $table) {
            $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
        });
    }
};
