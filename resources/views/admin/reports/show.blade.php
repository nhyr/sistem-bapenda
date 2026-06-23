<x-app-layout>
    @php
        $latestAppeal = $report->latestAppeal ?? null;

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

        .alert {
            padding: 12px 16px;
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

        .btn-back {
            background: #991b1b;
            color: #ffffff;
            padding: 11px 18px;
            border-radius: 999px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 900;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back:hover {
            background: #7f1d1d;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.3fr .8fr;
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

        .badge-wrapper {
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

        .response-form {
            display: grid;
            gap: 14px;
        }

        .form-label {
            font-size: 12px;
            font-weight: 900;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .4px;
            display: block;
            margin-bottom: 6px;
        }

        .form-select,
        .form-textarea {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            padding: 11px 13px;
            font-size: 13px;
            color: #334155;
            outline: none;
            background: #ffffff;
        }

        .form-select:focus,
        .form-textarea:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
        }

        .form-textarea {
            min-height: 110px;
            resize: vertical;
        }

        .helper-text {
            margin-top: 6px;
            font-size: 12px;
            color: #64748b;
            line-height: 1.5;
        }

        .btn-submit {
            background: #ef4444;
            color: #ffffff;
            border: none;
            border-radius: 999px;
            padding: 12px 18px;
            font-size: 13px;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(239, 68, 68, 0.25);
        }

        .btn-submit:hover {
            background: #dc2626;
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
            margin: 0 0 12px;
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

            .content-grid {
                grid-template-columns: 1fr;
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
            }

            .btn-back {
                width: 100%;
                justify-content: center;
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
                    <a href="{{ route('admin.dashboard') }}">
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
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        <ul style="margin: 0; padding-left: 18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="topbar">
                    <div>
                        <h1>Detail Laporan</h1>
                        <p>Admin dapat meninjau laporan, menugaskan teknisi, dan memperbarui tanggapan untuk staff.</p>
                    </div>

                    <a href="{{ route('admin.dashboard') }}" class="btn-back">
                        ← Kembali
                    </a>
                </div>

                <div class="content-grid">
                    <div class="card">
                        <div class="card-header">
                            <h2>{{ $report->judul }}</h2>
                            <p>
                                Dibuat pada
                                {{ $report->created_at ? $report->created_at->format('d-m-Y H:i') : '-' }}
                            </p>
                        </div>

                        <div class="card-body">
                            <div class="badge-wrapper">
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
                                <h2>Edit Tanggapan</h2>
                                <p>Perbarui teknisi, status, dan catatan tindak lanjut untuk laporan ini.</p>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.reports.update-status', $report) }}" method="POST"
                                    class="response-form">
                                    @csrf
                                    @method('PUT')

                                    <div>
                                        <label class="form-label">Tugaskan Teknisi</label>

                                        <select name="teknisi_id" class="form-select">
                                            <option value="">Pilih Teknisi</option>

                                            @foreach ($teknisis ?? [] as $teknisi)
                                                <option value="{{ $teknisi->id }}"
                                                    {{ (string) $report->teknisi_id === (string) $teknisi->id ? 'selected' : '' }}>
                                                    {{ $teknisi->name }}
                                                    -
                                                    {{ $teknisi->kategori_teknisi === 'sistem' ? 'Teknisi Sistem' : 'Teknisi Barang' }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="helper-text">
                                            Teknisi yang muncul disesuaikan dengan jenis laporan.
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label">Status</label>

                                        <select name="status" class="form-select" required>
                                            <option value="menunggu" {{ $report->status === 'menunggu' ? 'selected' : '' }}>
                                                Menunggu
                                            </option>

                                            <option value="diproses" {{ $report->status === 'diproses' ? 'selected' : '' }}>
                                                Diproses
                                            </option>

                                            <option value="ditolak" {{ $report->status === 'ditolak' ? 'selected' : '' }}>
                                                Ditolak
                                            </option>
                                        </select>

                                        <div class="helper-text">
                                            Status selesai hanya dapat dilakukan oleh teknisi setelah laporan ditangani.
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label">Catatan Admin</label>

                                        <textarea name="catatan_admin" class="form-textarea"
                                            placeholder="Tulis catatan atau tindak lanjut untuk staff...">{{ old('catatan_admin', $report->catatan_admin) }}</textarea>
                                    </div>

                                    <button type="submit" class="btn-submit">
                                        Update Tanggapan
                                    </button>
                                </form>

                                <div style="margin-top: 18px;" class="info-list">
                                    <div class="info-item">
                                        <div class="info-label">Pelapor</div>
                                        <div class="info-value">
                                            {{ $report->user->name ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Unit Kerja</div>
                                        <div class="info-value">
                                            {{ $report->user->unit_kerja ?? 'Staff Pelayanan' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Prioritas</div>
                                        <div class="info-value">
                                            {{ strtoupper($report->prioritas ?? '-') }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Teknisi Ditugaskan</div>
                                        <div class="info-value">
                                            @if ($report->teknisi)
                                                {{ $report->teknisi->name }}
                                                -
                                                {{ $report->teknisi->kategori_teknisi === 'sistem' ? 'Teknisi Sistem' : 'Teknisi Barang' }}
                                            @else
                                                Belum ditugaskan
                                            @endif
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Nama Sistem / Asset</div>
                                        <div class="info-value">
                                            {{ $report->nama_sistem ?? $report->asset->nama_aset ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Lokasi Kejadian</div>
                                        <div class="info-value">
                                            {{ $report->lokasi_kejadian ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Catatan Teknisi</div>
                                        <div class="info-value">
                                            {{ $report->catatan_teknisi ?? 'Belum ada catatan teknisi.' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Ditangani Pada</div>
                                        <div class="info-value">
                                            {{ $report->ditangani_pada ? \Carbon\Carbon::parse($report->ditangani_pada)->format('d-m-Y H:i') : '-' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($latestAppeal)
                            <div class="card">
                                <div class="card-header">
                                    <h2>Pengajuan Banding Staff</h2>
                                    <p>Tinjau alasan banding yang diajukan oleh staff.</p>
                                </div>

                                <div class="card-body">
                                    <div class="appeal-box">
                                        <h3>Detail Banding</h3>

                                        @if ($latestAppeal->status === 'menunggu')
                                            <span class="appeal-status appeal-waiting">
                                                Menunggu Keputusan
                                            </span>
                                        @elseif ($latestAppeal->status === 'diterima')
                                            <span class="appeal-status appeal-accepted">
                                                Banding Diterima
                                            </span>
                                        @else
                                            <span class="appeal-status appeal-rejected">
                                                Banding Ditolak
                                            </span>
                                        @endif

                                        <p>
                                            <strong>Diajukan oleh:</strong><br>
                                            {{ $latestAppeal->user->name ?? '-' }}
                                        </p>

                                        <p>
                                            <strong>Alasan Banding:</strong><br>
                                            {{ $latestAppeal->alasan_banding }}
                                        </p>

                                        @if ($latestAppeal->lampiran_banding)
                                            <p>
                                                <strong>Lampiran Banding:</strong><br>
                                                <a href="{{ asset('storage/' . $latestAppeal->lampiran_banding) }}"
                                                    target="_blank"
                                                    style="color: #dc2626; font-weight: 900;">
                                                    Lihat Lampiran Banding
                                                </a>
                                            </p>
                                        @endif

                                        @if ($latestAppeal->status === 'menunggu')
                                            <form action="{{ route('admin.report-appeals.review', $latestAppeal) }}"
                                                method="POST" class="response-form" style="margin-top: 16px;">
                                                @csrf
                                                @method('PATCH')

                                                <div>
                                                    <label class="form-label">Keputusan Banding</label>

                                                    <select name="status" class="form-select" required>
                                                        <option value="">Pilih Keputusan</option>
                                                        <option value="diterima">Terima Banding</option>
                                                        <option value="ditolak">Tolak Banding</option>
                                                    </select>

                                                    <div class="helper-text">
                                                        Jika banding diterima, status laporan akan kembali menjadi menunggu.
                                                    </div>
                                                </div>

                                                <div>
                                                    <label class="form-label">Catatan Keputusan</label>

                                                    <textarea name="catatan_admin" class="form-textarea"
                                                        placeholder="Tulis catatan keputusan banding...">{{ old('catatan_admin') }}</textarea>
                                                </div>

                                                <button type="submit" class="btn-submit">
                                                    Simpan Keputusan Banding
                                                </button>
                                            </form>
                                        @else
                                            <p>
                                                <strong>Catatan Admin:</strong><br>
                                                {{ $latestAppeal->catatan_admin ?? '-' }}
                                            </p>

                                            <p>
                                                <strong>Diproses oleh:</strong><br>
                                                {{ $latestAppeal->admin->name ?? '-' }}
                                            </p>

                                            <p>
                                                <strong>Diproses pada:</strong><br>
                                                {{ $latestAppeal->reviewed_at ? \Carbon\Carbon::parse($latestAppeal->reviewed_at)->format('d-m-Y H:i') : '-' }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2>Riwayat Status</h2>
                        <p>Catatan perubahan status laporan.</p>
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