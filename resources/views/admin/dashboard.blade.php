@php
    use Illuminate\Support\Str;

    $safeChartLabels = isset($chartLabels) ? $chartLabels : [
        'Total',
        'Menunggu',
        'Diproses',
        'Selesai',
        'Ditolak',
        'Banding Menunggu',
    ];

    $safeChartData = isset($chartData) ? $chartData : [
        0,
        0,
        0,
        0,
        0,
        0,
    ];
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
            max-width: 1360px;
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
            overflow: hidden;
        }

        .alert-success,
        .alert-error {
            padding: 12px 16px;
            border-radius: 14px;
            margin-bottom: 18px;
            font-weight: 700;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 22px;
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

        .filter-panel,
        .chart-panel,
        .table-panel {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 14px 28px rgba(15, 23, 42, 0.06);
            margin-bottom: 22px;
        }

        .filter-panel {
            padding: 20px;
        }

        .filter-form {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto auto;
            gap: 12px;
            align-items: end;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 900;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 7px;
        }

        .form-control {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            padding: 11px 13px;
            font-size: 13px;
            color: #334155;
            outline: none;
            background: #ffffff;
        }

        .form-control:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
        }

        .btn-filter,
        .btn-reset {
            border: none;
            border-radius: 999px;
            padding: 12px 18px;
            font-size: 13px;
            font-weight: 900;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            white-space: nowrap;
        }

        .btn-filter {
            background: #dc2626;
            color: #ffffff;
            box-shadow: 0 10px 20px rgba(220, 38, 38, 0.22);
        }

        .btn-filter:hover {
            background: #b91c1c;
        }

        .btn-reset {
            background: #e5e7eb;
            color: #111827;
        }

        .btn-reset:hover {
            background: #d1d5db;
        }

        .chart-header,
        .table-panel-header {
            padding: 20px 22px;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }

        .table-panel-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
        }

        .chart-header h2,
        .table-panel-header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 900;
            color: #0f172a;
        }

        .chart-header p,
        .table-panel-header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .chart-body {
            padding: 22px;
            height: 320px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 24px;
        }

        .stat-card {
            position: relative;
            border-radius: 22px;
            padding: 18px;
            min-height: 118px;
            overflow: hidden;
            box-shadow: 0 14px 28px rgba(15, 23, 42, 0.08);
        }

        .stat-card small {
            display: block;
            font-size: 12px;
            font-weight: 800;
            opacity: .92;
            max-width: 95px;
            line-height: 1.35;
        }

        .stat-card h3 {
            margin: 20px 0 0;
            font-size: 30px;
            line-height: 1;
            font-weight: 900;
        }

        .stat-icon {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, .35);
            font-size: 18px;
        }

        .card-total {
            background: linear-gradient(135deg, #dc2626, #f87171);
            color: #ffffff;
        }

        .card-waiting {
            background: linear-gradient(135deg, #f97316, #fdba74);
            color: #7c2d12;
        }

        .card-process {
            background: linear-gradient(135deg, #fb7185, #fecdd3);
            color: #881337;
        }

        .card-done {
            background: linear-gradient(135deg, #22c55e, #86efac);
            color: #064e3b;
        }

        .card-rejected {
            background: linear-gradient(135deg, #991b1b, #ef4444);
            color: #ffffff;
        }

        .card-appeal {
            background: #ffffff;
            color: #0f172a;
            border: 1px solid #fed7aa;
        }

        .card-appeal small {
            color: #9a3412;
        }

        .card-appeal .stat-icon {
            background: #fff7ed;
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

        .badge-appeal {
            background: #fff7ed;
            color: #9a3412;
            border: 1px solid #fed7aa;
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
            justify-content: center;
            white-space: nowrap;
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

        @media (max-width: 1280px) {
            .filter-form {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .stats {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
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
        }

        @media (max-width: 720px) {
            .filter-form {
                grid-template-columns: 1fr;
            }

            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .btn-filter,
            .btn-reset {
                width: 100%;
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

            .btn-view-all {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .stats {
                grid-template-columns: 1fr;
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
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span>📊</span>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.reports.index') }}"
                        class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                        <span>📁</span>
                        <span>Riwayat Laporan Masuk</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                        class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <span>👥</span>
                        <span>Data User</span>
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

                @if (session('error'))
                    <div class="alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="topbar">
                    <div>
                        <h1>Dashboard Admin</h1>
                        <p>Kelola laporan staff, tugaskan teknisi, dan pantau status penanganan.</p>
                    </div>
                </div>

                <div class="filter-panel">
                    <form action="{{ route('admin.dashboard') }}" method="GET" class="filter-form">
                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Jenis Pengaduan</label>
                            <select name="jenis_laporan" class="form-control">
                                <option value="">Semua Jenis</option>
                                <option value="sistem" {{ request('jenis_laporan') === 'sistem' ? 'selected' : '' }}>
                                    Sistem
                                </option>
                                <option value="asset" {{ request('jenis_laporan') === 'asset' ? 'selected' : '' }}>
                                    Aset / Barang
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="btn-filter">Filter</button>

                        <a href="{{ route('admin.dashboard') }}" class="btn-reset">Reset</a>
                    </form>
                </div>

                <div class="chart-panel">
                    <div class="chart-header">
                        <h2>Diagram Statistik Laporan</h2>
                        <p>Diagram berdasarkan filter tanggal dan jenis pengaduan yang dipilih.</p>
                    </div>

                    <div class="chart-body">
                        <canvas id="reportChart"></canvas>
                    </div>
                </div>

                <div class="stats">
                    <div class="stat-card card-total">
                        <div class="stat-icon">📄</div>
                        <small>Total Laporan</small>
                        <h3>{{ $total ?? 0 }}</h3>
                    </div>

                    <div class="stat-card card-waiting">
                        <div class="stat-icon">⏳</div>
                        <small>Menunggu</small>
                        <h3>{{ $menunggu ?? 0 }}</h3>
                    </div>

                    <div class="stat-card card-process">
                        <div class="stat-icon">🔧</div>
                        <small>Diproses</small>
                        <h3>{{ $diproses ?? 0 }}</h3>
                    </div>

                    <div class="stat-card card-done">
                        <div class="stat-icon">✓</div>
                        <small>Selesai</small>
                        <h3>{{ $selesai ?? 0 }}</h3>
                    </div>

                    <div class="stat-card card-rejected">
                        <div class="stat-icon">✕</div>
                        <small>Ditolak</small>
                        <h3>{{ $ditolak ?? 0 }}</h3>
                    </div>

                    <div class="stat-card card-appeal">
                        <div class="stat-icon">⚠️</div>
                        <small>Banding Menunggu</small>
                        <h3>{{ $totalBanding ?? 0 }}</h3>
                    </div>
                </div>

                <div class="table-panel">
                    <div class="table-panel-header">
                        <div>
                            <h2>Laporan Terbaru Perlu Ditindaklanjuti</h2>
                            <p>Menampilkan laporan yang masih menunggu atau sedang diproses.</p>
                        </div>

                        <a href="{{ route('admin.reports.index') }}" class="btn-view-all">
                            Lihat Riwayat
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="light-table">
                            <thead>
                                <tr>
                                    <th>Pelapor</th>
                                    <th>Laporan</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Teknisi</th>
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
                                            @if ($report->teknisi)
                                                <strong style="color: #0f172a;">
                                                    {{ $report->teknisi->name }}
                                                </strong>

                                                <div class="report-desc">
                                                    {{ $report->teknisi->kategori_teknisi === 'sistem' ? 'Teknisi Sistem' : 'Teknisi Barang' }}
                                                </div>
                                            @else
                                                <span class="report-desc">Belum ditugaskan</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $report->created_at ? $report->created_at->format('d-m-Y H:i') : '-' }}
                                        </td>

                                        <td style="text-align: right;">
                                            <a href="{{ route('admin.reports.show', $report) }}" class="btn-detail">
                                                Tanggapi
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="empty-state">
                                                <div class="icon">✅</div>
                                                <strong>Tidak ada laporan yang perlu ditindaklanjuti</strong>
                                                <p>Laporan baru dari staff akan muncul di sini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="table-panel">
                    <div class="table-panel-header">
                        <div>
                            <h2>Pengajuan Banding Staff</h2>
                            <p>Menampilkan laporan yang ditolak dan diajukan banding oleh staff.</p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="light-table">
                            <thead>
                                <tr>
                                    <th>Staff</th>
                                    <th>Laporan</th>
                                    <th>Alasan Banding</th>
                                    <th>Status Banding</th>
                                    <th>Tanggal Banding</th>
                                    <th style="text-align: right;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($appeals ?? [] as $appeal)
                                    <tr>
                                        <td>
                                            <strong style="color: #0f172a;">
                                                {{ $appeal->user->name ?? $appeal->report->user->name ?? '-' }}
                                            </strong>

                                            <div class="report-desc">
                                                {{ $appeal->user->unit_kerja ?? $appeal->report->user->unit_kerja ?? 'Staff Pelayanan' }}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="report-title">
                                                {{ $appeal->report->judul ?? '-' }}
                                            </div>

                                            <div class="report-desc">
                                                Status laporan:
                                                <span style="color: #991b1b; font-weight: 900;">Ditolak</span>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="report-desc">
                                                {{ Str::limit($appeal->alasan_banding, 90) }}
                                            </div>
                                        </td>

                                        <td>
                                            @if ($appeal->status === 'menunggu')
                                                <span class="badge badge-appeal">Menunggu</span>
                                            @elseif ($appeal->status === 'diterima')
                                                <span class="badge badge-done">Diterima</span>
                                            @else
                                                <span class="badge badge-rejected">Ditolak</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $appeal->created_at ? $appeal->created_at->format('d-m-Y H:i') : '-' }}
                                        </td>

                                        <td style="text-align: right;">
                                            @if ($appeal->report)
                                                <a href="{{ route('admin.reports.show', $appeal->report) }}" class="btn-detail">
                                                    Review
                                                </a>
                                            @else
                                                <span class="report-desc">Tidak tersedia</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="empty-state">
                                                <div class="icon">📭</div>
                                                <strong>Belum ada pengajuan banding</strong>
                                                <p>Banding dari staff akan muncul di sini setelah laporan ditolak dan diajukan banding.</p>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const chartLabels = {!! json_encode($safeChartLabels) !!};
        const chartData = {!! json_encode($safeChartData) !!};

        const reportChart = document.getElementById('reportChart');

        if (reportChart) {
            new Chart(reportChart, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Jumlah Laporan',
                        data: chartData,
                        backgroundColor: [
                            'rgba(220, 38, 38, 0.78)',
                            'rgba(249, 115, 22, 0.78)',
                            'rgba(244, 114, 182, 0.78)',
                            'rgba(34, 197, 94, 0.78)',
                            'rgba(153, 27, 27, 0.78)',
                            'rgba(251, 146, 60, 0.78)'
                        ],
                        borderColor: [
                            'rgb(220, 38, 38)',
                            'rgb(249, 115, 22)',
                            'rgb(244, 114, 182)',
                            'rgb(34, 197, 94)',
                            'rgb(153, 27, 27)',
                            'rgb(251, 146, 60)'
                        ],
                        borderWidth: 1,
                        borderRadius: 12,
                        barThickness: 48
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Jumlah: ' + context.raw;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    weight: 'bold'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }
    </script>
</x-app-layout>