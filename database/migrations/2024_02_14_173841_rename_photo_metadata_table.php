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
        Schema::table('photos_metadata', function (Blueprint $table) {
            $table->dropForeign(['label_id']);
            $table->dropForeign(['photo_id']);
        });

        Schema::rename('photos_metadata', 'photos_labels');

        Schema::table('photos_labels', function (Blueprint $table) {
            $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photos_labels', function (Blueprint $table) {
            $table->dropForeign(['label_id']);
            $table->dropForeign(['photo_id']);
        });

        Schema::rename('photos_labels', 'photos_metadata');

        Schema::table('photos_metadata', function (Blueprint $table) {
            $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
        });
    }
};
