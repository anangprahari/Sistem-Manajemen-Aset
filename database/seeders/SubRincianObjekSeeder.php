<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubRincianObjek;
use App\Models\RincianObjek;

class SubRincianObjekSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil rincian objek yang ada berdasarkan kode
        // 1.3.1.01 - TANAH
        $rincianTanahUntukBangunanGedung = RincianObjek::where('kode', '1.3.1.01.01')->first();
        $rincianTanahUntukBangunanSaranaDanPrasarana = RincianObjek::where('kode', '1.3.1.01.02')->first();
        $rincianTanahUntukJalanDanJembatan = RincianObjek::where('kode', '1.3.1.01.03')->first();
        $rincianTanahUntukTamanDanLapangan = RincianObjek::where('kode', '1.3.1.01.04')->first();
        $rincianTanahUntukLahanParkir = RincianObjek::where('kode', '1.3.1.01.05')->first();

        // 1.3.2.01 - ALAT BERAT
        $rincianTraktor = RincianObjek::where('kode', '1.3.2.01.01')->first();
        $rincianExcavator = RincianObjek::where('kode', '1.3.2.01.02')->first();
        $rincianBulldozer = RincianObjek::where('kode', '1.3.2.01.03')->first();
        $rincianLoader = RincianObjek::where('kode', '1.3.2.01.04')->first();
        $rincianGrader = RincianObjek::where('kode', '1.3.2.01.05')->first();
        $rincianCrane = RincianObjek::where('kode', '1.3.2.01.06')->first();

        // 1.3.2.02 - ALAT ANGKUTAN
        $rincianKendaraanDinas = RincianObjek::where('kode', '1.3.2.02.01')->first();
        $rincianKendaraanOperasional = RincianObjek::where('kode', '1.3.2.02.02')->first();
        $rincianAngkutanDaratBermotor = RincianObjek::where('kode', '1.3.2.02.03')->first();
        $rincianAngkutanDaratTakBermotor = RincianObjek::where('kode', '1.3.2.02.04')->first();
        $rincianAngkutanAirBermotor = RincianObjek::where('kode', '1.3.2.02.05')->first();
        $rincianAngkutanAirTakBermotor = RincianObjek::where('kode', '1.3.2.02.06')->first();
        $rincianAngkutanUdara = RincianObjek::where('kode', '1.3.2.02.07')->first();

        // 1.3.2.03 - ALAT BENGKEL DAN ALAT UKUR
        $rincianAlatBengkelBermesin = RincianObjek::where('kode', '1.3.2.03.01')->first();
        $rincianAlatBengkelTidakBermesin = RincianObjek::where('kode', '1.3.2.03.02')->first();
        $rincianAlatUkur = RincianObjek::where('kode', '1.3.2.03.03')->first();
        $rincianAlatSurveiDanPemetaan = RincianObjek::where('kode', '1.3.2.03.04')->first();

        // 1.3.2.05 - ALAT KANTOR DAN RUMAH TANGGA
        $rincianAlatKantor = RincianObjek::where('kode', '1.3.2.05.01')->first();
        $rincianAlatRumahTangga = RincianObjek::where('kode', '1.3.2.05.02')->first();
        $rincianMeubelair = RincianObjek::where('kode', '1.3.2.05.03')->first();
        $rincianAlatPendingin = RincianObjek::where('kode', '1.3.2.05.04')->first();

        // 1.3.2.06 - ALAT STUDIO, KOMUNIKASI DAN PEMANCAR
        $rincianAlatStudio = RincianObjek::where('kode', '1.3.2.06.01')->first();
        $rincianAlatKomunikasi = RincianObjek::where('kode', '1.3.2.06.02')->first();
        $rincianAlatPemancar = RincianObjek::where('kode', '1.3.2.06.03')->first();
        $rincianAlatNavigasi = RincianObjek::where('kode', '1.3.2.06.04')->first();

        // 1.3.2.07 - ALAT KEDOKTERAN DAN KESEHATAN
        $rincianAlatKedokteran = RincianObjek::where('kode', '1.3.2.07.01')->first();
        $rincianAlatKesehatan = RincianObjek::where('kode', '1.3.2.07.02')->first();
        $rincianAlatKedokteranGigi = RincianObjek::where('kode', '1.3.2.07.03')->first();
        $rincianAlatVeteriner = RincianObjek::where('kode', '1.3.2.07.04')->first();

        // 1.3.2.10 - KOMPUTER
        $rincianPerangkatKerasKomputer = RincianObjek::where('kode', '1.3.2.10.01')->first();
        $rincianPerangkatLunakKomputer = RincianObjek::where('kode', '1.3.2.10.02')->first();

        // 1.3.3.01 - BANGUNAN GEDUNG
        $rincianBangunanGedungTempatKerja = RincianObjek::where('kode', '1.3.3.01.01')->first();
        $rincianBangunanGedungTempatTinggal = RincianObjek::where('kode', '1.3.3.01.02')->first();
        $rincianBangunanGedungTempatUsaha = RincianObjek::where('kode', '1.3.3.01.03')->first();
        $rincianBangunanGedungSosialDanBudaya = RincianObjek::where('kode', '1.3.3.01.04')->first();
        $rincianBangunanGedungKhusus = RincianObjek::where('kode', '1.3.3.01.05')->first();

        // 1.3.4.01 - JALAN DAN JEMBATAN
        $rincianJalan = RincianObjek::where('kode', '1.3.4.01.01')->first();
        $rincianJembatan = RincianObjek::where('kode', '1.3.4.01.02')->first();

        // 1.3.4.02 - BANGUNAN AIR
        $rincianBangunanPengairan = RincianObjek::where('kode', '1.3.4.02.01')->first();
        $rincianBangunanPengamananPantaiDanSungai = RincianObjek::where('kode', '1.3.4.02.02')->first();

        // 1.3.4.03 - INSTALASI
        $rincianInstalasiAirBersih = RincianObjek::where('kode', '1.3.4.03.01')->first();
        $rincianInstalasiPengolahanKotoran = RincianObjek::where('kode', '1.3.4.03.02')->first();
        $rincianInstalasiPembangkitListrik = RincianObjek::where('kode', '1.3.4.03.03')->first();
        $rincianInstalasiGarduListrik = RincianObjek::where('kode', '1.3.4.03.04')->first();

        // 1.3.4.04 - JARINGAN
        $rincianJaringanAirMinum = RincianObjek::where('kode', '1.3.4.04.01')->first();
        $rincianJaringanListrik = RincianObjek::where('kode', '1.3.4.04.02')->first();
        $rincianJaringanTeleponDanTelegraph = RincianObjek::where('kode', '1.3.4.04.03')->first();
        $rincianJaringanGas = RincianObjek::where('kode', '1.3.4.04.04')->first();

        $subRincianObjeks = [
            // 1.3.1.01.01 - TANAH UNTUK BANGUNAN GEDUNG
            ['rincian_objek_id' => $rincianTanahUntukBangunanGedung->id, 'kode' => '1.3.1.01.01.001', 'nama' => 'TANAH UNTUK GEDUNG KANTOR PEMERINTAH'],
            ['rincian_objek_id' => $rincianTanahUntukBangunanGedung->id, 'kode' => '1.3.1.01.01.002', 'nama' => 'TANAH UNTUK GEDUNG SEKOLAH'],
            ['rincian_objek_id' => $rincianTanahUntukBangunanGedung->id, 'kode' => '1.3.1.01.01.003', 'nama' => 'TANAH UNTUK GEDUNG RUMAH SAKIT'],
            ['rincian_objek_id' => $rincianTanahUntukBangunanGedung->id, 'kode' => '1.3.1.01.01.004', 'nama' => 'TANAH UNTUK GEDUNG PUSKESMAS'],

            // 1.3.1.01.02 - TANAH UNTUK BANGUNAN SARANA DAN PRASARANA
            ['rincian_objek_id' => $rincianTanahUntukBangunanSaranaDanPrasarana->id, 'kode' => '1.3.1.01.02.001', 'nama' => 'TANAH UNTUK GUDANG'],
            ['rincian_objek_id' => $rincianTanahUntukBangunanSaranaDanPrasarana->id, 'kode' => '1.3.1.01.02.002', 'nama' => 'TANAH UNTUK BENGKEL'],
            ['rincian_objek_id' => $rincianTanahUntukBangunanSaranaDanPrasarana->id, 'kode' => '1.3.1.01.02.003', 'nama' => 'TANAH UNTUK INSTALASI LISTRIK'],

            // 1.3.1.01.03 - TANAH UNTUK JALAN DAN JEMBATAN
            ['rincian_objek_id' => $rincianTanahUntukJalanDanJembatan->id, 'kode' => '1.3.1.01.03.001', 'nama' => 'TANAH UNTUK JALAN NASIONAL'],
            ['rincian_objek_id' => $rincianTanahUntukJalanDanJembatan->id, 'kode' => '1.3.1.01.03.002', 'nama' => 'TANAH UNTUK JALAN PROVINSI'],
            ['rincian_objek_id' => $rincianTanahUntukJalanDanJembatan->id, 'kode' => '1.3.1.01.03.003', 'nama' => 'TANAH UNTUK JALAN KABUPATEN/KOTA'],
            ['rincian_objek_id' => $rincianTanahUntukJalanDanJembatan->id, 'kode' => '1.3.1.01.03.004', 'nama' => 'TANAH UNTUK JEMBATAN'],

            // 1.3.1.01.04 - TANAH UNTUK TAMAN DAN LAPANGAN
            ['rincian_objek_id' => $rincianTanahUntukTamanDanLapangan->id, 'kode' => '1.3.1.01.04.001', 'nama' => 'TANAH UNTUK TAMAN KOTA'],
            ['rincian_objek_id' => $rincianTanahUntukTamanDanLapangan->id, 'kode' => '1.3.1.01.04.002', 'nama' => 'TANAH UNTUK LAPANGAN OLAHRAGA'],
            ['rincian_objek_id' => $rincianTanahUntukTamanDanLapangan->id, 'kode' => '1.3.1.01.04.003', 'nama' => 'TANAH UNTUK RUANG TERBUKA HIJAU'],

            // 1.3.1.01.05 - TANAH UNTUK LAHAN PARKIR
            ['rincian_objek_id' => $rincianTanahUntukLahanParkir->id, 'kode' => '1.3.1.01.05.001', 'nama' => 'TANAH UNTUK PARKIR KENDARAAN DINAS'],
            ['rincian_objek_id' => $rincianTanahUntukLahanParkir->id, 'kode' => '1.3.1.01.05.002', 'nama' => 'TANAH UNTUK PARKIR UMUM'],

            // 1.3.2.01.01 - TRAKTOR
            ['rincian_objek_id' => $rincianTraktor->id, 'kode' => '1.3.2.01.01.001', 'nama' => 'TRAKTOR RODA EMPAT'],
            ['rincian_objek_id' => $rincianTraktor->id, 'kode' => '1.3.2.01.01.002', 'nama' => 'TRAKTOR RODA RANTAI'],
            ['rincian_objek_id' => $rincianTraktor->id, 'kode' => '1.3.2.01.01.003', 'nama' => 'TRAKTOR MINI'],

            // 1.3.2.01.02 - EXCAVATOR
            ['rincian_objek_id' => $rincianExcavator->id, 'kode' => '1.3.2.01.02.001', 'nama' => 'EXCAVATOR RODA RANTAI'],
            ['rincian_objek_id' => $rincianExcavator->id, 'kode' => '1.3.2.01.02.002', 'nama' => 'EXCAVATOR RODA KARET'],
            ['rincian_objek_id' => $rincianExcavator->id, 'kode' => '1.3.2.01.02.003', 'nama' => 'MINI EXCAVATOR'],

            // 1.3.2.01.03 - BULLDOZER
            ['rincian_objek_id' => $rincianBulldozer->id, 'kode' => '1.3.2.01.03.001', 'nama' => 'BULLDOZER SEDANG'],
            ['rincian_objek_id' => $rincianBulldozer->id, 'kode' => '1.3.2.01.03.002', 'nama' => 'BULLDOZER BESAR'],

            // 1.3.2.01.04 - LOADER
            ['rincian_objek_id' => $rincianLoader->id, 'kode' => '1.3.2.01.04.001', 'nama' => 'WHEEL LOADER'],
            ['rincian_objek_id' => $rincianLoader->id, 'kode' => '1.3.2.01.04.002', 'nama' => 'TRACK LOADER'],
            ['rincian_objek_id' => $rincianLoader->id, 'kode' => '1.3.2.01.04.003', 'nama' => 'SKID STEER LOADER'],

            // 1.3.2.01.05 - GRADER
            ['rincian_objek_id' => $rincianGrader->id, 'kode' => '1.3.2.01.05.001', 'nama' => 'MOTOR GRADER'],
            ['rincian_objek_id' => $rincianGrader->id, 'kode' => '1.3.2.01.05.002', 'nama' => 'GRADER BLADE'],

            // 1.3.2.01.06 - CRANE
            ['rincian_objek_id' => $rincianCrane->id, 'kode' => '1.3.2.01.06.001', 'nama' => 'MOBILE CRANE'],
            ['rincian_objek_id' => $rincianCrane->id, 'kode' => '1.3.2.01.06.002', 'nama' => 'TOWER CRANE'],
            ['rincian_objek_id' => $rincianCrane->id, 'kode' => '1.3.2.01.06.003', 'nama' => 'TRUCK CRANE'],

            // 1.3.2.02.01 - KENDARAAN DINAS
            ['rincian_objek_id' => $rincianKendaraanDinas->id, 'kode' => '1.3.2.02.01.001', 'nama' => 'SEDAN'],
            ['rincian_objek_id' => $rincianKendaraanDinas->id, 'kode' => '1.3.2.02.01.002', 'nama' => 'STATION WAGON'],
            ['rincian_objek_id' => $rincianKendaraanDinas->id, 'kode' => '1.3.2.02.01.003', 'nama' => 'JEEP'],
            ['rincian_objek_id' => $rincianKendaraanDinas->id, 'kode' => '1.3.2.02.01.004', 'nama' => 'MINI BUS'],

            // 1.3.2.02.02 - KENDARAAN OPERASIONAL
            ['rincian_objek_id' => $rincianKendaraanOperasional->id, 'kode' => '1.3.2.02.02.001', 'nama' => 'PICK UP'],
            ['rincian_objek_id' => $rincianKendaraanOperasional->id, 'kode' => '1.3.2.02.02.002', 'nama' => 'TRUCK'],
            ['rincian_objek_id' => $rincianKendaraanOperasional->id, 'kode' => '1.3.2.02.02.003', 'nama' => 'BUS'],
            ['rincian_objek_id' => $rincianKendaraanOperasional->id, 'kode' => '1.3.2.02.02.004', 'nama' => 'SEPEDA MOTOR'],

            // 1.3.2.02.03 - ANGKUTAN DARAT BERMOTOR
            ['rincian_objek_id' => $rincianAngkutanDaratBermotor->id, 'kode' => '1.3.2.02.03.001', 'nama' => 'MOBIL PENUMPANG'],
            ['rincian_objek_id' => $rincianAngkutanDaratBermotor->id, 'kode' => '1.3.2.02.03.002', 'nama' => 'MOBIL BARANG'],
            ['rincian_objek_id' => $rincianAngkutanDaratBermotor->id, 'kode' => '1.3.2.02.03.003', 'nama' => 'MOBIL KHUSUS'],

            // 1.3.2.02.04 - ANGKUTAN DARAT TAK BERMOTOR
            ['rincian_objek_id' => $rincianAngkutanDaratTakBermotor->id, 'kode' => '1.3.2.02.04.001', 'nama' => 'SEPEDA'],
            ['rincian_objek_id' => $rincianAngkutanDaratTakBermotor->id, 'kode' => '1.3.2.02.04.002', 'nama' => 'GEROBAK'],
            ['rincian_objek_id' => $rincianAngkutanDaratTakBermotor->id, 'kode' => '1.3.2.02.04.003', 'nama' => 'KERETA DORONG'],

            // 1.3.2.02.05 - ANGKUTAN AIR BERMOTOR
            ['rincian_objek_id' => $rincianAngkutanAirBermotor->id, 'kode' => '1.3.2.02.05.001', 'nama' => 'KAPAL MOTOR'],
            ['rincian_objek_id' => $rincianAngkutanAirBermotor->id, 'kode' => '1.3.2.02.05.002', 'nama' => 'SPEED BOAT'],
            ['rincian_objek_id' => $rincianAngkutanAirBermotor->id, 'kode' => '1.3.2.02.05.003', 'nama' => 'PERAHU MOTOR'],

            // 1.3.2.02.06 - ANGKUTAN AIR TAK BERMOTOR
            ['rincian_objek_id' => $rincianAngkutanAirTakBermotor->id, 'kode' => '1.3.2.02.06.001', 'nama' => 'PERAHU DAYUNG'],
            ['rincian_objek_id' => $rincianAngkutanAirTakBermotor->id, 'kode' => '1.3.2.02.06.002', 'nama' => 'RAKIT'],
            ['rincian_objek_id' => $rincianAngkutanAirTakBermotor->id, 'kode' => '1.3.2.02.06.003', 'nama' => 'SAMPAN'],

            // 1.3.2.02.07 - ANGKUTAN UDARA
            ['rincian_objek_id' => $rincianAngkutanUdara->id, 'kode' => '1.3.2.02.07.001', 'nama' => 'PESAWAT TERBANG'],
            ['rincian_objek_id' => $rincianAngkutanUdara->id, 'kode' => '1.3.2.02.07.002', 'nama' => 'HELICOPTER'],
            ['rincian_objek_id' => $rincianAngkutanUdara->id, 'kode' => '1.3.2.02.07.003', 'nama' => 'PESAWAT TANPA AWAK (DRONE)'],

            // 1.3.2.03.01 - ALAT BENGKEL BERMESIN
            ['rincian_objek_id' => $rincianAlatBengkelBermesin->id, 'kode' => '1.3.2.03.01.001', 'nama' => 'MESIN BUBUT'],
            ['rincian_objek_id' => $rincianAlatBengkelBermesin->id, 'kode' => '1.3.2.03.01.002', 'nama' => 'MESIN FRAIS'],
            ['rincian_objek_id' => $rincianAlatBengkelBermesin->id, 'kode' => '1.3.2.03.01.003', 'nama' => 'MESIN GERINDA'],
            ['rincian_objek_id' => $rincianAlatBengkelBermesin->id, 'kode' => '1.3.2.03.01.004', 'nama' => 'MESIN LAS'],

            // 1.3.2.03.02 - ALAT BENGKEL TIDAK BERMESIN
            ['rincian_objek_id' => $rincianAlatBengkelTidakBermesin->id, 'kode' => '1.3.2.03.02.001', 'nama' => 'TANG'],
            ['rincian_objek_id' => $rincianAlatBengkelTidakBermesin->id, 'kode' => '1.3.2.03.02.002', 'nama' => 'OBENG'],
            ['rincian_objek_id' => $rincianAlatBengkelTidakBermesin->id, 'kode' => '1.3.2.03.02.003', 'nama' => 'KUNCI PAS'],
            ['rincian_objek_id' => $rincianAlatBengkelTidakBermesin->id, 'kode' => '1.3.2.03.02.004', 'nama' => 'PALU'],

            // 1.3.2.03.03 - ALAT UKUR
            ['rincian_objek_id' => $rincianAlatUkur->id, 'kode' => '1.3.2.03.03.001', 'nama' => 'METERAN'],
            ['rincian_objek_id' => $rincianAlatUkur->id, 'kode' => '1.3.2.03.03.002', 'nama' => 'JANGKA SORONG'],
            ['rincian_objek_id' => $rincianAlatUkur->id, 'kode' => '1.3.2.03.03.003', 'nama' => 'MIKROMETER'],
            ['rincian_objek_id' => $rincianAlatUkur->id, 'kode' => '1.3.2.03.03.004', 'nama' => 'WATERPASS'],

            // 1.3.2.03.04 - ALAT SURVEI DAN PEMETAAN
            ['rincian_objek_id' => $rincianAlatSurveiDanPemetaan->id, 'kode' => '1.3.2.03.04.001', 'nama' => 'THEODOLITE'],
            ['rincian_objek_id' => $rincianAlatSurveiDanPemetaan->id, 'kode' => '1.3.2.03.04.002', 'nama' => 'TOTAL STATION'],
            ['rincian_objek_id' => $rincianAlatSurveiDanPemetaan->id, 'kode' => '1.3.2.03.04.003', 'nama' => 'GPS'],
            ['rincian_objek_id' => $rincianAlatSurveiDanPemetaan->id, 'kode' => '1.3.2.03.04.004', 'nama' => 'RAMBU UKUR'],

            // 1.3.2.05.01 - ALAT KANTOR
            ['rincian_objek_id' => $rincianAlatKantor->id, 'kode' => '1.3.2.05.01.001', 'nama' => 'MESIN KETIK'],
            ['rincian_objek_id' => $rincianAlatKantor->id, 'kode' => '1.3.2.05.01.002', 'nama' => 'MESIN HITUNG'],
            ['rincian_objek_id' => $rincianAlatKantor->id, 'kode' => '1.3.2.05.01.003', 'nama' => 'MESIN FOTOKOPI'],
            ['rincian_objek_id' => $rincianAlatKantor->id, 'kode' => '1.3.2.05.01.004', 'nama' => 'PRINTER'],
            ['rincian_objek_id' => $rincianAlatKantor->id, 'kode' => '1.3.2.05.01.005', 'nama' => 'SCANNER'],
            ['rincian_objek_id' => $rincianAlatKantor->id, 'kode' => '1.3.2.05.01.006', 'nama' => 'FAXIMILE'],

            // 1.3.2.05.02 - ALAT RUMAH TANGGA
            ['rincian_objek_id' => $rincianAlatRumahTangga->id, 'kode' => '1.3.2.05.02.001', 'nama' => 'KOMPOR'],
            ['rincian_objek_id' => $rincianAlatRumahTangga->id, 'kode' => '1.3.2.05.02.002', 'nama' => 'RICE COOKER'],
            ['rincian_objek_id' => $rincianAlatRumahTangga->id, 'kode' => '1.3.2.05.02.003', 'nama' => 'DISPENSER'],
            ['rincian_objek_id' => $rincianAlatRumahTangga->id, 'kode' => '1.3.2.05.02.004', 'nama' => 'MESIN CUCI'],
            ['rincian_objek_id' => $rincianAlatRumahTangga->id, 'kode' => '1.3.2.05.02.005', 'nama' => 'VACUUM CLEANER'],
            ['rincian_objek_id' => $rincianAlatRumahTangga->id, 'kode' => '1.3.2.05.02.006', 'nama' => 'MICROWAVE'],

            // 1.3.2.05.03 - MEUBELAIR
            ['rincian_objek_id' => $rincianMeubelair->id, 'kode' => '1.3.2.05.03.001', 'nama' => 'MEJA KERJA'],
            ['rincian_objek_id' => $rincianMeubelair->id, 'kode' => '1.3.2.05.03.002', 'nama' => 'KURSI KERJA'],
            ['rincian_objek_id' => $rincianMeubelair->id, 'kode' => '1.3.2.05.03.003', 'nama' => 'LEMARI ARSIP'],
            ['rincian_objek_id' => $rincianMeubelair->id, 'kode' => '1.3.2.05.03.004', 'nama' => 'RAK BUKU'],
            ['rincian_objek_id' => $rincianMeubelair->id, 'kode' => '1.3.2.05.03.005', 'nama' => 'SOFA'],
            ['rincian_objek_id' => $rincianMeubelair->id, 'kode' => '1.3.2.05.03.006', 'nama' => 'TEMPAT TIDUR'],

            // 1.3.2.05.04 - ALAT PENDINGIN
            ['rincian_objek_id' => $rincianAlatPendingin->id, 'kode' => '1.3.2.05.04.001', 'nama' => 'AIR CONDITIONER (AC)'],
            ['rincian_objek_id' => $rincianAlatPendingin->id, 'kode' => '1.3.2.05.04.002', 'nama' => 'KIPAS ANGIN'],
            ['rincian_objek_id' => $rincianAlatPendingin->id, 'kode' => '1.3.2.05.04.003', 'nama' => 'KULKAS'],
            ['rincian_objek_id' => $rincianAlatPendingin->id, 'kode' => '1.3.2.05.04.004', 'nama' => 'FREEZER'],

            // 1.3.2.06.01 - ALAT STUDIO
            ['rincian_objek_id' => $rincianAlatStudio->id, 'kode' => '1.3.2.06.01.001', 'nama' => 'KAMERA FOTO'],
            ['rincian_objek_id' => $rincianAlatStudio->id, 'kode' => '1.3.2.06.01.002', 'nama' => 'KAMERA VIDEO'],
            ['rincian_objek_id' => $rincianAlatStudio->id, 'kode' => '1.3.2.06.01.003', 'nama' => 'LIGHTING EQUIPMENT'],
            ['rincian_objek_id' => $rincianAlatStudio->id, 'kode' => '1.3.2.06.01.004', 'nama' => 'TRIPOD'],
            ['rincian_objek_id' => $rincianAlatStudio->id, 'kode' => '1.3.2.06.01.005', 'nama' => 'MICROPHONE'],

            // 1.3.2.06.02 - ALAT KOMUNIKASI
            ['rincian_objek_id' => $rincianAlatKomunikasi->id, 'kode' => '1.3.2.06.02.001', 'nama' => 'TELEPON'],
            ['rincian_objek_id' => $rincianAlatKomunikasi->id, 'kode' => '1.3.2.06.02.002', 'nama' => 'HANDPHONE'],
            ['rincian_objek_id' => $rincianAlatKomunikasi->id, 'kode' => '1.3.2.06.02.003', 'nama' => 'RADIO KOMUNIKASI'],
            ['rincian_objek_id' => $rincianAlatKomunikasi->id, 'kode' => '1.3.2.06.02.004', 'nama' => 'WALKIE TALKIE'],
            ['rincian_objek_id' => $rincianAlatKomunikasi->id, 'kode' => '1.3.2.06.02.005', 'nama' => 'INTERCOM'],

            // 1.3.2.06.03 - ALAT PEMANCAR
            ['rincian_objek_id' => $rincianAlatPemancar->id, 'kode' => '1.3.2.06.03.001', 'nama' => 'PEMANCAR RADIO'],
            ['rincian_objek_id' => $rincianAlatPemancar->id, 'kode' => '1.3.2.06.03.002', 'nama' => 'PEMANCAR TV'],
            ['rincian_objek_id' => $rincianAlatPemancar->id, 'kode' => '1.3.2.06.03.003', 'nama' => 'REPEATER'],
            ['rincian_objek_id' => $rincianAlatPemancar->id, 'kode' => '1.3.2.06.03.004', 'nama' => 'ANTENA'],

            // 1.3.2.06.04 - ALAT NAVIGASI
            ['rincian_objek_id' => $rincianAlatNavigasi->id, 'kode' => '1.3.2.06.04.001', 'nama' => 'GPS NAVIGASI'],
            ['rincian_objek_id' => $rincianAlatNavigasi->id, 'kode' => '1.3.2.06.04.002', 'nama' => 'KOMPAS'],
            ['rincian_objek_id' => $rincianAlatNavigasi->id, 'kode' => '1.3.2.06.04.003', 'nama' => 'RADAR'],

            // 1.3.2.07.01 - ALAT KEDOKTERAN
            ['rincian_objek_id' => $rincianAlatKedokteran->id, 'kode' => '1.3.2.07.01.001', 'nama' => 'STETOSKOP'],
            ['rincian_objek_id' => $rincianAlatKedokteran->id, 'kode' => '1.3.2.07.01.002', 'nama' => 'TENSIMETER'],
            ['rincian_objek_id' => $rincianAlatKedokteran->id, 'kode' => '1.3.2.07.01.003', 'nama' => 'TERMOMETER'],
            ['rincian_objek_id' => $rincianAlatKedokteran->id, 'kode' => '1.3.2.07.01.004', 'nama' => 'ECG'],
            ['rincian_objek_id' => $rincianAlatKedokteran->id, 'kode' => '1.3.2.07.01.005', 'nama' => 'USG'],
            ['rincian_objek_id' => $rincianAlatKedokteran->id, 'kode' => '1.3.2.07.01.006', 'nama' => 'RONTGEN'],

            // 1.3.2.07.02 - ALAT KESEHATAN
            ['rincian_objek_id' => $rincianAlatKesehatan->id, 'kode' => '1.3.2.07.02.001', 'nama' => 'TIMBANGAN BADAN'],
            ['rincian_objek_id' => $rincianAlatKesehatan->id, 'kode' => '1.3.2.07.02.002', 'nama' => 'PENGUKUR TINGGI BADAN'],
            ['rincian_objek_id' => $rincianAlatKesehatan->id, 'kode' => '1.3.2.07.02.003', 'nama' => 'BRANKAR'],
            ['rincian_objek_id' => $rincianAlatKesehatan->id, 'kode' => '1.3.2.07.02.004', 'nama' => 'KURSI RODA'],
            ['rincian_objek_id' => $rincianAlatKesehatan->id, 'kode' => '1.3.2.07.02.005', 'nama' => 'TEMPAT TIDUR PASIEN'],

            // 1.3.2.07.03 - ALAT KEDOKTERAN GIGI
            ['rincian_objek_id' => $rincianAlatKedokteranGigi->id, 'kode' => '1.3.2.07.03.001', 'nama' => 'DENTAL UNIT'],
            ['rincian_objek_id' => $rincianAlatKedokteranGigi->id, 'kode' => '1.3.2.07.03.002', 'nama' => 'DENTAL HANDPIECE'],
            ['rincian_objek_id' => $rincianAlatKedokteranGigi->id, 'kode' => '1.3.2.07.03.003', 'nama' => 'DENTAL X-RAY'],
            ['rincian_objek_id' => $rincianAlatKedokteranGigi->id, 'kode' => '1.3.2.07.03.004', 'nama' => 'SCALER'],

            // 1.3.2.07.04 - ALAT VETERINER
            ['rincian_objek_id' => $rincianAlatVeteriner->id, 'kode' => '1.3.2.07.04.001', 'nama' => 'STETOSKOP VETERINER'],
            ['rincian_objek_id' => $rincianAlatVeteriner->id, 'kode' => '1.3.2.07.04.002', 'nama' => 'TERMOMETER VETERINER'],
            ['rincian_objek_id' => $rincianAlatVeteriner->id, 'kode' => '1.3.2.07.04.003', 'nama' => 'KANDANG PEMERIKSAAN'],
            ['rincian_objek_id' => $rincianAlatVeteriner->id, 'kode' => '1.3.2.07.04.004', 'nama' => 'ALAT SUNTIK HEWAN'],

            // 1.3.2.10.01 - PERANGKAT KERAS KOMPUTER
            ['rincian_objek_id' => $rincianPerangkatKerasKomputer->id, 'kode' => '1.3.2.10.01.001', 'nama' => 'PERSONAL COMPUTER (PC)'],
            ['rincian_objek_id' => $rincianPerangkatKerasKomputer->id, 'kode' => '1.3.2.10.01.002', 'nama' => 'LAPTOP'],
            ['rincian_objek_id' => $rincianPerangkatKerasKomputer->id, 'kode' => '1.3.2.10.01.003', 'nama' => 'SERVER'],
            ['rincian_objek_id' => $rincianPerangkatKerasKomputer->id, 'kode' => '1.3.2.10.01.004', 'nama' => 'MONITOR'],
            ['rincian_objek_id' => $rincianPerangkatKerasKomputer->id, 'kode' => '1.3.2.10.01.005', 'nama' => 'KEYBOARD'],
            ['rincian_objek_id' => $rincianPerangkatKerasKomputer->id, 'kode' => '1.3.2.10.01.006', 'nama' => 'MOUSE'],
            ['rincian_objek_id' => $rincianPerangkatKerasKomputer->id, 'kode' => '1.3.2.10.01.007', 'nama' => 'HARD DISK'],
            ['rincian_objek_id' => $rincianPerangkatKerasKomputer->id, 'kode' => '1.3.2.10.01.008', 'nama' => 'MEMORY (RAM)'],
            ['rincian_objek_id' => $rincianPerangkatKerasKomputer->id, 'kode' => '1.3.2.10.01.009', 'nama' => 'MOTHERBOARD'],
            ['rincian_objek_id' => $rincianPerangkatKerasKomputer->id, 'kode' => '1.3.2.10.01.010', 'nama' => 'PROCESSOR'],

            // 1.3.2.10.02 - PERANGKAT LUNAK KOMPUTER
            ['rincian_objek_id' => $rincianPerangkatLunakKomputer->id, 'kode' => '1.3.2.10.02.001', 'nama' => 'SISTEM OPERASI'],
            ['rincian_objek_id' => $rincianPerangkatLunakKomputer->id, 'kode' => '1.3.2.10.02.002', 'nama' => 'APLIKASI PERKANTORAN'],
            ['rincian_objek_id' => $rincianPerangkatLunakKomputer->id, 'kode' => '1.3.2.10.02.003', 'nama' => 'APLIKASI DATABASE'],
            ['rincian_objek_id' => $rincianPerangkatLunakKomputer->id, 'kode' => '1.3.2.10.02.004', 'nama' => 'APLIKASI ANTIVIRUS'],
            ['rincian_objek_id' => $rincianPerangkatLunakKomputer->id, 'kode' => '1.3.2.10.02.005', 'nama' => 'APLIKASI WEB BROWSER'],

            // 1.3.3.01.01 - BANGUNAN GEDUNG TEMPAT KERJA
            ['rincian_objek_id' => $rincianBangunanGedungTempatKerja->id, 'kode' => '1.3.3.01.01.001', 'nama' => 'GEDUNG KANTOR PEMERINTAHAN'],
            ['rincian_objek_id' => $rincianBangunanGedungTempatKerja->id, 'kode' => '1.3.3.01.01.002', 'nama' => 'GEDUNG KANTOR SWASTA'],
            ['rincian_objek_id' => $rincianBangunanGedungTempatKerja->id, 'kode' => '1.3.3.01.01.003', 'nama' => 'GEDUNG WORKSHOP'],
            ['rincian_objek_id' => $rincianBangunanGedungTempatKerja->id, 'kode' => '1.3.3.01.01.004', 'nama' => 'GEDUNG LABORATORIUM'],

            // 1.3.3.01.02 - BANGUNAN GEDUNG TEMPAT TINGGAL
            ['rincian_objek_id' => $rincianBangunanGedungTempatTinggal->id, 'kode' => '1.3.3.01.02.001', 'nama' => 'RUMAH DINAS'],
            ['rincian_objek_id' => $rincianBangunanGedungTempatTinggal->id, 'kode' => '1.3.3.01.02.002', 'nama' => 'ASRAMA'],
            ['rincian_objek_id' => $rincianBangunanGedungTempatTinggal->id, 'kode' => '1.3.3.01.02.003', 'nama' => 'MESS'],
            ['rincian_objek_id' => $rincianBangunanGedungTempatTinggal->id, 'kode' => '1.3.3.01.02.004', 'nama' => 'GUEST HOUSE'],

            // 1.3.3.01.03 - BANGUNAN GEDUNG TEMPAT USAHA
            ['rincian_objek_id' => $rincianBangunanGedungTempatUsaha->id, 'kode' => '1.3.3.01.03.001', 'nama' => 'GEDUNG TOKO'],
            ['rincian_objek_id' => $rincianBangunanGedungTempatUsaha->id, 'kode' => '1.3.3.01.03.002', 'nama' => 'GEDUNG RESTORAN'],
            ['rincian_objek_id' => $rincianBangunanGedungTempatUsaha->id, 'kode' => '1.3.3.01.03.003', 'nama' => 'GEDUNG HOTEL'],
            ['rincian_objek_id' => $rincianBangunanGedungTempatUsaha->id, 'kode' => '1.3.3.01.03.004', 'nama' => 'GEDUNG PABRIK'],

            // 1.3.3.01.04 - BANGUNAN GEDUNG SOSIAL DAN BUDAYA
            ['rincian_objek_id' => $rincianBangunanGedungSosialDanBudaya->id, 'kode' => '1.3.3.01.04.001', 'nama' => 'GEDUNG SEKOLAH'],
            ['rincian_objek_id' => $rincianBangunanGedungSosialDanBudaya->id, 'kode' => '1.3.3.01.04.002', 'nama' => 'GEDUNG RUMAH SAKIT'],
            ['rincian_objek_id' => $rincianBangunanGedungSosialDanBudaya->id, 'kode' => '1.3.3.01.04.003', 'nama' => 'GEDUNG PUSKESMAS'],
            ['rincian_objek_id' => $rincianBangunanGedungSosialDanBudaya->id, 'kode' => '1.3.3.01.04.004', 'nama' => 'GEDUNG PERPUSTAKAAN'],
            ['rincian_objek_id' => $rincianBangunanGedungSosialDanBudaya->id, 'kode' => '1.3.3.01.04.005', 'nama' => 'GEDUNG MUSEUM'],
            ['rincian_objek_id' => $rincianBangunanGedungSosialDanBudaya->id, 'kode' => '1.3.3.01.04.006', 'nama' => 'GEDUNG KESENIAN'],

            // 1.3.3.01.05 - BANGUNAN GEDUNG KHUSUS
            ['rincian_objek_id' => $rincianBangunanGedungKhusus->id, 'kode' => '1.3.3.01.05.001', 'nama' => 'GEDUNG TERMINAL'],
            ['rincian_objek_id' => $rincianBangunanGedungKhusus->id, 'kode' => '1.3.3.01.05.002', 'nama' => 'GEDUNG BANDARA'],
            ['rincian_objek_id' => $rincianBangunanGedungKhusus->id, 'kode' => '1.3.3.01.05.003', 'nama' => 'GEDUNG STASIUN'],
            ['rincian_objek_id' => $rincianBangunanGedungKhusus->id, 'kode' => '1.3.3.01.05.004', 'nama' => 'GEDUNG PELABUHAN'],

            // 1.3.4.01.01 - JALAN
            ['rincian_objek_id' => $rincianJalan->id, 'kode' => '1.3.4.01.01.001', 'nama' => 'JALAN ASPAL'],
            ['rincian_objek_id' => $rincianJalan->id, 'kode' => '1.3.4.01.01.002', 'nama' => 'JALAN BETON'],
            ['rincian_objek_id' => $rincianJalan->id, 'kode' => '1.3.4.01.01.003', 'nama' => 'JALAN PAVING'],
            ['rincian_objek_id' => $rincianJalan->id, 'kode' => '1.3.4.01.01.004', 'nama' => 'JALAN TANAH'],
            ['rincian_objek_id' => $rincianJalan->id, 'kode' => '1.3.4.01.01.005', 'nama' => 'JALAN KERIKIL'],

            // 1.3.4.01.02 - JEMBATAN
            ['rincian_objek_id' => $rincianJembatan->id, 'kode' => '1.3.4.01.02.001', 'nama' => 'JEMBATAN BETON'],
            ['rincian_objek_id' => $rincianJembatan->id, 'kode' => '1.3.4.01.02.002', 'nama' => 'JEMBATAN BAJA'],
            ['rincian_objek_id' => $rincianJembatan->id, 'kode' => '1.3.4.01.02.003', 'nama' => 'JEMBATAN KAYU'],
            ['rincian_objek_id' => $rincianJembatan->id, 'kode' => '1.3.4.01.02.004', 'nama' => 'JEMBATAN GANTUNG'],

            // 1.3.4.02.01 - BANGUNAN PENGAIRAN
            ['rincian_objek_id' => $rincianBangunanPengairan->id, 'kode' => '1.3.4.02.01.001', 'nama' => 'BENDUNGAN'],
            ['rincian_objek_id' => $rincianBangunanPengairan->id, 'kode' => '1.3.4.02.01.002', 'nama' => 'SALURAN IRIGASI'],
            ['rincian_objek_id' => $rincianBangunanPengairan->id, 'kode' => '1.3.4.02.01.003', 'nama' => 'PINTU AIR'],
            ['rincian_objek_id' => $rincianBangunanPengairan->id, 'kode' => '1.3.4.02.01.004', 'nama' => 'POMPA AIR'],

            // 1.3.4.02.02 - BANGUNAN PENGAMANAN PANTAI DAN SUNGAI
            ['rincian_objek_id' => $rincianBangunanPengamananPantaiDanSungai->id, 'kode' => '1.3.4.02.02.001', 'nama' => 'TANGGUL'],
            ['rincian_objek_id' => $rincianBangunanPengamananPantaiDanSungai->id, 'kode' => '1.3.4.02.02.002', 'nama' => 'PEMECAH GELOMBANG'],
            ['rincian_objek_id' => $rincianBangunanPengamananPantaiDanSungai->id, 'kode' => '1.3.4.02.02.003', 'nama' => 'KRIB'],
            ['rincian_objek_id' => $rincianBangunanPengamananPantaiDanSungai->id, 'kode' => '1.3.4.02.02.004', 'nama' => 'BRONJONG'],

            // 1.3.4.03.01 - INSTALASI AIR BERSIH
            ['rincian_objek_id' => $rincianInstalasiAirBersih->id, 'kode' => '1.3.4.03.01.001', 'nama' => 'INSTALASI PENGOLAHAN AIR'],
            ['rincian_objek_id' => $rincianInstalasiAirBersih->id, 'kode' => '1.3.4.03.01.002', 'nama' => 'RESERVOIR'],
            ['rincian_objek_id' => $rincianInstalasiAirBersih->id, 'kode' => '1.3.4.03.01.003', 'nama' => 'MENARA AIR'],

            // 1.3.4.03.02 - INSTALASI PENGOLAHAN KOTORAN
            ['rincian_objek_id' => $rincianInstalasiPengolahanKotoran->id, 'kode' => '1.3.4.03.02.001', 'nama' => 'INSTALASI PENGOLAHAN AIR LIMBAH'],
            ['rincian_objek_id' => $rincianInstalasiPengolahanKotoran->id, 'kode' => '1.3.4.03.02.002', 'nama' => 'SEPTIC TANK'],
            ['rincian_objek_id' => $rincianInstalasiPengolahanKotoran->id, 'kode' => '1.3.4.03.02.003', 'nama' => 'BIOGAS'],

            // 1.3.4.03.03 - INSTALASI PEMBANGKIT LISTRIK
            ['rincian_objek_id' => $rincianInstalasiPembangkitListrik->id, 'kode' => '1.3.4.03.03.001', 'nama' => 'PEMBANGKIT LISTRIK TENAGA DIESEL'],
            ['rincian_objek_id' => $rincianInstalasiPembangkitListrik->id, 'kode' => '1.3.4.03.03.002', 'nama' => 'PEMBANGKIT LISTRIK TENAGA SURYA'],
            ['rincian_objek_id' => $rincianInstalasiPembangkitListrik->id, 'kode' => '1.3.4.03.03.003', 'nama' => 'PEMBANGKIT LISTRIK TENAGA ANGIN'],
            ['rincian_objek_id' => $rincianInstalasiPembangkitListrik->id, 'kode' => '1.3.4.03.03.004', 'nama' => 'PEMBANGKIT LISTRIK TENAGA AIR'],

            // 1.3.4.03.04 - INSTALASI GARDU LISTRIK
            ['rincian_objek_id' => $rincianInstalasiGarduListrik->id, 'kode' => '1.3.4.03.04.001', 'nama' => 'GARDU INDUK'],
            ['rincian_objek_id' => $rincianInstalasiGarduListrik->id, 'kode' => '1.3.4.03.04.002', 'nama' => 'GARDU DISTRIBUSI'],
            ['rincian_objek_id' => $rincianInstalasiGarduListrik->id, 'kode' => '1.3.4.03.04.003', 'nama' => 'TRAFO'],

            // 1.3.4.04.01 - JARINGAN AIR MINUM
            ['rincian_objek_id' => $rincianJaringanAirMinum->id, 'kode' => '1.3.4.04.01.001', 'nama' => 'PIPA DISTRIBUSI AIR'],
            ['rincian_objek_id' => $rincianJaringanAirMinum->id, 'kode' => '1.3.4.04.01.002', 'nama' => 'PIPA TRANSMISI AIR'],
            ['rincian_objek_id' => $rincianJaringanAirMinum->id, 'kode' => '1.3.4.04.01.003', 'nama' => 'KATUP AIR'],
            ['rincian_objek_id' => $rincianJaringanAirMinum->id, 'kode' => '1.3.4.04.01.004', 'nama' => 'METER AIR'],

            // 1.3.4.04.02 - JARINGAN LISTRIK
            ['rincian_objek_id' => $rincianJaringanListrik->id, 'kode' => '1.3.4.04.02.001', 'nama' => 'KABEL LISTRIK'],
            ['rincian_objek_id' => $rincianJaringanListrik->id, 'kode' => '1.3.4.04.02.002', 'nama' => 'TIANG LISTRIK'],
            ['rincian_objek_id' => $rincianJaringanListrik->id, 'kode' => '1.3.4.04.02.003', 'nama' => 'PANEL LISTRIK'],
            ['rincian_objek_id' => $rincianJaringanListrik->id, 'kode' => '1.3.4.04.02.004', 'nama' => 'METER LISTRIK'],

            // 1.3.4.04.03 - JARINGAN TELEPON DAN TELEGRAPH
            ['rincian_objek_id' => $rincianJaringanTeleponDanTelegraph->id, 'kode' => '1.3.4.04.03.001', 'nama' => 'KABEL TELEPON'],
            ['rincian_objek_id' => $rincianJaringanTeleponDanTelegraph->id, 'kode' => '1.3.4.04.03.002', 'nama' => 'TIANG TELEPON'],
            ['rincian_objek_id' => $rincianJaringanTeleponDanTelegraph->id, 'kode' => '1.3.4.04.03.003', 'nama' => 'CENTRAL TELEPON'],

            // 1.3.4.04.04 - JARINGAN GAS
            ['rincian_objek_id' => $rincianJaringanGas->id, 'kode' => '1.3.4.04.04.001', 'nama' => 'PIPA GAS'],
            ['rincian_objek_id' => $rincianJaringanGas->id, 'kode' => '1.3.4.04.04.002', 'nama' => 'REGULATOR GAS'],
            ['rincian_objek_id' => $rincianJaringanGas->id, 'kode' => '1.3.4.04.04.003', 'nama' => 'METER GAS'],
            ['rincian_objek_id' => $rincianJaringanGas->id, 'kode' => '1.3.4.04.04.004', 'nama' => 'KATUP GAS'],

           
        ];

        foreach ($subRincianObjeks as $subRincianObjek) {
            SubRincianObjek::create($subRincianObjek);
        }
    }
}