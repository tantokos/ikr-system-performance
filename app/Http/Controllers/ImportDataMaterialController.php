<?php

namespace App\Http\Controllers;

use App\Imports\MaterialImport;
use App\Models\FtthMaterial;
use App\Models\ImportFtthMaterial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Arr;

class ImportDataMaterialController extends Controller
{
    public function index(Request $request)
    {
        if($request->areaFill != null) {
            $area = explode("|", $request->areaFill);
            $filArea = $area[1];
        }

        if($request->areagroup != null) {
            $grupArea = DB::table('branches')->select('grup_area', 'nama_branch')
                            ->where('grup_area', $request->areagroup)->pluck('nama_branch')->toArray();

            $filArea = Arr::join($grupArea, ', ');
        }        

        if($request->areaFill == null && $request->areagroup == null) {
            $filArea = null;
        }

        $akses = Auth::user()->name;
        $leadCallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'leader_id', 'nama_leader', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $branches = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        $pivotData = ImportFtthMaterial::select(
            'area',
            'description',
            'status_item',
            'qty'
        )
        ->get()
        ->groupBy(['area', 'description', 'wo_no']); // Kelompokkan berdasarkan area, description, dan wo_no

        // Menghitung jumlah 'Out' dan 'In' untuk setiap grup area, description, dan wo_no
        $processedData = $pivotData->map(function($itemsByDescription, $area) {
            return $itemsByDescription->map(function($itemsByWoNo, $description) use ($area) {
                return $itemsByWoNo->map(function($items, $wo_no) use ($area, $description) {
                    // Hitung total 'Out' dan 'In' berdasarkan status_item dan jumlah qty
                    $out = $items->where('status_item', 'OUT')->sum('qty');
                    $in = $items->where('status_item', 'IN')->sum('qty');

                    return [
                        'area' => $area,
                        'description' => $description,
                        'out' => $out,
                        'in' => $in,
                    ];
                });
            });
        })->flatten(2);

        // return 'Halaman Import Data Material';
        return view('monitoringWo.import_ftth_material', compact('akses', 'leadCallsign', 'branches', 'processedData','filArea'));
    }

    public function import()
    {
        $headings = (new HeadingRowImport)->toArray('users.xlsx');
    }

    public function importProsesMaterial(Request $request, Excel $excel)
    {
        if($request->FilterArea != "All Area"){
            $filArea = $request->FilterArea;
        }

        if ($request->hasFile('fileDataWO'))
        {
            $request->validate([
                'fileDataWO' => ['required', 'mimes:xlsx,xls,csv']
            ]);

            $akses = Auth::user()->id . "|" . Auth::user()->name;

            try {
                $excel->import(new MaterialImport($akses), $request->file('fileDataWO'));
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                foreach ($failures as $failure) {
                    $failure->row(); // row that went wrong
                    $failure->attribute();
                    $failure->errors();
                    $failure->values();
                }
            }

            return back()->with(['success' => 'Import Data Material berhasil']);
        }
    }

    public function getDataImportMaterial(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {
            $datas = DB::table('import_ftth_material')
                ->get();

            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="javascript:void(0)" id="detail-importMaterial"
                                data-id="' . $row->id . '"
                                class="btn btn-sm btn-primary detail-importMaterial mb-0">Detail</a>';
                })
                ->rawColumns(['action']) // Memastikan kolom "action" tidak di-escape
                ->escapeColumns([]) // Mematikan escape di semua kolom
                ->toJson();
        }

        // Kembalikan respons kosong untuk non-AJAX
        return response()->json(['message' => 'Invalid request'], 400);
    }


    public function storeFtthMaterial(Request $request)
    {
        $filArea = [];
        $akses = Auth::user()->name;

        switch ($request->input('action')) {
            case 'simpan':
                //get all data dari hasil import apk
                $importedData = DB::table('import_ftth_material');

                if($request->FiArea != "All Area") {
                    $listArea = explode(", ", $request->FiArea);
                    $importedData = $importedData->whereIn('area', $listArea);
                } 

                $importedData = $importedData->get();

                DB::beginTransaction();
                try {
                    $doubleImport = [];

                    foreach ($importedData as $data) {
                        // Cek apakah data WO ada sama / pernah di import sebelumnya
                        $cekDoubleImport = DB::table('ftth_materials')
                                    ->where('wo_no',$data->wo_no)
                                    // ->where('installation_date', $data->installation_date)
                                    ->first();
                        
                        // kumpulkan no wo yg sama /pernah di import sebelumnya
                        if($cekDoubleImport) {
                            array_push($doubleImport,  $data->wo_no);                            
                        }                        
                    }

                    //cek jumlah wo yg sama, dan langsung di hapus
                    if(count($doubleImport) > 0) {
                        $deleteDtMaterial = FtthMaterial::whereIn('wo_no', $doubleImport)
                        // ->where('installation_date', $data->installation_date)
                        ->delete();
                    }

                    //proces looping insert data import
                    foreach ($importedData as $data) {

                        // Insert data material
                        DB::table('ftth_materials')->insert([
                            'wo_no' => $data->wo_no,
                            'wo_date' => $data->wo_date,
                            'installation_date' => $data->installation_date,
                            'vendor_installer' => $data->vendor_installer,
                            'callsign' => $data->callsign,
                            'area' => $data->area,
                            'warehouse' => $data->warehouse,
                            'cust_id' => $data->cust_id,
                            'name' => $data->name,
                            'wo_type' => $data->wo_type,
                            'remarks' => $data->remarks,
                            'status' => $data->status,
                            'status_item' => $data->status_item,
                            'item_code' => $data->item_code,
                            'description' => $data->description,
                            'qty' => $data->qty,
                            'sn' => $data->sn,
                            'mac_address' => $data->mac_address,
                            'material_condition' => $data->material_condition,
                            'kategori_material' => $data->kategori_material,
                            'login' => $akses,
                        ]);
                    }

                    // Commit transaksi jika tidak ada kesalahan
                    DB::table('import_ftth_material')->delete();
                    DB::commit();
                    return redirect()->route('monitFtthMT')->with('success', 'Data berhasil disimpan.');
                } catch (\Exception $e) {
                    // Rollback jika ada kesalahan
                    DB::rollback();
                    return $e;
                    return redirect()->route('importDataMaterial')->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
                }
                break;

            case 'batal':
                DB::table('import_ftth_material')->delete();
                return redirect()->route('monitFtthMT')->with('success', 'Material berhasil dibatalkan.');
                break;
        }
    }



}
