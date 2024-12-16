<?php

namespace App\Http\Controllers;

use App\Models\DataJadwalIkr;
use App\Models\DataJadwalIkrEdit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
                ->select(DB::raw('*, monthname(DATE(CONCAT_WS("-", tahun, bulan, 1))) as bulanname'))
                ->orderBy('nama_karyawan')->get();

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->editColumn('nama_karyawan', function ($nm) {
                    return Str::title($nm->nama_karyawan);
                })
                ->addColumn('dtid', function ($rw) {
                    $rwid = $rw->id;
                    return $rwid;
                })                 
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-assign" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-assign mb-0" >Detail</a>';
                    // <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                    //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action','dtid'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }

    public function getRekapDataJadwalTeknisi(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('v_rekap_jadwal')
                ->where('posisiNew', 'LIKE', "%teknisi%")
                ->get();
                // ->orWhere('posisi','LIKE','%staff%')->get();

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

    public function getRekapDataJadwalStaff(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('v_rekap_jadwal')
                ->where('posisiNew', 'LIKE', "%staff%")
                ->get();
                // ->orWhere('posisi','LIKE','%staff%')->get();

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

    public function getRekapDataJadwalLeader(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('v_rekap_jadwal')
                ->where('posisiNew', 'LIKE', "%leader%")
                ->get();
                // ->orWhere('posisi','LIKE','%staff%')->get();

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

    public function getRekapDataJadwalSpv(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('v_rekap_jadwal')
                ->where('posisiNew', 'LIKE', "%Supervisor%")
                ->get();
                // ->orWhere('posisi','LIKE','%staff%')->get();

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
        $loginId = Auth::user()->id;
        $login = Auth::user()->name;
        
        $dateRange = explode("-", $request->tglProgress);
        $thn = $dateRange[0];
        $bln = $dateRange[1];
        $day = "t".$dateRange[2];

        $dt = DataJadwalIkr::where('nik_karyawan',$request->nikKaryawan)
                    ->where('bulan',$bln)->where('tahun',$thn)->first();

        $dtEdit = DataJadwalIkrEdit::where('jadwal_id',$dt->id)->where('tgl_jadwal', $request->tglProgress)->first();
        if($dtEdit) {
            $oldFoto = $dtEdit->foto_lampiran;
        } else {
            $oldFoto = "Baru";
        }

        if ($request->hasFile('fotoPengajuanGD')) {
            $fileFoto = $request->file('fotoPengajuanGD');
            $file = $fileFoto->hashName();
            // $request->file('fotoPengajuanGD')->move(public_path('storage/image-jadwal'), $file);
        } else {
            $file = 'default-150x150.png';
        }

        DB::beginTransaction();
        try {

            if (is_null($dt)) {
                return redirect()->route('jadwalTim')->with(['error' => 'Gagal Simpan Data. Karyawan tidak ada data karyawan']);
            } else {
                $dt->$day = $request->statusKehadiran;
                $updateDt = $dt->update();
            }

            if ($updateDt){
                if (is_null($dtEdit)) {
                    $saveEdit = DataJadwalIkrEdit::create([
                        'jadwal_id' => $dt->id,
                        'branch_id' => $dt->branch_id,
                        'branch' => $dt->branch,
                        'nik_karyawan' => $dt->nik_karyawan,
                        'nama_karyawan' => $dt->nama_karyawan,
                        'bulan' => $dt->bulan,
                        'tahun' => $dt->tahun,
                        'tgl_jadwal' => $request->tglProgress,
                        'jadwal_before' => $request->jadwalKaryawan,
                        'status_jadwal' => $request->statusKehadiran,
                        'keterangan' => $request->remarks,
                        'foto_lampiran' => $file,
                        'login_id' => $loginId,
                        'login' => $login,
                    ]);

                    if($saveEdit){
                        if ($file != 'default-150x150.png') {
                            $request->file('fotoPengajuanGD')->move(public_path('storage/image-jadwal'), $file);
                        }
                    }
                    
                } else {
                    $dtEdit->update([
                        'status_jadwal' => $request->statusKehadiran,
                        'keterangan' => $request->remarks,
                        'foto_lampiran' => $file,
                        'login_id' => $loginId,
                        'login' => $login,
                    ]);

                    if($dtEdit){
                        if ($file != 'default-150x150.png') {
                            if($oldFoto != "Baru"){
                                File::delete(public_path('storage/image-jadwal/' . $oldFoto));
                            }
                            
                            $request->file('fotoPengajuanGD')->move(public_path('storage/image-jadwal'), $file);
                        }
                    }
                }

                DB::commit();
                return redirect()->route('jadwalTim')->with(['success' => 'Data tersimpan.']);
            } else {
                return redirect()->route('jadwalTim')->with(['error' => 'Gagal Simpan Data.']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('jadwalTim')->with(['error' => 'Gagal Simpan Data.' . $e->getMessage()]);
        }
               

    }

    public function getDetailStatus(Request $request)
    {
        $day = $request->tglClick;
        $detail = explode("|",$request->detail);
        
        $jwId = explode("-", $detail[0]);
        $jadwalId = $jwId[1];
        $status = $detail[1];
        $branch = $detail[2];
        $nik = $detail[3];
        $bulan = $detail[4];
        $tahun = $detail[5];

        $tglStatus = implode("-",[$tahun, $bulan, $day]);

        $data = DataJadwalIkrEdit::where('jadwal_id', $jadwalId)->where('tgl_jadwal', $tglStatus)
                                    ->where('status_jadwal', $status)->first();

        return response()->json($data);

    }

}
