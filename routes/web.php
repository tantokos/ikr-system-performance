<?php

use App\Http\Controllers\analisa_woController;
use App\Http\Controllers\AssignTimController;
use App\Http\Controllers\FtthDismantleController;
use App\Http\Controllers\ImportDataMaterialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\DistribusiToolController;
use App\Http\Controllers\Import_AbsensiController;
use App\Http\Controllers\Import_DataWoController;
use App\Http\Controllers\ImportDataWoApkController;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\KembaliTool;
use App\Http\Controllers\KembaliToolController;
use App\Http\Controllers\LaporanToolController;
use App\Http\Controllers\Leader_PerformController;
use App\Http\Controllers\MonitFotoFtthMT_Controller;
use App\Http\Controllers\MonitFTTH_MTController;
use App\Http\Controllers\MonitFtthIB_Controller;
use App\Http\Controllers\MonitFtthMT_Controller;
use App\Http\Controllers\Monitoring_FTTH_IB;
use App\Http\Controllers\RekapAssignTimController;
use App\Http\Controllers\RekapProgressWOController;
use App\Http\Controllers\RescheduleWO_Controller;
use App\Http\Controllers\TimController;
use App\Http\Controllers\ToolController;

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
Route::post('/updateKaryawan', [karyawanController::class, 'updateKaryawan'])->name('updateKaryawan')->middleware('auth');

//end Karyawan //

// Tim & Callsign //
Route::get('/dataTim', [TimController::class, 'index'])->name('dataTim')->middleware('auth');
Route::get('/getDataLead', [TimController::class, 'getDataLead'])->name('getDataLead')->middleware('auth');
Route::get('/getLeader', [TimController::class, 'getLeader'])->name('getLeader')->middleware('auth');
Route::post('/simpanLead', [TimController::class, 'simpanLead'])->name('simpanLead')->middleware('auth');
Route::get('/showDetailLead', [TimController::class, 'showDetailLead'])->name('showDetailLead')->middleware('auth');
Route::get('/getDetailLead', [TimController::class, 'getDetailLead'])->name('getDetailLead')->middleware('auth');
Route::get('/getListTool', [TimController::class, 'getListTool'])->name('getListTool')->middleware('auth');

Route::get('/getListWo', [TimController::class, 'getListWo'])->name('getListWo')->middleware('auth');

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

//Assign Tim//
Route::get('/analisaWo', [analisa_woController::class, 'index'])->name('analisaWo')->middleware('auth');

Route::get('/rekapAssignTim', [RekapAssignTimController::class, 'index'])->name('rekapAssignTim')->middleware('auth');
Route::get('/getTabelLeadAssignTim', [RekapAssignTimController::class, 'getTabelLeadAssignTim'])->name('getTabelLeadAssignTim')->middleware('auth');
Route::get('/getDetailLeadAssignTim', [RekapAssignTimController::class, 'getDetailLeadAssignTim'])->name('getDetailLeadAssignTim')->middleware('auth');

Route::get('/assignTim', [AssignTimController::class, 'index'])->name('assignTim')->middleware('auth');
Route::get('/getTabelAssignTim', [AssignTimController::class, 'getTabelAssignTim'])->name('getTabelAssignTim')->middleware('auth');
Route::get('/getDetailAssign', [AssignTimController::class, 'getDetailAssign'])->name('getDetailAssign')->middleware('auth');
Route::get('/getLeadCallsignAssign', [AssignTimController::class, 'getLeadCallsignAssign'])->name('getLeadCallsignAssign')->middleware('auth');
Route::get('/getTeknisi', [AssignTimController::class, 'getTeknisi'])->name('getTeknisi')->middleware('auth');

Route::post('/simpanSignTim', [AssignTimController::class, 'simpanSignTim'])->name('simpanSignTim')->middleware('auth');
Route::post('/updateSignTim', [AssignTimController::class, 'updateSignTim'])->name('updateSignTim')->middleware('auth');

Route::get('/importDataWo', [Import_DataWoController::class, 'index'])->name('importDataWo')->middleware('auth');
Route::post('/importProsesDataWo', [Import_DataWoController::class, 'importProsesDataWo'])->name('importProsesDataWo')->middleware('auth');
Route::get('/getdataImportWo', [Import_DataWoController::class, 'getdataImportWo'])->name('getdataImportWo')->middleware('auth');
Route::get('/getDetailImport', [Import_DataWoController::class, 'getDetailImport'])->name('getDetailImport')->middleware('auth');
Route::get('/getMaterial', [Import_DataWoController::class, 'getMaterial'])->name('getMaterial')->middleware('auth');

