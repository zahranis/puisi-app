<?php

namespace Database\Seeders;

use App\Models\Puisi;
use App\Models\User;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class PuisiSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@dot.com')->first();
        $annisa = User::where('email', 'annisa@dot.com')->first();
        $zahra = User::where('email', 'zahra@dot.com')->first();
        $genres = Genre::all();

        if (!$admin || !$annisa || !$zahra || $genres->isEmpty()) {
            $this->command->warn('User atau Genre belum tersedia. Seeder Puisi dilewati.');
            return;
        }

        $judulList = [
            'Senja yang Merintih',
            'Jejak Waktu',
            'Bisikan Hujan',
            'Langit Tanpa Bintang',
            'Cahaya di Ujung Malam',
            'Nyanyian Daun Gugur',
            'Rindu yang Tertinggal',
            'Bayang Dalam Mimpi',
            'Pelangi Setelah Luka',
            'Langkah yang Tak Kembali',
            'Matahari Terakhir',
            'Sajak Sepi',
            'Embun di Ujung Harap',
            'Riuh Dalam Sunyi',
            'Bayangan Masa Lalu',
        ];

        $isiList = [
            implode("\n", [
                "Langit senja berwarna merah saga,",
                "Angin berhembus membawa nostalgia,",
                "Setiap langkah menorehkan cerita,",
                "Yang tak sempat selesai dituliskan pena.",
                "",
                "Di bawah pohon kenangan aku menunggu,",
                "Namun waktu berlalu begitu saja,",
                "Tersisa sunyi dan rindu yang bisu,",
                "Terkunci di lubuk jiwa yang lama."
            ]),
            implode("\n", [
                "Hujan turun perlahan menyentuh bumi,",
                "Seperti rindu yang tak bisa ku sembunyi,",
                "Di sela malam yang panjang dan sunyi,",
                "Namamu datang kembali dalam mimpi.",
                "",
                "Kita pernah satu langkah, satu irama,",
                "Kini tinggal cerita dalam dada,",
                "Namun aku percaya suatu masa,",
                "Kita bertemu tanpa luka."
            ]),
            implode("\n", [
                "Di antara bayang-bayang yang samar,",
                "Aku menari bersama kenangan yang liar,",
                "Waktu tak bisa ku genggam erat,",
                "Namun jejakmu masih kuat.",
                "",
                "Setiap detik menjadi puisi,",
                "Yang kutulis dalam hati sendiri,",
                "Tak perlu dibaca, tak perlu diungkap,",
                "Cukup dirasa hingga lelap."
            ])
        ];

        $generateJudul = fn() => collect($judulList)->shuffle()->first();
        $generateIsi = fn() => collect($isiList)->shuffle()->first();

        $buatPuisiUntuk = function ($user, $jumlah) use ($genres, $generateJudul, $generateIsi) {
            foreach (range(1, $jumlah) as $i) {
                Puisi::create([
                    'user_id' => $user->id,
                    'genre_id' => $genres->random()->id,
                    'judul' => $generateJudul(),
                    'isi' => $generateIsi(),
                    'penulis' => $user->name,
                ]);
            }
        };

        $buatPuisiUntuk($admin, 2);
        $buatPuisiUntuk($annisa, 5);
        $buatPuisiUntuk($zahra, 10);

        $this->command->info('Seeder: Puisi beragam berhasil dibuat untuk Admin, Annisa, dan Zahra.');
    }
}
