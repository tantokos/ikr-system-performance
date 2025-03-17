<?php

use App\Exports\ExportAssignTimFtth;
use App\Http\Controllers\analisa_woController;
use App\Http\Controllers\AreaFat_Controller;
use App\Http\Controllers\AssignTimController;
use App\Http\Controllers\FtthDismantleController;
use App\Http\Controllers\FTTX\ImportAssignTeamController;
use App\Http\Controllers\ImportDataMaterialController;
use App\Http\Controllers\ImportIbMaterialController;
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
use App\Http\Controllers\ImportDataWoIbApkController;
use App\Http\Controllers\ImportFtthDismantleController;
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
use App\Http\Controllers\ImportJadwalTim_controller;
use App\Http\Controllers\ImportMaterialDismantleController;
use App\Http\Controllers\JadwalTim_controller;
use App\Http\Controllers\KaryawanKelengkapanController;
use App\Http\Controllers\KembaliToolGA_Controller;
use App\Http\Controllers\SeragamController;
use App\Http\Controllers\TerimaSeragamController;
use App\Http\Controllers\UpdateSeragamController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\DisposalToolController;
use App\Http\Controllers\DistribusiSeragamController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FTTX\AssignTeamController;
use App\Http\Controllers\FTTX\AssignTeamFttxController;
use App\Http\Controllers\FTTX\AssignTeammController;
use App\Http\Controllers\FTTX\AssignTimController as FTTXAssignTimController;
use App\Http\Controllers\FTTX\ImportAssignTeamFttxController;
use App\Http\Controllers\ImportDataKonfCstController;
use App\Http\Controllers\po_toolsController;
use App\Http\Controllers\RootCause_Controller;
use PhpParser\Node\Expr\Assign;

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
Route::get('/getSummaryKaryawan', [karyawanController::class, 'getSummaryKaryawan'])->name('getSummaryKaryawan')->middleware('auth');
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
Route::get('/getTeknisiTim', [TimController::class, 'getTeknisiTim'])->name('getTeknisiTim')->middleware('auth');
Route::post('/simpanTim', [TimController::class, 'simpanTim'])->name('simpanTim')->middleware('auth');
Route::get('/getDetailTim', [TimController::class, 'getDetailTim'])->name('getDetailTim')->middleware('auth');

Route::get('/updateTim/{id}', [TimController::class, 'updateTim'])->name('updateTim')->middleware('auth');
//end Tim & Callsign //

//Jadwal Tim//

Route::get('/jadwalTim', [JadwalTim_controller::class,'index'])->name('jadwalTim')->middleware('auth');
Route::get('/getdataJadwalIkr', [JadwalTim_controller::class,'getdataJadwalIkr'])->name('getdataJadwalIkr')->middleware('auth');
Route::post('/getRekapDataJadwalTeknisi', [JadwalTim_controller::class,'getRekapDataJadwalTeknisi'])->name('getRekapDataJadwalTeknisi')->middleware('auth');
Route::post('/getRekapDataJadwalStaff', [JadwalTim_controller::class,'getRekapDataJadwalStaff'])->name('getRekapDataJadwalStaff')->middleware('auth');
Route::post('/getRekapDataJadwalLeader', [JadwalTim_controller::class,'getRekapDataJadwalLeader'])->name('getRekapDataJadwalLeader')->middleware('auth');
Route::post('/getRekapDataJadwalSpv', [JadwalTim_controller::class,'getRekapDataJadwalSpv'])->name('getRekapDataJadwalSpv')->middleware('auth');
Route::get('/getKaryawan', [JadwalTim_controller::class,'getKaryawan'])->name('getKaryawan')->middleware('auth');
Route::post('/simpanEditKehadiran', [JadwalTim_controller::class, 'simpanEditKehadiran'])->name('simpanEditKehadiran')->middleware('auth');
Route::get('/getDetailStatus', [JadwalTim_controller::class, 'getDetailStatus'])->name('getDetailStatus')->middleware('auth');
Route::get('/getDetailRekapStatus', [JadwalTim_controller::class, 'getDetailRekapStatus'])->name('getDetailRekapStatus')->middleware('auth');

