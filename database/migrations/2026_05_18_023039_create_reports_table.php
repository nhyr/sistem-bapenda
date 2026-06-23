<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relasi User
            |--------------------------------------------------------------------------
            */
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('admin_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('teknisi_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Relasi Asset
            |--------------------------------------------------------------------------
            */
            $table->foreignId('asset_id')
                ->nullable()
                ->constrained('assets')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Data Laporan
            |--------------------------------------------------------------------------
            */
            $table->enum('jenis_laporan', ['sistem', 'asset']);
            $table->string('judul');
            $table->text('deskripsi');

            /*
            |--------------------------------------------------------------------------
            | Detail Sistem / Asset
            |--------------------------------------------------------------------------
            */
            $table->string('nama_sistem')->nullable();
            $table->string('url_sistem')->nullable();
            $table->string('lokasi_kejadian')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Bukti Laporan
            |--------------------------------------------------------------------------
            */
            $table->string('foto_bukti')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Prioritas dan Status
            |--------------------------------------------------------------------------
            */
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi'])
                ->default('sedang');

            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])
                ->default('menunggu');

            /*
            |--------------------------------------------------------------------------
            | Catatan Penanganan
            |--------------------------------------------------------------------------
            */
            $table->text('catatan_admin')->nullable();
            $table->text('catatan_teknisi')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Waktu Penanganan
            |--------------------------------------------------------------------------
            */
            $table->timestamp('ditangani_pada')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};