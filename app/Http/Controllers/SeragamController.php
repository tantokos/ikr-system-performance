<?php

namespace App\Http\Controllers;

use App\Models\DataSeragam;
use App\Models\DataTerimaSeragam;
use App\Models\DataTerimaSeragamDetail;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class SeragamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mail = Auth::user()->email;
        $login = Employee::where('email', $mail)
                ->leftJoin('branches', 'employees.branch_id','=','branches.id')
                ->select('nik_karyawan', 'nama_karyawan','departement','posisi','branch_id','nama_branch','email')
                ->first();

        $area = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();
        
        return view('seragam.data_seragam',
            ['area' => $area, 'login' => $login]);
    }

    public function getKaryawanBranch(Request $request)
    {
        $br = explode("|", $request->branch);
        $branch = $br[1]; 
        $dtkry = DB::table('v_karyawan_callsign')->where('nama_branch', $branch)->get();

        return response()->json($dtkry);
    }
    
    public function getRekapSeragam(Request $request)
    {
        // $RekapTool = DB::table('v_rekap_tool')->get();
        $stockSeragam = DB::table('data_seragams')
                ->select(DB::raw('posisi_seragam, sum(if(ukuran="S", jml,0)) as ukuranS, 
                            sum(if(ukuran="M", jml,0)) as ukuranM,
                            sum(if(ukuran="L", jml,0)) as ukuranL,
                            sum(if(ukuran="XL", jml,0)) as ukuranXL,
                            sum(if(ukuran="XXL", jml,0)) as ukuranXXL,
                            sum(if(ukuran="XXXL", jml,0)) as ukuranXXXL'))
                ->groupBy('posisi_seragam');

        $RekapTool = DB::table('v_rekap_seragam')
                ->select(DB::raw('status,posisi_penerima, sum(if(ukuran="S", jml,0)) as ukuranS, 
                            sum(if(ukuran="M", jml,0)) as ukuranM,
                            sum(if(ukuran="L", jml,0)) as ukuranL,
                            sum(if(ukuran="XL", jml,0)) as ukuranXL,
                            sum(if(ukuran="XXL", jml,0)) as ukuranXXL,
                            sum(if(ukuran="XXXL", jml,0)) as ukuranXXXL'))
                ->groupBy('status','posisi_penerima');
                // ->get();

        if($request->filBranch != "ALL"){
            $RekapTool = $RekapTool->where('branch_penerima',$request->filBranch);
            $stockSeragam = $stockSeragam->where('branch_seragam',$request->filBranch);
        }

        // if($request->filUkuran != "ALL") {
        //     $RekapTool = $RekapTool->where('nama_barang', $request->filNamaTool);
        // }

        if($request->filPosisi != "ALL"){
            if($request->filPosisi == "Tim") {
                $RekapTool = $RekapTool->whereNotIn('posisi_penerima',["Supervisor","Dikembalikan ke GA","Disposal"]);
                $stockSeragam = $stockSeragam->whereNotIn('posisi_seragam',["Supervisor","Dikembalikan ke GA","Disposal"]);
            } else {
                $RekapTool = $RekapTool->where('posisi_penerima',$request->filPosisi);
                $stockSeragam = $stockSeragam->where('posisi_seragam',$request->filPosisi);
            }
            
        }
        if($request->filKondisi != "ALL"){
            $RekapTool = $RekapTool->where('kondisi',$request->filKondisi);
            $stockSeragam = $stockSeragam->where('kondisi',$request->filKondisi);
        }
        // if($request->filCallsign != "ALL"){
        //     $RekapTool = $RekapTool->where('posisi',$request->filCallsign);
        // }
        // if($request->filApprove1 != "ALL"){
        //     $RekapTool = $RekapTool->where('approve1',$request->filApprove1);
        // }
        // if($request->filApprove2 != "ALL"){
        //     $RekapTool = $RekapTool->where('approve2',$request->filApprove2);
        // }

        $RekapTool = $RekapTool->get();
        $stockSeragam = $stockSeragam->get();

        return response()->json($RekapTool);
    }

    public function getDataSeragam(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('v_rekap_seragam')
                ->select(DB::raw('status,status_id,tgl_terima,nik_penerima, nama_penerima,departement,posisi_penerima,posisi_seragam,branch_penerima,kondisi,ukuran, jml as total'))
                // ->groupBy('status','status_id','tgl_terima','nik_penerima','nama_penerima','departement','posisi_penerima','posisi_seragam','branch_penerima','kondisi')
                ->orderBy('tgl_terima','DESC');
                // ->get();

        if($request->filBranch != "ALL"){
            $datas = $datas->where('branch_penerima',$request->filBranch);
        }

        if($request->filPosisi != "ALL"){
            if($request->filPosisi == "Tim") {
                $datas = $datas->whereNotIn('posisi_seragam',["Supervisor","Dikembalikan ke GA","Disposal"]);
            } else {
                $datas = $datas->where('posisi_seragam',$request->filPosisi);
            }
            
        }
        if($request->filKondisi != "ALL"){
            $datas = $datas->where('kondisi',$request->filKondisi);
        }

        $datas = $datas->get();
        // dd($datas);

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-terima" data-id="' . $row->status ."|". $row->status_id . '" class="btn btn-sm btn-primary detail-terima mb-0" >Detail</a>';
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

    public function getRekapTeknisiTanpaSeragam(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('v_rekap_seragam_teknisi')
                ->select(DB::raw('nama_branch, count(if(jml=0,1,null)) as jml'))
                ->groupBy('nama_branch')
                ->orderBy('jml','DESC');
                // ->get();

        if($request->filBranch != "ALL"){
            $datas = $datas->where('nama_branch',$request->filBranch);
        }

        $datas = $datas->get();

        return response()->json($datas);

    }

    public function showDetailSeragam(Request $request)
    {
        $headTerima = DB::table('data_terima_seragams')
                ->where('id', $request->filTerimaId)->first();

        $detTerima = DB::table('data_terima_seragams as sh')
                ->leftJoin('data_terima_seragam_details as sd','sh.id','=','sd.penerimaan_id')
                ->select('sh.*','sd.id as det_id', 'sd.ukuran','sd.kondisi','sd.jml')
                ->where('sh.id', $request->filTerimaId)
            ->get();

        return response()->json(['hterima' => $headTerima, 'dterima' => $detTerima]);
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
