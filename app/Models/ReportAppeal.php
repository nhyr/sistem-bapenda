<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportAppeal extends Model
{
    protected $fillable = [
        'report_id',
        'user_id',
        'alasan_banding',
        'lampiran_banding',
        'status',
        'catatan_admin',
        'reviewed_by',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'reviewed_at' => 'datetime',
        ];
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}