<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $baseReports = Report::where('user_id', auth()->id());

        $reports = Report::with('asset')
            ->where('user_id', auth()->id())
            ->whereDate('created_at', today())
            ->when($request->filled('jenis_laporan'), function ($query) use ($request) {
                $query->where('jenis_laporan', $request->jenis_laporan);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->get();

        return view('staff.dashboard', [
            'total' => (clone $baseReports)->count(),
            'menunggu' => (clone $baseReports)->where('status', 'menunggu')->count(),
            'diproses' => (clone $baseReports)->where('status', 'diproses')->count(),
            'selesai' => (clone $baseReports)->where('status', 'selesai')->count(),
            'ditolak' => (clone $baseReports)->where('status', 'ditolak')->count(),
            'reports' => $reports,
        ]);
    }
}