Route::get('/importScheduleIkr', [ImportJadwalTim_controller::class, 'index'])->name('importJadwalTim')->middleware('auth');
Route::get('/getdataImportJadwal', [ImportJadwalTim_controller::class, 'getdataImportJadwal'])->name('getdataImportJadwal')->middleware('auth');

Route::get('/getRekapDataImportJadwal', [ImportJadwalTim_controller::class, 'getRekapDataImportJadwal'])->name('getRekapDataImportJadwal')->middleware('auth');
Route::get('/getKaryawanTidakTerdaftar', [ImportJadwalTim_controller::class, 'getKaryawanTidakTerdaftar'])->name('getKaryawanTidakTerdaftar')->middleware('auth');

Route::post('/importProsesJadwalIkr', [ImportJadwalTim_controller::class, 'importProsesJadwalIkr'])->name('importProsesJadwalIkr')->middleware('auth');
Route::post('/simpanImportJadwal', [ImportJadwalTim_controller::class, 'simpanImportJadwal'])->name('simpanImportJadwal')->middleware('auth');


//End Jadwal Tim//

//Assign Tim//
Route::get('/analisaWo', [analisa_woController::class, 'index'])->name('analisaWo')->middleware('auth');

Route::get('/rekapAssignTim', [RekapAssignTimController::class, 'index'])->name('rekapAssignTim')->middleware('auth');
Route::get('/getTeknisiOffAssign', [RekapAssignTimController::class, 'getTeknisiOffAssign'])->name('getTeknisiOffAssign')->middleware('auth');
Route::get('/getTabelLeadAssignTim', [RekapAssignTimController::class, 'getTabelLeadAssignTim'])->name('getTabelLeadAssignTim')->middleware('auth');
Route::get('/getTabelRekapAssignTim', [RekapAssignTimController::class, 'getTabelRekapAssignTim'])->name('getTabelRekapAssignTim')->middleware('auth');
Route::get('/getDetailLeadAssignTim', [RekapAssignTimController::class, 'getDetailLeadAssignTim'])->name('getDetailLeadAssignTim')->middleware('auth');
Route::get('/getTimEditCallsign', [RekapAssignTimController::class, 'getTimEditCallsign'])->name('getTimEditCallsign')->middleware('auth');

Route::get('/getDetailRekapAssignTim', [RekapAssignTimController::class, 'getDetailRekapAssignTim'])->name('getDetailRekapAssignTim')->middleware('auth');
Route::get('/getPopUpRekapAssignTim', [RekapAssignTimController::class, 'getPopUpRekapAssignTim'])->name('getPopUpRekapAssignTim')->middleware('auth');
Route::get('/getPopUpRekapJmlAssignTeknisi', [RekapAssignTimController::class, 'getPopUpRekapJmlAssignTeknisi'])->name('getPopUpRekapJmlAssignTeknisi')->middleware('auth');

Route::get('/updateRekapCallTim', [RekapAssignTimController::class, 'updateRekapCallTim'])->name('updateRekapCallTim')->middleware('auth');
Route::get('/updateRekapAssignWo', [RekapAssignTimController::class, 'updateRekapAssignWo'])->name('updateRekapAssignWo')->middleware('auth');
Route::post('/delRekapAssignWo', [RekapAssignTimController::class, 'delRekapAssignWo'])->name('delRekapAssignWo')->middleware('auth');

Route::get('/exportTemplateAssignTimFtth', [RekapAssignTimController::class, 'exportTemplateAssignTimFtth'])->name('exportTemplateAssignTimFtth')->middleware('auth');

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

Route::get('/getDoubleCallsign', [Import_DataWoController::class, 'getDoubleCallsign'])->name('getDoubleCallsign')->middleware('auth');

