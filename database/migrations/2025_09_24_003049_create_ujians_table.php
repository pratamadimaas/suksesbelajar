<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ujians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('paket_id')->constrained('pakets')->onDelete('cascade');
            $table->timestamp('mulai_ujian');
            $table->timestamp('selesai_ujian')->nullable();
            $table->integer('skor_twk')->default(0);
            $table->integer('skor_tiu')->default(0);
            $table->integer('skor_tkp')->default(0);
            $table->integer('total_skor')->default(0);
            $table->enum('status', ['ongoing', 'finished', 'timeout'])->default('ongoing');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ujians');
    }
};