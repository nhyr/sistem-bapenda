<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = Report::with(['asset', 'admin', 'teknisi'])
            ->where('user_id', auth()->id())
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('jenis_laporan'), function ($query) use ($request) {
                $query->where('jenis_laporan', $request->jenis_laporan);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('staff.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('staff.reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_laporan' => ['required', 'in:sistem,asset'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'nama_sistem' => ['nullable', 'string', 'max:255'],
            'lokasi_kejadian' => ['nullable', 'string', 'max:255'],
            'prioritas' => ['required', 'in:rendah,sedang,tinggi'],
            'foto_bukti' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'foto_bukti.required' => 'Foto bukti wajib diunggah.',
            'foto_bukti.image' => 'File bukti harus berupa gambar.',
            'foto_bukti.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto_bukti.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        if ($request->hasFile('foto_bukti')) {
            $validated['foto_bukti'] = $request->file('foto_bukti')->store('reports', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'menunggu';

        Report::create($validated);

        return redirect()
            ->route('staff.dashboard')
            ->with('success', 'Laporan berhasil dikirim.');
    }

    public function show(Report $report)
    {
        abort_unless($report->user_id === auth()->id(), 403);

        $report->load([
            'asset',
            'admin',
            'teknisi',
            'histories.user',
            'reportAppeals.admin',
        ]);

        return view('staff.reports.show', compact('report'));
    }

    public function destroy(Report $report)
    {
        abort_unless($report->user_id === auth()->id(), 403);

        if ($report->foto_bukti && Storage::disk('public')->exists($report->foto_bukti)) {
            Storage::disk('public')->delete($report->foto_bukti);
        }

        $report->delete();

        return redirect()
            ->route('staff.dashboard')
            ->with('success', 'Laporan berhasil dihapus.');
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