Route::get('/updateImportWo', [Import_DataWoController::class, 'updateImportWo'])->name('updateImportWo')->middleware('auth');
Route::post('/simpanImportWo', [Import_DataWoController::class, 'simpanImportWo'])->name('simpanImportWo')->middleware('auth');

//Import Data Wo Apk
Route::get('/importDataFtthMtApk', [ImportDataWoApkController::class, 'index'])->name('importDataFtthMtApk')->middleware('auth');
Route::post('/importProsesDataWoApk', [ImportDataWoApkController::class, 'importProsesDataWoApk'])->name('importProsesDataWoApk')->middleware('auth');
Route::get('/getFtthMtApk', [ImportDataWoApkController::class, 'getFtthMtApk'])->name('getFtthMtApk')->middleware('auth');
Route::post('/storeFtthMtApk', [ImportDataWoApkController::class, 'storeFtthMtApk'])->name('storeFtthMtApk')->middleware('auth');
Route::post('/updateFtthMtApk', [ImportDataWoApkController::class, 'updateFtthMtApk'])->name('updateFtthMtApk')->middleware('auth');
Route::get('/getDetailCustId', [ImportDataWoApkController::class, 'getDetailCustId'])->name('getDetailCustId')->middleware('auth');

Route::get('/monitFtthIB', [MonitFtthIB_Controller::class, 'index'])->name('monitFtthIB')->middleware('auth');
Route::get('/importDataFtthIbApk', [ImportDataWoIbApkController::class, 'index'])->name('importDataFtthIbApk')->middleware(middleware: 'auth');
Route::post('/importProsesDataIbApk', [ImportDataWoIbApkController::class,'importProsesDataWoIbApk'])->name('importProsesDataWoIbApk')->middleware('auth');
Route::get('/getFtthIbApk', [ImportDataWoIbApkController::class, 'getFtthIbApk'])->name('getFtthIbApk')->middleware('auth');
Route::post('/storeFtthIbApk', [ImportDataWoIbApkController::class, 'storeFtthIbApk'])->name('storeFtthIbApk')->middleware('auth');
Route::get('/getMaterialFtthIb', [MonitFtthIB_Controller::class, 'getMaterialFtthIb'])->name('getMaterialFtthIb')->middleware('auth');

Route::get('/importDataMaterial', [ImportDataMaterialController::class, 'index'])->name('importDataMaterial')->middleware('auth');
Route::post('/importProsesMaterial', [ImportDataMaterialController::class, 'importProsesMaterial'])->name('importProsesMaterial')->middleware('auth');
Route::get('/getDataImportMaterial', [ImportDataMaterialController::class, 'getDataImportMaterial'])->name('getDataImportMaterial')->middleware('auth');
Route::post('/storeFtthMaterial', [ImportDataMaterialController::class, 'storeFtthMaterial'])->name('storeFtthMaterial')->middleware('auth');

Route::get('/importIbMaterial', [ImportIbMaterialController::class,'index'])->name('importIbMaterial')->middleware('auth');
Route::post('/importIbProsesMaterial', [ImportIbMaterialController::class,'importIbProsesMaterial'])->name('importIbProsesMaterial')->middleware('auth');
Route::get('/getDataImportIbMaterial', [ImportIbMaterialController::class,'getDataImportIbMaterial'])->name('getDataImportIbMaterial')->middleware('auth');
Route::post('/storeFtthIbMaterial', [ImportIbMaterialController::class, 'storeFtthIbMaterial'])->name('storeFtthIbMaterial')->middleware('auth');

Route::get('/importMaterialDismantle', [ImportMaterialDismantleController::class,'index'])->name('importMaterialDismantle')->middleware('auth');
Route::post('/importDismantleProsesMaterial', [ImportMaterialDismantleController::class,'importDismantleProsesMaterial'])->name('importDismantleProsesMaterial')->middleware('auth');
Route::get('/getDataImportMaterialDismantle', [ImportMaterialDismantleController::class,'getDataImportMaterialDismantle'])->name('getDataImportMaterialDismantle')->middleware('auth');
Route::post('/storeDismantleMaterial', [ImportMaterialDismantleController::class, 'storeDismantleMaterial'])->name('storeDismantleMaterial')->middleware('auth');

