<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = ['Cinta', 'Persahabatan', 'Alam', 'Motivasi'];

        foreach ($genres as $genre) {
            Genre::updateOrCreate(['nama' => $genre]);
        }
    }
}
