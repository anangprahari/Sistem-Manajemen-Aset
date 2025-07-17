<?php

namespace Database\Seeders;

use App\Models\Aset;
use App\Models\SubSubRincianObjek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil beberapa SubSubRincianObjek yang sudah ada
        $subSubRincianObjeks = SubSubRincianObjek::limit(5)->get();

        $asets = [
            [
                'sub_sub_rincian_objek_id' => $subSubRincianObjeks[0]->id,
                'kode_barang' => $subSubRincianObjeks[0]->kode . '.001',
                'nama_bidang_barang' => 'Kendaraan Operasional Dinas',
                'register' => 'REG001/2024',
                'nama_jenis_barang' => 'Sedan Toyota Camry 2024',
                'merk_type' => 'Toyota Camry Hybrid',
                'no_sertifikat' => 'SERT001/2024',
                'no_plat_kendaraan' => 'B 1234 ABC',
                'no_pabrik' => 'TOY123456789',
                'no_casis' => 'CAS123456789',
                'bahan' => 'Logam dan Plastik',
                'asal_perolehan' => 'Pembelian Langsung',
                'ukuran_barang_konstruksi' => '4.5m x 1.8m x 1.4m',
                'satuan' => 'Unit',
                'keadaan_barang' => 'Baik',
                'jumlah_barang' => 1,
                'harga_satuan' => 450000000.00,
                'bukti_barang' => null,
                'bukti_berita' => null,
            ],
            [
                'sub_sub_rincian_objek_id' => $subSubRincianObjeks[1]->id,
                'kode_barang' => $subSubRincianObjeks[1]->kode . '.001',
                'nama_bidang_barang' => 'Perangkat Komputer Kantor',
                'register' => 'REG002/2024',
                'nama_jenis_barang' => 'PC Desktop Dell OptiPlex 7090',
                'merk_type' => 'Dell OptiPlex 7090 Intel Core i7',
                'no_sertifikat' => 'SERT002/2024',
                'no_plat_kendaraan' => null,
                'no_pabrik' => 'DELL789012345',
                'no_casis' => null,
                'bahan' => 'Plastik dan Logam',
                'asal_perolehan' => 'Tender Terbuka',
                'ukuran_barang_konstruksi' => '20cm x 40cm x 35cm',
                'satuan' => 'Unit',
                'keadaan_barang' => 'Baik',
                'jumlah_barang' => 10,
                'harga_satuan' => 8500000.00,
                'bukti_barang' => null,
                'bukti_berita' => null,
            ],
            [
                'sub_sub_rincian_objek_id' => $subSubRincianObjeks[2]->id,
                'kode_barang' => $subSubRincianObjeks[2]->kode . '.001',
                'nama_bidang_barang' => 'Peralatan Cetak Kantor',
                'register' => 'REG003/2024',
                'nama_jenis_barang' => 'Printer Laser Canon LBP2900',
                'merk_type' => 'Canon LBP2900 Monokrom',
                'no_sertifikat' => 'SERT003/2024',
                'no_plat_kendaraan' => null,
                'no_pabrik' => 'CAN456789012',
                'no_casis' => null,
                'bahan' => 'Plastik ABS',
                'asal_perolehan' => 'Pengadaan Langsung',
                'ukuran_barang_konstruksi' => '35cm x 25cm x 18cm',
                'satuan' => 'Unit',
                'keadaan_barang' => 'Baik',
                'jumlah_barang' => 5,
                'harga_satuan' => 1200000.00,
                'bukti_barang' => null,
                'bukti_berita' => null,
            ],
            [
                'sub_sub_rincian_objek_id' => $subSubRincianObjeks[3]->id,
                'kode_barang' => $subSubRincianObjeks[3]->kode . '.001',
                'nama_bidang_barang' => 'Furniture Kantor',
                'register' => 'REG004/2024',
                'nama_jenis_barang' => 'Kursi Kantor Ergonomis',
                'merk_type' => 'Kursi Kantor High Back Mesh',
                'no_sertifikat' => 'SERT004/2024',
                'no_plat_kendaraan' => null,
                'no_pabrik' => 'FUR345678901',
                'no_casis' => null,
                'bahan' => 'Mesh dan Logam',
                'asal_perolehan' => 'Tender Terbatas',
                'ukuran_barang_konstruksi' => '65cm x 65cm x 120cm',
                'satuan' => 'Unit',
                'keadaan_barang' => 'Baik',
                'jumlah_barang' => 25,
                'harga_satuan' => 750000.00,
                'bukti_barang' => null,
                'bukti_berita' => null,
            ],
            [
                'sub_sub_rincian_objek_id' => $subSubRincianObjeks[4]->id,
                'kode_barang' => $subSubRincianObjeks[4]->kode . '.001',
                'nama_bidang_barang' => 'Perangkat Laptop Portable',
                'register' => 'REG005/2024',
                'nama_jenis_barang' => 'Laptop Dell Latitude 5420',
                'merk_type' => 'Dell Latitude 5420 Intel Core i5',
                'no_sertifikat' => 'SERT005/2024',
                'no_plat_kendaraan' => null,
                'no_pabrik' => 'DELL567890123',
                'no_casis' => null,
                'bahan' => 'Plastik dan Aluminium',
                'asal_perolehan' => 'Kontrak Payung',
                'ukuran_barang_konstruksi' => '32cm x 23cm x 2cm',
                'satuan' => 'Unit',
                'keadaan_barang' => 'Kurang Baik',
                'jumlah_barang' => 15,
                'harga_satuan' => 12000000.00,
                'bukti_barang' => null,
                'bukti_berita' => null,
            ],
        ];

        foreach ($asets as $aset) {
            Aset::create($aset);
        }
    }
}
