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

class karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $area = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen','Underground'])->get();

        return view('karyawan.data_Karyawan', ['area' => $area]);
    }

    public function getDataKaryawan(Request $request)
    {
        $akses = Auth::user()->name;
        
        
        if ($request->ajax()) {
            $datas = DB::table('employees as d')
                    ->leftJoin('branches as b', 'd.branch_id','=','b.id')
                    ->select('d.*', 'b.nama_branch')
                    ->orderBy('nama_karyawan')->get();
            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '<a href="/detailKaryawan/'. $row->id.'" class="btn btn-sm btn-primary edit-barang mb-1" >Show Detail</a>';
                            //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }

    }


    public function simpanKaryawan(Request $request)
    {

        $akses= Auth::user()->name;

        $request->validate([
            'nik_karyawan' => ['required', 'unique:Employees,nik_karyawan'],
            'nama_karyawan' => ['required', 'unique:Employees,nama_karyawan'],
            'branch_id' => 'required',
            'divisi' => 'required',
            'departement' => 'required',
            'posisi' => 'required',
        ]);

        if ($request->hasFile('foto_karyawan')) {
            $file = $request->file('foto_karyawan')->getClientOriginalName();
            $request->file('foto_karyawan')->move(public_path('storage/image-kry'), $file);
        } else {
            $file = 'foto-blank.jpg';
        }


        Employee::create([
            'nik_karyawan' => $request->nik,
            'nama_karyawan' => $request->namaKaryawan,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tmptLahir,
            'tgl_lahir' => $request->tglLahir,
            'jenis_kelamin' => $request->jenisKelamin,
            'agama' => $request->agama,
            'no_telp' => $request->noTelp,
            'tgl_gabung' => $request->tglGabung,
            'status_pegawai' => $request->statusPegawai,
            'status_active' => $request->statusKaryawan,
            'tgl_nonactive' => $request->tglKeluar, 
            'branch_id' => $request->area,
            'divisi' => $request->divisi,
            'departement' => $request->departemen,
            'posisi' => $request->posisi,
            'email' => $request->email,
            'no_ktp' => $request->noKTP,
            'no_npwp' => $request->noNPWP,
            'no_rek' => $request->noRek,
            'no_bpjs' => $request->noBpjs,
            'no_jamsostek' => $request->noJamsostek,
            'foto_karyawan' => $file,
            'input_by' => $akses
        ]);

        // $request->session()->flash('status', 'Task was successful!');
        return redirect()->route('dataKaryawan')->with(['success' => 'Data sudah tersimpan.']);
    }


    public function detailKaryawan($id)
    {

        $karyawan = Employee::find($id);
        $area = Branch::all();
        return view('karyawan.detail_Karyawan',['karyawan' => $karyawan, 'area' => $area]);
        
    }

    public function updateKaryawan(Request $request, $id) 
    {
        $akses= Auth::user()->name;

        // dd($request);
        $request->validate([
            'nik' => 'required',
            'namaKaryawan' => 'required',
            'area' => 'required',
            'divisi' => 'required',
            'departemen' => 'required',
            'posisi' => 'required',
        ]);

        $karyawan = Employee::findOrFail($id);

        if ($request->hasFile('foto_karyawan')) {
            $file = $request->file('foto_karyawan');
            $file->storeAs('public/storage/image-kry', $file->hashName());

            // $request->file('foto_karyawan')->move(public_path('storage/image-kry'), $file);

            Storage::delete('public/storage/image-kry'.$karyawan->foto_karyawan);

            $karyawan->update([
                'nik_karyawan' => $request->nik,
                'nama_karyawan' => $request->namaKaryawan,
                'alamat' => $request->alamat,
                'tempat_lahir' => $request->tmptLahir,
                'tgl_lahir' => $request->tglLahir,
                'jenis_kelamin' => $request->jenisKelamin,
                'agama' => $request->agama,
                'no_telp' => $request->noTelp,
                'tgl_gabung' => $request->tglGabung,
                'status_pegawai' => $request->statusPegawai,
                'status_active' => $request->statusKaryawan,
                'tgl_nonactive' => $request->tglKeluar, 
                'branch_id' => $request->area,
                'divisi' => $request->divisi,
                'departement' => $request->departemen,
                'posisi' => $request->posisi,
                'email' => $request->email,
                'no_ktp' => $request->noKTP,
                'no_npwp' => $request->noNPWP,
                'no_rek' => $request->noRek,
                'no_bpjs' => $request->noBpjs,
                'no_jamsostek' => $request->noJamsostek,
                'foto_karyawan' => $file,
                'update_by' => $akses
            ]);

        } else {
            $file = 'foto-blank.jpg';

            $karyawan->update([
                'nik_karyawan' => $request->nik,
                'nama_karyawan' => $request->namaKaryawan,
                'alamat' => $request->alamat,
                'tempat_lahir' => $request->tmptLahir,
                'tgl_lahir' => $request->tglLahir,
                'jenis_kelamin' => $request->jenisKelamin,
                'agama' => $request->agama,
                'no_telp' => $request->noTelp,
                'tgl_gabung' => $request->tglGabung,
                'status_pegawai' => $request->statusPegawai,
                'status_active' => $request->statusKaryawan,
                'tgl_nonactive' => $request->tglKeluar, 
                'branch_id' => $request->area,
                'divisi' => $request->divisi,
                'departement' => $request->departemen,
                'posisi' => $request->posisi,
                'email' => $request->email,
                'no_ktp' => $request->noKTP,
                'no_npwp' => $request->noNPWP,
                'no_rek' => $request->noRek,
                'no_bpjs' => $request->noBpjs,
                'no_jamsostek' => $request->noJamsostek,
                'foto_karyawan' => $file,
                'update_by' => $akses
            ]);

        }

        return redirect()->route('dataKaryawan')->with(['success' => 'Data sudah tersimpan.']);

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
