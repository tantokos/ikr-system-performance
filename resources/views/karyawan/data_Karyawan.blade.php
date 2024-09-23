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
                            <h3 class="text-white mb-2">Data Karyawan</h3>
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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleMonthly"></span></h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
                                    <button type="button"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                        data-bs-toggle="modal" data-bs-target="#tambahData">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Tambah Data</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="card-body px-2 py-2">

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="tabelDataKaryawan" style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headAbsenMonthly">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Nik</th>
                                            <th class="text-center text-xs font-weight-semibold">Nama Karyawan</th>
                                            <th class="text-center text-xs font-weight-semibold">Area</th>
                                            <th class="text-center text-xs font-weight-semibold">Divisi</th>
                                            <th class="text-center text-xs font-weight-semibold">Departemen</th>
                                            <th class="text-center text-xs font-weight-semibold">Posisi</th>
                                            <th class="text-center text-xs font-weight-semibold">Email</th>
                                            <th class="text-center text-xs font-weight-semibold">No Telpon</th>
                                            <th class="text-center text-xs font-weight-semibold">Alamat</th>
                                            <th class="text-center text-xs font-weight-semibold">Tempat Lahir</th>
                                            <th class="text-center text-xs font-weight-semibold">Tanggal Lahir</th>
                                            <th class="text-center text-xs font-weight-semibold">Jenis Kelamin</th>
                                            <th class="text-center text-xs font-weight-semibold">Agama</th>
                                            <th class="text-center text-xs font-weight-semibold">Tanggal Masuk</th>
                                            <th class="text-center text-xs font-weight-semibold">Status Pegawai</th>
                                            <th class="text-center text-xs font-weight-semibold">Status Active</th>
                                            <th class="text-center text-xs font-weight-semibold">Tanggal Keluar</th>
                                            <th class="text-center text-xs font-weight-semibold">No KTP</th>
                                            <th class="text-center text-xs font-weight-semibold">No NPWP</th>
                                            <th class="text-center text-xs font-weight-semibold">No Rekening</th>
                                            <th class="text-center text-xs font-weight-semibold">No BPJS</th>
                                            <th class="text-center text-xs font-weight-semibold">No Jamsostek</th>
                                            <th class="text-center text-xs font-weight-semibold">#</th>

                                        </tr>
                                    </thead>
                                    <tbody id="bodyAbsenMonthly">

                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <x-app.footer /> --}}
        </div>

        {{-- Modal Tambah Data --}}
        <div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Karyawan</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('simpankaryawan') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body px-2 py-2">
                                <div class="nav-wrapper position-relative end-0">
                                    <ul class="nav nav-tabs nav-fill p-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab"
                                                href="#DetailKry" role="tab" aria-controls="DetailKry"
                                                aria-selected="true">
                                                Detail Karyawan
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#Kepesertaan"
                                                role="tab" aria-controls="Kepesertaan" aria-selected="true">
                                                Kepesertaan
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                                href="#IdentitasKel" role="tab" aria-controls="IdentitasKel"
                                                aria-selected="false">
                                                Identitas Keluarga
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                                href="#kontakDarurat" role="tab" aria-controls="kontakDarurat"
                                                aria-selected="false">
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
                                                <div class="form-group mb-1 text-center">
                                                    <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                        id="showFoto" alt="Card Image"
                                                        style="width:160px;height: 160px;" />

                                                </div>
                                                <div class="form-group mb-1">
                                                    <input class="form-control form-control-sm" id="foto_karyawan"
                                                        name="foto_karyawan" type="file"
                                                        style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Nik Karyawan</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="nik" name="nik" style="border-color:#9ca0a7;"
                                                        required>
                                                    @error('nik')
                                                        <span class="text-xs text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Nama Karyawan</span>
                                                    <input class="form-control form-control-sm" id="namaKaryawan"
                                                        name="namaKaryawan" style="border-color:#9ca0a7;" required>
                                                    @error('namaKaryawan')
                                                        <span class="text-xs text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Tanggal Bergabung</span>
                                                        <Input class="form-control form-control-sm" type="date"
                                                            id="tglGabung" name="tglGabung"
                                                            style="border-color:#9ca0a7;">
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Status Pegawai</span>
                                                        <select class="form-control form-control-sm"
                                                            id="statusPegawai" name="statusPegawai"
                                                            style="border-color:#9ca0a7;">
                                                            <option value="Kontrak">Kontrak</option>
                                                            <option value="Tetap">Tetap</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Status Karyawan</span>
                                                        <select class="form-control form-control-sm"
                                                            id="statusKaryawan" name="statusKaryawan"
                                                            style="border-color:#9ca0a7;">
                                                            <option value="Aktif">Aktif</option>
                                                            <option value="Tidak Aktif">Tidak Aktif</option>

                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Tanggal Keluar</span>
                                                        <Input class="form-control form-control-sm" type="date"
                                                            id="tglKeluar" name="tglKeluar"
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
                                                                <option value="{{ $listArea->id }}">
                                                                    {{ $listArea->nama_branch }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Divisi</span>
                                                        <select class="form-control form-control-sm" id="divisi"
                                                            name="divisi" style="border-color:#9ca0a7;">
                                                            <option value="IKR">IKR</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Departemen</span>
                                                        <select class="form-control form-control-sm" id="departemen"
                                                            name="departemen" style="border-color:#9ca0a7;">
                                                            <option value="FTTH">FTTH</option>
                                                            <option value="FTTX/FTTB">FTTX/FTTB</option>
                                                            <option value="Dokumen Kontrol">Dokumen Kontrol</option>
                                                            <option value="Traffic">Traffic</option>
                                                            <option value="System IKR">System IKR</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Posisi</span>
                                                        <select class="form-control form-control-sm" id="posisi"
                                                            name="posisi" style="border-color:#9ca0a7;">
                                                            <option value="Installer">Installer</option>
                                                            <option value="Maintenance">Maintenance</option>
                                                            <option value="Leader Instalasi FTTH">Leader Instalasi FTTH
                                                            </option>
                                                            <option value="Leader Maintenance FTTH">Leader Maintenance
                                                                FTTH
                                                            </option>
                                                            <option value="Leader FTTX/FTTB">Leader FTTX/FTTB</option>
                                                            <option value="Supervisor">Supervisor</option>
                                                            <option value="Staff">Staff</option>
                                                            <option value="Ast. Manager">Ast. Manager</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Tempat Lahir</span>
                                                        <input class="form-control form-control-sm" id="tmptLahir"
                                                            name="tmptLahir" style="border-color:#9ca0a7;">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-xs">Tanggal Lahir</span>
                                                        <Input class="form-control form-control-sm" type="date"
                                                            id="tglLahir" name="tglLahir"
                                                            style="border-color:#9ca0a7;">
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">No. KTP</span>
                                                        <input class="form-control form-control-sm" id="noKTP"
                                                            name="noKTP" style="border-color:#9ca0a7;">
                                                    </div>
                                                    <div class="col-4">
                                                        <span class="text-xs">Agama</span>
                                                        <select class="form-control form-control-sm" id="agama"
                                                            name="agama" style="border-color:#9ca0a7;">
                                                            <option value=""></option>
                                                            <option value="Islam">Islam</option>
                                                            <option value="Kristen">Kristen</option>
                                                            <option value="Hindu">Hindu</option>
                                                            <option value="Budha">Budha</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Jenis Kelamin</span>
                                                    <select class="form-control form-control-sm" id="jenisKelamin"
                                                        name="jenisKelamin" style="border-color:#9ca0a7;">
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Kewarganegaraan</span>
                                                    <input class="form-control form-control-sm" id="kewarganegaraan"
                                                        name="kewarganegaraan" style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No Telepon/Hp</span>
                                                    <input class="form-control form-control-sm" id="noTelpKry"
                                                        name="noTelpKry" style="border-color:#9ca0a7;">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Alamat Lengkap</span>
                                                    <textarea class="form-control form-control-sm" id="alamat" name="alamat" style="border-color:#9ca0a7;"></textarea>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Status Pernikahan</span>
                                                        <select class="form-control form-control-sm"
                                                            id="statusPernikahan" name="statusPernikahan"
                                                            style="border-color:#9ca0a7;">
                                                            <option value=""></option>
                                                            <option value="Kawin">Kawin</option>
                                                            <option value="Belum Kawin">Belum Kawin</option>
                                                            <option value="Cerai Hidup">Cerai Hidup</option>
                                                            <option value="Cerai Mati">Cerai Mati</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Jml Tanggungan</span>
                                                        <input type="number" class="form-control form-control-sm"
                                                            id="jmlTanggungan" name="jmlTanggungan"
                                                            style="border-color:#9ca0a7;">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Email Pribadi</span>
                                                    <input class="form-control form-control-sm" id="emailPribadi"
                                                        name="emailPribadi" style="border-color:#9ca0a7;">
                                                </div>
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Email Perusahaan</span>
                                                    <input class="form-control form-control-sm" id="emailPerusahaan"
                                                        name="emailPerusahaan" style="border-color:#9ca0a7;">
                                                </div>
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Alamat Domisili</span>
                                                    <textarea class="form-control form-control-sm" id="alamatDomisili" name="alamatDomisili"
                                                        style="border-color:#9ca0a7;"></textarea>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Pendidikan Terakhir</span>
                                                    <select class="form-control form-control-sm"
                                                        id="pendidikanTerakhir" name="pendidikanTerakhir"
                                                        style="border-color:#9ca0a7;">
                                                        <option value=""></option>
                                                        <option value="SD">SD</option>
                                                        <option value="SMP">SMP</option>
                                                        <option value="SMA">SMA</option>
                                                        <option value="Diploma">Dimploma 3</option>
                                                        <option value="Strata 1">Strata 1</option>
                                                        <option value="Strata 2">Strata 2</option>
                                                        <option value="Doktor">Doktor</option>
                                                    </select>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Golongan Darah</span>
                                                    <select class="form-control form-control-sm" id="golonganDarah"
                                                        name="golonganDarah" style="border-color:#9ca0a7;">
                                                        <option value=""></option>
                                                        <option value="O">O</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="AB">AB</option>
                                                    </select>
                                                </div>
                                                {{-- </dl> --}}
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
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No. NPWP</span>
                                                    <input class="form-control form-control-sm" id="noNPWP"
                                                        name="noNPWP" style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No. Rekening Bank</span>
                                                    <input class="form-control form-control-sm" id="noRek"
                                                        name="noRek" style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No. BPJS</span>
                                                    <input class="form-control form-control-sm" id="noBpjs"
                                                        name="noBpjs" style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No. Jamsostek</span>
                                                    <input class="form-control form-control-sm" id="noJamsostek"
                                                        name="noJamsostek" style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No. Koperasi Karyawan</span>
                                                    <input class="form-control form-control-sm" id="noKoperasi"
                                                        name="noKoperasi" style="border-color:#9ca0a7;">
                                                </div>
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
                                                {{-- <dl class="dl-horizontal row"> --}}
                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Nama</span>
                                                        <input class="form-control form-control-sm" id="namaKel"
                                                            name="namaKel" style="border-color:#9ca0a7;">
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Status</span>
                                                        <input class="form-control form-control-sm" id="statusKel"
                                                            name="statusKel" style="border-color:#9ca0a7;">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Alamat Domisili</span>
                                                    <textarea class="form-control form-control-sm" id="alamatKel" name="alamatKel" style="border-color:#9ca0a7;"></textarea>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Pekerjaan</span>
                                                    <input class="form-control form-control-sm" id="pekerjaanKel"
                                                        name="pekerjaanKel" style="border-color:#9ca0a7;">
                                                </div>
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No Telp</span>
                                                    <input class="form-control form-control-sm" id="noTelpKel"
                                                        name="noTelpKel" style="border-color:#9ca0a7;">
                                                </div>

                                                {{-- </dl> --}}
                                            </div>

                                            <div class="col">
                                                {{-- <dl class="dl-horizontal row"> --}}
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Anak 1</span>
                                                    <input class="form-control form-control-sm" id="anak1"
                                                        name="anak1" style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Anak 2</span>
                                                    <input class="form-control form-control-sm" id="anak2"
                                                        name="anak2" style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Anak 3</span>
                                                    <input class="form-control form-control-sm" id="anak3"
                                                        name="anak3" style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Anak 4</span>
                                                    <input class="form-control form-control-sm" id="anak4"
                                                        name="anak4" style="border-color:#9ca0a7;">
                                                </div>

                                                {{-- </dl> --}}
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
                                                {{-- <dl class="dl-horizontal row"> --}}
                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Nama Kontak 1</span>
                                                        <input class="form-control form-control-sm" id="namaKontak1"
                                                            name="namaKontak1" style="border-color:#9ca0a7;">
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Status</span>
                                                        <input class="form-control form-control-sm" id="statusKontak1"
                                                            name="statusKontak1" style="border-color:#9ca0a7;">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Alamat Domisili</span>
                                                    <textarea class="form-control form-control-sm" id="alamatKontak1" name="alamatKontak1"
                                                        style="border-color:#9ca0a7;"></textarea>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No Telepon/Hp</span>
                                                    <input class="form-control form-control-sm" id="noTelpKontak1"
                                                        name="noTelpKontak1" style="border-color:#9ca0a7;">
                                                </div>

                                                {{-- </dl> --}}
                                            </div>

                                            <div class="col">
                                                {{-- <dl class="dl-horizontal row"> --}}
                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Nama Kontak 2</span>
                                                        <input class="form-control form-control-sm" id="namaKontak2"
                                                            name="namaKontak2" style="border-color:#9ca0a7;">
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Status</span>
                                                        <input class="form-control form-control-sm" id="statusKontak2"
                                                            name="statusKontak2" style="border-color:#9ca0a7;">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Alamat Domisili</span>
                                                    <textarea class="form-control form-control-sm" id="alamatKontak2" name="alamatKontak2"
                                                        style="border-color:#9ca0a7;"></textarea>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No Telepon/Hp</span>
                                                    <input class="form-control form-control-sm" id="noTelpKontak2"
                                                        name="noTelpKontak2" style="border-color:#9ca0a7;">
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
                                <button type="submit" class="btn btn-sm btn-dark align-items-center simpanKaryawan"
                                    id="simpanKaryawan">Simpan Data</button>
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

        {{-- <script>
            $('#simpanKaryawan').click(function(e) {
                e.prevenDefault();

                let nik= $('#nik').val();
                let namaKaryawan= $('#namaKaryawan').val();
                let alamat= $('#alamat').val();
                let tmptLahir= $('#tmptLahir').val();
                let tglLahir= $('#tglLahir').val();
                let jenisKelamin= $('#jenisKelamin').val();
                let agama= $('#agama').val();
                let noTelp= $('#noTelp').val();
                let tglGabung= $('#tglGabung').val();
                let statusPegawai= $('#statusPegawai').val();
                let statusKaryawan= $('#statusKaryawan').val();
                let tglKeluar= $('#tglKeluar').val();
                let area= $('#area').val();
                let divisi= $('#divisi').val();
                let departemen= $('#departemen').val();
                let posisi= $('#posisi').val();
                let email= $('#email').val();
                let noKTP= $('#noKTP').val();
                let noNPWP= $('#noNPWP').val();
                let noRek= $('#noRek').val();
                let noBpjs= $('#noBpjs').val();
                let noJamsostek= $('#noJamsostek').val();
            })

        </script> --}}


    </main>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script
    src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-html5-3.1.0/fc-5.0.1/r-3.0.2/datatables.min.js">
</script>

@if (count($errors) > 0)
    <script>
        Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: "{{ $errors }}",
            showConfirmButton: true,
            // timer: 2000
        }).then((result) => {
            $(document).ready(function() {
                $('#tambahData').modal('show');
            });
        })
    </script>