Route::get('/editMaterialFtthMt', [MonitFtthMT_Controller::class, 'editMaterial'])->name('editMaterialFtthMt')->middleware('auth');
Route::get('/editMaterialFtthIb', [MonitFtthIB_Controller::class, 'editMaterialIb'])->name('editMaterialFtthIb')->middleware('auth');
Route::put('/updateMaterialIb', [MonitFtthIB_Controller::class, 'updateMaterialIb'])->name('updateMaterialIb')->middleware('auth');
Route::get('/editMaterialFtthDismantle', [FtthDismantleController::class, 'editMaterialDismantle'])->name('editMaterialFtthDismantle')->middleware('auth');
//Start Monitoring WO//

Route::get('/rekapProgressWO', [RekapProgressWOController::class, 'index'])->name('rekapProgressWO')->middleware('auth');
Route::get('/getMonthReport', [RekapProgressWOController::class, 'getMonthReport'])->name('getMonthReport')->middleware('auth');
Route::get('/getRekapProgressWO', [RekapProgressWOController::class, 'getRekapProgressWO'])->name('getRekapProgressWO')->middleware('auth');

Route::get('/monitFtthMT', [MonitFtthMT_Controller::class, 'index'])->name(name: 'monitFtthMT')->middleware('auth');
Route::get('/getDetailCustId', [MonitFtthMT_Controller::class, 'getDetailCustId'])->name('getDetailCustId')->middleware('auth');
Route::get('/detail-customer/{cust_id}', [MonitFtthMT_Controller::class, 'getDetailCustId'])->name('detail-customer')->middleware('auth');
Route::get('/updateFtthMt', [MonitFtthMT_Controller::class, 'update'])->name('updateFtthMt')->middleware('auth');

Route::get('/ftth-dismantle', [FtthDismantleController::class, 'index'])->name('ftth-dismantle')->middleware('auth');
Route::get('/getDetailFtthDismantle', [FtthDismantleController::class, 'getDetailFtthDismantle'])->name('getDetailFtthDismantle')->middleware('auth');
Route::get('/getFtthDismantle', [FtthDismantleController::class, 'getFtthDismantle'])->name('getFtthDismantle')->middleware('auth');
Route::get('/getMaterialFtthDismantle', [FtthDismantleController::class,'getMaterialFtthDismantle'])->name('getMaterialFtthDismantle')->middleware('auth');
Route::put('/updateFtthDismantle', [FtthDismantleController::class, 'updateFtthDismantle'])->name('updateFtthDismantle')->middleware('auth');
Route::put('/updateMaterialDismantle', [FtthDismantleController::class, 'updateMaterialDismantle'])->name('updateMaterialDismantle')->middleware('auth');

Route::get('/importFtthDismantle', [ImportFtthDismantleController::class, 'index'])->name('importFtthDismantle')->middleware('auth');
Route::post('/importProsesFtthDismantle', [ImportFtthDismantleController::class, 'importProsesFtthDismantle'])->name('importProsesFtthDismantle')->middleware('auth');
Route::get('/getDataImportDismantle', [ImportFtthDismantleController::class, 'getDataImportDismantle'])->name('getDataImportDismantle')->middleware('auth');
Route::post('/storeDismantleApk', [ImportFtthDismantleController::class, 'storeDismantleApk'])->name('storeDismantleApk')->middleware('auth');

Route::post('/update-confirmation', [MonitFtthIB_Controller::class, 'updateConfirmation'])->name('update-confirmation')->middleware('auth');

