<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom role_id
            $table->unsignedBigInteger('role_id')->default(1)->after('id');

            // Tambah foreign key ke tabel roles
            $table->foreign('role_id')->references('id')->on('roles');

            // Tambah kolom birthdate (phone dihapus karena sudah ada)
            $table->date('birthdate')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn(['role_id', 'birthdate']);
        });
    }
};
