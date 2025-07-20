<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jenis;
use App\Models\Kelompok;

class JenisSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil kelompok yang ada
        $kelompokTanah = Kelompok::where('kode', '1.1')->first();
        $kelompokMesin = Kelompok::where('kode', '1.2')->first();
        $kelompokGedung = Kelompok::where('kode', '1.3')->first();
        $kelompokJalan = Kelompok::where('kode', '1.4')->first();
        $kelompokAsetTetapLain = Kelompok::where('kode', '1.5')->first();

        $kelompokAsetTakBerwujud = Kelompok::where('kode', '2.1')->first();
        $kelompokAsetLainLain = Kelompok::where('kode', '2.2')->first();

        $jenis = [
            // Untuk Tanah (1.1)
            ['kelompok_id' => $kelompokTanah->id, 'kode' => '1.1.1', 'nama' => 'Tanah Pekarangan'],
            ['kelompok_id' => $kelompokTanah->id, 'kode' => '1.1.2', 'nama' => 'Tanah Bangunan'],

            // Untuk Mesin dan Peralatan (1.2)
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.1', 'nama' => 'Alat Besar Darat'],
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.2', 'nama' => 'Alat Angkutan Darat Bermotor'],
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.3', 'nama' => 'Alat Bengkel dan Ukur'],
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.4', 'nama' => 'Alat Pertanian'],
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.5', 'nama' => 'Alat Kantor dan Rumah Tangga'],
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.6', 'nama' => 'Alat Studio dan Komunikasi'],
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.7', 'nama' => 'Alat Kedokteran'],
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.8', 'nama' => 'Alat Laboratorium'],

            // Untuk Gedung dan Bangunan (1.3)
            ['kelompok_id' => $kelompokGedung->id, 'kode' => '1.3.1', 'nama' => 'Bangunan Gedung Tempat Kerja'],
            ['kelompok_id' => $kelompokGedung->id, 'kode' => '1.3.2', 'nama' => 'Bangunan Gedung Tempat Tinggal'],
            ['kelompok_id' => $kelompokGedung->id, 'kode' => '1.3.3', 'nama' => 'Bangunan Gedung Tempat Ibadah'],

            // Untuk Jalan, Irigasi, dan Jaringan (1.4)
            ['kelompok_id' => $kelompokJalan->id, 'kode' => '1.4.1', 'nama' => 'Jalan dan Jembatan'],
            ['kelompok_id' => $kelompokJalan->id, 'kode' => '1.4.2', 'nama' => 'Bangunan Air/Irigasi'],
            ['kelompok_id' => $kelompokJalan->id, 'kode' => '1.4.3', 'nama' => 'Jaringan Listrik dan Telepon'],

            // Untuk Aset Tetap Lainnya (1.5)
            ['kelompok_id' => $kelompokAsetTetapLain->id, 'kode' => '1.5.1', 'nama' => 'Konstruksi Dalam Pengerjaan'],
            ['kelompok_id' => $kelompokAsetTetapLain->id, 'kode' => '1.5.2', 'nama' => 'Akumulasi Penyusutan'],

            // Untuk Aset Tak Berwujud (2.1)
            ['kelompok_id' => $kelompokAsetTakBerwujud->id, 'kode' => '2.1.1', 'nama' => 'Software Komputer'],
            ['kelompok_id' => $kelompokAsetTakBerwujud->id, 'kode' => '2.1.2', 'nama' => 'Lisensi dan Hak Cipta'],

            // Untuk Aset Lain-lain (2.2)
            ['kelompok_id' => $kelompokAsetLainLain->id, 'kode' => '2.2.1', 'nama' => 'Koleksi Perpustakaan'],
            ['kelompok_id' => $kelompokAsetLainLain->id, 'kode' => '2.2.2', 'nama' => 'Barang Bercorak Seni'],
        ];

        foreach ($jenis as $item) {
            Jenis::create($item);
        }
    }
}
