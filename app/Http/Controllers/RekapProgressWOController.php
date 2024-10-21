<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
