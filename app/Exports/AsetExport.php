<?php

namespace App\Exports;

use App\Models\Aset;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AsetExport implements FromQuery, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle, WithChunkReading
{
    protected $search;
    protected $tahunPerolehan;
    protected $keadaanBarang;
    private $rowNumber = 0;

    public function __construct($search = null, $tahunPerolehan = null, $keadaanBarang = null)
    {
        $this->search = $search;
        $this->tahunPerolehan = $tahunPerolehan;
        $this->keadaanBarang = $keadaanBarang;
    }

    public function query()
    {
        $query = Aset::with([
            'subSubRincianObjek.subRincianObjek.rincianObjek.objek.jenis.kelompok.akun'
        ]);

        // Apply same filters as in index method
        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_bidang_barang', 'like', "%{$search}%")
                    ->orWhere('nama_jenis_barang', 'like', "%{$search}%")
                    ->orWhere('kode_barang', 'like', "%{$search}%")
                    ->orWhere('register', 'like', "%{$search}%");
            });
        }

        if ($this->tahunPerolehan) {
            $query->where('tahun_perolehan', $this->tahunPerolehan);
        }

        if ($this->keadaanBarang) {
            $query->where('keadaan_barang', $this->keadaanBarang);
        }

        return $query->latest();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Barang',
            'Register',
            'Nama Bidang Barang',
            'Nama Jenis Barang',
            'Akun',
            'Kelompok',
            'Jenis',
            'Objek',
            'Rincian Objek',
            'Sub Rincian Objek',
            'Sub Sub Rincian Objek',
            'Merk/Type',
            'No. Sertifikat',
            'No. Plat Kendaraan',
            'No. Pabrik',
            'No. Casis',
            'Bahan',
            'Asal Perolehan',
            'Tahun Perolehan',
            'Ukuran/Konstruksi',
            'Satuan',
            'Keadaan Barang',
            'Jumlah Barang',
            'Harga Satuan',
            'Total Harga',
            'Tanggal Dibuat',
            'Tanggal Diupdate'
        ];
    }

    public function map($aset): array
    {
        $this->rowNumber++;

        // Safe access to nested relationships
        $akun = optional(optional(optional(optional(optional(optional($aset->subSubRincianObjek)->subRincianObjek)->rincianObjek)->objek)->jenis)->kelompok)->akun->nama ?? '-';
        $kelompok = optional(optional(optional(optional(optional($aset->subSubRincianObjek)->subRincianObjek)->rincianObjek)->objek)->jenis)->kelompok->nama ?? '-';
        $jenis = optional(optional(optional(optional($aset->subSubRincianObjek)->subRincianObjek)->rincianObjek)->objek)->jenis->nama ?? '-';
        $objek = optional(optional(optional($aset->subSubRincianObjek)->subRincianObjek)->rincianObjek)->objek->nama ?? '-';
        $rincianObjek = optional(optional($aset->subSubRincianObjek)->subRincianObjek)->rincianObjek->nama ?? '-';
        $subRincianObjek = optional($aset->subSubRincianObjek)->subRincianObjek->nama ?? '-';
        $subSubRincianObjek = optional($aset->subSubRincianObjek)->nama_barang ?? '-';

        return [
            $this->rowNumber,
            $aset->kode_barang ?? '-',
            $aset->register ?? '-',
            $aset->nama_bidang_barang ?? '-',
            $aset->nama_jenis_barang ?? '-',
            $akun,
            $kelompok,
            $jenis,
            $objek,
            $rincianObjek,
            $subRincianObjek,
            $subSubRincianObjek,
            $aset->merk_type ?? '-',
            $aset->no_sertifikat ?? '-',
            $aset->no_plat_kendaraan ?? '-',
            $aset->no_pabrik ?? '-',
            $aset->no_casis ?? '-',
            $aset->bahan ?? '-',
            $aset->asal_perolehan ?? '-',
            $aset->tahun_perolehan ?? '-',
            $aset->ukuran_barang_konstruksi ?? '-',
            $aset->satuan ?? '-',
            $aset->keadaan_barang ?? '-',
            $aset->jumlah_barang ?? 0,
            $this->formatCurrency($aset->harga_satuan ?? 0),
            $this->formatCurrency(($aset->harga_satuan ?? 0) * ($aset->jumlah_barang ?? 0)),
            $aset->created_at ? $aset->created_at->format('d/m/Y H:i') : '-',
            $aset->updated_at ? $aset->updated_at->format('d/m/Y H:i') : '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as header
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000']
                    ]
                ]
            ],
            // Style all data cells
            'A2:AB1000' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC']
                    ]
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ]
            ],
            // Style nomor urut column
            'A:A' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ]
            ],
            // Style currency columns
            'Y:Z' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                ]
            ]
        ];
    }

    public function title(): string
    {
        return 'Data Aset';
    }

    public function chunkSize(): int
    {
        return 1000; // Process 1000 records at a time
    }

    private function formatCurrency($amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
