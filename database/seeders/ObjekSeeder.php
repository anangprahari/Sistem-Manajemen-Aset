<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Objek;
use App\Models\Jenis;

class ObjekSeeder extends Seeder
{
    public function run(): void
    {
        $jenisAngkutan = Jenis::where('kode', '1.2.2')->first();
        $jenisKantor = Jenis::where('kode', '1.2.5')->first();
        $jenisStudio = Jenis::where('kode', '1.2.6')->first();
        $jenisGedungKerja = Jenis::where('kode', '1.3.1')->first();

        $objeks = [
            // Untuk Alat Angkutan Darat Bermotor
            ['jenis_id' => $jenisAngkutan->id, 'kode' => '1.2.2.01', 'nama' => 'Kendaraan Dinas'],
            ['jenis_id' => $jenisAngkutan->id, 'kode' => '1.2.2.02', 'nama' => 'Kendaraan Operasional'],
            ['jenis_id' => $jenisAngkutan->id, 'kode' => '1.2.2.03', 'nama' => 'Kendaraan Khusus'],
            ['jenis_id' => $jenisAngkutan->id, 'kode' => '1.2.2.04', 'nama' => 'Alat Angkut Barang'],

            // Untuk Alat Kantor dan Rumah Tangga
            ['jenis_id' => $jenisKantor->id, 'kode' => '1.2.5.01', 'nama' => 'Alat Kantor'],
            ['jenis_id' => $jenisKantor->id, 'kode' => '1.2.5.02', 'nama' => 'Alat Rumah Tangga'],
            ['jenis_id' => $jenisKantor->id, 'kode' => '1.2.5.03', 'nama' => 'Meubelair'],
            ['jenis_id' => $jenisKantor->id, 'kode' => '1.2.5.04', 'nama' => 'Peralatan Dapur'],

            // Untuk Alat Studio dan Komunikasi
            ['jenis_id' => $jenisStudio->id, 'kode' => '1.2.6.01', 'nama' => 'Alat Studio'],
            ['jenis_id' => $jenisStudio->id, 'kode' => '1.2.6.02', 'nama' => 'Alat Komunikasi'],
            ['jenis_id' => $jenisStudio->id, 'kode' => '1.2.6.03', 'nama' => 'Peralatan Pemancar'],

            // Untuk Bangunan Gedung Tempat Kerja
            ['jenis_id' => $jenisGedungKerja->id, 'kode' => '1.3.1.01', 'nama' => 'Bangunan Gedung Perkantoran'],
            ['jenis_id' => $jenisGedungKerja->id, 'kode' => '1.3.1.02', 'nama' => 'Bangunan Gedung Pendidikan'],
            ['jenis_id' => $jenisGedungKerja->id, 'kode' => '1.3.1.03', 'nama' => 'Bangunan Gedung Kesehatan'],
        ];

        foreach ($objeks as $objek) {
            Objek::create($objek);
        }
    }
}
