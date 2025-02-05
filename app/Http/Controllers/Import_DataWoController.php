<?php

namespace App\Http\Controllers;

use App\Imports\AssignWoImport;
use App\Models\DataAssignTim;
use App\Models\Employee;
use App\Models\ImportAssignTim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\HeadingRowImport;

use function PHPUnit\Framework\isNull;

class Import_DataWoController extends Controller
{
    public function index(Request $request)
    {
        $akses = Auth::user()->name;
        $Leadcallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'leader_id', 'nama_leader', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $branches = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        $jmlData = DB::table('import_assign_tims')->where('login', '=', $akses)->count('login');

        $callsigns = DB::table('import_assign_tims')
        ->select('callsign', 'branch_id','branch', 'type_wo', DB::raw('count(*) as total_wo'))
        ->groupBy('callsign', 'type_wo','branch_id', 'branch')
        ->orderBy('branch_id')
        ->orderBy('callsign')
        ->get();


        $pivotData = [];
        $totalFtthNewInstallation = 0;
        $totalFtthMt = 0;
        $totalDismantle = 0;
        $totalFttxIb = 0;

        foreach ($callsigns as $item) {
            $area = $item->branch;
            $callsign = $item->callsign;
            $type_wo = $item->type_wo;

            // Inisialisasi array jika belum ada
            if (!isset($pivotData[$callsign])) {
                $pivotData[$callsign] = [
                    'area' => $area,
                    'callsign' => $callsign,
                    'FTTH New Installation' => 0,
                    'FTTH Maintenance' => 0,
                    'FTTH Dismantle' => 0,
                    'FTTX New Installation' => 0,
                    'FTTX Maintenance' => 0,
                    'Total WO' => 0
                ];
            }

            // Tambahkan nilai total_wo ke type_wo yang sesuai
            $pivotData[$callsign][$type_wo] = $item->total_wo;

            if($type_wo == 'FTTH New Installation'){
                $totalFtthNewInstallation += $item->total_wo;
            }

            if($type_wo == 'FTTH Maintenance'){
                $totalFtthMt += $item->total_wo;
            }

            if($type_wo == 'FTTH Dismantle'){
                $totalDismantle += $item->total_wo;
            }

            if($type_wo == 'FTTX New Installation'){
                $totalFttxIb += $item->total_wo;
            }

            // Tambahkan ke total WO
            $pivotData[$callsign]['Total WO'] += $item->total_wo;
        }

        // return $pivotData;
        return view('assign.import-DataWO', [
            'branches' => $branches,
            'leadCallsign' => $Leadcallsign,
            'akses' => $akses,
            'brImport' => $request->brImport,
            'callsigns' => $callsigns,
            'pivotData' => $pivotData,
            'totalFtthNewInstallation' => $totalFtthNewInstallation,
            'totalFtthMt' => $totalFtthMt,
            'totalDismantle' => $totalDismantle,
            'totalFttxIb' => $totalFttxIb,
        ]);
    }



    public function import()
    {
        $headings = (new HeadingRowImport)->toArray('users.xlsx');
    }


