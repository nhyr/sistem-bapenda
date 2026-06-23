<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Report;

class DashboardController extends Controller
{
    public function index()
    {
        $baseReports = Report::where('teknisi_id', auth()->id());

        $reports = Report::with(['user', 'asset'])
            ->where('teknisi_id', auth()->id())
            ->whereIn('status', ['menunggu', 'diproses'])
            ->latest()
            ->get();

        return view('teknisi.dashboard', [
            'total' => (clone $baseReports)->count(),
            'diproses' => (clone $baseReports)->where('status', 'diproses')->count(),
            'selesai' => (clone $baseReports)->where('status', 'selesai')->count(),
            'reports' => $reports,
        ]);
    }
}