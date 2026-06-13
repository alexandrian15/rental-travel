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
Schema::create('travel_bookings', function (Blueprint $table) {

    $table->id();

    $table->foreignId('travel_id')
          ->constrained('travels')
          ->cascadeOnDelete();

    $table->foreignId('user_id')
          ->nullable()
          ->constrained('users')
          ->nullOnDelete();

    $table->string('nama_pemesan');

    $table->string('telepon');

    $table->date('tanggal_berangkat');

    $table->integer('jumlah_kursi');


    $table->enum('status', [
        'pending',
        'paid',
        'cancelled'
    ])->default('pending');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_bookings');
    }
};
