<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::create([
    'name' => 'Admin',
    'email' => 'admin@gmail.com',
    'password' => Hash::make('12345678'),
    'role' => 'admin'
]);

Travel::create([
    'asal' => 'Malang',
    'tujuan' => 'Surabaya',
    'jam_berangkat' => '07:00',
    'harga' => 100000,
    'jumlah_kursi' => 10,
    'kelas' => 'Executive'
]);

Travel::create([
    'asal' => 'Malang',
    'tujuan' => 'Jakarta',
    'jam_berangkat' => '18:00',
    'harga' => 350000,
    'jumlah_kursi' => 10,
    'kelas' => 'Executive'
]);
    }
}
