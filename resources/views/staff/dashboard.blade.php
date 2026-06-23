@php
    use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <style>
        body {
            background: #f1f5f9;
        }

        .dashboard-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #fee2e2, #fff7ed, #f8fafc);
            padding: 28px;
        }

        .dashboard-container {
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
            color: #111827;
            min-height: 680px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
        }

        .brand {
            font-size: 22px;
            font-weight: 900;
            margin-bottom: 36px;
            padding: 0 10px;
            letter-spacing: .5px;
            color: #0f172a;
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
            color: #111827;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 16px;
            border-radius: 14px;
            margin-bottom: 18px;
            font-weight: 700;
            border: 1px solid #bbf7d0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            gap: 16px;
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
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: .2s;
            box-shadow: 0 10px 20px rgba(239, 68, 68, 0.25);
            white-space: nowrap;
        }

        .btn-create:hover {
            background: #dc2626;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }

        .stat-card {
            position: relative;
            border-radius: 22px;
            padding: 20px;
            min-height: 130px;
            overflow: hidden;
            box-shadow: 0 14px 28px rgba(15, 23, 42, 0.08);
        }

        .stat-card small {
            display: block;
            font-size: 13px;
            font-weight: 800;
            opacity: .9;
        }

        .stat-card h3 {
            margin: 22px 0 0;
            font-size: 34px;
            line-height: 1;
            font-weight: 900;
        }

        .stat-icon {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, .35);
            font-size: 20px;
        }

        .card-blue {
            background: linear-gradient(135deg, #dc2626, #f87171);
            color: #ffffff;
        }

        .card-yellow {
            background: linear-gradient(135deg, #f97316, #fdba74);
            color: #7c2d12;
        }

        .card-cyan {
            background: linear-gradient(135deg, #fb7185, #fecdd3);
            color: #881337;
        }

        .card-green {
            background: linear-gradient(135deg, #22c55e, #86efac);
            color: #064e3b;
        }

        .card-red {
            background: linear-gradient(135deg, #991b1b, #ef4444);
            color: #ffffff;
        }

        .table-panel {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 14px 28px rgba(15, 23, 42, 0.06);
        }

        .table-panel-header {
            padding: 22px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            flex-wrap: wrap;
            border-bottom: 1px solid #e5e7eb;
            background: #f8fafc;
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

        .filter-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-select {
            border: 1px solid #cbd5e1;
            border-radius: 999px;
            padding: 9px 14px;
            font-size: 12px;
            font-weight: 700;
            color: #334155;
            background: #ffffff;
            outline: none;
        }

        .filter-select:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
        }

        .btn-filter {
            background: #ef4444;
            color: #ffffff;
            border: none;
            border-radius: 999px;
            padding: 9px 16px;
            font-size: 12px;
            font-weight: 900;
            cursor: pointer;
        }

        .btn-filter:hover {
            background: #dc2626;
        }

        .btn-reset {
            background: #fff7ed;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-radius: 999px;
            padding: 9px 16px;
            font-size: 12px;
            font-weight: 900;
            text-decoration: none;
        }

        .btn-reset:hover {
            background: #fee2e2;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .light-table {
            width: 100%;
            border-collapse: collapse;
        }

        .light-table th {
            color: #64748b;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .7px;
            font-weight: 800;
            padding: 14px 22px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            background: #f8fafc;
            white-space: nowrap;
        }

        .light-table td {
            padding: 18px 22px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 14px;
            vertical-align: middle;
        }

        .light-table tr:hover td {
            background: #fff7ed;
        }

        .report-title {
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 5px;
        }

        .report-desc {
            color: #64748b;
            font-size: 12px;
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

        .action-wrapper {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 8px;
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

        @media (max-width: 1100px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                min-height: auto;
            }

            .sidebar-menu {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .dashboard-page {
                padding: 16px;
            }

            .main {
                padding: 18px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .table-panel-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-form {
                width: 100%;
            }

            .filter-select,
            .btn-filter,
            .btn-reset {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <div class="dashboard-page">
        <div class="dashboard-container">

            <aside class="sidebar">
                <div class="brand">
                    BAPEN<span>DA</span>
                </div>

                <nav class="sidebar-menu">
                    <a href="{{ route('staff.dashboard') }}" class="active">
                        <span>📊</span>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('staff.reports.create') }}">
                        <span>📝</span>
                        <span>Buat Laporan</span>
                    </a>

                    <a href="{{ route('staff.reports.index') }}">
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
                @if (session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="topbar">
                    <div>
                        <h1>Dashboard Staff</h1>
                        <p>Pantau status laporan sistem dan aset Bapenda.</p>
                    </div>

                    <a href="{{ route('staff.reports.create') }}" class="btn-create">
                        + Buat Laporan
                    </a>
                </div>

                <div class="stats">
                    <div class="stat-card card-blue">
                        <div class="stat-icon">📄</div>
                        <small>Total Laporan</small>
                        <h3>{{ $total ?? 0 }}</h3>
                    </div>

                    <div class="stat-card card-yellow">
                        <div class="stat-icon">⏳</div>
                        <small>Menunggu</small>
                        <h3>{{ $menunggu ?? 0 }}</h3>
                    </div>

                    <div class="stat-card card-cyan">
                        <div class="stat-icon">🔧</div>
                        <small>Diproses</small>
                        <h3>{{ $diproses ?? 0 }}</h3>
                    </div>

                    <div class="stat-card card-green">
                        <div class="stat-icon">✓</div>
                        <small>Selesai</small>
                        <h3>{{ $selesai ?? 0 }}</h3>
                    </div>

                    <div class="stat-card card-red">
                        <div class="stat-icon">✕</div>
                        <small>Ditolak</small>
                        <h3>{{ $ditolak ?? 0 }}</h3>
                    </div>
                </div>

                <div class="table-panel">
                    <div class="table-panel-header">
                        <div>
                            <h2>Laporan Terbaru</h2>
                            <p>Daftar laporan terbaru yang sudah Anda kirim.</p>
                        </div>

                        <form method="GET" action="{{ route('staff.dashboard') }}" class="filter-form">
                            <select name="jenis_laporan" class="filter-select">
                                <option value="">Semua Jenis</option>
                                <option value="sistem" {{ request('jenis_laporan') === 'sistem' ? 'selected' : '' }}>
                                    Sistem
                                </option>
                                <option value="asset" {{ request('jenis_laporan') === 'asset' ? 'selected' : '' }}>
                                    Asset
                                </option>
                            </select>

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

                            <button type="submit" class="btn-filter">
                                Filter
                            </button>

                            <a href="{{ route('staff.dashboard') }}" class="btn-reset">
                                Reset
                            </a>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="light-table">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Jenis</th>
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
                                                {{ Str::limit($report->deskripsi, 55) }}
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge badge-type">
                                                {{ strtoupper($report->jenis_laporan) }}
                                            </span>
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
                                        <td colspan="5">
                                            <div class="empty-state">
                                                <div class="icon">📭</div>
                                                <strong>Tidak ada laporan</strong>
                                                <p>Laporan tidak ditemukan berdasarkan filter yang dipilih.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

        </div>
    </div>
</x-app-layout>