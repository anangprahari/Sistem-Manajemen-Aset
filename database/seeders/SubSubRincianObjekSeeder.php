<?php

namespace Database\Seeders;

use App\Models\SubSubRincianObjek;
use App\Models\SubRincianObjek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubSubRincianObjekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil sub rincian objek yang ada
        $subRincianTanahDepan = SubRincianObjek::where('kode', '1.1.1.01.01.01')->first();
        $subRincianMesinLasListrik = SubRincianObjek::where('kode', '1.2.3.01.01.01')->first();
        $subRincianSedan4Pintu = SubRincianObjek::where('kode', '1.2.2.01.01.01')->first();
        $subRincianDesktop = SubRincianObjek::where('kode', '1.2.5.01.05.01')->first();
        $subRincianLaptop = SubRincianObjek::where('kode', '1.2.5.01.05.02')->first();
        $subRincianPrinterLaser = SubRincianObjek::where('kode', '1.2.5.01.06.03')->first();
        $subRincianKursiKerja = SubRincianObjek::where('kode', '1.2.5.03.01.01')->first();
        $subRincianMejaKerja = SubRincianObjek::where('kode', '1.2.5.03.02.01')->first();

        $subSubRincianObjeks = [
            // Untuk Tanah Depan Gedung (1.1.1.01.01.01)
            ['sub_rincian_objek_id' => $subRincianTanahDepan->id, 'kode' => '1.1.1.01.01.01.001', 'nama_barang' => 'Tanah Halaman Depan 500 m2'],
            ['sub_rincian_objek_id' => $subRincianTanahDepan->id, 'kode' => '1.1.1.01.01.01.002', 'nama_barang' => 'Tanah Taman Depan 200 m2'],

            // Untuk Mesin Las Listrik (1.2.3.01.01.01)
            ['sub_rincian_objek_id' => $subRincianMesinLasListrik->id, 'kode' => '1.2.3.01.01.01.001', 'nama_barang' => 'Mesin Las Listrik 200A'],
            ['sub_rincian_objek_id' => $subRincianMesinLasListrik->id, 'kode' => '1.2.3.01.01.01.002', 'nama_barang' => 'Mesin Las Listrik 300A'],
            ['sub_rincian_objek_id' => $subRincianMesinLasListrik->id, 'kode' => '1.2.3.01.01.01.003', 'nama_barang' => 'Mesin Las Listrik 400A'],

            // Untuk Sedan 4 Pintu (1.2.2.01.01.01)
            ['sub_rincian_objek_id' => $subRincianSedan4Pintu->id, 'kode' => '1.2.2.01.01.01.001', 'nama_barang' => 'Toyota Camry 2.4L'],
            ['sub_rincian_objek_id' => $subRincianSedan4Pintu->id, 'kode' => '1.2.2.01.01.01.002', 'nama_barang' => 'Honda Accord 2.0L'],
            ['sub_rincian_objek_id' => $subRincianSedan4Pintu->id, 'kode' => '1.2.2.01.01.01.003', 'nama_barang' => 'Nissan Teana 2.5L'],
            ['sub_rincian_objek_id' => $subRincianSedan4Pintu->id, 'kode' => '1.2.2.01.01.01.004', 'nama_barang' => 'Mitsubishi Lancer 1.6L'],

            // Untuk Komputer Desktop (1.2.5.01.05.01)
            ['sub_rincian_objek_id' => $subRincianDesktop->id, 'kode' => '1.2.5.01.05.01.001', 'nama_barang' => 'PC Desktop Intel Core i3 4GB RAM'],
            ['sub_rincian_objek_id' => $subRincianDesktop->id, 'kode' => '1.2.5.01.05.01.002', 'nama_barang' => 'PC Desktop Intel Core i5 8GB RAM'],
            ['sub_rincian_objek_id' => $subRincianDesktop->id, 'kode' => '1.2.5.01.05.01.003', 'nama_barang' => 'PC Desktop Intel Core i7 16GB RAM'],
            ['sub_rincian_objek_id' => $subRincianDesktop->id, 'kode' => '1.2.5.01.05.01.004', 'nama_barang' => 'PC Desktop AMD Ryzen 5 8GB RAM'],

            // Untuk Komputer Laptop (1.2.5.01.05.02)
            ['sub_rincian_objek_id' => $subRincianLaptop->id, 'kode' => '1.2.5.01.05.02.001', 'nama_barang' => 'Laptop ASUS VivoBook 14"'],
            ['sub_rincian_objek_id' => $subRincianLaptop->id, 'kode' => '1.2.5.01.05.02.002', 'nama_barang' => 'Laptop HP Pavilion 15"'],
            ['sub_rincian_objek_id' => $subRincianLaptop->id, 'kode' => '1.2.5.01.05.02.003', 'nama_barang' => 'Laptop Dell Inspiron 14"'],
            ['sub_rincian_objek_id' => $subRincianLaptop->id, 'kode' => '1.2.5.01.05.02.004', 'nama_barang' => 'Laptop Lenovo ThinkPad 15"'],

            // Untuk Printer Laser (1.2.5.01.06.03)
            ['sub_rincian_objek_id' => $subRincianPrinterLaser->id, 'kode' => '1.2.5.01.06.03.001', 'nama_barang' => 'Printer Laser HP LaserJet Pro'],
            ['sub_rincian_objek_id' => $subRincianPrinterLaser->id, 'kode' => '1.2.5.01.06.03.002', 'nama_barang' => 'Printer Laser Canon ImageClass'],
            ['sub_rincian_objek_id' => $subRincianPrinterLaser->id, 'kode' => '1.2.5.01.06.03.003', 'nama_barang' => 'Printer Laser Brother HL-L2350DW'],
            ['sub_rincian_objek_id' => $subRincianPrinterLaser->id, 'kode' => '1.2.5.01.06.03.004', 'nama_barang' => 'Printer Laser Epson WorkForce'],

            // Untuk Kursi Kerja (1.2.5.03.01.01)
            ['sub_rincian_objek_id' => $subRincianKursiKerja->id, 'kode' => '1.2.5.03.01.01.001', 'nama_barang' => 'Kursi Kerja Eksekutif Kulit'],
            ['sub_rincian_objek_id' => $subRincianKursiKerja->id, 'kode' => '1.2.5.03.01.01.002', 'nama_barang' => 'Kursi Kerja Staff Fabric'],
            ['sub_rincian_objek_id' => $subRincianKursiKerja->id, 'kode' => '1.2.5.03.01.01.003', 'nama_barang' => 'Kursi Kerja Ergonomis Mesh'],
            ['sub_rincian_objek_id' => $subRincianKursiKerja->id, 'kode' => '1.2.5.03.01.01.004', 'nama_barang' => 'Kursi Kerja Gaming Racing'],

            // Untuk Meja Kerja (1.2.5.03.02.01)
            ['sub_rincian_objek_id' => $subRincianMejaKerja->id, 'kode' => '1.2.5.03.02.01.001', 'nama_barang' => 'Meja Kerja L-Shape Kayu Jati'],
            ['sub_rincian_objek_id' => $subRincianMejaKerja->id, 'kode' => '1.2.5.03.02.01.002', 'nama_barang' => 'Meja Kerja Straight Melamine'],
            ['sub_rincian_objek_id' => $subRincianMejaKerja->id, 'kode' => '1.2.5.03.02.01.003', 'nama_barang' => 'Meja Kerja Standing Desk'],
            ['sub_rincian_objek_id' => $subRincianMejaKerja->id, 'kode' => '1.2.5.03.02.01.004', 'nama_barang' => 'Meja Kerja Executive Mahogany'],
        ];

        foreach ($subSubRincianObjeks as $subSubRincianObjek) {
            SubSubRincianObjek::create($subSubRincianObjek);
        }
    }
}
