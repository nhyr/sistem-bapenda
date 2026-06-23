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

    .alert-success {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
        padding: 14px 16px;
        border-radius: 16px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 800;
    }

    .section-card {
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 20px;
        background: #ffffff;
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.04);
    }

    .section-header {
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
        padding: 18px 20px;
    }

    .section-header h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 900;
        color: #0f172a;
    }

    .section-header p {
        margin: 5px 0 0;
        color: #64748b;
        font-size: 13px;
    }

    .section-body {
        padding: 20px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
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
    }

    .form-control:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.12);
    }

    .form-control[disabled] {
        background: #f8fafc;
        color: #64748b;
        cursor: not-allowed;
    }

    .helper-text {
        margin-top: 6px;
        font-size: 12px;
        color: #64748b;
    }

    .form-error {
        margin-top: 6px;
        font-size: 12px;
        color: #dc2626;
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

    .btn-danger {
        padding: 11px 20px;
        border-radius: 999px;
        border: none;
        background: #991b1b;
        color: #ffffff;
        font-size: 13px;
        font-weight: 900;
        cursor: pointer;
    }

    .btn-danger:hover {
        background: #7f1d1d;
    }

    .warning-box {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
        border-radius: 16px;
        padding: 14px 16px;
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 18px;
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
        .btn-submit,
        .btn-danger {
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
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}">
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
                        <a href="{{ route('admin.users.index') }}">
                            <span>👥</span>
                            <span>Data User</span>
                        </a>
                    @else
                        <a href="{{ route('staff.dashboard') }}">
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
                    @endif

                    <a href="{{ route('profile.edit') }}" class="active">
                        <span>👤</span>
                        <span>Profile</span>
                    </a>
                </nav>
            </aside>

            <main class="main-card">
                <div class="form-header">
                    <h1>Profile Akun</h1>
                    <p>Kelola informasi akun dan keamanan password Anda.</p>
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

                    @if (session('status') === 'profile-updated')
                        <div class="alert-success">
                            Profile berhasil diperbarui.
                        </div>
                    @endif

                    @if (session('status') === 'password-updated')
                        <div class="alert-success">
                            Password berhasil diperbarui.
                        </div>
                    @endif

                    {{-- Informasi Profile --}}
                    <div class="section-card">
                        <div class="section-header">
                            <h2>Informasi Profile</h2>
                            <p>Perbarui nama dan email akun Anda.</p>
                        </div>

                        <div class="section-body">
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PATCH')

                                <div class="form-grid">
                                    <div>
                                        <label class="form-label">
                                            Nama <span class="required">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            name="name"
                                            value="{{ old('name', $user->name) }}"
                                            class="form-control"
                                            required
                                        >

                                        @error('name')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
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

                                        @error('email')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="form-label">
                                            Role
                                        </label>

                                        <input
                                            type="text"
                                            value="{{ strtoupper($user->role) }}"
                                            class="form-control"
                                            disabled
                                        >

                                        <div class="helper-text">
                                            Role hanya dapat diubah oleh admin melalui menu Data User.
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label">
                                            Unit Kerja
                                        </label>

                                        <input
                                            type="text"
                                            value="{{ $user->unit_kerja ?? '-' }}"
                                            class="form-control"
                                            disabled
                                        >

                                        <div class="helper-text">
                                            Unit kerja hanya dapat diubah oleh admin.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-footer">
                                    <a
                                        href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('staff.dashboard') }}"
                                        class="btn-cancel"
                                    >
                                        Kembali
                                    </a>

                                    <button type="submit" class="btn-submit">
                                        Simpan Profile
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Update Password --}}
                    <div class="section-card">
                        <div class="section-header">
                            <h2>Update Password</h2>
                            <p>Gunakan password yang kuat untuk menjaga keamanan akun.</p>
                        </div>

                        <div class="section-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="form-grid">
                                    <div>
                                        <label class="form-label">
                                            Password Saat Ini
                                        </label>

                                        <input
                                            type="password"
                                            name="current_password"
                                            class="form-control"
                                            autocomplete="current-password"
                                        >

                                        @error('current_password', 'updatePassword')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="form-label">
                                            Password Baru
                                        </label>

                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control"
                                            autocomplete="new-password"
                                        >

                                        @error('password', 'updatePassword')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="form-label">
                                            Konfirmasi Password Baru
                                        </label>

                                        <input
                                            type="password"
                                            name="password_confirmation"
                                            class="form-control"
                                            autocomplete="new-password"
                                        >

                                        @error('password_confirmation', 'updatePassword')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn-submit">
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Hapus Akun --}}
                    <div class="section-card">
                        <div class="section-header">
                            <h2>Hapus Akun</h2>
                            <p>Tindakan ini akan menghapus akun secara permanen.</p>
                        </div>

                        <div class="section-body">
                            <div class="warning-box">
                                Setelah akun dihapus, seluruh data akun tidak dapat dikembalikan.
                                Pastikan Anda benar-benar ingin menghapus akun ini.
                            </div>

                            <form
                                method="POST"
                                action="{{ route('profile.destroy') }}"
                                onsubmit="return confirm('Yakin ingin menghapus akun ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <div class="form-grid">
                                    <div>
                                        <label class="form-label">
                                            Password
                                        </label>

                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control"
                                            placeholder="Masukkan password akun"
                                        >

                                        @error('password', 'userDeletion')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn-danger">
                                        Hapus Akun
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>
</x-app-layout>