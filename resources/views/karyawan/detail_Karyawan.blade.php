<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-2 mb-5">
                        <div class="full-background" style="background: linear-gradient(to right, #112133, #21416d);">
                        </div>
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">Detail Data Karyawan</h3>
                            <p class="mb-4 font-weight-semibold">
                                PT. Mitra Sinergi Telematika.
                            </p>

                            {{-- <img src="../assets/img/3d-cube.png" alt="3d-cube"
                                class="position-absolute top-0 end-1 w-25 max-width-200 mt-n6 d-sm-block d-none" /> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleMonthly"></span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
                                    <button type="button"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                        id="editData" data-bs-toggle="modal" data-bs-target="#editDataModal">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Edit Data</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group mb-1 text-center" style="width:160px;height: 160px;">

                                        @if (substr($karyawan->foto_karyawan,0,4) == "http" )
                                            {{-- {{ dd($karyawan->foto_karyawan)}} --}}
                                            <iframe src="https://drive.google.com/file/d/{{ substr($karyawan->foto_karyawan, strpos($karyawan->foto_karyawan,"id=") + 3) }}/preview" id="showFotoDetail"
                                            alt="Card Image" width="170" height="170"></iframe>
                                        @else
                                            <img src="/storage/image-kry/{{ $karyawan->foto_karyawan }}" id="showFotoDetail"
                                            alt="Card Image" style="width:160px;height: 160px;object-fit: contain;"/>
                                        @endif
                                        
                                            
                                    </div>
                                </div>
                                <div class="col">

                                    <dl class="dl-horizontal row">
                                        <dt class="col-sm-4 text-sm">Nik Karyawan</dt>
                                        <dd class="col-sm-8 text-sm">
                                            {{ $karyawan->nik_karyawan ? $karyawan->nik_karyawan : '-' }}
                                        </dd>

                                        <dt class="col-sm-4 text-sm">Nama Karyawan</dt>
                                        <dd class="col-sm-8 text-sm">
                                            {{ $karyawan->nama_karyawan ? $karyawan->nama_karyawan : '-' }}
                                        </dd>

                                        <dt class="col-sm-4 text-sm">Status Karyawan</dt>
                                        <dd class="col-sm-8 text-sm">
                                            {{ $karyawan->status_active ? $karyawan->status_active : '-' }}
                                        </dd>

                                        <dt class="col-sm-4 text-sm">Status Pegawai</dt>
                                        <dd class="col-sm-8 text-sm">
                                            {{ $karyawan->status_pegawai ? $karyawan->status_pegawai : '-' }}
                                        </dd>

                                        <dt class="col-sm-4 text-sm">Tanggal Bergabung</dt>
                                        <dd class="col-sm-8 text-sm">
                                            {{ $karyawan->tgl_gabung ? $karyawan->tgl_gabung : '-' }}
                                        </dd>

                                        <dt class="col-sm-4 text-sm">Divisi</dt>
                                        <dd class="col-sm-8 text-sm">
                                            {{ $karyawan->divisi ? $karyawan->divisi : '-' }}
                                        </dd>

                                        <dt class="col-sm-4 text-sm">Departemen</dt>
                                        <dd class="col-sm-8 text-sm">
                                            {{ $karyawan->departement ? $karyawan->departement : '-' }}
                                        </dd>

                                        <dt class="col-sm-4 text-sm">posisi</dt>
                                        <dd class="col-sm-8 text-sm">
                                            {{ $karyawan->posisi ? $karyawan->posisi : '-' }}
                                        </dd>

                                        <dt class="col-sm-4 text-sm">Branch</dt>
                                        <dd class="col-sm-8 text-sm">
                                            {{ $karyawan->nama_branch ? $karyawan->nama_branch : '-' }}
                                        </dd>

                                        <dt class="col-sm-4 text-sm">Email</dt>
                                        <dd class="col-sm-8 text-sm">
                                            {{ $karyawan->email ? $karyawan->email : '-' }}
                                        </dd>
                                    </dl>
                                </div>

                                <div class="col">
                                    <dl class="dl-horizontal row">
                                        <dt class="col-sm-4 text-sm">No Telepon</dt>
                                        <dd class="col-sm-8 text-sm">
                                            {{ $karyawan->no_telp ? $karyawan->no_telp : '-' }}</dd>

                                        <dt class="col-sm-4 text-sm">Periode Bergabung</dt>
                                        <dd class="col-sm-8 text-sm">
                                            {{ $join->y . ' Tahun ' . $join->m . ' Bulan ' . $join->d . ' Hari' }}
                                        </dd>

                                        {{-- <dt class="col-sm-4"><small>No Rekening Bank</small></dt>
                                        <dd class="col-sm-8"><small>{{ $karyawan->no_rek ?: '-' }}</small>
                                        </dd> --}}
                                        <dt class="col-sm-4"><small> No BPJS</small></dt>
                                        <dd class="col-sm-8">
                                            <small>{{ $karyawan->no_bpjs ?: '-' }}</small>
                                        </dd>
                                        <dt class="col-sm-4"><small> No Jamsostek</small></dt>
                                        <dd class="col-sm-8">
                                            <small>{{ $karyawan->no_jamsostek ?: '-' }}</small>
                                        </dd>
                                        <dt class="col-sm-4"><small> No NPWP</small></dt>
                                        <dd class="col-sm-8">
                                            <small>{{ $karyawan->no_npwp ?: '-' }}</small>
                                        </dd>
                                        <dt class="col-sm-4"><small> Seragam</small></dt>
                                        <dd class="col-sm-8">
                                            <small>{{ $karyawan->seragam1 ? $karyawan->seragam1 . " - " . $karyawan->seragam2 . " - " . $karyawan->seragam3 : '-' }}</small>
                                        </dd>
                                        <dt class="col-sm-4"><small> Tgl Pencatatan Data</small></dt>
                                        <dd class="col-sm-8">
                                            <small>{{ $karyawan->created_at ?: '-' }}</small>
                                        </dd>
                                        <dt class="col-sm-4"><small> Tgl Pembaruan Data</small></dt>
                                        <dd class="col-sm-8">
                                            <small>{{ $karyawan->updated_at ?: '-' }}</small>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body px-2 py-2">
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-tabs nav-fill p-1" role="tablist">
                                    <li class="nav-item" style="background-color: #c2c3c4">
                                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#DetailKry"
                                            role="tab" aria-controls="DetailKry" aria-selected="true">
                                            Detail Karyawan
                                        </a>
                                    </li>
                                    <li class="nav-item" style="background-color: #c2c3c4">
                                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#Kepesertaan"
                                            role="tab" aria-controls="Kepesertaan" aria-selected="true">
                                            Informasi Tambahan
                                        </a>
                                    </li>
                                    <li class="nav-item" style="background-color: #c2c3c4">
                                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#IdentitasKel"
                                            role="tab" aria-controls="IdentitasKel" aria-selected="false">
                                            Identitas Keluarga
                                        </a>
                                    </li>

                                    <li class="nav-item" style="background-color: #c2c3c4">
                                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#kontakDarurat"
                                            role="tab" aria-controls="kontakDarurat" aria-selected="false">
                                            Kontak Darurat
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane active" id="DetailKry" role="tabpanel" aria-expanded="true">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col">

                                            <dl class="dl-horizontal row">

                                                <dt class="col-sm-4 text-sm">Nama Karyawan</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->nama_karyawan ? $karyawan->nama_karyawan : '-' }}
                                                </dd>

                                                <dt class="col-sm-4 text-sm">Tempat & Tgl Lahir</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ ($karyawan->tempat_lahir ? $karyawan->tempat_lahir : '-') . ', ' . ($karyawan->tgl_lahir ? $karyawan->tgl_lahir : '-') }}
                                                </dd>

                                                <dt class="col-sm-4 text-sm">Agama</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->agama ?: '-' }}</dd>

                                                <dt class="col-sm-4 text-sm">No KTP</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->no_ktp ?: '-' }}
                                                </dd>

                                                <dt class="col-sm-4 text-sm">Kewarganegaraan</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->kewarganegaraan ?: '-' }}
                                                </dd>

                                                <dt class="col-sm-4 text-sm">No Telepon</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->no_telp ?: '-' }}
                                                </dd>

                                                <dt class="col-sm-4 text-sm">Alamat Lengkap</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->alamat ?: '-' }}
                                                </dd>

                                            </dl>
                                        </div>

                                        <div class="col">
                                            <dl class="dl-horizontal row">
                                                <dt class="col-sm-4  text-sm">Jenis Kelamin</dt>
                                                <dd class="col-sm-8 text-sm">{{ $karyawan->jenis_kelamin ?: '-' }}
                                                </dd>
                                                <dt class="col-sm-4 text-sm">Status Pernikahan</dt>
                                                <dd class="col-sm-8 text-sm">{{ $karyawan->status_pernikahan ?: '-' }}
                                                </dd>

                                                <dt class="col-sm-4 text-sm">Jumlah Tanggungan</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->jml_tanggungan ?: '-' }}</dd>

                                                <dt class="col-sm-4 text-sm">Email Pribadi</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->email_pribadi ?: '-' }}</dd>
                                                <dt class="col-sm-4 text-sm">Email Perusahaan</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->email ?: '-' }}</dd>
                                                <dt class="col-sm-4 text-sm">Alamat Domisili</dt>
                                                <dd class="col-sm-8 text-sm">{{ $karyawan->alamat_domisili ?: '-' }}
                                                </dd>
                                                <dt class="col-sm-4 text-sm">Pendidikan Terakhir</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->pendidikan_terakhir ?: '-' }}</dd>
                                                <dt class="col-sm-4 text-sm">Golongan Darah</dt>
                                                <dd class="col-sm-8 text-sm">{{ $karyawan->golongan_darah ?: '-' }}
                                                </dd>

                                            </dl>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane" id="Kepesertaan" role="tabpanel" aria-expanded="true">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">

                                            <dl class="dl-horizontal row">
                                                <dt class="col-sm-4  text-sm">No NPWP</dt>
                                                <dd class="col-sm-8 text-sm">{{ $karyawan->no_npwp ?: '-' }}
                                                </dd>
                                                {{-- <dt class="col-sm-4 text-sm">No Rek Bank</dt>
                                                <dd class="col-sm-8 text-sm">{{ $karyawan->no_rek ?: '-' }}
                                                </dd> --}}

                                                <dt class="col-sm-4 text-sm">No BPJS</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->no_bpjs ?: '-' }}</dd>

                                                <dt class="col-sm-4 text-sm">No Jamsostek</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->no_jamsostek ?: '-' }}</dd>

                                                <dt class="col-sm-4 text-sm">No Koperasi Karyawan</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->no_koperasi ?: '-' }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane" id="IdentitasKel" role="tabpanel" aria-expanded="true">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">

                                            <dl class="dl-horizontal row">
                                                <dt class="col-sm-4  text-sm">Nama Pasangan</dt>
                                                <dd class="col-sm-8 text-sm">{{ $karyawan->nama_kel ?: '-' }}
                                                </dd>
                                                <dt class="col-sm-4 text-sm">Status Pasangan</dt>
                                                <dd class="col-sm-8 text-sm">{{ $karyawan->status_kel ?: '-' }}
                                                </dd>

                                                <dt class="col-sm-4 text-sm">Alamat</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->alamat_kel ?: '-' }}</dd>

                                                <dt class="col-sm-4 text-sm">Pekerjaan</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->pekerjaan_kel ?: '-' }}</dd>

                                                <dt class="col-sm-4 text-sm">No Telepon/Hp</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->no_telp_kel ?: '-' }}</dd>

                                            </dl>
                                        </div>

                                        <div class="col">

                                            <dl class="dl-horizontal row">
                                                <dt class="col-sm-4  text-sm">Nama Anak 1</dt>
                                                <dd class="col-sm-8 text-sm">{{ $karyawan->anak1 ?: '-' }}
                                                </dd>
                                                <dt class="col-sm-4 text-sm">Nama Anak 2</dt>
                                                <dd class="col-sm-8 text-sm">{{ $karyawan->anak2 ?: '-' }}
                                                </dd>

                                                <dt class="col-sm-4 text-sm">Nama Anak 3</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->anak3 ?: '-' }}</dd>

                                                <dt class="col-sm-4 text-sm">Nama Anak 4</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->anak4 ?: '-' }}</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane" id="kontakDarurat" role="tabpanel" aria-expanded="true">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">

                                            <dl class="dl-horizontal row">
                                                <dt class="col-sm-4  text-sm">Nama Kontak 1</dt>
                                                <dd class="col-sm-8 text-sm">{{ $karyawan->nama_kontak1 ?: '-' }}
                                                </dd>
                                                <dt class="col-sm-4 text-sm">Status</dt>
                                                <dd class="col-sm-8 text-sm">{{ $karyawan->status_kontak1 ?: '-' }}
                                                </dd>

                                                <dt class="col-sm-4 text-sm">Alamat</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->alamat_kontak1 ?: '-' }}</dd>

                                                <dt class="col-sm-4 text-sm">No Telepon/hp</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->no_telp_kontak1 ?: '-' }}</dd>
                                            </dl>
                                        </div>

                                        <div class="col">

                                            <dl class="dl-horizontal row">
                                                <dt class="col-sm-4  text-sm">Nama Kontak 2</dt>
                                                <dd class="col-sm-8 text-sm">{{ $karyawan->nama_kontak2 ?: '-' }}
                                                </dd>
                                                <dt class="col-sm-4 text-sm">Status</dt>
                                                <dd class="col-sm-8 text-sm">{{ $karyawan->status_kontak2 ?: '-' }}
                                                </dd>

                                                <dt class="col-sm-4 text-sm">Alamat</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->alamat_kontak2 ?: '-' }}</dd>

                                                <dt class="col-sm-4 text-sm">No Telepon/hp</dt>
                                                <dd class="col-sm-8 text-sm">
                                                    {{ $karyawan->no_telp_kontak2 ?: '-' }}</dd>
                                            </dl>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        {{-- </form> --}}
                    </div>
                </div>
            </div>


            {{-- <x-app.footer /> --}}
        </div>

        {{-- Modal Tambah Data --}}
        <div class="modal fade" id="editDataModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Karyawan</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateKaryawan') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body px-2 py-2">
                                <div class="nav-wrapper position-relative end-0">
                                    <ul class="nav nav-tabs nav-fill p-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab"
                                                href="#DetailKryEdit" role="tab" aria-controls="DetailKry"
                                                aria-selected="true">
                                                Detail Karyawan
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                                href="#KepesertaanEdit" role="tab" aria-controls="Kepesertaan"
                                                aria-selected="true">
                                                Informasi Tambahan
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                                href="#IdentitasKelEdit" role="tab" aria-controls="IdentitasKel"
                                                aria-selected="false">
                                                Identitas Keluarga
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                                href="#kontakDaruratEdit" role="tab"
                                                aria-controls="kontakDarurat" aria-selected="false">
                                                Kontak Darurat
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane active" id="DetailKryEdit" role="tabpanel"
                                    aria-expanded="true">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col">
                                                <div class="form-group mb-1 text-center">
                                                    <img src="/storage/image-kry/{{ $karyawan->foto_karyawan }}"
                                                        id="showFotoEdit" alt="Card Image"
                                                        style="width:160px;height: 160px;" />

                                                </div>
                                                <div class="form-group mb-1">
                                                    <input class="form-control form-control-sm" id="foto_karyawan"
                                                        name="foto_karyawan" type="file"
                                                        style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <input type="hidden" id="nikId" name="nikId"
                                                        value="{{ $karyawan->id }}">
                                                    <span class="text-xs">Nik Karyawan</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="nik" name="nik" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->nik_karyawan ? $karyawan->nik_karyawan : '-' }}">
                                                    @error('nik')
                                                        <span class="text-xs text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Nama Karyawan</span>
                                                    <input class="form-control form-control-sm" id="namaKaryawan"
                                                        name="namaKaryawan" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->nama_karyawan ? $karyawan->nama_karyawan : '-' }}">
                                                    @error('namaKaryawan')
                                                        <span class="text-xs text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Tanggal Bergabung</span>
                                                        <Input class="form-control form-control-sm" type="date"
                                                            id="tglGabung" name="tglGabung"
                                                            value="{{ $karyawan->tgl_gabung ? $karyawan->tgl_gabung : '-' }}"
                                                            style="border-color:#9ca0a7;">
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Status Pegawai</span>
                                                        <select class="form-control form-control-sm"
                                                            id="statusPegawai" name="statusPegawai"
                                                            style="border-color:#9ca0a7;">
                                                            <option value="Kontrak"
                                                                {{ $karyawan->status_pegawai == 'Kontrak' ? 'selected' : '' }}>
                                                                Kontrak</option>
                                                            <option value="Tetap"
                                                                {{ $karyawan->status_pegawai == 'Tetap' ? 'selected' : '' }}>
                                                                Tetap</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Status Karyawan</span>
                                                        <select class="form-control form-control-sm"
                                                            id="statusKaryawan" name="statusKaryawan"
                                                            style="border-color:#9ca0a7;">
                                                            <option value="Aktif"
                                                                {{ $karyawan->status_active == 'Aktif' ? 'selected' : '-' }}>
                                                                Aktif</option>
                                                            <option value="Tidak Aktif"
                                                                {{ $karyawan->status_active == 'Tidak Aktif' ? 'selected' : '-' }}>
                                                                Tidak Aktif</option>

                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Tanggal Keluar</span>
                                                        <Input class="form-control form-control-sm" type="date"
                                                            id="tglKeluar" name="tglKeluar"
                                                            value="{{ $karyawan->tgl_nonactive ? $karyawan->tgl_nonactive : '-' }}"
                                                            style="border-color:#9ca0a7;">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Area</span>
                                                        <select class="form-control form-control-sm" id="area"
                                                            name="area" style="border-color:#9ca0a7;">
                                                            <option value="">Pilih Area</option>
                                                            @foreach ($area as $listArea)
                                                                <option value="{{ $listArea->id }}"
                                                                    {{ $karyawan->branch_id == $listArea->id ? 'selected' : '' }}>
                                                                    {{ $listArea->nama_branch }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Divisi</span>
                                                        <select class="form-control form-control-sm" id="divisi"
                                                            name="divisi" style="border-color:#9ca0a7;">
                                                            <option value="IKR Operation" {{ $karyawan->divisi == 'IKR Operation' ? 'selected' : '' }}>IKR Operation</option>
                                                            <option value="IKR Support" {{ $karyawan->divisi == 'IKR Support' ? 'selected' : '' }}>IKR Support</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Departemen</span>
                                                        <select class="form-control form-control-sm" id="departemen"
                                                            name="departemen" style="border-color:#9ca0a7;">
                                                            <option value="FTTH"
                                                                {{ $karyawan->departement == 'FTTH' ? 'selected' : '' }}>
                                                                FTTH</option>
                                                            <option value="FTTX/FTTB"
                                                                {{ $karyawan->departement == 'FTTX/FTTB' ? 'selected' : '' }}>
                                                                FTTX/FTTB</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Posisi</span>
                                                        <select class="form-control form-control-sm" id="posisi"
                                                            name="posisi" style="border-color:#9ca0a7;">
                                                            <option value="Operation Manager"
                                                                {{ $karyawan->posisi == 'Operation Manager' ? 'selected' : '' }}>
                                                                Operation Manager</option>
                                                            <option value="IKR Support Manager"
                                                                {{ $karyawan->posisi == 'IKR Support Manager' ? 'selected' : '' }}>
                                                                IKR Support Manager</option>
                                                            <option value="Assistant Manager"
                                                                {{ $karyawan->posisi == 'Assistant Manager' ? 'selected' : '' }}>
                                                                Assistant Manager
                                                            </option>
                                                            <option value="Supervisor Operation"
                                                                {{ $karyawan->posisi == 'Supervisor Operation' ? 'selected' : '' }}>
                                                                Supervisor Operation
                                                            </option>
                                                            <option value="Supervisor Operation Regional"
                                                                {{ $karyawan->posisi == 'Supervisor Operation Regional' ? 'selected' : '' }}>
                                                                Supervisor Operation Regional</option>
                                                            <option value="Supervisor Traffic"
                                                                {{ $karyawan->posisi == 'Supervisor Traffic' ? 'selected' : '' }}>
                                                                Supervisor Traffic</option>
                                                            <option value="Supervisor IT Support"
                                                                {{ $karyawan->posisi == 'Supervisor IT Support' ? 'selected' : '' }}>
                                                                Supervisor IT Support</option>
                                                            <option value="Leader"
                                                                {{ $karyawan->posisi == 'Leader' ? 'selected' : '' }}>Leader</option>
                                                            <option value="Staff Document Control"
                                                                {{ $karyawan->posisi == 'Staff Document Control' ? 'selected' : '' }}>
                                                                Staff Document Control</option>
                                                            <option value="Staff Traffic"
                                                                {{ $karyawan->posisi == 'Staff Traffic' ? 'selected' : '' }}>Staff Traffic</option>
                                                            <option value="Staff IT Support"
                                                                {{ $karyawan->posisi == 'Staff IT Support' ? 'selected' : '' }}>Staff IT Support</option>
                                                            <option value="Teknisi"
                                                                {{ $karyawan->posisi == 'Teknisi' ? 'selected' : '' }}>Teknisi</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Tempat Lahir</span>
                                                        <input class="form-control form-control-sm" id="tmptLahir"
                                                            name="tmptLahir" style="border-color:#9ca0a7;"
                                                            value="{{ $karyawan->tempat_lahir }}">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-xs">Tanggal Lahir</span>
                                                        <Input class="form-control form-control-sm" type="date"
                                                            id="tglLahir" name="tglLahir"
                                                            value="{{ $karyawan->tgl_lahir }}"
                                                            style="border-color:#9ca0a7;">
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">No. KTP</span>
                                                        <input class="form-control form-control-sm" id="noKTP"
                                                            name="noKTP" style="border-color:#9ca0a7;"
                                                            value="{{ $karyawan->no_ktp }}">
                                                    </div>
                                                    <div class="col-4">
                                                        <span class="text-xs">Agama</span>
                                                        <select class="form-control form-control-sm" id="agama"
                                                            name="agama" style="border-color:#9ca0a7;">
                                                            <option value=""></option>
                                                            <option value="Islam"
                                                                {{ $karyawan->agama == 'Islam' ? 'selected' : '' }}>
                                                                Islam
                                                            </option>
                                                            <option value="Kristen"
                                                                {{ $karyawan->agama == 'Kristen' ? 'selected' : '' }}>
                                                                Kristen</option>
                                                            <option value="Hindu"
                                                                {{ $karyawan->agama == 'Hindu' ? 'selected' : '' }}>
                                                                Hindu
                                                            </option>
                                                            <option value="Budha"
                                                                {{ $karyawan->agama == 'Budha' ? 'selected' : '' }}>
                                                                Budha
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="col">
                                                        <div class="form-group mb-1">
                                                            <span class="text-xs">Kewarganegaraan</span>
                                                            <input class="form-control form-control-sm" id="kewarganegaraan"
                                                                name="kewarganegaraan" style="border-color:#9ca0a7;"
                                                                value="{{ $karyawan->kewarganegaraan }}">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-xs">Jenis Kelamin</span>
                                                        <select class="form-control form-control-sm" id="jenisKelamin"
                                                            name="jenisKelamin" style="border-color:#9ca0a7;">
                                                            <option value="Laki-laki"
                                                                {{ $karyawan->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                                                Laki-laki</option>
                                                            <option value="Perempuan"
                                                                {{ $karyawan->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                                Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <label class="text-xs">Seragam 1</label>
                                                        <div class="col">
                                                            <input class="form-check-input" type="radio" value="Baik" name="seragam1" id="seragam1_1"
                                                            {{ $karyawan->seragam1 == "Baik" ? "checked" : ""}}>
                                                            <span class="text-xs">Baik</span>
                                                        </div>

                                                        <div class="col">
                                                            <input class="form-check-input" type="radio" value="Rusak" name="seragam1" id="seragam1_2"
                                                            {{ $karyawan->seragam1 == "Rusak" ? "checked" : ""}}>
                                                            <span class="text-xs">Rusak</span>
                                                        </div>

                                                        <div class="col">
                                                            <input class="form-check-input" type="radio" value="Belum Dapat" name="seragam1" id="seragam1_3" 
                                                            {{ $karyawan->seragam1 == "Belum Dapat" ? "checked" : ""}}>
                                                            <span class="text-xs">Belum Dapat</span>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <label class="text-xs">Seragam 2</label>
                                                        <div class="col">
                                                            <input class="form-check-input" type="radio" value="Baik" name="seragam2" id="seragam2_1"
                                                            {{ $karyawan->seragam2 == "Baik" ? "checked" : ""}}>
                                                            <span class="text-xs">Baik</span>
                                                        </div>

                                                        <div class="col">
                                                            <input class="form-check-input" type="radio" value="Rusak" name="seragam2" id="seragam2_2"
                                                            {{ $karyawan->seragam2 == "Rusak" ? "checked" : ""}}>
                                                            <span class="text-xs">Rusak</span>
                                                        </div>
                                                        
                                                        <div class="col">
                                                            <input class="form-check-input" type="radio" value="Belum Dapat" name="seragam2" id="seragam2_3"
                                                            {{ $karyawan->seragam1 == "Belum Dapat" ? "checked" : ""}}>
                                                            <span class="text-xs">Belum Dapat</span>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <label class="text-xs">Seragam 3</label>
                                                        <div class="col">
                                                            <input class="form-check-input" type="radio" value="Baik" name="seragam3" id="seragam3_1"
                                                            {{ $karyawan->seragam3 == "Baik" ? "checked" : ""}}>
                                                            <span class="text-xs">Baik</span>
                                                        </div>

                                                        <div class="col">
                                                            <input class="form-check-input" type="radio" value="Rusak" name="seragam3" id="seragam3_2"
                                                            {{ $karyawan->seragam3 == "Rusak" ? "checked" : ""}}>
                                                            <span class="text-xs">Rusak</span>
                                                        </div>
                                                        
                                                        <div class="col">
                                                            <input class="form-check-input" type="radio" value="Belum Dapat" name="seragam3" id="seragam3_3"
                                                            {{ $karyawan->seragam3 == "Belum Dapat" ? "checked" : ""}}>
                                                            <span class="text-xs">Belum Dapat</span>
                                                        </div>
                                                    </div>                                                    
                                                </div>

                                                
                                            </div>

                                            <div class="col">
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No Telepon/Hp</span>
                                                    <input class="form-control form-control-sm" id="noTelpKry"
                                                        name="noTelpKry" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->no_telp }}">
                                                </div>
                                                
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Alamat Lengkap</span>
                                                    <textarea class="form-control form-control-sm" id="alamat" name="alamat" style="border-color:#9ca0a7;">{{ $karyawan->alamat }}</textarea>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Status Pernikahan</span>
                                                        <select class="form-control form-control-sm"
                                                            id="statusPernikahan" name="statusPernikahan"
                                                            style="border-color:#9ca0a7;">
                                                            <option value=""></option>
                                                            <option value="Kawin"
                                                                {{ $karyawan->status_pernikahan == 'Kawin' ? 'selected' : '' }}>
                                                                Kawin</option>
                                                            <option value="Belum Kawin"
                                                                {{ $karyawan->status_pernikahan == 'Belum Kawin' ? 'selected' : '' }}>
                                                                Belum Kawin</option>
                                                            <option value="Cerai Hidup"
                                                                {{ $karyawan->status_pernikahan == 'Cerai Hidup' ? 'selected' : '' }}>
                                                                Cerai Hidup</option>
                                                            <option value="Cerai Mati"
                                                                {{ $karyawan->status_pernikahan == 'Cerai Mati' ? 'selected' : '' }}>
                                                                Cerai Mati</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Jml Tanggungan</span>
                                                        <input type="number" class="form-control form-control-sm"
                                                            id="jmlTanggungan" name="jmlTanggungan"
                                                            style="border-color:#9ca0a7;"
                                                            value="{{ $karyawan->jml_tanggungan }}">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Email Pribadi</span>
                                                    <input class="form-control form-control-sm" id="emailPribadi"
                                                        name="emailPribadi" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->email_pribadi }}">
                                                </div>
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Email Perusahaan</span>
                                                    <input class="form-control form-control-sm" id="emailPerusahaan"
                                                        name="emailPerusahaan" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->email }}">
                                                </div>
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Alamat Domisili</span>
                                                    <textarea class="form-control form-control-sm" id="alamatDomisili" name="alamatDomisili"
                                                        style="border-color:#9ca0a7;">{{ $karyawan->alamat_domisili }}</textarea>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Pendidikan Terakhir</span>
                                                        <select class="form-control form-control-sm"
                                                            id="pendidikanTerakhir" name="pendidikanTerakhir"
                                                            style="border-color:#9ca0a7;">
                                                            <option value=""></option>
                                                            <option value="SD"
                                                                {{ $karyawan->pendidikan_terakhir == 'SD' ? 'selected' : '' }}>
                                                                SD</option>
                                                            <option value="SMP"
                                                                {{ $karyawan->pendidikan_terakhir == 'SMP' ? 'selected' : '' }}>
                                                                SMP</option>
                                                            <option value="SMA"
                                                                {{ $karyawan->pendidikan_terakhir == 'SMA' ? 'selected' : '' }}>
                                                                SMA</option>
                                                            <option value="Diploma"
                                                                {{ $karyawan->pendidikan_terakhir == 'Diploma' ? 'selected' : '' }}>
                                                                Dimploma 3</option>
                                                            <option value="Strata 1"
                                                                {{ $karyawan->pendidikan_terakhir == 'Strata 1' ? 'selected' : '' }}>
                                                                Strata 1</option>
                                                            <option value="Strata 2"
                                                                {{ $karyawan->pendidikan_terakhir == 'Strata 2' ? 'selected' : '' }}>
                                                                Strata 2</option>
                                                            <option value="Doktor"
                                                                {{ $karyawan->pendidikan_terakhir == 'Doktor' ? 'selected' : '' }}>
                                                                Doktor</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Golongan Darah</span>
                                                        <select class="form-control form-control-sm" id="golonganDarah"
                                                            name="golonganDarah" style="border-color:#9ca0a7;">
                                                            <option value=""></option>
                                                            <option value="O"
                                                                {{ $karyawan->golongan_darah == 'O' ? 'selected' : '' }}>O
                                                            </option>
                                                            <option value="A"
                                                                {{ $karyawan->golongan_darah == 'A' ? 'selected' : '' }}>A
                                                            </option>
                                                            <option value="B"
                                                                {{ $karyawan->golongan_darah == 'B' ? 'selected' : '' }}>B
                                                            </option>
                                                            <option value="AB"
                                                                {{ $karyawan->golongan_darah == 'AB' ? 'selected' : '' }}>
                                                                AB
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane" id="KepesertaanEdit" role="tabpanel" aria-expanded="true">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No. NPWP</span>
                                                    <input class="form-control form-control-sm" id="noNPWP"
                                                        name="noNPWP" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->no_npwp }}">
                                                </div>

                                                {{-- <div class="form-group mb-1">
                                                    <span class="text-xs">No. Rekening Bank</span>
                                                    <input class="form-control form-control-sm" id="noRek"
                                                        name="noRek" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->no_rek }}">
                                                </div> --}}

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No. BPJS</span>
                                                    <input class="form-control form-control-sm" id="noBpjs"
                                                        name="noBpjs" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->no_bpjs }}">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No. Jamsostek</span>
                                                    <input class="form-control form-control-sm" id="noJamsostek"
                                                        name="noJamsostek" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->no_jamsostek }}">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No. Koperasi Karyawan</span>
                                                    <input class="form-control form-control-sm" id="noKoperasi"
                                                        name="noKoperasi" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->no_koperasi }}">
                                                </div>
                                            </div>

                                            <div class="col">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane" id="IdentitasKelEdit" role="tabpanel" aria-expanded="true">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                {{-- <dl class="dl-horizontal row"> --}}
                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Nama Pasangan</span>
                                                        <input class="form-control form-control-sm" id="namaKel"
                                                            name="namaKel" style="border-color:#9ca0a7;"
                                                            value="{{ $karyawan->nama_kel }}">
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Status Pasangan</span>
                                                        <input class="form-control form-control-sm" id="statusKel"
                                                            name="statusKel" style="border-color:#9ca0a7;"
                                                            value="{{ $karyawan->status_kel }}">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Alamat Domisili</span>
                                                    <textarea class="form-control form-control-sm" id="alamatKel" name="alamatKel" style="border-color:#9ca0a7;">{{ $karyawan->alamat_kel }}</textarea>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Pekerjaan</span>
                                                    <input class="form-control form-control-sm" id="pekerjaanKel"
                                                        name="pekerjaanKel" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->pekerjaan_kel }}">
                                                </div>
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No Telp</span>
                                                    <input class="form-control form-control-sm" id="noTelpKel"
                                                        name="noTelpKel" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->no_telp_kel }}">
                                                </div>

                                                {{-- </dl> --}}
                                            </div>

                                            <div class="col">
                                                {{-- <dl class="dl-horizontal row"> --}}
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Nama Anak 1</span>
                                                    <input class="form-control form-control-sm" id="anak1"
                                                        name="anak1" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->anak1 }}">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Nama Anak 2</span>
                                                    <input class="form-control form-control-sm" id="anak2"
                                                        name="anak2" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->anak2 }}">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Nama Anak 3</span>
                                                    <input class="form-control form-control-sm" id="anak3"
                                                        name="anak3" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->anak3 }}">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Nama Anak 4</span>
                                                    <input class="form-control form-control-sm" id="anak4"
                                                        name="anak4" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->anak4 }}">
                                                </div>

                                                {{-- </dl> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane" id="kontakDaruratEdit" role="tabpanel" aria-expanded="true">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                {{-- <dl class="dl-horizontal row"> --}}
                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Nama Kontak 1</span>
                                                        <input class="form-control form-control-sm" id="namaKontak1"
                                                            name="namaKontak1" style="border-color:#9ca0a7;"
                                                            value="{{ $karyawan->nama_kontak1 }}">
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Status</span>
                                                        <input class="form-control form-control-sm" id="statusKontak1"
                                                            name="statusKontak1" style="border-color:#9ca0a7;"
                                                            value="{{ $karyawan->status_kontak1 }}">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Alamat Domisili</span>
                                                    <textarea class="form-control form-control-sm" id="alamatKontak1" name="alamatKontak1"
                                                        style="border-color:#9ca0a7;">{{ $karyawan->alamat_kontak1 }}</textarea>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No Telepon/Hp</span>
                                                    <input class="form-control form-control-sm" id="noTelpKontak1"
                                                        name="noTelpKontak1" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->no_telp_kontak1 }}">
                                                </div>

                                                {{-- </dl> --}}
                                            </div>

                                            <div class="col">
                                                {{-- <dl class="dl-horizontal row"> --}}
                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Nama Kontak 2</span>
                                                        <input class="form-control form-control-sm" id="namaKontak2"
                                                            name="namaKontak2" style="border-color:#9ca0a7;"
                                                            value="{{ $karyawan->nama_kontak2 }}">
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Status</span>
                                                        <input class="form-control form-control-sm" id="statusKontak2"
                                                            name="statusKontak2" style="border-color:#9ca0a7;"
                                                            value="{{ $karyawan->status_kontak2 }}">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Alamat Domisili</span>
                                                    <textarea class="form-control form-control-sm" id="alamatKontak2" name="alamatKontak2"
                                                        style="border-color:#9ca0a7;">{{ $karyawan->alamat_kontak2 }}</textarea>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No Telepon/Hp</span>
                                                    <input class="form-control form-control-sm" id="noTelpKontak2"
                                                        name="noTelpKontak2" style="border-color:#9ca0a7;"
                                                        value="{{ $karyawan->no_telp_kontak2 }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            {{-- @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif --}}

                            <div class="col text-center">
                                <button type="submit" class="btn btn-sm btn-dark align-items-center updateKaryawan"
                                    id="updateKaryawan">Update Data</button>
                                <button type="button" value="close" class="btn btn-sm btn-dark align-items-center"
                                    data-bs-dismiss="modal">Batalkan</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                        {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Tambah Data --}}

    </main>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script
    src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-html5-3.1.0/fc-5.0.1/r-3.0.2/datatables.min.js">
</script>

<script>
    //message with sweetalert
    @if (session('success'))
        Swal.fire({
            icon: "success",
            title: "Berhasil",
            text: "{{ session('success') }}",
            showConfirmButton: true,
            // timer: 2000
        });
    @elseif (session('error'))
        Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: "{{ session('error') }}",
            showConfirmButton: true,
            // timer: 2000
        });
    @endif
</script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showFotoEdit').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#foto_karyawan").change(function() {
        readURL(this);
    });
</script>
