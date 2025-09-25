<?php
// app/Models/Soal.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori', 'pertanyaan', 'pilihan_a', 'pilihan_b', 'pilihan_c',
        'pilihan_d', 'pilihan_e', 'kunci_jawaban', 'skor_a', 'skor_b',
        'skor_c', 'skor_d', 'skor_e', 'pembahasan', 'is_active'
    ];

    public function pakets()
    {
        return $this->belongsToMany(Paket::class, 'paket_soals');
    }

    public function ujianJawabans()
    {
        return $this->hasMany(UjianJawaban::class);
    }

    public function getPilihanArray()
    {
        return [
            'A' => $this->pilihan_a,
            'B' => $this->pilihan_b,
            'C' => $this->pilihan_c,
            'D' => $this->pilihan_d,
            'E' => $this->pilihan_e,
        ];
    }
}