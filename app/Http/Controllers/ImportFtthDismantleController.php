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

        $datas = DB::table('import_ftth_dismantle_apk')->orderBy('wo_date', 'DESC');

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
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');

        $akses = Auth::user()->name;

        switch ($request->input('action')) {
            case 'simpan':

                $importedData = DB::table('import_ftth_dismantle_apk')
                    ->get();

                DB::beginTransaction();
                try {
                    // Update status_wo pada data_ftth_dismantle_oris berdasarkan wo_no dan tgl_ikr
                    foreach ($importedData as $data) {
                        DB::table('data_ftth_dismantle_oris')
                            ->where('no_wo', $data->wo_no)
                            ->where('visit_date', $data->installation_date) // Menambahkan syarat
                            ->where('is_checked', 0)
                            ->update([
                                'slot_time_apk' => $data->time,
                                'status_wo' => $data->status,
                                'status_apk' => $data->status,
                                'checkin_apk' => $data->check_in,
                                'checkout_apk' => $data->check_out,
                                'login' => Auth::user()->name,
                                'mttr_all' => $data->mttr_all,
                                'mttr_pending' => $data->mttr_pending,
                                'mttr_progress' => $data->mttr_progress,
                                'mttr_technician' => $data->mttr_technician,
                                'sla_over' => $data->sla_over,
                            ]);
                    }

                    // Commit transaksi
                    DB::table('import_ftth_dismantle_apk')->delete();
                    DB::commit();
                    return redirect()->route('ftth-dismantle')->with(['success' => 'Status berhasil diupdate.']);
                } catch (\Exception $e) {
                    // Rollback jika ada kesalahan
                    return $e;
                    DB::rollback();
                    return redirect()->route('ftth-dismantle')->with(['error' => 'Gagal mengupdate status.']);
                }

        break;

            case 'batal':
                $importedData = DB::table('import_ftth_dismantle_apk')
                    ->delete();
                return redirect()->route('ftth-dismantle')->with(['success' => 'Data berhasil dihapus.']);
            break;

        }
    }
}
