<?php

namespace App\Http\Controllers;

use App\Models\DataJadwalIkr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class JadwalTim_controller extends Controller
{

    public function index()
    {
        $akses = Auth::user()->name;

        $branches = DB::table('branches')->select('id','nama_branch')->whereNotIn('nama_branch',['Apartemen', 'Underground'])->get();


        return view('absensi.ikr_schedule', ['akses' => $akses, 'branches' => $branches]);
    }

    public function getKaryawan(Request $request)
    {
        $filBranch = explode("|",$request->branch);
        $branchId = $filBranch[0];
        $branch = $filBranch[1];

        $dateRange = explode("-", $request->tgl);
        $thn = $dateRange[0];
        $bln = $dateRange[1];
        $day = $dateRange[2];

        $dt = DB::table('data_jadwal_ikrs')
                ->where('branch', $branch)
                ->where('bulan',$bln)
                ->where('tahun',$thn)
                ->orderBy('nama_karyawan')->get();
            // ->select('id','nik_karyawan','nama_karyawan','t'.$day)->get();

        return response()->json($dt);
    }

    public function getdataJadwalIkr(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('data_jadwal_ikrs')
                ->select(DB::raw('*, monthname(DATE(CONCAT_WS("-", tahun, bulan, 1))) as bulanname'))->get();

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->editColumn('nama_karyawan', function ($nm) {
                    return Str::title($nm->nama_karyawan);
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

    public function getRekapDataJadwal(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('v_rekap_jadwal_ikr')->get();

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                // ->editColumn('nama_karyawan', function ($nm) {
                //     return Str::title($nm->nama_karyawan);
                // })
                
                // ->addColumn('action', function ($row) {
                //     $btn = '
                //     <a href="javascript:void(0)" id="detail-assign" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-assign mb-0" >Detail</a>';
                //     // <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                //     //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                //     return $btn;
                // })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }

    public function simpanEditkehadiran(Request $request)
    {
        
        $dateRange = explode("-", $request->tglProgress);
        $thn = $dateRange[0];
        $bln = $dateRange[1];
        $day = "t".$dateRange[2];

        $dt = DataJadwalIkr::where('nik_karyawan',$request->nikKaryawan)
                    ->where('bulan',$bln)->where('tahun',$thn)->first();
        
        
        if (is_null($dt)) {
            return redirect()->route('jadwalTim')->with(['error' => 'Gagal Simpan Data. Karyawan tidak ada data karyawan']);
        } else {
            $dt->$day = $request->statusKehadiran;
            $updateDt = $dt->update();
        }

        if ($updateDt){
            return redirect()->route('jadwalTim')->with(['success' => 'Data tersimpan.']);
        } else {
            return redirect()->route('jadwalTim')->with(['error' => 'Gagal Simpan Data.']);
        }

    }
}
