<?php

namespace App\Http\Controllers;

use App\Imports\JadwalIkrImport;
use App\Models\DataJadwalIkr;
use App\Models\ImportJadwalIkr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ImportJadwalTim_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akses = Auth::user()->name;
        return view('absensi.import-scheduleIkr',['akses' => $akses]);
    }

    public function importProsesJadwalIkr(Request $request)
    {


        if ($request->hasFile('fileDataJadwal')) {

            $bulan = $request->bulan;
            $tahun = $request->tahun;

            $request->validate([
                'fileDataJadwal' => ['required', 'mimes:xlsx,xls,csv']
            ]);

            $akses = Auth::user()->id . "|" . Auth::user()->name . "|" . $bulan . "|" . $tahun;

            // $headings = (new HeadingRowImport)->toArray($request->fileDataWO);
            // dd($headings);
            try {
                Excel::import(new JadwalIkrImport($akses), request()->file('fileDataJadwal'));

            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                // DB::rollBack();
                // return $e->getMessage();
                //return redirect()->route('importDataWo')
                //->with(['error' => 'Gagal Import Assign Tim: ' . $e->getMessage()]);
                $failures = $e->failures();

                foreach ($failures as $failure) {
                    $failure->row(); // row that went wrong
                    $failure->attribute(); // either heading key (if using heading row concern) or column index
                    $failure->errors(); // Actual error messages from Laravel validator
                    $failure->values(); // The values of the row that has failed.
                }
            }

            return back()->with(['success' => 'Import Jadwal IKR berhasil.']);
        }
    }

    public function simpanImportJadwal(Request $request)
    {
        $akses = Auth::user()->name;

        switch ($request->input('action')) {
            case 'simpan':

                if ($request->branchShow) {
                    $branchRq = explode('|', $request->branchShow);
                    $branchId = $branchRq[0];
                    $branch = $branchRq[1];
                } else {
                    $branch = "";
                }

                $dtImportNull = ImportJadwalIkr::whereNull('nik_karyawan')
                    ->where('login', $akses)
                    ->get()->toArray();

                if (count($dtImportNull) > 0) {
                    return redirect()->route('importJadwalTim')
                        ->with(['error' => 'Cek data karyawan yang belum terdaftar di Database']);
                }

                $dtImport = ImportJadwalIkr::whereNotNull('nik_karyawan')
                    ->select(
                        'branch_id',
                        'branch',
                        'nik_karyawan',
                        'nama_karyawan',
                        'bulan',
                        'tahun',
                        't01','t02','t03','t04','t05','t06','t07','t08','t09','t10',
                        't11','t12','t13','t14','t15','t16','t17','t18','t19','t20',
                        't21','t22','t23','t24','t25','t26','t27','t28','t29','t30','t31',
                        'login_id','login','created_at','updated_at'
                    )
                    ->where('login', $akses)
                    ->get()->toArray();


                if (count($dtImport) > 0) 
                {
                    $doubleAssign = [];

                    foreach ($dtImport as $data) {
                        $cekDoubleImport = DB::table('data_jadwal_ikrs')->where('nik_karyawan', $data['nik_karyawan'])
                            ->where('bulan', $data['bulan'])->where('tahun', $data['tahun'])
                            ->first();

                        if ($cekDoubleImport) {
                            array_push($doubleAssign, $cekDoubleImport->nama_karyawan);
                        }
                    }

                    $dtImport2 = ImportJadwalIkr::whereNotIn('nik_karyawan', $doubleAssign)
                    ->select(
                        'branch_id',
                        'branch',
                        'nik_karyawan',
                        'nama_karyawan',
                        'bulan',
                        'tahun',
                        't01','t02','t03','t04','t05','t06','t07','t08','t09','t10',
                        't11','t12','t13','t14','t15','t16','t17','t18','t19','t20',
                        't21','t22','t23','t24','t25','t26','t27','t28','t29','t30','t31',
                        'login_id','login'
                    )
                        ->whereNotNull('nik_karyawan')
                        ->where('login', $akses)
                        ->get()
                        ->toArray();
                    // dd($dtImport2);
                    DB::beginTransaction();

                    try {
                        // Insert ke data_assign_tims
                        DataJadwalIkr::insert($dtImport2);

                        // Hapus data dari ImportAssignTim
                        ImportJadwalIkr::whereNotIn('nik_karyawan', $doubleAssign)
                            ->where('login', $akses)
                            ->delete();

                        DB::commit();

                        if (count($doubleAssign) > 0) {
                            return redirect()->route('importJadwalTim')
                                ->with(['success' => 'Sebagian Data tersimpan. Cek data karyawan yang sama']);
                        
                        } else {
                            ImportJadwalIkr::where('login', $akses)->delete();
                            return redirect()->route('jadwalTim')
                                ->with(['success' => 'Data tersimpan.']);
                        }
                    } catch (\Exception $e) {
                        DB::rollBack();
                        return $e->getMessage();
                        return redirect()->route('importJadwalTim')
                            ->with(['error' => 'Gagal Simpan Data: ' . $e->getMessage()]);
                    }
                } else {
                    return redirect()->route('importJadwalTim')
                        ->with(['error' => 'Data Karyawan Belum Terdaftar di Database']);
                }

                break;

            case 'batal':
                ImportJadwalIkr::where('login', $akses)->delete();
                return redirect()->route('jadwalTim');
                break;
        }
    }

    public function getRekapDataImportJadwal(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('v_rekap_import_jadwal')->where('login',$akses)->get();

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

    public function getKaryawanTidakTerdaftar(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('import_jadwal_ikrs')->where('login',$akses)
                ->whereNull('nik_karyawan')->get();

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

    public function getdataImportJadwal(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('import_jadwal_ikrs')->where('login',$akses)
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
