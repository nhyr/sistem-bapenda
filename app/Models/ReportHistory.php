<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportHistory extends Model
{
    protected $fillable = [
        'report_id',
        'user_id',
        'status_sebelumnya',
        'status_baru',
        'catatan',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
