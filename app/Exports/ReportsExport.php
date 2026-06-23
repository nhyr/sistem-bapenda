<?php

namespace App\Exports;

use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected array $filters;
    protected int $no = 1;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return Report::with(['user', 'asset', 'teknisi'])
            ->when(!empty($this->filters['status']), function (Builder $query) {
                $query->where('status', $this->filters['status']);
            })
            ->when(!empty($this->filters['jenis_laporan']), function (Builder $query) {
                $query->where('jenis_laporan', $this->filters['jenis_laporan']);
            })
            ->when(!empty($this->filters['tanggal_awal']), function (Builder $query) {
                $query->where('created_at', '>=', Carbon::parse($this->filters['tanggal_awal'])->startOfDay());
            })
            ->when(!empty($this->filters['tanggal_akhir']), function (Builder $query) {
                $query->where('created_at', '<=', Carbon::parse($this->filters['tanggal_akhir'])->endOfDay());
            })
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Pelapor',
            'Unit Kerja',
            'Judul Laporan',
            'Deskripsi',
            'Jenis Laporan',
            'Prioritas',
            'Status',
            'Teknisi Ditugaskan',
            'Catatan Admin',
            'Catatan Teknisi',
            'Tanggal Laporan',
        ];
    }

    public function map($report): array
    {
        return [
            $this->no++,
            $report->user->name ?? '-',
            $report->user->unit_kerja ?? '-',
            $report->judul ?? '-',
            $report->deskripsi ?? '-',
            strtoupper($report->jenis_laporan ?? '-'),
            strtoupper($report->prioritas ?? '-'),
            ucfirst($report->status ?? '-'),
            $report->teknisi->name ?? '-',
            $report->catatan_admin ?? '-',
            $report->catatan_teknisi ?? '-',
            $report->created_at ? Carbon::parse($report->created_at)->format('d-m-Y H:i') : '-',
        ];
    }
}