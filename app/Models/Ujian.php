<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'paket_id', 'mulai_ujian', 'selesai_ujian',
        'skor_twk', 'skor_tiu', 'skor_tkp', 'total_skor', 'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'mulai_ujian' => 'datetime',
        'selesai_ujian' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function ujianJawabans()
    {
        return $this->hasMany(UjianJawaban::class);
    }

    public function getDurasiUjian()
    {
        if ($this->selesai_ujian) {
            return $this->mulai_ujian->diffInMinutes($this->selesai_ujian);
        }
        return $this->mulai_ujian->diffInMinutes(now());
    }
}
