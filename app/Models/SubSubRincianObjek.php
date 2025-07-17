<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubRincianObjek extends Model
{
    use HasFactory;

    protected $fillable = ['sub_rincian_objek_id', 'kode', 'nama_barang'];

    public function subRincianObjek()
    {
        return $this->belongsTo(SubRincianObjek::class);
    }
}
