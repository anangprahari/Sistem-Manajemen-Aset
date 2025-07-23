<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubSubRincianObjek;
use App\Models\SubRincianObjek;

class SubSubRincianObjekSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil sub rincian objek yang ada berdasarkan kode
        // TANAH UNTUK BANGUNAN GEDUNG
        $subRincianTanahGedungKantor = SubRincianObjek::where('kode', '1.3.1.01.01.001')->first();
        $subRincianTanahGedungSekolah = SubRincianObjek::where('kode', '1.3.1.01.01.002')->first();
        $subRincianTanahGedungRumahSakit = SubRincianObjek::where('kode', '1.3.1.01.01.003')->first();
        $subRincianTanahGedungPuskesmas = SubRincianObjek::where('kode', '1.3.1.01.01.004')->first();

        // TANAH UNTUK BANGUNAN SARANA DAN PRASARANA
        $subRincianTanahGudang = SubRincianObjek::where('kode', '1.3.1.01.02.001')->first();
        $subRincianTanahBengkel = SubRincianObjek::where('kode', '1.3.1.01.02.002')->first();
        $subRincianTanahInstalasiListrik = SubRincianObjek::where('kode', '1.3.1.01.02.003')->first();

        // TANAH UNTUK JALAN DAN JEMBATAN
        $subRincianTanahJalanNasional = SubRincianObjek::where('kode', '1.3.1.01.03.001')->first();
        $subRincianTanahJalanProvinsi = SubRincianObjek::where('kode', '1.3.1.01.03.002')->first();
        $subRincianTanahJalanKabupaten = SubRincianObjek::where('kode', '1.3.1.01.03.003')->first();
        $subRincianTanahJembatan = SubRincianObjek::where('kode', '1.3.1.01.03.004')->first();

        // TANAH UNTUK TAMAN DAN LAPANGAN
        $subRincianTanahTamanKota = SubRincianObjek::where('kode', '1.3.1.01.04.001')->first();
        $subRincianTanahLapanganOlahraga = SubRincianObjek::where('kode', '1.3.1.01.04.002')->first();
        $subRincianTanahRuangTerbukaHijau = SubRincianObjek::where('kode', '1.3.1.01.04.003')->first();

        // TANAH UNTUK LAHAN PARKIR
        $subRincianTanahParkirDinas = SubRincianObjek::where('kode', '1.3.1.01.05.001')->first();
        $subRincianTanahParkirUmum = SubRincianObjek::where('kode', '1.3.1.01.05.002')->first();

        // TRAKTOR
        $subRincianTraktorRodaEmpat = SubRincianObjek::where('kode', '1.3.2.01.01.001')->first();
        $subRincianTraktorRodaRantai = SubRincianObjek::where('kode', '1.3.2.01.01.002')->first();
        $subRincianTraktorMini = SubRincianObjek::where('kode', '1.3.2.01.01.003')->first();

        // EXCAVATOR
        $subRincianExcavatorRodaRantai = SubRincianObjek::where('kode', '1.3.2.01.02.001')->first();
        $subRincianExcavatorRodaKaret = SubRincianObjek::where('kode', '1.3.2.01.02.002')->first();
        $subRincianMiniExcavator = SubRincianObjek::where('kode', '1.3.2.01.02.003')->first();

        // BULLDOZER
        $subRincianBulldozerSedang = SubRincianObjek::where('kode', '1.3.2.01.03.001')->first();
        $subRincianBulldozerBesar = SubRincianObjek::where('kode', '1.3.2.01.03.002')->first();

        // LOADER
        $subRincianWheelLoader = SubRincianObjek::where('kode', '1.3.2.01.04.001')->first();
        $subRincianTrackLoader = SubRincianObjek::where('kode', '1.3.2.01.04.002')->first();
        $subRincianSkidSteerLoader = SubRincianObjek::where('kode', '1.3.2.01.04.003')->first();

        // GRADER
        $subRincianMotorGrader = SubRincianObjek::where('kode', '1.3.2.01.05.001')->first();
        $subRincianGraderBlade = SubRincianObjek::where('kode', '1.3.2.01.05.002')->first();

        // CRANE
        $subRincianMobileCrane = SubRincianObjek::where('kode', '1.3.2.01.06.001')->first();
        $subRincianTowerCrane = SubRincianObjek::where('kode', '1.3.2.01.06.002')->first();
        $subRincianTruckCrane = SubRincianObjek::where('kode', '1.3.2.01.06.003')->first();

        // KENDARAAN DINAS
        $subRincianSedan = SubRincianObjek::where('kode', '1.3.2.02.01.001')->first();
        $subRincianStationWagon = SubRincianObjek::where('kode', '1.3.2.02.01.002')->first();
        $subRincianJeep = SubRincianObjek::where('kode', '1.3.2.02.01.003')->first();
        $subRincianMiniBus = SubRincianObjek::where('kode', '1.3.2.02.01.004')->first();

        // KENDARAAN OPERASIONAL
        $subRincianPickUp = SubRincianObjek::where('kode', '1.3.2.02.02.001')->first();
        $subRincianTruck = SubRincianObjek::where('kode', '1.3.2.02.02.002')->first();
        $subRincianBus = SubRincianObjek::where('kode', '1.3.2.02.02.003')->first();
        $subRincianSepedaMotor = SubRincianObjek::where('kode', '1.3.2.02.02.004')->first();

        // ANGKUTAN DARAT BERMOTOR
        $subRincianMobilPenumpang = SubRincianObjek::where('kode', '1.3.2.02.03.001')->first();
        $subRincianMobilBarang = SubRincianObjek::where('kode', '1.3.2.02.03.002')->first();
        $subRincianMobilKhusus = SubRincianObjek::where('kode', '1.3.2.02.03.003')->first();

        // ANGKUTAN DARAT TAK BERMOTOR
        $subRincianSepeda = SubRincianObjek::where('kode', '1.3.2.02.04.001')->first();
        $subRincianGerobak = SubRincianObjek::where('kode', '1.3.2.02.04.002')->first();
        $subRincianKeretaDorong = SubRincianObjek::where('kode', '1.3.2.02.04.003')->first();

        // ANGKUTAN AIR BERMOTOR
        $subRincianKapalMotor = SubRincianObjek::where('kode', '1.3.2.02.05.001')->first();
        $subRincianSpeedBoat = SubRincianObjek::where('kode', '1.3.2.02.05.002')->first();
        $subRincianPerahuMotor = SubRincianObjek::where('kode', '1.3.2.02.05.003')->first();

        // ANGKUTAN AIR TAK BERMOTOR
        $subRincianPerahuDayung = SubRincianObjek::where('kode', '1.3.2.02.06.001')->first();
        $subRincianRakit = SubRincianObjek::where('kode', '1.3.2.02.06.002')->first();
        $subRincianSampan = SubRincianObjek::where('kode', '1.3.2.02.06.003')->first();

        $subSubRincianObjeks = [
            // TANAH UNTUK BANGUNAN GEDUNG
            ['sub_rincian_objek_id' => $subRincianTanahGedungKantor->id, 'kode' => '1.3.1.01.01.001.001', 'nama_barang' => 'TANAH GEDUNG KANTOR BUPATI'],
            ['sub_rincian_objek_id' => $subRincianTanahGedungSekolah->id, 'kode' => '1.3.1.01.01.002.001', 'nama_barang' => 'TANAH GEDUNG SDN 001'],
            ['sub_rincian_objek_id' => $subRincianTanahGedungRumahSakit->id, 'kode' => '1.3.1.01.01.003.001', 'nama_barang' => 'TANAH RSUD KABUPATEN'],
            ['sub_rincian_objek_id' => $subRincianTanahGedungPuskesmas->id, 'kode' => '1.3.1.01.01.004.001', 'nama_barang' => 'TANAH PUSKESMAS KECAMATAN A'],

            // TANAH UNTUK BANGUNAN SARANA DAN PRASARANA
            ['sub_rincian_objek_id' => $subRincianTanahGudang->id, 'kode' => '1.3.1.01.02.001.001', 'nama_barang' => 'TANAH GUDANG LOGISTIK DAERAH'],
            ['sub_rincian_objek_id' => $subRincianTanahBengkel->id, 'kode' => '1.3.1.01.02.002.001', 'nama_barang' => 'TANAH BENGKEL KENDARAAN DINAS'],
            ['sub_rincian_objek_id' => $subRincianTanahInstalasiListrik->id, 'kode' => '1.3.1.01.02.003.001', 'nama_barang' => 'TANAH GARDU INDUK LISTRIK'],

            // TANAH UNTUK JALAN DAN JEMBATAN
            ['sub_rincian_objek_id' => $subRincianTanahJalanNasional->id, 'kode' => '1.3.1.01.03.001.001', 'nama_barang' => 'TANAH JALAN NASIONAL KM 1-2'],
            ['sub_rincian_objek_id' => $subRincianTanahJalanProvinsi->id, 'kode' => '1.3.1.01.03.002.001', 'nama_barang' => 'TANAH JALAN PROVINSI SEGMENT A'],
            ['sub_rincian_objek_id' => $subRincianTanahJalanKabupaten->id, 'kode' => '1.3.1.01.03.003.001', 'nama_barang' => 'TANAH JALAN KABUPATEN UTAMA'],
            ['sub_rincian_objek_id' => $subRincianTanahJembatan->id, 'kode' => '1.3.1.01.03.004.001', 'nama_barang' => 'TANAH JEMBATAN SUNGAI BESAR'],

            // TANAH UNTUK TAMAN DAN LAPANGAN
            ['sub_rincian_objek_id' => $subRincianTanahTamanKota->id, 'kode' => '1.3.1.01.04.001.001', 'nama_barang' => 'TANAH TAMAN KOTA PUSAT'],
            ['sub_rincian_objek_id' => $subRincianTanahLapanganOlahraga->id, 'kode' => '1.3.1.01.04.002.001', 'nama_barang' => 'TANAH STADION KABUPATEN'],
            ['sub_rincian_objek_id' => $subRincianTanahRuangTerbukaHijau->id, 'kode' => '1.3.1.01.04.003.001', 'nama_barang' => 'TANAH RTH KAWASAN PERKANTORAN'],

            // TANAH UNTUK LAHAN PARKIR
            ['sub_rincian_objek_id' => $subRincianTanahParkirDinas->id, 'kode' => '1.3.1.01.05.001.001', 'nama_barang' => 'TANAH PARKIR KANTOR BUPATI'],
            ['sub_rincian_objek_id' => $subRincianTanahParkirUmum->id, 'kode' => '1.3.1.01.05.002.001', 'nama_barang' => 'TANAH PARKIR PASAR TRADISIONAL'],

            // TRAKTOR
            ['sub_rincian_objek_id' => $subRincianTraktorRodaEmpat->id, 'kode' => '1.3.2.01.01.001.001', 'nama_barang' => 'TRAKTOR RODA EMPAT KUBOTA'],
            ['sub_rincian_objek_id' => $subRincianTraktorRodaRantai->id, 'kode' => '1.3.2.01.01.002.001', 'nama_barang' => 'TRAKTOR RODA RANTAI CATERPILLAR'],
            ['sub_rincian_objek_id' => $subRincianTraktorMini->id, 'kode' => '1.3.2.01.01.003.001', 'nama_barang' => 'TRAKTOR MINI QUICK'],

            // EXCAVATOR
            ['sub_rincian_objek_id' => $subRincianExcavatorRodaRantai->id, 'kode' => '1.3.2.01.02.001.001', 'nama_barang' => 'EXCAVATOR PC200 KOMATSU'],
            ['sub_rincian_objek_id' => $subRincianExcavatorRodaKaret->id, 'kode' => '1.3.2.01.02.002.001', 'nama_barang' => 'EXCAVATOR RODA KARET HITACHI'],
            ['sub_rincian_objek_id' => $subRincianMiniExcavator->id, 'kode' => '1.3.2.01.02.003.001', 'nama_barang' => 'MINI EXCAVATOR PC30'],

            // BULLDOZER
            ['sub_rincian_objek_id' => $subRincianBulldozerSedang->id, 'kode' => '1.3.2.01.03.001.001', 'nama_barang' => 'BULLDOZER D6 CATERPILLAR'],
            ['sub_rincian_objek_id' => $subRincianBulldozerBesar->id, 'kode' => '1.3.2.01.03.002.001', 'nama_barang' => 'BULLDOZER D8 CATERPILLAR'],

            // LOADER
            ['sub_rincian_objek_id' => $subRincianWheelLoader->id, 'kode' => '1.3.2.01.04.001.001', 'nama_barang' => 'WHEEL LOADER 966 CATERPILLAR'],
            ['sub_rincian_objek_id' => $subRincianTrackLoader->id, 'kode' => '1.3.2.01.04.002.001', 'nama_barang' => 'TRACK LOADER 963 CATERPILLAR'],
            ['sub_rincian_objek_id' => $subRincianSkidSteerLoader->id, 'kode' => '1.3.2.01.04.003.001', 'nama_barang' => 'SKID STEER LOADER BOBCAT'],

            // GRADER
            ['sub_rincian_objek_id' => $subRincianMotorGrader->id, 'kode' => '1.3.2.01.05.001.001', 'nama_barang' => 'MOTOR GRADER 120H CATERPILLAR'],
            ['sub_rincian_objek_id' => $subRincianGraderBlade->id, 'kode' => '1.3.2.01.05.002.001', 'nama_barang' => 'GRADER BLADE ATTACHMENT'],

            // CRANE
            ['sub_rincian_objek_id' => $subRincianMobileCrane->id, 'kode' => '1.3.2.01.06.001.001', 'nama_barang' => 'MOBILE CRANE 25 TON TADANO'],
            ['sub_rincian_objek_id' => $subRincianTowerCrane->id, 'kode' => '1.3.2.01.06.002.001', 'nama_barang' => 'TOWER CRANE LIEBHERR'],
            ['sub_rincian_objek_id' => $subRincianTruckCrane->id, 'kode' => '1.3.2.01.06.003.001', 'nama_barang' => 'TRUCK CRANE KATO 15 TON'],

            // KENDARAAN DINAS
            ['sub_rincian_objek_id' => $subRincianSedan->id, 'kode' => '1.3.2.02.01.001.001', 'nama_barang' => 'SEDAN TOYOTA CAMRY'],
            ['sub_rincian_objek_id' => $subRincianStationWagon->id, 'kode' => '1.3.2.02.01.002.001', 'nama_barang' => 'STATION WAGON TOYOTA AVANZA'],
            ['sub_rincian_objek_id' => $subRincianJeep->id, 'kode' => '1.3.2.02.01.003.001', 'nama_barang' => 'JEEP TOYOTA FORTUNER'],
            ['sub_rincian_objek_id' => $subRincianMiniBus->id, 'kode' => '1.3.2.02.01.004.001', 'nama_barang' => 'MINI BUS ISUZU ELF'],

            // KENDARAAN OPERASIONAL
            ['sub_rincian_objek_id' => $subRincianPickUp->id, 'kode' => '1.3.2.02.02.001.001', 'nama_barang' => 'PICK UP TOYOTA HILUX'],
            ['sub_rincian_objek_id' => $subRincianTruck->id, 'kode' => '1.3.2.02.02.002.001', 'nama_barang' => 'TRUCK HINO DUTRO'],
            ['sub_rincian_objek_id' => $subRincianBus->id, 'kode' => '1.3.2.02.02.003.001', 'nama_barang' => 'BUS MERCEDES BENZ OH1526'],
            ['sub_rincian_objek_id' => $subRincianSepedaMotor->id, 'kode' => '1.3.2.02.02.004.001', 'nama_barang' => 'SEPEDA MOTOR HONDA BEAT'],

            // ANGKUTAN DARAT BERMOTOR
            ['sub_rincian_objek_id' => $subRincianMobilPenumpang->id, 'kode' => '1.3.2.02.03.001.001', 'nama_barang' => 'MOBIL PENUMPANG HONDA CIVIC'],
            ['sub_rincian_objek_id' => $subRincianMobilBarang->id, 'kode' => '1.3.2.02.03.002.001', 'nama_barang' => 'MOBIL BARANG MITSUBISHI COLT'],
            ['sub_rincian_objek_id' => $subRincianMobilKhusus->id, 'kode' => '1.3.2.02.03.003.001', 'nama_barang' => 'MOBIL AMBULANCE TOYOTA HIACE'],

            // ANGKUTAN DARAT TAK BERMOTOR
            ['sub_rincian_objek_id' => $subRincianSepeda->id, 'kode' => '1.3.2.02.04.001.001', 'nama_barang' => 'SEPEDA POLYGON'],
            ['sub_rincian_objek_id' => $subRincianGerobak->id, 'kode' => '1.3.2.02.04.002.001', 'nama_barang' => 'GEROBAK SAMPAH KAPASITAS 1 M3'],
            ['sub_rincian_objek_id' => $subRincianKeretaDorong->id, 'kode' => '1.3.2.02.04.003.001', 'nama_barang' => 'KERETA DORONG BARANG'],

            // ANGKUTAN AIR BERMOTOR
            ['sub_rincian_objek_id' => $subRincianKapalMotor->id, 'kode' => '1.3.2.02.05.001.001', 'nama_barang' => 'KAPAL MOTOR PENUMPANG 50 SEAT'],
            ['sub_rincian_objek_id' => $subRincianSpeedBoat->id, 'kode' => '1.3.2.02.05.002.001', 'nama_barang' => 'SPEED BOAT YAMAHA 40 HP'],
            ['sub_rincian_objek_id' => $subRincianPerahuMotor->id, 'kode' => '1.3.2.02.05.003.001', 'nama_barang' => 'PERAHU MOTOR NELAYAN 15 HP'],

            // ANGKUTAN AIR TAK BERMOTOR
            ['sub_rincian_objek_id' => $subRincianPerahuDayung->id, 'kode' => '1.3.2.02.06.001.001', 'nama_barang' => 'PERAHU DAYUNG KAYU KAPASITAS 6 ORANG'],
            ['sub_rincian_objek_id' => $subRincianRakit->id, 'kode' => '1.3.2.02.06.002.001', 'nama_barang' => 'RAKIT BAMBU TRANSPORTASI'],
            ['sub_rincian_objek_id' => $subRincianSampan->id, 'kode' => '1.3.2.02.06.003.001', 'nama_barang' => 'SAMPAN TRADISIONAL KAYU'],
        ];

        foreach ($subSubRincianObjeks as $subSubRincianObjek) {
            SubSubRincianObjek::create($subSubRincianObjek);
        }
    }
}