Route::get('/getDataMTOris', [MonitFtthMT_Controller::class, 'getDataMTOris'])->name('getDataMTOris')->middleware('auth');
Route::get('/getDataIBOris', [MonitFtthIB_Controller::class, 'getDataIBOris'])->name('getDataIBOris')->middleware('auth');
Route::get('/getDetailWOFtthMT', [MonitFtthMT_Controller::class, 'getDetailWOFtthMT'])->name('getDetailWOFtthMT')->middleware('auth');
Route::get('/getDetailWOFtthIB', [MonitFtthIB_Controller::class, 'getDetailWOFtthIB'])->name('getDetailWOFtthIB')->middleware('auth');
Route::get('/updateFtthIb', [MonitFtthIB_Controller::class, 'updateFtthIb'])->name('updateFtthIb')->middleware('auth');

Route::get('/getSummaryWO', [MonitFtthMT_Controller::class, 'getSummaryWO'])->name('getSummaryWO')->middleware('auth');
Route::get('/getSummaryWOIb', [MonitFtthIB_Controller::class, 'getSummaryWOIb'])->name('getSummaryWOIb')->middleware('auth');
Route::get('/getSummaryWODismantle', [FtthDismantleController::class, 'getSummaryWODismantle'])->name('getSummaryWODismantle')->middleware('auth');

Route::get('/getMaterialFtthMt', [MonitFtthMT_Controller::class,'getMaterialFtthMt'])->name('getMaterialFtthMt')->middleware('auth');
Route::put('/updateMaterialMt', [MonitFtthMT_Controller::class, 'updateMaterialMt'])->name('updateMaterialMt')->middleware('auth');

//End Monitoring//

//FTTX
// Route::view('/fttx-assign-team', 'fttx.assign-team.index')->name('fttx-assign-team')->middleware('auth');

Route::get('/fttx-assign-team', [AssignTeamFttxController::class, 'index'])->name('fttx-assign-team')->middleware('auth');
Route::get('/getTabelAssignTimFttx', [AssignTeamFttxController::class, 'getTabelAssignTimFttx'])->name('getTabelAssignTimFttx')->middleware('auth');

Route::view('/fttx-ib', 'fttx.monitoring-wo.ib')->name('fttx-ib')->middleware('auth');
Route::view('/fttx-mt', 'fttx.monitoring-wo.mt')->name('fttx-mt')->middleware('auth');

Route::get('/fttx/import/assign-team', [ImportAssignTeamFttxController::class, 'index'])->name('fttx.import.assign-team')->middleware('auth');
Route::post('/fttx/import/proses-so', [ImportAssignTeamFttxController::class, 'importProsesDataSo'])->name('fttx.import.proses-so')->middleware('auth');
Route::get('/fttx/import/data', [ImportAssignTeamFttxController::class, 'getImportSoFttx'])->name('fttx.import.data')->middleware('auth');

Route::post('/simpanImportWoFttx', [ImportAssignTeamFttxController::class,'simpanImportWoFttx'])->name('simpanImportWoFttx')->middleware('auth');
Route::post('/simpanSignTimFttx', [AssignTeamFttxController::class, 'simpanSignTimFttx'])->name('simpanSignTimFttx')->middleware('auth');
Route::get('/getDetailAssignFttx', [AssignTeamFttxController::class, 'getDetailAssignFttx'])->name('getDetailAssignFttx')->middleware('auth');
Route::post('/updateSignTimFttx', [AssignTeamFttxController::class, 'updateSignTimFttx'])->name('updateSignTimFttx')->middleware('auth');

//END FTTX

Route::get('ftth-mt/export', [MonitFtthMT_Controller::class, 'export'])->name('ftth-mt.export')->middleware('auth');
Route::get('/ftth-ib/export', [MonitFtthIB_Controller::class, 'export'])->name('ftth-ib.export')->middleware('auth');
Route::get('/ftth-dismantle/export', [FtthDismantleController::class, 'export'])->name('ftth-dismantle.export')->middleware('auth');
//Start Monitoring FOTO APK//