Route::get('/updateImportWo', [Import_DataWoController::class, 'updateImportWo'])->name('updateImportWo')->middleware('auth');
Route::post('/simpanImportWo', [Import_DataWoController::class, 'simpanImportWo'])->name('simpanImportWo')->middleware('auth');

//Import Data Wo Apk
Route::get('/importDataFtthMtApk', [ImportDataWoApkController::class, 'index'])->name('importDataFtthMtApk')->middleware('auth');
Route::post('/importProsesDataWoApk', [ImportDataWoApkController::class, 'importProsesDataWoApk'])->name('importProsesDataWoApk')->middleware('auth');
Route::get('/getFtthMtApk', [ImportDataWoApkController::class, 'getFtthMtApk'])->name('getFtthMtApk')->middleware('auth');
Route::post('/storeFtthMtApk', [ImportDataWoApkController::class, 'storeFtthMtApk'])->name('storeFtthMtApk')->middleware('auth');
Route::post('/updateFtthMtApk', [ImportDataWoApkController::class, 'updateFtthMtApk'])->name('updateFtthMtApk')->middleware('auth');
Route::get('/getDetailCustId', [ImportDataWoApkController::class, 'getDetailCustId'])->name('getDetailCustId')->middleware('auth');

Route::get('/importDataMaterial', [ImportDataMaterialController::class, 'index'])->name('importDataMaterial')->middleware('auth');
Route::post('/importProsesMaterial', [ImportDataMaterialController::class, 'importProsesMaterial'])->name('importProsesMaterial')->middleware('auth');
Route::get('/getDataImportMaterial', [ImportDataMaterialController::class, 'getDataImportMaterial'])->name('getDataImportMaterial')->middleware('auth');
Route::post('/storeFtthMaterial', [ImportDataMaterialController::class, 'storeFtthMaterial'])->name('storeFtthMaterial')->middleware('auth');

//Start Monitoring WO//

Route::get('/rekapProgressWO', [RekapProgressWOController::class, 'index'])->name('rekapProgressWO')->middleware('auth');
Route::get('/getMonthReport', [RekapProgressWOController::class, 'getMonthReport'])->name('getMonthReport')->middleware('auth');
Route::get('/getRekapProgressWO', [RekapProgressWOController::class, 'getRekapProgressWO'])->name('getRekapProgressWO')->middleware('auth');

Route::get('/monitFtthIB', [MonitFtthIB_Controller::class, 'index'])->name('monitFtthIB')->middleware('auth');
Route::get('/monitFtthMT', [MonitFtthMT_Controller::class, 'index'])->name(name: 'monitFtthMT')->middleware('auth');
Route::get('/getDetailCustId', [MonitFtthMT_Controller::class, 'getDetailCustId'])->name('getDetailCustId')->middleware('auth');
Route::get('/detail-customer/{cust_id}', [MonitFtthMT_Controller::class, 'getDetailCustId'])->name('detail-customer')->middleware('auth');
Route::put('/updateFtthMt', [MonitFtthMT_Controller::class, 'update'])->name('updateFtthMt')->middleware('auth');

Route::get('/ftth-dismantle', [FtthDismantleController::class, 'index'])->name('ftth-dismantle')->middleware('auth');


Route::get('/getDataMTOris', [MonitFtthMT_Controller::class, 'getDataMTOris'])->name('getDataMTOris')->middleware('auth');
Route::get('/getDataIBOris', [MonitFtthIB_Controller::class, 'getDataIBOris'])->name('getDataIBOris')->middleware('auth');
Route::get('/getDetailWOFtthMT', [MonitFtthMT_Controller::class, 'getDetailWOFtthMT'])->name('getDetailWOFtthMT')->middleware('auth');
Route::get('/getDetailWOFtthIB', [MonitFtthIB_Controller::class, 'getDetailWOFtthIB'])->name('getDetailWOFtthIB')->middleware('auth');
// Route::get('/getTabelAssignMT', [MonitFTTH_MTController::class, 'getTabelAssignMT'])->name('getTabelAssignMT')->middleware('auth');


//End Monitoring//


//Start Monitoring FOTO APK//

Route::get('/monitFotoFtthMT', [MonitFotoFtthMT_Controller::class, 'index'])->name('monitFotoFtthMT')->middleware('auth');
Route::get('/getMonitFotoFtthMT', [MonitFotoFtthMT_Controller::class, 'getMonitFotoFtthMT'])->name('getMonitFotoFtthMT')->middleware('auth');

