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
Schema::create('travels', function (Blueprint $table) {
    $table->id();
    $table->string('asal');
    $table->string('tujuan');
    $table->date('tanggal');
    $table->time('jam_berangkat');
    $table->integer('harga');
    $table->integer('kursi_total');
    $table->integer('kursi_terisi')->default(0);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travels');
    }
};
