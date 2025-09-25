<?php
// app/Models/Paket.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_paket', 'deskripsi', 'jumlah_soal_twk', 'jumlah_soal_tiu',
        'jumlah_soal_tkp', 'waktu_ujian', 'is_active'
    ];

    public function soals()
    {
        return $this->belongsToMany(Soal::class, 'paket_soals')->withPivot('urutan');
    }

    public function ujians()
    {
        return $this->hasMany(Ujian::class);
    }

    public function getTotalSoal()
    {
        return $this->jumlah_soal_twk + $this->jumlah_soal_tiu + $this->jumlah_soal_tkp;
    }
}