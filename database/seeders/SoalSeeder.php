<?php
// database/seeders/SoalSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Soal;

class SoalSeeder extends Seeder
{
    public function run(): void
    {
        // Sample TWK
        Soal::create([
            'kategori' => 'TWK',
            'pertanyaan' => 'Pancasila sebagai dasar negara Indonesia ditetapkan pada tanggal?',
            'pilihan_a' => '17 Agustus 1945',
            'pilihan_b' => '18 Agustus 1945',
            'pilihan_c' => '1 Juni 1945',
            'pilihan_d' => '22 Juni 1945',
            'pilihan_e' => '29 Mei 1945',
            'kunci_jawaban' => 'B',
            'pembahasan' => 'Pancasila ditetapkan sebagai dasar negara pada tanggal 18 Agustus 1945.'
        ]);

        // Sample TIU
        Soal::create([
            'kategori' => 'TIU',
            'pertanyaan' => 'Jika 2x + 3 = 11, maka nilai x adalah?',
            'pilihan_a' => '3',
            'pilihan_b' => '4',
            'pilihan_c' => '5',
            'pilihan_d' => '6',
            'pilihan_e' => '7',
            'kunci_jawaban' => 'B',
            'pembahasan' => '2x + 3 = 11, maka 2x = 8, sehingga x = 4'
        ]);

        // Sample TKP
        Soal::create([
            'kategori' => 'TKP',
            'pertanyaan' => 'Ketika menghadapi tugas yang sulit, sikap yang sebaiknya Anda lakukan adalah?',
            'pilihan_a' => 'Menyerah dan meminta bantuan orang lain',
            'pilihan_b' => 'Mengerjakan dengan asal-asalan',
            'pilihan_c' => 'Berusaha keras dan mencari solusi',
            'pilihan_d' => 'Menunda sampai ada yang membantu',
            'pilihan_e' => 'Mengeluh kepada atasan',
            'kunci_jawaban' => 'C',
            'skor_a' => 1,
            'skor_b' => 2,
            'skor_c' => 5,
            'skor_d' => 3,
            'skor_e' => 1,
        ]);
    }
}