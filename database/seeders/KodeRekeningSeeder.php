<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KodeRekening;

class KodeRekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kodeRekenings = [
            // Akun 1 - Aset Lancar
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '111',
                'objek' => '1111',
                'nomor' => '01',
                'kode_lengkap' => '1.11.111.1111.01',
                'uraian' => 'Kas di Bendahara Pengeluaran'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '111',
                'objek' => '1111',
                'nomor' => '02',
                'kode_lengkap' => '1.11.111.1111.02',
                'uraian' => 'Kas di Bendahara Penerimaan'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '111',
                'objek' => '1112',
                'nomor' => '01',
                'kode_lengkap' => '1.11.111.1112.01',
                'uraian' => 'Rekening Kas Umum Daerah'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '111',
                'objek' => '1112',
                'nomor' => '02',
                'kode_lengkap' => '1.11.111.1112.02',
                'uraian' => 'Rekening Kas Daerah'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '112',
                'objek' => '1121',
                'nomor' => '01',
                'kode_lengkap' => '1.11.112.1121.01',
                'uraian' => 'Deposito Kurang dari 3 Bulan'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '112',
                'objek' => '1121',
                'nomor' => '02',
                'kode_lengkap' => '1.11.112.1121.02',
                'uraian' => 'Deposito 3 sampai 12 Bulan'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '113',
                'objek' => '1131',
                'nomor' => '01',
                'kode_lengkap' => '1.11.113.1131.01',
                'uraian' => 'Piutang Pajak Hotel'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '113',
                'objek' => '1131',
                'nomor' => '02',
                'kode_lengkap' => '1.11.113.1131.02',
                'uraian' => 'Piutang Pajak Restoran'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '113',
                'objek' => '1131',
                'nomor' => '03',
                'kode_lengkap' => '1.11.113.1131.03',
                'uraian' => 'Piutang Pajak Hiburan'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '113',
                'objek' => '1131',
                'nomor' => '04',
                'kode_lengkap' => '1.11.113.1131.04',
                'uraian' => 'Piutang Pajak Reklame'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '113',
                'objek' => '1132',
                'nomor' => '01',
                'kode_lengkap' => '1.11.113.1132.01',
                'uraian' => 'Piutang Retribusi Pelayanan Kesehatan'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '113',
                'objek' => '1132',
                'nomor' => '02',
                'kode_lengkap' => '1.11.113.1132.02',
                'uraian' => 'Piutang Retribusi Persampahan'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '113',
                'objek' => '1132',
                'nomor' => '03',
                'kode_lengkap' => '1.11.113.1132.03',
                'uraian' => 'Piutang Retribusi Terminal'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '113',
                'objek' => '1133',
                'nomor' => '01',
                'kode_lengkap' => '1.11.113.1133.01',
                'uraian' => 'Piutang Penjualan Angsuran'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '113',
                'objek' => '1133',
                'nomor' => '02',
                'kode_lengkap' => '1.11.113.1133.02',
                'uraian' => 'Piutang Tuntutan Ganti Rugi'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '114',
                'objek' => '1141',
                'nomor' => '01',
                'kode_lengkap' => '1.11.114.1141.01',
                'uraian' => 'Persediaan Alat Tulis Kantor'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '114',
                'objek' => '1141',
                'nomor' => '02',
                'kode_lengkap' => '1.11.114.1141.02',
                'uraian' => 'Persediaan Alat Listrik dan Elektronik'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '114',
                'objek' => '1141',
                'nomor' => '03',
                'kode_lengkap' => '1.11.114.1141.03',
                'uraian' => 'Persediaan Bahan Bakar dan Pelumas'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '114',
                'objek' => '1141',
                'nomor' => '04',
                'kode_lengkap' => '1.11.114.1141.04',
                'uraian' => 'Persediaan Obat-obatan'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '114',
                'objek' => '1141',
                'nomor' => '05',
                'kode_lengkap' => '1.11.114.1141.05',
                'uraian' => 'Persediaan Bahan Kimia'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '114',
                'objek' => '1142',
                'nomor' => '01',
                'kode_lengkap' => '1.11.114.1142.01',
                'uraian' => 'Persediaan Bahan Bangunan dan Konstruksi'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '114',
                'objek' => '1142',
                'nomor' => '02',
                'kode_lengkap' => '1.11.114.1142.02',
                'uraian' => 'Persediaan Bahan Makanan'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '114',
                'objek' => '1142',
                'nomor' => '03',
                'kode_lengkap' => '1.11.114.1142.03',
                'uraian' => 'Persediaan Bahan Pakaian'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '115',
                'objek' => '1151',
                'nomor' => '01',
                'kode_lengkap' => '1.11.115.1151.01',
                'uraian' => 'Sewa Dibayar Dimuka'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '115',
                'objek' => '1151',
                'nomor' => '02',
                'kode_lengkap' => '1.11.115.1151.02',
                'uraian' => 'Asuransi Dibayar Dimuka'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '115',
                'objek' => '1151',
                'nomor' => '03',
                'kode_lengkap' => '1.11.115.1151.03',
                'uraian' => 'Biaya Dibayar Dimuka Lainnya'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '116',
                'objek' => '1161',
                'nomor' => '01',
                'kode_lengkap' => '1.11.116.1161.01',
                'uraian' => 'Koleksi Perpustakaan'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '116',
                'objek' => '1161',
                'nomor' => '02',
                'kode_lengkap' => '1.11.116.1161.02',
                'uraian' => 'Barang Antik'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '116',
                'objek' => '1162',
                'nomor' => '01',
                'kode_lengkap' => '1.11.116.1162.01',
                'uraian' => 'Aset Tak Berwujud'
            ],
            [
                'akun' => '1',
                'kelompok' => '11',
                'jenis' => '116',
                'objek' => '1162',
                'nomor' => '02',
                'kode_lengkap' => '1.11.116.1162.02',
                'uraian' => 'Kemitraan dengan Pihak Ketiga'
            ],

            // Akun 1 - Aset Tetap
            [
                'akun' => '1',
                'kelompok' => '13',
                'jenis' => '131',
                'objek' => '1311',
                'nomor' => '01',
                'kode_lengkap' => '1.13.131.1311.01',
                'uraian' => 'Tanah Perkantoran'
            ],
            [
                'akun' => '1',
                'kelompok' => '13',
                'jenis' => '131',
                'objek' => '1311',
                'nomor' => '02',
                'kode_lengkap' => '1.13.131.1311.02',
                'uraian' => 'Tanah Sekolah'
            ],
            [
                'akun' => '1',
                'kelompok' => '13',
                'jenis' => '131',
                'objek' => '1311',
                'nomor' => '03',
                'kode_lengkap' => '1.13.131.1311.03',
                'uraian' => 'Tanah Rumah Sakit'
            ],
            [
                'akun' => '1',
                'kelompok' => '13',
                'jenis' => '132',
                'objek' => '1321',
                'nomor' => '01',
                'kode_lengkap' => '1.13.132.1321.01',
                'uraian' => 'Bangunan Gedung Perkantoran'
            ],
            [
                'akun' => '1',
                'kelompok' => '13',
                'jenis' => '132',
                'objek' => '1321',
                'nomor' => '02',
                'kode_lengkap' => '1.13.132.1321.02',
                'uraian' => 'Bangunan Gedung Sekolah'
            ],
            [
                'akun' => '1',
                'kelompok' => '13',
                'jenis' => '132',
                'objek' => '1321',
                'nomor' => '03',
                'kode_lengkap' => '1.13.132.1321.03',
                'uraian' => 'Bangunan Gedung Rumah Sakit'
            ],
            [
                'akun' => '1',
                'kelompok' => '13',
                'jenis' => '133',
                'objek' => '1331',
                'nomor' => '01',
                'kode_lengkap' => '1.13.133.1331.01',
                'uraian' => 'Peralatan dan Mesin Kantor'
            ],
            [
                'akun' => '1',
                'kelompok' => '13',
                'jenis' => '133',
                'objek' => '1331',
                'nomor' => '02',
                'kode_lengkap' => '1.13.133.1331.02',
                'uraian' => 'Peralatan dan Mesin Medis'
            ],
            [
                'akun' => '1',
                'kelompok' => '13',
                'jenis' => '133',
                'objek' => '1332',
                'nomor' => '01',
                'kode_lengkap' => '1.13.133.1332.01',
                'uraian' => 'Kendaraan Bermotor Roda Empat'
            ],
            [
                'akun' => '1',
                'kelompok' => '13',
                'jenis' => '133',
                'objek' => '1332',
                'nomor' => '02',
                'kode_lengkap' => '1.13.133.1332.02',
                'uraian' => 'Kendaraan Bermotor Roda Dua'
            ],
            [
                'akun' => '1',
                'kelompok' => '13',
                'jenis' => '134',
                'objek' => '1341',
                'nomor' => '01',
                'kode_lengkap' => '1.13.134.1341.01',
                'uraian' => 'Jalan dan Jembatan'
            ],
            [
                'akun' => '1',
                'kelompok' => '13',
                'jenis' => '134',
                'objek' => '1341',
                'nomor' => '02',
                'kode_lengkap' => '1.13.134.1341.02',
                'uraian' => 'Irigasi'
            ],
            [
                'akun' => '1',
                'kelompok' => '13',
                'jenis' => '134',
                'objek' => '1341',
                'nomor' => '03',
                'kode_lengkap' => '1.13.134.1341.03',
                'uraian' => 'Jaringan Air Minum dan Air Limbah'
            ],
            [
                'akun' => '1',
                'kelompok' => '13',
                'jenis' => '135',
                'objek' => '1351',
                'nomor' => '01',
                'kode_lengkap' => '1.13.135.1351.01',
                'uraian' => 'Aset Tetap Lainnya'
            ],

            // Akun 2 - Kewajiban
            [
                'akun' => '2',
                'kelompok' => '21',
                'jenis' => '211',
                'objek' => '2111',
                'nomor' => '01',
                'kode_lengkap' => '2.21.211.2111.01',
                'uraian' => 'Utang Perhitungan Fihak Ketiga (PFK)'
            ],
            [
                'akun' => '2',
                'kelompok' => '21',
                'jenis' => '211',
                'objek' => '2111',
                'nomor' => '02',
                'kode_lengkap' => '2.21.211.2111.02',
                'uraian' => 'Utang Bunga'
            ],
            [
                'akun' => '2',
                'kelompok' => '21',
                'jenis' => '211',
                'objek' => '2112',
                'nomor' => '01',
                'kode_lengkap' => '2.21.211.2112.01',
                'uraian' => 'Utang Beban'
            ],
            [
                'akun' => '2',
                'kelompok' => '21',
                'jenis' => '211',
                'objek' => '2112',
                'nomor' => '02',
                'kode_lengkap' => '2.21.211.2112.02',
                'uraian' => 'Utang Belanja'
            ],
            [
                'akun' => '2',
                'kelompok' => '21',
                'jenis' => '212',
                'objek' => '2121',
                'nomor' => '01',
                'kode_lengkap' => '2.21.212.2121.01',
                'uraian' => 'Pendapatan Diterima Dimuka'
            ],
            [
                'akun' => '2',
                'kelompok' => '22',
                'jenis' => '221',
                'objek' => '2211',
                'nomor' => '01',
                'kode_lengkap' => '2.22.221.2211.01',
                'uraian' => 'Utang Dalam Negeri - Sektor Perbankan'
            ],
            [
                'akun' => '2',
                'kelompok' => '22',
                'jenis' => '221',
                'objek' => '2211',
                'nomor' => '02',
                'kode_lengkap' => '2.22.221.2211.02',
                'uraian' => 'Utang Dalam Negeri - Sektor Non Perbankan'
            ],

            // Akun 3 - Ekuitas
            [
                'akun' => '3',
                'kelompok' => '31',
                'jenis' => '311',
                'objek' => '3111',
                'nomor' => '01',
                'kode_lengkap' => '3.31.311.3111.01',
                'uraian' => 'Ekuitas Dana Lancar'
            ],
            [
                'akun' => '3',
                'kelompok' => '31',
                'jenis' => '312',
                'objek' => '3121',
                'nomor' => '01',
                'kode_lengkap' => '3.31.312.3121.01',
                'uraian' => 'Ekuitas Dana Investasi'
            ],
            [
                'akun' => '3',
                'kelompok' => '31',
                'jenis' => '313',
                'objek' => '3131',
                'nomor' => '01',
                'kode_lengkap' => '3.31.313.3131.01',
                'uraian' => 'Ekuitas Dana Cadangan'
            ],

            // Akun 4 - Pendapatan-LRA
            [
                'akun' => '4',
                'kelompok' => '41',
                'jenis' => '411',
                'objek' => '4111',
                'nomor' => '01',
                'kode_lengkap' => '4.41.411.4111.01',
                'uraian' => 'Pajak Daerah'
            ],
            [
                'akun' => '4',
                'kelompok' => '41',
                'jenis' => '412',
                'objek' => '4121',
                'nomor' => '01',
                'kode_lengkap' => '4.41.412.4121.01',
                'uraian' => 'Retribusi Daerah'
            ],
            [
                'akun' => '4',
                'kelompok' => '41',
                'jenis' => '413',
                'objek' => '4131',
                'nomor' => '01',
                'kode_lengkap' => '4.41.413.4131.01',
                'uraian' => 'Hasil Pengelolaan Kekayaan Daerah yang Dipisahkan'
            ],
            [
                'akun' => '4',
                'kelompok' => '41',
                'jenis' => '414',
                'objek' => '4141',
                'nomor' => '01',
                'kode_lengkap' => '4.41.414.4141.01',
                'uraian' => 'Lain-lain Pendapatan Asli Daerah yang Sah'
            ],
            [
                'akun' => '4',
                'kelompok' => '42',
                'jenis' => '421',
                'objek' => '4211',
                'nomor' => '01',
                'kode_lengkap' => '4.42.421.4211.01',
                'uraian' => 'Dana Bagi Hasil Pajak'
            ],
            [
                'akun' => '4',
                'kelompok' => '42',
                'jenis' => '422',
                'objek' => '4221',
                'nomor' => '01',
                'kode_lengkap' => '4.42.422.4221.01',
                'uraian' => 'Dana Alokasi Umum'
            ],
            [
                'akun' => '4',
                'kelompok' => '42',
                'jenis' => '423',
                'objek' => '4231',
                'nomor' => '01',
                'kode_lengkap' => '4.42.423.4231.01',
                'uraian' => 'Dana Alokasi Khusus'
            ],

            // Akun 5 - Belanja
            [
                'akun' => '5',
                'kelompok' => '51',
                'jenis' => '511',
                'objek' => '5111',
                'nomor' => '01',
                'kode_lengkap' => '5.51.511.5111.01',
                'uraian' => 'Belanja Gaji dan Tunjangan'
            ],
            [
                'akun' => '5',
                'kelompok' => '51',
                'jenis' => '512',
                'objek' => '5121',
                'nomor' => '01',
                'kode_lengkap' => '5.51.512.5121.01',
                'uraian' => 'Belanja Barang dan Jasa'
            ],
            [
                'akun' => '5',
                'kelompok' => '52',
                'jenis' => '521',
                'objek' => '5211',
                'nomor' => '01',
                'kode_lengkap' => '5.52.521.5211.01',
                'uraian' => 'Belanja Modal Tanah'
            ],
            [
                'akun' => '5',
                'kelompok' => '52',
                'jenis' => '522',
                'objek' => '5221',
                'nomor' => '01',
                'kode_lengkap' => '5.52.522.5221.01',
                'uraian' => 'Belanja Modal Peralatan dan Mesin'
            ],
            [
                'akun' => '5',
                'kelompok' => '52',
                'jenis' => '523',
                'objek' => '5231',
                'nomor' => '01',
                'kode_lengkap' => '5.52.523.5231.01',
                'uraian' => 'Belanja Modal Gedung dan Bangunan'
            ],
            [
                'akun' => '5',
                'kelompok' => '53',
                'jenis' => '531',
                'objek' => '5311',
                'nomor' => '01',
                'kode_lengkap' => '5.53.531.5311.01',
                'uraian' => 'Belanja Bunga'
            ],
            [
                'akun' => '5',
                'kelompok' => '53',
                'jenis' => '532',
                'objek' => '5321',
                'nomor' => '01',
                'kode_lengkap' => '5.53.532.5321.01',
                'uraian' => 'Belanja Subsidi'
            ],
            [
                'akun' => '5',
                'kelompok' => '53',
                'jenis' => '533',
                'objek' => '5331',
                'nomor' => '01',
                'kode_lengkap' => '5.53.533.5331.01',
                'uraian' => 'Belanja Hibah'
            ],
            [
                'akun' => '5',
                'kelompok' => '53',
                'jenis' => '534',
                'objek' => '5341',
                'nomor' => '01',
                'kode_lengkap' => '5.53.534.5341.01',
                'uraian' => 'Belanja Bantuan Sosial'
            ],

            // Akun 6 - Pembiayaan
            [
                'akun' => '6',
                'kelompok' => '61',
                'jenis' => '611',
                'objek' => '6111',
                'nomor' => '01',
                'kode_lengkap' => '6.61.611.6111.01',
                'uraian' => 'Penerimaan Pinjaman Dalam Negeri'
            ],
            [
                'akun' => '6',
                'kelompok' => '61',
                'jenis' => '612',
                'objek' => '6121',
                'nomor' => '01',
                'kode_lengkap' => '6.61.612.6121.01',
                'uraian' => 'Penerimaan Kembali Investasi Non Permanen'
            ],
            [
                'akun' => '6',
                'kelompok' => '62',
                'jenis' => '621',
                'objek' => '6211',
                'nomor' => '01',
                'kode_lengkap' => '6.62.621.6211.01',
                'uraian' => 'Pembayaran Pokok Utang Dalam Negeri'
            ],
            [
                'akun' => '6',
                'kelompok' => '62',
                'jenis' => '622',
                'objek' => '6221',
                'nomor' => '01',
                'kode_lengkap' => '6.62.622.6221.01',
                'uraian' => 'Pengeluaran Investasi Non Permanen'
            ],

            // Akun 7 - Pendapatan-LO
            [
                'akun' => '7',
                'kelompok' => '71',
                'jenis' => '711',
                'objek' => '7111',
                'nomor' => '01',
                'kode_lengkap' => '7.71.711.7111.01',
                'uraian' => 'Pendapatan Pajak Daerah-LO'
            ]
        ];

        foreach ($kodeRekenings as $data) {
            KodeRekening::create($data);
        }
    }
}
