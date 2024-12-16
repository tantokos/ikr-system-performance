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
                            <h3 class="text-white mb-2">Data Distribusi Seragam IKR</h3>
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
                        <div class="card-body px-2 py-2">
                            <div class="row mb-2">
                                <div class="col form-group mb-2">
                                    <span class="text-xs">Branch</span>
                                    <select class="form-control form-control-sm" id="filBranch" name="filBranch"
                                        style="border-color:#9ca0a7;">
                                        <option value="ALL">ALL</option>
                                        @if (isset($area))
                                            @foreach ($area as $b)
                                                <option value="{{ $b->nama_branch }}">{{ $b->nama_branch }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col form-group mb-2">
                                    <span class="text-xs">Nama Penerima</span>
                                    <select class="form-control form-control-sm" id="filPenerima" name="filPenerima"
                                        style="border-color:#9ca0a7;">
                                        <option value="ALL">ALL</option>
                                        @if (isset($karyawan))
                                            @foreach ($karyawan as $k)
                                                <option value="{{ $k->nik_karyawan }}">{{ $k->nama_karyawan }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col form-group mb-2">
                                    <span class="text-xs">Ukuran Seragam</span>
                                    <select class="form-control form-control-sm" id="filUkuran" name="filUkuran"
                                        style="border-color:#9ca0a7;">
                                        <option value="ALL">ALL</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                        <option value="XXXL">XXXL</option>
                                    </select>
                                </div>

                                <div class="row text-center">
                                    <div class="col">
                                        <button type="button" class="btn btn-sm btn-dark align-items-center filterData"
                                            id="filterData">Filter Data</button>
                                    </div>
                                </div>

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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Rekap
                                            Distribusi Seragam</span>
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
                                        <span class="btn-inner--text">Tambah Data Distribusi</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="card-body px-2 py-2">

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="tabelRekapSeragam" style="font-size: 12px; border-color:#9ca0a7;">
                                    <thead class="bg-secondary text-white">
                                        <tr id="headRekapSeragam">
                                            <th class="text-xs font-weight-semibold">Posisi</th>
                                            <th class="text-center text-xs font-weight-semibold">S</th>
                                            <th class="text-center text-xs font-weight-semibold">M</th>
                                            <th class="text-center text-xs font-weight-semibold">L</th>
                                            <th class="text-center text-xs font-weight-semibold">XL</th>
                                            <th class="text-center text-xs font-weight-semibold">XXL</th>
                                            <th class="text-center text-xs font-weight-semibold">XXXL</th>
                                            <th class="text-center text-xs font-weight-semibold">SubTotal</th>

                                        </tr>
                                    </thead>
                                    <tbody id="bodyRekapSeragam">

                                    </tbody>
                                </table>
                            </div>

                            {{-- <div class="border-top py-3 px-3 d-flex align-items-center">

                            </div> --}}
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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">List
                                            Data</span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="tabelDataDistribusiSeragam" style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-xs font-weight-semibold">Branch</th>
                                            <th class="text-xs font-weight-semibold">tgl Distribusi</th>
                                            <th class="text-xs font-weight-semibold">Penerima</th>
                                            <th class="text-xs font-weight-semibold">Posisi</th>
                                            <th class="text-xs font-weight-semibold">Ukuran</th>
                                            <th class="text-center text-xs font-weight-semibold">Jumlah</th>
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

            {{-- Modal Tambah Data Distribusi Seragam --}}
            <div class="modal fade" id="tambahPenerimaan" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
                data-bs-backdrop="static">>
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Distribusi Seragam</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('simpanDistribusiSeragam') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Tgl Distribusi Seragam</span>
                                                    <input class="form-control form-control-sm" type="date"
                                                        value="{{ date('Y-m-d') }}" id="tglDistribusi"
                                                        name="tglDistribusi" style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Nama Penerima</span>
                                                    <select class="form-control form-control-sm" type="text"
                                                        id="namapenerima" name="namapenerima"
                                                        style="border-color:#9ca0a7;" required>
                                                        <option value="">Pilih Karyawan</option>
                                                        @if (isset($karyawan))
                                                            @foreach ($karyawan as $kry)
                                                                <option
                                                                    value="{{ $kry->nik_karyawan . '|' . $kry->nama_karyawan . '|' . $kry->departement . '|' . $kry->posisi . '|' . $kry->branch_id . '|' . $kry->nama_branch }}">
                                                                    {{ $kry->nama_karyawan }}</option>
                                                            @endforeach

                                                        @endif
                                                    </select>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Nik Penerima</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="nikpenerima" name="nikpenerima"
                                                        style="border-color:#9ca0a7;" readonly>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Departemen</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="departemen" name="departemen"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Posisi</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="posisi" name="posisi"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Branch</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="namaBranch" name="namaBranch"
                                                        style="border-color:#9ca0a7;" readonly>
                                                </div>

                                            </div>


                                            <div class="col">
                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Ukuran</span>
                                                        <input value="S" type="text"
                                                            class="text-center text-xs form-control form-control-sm"
                                                            id="ukuranS" name="ukuran[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col" hidden>
                                                        <span class="text-xs">Kondisi</span>
                                                        <select class="text-xs form-control form-control-sm"
                                                            id="kondisiS" name="kondisi[]"
                                                            style="border-color:#9ca0a7;">
                                                            {{-- <option value="">Pilih Kondisi</option> --}}
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak">Rusak</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Jml</span>
                                                        <input type="number"
                                                            class="form-control form-control-sm jmlDistribusi"
                                                            id="jmlS" value="0" name="jml[]"
                                                            style="border-color:#9ca0a7;" min="0"
                                                            max="{{ isset($stock) ? $stock->sizeS : '0' }}">
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        {{-- <span class="text-xs">Ukuran</span> --}}
                                                        <input value="M" type="text"
                                                            class="text-center form-control form-control-sm"
                                                            id="ukuranM" name="ukuran[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col" hidden>
                                                        {{-- <span class="text-xs">Kondisi</span> --}}
                                                        <select class="form-control form-control-sm" id="kondisiM"
                                                            name="kondisi[]" style="border-color:#9ca0a7;">
                                                            {{-- <option value="">Pilih Kondisi</option> --}}
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak">Rusak</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        {{-- <span class="text-xs">Jml</span> --}}
                                                        <input type="number"
                                                            class="form-control form-control-sm jmlDistribusi"
                                                            id="jmlM" value="0" name="jml[]"
                                                            style="border-color:#9ca0a7;" min="0"
                                                            max="{{ isset($stock) ? $stock->sizeM : '0' }}">
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        {{-- <span class="text-xs">Ukuran</span> --}}
                                                        <input value="L" type="text"
                                                            class="text-center form-control form-control-sm"
                                                            id="ukuranL" name="ukuran[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col" hidden>
                                                        {{-- <span class="text-xs">Kondisi</span> --}}
                                                        <select class="form-control form-control-sm" id="kondisiL"
                                                            name="kondisi[]" style="border-color:#9ca0a7;">
                                                            {{-- <option value="">Pilih Kondisi</option> --}}
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak">Rusak</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        {{-- <span class="text-xs">Jml</span> --}}
                                                        <input type="number"
                                                            class="form-control form-control-sm jmlDistribusi"
                                                            id="jmlL" value="0" name="jml[]"
                                                            style="border-color:#9ca0a7;" min="0"
                                                            max="{{ isset($stock) ? $stock->sizeL : '0' }}">
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        {{-- <span class="text-xs">Ukuran</span> --}}
                                                        <input value="XL" type="text"
                                                            class="text-center form-control form-control-sm"
                                                            id="ukuranXL" name="ukuran[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col" hidden>
                                                        {{-- <span class="text-xs">Kondisi</span> --}}
                                                        <select class="form-control form-control-sm" id="kondisiXL"
                                                            name="kondisi[]" style="border-color:#9ca0a7;">
                                                            {{-- <option value="">Pilih Kondisi</option> --}}
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak">Rusak</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        {{-- <span class="text-xs">Jml</span> --}}
                                                        <input type="number"
                                                            class="form-control form-control-sm jmlDistribusi"
                                                            id="jmlXL" value="0" name="jml[]"
                                                            style="border-color:#9ca0a7;" min="0"
                                                            max="{{ isset($stock) ? $stock->sizeXL : '0' }}">
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        {{-- <span class="text-xs">Ukuran</span> --}}
                                                        <input value="XXL" type="text"
                                                            class="text-center form-control form-control-sm"
                                                            id="ukuranXXL" name="ukuran[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col" hidden>
                                                        {{-- <span class="text-xs">Kondisi</span> --}}
                                                        <select class="form-control form-control-sm" id="kondisiXXL"
                                                            name="kondisi[]" style="border-color:#9ca0a7;">
                                                            {{-- <option value="">Pilih Kondisi</option> --}}
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak">Rusak</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        {{-- <span class="text-xs">Jml</span> --}}
                                                        <input type="number"
                                                            class="form-control form-control-sm jmlDistribusi"
                                                            id="jmlXXL" value="0" name="jml[]"
                                                            style="border-color:#9ca0a7;" min="0"
                                                            max="{{ isset($stock) ? $stock->sizeXXL : '0' }}">
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        {{-- <span class="text-xs">Ukuran</span> --}}
                                                        <input value="XXXL" type="text"
                                                            class="text-center form-control form-control-sm"
                                                            id="ukuranXXXL" name="ukuran[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col" hidden>
                                                        {{-- <span class="text-xs">Kondisi</span> --}}
                                                        <select class="form-control form-control-sm" id="kondisiXXXL"
                                                            name="kondisi[]" style="border-color:#9ca0a7;">
                                                            {{-- <option value="">Pilih Kondisi</option> --}}
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak">Rusak</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        {{-- <span class="text-xs">Jml</span> --}}
                                                        <input type="number"
                                                            class="form-control form-control-sm jmlDistribusi"
                                                            id="jmlXXXL" value="0" name="jml[]"
                                                            style="border-color:#9ca0a7;" min="0"
                                                            max="{{ isset($stock) ? $stock->sizeXXXL : '0' }}">
                                                    </div>


                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">-</span>
                                                        <input value="Jumlah Seragam" type="text"
                                                            class="form-control form-control-sm"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    {{-- <div class="col"> --}}
                                                    {{-- <span class="text-xs">Kondisi</span> --}}
                                                    {{-- <select class="form-control form-control-sm" id="kondisiXXXL"
                                                        name="kondisi[]" style="border-color:#9ca0a7;">
                                                        <option value="Baik">Baik</option>
                                                        <option value="Rusak">Rusak</option>
                                                    </select> --}}
                                                    {{-- </div> --}}

                                                    <div class="col">
                                                        <span class="text-xs">-</span>
                                                        <input type="text"
                                                            class="text-center form-control form-control-sm"
                                                            id="jmlTotal" name="jmlTotal"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col">

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Nik Distribusi Seragam</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="nikDistribusi" name="nikDistribusi"
                                                        style="border-color:#9ca0a7;"
                                                        value="{{ isset($login) ? $login->nik_karyawan : '' }}"
                                                        readonly>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Nama</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="namaDistribusi" name="namaDistribusi"
                                                        style="border-color:#9ca0a7;"
                                                        value="{{ isset($login) ? $login->nama_karyawan : '' }}"
                                                        readonly>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Departemen</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="deptDistribusi" name="deptDistribusi"
                                                            style="border-color:#9ca0a7;"
                                                            value="{{ isset($login) ? $login->departement : '' }}"
                                                            readonly>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Posisi</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="posisiDistribusi" name="posisiDistribusi"
                                                            style="border-color:#9ca0a7;"
                                                            value="{{ isset($login) ? $login->posisi : '' }}"
                                                            readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Branch</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="branchDistribusi" name="branchDistribusi"
                                                        style="border-color:#9ca0a7;"
                                                        value="{{ isset($login) ? $login->nama_branch : '' }}"
                                                        readonly>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Keterangan</span>
                                                    <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" style="border-color:#9ca0a7;"></textarea>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <span class="text-xs">Foto Distribusi Seragam</span>

                                                <div class="form-group mb-1 text-center">

                                                    <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                        id="showgambar" alt="Card Image"
                                                        style="width:150px;height: 150px;" />
                                                </div>

                                                <div class="form-group mb-1">
                                                    <input class="form-control form-control-sm" id="fotoDistribusi"
                                                        name="fotoDistribusi" type="file"
                                                        style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <dl class="row mb-1">
                                                        <dt class="col-sm"><span class="text-xs">Informasi Stock
                                                                Seragam</span></dt>

                                                    </dl>

                                                    <div class="row">
                                                        <div class="col">
                                                            <ul>
                                                                <li><span class="text-xs">S =
                                                                        {{ isset($stock) ? $stock->sizeS : '0' }}</span>
                                                                </li>
                                                                <li><span class="text-xs">M =
                                                                        {{ isset($stock) ? $stock->sizeM : 0 }}</span>
                                                                </li>
                                                                <li><span class="text-xs">L =
                                                                        {{ isset($stock) ? $stock->sizeL : 0 }}</span>
                                                                </li>

                                                            </ul>
                                                        </div>

                                                        <div class="col">
                                                            <ul>
                                                                <li><span class="text-xs">XL =
                                                                        {{ isset($stock) ? $stock->sizeXL : 0 }}</span>
                                                                </li>
                                                                <li><span class="text-xs">XXL =
                                                                        {{ isset($stock) ? $stock->sizeXXL : 0 }}</span>
                                                                </li>
                                                                <li><span class="text-xs">XXXL =
                                                                        {{ isset($stock) ? $stock->sizeXXXL : 0 }}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <div class="form-group mb-1">
                                                <span class="text-xs">Keterangan</span>
                                                <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" style="border-color:#9ca0a7;"></textarea>
                                            </div> --}}

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
            {{-- End Modal Tambah Distribusi Seragam --}}

            {{-- Modal Detail Data Distribusi Seragam --}}
            <div class="modal fade" id="detailDistribusi" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
                data-bs-backdrop="static">>
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Data Distribusi Seragam</h5>
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
                                                    <span class="text-xs">Tgl Distribusi Seragam</span>
                                                    <input class="form-control form-control-sm" type="date"
                                                        value="{{ date('Y-m-d') }}" id="tglDistribusiShow"
                                                        name="tglDistribusiShow" style="border-color:#9ca0a7;"
                                                        readonly>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <input type="hidden" id="distribusiIdShow"
                                                        name="distribusiIdShow" readonly>
                                                    <span class="text-xs">Nama Penerima</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="namapenerimaShow" name="namapenerimaShow"
                                                        style="border-color:#9ca0a7;" readonly>

                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Nik Penerima</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="nikpenerimaShow" name="nikpenerimaShow"
                                                        style="border-color:#9ca0a7;" readonly>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Departemen</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="departemenShow" name="departemenShow"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Posisi</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="posisiShow" name="posisiShow"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Branch</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="namaBranchShow" name="namaBranchShow"
                                                        style="border-color:#9ca0a7;" readonly>
                                                </div>

                                            </div>


                                            <div class="col">
                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Ukuran</span>
                                                        <input value="S" type="text"
                                                            class="text-center text-xs form-control form-control-sm"
                                                            id="ukuranSShow" name="ukuranShow[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col" hidden>
                                                        <span class="text-xs">Kondisi</span>
                                                        <select class="text-xs form-control form-control-sm"
                                                            id="kondisiSShow" name="kondisiShow[]"
                                                            style="border-color:#9ca0a7;">
                                                            {{-- <option value="">Pilih Kondisi</option> --}}
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak">Rusak</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Jml</span>
                                                        <input type="number"
                                                            class="text-center form-control form-control-sm"
                                                            id="jmlSShow" value="0" name="jmlShow[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        {{-- <span class="text-xs">Ukuran</span> --}}
                                                        <input value="M" type="text"
                                                            class="text-center form-control form-control-sm"
                                                            id="ukuranMShow" name="ukuranShow[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col" hidden>
                                                        {{-- <span class="text-xs">Kondisi</span> --}}
                                                        <select class="form-control form-control-sm" id="kondisiMShow"
                                                            name="kondisiShow[]" style="border-color:#9ca0a7;">
                                                            {{-- <option value="">Pilih Kondisi</option> --}}
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak">Rusak</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        {{-- <span class="text-xs">Jml</span> --}}
                                                        <input type="number"
                                                            class="text-center form-control form-control-sm"
                                                            id="jmlMShow" value="0" name="jmlShow[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        {{-- <span class="text-xs">Ukuran</span> --}}
                                                        <input value="L" type="text"
                                                            class="text-center form-control form-control-sm"
                                                            id="ukuranLShow" name="ukuranShow[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col" hidden>
                                                        {{-- <span class="text-xs">Kondisi</span> --}}
                                                        <select class="form-control form-control-sm" id="kondisiLShow"
                                                            name="kondisiShow[]" style="border-color:#9ca0a7;">
                                                            {{-- <option value="">Pilih Kondisi</option> --}}
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak">Rusak</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        {{-- <span class="text-xs">Jml</span> --}}
                                                        <input type="number"
                                                            class="text-center form-control form-control-sm"
                                                            id="jmlLShow" value="0" name="jmlShow[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        {{-- <span class="text-xs">Ukuran</span> --}}
                                                        <input value="XL" type="text"
                                                            class="text-center form-control form-control-sm"
                                                            id="ukuranXLShow" name="ukuranShow[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col" hidden>
                                                        {{-- <span class="text-xs">Kondisi</span> --}}
                                                        <select class="form-control form-control-sm"
                                                            id="kondisiXLShow" name="kondisiShow[]"
                                                            style="border-color:#9ca0a7;">
                                                            {{-- <option value="">Pilih Kondisi</option> --}}
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak">Rusak</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        {{-- <span class="text-xs">Jml</span> --}}
                                                        <input type="number"
                                                            class="text-center form-control form-control-sm"
                                                            id="jmlXLShow" name="jmlShow[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        {{-- <span class="text-xs">Ukuran</span> --}}
                                                        <input value="XXL" type="text"
                                                            class="text-center form-control form-control-sm"
                                                            id="ukuranXXLShow" name="ukuranShow[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col" hidden>
                                                        {{-- <span class="text-xs">Kondisi</span> --}}
                                                        <select class="form-control form-control-sm"
                                                            id="kondisiXXLShow" name="kondisiShow[]"
                                                            style="border-color:#9ca0a7;">
                                                            {{-- <option value="">Pilih Kondisi</option> --}}
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak">Rusak</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        {{-- <span class="text-xs">Jml</span> --}}
                                                        <input type="number"
                                                            class="text-center form-control form-control-sm"
                                                            id="jmlXXLShow" value="0" name="jmlShow[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        {{-- <span class="text-xs">Ukuran</span> --}}
                                                        <input value="XXXL" type="text"
                                                            class="text-center form-control form-control-sm"
                                                            id="ukuranXXXLShow" name="ukuranShow[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col" hidden>
                                                        {{-- <span class="text-xs">Kondisi</span> --}}
                                                        <select class="form-control form-control-sm"
                                                            id="kondisiXXXLShow" name="kondisiShow[]"
                                                            style="border-color:#9ca0a7;">
                                                            {{-- <option value="">Pilih Kondisi</option> --}}
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak">Rusak</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        {{-- <span class="text-xs">Jml</span> --}}
                                                        <input type="number"
                                                            class="text-center form-control form-control-sm"
                                                            id="jmlXXXLShow" value="0" name="jmlShow[]"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>


                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">-</span>
                                                        <input value="Jumlah Seragam" type="text"
                                                            class="form-control form-control-sm"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    {{-- <div class="col"> --}}
                                                    {{-- <span class="text-xs">Kondisi</span> --}}
                                                    {{-- <select class="form-control form-control-sm" id="kondisiXXXL"
                                                        name="kondisi[]" style="border-color:#9ca0a7;">
                                                        <option value="Baik">Baik</option>
                                                        <option value="Rusak">Rusak</option>
                                                    </select> --}}
                                                    {{-- </div> --}}

                                                    <div class="col">
                                                        <span class="text-xs">-</span>
                                                        <input type="text"
                                                            class="text-center form-control form-control-sm"
                                                            id="jmlTotalShow" name="jmlTotalShow"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col">

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Nik Distribusi Seragam</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="nikDistribusiShow" name="nikDistribusiShow"
                                                        style="border-color:#9ca0a7;" readonly>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Nama</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="namaDistribusiShow" name="namaDistribusiShow"
                                                        style="border-color:#9ca0a7;" readonly>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Departemen</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="deptDistribusiShow" name="deptDistribusiShow"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Posisi</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="posisiDistribusiShow" name="posisiDistribusiShow"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Branch</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="branchDistribusiShow" name="branchDistribusiShow"
                                                        style="border-color:#9ca0a7;" readonly>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Keterangan</span>
                                                    <textarea class="form-control form-control-sm" id="keteranganShow" name="keteranganShow"
                                                        style="border-color:#9ca0a7;" readonly></textarea>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <span class="text-xs">Foto Distribusi Seragam</span>

                                                <div class="form-group mb-1 text-center">

                                                    <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                        id="showgambarShow" alt="Card Image"
                                                        style="width:150px;height: 150px;" />
                                                </div>

                                                <div class="form-group mb-1">
                                                    <input class="form-control form-control-sm"
                                                        id="fotoDistribusiShow" name="fotoDistribusiShow"
                                                        type="file" style="border-color:#9ca0a7;" disabled>
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
            {{-- End Modal Detail Distribusi Seragam --}}

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

    $("#fotoDistribusi").change(function() {
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

        rekap_distribusi_seragam();
        data_distribusi_seragam();

        $(document).on('click', '#filterData', function(e) {
            e.preventDefault();
            rekap_distribusi_seragam();
            data_distribusi_seragam();
        })

        $("[type='number']").keypress(function(evt) {
            evt.preventDefault();
        });

        $('.jmlDistribusi').change(function() {
            tot = 0;
            js = Number($('#jmlS').val());
            jm = Number($('#jmlM').val());
            jl = Number($('#jmlL').val());
            jxl = Number($('#jmlXL').val());
            jxxl = Number($('#jmlXXL').val());
            jxxxl = Number($('#jmlXXXL').val());

            tot = tot + js + jm + jl + jxl + jxxl + jxxxl;

            $('#jmlTotal').val(tot);
        })

        function rekap_distribusi_seragam() {

            filterAll = $('#filBranch').val() + "|" + $('#filNamaTool').val() + "|" + $('#filPosisi').val() +
                "|" + $('#filKondisi').val() + "|" + $('#filCallsign').val() + "|" + $('#filApprove1').val() +
                "|" + $('#filApprove2').val()

            $.ajax({
                url: "{{ route('getRekapDistribusiSeragam') }}",
                type: "get",
                data: {
                    _token: _token,
                    filBranch: $('#filBranch').val(),
                    filUkuran: $('#filUkuran').val(),
                    filPenerima: $('#filPenerima').val(),
                },
                success: function(dtRekap) {
                    console.log('rekapSeragam : ', dtRekap)
                    $('#bodyRekapSeragam').find('tr').remove();

                    bdRekapSeragam = "";
                    stotal = [];
                    tS = 0;
                    tM = 0;
                    tL = 0;
                    tXL = 0;
                    tXXL = 0;
                    tXXXL = 0;
                    ttot = 0;

                    bdRekapSeragamDs = "";
                    stotalDs = [];
                    tbaikDs = 0;
                    trusakDs = 0;
                    thilangDs = 0;
                    ttotDs = 0;

                    for (p = 0; p < dtRekap.length; p++) {

                        // if(dtRekap[p].posisi != "Disposal") {
                        stotal[p] = 0;
                        stotal[p] = Number(dtRekap[p].ukuranS) +
                            Number(dtRekap[p].ukuranM) +
                            Number(dtRekap[p].ukuranL) +
                            Number(dtRekap[p].ukuranXL) +
                            Number(dtRekap[p].ukuranXXL) +
                            Number(dtRekap[p].ukuranXXXL);

                        tS += Number(dtRekap[p].ukuranS)
                        tM += Number(dtRekap[p].ukuranM)
                        tL += Number(dtRekap[p].ukuranL)
                        tXL += Number(dtRekap[p].ukuranXL)
                        tXXL += Number(dtRekap[p].ukuranXXL)
                        tXXXL += Number(dtRekap[p].ukuranXXXL)

                        ttot += stotal[p];
                        bdRekapSeragam = bdRekapSeragam + `
                                <tr>
                                    <td style="font-weight:500">${dtRekap[p].posisi_penerima}</td>
                                    <td class="text-center" style="font-weight:500"><span id="${dtRekap[p].posisi_penerima + "|S|" + filterAll}" onclick="detRekap_click(this.id)" style="cursor:pointer">${dtRekap[p].ukuranS.toLocaleString()}</span></td>
                                    <td class="text-center" style="font-weight:500"><span id="${dtRekap[p].posisi_penerima + "|M|" + filterAll}" onclick="detRekap_click(this.id)" style="cursor:pointer">${dtRekap[p].ukuranM.toLocaleString()}</span></td>
                                    <td class="text-center" style="font-weight:500"><span id="${dtRekap[p].posisi_penerima + "|L|" + filterAll}" onclick="detRekap_click(this.id)" style="cursor:pointer">${dtRekap[p].ukuranL.toLocaleString()}</span></td>
                                    <td class="text-center" style="font-weight:500"><span id="${dtRekap[p].posisi_penerima + "|XL|" + filterAll}" onclick="detRekap_click(this.id)" style="cursor:pointer">${dtRekap[p].ukuranXL.toLocaleString()}</span></td>
                                    <td class="text-center" style="font-weight:500"><span id="${dtRekap[p].posisi_penerima + "|XXL|" + filterAll}" onclick="detRekap_click(this.id)" style="cursor:pointer">${dtRekap[p].ukuranXXL.toLocaleString()}</span></td>
                                    <td class="text-center" style="font-weight:500"><span id="${dtRekap[p].posisi_penerima + "|XXXL|" + filterAll}" onclick="detRekap_click(this.id)" style="cursor:pointer">${dtRekap[p].ukuranXXXL.toLocaleString()}</span></td>
                                    <td class="text-center" style="font-weight:500"><span id="${dtRekap[p].posisi_penerima + "|Subtotal|" + filterAll}" onclick="detRekap_click(this.id)" style="cursor:pointer">${stotal[p].toLocaleString()}</span></td>
                                </tr>`;

                    }

                    bdRekapSeragam = bdRekapSeragam + `
                        <tr>
                            <td style="font-weight:500"></td>
                            <td class="text-center" style="font-weight:500"></td>
                            <td class="text-center" style="font-weight:500"></td>
                            <td class="text-center" style="font-weight:500"></td>
                            <td class="text-center" style="font-weight:500"></td>
                            <td class="text-center" style="font-weight:500"></td>
                            <td class="text-center" style="font-weight:500"></td>
                            <td class="text-center" style="font-weight:500"></td>
                        </tr>
                        <tr class="table-dark">
                            <td class="text-center" style="font-weight:500">Total</td>
                            <td class="text-center" style="font-weight:500"><span style="cursor:pointer">${tS.toLocaleString()}</span></td>
                            <td class="text-center" style="font-weight:500"><span style="cursor:pointer">${tM.toLocaleString()}</span></td>
                            <td class="text-center" style="font-weight:500"><span style="cursor:pointer">${tL.toLocaleString()}</span></td>
                            <td class="text-center" style="font-weight:500"><span style="cursor:pointer">${tXL.toLocaleString()}</span></td>
                            <td class="text-center" style="font-weight:500"><span style="cursor:pointer">${tXXL.toLocaleString()}</span></td>
                            <td class="text-center" style="font-weight:500"><span style="cursor:pointer">${tXXXL.toLocaleString()}</span></td>
                            <td class="text-center" style="font-weight:500"><span style="cursor:pointer">${ttot.toLocaleString()}</span></td>
                        </tr>`;

                    $('#bodyRekapSeragam').append(bdRekapSeragam);
                }
            })
        }

        function data_distribusi_seragam() {
            $('#tabelDataDistribusiSeragam').DataTable({
                // dom: 'Blrtip',
                layout: {
                    topStart: {
                        pageLength: {
                            menu: [
                                [10, 25, 50, -1],
                                [10, 25, 50, "All"]
                            ]
                        },
                        buttons: ['excel'],
                    },

                },
                // buttons: [
                //     'excel',
                // ],
                paging: true,
                orderClasses: false,
                // fixedColumns: true,

                fixedColumns: {
                    leftColumns: 2,
                    // rightColumns: 1
                },
                // lengthMenu: [
                //     [10, 50, 100 - 1], [10, 50, 100, "All"]
                // ],
                deferRender: true,
                scrollCollapse: true,
                scrollX: true,
                pageLength: 10,
                lengthChange: true,
                bFilter: true,
                destroy: true,
                processing: true,
                serverSide: false,
                ajax: {
                    url: "{{ route('getDataDistribusiSeragam') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        _token: _token,
                        filBranch: $('#filBranch').val(),
                        filUkuran: $('#filUkuran').val(),
                        filPenerima: $('#filPenerima').val(),
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_Row_Index',
                        "className": "text-center",
                        // orderable: false,
                        searchable: false,
                        "width": '40px'
                    },
                    {
                        data: 'branch_penerima',
                        // width: '90'
                    },
                    {
                        data: 'tgl_distribusi',
                        "className": "text-start",
                    },
                    {
                        data: 'nama_penerima'
                    },
                    {
                        data: 'posisi_penerima'
                    },
                    {
                        data: 'ukuran'
                    },
                    {
                        data: 'jml',
                        "className": "text-center",
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }

        $(document).on('change', '#namapenerima', function(e) {
            dt = $(this).val().split('|');
            dtNik = dt[0];
            dtDept = dt[2];
            dtPos = dt[3];
            dtBranch = dt[5];

            $('#nikpenerima').val(dtNik);
            $('#departemen').val(dtDept);
            $('#posisi').val(dtPos);
            $('#namaBranch').val(dtBranch);
        })

        $(document).on('click', '#detail-distribusi', function(e) {
            e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let t_id = $(this).data('id');
            $('#detailDistribusi').modal('show');

            $.ajax({
                url: "{{ route('showDetailDistribusiSeragam') }}",
                type: "get",
                data: {
                    filDistribusiId: t_id,
                    _token: _token
                },
                success: function(res) {
                    jmlSrg = 0;
                    $('#distribusiIdShow').val('')
                    $('#tglDistribusiShow').val('')
                    $('#namapenerimaShow').val('')
                    $('#nikpenerimaShow').val('')
                    $('#departemenShow').val('')
                    $('#posisiShow').val('')
                    $('#namaBranchShow').val('')
                    $('#kondisiSShow').val('')
                    $('#jmlSShow').val('')
                    $('#kondisiMShow').val('')
                    $('#jmlMShow').val('')
                    $('#kondisiLShow').val('')
                    $('#jmlLShow').val('')
                    $('#kondisiXLShow').val('')
                    $('#jmlXLShow').val('')
                    $('#kondisiXXLShow').val('')
                    $('#jmlXXLShow').val('')
                    $('#kondisiXXXLShow').val('')
                    $('#jmlXXXLShow').val('')

                    $('#tglDistribusiShow').val(res.hDistribusi.tgl_distribusi)
                    $('#distribusiIdShow').val(res.hDistribusi.id)
                    $('#namapenerimaShow').val(res.hDistribusi.nama_penerima)
                    $('#nikpenerimaShow').val(res.hDistribusi.nik_penerima)
                    $('#departemenShow').val(res.hDistribusi.departement)
                    $('#posisiShow').val(res.hDistribusi.posisi_penerima)
                    $('#namaBranchShow').val(res.hDistribusi.branch_penerima)

                    $('#showgambarShow').attr('src',
                        `/storage/image-seragam/${res.hDistribusi.foto_distribusi_seragam}`
                    )
                    $('#keteranganShow').val(res.hDistribusi.keterangan)

                    $('#nikDistribusiShow').val(res.hDistribusi.nik_distribusi)
                    $('#namaDistribusiShow').val(res.hDistribusi.nama_distribusi)
                    $('#deptDistribusiShow').val(res.hDistribusi.dept_distribusi)
                    $('#posisiDistribusiShow').val(res.hDistribusi.posisi_distribusi)
                    $('#branchDistribusiShow').val(res.hDistribusi.branch_distribusi)

                    for (x = 0; x < res.dDistribusi.length; x++) {
                        if (res.dDistribusi[x].ukuran === "S") {
                            $('#kondisiSShow').val(res.dDistribusi[x].kondisi)
                            $('#jmlSShow').val(res.dDistribusi[x].jml)
                        }
                        if (res.dDistribusi[x].ukuran === "M") {
                            $('#kondisiMShow').val(res.dDistribusi[x].kondisi)
                            $('#jmlMShow').val(res.dDistribusi[x].jml)
                        }
                        if (res.dDistribusi[x].ukuran === "L") {
                            $('#kondisiLShow').val(res.dDistribusi[x].kondisi)
                            $('#jmlLShow').val(res.dDistribusi[x].jml)
                        }
                        if (res.dDistribusi[x].ukuran === "XL") {
                            $('#kondisiXLShow').val(res.dDistribusi[x].kondisi)
                            $('#jmlXLShow').val(res.dDistribusi[x].jml)
                        }
                        if (res.dDistribusi[x].ukuran === "XXL") {
                            $('#kondisiXXLShow').val(res.dDistribusi[x].kondisi)
                            $('#jmlXXLShow').val(res.dDistribusi[x].jml)
                        }
                        if (res.dDistribusi[x].ukuran === "XXXL") {
                            $('#kondisiXXXLShow').val(res.dDistribusi[x].kondisi)
                            $('#jmlXXXLShow').val(res.dDistribusi[x].jml)
                        }
                        jmlSrg = jmlSrg + res.dDistribusi[x].jml;
                    }

                    $('#jmlTotalShow').val(jmlSrg)


                }
            })
        })

    })
</script>
