<?php

namespace App\Http\Controllers;

use App\Models\DataAssignTim;
use App\Models\Employee;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class RekapAssignTimController extends Controller
{
    public function index()
    {
        $Leadcallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $leader = DB::table('v_detail_callsign_tim')->select('leader_id', 'nama_leader', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $branches = DB::table('branches')->select('id','nama_branch')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        $callTim = DB::table('v_detail_callsign_tim')
            ->select('callsign_tim_id', 'callsign_tim')->distinct()
            ->orderBy('callsign_tim')->get();

        $tim = Employee::whereIn('posisi', ['Installer', 'Maintenance','Teknisi'])
            ->select('nik_karyawan', 'nama_karyawan')
            ->where('status_active','=','Aktif')
            ->orderBy('nama_karyawan')
            ->get();
        
        $cluster = DB::table('fats')->select('cluster')
                ->where('cluster', '<>', "")->distinct()->orderBy('cluster')->get();

        return view('assign.rekap_assign_tim', ['leadCallsign' => $Leadcallsign, 'leader' => $leader, 
                                        'branches' => $branches, 'callTim' => $callTim, 
                                        'cluster' => $cluster, 'tim' => $tim]);
    }

    public function getTabelRekapAssignTim(Request $request)
    {
        $akses = Auth::user()->name;
                            
            $datas = DB::table('v_rekap_summary_tim as vtim')
                ->select(DB::raw('vtim.branch, vtim.departement,
                                    sum(vtim.jml_tim) as j_tim,
                                    sum(vtim.jml_assign) as j_assign, 
                                    sum(vtim.jml_teknisi) as j_teknisi,
                                    sum(vtim.jml_on) as j_on,
                                    sum(vtim.jml_off) as j_off,
                                    sum(vtim.jml_cuti) as j_cuti,
                                    sum(vtim.jml_sakit) as j_sakit,
                                    sum(vtim.jml_abs) as j_abs'))
                // ->where('vtim.departement','FTTH')
                ->groupBy('vtim.branch','vtim.departement')
                ->orderBy(DB::raw('case when vtim.branch="Jakarta Timur" then 1
                            when vtim.branch="Jakarta Selatan" then 2
                            when vtim.branch="Bekasi" then 3
                            when vtim.branch="Bogor" then 4
                            when vtim.branch="Tangerang" then 5
                            when vtim.branch="Medan" then 6
                            when vtim.branch="Pangkal Pinang" then 7
                            when vtim.branch="Pontianak" then 8
                            when vtim.branch="Jambi" then 9
                            when vtim.branch="Bali" then 10
                            when vtim.branch="Palembang" then 11 end')); 
        
            if($request->filTgl != null) {
                $dateRange = explode("-", $request->filTgl);
                $startDt = \Carbon\Carbon::parse($dateRange[0])->format('Y-m-d');
                $endDt = \Carbon\Carbon::parse($dateRange[1])->format('Y-m-d');

                $datas = $datas->whereBetween('vtim.tgl_ikr',[$startDt, $endDt]);
                // $datas = $datas->whereRaw("(date_format(vtim.tgl_ikr,'%Y-%m-%d') >= ? and date_format(vtim.tgl_ikr, '%Y-%m-%d') <= ?)",[$startDt, $endDt]);
            }

            if($request->filarea != null) {
                $b = explode("|", $request->filarea);
                $br = $b[1];
                $datas = $datas->where('vtim.branch', $br);
            }

            $datas = $datas->get();

 
        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran                
                ->addColumn('action', function ($row) {
                    $btn = '
                        <button type="button" id="showDetRekapAssignTim" name="showDetRekapAssignTim" data-id= "'. $row->branch . '" class="btn btn-sm btn-dark btn-icon align-items-center me-0 mb-0 px-1 py-1">
                            <span class="btn-inner--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"></path>
                                </svg>
                            </span>
                        </button>';
                    //'
                    //<a href="javascript:void(0)" id="detail-assign" data-id="' . $row->branch . '" class="btn btn-sm btn-primary detail-assign mb-0" ><i class="bi bi-info-circle"></i></a>';
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

    public function getTimEditCallsign(Request $request)
    {
        // dd($request->all());
        $fil = explode("|", $request->fil);
        $tgl= $fil[0];
        $branch= $fil[1];
        $leadCall = $fil[2];
        $leader = $fil[3];
        $callsign = $fil[4];
        $tek1_nik = $fil[5];
        $teknisi1 = $fil[6];
        $tek2_nik = $fil[7];
        $teknisi2 = $fil[8];

        // dd($tgl);
        // $filTgl = explode("-",$request->tglClick);
        // $startDt = \Carbon\Carbon::parse($filTgl[0])->format('Y-m-d');
        // $endDt = \Carbon\Carbon::parse($filTgl[1])->format('Y-m-d');

        $dt= DB::table('v_rekap_jadwal_data as vd')
                    ->leftJoin('employees as e', 'vd.nik_karyawan','=','e.nik_karyawan')                    
                    ->where('vd.branch', $branch)
                    ->where('e.status_active', 'Aktif')
                    ->whereIn('vd.status', ["ON", "OD"])
                    ->where('vd.tgl', $tgl)
                    ->where('e.posisi', 'like','%Teknisi%')
                    ->select('vd.tgl','vd.branch','vd.nik_karyawan','vd.nama_karyawan','e.posisi')
                    ->orderBy('vd.tgl')
                    ->orderBy('vd.nama_karyawan')
                    ->get();
       
        return response()->json($dt);
    }

    public function updateRekapCallTim(Request $request) 
    {
        
        $tgl = $request->EdittglProgressTim;
        $branch = $request->EditArea;
        $callTim = $request->EditcallsignTim;
        $dept = $request->EditDepartement;

        $tek1 = !isset($request->EditTeknisi1) ? null : explode("|",$request->EditTeknisi1);
        $tek1_nik = !isset($tek1) ? null : $tek1[0];
        $teknisi1 = !isset($tek1) ? null : $tek1[1];

        $tek2 = !isset($request->EditTeknisi2) ? null : explode("|",$request->EditTeknisi2);
        $tek2_nik = !isset($tek2) ? null : $tek2[0];
        $teknisi2 = !isset($tek2) ? null : $tek2[1];

        $tek3 = !isset($request->EditTeknisi3) ? null : explode("|",$request->EditTeknisi3);
        $tek3_nik = !isset($tek3) ? null : $tek3[0];
        $teknisi3 = !isset($tek3) ? null : $tek3[1];

        $tek4 = !isset($request->EditTeknisi4) ? null : explode("|",$request->EditTeknisi4);
        $tek4_nik = !isset($tek4) ? null : $tek4[0];
        $teknisi4 = !isset($tek4) ? null : $tek4[1];

        DB::beginTransaction();
        try {

            //get data dari view rekap assign tim untuk teknisi yg di rubah/update
            $dtAssign = DB::table('v_rekap_assign')
                        ->where('tgl_ikr', $tgl)->whereIn('tek_nik', [$tek1_nik, $tek2_nik, $tek3_nik, $tek4_nik])
                        ->select('callsign', 'departement', 'posisi_nik','posisi_tek')
                        ->get();

            $dtAssignx = DB::table('v_rekap_assign_fttx')
                        ->where('tgl_ikr', $tgl)->whereIn('tek_nik', [$tek1_nik, $tek2_nik, $tek3_nik, $tek4_nik])
                        ->select('callsign', 'departement', 'posisi_nik','posisi_tek')
                        ->get();

            //hapus semua teknisi yang di rubah/update di data callsign lain
            if(!is_null($dtAssign)) {
                for($x=0; $x < count($dtAssign); $x++) {
                    $pos_nik = $dtAssign[$x]->posisi_nik;
                    $pos_tek = $dtAssign[$x]->posisi_tek;

                    $dtAssignTim = DB::table('data_assign_tims')
                            ->where('tgl_ikr', $tgl)
                            ->where('branch', $branch)
                            ->where('callsign', $dtAssign[$x]->callsign)
                            ->update([
                                $pos_nik => null,
                                $pos_tek => null,
                            ]);                                          
                }
            }

            if(!is_null($dtAssignx)) {
                for($x=0; $x < count($dtAssignx); $x++) {
                    $pos_nikx = $dtAssignx[$x]->posisi_nik;
                    $pos_tekx = $dtAssignx[$x]->posisi_tek;

                    $dtAssignTim = DB::table('data_assign_tim_fttxs')
                            ->where('jadwal_ikr', $tgl)
                            ->where('branch', $branch)
                            ->where('callsign', $dtAssignx[$x]->callsign)
                            ->update([
                                $pos_nikx => null,
                                $pos_nikx => null,
                            ]);
                }
            }

                $dtCallTim = DB::table('data_assign_tims')
                    ->where('tgl_ikr',$tgl)->where('branch',$branch)
                    ->where('callsign',$callTim)->update([
                    'tek1_nik' => $tek1_nik,
                    'teknisi1' => $teknisi1,
                    'tek2_nik' => $tek2_nik,
                    'teknisi2' => $teknisi2,
                    'tek3_nik' => $tek3_nik,
                    'teknisi3' => $teknisi3,
                    'tek4_nik' => $tek4_nik,
                    'teknisi4' => $teknisi4,
                ]);

                $dtCallTim = DB::table('data_assign_tim_fttxs')
                    ->where('jadwal_ikr',$tgl)->where('branch',$branch)
                    ->where('callsign',$callTim)->update([
                    'tek1_nik' => $tek1_nik,
                    'tim_1' => $teknisi1,
                    'tek2_nik' => $tek2_nik,
                    'tim_2' => $teknisi2,
                    'tek3_nik' => $tek3_nik,
                    'tim_3' => $teknisi3,
                    'tek4_nik' => $tek4_nik,
                    'tim_4' => $teknisi4,
                ]);
            

            DB::commit();

            // if ($dtCallTim) {
                return response()->json('success');
            // }

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage());
        }

    }

    public function getDetailRekapAssignTim(Request $request)
    {
        $detail = explode("|", $request->fil);
        $branch = $detail[0];
        $dept = $detail[1];
        $tgl = $detail[2];

        $filTgl = explode("-",$tgl);
        $startDt = \Carbon\Carbon::parse($filTgl[0])->format('Y-m-d');
        $endDt = \Carbon\Carbon::parse($filTgl[1])->format('Y-m-d');

        if($dept == "FTTH") {
            $dtx = DB::table('data_assign_tim_fttxs as d')
                ->leftJoin('employees as e', 'd.leader_id', '=', 'e.nik_karyawan')
                ->select('d.jadwal_ikr as tgl_ikr', 'd.branch_id', 'd.branch', 'e.departement','d.leadcall_id', 'd.leadcall', 'd.leader_id', 'd.leader', 
                    'd.callsign_id', 'd.callsign','d.tek1_nik', 'd.tim_1 as teknisi1', 'd.tek2_nik', 'd.tim_2 as teknisi2', 'd.tek3_nik', 'd.tim_3 as teknisi3', 'd.tek4_nik', 'd.tim_4 as teknisi4')
                ->where('d.branch',$branch)
                ->where('e.departement', $dept)
                ->whereBetween('d.jadwal_ikr', [$startDt, $endDt])
                ->groupBy('d.jadwal_ikr', 'd.branch_id', 'd.branch', 'e.departement','d.leadcall_id', 'd.leadcall', 'd.leader_id', 'd.leader', 
                    'd.callsign_id', 'd.callsign','d.tek1_nik', 'd.tim_1', 'd.tek2_nik', 'd.tim_2', 'd.tek3_nik', 'd.tim_3', 'd.tek4_nik', 'd.tim_4')
                ->orderBy('tgl_ikr')->orderBy('callsign');    
                // ->get(); 

            $dt = DB::table('data_assign_tims as d')
                    ->leftJoin('employees as e', 'd.leader_id', '=', 'e.nik_karyawan')
                    ->select('d.tgl_ikr', 'd.branch_id', 'd.branch', 'e.departement','d.leadcall_id', 'd.leadcall', 'd.leader_id', 'd.leader', 
                        'd.callsign_id', 'd.callsign','d.tek1_nik', 'd.teknisi1', 'd.tek2_nik', 'd.teknisi2', 'd.tek3_nik', 'd.teknisi3', 'd.tek4_nik', 'd.teknisi4')
                    ->where('d.branch',$branch)
                    ->where('e.departement', $dept)
                    ->whereBetween('d.tgl_ikr', [$startDt, $endDt])
                    ->union($dtx)
                    ->groupBy('d.tgl_ikr', 'd.branch_id', 'd.branch', 'e.departement','d.leadcall_id', 'd.leadcall', 'd.leader_id', 'd.leader', 
                        'd.callsign_id', 'd.callsign','d.tek1_nik', 'd.teknisi1', 'd.tek2_nik', 'd.teknisi2', 'd.tek3_nik', 'd.teknisi3', 'd.tek4_nik', 'd.teknisi4')
                    ->orderBy('tgl_ikr')->orderBy('callsign')    
                    ->get();
        } else {
            $dt = DB::table('data_assign_tim_fttxs as d')
                ->leftJoin('employees as e', 'd.leader_id', '=', 'e.nik_karyawan')
                ->select('d.jadwal_ikr as tgl_ikr', 'd.branch_id', 'd.branch', 'e.departement','d.leadcall_id', 'd.leadcall', 'd.leader_id', 'd.leader', 
                    'd.callsign_id', 'd.callsign','d.tek1_nik', 'd.tim_1 as teknisi1', 'd.tek2_nik', 'd.tim_2 as teknisi2', 'd.tek3_nik', 'd.tim_3 as teknisi3', 'd.tek4_nik', 'd.tim_4 as teknisi4')
                ->where('d.branch',$branch)
                ->where('e.departement', $dept)
                ->whereBetween('d.jadwal_ikr', [$startDt, $endDt])
                ->groupBy('d.jadwal_ikr', 'd.branch_id', 'd.branch', 'e.departement','d.leadcall_id', 'd.leadcall', 'd.leader_id', 'd.leader', 
                    'd.callsign_id', 'd.callsign','d.tek1_nik', 'd.tim_1', 'd.tek2_nik', 'd.tim_2', 'd.tek3_nik', 'd.tim_3', 'd.tek4_nik', 'd.tim_4')
                ->orderBy('tgl_ikr')->orderBy('callsign')    
                ->get();
        }

        if ($request->ajax()) 
        {
            return DataTables::of($dt)
                ->addIndexColumn() //memberikan penomoran                
                ->addColumn('action', function ($row) {
                    $btn = '
                        <button type="button" id="editSignTim" name="editSignTim" 
                        data-id= "'. $row->tgl_ikr."|".$row->branch."|".$row->leadcall."|".$row->leader."|".$row->callsign ."|".$row->tek1_nik."|".$row->teknisi1."|".$row->tek2_nik."|".$row->teknisi2."|".$row->tek3_nik."|".$row->teknisi3."|".$row->tek4_nik."|".$row->teknisi4."|".$row->departement. '" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-0 mb-0 px-1 py-1">
                            <span class="btn-inner--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"></path>
                                </svg>
                            </span>
                        </button>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
                // ->make(true);
        }

    }

    public function getPopUpRekapAssignTim(Request $request)
    {
        $detail = explode("|", $request->detail);
        $isi = $detail[0];
        $klik = $detail[1];
        $branch = $detail[2];
        $dept = $detail[3];

        $statusAbs =[];
        if (($detail[4] == "ON" or $detail[4]== "OD")){
            $statusAbs = ["ON","OD"];
        } else {
            $statusAbs = [$detail[4]];
        }

        $filTgl = explode("-",$request->tglClick);
        $startDt = \Carbon\Carbon::parse($filTgl[0])->format('Y-m-d');
        $endDt = \Carbon\Carbon::parse($filTgl[1])->format('Y-m-d');

        $dt= DB::table('v_rekap_jadwal_data as vd')
                    ->leftJoin('employees as e', 'vd.nik_karyawan','=','e.nik_karyawan')                    
                    ->where('vd.branch', $branch)
                    ->where('e.status_active', 'Aktif')
                    ->whereIn('vd.status', $statusAbs)
                    ->whereBetween('vd.tgl', [$startDt,$endDt])
                    ->where('e.posisi', 'like','%Teknisi%')
                    ->where('vd.departement','=', $dept)
                    ->select('vd.tgl','vd.branch','vd.nik_karyawan','vd.nama_karyawan','e.posisi','vd.status','vd.keterangan')
                    ->orderBy('vd.tgl')
                    ->orderBy('vd.nama_karyawan')
                    ->orderBy('vd.branch_id')
                    ->orderBy('vd.departement')
                    ->get();

        if ($request->ajax()) 
        {
            return DataTables::of($dt)
                ->addIndexColumn() //memberikan penomoran                
                ->addColumn('action', function ($row) {
                    $btn = '
                        <button type="button" id="editSignTim" name="editSignTim" data-id= "'.$row->branch. '" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-0 mb-0 px-1 py-1">
                            <span class="btn-inner--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"></path>
                                </svg>
                            </span>
                        </button>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
                // ->make(true);
        }

    }

    public function getPopUpRekapJmlAssignTeknisi(Request $request)
    {
        $detail = explode("|", $request->detail);
        $isi = $detail[0];
        $klik = $detail[1];
        $branch = $detail[2];
        $dept = $detail[3];

        $filTgl = explode("-",$request->tglClick);
        $startDt = \Carbon\Carbon::parse($filTgl[0])->format('Y-m-d');
        $endDt = \Carbon\Carbon::parse($filTgl[1])->format('Y-m-d');

        // $tek1 = DB::table('v_rekap_assign_tim as vtim')
        //             ->leftJoin('employees as e', 'vtim.tek1_nik','=','e.nik_karyawan')
        //             ->select('vtim.tgl_ikr','vtim.branch_id','vtim.branch', 'vtim.departement','vtim.callsign', 'vtim.tek1_nik', 'vtim.teknisi1', 'e.posisi' )
        //             ->whereBetween('vtim.tgl_ikr',[$startDt, $endDt])
        //             ->where('vtim.branch',$branch)->where('vtim.departement',$dept)
        //             ->whereNotNull('vtim.tek1_nik');

        // $tek2 = DB::table('v_rekap_assign_tim as vtim')
        //             ->leftJoin('employees as e', 'vtim.tek2_nik','=','e.nik_karyawan')
        //             ->select('vtim.tgl_ikr','vtim.branch_id','vtim.branch', 'vtim.departement','vtim.callsign', 'vtim.tek2_nik', 'vtim.teknisi2', 'e.posisi' )
        //             ->whereBetween('vtim.tgl_ikr',[$startDt, $endDt])
        //             ->where('vtim.branch',$branch)->where('vtim.departement',$dept)
        //             ->whereNotNull('vtim.tek2_nik');

        // $tek3 = DB::table('v_rekap_assign_tim as vtim')
        //             ->leftJoin('employees as e', 'vtim.tek3_nik','=','e.nik_karyawan')
        //             ->select('vtim.tgl_ikr','vtim.branch_id','vtim.branch', 'vtim.departement','vtim.callsign', 'vtim.tek3_nik', 'vtim.teknisi3', 'e.posisi' )
        //             ->whereBetween('vtim.tgl_ikr',[$startDt, $endDt])
        //             ->where('vtim.branch',$branch)->where('vtim.departement',$dept)
        //             ->whereNotNull('vtim.tek3_nik');

        // $tekAssign = DB::table('v_rekap_assign_tim as vtim')
        //             ->leftJoin('employees as e', 'vtim.tek4_nik','=','e.nik_karyawan')
        //             ->select('vtim.tgl_ikr','vtim.branch_id','vtim.branch', 'vtim.departement','vtim.callsign', 'vtim.tek4_nik as tek_nik', 'vtim.teknisi4 as teknisi', 'e.posisi' )
        //             ->whereBetween('vtim.tgl_ikr',[$startDt, $endDt])
        //             ->where('vtim.branch',$branch)->where('vtim.departement',$dept)
        //             ->whereNotNull('vtim.tek4_nik')
        //             ->union($tek1)
        //             ->union($tek2)
        //             ->union($tek3)->distinct()
        //             ->orderBy('callsign')->get();

        $tekFtth = DB::table('v_rekap_assign as vtim')
                    ->leftJoin('employees as e', 'vtim.tek_nik','=','e.nik_karyawan')
                    ->select('vtim.tgl_ikr','vtim.branch', 'vtim.departement','vtim.callsign', 'vtim.tek_nik', 'vtim.teknisi', 'e.posisi' )
                    ->whereBetween('vtim.tgl_ikr',[$startDt, $endDt])
                    ->where('vtim.branch',$branch)->where('vtim.departement',$dept)
                    ->whereNotNull('vtim.tek_nik');

        $tekAssign = DB::table('v_rekap_assign_fttx as vtim')
                    ->leftJoin('employees as e', 'vtim.tek_nik','=','e.nik_karyawan')
                    ->select('vtim.tgl_ikr','vtim.branch', 'vtim.departement','vtim.callsign', 'vtim.tek_nik', 'vtim.teknisi as teknisi', 'e.posisi' )
                    ->whereBetween('vtim.tgl_ikr',[$startDt, $endDt])
                    ->where('vtim.branch',$branch)->where('vtim.departement',$dept)
                    ->whereNotNull('vtim.tek_nik')
                    ->union($tekFtth)->distinct()
                    ->orderBy('callsign')->get();


        $tekStandBy= DB::table('v_rekap_jadwal_data as vd')
                    ->leftJoin('employees as e', 'vd.nik_karyawan','=','e.nik_karyawan')                    
                    ->where('vd.branch', $branch)
                    ->where('e.status_active', 'Aktif')
                    ->whereIn('vd.status', ["ON","OD"])
                    ->whereBetween('vd.tgl', [$startDt,$endDt])
                    ->where('e.posisi', 'like','%Teknisi%')
                    ->where('vd.departement','=', $dept)
                    ->whereNotIn('vd.nik_karyawan', $tekAssign->pluck('tek_nik'))
                    ->select('vd.tgl as tgl_ikr','vd.branch','vd.nik_karyawan as tek_nik','vd.nama_karyawan as teknisi','e.posisi','vd.status','vd.keterangan')
                    ->orderBy('vd.tgl')
                    ->orderBy('vd.nama_karyawan')
                    ->orderBy('vd.branch_id')
                    ->orderBy('vd.departement')
                    ->get();

        if($klik=="JmlTeknisi") {
            $dt = $tekAssign;
        }elseif($klik=="JmlStandby"){
            $dt = $tekStandBy;
        }

        
        if ($request->ajax()) 
        {
            return DataTables::of($dt)
                ->addIndexColumn() //memberikan penomoran                
                ->addColumn('action', function ($row) {
                    $btn = '
                        <button type="button" id="editSignTim" name="editSignTim" data-id= "'.$row->branch. '" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-0 mb-0 px-1 py-1">
                            <span class="btn-inner--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"></path>
                                </svg>
                            </span>
                        </button>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
                // ->make(true);
        }

    }

    public function getTabelLeadAssignTim(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('v_rekap_assign_tim_hx')
                ->select('branch','departement',DB::raw('sum(ftth_ib) as ftth_ib, sum(ftth_mt) as ftth_mt, sum(dismantle) as dismantle, sum(fttx_ib) as fttx_ib, sum(fttx_mt) as fttx_mt'))
                ->groupBy('branch','departement')
                ->orderBy('branch');

            if($request->filTgl != null) {
                $dateRange = explode("-", $request->filTgl);
                $startDt = \Carbon\Carbon::parse($dateRange[0]);
                $endDt = \Carbon\Carbon::parse($dateRange[1]);

                $datas = $datas->whereBetween('tgl_ikr',[$startDt, $endDt]);
            }

            if($request->filNoWo != null) {
                $datas = $datas->where('wo_no', $request->filNoWo);
            }
            if($request->filcustId != null) {
                $datas = $datas->where('cust_id', $request->filcustId);
            }
            if($request->filtypeWo != null) {
                $datas = $datas->where('jenis_wo', $request->filtypeWo);
            }
            if($request->filarea != null) {
                $b = explode("|", $request->filarea);
                $br = $b[1];
                $datas = $datas->where('branch', $br);
            }
            if($request->filleaderTim != null) {
                $lt = explode("|", $request->filleaderTim);
                $ld = $lt[1];
                $datas = $datas->where('login', $ld);
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
                $datas = $datas->where('area', $request->filcluster);
            }
            if($request->filfatCode != null) {
                $datas = $datas->where('fat_code', $request->filfatCode);
            }
            if($request->filslotTime != null) {
                $datas = $datas->where('slot_time', $request->filslotTime);
            }

            $datas = $datas->get();

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran                
                ->addColumn('action', function ($row) {
                    $btn = '
                        <button type="button" id="showDetAssignTim" name="showDetAssignTim" data-id= "'. $row->branch . '" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-0 mb-0 px-1 py-1">
                            <span class="btn-inner--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"></path>
                                </svg>
                            </span>
                        </button>';
                    //'
                    //<a href="javascript:void(0)" id="detail-assign" data-id="' . $row->branch . '" class="btn btn-sm btn-primary detail-assign mb-0" ><i class="bi bi-info-circle"></i></a>';
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

    public function getDetailLeadAssignTim(Request $request)
    {
        // dd($request);
        $akses = Auth::user()->name;

        $datas = DB::table('data_assign_tims')->orderBy('tgl_ikr', 'DESC');

            if($request->filTgl != null) {
                $dateRange = explode("-", $request->filTgl);
                $startDt = \Carbon\Carbon::parse($dateRange[0]);
                $endDt = \Carbon\Carbon::parse($dateRange[1]);

                $datas = $datas->whereBetween('tgl_ikr',[$startDt, $endDt]);
            }

            if($request->filBrnchLead != null) {
                $BrLead = explode("|", $request->filBrnchLead);
                $branch = $BrLead[0];
                $lead = $BrLead[1];

                $datas = $datas->where('branch',$branch)->where('login',$lead);
            }

            $datas=$datas->get();

            // dd($datas);

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->editColumn('name_cust_apk', function ($nm) {
                    return Str::title($nm->name_cust_apk);
                })
                ->editColumn('wo_type_apk', function ($nm) {
                    return Str::title($nm->wo_type_apk);
                })
                ->editColumn('area_cluster_apk', function ($nm) {
                    return Str::title($nm->area_cluster_apk);
                })
                ->editColumn('branch', function ($nm) {
                    return Str::title($nm->branch);
                })
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
