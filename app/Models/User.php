<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'role',
    'kategori_teknisi',
    'unit_kerja',
    'no_hp',
])]
#[Hidden([
    'password',
    'remember_token',
])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Relasi: staff dapat memiliki banyak laporan.
     */
    public function reports()
    {
        return $this->hasMany(Report::class, 'user_id');
    }

    /**
     * Relasi: admin dapat menangani banyak laporan.
     */
    public function handledReports()
    {
        return $this->hasMany(Report::class, 'admin_id');
    }

    /**
     * Relasi: teknisi dapat menerima banyak laporan yang ditugaskan.
     */
    public function assignedReports()
    {
        return $this->hasMany(Report::class, 'teknisi_id');
    }

    /**
     * Cek apakah user adalah admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah staff.
     */
    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    /**
     * Cek apakah user adalah teknisi.
     */
    public function isTeknisi(): bool
    {
        return $this->role === 'teknisi';
    }

    /**
     * Cek apakah user adalah teknisi sistem/software.
     */
    public function isTeknisiSistem(): bool
    {
        return $this->role === 'teknisi'
            && $this->kategori_teknisi === 'sistem';
    }

    /**
     * Cek apakah user adalah teknisi barang/aset.
     */
    public function isTeknisiBarang(): bool
    {
        return $this->role === 'teknisi'
            && $this->kategori_teknisi === 'barang';
    }

    /**
     * Label role untuk tampilan.
     */
    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'admin' => 'Admin Bapenda',
            'staff' => 'Staff Pelayanan',
            'teknisi' => $this->kategori_teknisi === 'sistem'
                ? 'Teknisi Sistem'
                : 'Teknisi Barang',
            default => 'User',
        };
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}