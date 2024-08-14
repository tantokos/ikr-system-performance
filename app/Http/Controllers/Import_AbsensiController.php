<?php

namespace App\Http\Controllers;

use App\Imports\AbsenImport;
use App\Models\DataAbsence;
use App\Models\ImportDataAbsence;
use App\Models\VImportAbsensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class Import_AbsensiController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akses = Auth::user()->name;

        // $jmlData = ImportDataAbsence::where('import_by','=', $akses)->count('nama_karyawan');
        $jmlData = DB::table('v_import_absensis')->where('import_by','=', $akses)->count('nama_karyawan');

        $periode = ImportDataAbsence::where('import_by','=', $akses)->select('tanggal')->distinct()->get();

        $tglMin = $periode->min('tanggal');
        $tglMax = $periode->max('tanggal');

        $statusImport = DataAbsence::whereBetween('tanggal',[$tglMax, $tglMax])->get();

        if($statusImport->count() > 0) {
            $croscekData = "Data Tanggal $tglMin - $tglMax Sudah Pernah di Import";
        }
        else
        {
            $croscekData = "-";
        }

        $dataAbsen = DB::table('v_import_absensis as v') // ->join('status_kehadiran as sk', 'v.status_masuk_keluar', '=', 'sk.status_absen')
                    ->select(DB::raw('v.status_masuk_keluar'))
                    ->where('import_by','=', $akses)
                    ->groupBy('v.status_masuk_keluar')
                    ->orderBy('v.status_masuk_keluar')
                    ->get();

        $dataNama = DB::table('v_import_absensis as v') // ->join('status_kehadiran as sk', 'v.status_masuk_keluar', '=', 'sk.status_absen')
                    ->select(DB::raw('v.nama_karyawan'))
                    ->where('import_by','=', $akses)
                    ->groupBy('v.nama_karyawan')
                    ->orderBy('v.nama_karyawan')
                    ->get();

        $dataArea = DB::table('v_import_absensis as v') // ->join('status_kehadiran as sk', 'v.status_masuk_keluar', '=', 'sk.status_absen')
                    ->select(DB::raw('v.area'))
                    ->where('import_by','=', $akses)
                    ->groupBy('v.area')
                    ->orderBy('v.area')
                    ->get();

        return view('perform.import-DataAbsensi', [
            'akses' => $akses, 'jmlData' => $jmlData, 'periode' => $periode, 'croscekData' => $croscekData,
            'dataAbsen' => $dataAbsen, 'dataNama' => $dataNama, 'dataArea' => $dataArea
        ]);
    }

    public function importDataAbsensi(Request $request)
    {

        if ($request->hasFile('fileDataAbsensi')) {

            $request->validate([
                'fileDataAbsensi' => ['required', 'mimes:xlsx,xls,csv']
            ]);

            $akses = Auth::user()->name;

            Excel::import(new AbsenImport($akses), request()->file('fileDataAbsensi'));

            return back();

        }
        
    }

    public function getDataAbsensi(Request $request)
    {

        $akses = Auth::user()->name;
        
        if ($request->ajax()) {
            $datas = DB::table('v_import_absensis')->where('import_by', '=', $akses)->orderBy('nama_karyawan')->orderBy('tanggal')->get();
            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                // ->addColumn('action', function ($row) {
                    // $btn = '<a href="#" class="btn btn-sm btn-primary edit-barang" > <i class="fas fa-edit"></i> Edit</a>
                            //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    // return $btn;
                // })
                // ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }


    public function getFilterPreview(Request $request)
    {
        // dd($request->all());
        $akses = Auth::user()->name;
        $periode = DB::table('v_import_absensis')->where('import_by','=', $akses)->select('tanggal')->distinct()->get();

        $tglMin = $periode->min('tanggal');
        $tglMax = $periode->max('tanggal');

        $tgl = [];
        $tblPreview = [];
        $dayMonth = \Carbon\CarbonPeriod::between($tglMin, $tglMax);

        $dataPreview = DB::table('v_import_absensis as v')->join('status_kehadiran as sk', 'v.status_masuk_keluar', '=', 'sk.status_absen')
                    ->select(DB::raw('sk.id, v.status_masuk_keluar'))
                    ->where('import_by','=', $akses);

        if( $request->filStatus != "All"){
            $dataPreview = $dataPreview->where('status_masuk_keluar','=', $request->filStatus);
        }
        if( $request->filNama != "All"){
            $dataPreview = $dataPreview->where('nama_karyawan','=', $request->filNama);
        }
        if( $request->filArea != "All"){
            $dataPreview = $dataPreview->where('area','=', $request->filArea);
        }

        foreach ($dayMonth as $date) {
            $tgl[] = $date->format('Y-m-d'); 
            
            $dataPreview = $dataPreview->addSelect(DB::raw('ifnull(sum(if(v.tanggal="'.$date.'",1,0)),0) as "'.$date->format('Y_m_d').'"'));
        }

        $dataPreview = $dataPreview->groupBy('sk.id','v.status_masuk_keluar')
                                    ->orderBy('sk.id')
                                    ->get();

        for ($dp=0; $dp < $dataPreview->count(); $dp++){
            $tblPreview[$dp] = ['status_absen' => $dataPreview[$dp]->status_masuk_keluar];

            for ($t=0; $t < count($tgl); $t++){
                $days = str_replace('-','_', $tgl[$t]);

                $tblPreview[$dp]['day'][$t]= (int)$dataPreview[$dp]->$days;
            }
        }

        return response()->json(
            ['tgl'=> $tgl, //'dataAbsen' => $dataPreview, 
            'tblPreview' => $tblPreview
        ]);
    }


    public function saveImportAbsensi(Request $request)
    {
        $akses = Auth::user()->name;

        switch ($request->input('action')) {

            case 'simpan':

                // ===== copy data Ftth MT Ori Temporary ke table Data Ftth MT Ori ======//
                $dataimportAbsen = VImportAbsensi::where('import_by', '=', $akses)->get()
                    ->each(function ($item) {
                        $dataAbsen = $item->replicate();
                        $dataAbsen->setTable('data_absences');
                        $dataAbsen->save();
                    });

                

                if ($dataimportAbsen) {
                //     // ==== copy data Ftth Mt Sortir Temporary ke table Data Ftth Mt Sortir =======//
                //     $dataimportFtthMtSortir = ImportFtthMtSortirTemp::where('login', '=', $akses)->get()
                //         ->each(function ($item) {
                //             $dataFtthMtSortir = $item->replicate();
                //             $dataFtthMtSortir->setTable('data_ftth_mt_sortirs');
                //             $dataFtthMtSortir->save();
                //         });

                    ImportDataAbsence::where('import_by', '=', $akses)->delete();
                }

                break;

            case 'batal':
                ImportDataAbsence::where('import_by', '=', $akses)->delete();

                break;
        }

        

        return back();
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
