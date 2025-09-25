<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ujian_jawabans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ujian_id')->constrained('ujians')->onDelete('cascade');
            $table->foreignId('soal_id')->constrained('soals')->onDelete('cascade');
            $table->char('jawaban', 1)->nullable();
            $table->boolean('is_correct')->default(false);
            $table->integer('skor')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ujian_jawabans');
    }
};