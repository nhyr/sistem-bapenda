<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'asset_id',
        'admin_id',
        'teknisi_id',
        'jenis_laporan',
        'judul',
        'deskripsi',
        'nama_sistem',
        'url_sistem',
        'lokasi_kejadian',
        'foto_bukti',
        'prioritas',
        'status',
        'catatan_admin',
        'catatan_teknisi',
        'ditangani_pada',
        'tanggal_selesai',
    ];

    protected function casts(): array
    {
        return [
            'ditangani_pada' => 'datetime',
            'tanggal_selesai' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function histories()
    {
        return $this->hasMany(ReportHistory::class);
    }
    
    public function reportAppeals()
    {
        return $this->hasMany(ReportAppeal::class);
    }

    public function latestAppeal()
    {
        return $this->hasOne(ReportAppeal::class)->latestOfMany();
    }
}
