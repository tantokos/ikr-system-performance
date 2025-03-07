<?php

namespace App\Http\Controllers;

use App\Imports\FtthDismantleApk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ImportFtthDismantleController extends Controller
{
    public function index()
    {
        $akses = Auth::user()->name;
        $leadCallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'leader_id', 'nama_leader', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $branches = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        $jmlData = DB::table('import_ftth_dismantle_apk');

        return view('monitoringWo.import_ftth_dismantle_apk', compact('akses', 'leadCallsign', 'branches', 'jmlData'));
    }

    public function importProsesFtthDismantle(Request $request)
    {
        if ($request->hasFile('fileDataWO')) {

            $request->validate([
                'fileDataWO' => ['required', 'mimes:xlsx,xls,csv']
            ]);

            $akses = Auth::user()->id . "|" . Auth::user()->name;

            Excel::import(new FtthDismantleApk($akses), request()->file('fileDataWO'));

            return back()->with(['success' => 'Import FTTH Dismantle berhasil.']);

        }
    }

    public function getDataImportDismantle(Request $request)
    {
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');
        $akses = Auth::user()->name;

        // $datas = DB::table('import_ftth_dismantle_apk')->orderBy('wo_date', 'DESC');
        $datas = DB::table('import_ftth_dismantle_apk')->where('login', $akses)->orderBy('wo_date', 'DESC');

        if($request->filTgl != null) {
            $dateRange = explode("-", $request->filTgl);
            $startDt = \Carbon\Carbon::parse($dateRange[0]);
            $endDt = \Carbon\Carbon::parse($dateRange[1]);

            $datas = $datas->whereBetween('wo_date', [$startDt, $endDt]);
        }

        if($request->filNoWo != null) {
                $datas = $datas->where('no_wo', $request->filNoWo);
            }
            if($request->filcustId != null) {
                $datas = $datas->where('cust_id', $request->filcustId);
            }
            if($request->filtypeWo != null) {
                $datas = $datas->where('type_wo', $request->filtypeWo);
            }
            if($request->filarea != null) {
                $b = explode("|", $request->filarea);
                $br = $b[1];
                $datas = $datas->where('branch', $br);
            }
            if($request->filleaderTim != null) {
                $lt = explode("|", $request->filleaderTim);
                $ld = $lt[1];
                $datas = $datas->where('leader', $ld);
            }
            if($request->filcallsignTimid != null) {
                $fct = explode("|", $request->filcallsignTimid);
                $ct = $fct[1];
                $datas = $datas->where('callsign', $ct);
            }
            if($request->filteknisi != null) {
                $ftk = explode("|", $request->filteknisi );
                $nikTk = $ftk[0];
                $datas = $datas->where('tek1_nik', $nikTk)
                                ->orWhere('tek2_nik', $nikTk)
                                ->orWhere('tek3_nik', $nikTk)
                                ->orWhere('tek4_nik', $nikTk);
            }
            if($request->filcluster != null) {
                $datas = $datas->where('cluster', $request->filcluster);
            }
            if($request->filfatCode != null) {
                $datas = $datas->where('kode_fat', $request->filfatCode);
            }
            if($request->filslotTime != null) {
                $datas = $datas->where('slot_time', $request->filslotTime);
            }

            $datas = $datas->get();

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->editColumn('name', function ($nm) {
                    return Str::title($nm->name);
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-assign" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-assign mb-0" >Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
        }
    }

    public function storeDismantleApk(Request $request)
    {
        // dd($request->all());
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');

        $akses = Auth::user()->name;

        switch ($request->input('action')) {
            case 'simpan':

                $importedData = DB::table('import_ftth_dismantle_apk as apk')
                    ->leftJoin('v_rekap_assign_tim as vtim', function($join) {
                        $join->on('apk.installation_date','=','vtim.tgl_ikr');
                        $join->on('apk.callsign','=','vtim.callsign');
                    })
                    ->join('data_ftth_dismantle_oris as dt', function($j) {
                        $j->on('dt.visit_date', '=', 'apk.installation_date');
                        $j->on('dt.no_wo', '=', 'apk.wo_no');
                    })
                    ->whereIn('apk.wo_type', ['DISMANTLE'])
                    ->where('dt.is_checked','=', 0)
                    ->where('apk.login', $akses)
                    ->select('dt.id as dt_id', 'apk.*','vtim.leadcall_id','vtim.leadcall', 'vtim.leader_id', 'vtim.leader', 'vtim.callsign_id as callsignAssignId', 'vtim.callsign as callsignAssign',
                            'vtim.tek1_nik', 'vtim.teknisi1', 'vtim.tek2_nik', 'vtim.teknisi2', 'vtim.tek3_nik', 'vtim.teknisi3',
                            'vtim.tek4_nik', 'vtim.teknisi4');

                $importedData = $importedData->get();

                if(count($importedData) > 0)
                {

                    DB::beginTransaction();
                    try {

                        $dtApk = [];
                        foreach ($importedData as $data) {

                            if(Str::upper($data->status == "DONE") || Str::upper($data->status == "CHECKOUT")) {
                                $statWo = "Done";
                            }elseif(Str::upper($data->status) == "PENDING") {
                                $statWo = "Pending";
                            }elseif(Str::upper($data->status) == "CANCELLED") {
                                $statWo = "Cancel";
                            }else {
                                $statWo = Str::title($data->status);
                            }

                            array_push($dtApk,
                                [
                                    'id' => $data->dt_id,
                                    'no_wo' => $data->wo_no,
                                    'visit_date' => $data->installation_date,
                                    'wo_date' => $data->wo_date,
                                    'wo_type_apk' => $data->wo_type,
                                    'kode_fat' => $data->fat_code,
                                    // 'type_maintenance' => $data->remarks,
                                    'callsign_id' => $data->callsignAssignId,
                                    'callsign' => $data->callsignAssign,
                                    'slot_time_apk' => $data->time,
                                    'status_wo' => $statWo,
                                    'reason_status' => null,
                                    'status_apk' => $data->status,
                                    'checkin_apk' => $data->check_in,
                                    'checkout_apk' => $data->check_out,
                                    'mttr_all' => $data->mttr_all,
                                    'mttr_pending' => $data->mttr_pending,
                                    'mttr_progress' => $data->mttr_progress,
                                    'mttr_technician' => $data->mttr_technician,
                                    'sla_over' => $data->sla_over,
                                    'login' => Auth::user()->name,
                                ]
                            );
                        }

                        // dd($importedData, $dtApk);

                        if(count($dtApk)>0) {
                            // DB::enableQueryLog();
                            $updateProgress = DB::table('data_ftth_dismantle_oris')->upsert(
                                $dtApk, ['id'], ['no_wo', 'visit_date', 'wo_date', 'wo_type_apk', 'kode_fat',
                                        'callsign_id', 'callsign', 'slot_time_apk', 'status_wo',
                                        'reason_status', 'status_apk', 'checkin_apk',
                                        'checkout_apk', 'mttr_all', 'mttr_pending', 'mttr_progress', 'mttr_technician',
                                        'sla_over', 'login'
                                ]);

                        }

                        // dd($importedData, $dtApk, DB::getQueryLog());
                        // Commit transaksi
                        DB::table('import_ftth_dismantle_apk')->where('login', $akses)->delete();
                        DB::commit();
                        return redirect()->route('ftth-dismantle')->with(['success' => 'Status berhasil diupdate.']);
                    } catch (\Exception $e) {
                        // Rollback jika ada kesalahan
                        DB::rollback();
                        return redirect()->route('ftth-dismantle')->with(['error' => 'Gagal mengupdate status.' . $e->getMessage()]);
                    }
                } else {
                    return redirect()->route('ftth-dismantle')->with(['error' => 'Tidak ada data Import APK']);
                }

        break;

            case 'batal':
                $importedData = DB::table('import_ftth_dismantle_apk')->where('login', $akses)
                    ->delete();
                return redirect()->route('ftth-dismantle')->with(['success' => 'Data berhasil dihapus.']);
            break;

        }
    }
}
