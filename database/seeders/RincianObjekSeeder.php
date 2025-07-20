<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RincianObjek;
use App\Models\Objek;

class RincianObjekSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil objek yang ada
        $objekKendaraanDinas = Objek::where('kode', '1.2.2.01')->first();
        $objekAlatKantor = Objek::where('kode', '1.2.5.01')->first();
        $objekAlatKomunikasi = Objek::where('kode', '1.2.6.02')->first();
        $objekMeubelair = Objek::where('kode', '1.2.5.03')->first();
        $objekTanahKantorPusat = Objek::where('kode', '1.1.1.01')->first();
        $objekAlatBengkel = Objek::where('kode', '1.2.3.01')->first();

        $rincianObjeks = [
            // Untuk Tanah Kantor Pusat (1.1.1.01)
            ['objek_id' => $objekTanahKantorPusat->id, 'kode' => '1.1.1.01.01', 'nama' => 'Tanah Gedung Utama'],
            ['objek_id' => $objekTanahKantorPusat->id, 'kode' => '1.1.1.01.02', 'nama' => 'Tanah Parkir'],

            // Untuk Alat Bengkel Umum (1.2.3.01)
            ['objek_id' => $objekAlatBengkel->id, 'kode' => '1.2.3.01.01', 'nama' => 'Peralatan Las'],
            ['objek_id' => $objekAlatBengkel->id, 'kode' => '1.2.3.01.02', 'nama' => 'Peralatan Bubut'],

            // Untuk Kendaraan Dinas (1.2.2.01)
            ['objek_id' => $objekKendaraanDinas->id, 'kode' => '1.2.2.01.01', 'nama' => 'Sedan'],
            ['objek_id' => $objekKendaraanDinas->id, 'kode' => '1.2.2.01.02', 'nama' => 'Station Wagon'],
            ['objek_id' => $objekKendaraanDinas->id, 'kode' => '1.2.2.01.03', 'nama' => 'Jeep'],
            ['objek_id' => $objekKendaraanDinas->id, 'kode' => '1.2.2.01.04', 'nama' => 'Minibus'],
            ['objek_id' => $objekKendaraanDinas->id, 'kode' => '1.2.2.01.05', 'nama' => 'Microbus'],
            ['objek_id' => $objekKendaraanDinas->id, 'kode' => '1.2.2.01.06', 'nama' => 'Bus'],

            // Untuk Alat Kantor (1.2.5.01)
            ['objek_id' => $objekAlatKantor->id, 'kode' => '1.2.5.01.01', 'nama' => 'Mesin Tulis'],
            ['objek_id' => $objekAlatKantor->id, 'kode' => '1.2.5.01.02', 'nama' => 'Mesin Hitung'],
            ['objek_id' => $objekAlatKantor->id, 'kode' => '1.2.5.01.03', 'nama' => 'Mesin Stensil'],
            ['objek_id' => $objekAlatKantor->id, 'kode' => '1.2.5.01.04', 'nama' => 'Mesin Fotokopi'],
            ['objek_id' => $objekAlatKantor->id, 'kode' => '1.2.5.01.05', 'nama' => 'Komputer'],
            ['objek_id' => $objekAlatKantor->id, 'kode' => '1.2.5.01.06', 'nama' => 'Printer'],

            // Untuk Alat Komunikasi (1.2.6.02)
            ['objek_id' => $objekAlatKomunikasi->id, 'kode' => '1.2.6.02.01', 'nama' => 'Telepon'],
            ['objek_id' => $objekAlatKomunikasi->id, 'kode' => '1.2.6.02.02', 'nama' => 'Facsimile'],
            ['objek_id' => $objekAlatKomunikasi->id, 'kode' => '1.2.6.02.03', 'nama' => 'Wireless'],
            ['objek_id' => $objekAlatKomunikasi->id, 'kode' => '1.2.6.02.04', 'nama' => 'Handy Talky'],

            // Untuk Meubelair (1.2.5.03)
            ['objek_id' => $objekMeubelair->id, 'kode' => '1.2.5.03.01', 'nama' => 'Kursi'],
            ['objek_id' => $objekMeubelair->id, 'kode' => '1.2.5.03.02', 'nama' => 'Meja'],
            ['objek_id' => $objekMeubelair->id, 'kode' => '1.2.5.03.03', 'nama' => 'Lemari'],
            ['objek_id' => $objekMeubelair->id, 'kode' => '1.2.5.03.04', 'nama' => 'Rak'],
        ];
        foreach ($rincianObjeks as $rincianObjek) {
            RincianObjek::create($rincianObjek);
        }
    }
}