    public function importProsesDataWo(Request $request)
    {
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');

        if ($request->hasFile('fileDataWO')) {
            $request->validate([
                'fileDataWO' => ['required', 'mimes:xlsx,xls,csv']
            ]);

            $akses = Auth::user()->id . "|" . Auth::user()->name;

            $dtJadwal = DB::table('employees as e')->select('vj.tgl','vj.nik_karyawan','e.nama_karyawan')
                                ->leftJoin('v_rekap_jadwal_data as vj', 'e.nik_karyawan','=','vj.nik_karyawan')
                                ->where('e.status_active','=','Aktif')                                
                                ->whereIn('vj.status', ["ON","OD"])->get();
                                // ->where('vj.tgl', $tanggal)
                                // ->first();
            $dtBranch = DB::table('branches')->select('id','nama_branch')->get();
            $dtCallsignTim = DB::table('v_detail_callsign_tim')->get();
            $dtCallsignLead = DB::table('callsign_leads as cl')
                            ->leftJoin('employees as e','cl.leader_id', '=', 'e.nik_karyawan')
                            ->select('cl.id as callsign_tim_id', 'cl.lead_callsign')->get();
                            // ->where('lead_callsign', $data)->first();

            try {
                Excel::import(new AssignWoImport($akses, $dtJadwal, $dtBranch, $dtCallsignTim, $dtCallsignLead), $request->file('fileDataWO'));

                return back()->with(['success' => 'Import Work Order berhasil.']);
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                // dd($failures);
                $errorMessages = [];
                foreach ($failures as $failure) {
                    // dd($failure->values()[$failure->attribute()]);
                    $errorMessages[] = "Baris " . $failure->row() . " (" . $failure->attribute() . ") = " . "'" . $failure->values()[$failure->attribute()] . "'. ". implode(', ', $failure->errors());
                }

                return back()->with(['error' => 'Kesalahan validasi: ' . implode('<br>', $errorMessages)]);
            } catch (\Exception $e) {

                return back()->with(['error' => 'Kesalahan: ' . $e->getMessage()]);
            }
        }

        return back()->with(['error' => 'Tidak ada file yang diunggah.']);
    }

    public function getDoubleCallsign(Request $request)
    {
        $dtAssign = DB::table('data_assign_tims')
                ->select('tgl_ikr','branch','leader','callsign','tek1_nik', 'teknisi1','tek2_nik', 'teknisi2','tek3_nik', 'teknisi3','tek4_nik', 'teknisi4')
                ->where('tgl_ikr','2025-01-12')->distinct()->get();

        $dtImport = DB::table('import_assign_tims')
                ->select('tgl_ikr','branch','callsign','tek1_nik', 'teknisi1','tek2_nik', 'teknisi2','tek3_nik', 'teknisi3','tek4_nik', 'teknisi4')
                ->where('tgl_ikr','2025-01-12')->distinct()->get()->toArray();

        $dtImportTek1 = DB::table('import_assign_tims')
                ->select('tgl_ikr','branch','leadcall','leader','callsign','tek1_nik', 'teknisi1')
                ->where('tgl_ikr','2025-01-12')->whereNotNull('tek1_nik')->distinct();

        $dtImportTek2 = DB::table('import_assign_tims')
                ->select('tgl_ikr','branch','leadcall','leader','callsign','tek2_nik', 'teknisi2')
                ->where('tgl_ikr','2025-01-12')->whereNotNull('tek2_nik')->distinct();

        $dtImportTek3 = DB::table('import_assign_tims')
                ->select('tgl_ikr','branch','leadcall','leader','callsign','tek3_nik', 'teknisi3')
                ->where('tgl_ikr','2025-01-12')->whereNotNull('tek3_nik')->distinct();

        $dtImportTek = DB::table('import_assign_tims')
                ->select('tgl_ikr','branch','leadcall','leader','callsign','tek4_nik as tek_nik', 'teknisi4 as teknisi')
                ->where('tgl_ikr','2025-01-12')->whereNotNull('tek4_nik')
                ->union($dtImportTek1)
                ->union($dtImportTek2)
                ->union($dtImportTek3)
                ->distinct()->orderBy('callsign')->get();

        for($x=0; $x < count($dtImportTek); $x++) {
            // dd($dtImportTek[$x]);
            $dtAssignTek = DB::table('v_rekap_assign')
                ->where('tgl_ikr', $dtImportTek[$x]->tgl_ikr)
                ->where('branch', $dtImportTek[$x]->branch)
                ->where('callsign', $dtImportTek[$x]->callsign)
                ->where('tek_nik', $dtImportTek[$x]->tek_nik)
                ->get();

            if(count($dtAssignTek) == 0) {
                $dtAssign = DB::table('v_rekap_assign_tim')
                    ->select('tgl_ikr','branch','leader','callsign', 'teknisi1', 'teknisi2', 'teknisi3', 'teknisi4')
                    ->where('tgl_ikr', $dtImportTek[$x]->tgl_ikr)
                    ->where('callsign', $dtImportTek[$x]->callsign )->distinct()->get();
            }
        }

        dd("stop");

        $dtAssignTek = DB::table('v_rekap_assign')
                ->select('tgl_ikr','branch','leadcall','leader','callsign','tek_nik', 'teknisi')
                ->where('tgl_ikr', '2025-01-12')->get();


        // $diff = $dtImport->diff($dtAssign);
        dd($dtImportTek, $dtAssignTek);
        $differenceArray = array_diff($dtAssign, $dtImport);
        dd($differenceArray);
        return response()->json($dtAssign);
    }

