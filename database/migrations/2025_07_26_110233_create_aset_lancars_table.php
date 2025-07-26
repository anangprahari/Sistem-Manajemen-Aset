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
        Schema::create('aset_lancars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kode_rekening_id')->constrained('kode_rekenings')->onDelete('cascade');
            $table->string('uraian_barang');
            $table->string('nama_kegiatan');
            $table->text('uraian_kegiatan');
            $table->text('uraian_jenis_barang');

            // Saldo Awal
            $table->integer('saldo_awal_unit')->default(0);
            $table->decimal('saldo_awal_harga_satuan', 15, 2)->default(0);
            $table->decimal('saldo_awal_total', 15, 2)->default(0);

            // Mutasi Tambah
            $table->integer('mutasi_tambah_unit')->default(0);
            $table->decimal('mutasi_tambah_harga', 15, 2)->default(0);
            $table->decimal('mutasi_tambah_nilai', 15, 2)->default(0);

            // Mutasi Kurang
            $table->integer('mutasi_kurang_unit')->default(0);
            $table->decimal('mutasi_kurang_nilai', 15, 2)->default(0);

            // Saldo Akhir
            $table->integer('saldo_akhir_unit')->default(0);
            $table->decimal('saldo_akhir_total', 15, 2)->default(0);

            $table->timestamps();

            // Index untuk pencarian
            $table->index('kode_rekening_id');
            $table->index('uraian_barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset_lancars');
    }
};
