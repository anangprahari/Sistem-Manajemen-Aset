<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsetLancar extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_rekening_id',
        'uraian_barang',
        'nama_kegiatan',
        'uraian_kegiatan',
        'uraian_jenis_barang',
        'saldo_awal_unit',
        'saldo_awal_harga_satuan',
        'saldo_awal_total',
        'mutasi_tambah_unit',
        'mutasi_tambah_harga',
        'mutasi_tambah_nilai',
        'mutasi_kurang_unit',
        'mutasi_kurang_nilai',
        'saldo_akhir_unit',
        'saldo_akhir_total'
    ];

    protected $casts = [
        'saldo_awal_harga_satuan' => 'decimal:2',
        'saldo_awal_total' => 'decimal:2',
        'mutasi_tambah_harga' => 'decimal:2',
        'mutasi_tambah_nilai' => 'decimal:2',
        'mutasi_kurang_nilai' => 'decimal:2',
        'saldo_akhir_total' => 'decimal:2'
    ];

    /**
     * Relasi dengan KodeRekening
     */
    public function kodeRekening()
    {
        return $this->belongsTo(KodeRekening::class);
    }

    /**
     * Mutator untuk menghitung saldo awal total otomatis
     */
    public function setSaldoAwalUnitAttribute($value)
    {
        $this->attributes['saldo_awal_unit'] = $value;
        $this->calculateSaldoAwalTotal();
    }

    public function setSaldoAwalHargaSatuanAttribute($value)
    {
        $this->attributes['saldo_awal_harga_satuan'] = $value;
        $this->calculateSaldoAwalTotal();
    }

    /**
     * Mutator untuk menghitung mutasi tambah nilai otomatis
     */
    public function setMutasiTambahUnitAttribute($value)
    {
        $this->attributes['mutasi_tambah_unit'] = $value;
        $this->calculateMutasiTambahNilai();
    }

    public function setMutasiTambahHargaAttribute($value)
    {
        $this->attributes['mutasi_tambah_harga'] = $value;
        $this->calculateMutasiTambahNilai();
    }

    /**
     * Method untuk menghitung saldo awal total
     */
    private function calculateSaldoAwalTotal()
    {
        if (isset($this->attributes['saldo_awal_unit']) && isset($this->attributes['saldo_awal_harga_satuan'])) {
            $this->attributes['saldo_awal_total'] = $this->attributes['saldo_awal_unit'] * $this->attributes['saldo_awal_harga_satuan'];
        }
    }

    /**
     * Method untuk menghitung mutasi tambah nilai
     */
    private function calculateMutasiTambahNilai()
    {
        if (isset($this->attributes['mutasi_tambah_unit']) && isset($this->attributes['mutasi_tambah_harga'])) {
            $this->attributes['mutasi_tambah_nilai'] = $this->attributes['mutasi_tambah_unit'] * $this->attributes['mutasi_tambah_harga'];
        }
    }

    /**
     * Method untuk menghitung saldo akhir
     */
    public function calculateSaldoAkhir()
    {
        // Hitung unit saldo akhir
        $this->saldo_akhir_unit = $this->saldo_awal_unit + $this->mutasi_tambah_unit - $this->mutasi_kurang_unit;

        // Hitung total saldo akhir
        $this->saldo_akhir_total = $this->saldo_awal_total + $this->mutasi_tambah_nilai - $this->mutasi_kurang_nilai;

        $this->save();
    }

    /**
     * Accessor untuk format currency
     */
    public function getFormattedSaldoAwalTotalAttribute()
    {
        return number_format($this->saldo_awal_total, 2, ',', '.');
    }

    public function getFormattedMutasiTambahNilaiAttribute()
    {
        return number_format($this->mutasi_tambah_nilai, 2, ',', '.');
    }

    public function getFormattedMutasiKurangNilaiAttribute()
    {
        return number_format($this->mutasi_kurang_nilai, 2, ',', '.');
    }

    public function getFormattedSaldoAkhirTotalAttribute()
    {
        return number_format($this->saldo_akhir_total, 2, ',', '.');
    }
}