@endif

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
                $('#showFoto').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#foto_karyawan").change(function() {
        readURL(this);
    });
</script>

<script>
    $(document).ready(function() {

        var _token = $('meta[name=csrf-token]').attr('content');
        var firstDate;
        var lastDate;
        akses = $('#akses').val();
        data_absen()



        function data_absen() {
            $('#tabelDataKaryawan').DataTable({
                // dom: 'Bftip',
                layout: {
                    topStart: {
                        buttons: ['excel']
                    },
                },
                paging: true,
                orderClasses: false,
                fixedColumns: true,

                fixedColumns: {
                    leftColumns: 3,
                    // rightColumns: 1
                },
                deferRender: true,
                scrollCollapse: true,
                scrollX: true,
                pageLength: 10,
                lengthChange: false,
                bFilter: true,
                destroy: true,
                processing: true,
                serverSide: false,
                ajax: {
                    url: "{{ route('getDataKaryawan') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        akses: akses,
                        _token: _token
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_Row_Index',
                        "className": "text-center",
                        // orderable: false,
                        searchable: false,
                        "width": '20'
                    },
                    {
                        data: 'nik_karyawan',
                        width: '90'
                    },
                    {
                        data: 'nama_karyawan'
                    },
                    {
                        data: 'nama_branch'
                    },

                    {
                        data: 'divisi'
                    },
                    {
                        data: 'departement'
                    },
                    {
                        data: 'posisi'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'no_telp'
                    },
                    {
                        data: 'alamat'
                    },
                    {
                        data: 'tempat_lahir'
                    },
                    {
                        data: 'tgl_lahir'
                    },
                    {
                        data: 'jenis_kelamin'
                    },
                    {
                        data: 'agama'
                    },
                    {
                        data: 'tgl_gabung'
                    },
                    {
                        data: 'status_pegawai'
                    },
                    {
                        data: 'status_active'
                    },
                    {
                        data: 'tgl_nonactive'
                    },
                    {
                        data: 'no_ktp'
                    },
                    {
                        data: 'no_npwp'
                    },
                    {
                        data: 'no_rek'
                    },
                    {
                        data: 'no_bpjs'
                    },
                    {
                        data: 'no_jamsostek'
                    },
                    {
                        data: 'action'
                    },
                ]
            })
        }
    })
</script>
