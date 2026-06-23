<?php

use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReportAppealController as AdminReportAppealController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\Staff\ReportAppealController as StaffReportAppealController;
use App\Http\Controllers\Staff\ReportController as StaffReportController;
use App\Http\Controllers\Teknisi\DashboardController as TeknisiDashboardController;
use App\Http\Controllers\Teknisi\ReportController as TeknisiReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Redirect Dashboard Berdasarkan Role
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if (auth()->user()->isTeknisi()) {
            return redirect()->route('teknisi.dashboard');
        }

        return redirect()->route('staff.dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:admin')
        ->group(function () {
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])
                ->name('dashboard');

            Route::get('/reports', [AdminReportController::class, 'index'])
                ->name('reports.index');

            /*
            |--------------------------------------------------------------------------
            | Export Excel
            |--------------------------------------------------------------------------
            | Dibuat dengan URL khusus agar tidak bentrok dengan /reports/{report}
            */
            Route::get('/reports-export-excel', [AdminReportController::class, 'export'])
                ->name('reports.export');

            Route::get('/reports/{report}', [AdminReportController::class, 'show'])
                ->whereNumber('report')
                ->name('reports.show');

            Route::put('/reports/{report}/status', [AdminReportController::class, 'updateStatus'])
                ->whereNumber('report')
                ->name('reports.update-status');

            Route::patch('/report-appeals/{appeal}/review', [AdminReportAppealController::class, 'review'])
                ->whereNumber('appeal')
                ->name('report-appeals.review');

            Route::resource('/assets', AssetController::class);
            Route::resource('/users', UserController::class);
        });

    /*
    |--------------------------------------------------------------------------
    | Staff Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('staff')
        ->name('staff.')
        ->middleware('role:staff')
        ->group(function () {
            Route::get('/dashboard', [StaffDashboardController::class, 'index'])
                ->name('dashboard');

            Route::get('/reports', [StaffReportController::class, 'index'])
                ->name('reports.index');

            Route::get('/reports/create', [StaffReportController::class, 'create'])
                ->name('reports.create');

            Route::post('/reports', [StaffReportController::class, 'store'])
                ->name('reports.store');

            Route::get('/reports/{report}/appeal', [StaffReportAppealController::class, 'create'])
                ->whereNumber('report')
                ->name('reports.appeal.create');

            Route::post('/reports/{report}/appeal', [StaffReportAppealController::class, 'store'])
                ->whereNumber('report')
                ->name('reports.appeal.store');

            Route::get('/reports/{report}', [StaffReportController::class, 'show'])
                ->whereNumber('report')
                ->name('reports.show');

            Route::delete('/reports/{report}', [StaffReportController::class, 'destroy'])
                ->whereNumber('report')
                ->name('reports.destroy');
        });

    /*
    |--------------------------------------------------------------------------
    | Teknisi Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('teknisi')
        ->name('teknisi.')
        ->middleware('role:teknisi')
        ->group(function () {
            Route::get('/dashboard', [TeknisiDashboardController::class, 'index'])
                ->name('dashboard');

            Route::get('/reports', [TeknisiReportController::class, 'index'])
                ->name('reports.index');

            Route::get('/reports/{report}', [TeknisiReportController::class, 'show'])
                ->whereNumber('report')
                ->name('reports.show');

            Route::put('/reports/{report}/progress', [TeknisiReportController::class, 'updateProgress'])
                ->whereNumber('report')
                ->name('reports.update-progress');
        });

    /*
    |--------------------------------------------------------------------------
    | Profile Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';