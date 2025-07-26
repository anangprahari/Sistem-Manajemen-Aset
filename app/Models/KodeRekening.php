<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeRekening extends Model
{
    use HasFactory;

    protected $fillable = [
        'akun',
        'kelompok',
        'jenis',
        'objek',
        'nomor',
        'kode_lengkap',
        'uraian'
    ];

    /**
     * Relasi dengan AsetLancar
     */
    public function asetLancars()
    {
        return $this->hasMany(AsetLancar::class);
    }

    /**
     * Scope untuk mendapatkan akun unik
     */
    public function scopeDistinctAkun($query)
    {
        return $query->select('akun')->distinct();
    }

    /**
     * Scope untuk mendapatkan kelompok berdasarkan akun
     */
    public function scopeKelompokByAkun($query, $akun)
    {
        return $query->select('kelompok')->where('akun', $akun)->distinct();
    }

    /**
     * Scope untuk mendapatkan jenis berdasarkan akun dan kelompok
     */
    public function scopeJenisByAkunKelompok($query, $akun, $kelompok)
    {
        return $query->select('jenis')
            ->where('akun', $akun)
            ->where('kelompok', $kelompok)
            ->distinct();
    }

    /**
     * Scope untuk mendapatkan objek berdasarkan akun, kelompok, dan jenis
     */
    public function scopeObjekByAkunKelompokJenis($query, $akun, $kelompok, $jenis)
    {
        return $query->select('objek')
            ->where('akun', $akun)
            ->where('kelompok', $kelompok)
            ->where('jenis', $jenis)
            ->distinct();
    }

    /**
     * Scope untuk mendapatkan nomor rekening lengkap berdasarkan filter
     */
    public function scopeNomorByFilter($query, $akun, $kelompok, $jenis, $objek)
    {
        return $query->select('id', 'nomor', 'kode_lengkap', 'uraian')
            ->where('akun', $akun)
            ->where('kelompok', $kelompok)
            ->where('jenis', $jenis)
            ->where('objek', $objek);
    }

    /**
     * Accessor untuk menampilkan nama akun
     */
    public function getNamaAkunAttribute()
    {
        $namaAkun = [
            '1' => 'ASET',
            '2' => 'KEWAJIBAN',
            '3' => 'EKUITAS',
            '4' => 'PENDAPATAN',
            '5' => 'BEBAN'
        ];

        return $namaAkun[$this->akun] ?? 'Unknown';
    }

    /**
     * Accessor untuk menampilkan nama kelompok
     */
    public function getNamaKelompokAttribute()
    {
        $namaKelompok = [
            '01' => 'ASET LANCAR',
            '02' => 'ASET TIDAK LANCAR',
            '03' => 'ASET LAINNYA'
        ];

        return $namaKelompok[$this->kelompok] ?? 'Unknown';
    }

    /**
     * Accessor untuk menampilkan nama jenis
     */
    public function getNamaJenisAttribute()
    {
        $namaJenis = [
            '01' => 'KAS DAN BANK',
            '02' => 'INVESTASI JANGKA PENDEK',
            '06' => 'PIUTANG',
            '07' => 'PERSEDIAAN'
        ];

        return $namaJenis[$this->jenis] ?? 'Unknown';
    }

    /**
     * Accessor untuk menampilkan nama objek
     */
    public function getNamaObjekAttribute()
    {
        $namaObjek = [
            '01' => 'BARANG PAKAI HABIS',
            '02' => 'BARANG DALAM PROSES',
            '03' => 'BARANG JADI'
        ];

        return $namaObjek[$this->objek] ?? 'Unknown';
    }
}