Route::get('/getDetailFotoFtthMT', [MonitFotoFtthMT_Controller::class, 'getDetailFotoFtthMT'])->name('getDetailFotoFtthMT')->middleware('auth');

Route::post('/saveValidasi', [MonitFotoFtthMT_Controller::class, 'saveValidasi'])->name('saveValidasi')->middleware('auth');


//End Monitoring FOTO APK//

//Start Tools//
Route::get('/dataTool', [ToolController::class, 'index'])->name('dataTool')->middleware('auth');
Route::get('/getDataTool', [ToolController::class, 'getDataTool'])->name('getDataTool')->middleware('auth');
Route::get('/showDetailTool', [ToolController::class, 'showDetailTool'])->name('showDetailTool')->middleware('auth');
Route::get('/getDataShowTool', [ToolController::class, 'getDataShowTool'])->name('getDataShowTool')->middleware('auth');
Route::get('/getRiwayatTool', [ToolController::class, 'getRiwayatTool'])->name('getRiwayatTool')->middleware('auth');
Route::post('/simpanTool', [ToolController::class, 'simpanTool'])->name('simpanTool')->middleware('auth');

Route::get('/distribusiTool', [DistribusiToolController::class, 'index'])->name('distribusiTool')->middleware('auth');
Route::get('/getDataDistribusi', [DistribusiToolController::class, 'getDataDistribusi'])->name('getDataDistribusi')->middleware('auth');
Route::get('/getDetailDistribusi', [DistribusiToolController::class, 'getDetailDistribusi'])->name('getDetailDistribusi')->middleware('auth');
Route::get('/getLeadCallsign', [DistribusiToolController::class, 'getLeadCallsign'])->name('getLeadCallsign')->middleware('auth');
Route::get('/getTim', [DistribusiToolController::class, 'getTim'])->name('getTim')->middleware('auth');
Route::get('/getSelectTool', [DistribusiToolController::class, 'getSelectTool'])->name('getSelectTool')->middleware('auth');
Route::post('/simpanDistribusi', [DistribusiToolController::class, 'simpanDistribusi'])->name('simpanDistribusi')->middleware('auth');

Route::get('/approveDistribusi', [DistribusiToolController::class, 'approveDistribusi'])->name('approveDistribusi')->middleware('auth');

Route::get('/dataKembaliTool', [KembaliToolController::class, 'index'])->name('dataKembaliTool')->middleware('auth');
Route::get('/getDataKembali', [KembaliToolController::class, 'getDataKembali'])->name('getDataKembali')->middleware('auth');
Route::get('/getDetailKembali', [KembaliToolController::class, 'getDetailKembali'])->name('getDetailKembali')->middleware('auth');

Route::get('/getRawDistribusi', [KembaliToolController::class, 'getRawDistribusi'])->name('getRawDistribusi')->middleware('auth');

Route::post('/simpanPengembalian', [KembaliToolController::class, 'simpanPengembalian'])->name('simpanPengembalian')->middleware('auth');


Route::get('/laporanTool', [LaporanToolController::class, 'index'])->name('laporanTool')->middleware('auth');
Route::get('/getDataPengecekan', [LaporanToolController::class, 'getDataPengecekan'])->name('getDataPengecekan')->middleware('auth');
Route::get('/getDetailCek', [LaporanToolController::class, 'getDetailCek'])->name('getDetailCek')->middleware('auth');

Route::post('/simpanPengecekan', [LaporanToolController::class, 'simpanPengecekan'])->name('simpanPengecekan')->middleware('auth');

//End Tools//


// Import Absensi //
Route::get('/importPerformance', [Import_AbsensiController::class, 'index'])->name('import-performance')->middleware('auth');
Route::post('/importDataAbsensi', [Import_AbsensiController::class, 'importDataAbsensi'])->name('import-dataAbsensi')->middleware('auth');
Route::get('/getDataAbsensi', [Import_AbsensiController::class, 'getDataAbsensi'])->name('getdataAbsensi')->middleware('auth');
Route::post('/saveImportAbsensi', [Import_AbsensiController::class, 'saveImportAbsensi'])->name('saveImportAbsensi')->middleware('auth');
Route::get('/getFilterPreview', [Import_AbsensiController::class, 'getFilterPreview'])->name('getFilterPreview')->middleware('auth');

// End Import Absensi //

//Reschedule WO//
Route::get('/rescheduleWO',[RescheduleWO_Controller::class, 'index'])->name('rescheduleWO')->middleware('auth');

//End Reschedule WO//


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
