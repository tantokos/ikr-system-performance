<?php

namespace App\Http\Controllers;

use App\Models\DataDistribusiSeragam;
use App\Models\DataDistribusiSeragamDetail;
use App\Models\DataSeragam;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DistribusiSeragamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mail = Auth::user()->email;
        $login = Employee::where('email', $mail)
                ->leftJoin('branches', 'employees.branch_id','=','branches.id')
                ->select('nik_karyawan', 'nama_karyawan','departement','posisi','nama_branch','email')
                ->first();

        $area = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        $kry = DB::table('employees as e')->leftJoin('branches as b', 'e.branch_id','=','b.id')
                ->where('e.status_active','Aktif')
                ->where('b.nama_branch',$login->nama_branch)
                ->select('e.nik_karyawan','e.nama_karyawan','e.departement', 'e.posisi', 'e.branch_id','b.nama_branch')
                ->orderBy('e.nama_karyawan')->get();

        $stock = DB::table('data_seragams')->where('branch_seragam',$login->nama_branch)
                ->where('kondisi', 'Baik')
                ->select(DB::raw('branch_seragam, 
                            sum(if(ukuran="S", jml, 0)) as sizeS,
                            sum(if(ukuran="M", jml, 0)) as sizeM,
                            sum(if(ukuran="L", jml, 0)) as sizeL,
                            sum(if(ukuran="XL", jml, 0)) as sizeXL,
                            sum(if(ukuran="XXL", jml, 0)) as sizeXXL,
                            sum(if(ukuran="XXXL", jml, 0)) as sizeXXXL'))
                ->groupBy('branch_seragam')
                ->first();

        return view('seragam.distribusi_seragam',['karyawan' => $kry, 'login' => $login, 'stock' => $stock, 'area' => $area]);
    }

    public function simpanDistribusiSeragam(Request $request)
    {
        // dd($request->all());
        $loginId = Auth::user()->id;
        $login = Auth::user()->name;

        $namaKry = explode("|", $request->namapenerima);
        $nama = $namaKry[1];
        $branchId = $namaKry[4];

        if ($request->hasFile('fotoDistribusi')) {
            $fileFoto = $request->file('fotoDistribusi');
            $file = $fileFoto->hashName();
            // $request->file('fotoSeragam')->move(public_path('storage/image-seragam'), $file);
        } else {
            $file = 'default-150x150.png';
        }

        DB::beginTransaction();
        try {

            $headDistribusi = DataDistribusiSeragam::create([
                'tgl_distribusi' => $request['tglDistribusi'],
                'nik_penerima' => $request['nikpenerima'],
                'nama_penerima' => $nama,
                'departement' => $request['departemen'],
                'posisi_penerima' => $request['posisi'],
                'posisi_seragam' => "Teknisi",
                'branch_penerima' => $request['namaBranch'],

                'nik_distribusi' => $request['nikDistribusi'],
                'nama_distribusi' => $request['namaDistribusi'],
                'dept_distribusi' => $request['deptDistribusi'],
                'posisi_distribusi' => $request['posisiDistribusi'],
                'branch_distribusi' => $request['branchDistribusi'],

                'foto_distribusi_seragam' => $file,
                'keterangan' => $request->keterangan,
                'login_id' => $loginId,
                'login' => $login,
            ]);

            for($x=0; $x < count($request->jml); $x++) {
                if($request->jml[$x] > 0 ) {
                    $detailSeragam = DataDistribusiSeragamDetail::create([
                        'distribusi_id' => $headDistribusi->id,
                        'ukuran' => $request->ukuran[$x],
                        'kondisi' => $request->kondisi[$x],
                        'jml' => $request->jml[$x],
                    ]);

                    //update stock seragam di supervisor
                    $stockSeragam = DataSeragam::where('branch_seragam', $request->namaBranch)
                                    ->where('ukuran', $request->ukuran[$x])
                                    ->where('kondisi', $request->kondisi[$x])
                                    ->first();

                    if($stockSeragam){
                        $stockSeragam->update([
                            'jml' => $stockSeragam->jml - $request->jml[$x]
                        ]);
                    }

                    //update/create stock seragam yang di distribusi/teknisi
                    $stockTeknisi = DataSeragam::where('nik_teknisi', $request->nikpenerima)
                                    ->where('ukuran', $request->ukuran[$x])
                                    ->where('kondisi', $request->kondisi[$x])
                                    ->first();

                    if($stockTeknisi){
                        $stockTeknisi->update([
                            'jml' => $stockTeknisi->jml + $request->jml[$x]
                        ]);
                    } else {
                        DataSeragam::create([
                            'branch_id' => $branchId,
                            'branch_seragam' => $request->namaBranch,
                            'nik_teknisi' => $request->nikpenerima,
                            'posisi_seragam' => "Teknisi",
                            'kondisi' => $request->kondisi[$x],
                            'ukuran' => $request->ukuran[$x],
                            'jml' => $request->jml[$x],
                        ]);
                    }

                }
            }

            if ($request->hasFile('fotoDistribusi')) {
                // $fileFoto = $request->file('fotoSeragam');
                // $file = $fileFoto->hashName();
                $request->file('fotoDistribusi')->move(public_path('storage/image-seragam'), $file);
            }

            DB::commit();            

            return redirect()->route('distribusiSeragam')->with(['success' => 'Data tersimpan.']);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('distribusiSeragam')->with('error','Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function getRekapDistribusiSeragam(Request $request)
    {        
        $RekapDistribusi = DB::table('data_distribusi_seragams as sh')
                ->leftJoin('data_distribusi_seragam_details as sd','sh.id','=','sd.distribusi_id')
                ->select(DB::raw('sh.posisi_penerima, sum(if(sd.ukuran="S",jml,0)) as ukuranS,
                            sum(if(sd.ukuran="M",jml,0)) as ukuranM,
                            sum(if(sd.ukuran="L",jml,0)) as ukuranL,
                            sum(if(sd.ukuran="XL",jml,0)) as ukuranXL,
                            sum(if(sd.ukuran="XXL",jml,0)) as ukuranXXL,
                            sum(if(sd.ukuran="XXXL",jml,0)) as ukuranXXXL'))
                ->groupBy('sh.posisi_penerima');

        if($request->filBranch != "ALL"){
            $RekapDistribusi = $RekapDistribusi->where('branch_penerima',$request->filBranch);
        }

        if($request->filPenerima != "ALL"){
            $RekapDistribusi = $RekapDistribusi->where('nik_penerima',$request->filPenerima);
        }

        if($request->filUkuran != "ALL"){
            $RekapDistribusi = $RekapDistribusi->where('ukuran',$request->filUkuran);
        }

        $RekapDistribusi = $RekapDistribusi->get();

        return response()->json($RekapDistribusi);
    }

    public function getDataDistribusiSeragam(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('data_distribusi_seragams as sh')
                ->leftJoin('data_distribusi_seragam_details as sd','sh.id','=','sd.distribusi_id')
                ->select(DB::raw('sh.id, sh.tgl_distribusi, sh.nik_penerima, sh.nama_penerima, sh.departement, sh.posisi_penerima, sh.posisi_seragam, sh.branch_penerima, sh.foto_distribusi_seragam,
                            sd.ukuran,sd.jml'))
                // ->groupBy('sh.id', 'sh.tgl_terima', 'sh.nik_penerima', 'sh.nama_penerima', 'sh.departement', 'sh.posisi_penerima', 'sh.posisi_seragam', 'sh.branch_penerima', 'sh.foto_terima_seragam')
                ->orderBy('tgl_distribusi','DESC');
                // ->get();

        if($request->filBranch != "ALL"){
            $datas = $datas->where('sh.branch_penerima',$request->filBranch);
        }

        if($request->filPenerima != "ALL"){
            $datas = $datas->where('nik_penerima',$request->filPenerima);
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
                    <a href="javascript:void(0)" id="detail-distribusi" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-distribusi mb-0" >Detail</a>';
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

    public function showDetailDistribusiSeragam(Request $request)
    {
        $headDistribusi = DB::table('data_distribusi_seragams')
                ->where('id', $request->filDistribusiId)->first();

        $detDistribusi = DB::table('data_distribusi_seragams as sh')
                ->leftJoin('data_distribusi_seragam_details as sd','sh.id','=','sd.distribusi_id')
                ->select('sh.*','sd.id as det_id', 'sd.ukuran','sd.kondisi','sd.jml')
                ->where('sh.id', $request->filDistribusiId)
            ->get();

        return response()->json(['hDistribusi' => $headDistribusi, 'dDistribusi' => $detDistribusi]);
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
