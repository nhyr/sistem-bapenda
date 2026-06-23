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

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 12px 16px;
            border-radius: 14px;
            margin-bottom: 18px;
            font-weight: 700;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 12px 16px;
            border-radius: 14px;
            margin-bottom: 18px;
            font-weight: 700;
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

        .form-label {
            font-size: 12px;
            font-weight: 900;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .4px;
            display: block;
            margin-bottom: 6px;
        }

        .form-textarea {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            padding: 11px 13px;
            font-size: 13px;
            color: #334155;
            outline: none;
            background: #ffffff;
            min-height: 140px;
            resize: vertical;
        }

        .form-textarea:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
        }

        .form-textarea:disabled {
            background: #f1f5f9;
            color: #64748b;
            cursor: not-allowed;
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
            margin-top: 12px;
        }

        .btn-submit:hover {
            background: #dc2626;
        }

        .finished-box {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            border-radius: 16px;
            padding: 14px 16px;
            font-size: 14px;
            font-weight: 800;
            line-height: 1.6;
            margin-top: 12px;
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

                @if ($errors->any())
                    <div class="alert-error">
                        <strong>Terjadi kesalahan!</strong>

                        <ul style="margin-top: 8px; padding-left: 18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="topbar">
                    <div>
                        <h1>Detail Laporan</h1>
                        <p>Teknisi dapat melihat detail laporan dan memberikan catatan penanganan.</p>
                    </div>

                    <a
                        href="{{ $report->status === 'selesai' ? route('teknisi.reports.index') : route('teknisi.dashboard') }}"
                        class="btn-back"
                    >
                        ← Kembali
                    </a>
                </div>

                <div class="content-grid">
                    <div class="card">
                        <div class="card-header">
                            <h2>{{ $report->judul }}</h2>
                            <p>Dibuat pada {{ $report->created_at->format('d-m-Y H:i') }}</p>
                        </div>

                        <div class="card-body">
                            <div class="badge-wrapper">
                                <span class="badge badge-type">
                                    {{ strtoupper($report->jenis_laporan) }}
                                </span>

                                @if ($report->status === 'menunggu')
                                    <span class="badge badge-waiting">Menunggu</span>
                                @elseif ($report->status === 'diproses')
                                    <span class="badge badge-process">Diproses</span>
                                @elseif ($report->status === 'selesai')
                                    <span class="badge badge-done">Selesai</span>
                                @else
                                    <span class="badge badge-rejected">Ditolak</span>
                                @endif
                            </div>

                            <div class="info-list">
                                <div class="info-item">
                                    <div class="info-label">Deskripsi Masalah</div>
                                    <div class="description-box">
                                        {{ $report->deskripsi }}
                                    </div>
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

                    <div class="card">
                        <div class="card-header">
                            <h2>Catatan Penanganan</h2>
                            <p>Isi hasil pengecekan atau perbaikan laporan.</p>
                        </div>

                        <div class="card-body">
                            <form
                                action="{{ route('teknisi.reports.update-progress', $report) }}"
                                method="POST"
                            >
                                @csrf
                                @method('PUT')

                                <div>
                                    <label class="form-label">Catatan Teknisi</label>

                                    <textarea
                                        name="catatan_teknisi"
                                        class="form-textarea"
                                        placeholder="Tulis hasil penanganan laporan..."
                                        required
                                        {{ $report->status === 'selesai' ? 'disabled' : '' }}
                                    >{{ old('catatan_teknisi', $report->catatan_teknisi) }}</textarea>
                                </div>

                                @if ($report->status !== 'selesai')
                                    <button type="submit" class="btn-submit">
                                        Simpan Catatan & Selesaikan
                                    </button>
                                @else
                                    <div class="finished-box">
                                        ✅ Laporan ini sudah selesai ditangani.
                                    </div>
                                @endif
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
                                        {{ strtoupper($report->prioritas) }}
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">Nama Sistem / Asset</div>
                                    <div class="info-value">
                                        {{ $report->nama_sistem ?? '-' }}
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">Lokasi Kejadian</div>
                                    <div class="info-value">
                                        {{ $report->lokasi_kejadian ?? '-' }}
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">Ditangani Pada</div>
                                    <div class="info-value">
                                        {{ $report->ditangani_pada ? $report->ditangani_pada->format('d-m-Y H:i') : '-' }}
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">Catatan Admin</div>
                                    <div class="info-value">
                                        {{ $report->catatan_admin ?? 'Belum ada catatan admin.' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>
</x-app-layout>