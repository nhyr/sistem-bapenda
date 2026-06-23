<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportAppeal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'tanggal_awal' => ['nullable', 'date'],
            'tanggal_akhir' => ['nullable', 'date', 'after_or_equal:tanggal_awal'],
            'jenis_laporan' => ['nullable', 'in:sistem,asset'],
        ]);

        $tanggalAwal = $request->filled('tanggal_awal')
            ? Carbon::parse($request->tanggal_awal)->startOfDay()
            : null;

        $tanggalAkhir = $request->filled('tanggal_akhir')
            ? Carbon::parse($request->tanggal_akhir)->endOfDay()
            : null;

        $jenisLaporan = $request->jenis_laporan;

        $baseQuery = Report::query()
            ->when($tanggalAwal, function ($query) use ($tanggalAwal) {
                $query->where('created_at', '>=', $tanggalAwal);
            })
            ->when($tanggalAkhir, function ($query) use ($tanggalAkhir) {
                $query->where('created_at', '<=', $tanggalAkhir);
            })
            ->when($jenisLaporan, function ($query) use ($jenisLaporan) {
                $query->where('jenis_laporan', $jenisLaporan);
            });

        $total = (clone $baseQuery)->count();
        $menunggu = (clone $baseQuery)->where('status', 'menunggu')->count();
        $diproses = (clone $baseQuery)->where('status', 'diproses')->count();
        $selesai = (clone $baseQuery)->where('status', 'selesai')->count();
        $ditolak = (clone $baseQuery)->where('status', 'ditolak')->count();

        $reports = (clone $baseQuery)
            ->with(['user', 'asset', 'teknisi'])
            ->whereIn('status', ['menunggu', 'diproses'])
            ->latest()
            ->take(10)
            ->get();

        $appealQuery = ReportAppeal::with(['report.user', 'user'])
            ->where('status', 'menunggu')
            ->whereHas('report', function ($query) use ($tanggalAwal, $tanggalAkhir, $jenisLaporan) {
                $query->where('status', 'ditolak')
                    ->when($tanggalAwal, function ($q) use ($tanggalAwal) {
                        $q->where('created_at', '>=', $tanggalAwal);
                    })
                    ->when($tanggalAkhir, function ($q) use ($tanggalAkhir) {
                        $q->where('created_at', '<=', $tanggalAkhir);
                    })
                    ->when($jenisLaporan, function ($q) use ($jenisLaporan) {
                        $q->where('jenis_laporan', $jenisLaporan);
                    });
            });

        $appeals = (clone $appealQuery)
            ->latest()
            ->take(5)
            ->get();

        $totalBanding = (clone $appealQuery)->count();

        $chartLabels = [
            'Menunggu',
            'Diproses',
            'Selesai',
            'Ditolak',
            'Banding Menunggu',
        ];

        $chartData = [
            $menunggu,
            $diproses,
            $selesai,
            $ditolak,
            $totalBanding,
        ];

        return view('admin.dashboard', compact(
            'total',
            'menunggu',
            'diproses',
            'selesai',
            'ditolak',
            'reports',
            'appeals',
            'totalBanding',
            'chartLabels',
            'chartData'
        ));
    }
}