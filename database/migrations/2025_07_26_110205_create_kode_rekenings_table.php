<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kode_rekenings', function (Blueprint $table) {
            $table->id();
            $table->string('akun', 10);
            $table->string('kelompok', 10);
            $table->string('jenis', 10);
            $table->string('objek', 10);
            $table->string('nomor', 10);
            $table->string('kode_lengkap', 50)->unique(); // format: akun.kelompok.jenis.objek.nomor
            $table->text('uraian');
            $table->timestamps();

            // Index untuk pencarian yang lebih cepat
            $table->index(['akun', 'kelompok', 'jenis', 'objek']);
            $table->index('kode_lengkap');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_rekenings');
    }
};
