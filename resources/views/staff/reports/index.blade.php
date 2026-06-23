@php
    use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <style>
    body {
        background: #f1f5f9;
    }

    .page-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #fee2e2, #fff7ed, #f8fafc);
        padding: 28px;
    }

    .page-container {
        max-width: 1280px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 230px 1fr;
        gap: 22px;
    }

    .sidebar {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 24px;
        padding: 24px 18px;
        min-height: 680px;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
    }

    .brand {
        font-size: 22px;
        font-weight: 900;
        margin-bottom: 36px;
        padding: 0 10px;
        color: #0f172a;
        letter-spacing: .5px;
    }

    .brand span {
        color: #ef4444;
    }

    .sidebar-menu {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 13px 14px;
        border-radius: 14px;
        color: #64748b;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        transition: .2s;
    }

    .sidebar-menu a:hover,
    .sidebar-menu a.active {
        background: #fee2e2;
        color: #dc2626;
    }

    .main {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 24px;
        padding: 26px;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
    }

    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
    }

    .topbar h1 {
        margin: 0;
        font-size: 26px;
        font-weight: 900;
        color: #0f172a;
    }

    .topbar p {
        margin: 6px 0 0;
        color: #64748b;
        font-size: 14px;
    }

    .btn-create {
        background: #ef4444;
        color: #ffffff;
        padding: 12px 18px;
        border-radius: 999px;
        text-decoration: none;
        font-weight: 900;
        font-size: 13px;
        box-shadow: 0 10px 20px rgba(239, 68, 68, 0.25);
        transition: .2s;
    }

    .btn-create:hover {
        background: #dc2626;
    }

    .filter-card {
        background: #fff7ed;
        border: 1px solid #fecaca;
        border-radius: 20px;
        padding: 18px;
        margin-bottom: 20px;
    }

    .filter-form {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-select {
        min-width: 170px;
        border: 1px solid #cbd5e1;
        border-radius: 14px;
        padding: 11px 14px;
        font-size: 13px;
        font-weight: 700;
        color: #334155;
        background: #ffffff;
        outline: none;
    }

    .filter-select:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.12);
    }

    .btn-filter {
        background: #ef4444;
        color: #ffffff;
        border: none;
        border-radius: 14px;
        padding: 11px 18px;
        font-size: 13px;
        font-weight: 900;
        cursor: pointer;
    }

    .btn-filter:hover {
        background: #dc2626;
    }

    .btn-reset {
        background: #ffffff;
        color: #991b1b;
        border: 1px solid #fecaca;
        border-radius: 14px;
        padding: 11px 18px;
        font-size: 13px;
        font-weight: 900;
        text-decoration: none;
    }

    .btn-reset:hover {
        background: #fee2e2;
    }

    .table-panel {
        border: 1px solid #e5e7eb;
        border-radius: 22px;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 14px 28px rgba(15, 23, 42, 0.06);
    }

    .table-panel-header {
        padding: 22px;
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
    }

    .table-panel-header h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 900;
        color: #0f172a;
    }

    .table-panel-header p {
        margin: 5px 0 0;
        color: #64748b;
        font-size: 13px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .light-table {
        width: 100%;
        border-collapse: collapse;
    }

    .light-table th {
        padding: 14px 18px;
        text-align: left;
        font-size: 11px;
        font-weight: 900;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: .7px;
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .light-table td {
        padding: 18px;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 14px;
        vertical-align: middle;
    }

    .light-table tr:hover td {
        background: #fff7ed;
    }

    .report-title {
        font-weight: 900;
        color: #0f172a;
        margin-bottom: 5px;
    }

    .report-desc {
        color: #64748b;
        font-size: 12px;
        line-height: 1.5;
    }

    .badge {
        display: inline-flex;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 900;
        white-space: nowrap;
    }

    .badge-type {
        background: #fee2e2;
        color: #b91c1c;
    }

    .badge-waiting {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-process {
        background: #ffedd5;
        color: #c2410c;
    }

    .badge-done {
        background: #dcfce7;
        color: #166534;
    }

    .badge-rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .btn-detail {
        background: #991b1b;
        color: #ffffff;
        padding: 9px 14px;
        border-radius: 999px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 800;
        display: inline-flex;
    }

    .btn-detail:hover {
        background: #7f1d1d;
    }

    .btn-delete {
        background: #ef4444;
        color: #ffffff;
        padding: 9px 14px;
        border-radius: 999px;
        border: none;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: #dc2626;
    }

    .action-wrapper {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
    }

    .empty-state {
        padding: 44px 20px;
        text-align: center;
        color: #64748b;
    }

    .empty-state .icon {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .empty-state strong {
        color: #0f172a;
        display: block;
        margin-bottom: 6px;
    }

    .pagination-wrapper {
        padding: 18px;
        border-top: 1px solid #e5e7eb;
    }

    @media (max-width: 1100px) {
        .page-container {
            grid-template-columns: 1fr;
        }

        .sidebar {
            min-height: auto;
        }

        .sidebar-menu {
            flex-direction: row;
            flex-wrap: wrap;
        }
    }

    @media (max-width: 640px) {
        .page-wrapper {
            padding: 16px;
        }

        .main {
            padding: 18px;
        }

        .topbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .filter-select,
        .btn-filter,
        .btn-reset,
        .btn-create {
            width: 100%;
            text-align: center;
        }

        .filter-form {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>

    <div class="page-wrapper">
        <div class="page-container">

            <aside class="sidebar">
                <div class="brand">
                    SIMON<span>ASET</span>
                </div>

                <nav class="sidebar-menu">
                    <a href="{{ route('staff.dashboard') }}">
                        <span>📊</span>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('staff.reports.create') }}">
                        <span>📝</span>
                        <span>Buat Laporan</span>
                    </a>

                    <a href="{{ route('staff.reports.index') }}" class="active">
                        <span>📁</span>
                        <span>Riwayat Laporan</span>
                    </a>

                    <a href="{{ route('profile.edit') }}">
                        <span>👤</span>
                        <span>Profile</span>
                    </a>
                </nav>
            </aside>

            <main class="main">
                <div class="topbar">
                    <div>
                        <h1>Riwayat Laporan</h1>
                        <p>Pantau seluruh laporan sistem dan aset yang sudah Anda kirim.</p>
                    </div>

                    <a href="{{ route('staff.reports.create') }}" class="btn-create">
                        + Buat Laporan
                    </a>
                </div>

                <div class="filter-card">
                    <form method="GET" action="{{ route('staff.reports.index') }}" class="filter-form">
                        <select name="status" class="filter-select">
                            <option value="">Semua Status</option>
                            <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>
                                Menunggu
                            </option>
                            <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>
                                Diproses
                            </option>
                            <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>
                            <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>
                                Ditolak
                            </option>
                        </select>

                        <select name="jenis_laporan" class="filter-select">
                            <option value="">Semua Jenis</option>
                            <option value="sistem" {{ request('jenis_laporan') === 'sistem' ? 'selected' : '' }}>
                                Sistem
                            </option>
                            <option value="asset" {{ request('jenis_laporan') === 'asset' ? 'selected' : '' }}>
                                Asset
                            </option>
                        </select>

                        <button type="submit" class="btn-filter">
                            Filter
                        </button>

                        <a href="{{ route('staff.reports.index') }}" class="btn-reset">
                            Reset
                        </a>
                    </form>
                </div>

                <div class="table-panel">
                    <div class="table-panel-header">
                        <h2>Daftar Riwayat Laporan</h2>
                        <p>Data laporan terbaru ditampilkan berdasarkan tanggal pengiriman.</p>
                    </div>

                    <div class="table-responsive">
                        <table class="light-table">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Jenis</th>
                                    <th>Prioritas</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th style="text-align: right;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($reports ?? [] as $report)
                                    <tr>
                                        <td>
                                            <div class="report-title">
                                                {{ $report->judul }}
                                            </div>

                                            <div class="report-desc">
                                                {{ Str::limit($report->deskripsi, 60) }}
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge badge-type">
                                                {{ strtoupper($report->jenis_laporan) }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ strtoupper($report->prioritas) }}
                                        </td>

                                        <td>
                                            @if ($report->status === 'menunggu')
                                                <span class="badge badge-waiting">Menunggu</span>
                                            @elseif ($report->status === 'diproses')
                                                <span class="badge badge-process">Diproses</span>
                                            @elseif ($report->status === 'selesai')
                                                <span class="badge badge-done">Selesai</span>
                                            @else
                                                <span class="badge badge-rejected">Ditolak</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $report->created_at->format('d-m-Y H:i') }}
                                        </td>

                                        <td style="text-align: right;">
                                            <div class="action-wrapper">
                                                <a
                                                    href="{{ route('staff.reports.show', $report) }}"
                                                    class="btn-detail"
                                                >
                                                    Detail
                                                </a>

                                                <form
                                                    action="{{ route('staff.reports.destroy', $report) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus laporan ini?')"
                                                    style="margin: 0;"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn-delete">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="empty-state">
                                                <div class="icon">📭</div>
                                                <strong>Belum ada laporan</strong>
                                                <p>Laporan yang Anda kirim akan muncul di sini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if (method_exists($reports, 'links'))
                        <div class="pagination-wrapper">
                            {{ $reports->links() }}
                        </div>
                    @endif
                </div>
            </main>

        </div>
    </div>
</x-app-layout>