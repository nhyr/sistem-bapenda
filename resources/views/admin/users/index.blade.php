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

        .btn-primary {
            background: #ef4444;
            color: #ffffff;
            padding: 12px 18px;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 900;
            font-size: 13px;
            box-shadow: 0 10px 20px rgba(239, 68, 68, 0.25);
            white-space: nowrap;
        }

        .btn-primary:hover {
            background: #dc2626;
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

        .table-card {
            border: 1px solid #e5e7eb;
            border-radius: 22px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 14px 28px rgba(15, 23, 42, 0.06);
        }

        .table-header {
            padding: 22px;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }

        .table-header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 900;
            color: #0f172a;
        }

        .table-header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            padding: 14px 18px;
            text-align: left;
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .7px;
            border-bottom: 1px solid #e5e7eb;
            background: #f8fafc;
            white-space: nowrap;
        }

        td {
            padding: 16px 18px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: #334155;
            vertical-align: middle;
        }

        tr:hover td {
            background: #fff7ed;
        }

        .badge {
            display: inline-flex;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 900;
            white-space: nowrap;
        }

        .badge-admin {
            background: #fee2e2;
            color: #b91c1c;
        }

        .badge-staff {
            background: #dcfce7;
            color: #166534;
        }

        .action-wrapper {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .btn-edit {
            background: #991b1b;
            color: #ffffff;
            padding: 8px 13px;
            border-radius: 999px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
        }

        .btn-edit:hover {
            background: #7f1d1d;
        }

        .btn-delete {
            background: #ef4444;
            color: #ffffff;
            padding: 8px 13px;
            border-radius: 999px;
            border: none;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

        .empty-row {
            text-align: center;
            padding: 44px 20px;
            color: #64748b;
        }

        .pagination-wrapper {
            padding: 16px;
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

            .btn-primary {
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
                        <h1>Data User</h1>
                        <p>Kelola akun admin dan staff pelayanan.</p>
                    </div>

                    <a href="{{ route('admin.users.create') }}" class="btn-primary">
                        + Tambah User
                    </a>
                </div>

                <div class="table-card">
                    <div class="table-header">
                        <h2>Daftar User</h2>
                        <p>Data akun yang memiliki akses ke sistem pelaporan BAPENDA.</p>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Unit Kerja</th>
                                    <th>No HP</th>
                                    <th style="text-align: right;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>
                                            <strong style="color: #0f172a;">
                                                {{ $user->name }}
                                            </strong>
                                        </td>

                                        <td>{{ $user->email }}</td>

                                        <td>
                                            @if ($user->role === 'admin')
                                                <span class="badge badge-admin">
                                                    ADMIN
                                                </span>
                                            @else
                                                <span class="badge badge-staff">
                                                    STAFF
                                                </span>
                                            @endif
                                        </td>

                                        <td>{{ $user->unit_kerja ?? '-' }}</td>

                                        <td>{{ $user->no_hp ?? '-' }}</td>

                                        <td style="text-align: right;">
                                            <div class="action-wrapper">
                                                <a
                                                    href="{{ route('admin.users.edit', $user) }}"
                                                    class="btn-edit"
                                                >
                                                    Edit
                                                </a>

                                                <form
                                                    action="{{ route('admin.users.destroy', $user) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')"
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
                                        <td colspan="6">
                                            <div class="empty-row">
                                                Belum ada data user.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-wrapper">
                        {{ $users->links() }}
                    </div>
                </div>
            </main>

        </div>
    </div>
</x-app-layout>