Route::get('/monitFotoFtthMT', [MonitFotoFtthMT_Controller::class, 'index'])->name('monitFotoFtthMT')->middleware('auth');
Route::get('/getMonitFotoFtthMT', [MonitFotoFtthMT_Controller::class, 'getMonitFotoFtthMT'])->name('getMonitFotoFtthMT')->middleware('auth');

Route::get('/getDetailFotoFtthMT', [MonitFotoFtthMT_Controller::class, 'getDetailFotoFtthMT'])->name('getDetailFotoFtthMT')->middleware('auth');

Route::post('/saveValidasi', [MonitFotoFtthMT_Controller::class, 'saveValidasi'])->name('saveValidasi')->middleware('auth');


//End Monitoring FOTO APK//

//Chart Endpoint
Route::get('/getFtthData', [DashboardController::class, 'getFtthData'])->name('getFtthData')->middleware('auth');

//Start Tools//
Route::get('/poTool', [po_toolsController::class, 'index'])->name('poTool')->middleware('auth');
Route::post('/simpanPoTool', [po_toolsController::class, 'simpanPoTool'])->name('simpanPoTool')->middleware('auth');


Route::get('/dataTool', [ToolController::class, 'index'])->name('dataTool')->middleware('auth');
Route::get('/getRekapTool', [ToolController::class, 'getRekapTool'])->name('getRekapTool')->middleware('auth');
Route::get('/getDataTool', [ToolController::class, 'getDataTool'])->name('getDataTool')->middleware('auth');
Route::get('/showDetailTool', [ToolController::class, 'showDetailTool'])->name('showDetailTool')->middleware('auth');
Route::get('/getDataShowTool', [ToolController::class, 'getDataShowTool'])->name('getDataShowTool')->middleware('auth');
Route::get('/getRiwayatTool', [ToolController::class, 'getRiwayatTool'])->name('getRiwayatTool')->middleware('auth');
Route::post('/simpanTool', [ToolController::class, 'simpanTool'])->name('simpanTool')->middleware('auth');
Route::post('/updateTool', [ToolController::class, 'updateTool'])->name('updateTool')->middleware('auth');

Route::get('/simpanApproval', [ToolController::class, 'simpanApproval'])->name('simpanApproval')->middleware('auth');
Route::get('/getRiwayatApprove', [ToolController::class, 'getRiwayatApprove'])->name('getRiwayatApprove')->middleware('auth');

Route::get('/getCallsignBranch', [ToolController::class, 'getCallsignBranch'])->name('getCallsignBranch')->middleware('auth');
Route::get('/getDetailRekap_click', [ToolController::class, 'getDetailRekap_click'])->name('getDetailRekap_click')->middleware('auth');


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


Route::get('/dataKembaliToolGA', [KembaliToolGA_Controller::class, 'index'])->name('dataKembaliToolGA')->middleware('auth');
Route::get('/getDataKembaliGA', [KembaliToolGA_Controller::class, 'getDataKembaliGA'])->name('getDataKembaliGA')->middleware('auth');
Route::get('/getDetailKembaliGA', [KembaliToolGA_Controller::class, 'getDetailKembaliGA'])->name('getDetailKembaliGA')->middleware('auth');
Route::get('/getRawTool', [KembaliToolGA_Controller::class, 'getRawTool'])->name('getRawTool')->middleware('auth');
Route::post('/simpanPengembalianGA', [KembaliToolGA_Controller::class, 'simpanPengembalianGA'])->name('simpanPengembalianGA')->middleware('auth');

Route::get('/laporanTool', [LaporanToolController::class, 'index'])->name('laporanTool')->middleware('auth');
Route::get('/getDataPengecekan', [LaporanToolController::class, 'getDataPengecekan'])->name('getDataPengecekan')->middleware('auth');
Route::get('/getDetailCek', [LaporanToolController::class, 'getDetailCek'])->name('getDetailCek')->middleware('auth');

