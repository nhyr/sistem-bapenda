<x-app-layout>
    @php
        $latestAppeal = $report->reportAppeals()->latest()->first();
        $pendingAppeal = $report->reportAppeals()->where('status', 'menunggu')->exists();

        $statusClass = match ($report->status) {
            'menunggu' => 'badge-waiting',
            'diproses' => 'badge-process',
            'selesai' => 'badge-done',
            'ditolak' => 'badge-rejected',
            default => 'badge-waiting',
        };

        $statusLabel = match ($report->status) {
            'menunggu' => 'Menunggu',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            default => ucfirst($report->status),
        };
    @endphp

    <style>
        body {
            background: #f1f5f9;
        }

        .detail-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #fee2e2, #fff7ed, #f8fafc);
            padding: 28px;
        }

        .detail-container {
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

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
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

        .btn-back,
        .btn-appeal {
            color: #ffffff;
            padding: 12px 18px;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 900;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }

        .btn-back {
            background: #ef4444;
            box-shadow: 0 10px 20px rgba(239, 68, 68, 0.25);
        }

        .btn-back:hover,
        .btn-appeal:hover {
            background: #dc2626;
        }

        .btn-appeal {
            background: #dc2626;
            margin-top: 12px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1.4fr .8fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 14px 28px rgba(15, 23, 42, 0.06);
            margin-bottom: 20px;
        }

        .card-header {
            padding: 22px;
            border-bottom: 1px solid #e5e7eb;
            background: #f8fafc;
        }

        .card-header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 900;
            color: #0f172a;
        }

        .card-header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .card-body {
            padding: 22px;
        }

        .badge-wrap {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .badge {
            display: inline-flex;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 900;
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

        .info-list {
            display: grid;
            gap: 14px;
        }

        .info-item {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 14px 16px;
        }

        .info-item:hover {
            background: #fff7ed;
        }

        .info-label {
            font-size: 12px;
            font-weight: 900;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 6px;
        }

        .info-value {
            color: #0f172a;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.6;
        }

        .description-box {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 16px;
            color: #334155;
            line-height: 1.7;
            font-size: 14px;
            white-space: pre-line;
        }

        .photo-box {
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            overflow: hidden;
            background: #f8fafc;
        }

        .photo-box img {
            width: 100%;
            max-height: 360px;
            object-fit: cover;
            display: block;
        }

        .no-photo {
            padding: 34px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 18px;
            font-size: 14px;
            font-weight: 700;
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

        .appeal-box {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            border-radius: 18px;
            padding: 18px;
        }

        .appeal-box h3 {
            margin: 0 0 8px;
            color: #9a3412;
            font-size: 17px;
            font-weight: 900;
        }

        .appeal-box p {
            margin: 0 0 10px;
            color: #475569;
            font-size: 14px;
            line-height: 1.7;
        }

        .appeal-status {
            display: inline-flex;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 900;
            margin-bottom: 12px;
        }

        .appeal-waiting {
            background: #fef3c7;
            color: #92400e;
        }

        .appeal-accepted {
            background: #dcfce7;
            color: #166534;
        }

        .appeal-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .timeline {
            display: grid;
            gap: 14px;
        }

        .timeline-item {
            display: flex;
            gap: 12px;
            padding: 14px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
        }

        .timeline-item:hover {
            background: #fff7ed;
        }

        .timeline-dot {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #fee2e2;
            color: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            flex-shrink: 0;
        }

        .timeline-content strong {
            display: block;
            color: #0f172a;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .timeline-content p {
            margin: 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        .empty-state {
            padding: 34px 20px;
            text-align: center;
            color: #64748b;
        }

        .empty-state .icon {
            font-size: 34px;
            margin-bottom: 10px;
        }

        .empty-state strong {
            color: #0f172a;
            display: block;
            margin-bottom: 6px;
        }

        @media (max-width: 1100px) {
            .detail-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                min-height: auto;
            }

            .sidebar-menu {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .detail-page {
                padding: 16px;
            }

            .main {
                padding: 18px;
            }

            .topbar {
                flex-direction: column;
            }

            .btn-back {
                width: 100%;
            }
        }
    </style>

    <div class="detail-page">
        <div class="detail-container">

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
                        <h1>Detail Laporan</h1>
                        <p>Informasi lengkap laporan yang sudah Anda kirim.</p>
                    </div>

                    <a href="{{ route('staff.reports.index') }}" class="btn-back">
                        ← Kembali
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="detail-grid">
                    <div class="card">
                        <div class="card-header">
                            <h2>{{ $report->judul }}</h2>
                            <p>
                                Dibuat pada
                                {{ $report->created_at ? $report->created_at->format('d-m-Y H:i') : '-' }}
                            </p>
                        </div>

                        <div class="card-body">
                            <div class="badge-wrap">
                                <span class="badge badge-type">
                                    {{ strtoupper($report->jenis_laporan) }}
                                </span>

                                <span class="badge {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </div>

                            <div class="info-list">
                                <div class="info-item">
                                    <div class="info-label">Deskripsi Masalah</div>
                                    <div class="description-box">{{ $report->deskripsi }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">Foto Bukti</div>

                                    @if ($report->foto_bukti)
                                        <div class="photo-box">
                                            <img
                                                src="{{ asset('storage/' . $report->foto_bukti) }}"
                                                alt="Foto bukti laporan"
                                            >
                                        </div>
                                    @else
                                        <div class="no-photo">
                                            📷 Tidak ada foto bukti yang diunggah.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="card">
                            <div class="card-header">
                                <h2>Informasi Laporan</h2>
                                <p>Data pendukung laporan.</p>
                            </div>

                            <div class="card-body">
                                <div class="info-list">
                                    <div class="info-item">
                                        <div class="info-label">Prioritas</div>
                                        <div class="info-value">
                                            {{ strtoupper($report->prioritas ?? '-') }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Nama Sistem / Asset</div>
                                        <div class="info-value">
                                            {{ $report->asset->nama_aset ?? $report->nama_sistem ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Lokasi Kejadian</div>
                                        <div class="info-value">
                                            {{ $report->lokasi_kejadian ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Admin yang Menangani</div>
                                        <div class="info-value">
                                            {{ $report->admin->name ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Teknisi yang Ditugaskan</div>
                                        <div class="info-value">
                                            {{ $report->teknisi->name ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Catatan Admin</div>
                                        <div class="info-value">
                                            {{ $report->catatan_admin ?? 'Belum ada catatan dari admin.' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Catatan Teknisi</div>
                                        <div class="info-value">
                                            {{ $report->catatan_teknisi ?? 'Belum ada catatan dari teknisi.' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($report->status === 'ditolak')
                            <div class="card">
                                <div class="card-header">
                                    <h2>Pengajuan Banding</h2>
                                    <p>Ajukan banding apabila laporan masih perlu diproses.</p>
                                </div>

                                <div class="card-body">
                                    <div class="appeal-box">
                                        <h3>Laporan Anda Ditolak</h3>

                                        <p>
                                            Laporan ini ditolak oleh admin. Anda dapat mengajukan banding
                                            dengan memberikan alasan tambahan agar laporan dapat ditinjau ulang.
                                        </p>

                                        @if ($report->catatan_admin)
                                            <p>
                                                <strong>Catatan Admin:</strong><br>
                                                {{ $report->catatan_admin }}
                                            </p>
                                        @endif

                                        @if ($pendingAppeal)
                                            <span class="appeal-status appeal-waiting">
                                                Banding Menunggu Keputusan
                                            </span>

                                            <p>
                                                Banding sudah diajukan dan sedang menunggu keputusan admin.
                                            </p>
                                        @else
                                            <a
                                                href="{{ route('staff.reports.appeal.create', $report) }}"
                                                class="btn-appeal"
                                            >
                                                Ajukan Banding
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($latestAppeal)
                            <div class="card">
                                <div class="card-header">
                                    <h2>Riwayat Banding Terakhir</h2>
                                    <p>Informasi pengajuan banding laporan ini.</p>
                                </div>

                                <div class="card-body">
                                    <div class="appeal-box">
                                        @if ($latestAppeal->status === 'menunggu')
                                            <span class="appeal-status appeal-waiting">Menunggu</span>
                                        @elseif ($latestAppeal->status === 'diterima')
                                            <span class="appeal-status appeal-accepted">Diterima</span>
                                        @else
                                            <span class="appeal-status appeal-rejected">Ditolak</span>
                                        @endif

                                        <p>
                                            <strong>Alasan Banding:</strong><br>
                                            {{ $latestAppeal->alasan_banding }}
                                        </p>

                                        @if ($latestAppeal->lampiran_banding)
                                            <p>
                                                <strong>Lampiran:</strong><br>
                                                <a href="{{ asset('storage/' . $latestAppeal->lampiran_banding) }}" target="_blank">
                                                    Lihat Lampiran Banding
                                                </a>
                                            </p>
                                        @endif

                                        <p>
                                            <strong>Catatan Admin:</strong><br>
                                            {{ $latestAppeal->catatan_admin ?? 'Belum ada catatan keputusan dari admin.' }}
                                        </p>

                                        <p>
                                            <strong>Diajukan pada:</strong>
                                            {{ $latestAppeal->created_at ? $latestAppeal->created_at->format('d-m-Y H:i') : '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2>Riwayat Status</h2>
                        <p>Perubahan status laporan dari admin atau teknisi.</p>
                    </div>

                    <div class="card-body">
                        @if ($report->histories && $report->histories->count() > 0)
                            <div class="timeline">
                                @foreach ($report->histories as $history)
                                    <div class="timeline-item">
                                        <div class="timeline-dot">✓</div>

                                        <div class="timeline-content">
                                            <strong>
                                                {{ ucfirst($history->status_sebelumnya ?? 'Awal') }}
                                                →
                                                {{ ucfirst($history->status_baru) }}
                                            </strong>

                                            <p>
                                                {{ $history->catatan ?? 'Tidak ada catatan.' }}
                                            </p>

                                            <p>
                                                Oleh {{ $history->user->name ?? '-' }}
                                                pada {{ $history->created_at ? $history->created_at->format('d-m-Y H:i') : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="icon">🕒</div>
                                <strong>Belum ada riwayat status</strong>
                                <p>Status laporan belum mengalami perubahan.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>