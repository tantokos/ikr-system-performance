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

class karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $area = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        return view('karyawan.data_Karyawan', ['area' => $area]);
    }

    public function getDataKaryawan(Request $request)
    {
        $akses = Auth::user()->name;


        if ($request->ajax()) {
            $datas = DB::table('employees as d')
                ->leftJoin('branches as b', 'd.branch_id', '=', 'b.id')
                ->select('d.*', 'b.nama_branch')
                ->orderBy('nama_karyawan')->get();
            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '<a href="/detailKaryawan/' . $row->id . '" class="btn btn-sm btn-primary edit-barang mb-1" >Show Detail</a>';
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
        // dd($request->all());

        $akses = Auth::user()->name;

        // $request->validate([
        //     'nik_karyawan' => ['required', 'unique:Employees,nik_karyawan'],
        //     'nama_karyawan' => ['required', 'unique:Employees,nama_karyawan'],
        //     'branch_id' => 'required',
        //     'divisi' => 'required',
        //     'departement' => 'required',
        //     'posisi' => 'required',
        // ]);

        $cekValidasi = $request->validate([
            'nik' => ['required', 'unique:Employees,nik_karyawan'],
            'namaKaryawan' => ['required', 'unique:Employees,nama_karyawan'],
        ]);

        if ($request->hasFile('foto_karyawan')) {
            $file = $request->file('foto_karyawan')->getClientOriginalName();
            $request->file('foto_karyawan')->move(public_path('storage/image-kry'), $file);
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
            return redirect()->route('dataKaryawan')->with(['success' => 'Data sudah tersimpan.']);
        } else {
            return response()->with(['error' => 'Data Tidak tersimpan.']);
        }


        // $request->session()->flash('status', 'Task was successful!');
        // return redirect()->route('dataKaryawan')->with(['success' => 'Data sudah tersimpan.']);
    }


    public function detailKaryawan($id)
    {

        $karyawan = DB::table('employees as e')
            ->leftJoin('branches as b', 'b.id', '=', 'e.branch_id')
            ->where('e.id', $id)
            ->select('e.*', 'b.nama_branch')
            ->first();

        $area = Branch::all();

        $join = Carbon::parse(substr($karyawan->nik_karyawan, 0, 4) . "-" . substr($karyawan->nik_karyawan, 4, 2))->diff(Carbon::now());
        return view('karyawan.detail_Karyawan', ['karyawan' => $karyawan, 'area' => $area, 'join' => $join]);
    }

    public function updateKaryawan(Request $request)
    {
        $akses = Auth::user()->name;
        $karyawan = Employee::findOrFail($request->nikId);
        // $karyawan = DB::table('employees')->where('id', $request->nikId)->where('nik_karyawan', $request->nik)->first();


        if ($request->hasFile('foto_karyawan')) {
            $fileFoto = $request->file('foto_karyawan');
            $file = $fileFoto->hashName();
            $request->file('foto_karyawan')->move(public_path('storage/image-kry'), $file);

            File::delete(public_path('storage/image-kry/' . $karyawan->foto_karyawan));

            $karyawan->update([
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
            $file = 'foto-blank.jpg';

            $karyawan->update([
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
