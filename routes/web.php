<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Import_AbsensiController;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\Leader_PerformController;
use App\Http\Controllers\TimController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Leader Perform //
Route::get('/leaderPerformance', [Leader_PerformController::class, 'index'])->name('leader-performance')->middleware('auth');
Route::get('/getNamaLeader', [Leader_PerformController::class, 'getNamaLeader'])->name('getNamaLeader')->middleware('auth');

Route::get('/getAbsensiMonthly', [Leader_PerformController::class, 'getAbsensiMonthly'])->name('getAbsensiMonthly')->middleware('auth');
Route::get('/getAbsensi', [Leader_PerformController::class, 'getAbsensi'])->name('getAbsensi')->middleware('auth');
Route::get('/getAbsensiTim', [Leader_PerformController::class, 'getAbsensiTim'])->name('getAbsensiTim')->middleware('auth');

Route::get('/getTotalWO', [Leader_PerformController::class, 'getTotalWO'])->name('getTotalWO')->middleware('auth');
Route::get('/getRemarkWO', [Leader_PerformController::class, 'getRemarkWO'])->name('getRemarkWO')->middleware('auth');
Route::get('/getPreconWO', [Leader_PerformController::class, 'getPreconWO'])->name('getPreconWO')->middleware('auth');
Route::get('/getStatusPrecon', [Leader_PerformController::class, 'getStatusPrecon'])->name('getStatusPrecon')->middleware('auth');
Route::get('/getProgresWO', [Leader_PerformController::class, 'getProgresWO'])->name('getProgresWO')->middleware('auth');
Route::get('/getCheckin09', [Leader_PerformController::class, 'getCheckin09'])->name('getCheckin09')->middleware('auth');
Route::get('/getCheckinAll', [Leader_PerformController::class, 'getCheckinAll'])->name('getCheckinAll')->middleware('auth');

// End Leader Perform //

// Karyawan //
Route::get('/karyawan', [karyawanController::class, 'index'])->name('dataKaryawan')->middleware('auth');
Route::get('/getDataKaryawan', [karyawanController::class, 'getDataKaryawan'])->name('getDataKaryawan')->middleware('auth');
Route::post('/simpankaryawan', [karyawanController::class, 'simpankaryawan'])->name('simpankaryawan')->middleware('auth');
Route::get('/detailKaryawan/{id}', [karyawanController::class, 'detailKaryawan'])->name('detailKaryawan')->middleware('auth');
Route::put('/updateKaryawan/{id}', [karyawanController::class, 'updateKaryawan'])->name('updateKaryawan')->middleware('auth');

//end Karyawan //

// Tim & Callsign //
Route::get('/dataTim', [TimController::class, 'index'])->name('dataTim')->middleware('auth');
Route::get('/getDataLead', [TimController::class, 'getDataLead'])->name('getDataLead')->middleware('auth');
Route::get('/getLeader', [TimController::class, 'getLeader'])->name('getLeader')->middleware('auth');
Route::post('/simpanLead', [TimController::class, 'simpanLead'])->name('simpanLead')->middleware('auth');
Route::get('/showDetailLead', [TimController::class, 'showDetailLead'])->name('showDetailLead')->middleware('auth');
Route::get('/getDetailLead', [TimController::class, 'getDetailLead'])->name('getDetailLead')->middleware('auth');
Route::get('/getPosisi', [TimController::class, 'getPosisi'])->name('getPosisi')->middleware('auth');
Route::put('/updateLead/{id}', [TimController::class, 'updateLead'])->name('updateLead')->middleware('auth');

//Sub bagian Callsign Tim
Route::get('/getDataLeadCallsign', [TimController::class, 'getDataLeadCallsign'])->name('getDataLeadCallsign')->middleware('auth');
Route::get('/getDataShowTim', [TimController::class, 'getDataShowTim'])->name('getDataShowTim')->middleware('auth');
Route::get('/getDataTim', [TimController::class, 'getDataTim'])->name('getDataTim')->middleware('auth');
Route::get('/getTeknisi', [TimController::class, 'getTeknisi'])->name('getTeknisi')->middleware('auth');
Route::post('/simpanTim', [TimController::class, 'simpanTim'])->name('simpanTim')->middleware('auth');
Route::get('/getDetailTim', [TimController::class, 'getDetailTim'])->name('getDetailTim')->middleware('auth');

Route::get('/updateTim/{id}', [TimController::class, 'updateTim'])->name('updateTim')->middleware('auth');
//end Tim & Callsign //


//Start Tools//
Route::get('/dataTool', [TimController::class, 'index'])->name('dataTool')->middleware('auth');
//End Tools//


// Import Absensi //
Route::get('/importPerformance', [Import_AbsensiController::class, 'index'])->name('import-performance')->middleware('auth');
Route::post('/importDataAbsensi', [Import_AbsensiController::class, 'importDataAbsensi'])->name('import-dataAbsensi')->middleware('auth');
Route::get('/getDataAbsensi', [Import_AbsensiController::class, 'getDataAbsensi'])->name('getdataAbsensi')->middleware('auth');
Route::post('/saveImportAbsensi', [Import_AbsensiController::class, 'saveImportAbsensi'])->name('saveImportAbsensi')->middleware('auth');
Route::get('/getFilterPreview', [Import_AbsensiController::class, 'getFilterPreview'])->name('getFilterPreview')->middleware('auth');

// End Import Absensi //

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/tables', function () {
    return view('tables');
})->name('tables')->middleware('auth');

Route::get('/wallet', function () {
    return view('wallet');
})->name('wallet')->middleware('auth');

Route::get('/RTL', function () {
    return view('RTL');
})->name('RTL')->middleware('auth');

Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('auth');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('account-pages.signup');
})->name('signup')->middleware('guest');

Route::get('/sign-up', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('sign-up');

Route::post('/sign-up', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');

Route::get('/laravel-examples/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');
Route::put('/laravel-examples/user-profile/update', [ProfileController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('/laravel-examples/users-management', [UserController::class, 'index'])->name('users-management')->middleware('auth');
