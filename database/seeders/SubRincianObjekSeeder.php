<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubRincianObjek;
use App\Models\RincianObjek;

class SubRincianObjekSeeder extends Seeder
{
    public function run(): void
    {
        $rincianSedan = RincianObjek::where('kode', '1.2.2.01.01')->first();
        $rincianKomputer = RincianObjek::where('kode', '1.2.5.01.05')->first();
        $rincianPrinter = RincianObjek::where('kode', '1.2.5.01.06')->first();
        $rincianKursi = RincianObjek::where('kode', '1.2.5.03.01')->first();
        $rincianMeja = RincianObjek::where('kode', '1.2.5.03.02')->first();

        $subRincianObjeks = [
            // Untuk Sedan
            ['rincian_objek_id' => $rincianSedan->id, 'kode' => '1.2.2.01.01.01', 'nama' => 'Sedan 4 Pintu'],
            ['rincian_objek_id' => $rincianSedan->id, 'kode' => '1.2.2.01.01.02', 'nama' => 'Sedan 2 Pintu'],
            ['rincian_objek_id' => $rincianSedan->id, 'kode' => '1.2.2.01.01.03', 'nama' => 'Sedan Hatchback'],

            // Untuk Komputer
            ['rincian_objek_id' => $rincianKomputer->id, 'kode' => '1.2.5.01.05.01', 'nama' => 'Komputer Desktop'],
            ['rincian_objek_id' => $rincianKomputer->id, 'kode' => '1.2.5.01.05.02', 'nama' => 'Komputer Laptop'],
            ['rincian_objek_id' => $rincianKomputer->id, 'kode' => '1.2.5.01.05.03', 'nama' => 'Komputer Tablet'],
            ['rincian_objek_id' => $rincianKomputer->id, 'kode' => '1.2.5.01.05.04', 'nama' => 'Komputer Server'],

            // Untuk Printer
            ['rincian_objek_id' => $rincianPrinter->id, 'kode' => '1.2.5.01.06.01', 'nama' => 'Printer Inkjet'],
            ['rincian_objek_id' => $rincianPrinter->id, 'kode' => '1.2.5.01.06.02', 'nama' => 'Printer Laser'],
            ['rincian_objek_id' => $rincianPrinter->id, 'kode' => '1.2.5.01.06.03', 'nama' => 'Printer Dot Matrix'],
            ['rincian_objek_id' => $rincianPrinter->id, 'kode' => '1.2.5.01.06.04', 'nama' => 'Printer Multifungsi'],

            // Untuk Kursi
            ['rincian_objek_id' => $rincianKursi->id, 'kode' => '1.2.5.03.01.01', 'nama' => 'Kursi Kantor'],
            ['rincian_objek_id' => $rincianKursi->id, 'kode' => '1.2.5.03.01.02', 'nama' => 'Kursi Rapat'],
            ['rincian_objek_id' => $rincianKursi->id, 'kode' => '1.2.5.03.01.03', 'nama' => 'Kursi Tamu'],
            ['rincian_objek_id' => $rincianKursi->id, 'kode' => '1.2.5.03.01.04', 'nama' => 'Kursi Lipat'],

            // Untuk Meja
            ['rincian_objek_id' => $rincianMeja->id, 'kode' => '1.2.5.03.02.01', 'nama' => 'Meja Kerja'],
            ['rincian_objek_id' => $rincianMeja->id, 'kode' => '1.2.5.03.02.02', 'nama' => 'Meja Rapat'],
            ['rincian_objek_id' => $rincianMeja->id, 'kode' => '1.2.5.03.02.03', 'nama' => 'Meja Komputer'],
            ['rincian_objek_id' => $rincianMeja->id, 'kode' => '1.2.5.03.02.04', 'nama' => 'Meja Lipat'],
        ];

        foreach ($subRincianObjeks as $subRincianObjek) {
            SubRincianObjek::create($subRincianObjek);
        }
    }
}
