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
            max-width: 1100px;
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
            min-height: 620px;
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

        .main-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .form-header {
            padding: 26px;
            background: linear-gradient(135deg, #dc2626, #f87171);
            color: #ffffff;
        }

        .form-header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 900;
        }

        .form-header p {
            margin: 8px 0 0;
            font-size: 14px;
            opacity: .92;
        }

        .form-body {
            padding: 26px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 14px 16px;
            border-radius: 16px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 800;
            color: #334155;
            margin-bottom: 8px;
        }

        .required {
            color: #ef4444;
        }

        .form-control {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            padding: 12px 14px;
            font-size: 14px;
            color: #0f172a;
            background: #ffffff;
            outline: none;
            transition: .2s;
        }

        .form-control:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.12);
        }

        textarea.form-control {
            min-height: 140px;
            resize: vertical;
        }

        .upload-wrapper {
            width: 100%;
        }

        .upload-box {
            width: 100%;
            min-height: 175px;
            border: 2px dashed #fca5a5;
            background: linear-gradient(135deg, #fff7ed, #fef2f2);
            border-radius: 18px;
            padding: 28px;
            text-align: center;
            cursor: pointer;
            transition: .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            box-sizing: border-box;
        }

        .upload-box:hover {
            background: #fee2e2;
            border-color: #ef4444;
            transform: translateY(-1px);
        }

        .upload-box.has-file {
            background: #f0fdf4;
            border-color: #22c55e;
        }

        .upload-icon {
            width: 56px;
            height: 56px;
            border-radius: 999px;
            background: #fee2e2;
            color: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 12px;
        }

        .upload-title {
            font-size: 14px;
            font-weight: 900;
            color: #dc2626;
            margin-bottom: 5px;
        }

        .upload-desc {
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
        }

        .upload-file-name {
            display: none;
            margin-top: 10px;
            font-size: 13px;
            font-weight: 800;
            color: #166534;
            word-break: break-word;
        }

        .upload-preview {
            display: none;
            margin-top: 14px;
        }

        .upload-preview img {
            width: 100%;
            max-width: 300px;
            max-height: 190px;
            object-fit: cover;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
        }

        .form-footer {
            padding-top: 22px;
            margin-top: 8px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn-cancel {
            padding: 11px 18px;
            border-radius: 999px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
            text-decoration: none;
            font-size: 13px;
            font-weight: 900;
        }

        .btn-cancel:hover {
            background: #f8fafc;
        }

        .btn-submit {
            padding: 11px 20px;
            border-radius: 999px;
            border: none;
            background: #ef4444;
            color: #ffffff;
            font-size: 13px;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(239, 68, 68, 0.25);
        }

        .btn-submit:hover {
            background: #dc2626;
        }

        @media (max-width: 1000px) {
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

            .form-body {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-footer {
                flex-direction: column-reverse;
            }

            .btn-cancel,
            .btn-submit {
                width: 100%;
                text-align: center;
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

                    <a href="{{ route('staff.reports.create') }}" class="active">
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

            <main class="main-card">
                <div class="form-header">
                    <h1>Buat Laporan</h1>
                    <p>
                        Laporkan gangguan sistem atau kerusakan aset agar segera ditindaklanjuti admin.
                    </p>
                </div>

                <div class="form-body">
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

                    <form
                        action="{{ route('staff.reports.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @csrf

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="jenis_laporan" class="form-label">
                                    Jenis Laporan <span class="required">*</span>
                                </label>

                                <select
                                    id="jenis_laporan"
                                    name="jenis_laporan"
                                    required
                                    class="form-control"
                                >
                                    <option value="sistem" {{ old('jenis_laporan') === 'sistem' ? 'selected' : '' }}>
                                        Gangguan Sistem / Bug
                                    </option>

                                    <option value="asset" {{ old('jenis_laporan') === 'asset' ? 'selected' : '' }}>
                                        Kerusakan Asset / Inventaris
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="prioritas" class="form-label">
                                    Prioritas <span class="required">*</span>
                                </label>

                                <select
                                    id="prioritas"
                                    name="prioritas"
                                    required
                                    class="form-control"
                                >
                                    <option value="rendah" {{ old('prioritas') === 'rendah' ? 'selected' : '' }}>
                                        Rendah
                                    </option>

                                    <option value="sedang" {{ old('prioritas', 'sedang') === 'sedang' ? 'selected' : '' }}>
                                        Sedang
                                    </option>

                                    <option value="tinggi" {{ old('prioritas') === 'tinggi' ? 'selected' : '' }}>
                                        Tinggi
                                    </option>
                                </select>
                            </div>

                            <div class="form-group full">
                                <label for="judul" class="form-label">
                                    Judul Laporan <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="judul"
                                    name="judul"
                                    value="{{ old('judul') }}"
                                    required
                                    placeholder="Contoh: Aplikasi error saat input data wajib pajak"
                                    class="form-control"
                                >
                            </div>

                            <div class="form-group full">
                                <label for="deskripsi" class="form-label">
                                    Deskripsi Masalah <span class="required">*</span>
                                </label>

                                <textarea
                                    id="deskripsi"
                                    name="deskripsi"
                                    required
                                    placeholder="Jelaskan permasalahan yang terjadi secara lengkap..."
                                    class="form-control"
                                >{{ old('deskripsi') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="nama_sistem" class="form-label">
                                    Nama Sistem / Asset
                                </label>

                                <input
                                    type="text"
                                    id="nama_sistem"
                                    name="nama_sistem"
                                    value="{{ old('nama_sistem') }}"
                                    placeholder="Contoh: e-SPTPD, SIMPADA, AC, Printer"
                                    class="form-control"
                                >
                            </div>

                            <div class="form-group">
                                <label for="lokasi_kejadian" class="form-label">
                                    Lokasi Kejadian
                                </label>

                                <input
                                    type="text"
                                    id="lokasi_kejadian"
                                    name="lokasi_kejadian"
                                    value="{{ old('lokasi_kejadian') }}"
                                    placeholder="Contoh: Loket 1, Ruang Pelayanan"
                                    class="form-control"
                                >
                            </div>

                            <div class="form-group full">
                                <label for="foto_bukti" class="form-label">
                                    Foto Bukti
                                </label>

                                <div class="upload-wrapper">
                                    <label for="foto_bukti" class="upload-box" id="uploadBox">
                                        <div class="upload-icon">📷</div>

                                        <div class="upload-title" id="uploadTitle">
                                            Klik untuk upload foto bukti
                                        </div>

                                        <div class="upload-desc">
                                            Format PNG, JPG, JPEG, atau WEBP maksimal 2MB
                                        </div>

                                        <div class="upload-file-name" id="uploadFileName"></div>

                                        <div class="upload-preview" id="uploadPreview">
                                            <img src="" alt="Preview foto bukti" id="previewImage">
                                        </div>
                                    </label>

                                    <input
                                        id="foto_bukti"
                                        name="foto_bukti"
                                        type="file"
                                        accept="image/png,image/jpg,image/jpeg,image/webp"
                                        style="display: none;"
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="form-footer">
                            <a href="{{ route('staff.dashboard') }}" class="btn-cancel">
                                Batal
                            </a>

                            <button type="submit" class="btn-submit">
                                Kirim Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </main>

        </div>
    </div>

    <script>
        const fotoBuktiInput = document.getElementById('foto_bukti');
        const uploadBox = document.getElementById('uploadBox');
        const uploadTitle = document.getElementById('uploadTitle');
        const uploadFileName = document.getElementById('uploadFileName');
        const uploadPreview = document.getElementById('uploadPreview');
        const previewImage = document.getElementById('previewImage');

        if (fotoBuktiInput) {
            fotoBuktiInput.addEventListener('change', function () {
                const file = this.files[0];

                if (!file) {
                    return;
                }

                uploadBox.classList.add('has-file');
                uploadTitle.textContent = 'Foto berhasil dipilih';
                uploadFileName.textContent = file.name;
                uploadFileName.style.display = 'block';

                const reader = new FileReader();

                reader.onload = function (event) {
                    previewImage.src = event.target.result;
                    uploadPreview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            });
        }
    </script>
</x-app-layout>