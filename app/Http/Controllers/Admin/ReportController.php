<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReportsExport;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'status' => ['nullable', 'in:menunggu,diproses,selesai,ditolak'],
            'jenis_laporan' => ['nullable', 'in:sistem,asset'],
            'periode' => ['nullable', 'in:minggu_ini,bulan_ini,custom'],
            'tanggal_awal' => ['nullable', 'date'],
            'tanggal_akhir' => ['nullable', 'date', 'after_or_equal:tanggal_awal'],
        ]);

        $filters = $this->resolveReportFilters($request);

        $reports = Report::with(['user', 'asset', 'teknisi'])
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('jenis_laporan'), function ($query) use ($request) {
                $query->where('jenis_laporan', $request->jenis_laporan);
            })
            ->when(!empty($filters['tanggal_awal']), function ($query) use ($filters) {
                $query->where('created_at', '>=', Carbon::parse($filters['tanggal_awal'])->startOfDay());
            })
            ->when(!empty($filters['tanggal_akhir']), function ($query) use ($filters) {
                $query->where('created_at', '<=', Carbon::parse($filters['tanggal_akhir'])->endOfDay());
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        $report->load([
            'user',
            'asset',
            'admin',
            'teknisi',
            'histories.user',
            'latestAppeal.user',
            'latestAppeal.admin',
        ]);

        $kategoriTeknisi = $report->jenis_laporan === 'sistem' ? 'sistem' : 'barang';

        $teknisis = User::where('role', 'teknisi')
            ->where('kategori_teknisi', $kategoriTeknisi)
            ->orderBy('name')
            ->get();

        return view('admin.reports.show', compact('report', 'teknisis'));
    }

    public function updateStatus(Request $request, Report $report)
    {
        $kategoriTeknisi = $report->jenis_laporan === 'sistem' ? 'sistem' : 'barang';

        $validated = $request->validate([
            /*
            |--------------------------------------------------------------------------
            | Status laporan
            |--------------------------------------------------------------------------
            | Pada alur sistem ini, admin hanya memproses atau menolak laporan.
            | Status selesai dilakukan oleh teknisi setelah penanganan selesai.
            */
            'status' => ['required', 'in:menunggu,diproses,ditolak'],

            'catatan_admin' => ['nullable', 'string'],

            /*
            |--------------------------------------------------------------------------
            | Validasi teknisi
            |--------------------------------------------------------------------------
            | Teknisi yang dapat dipilih harus role teknisi dan kategorinya sesuai:
            | - laporan sistem  -> teknisi sistem
            | - laporan asset   -> teknisi barang
            */
            'teknisi_id' => [
                'nullable',
                Rule::exists('users', 'id')->where(function ($query) use ($kategoriTeknisi) {
                    $query->where('role', 'teknisi')
                        ->where('kategori_teknisi', $kategoriTeknisi);
                }),
            ],
        ]);

        $statusLama = $report->status;

        $report->update([
            'status' => $validated['status'],
            'catatan_admin' => $validated['catatan_admin'] ?? null,
            'teknisi_id' => $validated['status'] === 'ditolak'
                ? null
                : ($validated['teknisi_id'] ?? null),
            'admin_id' => auth()->id(),
            'tanggal_selesai' => null,
        ]);

        ReportHistory::create([
            'report_id' => $report->id,
            'user_id' => auth()->id(),
            'status_sebelumnya' => $statusLama,
            'status_baru' => $validated['status'],
            'catatan' => $validated['catatan_admin'] ?? null,
        ]);

        return back()->with('success', 'Tanggapan laporan berhasil disimpan.');
    }

    public function export(Request $request)
    {
        $request->validate([
            'status' => ['nullable', 'in:menunggu,diproses,selesai,ditolak'],
            'jenis_laporan' => ['nullable', 'in:sistem,asset'],
            'periode' => ['nullable', 'in:minggu_ini,bulan_ini,custom'],
            'tanggal_awal' => ['nullable', 'date'],
            'tanggal_akhir' => ['nullable', 'date', 'after_or_equal:tanggal_awal'],
        ]);

        $filters = $this->resolveReportFilters($request);

        $filters['status'] = $request->status;
        $filters['jenis_laporan'] = $request->jenis_laporan;

        $fileName = 'riwayat-laporan-masuk-' . now()->format('Y-m-d-H-i-s') . '.xlsx';

        return Excel::download(new ReportsExport($filters), $fileName);
    }

    private function resolveReportFilters(Request $request): array
    {
        $periode = $request->periode;

        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        if ($periode === 'minggu_ini') {
            $tanggalAwal = now()->startOfWeek()->format('Y-m-d');
            $tanggalAkhir = now()->endOfWeek()->format('Y-m-d');
        }

        if ($periode === 'bulan_ini') {
            $tanggalAwal = now()->startOfMonth()->format('Y-m-d');
            $tanggalAkhir = now()->endOfMonth()->format('Y-m-d');
        }

        return [
            'tanggal_awal' => $tanggalAwal,
            'tanggal_akhir' => $tanggalAkhir,
        ];
    }
}