<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use App\Models\Jenis;
use App\Models\Objek;
use App\Models\RincianObjek;
use App\Models\SubRincianObjek;
use App\Models\SubSubRincianObjek;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DropdownController extends Controller
{
    /**
     * Get Kelompok berdasarkan Akun ID
     */
    public function getKelompok($akun_id)
    {
        try {
            Log::info('Getting Kelompok for akun_id: ' . $akun_id);

            // Validate akun_id exists
            if (!Akun::where('id', $akun_id)->exists()) {
                Log::error('Akun not found with id: ' . $akun_id);
                return response()->json([
                    'error' => 'Akun tidak ditemukan',
                    'message' => 'Akun dengan ID ' . $akun_id . ' tidak ditemukan'
                ], 404);
            }

            $kelompoks = Kelompok::where('akun_id', $akun_id)
                ->select('id', 'kode', 'nama')
                ->orderBy('kode')
                ->get();

            Log::info('Found ' . $kelompoks->count() . ' kelompoks for akun_id: ' . $akun_id);

            // Return empty array if no data found (not error)
            return response()->json($kelompoks->toArray());
        } catch (\Exception $e) {
            Log::error('Error getting kelompok: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'error' => 'Gagal mengambil data kelompok',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get Jenis berdasarkan Kelompok ID
     */
    public function getJenis($kelompok_id)
    {
        try {
            Log::info('Getting Jenis for kelompok_id: ' . $kelompok_id);

            // Validate kelompok_id exists
            if (!Kelompok::where('id', $kelompok_id)->exists()) {
                Log::error('Kelompok not found with id: ' . $kelompok_id);
                return response()->json([
                    'error' => 'Kelompok tidak ditemukan',
                    'message' => 'Kelompok dengan ID ' . $kelompok_id . ' tidak ditemukan'
                ], 404);
            }

            $jenis = Jenis::where('kelompok_id', $kelompok_id)
                ->select('id', 'kode', 'nama')
                ->orderBy('kode')
                ->get();

            Log::info('Found ' . $jenis->count() . ' jenis for kelompok_id: ' . $kelompok_id);

            return response()->json($jenis->toArray());
        } catch (\Exception $e) {
            Log::error('Error getting jenis: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'error' => 'Gagal mengambil data jenis',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get Objek berdasarkan Jenis ID
     */
    public function getObjek($jenis_id)
    {
        try {
            Log::info('Getting Objek for jenis_id: ' . $jenis_id);

            // Validate jenis_id exists
            if (!Jenis::where('id', $jenis_id)->exists()) {
                Log::error('Jenis not found with id: ' . $jenis_id);
                return response()->json([
                    'error' => 'Jenis tidak ditemukan',
                    'message' => 'Jenis dengan ID ' . $jenis_id . ' tidak ditemukan'
                ], 404);
            }

            $objeks = Objek::where('jenis_id', $jenis_id)
                ->select('id', 'kode', 'nama')
                ->orderBy('kode')
                ->get();

            Log::info('Found ' . $objeks->count() . ' objeks for jenis_id: ' . $jenis_id);

            return response()->json($objeks->toArray());
        } catch (\Exception $e) {
            Log::error('Error getting objek: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'error' => 'Gagal mengambil data objek',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get Rincian Objek berdasarkan Objek ID
     */
    public function getRincianObjek($objek_id)
    {
        try {
            Log::info('Getting RincianObjek for objek_id: ' . $objek_id);

            // Validate objek_id exists
            if (!Objek::where('id', $objek_id)->exists()) {
                Log::error('Objek not found with id: ' . $objek_id);
                return response()->json([
                    'error' => 'Objek tidak ditemukan',
                    'message' => 'Objek dengan ID ' . $objek_id . ' tidak ditemukan'
                ], 404);
            }

            $rincianObjeks = RincianObjek::where('objek_id', $objek_id)
                ->select('id', 'kode', 'nama')
                ->orderBy('kode')
                ->get();

            Log::info('Found ' . $rincianObjeks->count() . ' rincian objeks for objek_id: ' . $objek_id);

            return response()->json($rincianObjeks->toArray());
        } catch (\Exception $e) {
            Log::error('Error getting rincian objek: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'error' => 'Gagal mengambil data rincian objek',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get Sub Rincian Objek berdasarkan Rincian Objek ID
     */
    public function getSubRincianObjek($rincian_objek_id)
    {
        try {
            Log::info('Getting SubRincianObjek for rincian_objek_id: ' . $rincian_objek_id);

            // Validate rincian_objek_id exists
            if (!RincianObjek::where('id', $rincian_objek_id)->exists()) {
                Log::error('RincianObjek not found with id: ' . $rincian_objek_id);
                return response()->json([
                    'error' => 'Rincian Objek tidak ditemukan',
                    'message' => 'Rincian Objek dengan ID ' . $rincian_objek_id . ' tidak ditemukan'
                ], 404);
            }

            $subRincianObjeks = SubRincianObjek::where('rincian_objek_id', $rincian_objek_id)
                ->select('id', 'kode', 'nama')
                ->orderBy('kode')
                ->get();

            Log::info('Found ' . $subRincianObjeks->count() . ' sub rincian objeks for rincian_objek_id: ' . $rincian_objek_id);

            return response()->json($subRincianObjeks->toArray());
        } catch (\Exception $e) {
            Log::error('Error getting sub rincian objek: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'error' => 'Gagal mengambil data sub rincian objek',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get Sub Sub Rincian Objek berdasarkan Sub Rincian Objek ID (Level 7)
     */
    public function getSubSubRincianObjek($sub_rincian_objek_id)
    {
        try {
            Log::info('Getting SubSubRincianObjek for sub_rincian_objek_id: ' . $sub_rincian_objek_id);

            // Validate sub_rincian_objek_id exists
            if (!SubRincianObjek::where('id', $sub_rincian_objek_id)->exists()) {
                Log::error('SubRincianObjek not found with id: ' . $sub_rincian_objek_id);
                return response()->json([
                    'error' => 'Sub Rincian Objek tidak ditemukan',
                    'message' => 'Sub Rincian Objek dengan ID ' . $sub_rincian_objek_id . ' tidak ditemukan'
                ], 404);
            }

            $subSubRincianObjeks = SubSubRincianObjek::where('sub_rincian_objek_id', $sub_rincian_objek_id)
                ->select('id', 'kode', 'nama_barang')
                ->orderBy('kode')
                ->get();

            Log::info('Found ' . $subSubRincianObjeks->count() . ' sub sub rincian objeks for sub_rincian_objek_id: ' . $sub_rincian_objek_id);

            return response()->json($subSubRincianObjeks->toArray());
        } catch (\Exception $e) {
            Log::error('Error getting sub sub rincian objek: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'error' => 'Gagal mengambil data sub sub rincian objek',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Health check untuk API
     */
    public function healthCheck()
    {
        try {
            // Test database connection
            DB::connection()->getPdo();

            // Test model connections
            $akunCount = Akun::count();
            $kelompokCount = Kelompok::count();

            return response()->json([
                'status' => 'OK',
                'timestamp' => now(),
                'message' => 'Dropdown API is working',
                'database' => 'Connected',
                'data_counts' => [
                    'akun' => $akunCount,
                    'kelompok' => $kelompokCount
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Health check failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'ERROR',
                'timestamp' => now(),
                'message' => 'Dropdown API has issues',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Test endpoint untuk debugging
     */
    public function testData()
    {
        try {
            $akuns = Akun::select('id', 'kode', 'nama')->limit(5)->get();
            $kelompoks = Kelompok::select('id', 'kode', 'nama', 'akun_id')->limit(5)->get();

            return response()->json([
                'status' => 'OK',
                'test_data' => [
                    'akuns' => $akuns,
                    'kelompoks' => $kelompoks
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Test data failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'ERROR',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
