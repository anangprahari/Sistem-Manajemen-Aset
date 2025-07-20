<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelompok;
use App\Models\Akun;

class KelompokSeeder extends Seeder
{
    public function run(): void
    {
        $akunAsetTetap = Akun::where('kode', '1')->first();
        $akunAsetLainnya = Akun::where('kode', '2')->first();
        $akunBebanDibayar = Akun::where('kode', '3')->first();
        $akunInvestasi = Akun::where('kode', '4')->first();
        $akunAsetTakBerwujud = Akun::where('kode', '5')->first();

        $kelompoks = [
            // Untuk Aset Tetap (1)
            ['akun_id' => $akunAsetTetap->id, 'kode' => '1.1', 'nama' => 'Tanah'],
            ['akun_id' => $akunAsetTetap->id, 'kode' => '1.2', 'nama' => 'Mesin dan Peralatan'],
            ['akun_id' => $akunAsetTetap->id, 'kode' => '1.3', 'nama' => 'Gedung dan Bangunan'],
            ['akun_id' => $akunAsetTetap->id, 'kode' => '1.4', 'nama' => 'Jalan, Irigasi, dan Jaringan'],
            ['akun_id' => $akunAsetTetap->id, 'kode' => '1.5', 'nama' => 'Aset Tetap Lainnya'],

            // Untuk Aset Lainnya (2)
            ['akun_id' => $akunAsetLainnya->id, 'kode' => '2.1', 'nama' => 'Aset Tak Berwujud'],
            ['akun_id' => $akunAsetLainnya->id, 'kode' => '2.2', 'nama' => 'Aset Lain-lain'],

            // Untuk Beban Dibayar Dimuka (3)
            ['akun_id' => $akunBebanDibayar->id, 'kode' => '3.1', 'nama' => 'Sewa Dibayar Dimuka'],
            ['akun_id' => $akunBebanDibayar->id, 'kode' => '3.2', 'nama' => 'Asuransi Dibayar Dimuka'],

            // Untuk Investasi Jangka Panjang (4)
            ['akun_id' => $akunInvestasi->id, 'kode' => '4.1', 'nama' => 'Investasi Saham'],
            ['akun_id' => $akunInvestasi->id, 'kode' => '4.2', 'nama' => 'Investasi Obligasi'],

            // Untuk Aset Tak Berwujud (5)
            ['akun_id' => $akunAsetTakBerwujud->id, 'kode' => '5.1', 'nama' => 'Software dan Lisensi'],
            ['akun_id' => $akunAsetTakBerwujud->id, 'kode' => '5.2', 'nama' => 'Hak Paten'],
        ];

        foreach ($kelompoks as $kelompok) {
            Kelompok::create($kelompok);
        }
    }
}
