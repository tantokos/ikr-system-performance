<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\DataAbsence;

use function PHPUnit\Framework\isNull;

class Leader_PerformController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $akses = Auth::user()->name;

        $trendMonthly = DataAbsence::select(DB::raw('date_format(tanggal, "%b-%Y") as bulan'))->distinct()->get();
        
        $branchList = DB::table('branches as b')->Join('struktur_ikr as d', 'b.nama_branch', '=', 'd.area')
            ->select('b.id', 'd.area as nama_branch')
            ->distinct()
            ->orderBy('b.id')
            ->get();

        // $namaKaryawan = DataAbsence::select('nama_karyawan')->distinct()->get();

        return view('perform.leader-performance',
            [
                'akses' => $akses, 'bulanTahun' => $trendMonthly, 'areaList' => $branchList //, 'nama_karyawan' => $namaKaryawan
            ]);
    }

    public function getNamaLeader(Request $request)
    {

        $akses= Auth::user()->name;

        $namaLeader = DB::table('struktur_ikr')->select('nama_karyawan')
                    ->where('posisi','like','Leader%')
                    ->whereIn('departement', ['FTTH', 'FTTX/FTTB']);

        if ($request->area != "All") {
            $namaLeader = $namaLeader->where('area','=', $request->area);
        }

        $namaLeader = $namaLeader->distinct()->orderBy('nama_karyawan')->get();

        return response()->json($namaLeader);

    }

    public function getAbsensiMonthly(Request $request)
    {
        $akses= Auth::user()->name;
        $tblAbs = [];
        $listLeader = [];
        $nama = [];
        $bulan = \Carbon\Carbon::parse($request->bulanTahun)->month;
        $tahun = \Carbon\Carbon::parse($request->bulanTahun)->year; 
        $area = $request->area;
        // $nama = $request->nama;

        $startDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
        $endDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();

        $dayMonth = \Carbon\CarbonPeriod::between($startDate, $endDate);

        $namaLeader = DB::table('struktur_ikr')->select('nama_karyawan')
                    ->where('posisi','like','Leader%')
                    ->whereIn('departement', ['FTTH', 'FTTX/FTTB']);

        if($request->area != "All") {
            $namaLeader = $namaLeader->where('area','=', $request->area);
        }
        if($request->nama != "All"){
            $namaLeader = $namaLeader->where('nama_karyawan','=', $request->nama);
        }

        $namaLeader = $namaLeader->distinct()->orderBy('nama_karyawan')->get();

        $listLeader=$namaLeader->pluck('nama_karyawan');

        $absMonthly = DB::table('v_absensi_tot')
                        ->select('id','status_masuk_keluar')
                        ->whereIn('nama_karyawan', $listLeader);


        for ($bt = 1; $bt <= $bulan; $bt++) {
            $trendBulanan[] = ['bulan' => \Carbon\Carbon::create($tahun, $bt)->format('M-Y')];
        }

        for($b=0; $b < count($trendBulanan); $b++) {

            $Qbln = \Carbon\Carbon::parse($trendBulanan[$b]['bulan'])->month;

            $blnThn = str_replace('-','_',$trendBulanan[$b]['bulan']);

            $absMonthly = $absMonthly->addSelect(DB::raw('ifnull(sum(case when bulan="'.$Qbln.'" and tahun="'.$tahun.'" then 1 end),0) as '.$blnThn.' '));
        }

        $absMonthly = $absMonthly->groupBy('id','status_masuk_keluar')
                                ->orderBy('id')
                                ->get();


        for($dp=0; $dp<$absMonthly->count(); $dp++){
            $tblAbs[$dp] = ['status_absen' => $absMonthly[$dp]->status_masuk_keluar];

            for ($t=0; $t < count($trendBulanan); $t++){

                $days = str_replace('-','_', $trendBulanan[$t]['bulan']);

                $tblAbs[$dp]['bulanan'][$t] = (int)$absMonthly[$dp]->$days;
            }
        }

        return response()->json(['monthly' => $trendBulanan, 'absensi' => $tblAbs]);

    }

    public function getAbsensi(Request $request)
    {
        $akses= Auth::user()->name;
        $tblAbs = [];
        $listLeader = [];
        $nama = [];
        $bulan = \Carbon\Carbon::parse($request->bulanTahun)->month;
        $tahun = \Carbon\Carbon::parse($request->bulanTahun)->year; 
        $area = $request->area;
        // $nama = $request->nama;

        $startDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
        $endDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();

        $dayMonth = \Carbon\CarbonPeriod::between($startDate, $endDate);

        $namaLeader = DB::table('struktur_ikr')->select('nama_karyawan')
                    ->where('posisi','like','Leader%')
                    ->whereIn('departement', ['FTTH', 'FTTX/FTTB']);

        if($request->area != "All") {
            $namaLeader = $namaLeader->where('area','=', $request->area);
        }
        if($request->nama != "All"){
            $namaLeader = $namaLeader->where('nama_karyawan','=', $request->nama);
        }

        $namaLeader = $namaLeader->distinct()->orderBy('nama_karyawan')->get();

        $listLeader=$namaLeader->pluck('nama_karyawan');



        $dbAbsen = DB::table('data_absences as d')
                    ->join('status_kehadiran as sk', 'd.status_masuk_keluar', '=', 'sk.status_absen')
                    ->select('d.status_masuk_keluar') //select('d.nama_karyawan', 'd.status_masuk_keluar')
                    ->whereMonth('d.tanggal', $bulan)
                    ->whereYear('d.tanggal', $tahun)
                    ->where('d.area', $area)
                    ->whereIn('d.nama_karyawan', $listLeader); //->pluck('nama_karyawan'));

        // if($nama!="All"){
            // $dbAbsen = $dbAbsen->where('d.nama_karyawan','=', $nama);
        // }

        foreach ($dayMonth as $date) {
            $tgl[] = ['tanggal' => $date->format('Y-m-d')]; 
            
            $dbAbsen = $dbAbsen->addSelect(DB::raw('ifnull(sum(if(d.tanggal="'.$date.'",1,0)),0) as "'.$date->format('Y_m_d').'"'));
        }

        $dbAbsen = $dbAbsen->groupBy('sk.id','d.status_masuk_keluar')
                            ->orderBy('sk.id')
                            ->get();

        

        for($dp=0; $dp<$dbAbsen->count(); $dp++){
            $tblAbs[$dp] = ['status_absen' => $dbAbsen[$dp]->status_masuk_keluar];

            for ($t=0; $t < count($tgl); $t++){

                $days = str_replace('-','_', $tgl[$t]['tanggal']);

                $tblAbs[$dp]['day'][$t] = (int)$dbAbsen[$dp]->$days;
            }
        }

        return response()->json(['tgl' => $tgl, 'absensi' => $tblAbs]);

    }

    public function getAbsensiTim(Request $request)
    {
        $akses= Auth::user()->name;
        $tblAbs = [];
        $bulan = \Carbon\Carbon::parse($request->bulanTahun)->month;
        $tahun = \Carbon\Carbon::parse($request->bulanTahun)->year; 
        $area = $request->area;
        $namaLeader = $request->nama;

        $startDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
        $endDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();

        $dayMonth = \Carbon\CarbonPeriod::between($startDate, $endDate);


        $namaLeader = DB::table('struktur_ikr')->select('nama_karyawan')
                ->where('posisi','like','Leader%')
                ->whereIn('departement', ['FTTH', 'FTTX/FTTB']);

        if($request->area != "All") {
            $namaLeader = $namaLeader->where('area','=', $request->area);
        }
        if($request->nama != "All"){
            $namaLeader = $namaLeader->where('nama_karyawan','=', $request->nama);
        }

        $namaLeader = $namaLeader->distinct()->orderBy('nama_karyawan')->get();
        $listLeader=$namaLeader->pluck('nama_karyawan');

        
        $dbTim = DB::table('struktur_ikr')->select('nama_karyawan')->distinct()
                    ->where('area','=',$area)
                    ->whereIn('atasan_langsung',$listLeader)                   
                    ->get();


        $dbAbsen = DB::table('data_absences as d')
                    ->join('status_kehadiran as sk', 'd.status_masuk_keluar', '=', 'sk.status_absen')
                    ->select('d.status_masuk_keluar')
                    ->whereMonth('d.tanggal', $bulan)
                    ->whereYear('d.tanggal', $tahun)
                    ->whereIn('d.nama_karyawan', $dbTim->pluck('nama_karyawan'));
        
       

        foreach ($dayMonth as $date) {
            $tgl[] = ['tanggal' => $date->format('Y-m-d')]; 
            
            $dbAbsen = $dbAbsen->addSelect(DB::raw('ifnull(sum(if(d.tanggal="'.$date.'",1,0)),0) as "'.$date->format('Y_m_d').'"'));
        }

        $dbAbsen = $dbAbsen->groupBy('sk.id','d.status_masuk_keluar')
                            ->orderBy('sk.id')
                            ->get();


        for($dp=0; $dp<$dbAbsen->count(); $dp++){
            $tblAbs[$dp] = ['status_absen' => $dbAbsen[$dp]->status_masuk_keluar];

            for ($t=0; $t < count($tgl); $t++){

                $days = str_replace('-','_', $tgl[$t]['tanggal']);

                $tblAbs[$dp]['day'][$t] = (int)$dbAbsen[$dp]->$days;
            }
        }

        return response()->json(['tgl' => $tgl, 'absensi' => $tblAbs]);

    }

    public function getTotalWO(request $request)
    {
        $akses= Auth::user()->name;
        $tblProgressWO = [];
        $status=['Done','Pending','Cancel'];
        $bulan = \Carbon\Carbon::parse($request->bulanTahun)->month;
        $tahun = \Carbon\Carbon::parse($request->bulanTahun)->year; 
        $area = $request->area;
        $namaLeader = $request->nama;

        $startDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
        $endDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();

        $dayMonth = \Carbon\CarbonPeriod::between($startDate, $endDate);

        foreach ($dayMonth as $date) 
        {
            $tgl[] = ['tanggal' => $date->format('Y-m-d')]; 
        }
        

        $dtTypeWo = DB::table('v_total_wo')
                    ->select('type_wo')->distinct()
                    // ->where('atasan_langsung','=',$namaLeader)
                    ->whereMonth('tgl_ikr',$bulan)
                    ->whereYear('tgl_ikr', $tahun)
                    ->where('branch','=',$area)
                    ->groupBy('type_wo')
                    ->get();


        for($tp=0; $tp < count($dtTypeWo); $tp++){

            $dtIB = DB::table('v_total_wo')
                    ->select('type_wo')
                    // ->where('tgl_ikr','=', $tgl[$tg]['tanggal'])
                    // ->where('type_wo','=', $dtTypeWo[$t]->type_wo)
                    // ->where('atasan_langsung','=',$namaLeader)
                    ->where('type_wo','=', $dtTypeWo[$tp]->type_wo)
                    ->whereMonth('tgl_ikr',$bulan)
                    ->whereYear('tgl_ikr', $tahun)
                    ->where('branch','=',$area)
                    ->groupBy('type_wo');

            for($hr=0; $hr<count($tgl); $hr++){

                $hari = str_replace("-","_",$tgl[$hr]['tanggal']);

                $dtIB = $dtIB->addSelect(
                    DB::raw("ifnull(count(case when tgl_ikr='".$tgl[$hr]['tanggal']."' then branch end),0) as tot_".$hari.""));
            }

            $dtIB=$dtIB->get();


            $tblProgressWO[$tp] = ['type' => $dtTypeWo[$tp]->type_wo];

            for ($dt=0; $dt < count($dtIB); $dt++){

                for($tg=0; $tg < count($tgl); $tg++){

                    $h = str_replace("-", "_", $tgl[$tg]['tanggal']);
                    $qhd = "tot_".$h;
                    $qhp = "pending_".$h;
                    $qhc = "cancel_".$h;

                    $tblProgressWO[$tp]['harian'][] = (int)$dtIB[$dt]->$qhd;
                }
            }

        }

        return response()->json(['tgl' => $tgl, 'dataWO' => $tblProgressWO]);
    }


    public function getRemarkWO(request $request)
    {
        $akses= Auth::user()->name;
        $tblProgressWO = [];
        $status=['Done','Pending','Cancel'];
        $bulan = \Carbon\Carbon::parse($request->bulanTahun)->month;
        $tahun = \Carbon\Carbon::parse($request->bulanTahun)->year; 
        $area = $request->area;
        $namaLeader = $request->nama;

        $startDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
        $endDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();

        $dayMonth = \Carbon\CarbonPeriod::between($startDate, $endDate);

        foreach ($dayMonth as $date) 
        {
            $tgl[] = ['tanggal' => $date->format('Y-m-d')]; 
        }
        

        $namaLeader = DB::table('struktur_ikr')->select('nama_karyawan')
                ->where('posisi','like','Leader%')
                ->whereIn('departement', ['FTTH', 'FTTX/FTTB']);

        if($request->area != "All") {
            $namaLeader = $namaLeader->where('area','=', $request->area);
        }
        if($request->nama != "All"){
            $namaLeader = $namaLeader->where('nama_karyawan','=', $request->nama);
        }

        $namaLeader = $namaLeader->distinct()->orderBy('nama_karyawan')->get();
        $listLeader=$namaLeader->pluck('nama_karyawan');

        $dtRemarkWo = DB::table('v_progres_wo_data')
                    ->select('remark_traffic')->distinct()
                    ->where('status_wo','=','Done')
                    ->whereMonth('tgl_ikr',$bulan)
                    ->whereYear('tgl_ikr', $tahun)
                    ->where('branch','=',$area)
                    ->whereIn('remark_traffic', ['Tag Alarm Traffic - Wajib Ganti Precon', 'Tag Alarm MTI - Wajib Ganti Precon'])
                    ->whereIn('atasan_langsung',$listLeader)
                    ->groupBy('remark_traffic');
                    

        // if($namaLeader!="ALL"){
        //     $dtRemarkWo =  $dtRemarkWo->where('atasan_langsung','=',$namaLeader);
        // }

        $dtRemarkWo =  $dtRemarkWo->get();
        
        
        for($tp=0; $tp < count($dtRemarkWo); $tp++){

            $dtIB = DB::table('v_progres_wo_data')
                    ->select('remark_traffic')
                    // ->where('tgl_ikr','=', $tgl[$tg]['tanggal'])
                    // ->where('type_wo','=', $dtTypeWo[$t]->type_wo)
                    // ->where('atasan_langsung','=',$namaLeader)
                    ->where('remark_traffic','=', $dtRemarkWo[$tp]->remark_traffic)
                    ->where('status_wo','=','Done')
                    ->whereMonth('tgl_ikr',$bulan)
                    ->whereYear('tgl_ikr', $tahun)
                    ->where('branch','=',$area)
                    ->whereIn('remark_traffic', ['Tag Alarm Traffic - Wajib Ganti Precon', 'Tag Alarm MTI - Wajib Ganti Precon'])
                    ->whereIn('atasan_langsung', $listLeader)
                    ->groupBy('remark_traffic');
            
            // if($namaLeader!="ALL"){
            //     $dtIB =  $dtIB->where('atasan_langsung','=',$namaLeader);
            // }

            for($hr=0; $hr<count($tgl); $hr++){

                $hari = str_replace("-","_",$tgl[$hr]['tanggal']);

                $dtIB = $dtIB->addSelect(
                    DB::raw("ifnull(count(case when tgl_ikr='".$tgl[$hr]['tanggal']."' then branch end),0) as tot_".$hari.""));
            }

            $dtIB=$dtIB->get();


            $tblProgressWO[$tp] = ['remark' => $dtRemarkWo[$tp]->remark_traffic];

            for ($dt=0; $dt < count($dtIB); $dt++){

                for($tg=0; $tg < count($tgl); $tg++){

                    $h = str_replace("-", "_", $tgl[$tg]['tanggal']);
                    $qhd = "tot_".$h;
                    $qhp = "pending_".$h;
                    $qhc = "cancel_".$h;

                    $tblProgressWO[$tp]['harian'][] = (int)$dtIB[$dt]->$qhd;
                }
            }

        }

        return response()->json(['tgl' => $tgl, 'dataRemarkWO' => $tblProgressWO]);
    }

    public function getPreconWO(request $request)
    {
        $akses= Auth::user()->name;
        $tblProgressWO = [];
        $status=['Done','Pending','Cancel'];
        $bulan = \Carbon\Carbon::parse($request->bulanTahun)->month;
        $tahun = \Carbon\Carbon::parse($request->bulanTahun)->year; 
        $area = $request->area;
        $namaLeader = $request->nama;

        $startDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
        $endDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();

        $dayMonth = \Carbon\CarbonPeriod::between($startDate, $endDate);

        foreach ($dayMonth as $date) 
        {
            $tgl[] = ['tanggal' => $date->format('Y-m-d')]; 
        }
        

        $namaLeader = DB::table('struktur_ikr')->select('nama_karyawan')
                ->where('posisi','like','Leader%')
                ->whereIn('departement', ['FTTH', 'FTTX/FTTB']);

        if($request->area != "All") {
            $namaLeader = $namaLeader->where('area','=', $request->area);
        }
        if($request->nama != "All"){
            $namaLeader = $namaLeader->where('nama_karyawan','=', $request->nama);
        }

        $namaLeader = $namaLeader->distinct()->orderBy('nama_karyawan')->get();
        $listLeader=$namaLeader->pluck('nama_karyawan');

        $dtPreconWo = DB::table('v_progres_wo_data')
                    ->select('penagihan')->distinct()
                    // ->where('atasan_langsung','=',$namaLeader)
                    ->where('status_wo','=','Done')
                    ->whereMonth('tgl_ikr',$bulan)
                    ->whereYear('tgl_ikr', $tahun)
                    ->where('branch','=',$area)
                    ->where(function ($q) {
                        $q->where('remark_traffic','Tag Alarm Traffic - Wajib Ganti Precon')
                            ->orWhere('remark_traffic','Tag Alarm MTI - Wajib Ganti Precon');
                    })  
                    ->where(function ($p) {
                        $p->where('penagihan','Migrasi DW To Precon')
                            ->orWhere('penagihan', 'Replace Precon To Precon');
                    })
                    ->whereIn('atasan_langsung', $listLeader)
                    ->groupBy('penagihan');
                    // ->get();

        // if($namaLeader!="ALL"){
        //     $dtPreconWo =  $dtPreconWo->where('atasan_langsung','=',$namaLeader);
        // }

        $dtPreconWo =  $dtPreconWo->get();


        for($tp=0; $tp < count($dtPreconWo); $tp++){

            $dtIB = DB::table('v_progres_wo_data')
                    ->select('penagihan')
                    // ->where('tgl_ikr','=', $tgl[$tg]['tanggal'])
                    // ->where('type_wo','=', $dtTypeWo[$t]->type_wo)
                    // ->where('atasan_langsung','=',$namaLeader)
                    ->where('penagihan','=', $dtPreconWo[$tp]->penagihan)
                    ->where('status_wo','=','Done')
                    ->whereMonth('tgl_ikr',$bulan)
                    ->whereYear('tgl_ikr', $tahun)
                    ->where('branch','=',$area)
                    ->whereIn('remark_traffic', ['Tag Alarm Traffic - Wajib Ganti Precon', 'Tag Alarm MTI - Wajib Ganti Precon'])
                    // ->whereIn('penagihan', ['Migrasi DW To Precon, Replace Precon To Precon'])
                    ->whereIn('atasan_langsung', $listLeader)
                    ->groupBy('penagihan');

            // if($namaLeader!="ALL"){
            //     $dtIB =  $dtIB->where('atasan_langsung','=',$namaLeader);
            // }

            for($hr=0; $hr<count($tgl); $hr++){

                $hari = str_replace("-","_",$tgl[$hr]['tanggal']);

                $dtIB = $dtIB->addSelect(
                    DB::raw("ifnull(count(case when tgl_ikr='".$tgl[$hr]['tanggal']."' then branch end),0) as tot_".$hari.""));
            }

            $dtIB=$dtIB->get();


            $tblProgressWO[$tp] = ['penagihan' => $dtPreconWo[$tp]->penagihan];

            for ($dt=0; $dt < count($dtIB); $dt++){

                for($tg=0; $tg < count($tgl); $tg++){

                    $h = str_replace("-", "_", $tgl[$tg]['tanggal']);
                    $qhd = "tot_".$h;
                    $qhp = "pending_".$h;
                    $qhc = "cancel_".$h;

                    $tblProgressWO[$tp]['harian'][] = (int)$dtIB[$dt]->$qhd;
                }
            }

        }

        return response()->json(['tgl' => $tgl, 'dataPreconWO' => $tblProgressWO]);
    }

    public function getStatusPrecon(request $request)
    {
        $akses= Auth::user()->name;
        $tblProgressWO = [];
        $status=['Done','Pending','Cancel'];
        $bulan = \Carbon\Carbon::parse($request->bulanTahun)->month;
        $tahun = \Carbon\Carbon::parse($request->bulanTahun)->year; 
        $area = $request->area;
        $namaLeader = $request->nama;

        $startDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
        $endDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();

        $dayMonth = \Carbon\CarbonPeriod::between($startDate, $endDate);

        foreach ($dayMonth as $date) 
        {
            $tgl[] = ['tanggal' => $date->format('Y-m-d')]; 
        }
        

        $namaLeader = DB::table('struktur_ikr')->select('nama_karyawan')
                ->where('posisi','like','Leader%')
                ->whereIn('departement', ['FTTH', 'FTTX/FTTB']);

        if($request->area != "All") {
            $namaLeader = $namaLeader->where('area','=', $request->area);
        }
        if($request->nama != "All"){
            $namaLeader = $namaLeader->where('nama_karyawan','=', $request->nama);
        }

        $namaLeader = $namaLeader->distinct()->orderBy('nama_karyawan')->get();
        $listLeader=$namaLeader->pluck('nama_karyawan');

        $dtPreconWo = DB::table('v_progres_wo_data')
                    ->select('remark_status')->distinct()
                    // ->where('atasan_langsung','=',$namaLeader)
                    ->where('status_wo','=','Done')
                    ->whereMonth('tgl_ikr',$bulan)
                    ->whereYear('tgl_ikr', $tahun)
                    ->where('branch','=',$area)
                    ->where(function ($q) {
                        $q->where('remark_traffic','Tag Alarm Traffic - Wajib Ganti Precon')
                            ->orWhere('remark_traffic','Tag Alarm MTI - Wajib Ganti Precon');
                    })  
                    ->whereNotIn('penagihan',['Migrasi DW To Precon','Replace Precon To Precon'])
                    ->whereIn('atasan_langsung', $listLeader)
                    ->groupBy('remark_status');
                    // ->get();

        // if($namaLeader!="ALL"){
        //     $dtPreconWo =  $dtPreconWo->where('atasan_langsung','=',$namaLeader);
        // }

        $dtPreconWo =  $dtPreconWo->get();


        for($tp=0; $tp < count($dtPreconWo); $tp++){

            $dtIB = DB::table('v_progres_wo_data')
                    ->select('remark_status')
                    // ->where('tgl_ikr','=', $tgl[$tg]['tanggal'])
                    // ->where('type_wo','=', $dtTypeWo[$t]->type_wo)
                    // ->where('atasan_langsung','=',$namaLeader)
                    ->where('remark_status','=', $dtPreconWo[$tp]->remark_status)
                    ->where('status_wo','=','Done')
                    ->whereMonth('tgl_ikr',$bulan)
                    ->whereYear('tgl_ikr', $tahun)
                    ->where('branch','=',$area)
                    ->where(function ($q) {
                        $q->where('remark_traffic','Tag Alarm Traffic - Wajib Ganti Precon')
                            ->orWhere('remark_traffic','Tag Alarm MTI - Wajib Ganti Precon');
                    })  
                    ->where('penagihan','<>','Migrasi DW To Precon')
                    ->where('penagihan','<>', 'Replace Precon To Precon')
                    ->whereIn('atasan_langsung', $listLeader)
                    ->groupBy('remark_status');

            // if($namaLeader!="ALL"){
            //     $dtIB =  $dtIB->where('atasan_langsung','=',$namaLeader);
            // }

            for($hr=0; $hr<count($tgl); $hr++){

                $hari = str_replace("-","_",$tgl[$hr]['tanggal']);

                $dtIB = $dtIB->addSelect(
                    DB::raw("ifnull(count(case when tgl_ikr='".$tgl[$hr]['tanggal']."' then branch end),0) as tot_".$hari.""));
            }

            $dtIB=$dtIB->get();


            $tblProgressWO[$tp] = ['remark_status' => $dtPreconWo[$tp]->remark_status ?? "NA"];

            for ($dt=0; $dt < count($dtIB); $dt++){

                for($tg=0; $tg < count($tgl); $tg++){

                    $h = str_replace("-", "_", $tgl[$tg]['tanggal']);
                    $qhd = "tot_".$h;
                    $qhp = "pending_".$h;
                    $qhc = "cancel_".$h;

                    $tblProgressWO[$tp]['harian'][] = (int)$dtIB[$dt]->$qhd;
                }
            }

        }

        return response()->json(['tgl' => $tgl, 'dataStatusPrecon' => $tblProgressWO]);
    }


    public function getProgresWO(request $request)
    {
        $akses= Auth::user()->name;
        $tblProgressWO = [];
        $status=['Done','Pending','Cancel'];
        $bulan = \Carbon\Carbon::parse($request->bulanTahun)->month;
        $tahun = \Carbon\Carbon::parse($request->bulanTahun)->year; 
        $area = $request->area;
        $namaLeader = $request->nama;

        $startDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
        $endDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();

        $dayMonth = \Carbon\CarbonPeriod::between($startDate, $endDate);

        foreach ($dayMonth as $date) 
        {
            $tgl[] = ['tanggal' => $date->format('Y-m-d')]; 
        }

        $namaLeader = DB::table('struktur_ikr')->select('nama_karyawan')
                ->where('posisi','like','Leader%')
                ->whereIn('departement', ['FTTH', 'FTTX/FTTB']);

        if($request->area != "All") {
            $namaLeader = $namaLeader->where('area','=', $request->area);
        }
        if($request->nama != "All"){
            $namaLeader = $namaLeader->where('nama_karyawan','=', $request->nama);
        }

        $namaLeader = $namaLeader->distinct()->orderBy('nama_karyawan')->get();
        $listLeader=$namaLeader->pluck('nama_karyawan');
        

        $dbTim = DB::table('struktur_ikr')->select('nama_karyawan')->distinct()
                    ->where('area',$area)
                    ->whereIn('atasan_langsung',$listLeader);
                    // ->get();

        // if($namaLeader!="ALL"){
        //     $dbTim =  $dbTim->where('atasan_langsung','=',$namaLeader);
        // }

        $dbTim =  $dbTim->get();    

        $dtTypeWo = DB::table('v_progres_wo_tot')
                    ->select('type_wo')->distinct()
                    ->whereIn('teknisi', $dbTim->pluck('nama_karyawan'))
                    // ->where('atasan_langsung','=',$namaLeader)
                    ->where('bulan',$bulan)
                    ->where('tahun', $tahun)
                    ->groupBy('type_wo')
                    ->get();

        for($tp=0; $tp < count($dtTypeWo); $tp++){

            $dtIB = DB::table('v_progres_wo_tot')
                    ->select('type_wo')
                    // ->where('tgl_ikr','=', $tgl[$tg]['tanggal'])
                    // ->where('type_wo','=', $dtTypeWo[$t]->type_wo)
                    ->whereIn('atasan_langsung',$listLeader)
                    ->where('type_wo','=', $dtTypeWo[$tp]->type_wo)
                    ->where('bulan',$bulan)
                    ->where('tahun', $tahun)
                    ->groupBy('type_wo');

            for($hr=0; $hr<count($tgl); $hr++){

                $hari = str_replace("-","_",$tgl[$hr]['tanggal']);

                $dtIB = $dtIB->addSelect(
                    DB::raw("ifnull(sum(case when tgl_ikr='".$tgl[$hr]['tanggal']."' then tdone end),0) as done_".$hari.""),
                    DB::raw("ifnull(sum(case when tgl_ikr='".$tgl[$hr]['tanggal']."' then tpending end),0) as pending_".$hari.""),
                    DB::raw("ifnull(sum(case when tgl_ikr='".$tgl[$hr]['tanggal']."' then tcancel end),0) as cancel_".$hari.""));
            }

            $dtIB=$dtIB->get();

            $tblProgressWO[$tp] = ['type' => $dtTypeWo[$tp]->type_wo];

            for ($dt=0; $dt < count($dtIB); $dt++){

                for($tg=0; $tg < count($tgl); $tg++){

                    $h = str_replace("-", "_", $tgl[$tg]['tanggal']);
                    $qhd = "done_".$h;
                    $qhp = "pending_".$h;
                    $qhc = "cancel_".$h;

                    $tblProgressWO[$tp]['status']['done'][] = (int)$dtIB[$dt]->$qhd;
                    $tblProgressWO[$tp]['status']['pending'][] = (int)$dtIB[$dt]->$qhp;
                    $tblProgressWO[$tp]['status']['cancel'][] = (int)$dtIB[$dt]->$qhc;
                }
            }
        }


        return response()->json(['tgl' => $tgl, 'dataProgress' => $tblProgressWO]);
    }

    public function getCheckin09(request $request)
    {
        $akses= Auth::user()->name;
        $tblProgress9 = [];
        $status=['Done','Pending','Cancel'];
        $bulan = \Carbon\Carbon::parse($request->bulanTahun)->month;
        $tahun = \Carbon\Carbon::parse($request->bulanTahun)->year; 
        $area = $request->area;
        $namaLeader = $request->nama;

        $startDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
        $endDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();

        $dayMonth = \Carbon\CarbonPeriod::between($startDate, $endDate);

        $detStatus = [];

        foreach ($dayMonth as $date) 
        {
            $tgl[] = ['tanggal' => $date->format('Y-m-d')]; 
        }
        

        $namaLeader = DB::table('struktur_ikr')->select('nama_karyawan')
                ->where('posisi','like','Leader%')
                ->whereIn('departement', ['FTTH', 'FTTX/FTTB']);

        if($request->area != "All") {
            $namaLeader = $namaLeader->where('area','=', $request->area);
        }
        if($request->nama != "All"){
            $namaLeader = $namaLeader->where('nama_karyawan','=', $request->nama);
        }

        $namaLeader = $namaLeader->distinct()->orderBy('nama_karyawan')->get();
        $listLeader=$namaLeader->pluck('nama_karyawan');

        $dtStatus9 = DB::table('v_progres_wo_data')
                    ->select('status_slot_time_apk_delay')->distinct()
                    ->whereIn('atasan_langsung',$listLeader)
                    ->whereMonth('tgl_ikr',$bulan)
                    ->whereYear('tgl_ikr', $tahun)
                    ->where('slot_time_apk','like','09:00%')
                    ->groupBy('status_slot_time_apk_delay')
                    ->get();

        $dtType9 = DB::table('v_progres_wo_data')
                    ->select('status_slot_time_apk_delay','type_wo')
                    ->whereIn('atasan_langsung',$listLeader)
                    ->whereMonth('tgl_ikr',$bulan)
                    ->whereYear('tgl_ikr', $tahun)
                    ->where('slot_time_apk','like','09:00%')
                    ->groupBy('status_slot_time_apk_delay','type_wo');
                    // ->get();


        for($hr=0; $hr<count($tgl); $hr++){

            $hari = str_replace("-","_",$tgl[$hr]['tanggal']);

                $dtType9 = $dtType9->addSelect(
                                DB::raw("ifnull(count(case when tgl_ikr='".$tgl[$hr]['tanggal']."' then atasan_langsung end),0) as ".$hari.""));
        
        }

        $dtType9 = $dtType9->get();

        // get total status
        for ($st=0; $st < count($dtStatus9); $st++){

            $detStatus[$st]['status'] = $dtStatus9[$st]->status_slot_time_apk_delay ?? "NA";
            // $tblProgress9[$st]['type_wo'] = $dtStatus9[$st]->type_wo;

        }

        // get detail status
        for ($det=0; $det < count($dtType9); $det++){

            $tblProgress9[$det]['status'] = $dtType9[$det]->status_slot_time_apk_delay ?? "NA" ;
            $tblProgress9[$det]['tipe'] = $dtType9[$det]->type_wo;

            for($hr=0; $hr<count($tgl); $hr++){

                $hari = str_replace("-","_",$tgl[$hr]['tanggal']);
    
                $tblProgress9[$det]['harian'][$hr] = $dtType9[$det]->$hari;
            }
        }

        
        return response()->json(['tgl' => $tgl, 'dataStatus' => $detStatus, 'dataCheckin9' => $tblProgress9]);
    }

    public function getCheckinAll(request $request)
    {
        $akses= Auth::user()->name;
        $tblProgress9 = [];
        $status=['Done','Pending','Cancel'];
        $bulan = \Carbon\Carbon::parse($request->bulanTahun)->month;
        $tahun = \Carbon\Carbon::parse($request->bulanTahun)->year; 
        $area = $request->area;
        $namaLeader = $request->nama;

        $startDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
        $endDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();

        $dayMonth = \Carbon\CarbonPeriod::between($startDate, $endDate);

        $detStatus = [];

        foreach ($dayMonth as $date) 
        {
            $tgl[] = ['tanggal' => $date->format('Y-m-d')]; 
        }
        

        $namaLeader = DB::table('struktur_ikr')->select('nama_karyawan')
                ->where('posisi','like','Leader%')
                ->whereIn('departement', ['FTTH', 'FTTX/FTTB']);

        if($request->area != "All") {
            $namaLeader = $namaLeader->where('area','=', $request->area);
        }
        if($request->nama != "All"){
            $namaLeader = $namaLeader->where('nama_karyawan','=', $request->nama);
        }

        $namaLeader = $namaLeader->distinct()->orderBy('nama_karyawan')->get();
        $listLeader=$namaLeader->pluck('nama_karyawan');

        $dtStatus9 = DB::table('v_progres_wo_data')
                    ->select('status_slot_time_apk_delay')->distinct()
                    ->whereIn('atasan_langsung',$listLeader)
                    ->whereMonth('tgl_ikr',$bulan)
                    ->whereYear('tgl_ikr', $tahun)
                    ->where('slot_time_apk','<>','09:00:00')
                    ->where('slot_time_apk','<>','00:00:00')
                    ->groupBy('status_slot_time_apk_delay')
                    ->get();

        $dtType9 = DB::table('v_progres_wo_data')
                    ->select('status_slot_time_apk_delay','type_wo')
                    ->whereIn('atasan_langsung',$listLeader)
                    ->whereMonth('tgl_ikr',$bulan)
                    ->whereYear('tgl_ikr', $tahun)
                    ->where('slot_time_apk','<>','09:00:00')
                    ->where('slot_time_apk','<>','00:00:00')
                    ->groupBy('status_slot_time_apk_delay','type_wo');
                    // ->get();


        for($hr=0; $hr<count($tgl); $hr++){

            $hari = str_replace("-","_",$tgl[$hr]['tanggal']);

                $dtType9 = $dtType9->addSelect(
                                DB::raw("ifnull(count(case when tgl_ikr='".$tgl[$hr]['tanggal']."' then atasan_langsung end),0) as ".$hari.""));
        
        }

        $dtType9 = $dtType9->get();

        // get total status
        for ($st=0; $st < count($dtStatus9); $st++){

            $detStatus[$st]['status'] = $dtStatus9[$st]->status_slot_time_apk_delay ?? "NA";
            // $tblProgress9[$st]['type_wo'] = $dtStatus9[$st]->type_wo;

        }

        // get detail status
        for ($det=0; $det < count($dtType9); $det++){

            $tblProgress9[$det]['status'] = $dtType9[$det]->status_slot_time_apk_delay ?? "NA" ;
            $tblProgress9[$det]['tipe'] = $dtType9[$det]->type_wo;

            for($hr=0; $hr<count($tgl); $hr++){

                $hari = str_replace("-","_",$tgl[$hr]['tanggal']);
    
                $tblProgress9[$det]['harian'][$hr] = $dtType9[$det]->$hari;
            }
        }

        
        return response()->json(['tgl' => $tgl, 'dataStatus' => $detStatus, 'dataCheckin9' => $tblProgress9]);
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
