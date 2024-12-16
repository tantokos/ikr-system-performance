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

class TerimaSeragamController extends Controller
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
        
        return view('seragam.terima_seragam',
            ['area' => $area, 'login' => $login]);
    }

    public function getKaryawanBranch(Request $request)
    {
        $br = explode("|", $request->branch);
        $branch = $br[1]; 
        $dtkry = DB::table('v_karyawan_callsign')->where('nama_branch', $branch)->get();

        return response()->json($dtkry);
    }

    public function simpanSeragam(Request $request)
    {
        // dd($request->all(), count($request->jml), is_numeric($request->jml[1]));
        $loginId = Auth::user()->id;
        $login = Auth::user()->name;

        if ($request->hasFile('fotoSeragam')) {
            $fileFoto = $request->file('fotoSeragam');
            $file = $fileFoto->hashName();
            // $request->file('fotoSeragam')->move(public_path('storage/image-seragam'), $file);
        } else {
            $file = 'default-150x150.png';
        }

        DB::beginTransaction();
        try {

            $headSeragam = DataTerimaSeragam::create([
                'tgl_terima' => $request['tglPenerimaan'],
                'nik_penerima' => $request['nikpenerima'],
                'nama_penerima' => $request['namapenerima'],
                'departement' => $request['departemen'],
                'posisi_penerima' => $request['posisi'],
                'posisi_seragam' => "Supervisor",
                'branch_penerima' => $request['namaBranch'],
                'foto_terima_seragam' => $file,
                'keterangan' => $request->keterangan,
                'login_id' => $loginId,
                'login' => $login,
            ]);

            for($x=0; $x < count($request->jml); $x++) {
                if($request->jml[$x] > 0 ) {
                    $detailSeragam = DataTerimaSeragamDetail::create([
                        'penerimaan_id' => $headSeragam->id,
                        'ukuran' => $request->ukuran[$x],
                        'kondisi' => $request->kondisi[$x],
                        'jml' => $request->jml[$x],
                    ]);

                    $stockSeragam = DataSeragam::where('branch_seragam', $request->namaBranch)
                                    ->where('ukuran', $request->ukuran[$x])
                                    ->where('kondisi', $request->kondisi[$x])
                                    ->first();

                    if($stockSeragam){
                        $stockSeragam->update([
                            'jml' => $stockSeragam->jml + $request->jml[$x]
                        ]);
                    }else{
                        DataSeragam::create([
                            'branch_id' => $request->branchId,
                            'branch_seragam' => $request->namaBranch,
                            'posisi_seragam' => "Supervisor",
                            'kondisi' => $request->kondisi[$x],
                            'ukuran' => $request->ukuran[$x],
                            'jml' => $request->jml[$x],
                        ]);
                    }
                }
            }

            if ($request->hasFile('fotoSeragam')) {
                // $fileFoto = $request->file('fotoSeragam');
                // $file = $fileFoto->hashName();
                $request->file('fotoSeragam')->move(public_path('storage/image-seragam'), $file);
            }

            DB::commit();            

            return redirect()->route('penerimaanSeragam')->with(['success' => 'Data tersimpan.']);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('penerimaanSeragam')->with('error','Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function getRekapTerimaSeragam(Request $request)
    {
        // $RekapTool = DB::table('v_rekap_tool')->get();

        $rekapTerima = DB::table('data_terima_seragams as sh')
                    ->leftJoin('data_terima_seragam_details as sd','sh.id','=','sd.penerimaan_id')
                    ->select(DB::raw('sh.branch_penerima, sum(if(ukuran="S", jml,0)) as ukuranS, 
                            sum(if(ukuran="M", jml,0)) as ukuranM,
                            sum(if(ukuran="L", jml,0)) as ukuranL,
                            sum(if(ukuran="XL", jml,0)) as ukuranXL,
                            sum(if(ukuran="XXL", jml,0)) as ukuranXXL,
                            sum(if(ukuran="XXXL", jml,0)) as ukuranXXXL'))
                ->groupBy('sh.branch_penerima');


        if($request->filBranch != "ALL"){
            $rekapTerima = $rekapTerima->where('sh.branch_penerima',$request->filBranch);
            
        }

        if($request->filUkuran != "ALL"){
            $rekapTerima = $rekapTerima->where('sd.ukuran',$request->filUkuran);
            
        }


        $rekapTerima = $rekapTerima->get();

        return response()->json($rekapTerima);
    }

    public function getDataTerimaSeragam(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('data_terima_seragams as sh')
                ->leftJoin('data_terima_seragam_details as sd','sh.id','=','sd.penerimaan_id')
                ->select(DB::raw('sh.id, sh.tgl_terima, sh.nik_penerima, sh.nama_penerima, sh.departement, sh.posisi_penerima, sh.posisi_seragam, sh.branch_penerima, sh.foto_terima_seragam, sh.keterangan,
                            sd.ukuran, sd.jml'))
                ->orderBy('tgl_terima','DESC');
                // ->get();

        if($request->filBranch != "ALL"){
            $datas = $datas->where('sh.branch_penerima',$request->filBranch);
        }
        
        if($request->filUkuran != "ALL"){
            $datas = $datas->where('sd.ukuran',$request->filUkuran);
        }

        $datas = $datas->get();
        // dd($datas);

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-terima" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-terima mb-0" >Detail</a>';
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

    public function showDetailTerimaSeragam(Request $request)
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
