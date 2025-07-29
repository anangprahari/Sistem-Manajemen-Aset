<?php

namespace App\Http\Controllers\Aset;

use App\Http\Controllers\Controller;
use App\Models\AsetLancar;
use App\Models\RekeningUraian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class AsetLancarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AsetLancar::with('rekeningUraian');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_kegiatan', 'like', "%{$search}%")
                    ->orWhere('uraian_kegiatan', 'like', "%{$search}%")
                    ->orWhere('uraian_jenis_barang', 'like', "%{$search}%")
                    ->orWhereHas('rekeningUraian', function ($q) use ($search) {
                        $q->where('kode_rekening', 'like', "%{$search}%")
                            ->orWhere('uraian', 'like', "%{$search}%");
                    });
            });
        }

        $asetLancars = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('asets.asetlancar.index', compact('asetLancars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rekeningUraians = RekeningUraian::orderBy('kode_rekening')->get();
        return view('asets.asetlancar.create', compact('rekeningUraians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rekening_uraian_id' => 'required|exists:rekening_uraians,id',
            'nama_kegiatan' => 'required|string|max:255',
            'uraian_kegiatan' => 'nullable|string',
            'uraian_jenis_barang' => 'nullable|string',
            'saldo_awal_unit' => 'required|integer|min:0',
            'saldo_awal_harga_satuan' => 'required|numeric|min:0',
            'mutasi_tambah_unit' => 'nullable|integer|min:0',
            'mutasi_tambah_harga_satuan' => 'nullable|numeric|min:0',
            'mutasi_kurang_unit' => 'nullable|integer|min:0',
            'mutasi_kurang_nilai_total' => 'nullable|numeric|min:0',
        ]);

        $data = $request->all();

        // Perhitungan otomatis
        $data = $this->calculateValues($data);

        AsetLancar::create($data);

        return redirect()->route('aset-lancars.index')
            ->with('success', 'Data aset lancar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AsetLancar $asetLancar)
    {
        $asetLancar->load('rekeningUraian');
        return view('aset-lancars.show', compact('asetLancar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsetLancar $asetLancar)
    {
        $rekeningUraians = RekeningUraian::orderBy('kode_rekening')->get();
        return view('aset-lancars.edit', compact('asetLancar', 'rekeningUraians'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AsetLancar $asetLancar)
    {
        $request->validate([
            'rekening_uraian_id' => 'required|exists:rekening_uraians,id',
            'nama_kegiatan' => 'required|string|max:255',
            'uraian_kegiatan' => 'nullable|string',
            'uraian_jenis_barang' => 'nullable|string',
            'saldo_awal_unit' => 'required|integer|min:0',
            'saldo_awal_harga_satuan' => 'required|numeric|min:0',
            'mutasi_tambah_unit' => 'nullable|integer|min:0',
            'mutasi_tambah_harga_satuan' => 'nullable|numeric|min:0',
            'mutasi_kurang_unit' => 'nullable|integer|min:0',
            'mutasi_kurang_nilai_total' => 'nullable|numeric|min:0',
        ]);

        $data = $request->all();

        // Perhitungan otomatis
        $data = $this->calculateValues($data);

        $asetLancar->update($data);

        return redirect()->route('aset-lancars.index')
            ->with('success', 'Data aset lancar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AsetLancar $asetLancar)
    {
        $asetLancar->delete();

        return redirect()->route('aset-lancars.index')
            ->with('success', 'Data aset lancar berhasil dihapus.');
    }

    /**
     * Calculate automatic values
     */
    private function calculateValues($data)
    {
        // Set default values if null
        $data['mutasi_tambah_unit'] = $data['mutasi_tambah_unit'] ?? 0;
        $data['mutasi_tambah_harga_satuan'] = $data['mutasi_tambah_harga_satuan'] ?? 0;
        $data['mutasi_kurang_unit'] = $data['mutasi_kurang_unit'] ?? 0;
        $data['mutasi_kurang_nilai_total'] = $data['mutasi_kurang_nilai_total'] ?? 0;

        // Perhitungan saldo_awal_total
        $data['saldo_awal_total'] = $data['saldo_awal_unit'] * $data['saldo_awal_harga_satuan'];

        // Perhitungan mutasi_tambah_nilai_total
        $data['mutasi_tambah_nilai_total'] = $data['mutasi_tambah_unit'] * $data['mutasi_tambah_harga_satuan'];

        // Perhitungan saldo_akhir_unit
        $data['saldo_akhir_unit'] = $data['saldo_awal_unit'] + $data['mutasi_tambah_unit'] - $data['mutasi_kurang_unit'];

        // Perhitungan saldo_akhir_total
        $data['saldo_akhir_total'] = $data['saldo_awal_total'] + $data['mutasi_tambah_nilai_total'] - $data['mutasi_kurang_nilai_total'];

        return $data;
    }

    /**
     * Export to Excel
     */
    public function export(Request $request)
    {
        $query = AsetLancar::with('rekeningUraian');

        // Apply search filter if exists
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_kegiatan', 'like', "%{$search}%")
                    ->orWhere('uraian_kegiatan', 'like', "%{$search}%")
                    ->orWhere('uraian_jenis_barang', 'like', "%{$search}%")
                    ->orWhereHas('rekeningUraian', function ($q) use ($search) {
                        $q->where('kode_rekening', 'like', "%{$search}%")
                            ->orWhere('uraian', 'like', "%{$search}%");
                    });
            });
        }

        $asetLancars = $query->orderBy('created_at', 'desc')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $headers = [
            'A1' => 'No',
            'B1' => 'Kode Rekening',
            'C1' => 'Uraian Rekening',
            'D1' => 'Nama Kegiatan',
            'E1' => 'Uraian Kegiatan',
            'F1' => 'Uraian Jenis Barang',
            'G1' => 'Saldo Awal Unit',
            'H1' => 'Saldo Awal Harga Satuan',
            'I1' => 'Saldo Awal Total',
            'J1' => 'Mutasi Tambah Unit',
            'K1' => 'Mutasi Tambah Harga Satuan',
            'L1' => 'Mutasi Tambah Nilai Total',
            'M1' => 'Mutasi Kurang Unit',
            'N1' => 'Mutasi Kurang Nilai Total',
            'O1' => 'Saldo Akhir Unit',
            'P1' => 'Saldo Akhir Total',
        ];

        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Style headers
        $sheet->getStyle('A1:P1')->getFont()->setBold(true);
        $sheet->getStyle('A1:P1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:P1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Fill data
        $row = 2;
        foreach ($asetLancars as $index => $aset) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $aset->rekeningUraian->kode_rekening);
            $sheet->setCellValue('C' . $row, $aset->rekeningUraian->uraian);
            $sheet->setCellValue('D' . $row, $aset->nama_kegiatan);
            $sheet->setCellValue('E' . $row, $aset->uraian_kegiatan);
            $sheet->setCellValue('F' . $row, $aset->uraian_jenis_barang);
            $sheet->setCellValue('G' . $row, $aset->saldo_awal_unit);
            $sheet->setCellValue('H' . $row, $aset->saldo_awal_harga_satuan);
            $sheet->setCellValue('I' . $row, $aset->saldo_awal_total);
            $sheet->setCellValue('J' . $row, $aset->mutasi_tambah_unit);
            $sheet->setCellValue('K' . $row, $aset->mutasi_tambah_harga_satuan);
            $sheet->setCellValue('L' . $row, $aset->mutasi_tambah_nilai_total);
            $sheet->setCellValue('M' . $row, $aset->mutasi_kurang_unit);
            $sheet->setCellValue('N' . $row, $aset->mutasi_kurang_nilai_total);
            $sheet->setCellValue('O' . $row, $aset->saldo_akhir_unit);
            $sheet->setCellValue('P' . $row, $aset->saldo_akhir_total);

            // Apply borders to data rows
            $sheet->getStyle('A' . $row . ':P' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'P') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Format currency columns
        $currencyColumns = ['H', 'I', 'K', 'L', 'N', 'P'];
        foreach ($currencyColumns as $col) {
            $sheet->getStyle($col . '2:' . $col . ($row - 1))->getNumberFormat()->setFormatCode('#,##0.00');
        }

        $writer = new Xlsx($spreadsheet);

        $filename = 'aset_lancar_' . date('Y-m-d_H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    /**
     * Get rekening uraian data for AJAX
     */
    public function getRekeningUraian($id)
    {
        $rekening = RekeningUraian::find($id);

        if ($rekening) {
            return response()->json([
                'success' => true,
                'data' => $rekening
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ]);
    }
}
