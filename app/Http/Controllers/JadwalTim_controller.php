<?php

namespace App\Http\Controllers;

use App\Models\DataJadwalIkr;
use App\Models\DataJadwalIkrEdit;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class JadwalTim_controller extends Controller
{

    public function index()
    {
        $akses = Auth::user()->name;

        $branches = DB::table('branches')->select('id','nama_branch')->whereNotIn('nama_branch',['Apartemen', 'Underground'])->get();
        $kry = DB::table('employees as e')
            ->where('status_active','=','Aktif')
            ->leftJoin('branches as b','e.branch_id','=','b.id')
            ->select('e.nik_karyawan', 'e.nama_karyawan', 'b.nama_branch')->orderBy('e.nama_karyawan')->get();

        $tahun = DB::table('data_jadwal_ikrs')->select('tahun')->distinct()->orderBy('tahun','DESC')->get();
        $bln = DB::table('data_jadwal_ikrs')
                ->select('tahun','bulan', DB::raw('monthname(DATE(CONCAT_WS("-", tahun, bulan, 1))) as bulanname'))
                ->distinct()->orderBy('bulan')->get();

        return view('absensi.ikr_schedule', 
                ['akses' => $akses, 'branches' => $branches, 'kry' => $kry,
                'tahun' => $tahun, 'bulan' => $bln]);
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
        // dd($request->all());
        // dd($request->filStDate, $request->filEndDate);        
        

        $area = explode("|",$request->filarea);
        $areaId = $area[0];
        $areaNm = $area[1];

        $kry = explode("|", $request->filNama);
        $kryId = $kry[0];
        $kryNm = $kry[1];

        $akses = Auth::user()->name;

        $datas = DB::table('data_jadwal_ikrs as d')
                ->leftJoin('employees as e', 'd.nik_karyawan','=','e.nik_karyawan')
                ->where('d.tahun', $request->filTahun)
                ->where('d.bulan', $request->filBulan)
                ->select(DB::raw('d.*, e.departement, monthname(DATE(CONCAT_WS("-", d.tahun, d.bulan, 1))) as bulanname'))
                ->orderBy('d.branch_id')
                ->orderBy('d.nama_karyawan'); //->get();

        if ($areaNm != "All") {
            $datas = $datas->where('branch', $areaNm);
        }
        if ($kryId != "All") {
            $datas = $datas->where('nik_karyawan', $kryId);
        }
        if ($request->filStatusHadir != "All") {
            $datas = $datas->where(DB::raw('concat_ws("_",t01,t02,t03,t04,t05,t06,t07,t08,t09,t10,t11,t12,t13,t14,t15,t16,t17,t18,t19,t20,t21,t22,t23,t24,t25,t26,t27,t28,t29,t30,t31)'), 'like', '%'.$request->filStatusHadir.'%');
        }

        $datas = $datas->get();
        
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

        $area = explode("|",$request->filarea);
        $areaId = $area[0];
        $areaNm = $area[1];

        $kry = explode("|", $request->filNama);
        $kryId = $kry[0];
        $kryNm = $kry[1];

        $akses = Auth::user()->name;

        if($kryId != "All") {
            $datas = DB::table('v_rekap_jadwal_karyawan')
                ->where('tahun', $request->filTahun)
                ->where('bulan', $request->filBulan)
                ->where('posisiNew', 'LIKE', "%teknisi%")
                ->where('nik_karyawan',$kryId)
                ->orderBy('branch_id')
                ->orderBy('nama_karyawan')
                ->orderBy(DB::raw('case when status="ON" then 1
                            when status="OD" then 2
                            when status="OFF" then 3
                            when status="Cuti" then 4
                            when status="Sakit" then 5
                            when status="Absen" then 6 end'));
                // ->get();
        } else {
            $datas = DB::table('v_rekap_jadwal')
                ->where('tahun', $request->filTahun)
                ->where('bulan', $request->filBulan)
                ->where('posisiNew', 'LIKE', "%teknisi%")
                ->orderBy('branch_id')
                ->orderBy('departement')
                ->orderBy(DB::raw('case when status="ON" then 1
                            when status="OD" then 2
                            when status="OFF" then 3
                            when status="Cuti" then 4
                            when status="Sakit" then 5
                            when status="Absen" then 6 end'));
                // ->get();
                // ->orWhere('posisi','LIKE','%staff%')->get();
        }

        if ($areaNm != "All") {
            $datas = $datas->where('branch', $areaNm);
        }

        $datas = $datas->get();        

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                // ->editColumn('nama_karyawan', function ($nm) {
                //     return Str::title($nm->nama_karyawan);
                // })
                ->addColumn('dtid', function ($rw) {
                    $rwid = 'Teknisi|' . $rw->tahun .'|'. $rw->bulan .'|'. $rw->branch .'|'. $rw->status;
                    return $rwid;
                }) 
                
                // ->addColumn('action', function ($row) {
                //     $btn = '
                //     <a href="javascript:void(0)" id="detail-assign" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-assign mb-0" >Detail</a>';
                //     // <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                //     //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                //     return $btn;
                // })
                ->rawColumns(['dtid'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }

    public function getRekapDataJadwalStaff(Request $request)
    {
        $area = explode("|",$request->filarea);
        $areaId = $area[0];
        $areaNm = $area[1];

        $kry = explode("|", $request->filNama);
        $kryId = $kry[0];
        $kryNm = $kry[1];

        $akses = Auth::user()->name;

        if($kryId != "All") {
            $datas = DB::table('v_rekap_jadwal_karyawan')
                ->where('tahun', $request->filTahun)
                ->where('bulan', $request->filBulan)
                ->where('posisiNew', 'LIKE', "%staff%")
                ->where('nik_karyawan',$kryId)
                ->orderBy('branch_id')
                ->orderBy('nama_karyawan')
                ->orderBy(DB::raw('case when status="ON" then 1
                            when status="OD" then 2
                            when status="OFF" then 3
                            when status="Cuti" then 4
                            when status="Sakit" then 5
                            when status="Absen" then 6 end'));
                // ->get();
        } else {
            $datas = DB::table('v_rekap_jadwal')
                ->where('tahun', $request->filTahun)
                ->where('bulan', $request->filBulan)
                ->where('posisiNew', 'LIKE', "%staff%")
                ->orderBy('branch_id')
                ->orderBy('departement')
                ->orderBy(DB::raw('case when status="ON" then 1
                            when status="OD" then 2
                            when status="OFF" then 3
                            when status="Cuti" then 4
                            when status="Sakit" then 5
                            when status="Absen" then 6 end'));
                // ->get();
                // ->orWhere('posisi','LIKE','%staff%')->get();
        }

        if ($areaNm != "All") {
            $datas = $datas->where('branch', $areaNm);
        }

        $datas = $datas->get();
        

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                // ->editColumn('nama_karyawan', function ($nm) {
                //     return Str::title($nm->nama_karyawan);
                // })
                ->addColumn('dtid', function ($rw) {
                    $rwid = 'Staff|' . $rw->tahun .'|'. $rw->bulan .'|'. $rw->branch .'|'. $rw->status;
                    return $rwid;
                }) 
                
                // ->addColumn('action', function ($row) {
                //     $btn = '
                //     <a href="javascript:void(0)" id="detail-assign" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-assign mb-0" >Detail</a>';
                //     // <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                //     //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                //     return $btn;
                // })
                ->rawColumns(['dtid'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }

    public function getRekapDataJadwalLeader(Request $request)
    {
        $area = explode("|",$request->filarea);
        $areaId = $area[0];
        $areaNm = $area[1];

        $kry = explode("|", $request->filNama);
        $kryId = $kry[0];
        $kryNm = $kry[1];

        $akses = Auth::user()->name;

        if($kryId != "All") {
            $datas = DB::table('v_rekap_jadwal_karyawan')
                ->where('tahun', $request->filTahun)
                ->where('bulan', $request->filBulan)
                ->where('posisiNew', 'LIKE', "%leader%")
                ->where('nik_karyawan',$kryId)
                ->orderBy('branch_id')
                ->orderBy('nama_karyawan')
                ->orderBy(DB::raw('case when status="ON" then 1
                            when status="OD" then 2
                            when status="OFF" then 3
                            when status="Cuti" then 4
                            when status="Sakit" then 5
                            when status="Absen" then 6 end'));
                // ->get();
        } else {
            $datas = DB::table('v_rekap_jadwal')
                ->where('tahun', $request->filTahun)
                ->where('bulan', $request->filBulan)
                ->where('posisiNew', 'LIKE', "%leader%")
                ->orderBy('branch_id')
                ->orderBy('departement')
                ->orderBy(DB::raw('case when status="ON" then 1
                            when status="OD" then 2
                            when status="OFF" then 3
                            when status="Cuti" then 4
                            when status="Sakit" then 5
                            when status="Absen" then 6 end'));
                // ->get();
                // ->orWhere('posisi','LIKE','%staff%')->get();
        }

        if ($areaNm != "All") {
            $datas = $datas->where('branch', $areaNm);
        }

        $datas = $datas->get();
        

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                // ->editColumn('nama_karyawan', function ($nm) {
                //     return Str::title($nm->nama_karyawan);
                // })
                ->addColumn('dtid', function ($rw) {
                    $rwid = 'Leader|' . $rw->tahun .'|'. $rw->bulan .'|'. $rw->branch .'|'. $rw->status;
                    return $rwid;
                }) 
                
                // ->addColumn('action', function ($row) {
                //     $btn = '
                //     <a href="javascript:void(0)" id="detail-assign" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-assign mb-0" >Detail</a>';
                //     // <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                //     //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                //     return $btn;
                // })
                ->rawColumns(['dtid'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }

    public function getRekapDataJadwalSpv(Request $request)
    {
        $area = explode("|",$request->filarea);
        $areaId = $area[0];
        $areaNm = $area[1];

        $kry = explode("|", $request->filNama);
        $kryId = $kry[0];
        $kryNm = $kry[1];

        $akses = Auth::user()->name;

        if($kryId != "All") {
            $datas = DB::table('v_rekap_jadwal_karyawan')
                ->where('tahun', $request->filTahun)
                ->where('bulan', $request->filBulan)
                ->where('posisiNew', 'LIKE', "%Supervisor%")
                ->where('nik_karyawan',$kryId)
                ->orderBy('branch_id')
                ->orderBy('nama_karyawan')
                ->orderBy(DB::raw('case when status="ON" then 1
                            when status="OD" then 2
                            when status="OFF" then 3
                            when status="Cuti" then 4
                            when status="Sakit" then 5
                            when status="Absen" then 6 end'));
                // ->get();
        } else {
            $datas = DB::table('v_rekap_jadwal')
                ->where('tahun', $request->filTahun)
                ->where('bulan', $request->filBulan)
                ->where('posisiNew', 'LIKE', "%Supervisor%")
                ->orderBy('branch_id')
                ->orderBy('departement')
                ->orderBy(DB::raw('case when status="ON" then 1
                            when status="OD" then 2
                            when status="OFF" then 3
                            when status="Cuti" then 4
                            when status="Sakit" then 5
                            when status="Absen" then 6 end'));
                // ->get();
                // ->orWhere('posisi','LIKE','%staff%')->get();
        }

        if ($areaNm != "All") {
            $datas = $datas->where('branch', $areaNm);
        }

        $datas = $datas->get();
        

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                // ->editColumn('nama_karyawan', function ($nm) {
                //     return Str::title($nm->nama_karyawan);
                // })
                ->addColumn('dtid', function ($rw) {
                    $rwid = 'Supervisor|' . $rw->tahun .'|'. $rw->bulan .'|'. $rw->branch .'|'. $rw->status;
                    return $rwid;
                }) 
                
                // ->addColumn('action', function ($row) {
                //     $btn = '
                //     <a href="javascript:void(0)" id="detail-assign" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-assign mb-0" >Detail</a>';
                //     // <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                //     //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                //     return $btn;
                // })
                ->rawColumns(['dtid'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }

    public function simpanEditkehadiran(Request $request)
    {
        $loginId = Auth::user()->id;
        $login = Auth::user()->name;
        
        $brnch = explode("|", $request->branch);
        $branchid = $brnch[0];
        $branch = $brnch[1];

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
                return redirect()->route('jadwalTim')->with(['error' => 'Gagal Simpan Data. Karyawan tidak ada di data karyawan']);
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

                $dtAssign = DB::table('v_rekap_assign')
                        ->where('tgl_ikr', $request->tglProgress)->where('tek_nik', $request->nikKaryawan)
                        ->select('callsign', 'posisi_nik','posisi_tek')
                        ->first();
                // dd(is_null($dtAssign));
                
                if(!is_null($dtAssign) && ($request->statusKehadiran == "OFF" || $request->statusKehadiran == "Cuti" || $request->statusKehadiran == "Sakit" || $request->statusKehadiran == "Absen"))
                {
                    $pos_nik = $dtAssign->posisi_nik;
                    $pos_tek = $dtAssign->posisi_tek;

                    $dtAssignTim = DB::table('data_assign_tims')
                            ->where('tgl_ikr', $request->tglProgress)
                            ->where('branch', $dt->branch)
                            ->where('callsign', $dtAssign->callsign)
                            ->update([
                                $pos_nik => null,
                                $pos_tek => null,
                            ]);                
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

        $data = DataJadwalIkrEdit::where('nik_karyawan', $nik)->where('tgl_jadwal', $tglStatus)
                                    ->where('status_jadwal', $status)->first();

        return response()->json($data);

    }

    public function getDetailRekapStatus(Request $request)
    {
        // dd($request->all());
        
        $detail = explode("|", $request->detail);
        $tbl = $detail[0];
        $thn = $detail[1];
        $bln = $detail[2];
        $day = "t".$request->tglClick;
        $branch = $detail[3];
        $status = $detail[4];
        $kryId = $detail[5];
        $kryNm = $detail[6];
        $dept=$detail[8];

        if ($request->tglClick != "total") {
            $tglStat = implode("-",[$thn, $bln, $request->tglClick]);
            $tglStatus = \Carbon\Carbon::parse($tglStat)->format('Y-m-d');
        }       


        if($day == "ttotal"){
            $datas= DB::table('v_rekap_jadwal_data as vd')
                    ->leftJoin('employees as e', 'vd.nik_karyawan','=','e.nik_karyawan')                    
                    ->where('vd.branch', $branch)->where('vd.tahun', $thn)->where('vd.bulan', $bln)
                    ->where('e.status_active', 'Aktif')
                    ->where('vd.status', $status)
                    ->where('e.posisi', 'like','%'. $tbl.'%')
                    ->where('vd.departement','=', $dept)
                    ->select(DB::raw('vd.branch_id, vd.branch, vd.nik_karyawan, vd.nama_karyawan, e.posisi, tgl, status, vd.keterangan'))
                    ->orderBy('vd.tgl')
                    ->orderBy('vd.nama_karyawan')
                    ->orderBy('vd.branch_id')
                    ->orderBy('vd.departement')
                    ->get();

            
        } else {
            $datas= DB::table('v_rekap_jadwal_data as vd')
                    ->leftJoin('employees as e', 'vd.nik_karyawan','=','e.nik_karyawan')                    
                    ->where('vd.branch', $branch)->where('vd.tahun', $thn)->where('vd.bulan', $bln)
                    ->where('e.status_active', 'Aktif')
                    ->where('vd.status', $status)
                    ->where('vd.tgl', $tglStatus)
                    ->where('e.posisi', 'like','%'. $tbl.'%')
                    ->where('vd.departement','=', $dept)
                    ->select(DB::raw('vd.branch_id, vd.branch, vd.nik_karyawan, vd.nama_karyawan, e.posisi, tgl, status, vd.keterangan'))
                    ->orderBy('vd.tgl')
                    ->orderBy('vd.nama_karyawan')
                    ->orderBy('vd.branch_id')
                    ->orderBy('vd.departement')
                    ->get();
        }
        

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

}
