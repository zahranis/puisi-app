<?php

namespace Database\Seeders;

use App\Models\Puisi;
use App\Models\User;
use App\Models\Komentar;
use Illuminate\Database\Seeder;

class KomentarSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $puisis = Puisi::all();

        if ($users->isEmpty() || $puisis->isEmpty()) {
            $this->command->warn('User atau Puisi belum tersedia. Seeder Komentar dilewati.');
            return;
        }

        $isiKomentar = [
            "Sungguh menyentuh hati dan penuh makna. Terima kasih telah berbagi!",
            "Kata-kata yang sangat indah, saya bisa merasakan emosinya.",
            "Puisi ini membuat saya merenung. Sangat inspiratif!",
            "Bahasanya lembut sekali, cocok dibaca saat senja.",
            "Benar-benar luar biasa. Teruslah menulis karya yang indah seperti ini."
        ];

        foreach ($puisis as $puisi) {
            $jumlahKomentar = rand(1, 3);
            $komentator = $users->shuffle()->take($jumlahKomentar);

            foreach ($komentator as $user) {
                Komentar::create([
                    'puisi_id' => $puisi->id,
                    'user_id' => $user->id,
                    'isi' => $isiKomentar[array_rand($isiKomentar)],
                ]);
            }
        }

        $this->command->info('Seeder: Komentar berhasil dibuat untuk semua puisi.');
    }
}
