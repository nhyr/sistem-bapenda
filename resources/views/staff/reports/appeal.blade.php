<x-app-layout>
    <style>
        body {
            background: #f1f5f9;
        }

        .appeal-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #fee2e2, #fff7ed, #f8fafc);
            padding: 28px;
        }

        .appeal-container {
            max-width: 980px;
            margin: 0 auto;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
        }

        .card-header {
            padding: 26px;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }

        .card-header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 900;
            color: #991b1b;
        }

        .card-header p {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .card-body {
            padding: 26px;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 18px;
            font-size: 14px;
            font-weight: 700;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .report-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 18px;
            padding: 18px;
            margin-bottom: 22px;
        }

        .report-box h2 {
            margin: 0 0 8px;
            color: #991b1b;
            font-size: 18px;
            font-weight: 900;
        }

        .report-box p {
            margin: 0 0 8px;
            color: #374151;
            font-size: 14px;
            line-height: 1.7;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 900;
            color: #374151;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .form-textarea,
        .form-input {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            padding: 13px 14px;
            font-size: 14px;
            color: #334155;
            outline: none;
            background: #ffffff;
        }

        .form-textarea:focus,
        .form-input:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
        }

        .form-textarea {
            min-height: 150px;
            resize: vertical;
        }

        .helper-text {
            margin-top: 7px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .button-group {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 24px;
        }

        .btn {
            border: none;
            border-radius: 999px;
            padding: 12px 20px;
            font-size: 13px;
            font-weight: 900;
            text-decoration: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: #dc2626;
            color: #ffffff;
            box-shadow: 0 10px 20px rgba(220, 38, 38, 0.25);
        }

        .btn-primary:hover {
            background: #b91c1c;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #111827;
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }

        @media (max-width: 640px) {
            .appeal-page {
                padding: 16px;
            }

            .card-header,
            .card-body {
                padding: 20px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>

    <div class="appeal-page">
        <div class="appeal-container">
            <div class="card">
                <div class="card-header">
                    <h1>Ajukan Banding Laporan</h1>
                    <p>
                        Gunakan form ini untuk mengajukan peninjauan ulang terhadap laporan
                        yang telah ditolak oleh admin.
                    </p>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-error">
                            <ul style="margin: 0; padding-left: 18px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="report-box">
                        <h2>{{ $report->judul }}</h2>

                        <p>
                            <strong>Status:</strong>
                            Ditolak
                        </p>

                        @if ($report->catatan_admin)
                            <p>
                                <strong>Catatan Admin:</strong><br>
                                {{ $report->catatan_admin }}
                            </p>
                        @else
                            <p>
                                <strong>Catatan Admin:</strong><br>
                                Belum ada catatan admin.
                            </p>
                        @endif
                    </div>

                    <form
                        action="{{ route('staff.reports.appeal.store', $report) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @csrf

                        <div class="form-group">
                            <label class="form-label">Alasan Banding</label>

                            <textarea
                                name="alasan_banding"
                                class="form-textarea"
                                placeholder="Jelaskan alasan mengapa laporan ini perlu ditinjau ulang oleh admin..."
                                required
                            >{{ old('alasan_banding') }}</textarea>

                            <div class="helper-text">
                                Tulis alasan secara jelas, misalnya kerusakan masih terjadi, data laporan sudah benar,
                                atau terdapat bukti tambahan.
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Lampiran Tambahan</label>

                            <input
                                type="file"
                                name="lampiran_banding"
                                class="form-input"
                                accept=".jpg,.jpeg,.png,.webp,.pdf"
                            >

                            <div class="helper-text">
                                Opsional. Format yang diperbolehkan: JPG, JPEG, PNG, WEBP, atau PDF. Maksimal 2MB.
                            </div>
                        </div>

                        <div class="button-group">
                            <a
                                href="{{ route('staff.reports.show', $report) }}"
                                class="btn btn-secondary"
                            >
                                ← Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Kirim Banding
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>