<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RincianObjek;
use App\Models\Objek;

class RincianObjekSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil objek yang ada berdasarkan kode
        // 1.3.1 - TANAH
        $objekTanah = Objek::where('kode', '1.3.1.01')->first();

        // 1.3.2 - PERALATAN DAN MESIN
        $objekAlatBerat = Objek::where('kode', '1.3.2.01')->first();
        $objekAlatAngkutan = Objek::where('kode', '1.3.2.02')->first();
        $objekAlatBengkelDanAlatUkur = Objek::where('kode', '1.3.2.03')->first();
        $objekAlatPertanian = Objek::where('kode', '1.3.2.04')->first();
        $objekAlatKantorDanRumahTangga = Objek::where('kode', '1.3.2.05')->first();
        $objekAlatStudioKomunikasiDanPemancar = Objek::where('kode', '1.3.2.06')->first();
        $objekAlatKedokteranDanKesehatan = Objek::where('kode', '1.3.2.07')->first();
        $objekAlatLaboratorium = Objek::where('kode', '1.3.2.08')->first();
        $objekAlatPersenjataan = Objek::where('kode', '1.3.2.09')->first();
        $objekKomputer = Objek::where('kode', '1.3.2.10')->first();

        // 1.3.3 - GEDUNG DAN BANGUNAN
        $objekBangunanGedung = Objek::where('kode', '1.3.3.01')->first();
        $objekMonumen = Objek::where('kode', '1.3.3.02')->first();
        $objekBangunanMenara = Objek::where('kode', '1.3.3.03')->first();

        // 1.3.4 - JALAN, JARINGAN DAN IRIGASI
        $objekJalanDanJembatan = Objek::where('kode', '1.3.4.01')->first();
        $objekBangunanAir = Objek::where('kode', '1.3.4.02')->first();
        $objekInstalasi = Objek::where('kode', '1.3.4.03')->first();
        $objekJaringan = Objek::where('kode', '1.3.4.04')->first();

        // 1.3.5 - ASET TETAP LAINNYA
        $objekBahanPerpustakaan = Objek::where('kode', '1.3.5.01')->first();
        $objekBarangBercorakKesenian = Objek::where('kode', '1.3.5.02')->first();
        $objekHewan = Objek::where('kode', '1.3.5.03')->first();
        $objekTanaman = Objek::where('kode', '1.3.5.05')->first();

        $rincianObjeks = [
            // 1.3.1.01 - TANAH
            ['objek_id' => $objekTanah->id, 'kode' => '1.3.1.01.01', 'nama' => 'TANAH UNTUK BANGUNAN GEDUNG'],
            ['objek_id' => $objekTanah->id, 'kode' => '1.3.1.01.02', 'nama' => 'TANAH UNTUK BANGUNAN SARANA DAN PRASARANA'],
            ['objek_id' => $objekTanah->id, 'kode' => '1.3.1.01.03', 'nama' => 'TANAH UNTUK JALAN DAN JEMBATAN'],
            ['objek_id' => $objekTanah->id, 'kode' => '1.3.1.01.04', 'nama' => 'TANAH UNTUK TAMAN DAN LAPANGAN'],
            ['objek_id' => $objekTanah->id, 'kode' => '1.3.1.01.05', 'nama' => 'TANAH UNTUK LAHAN PARKIR'],

            // 1.3.2.01 - ALAT BERAT
            ['objek_id' => $objekAlatBerat->id, 'kode' => '1.3.2.01.01', 'nama' => 'TRAKTOR'],
            ['objek_id' => $objekAlatBerat->id, 'kode' => '1.3.2.01.02', 'nama' => 'EXCAVATOR'],
            ['objek_id' => $objekAlatBerat->id, 'kode' => '1.3.2.01.03', 'nama' => 'BULLDOZER'],
            ['objek_id' => $objekAlatBerat->id, 'kode' => '1.3.2.01.04', 'nama' => 'LOADER'],
            ['objek_id' => $objekAlatBerat->id, 'kode' => '1.3.2.01.05', 'nama' => 'GRADER'],
            ['objek_id' => $objekAlatBerat->id, 'kode' => '1.3.2.01.06', 'nama' => 'CRANE'],

            // 1.3.2.02 - ALAT ANGKUTAN
            ['objek_id' => $objekAlatAngkutan->id, 'kode' => '1.3.2.02.01', 'nama' => 'KENDARAAN DINAS'],
            ['objek_id' => $objekAlatAngkutan->id, 'kode' => '1.3.2.02.02', 'nama' => 'KENDARAAN OPERASIONAL'],
            ['objek_id' => $objekAlatAngkutan->id, 'kode' => '1.3.2.02.03', 'nama' => 'ANGKUTAN DARAT BERMOTOR'],
            ['objek_id' => $objekAlatAngkutan->id, 'kode' => '1.3.2.02.04', 'nama' => 'ANGKUTAN DARAT TAK BERMOTOR'],
            ['objek_id' => $objekAlatAngkutan->id, 'kode' => '1.3.2.02.05', 'nama' => 'ANGKUTAN AIR BERMOTOR'],
            ['objek_id' => $objekAlatAngkutan->id, 'kode' => '1.3.2.02.06', 'nama' => 'ANGKUTAN AIR TAK BERMOTOR'],
            ['objek_id' => $objekAlatAngkutan->id, 'kode' => '1.3.2.02.07', 'nama' => 'ANGKUTAN UDARA'],

            // 1.3.2.03 - ALAT BENGKEL DAN ALAT UKUR
            ['objek_id' => $objekAlatBengkelDanAlatUkur->id, 'kode' => '1.3.2.03.01', 'nama' => 'ALAT BENGKEL BERMESIN'],
            ['objek_id' => $objekAlatBengkelDanAlatUkur->id, 'kode' => '1.3.2.03.02', 'nama' => 'ALAT BENGKEL TIDAK BERMESIN'],
            ['objek_id' => $objekAlatBengkelDanAlatUkur->id, 'kode' => '1.3.2.03.03', 'nama' => 'ALAT UKUR'],
            ['objek_id' => $objekAlatBengkelDanAlatUkur->id, 'kode' => '1.3.2.03.04', 'nama' => 'ALAT SURVEI DAN PEMETAAN'],

            // 1.3.2.04 - ALAT PERTANIAN
            ['objek_id' => $objekAlatPertanian->id, 'kode' => '1.3.2.04.01', 'nama' => 'ALAT PENGOLAHAN'],
            ['objek_id' => $objekAlatPertanian->id, 'kode' => '1.3.2.04.02', 'nama' => 'ALAT PANEN DAN PERONTOKAN'],
            ['objek_id' => $objekAlatPertanian->id, 'kode' => '1.3.2.04.03', 'nama' => 'ALAT PETERNAKAN'],
            ['objek_id' => $objekAlatPertanian->id, 'kode' => '1.3.2.04.04', 'nama' => 'ALAT KEHUTANAN'],
            ['objek_id' => $objekAlatPertanian->id, 'kode' => '1.3.2.04.05', 'nama' => 'ALAT PERIKANAN'],

            // 1.3.2.05 - ALAT KANTOR DAN RUMAH TANGGA
            ['objek_id' => $objekAlatKantorDanRumahTangga->id, 'kode' => '1.3.2.05.01', 'nama' => 'ALAT KANTOR'],
            ['objek_id' => $objekAlatKantorDanRumahTangga->id, 'kode' => '1.3.2.05.02', 'nama' => 'ALAT RUMAH TANGGA'],
            ['objek_id' => $objekAlatKantorDanRumahTangga->id, 'kode' => '1.3.2.05.03', 'nama' => 'MEUBELAIR'],
            ['objek_id' => $objekAlatKantorDanRumahTangga->id, 'kode' => '1.3.2.05.04', 'nama' => 'ALAT PENDINGIN'],

            // 1.3.2.06 - ALAT STUDIO, KOMUNIKASI DAN PEMANCAR
            ['objek_id' => $objekAlatStudioKomunikasiDanPemancar->id, 'kode' => '1.3.2.06.01', 'nama' => 'ALAT STUDIO'],
            ['objek_id' => $objekAlatStudioKomunikasiDanPemancar->id, 'kode' => '1.3.2.06.02', 'nama' => 'ALAT KOMUNIKASI'],
            ['objek_id' => $objekAlatStudioKomunikasiDanPemancar->id, 'kode' => '1.3.2.06.03', 'nama' => 'ALAT PEMANCAR'],
            ['objek_id' => $objekAlatStudioKomunikasiDanPemancar->id, 'kode' => '1.3.2.06.04', 'nama' => 'ALAT NAVIGASI'],

            // 1.3.2.07 - ALAT KEDOKTERAN DAN KESEHATAN
            ['objek_id' => $objekAlatKedokteranDanKesehatan->id, 'kode' => '1.3.2.07.01', 'nama' => 'ALAT KEDOKTERAN'],
            ['objek_id' => $objekAlatKedokteranDanKesehatan->id, 'kode' => '1.3.2.07.02', 'nama' => 'ALAT KESEHATAN'],
            ['objek_id' => $objekAlatKedokteranDanKesehatan->id, 'kode' => '1.3.2.07.03', 'nama' => 'ALAT KEDOKTERAN GIGI'],
            ['objek_id' => $objekAlatKedokteranDanKesehatan->id, 'kode' => '1.3.2.07.04', 'nama' => 'ALAT VETERINER'],

            // 1.3.2.08 - ALAT LABORATORIUM
            ['objek_id' => $objekAlatLaboratorium->id, 'kode' => '1.3.2.08.01', 'nama' => 'ALAT LABORATORIUM'],

            // 1.3.2.09 - ALAT PERSENJATAAN
            ['objek_id' => $objekAlatPersenjataan->id, 'kode' => '1.3.2.09.01', 'nama' => 'SENJATA API'],
            ['objek_id' => $objekAlatPersenjataan->id, 'kode' => '1.3.2.09.02', 'nama' => 'SENJATA BUKAN API'],
            ['objek_id' => $objekAlatPersenjataan->id, 'kode' => '1.3.2.09.03', 'nama' => 'AMUNISI'],

            // 1.3.2.10 - KOMPUTER
            ['objek_id' => $objekKomputer->id, 'kode' => '1.3.2.10.01', 'nama' => 'PERANGKAT KERAS KOMPUTER'],
            ['objek_id' => $objekKomputer->id, 'kode' => '1.3.2.10.02', 'nama' => 'PERANGKAT LUNAK KOMPUTER'],

            // 1.3.3.01 - BANGUNAN GEDUNG
            ['objek_id' => $objekBangunanGedung->id, 'kode' => '1.3.3.01.01', 'nama' => 'BANGUNAN GEDUNG TEMPAT KERJA'],
            ['objek_id' => $objekBangunanGedung->id, 'kode' => '1.3.3.01.02', 'nama' => 'BANGUNAN GEDUNG TEMPAT TINGGAL'],
            ['objek_id' => $objekBangunanGedung->id, 'kode' => '1.3.3.01.03', 'nama' => 'BANGUNAN GEDUNG TEMPAT USAHA'],
            ['objek_id' => $objekBangunanGedung->id, 'kode' => '1.3.3.01.04', 'nama' => 'BANGUNAN GEDUNG SOSIAL DAN BUDAYA'],
            ['objek_id' => $objekBangunanGedung->id, 'kode' => '1.3.3.01.05', 'nama' => 'BANGUNAN GEDUNG KHUSUS'],

            // 1.3.3.02 - MONUMEN
            ['objek_id' => $objekMonumen->id, 'kode' => '1.3.3.02.01', 'nama' => 'TUGU PERINGATAN/MONUMEN'],
            ['objek_id' => $objekMonumen->id, 'kode' => '1.3.3.02.02', 'nama' => 'CANDI'],

            // 1.3.3.03 - BANGUNAN MENARA
            ['objek_id' => $objekBangunanMenara->id, 'kode' => '1.3.3.03.01', 'nama' => 'MENARA AIR'],
            ['objek_id' => $objekBangunanMenara->id, 'kode' => '1.3.3.03.02', 'nama' => 'MENARA LISTRIK'],
            ['objek_id' => $objekBangunanMenara->id, 'kode' => '1.3.3.03.03', 'nama' => 'MENARA TELEKOMUNIKASI'],

            // 1.3.4.01 - JALAN DAN JEMBATAN
            ['objek_id' => $objekJalanDanJembatan->id, 'kode' => '1.3.4.01.01', 'nama' => 'JALAN'],
            ['objek_id' => $objekJalanDanJembatan->id, 'kode' => '1.3.4.01.02', 'nama' => 'JEMBATAN'],

            // 1.3.4.02 - BANGUNAN AIR
            ['objek_id' => $objekBangunanAir->id, 'kode' => '1.3.4.02.01', 'nama' => 'BANGUNAN PENGAIRAN'],
            ['objek_id' => $objekBangunanAir->id, 'kode' => '1.3.4.02.02', 'nama' => 'BANGUNAN PENGAMANAN PANTAI DAN SUNGAI'],

            // 1.3.4.03 - INSTALASI
            ['objek_id' => $objekInstalasi->id, 'kode' => '1.3.4.03.01', 'nama' => 'INSTALASI AIR BERSIH'],
            ['objek_id' => $objekInstalasi->id, 'kode' => '1.3.4.03.02', 'nama' => 'INSTALASI PENGOLAHAN KOTORAN'],
            ['objek_id' => $objekInstalasi->id, 'kode' => '1.3.4.03.03', 'nama' => 'INSTALASI PEMBANGKIT LISTRIK'],
            ['objek_id' => $objekInstalasi->id, 'kode' => '1.3.4.03.04', 'nama' => 'INSTALASI GARDU LISTRIK'],

            // 1.3.4.04 - JARINGAN
            ['objek_id' => $objekJaringan->id, 'kode' => '1.3.4.04.01', 'nama' => 'JARINGAN AIR MINUM'],
            ['objek_id' => $objekJaringan->id, 'kode' => '1.3.4.04.02', 'nama' => 'JARINGAN LISTRIK'],
            ['objek_id' => $objekJaringan->id, 'kode' => '1.3.4.04.03', 'nama' => 'JARINGAN TELEPON DAN TELEGRAPH'],
            ['objek_id' => $objekJaringan->id, 'kode' => '1.3.4.04.04', 'nama' => 'JARINGAN GAS'],

            // 1.3.5.01 - BAHAN PERPUSTAKAAN
            ['objek_id' => $objekBahanPerpustakaan->id, 'kode' => '1.3.5.01.01', 'nama' => 'BUKU'],
            ['objek_id' => $objekBahanPerpustakaan->id, 'kode' => '1.3.5.01.02', 'nama' => 'JURNAL'],
            ['objek_id' => $objekBahanPerpustakaan->id, 'kode' => '1.3.5.01.03', 'nama' => 'BAHAN PUSTAKA LAINNYA'],

            // 1.3.5.02 - BARANG BERCORAK KESENIAN/KEBUDAYAAN/OLAHRAGA
            ['objek_id' => $objekBarangBercorakKesenian->id, 'kode' => '1.3.5.02.01', 'nama' => 'BARANG KESENIAN'],
            ['objek_id' => $objekBarangBercorakKesenian->id, 'kode' => '1.3.5.02.02', 'nama' => 'BARANG KEBUDAYAAN'],
            ['objek_id' => $objekBarangBercorakKesenian->id, 'kode' => '1.3.5.02.03', 'nama' => 'BARANG OLAHRAGA'],

            // 1.3.5.03 - HEWAN
            ['objek_id' => $objekHewan->id, 'kode' => '1.3.5.03.01', 'nama' => 'HEWAN TERNAK'],
            ['objek_id' => $objekHewan->id, 'kode' => '1.3.5.03.02', 'nama' => 'HEWAN KONSERVASI'],

            // 1.3.5.05 - TANAMAN
            ['objek_id' => $objekTanaman->id, 'kode' => '1.3.5.05.01', 'nama' => 'TANAMAN HIAS'],
            ['objek_id' => $objekTanaman->id, 'kode' => '1.3.5.05.02', 'nama' => 'TANAMAN LANGKA'],
            ['objek_id' => $objekTanaman->id, 'kode' => '1.3.5.05.03', 'nama' => 'TANAMAN BUAH-BUAHAN'],
        ];

        foreach ($rincianObjeks as $rincianObjek) {
            RincianObjek::create($rincianObjek);
        }
    }
}
