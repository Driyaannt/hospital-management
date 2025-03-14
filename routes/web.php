<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RekamMedikController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\BedController;

// Route untuk pengguna yang belum login (guest)
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Route untuk pengguna yang sudah login (auth)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route umum untuk semua role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/my-profile', [MyProfileController::class, 'index'])->name('v-my-profile');


    // Routes khusus untuk admin
    Route::middleware('role:admin')->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('v-data-user');
            Route::get('/create', [UserController::class, 'create'])->name('v-user-create');
            Route::get('/edit/{id}', [UserController::class, 'create'])->name('user.edit');
            Route::post('/store/{id?}', [UserController::class, 'store'])->name('user.store');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.delete');
        });

        Route::prefix('patient')->group(function () {
            Route::get('/', [PatientController::class, 'index'])->name('v-data-patients');
            Route::get('/create', [PatientController::class, 'create'])->name('v-patient-create');
            Route::get('/edit/{id}', [PatientController::class, 'create'])->name('patient.edit');
            Route::post('/store/{id?}', [PatientController::class, 'store'])->name('patient.store');
            Route::put('/update/{id}', [PatientController::class, 'update'])->name('patient.update');
            Route::delete('/{id}', [PatientController::class, 'destroy'])->name('patient.delete');
        });


        Route::prefix('bed')->group(function () {
            Route::get('/', [BedController::class, 'index'])->name('v-data-bed');
            Route::get('/create', [BedController::class, 'create'])->name('v-bed-create');
            Route::get('/edit/{id}', [BedController::class, 'create'])->name('bed.edit');
            Route::post('/store/{id?}', [BedController::class, 'store'])->name('bed.store');
            Route::put('/update/{id}', [BedController::class, 'update'])->name('bed.update');
            Route::delete('/{id}', [BedController::class, 'destroy'])->name('bed.delete');
        });


        // Route::prefix('rekam-medik')->group(function () {
        //     Route::get('/history-rm', [RekamMedikController::class, 'index'])->name('v-history-rm');
        //     Route::get('/create-assesment/{id}', [RekamMedikController::class, 'create'])->name('v-assesment-create');
        //     Route::get('/edit-assesment/{id}', [RekamMedikController::class, 'create'])->name('v-assesment-edit');
        //     Route::post('/store-assesment/{id?}', [RekamMedikController::class, 'store'])->name('assesment.store');
        //     Route::get('/update-assesment/{id}', [RekamMedikController::class, 'update'])->name('assesment.update');
        //     Route::delete('/{id}', [RekamMedikController::class, 'destroy'])->name('assesment.delete');
        //     Route::get('/search-patient', [PatientController::class, 'searchPatient']);
        // });
    });

    // Middleware untuk Admin dan Dokter
    Route::middleware('role:admin,dokter')->group(function () {
        Route::prefix('rekam-medik')->group(function () {
            Route::get('/history-rm', [RekamMedikController::class, 'index'])->name('v-history-rm');
            // Route::get('/create-assesment', [RekamMedikController::class, 'create'])
            //     ->name('v-assesment-create');
            Route::get('/print-barcode', [RekamMedikController::class, 'printBarcode'])->name('print.barcode');
            Route::get('/create-assesment/{id}', [RekamMedikController::class, 'create'])
                ->where('id', '[0-9]+') // Hanya menerima angka
                ->name('v-assesment-create-id');
            Route::get('/edit-assesment/{id}', [RekamMedikController::class, 'create'])->name('v-assesment-edit');
            Route::get('/assesment/{id}', [RekamMedikController::class, 'show'])->name('v-assesment-show');
            Route::post('/store-assesment/{id?}', [RekamMedikController::class, 'store'])->name('assesment.store');
            Route::put('/update-assesment/{id}', [RekamMedikController::class, 'store'])->name('assesment.update');

            Route::delete('/{id}', [RekamMedikController::class, 'destroy'])->name('assesment.delete');
            Route::get('/search-patient', [PatientController::class, 'searchPatient']);
        });
    });


    // Route untuk dashboard dokter
    Route::middleware('role:dokter')->group(function () {
        Route::get('/dokter/dashboard', [DashboardController::class, 'index'])->name('dokter.dashboard');
    });

    // Route untuk dashboard perawat
    Route::middleware('role:perawat')->group(function () {
        Route::get('/perawat/dashboard', [DashboardController::class, 'index'])->name('perawat.dashboard');
    });

    // Route untuk dashboard apoteker
    Route::middleware('role:apoteker')->group(function () {
        Route::get('/apoteker/dashboard', [DashboardController::class, 'index'])->name('apoteker.dashboard');
    });
});
