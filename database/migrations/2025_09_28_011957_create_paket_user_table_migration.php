<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Membuat tabel pivot untuk relasi many-to-many antara User dan Paket.
     * Ini digunakan untuk menyimpan paket mana yang ditugaskan kepada siswa mana.
     */
    public function up(): void
    {
        Schema::create('paket_user', function (Blueprint $table) {
            $table->id();
            // Kunci asing ke tabel users (siswa)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            // Kunci asing ke tabel pakets (paket soal)
            $table->foreignId('paket_id')->constrained('pakets')->onDelete('cascade');
            // Status persetujuan/aktivasi. Default true berarti paket siap dikerjakan setelah ditugaskan.
            $table->boolean('is_active')->default(true); 
            $table->timestamps();

            // Mencegah duplikasi entri (satu siswa tidak bisa ditugaskan paket yang sama dua kali)
            $table->unique(['user_id', 'paket_id']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_user');
    }
};
