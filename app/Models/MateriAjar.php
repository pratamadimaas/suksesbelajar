<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriAjar extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'isi_materi',
        'file_path',
        'is_published',
    ];
}