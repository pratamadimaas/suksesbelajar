<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Ditambahkan
use App\Models\Paket; // Ditambahkan

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'phone',
        'birth_date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    /**
     * Atribut yang harus disembunyikan untuk serialisasi.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Dapatkan role yang dimiliki user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Dapatkan semua ujian yang diikuti user.
     */
    public function ujians()
    {
        return $this->hasMany(Ujian::class);
    }

    // --- RELASI BARU UNTUK FITUR ASSIGN PAKET ---
    
    /**
     * Relasi many-to-many ke Paket.
     * Ini akan mengambil semua paket yang ditugaskan kepada pengguna ini.
     */
    public function pakets(): BelongsToMany
    {
        // Menggunakan tabel pivot 'paket_user' dan memuat kolom 'is_active'.
        return $this->belongsToMany(Paket::class, 'paket_user')->withPivot('is_active');
    }

    /**
     * Helper untuk memeriksa role pengguna.
     *
     * @param string $roleName
     * @return bool
     */
    public function hasRole(string $roleName)
    {
        return $this->role && $this->role->name === $roleName;
    }

    /**
     * Periksa apakah user adalah admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Periksa apakah user adalah siswa.
     *
     * @return bool
     */
    public function isSiswa()
    {
        return $this->hasRole('siswa');
    }
}
