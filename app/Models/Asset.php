<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'kode_asset',
        'nama_asset',
        'kategori',
        'lokasi',
        'keterangan',
        'kondisi',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
