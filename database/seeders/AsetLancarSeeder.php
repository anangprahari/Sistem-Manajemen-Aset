<?php

namespace Database\Seeders;

use App\Models\AsetLancar;
use Illuminate\Database\Seeder;

class AsetLancarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan kamu punya data pada tabel kode_rekenings
        // Ambil salah satu id dari tabel kode_rekenings (anggap id=1 tersedia)
        $kodeRekeningId = 1;

        AsetLancar::create([
            'kode_rekening_id' => $kodeRekeningId,
            'uraian_barang' => 'Kertas HVS A4',
            'nama_kegiatan' => 'Pengadaan ATK Kantor',
            'uraian_kegiatan' => 'Pembelian alat tulis kantor untuk operasional',
            'uraian_jenis_barang' => 'ATK - Alat Tulis Kantor',

            'saldo_awal_unit' => 100,
            'saldo_awal_harga_satuan' => 1200.00,
            'saldo_awal_total' => 120000.00,

            'mutasi_tambah_unit' => 50,
            'mutasi_tambah_harga' => 1300.00,
            'mutasi_tambah_nilai' => 65000.00,

            'mutasi_kurang_unit' => 30,
            'mutasi_kurang_nilai' => 39000.00,

            'saldo_akhir_unit' => 120,
            'saldo_akhir_total' => 146000.00,
        ]);

        AsetLancar::create([
            'kode_rekening_id' => $kodeRekeningId,
            'uraian_barang' => 'Tinta Printer Canon',
            'nama_kegiatan' => 'Perawatan Peralatan Cetak',
            'uraian_kegiatan' => 'Pembelian tinta untuk printer',
            'uraian_jenis_barang' => 'Tinta dan Perlengkapan Cetak',

            'saldo_awal_unit' => 10,
            'saldo_awal_harga_satuan' => 75000.00,
            'saldo_awal_total' => 750000.00,

            'mutasi_tambah_unit' => 5,
            'mutasi_tambah_harga' => 76000.00,
            'mutasi_tambah_nilai' => 380000.00,

            'mutasi_kurang_unit' => 3,
            'mutasi_kurang_nilai' => 228000.00,

            'saldo_akhir_unit' => 12,
            'saldo_akhir_total' => 902000.00,
        ]);
    }
}
