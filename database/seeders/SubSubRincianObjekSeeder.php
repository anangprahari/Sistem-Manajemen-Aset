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
        // Ambil data SubRincianObjek yang sudah ada
        $subSedan4Pintu = SubRincianObjek::where('kode', '1.2.2.01.01.01')->first();
        $subSedan2Pintu = SubRincianObjek::where('kode', '1.2.2.01.01.02')->first();
        $subSedanHatchback = SubRincianObjek::where('kode', '1.2.2.01.01.03')->first();

        $subKomputerDesktop = SubRincianObjek::where('kode', '1.2.5.01.05.01')->first();
        $subKomputerLaptop = SubRincianObjek::where('kode', '1.2.5.01.05.02')->first();
        $subKomputerTablet = SubRincianObjek::where('kode', '1.2.5.01.05.03')->first();
        $subKomputerServer = SubRincianObjek::where('kode', '1.2.5.01.05.04')->first();

        $subPrinterInkjet = SubRincianObjek::where('kode', '1.2.5.01.06.01')->first();
        $subPrinterLaser = SubRincianObjek::where('kode', '1.2.5.01.06.02')->first();
        $subPrinterDotMatrix = SubRincianObjek::where('kode', '1.2.5.01.06.03')->first();
        $subPrinterMultifungsi = SubRincianObjek::where('kode', '1.2.5.01.06.04')->first();

        $subKursiKantor = SubRincianObjek::where('kode', '1.2.5.03.01.01')->first();
        $subKursiRapat = SubRincianObjek::where('kode', '1.2.5.03.01.02')->first();
        $subKursiTamu = SubRincianObjek::where('kode', '1.2.5.03.01.03')->first();
        $subKursiLipat = SubRincianObjek::where('kode', '1.2.5.03.01.04')->first();

        $subMejaKerja = SubRincianObjek::where('kode', '1.2.5.03.02.01')->first();
        $subMejaRapat = SubRincianObjek::where('kode', '1.2.5.03.02.02')->first();
        $subMejaKomputer = SubRincianObjek::where('kode', '1.2.5.03.02.03')->first();
        $subMejaLipat = SubRincianObjek::where('kode', '1.2.5.03.02.04')->first();

        $subSubRincianObjeks = [
            // Untuk Sedan 4 Pintu
            ['sub_rincian_objek_id' => $subSedan4Pintu->id, 'kode' => '1.2.2.01.01.01.01', 'nama_barang' => 'Sedan 4 Pintu Toyota Camry'],
            ['sub_rincian_objek_id' => $subSedan4Pintu->id, 'kode' => '1.2.2.01.01.01.02', 'nama_barang' => 'Sedan 4 Pintu Honda Accord'],
            ['sub_rincian_objek_id' => $subSedan4Pintu->id, 'kode' => '1.2.2.01.01.01.03', 'nama_barang' => 'Sedan 4 Pintu Nissan Teana'],

            // Untuk Sedan 2 Pintu
            ['sub_rincian_objek_id' => $subSedan2Pintu->id, 'kode' => '1.2.2.01.01.02.01', 'nama_barang' => 'Sedan 2 Pintu BMW 3 Series Coupe'],
            ['sub_rincian_objek_id' => $subSedan2Pintu->id, 'kode' => '1.2.2.01.01.02.02', 'nama_barang' => 'Sedan 2 Pintu Mercedes C-Class Coupe'],

            // Untuk Sedan Hatchback
            ['sub_rincian_objek_id' => $subSedanHatchback->id, 'kode' => '1.2.2.01.01.03.01', 'nama_barang' => 'Sedan Hatchback Honda Civic Type R'],
            ['sub_rincian_objek_id' => $subSedanHatchback->id, 'kode' => '1.2.2.01.01.03.02', 'nama_barang' => 'Sedan Hatchback Toyota Yaris'],

            // Untuk Komputer Desktop
            ['sub_rincian_objek_id' => $subKomputerDesktop->id, 'kode' => '1.2.5.01.05.01.01', 'nama_barang' => 'PC Desktop Dell OptiPlex 7090'],
            ['sub_rincian_objek_id' => $subKomputerDesktop->id, 'kode' => '1.2.5.01.05.01.02', 'nama_barang' => 'PC Desktop HP EliteDesk 800'],
            ['sub_rincian_objek_id' => $subKomputerDesktop->id, 'kode' => '1.2.5.01.05.01.03', 'nama_barang' => 'PC Desktop Lenovo ThinkCentre M720'],

            // Untuk Komputer Laptop
            ['sub_rincian_objek_id' => $subKomputerLaptop->id, 'kode' => '1.2.5.01.05.02.01', 'nama_barang' => 'Laptop Dell Latitude 5420'],
            ['sub_rincian_objek_id' => $subKomputerLaptop->id, 'kode' => '1.2.5.01.05.02.02', 'nama_barang' => 'Laptop HP EliteBook 840'],
            ['sub_rincian_objek_id' => $subKomputerLaptop->id, 'kode' => '1.2.5.01.05.02.03', 'nama_barang' => 'Laptop Lenovo ThinkPad X1 Carbon'],

            // Untuk Komputer Tablet
            ['sub_rincian_objek_id' => $subKomputerTablet->id, 'kode' => '1.2.5.01.05.03.01', 'nama_barang' => 'Tablet Microsoft Surface Pro 8'],
            ['sub_rincian_objek_id' => $subKomputerTablet->id, 'kode' => '1.2.5.01.05.03.02', 'nama_barang' => 'Tablet iPad Pro 12.9 inch'],

            // Untuk Komputer Server
            ['sub_rincian_objek_id' => $subKomputerServer->id, 'kode' => '1.2.5.01.05.04.01', 'nama_barang' => 'Server Dell PowerEdge R740'],
            ['sub_rincian_objek_id' => $subKomputerServer->id, 'kode' => '1.2.5.01.05.04.02', 'nama_barang' => 'Server HP ProLiant DL380'],

            // Untuk Printer Inkjet
            ['sub_rincian_objek_id' => $subPrinterInkjet->id, 'kode' => '1.2.5.01.06.01.01', 'nama_barang' => 'Printer Inkjet Canon PIXMA G3010'],
            ['sub_rincian_objek_id' => $subPrinterInkjet->id, 'kode' => '1.2.5.01.06.01.02', 'nama_barang' => 'Printer Inkjet HP DeskJet 2720'],
            ['sub_rincian_objek_id' => $subPrinterInkjet->id, 'kode' => '1.2.5.01.06.01.03', 'nama_barang' => 'Printer Inkjet Epson EcoTank L3150'],

            // Untuk Printer Laser
            ['sub_rincian_objek_id' => $subPrinterLaser->id, 'kode' => '1.2.5.01.06.02.01', 'nama_barang' => 'Printer Laser Canon LBP2900'],
            ['sub_rincian_objek_id' => $subPrinterLaser->id, 'kode' => '1.2.5.01.06.02.02', 'nama_barang' => 'Printer Laser HP LaserJet Pro M404n'],
            ['sub_rincian_objek_id' => $subPrinterLaser->id, 'kode' => '1.2.5.01.06.02.03', 'nama_barang' => 'Printer Laser Brother HL-L2375DW'],

            // Untuk Printer Dot Matrix
            ['sub_rincian_objek_id' => $subPrinterDotMatrix->id, 'kode' => '1.2.5.01.06.03.01', 'nama_barang' => 'Printer Dot Matrix Epson LQ-310'],
            ['sub_rincian_objek_id' => $subPrinterDotMatrix->id, 'kode' => '1.2.5.01.06.03.02', 'nama_barang' => 'Printer Dot Matrix Epson LX-310'],

            // Untuk Printer Multifungsi
            ['sub_rincian_objek_id' => $subPrinterMultifungsi->id, 'kode' => '1.2.5.01.06.04.01', 'nama_barang' => 'Printer Multifungsi Canon TR4570S'],
            ['sub_rincian_objek_id' => $subPrinterMultifungsi->id, 'kode' => '1.2.5.01.06.04.02', 'nama_barang' => 'Printer Multifungsi HP DeskJet 2632'],

            // Untuk Kursi Kantor
            ['sub_rincian_objek_id' => $subKursiKantor->id, 'kode' => '1.2.5.03.01.01.01', 'nama_barang' => 'Kursi Kantor Ergonomis High Back'],
            ['sub_rincian_objek_id' => $subKursiKantor->id, 'kode' => '1.2.5.03.01.01.02', 'nama_barang' => 'Kursi Kantor Putar Mesh'],
            ['sub_rincian_objek_id' => $subKursiKantor->id, 'kode' => '1.2.5.03.01.01.03', 'nama_barang' => 'Kursi Kantor Executive Kulit'],

            // Untuk Kursi Rapat
            ['sub_rincian_objek_id' => $subKursiRapat->id, 'kode' => '1.2.5.03.01.02.01', 'nama_barang' => 'Kursi Rapat Stacking Chair'],
            ['sub_rincian_objek_id' => $subKursiRapat->id, 'kode' => '1.2.5.03.01.02.02', 'nama_barang' => 'Kursi Rapat Berlengan Fabric'],

            // Untuk Kursi Tamu
            ['sub_rincian_objek_id' => $subKursiTamu->id, 'kode' => '1.2.5.03.01.03.01', 'nama_barang' => 'Kursi Tamu Sofa 1 Dudukan'],
            ['sub_rincian_objek_id' => $subKursiTamu->id, 'kode' => '1.2.5.03.01.03.02', 'nama_barang' => 'Kursi Tamu Minimalis Kayu'],

            // Untuk Kursi Lipat
            ['sub_rincian_objek_id' => $subKursiLipat->id, 'kode' => '1.2.5.03.01.04.01', 'nama_barang' => 'Kursi Lipat Plastik Chitose'],
            ['sub_rincian_objek_id' => $subKursiLipat->id, 'kode' => '1.2.5.03.01.04.02', 'nama_barang' => 'Kursi Lipat Besi Serbaguna'],

            // Untuk Meja Kerja
            ['sub_rincian_objek_id' => $subMejaKerja->id, 'kode' => '1.2.5.03.02.01.01', 'nama_barang' => 'Meja Kerja L-Shape 120x60 cm'],
            ['sub_rincian_objek_id' => $subMejaKerja->id, 'kode' => '1.2.5.03.02.01.02', 'nama_barang' => 'Meja Kerja Straight 100x60 cm'],
            ['sub_rincian_objek_id' => $subMejaKerja->id, 'kode' => '1.2.5.03.02.01.03', 'nama_barang' => 'Meja Kerja Standing Desk'],

            // Untuk Meja Rapat
            ['sub_rincian_objek_id' => $subMejaRapat->id, 'kode' => '1.2.5.03.02.02.01', 'nama_barang' => 'Meja Rapat Oval 240x120 cm'],
            ['sub_rincian_objek_id' => $subMejaRapat->id, 'kode' => '1.2.5.03.02.02.02', 'nama_barang' => 'Meja Rapat Persegi 180x90 cm'],

            // Untuk Meja Komputer
            ['sub_rincian_objek_id' => $subMejaKomputer->id, 'kode' => '1.2.5.03.02.03.01', 'nama_barang' => 'Meja Komputer dengan Rak CPU'],
            ['sub_rincian_objek_id' => $subMejaKomputer->id, 'kode' => '1.2.5.03.02.03.02', 'nama_barang' => 'Meja Komputer Gaming RGB'],

            // Untuk Meja Lipat
            ['sub_rincian_objek_id' => $subMejaLipat->id, 'kode' => '1.2.5.03.02.04.01', 'nama_barang' => 'Meja Lipat Serbaguna 120x60 cm'],
            ['sub_rincian_objek_id' => $subMejaLipat->id, 'kode' => '1.2.5.03.02.04.02', 'nama_barang' => 'Meja Lipat Portable 80x40 cm'],
        ];

        foreach ($subSubRincianObjeks as $subSubRincianObjek) {
            SubSubRincianObjek::create($subSubRincianObjek);
        }
    }
}
