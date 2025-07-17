<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jenis;
use App\Models\Kelompok;

class JenisSeeder extends Seeder
{
    public function run(): void
    {
        $kelompokMesin = Kelompok::where('kode', '1.2')->first();
        $kelompokGedung = Kelompok::where('kode', '1.3')->first();
        $kelompokJalan = Kelompok::where('kode', '1.4')->first();

        $jenis = [
            // Untuk Mesin dan Peralatan
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.1', 'nama' => 'Alat Besar Darat'],
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.2', 'nama' => 'Alat Angkutan Darat Bermotor'],
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.3', 'nama' => 'Alat Bengkel dan Ukur'],
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.4', 'nama' => 'Alat Pertanian'],
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.5', 'nama' => 'Alat Kantor dan Rumah Tangga'],
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.6', 'nama' => 'Alat Studio dan Komunikasi'],
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.7', 'nama' => 'Alat Kedokteran'],
            ['kelompok_id' => $kelompokMesin->id, 'kode' => '1.2.8', 'nama' => 'Alat Laboratorium'],

            // Untuk Gedung dan Bangunan
            ['kelompok_id' => $kelompokGedung->id, 'kode' => '1.3.1', 'nama' => 'Bangunan Gedung Tempat Kerja'],
            ['kelompok_id' => $kelompokGedung->id, 'kode' => '1.3.2', 'nama' => 'Bangunan Gedung Tempat Tinggal'],
            ['kelompok_id' => $kelompokGedung->id, 'kode' => '1.3.3', 'nama' => 'Bangunan Gedung Tempat Ibadah'],

            // Untuk Jalan, Irigasi, dan Jaringan
            ['kelompok_id' => $kelompokJalan->id, 'kode' => '1.4.1', 'nama' => 'Jalan dan Jembatan'],
            ['kelompok_id' => $kelompokJalan->id, 'kode' => '1.4.2', 'nama' => 'Bangunan Air/Irigasi'],
        ];

        foreach ($jenis as $item) {
            Jenis::create($item);
        }
    }
}
