<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportHistory;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with(['user', 'asset'])
            ->where('teknisi_id', auth()->id())
            ->where('status', 'selesai')
            ->latest()
            ->paginate(10);

        return view('teknisi.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        abort_unless($report->teknisi_id === auth()->id(), 403);

        $report->load([
            'user',
            'asset',
            'admin',
            'histories.user',
        ]);

        return view('teknisi.reports.show', compact('report'));
    }

    public function updateProgress(Request $request, Report $report)
    {
        abort_unless($report->teknisi_id === auth()->id(), 403);

        if ($report->status === 'selesai') {
            return redirect()
                ->route('teknisi.reports.index')
                ->with('success', 'Laporan ini sudah selesai.');
        }

        $validated = $request->validate([
            'catatan_teknisi' => ['required', 'string'],
        ]);

        $statusLama = $report->status;

        $report->update([
            'status' => 'selesai',
            'catatan_teknisi' => $validated['catatan_teknisi'],
            'ditangani_pada' => now(),
            'tanggal_selesai' => now(),
        ]);

        ReportHistory::create([
            'report_id' => $report->id,
            'user_id' => auth()->id(),
            'status_sebelumnya' => $statusLama,
            'status_baru' => 'selesai',
            'catatan' => $validated['catatan_teknisi'],
        ]);

        return redirect()
            ->route('teknisi.reports.index')
            ->with('success', 'Laporan berhasil ditanggapi dan diselesaikan.');
    }
}