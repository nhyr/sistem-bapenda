<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReportAppeal;
use App\Models\ReportHistory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReportAppealController extends Controller
{
    public function review(Request $request, ReportAppeal $appeal)
    {
        if ($appeal->status !== 'menunggu') {
            return back()->with('error', 'Banding ini sudah diproses sebelumnya.');
        }

        $validated = $request->validate([
            'status' => ['required', Rule::in(['diterima', 'ditolak'])],
            'catatan_admin' => ['nullable', 'string'],
        ]);

        $report = $appeal->report;
        $statusLama = $report->status;

        $appeal->update([
            'status' => $validated['status'],
            'catatan_admin' => $validated['catatan_admin'] ?? null,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        if ($validated['status'] === 'diterima') {
            $report->update([
                'status' => 'menunggu',
                'admin_id' => auth()->id(),
                'catatan_admin' => $validated['catatan_admin'] ?? 'Banding diterima. Laporan akan diproses ulang.',
                'teknisi_id' => null,
                'tanggal_selesai' => null,
            ]);

            ReportHistory::create([
                'report_id' => $report->id,
                'user_id' => auth()->id(),
                'status_sebelumnya' => $statusLama,
                'status_baru' => 'menunggu',
                'catatan' => $validated['catatan_admin'] ?? 'Banding diterima. Laporan dikembalikan ke status menunggu.',
            ]);
        }

        if ($validated['status'] === 'ditolak') {
            ReportHistory::create([
                'report_id' => $report->id,
                'user_id' => auth()->id(),
                'status_sebelumnya' => $statusLama,
                'status_baru' => 'ditolak',
                'catatan' => $validated['catatan_admin'] ?? 'Banding ditolak oleh admin.',
            ]);
        }

        return redirect()
            ->route('admin.reports.show', $report)
            ->with('success', 'Banding berhasil diproses.');
    }
}