<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah_soal_twk')->default(30);
            $table->integer('jumlah_soal_tiu')->default(35);
            $table->integer('jumlah_soal_tkp')->default(45);
            $table->integer('waktu_ujian')->default(90); 
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pakets');
    }
};