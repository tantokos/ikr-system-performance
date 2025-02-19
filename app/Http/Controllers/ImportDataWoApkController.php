<?php

namespace App\Http\Controllers;

use App\Imports\FtthMtApkImport;
use App\Models\ImportFtthMtApk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Arr;

class ImportDataWoApkController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all() == null);
        $monitArea = $request->areaFill;
        $monitGrupArea = $request->areagroup;

        if($request->areaFill != null) {
            $area = explode("|", $request->areaFill);
            $filArea = $area[1];
        }

        if($request->areagroup != null) {
            $grupArea = DB::table('branches')->select('grup_area', 'nama_branch')
                            ->where('grup_area', $request->areagroup)->pluck('nama_branch')->toArray();

            $filArea = Arr::join($grupArea, ', ');
        }

        if($request->areaFill == null && $request->areagroup == null) {
            $filArea = null;
        }

        // dd($filArea);

        $akses = Auth::user()->name;
        $leadCallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'leader_id', 'nama_leader', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $branches = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        $jmlData = DB::table('import_ftth_mt_apks');

        return view('monitoringWo.import_ftth_mt_apk', compact('branches', 'leadCallsign', 'akses', 'jmlData', 'filArea','monitArea','monitGrupArea'));
    }

    public function importProsesDataWoApk(Request $request)
    {

        if($request->FilterArea != "All Area"){
            $filArea = $request->FilterArea;
        }

        if ($request->hasFile('fileDataWO')) {

            $request->validate([
                'fileDataWO' => ['required', 'mimes:xlsx,xls,csv']
            ]);

            $akses = Auth::user()->id . "|" . Auth::user()->name;

            try {
                Excel::import(new FtthMtApkImport($akses), request()->file('fileDataWO'));

                return back()->with(['success' => 'Import WO FTTH Maintenance berhasil.']);

            } catch (\Exception $e) {

                return back()->with(['error' => 'Kesalahan: ' . $e->getMessage()]);
            }


        }

    }

    public function getFtthMtApk(Request $request)
    {


        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');
        $akses = Auth::user()->name;

        $datas = DB::table('import_ftth_mt_apks')->where('login','=', $akses)->orderBy('wo_date', 'DESC');

            if($request->filTgl != null) {
                $dateRange = explode("-", $request->filTgl);
                $startDt = \Carbon\Carbon::parse($dateRange[0]);
                $endDt = \Carbon\Carbon::parse($dateRange[1]);

                $datas = $datas->whereBetween('wo_date',[$startDt, $endDt]);
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
                // ->editColumn('type_wo', function ($nm) {
                //     return Str::title($nm->type_wo);
                // })
                // ->editColumn('cluster', function ($nm) {
                //     return Str::title($nm->cluster);
                // })
                // ->editColumn('branch', function ($nm) {
                //     return Str::title($nm->branch);
                // })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-assign" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-assign mb-0" >Detail</a>';
                    // <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                    //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }

        // return response()->json($request->ajax());
    }

    public function storeFtthMtApk(Request $request)
    {
        $filArea = [];
        $akses = Auth::user()->name;

        // dd($request->all());

        switch ($request->input('action')) {
            case 'simpan':
                //get all data dari hasil import apk
                $importedData = DB::table('import_ftth_mt_apks as apk')
                    ->leftJoin('v_rekap_assign_tim as vtim', function($join) {
                        $join->on('apk.installation_date','=','vtim.tgl_ikr');
                        $join->on('apk.callsign','=','vtim.callsign');
                    })
                    ->join('data_ftth_mt_oris as dt', function($j) {
                        $j->on('dt.tgl_ikr', '=', 'apk.installation_date');
                        $j->on('dt.no_wo', '=', 'apk.wo_no');
                    })
                    ->whereNotIn('apk.wo_type', ['NEW INSTALLATION', 'INSTALLATION', 'RELOCATION', 'DISMANTLE'])
                    ->where('dt.is_checked','=', 0)
                    ->where('apk.login', $akses)
                    ->select('dt.id as dt_id', 'apk.*','vtim.leadcall_id','vtim.leadcall', 'vtim.leader_id', 'vtim.leader', 'vtim.callsign_id as callsignAssignId', 'vtim.callsign as callsignAssign',
                            'vtim.tek1_nik', 'vtim.teknisi1', 'vtim.tek2_nik', 'vtim.teknisi2', 'vtim.tek3_nik', 'vtim.teknisi3',
                            'vtim.tek4_nik', 'vtim.teknisi4');

                //tambah filter area sesuai yg dipilih user
                if($request->FiArea != "All Area") {
                    $listArea = explode(", ", $request->FiArea);
                    $importedData = $importedData->whereIn('apk.area', $listArea);
                }

                $importedData = $importedData->get();
                
                // dd($importedData);
                if(count($importedData) > 0) {
                
                    DB::beginTransaction();
                    try {

                        $dtApk = [];
                        // Update status_wo pada data_ftth_mt_oris berdasarkan wo_no dan tgl_ikr
                        foreach ($importedData as $data) {

                            if(Str::upper($data->status == "DONE") || Str::upper($data->status == "CHECKOUT")) {
                                $statWo = "Done";
                            }else if(Str::upper($data->status) == "PENDING") {
                                $statWo = "Pending";
                            }else if(Str::upper($data->status) == "CANCELLED") {
                                $statWo = "Cancel";
                            }else {
                                $statWo = Str::title($data->status);
                            }

                            array_push($dtApk, 
                                [   
                                    'id' => $data->dt_id,
                                    'no_wo' => $data->wo_no,
                                    'tgl_ikr' => $data->installation_date,
                                    'wo_date_apk' => $data->wo_date,
                                    'wo_type_apk' => $data->wo_type,
                                    'kode_fat' => $data->fat_code,
                                    'type_maintenance' => $data->remarks,
                                    'callsign_id' => $data->callsign_id,
                                    'callsign' => $data->callsign,
                                    'slot_time_apk' => $data->time,
                                    'status_wo' => $statWo,
                                    'couse_code' => $data->cause_code,
                                    'root_couse' => $data->root_cause,
                                    'action_taken' => $data->action_taken,
                                    'status_apk' => $data->status,
                                    'checkin_apk' => $data->check_in,
                                    'checkout_apk' => $data->check_out,
                                    'mttr_all' => $data->mttr_all,
                                    'mttr_pending' => $data->mttr_pending,
                                    'mttr_progress' => $data->mttr_progress,
                                    'mttr_teknisi' => $data->mttr_technician,
                                    'sla_over' => $data->sla_over,
                                    'login' => Auth::user()->name,
                                ]
                            );                            
                        }

                        // dd(count($dtApk));

                        if(count($dtApk)>0) {
                            $updateProgress = DB::table('data_ftth_mt_oris')->upsert(
                                $dtApk, ['id'], ['no_wo', 'tgl_ikr', 'wo_date_apk', 'wo_type_apk', 'kode_fat',
                                        'type_maintenance', 'callsign_id', 'callsign', 'slot_time_apk', 'status_wo',
                                        'couse_code', 'root_couse', 'action_taken', 'status_apk', 'checkin_apk',
                                        'checkout_apk', 'mttr_all', 'mttr_pending', 'mttr_progress', 'mttr_teknisi', 
                                        'sla_over', 'login'
                                ]);
                        }

                        // DB::table('data_ftth_mt_oris')
                        //         ->where('no_wo', $data->wo_no)
                        //         ->where('tgl_ikr', $data->installation_date) // Menambahkan syarat
                        //         ->where('is_checked', 0)
                        //         ->update([
                        //             'wo_date_apk' => $data->wo_date,
                        //             'wo_type_apk' => $data->wo_type,
                        //             'kode_fat' => $data->fat_code,
                        //             'type_maintenance' => $data->remarks,
                        //             // 'leadcall_id' => $data->leadcall_id,
                        //             // 'leadcall' => $data->leadcall,
                        //             // 'leader_id' => $data->leader_id,
                        //             // 'leader' => $data->leader,
                        //             'callsign_id' => $data->callsign_id,
                        //             'callsign' => $data->callsign,
                        //             // 'tek1_nik' => $data->tek1_nik,
                        //             // 'teknisi1' => $data->teknisi1,
                        //             // 'tek2_nik' => $data->tek2_nik,
                        //             // 'teknisi2' => $data->teknisi2,
                        //             // 'tek3_nik' => $data->tek3_nik,
                        //             // 'teknisi3' => $data->teknisi3,
                        //             // 'tek4_nik' => $data->tek4_nik,
                        //             // 'teknisi4' => $data->teknisi4,
                        //             'slot_time_apk' => $data->time,
                        //             'status_wo' => $statWo,
                        //             'couse_code' => $data->cause_code,
                        //             'root_couse' => $data->root_cause,
                        //             'action_taken' => $data->action_taken,
                        //             'status_apk' => $data->status,
                        //             'checkin_apk' => $data->check_in,
                        //             'checkout_apk' => $data->check_out,
                        //             'mttr_all' => $data->mttr_all,
                        //             'mttr_pending' => $data->mttr_pending,
                        //             'mttr_progress' => $data->mttr_progress,
                        //             'mttr_teknisi' => $data->mttr_technician,
                        //             'sla_over' => $data->sla_over,
                        //             'login' => Auth::user()->name,
                        //         ]);

                        // Commit transaksi
                        DB::table('import_ftth_mt_apks')->where('login', $akses)->delete();
                        DB::commit();
                        return redirect()->route('monitFtthMT')->with(['success' => 'Status berhasil diupdate.']);
                    } catch (\Exception $e) {
                        // Rollback jika ada kesalahan
                        DB::rollback();
                        // return $e;
                        return redirect()->route('monitFtthMT')->with(['error' => 'Gagal mengupdate status.' . $e->getMessage()]);
                    }
                } else {
                    return redirect()->route('monitFtthMT')->with(['error' => 'Tidak ada data Import APK']);
                }

        break;

            case 'batal':
                $importedData = DB::table('import_ftth_mt_apks')->where('login', $akses)
                    ->delete();
                return redirect()->route('monitFtthMT')->with(['success' => 'Data berhasil dihapus.']);
            break;
            // case 'batal':
            //     ImportAssignTim::where('login', $akses)->delete();
            //         return redirect()->route('assignTim');
            // break;
        }

    }

    public function updateFtthMtApk_()
    {
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');
        $akses=Auth::user()->name;

        $importedData = DB::table('import_ftth_mt_apks')->where('login', $akses)
            ->get();

        DB::beginTransaction();
        try {
            // Update status_wo pada data_ftth_mt_oris berdasarkan wo_no dan tgl_ikr
            foreach ($importedData as $data) {
                DB::table('data_ftth_mt_oris')
                    ->where('no_wo', $data->wo_no)
                    ->where('login', $akses)
                    ->where('tgl_ikr', $data->installation_date) // Menambahkan syarat
                    ->update([
                        'status_wo' => $data->status,
                        'login' => Auth::user()->name,
                    ]);
            }

            // Commit transaksi
            DB::commit();
            return redirect()->route('monitFtthMT')->with(['success' => 'Status berhasil diupdate.']);
        } catch (\Exception $e) {
            // Rollback jika ada kesalahan
            DB::rollback();
            return redirect()->route('monitFtthMT')->with(['error' => 'Gagal mengupdate status.']);
        }
    }

}
