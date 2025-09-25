<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori', ['TWK', 'TIU', 'TKP']);
            $table->text('pertanyaan');
            $table->text('pilihan_a');
            $table->text('pilihan_b');
            $table->text('pilihan_c');
            $table->text('pilihan_d');
            $table->text('pilihan_e');
            $table->char('kunci_jawaban', 1); 
            $table->integer('skor_a')->default(0);
            $table->integer('skor_b')->default(0);
            $table->integer('skor_c')->default(0);
            $table->integer('skor_d')->default(0);
            $table->integer('skor_e')->default(0);
            $table->text('pembahasan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('soals');
    }
};