Route::post('/simpanPengecekan', [LaporanToolController::class, 'simpanPengecekan'])->name('simpanPengecekan')->middleware('auth');

Route::get('/disposalTool', [DisposalToolController::class, 'index'])->name('disposalTool')->middleware('auth');
Route::get('/getSelectToolDisposal', [DisposalToolController::class, 'getSelectToolDisposal'])->name('getSelectToolDisposal')->middleware('auth');
Route::post('/simpanDisposal', [DisposalToolController::class, 'simpanDisposal'])->name('simpanDisposal')->middleware('auth');
Route::get('/getDataDisposal', [DisposalToolController::class, 'getDataDisposal'])->name('getDataDisposal')->middleware('auth');
Route::get('/getDetailDisposal', [DisposalToolController::class, 'getDetailDisposal'])->name('getDetailDisposal')->middleware('auth');

//End Tools//

//Start kelengkapan Seragam
Route::get('/dataSeragam', [SeragamController::class, 'index'])->name('dataSeragam')->middleware('auth');

Route::get('/getKaryawanBranch', [SeragamController::class, 'getKaryawanBranch'])->name('getKaryawanBranch')->middleware('auth');

Route::get('/getRekapSeragam', [SeragamController::class, 'getRekapSeragam'])->name('getRekapSeragam')->middleware('auth');
Route::get('/getDataSeragam', [SeragamController::class, 'getDataSeragam'])->name('getDataSeragam')->middleware('auth');
Route::get('/showDetailSeragam', [SeragamController::class, 'showDetailSeragam'])->name('showDetailSeragam')->middleware('auth');

Route::get('/getRekapTeknisiTanpaSeragam', [SeragamController::class, 'getRekapTeknisiTanpaSeragam'])->name('getRekapTeknisiTanpaSeragam')->middleware('auth');

Route::get('/penerimaanSeragam', [TerimaSeragamController::class, 'index'])->name('penerimaanSeragam')->middleware('auth');
Route::get('/getRekapTerimaSeragam', [TerimaSeragamController::class, 'getRekapTerimaSeragam'])->name('getRekapTerimaSeragam')->middleware('auth');
Route::get('/getDataTerimaSeragam', [TerimaSeragamController::class, 'getDataTerimaSeragam'])->name('getDataTerimaSeragam')->middleware('auth');
Route::get('/showDetailTerimaSeragam', [TerimaSeragamController::class, 'showDetailTerimaSeragam'])->name('showDetailTerimaSeragam')->middleware('auth');
Route::post('/simpanSeragam',[TerimaSeragamController::class,'simpanSeragam'])->name('simpanSeragam')->middleware('auth');


Route::get('/distribusiSeragam', [DistribusiSeragamController::class, 'index'])->name('distribusiSeragam')->middleware('auth');
Route::post('/simpanDistribusiSeragam',[DistribusiSeragamController::class,'simpanDistribusiSeragam'])->name('simpanDistribusiSeragam')->middleware('auth');
Route::get('/getRekapDistribusiSeragam',[DistribusiSeragamController::class,'getRekapDistribusiSeragam'])->name('getRekapDistribusiSeragam')->middleware('auth');
Route::get('/getDataDistribusiSeragam', [DistribusiSeragamController::class, 'getDataDistribusiSeragam'])->name('getDataDistribusiSeragam')->middleware('auth');
Route::get('/showDetailDistribusiSeragam', [DistribusiSeragamController::class, 'showDetailDistribusiSeragam'])->name('showDetailDistribusiSeragam')->middleware('auth');

Route::get('/updateSeragam', [UpdateSeragamController::class, 'index'])->name('updateSeragam')->middleware('auth');
Route::get('/getStockTeknisi', [UpdateSeragamController::class, 'getStockTeknisi'])->name('getStockTeknisi')->middleware('auth');

//End Kelengkapan Seragam


