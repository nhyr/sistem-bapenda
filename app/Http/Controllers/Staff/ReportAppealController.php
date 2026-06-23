<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportAppeal;
use Illuminate\Http\Request;

class ReportAppealController extends Controller
{
    public function create(Report $report)
    {
        abort_unless($report->user_id === auth()->id(), 403);

        if ($report->status !== 'ditolak') {
            return redirect()
                ->route('staff.reports.show', $report)
                ->with('error', 'Banding hanya dapat diajukan untuk laporan yang ditolak.');
        }

        $hasPendingAppeal = $report->reportAppeals()
            ->where('status', 'menunggu')
            ->exists();

        if ($hasPendingAppeal) {
            return redirect()
                ->route('staff.reports.show', $report)
                ->with('error', 'Banding untuk laporan ini masih menunggu keputusan admin.');
        }

        return view('staff.reports.appeal', compact('report'));
    }

    public function store(Request $request, Report $report)
    {
        abort_unless($report->user_id === auth()->id(), 403);

        if ($report->status !== 'ditolak') {
            return redirect()
                ->route('staff.reports.show', $report)
                ->with('error', 'Banding hanya dapat diajukan untuk laporan yang ditolak.');
        }

        $hasPendingAppeal = $report->reportAppeals()
            ->where('status', 'menunggu')
            ->exists();

        if ($hasPendingAppeal) {
            return redirect()
                ->route('staff.reports.show', $report)
                ->with('error', 'Banding untuk laporan ini masih menunggu keputusan admin.');
        }

        $validated = $request->validate([
            'alasan_banding' => ['required', 'string', 'min:10'],
            'lampiran_banding' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:2048'],
        ], [
            'alasan_banding.required' => 'Alasan banding wajib diisi.',
            'alasan_banding.min' => 'Alasan banding minimal 10 karakter.',
            'lampiran_banding.mimes' => 'Lampiran harus berupa JPG, JPEG, PNG, WEBP, atau PDF.',
            'lampiran_banding.max' => 'Ukuran lampiran maksimal 2MB.',
        ]);

        if ($request->hasFile('lampiran_banding')) {
            $validated['lampiran_banding'] = $request
                ->file('lampiran_banding')
                ->store('appeals', 'public');
        }

        ReportAppeal::create([
            'report_id' => $report->id,
            'user_id' => auth()->id(),
            'alasan_banding' => $validated['alasan_banding'],
            'lampiran_banding' => $validated['lampiran_banding'] ?? null,
            'status' => 'menunggu',
        ]);

        return redirect()
            ->route('staff.reports.show', $report)
            ->with('success', 'Banding berhasil diajukan dan menunggu keputusan admin.');
    }
}