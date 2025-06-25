<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat admin
        User::updateOrCreate(
            ['email' => 'admin@dot.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('aaaaaaaa'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Buat Annisa
        User::updateOrCreate(
            ['email' => 'annisa@dot.com'],
            [
                'name' => 'Annisa',
                'password' => Hash::make('aaaaaaaa'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        // Buat Zahra
        User::updateOrCreate(
            ['email' => 'zahra@dot.com'],
            [
                'name' => 'Zahra',
                'password' => Hash::make('aaaaaaaa'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        // Panggil seeder lain
        $this->call([
            GenreSeeder::class,
            PuisiSeeder::class,
            KomentarSeeder::class,
        ]);
    }
}
