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
        Schema::create('gallery_foto', function (Blueprint $table) {
            $table->id('foto_id');
            $table->string('judul_foto');
            $table->text('deskripsi_foto')->nullable();
            $table->string('lokasi_file');
            $table->unsignedBigInteger('album_id');
            $table->foreign('album_id')->references('album_id')->on('gallery_album')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_foto');
    }
};
