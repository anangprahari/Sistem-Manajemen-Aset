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

        $kelompoks = [
            // Untuk Aset Tetap
            ['akun_id' => $akunAsetTetap->id, 'kode' => '1.1', 'nama' => 'Tanah'],
            ['akun_id' => $akunAsetTetap->id, 'kode' => '1.2', 'nama' => 'Mesin dan Peralatan'],
            ['akun_id' => $akunAsetTetap->id, 'kode' => '1.3', 'nama' => 'Gedung dan Bangunan'],
            ['akun_id' => $akunAsetTetap->id, 'kode' => '1.4', 'nama' => 'Jalan, Irigasi, dan Jaringan'],
            ['akun_id' => $akunAsetTetap->id, 'kode' => '1.5', 'nama' => 'Aset Tetap Lainnya'],

            // Untuk Aset Lainnya
            ['akun_id' => $akunAsetLainnya->id, 'kode' => '2.1', 'nama' => 'Aset Tak Berwujud'],
            ['akun_id' => $akunAsetLainnya->id, 'kode' => '2.2', 'nama' => 'Aset Lain-lain'],
        ];

        foreach ($kelompoks as $kelompok) {
            Kelompok::create($kelompok);
        }
    }
}
