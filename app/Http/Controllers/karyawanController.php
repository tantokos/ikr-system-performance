<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\isNull;

class karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $area = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        $posisi = DB::table('data_posisi')->get();

        $kry = DB::table('employees')
                ->select('nama_karyawan','divisi','departement','status_active')
                ->orderBy('nama_karyawan')
                ->get();


        return view('karyawan.data_Karyawan', ['area' => $area, 'kry' => $kry,'posisi' => $posisi]);
    }

    public function getSummaryKaryawan(Request $request)
    {
        $sumKry = DB::table('v_karyawan_callsign')
                ->select(DB::raw('branch_id,nama_branch, departement,
                                count(if(divisi="IKR Operation",1,null)) as ikr_operation,
                                count(if(divisi="IKR Support",1,null)) as ikr_support'
                ))                
                ->orderBy('branch_id')
                ->groupBy('branch_id','nama_branch','departement'); //->get();

        if($request->filBranch != "ALL"){
            $sumKry = $sumKry->where('nama_branch',$request->filBranch);
        }
        if($request->filNamaKaryawan != "ALL"){
            $sumKry = $sumKry->where('nama_karyawan',$request->filNamaKaryawan);
        }
        if($request->filPosisi != "ALL"){
            $sumKry = $sumKry->where('posisi',$request->filPosisi);
        }
        if($request->filDivisi != "ALL"){
            $sumKry = $sumKry->where('divisi',$request->filDivisi);
        }
        if($request->filDepartement != "ALL"){
            $sumKry = $sumKry->where('departement',$request->filDepartement);
        }
        if($request->filSeragam != "ALL"){
            $sumKry = $sumKry->where('seragam', 'like', '%' . $request->filSeragam . '%');
        }
        

        $sumKry = $sumKry->get();    

        return response()->json($sumKry);

    }

    public function getDataKaryawan(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('employees as d')
                ->leftJoin('branches as b', 'd.branch_id', '=', 'b.id')
                ->select('d.*', 'b.nama_branch')
                ->orderBy('nama_karyawan'); //->get();

        if($request->filBranch != "ALL"){
            $datas = $datas->where('b.nama_branch',$request->filBranch);
        }
        if($request->filNamaKaryawan != "ALL"){
            $datas = $datas->where('d.nama_karyawan',$request->filNamaKaryawan);
        }
        if($request->filPosisi != "ALL"){
            $datas = $datas->where('d.posisi',$request->filPosisi);
        }
        if($request->filDivisi != "ALL"){
            $datas = $datas->where('d.divisi',$request->filDivisi);
        }
        if($request->filDepartement != "ALL"){
            $datas = $datas->where('d.departement',$request->filDepartement);
        }
        if($request->filStatus != "ALL"){
            $datas = $datas->where('d.status_active',$request->filStatus);
        }
        if($request->filSeragam != "ALL"){
            $datas = $datas->where('seragam1',$request->filSeragam);
            $datas = $datas->orWhere('seragam2',$request->filSeragam);
            $datas = $datas->orWhere('seragam3',$request->filSeragam);
        }

        $datas = $datas->get();      

        if ($request->ajax()) {
            
            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('seragam', function ($sr) {
                    $srg = $sr->seragam1 . "-" . $sr->seragam2 . "-" . $sr->seragam3;
                    return $srg;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="/detailKaryawan/' . $row->id . '" class="btn btn-sm btn-primary edit-barang mb-1" >Show Detail</a>';
                    //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action','seragam'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }


    public function simpanKaryawan(Request $request)
    {
        
        $akses = Auth::user()->name;

        $cekValidasi = $request->validate([
            'nik' => ['required', 'unique:employees,nik_karyawan'],
            // 'namaKaryawan' => ['required', 'unique:employees,nama_karyawan'],
        ]);

        DB::beginTransaction();
        try {

            if ($request->hasFile('foto_karyawan')) {
                $file = $request->file('foto_karyawan')->getClientOriginalName();
                // $request->file('foto_karyawan')->move(public_path('storage/image-kry'), $file);
            } else {
                $file = 'foto-blank.jpg';
            }
    
            $simpanKry = Employee::create([
                'nik_karyawan' => $request->nik,
                'nama_karyawan' => $request->namaKaryawan,
                'alamat' => $request->alamat,
                'tempat_lahir' => $request->tmptLahir,
                'tgl_lahir' => $request->tglLahir,
                'jenis_kelamin' => $request->jenisKelamin,
                'agama' => $request->agama,
                'no_telp' => $request->noTelpKry,
                'tgl_gabung' => $request->tglGabung,
                'status_pegawai' => $request->statusPegawai,
                'status_active' => $request->statusKaryawan,
                'tgl_nonactive' => $request->tglKeluar,
                'branch_id' => $request->area,
                'divisi' => $request->divisi,
                'departement' => $request->departemen,
                'posisi' => $request->posisi,
                'email' => $request->emailPerusahaan,
                'seragam1' => $request->seragam1,
                'seragam2' => $request->seragam2,
                'seragam3' => $request->seragam3,
                'no_ktp' => $request->noKTP,
                'no_npwp' => $request->noNPWP,
                'no_rek' => $request->noRek,
                'no_bpjs' => $request->noBpjs,
                'no_jamsostek' => $request->noJamsostek,
                'foto_karyawan' => $file,
                'kewarganegaraan' => $request->kewarganegaraan,
                'status_pernikahan' => $request->statusPernikahan,
                'jml_tanggungan' => $request->jmlTanggungan,
                'email_pribadi' => $request->emailPribadi,
                'alamat_domisili' => $request->alamatDomisili,
                'pendidikan_terakhir' => $request->pendidikanTerakhir,
                'golongan_darah' => $request->golonganDarah,
                'no_koperasi' => $request->noKoperasi,
                'nama_kel' => $request->namaKel,
                'status_kel' => $request->statusKel,
                'alamat_kel' => $request->alamatKel,
                'pekerjaan_kel' => $request->pekerjaanKel,
                'no_telp_kel' => $request->noTelpKel,
                'anak1' => $request->anak1,
                'anak2' => $request->anak2,
                'anak3' => $request->anak3,
                'anak4' => $request->anak4,
                'nama_kontak1' => $request->namaKontak1,
                'status_kontak1' => $request->statusKontak1,
                'alamat_kontak1' => $request->alamatKontak1,
                'no_telp_kontak1' => $request->noTelpKontak1,
                'nama_kontak2' => $request->namaKontak2,
                'status_kontak2' => $request->statusKontak2,
                'alamat_kontak2' => $request->alamatKontak2,
                'no_telp_kontak2' => $request->noTelpKontak2,
                'input_by' => $akses
            ]);
    
            if ($simpanKry) {
                if ($request->hasFile('foto_karyawan')) {
                    $request->file('foto_karyawan')->move(public_path('storage/image-kry'), $file);
                }
            }

            DB::commit();

            return redirect()->route('dataKaryawan')->with(['success' => 'Data sudah tersimpan.']);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error','Gagal Simpan Data: .'. $e->getMessage());

        }

    }


    public function detailKaryawan($id)
    {

        $karyawan = DB::table('employees as e')
            ->leftJoin('branches as b', 'b.id', '=', 'e.branch_id')
            ->where('e.id', $id)
            ->select('e.*', 'b.nama_branch')
            ->first();

        $area = Branch::all();
        // dd($karyawan->tgl_gabung);
        // $join = Carbon::parse(substr($karyawan->nik_karyawan, 0, 4) . "-" . substr($karyawan->nik_karyawan, 4, 2))->diff(Carbon::now());
        
        if(is_null($karyawan->tgl_gabung)) {
            $join = Carbon::parse(Carbon::now())->diff(Carbon::now());
        }else {
            $join = Carbon::parse($karyawan->tgl_gabung)->diff(Carbon::now());
            
        }
        
        return view('karyawan.detail_Karyawan', ['karyawan' => $karyawan, 'area' => $area, 'join' => $join]);
    }

    public function updateKaryawan(Request $request)
    {
        $akses = Auth::user()->name;
        $karyawan = Employee::findOrFail($request->nikId);
        // $karyawan = DB::table('employees')->where('id', $request->nikId)->where('nik_karyawan', $request->nik)->first();

        DB::beginTransaction();
        try{

            if ($request->hasFile('foto_karyawan')) {
                $fileFoto = $request->file('foto_karyawan');
                $file = $fileFoto->hashName();
                $request->file('foto_karyawan')->move(public_path('storage/image-kry'), $file);
    
                if($karyawan->foto_karyawan != "foto-blank.jpg"){
                    File::delete(public_path('storage/image-kry/' . $karyawan->foto_karyawan));
                }
                
                $karyawan->update([
                    'nik_karyawan' => $request->nik,
                    'nama_karyawan' => $request->namaKaryawan,
                    'alamat' => $request->alamat,
                    'tempat_lahir' => $request->tmptLahir,
                    'tgl_lahir' => $request->tglLahir,
                    'jenis_kelamin' => $request->jenisKelamin,
                    'agama' => $request->agama,
                    'no_telp' => $request->noTelpKry,
                    'tgl_gabung' => $request->tglGabung,
                    'status_pegawai' => $request->statusPegawai,
                    'status_active' => $request->statusKaryawan,
                    'tgl_nonactive' => $request->tglKeluar,
                    'branch_id' => $request->area,
                    'divisi' => $request->divisi,
                    'departement' => $request->departemen,
                    'posisi' => $request->posisi,
                    'email' => $request->emailPerusahaan,
                    'seragam1' => $request->seragam1,
                    'seragam2' => $request->seragam2,
                    'seragam3' => $request->seragam3,
                    'no_ktp' => $request->noKTP,
                    'no_npwp' => $request->noNPWP,
                    'no_rek' => $request->noRek,
                    'no_bpjs' => $request->noBpjs,
                    'no_jamsostek' => $request->noJamsostek,
                    'foto_karyawan' => $file,
                    'kewarganegaraan' => $request->kewarganegaraan,
                    'status_pernikahan' => $request->statusPernikahan,
                    'jml_tanggungan' => $request->jmlTanggungan,
                    'email_pribadi' => $request->emailPribadi,
                    'alamat_domisili' => $request->alamatDomisili,
                    'pendidikan_terakhir' => $request->pendidikanTerakhir,
                    'golongan_darah' => $request->golonganDarah,
                    'no_koperasi' => $request->noKoperasi,
                    'nama_kel' => $request->namaKel,
                    'status_kel' => $request->statusKel,
                    'alamat_kel' => $request->alamatKel,
                    'pekerjaan_kel' => $request->pekerjaanKel,
                    'no_telp_kel' => $request->noTelpKel,
                    'anak1' => $request->anak1,
                    'anak2' => $request->anak2,
                    'anak3' => $request->anak3,
                    'anak4' => $request->anak4,
                    'nama_kontak1' => $request->namaKontak1,
                    'status_kontak1' => $request->statusKontak1,
                    'alamat_kontak1' => $request->alamatKontak1,
                    'no_telp_kontak1' => $request->noTelpKontak1,
                    'nama_kontak2' => $request->namaKontak2,
                    'status_kontak2' => $request->statusKontak2,
                    'alamat_kontak2' => $request->alamatKontak2,
                    'no_telp_kontak2' => $request->noTelpKontak2,
                    'update_by' => $akses
                ]);
            } else {
                // $file = 'foto-blank.jpg';
    
                $karyawan->update([
                    'nik_karyawan' => $request->nik,
                    'nama_karyawan' => $request->namaKaryawan,
                    'alamat' => $request->alamat,
                    'tempat_lahir' => $request->tmptLahir,
                    'tgl_lahir' => $request->tglLahir,
                    'jenis_kelamin' => $request->jenisKelamin,
                    'agama' => $request->agama,
                    'no_telp' => $request->noTelpKry,
                    'tgl_gabung' => $request->tglGabung,
                    'status_pegawai' => $request->statusPegawai,
                    'status_active' => $request->statusKaryawan,
                    'tgl_nonactive' => $request->tglKeluar,
                    'branch_id' => $request->area,
                    'divisi' => $request->divisi,
                    'departement' => $request->departemen,
                    'posisi' => $request->posisi,
                    'email' => $request->emailPerusahaan,
                    'seragam1' => $request->seragam1,
                    'seragam2' => $request->seragam2,
                    'seragam3' => $request->seragam3,
                    'no_ktp' => $request->noKTP,
                    'no_npwp' => $request->noNPWP,
                    'no_rek' => $request->noRek,
                    'no_bpjs' => $request->noBpjs,
                    'no_jamsostek' => $request->noJamsostek,
                    // 'foto_karyawan' => $file,
                    'kewarganegaraan' => $request->kewarganegaraan,
                    'status_pernikahan' => $request->statusPernikahan,
                    'jml_tanggungan' => $request->jmlTanggungan,
                    'email_pribadi' => $request->emailPribadi,
                    'alamat_domisili' => $request->alamatDomisili,
                    'pendidikan_terakhir' => $request->pendidikanTerakhir,
                    'golongan_darah' => $request->golonganDarah,
                    'no_koperasi' => $request->noKoperasi,
                    'nama_kel' => $request->namaKel,
                    'status_kel' => $request->statusKel,
                    'alamat_kel' => $request->alamatKel,
                    'pekerjaan_kel' => $request->pekerjaanKel,
                    'no_telp_kel' => $request->noTelpKel,
                    'anak1' => $request->anak1,
                    'anak2' => $request->anak2,
                    'anak3' => $request->anak3,
                    'anak4' => $request->anak4,
                    'nama_kontak1' => $request->namaKontak1,
                    'status_kontak1' => $request->statusKontak1,
                    'alamat_kontak1' => $request->alamatKontak1,
                    'no_telp_kontak1' => $request->noTelpKontak1,
                    'nama_kontak2' => $request->namaKontak2,
                    'status_kontak2' => $request->statusKontak2,
                    'alamat_kontak2' => $request->alamatKontak2,
                    'no_telp_kontak2' => $request->noTelpKontak2,
                    'update_by' => $akses
                ]);
            }
            
            if($karyawan) {
                $dtBranch = DB::table('branches')->where('id', $request->area)->first();
    
                $dtJadwal = DB::table('data_jadwal_ikrs')->where('nik_karyawan', $request->nik)
                            ->select('branch_id','branch')->distinct()->first();

                if(count($dtJadwal) > 0) 
                {
                    if($dtJadwal->branch_id != $request->area) {
                        $updateJadwal = DB::table('data_jadwal_ikrs')->where('nik_karyawan', $request->nik)
                            ->update([
                                'branch_id' => $request->area,
                                'branch' => $dtBranch->nama_branch
                            ]);
                        
                        $updateCallTim1 = DB::table('callsign_tims')->where('nik_tim1', $request->nik)
                            ->update([
                                'nik_tim1' => null,                            
                            ]);
                        $updateCallTim2 = DB::table('callsign_tims')->where('nik_tim2', $request->nik)
                            ->update([
                                'nik_tim2' => null,                            
                            ]);
                        $updateCallTim3 = DB::table('callsign_tims')->where('nik_tim3', $request->nik)
                            ->update([
                                'nik_tim3' => null,                            
                            ]);
                        $updateCallTim4 = DB::table('callsign_tims')->where('nik_tim4', $request->nik)
                            ->update([
                                'nik_tim4' => null,                            
                            ]);
                    }
                }               
                
            }

            DB::commit();
            return redirect()->route('dataKaryawan')->with(['success' => 'Data sudah tersimpan.']);

        } catch (\Exception $e) {
            DB::rollBack();
            // return response()->json($e->getMessage());
            return redirect()->route('dataKaryawan')->with(['error' => 'Gagal mengupdate status.' . $e->getMessage()]);
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
