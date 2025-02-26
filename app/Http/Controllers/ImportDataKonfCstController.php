<?php

namespace App\Http\Controllers;

use App\Imports\KonfCstImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Arr;

class ImportDataKonfCstController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $monitArea = $request->areaFill;
        $monitGrupArea = $request->areagroup;
        $filTgl = $request->filTgl;

        if($request->filTgl != null) {
            $dateRange = explode("-", $request->filTgl);
            $startDt = \Carbon\Carbon::parse($dateRange[0]);
            $endDt = \Carbon\Carbon::parse($dateRange[1]);

            // $datas = $datas->whereBetween('tgl_ikr',[$startDt, $endDt]);
        }

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

        return view('monitoringWo.import_konf_cst', compact('branches', 'leadCallsign', 'akses', 'jmlData', 'filArea','monitArea','monitGrupArea', 'filTgl'));
    }

    public function importProsesKonfCst(Request $request)
    {

        if($request->FilterArea != "All Area"){
            $filArea = $request->FilterArea;
        }

        if ($request->hasFile('fileDataWO')) {

            $request->validate([
                'fileDataWO' => ['required', 'mimes:xlsx,xls,csv']
            ]);

            $akses = Auth::user()->id . "|" . Auth::user()->name;

            DB::beginTransaction();
            try {
                Excel::import(new KonfCstImport($akses), request()->file('fileDataWO'));

                DB::commit();
                return back()->with(['success' => 'Import Work Order berhasil.']);
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                DB::rollBack();
                $failures = $e->failures();
                // dd($failures);
                $errorMessages = [];
                foreach ($failures as $failure) {
                    // dd($failure->values()[$failure->attribute()]);
                    $errorMessages[] = "Baris " . $failure->row() . " (" . $failure->attribute() . ") = " . "'" . $failure->values()[$failure->attribute()] . "'. ". implode(', ', $failure->errors());
                }

                return back()->with(['error' => 'Kesalahan validasi: ' . implode('<br>', $errorMessages)]);
            } catch (\Exception $e) {
                DB::rollBack();

                return back()->with(['error' => 'Kesalahan: ' . $e->getMessage()]);
            }


        }

    }

    public function getDataImportKonfCst(Request $request)
    {

        $akses = Auth::user()->name;

        if ($request->ajax()) {
            $datas = DB::table('import_konf_csts')->where('login', '=', $akses)->orderBy('tgl_progress', 'DESC')->get();
            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-importKonf" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-importKonf mb-0" >Detail</a>';
                    // <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                    //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }

    public function storeKonfCst(Request $request)
    {

        $filArea = [];
        $akses = Auth::user()->name;

        switch ($request->input('action')) {
            case 'simpan':
                //get all data dari hasil import apk
                $importedData = DB::table('import_konf_csts as apk')
                    ->join('data_ftth_mt_oris as dt', function($j) {
                        $j->on('dt.tgl_ikr', '=', 'apk.tgl_progress');
                        $j->on('dt.no_wo', '=', 'apk.no_wo');
                    })
                    ->whereNotIn('apk.type_wo', ['NEW INSTALLATION', 'INSTALLATION', 'RELOCATION', 'DISMANTLE'])
                    // ->where('dt.is_checked','=', 0)
                    ->where('apk.login', $akses)
                    ->select('dt.id as dt_id', 'apk.*');

                //tambah filter area sesuai yg dipilih user
                if($request->FiArea != "All Area") {
                    $listArea = explode(", ", $request->FiArea);
                    $importedData = $importedData->whereIn('apk.branch', $listArea);
                }

                if($request->filTgl != null) {
                    $dateRange = explode("-", $request->filTgl);
                    $startDt = \Carbon\Carbon::parse($dateRange[0]);
                    $endDt = \Carbon\Carbon::parse($dateRange[1]);
        
                    $importedData = $importedData->whereBetween('apk.tgl_progress',[$startDt, $endDt]);
                }

                $importedData = $importedData->get();
                
                // dd($importedData);
                if(count($importedData) > 0) {
                
                    DB::beginTransaction();
                    try {

                        $dtApk = [];
                        $dtkonf = [];
                        // Update status_wo pada data_ftth_mt_oris berdasarkan wo_no dan tgl_ikr
                        foreach ($importedData as $data) {

                            array_push($dtApk, 
                                [   
                                    'id' => $data->dt_id,
                                    'timestamp' => $data->timestamp,
                                    'pic' => $data->pic,
                                    'tgl_progress' => $data->tgl_progress,
                                    'branch' => $data->branch,
                                    'type_wo' => $data->type_wo,
                                    'no_wo' => $data->no_wo,
                                    'id_cust' => $data->id_cust,
                                    'nama_cust' => $data->nama_cust,
                                    'slot_time_leader' => $data->slot_time_leader,
                                    'no_telp_cst' => $data->no_telp_cst,
                                    'bukti_konfirmasi' => $data->bukti_konfirmasi,
                                    'tgl_konfirmasi' => $data->tgl_konfirmasi,
                                    'jam_konfirmasi' => $data->jam_konfirmasi,
                                    'status_konfirmasi'  => $data->status_konfirmasi,
                                    'login' => Auth::user()->name,
                                ]
                            );              
                            
                            array_push($dtkonf, 
                                [   
                                    'id' => $data->dt_id,
                                    'pic_konf_cst' => $data->pic,
                                    'konfirmasi_customer'  => $data->status_konfirmasi,
                                    'tgl_konf_cst' => $data->tgl_konfirmasi,
                                    'jam_konf_cst' => $data->jam_konfirmasi,
                                    'bukti_konf_cst' => $data->bukti_konfirmasi
                                    // 'login' => Auth::user()->name,
                                ]
                            );          
                        }

                        // dd(($dtkonf));
                        // DB::enableQueryLog();
                        if(count($dtkonf)>0) {
                                $updateProgress = DB::table('data_ftth_mt_oris')->upsert(
                                    $dtkonf, ['id'], ['pic_konf_cst', 'konfirmasi_customer', 'tgl_konf_cst', 'jam_konf_cst', 'bukti_konf_cst'
                                    // ,'login'
                                    ]);
                            }

                        // if(count($dtApk)>0) {
                        //     $updateProgress = DB::table('data_konf_csts')->upsert(
                        //         $dtApk, ['id'], ['timestamp', 'pic', 'tgl_progress', 'branch', 'type_wo',
                        //                 'no_wo', 'id_cust', 'callsign', 'slot_time_apk', 'status_wo',
                        //                 'couse_code', 'root_couse', 'action_taken', 'status_apk', 'checkin_apk',
                        //                 'checkout_apk', 'mttr_all', 'mttr_pending', 'mttr_progress', 'mttr_teknisi', 
                        //                 'sla_over', 'login'
                        //         ]);
                        // }

                        // dd(DB::getQueryLog());
                        // Commit transaksi
                        DB::table('import_konf_csts')->where('login', $akses)->delete();
                        DB::commit();
                        return redirect()->route('monitFtthMT')->with(['success' => 'Status berhasil diupdate.']);
                    } catch (\Exception $e) {
                        // Rollback jika ada kesalahan
                        DB::rollback();
                        // return $e;
                        return redirect()->route('monitFtthMT')->with(['error' => 'Gagal mengupdate status.' . $e->getMessage()]);
                    }
                } else {
                    return redirect()->route('monitFtthMT')->with(['error' => 'Tidak ada data Import']);
                }

                break;

            case 'batal':
                $importedData = DB::table('import_konf_csts')->where('login', $akses)
                    ->delete();
                return redirect()->route('monitFtthMT')->with(['success' => 'Data berhasil dihapus.']);
            break;
            // case 'batal':
            //     ImportAssignTim::where('login', $akses)->delete();
            //         return redirect()->route('assignTim');
            // break;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
