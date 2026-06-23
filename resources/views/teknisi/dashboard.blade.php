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

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 12px 16px;
            border-radius: 14px;
            margin-bottom: 18px;
            font-weight: 700;
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

        .role-badge {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 10px 16px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 900;
            white-space: nowrap;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
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

        .card-red {
            background: linear-gradient(135deg, #dc2626, #f87171);
            color: #ffffff;
        }

        .card-orange {
            background: linear-gradient(135deg, #f97316, #fdba74);
            color: #7c2d12;
        }

        .card-green {
            background: linear-gradient(135deg, #22c55e, #86efac);
            color: #064e3b;
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

        .btn-view-all {
            background: #fff7ed;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-radius: 999px;
            padding: 9px 16px;
            font-size: 12px;
            font-weight: 900;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-view-all:hover {
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
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            background: #f8fafc;
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
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .dashboard-page {
                padding: 16px;
            }

            .main {
                padding: 18px;
            }

            .topbar,
            .table-panel-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-view-all,
            .role-badge {
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
                        <h1>Dashboard Teknisi</h1>
                        <p>Menampilkan laporan yang belum selesai dan perlu segera ditangani.</p>
                    </div>

                    <div class="role-badge">
                        {{ auth()->user()->kategori_teknisi === 'sistem' ? 'Teknisi Sistem' : 'Teknisi Barang' }}
                    </div>
                </div>

                <div class="stats">
                    <div class="stat-card card-red">
                        <div class="stat-icon">📄</div>
                        <small>Total Ditugaskan</small>
                        <h3>{{ $total ?? 0 }}</h3>
                    </div>

                    <div class="stat-card card-orange">
                        <div class="stat-icon">🔧</div>
                        <small>Belum Selesai</small>
                        <h3>{{ $belumSelesai ?? (($menunggu ?? 0) + ($diproses ?? 0)) }}</h3>
                    </div>

                    <div class="stat-card card-green">
                        <div class="stat-icon">✓</div>
                        <small>Selesai</small>
                        <h3>{{ $selesai ?? 0 }}</h3>
                    </div>
                </div>

                <div class="table-panel">
                    <div class="table-panel-header">
                        <div>
                            <h2>Laporan Perlu Ditangani</h2>
                            <p>Hanya menampilkan laporan yang masih menunggu atau sedang diproses.</p>
                        </div>

                        
                    </div>

                    <div class="table-responsive">
                        <table class="light-table">
                            <thead>
                                <tr>
                                    <th>Pelapor</th>
                                    <th>Laporan</th>
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
                                                Tanggapi
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="empty-state">
                                                <div class="icon">✅</div>
                                                <strong>Tidak ada laporan yang perlu ditangani</strong>
                                                <p>Laporan baru atau laporan yang belum selesai akan muncul di sini.</p>
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