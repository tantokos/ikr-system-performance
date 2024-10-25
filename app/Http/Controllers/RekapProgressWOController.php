<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RekapProgressWOController extends Controller
{
    public function index()
    {

        $tahun = DB::table('data_ftth_mt_oris')->select(DB::raw('year(tgl_ikr) as tahun'))
                ->distinct()->get();

        $branchList = DB::table('branches as b')->Join('struktur_ikr as d', 'b.nama_branch', '=', 'd.area')
            ->select('b.id', 'd.area as nama_branch')
            ->distinct()
            ->orderBy('b.id')
            ->get();

        return view('monitoringWo.rekap_progress_wo',['tahun' => $tahun,'areaList' => $branchList]);
    }

    public function getMonthReport(Request $request){
        // dd($request->all());

        $bulan = DB::table('data_ftth_mt_oris')->select(DB::raw('monthname(tgl_ikr) as bulan'))
                ->whereYear('tgl_ikr', $request->filTahun)->distinct()->get();

        return response()->json($bulan);
    }

    public function getRekapProgressWO(Request $request){

        $akses= Auth::user()->name;
        $tblProgressWO = [];
        $status=['Done','Pending','Cancel'];
        $bulan = $request->filBulan;
        $tahun = $request->filTahun;; 
        $area = $request->area;
        $filTgl = $request->filTgl;
        // $namaLeader = $request->nama;

        $startDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
        $endDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();

        $dayMonth = \Carbon\CarbonPeriod::between($startDate, $endDate);

        

        $totFtthIB = DB::table('data_ftth_ib_oris')->where('tgl_ikr',$filTgl);
                    // ->count();

        $totFtthMT = DB::table('data_ftth_mt_oris')->where('tgl_ikr',$filTgl);
                    // ->count();

        $totDismantle = DB::table('data_ftth_dismantle_oris')->where('visit_date',$filTgl);
                    // ->count();

        $totFttxIB = DB::table('data_fttx_ib_oris')->where('ib_date',$filTgl);
                    // ->count();
        
        $totFttxMT = DB::table('data_fttx_mt_oris')->where('mt_date',$filTgl);
                    // ->count();

        if($request->area != "All") {
            $totFtthIB = $totFtthIB->where('branch','=', $request->area);
            $totFtthMT = $totFtthMT->where('branch','=', $request->area);
            $totDismantle = $totDismantle->where('main_branch','=', $request->area);
            $totFttxIB = $totFttxIB->where('branch','=', $request->area);
            $totFttxMT = $totFttxMT->where('branch','=', $request->area);
        }

        $totFtthIB = $totFtthIB->count();
        $totFtthMT = $totFtthMT->count();
        $totDismantle = $totDismantle->count();
        $totFttxIB = $totFttxIB->count();
        $totFttxMT = $totFttxMT->count();

        
        $statFtthIB = DB::table('data_ftth_ib_oris')->where('tgl_ikr', $filTgl)
                    // ->where('status_wo', "Requested");
                    ->select("status_wo", DB::raw('count(status_wo) as jml'))
                    ->groupBy('status_wo');

        $statFtthMT = DB::table('data_ftth_mt_oris')->where('tgl_ikr', $filTgl)
                    // ->where('status_wo', "Requested");
                    ->select("status_wo", DB::raw('count(status_wo) as jml'))
                    ->groupBy('status_wo');

        $statDismantle = DB::table('data_ftth_dismantle_oris')->where('visit_date', $filTgl)
                    // ->where('status_wo', "Requested");
                    ->select("status_wo", DB::raw('count(status_wo) as jml'))
                    ->groupBy('status_wo');
        
        $statFttxIB = DB::table('data_fttx_ib_oris')->where('ib_date', $filTgl)
                    // ->where('status_wo', "Requested");
                    ->select("status_wo", DB::raw('count(status_wo) as jml'))
                    ->groupBy('status_wo');

        $statFttxMT = DB::table('data_fttx_mt_oris')->where('mt_date', $filTgl)
                    // ->where('status_wo', "Requested");
                    ->select("status_wo", DB::raw('count(status_wo) as jml'))
                    ->groupBy('status_wo');

        if($request->area != "All") {
            $statFtthIB = $statFtthIB->where('branch','=', $request->area);
            $statFtthMT = $statFtthMT->where('branch','=', $request->area);
            $statDismantle = $statDismantle->where('main_branch','=', $request->area);
            $statFttxIB = $statFttxIB->where('branch','=', $request->area);
            $statFttxMT = $statFttxMT->where('branch','=', $request->area);
        }        

        $statFtthIB = $statFtthIB->get();
        $statFtthMT = $statFtthMT->get();
        $statDismantle = $statDismantle->get();
        $statFttxIB = $statFttxIB->get();
        $statFttxMT = $statFttxMT->get();

        $totDone = 0;
        $totPending = 0;
        $totCancel = 0;
        $totCheckin = 0;
        $totRequested = 0;

        for($x=0; $x < count($statFtthMT); $x++) {
            if(Str::upper($statFtthMT[$x]->status_wo) == "DONE") {
                $totDone = $totDone + $statFtthMT[$x]->jml;
            }
            if(Str::upper($statFtthMT[$x]->status_wo) == "CHECKOUT") {
                $totDone = $totDone + $statFtthMT[$x]->jml;
            }
            if(Str::upper($statFtthMT[$x]->status_wo) == "PENDING") {
                $totPending = $totPending + $statFtthMT[$x]->jml;
            }
            if(Str::upper($statFtthMT[$x]->status_wo) == "CANCEL") {
                $totCancel = $totCancel + $statFtthMT[$x]->jml;
            }
            if(Str::upper($statFtthMT[$x]->status_wo) == "CHECKIN") {
                $totCheckin = $totCheckin + $statFtthMT[$x]->jml;
            }
            if(Str::upper($statFtthMT[$x]->status_wo) == "REQUESTED") {
                $totRequested = $totRequested + $statFtthMT[$x]->jml;
            }
        }

        for($x=0; $x < count($statFtthIB); $x++) {
            if(Str::upper($statFtthIB[$x]->status_wo) == "DONE") {
                $totDone = $totDone + $statFtthIB[$x]->jml;
            }
            if(Str::upper($statFtthIB[$x]->status_wo) == "CHECKOUT") {
                $totDone = $totDone + $statFtthIB[$x]->jml;
            }
            if(Str::upper($statFtthIB[$x]->status_wo) == "PENDING") {
                $totPending = $totPending + $statFtthIB[$x]->jml;
            }
            if(Str::upper($statFtthIB[$x]->status_wo) == "CANCEL") {
                $totCancel = $totCancel + $statFtthIB[$x]->jml;
            }
            if(Str::upper($statFtthIB[$x]->status_wo) == "CHECKIN") {
                $totCheckin = $totCheckin + $statFtthIB[$x]->jml;
            }
            if(Str::upper($statFtthIB[$x]->status_wo) == "REQUESTED") {
                $totRequested = $totRequested + $statFtthIB[$x]->jml;
            }
        }

        for($x=0; $x < count($statDismantle); $x++) {
            if(Str::upper($statDismantle[$x]->status_wo) == "DONE") {
                $totDone = $totDone + $statDismantle[$x]->jml;
            }
            if(Str::upper($statDismantle[$x]->status_wo) == "CHECKOUT") {
                $totDone = $totDone + $statDismantle[$x]->jml;
            }
            if(Str::upper($statDismantle[$x]->status_wo) == "PENDING") {
                $totPending = $totPending + $statDismantle[$x]->jml;
            }
            if(Str::upper($statDismantle[$x]->status_wo) == "CANCEL") {
                $totCancel = $totCancel + $statDismantle[$x]->jml;
            }
            if(Str::upper($statDismantle[$x]->status_wo) == "CHECKIN") {
                $totCheckin = $totCheckin + $statDismantle[$x]->jml;
            }
            if(Str::upper($statDismantle[$x]->status_wo) == "REQUESTED") {
                $totRequested = $totRequested + $statDismantle[$x]->jml;
            }
        }

        for($x=0; $x < count($statFttxIB); $x++) {
            if(Str::upper($statFttxIB[$x]->status_wo) == "DONE") {
                $totDone = $totDone + $statFttxIB[$x]->jml;
            }
            if(Str::upper($statFttxIB[$x]->status_wo) == "CHECKOUT") {
                $totDone = $totDone + $statFttxIB[$x]->jml;
            }
            if(Str::upper($statFttxIB[$x]->status_wo) == "PENDING") {
                $totPending = $totPending + $statFttxIB[$x]->jml;
            }
            if(Str::upper($statFttxIB[$x]->status_wo) == "CANCEL") {
                $totCancel = $totCancel + $statFttxIB[$x]->jml;
            }
            if(Str::upper($statFttxIB[$x]->status_wo) == "CHECKIN") {
                $totCheckin = $totCheckin + $statFttxIB[$x]->jml;
            }
            if(Str::upper($statFttxIB[$x]->status_wo) == "REQUESTED") {
                $totRequested = $totRequested + $statFttxIB[$x]->jml;
            }
        }

        for($x=0; $x < count($statFttxMT); $x++) {
            if(Str::upper($statFttxMT[$x]->status_wo) == "DONE") {
                $totDone = $totDone + $statFttxMT[$x]->jml;
            }
            if(Str::upper($statFttxMT[$x]->status_wo) == "CHECKOUT") {
                $totDone = $totDone + $statFttxMT[$x]->jml;
            }
            if(Str::upper($statFttxMT[$x]->status_wo) == "PENDING") {
                $totPending = $totPending + $statFttxMT[$x]->jml;
            }
            if(Str::upper($statFttxMT[$x]->status_wo) == "CANCEL") {
                $totCancel = $totCancel + $statFttxMT[$x]->jml;
            }
            if(Str::upper($statFttxMT[$x]->status_wo) == "CHECKIN") {
                $totCheckin = $totCheckin + $statFttxMT[$x]->jml;
            }
            if(Str::upper($statFttxMT[$x]->status_wo) == "REQUESTED") {
                $totRequested = $totRequested + $statFttxMT[$x]->jml;
            }
        }

        // dd($statFtthMT, $totDone, $totRequested);

        return response()->json(['totFtthIB' => $totFtthIB,'totFtthMT' => $totFtthMT,'totDismantle' => $totDismantle,
                                'totFttxIB' => $totFttxIB,'totFttxMT' => $totFttxMT,
                                'totDone' => $totDone, 'totPending' => $totPending, 'totCancel' => $totCancel, 
                                'totCheckin' => $totCheckin, 'totRequested' => $totRequested]);
    }

    public function getRekapProgressWO_old(Request $request){

        $akses= Auth::user()->name;
        $tblProgressWO = [];
        $status=['Done','Pending','Cancel'];
        $bulan = $request->filBulan;
        $tahun = $request->filTahun;; 
        $area = $request->area;
        // $namaLeader = $request->nama;

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
                    // ->whereIn('teknisi', $dbTim->pluck('nama_karyawan'))
                    // ->where('atasan_langsung','=',$namaLeader)
                    ->where('branch', $area)
                    ->where('bulan',$bulan)
                    ->where('tahun', $tahun)
                    ->groupBy('type_wo')
                    ->get();

        for($tp=0; $tp < count($dtTypeWo); $tp++){

            $dtIB = DB::table('v_progres_wo_tot')
                    ->select('type_wo')
                    // ->where('tgl_ikr','=', $tgl[$tg]['tanggal'])
                    // ->where('type_wo','=', $dtTypeWo[$t]->type_wo)
                    // ->whereIn('atasan_langsung',$listLeader)
                    ->where('branch', $area)
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
}