// Import Absensi //
Route::get('/importPerformance', [Import_AbsensiController::class, 'index'])->name('import-performance')->middleware('auth');
Route::post('/importDataAbsensi', [Import_AbsensiController::class, 'importDataAbsensi'])->name('import-dataAbsensi')->middleware('auth');
Route::get('/getDataAbsensi', [Import_AbsensiController::class, 'getDataAbsensi'])->name('getdataAbsensi')->middleware('auth');
Route::post('/saveImportAbsensi', [Import_AbsensiController::class, 'saveImportAbsensi'])->name('saveImportAbsensi')->middleware('auth');
Route::get('/getFilterPreview', [Import_AbsensiController::class, 'getFilterPreview'])->name('getFilterPreview')->middleware('auth');

// End Import Absensi //

//Reschedule WO//
Route::get('/rescheduleWO',[RescheduleWO_Controller::class, 'index'])->name('rescheduleWO')->middleware('auth');
Route::get('/getDataPendingReschedule',[RescheduleWO_Controller::class, 'getDataPendingReschedule'])->name('getDataPendingReschedule')->middleware('auth');
Route::get('/getDetailWORsch',[RescheduleWO_Controller::class, 'getDetailWORsch'])->name('getDetailWORsch')->middleware('auth');
Route::get('/getDetailPending',[RescheduleWO_Controller::class, 'getDetailPending'])->name('getDetailPending')->middleware('auth');

Route::get('/getRekapPendingReschedule',[RescheduleWO_Controller::class, 'getRekapPendingReschedule'])->name('getRekapPendingReschedule')->middleware('auth');

Route::post('/simpanReschedule',[RescheduleWO_Controller::class, 'simpanReschedule'])->name('simpanReschedule')->middleware('auth');

//End Reschedule WO//

//Root cause & FAT//

Route::get('/rootCause',[RootCause_Controller::class, 'index'])->name('rootCause')->middleware('auth');
Route::get('/getListRootCause',[RootCause_Controller::class, 'getListRootCause'])->name('getListRootCause')->middleware('auth');
Route::get('/getDetailRootCause',[RootCause_Controller::class, 'getDetailRootCause'])->name('getDetailRootCause')->middleware('auth');
Route::post('/simpanRootCause',[RootCause_Controller::class, 'simpanRootCause'])->name('simpanRootCause')->middleware('auth');
Route::post('/updateRootCause',[RootCause_Controller::class, 'updateRootCause'])->name('updateRootCause')->middleware('auth');

Route::get('/areaFat',[AreaFat_Controller::class, 'index'])->name('areaFat')->middleware('auth');
Route::get('/getListAreaFat',[AreaFat_Controller::class, 'getListAreaFat'])->name('getListAreaFat')->middleware('auth');
Route::get('/getDetailAreaFat',[AreaFat_Controller::class, 'getDetailAreaFat'])->name('getDetailAreaFat')->middleware('auth');
Route::post('/simpanAreaFat',[AreaFat_Controller::class, 'simpanAreaFat'])->name('simpanAreaFat')->middleware('auth');
Route::post('/updateAreaFat',[AreaFat_Controller::class, 'updateAreaFat'])->name('updateAreaFat')->middleware('auth');
//End Root cause & FAT//

//start import konfirmasi cst//
Route::get('/importDataKonfCst', [ImportDataKonfCstController::class, 'index'])->name('importDataKonfCst')->middleware('auth');
Route::post('/importProsesKonfCst', [ImportDataKonfCstController::class, 'importProsesKonfCst'])->name('importProsesKonfCst')->middleware('auth');
Route::get('/getDataImportKonfCst', [ImportDataKonfCstController::class, 'getDataImportKonfCst'])->name('getDataImportKonfCst')->middleware('auth');

Route::post('/storeKonfCst', [ImportDataKonfCstController::class, 'storeKonfCst'])->name('storeKonfCst')->middleware('auth');

//end konfirmasi cst//

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

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
