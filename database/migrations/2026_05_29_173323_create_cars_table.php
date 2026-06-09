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
    Schema::create('cars', function (Blueprint $table) {
        $table->id();
        $table->string('nama_mobil');
        $table->string('plat_nomor');
        $table->integer('harga_dasar');
        $table->string('gambar')->nullable();
        $table->enum('status', ['tersedia', 'disewa'])
              ->default('tersedia');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
