<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubRincianObjek;
use App\Models\RincianObjek;

class SubRincianObjekSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil rincian objek yang ada
        $rincianSedan = RincianObjek::where('kode', '1.2.2.01.01')->first();
        $rincianKomputer = RincianObjek::where('kode', '1.2.5.01.05')->first();
        $rincianPrinter = RincianObjek::where('kode', '1.2.5.01.06')->first();
        $rincianKursi = RincianObjek::where('kode', '1.2.5.03.01')->first();
        $rincianMeja = RincianObjek::where('kode', '1.2.5.03.02')->first();
        $rincianTanahGedung = RincianObjek::where('kode', '1.1.1.01.01')->first();
        $rincianPeralatanLas = RincianObjek::where('kode', '1.2.3.01.01')->first();

        $subRincianObjeks = [
            // Untuk Tanah Gedung Utama (1.1.1.01.01)
            ['rincian_objek_id' => $rincianTanahGedung->id, 'kode' => '1.1.1.01.01.01', 'nama' => 'Tanah Depan Gedung'],
            ['rincian_objek_id' => $rincianTanahGedung->id, 'kode' => '1.1.1.01.01.02', 'nama' => 'Tanah Samping Gedung'],

            // Untuk Peralatan Las (1.2.3.01.01)
            ['rincian_objek_id' => $rincianPeralatanLas->id, 'kode' => '1.2.3.01.01.01', 'nama' => 'Mesin Las Listrik'],
            ['rincian_objek_id' => $rincianPeralatanLas->id, 'kode' => '1.2.3.01.01.02', 'nama' => 'Mesin Las Argon'],

            // Untuk Sedan (1.2.2.01.01)
            ['rincian_objek_id' => $rincianSedan->id, 'kode' => '1.2.2.01.01.01', 'nama' => 'Sedan 4 Pintu'],
            ['rincian_objek_id' => $rincianSedan->id, 'kode' => '1.2.2.01.01.02', 'nama' => 'Sedan 2 Pintu'],
            ['rincian_objek_id' => $rincianSedan->id, 'kode' => '1.2.2.01.01.03', 'nama' => 'Sedan Hatchback'],

            // Untuk Komputer (1.2.5.01.05)
            ['rincian_objek_id' => $rincianKomputer->id, 'kode' => '1.2.5.01.05.01', 'nama' => 'Komputer Desktop'],
            ['rincian_objek_id' => $rincianKomputer->id, 'kode' => '1.2.5.01.05.02', 'nama' => 'Komputer Laptop'],
            ['rincian_objek_id' => $rincianKomputer->id, 'kode' => '1.2.5.01.05.03', 'nama' => 'Komputer Server'],
            ['rincian_objek_id' => $rincianKomputer->id, 'kode' => '1.2.5.01.05.04', 'nama' => 'Komputer Tablet'],

            // Untuk Printer (1.2.5.01.06)
            ['rincian_objek_id' => $rincianPrinter->id, 'kode' => '1.2.5.01.06.01', 'nama' => 'Printer Dot Matrix'],
            ['rincian_objek_id' => $rincianPrinter->id, 'kode' => '1.2.5.01.06.02', 'nama' => 'Printer Ink Jet'],
            ['rincian_objek_id' => $rincianPrinter->id, 'kode' => '1.2.5.01.06.03', 'nama' => 'Printer Laser'],
            ['rincian_objek_id' => $rincianPrinter->id, 'kode' => '1.2.5.01.06.04', 'nama' => 'Printer Multifungsi'],

            // Untuk Kursi (1.2.5.03.01)
            ['rincian_objek_id' => $rincianKursi->id, 'kode' => '1.2.5.03.01.01', 'nama' => 'Kursi Kerja'],
            ['rincian_objek_id' => $rincianKursi->id, 'kode' => '1.2.5.03.01.02', 'nama' => 'Kursi Tamu'],
            ['rincian_objek_id' => $rincianKursi->id, 'kode' => '1.2.5.03.01.03', 'nama' => 'Kursi Rapat'],
            ['rincian_objek_id' => $rincianKursi->id, 'kode' => '1.2.5.03.01.04', 'nama' => 'Kursi Sofa'],

            // Untuk Meja (1.2.5.03.02)
            ['rincian_objek_id' => $rincianMeja->id, 'kode' => '1.2.5.03.02.01', 'nama' => 'Meja Kerja'],
            ['rincian_objek_id' => $rincianMeja->id, 'kode' => '1.2.5.03.02.02', 'nama' => 'Meja Rapat'],
            ['rincian_objek_id' => $rincianMeja->id, 'kode' => '1.2.5.03.02.03', 'nama' => 'Meja Komputer'],
            ['rincian_objek_id' => $rincianMeja->id, 'kode' => '1.2.5.03.02.04', 'nama' => 'Meja Tamu'],
        ];

        foreach ($subRincianObjeks as $subRincianObjek) {
            SubRincianObjek::create($subRincianObjek);
        }
    }
}
