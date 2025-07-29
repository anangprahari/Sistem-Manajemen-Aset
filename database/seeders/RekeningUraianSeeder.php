<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RekeningUraianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode_rekening' => '5.2.2.01.01', 'uraian' => 'Belanja ATK'],
            ['kode_rekening' => '5.2.2.01.02', 'uraian' => 'Belanja Cetak'],
            ['kode_rekening' => '5.2.2.01.03', 'uraian' => 'Belanja Perjalanan Dinas'],
            ['kode_rekening' => '5.2.2.01.04', 'uraian' => 'Belanja Alat Tulis'],
            ['kode_rekening' => '5.2.2.01.05', 'uraian' => 'Belanja Sewa Gedung'],
            ['kode_rekening' => '5.2.2.01.06', 'uraian' => 'Belanja Listrik'],
            ['kode_rekening' => '5.2.2.01.07', 'uraian' => 'Belanja Air Bersih'],
            ['kode_rekening' => '5.2.2.01.08', 'uraian' => 'Belanja Konsumsi'],
            ['kode_rekening' => '5.2.2.01.09', 'uraian' => 'Belanja Internet'],
            ['kode_rekening' => '5.2.2.01.10', 'uraian' => 'Belanja Maintenance'],
        ];

        DB::table('rekening_uraians')->insert($data);
    }
}
