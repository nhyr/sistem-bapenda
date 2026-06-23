<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'staff', 'teknisi'])
                ->default('staff')
                ->after('password');

            $table->string('unit_kerja')
                ->nullable()
                ->after('role');

            $table->string('no_hp')
                ->nullable()
                ->after('unit_kerja');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'unit_kerja',
                'no_hp',
            ]);
        });
    }
};