    public function getDataImportWo(Request $request)
    {

        $akses = Auth::user()->name;

        if ($request->ajax()) {
            $datas = DB::table('import_assign_tims')->where('login', '=', $akses)->orderBy('fat_code_apk')->get();
            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-importWo" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-importWo mb-0" >Detail</a>';
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

    public function getDetailImport(Request $request)
    {
        // dd($request->all());
        $wo_id = $request->filWoId;
        $datas = DB::table('import_assign_tims as d')
            ->where('d.id', $wo_id)->first();

        $tim = Employee::whereIn('posisi', ['Installer', 'Maintenance','Teknisi'])
            ->select('nik_karyawan', 'nama_karyawan')
            ->where('status_active','=','Aktif')
            ->orderBy('nama_karyawan')
            ->get();

        $Leadcallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $callTim = DB::table('v_detail_callsign_tim')
            ->select('callsign_tim_id', 'callsign_tim')->distinct()
            ->orderBy('callsign_tim')->get();

        return response()->json(['data' => $datas, 'tim' => $tim, 'LeadCall' => $Leadcallsign, 'callTim' => $callTim]);
    }

    public function simpanImportWo(Request $request)
    {
        $akses = Auth::user()->name;

        switch ($request->input('action')) {
            case 'simpan':

                if ($request->branchShow) {
                    $branchRq = explode('|', $request->branchShow);
                    $branchId = $branchRq[0];
                    $branch = $branchRq[1];
                } else {
                    $branch = "";
                }

                //get data import assign tim,
                $dtImportAssign = ImportAssignTim::whereNotNull('callsign')
                    ->select(
                        'batch_wo', 'tgl_ikr', 'slot_time', 'type_wo', 'no_wo_apk', 'no_ticket_apk',
                        'wo_date_apk', 'cust_id_apk', 'name_cust_apk', 'cust_phone_apk', 'cust_mobile_apk',
                        'address_apk', 'area_cluster_apk', 'wo_type_apk', 'fat_code_apk', 'fat_port_apk',
                        'remarks_apk', 'vendor_installer_apk', 'ikr_date_apk', 'time_apk', 'branch_id',
                        'branch', 'leadcall_id', 'leadcall', 'leader_id', 'leader', 'callsign_id',
                        'callsign', 'tek1_nik', 'teknisi1', 'tek2_nik', 'teknisi2', 'tek3_nik', 'teknisi3',
                        'tek4_nik', 'teknisi4', 'login_id', 'login'
                    )
                    ->where('login', $akses)
                    ->get()->toArray();

                //get data callsign tim dari data import assign tim, sebagai acuan untuk update callsign tim di data assign tim
                $dtImportCallsign = ImportAssignTim::whereNotNull('callsign')
                    ->select(
                        'tgl_ikr', 'branch', 'leadcall_id', 'leadcall', 'leader_id','leader',
                        'callsign_id', 'callsign', 'tek1_nik', 'teknisi1', 'tek2_nik', 'teknisi2',
                        'tek3_nik', 'teknisi3', 'tek4_nik', 'teknisi4', 'login_id','login'
                    )
                    ->where('login', $akses)
                    ->distinct()->get()->toArray();


                if (count($dtImportAssign) > 0) {

                    DB::beginTransaction();

                    try {

                        $doubleAssign = [];

                        foreach ($dtImportAssign as $data) {
                            $cekDoubleAssign = DataAssignTim::where('no_wo_apk', $data['no_wo_apk'])
                                ->where('tgl_ikr', $data['tgl_ikr'])
                                ->first();

                            //update callsign jika wo sudah pernah di import/ sudah ada di data assign tim
                            if ($cekDoubleAssign) {
                                array_push($doubleAssign, $data['no_wo_apk']);

                                //update callsign di data sebelum nya, jika ada perubahan tim/callsign
                                $updateDtAssign = DataAssignTim::where('no_wo_apk', $data['no_wo_apk'])->where('tgl_ikr', $data['tgl_ikr'])
                                                ->update([
                                                    'area_cluster_apk' => $data['area_cluster_apk'],
                                                    'slot_time' => $data['slot_time'],
                                                    'time_apk' => $data['time_apk'],
                                                    'branch_id' => $data['branch_id'],
                                                    'branch' => $data['branch'],
                                                    'leadcall_id' => $data['leadcall_id'],
                                                    'leadcall' => $data['leadcall'],
                                                    'leader_id' => $data['leader_id'],
                                                    'leader' => $data['leader'],
                                                    'callsign_id' => $data['callsign_id'],
                                                    'callsign' => $data['callsign'],
                                                    'tek1_nik' => $data['tek1_nik'],
                                                    'teknisi1' => $data['teknisi1'],
                                                    'tek2_nik' => $data['tek2_nik'],
                                                    'teknisi2' => $data['teknisi2'],
                                                    'tek3_nik' => $data['tek3_nik'],
                                                    'teknisi3' => $data['teknisi3'],
                                                    'tek4_nik' => $data['tek4_nik'],
                                                    'teknisi4' => $data['teknisi4']
                                                ]);
                            }

                        }

                        //update selurun callsign tim di data assign tim jika ada perubahan tim di callsign
                        foreach ($dtImportCallsign as $impCallsign ) {
                            $updateDtCallsign = DataAssignTim::where('tgl_ikr', $impCallsign['tgl_ikr'])
                                    ->where('callsign', $impCallsign['callsign'])
                                    ->update(['leadcall_id' => $impCallsign['leadcall_id'],
                                                'leadcall' => $impCallsign['leadcall'],
                                                'leader_id' => $impCallsign['leader_id'],
                                                'leader' => $impCallsign['leader'],
                                                'callsign_id' => $impCallsign['callsign_id'],
                                                'callsign' => $impCallsign['callsign'],
                                                'tek1_nik' => $impCallsign['tek1_nik'],
                                                'teknisi1' => $impCallsign['teknisi1'],
                                                'tek2_nik' => $impCallsign['tek2_nik'],
                                                'teknisi2' => $impCallsign['teknisi2'],
                                                'tek3_nik' => $impCallsign['tek3_nik'],
                                                'teknisi3' => $impCallsign['teknisi3'],
                                                'tek4_nik' => $impCallsign['tek4_nik'],
                                                'teknisi4' => $impCallsign['teknisi4']
                                            ]);

                        }

                        //get data WO baru dari import assign tim
                        $dtImportAssign2 = ImportAssignTim::whereNotIn('no_wo_apk', $doubleAssign)
                            ->select(
                                'batch_wo',
                                'tgl_ikr',
                                'slot_time',
                                'type_wo',
                                'no_wo_apk',
                                'no_ticket_apk',
                                'wo_date_apk',
                                'cust_id_apk',
                                'name_cust_apk',
                                'cust_phone_apk',
                                'cust_mobile_apk',
                                'address_apk',
                                'area_cluster_apk',
                                'wo_type_apk',
                                'fat_code_apk',
                                'fat_port_apk',
                                'remarks_apk',
                                'vendor_installer_apk',
                                'ikr_date_apk',
                                'time_apk',
                                'branch_id',
                                'branch',
                                'leadcall_id',
                                'leadcall',
                                'leader_id',
                                'leader',
                                'callsign_id',
                                'callsign',
                                'tek1_nik',
                                'teknisi1',
                                'tek2_nik',
                                'teknisi2',
                                'tek3_nik',
                                'teknisi3',
                                'tek4_nik',
                                'teknisi4',
                                'login_id',
                                'login'
                            )
                            ->whereNotNull('callsign')
                            ->where('login', $akses)
                            ->get()
                            ->toArray();

                        // Insert data yang valid/tidak double ke data_assign_tims
                        DataAssignTim::insert($dtImportAssign2);

                        // Proses penyimpanan ke tabel sesuai type_wo
                        foreach ($dtImportAssign2 as $data) {

                            $kdArea = substr($data['fat_code_apk'],4,3);
                            $kategori_area = DB::table('list_fat')->where('branch', $data['branch'])
                                            ->select('kategori_area')->distinct()->first();

                            $areaSegmen = DB::table('list_fat')->where('kategori_area', $kategori_area->kategori_area)
                                        ->where('kode_area', $kdArea)->first();

                            // $cekStatWOBefore = DB::table('data_ftth_mt_oris')->where('no_wo',$data['no_wo_apk'])
                            //             ->where('status_wo','<>',"Done")
                            //             ->where('tgl_ikr','<',$data['tgl_ikr'])
                            //             ->orderBy('tgl_ikr','DESC')
                            //             ->first();

                            // if(is_null($cekStatWOBefore)) {
                            //     $woDateEmailReschedule = $cekStatWOBefore;
                            // }else{
                            //     $woDateEmailReschedule = implode(" ", [$data['tgl_ikr'],$data['time_apk']]);
                            // }

                            if ($data['type_wo'] == "FTTH Maintenance") {
                                DB::table('data_ftth_mt_oris')->insert([
                                    'type_wo' => $data['type_wo'],
                                    'no_wo' => $data['no_wo_apk'],
                                    'no_ticket' => $data['no_ticket_apk'],
                                    'cust_id' => $data['cust_id_apk'],
                                    'nama_cust' => $data['name_cust_apk'],
                                    'cust_address1' => $data['address_apk'],
                                    'cust_address2' => $data['address_apk'],
                                    'type_maintenance' => $data['remarks_apk'],
                                    'kode_fat' => $data['fat_code_apk'],
                                    'kode_wilayah' => isset($kdArea) ? $kdArea: null,
                                    'cluster' => isset($data['area_cluster_apk']) ? $data['area_cluster_apk'] : $areaSegmen->cluster,
                                    'kotamadya' => isset($areaSegmen->kotamadya) ? $areaSegmen->kotamadya : null,
                                    'kotamadya_penagihan' => isset($areaSegmen->kotamadya_penagihan) ? $areaSegmen->kotamadya_penagihan: null,
                                    'branch_id' => $data['branch_id'],
                                    'branch' => $data['branch'],
                                    'tgl_ikr' => $data['tgl_ikr'],
                                    'slot_time_leader' => $data['slot_time'],
                                    'slot_time_apk' => $data['time_apk'],
                                    'sesi' => $data['batch_wo'],
                                    'callsign' => $data['callsign'],
                                    'leader' => $data['leader'],
                                    'teknisi1' => $data['teknisi1'],
                                    'teknisi2' => $data['teknisi2'],
                                    'teknisi3' => $data['teknisi3'],
                                    'status_wo' => "Requested",
                                    'status_apk' => "Requested",
                                    'ms_regular' => isset($areaSegmen->status_ms) ? $areaSegmen->status_ms : null,
                                    'wo_date_apk' => $data['wo_date_apk'],
                                    'slot_time_assign_apk' => implode(" ", [$data['tgl_ikr'], $data['time_apk']]),
                                    'port_fat' => $data['fat_port_apk'],
                                    'site_penagihan' => isset($areaSegmen->site) ? $areaSegmen->site : null,
                                    'wo_type_apk' => $data['wo_type_apk'],
                                    'leadcall_id' => $data['leadcall_id'],
                                    'leadcall' => $data['leadcall'],
                                    'leader_id' => $data['leader_id'],
                                    'callsign_id' => $data['callsign_id'],
                                    'tek1_nik' => $data['tek1_nik'],
                                    'tek2_nik' => $data['tek2_nik'],
                                    'tek3_nik' => $data['tek3_nik'],
                                    'tek4_nik' => $data['tek4_nik'],
                                    'teknisi4' => $data['teknisi4'],
                                    'is_checked' => 0,
                                    'login' => $data['login'],
                                    "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                                    "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                                ]);
                            } elseif ($data['type_wo'] === 'FTTH New Installation') {
                                DB::table('data_ftth_ib_oris')->insert([
                                    'site' => isset($areaSegmen->site) ? $areaSegmen->site : null,
                                    'type_wo' => $data['type_wo'],
                                    'wo_type_apk' => $data['wo_type_apk'],
                                    'no_wo' => $data['no_wo_apk'],
                                    'no_ticket' => $data['no_ticket_apk'],
                                    'cust_id' => $data['cust_id_apk'],
                                    'nama_cust' => $data['name_cust_apk'],
                                    'cust_address1' => $data['address_apk'],
                                    'type_maintenance' => $data['remarks_apk'],
                                    'kode_fat' => $data['fat_code_apk'],

                                    'kode_wilayah' => isset($kdArea) ? $kdArea: null,
                                    'cluster' => isset($data['area_cluster_apk']) ? $data['area_cluster_apk'] : $areaSegmen->cluster,
                                    'kotamadya' => isset($areaSegmen->kotamadya) ? $areaSegmen->kotamadya : null,
                                    'kotamadya_penagihan' => isset($areaSegmen->kotamadya_penagihan) ? $areaSegmen->kotamadya_penagihan: null,

                                    'branch_id' => $data['branch_id'],
                                    'branch' => $data['branch'],
                                    'leadcall_id' => $data['leadcall_id'],
                                    'leadcall' => $data['leadcall'],
                                    'tgl_ikr' => $data['tgl_ikr'],
                                    'slot_time_leader' => $data['slot_time'],
                                    'slot_time_apk' => $data['time_apk'],
                                    'sesi' => $data['batch_wo'],
                                    'callsign' => $data['callsign'],
                                    'callsign_id' => $data['callsign_id'],
                                    'leader_id' => $data['leader_id'],
                                    'leader' => $data['leader'],
                                    'tek1_nik' => $data['tek1_nik'],
                                    'tek2_nik' => $data['tek2_nik'],
                                    'tek3_nik' => $data['tek3_nik'],
                                    'tek4_nik' => $data['tek4_nik'],
                                    'teknisi1' => $data['teknisi1'],
                                    'teknisi2' => $data['teknisi2'],
                                    'teknisi3' => $data['teknisi3'],
                                    'teknisi4' => $data['teknisi4'],
                                    'wo_date_apk' => $data['wo_date_apk'],
                                    'port_fat' => $data['fat_port_apk'],
                                    'status_wo' => "Requested",
                                    'status_apk' => "Requested",
                                    'is_checked' => 0,
                                    'login' => $data['login'],
                                    "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                                    "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                                ]);
                            } elseif ($data['type_wo'] == 'FTTH Dismantle') {
                                DB::table('data_ftth_dismantle_oris')->insert([
                                    'sesi' => $data['batch_wo'],
                                    'visit_date' => $data['tgl_ikr'],
                                    'type_wo' => $data['type_wo'],
                                    'no_wo' => $data['no_wo_apk'],
                                    'no_ticket' => $data['no_ticket_apk'],
                                    'wo_date' => $data['wo_date_apk'],
                                    'cust_id' => $data['cust_id_apk'],
                                    'nama_cust' => $data['name_cust_apk'],
                                    'cust_address1' => $data['address_apk'],
                                    'cluster' => $data['area_cluster_apk'],
                                    'wo_type_apk' => $data['wo_type_apk'],
                                    'kode_fat' => $data['fat_code_apk'],
                                    'port_fat' => $data['fat_port_apk'],
                                    'slot_time_leader' => $data['slot_time'],
                                    'slot_time_apk' => $data['time_apk'],
                                    'status_wo' => "Requested",
                                    'status_apk' => "Requested",
                                    'branch_id' => $data['branch_id'],
                                    'main_branch' => $data['branch'],
                                    'leadcall_id' => $data['leadcall_id'],
                                    'leadcall' => $data['leadcall'],
                                    'leader_id' => $data['leader_id'],
                                    'leader' => $data['leader'],
                                    'callsign_id' => $data['callsign_id'],
                                    'callsign' => $data['callsign'],
                                    'tek1_nik' => $data['tek1_nik'],
                                    'teknisi1' => $data['teknisi1'],
                                    'tek2_nik' => $data['tek2_nik'],
                                    'teknisi2' => $data['teknisi2'],
                                    'tek3_nik' => $data['tek3_nik'],
                                    'teknisi3' => $data['teknisi3'],
                                    'login' => $data['login'],
                                    "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                                    "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                                ]);
                            }
                        }

                        // Hapus data sementara yang sudah diproses
                        ImportAssignTim::where('login', $akses) //whereNotIn('no_wo_apk', $doubleAssign)
                            ->delete();

                        DB::commit();

                        // Cek apakah ada duplikasi
                        // if (count($doubleAssign) > 0) {
                        //     $warningMessage = 'Beberapa No WO sudah ada di assign tim: ' . implode(', ', $doubleAssign);
                        //     return redirect()->route('assignTim')
                        //         ->with(['success' => 'Data tersimpan sebagian.'. $warningMessage])
                        //         ->with(['warning' => $warningMessage]);
                        // } else {
                        //     return redirect()->route('assignTim')
                        //         ->with(['success' => 'Data tersimpan.']);
                        // }

                        return redirect()->route('assignTim')
                                ->with(['success' => 'Data tersimpan.']);
                    } catch (\Exception $e) {

                        DB::rollBack();
                        // dd($kdArea);
                        return redirect()->route('importDataWo')
                            ->with(['error' => 'Gagal Simpan Data: ' . $e->getMessage()]);
                    }
                } else {
                    return redirect()->route('importDataWo')
                        ->with(['error' => 'Data WO tidak ada assign tim.']);
                }
                break;

            case 'batal':
                ImportAssignTim::where('login', $akses)->delete();
                return redirect()->route('assignTim');
                break;
        }
    }



    public function updateImportWo(Request $request)
    {
        $aksesId = Auth::user()->id;
        $akses = Auth::user()->name;
        $imp_id = $request->detId;

        if ($request->branchShow) {
            $ReqBranch = explode('|', $request->branchShow);
            $branchId = $ReqBranch[0];
            $branchNm = $ReqBranch[1];
        }

        if ($request->LeadCallsignShow) {
            $ReqLeadCall = explode('|', $request->LeadCallsignShow);
            $leadCallId = $ReqLeadCall[0];
            $leadCall = $ReqLeadCall[1];
            $leaderId = $ReqLeadCall[2];
            $leader = $ReqLeadCall[3];
        } else {
            $leadCallId = $request->LeadCallsignShow;
            $leadCall = $request->LeadCallsignShow;
            $leaderId = $request->leaderidShow;
            $leader = $request->leaderShow;
        }

        if ($request->teknisi1Show) {
            $ReqTek1 = explode('|', $request->teknisi1Show);
            $tek1Nk = $ReqTek1[0];
            $tek1 = $ReqTek1[1];
        } else {
            $tek1Nk = $request->teknisi1Show;
            $tek1 = $request->teknisi1Show;
        }

        if ($request->teknisi2Show) {
            $ReqTek2 = explode('|', $request->teknisi2Show);
            $tek2Nk = $ReqTek2[0];
            $tek2 = $ReqTek2[1];
        } else {
            $tek2Nk = $request->teknisi2Show;
            $tek2 = $request->teknisi2Show;
        }

        if ($request->teknisi3Show) {
            $ReqTek3 = explode('|', $request->teknisi3Show);
            $tek3Nk = $ReqTek3[0];
            $tek3 = $ReqTek3[1];
        } else {
            $tek3Nk = $request->teknisi3Show;
            $tek3 = $request->teknisi3Show;
        }

        if ($request->teknisi4Show) {
            $ReqTek4 = explode('|', $request->teknisi4Show);
            $tek4Nk = $ReqTek4[0];
            $tek4 = $ReqTek4[1];
        } else {
            $tek4Nk = $request->teknisi4Show;
            $tek4 = $request->teknisi4Show;
        }

        if ($request->callsignTimidShow) {
            $ReqCallsign = explode('|', $request->callsignTimidShow);
            $callsignId = $ReqCallsign[0];
            $callsign = $ReqCallsign[1];
        } else {
            $callsignId = $request->callsignTimidShow;
            $callsign = $request->callsignTimidShow;
        }

        $dataImport = ImportAssignTim::findOrFail($imp_id);

        $updateImportWo = $dataImport->update([
            'batch_wo' => $request['sesiShow'],
            'tgl_ikr' => $request['tglProgressShow'],
            'slot_time' => $request['slotTimeShow'],
            'type_wo' => $request['jenisWoShow'],
            'branch_id' => $branchId,
            'branch' => $branchNm,
            'leadcall_id' => $leadCallId,
            'leadcall' => $leadCall,
            'leader_id' => $leaderId,
            'leader' => $leader,
            'callsign_id' => $callsignId,
            'callsign' => $callsign,
            'tek1_nik' => $tek1Nk,
            'teknisi1' => $tek1,
            'tek2_nik' => $tek2Nk,
            'teknisi2' => $tek2,
            'tek3_nik' => $tek3Nk,
            'teknisi3' => $tek3,
            'tek4_nik' => $tek4Nk,
            'teknisi4' => $tek4,
            'login_id' => $aksesId,
            'login' => $akses
        ]);

        if ($updateImportWo) {
            return response()->json(['success' => 'Data tersimpan.', 'brImport' => $request->branchShow]);
        } else {
            return response()->json(['error' => 'Gagal Simpan Data.', 'brImport' => $request->branchShow]);
        }
    }

    public function getMaterial(Request $request)
    {
        $wo_no = "WO-24102024-2112494"; // contoh WO No

        $ftth_material = DB::table('ftth_materials')
            ->select(
                'wo_no',
                'installation_date',
                'status_item',
                DB::raw('CASE WHEN status_item = "OUT" AND description LIKE "%ONT%" THEN description END AS merk_ont_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND description LIKE "%ONT%" THEN sn END AS sn_ont_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND description LIKE "%ONT%" THEN mac_address END AS mac_ont_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND description LIKE "%STB%" THEN description END AS stb_merk_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND description LIKE "%PRECON%" THEN description END AS precon_out'),
                DB::raw('CASE WHEN status_item = "IN" AND description LIKE "%STB%" THEN description END AS stb_merk_in'),
                DB::raw('CASE WHEN status_item = "IN" AND description LIKE "%ONT%" THEN description END AS merk_ont_in'),
                DB::raw('CASE WHEN status_item = "IN" AND description LIKE "%ONT%" THEN sn END AS sn_ont_in'),
                DB::raw('CASE WHEN status_item = "IN" AND description LIKE "%ONT%" THEN mac_address END AS mac_ont_in')
            )
            ->where('wo_no', $wo_no)
            ->get();

        return $ftth_material;

    }

}
