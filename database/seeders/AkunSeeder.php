<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Akun;

class AkunSeeder extends Seeder
{
    public function run(): void
    {
        $akuns = [
            ['kode' => '1', 'nama' => 'Aset Tetap'],
            ['kode' => '2', 'nama' => 'Aset Lainnya'],
            ['kode' => '3', 'nama' => 'Beban Dibayar Dimuka'],
            ['kode' => '4', 'nama' => 'Investasi Jangka Panjang'],
            ['kode' => '5', 'nama' => 'Aset Tak Berwujud'],
        ];

        foreach ($akuns as $akun) {
            Akun::create($akun);
        }
    }
}
