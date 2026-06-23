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

        .btn-back {
            background: #991b1b;
            color: #ffffff;
            padding: 11px 18px;
            border-radius: 999px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 900;
            white-space: nowrap;
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
            vertical-align: top;
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

        .empty-state {
            padding: 44px 20px;
            text-align: center;
            color: #64748b;
        }

        .empty-state .icon {
            font-size: 36px;
            margin-bottom: 10px;
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

            .btn-back {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <div class="page-wrapper">
        <div class="page-container">

            <aside class="sidebar">
                <div class="brand">
                    BAPEN<span>DA</span>
                </div>

                <nav class="sidebar-menu">
                    <a
                        href="{{ route('teknisi.dashboard') }}"
                        class="{{ request()->routeIs('teknisi.dashboard') ? 'active' : '' }}"
                    >
                        <span>📊</span>
                        <span>Dashboard</span>
                    </a>

                    <a
                        href="{{ route('teknisi.reports.index') }}"
                        class="{{ request()->routeIs('teknisi.reports.*') ? 'active' : '' }}"
                    >
                        <span>🛠️</span>
                        <span>Laporan Ditugaskan</span>
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
                        <h1>Laporan Ditugaskan</h1>
                        <p>Daftar seluruh laporan yang ditugaskan kepada teknisi.</p>
                    </div>

                    <a href="{{ route('teknisi.dashboard') }}" class="btn-back">
                        ← Kembali Dashboard
                    </a>
                </div>

                <div class="table-panel">
                    <div class="table-panel-header">
                        <h2>Daftar Laporan</h2>
                        <p>Laporan ditampilkan berdasarkan tanggal terbaru.</p>
                    </div>

                    <div class="table-responsive">
                        <table class="light-table">
                            <thead>
                                <tr>
                                    <th>Pelapor</th>
                                    <th>Laporan</th>
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
                                            <strong style="color: #0f172a;">
                                                {{ $report->user->name ?? '-' }}
                                            </strong>

                                            <div class="report-desc">
                                                {{ $report->user->unit_kerja ?? 'Staff Pelayanan' }}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="report-title">
                                                {{ $report->judul }}
                                            </div>

                                            <div class="report-desc">
                                                {{ Str::limit($report->deskripsi, 65) }}
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
                                            <a
                                                href="{{ route('teknisi.reports.show', $report) }}"
                                                class="btn-detail"
                                            >
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="empty-state">
                                                <div class="icon">📭</div>
                                                <strong>Belum ada laporan ditugaskan</strong>
                                                <p>Laporan yang ditugaskan admin akan muncul di sini.</p>
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