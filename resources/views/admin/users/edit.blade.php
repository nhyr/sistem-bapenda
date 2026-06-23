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

        .form-control:disabled {
            background: #f1f5f9;
            color: #94a3b8;
            cursor: not-allowed;
        }

        .helper-text {
            margin-top: 6px;
            font-size: 12px;
            color: #64748b;
            line-height: 1.5;
        }

        .helper-text.active {
            color: #991b1b;
            font-weight: 700;
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
                    BAPEN<span>DA</span>
                </div>

                <nav class="sidebar-menu">
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    >
                        <span>📊</span>
                        <span>Dashboard</span>
                    </a>

                    <a
                        href="{{ route('admin.reports.index') }}"
                        class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"
                    >
                        <span>📁</span>
                        <span>Riwayat Laporan Masuk</span>
                    </a>

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                    >
                        <span>👥</span>
                        <span>Data User</span>
                    </a>

                    <a href="{{ route('profile.edit') }}">
                        <span>👤</span>
                        <span>Profile</span>
                    </a>
                </nav>
            </aside>

            <main class="main-card">
                <div class="form-header">
                    <h1>Edit User</h1>
                    <p>Perbarui data akun admin, staff pelayanan, atau teknisi.</p>
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

                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-grid">
                            <div>
                                <label class="form-label">
                                    Nama User <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="form-control"
                                    required
                                >
                            </div>

                            <div>
                                <label class="form-label">
                                    Email <span class="required">*</span>
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="form-control"
                                    required
                                >
                            </div>

                            <div>
                                <label class="form-label">
                                    Password Baru
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Kosongkan jika tidak diganti"
                                >

                                <div class="helper-text">
                                    Kosongkan jika tidak ingin mengganti password.
                                </div>
                            </div>

                            <div>
                                <label class="form-label">
                                    Role <span class="required">*</span>
                                </label>

                                <select
                                    name="role"
                                    id="role"
                                    class="form-control"
                                    required
                                >
                                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>

                                    <option value="staff" {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>
                                        Staff Pelayanan
                                    </option>

                                    <option value="teknisi" {{ old('role', $user->role) === 'teknisi' ? 'selected' : '' }}>
                                        Teknisi
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label class="form-label">
                                    Kategori Teknisi
                                </label>

                                <select
                                    name="kategori_teknisi"
                                    id="kategori_teknisi"
                                    class="form-control"
                                >
                                    <option value="">Pilih Kategori Teknisi</option>

                                    <option value="sistem" {{ old('kategori_teknisi', $user->kategori_teknisi) === 'sistem' ? 'selected' : '' }}>
                                        Teknisi Sistem / Software
                                    </option>

                                    <option value="barang" {{ old('kategori_teknisi', $user->kategori_teknisi) === 'barang' ? 'selected' : '' }}>
                                        Teknisi Barang / Asset
                                    </option>
                                </select>

                                <div class="helper-text" id="kategori_teknisi_help">
                                    Kategori teknisi hanya bisa diisi jika role adalah teknisi.
                                </div>
                            </div>

                            <div>
                                <label class="form-label">
                                    Unit Kerja
                                </label>

                                <input
                                    type="text"
                                    name="unit_kerja"
                                    value="{{ old('unit_kerja', $user->unit_kerja) }}"
                                    class="form-control"
                                    placeholder="Contoh: Pelayanan"
                                >
                            </div>

                            <div>
                                <label class="form-label">
                                    No HP
                                </label>

                                <input
                                    type="text"
                                    name="no_hp"
                                    value="{{ old('no_hp', $user->no_hp) }}"
                                    class="form-control"
                                    placeholder="Contoh: 081234567890"
                                >
                            </div>
                        </div>

                        <div class="form-footer">
                            <a href="{{ route('admin.users.index') }}" class="btn-cancel">
                                Batal
                            </a>

                            <button type="submit" class="btn-submit">
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </main>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role');
            const kategoriSelect = document.getElementById('kategori_teknisi');
            const helperText = document.getElementById('kategori_teknisi_help');

            function toggleKategoriTeknisi() {
                if (roleSelect.value === 'teknisi') {
                    kategoriSelect.disabled = false;
                    kategoriSelect.required = true;
                    kategoriSelect.style.background = '#ffffff';
                    kategoriSelect.style.cursor = 'pointer';

                    helperText.textContent = 'Wajib dipilih jika role user adalah teknisi.';
                    helperText.classList.add('active');
                } else {
                    kategoriSelect.value = '';
                    kategoriSelect.disabled = true;
                    kategoriSelect.required = false;
                    kategoriSelect.style.background = '#f1f5f9';
                    kategoriSelect.style.cursor = 'not-allowed';

                    helperText.textContent = 'Kategori teknisi hanya bisa diisi jika role adalah teknisi.';
                    helperText.classList.remove('active');
                }
            }

            roleSelect.addEventListener('change', toggleKategoriTeknisi);
            toggleKategoriTeknisi();
        });
    </script>
</x-app-layout>