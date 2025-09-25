<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianJawaban extends Model
{
    use HasFactory;

    protected $fillable = [
        'ujian_id', 'soal_id', 'jawaban', 'is_correct', 'skor'
    ];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
}