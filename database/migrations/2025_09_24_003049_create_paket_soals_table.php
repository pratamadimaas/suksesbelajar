<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('paket_soals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->constrained('pakets')->onDelete('cascade');
            $table->foreignId('soal_id')->constrained('soals')->onDelete('cascade');
            $table->integer('urutan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paket_soals');
    }
};