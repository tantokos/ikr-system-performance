<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-2 mb-3">
                        <div class="full-background" style="background: linear-gradient(to right, #112133, #21416d);">
                        </div>
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">Data Seragam IKR</h3>
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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Rekap Data Seragam</span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
                                    <button type="button"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                        data-bs-toggle="modal" data-bs-target="#tambahPenerimaan">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Tambah Data Penerimaan</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="card-body px-2 py-2">

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0" id="tabelPenerimaan"
                                    style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headPenerimaan">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Posisi</th>
                                            <th class="text-center text-xs font-weight-semibold">Branch</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">Leader</th> --}}
                                            {{-- <th class="text-center text-xs font-weight-semibold">Callsign Tim</th> --}}
                                            <th class="text-center text-xs font-weight-semibold">ID Card</th>
                                            <th class="text-center text-xs font-weight-semibold">Seragam</th>
                                            <th class="text-center text-xs font-weight-semibold">Status</th>
                                            <th class="text-center text-xs font-weight-semibold">#</th>

                                        </tr>
                                    </thead>
                                    <tbody id="bodyPenerimaan">

                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">

                            </div>
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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">List Data</span>
                                    </h6>
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
                                <table class="table table-striped table-bordered align-items-center mb-0" id="tabelData"
                                    style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Nama Karyawan</th>
                                            <th class="text-center text-xs font-weight-semibold">Branch</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">Leader</th> --}}
                                            {{-- <th class="text-center text-xs font-weight-semibold">Callsign Tim</th> --}}
                                            <th class="text-center text-xs font-weight-semibold">ID Card</th>
                                            <th class="text-center text-xs font-weight-semibold">Seragam</th>
                                            <th class="text-center text-xs font-weight-semibold">Status</th>
                                            <th class="text-center text-xs font-weight-semibold">#</th>

                                        </tr>
                                    </thead>
                                    <tbody id="bodyTool">

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

        {{-- Modal Tambah Data Penerimaan Seragam --}}
        <div class="modal fade" id="tambahPenerimaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penerimaan Seragam</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('simpanSeragam')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Tgl Penerimaan Seragam</span>
                                                    <input class="form-control form-control-sm" type="date"
                                                        value="{{ date('Y-m-d') }}" id="tglPenerimaanShow"
                                                        name="tglPenerimaanShow" style="border-color:#9ca0a7;">
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Nik Penerima Seragam</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="nikpenerima" name="nikpenerima" style="border-color:#9ca0a7;"
                                                    value="{{ isset($login) ? $login->nik_karyawan : "" }}" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Nama Penerima</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namapenerima" name="namapenerima" style="border-color:#9ca0a7;"
                                                    value="{{ isset($login) ? $login->nama_karyawan : "" }}" readonly>
                                            </div>

                                            <div class="row form-group mb-1">
                                                <div class="col">
                                                <span class="text-xs">Departemen</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="departemen" name="departemen" style="border-color:#9ca0a7;"
                                                    value="{{ isset($login) ? $login->departement : "" }}" readonly>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Posisi</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="posisi" name="posisi" style="border-color:#9ca0a7;"
                                                        value="{{ isset($login) ? $login->posisi : "" }}" readonly>
                                                    </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Branch</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namaBranch" name="namaBranch" style="border-color:#9ca0a7;"
                                                    value="{{ isset($login) ? $login->nama_branch : "" }}" readonly>
                                            </div>

                                        </div>
                                        
                                        <div class="col">

                                            <div class="row form-group mb-1">
                                                <div class="col">
                                                    <span class="text-xs">Ukuran Seragam</span>
                                                    <input value="S" type="text" class="form-control form-control-sm" id="ukuranS"
                                                        name="ukuranS" style="border-color:#9ca0a7;" readonly>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Kondisi</span>
                                                    <select class="form-control form-control-sm" id="kondisiS"
                                                        name="kondisiS" style="border-color:#9ca0a7;">
                                                        {{-- <option value="">Pilih Kondisi</option> --}}
                                                        <option value="Baik">Baik</option>
                                                        <option value="Rusak">Rusak</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Jml</span>
                                                    <input type="number" class="form-control form-control-sm" id="jmlS" value="0"
                                                        name="jmlS" style="border-color:#9ca0a7;">
                                                </div>
                                            </div>

                                            <div class="row form-group mb-1">
                                                <div class="col">
                                                    <span class="text-xs">Ukuran Seragam</span>
                                                    <input value="M" type="text" class="form-control form-control-sm" id="ukuranM"
                                                        name="ukuranM" style="border-color:#9ca0a7;" readonly>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Kondisi</span>
                                                    <select class="form-control form-control-sm" id="kondisiM"
                                                        name="kondisiM" style="border-color:#9ca0a7;">
                                                        {{-- <option value="">Pilih Kondisi</option> --}}
                                                        <option value="Baik">Baik</option>
                                                        <option value="Rusak">Rusak</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Jml</span>
                                                    <input type="number" class="form-control form-control-sm" id="jmlM" value="0"
                                                        name="jmlM" style="border-color:#9ca0a7;">
                                                </div>
                                            </div>

                                            <div class="row form-group mb-1">
                                                <div class="col">
                                                    <span class="text-xs">Ukuran Seragam</span>
                                                    <input value="L" type="text" class="form-control form-control-sm" id="ukuranL"
                                                        name="ukuranL" style="border-color:#9ca0a7;" readonly>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Kondisi</span>
                                                    <select class="form-control form-control-sm" id="kondisiL"
                                                        name="kondisiL" style="border-color:#9ca0a7;">
                                                        {{-- <option value="">Pilih Kondisi</option> --}}
                                                        <option value="Baik">Baik</option>
                                                        <option value="Rusak">Rusak</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Jml</span>
                                                    <input type="number" class="form-control form-control-sm" id="jmlL" value="0"
                                                        name="jmlL" style="border-color:#9ca0a7;">
                                                </div>
                                            </div>

                                            <div class="row form-group mb-1">
                                                <div class="col">
                                                    <span class="text-xs">Ukuran Seragam</span>
                                                    <input value="XL" type="text" class="form-control form-control-sm" id="ukuranXL"
                                                        name="ukuranXL" style="border-color:#9ca0a7;" readonly>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Kondisi</span>
                                                    <select class="form-control form-control-sm" id="kondisiXL"
                                                        name="kondisiXL" style="border-color:#9ca0a7;">
                                                        {{-- <option value="">Pilih Kondisi</option> --}}
                                                        <option value="Baik">Baik</option>
                                                        <option value="Rusak">Rusak</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Jml</span>
                                                    <input type="number" class="form-control form-control-sm" id="jmlXL" value="0"
                                                        name="jmlXL" style="border-color:#9ca0a7;">
                                                </div>
                                            </div>

                                            <div class="row form-group mb-1">
                                                <div class="col">
                                                    <span class="text-xs">Ukuran Seragam</span>
                                                    <input value="XXL" type="text" class="form-control form-control-sm" id="ukuranXXL"
                                                        name="ukuranXXL" style="border-color:#9ca0a7;" readonly>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Kondisi</span>
                                                    <select class="form-control form-control-sm" id="kondisiXXL"
                                                        name="kondisiXXL" style="border-color:#9ca0a7;">
                                                        {{-- <option value="">Pilih Kondisi</option> --}}
                                                        <option value="Baik">Baik</option>
                                                        <option value="Rusak">Rusak</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Jml</span>
                                                    <input type="number" class="form-control form-control-sm" id="jmlXXL" value="0"
                                                        name="jmlXXL" style="border-color:#9ca0a7;">
                                                </div>
                                            </div>

                                            <div class="row form-group mb-1">
                                                <div class="col">
                                                    <span class="text-xs">Ukuran Seragam</span>
                                                    <input value="XXXL" type="text" class="form-control form-control-sm" id="ukuranXXXL"
                                                        name="ukuranXXXL" style="border-color:#9ca0a7;" readonly>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Kondisi</span>
                                                    <select class="form-control form-control-sm" id="kondisiXXXL"
                                                        name="kondisiXXXL" style="border-color:#9ca0a7;">
                                                        {{-- <option value="">Pilih Kondisi</option> --}}
                                                        <option value="Baik">Baik</option>
                                                        <option value="Rusak">Rusak</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Jml</span>
                                                    <input type="number" class="form-control form-control-sm" id="jmlXXXL" value="0"
                                                        name="jmlXXXL" style="border-color:#9ca0a7;">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <span class="text-xs">Foto Penerimaan Seragam</span>
                                            
                                            <div class="form-group mb-1 text-center">

                                                <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                    id="showgambar" alt="Card Image"
                                                    style="width:200px;height: 200px;" />
                                            </div>

                                            <div class="form-group mb-1">
                                                <input class="form-control form-control-sm" id="fotoSeragam"
                                                    name="fotoSeragam" type="file" style="border-color:#9ca0a7;">
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Keterangan</span>
                                                <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" style="border-color:#9ca0a7;"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center mb-1">
                                <div class="col">
                                    <button type="submit"
                                        class="btn btn-sm btn-dark align-items-center simpanSeragam"
                                        id="simpanSeragam">Simpan Data</button>
                                    <button type="button" value="close"
                                        class="btn btn-sm btn-dark align-items-center"
                                        data-bs-dismiss="modal">Batalkan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="modal-footer"> --}}
                    {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                    {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        {{-- End Modal Tambah Penerimaan Seragam --}}

        {{-- Modal Tambah Data Tool --}}
        <div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kelengkapan Karyawan</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Branch</span>
                                                <select class="form-control form-control-sm"
                                                    id="branch" name="branch" style="border-color:#9ca0a7;"
                                                    required>
                                                    <option value="">Pilih Branch</option>
                                                    @if (isset($area))
                                                        @foreach ($area as $branch )
                                                            <option value="{{ $branch->id . "|" . $branch->nama_branch }}">{{ $branch->nama_branch}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                {{-- <div class="row"> --}}
                                                    {{-- <div class="col form-group mb-1"> --}}
                                                        <span class="text-xs">Nama Karyawan</span>
                                                        <select class="form-control form-control-sm"
                                                            id="nama_karyawan" name="nama_karyawan" style="border-color:#9ca0a7;"
                                                            required>
                                                            <option value="">Pilih Karyawan</option>
                                                        </select>
                                                    {{-- </div> --}}

                                                {{-- </div> --}}
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">NIK Karyawan</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="nik_karyawan" name="nik_karyawan" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                            <div class="row form-group mb-1">
                                                <div class="col">
                                                <span class="text-xs">Departemen</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="departemen" name="departemen" style="border-color:#9ca0a7;"
                                                    value="{{ isset($login) ? $login->departement : "" }}" readonly>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Posisi</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="posisi" name="posisi" style="border-color:#9ca0a7;"
                                                        value="{{ isset($login) ? $login->posisi : "" }}" readonly>
                                                    </div>
                                            </div>

                                        </div>

                                        <div class="col">
                                            
                                            <div class="row form-group mb-1">
                                                <div class="col">
                                                    <span class="text-xs">Tgl Penyerahan ID Card</span>
                                                    <input class="form-control form-control-sm" type="date"
                                                        value="{{ date('Y-m-d') }}" id="tglPenerimaanShow"
                                                        name="tglPenerimaanShow" style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Kondisi ID Card</span>
                                                    <select class="form-control form-control-sm" id="kondisiID"
                                                        name="kondisiID" style="border-color:#9ca0a7;">
                                                        <option value="">Pilih Kondisi</option>
                                                        <option value="Baik">Baik</option>
                                                        <option value="Rusak">Rusak</option>
                                                        <option value="Hilang">Hilang</option>
                                                        <option value="Belum Dapat">Belum Dapat</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-group mb-1">

                                                <div class="col">
                                                    <span class="text-xs">Tgl Penyerahan Seragam</span>
                                                    <input class="form-control form-control-sm" type="date"
                                                        value="{{ date('Y-m-d') }}" id="tglPenerimaanShow"
                                                        name="tglPenerimaanShow" style="border-color:#9ca0a7;">
                                                </div>

                                                {{-- <div class="col">
                                                    <span class="text-xs">Ukuran Seragam</span>
                                                    <select class="form-control form-control-sm" id="kondisiID"
                                                        name="kondisiID" style="border-color:#9ca0a7;">
                                                        <option value="">Pilih Ukuran</option>
                                                        <option value="S">S</option>
                                                        <option value="M">M</option>
                                                        <option value="L">L</option>
                                                        <option value="XL">XL</option>
                                                        <option value="XXL">XXL</option>
                                                        <option value="XXXL">XXXL</option>
                                                    </select>
                                                </div> --}}
                                            </div>

                                            <div class="row form-group mb-1">
                                                <div class="col">
                                                    <span class="text-xs">Ukuran Seragam</span>
                                                    <select class="form-control form-control-sm" id="kondisiID"
                                                        name="kondisiID" style="border-color:#9ca0a7;">
                                                        <option value="">Pilih Ukuran</option>
                                                        <option value="S">S</option>
                                                        <option value="M">M</option>
                                                        <option value="L">L</option>
                                                        <option value="XL">XL</option>
                                                        <option value="XXL">XXL</option>
                                                        <option value="XXXL">XXXL</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Kondisi Seragam 1</span>
                                                    <select class="form-control form-control-sm" id="kondisiID"
                                                        name="kondisiID" style="border-color:#9ca0a7;">
                                                        <option value="">Pilih Kondisi</option>
                                                        <option value="Baik">Baik</option>
                                                        <option value="Rusak">Rusak</option>
                                                        <option value="Hilang">Hilang</option>
                                                        <option value="Belum Dapat">Belum Dapat</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-group mb-1">
                                                <div class="col">
                                                    <span class="text-xs">Kondisi Seragam 2</span>
                                                    <select class="form-control form-control-sm" id="kondisiID"
                                                        name="kondisiID" style="border-color:#9ca0a7;">
                                                        <option value="">Pilih Kondisi</option>
                                                        <option value="Baik">Baik</option>
                                                        <option value="Rusak">Rusak</option>
                                                        <option value="Hilang">Hilang</option>
                                                        <option value="Belum Dapat">Belum Dapat</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <span class="text-xs">Kondisi Seragam 3</span>
                                                    <select class="form-control form-control-sm" id="kondisiID"
                                                        name="kondisiID" style="border-color:#9ca0a7;">
                                                        <option value="">Pilih Kondisi</option>
                                                        <option value="Baik">Baik</option>
                                                        <option value="Rusak">Rusak</option>
                                                        <option value="Hilang">Hilang</option>
                                                        <option value="Belum Dapat">Belum Dapat</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        {{-- <div class="col">
                                            <div class="form-group mb-1">
                                                <span class="text-xs">Nik Penerima Tool</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="nikpenerima" name="nikpenerima" style="border-color:#9ca0a7;"
                                                    value="{{ isset($login) ? $login->nik_karyawan : "" }}" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Nama Penerima</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namapenerima" name="namapenerima" style="border-color:#9ca0a7;"
                                                    value="{{ isset($login) ? $login->nama_karyawan : "" }}" readonly>
                                            </div>

                                            

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Branch</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namaBranch" name="namaBranch" style="border-color:#9ca0a7;"
                                                    value="{{ isset($login) ? $login->nama_branch : "" }}" readonly>
                                            </div>

                                        </div> --}}

                                        {{-- <div class="col">
                                            <span class="text-xs">Foto </span>
                                            <div class="form-group mb-1 text-center">

                                                <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                    id="showgambar" alt="Card Image"
                                                    style="width:200px;height: 200px;" />
                                            </div>

                                            <div class="form-group mb-1">
                                                <input class="form-control form-control-sm" id="fotoTool"
                                                    name="fotoTool" type="file" style="border-color:#9ca0a7;">
                                            </div>



                                        </div> --}}
                                    </div>


                                </div>
                            </div>
                            <hr>
                            <div class="row text-center mb-1">
                                <div class="col">
                                    <button type="submit"
                                        class="btn btn-sm btn-dark align-items-center simpanKaryawan"
                                        id="simpanKaryawan">Simpan Data</button>
                                    <button type="button" value="close"
                                        class="btn btn-sm btn-dark align-items-center"
                                        data-bs-dismiss="modal">Batalkan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="modal-footer"> --}}
                    {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                    {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        {{-- End Modal Tambah Data Tool --}}

        {{-- Modal Show Detail Data Tool --}}
        <div class="modal fade" id="ShowTool" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Data Tool</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <input class="form-control form-control-sm" type="hidden"
                                                    id="namaToolShowId" name="namaToolShowId" readonly>

                                                <span class="text-xs">Nama Tool</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namaToolShow" name="namaToolShow"
                                                    style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Merk</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="merkShow" name="merkShow" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Satuan</span>
                                                <select class="form-control form-control-sm" id="satuanShow"
                                                    name="satuanShow" style="border-color:#9ca0a7;" disabled>
                                                    <option value="">Pilih Satuan</option>
                                                    <option value="Unit">Unit</option>
                                                    <option value="Pcs">Pcs</option>
                                                    <option value="Set">Set</option>

                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Spesifikasi</span>
                                                <textarea class="form-control form-control-sm" id="spesifikasiShow" name="spesifikasiShow"
                                                    style="border-color:#9ca0a7;" readonly></textarea>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group mb-1">
                                                <span class="text-xs">Tanggal Penerimaan Tool</span>
                                                <input class="form-control form-control-sm" type="date"
                                                    value="{{ date('Y-m-d') }}" id="tglPenerimaanShow"
                                                    name="tglPenerimaanShow" style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kondisi</span>
                                                <select class="form-control form-control-sm" id="kondisiShow"
                                                    name="kondisiShow" style="border-color:#9ca0a7;" disabled>
                                                    <option value="">Pilih Kondisi</option>
                                                    <option value="Baik">Baik</option>
                                                    <option value="Rusak">Rusak</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kode Aset</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="kodeAsetShow" name="kodeAsetShow"
                                                    style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kode GA</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="kodeGAShow" name="kodeGAShow" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <div class="form-group mb-1">
                                                <span class="text-xs">Nik Penerima Tool</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="nikpenerimaShow" name="nikpenerimaShow" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Nama Penerima</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namapenerimaShow" name="namapenerimaShow" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                            <div class="row form-group mb-1">
                                                <div class="col">
                                                <span class="text-xs">Departemen</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="departemenShow" name="departemenShow" style="border-color:#9ca0a7;"
                                                    readonly>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Posisi</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="posisiShow" name="posisiShow" style="border-color:#9ca0a7;"
                                                        readonly>
                                                    </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Branch</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namaBranchShow" name="namaBranchShow" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <span class="text-xs">Foto Tool</span>
                                            <div class="form-group mb-1 text-center">

                                                <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                    id="showgambarShow" alt="Card Image"
                                                    style="width:200px;height: 200px;" />
                                            </div>

                                            <div class="form-group mb-1">
                                                <input class="form-control form-control-sm" id="fotoToolShow"
                                                    name="fotoToolShow" type="file" style="border-color:#9ca0a7;"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <p>Riwayat Tool</p>
                            </div>

                            <div class="row">
                                <div class="table-responsive p-0">
                                    <table class="table table-striped table-bordered align-items-center mb-0"
                                        id="tabelRiwayatTool" style="font-size: 12px">
                                        <thead class="bg-gray-100">
                                            <tr id="headShowTool">
                                                <th class="text-xs font-weight-semibold">#</th>
                                                <th class="text-center text-xs font-weight-semibold">Tanggal</th>
                                                <th class="text-center text-xs font-weight-semibold">Status</th>
                                                <th class="text-center text-xs font-weight-semibold">Callsign Tim</th>
                                                <th class="text-center text-xs font-weight-semibold">Leader</th>
                                                <th class="text-center text-xs font-weight-semibold">Teknisi 1</th>
                                                <th class="text-center text-xs font-weight-semibold">Teknisi 2</th>
                                                <th class="text-center text-xs font-weight-semibold">Teknisi 3</th>
                                                <th class="text-center text-xs font-weight-semibold">Teknisi 4</th>
                                                <th class="text-center text-xs font-weight-semibold">Kondisi</th>
                                                <th class="text-center text-xs font-weight-semibold">#</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyShowTool">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center mb-1">
                                <div class="col ">
                                    {{-- <button type="submit" class="btn btn-sm btn-dark align-items-center showSimpan"
                                        id="showSimpan">Simpan Data</button> --}}
                                    <button type="button" value="close"
                                        class="btn btn-sm btn-dark align-items-center"
                                        data-bs-dismiss="modal">Kembali</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="modal-footer"> --}}
                    {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                    {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        {{-- End Modal Show Detail Tool --}}

        {{-- Modal Show Detail Riwayat Distribusi Tool --}}
        <div class="modal fade" id="showRiwayatDistribusi" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Distribusi Tool</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="{{ route('simpanDistribusi') }}" method="post" enctype="multipart/form-data"> --}}
                        {{-- @csrf --}}
                        <div class="row">
                            <div class="col">

                                <div class="form-group mb-1">
                                    <span class="text-xs">Lead Callsign</span>
                                    <input type="text" class="form-control form-control-sm"
                                        id="LeadCallsignTimShow" name="LeadCallsignTimShow"
                                        style="border-color:#9ca0a7;" readonly>
                                    <input type="hidden" id="leadCallsignShow" name="leadCallsignShow" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Nama Leader</span>
                                    <input class="form-control form-control-sm" type="text" id="leaderTimShow"
                                        name="leaderTimShow" style="border-color:#9ca0a7;" readonly>
                                    <input type="hidden" id="leaderidShow" name="leaderidShow" readonly>
                                </div>


                                <div class="form-group mb-1">
                                    <span class="text-xs">Posisi</span>
                                    <input class="form-control form-control-sm" type="text" id="posisiTimShow"
                                        name="posisiTimShow" style="border-color:#9ca0a7;" readonly>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group mb-1">
                                    <span class="text-xs">Callsign Tim</span>
                                    <input class="form-control form-control-sm" type="text" id="callsignTimidShow"
                                        name="callsignTimidShow" style="border-color:#9ca0a7;" readonly>
                                    <input type="hidden" id="callsignTimShow" name="callsignTim">
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 1</span>
                                    <input id="teknisi1NkShow" name="teknisi1NkShow" type="hidden" readonly>
                                    <input type="text" class="form-control form-control-sm" id="teknisi1Show"
                                        name="teknisi1Show" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 3</span>
                                    <input id="teknisi3NkShow" name="teknisi3NkShow" type="hidden" readonly>
                                    <input type="text" class="form-control form-control-sm" id="teknisi3Show"
                                        name="teknisi3Show" style="border-color:#9ca0a7;" readonly>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group mb-1">
                                    <span class="text-xs">Area</span>
                                    <input class="form-control form-control-sm" type="text" id="areaTimShow"
                                        name="areaTimShow" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 2</span>
                                    <input id="teknisi2NkShow" name="teknisi2NkShow" type="hidden" readonly>
                                    <input type="text" class="form-control form-control-sm" id="teknisi2Show"
                                        name="teknisi2Show" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 4</span>
                                    <input id="teknisi4NkShow" name="teknisi4NkShow" type="hidden" readonly>
                                    <input type="text" class="form-control form-control-sm" id="teknisi4Show"
                                        name="teknisi4Show" style="border-color:#9ca0a7;" readonly>
                                </div>
                            </div>

                            <hr>
                            {{-- </div>1 --}}

                            {{-- <div class="row">1 --}}
                            <div class="col">
                                {{-- <div class="form-group mb-1"> --}}
                                {{-- <span class="text-xs">Pilih Tool</span> --}}
                                {{-- <div class="input-group"> --}}
                                {{-- <input class="form-control form-control-sm" type="text" id="pilihToolShow" --}}
                                {{-- name="pilihToolShow" style="border-color:#9ca0a7;" readonly> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}

                                <div class="form-group mb-1">
                                    <span class="text-xs">Nama Tool</span>
                                    <input class="form-control form-control-sm" type="text" id="namaToolShowDis"
                                        name="namaToolShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Merk</span>
                                    <input class="form-control form-control-sm" type="text" id="merkShowDis"
                                        name="merkShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Satuan</span>
                                    <input type="text" class="form-control form-control-sm" id="satuanShowDis"
                                        name="satuanShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                    <span class="text-xs">Spesifikasi</span>
                                    <textarea class="form-control form-control-sm" id="spesifikasiShowDis" name="spesifikasiShowDis"
                                        style="border-color:#9ca0a7;" readonly></textarea>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-1">
                                    <span id="txDisPenerimaan" class="text-xs">Tanggal Penerimaan
                                        Tool</span>
                                    <input class="form-control form-control-sm" type="date"
                                        value="{{ date('Y-m-d') }}" id="tglPenerimaanShowDis"
                                        name="tglPenerimaanShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span id="txTglDistribusi" class="text-xs">Tanggal Distribusi Tool</span>
                                    <input class="form-control form-control-sm" type="date"
                                        value="{{ date('Y-m-d') }}" id="tglDistribusiShowDis"
                                        name="tglDistribusiShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>



                                <div class="form-group mb-1">
                                    <span class="text-xs">Kondisi</span>
                                    <input type="text" class="form-control form-control-sm" id="kondisiShowDis"
                                        name="kondisiShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Kode Aset</span>
                                    <input class="form-control form-control-sm" type="text" id="kodeAsetShowDis"
                                        name="kodeAsetShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Kode GA</span>
                                    <input class="form-control form-control-sm" type="text" id="kodeGAShowDis"
                                        name="kodeGAShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>

                            </div>

                            {{-- </div>1 --}}

                            {{-- <div class="row">2 --}}


                            {{-- <div class="col"> --}}
                            {{-- <span class="text-xs">Foto Data Tool</span> --}}
                            {{-- <div class="form-group mb-1 text-center"> --}}
                            {{-- <img src="{{ asset('assets/img/default-150x150.png') }}" id="showgambar" --}}
                            {{-- alt="Card Image" style="width:200px;height: 200px;" /> --}}
                            {{-- </div> --}}

                            {{-- <div class="form-group mb-1"> --}}
                            {{-- </div> --}}

                            {{-- <div class="form-group mb-1"> --}}
                            {{-- <span class="text-xs">Keterangan</span> --}}
                            {{-- <textarea class="form-control form-control-sm" id="keteranganShow" name="keteranganShow" --}}
                            {{-- style="border-color:#9ca0a7;" readonly></textarea> --}}
                            {{-- </div> --}}
                            {{-- </div> --}}

                            <div class="col">
                                <span class="text-xs">Foto Distribusi Tool</span>
                                <div class="form-group mb-1 text-center">
                                    <img src="{{ asset('assets/img/default-150x150.png') }}"
                                        id="showgambarDistribusiShow" alt="Card Image"
                                        style="width:200px;height: 200px;" />
                                </div>

                                {{-- <div class="form-group mb-1"> --}}
                                {{-- <input class="form-control form-control-sm" id="fotoToolDistribusi" --}}
                                {{-- name="fotoToolDistribusi" type="file" style="border-color:#9ca0a7;"> --}}
                                {{-- </div> --}}

                                <div class="form-group mb-1">
                                    {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                    <span class="text-xs">Keterangan</span>
                                    <textarea class="form-control form-control-sm" id="keteranganShow" name="keteranganShow"
                                        style="border-color:#9ca0a7;" readonly></textarea>
                                </div>
                            </div>
                            {{-- </div>2 --}}
                            <hr>
                            <div class="row text-center mb-1">
                                <div class="col">
                                    <button type="button" value="close"
                                        class="btn btn-sm btn-dark align-items-center"
                                        data-bs-dismiss="modal">Kembali</button>
                                </div>
                            </div>
                        </div>
                        {{-- </form> --}}
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                        {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Show Detail Riwayat Distribusi Tool --}}

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

    @if (session()->get('errors'))
        Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: "{{ session()->get('errors')->first() }}",
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
                $('#showgambar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fotoSeragam").change(function() {
        readURL(this);
    });
</script>

<script>
    $(document).ready(function() {

        var _token = $('meta[name=csrf-token]').attr('content');
        var firstDate;
        var lastDate;
        akses = $('#akses').val();
        var dtKarya;
        
        $(document).on('change', '#branch', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let branch = $('#branch').val();

            $.ajax({
                url: "{{ route('getKaryawanBranch') }}",
                type: "get",
                data: {
                    branch: branch,
                    _token: _token
                },
                success: function(dtKry) {
                    dtKarya = dtKry;
                    $('#nama_karyawan').find('option').remove();
                    $('#nama_karyawan').append(`<option value="">Pilih Karyawan</option>`);

                    $('#nik_karyawan').val('');
                    $('#departemen').val('');
                    $('#posisi').val('');

                    $.each(dtKry, function(k,kry) {
                        $('#nama_karyawan').append(`
                            <option value="${kry.nik_karyawan + "|" + kry.nama_karyawan}">${kry.nama_karyawan}</option>`
                        )
                    })
                }
            })
        })

        $(document).on('change', '#nama_karyawan', function(e) {
            dt = $(this).val().split('|');
            dtNik = dt[0];
            kry = dtKarya.find(k=>k.nik_karyawan === dtNik);

            $('#nik_karyawan').val(kry.nik_karyawan);
            $('#departemen').val(kry.departement);
            $('#posisi').val(kry.posisi);
        })

        function selectTeknisi(vstatus, vArea, vLeader) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let leadCallsignId = $('#LeadCallsignTim').val();

            $.ajax({
                url: "{{ route('getTeknisi') }}",
                type: "get",
                data: {
                    area: vArea,
                    leader: vLeader,
                    _token: _token
                },
                success: function(dtTim) {

                    if (vstatus === "baru") {
                        $('#teknisi1').find('option').remove();
                        $('#teknisi1').append(`<option value="">Pilih Teknisi 1</option>`);
                        $('#teknisi2').find('option').remove();
                        $('#teknisi2').append(`<option value="">Pilih Teknisi 2</option>`);
                        $('#teknisi3').find('option').remove();
                        $('#teknisi3').append(`<option value="">Pilih Teknisi 3</option>`);
                        $('#teknisi4').find('option').remove();
                        $('#teknisi4').append(`<option value="">Pilih Teknisi 4</option>`);

                        $.each(dtTim, function(key, tim) {
                            $('#teknisi1').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                            $('#teknisi2').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                            $('#teknisi3').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                            $('#teknisi4').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                        })
                    }
                    if (vstatus === "edit") {


                        $.each(dtTim, function(key, tim) {
                            $('#teknisi1Edit').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                            $('#teknisi2Edit').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                            $('#teknisi3Edit').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                            $('#teknisi4Edit').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                        })
                    }

                }
            })
        }

        $(document).on('click', '#detail-tim', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let cTim = $(this).data('id').split('|');
            let ct_id = cTim[0];
            let cl_id = cTim[1];
            let l_id = cTim[2];
            let b_id = cTim[3];

            $.ajax({
                url: "{{ route('getDetailTim') }}",
                type: "get",
                data: {
                    callTimEdit: ct_id,
                    callLeadEdit: cl_id,
                    branch_edit: b_id,
                    _token: _token
                },
                success: function(responEdit) {
                    $('#teknisi1Edit').find('option').remove();
                    $('#teknisi1Edit').append(`<option value="">Pilih Teknisi 1</option>`);
                    $('#teknisi2Edit').find('option').remove();
                    $('#teknisi2Edit').append(`<option value="">Pilih Teknisi 2</option>`);
                    $('#teknisi3Edit').find('option').remove();
                    $('#teknisi3Edit').append(`<option value="">Pilih Teknisi 3</option>`);
                    $('#teknisi4Edit').find('option').remove();
                    $('#teknisi4Edit').append(`<option value="">Pilih Teknisi 4</option>`);

                    $('#editTim').modal('show');

                    $('#callTimEdit').val('');
                    $('#LeadTimEdit').val('');
                    $('#TimLeaderEdit').val('');
                    $('#areaTimEdit').val('');
                    $('#posisiTimEdit').val('');
                    $('#callsignTimEdit').val('');

                    selectTeknisi("edit", b_id, l_id);

                    $('#editTim').modal('show');
                    $('#callTimEdit').val(responEdit.callsign_tim_id);
                    $('#LeadTimEdit').val(responEdit.lead_callsign);
                    $('#TimLeaderEdit').val(responEdit.nama_leader);
                    $('#areaTimEdit').val(responEdit.nama_branch);
                    $('#posisiTimEdit').val(responEdit.posisi);
                    $('#callsignTimEdit').val(responEdit.callsign_tim);


                    if (responEdit.nik_tim1 === null) {
                        document.getElementById('teknisi1Edit').value = "";
                    } else {
                        $('#teknisi1Edit').append(
                            `<option value="${responEdit.nik_tim1}" selected>${responEdit.teknisi1}</option>`
                        )
                    }

                    if (responEdit.nik_tim2 === null) {
                        document.getElementById('teknisi2Edit').value = "";
                    } else {
                        $('#teknisi2Edit').append(
                            `<option value="${responEdit.nik_tim2}" selected>${responEdit.teknisi2}</option>`
                        )
                    }

                    if (responEdit.nik_tim3 === null) {
                        document.getElementById('teknisi3Edit').value = "";
                    } else {
                        $('#teknisi3Edit').append(
                            `<option value="${responEdit.nik_tim3}" selected>${responEdit.teknisi3}</option>`
                        )
                    }

                    if (responEdit.nik_tim4 === null) {
                        document.getElementById('teknisi4Edit').value = "";
                    } else {
                        $('#teknisi4Edit').append(
                            `<option value="${responEdit.nik_tim4}" selected>${responEdit.teknisi4}</option>`
                        )
                    }

                }
            })
        })

        $('#updateTim').click(function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let callTimId = $('#callTimEdit').val();
            let tek1 = $('#teknisi1Edit').val();
            let tek2 = $('#teknisi2Edit').val();
            let tek3 = $('#teknisi3Edit').val();
            let tek4 = $('#teknisi4Edit').val();

            console.log(tek1, tek2, tek3, tek4)
            $.ajax({
                url: `/updateTim/${callTimId}`,
                type: 'get',
                data: {
                    idCallTim: callTimId,
                    tim1: tek1,
                    tim2: tek2,
                    tim3: tek3,
                    tim4: tek4,
                    _token: '{{ csrf_token() }}'
                },
                success: function(hasil) {

                    $('#editTim').modal('hide');
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "{{ session('success') }}",
                        showConfirmButton: true,
                        // timer: 2000
                    });

                    data_lead();
                    data_tim();

                },
                error: function(error) {
                    console.log(error);
                    if (error.responseJSON.message) {
                        alert(error.responseJSON.message)
                    }

                }
            })
        })
        // {{-- End Part Callsign Tim  --}}

    })
</script>
