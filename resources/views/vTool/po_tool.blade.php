<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-0 mb-3">
                        <div class="full-background" style="background: linear-gradient(to right, #112133, #21416d);">
                        </div>
                        <div class="card-body text-start p-3 w-100">
                            <h4 class="text-white mb-2">Data PO Tool IKR</h4>
                            <p class="mb-1 font-weight-semibold">
                                PT. Mitra Sinergi Telematika.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body px-2 py-2">
                            <div class="row mb-2">
                                <div class="col form-group mb-1">
                                    <span class="text-xs">Branch</span>
                                    <select class="form-control form-control-sm" 
                                        id="filBranch" name="filBranch" style="border-color:#9ca0a7;">
                                        <option value="ALL">ALL</option>
                                        @if (isset($branch))
                                            @foreach ($branch as $b )
                                                <option value="{{ $b->nama_branch}}">{{ $b->nama_branch }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col form-group mb-1">
                                    <span class="text-xs">Nama Tool</span>
                                    <select class="form-control form-control-sm" 
                                        id="filNamaTool" name="filNamaTool" style="border-color:#9ca0a7;">
                                        <option value="ALL">ALL</option>
                                        @if (isset($namaTool))
                                            @foreach ($namaTool as $n )
                                                <option value="{{ $n->nama_tool}}">{{ $n->nama_tool }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col form-group mb-1">
                                    <span class="text-xs">Posisi Tool</span>
                                    <select class="form-control form-control-sm" 
                                        id="filPosisi" name="filPosisi" style="border-color:#9ca0a7;">
                                        <option value="ALL">ALL</option>
                                        @if(isset($posisi))
                                            @foreach ($posisi as $p )
                                                <option value="{{ $p->posisiTool }}">{{ $p->posisiTool}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col form-group mb-1">
                                    <span class="text-xs">Kondisi Tool</span>
                                    <select class="form-control form-control-sm" 
                                        id="filKondisi" name="filKondisi" style="border-color:#9ca0a7;">
                                        <option value="ALL">ALL</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Rusak">Rusak</option>
                                        <option value="Hilang">Hilang</option>
                                    </select>
                                </div>

                                <div class="col form-group mb-1">
                                    <span class="text-xs">Callsign Tim</span>
                                    <select class="form-control form-control-sm" 
                                        id="filCallsign" name="filCallsign" style="border-color:#9ca0a7;">
                                        <option value="ALL">ALL</option>
                                        @if (isset($callsign))
                                            @foreach ($callsign as $c )
                                                <option value="{{ $c->callsign_tim }}">{{ $c->callsign_tim }}</option>
                                            @endforeach
                                            
                                        @endif
                                    </select>
                                </div>

                                <div class="col form-group mb-1">
                                    <span class="text-xs">Approval 1</span>
                                    <select class="form-control form-control-sm" 
                                        id="filApprove1" name="filApprove1" style="border-color:#9ca0a7;">
                                        <option value="ALL">ALL</option>
                                        <option value="Submited">Submited</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Reject">Reject</option>
                                    </select>
                                </div>

                                <div class="col form-group mb-1">
                                    <span class="text-xs">Approval 2</span>
                                    <select class="form-control form-control-sm" 
                                        id="filApprove2" name="filApprove2" style="border-color:#9ca0a7;">
                                        <option value="ALL">ALL</option>
                                        <option value="Submited">Submited</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Reject">Reject</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row text-center">
                                <div class="col">
                                    <button type="button"
                                        class="btn btn-sm btn-dark align-items-center filterData"
                                        id="filterData">Filter Data</button>
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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Rekap Data Tool</span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0" 
                                    id="tabelRekapTool" style="font-size: 12px; border-color:#9ca0a7;">
                                    <thead class="bg-gray-800 text-white">
                                        <tr id="headRekapTool" >
                                            <th class="text-xs font-weight-semibold">Posisi Tool</th>
                                            <th class="text-center text-xs font-weight-semibold">Baik</th>
                                            <th class="text-center text-xs font-weight-semibold">Rusak</th>
                                            <th class="text-center text-xs font-weight-semibold">Hilang</th>
                                            <th class="text-center text-xs font-weight-semibold">SubTotal</th>

                                        </tr>
                                    </thead>
                                    <tbody id="bodyRekapTool">

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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Data PO Tool</span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
                                    {{-- @if (isset($can)) --}}
                                        @if ($can !="GA/ACC")
                                            <button type="button"
                                                class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                                data-bs-toggle="modal" data-bs-target="#tambahPOTool">
                                                <span class="btn-inner--icon">
                                                    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                        <path
                                                            d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                        </path>
                                                    </svg>
                                                </span>
                                                <span class="btn-inner--text">Tambah PO Baru</span>
                                            </button>
                                        @endif
                                    {{-- @endif --}}
                                </div>

                            </div>
                        </div>

                        <div class="card-body px-2 py-2">

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0" id="tabelTool"
                                    style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Nama</th>
                                            <th class="text-center text-xs font-weight-semibold">Merk</th>
                                            <th class="text-center text-xs font-weight-semibold">Kode Aset</th>
                                            <th class="text-center text-xs font-weight-semibold">Kode GA</th>
                                            <th class="text-center text-xs font-weight-semibold">Branch</th>
                                            <th class="text-center text-xs font-weight-semibold">Departemen</th>
                                            <th class="text-center text-xs font-weight-semibold">Kondisi</th>
                                            <th class="text-center text-xs font-weight-semibold">Status</th>
                                            <th class="text-center text-xs font-weight-semibold">Posisi</th>
                                            <th class="text-center text-xs font-weight-semibold">Approval 1 Penerimaan Tool</th>
                                            <th class="text-center text-xs font-weight-semibold">Approval 2 Penerimaan Tool</th>
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

        {{-- Modal Tambah Data Tool --}}
        <div class="modal fade" id="tambahPOTool" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data PO Tool</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('simpanPoTool') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        {{-- <div class="col"> --}}
                                            {{-- <div class="row"> --}}
                                                <div class="col form-group mb-1">
                                                    <span class="text-xs">Nomor PO</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="noPengajuan" name="noPengajuan" value="{{ old('noPengajuan') }}"
                                                        style="width: 100%; border-color:#9ca0a7;text-transform:uppercase;" required>
                                                    @error('noPengajuan')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class=" col form-group mb-1">
                                                    <span class="text-xs">Tanggal PO</span>
                                                    <input class="form-control form-control-sm" type="date"
                                                        id="tgl" name="tgl" value="{{ date('Y-m-d') }}"
                                                        style="width: 100%; border-color:#9ca0a7;">
                                                </div>
                                            {{-- </div> --}}

                                            {{-- <div class="row"> --}}
                                                {{-- <div class="col form-group mb-1">
                                                    <span class="text-xs">Cost Center</span>
                                                    <select class="form-control form-control-sm" id="costCenter"
                                                        name="costCenter" style="width: 100%; border-color:#9ca0a7;"
                                                        value="{{ old('costCenter') }}" required>
                                                        <option value="">Pilih Cost Center</option>
                                                        @foreach ($cost as $cc)
                                                            <option value="{{ $cc->cost_center }}">
                                                                {{ $cc->cost_center }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}

                                                <div class="col form-group mb-1">
                                                    <span class="text-xs">Branch</span>
                                                    <select class="form-control form-control-sm" id="branch"
                                                        name="branch" style="width: 100%; border-color:#9ca0a7;"
                                                        value="{{ old('branch') }}" required>
                                                        <option value="">Pilih Branch</option>
                                                        @foreach ($branch as $b)
                                                            <option value="{{ $b->nama_branch }}">{{ $b->nama_branch }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            {{-- </div> --}}

                                            <div class="col form-group mb-1">
                                                <span class="text-xs">PIC Input</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="picInput" name="picInput" value="{{ $akses }}"
                                                    style="width: 100%; border-color:#9ca0a7;" readonly>
                                            </div>

                                            {{-- <div class="row">
                                                <div class="col form-group mb-1">
                                                    <span class="text-xs">Category</span>
                                                    <select class="form-control form-control-sm" id="category"
                                                        name="category" style="border-color:#9ca0a7;"
                                                        value="{{ old('category') }}" required>
                                                        <option value="">Pilih Category</option>
                                                        <option value="Barang">Barang</option>
                                                        <option value="Jasa">Jasa</option>
                                                    </select>
                                                </div>
                                                <div class="col form-group mb-1">

                                                </div>
                                            </div> --}}


                                        {{-- </div> --}}
                                    </div>
                                    <hr style="border: 1px solid">

                                    <div class="row">
                                        {{-- <div class="col"> --}}
                                            <div class="col form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Nama Tool</span>
                                                <select class="form-control form-control-sm namaTool"
                                                    id="namaTool" name="namaTool" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Tool</option>
                                                    @if (isset($namaTool))
                                                        @foreach ($namaTool as $nt )
                                                            <option value="{{ $nt->nama_tool }}">{{ $nt->nama_tool}}</option>
                                                        @endforeach
                                                        
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Merk</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="merk" name="merk" style="border-color:#9ca0a7;">
                                            </div>

                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Satuan</span>
                                                <input type="text" class="form-control form-control-sm" id="satuan"
                                                    name="satuan" style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="col form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Spesifikasi</span>
                                                <textarea class="form-control form-control-sm" id="spesifikasi" name="spesifikasi" style="border-color:#9ca0a7;"></textarea>
                                            </div>

                                            <div class="col form-group mb-1" style="width: 50%;">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Qty</span>
                                                <input type="number" class="form-control form-control-sm" id="qty" name="qty" style="border-color:#9ca0a7;"/>
                                            </div>

                                            <div class="col form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Harga Satuan</span>
                                                <input type="number" class="form-control form-control-sm" id="hrgSatuan" name="hrgSatuan" style="border-color:#9ca0a7;"/>
                                            </div>

                                            <div class="col form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Tot Harga</span>
                                                <input type="text" class="form-control form-control-sm" id="totHarga" name="totHarga" style="border-color:#9ca0a7;" readonly/>
                                            </div>
                                        {{-- </div> --}}
                                    </div>                                    

                                    <div class="row">
                                        <div class="col text-end mb-1">
                                            <button type="button"
                                            class="col btn btn-sm btn-success align-items-center mb-1 addListTool"
                                            id="addListTool">
                                            <span class="btn-inner--icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1z"/>
                                                    <path fill-rule="evenodd" d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708z"/>
                                                </svg>
                                            </span>
                                            <span> Add To List Tool</span></button>
                                        </div>
                                    </div>
                                    <hr style="border: 1px solid" class="mt-1 mb-1">
                                    
                                    <div class="row" id="tabelBrg">

                                        <div class="table table-responsive">
                                            <table class="table table-striped table-bordered align-items-center mb-0"
                                                style="font-size: 12px; border-color:#9ca0a7;" id="tabelPurchase"
                                                name="tabelPurchase">
                                                <thead class="bg-secondary text-white">
                                                    <tr>
                                                        {{-- <th>#</th> --}}
                                                        <th class="text-center">Nama Barang</th>
                                                        <th class="text-center">Merk</th>
                                                        <th class="text-center">Satuan</th>
                                                        <th class="text-center">Spesifikasi</th>
                                                        <th class="text-center" style="width: 5%;">Qty</th>
                                                        <th class="text-center">Harga</th>
                                                        <th class="text-center">Total Harga</th>
                                                        <th class="text-center">#</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbodyList">
                                                </tbody>

                                            </table>
                                        </div>

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
                    <div class="modal-header pb-1">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Data Tool</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateTool') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-1">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <input class="form-control form-control-sm" type="hidden"
                                                    id="namaToolShowId" name="namaToolShowId" readonly>

                                                <span class="text-xs">Nama Tool</span>
                                                <select class="form-control form-control-sm"
                                                    id="namaToolShow" name="namaToolShow" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Tool</option>
                                                    @if (isset($namaTool))
                                                        @foreach ($namaTool as $nt )
                                                            <option value="{{ $nt->nama_tool }}">{{ $nt->nama_tool}}</option>
                                                        @endforeach
                                                        
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Merk</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="merkShow" name="merkShow" style="border-color:#9ca0a7;">
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Satuan</span>
                                                <input type="text" class="form-control form-control-sm" id="satuanShow"
                                                    name="satuanShow" style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Spesifikasi</span>
                                                <textarea class="form-control form-control-sm" id="spesifikasiShow" name="spesifikasiShow"
                                                    style="border-color:#9ca0a7;"></textarea>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group mb-1">
                                                <span class="text-xs">Tanggal Penerimaan Tool</span>
                                                <input class="form-control form-control-sm" type="date"
                                                    value="{{ date('Y-m-d') }}" id="tglPenerimaanShow"
                                                    name="tglPenerimaanShow" style="border-color:#9ca0a7;">
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kondisi</span>
                                                <select class="form-control form-control-sm" id="kondisiShow"
                                                    name="kondisiShow" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Kondisi</option>
                                                    <option value="Baik">Baik</option>
                                                    <option value="Rusak">Rusak</option>
                                                    <option value="Hilang">Hilang</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kode Aset</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="kodeAsetShow" name="kodeAsetShow"
                                                    style="border-color:#9ca0a7;text-transform:uppercase;">
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kode GA</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="kodeGAShow" name="kodeGAShow" style="border-color:#9ca0a7;text-transform:uppercase;">
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
                                                    name="fotoToolShow" type="file" style="border-color:#9ca0a7;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row text-center mb-1">
                                        <div class="col">
                                            
                                            <button type="submit"
                                                    class="btn btn-sm btn-dark align-items-center updateTool"
                                                    id="updateTool">Update Data</button>
                                            
                                            <button type="button" value="close"
                                                class="btn btn-sm btn-dark align-items-center"
                                                data-bs-dismiss="modal">Kembali</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-1 mt-0">
                            <div class="d-flex justify-content-between">
                                <div>Riwayat Tool</div>
                                <div><p><small class="text-xs text-muted toold"></small></p></div>
                           </div>
                            {{-- <div class="row mb-1">
                                <p class="mb-1">Riwayat Tool</p>
                            </div> --}}

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
                            {{-- <div class="row text-center mb-1"> --}}
                                {{-- <div class="col "> --}}
                                    {{-- <button type="submit" class="btn btn-sm btn-dark align-items-center showSimpan"
                                        id="showSimpan">Simpan Data</button> --}}
                                    {{-- <button type="button" value="close"
                                        class="btn btn-sm btn-dark align-items-center"
                                        data-bs-dismiss="modal">Kembali</button> --}}
                                {{-- </div> --}}
                            {{-- </div> --}}
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
                                        name="kodeAsetShowDis" style="border-color:#9ca0a7;text-transform:uppercase;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Kode GA</span>
                                    <input class="form-control form-control-sm" type="text" id="kodeGAShowDis"
                                        name="kodeGAShowDis" style="border-color:#9ca0a7;text-transform:uppercase;" readonly>
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

        {{-- Modal Detail Pengembalian GA Tool --}}
        <div class="modal fade" id="showKembaliGA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Pengembalian Tool ke GA</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="{{ route('simpanPengembalianGA') }}" method="post" enctype="multipart/form-data"> --}}
                            {{-- @csrf --}}
                            <div class="row">
                                
                                <div class="col">
                                    {{-- <div class="form-group mb-1">
                                        <span class="text-xs">Pilih Tool</span>
                                        <div class="input-group">
                                            <select class="form-control form-control-sm" type="text"
                                                id="pilihTool" name="pilihTool" style="border-color:#9ca0a7;"
                                                required>
                                                <option value="">Pilih Tool</option>
                                            </select>
                                        </div>
                                        <input type="hidden" id="disId" name="disId" readonly required>
                                    </div> --}}

                                    <div class="form-group mb-1">
                                        {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                        <span class="text-xs">Nama Tool</span>
                                        <input type="hidden" id="namaToolidGAShow" name="namaToolidGAShow" readonly required>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm" type="text" id="namaToolGAShow"
                                                name="namaToolGAShow" style="border-color:#9ca0a7;" readonly required>
                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Merk</span>
                                        <input class="form-control form-control-sm" type="text" id="merkGAShow"
                                            name="merkGAShow" style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Satuan</span>
                                        <input type="text" class="form-control form-control-sm" id="satuanGAShow"
                                            name="satuanGAShow" style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                        <span class="text-xs">Spesifikasi</span>
                                        <textarea class="form-control form-control-sm" id="spesifikasiGAShow" name="spesifikasiGAShow" style="border-color:#9ca0a7;"
                                            readonly></textarea>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group mb-1">
                                        <span class="text-xs">Tanggal Penerimaan Tool dari GA</span>
                                        <input class="form-control form-control-sm" type="date"
                                            value="{{ date('Y-m-d') }}" id="tglPengadaanGAShow" name="tglPengadaanGAShow"
                                            style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Tanggal Pengembalian Tool ke GA</span>
                                        <input class="form-control form-control-sm" type="date"
                                            value="{{ date('Y-m-d') }}" id="tglPengembalianGAShow" name="tglPengembalianGAShow"
                                            style="border-color:#9ca0a7;" readonly>
                                    </div>



                                    <div class="row form-group mb-1">
                                        <div class="col">
                                            <span class="text-xs">Kondisi</span>
                                            <input type="text" class="form-control form-control-sm" id="kondisiGAShow"
                                                name="kondisiGAShow" style="border-color:#9ca0a7;" readonly>
                                        </div>
                                        <div class="col">
                                            <span class="text-xs">Status Pengembalian</span>
                                            <input class="form-control form-control-sm" type="text"
                                                value="Dikembalikan ke GA" id="statPengembalianGAShow" name="statPengembalianGAShow"
                                                style="border-color:#9ca0a7;" readonly>
                                        </div>
                                    </div>

                                    <div class="row form-group mb-1">
                                        <div class="col">
                                            <span class="text-xs">Kode Aset</span>
                                            <input class="form-control form-control-sm" type="text" id="kodeAsetGAShow"
                                                name="kodeAsetGAShow" style="border-color:#9ca0a7;text-transform:uppercase;" readonly>
                                        </div>
                                        <div class="col">
                                            <span class="text-xs">Kode GA</span>
                                            <input class="form-control form-control-sm" type="text" id="kodeGAGAShow"
                                                name="kodeGAGAShow" style="border-color:#9ca0a7;text-transform:uppercase;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Dikembalikan Oleh</span>
                                        <input class="form-control form-control-sm" type="text"
                                            id="nikPengembalianGAShow" name="nikPengembalianGAShow"
                                            style="border-color:#9ca0a7;" readonly>
                                    </div>

                                </div>

                                <div class="col">
                                    {{-- <div class="row"> --}}

                                        {{-- <div class="col form-group mb-1 text-center">
                                            <span class="text-xs">Foto Penerimaan Tool</span>
                                            <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                id="showgambarPenerimaanGAShow" alt="Card Image"
                                                style="width:160px;height: 160px;" />
                                        </div> --}}
                                        <span class="text-xs">Foto Pengembalian Tool</span>
                                        <div class="form-group mb-1 text-center">
                                            
                                            <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                id="showgambarKembaliGAShow" alt="Card Image"
                                                style="width:160px;height: 160px;" />
                                        </div>


                                    {{-- </div> --}}

                                    <div class="form-group mb-1">
                                        <input class="form-control form-control-sm" id="fotoKembaliToolGAShow"
                                            name="fotoKembaliToolGAShow" type="file" style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Keterangan</span>
                                        <textarea class="form-control form-control-sm" id="keteranganGAShow" name="keteranganGAShow" style="border-color:#9ca0a7;" readonly></textarea>
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
                    {{-- <div class="modal-footer"> --}}
                        {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                        {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        {{-- End Modal Detail pengembalian GA Tool --}}

        {{-- Modal Show Approve1 --}}
        <div class="modal fade" id="ShowApp1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Persetujuan 1</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="#" enctype="multipart/form-data"> --}}
                            {{-- @csrf --}}
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <input class="form-control form-control-sm" type="hidden"
                                                    id="namaToolApp1Id" name="namaToolApp1Id" readonly>

                                                <span class="text-xs">Nama Tool</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namaToolApp1" name="namaToolApp1"
                                                    style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Merk</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="merkApp1" name="merkApp1" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Satuan</span>
                                                <select class="form-control form-control-sm" id="satuanApp1"
                                                    name="satuanApp1" style="border-color:#9ca0a7;" disabled>
                                                    <option value="">Pilih Satuan</option>
                                                    <option value="Unit">Unit</option>
                                                    <option value="Pcs">Pcs</option>
                                                    <option value="Set">Set</option>

                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Spesifikasi</span>
                                                <textarea class="form-control form-control-sm" id="spesifikasiApp1" name="spesifikasiApp1"
                                                    style="border-color:#9ca0a7;" readonly></textarea>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group mb-1">
                                                <span class="text-xs">Tanggal Penerimaan Tool</span>
                                                <input class="form-control form-control-sm" type="date"
                                                    value="{{ date('Y-m-d') }}" id="tglPenerimaanApp1"
                                                    name="tglPenerimaanApp1" style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kondisi</span>
                                                <select class="form-control form-control-sm" id="kondisiApp1"
                                                    name="kondisiApp1" style="border-color:#9ca0a7;" disabled>
                                                    <option value="">Pilih Kondisi</option>
                                                    <option value="Baik">Baik</option>
                                                    <option value="Rusak">Rusak</option>
                                                    <option value="Hilang">Hilang</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kode Aset</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="kodeAsetApp1" name="kodeAsetApp1"
                                                    style="border-color:#9ca0a7;text-transform:uppercase;" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kode GA</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="kodeGAApp1" name="kodeGAApp1" style="border-color:#9ca0a7;text-transform:uppercase;"
                                                    readonly>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <div class="form-group mb-1">
                                                <span class="text-xs">Nik Penerima Tool</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="nikpenerimaApp1" name="nikpenerimaApp1" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Nama Penerima</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namapenerimaApp1" name="namapenerimaApp1" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                            <div class="row form-group mb-1">
                                                <div class="col">
                                                <span class="text-xs">Departemen</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="departemenApp1" name="departemenApp1" style="border-color:#9ca0a7;"
                                                    readonly>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Posisi</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="posisiApp1" name="posisiApp1" style="border-color:#9ca0a7;"
                                                        readonly>
                                                    </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Branch</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namaBranchApp1" name="namaBranchApp1" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <span class="text-xs">Foto Tool</span>
                                            <div class="form-group mb-1 text-center">

                                                <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                    id="showgambarApp1" alt="Card Image"
                                                    style="width:200px;height: 200px;" />
                                            </div>

                                            <div class="form-group mb-1">
                                                <input class="form-control form-control-sm" id="fotoToolApp1"
                                                    name="fotoToolApp1" type="file" style="border-color:#9ca0a7;"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-0">

                            <div class="row">
                                <div class="col">
                                    <div class="row form-group mb-1">
                                        {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                        {{-- <input class="form-control form-control-sm" type="hidden"
                                            id="namaToolApp1Id" name="namaToolApp1Id" readonly> --}}
                                        <div class="col">
                                            <span class="text-xs">Persetujuan 1</span>
                                            <input class="form-control form-control-sm" type="text"
                                                id="namaApp1" name="namaApp1"
                                                style="border-color:#9ca0a7;" 
                                                value="{{ isset($loginApp1) ? $loginApp1->nama_karyawan : '-' }}" readonly>
                                        </div>
                                        <div class="col">
                                            <span class="text-xs">Tanggal</span>
                                            <input class="form-control form-control-sm" type="date" value="{{ date('Y-m-d') }}"
                                                id="tglApp1" name="tglApp1" style="border-color:#9ca0a7;" required>
                                        </div>
                                        <div class="col">
                                            <span class="text-xs">Status</span>
                                            <select class="form-control form-control-sm" type="text"
                                                id="statusApp1" name="statusApp1" style="border-color:#9ca0a7;" required>
                                                {{-- <option value="">Pilih Status</option> --}}
                                                <option value="Approved" selected>Approved</option>
                                                <option value="Reject">Reject</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <span class="text-xs">Keterangan</span>
                                            <textarea class="form-control form-control-sm" id="keteranganApp1" name="keteranganApp1"
                                                style="border-color:#9ca0a7;"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center mb-0">
                                <div class="col mb-0">
                                    {{-- <button type="submit" class="btn btn-sm btn-dark align-items-center showSimpan"
                                        id="showSimpan">Simpan Data</button> --}}
                                    @if ($loginApp1->email == $login->email )
                                            
                                        <button type="button" class="btn btn-sm btn-dark align-items-center mb-0"
                                        id="action1" name="action" value="Approve1">Simpan Persetujuan 1</button>
                                    @else
                                        <button type="button" class="btn btn-sm btn-secondary align-items-center" disabled>
                                        Simpan Persetujuan 1</button>
                                    @endif
                                    
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <p>Riwayat Persetujuan 1</p>
                            </div>

                            <div class="row">
                                <div class="table-responsive p-0">
                                    <table class="table table-striped table-bordered align-items-center mb-0"
                                        id="tabelRiwayatApp1" style="font-size: 12px">
                                        <thead class="bg-gray-100">
                                            <tr id="headShowApprove1">
                                                <th class="text-xs font-weight-semibold">#</th>
                                                <th class="text-center text-xs font-weight-semibold">Tanggal</th>
                                                <th class="text-center text-xs font-weight-semibold">Nama Approval 1</th>
                                                <th class="text-center text-xs font-weight-semibold">Status</th>
                                                <th class="text-center text-xs font-weight-semibold">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyShowApprove1">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-end mb-1">
                                <div class="col ">
                                    {{-- <button type="submit" class="btn btn-sm btn-dark align-items-center showSimpan"
                                        id="showSimpan">Simpan Data</button> --}}
                                    <button type="button" value="close"
                                        class="btn btn-sm btn-dark align-items-center"
                                        data-bs-dismiss="modal">Kembali</button>
                                </div>
                            </div>
                        {{-- </form> --}}
                    </div>
                    {{-- <div class="modal-footer"> --}}
                    {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                    {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        {{-- End Modal Show Approve1 --}}

        {{-- Modal Show Approve2 --}}
        <div class="modal fade" id="ShowApp2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Persetujuan 2</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="{{ route('simpanApproval')}}" method="post" enctype="multipart/form-data"> --}}
                            {{-- @csrf --}}
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <input class="form-control form-control-sm" type="hidden"
                                                    id="namaToolApp2Id" name="namaToolApp2Id" readonly>

                                                <span class="text-xs">Nama Tool</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namaToolApp2" name="namaToolApp2"
                                                    style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Merk</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="merkApp2" name="merkApp2" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Satuan</span>
                                                <select class="form-control form-control-sm" id="satuanApp2"
                                                    name="satuanApp2" style="border-color:#9ca0a7;" disabled>
                                                    <option value="">Pilih Satuan</option>
                                                    <option value="Unit">Unit</option>
                                                    <option value="Pcs">Pcs</option>
                                                    <option value="Set">Set</option>

                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Spesifikasi</span>
                                                <textarea class="form-control form-control-sm" id="spesifikasiApp2" name="spesifikasiApp2"
                                                    style="border-color:#9ca0a7;" readonly></textarea>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group mb-1">
                                                <span class="text-xs">Tanggal Penerimaan Tool</span>
                                                <input class="form-control form-control-sm" type="date"
                                                    value="{{ date('Y-m-d') }}" id="tglPenerimaanApp2"
                                                    name="tglPenerimaanApp2" style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kondisi</span>
                                                <select class="form-control form-control-sm" id="kondisiApp2"
                                                    name="kondisiApp2" style="border-color:#9ca0a7;" disabled>
                                                    <option value="">Pilih Kondisi</option>
                                                    <option value="Baik">Baik</option>
                                                    <option value="Rusak">Rusak</option>
                                                    <option value="Hilang">Hilang</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kode Aset</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="kodeAsetApp2" name="kodeAsetApp2"
                                                    style="border-color:#9ca0a7;text-transform:uppercase;" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kode GA</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="kodeGAApp2" name="kodeGAApp2" style="border-color:#9ca0a7;text-transform:uppercase;"
                                                    readonly>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <div class="form-group mb-1">
                                                <span class="text-xs">Nik Penerima Tool</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="nikpenerimaApp2" name="nikpenerimaApp2" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Nama Penerima</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namapenerimaApp2" name="namapenerimaApp2" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                            <div class="row form-group mb-1">
                                                <div class="col">
                                                <span class="text-xs">Departemen</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="departemenApp2" name="departemenApp2" style="border-color:#9ca0a7;"
                                                    readonly>
                                                </div>

                                                <div class="col">
                                                    <span class="text-xs">Posisi</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="posisiApp2" name="posisiApp2" style="border-color:#9ca0a7;"
                                                        readonly>
                                                    </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Branch</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namaBranchApp2" name="namaBranchApp2" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <span class="text-xs">Foto Tool</span>
                                            <div class="form-group mb-1 text-center">

                                                <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                    id="showgambarApp2" alt="Card Image"
                                                    style="width:200px;height: 200px;" />
                                            </div>

                                            <div class="form-group mb-1">
                                                <input class="form-control form-control-sm" id="fotoToolApp2"
                                                    name="fotoToolApp2" type="file" style="border-color:#9ca0a7;"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-0">

                            <div class="row">
                                <div class="col">
                                    <div class="row form-group mb-1">
                                        {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                        {{-- <input class="form-control form-control-sm" type="hidden"
                                            id="namaToolApp1Id" name="namaToolApp1Id" readonly> --}}
                                        <div class="col">
                                            <span class="text-xs">Persetujuan 2</span>
                                            <input class="form-control form-control-sm" type="text"
                                                id="namaApp2" name="namaApp2"
                                                style="border-color:#9ca0a7;" 
                                                value="{{ isset($loginApp2) ? $loginApp2->nama_karyawan : '-' }}" readonly>
                                        </div>
                                        <div class="col">
                                            <span class="text-xs">Tanggal</span>
                                            <input class="form-control form-control-sm" type="date" value="{{ date('Y-m-d') }}"
                                                id="tglApp2" name="tglApp2" style="border-color:#9ca0a7;" required>
                                        </div>
                                        <div class="col">
                                            <span class="text-xs">Status</span>
                                            <select class="form-control form-control-sm" type="text"
                                                id="statusApp2" name="statusApp2" style="border-color:#9ca0a7;" required>
                                                {{-- <option value="">Pilih Status</option> --}}
                                                <option value="Approved" selected>Approved</option>
                                                <option value="Reject">Reject</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <span class="text-xs">Keterangan</span>
                                            <textarea class="form-control form-control-sm" id="keteranganApp2" name="keteranganApp2"
                                                style="border-color:#9ca0a7;"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center mb-0">
                                <div class="col mb-0">
                                    {{-- <button type="submit" class="btn btn-sm btn-dark align-items-center showSimpan"
                                        id="showSimpan">Simpan Data</button> --}}
                                    @if ($loginApp2->email == $login->email )
                                            
                                        <button type="button" class="btn btn-sm btn-dark align-items-center mb-0"
                                        id="action2" name="action" value="Approve2">Simpan Persetujuan 2</button>
                                    @else
                                        <button type="button" class="btn btn-sm btn-secondary align-items-center" disabled>
                                            Simpan Persetujuan 2</button>
                                    @endif
                                    
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <p>Riwayat Persetujuan 2</p>
                            </div>

                            <div class="row">
                                <div class="table-responsive p-0">
                                    <table class="table table-striped table-bordered align-items-center mb-0"
                                        id="tabelRiwayatApp2" style="font-size: 12px">
                                        <thead class="bg-gray-100">
                                            <tr id="headShowApprove2">
                                                <th class="text-xs font-weight-semibold">#</th>
                                                <th class="text-center text-xs font-weight-semibold">Tanggal</th>
                                                <th class="text-center text-xs font-weight-semibold">Nama Approval 2</th>
                                                <th class="text-center text-xs font-weight-semibold">Status</th>
                                                <th class="text-center text-xs font-weight-semibold">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyShowApprove2">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-end mb-1">
                                <div class="col ">
                                    {{-- <button type="submit" class="btn btn-sm btn-dark align-items-center showSimpan"
                                        id="showSimpan">Simpan Data</button> --}}
                                    <button type="button" value="close"
                                        class="btn btn-sm btn-dark align-items-center"
                                        data-bs-dismiss="modal">Kembali</button>
                                </div>
                            </div>
                        {{-- </form> --}}
                    </div>
                    {{-- <div class="modal-footer"> --}}
                    {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                    {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        {{-- End Modal Show Approve2 --}}

        {{-- Modal Detail Click Rekap Data Tool --}}
        <div class="modal fade" id="DetailClickTool" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="mb-0">Detail Rekap Tool</h6>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        
                    </div>
                    <style>
                        .tableFixHead          { overflow-y: auto; max-height: 400px; }
                        .tableFixHead thead th {position: sticky;  top: 0; }
                        .tableFixHead th { background: #495057; }

                        .clickable {background: #bcd1e5;}
                    </style>
                    <div class="modal-body">
                        <div class="row">
                            <p class="col text-sm mb-1" id="subtitel">testing</p>
                            <p class="col text-sm mb-1 text-end">
                                <span class="badge badge-dark  text-white" 
                                onclick="clearSelection()" style="cursor:pointer">clear Selection</span>
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="table-responsive tableFixHead" style="min-heigth: 100px; max-height: 300px">
                                    <table class="table table-sm table-bordered align-items-center mb-3" style="font-size: 12px;"
                                        id="tabelDetClickToolBranch">
                                        <thead class="bg-gray-700 text-white" >
                                            <tr id="headBranchTool">
                                                <th class="text-center text-xs font-weight-semibold p-2">#</th>
                                                <th class="text-xs font-weight-semibold" >Branch</th>
                                                <th class="text-xs font-weight-semibold" >Dept.</th>
                                                <th class="text-center text-xs font-weight-semibold" >Jml</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyBranchTool" >

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="table-responsive tableFixHead" style="min-heigth: 100px; max-height: 300px">
                                    <table class="table table-sm table-bordered align-items-center mb-3" style="font-size: 12px;"
                                        id="tabelDetClickToolName">
                                        <thead class="bg-gray-700 text-white" >
                                            <tr id="headToolName">
                                                <th class="text-center text-xs font-weight-semibold p-2">#</th>
                                                <th class="text-xs font-weight-semibold" >Nama Tool</th>
                                                <th class="text-center text-xs font-weight-semibold" >Jml</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyToolName" >

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            {{-- <div class="col"> --}}
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered align-items-center mb-0"
                                        id="tabelDetClickTool" style="font-size: 12px; width:100%">
                                        <thead class="bg-gray-100">
                                            <tr id="headToolList">
                                                <th class="text-xs font-weight-semibold">#</th>
                                                <th class="text-center text-xs font-weight-semibold">Nama</th>
                                                <th class="text-center text-xs font-weight-semibold">Merk</th>
                                                <th class="text-center text-xs font-weight-semibold">Kode Aset</th>
                                                <th class="text-center text-xs font-weight-semibold">Kode GA</th>
                                                <th class="text-center text-xs font-weight-semibold">Branch</th>
                                                <th class="text-center text-xs font-weight-semibold">Kondisi</th>
                                                <th class="text-center text-xs font-weight-semibold">Status</th>
                                                <th class="text-center text-xs font-weight-semibold">Posisi</th>
                                                {{-- <th class="text-center text-xs font-weight-semibold">Approval 1 Penerimaan Tool</th> --}}
                                                {{-- <th class="text-center text-xs font-weight-semibold">Approval 2 Penerimaan Tool</th> --}}
                                                {{-- <th class="text-center text-xs font-weight-semibold">#</th> --}}
    
                                            </tr>
                                        </thead>
                                        <tbody id="bodyToolList">
    
                                        </tbody>
                                    </table>
                                </div>
                            {{-- </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Kembali</button>
                    {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Detail Click Rekap Data Tool --}}

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

    $(document).on('keyup', '#hrgSatuan', function() {
            jml = document.getElementById('qty').value;
            hrg = document.getElementById('hrgSatuan').value;
            tot = jml * hrg
            $('#totHarga').val(tot.toLocaleString())
    })

    $(document).on('keyup', '#qty', function() {
            jml = document.getElementById('qty').value;
            hrg = document.getElementById('hrgSatuan').value;
            tot = jml * hrg
            $('#totHarga').val(tot.toLocaleString())
    })
    
    $('#addListTool').click(function(e) {
        console.log('nama tool : ',  $('#namaTool').val());

        if($('#noPengajuan').val() == "") {
            alert('Lengkapi Nomor PO terlebih dahulu.');
            return null;
        }

        if($('#namaTool').val() == "") {
            alert('Lengkapi data tool terlebih dahulu.');
            return null;
        }

        $('#tbodyList').append(
            `<tr>
            <td><input type="hidden" name="brg_id[]" value="${$('#namaTool').val()}|${$('#merk').val()}|${$('#satuan').val()}|${$('#spesifikasi').val()}|${$('#qty').val()}|${$('#hrgSatuan').val()}|${$('#totHarga').val()}" readonly>
                ${$('#namaTool').val()}
            </td>
            <td>${$('#merk').val()}</td>
            <td class="text-center">${$('#satuan').val()}</td>
            <td>${$('#spesifikasi').val()}</td>
            <td class="text-center">${$('#qty').val()}</td>
            <td class="text-end">${$('#hrgSatuan').val()}</td>
            <td class="text-end">${$('#totHarga').val()}</td>
            <td class="text-center"><input type="Button" onclick="deleteRow(this)" value="x" class="btn btn-sm btn-danger me-0 mb-0 px-1 py-1"></td>
            </tr>`
        )

        $('#namaTool').val("")
        $('#merk').val("")
        $('#spesifikasi').val("");
        $('#satuan').val("");
        $('#qty').val("");
        $('#hrgSatuan').val("");
        $('#totHarga').val("");

        })

        function deleteRow(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("tabelPurchase").deleteRow(i);
        }
</script>

<script>
    $(document).ready(function() {
        var listBranch;
        var listToolRekap;
        var listToolN;
        var listToolData;
    })
</script>

<script>

    //klik di tabel rekap tool, get data
    function detRekap_click(did) {
        var _token = $('meta[name=csrf-token]').attr('content');
        $('#DetailClickTool').modal('show');

        $.ajax({
            url: "{{ route('getDetailRekap_click' )}}",
            type: "get",
            data: {
                _token: _token,
                filClick: did,
            },
            success: function(detailRkp) {
                listBranch ;
                listToolN ;
                listToolRekap ;
                listToolData ;

                click = did.split("|");
                if(click[1] === "Subtotal") {
                    subtit = "Posisi Tool " + click[0];
                } else {
                    subtit = "Posisi Tool " + click[0] + " - Kondisi " + click[1];
                }

                $('#bodyBranchTool').find('tr').remove();
                $('#bodyToolName').find('tr').remove();

                branch = "";
                toolN = "";
                toolL = "";
                for(b=0;b<detailRkp.branchList.length;b++){
                    branch = branch + `<tr id="${detailRkp.branchList[b].branch_penerima}|${detailRkp.branchList[b].departement}" onclick="detRekapBranch_click(this.id)"> 
                            <td class="text-center" style="font-weight:500">${b + 1}</td>
                            <td style="font-weight:500;cursor:pointer">${detailRkp.branchList[b].branch_penerima}</td>
                            <td style="font-weight:500;cursor:pointer">${detailRkp.branchList[b].departement}</td>
                            <td class="text-center" style="font-weight:500">${detailRkp.branchList[b].jml}</td>
                          </tr>`;
                }

                $('#bodyBranchTool').append(branch);

                for(b=0;b<detailRkp.rekapTool.length;b++){
                    toolN = toolN + `<tr>
                            <td class="text-center" style="font-weight:500">${b + 1}</td>
                            <td style="font-weight:500">${detailRkp.rekapTool[b].nama_barang}</td>
                            <td class="text-center" style="font-weight:500">${detailRkp.rekapTool[b].jml}</td>
                          </tr>`;
                }

                $('#bodyToolName').append(toolN);

                $('#tabelDetClickTool').DataTable().clear().destroy();

                for(t=0;t<detailRkp.listTool.length;t++){
                    toolL = toolL + `<tr>
                            <td class="text-center" style="font-weight:500">${t + 1}</td>
                            <td style="font-weight:500">${detailRkp.listTool[t].nama_barang}</td>
                            <td style="font-weight:500">${detailRkp.listTool[t].merk_barang}</td>
                            <td style="font-weight:500">${detailRkp.listTool[t].kode_aset}</td>
                            <td style="font-weight:500">${detailRkp.listTool[t].kode_ga}</td>
                            <td style="font-weight:500">${detailRkp.listTool[t].branch_penerima}</td>
                            <td style="font-weight:500">${detailRkp.listTool[t].kondisi}</td>
                            <td style="font-weight:500">${detailRkp.listTool[t].status_distribusi}</td>
                            <td style="font-weight:500">${detailRkp.listTool[t].posisi}</td>
                          </tr>`;
                }

                $('#bodyToolList').append(toolL);

                tabelList = $('#tabelDetClickTool').DataTable({
                    // processing: true,
                    // paging: true,
                    // destroy: true,
                    // retrieve: true,
                    layout: {
                        topStart: {
                            pageLength: {
                                menu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                            } ,
                            buttons: ['excel'],
                        },
                    
                    },
                });

                tabelList
                    .on('order.dt search.dt', function () {
                        var i = 1;
 
                        tabelList
                        .cells(null, 0, { search: 'applied', order: 'applied' })
                        .every(function (cell) {
                            this.data(i++);
                        });
                })
                .draw();

                document.querySelectorAll('#subtitel').forEach(function(elem) {
                    elem.innerText = subtit;
                })
                
                
                // tblDetailList.draw();
            }
        })

        // $('#tabelDetClickTool').DataTable().columns.adjust().draw();
        
    }

    //klick tabel detail branch, langsung filter tool & listdata
    function detRekapBranch_click(branch){
        
        //background table selected/clickable
        $('#bodyBranchTool').find('tr').removeClass();
        document.getElementById(branch).setAttribute("class","clickable");

        branchClick = branch.split("|");
        filToolBranch = listToolN.filter(k => k.branch_penerima === branchClick[0] && k.departement == branchClick[1]);
        filDataTool = listToolData.filter(k => k.branch_penerima === branchClick[0] && k.departement == branchClick[1]);

        $('#bodyToolName').find('tr').remove();
        toolN = "";
        for(b=0;b<filToolBranch.length;b++){
                    toolN = toolN + `<tr id="${branch+"|"+filToolBranch[b].nama_barang}" onclick="detRekapName_click(this.id)">
                            <td class="text-center" style="font-weight:500">${b + 1}</td>
                            <td style="font-weight:500;cursor:pointer">${filToolBranch[b].nama_barang}</td>
                            <td class="text-center" style="font-weight:500">${filToolBranch[b].jml}</td>
                          </tr>`;
                }

        $('#bodyToolName').append(toolN);

        $('#tabelDetClickTool').DataTable().clear().destroy();

        toolL = "";
        for(t=0;t<filDataTool.length;t++){
            toolL = toolL + `<tr>
                    <td class="text-center" style="font-weight:500">${t + 1}</td>
                    <td style="font-weight:500">${filDataTool[t].nama_barang}</td>
                    <td style="font-weight:500">${filDataTool[t].merk_barang}</td>
                    <td style="font-weight:500">${filDataTool[t].kode_aset}</td>
                    <td style="font-weight:500">${filDataTool[t].kode_ga}</td>
                    <td style="font-weight:500">${filDataTool[t].branch_penerima}</td>
                    <td style="font-weight:500">${filDataTool[t].kondisi}</td>
                    <td style="font-weight:500">${filDataTool[t].status_distribusi}</td>
                    <td style="font-weight:500">${filDataTool[t].posisi}</td>
                    </tr>`;
        }

        $('#bodyToolList').append(toolL);

        tabelList = $('#tabelDetClickTool').DataTable({
                        // processing: true,
                        // paging: true,
                        // destroy: true,
                        // retrieve: true,
                        layout: {
                            topStart: {
                                pageLength: {
                                    menu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                                } ,
                                buttons: ['excel'],
                            },
                    
                        },
                    });

        tabelList
            .on('order.dt search.dt', function () {
                var i = 1;
 
                tabelList
                    .cells(null, 0, { search: 'applied', order: 'applied' })
                    .every(function (cell) {
                        this.data(i++);
                    });
            })
        .draw();

    }

    function detRekapName_click(name){
        $('#bodyToolName').find('tr').removeClass();
        document.getElementById(name).setAttribute("class","clickable");

        branchTool = name.split("|");

        filBranchToolName = listToolData.filter(k => k.branch_penerima === branchTool[0] && k.departement === branchTool[1] && k.nama_barang === branchTool[2]);

        $('#tabelDetClickTool').DataTable().clear().destroy();

        toolL = "";
        for(t=0;t<filBranchToolName.length;t++){
            toolL = toolL + `<tr>
                    <td class="text-center" style="font-weight:500">${t + 1}</td>
                    <td style="font-weight:500">${filBranchToolName[t].nama_barang}</td>
                    <td style="font-weight:500">${filBranchToolName[t].merk_barang}</td>
                    <td style="font-weight:500">${filBranchToolName[t].kode_aset}</td>
                    <td style="font-weight:500">${filBranchToolName[t].kode_ga}</td>
                    <td style="font-weight:500">${filBranchToolName[t].branch_penerima}</td>
                    <td style="font-weight:500">${filBranchToolName[t].kondisi}</td>
                    <td style="font-weight:500">${filBranchToolName[t].status_distribusi}</td>
                    <td style="font-weight:500">${filBranchToolName[t].posisi}</td>
                    </tr>`;
        }

        $('#bodyToolList').append(toolL);

        tabelList = $('#tabelDetClickTool').DataTable({
                        // processing: true,
                        // paging: true,
                        // destroy: true,
                        // retrieve: true,
                        layout: {
                            topStart: {
                                pageLength: {
                                    menu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                                } ,
                                buttons: ['excel'],
                            },
                    
                        },
                    });

        tabelList
            .on('order.dt search.dt', function () {
                var i = 1;
 
                tabelList
                    .cells(null, 0, { search: 'applied', order: 'applied' })
                    .every(function (cell) {
                        this.data(i++);
                    });
            })
        .draw();

    }

    function clearSelection(){
        $('#bodyBranchTool').find('tr').remove();
        $('#bodyToolName').find('tr').remove();

        branch = "";
        toolN = "";
        toolL = "";
        for(b=0;b<listBranch.length;b++){
            branch = branch + `<tr id="${listBranch[b].branch_penerima}|${listBranch[b].departement}" onclick="detRekapBranch_click(this.id)"> 
                            <td class="text-center" style="font-weight:500">${b + 1}</td>
                            <td style="font-weight:500;cursor:pointer">${listBranch[b].branch_penerima}</td>
                            <td class="text-center" style="font-weight:500">${listBranch[b].jml}</td>
                          </tr>`;
        }

        $('#bodyBranchTool').append(branch);

        for(b=0;b<listToolRekap.length;b++){
            toolN = toolN + `<tr>
                            <td class="text-center" style="font-weight:500">${b + 1}</td>
                            <td style="font-weight:500">${listToolRekap[b].nama_barang}</td>
                            <td class="text-center" style="font-weight:500">${listToolRekap[b].jml}</td>
                          </tr>`;
        }

        $('#bodyToolName').append(toolN);

        $('#tabelDetClickTool').DataTable().clear().destroy();

        for(t=0;t<listToolData.length;t++){
                toolL = toolL + `<tr>
                            <td class="text-center" style="font-weight:500">${t + 1}</td>
                            <td style="font-weight:500">${listToolData[t].nama_barang}</td>
                            <td style="font-weight:500">${listToolData[t].merk_barang}</td>
                            <td style="font-weight:500">${listToolData[t].kode_aset}</td>
                            <td style="font-weight:500">${listToolData[t].kode_ga}</td>
                            <td style="font-weight:500">${listToolData[t].branch_penerima}</td>
                            <td style="font-weight:500">${listToolData[t].kondisi}</td>
                            <td style="font-weight:500">${listToolData[t].status_distribusi}</td>
                            <td style="font-weight:500">${listToolData[t].posisi}</td>
                          </tr>`;
        }

        $('#bodyToolList').append(toolL);

        tabelList = $('#tabelDetClickTool').DataTable({
                        // processing: true,
                        // paging: true,
                        // destroy: true,
                        // retrieve: true,
                        layout: {
                            topStart: {
                                pageLength: {
                                    menu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                                } ,
                            buttons: ['excel'],
                            },
                    
                        },
                    });

        tabelList
            .on('order.dt search.dt', function () {
                var i = 1;
 
                tabelList
                    .cells(null, 0, { search: 'applied', order: 'applied' })
                    .every(function (cell) {
                        this.data(i++);
                    });
                })
            .draw();
        }
        
</script>

<script>
    $(document).ready(function() {

        var _token = $('meta[name=csrf-token]').attr('content');
        var firstDate;
        var lastDate;
        akses = $('#akses').val();
        toolNm = {!! $namaTool !!};
        

        rekap_tool()
        data_tool()

        $(document).on('change', '#namaTool', function(e) {
            e.preventDefault();
            sat = toolNm.find(k=>k.nama_tool === $(this).val());
            $('#satuan').val(sat.satuan_tool);

        })

        $(document).on('change', '#namaToolShow', function(e) {
            e.preventDefault();
            sat = toolNm.find(k=>k.nama_tool === $(this).val());
            $('#satuanShow').val(sat.satuan_tool);

        })

        $(document).on('click', '#filterData', function(e) {
            e.preventDefault();
            rekap_tool();
            data_tool();
        })

        function rekap_tool() {

            filterAll = $('#filBranch').val() + "|" + $('#filNamaTool').val() + "|" + $('#filPosisi').val() + "|" +  $('#filKondisi').val() + "|" + $('#filCallsign').val() + "|" + $('#filApprove1').val() + "|" + $('#filApprove2').val()
            
            $.ajax({
                url: "{{ route('getRekapTool' )}}",
                type: "get",
                data: {
                    _token: _token,
                    filBranch: $('#filBranch').val(),
                    filNamaTool: $('#filNamaTool').val(),
                    filPosisi: $('#filPosisi').val(),
                    filKondisi: $('#filKondisi').val(),
                    filCallsign: $('#filCallsign').val(),
                    filApprove1: $('#filApprove1').val(),
                    filApprove2: $('#filApprove2').val(),
                },
                success: function(dtRekap) {

                    $('#bodyRekapTool').find('tr').remove();
                    
                    bdRekapTool = "";
                    stotal = [];
                    tbaik = 0;
                    trusak = 0;
                    thilang = 0;
                    ttot = 0;

                    bdRekapToolDs = "";
                    stotalDs = [];
                    tbaikDs = 0;
                    trusakDs = 0;
                    thilangDs = 0;
                    ttotDs = 0;

                    for(p=0; p<dtRekap.length; p++ ){

                        if(dtRekap[p].posisiTool != "Disposal") {
                            stotal[p] = 0;
                            stotal[p] = Number(dtRekap[p].baik) + Number(dtRekap[p].rusak) +Number(dtRekap[p].hilang);
                            tbaik += Number(dtRekap[p].baik); 
                            trusak += Number(dtRekap[p].rusak);
                            thilang += Number(dtRekap[p].hilang);  
                            ttot += stotal[p];
                            bdRekapTool = bdRekapTool + `
                                <tr>
                                    <td style="font-weight:500">${dtRekap[p].posisiTool}</td>
                                    <td class="text-center" style="font-weight:500"><span id="${dtRekap[p].posisiTool + "|Baik|" + filterAll}" onclick="detRekap_click(this.id)" style="cursor:pointer">${dtRekap[p].baik.toLocaleString()}</span></td>
                                    <td class="text-center" style="font-weight:500"><span id="${dtRekap[p].posisiTool + "|Rusak|" + filterAll}" onclick="detRekap_click(this.id)" style="cursor:pointer">${dtRekap[p].rusak.toLocaleString()}</span></td>
                                    <td class="text-center" style="font-weight:500"><span id="${dtRekap[p].posisiTool + "|Hilang|" + filterAll}" onclick="detRekap_click(this.id)" style="cursor:pointer">${dtRekap[p].hilang.toLocaleString()}</span></td>
                                    <td class="text-center" style="font-weight:500"><span id="${dtRekap[p].posisiTool + "|Subtotal|" + filterAll}" onclick="detRekap_click(this.id)" style="cursor:pointer">${stotal[p].toLocaleString()}</span></td>
                                </tr>`;
                        }

                        if(dtRekap[p].posisiTool === "Disposal") {
                            stotalDs[p] = 0;
                            stotalDs[p] = Number(dtRekap[p].baik) + Number(dtRekap[p].rusak) +Number(dtRekap[p].hilang);
                            tbaikDs += Number(dtRekap[p].baik); 
                            trusakDs += Number(dtRekap[p].rusak);
                            thilangDs += Number(dtRekap[p].hilang);  
                            ttotDs += stotal[p];
                            bdRekapToolDs = bdRekapToolDs + `
                                <tr class="bg-gray-600">
                                    <td class="text-white" style="font-weight:500">${dtRekap[p].posisiTool}</td>
                                    <td class="text-center text-white" style="font-weight:500"><span id="${dtRekap[p].posisiTool + "|Baik|" + filterAll}" onclick="detRekap_click(this.id)" style="cursor:pointer">${dtRekap[p].baik.toLocaleString()}</span></td>
                                    <td class="text-center text-white" style="font-weight:500"><span id="${dtRekap[p].posisiTool + "|Rusak|" + filterAll}" onclick="detRekap_click(this.id)" style="cursor:pointer">${dtRekap[p].rusak.toLocaleString()}</span></td>
                                    <td class="text-center text-white" style="font-weight:500"><span id="${dtRekap[p].posisiTool + "|Hilang|" + filterAll}" onclick="detRekap_click(this.id)" style="cursor:pointer">${dtRekap[p].hilang.toLocaleString()}</span></td>
                                    <td class="text-center text-white" style="font-weight:500"><span id="${dtRekap[p].posisiTool + "|Subtotal|" + filterAll}" onclick="detRekap_click(this.id)" style="cursor:pointer">${stotalDs[p].toLocaleString()}</span></td>
                                </tr>`;
                        }
                        
                    }

                    bdRekapTool = bdRekapTool + `
                        <tr class="table-dark">
                            <td class="text-center" style="font-weight:500">Total</td>
                            <td class="text-center" style="font-weight:500"><span style="cursor:pointer">${tbaik.toLocaleString()}</span></td>
                            <td class="text-center" style="font-weight:500"><span style="cursor:pointer">${trusak.toLocaleString()}</span></td>
                            <td class="text-center" style="font-weight:500"><span style="cursor:pointer">${thilang.toLocaleString()}</span></td>
                            <td class="text-center" style="font-weight:500"><span style="cursor:pointer">${ttot.toLocaleString()}</span></td>
                        </tr>
                        
                        <tr>
                            <td style="font-weight:500"></td>
                            <td class="text-center" style="font-weight:500"></td>
                            <td class="text-center" style="font-weight:500"></td>
                            <td class="text-center" style="font-weight:500"></td>
                            <td class="text-center" style="font-weight:500"></td>
                        </tr>`;

                    $('#bodyRekapTool').append(bdRekapTool + bdRekapToolDs);

                    
                }
            })
            
        }

        function data_tool() {
            $('#tabelTool').DataTable({
                // dom: 'Blrtip',
                layout: {
                    topStart: {
                        pageLength: {
                            menu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                        } ,
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
                    url: "{{ route('getDataTool') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        _token: _token,
                        filBranch: $('#filBranch').val(),
                        filNamaTool: $('#filNamaTool').val(),
                        filPosisi: $('#filPosisi').val(),
                        filKondisi: $('#filKondisi').val(),
                        filCallsign: $('#filCallsign').val(),
                        filApprove1: $('#filApprove1').val(),
                        filApprove2: $('#filApprove2').val(),
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_Row_Index',
                        "className": "text-center",
                        // orderable: false,
                        searchable: false,
                        "width": '90'
                    },
                    {
                        data: 'nama_barang',
                        // width: '90'
                    },
                    {
                        data: 'merk_barang'
                    },
                    {
                        data: 'kode_aset'
                    },
                    {
                        data: 'kode_ga'
                    },
                    {
                        data: 'branch_penerima'
                    },
                    {
                        data: 'departement'
                    },
                    {
                        data: 'kondisi'
                    },
                    {
                        data: 'status_distribusi'
                    },
                    {
                        data: 'posisi'
                    },
                    {
                        data: 'app1',
                        "className": "text-center",
                    },
                    {
                        data: 'app2',
                        "className": "text-center",
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }

        $(document).on('change', '#filBranch', function(e) {
            e.preventDefault();
            branch = $(this).val();

            $.ajax({
                url: "{{ route('getCallsignBranch') }}",
                type: "get",
                data: {
                    _token: _token,
                    branch: branch,
                },
                success: function(dtCallsign) {

                    $('#filCallsign').find("option").remove();

                    $('#filCallsign').append(`
                        <option value="ALL">ALL</option>
                    `);

                    $.each(dtCallsign, function(key, item){
                        $('#filCallsign').append(`
                            <option value="${item.callsign_tim}">${item.callsign_tim}</option>
                        
                        `);
                    })
                }
            })
        })

        $(document).on('click', '#action1', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('simpanApproval') }}",
                type: "get",
                data: {
                    _token: _token,
                    action: $(this).val(),
                    namaToolApp1Id: $('#namaToolApp1Id').val(),
                    tglApp1: $('#tglApp1').val(),
                    statusApp1: $('#statusApp1').val(),
                    keteranganApp1: $('#keteranganApp1').val(),
                },
                success: function(resApp1) {

                    if(resApp1=="success"){
                        $('#ShowApp1').modal('hide');

                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Berhasil update Persetujuan 1",
                            showConfirmButton: true,
                            // timer: 2000
                        });

                        $('#tabelTool').DataTable().ajax.reload();
                    } else {
                        $('#ShowApp1').modal('hide');

                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: resApp1,
                            showConfirmButton: true,
                            // timer: 2000
                        });

                        $('#tabelTool').DataTable().ajax.reload();
                    }
                    
                }
            })
        })

        $(document).on('click', '#action2', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('simpanApproval') }}",
                type: "get",
                data: {
                    _token: _token,
                    action: $(this).val(),
                    namaToolApp2Id: $('#namaToolApp2Id').val(),
                    tglApp2: $('#tglApp2').val(),
                    statusApp2: $('#statusApp2').val(),
                    keteranganApp2: $('#keteranganApp2').val(),
                },
                success: function(resApp2) {

                    if(resApp2=="success"){
                        $('#ShowApp2').modal('hide');

                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Berhasil update Persetujuan 2",
                            showConfirmButton: true,
                            // timer: 2000
                        });

                        $('#tabelTool').DataTable().ajax.reload();
                    } else {
                        $('#ShowApp2').modal('hide');

                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: resApp2,
                            showConfirmButton: true,
                            // timer: 2000
                        });

                        $('#tabelTool').DataTable().ajax.reload();
                    }
                    
                }
            })
        })

        $(document).on('click', '#detail-tool', function(e) {
            e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let t_id = $(this).data('id');

            $.ajax({
                url: "{{ route('showDetailTool') }}",
                type: "get",
                data: {
                    filToolId: t_id,
                    _token: _token
                },
                success: function(respon) {

                    if(respon.approve1=="Approved" && respon.approve2 =="Approved"){
                        document.getElementById('namaToolShow').disabled = true;
                        document.getElementById('merkShow').readOnly = true;
                        document.getElementById('satuanShow').disabled = true;
                        document.getElementById('spesifikasiShow').readOnly = true;
                        document.getElementById('tglPenerimaanShow').readOnly = true;
                        document.getElementById('kondisiShow').disabled = true;
                        document.getElementById('kodeAsetShow').readOnly = true;
                        document.getElementById('kodeGAShow').readOnly = true;
                        document.getElementById('fotoToolShow').disabled = true;
                        document.getElementById('updateTool').disabled = true;
                    }else{
                        document.getElementById('namaToolShow').disabled = false;
                        document.getElementById('merkShow').readOnly = false;
                        document.getElementById('satuanShow').disabled = false;
                        document.getElementById('spesifikasiShow').readOnly = false;
                        document.getElementById('tglPenerimaanShow').readOnly = false;
                        document.getElementById('kondisiShow').disabled = false;
                        document.getElementById('kodeAsetShow').readOnly = false;
                        document.getElementById('kodeGAShow').readOnly = false;
                        document.getElementById('fotoToolShow').disabled = false;
                        document.getElementById('updateTool').disabled = false;
                        
                        
                    }

                        $('#namaToolShowId').val('')
                        $('#namaToolShow').val('')
                        $('#merkShow').val('')
                        $('#satuanShow').val('')
                        $('#spesifikasiShow').val('')
                        $('#tglPenerimaanShow').val('')
                        $('#kondisiShow').val('')
                        $('#kodeAsetShow').val('')
                        $('#kodeGAShow').val('')
                        $('#showgambarShow').val('')
                        $('#fotoToolShow').val('')

                    $('#namaToolShowId').val(respon.id)
                    $('.toold').text(respon.id)
                    $('#namaToolShow').val(respon.nama_barang)
                    $('#merkShow').val(respon.merk_barang)
                    $('#satuanShow').val(respon.satuan)
                    $('#spesifikasiShow').val(respon.spesifikasi)
                    $('#tglPenerimaanShow').val(respon.tgl_pengadaan)
                    $('#kondisiShow').val(respon.kondisi)
                    $('#kodeAsetShow').val(respon.kode_aset)
                    $('#kodeGAShow').val(respon.kode_ga)
                    $('#nikpenerimaShow').val(respon.nik_penerima)
                    $('#namapenerimaShow').val(respon.nama_penerima)
                    $('#departemenShow').val(respon.departement)
                    $('#posisiShow').val(respon.posisi)
                    $('#namaBranchShow').val(respon.branch_penerima)
                    $('#showgambarShow').attr('src',
                        `/storage/image-tool/${respon.foto_barang}`)

                    $('#ShowTool').modal('show');
                    // showDetail_tool(t_id);
                    showRiwayatTool(t_id);
                }
            })
        })

        function showRiwayatTool(detTool) {
            $('#tabelRiwayatTool').DataTable({
                // dom: 'Bftip',
                layout: {
                    topStart: {
                        buttons: ['excel']
                    },
                },
                paging: true,
                orderClasses: false,
                // fixedColumns: true,

                // fixedColumns: {
                //     leftColumns: 3,
                //     // rightColumns: 1
                // },
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
                    url: "{{ route('getRiwayatTool') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        tid: detTool,
                        _token: _token
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_Row_Index',
                        "className": "text-center",
                        // orderable: false,
                        searchable: false,
                        // "width": '90'
                    },
                    {
                        data: 'tgl',
                        // width: '90'
                    },
                    {
                        data: 'status_distribusi'
                    },
                    {
                        data: 'callsign_tim'
                    },
                    {
                        data: 'leader'
                    },
                    {
                        data: 'teknisi1'
                    },
                    {
                        data: 'teknisi2'
                    },
                    {
                        data: 'teknisi3'
                    },
                    {
                        data: 'teknisi4'
                    },
                    {
                        data: 'kondisi'
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }

        function showDetail_tool(tool) {
            $('#showTim').DataTable({
                // dom: 'Bftip',
                layout: {
                    topStart: {
                        buttons: ['excel']
                    },
                },
                paging: true,
                orderClasses: false,
                // fixedColumns: true,

                // fixedColumns: {
                //     leftColumns: 3,
                //     // rightColumns: 1
                // },
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
                    url: "{{ route('getDataShowTool') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        tool: tool,
                        // akses: akses,
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
                        data: 'callsign_tim'
                    },
                    {
                        data: 'teknisi1'
                    },
                    {
                        data: 'teknisi2'
                    },
                    {
                        data: 'teknisi3'
                    },
                    {
                        data: 'teknisi4'
                    },
                    // {
                    //     data: 'action',
                    //     "className": "text-center",
                    // },
                ]
            })
        }

        function showRiwayatApp1(detTool) {
            $('#tabelRiwayatApp1').DataTable({
                // dom: 'Bftip',
                layout: {
                    topStart: {
                        buttons: ['excel']
                    },
                },
                paging: true,
                orderClasses: false,
                // fixedColumns: true,

                // fixedColumns: {
                //     leftColumns: 3,
                //     // rightColumns: 1
                // },
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
                    url: "{{ route('getRiwayatApprove') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        tid: detTool,
                        app: "app1",
                        _token: _token
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_Row_Index',
                        "className": "text-center",
                        // orderable: false,
                        searchable: false,
                        "width": '10'
                    },
                    {
                        data: 'tgl_approve',
                        width: '20',
                        "className": "text-center",
                    },
                    {
                        data: 'nama_karyawan'
                    },
                    {
                        data: 'status_approve'
                    },
                    {
                        data: 'ket_approve'
                    },
                ]
            })
        }

        $(document).on('click', '#detail-app1', function(e) {
            e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let t_id = $(this).data('id');

            $.ajax({
                url: "{{ route('showDetailTool') }}",
                type: "get",
                data: {
                    filToolId: t_id,
                    _token: _token
                },
                success: function(respon) {

                    $('#namaToolApp1Id').val('')
                    $('#namaToolApp1').val('')
                    $('#merkApp1').val('')
                    $('#satuanApp1').val('')
                    $('#spesifikasiApp1').val('')
                    $('#tglPenerimaanApp1').val('')
                    $('#kondisiApp1').val('')
                    $('#kodeAsetApp1').val('')
                    $('#kodeGAApp1').val('')
                    $('#showgambarApp1').val('')
                    $('#fotoToolApp1').val('')
                    // $('#tglApp1').val('')
                    // $('#statusApp1').val('')
                    $('#keteranganApp1').val('')

                    $('#namaToolApp1Id').val(respon.id)
                    $('#namaToolApp1').val(respon.nama_barang)
                    $('#merkApp1').val(respon.merk_barang)
                    $('#satuanApp1').val(respon.satuan)
                    $('#spesifikasiApp1').val(respon.spesifikasi)
                    $('#tglPenerimaanApp1').val(respon.tgl_pengadaan)
                    $('#kondisiApp1').val(respon.kondisi)
                    $('#kodeAsetApp1').val(respon.kode_aset)
                    $('#kodeGAApp1').val(respon.kode_ga)
                    $('#nikpenerimaApp1').val(respon.nik_penerima)
                    $('#namapenerimaApp1').val(respon.nama_penerima)
                    $('#departemenApp1').val(respon.departement)
                    $('#posisiApp1').val(respon.posisi)
                    $('#namaBranchApp1').val(respon.branch_penerima)
                    $('#showgambarApp1').attr('src',
                        `/storage/image-tool/${respon.foto_barang}`)

                    $('#ShowApp1').modal('show');
                    // showDetail_tool(t_id);
                    showRiwayatApp1(t_id);
                    if(respon.approve1=="Approved"){
                        document.getElementById("action1").disabled = true;
                    }



                }
            })
        })

        function showRiwayatApp2(detTool) {
            $('#tabelRiwayatApp2').DataTable({
                // dom: 'Bftip',
                layout: {
                    topStart: {
                        buttons: ['excel']
                    },
                },
                paging: true,
                orderClasses: false,
                // fixedColumns: true,

                // fixedColumns: {
                //     leftColumns: 3,
                //     // rightColumns: 1
                // },
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
                    url: "{{ route('getRiwayatApprove') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        tid: detTool,
                        app: "app2",
                        _token: _token
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_Row_Index',
                        "className": "text-center",
                        // orderable: false,
                        searchable: false,
                        "width": '10'
                    },
                    {
                        data: 'tgl_approve',
                        width: '20',
                        "className": "text-center",
                    },
                    {
                        data: 'nama_karyawan'
                    },
                    {
                        data: 'status_approve'
                    },
                    {
                        data: 'ket_approve'
                    },
                ]
            })
        }

        $(document).on('click', '#detail-app2', function(e) {
            e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let t_id = $(this).data('id');

            $.ajax({
                url: "{{ route('showDetailTool') }}",
                type: "get",
                data: {
                    filToolId: t_id,
                    _token: _token
                },
                success: function(respon) {

                    $('#namaToolApp2Id').val('')
                    $('#namaToolApp2').val('')
                    $('#merkApp2').val('')
                    $('#satuanApp2').val('')
                    $('#spesifikasiApp2').val('')
                    $('#tglPenerimaanApp2').val('')
                    $('#kondisiApp2').val('')
                    $('#kodeAsetApp2').val('')
                    $('#kodeGAApp2').val('')
                    $('#showgambarApp2').val('')
                    $('#fotoToolApp2').val('')
                    // $('#tglApp2').val('')
                    // $('#statusApp2').val('')
                    $('#keteranganApp2').val('')

                    $('#namaToolApp2Id').val(respon.id)
                    $('#namaToolApp2').val(respon.nama_barang)
                    $('#merkApp2').val(respon.merk_barang)
                    $('#satuanApp2').val(respon.satuan)
                    $('#spesifikasiApp2').val(respon.spesifikasi)
                    $('#tglPenerimaanApp2').val(respon.tgl_pengadaan)
                    $('#kondisiApp2').val(respon.kondisi)
                    $('#kodeAsetApp2').val(respon.kode_aset)
                    $('#kodeGAApp2').val(respon.kode_ga)
                    $('#nikpenerimaApp2').val(respon.nik_penerima)
                    $('#namapenerimaApp2').val(respon.nama_penerima)
                    $('#departemenApp2').val(respon.departement)
                    $('#posisiApp2').val(respon.posisi)
                    $('#namaBranchApp2').val(respon.branch_penerima)
                    $('#showgambarApp2').attr('src',
                        `/storage/image-tool/${respon.foto_barang}`)

                    $('#ShowApp2').modal('show');
                    // showDetail_tool(t_id);
                    showRiwayatApp2(t_id);
                    if(respon.approve1=="Submited" || respon.approve1=="Reject"){
                        document.getElementById("action2").disabled = true;
                    }
                    if(respon.approve2=="Approved"){
                        document.getElementById("action2").disabled = true;
                    }



                }
            })
        })

        $(document).on('click', '#dis-detail', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let dt_Dis = $(this).data('id').split('|');
            let dis_id = dt_Dis[0];
            let kategori = dt_Dis[1];

            //tambah detail pengembalian disini//

            if (kategori == "Data Distribusi") {
                url = "{{ route('getDetailDistribusi') }}"
            }
            if (kategori == "Data Pengembalian") {
                url = "{{ route('getDetailKembali') }}"
            }
            if (kategori == "Data Pengecekan") {
                url = "{{ route('getDetailCek') }}"
            }
            if (kategori == "Data Pengembalian GA") {
                url = "{{ route('getDetailKembaliGA') }}"
            }

            $.ajax({
                url: url,
                type: "get",
                data: {
                    filDisId: dis_id,
                    filKategori: kategori,
                    _token: _token
                },
                success: function(dtDis) {

                    if(kategori == "Data Distribusi" || kategori == "Data Pengembalian" || kategori == "Data Pengecekan") {

                        $('#LeadCallsignTimShow').val(dtDis.lead_callsign)
                        $('#leadCallsignShow').val(dtDis.lead_callsign)
                        $('#leaderidShow').val(dtDis.leader_id)
                        $('#leaderTimShow').val(dtDis.leader)
                        $('#posisiTimShow').val(dtDis.posisi)
                        $('#callsignTimidShow').val(dtDis.callsign_tim)
                        $('#callsignTimShow').val(dtDis.callsign_tim_id)
                        $('#areaTimShow').val(dtDis.area)

                        $('#teknisi1NkShow').val(dtDis.nik_tim1);
                        $('#teknisi1Show').val(dtDis.teknisi1);
                        $('#teknisi2NkShow').val(dtDis.nik_tim2);
                        $('#teknisi2Show').val(dtDis.teknisi2);
                        $('#teknisi3NkShow').val(dtDis.nik_tim3);
                        $('#teknisi3Show').val(dtDis.teknisi3);
                        $('#teknisi4NkShow').val(dtDis.nik_tim4);
                        $('#teknisi4Show').val(dtDis.teknisi4);

                        $('#namaToolShowDis').val(dtDis.nama_barang);

                        $('#merkShowDis').val(dtDis.merk_barang);
                        $('#satuanShowDis').val(dtDis.satuan);
                        $('#spesifikasiShowDis').val(dtDis.spesifikasi);



                        $('#kondisiShowDis').val(dtDis.kondisi);
                        $('#kodeAsetShowDis').val(dtDis.kode_aset);
                        $('#kodeGAShowDis').val(dtDis.kode_ga);

                        $('#keteranganShow').val(dtDis.keterangan);

                        if (kategori == "Data Distribusi") {

                            $('#tglPenerimaanShowDis').val(dtDis.tgl_pengadaan);
                            $('#tglDistribusiShowDis').val(dtDis.tgl_distribusi);

                            document.getElementById('txDisPenerimaan').innerHTML =
                                "Tanggal Penerimaan Tool";
                            document.getElementById('txTglDistribusi').innerHTML =
                                "Tanggal Distribusi Tool";

                            $('#showgambarDistribusiShow').attr('src',
                                `/storage/image-distribusi/${dtDis.foto_distribusi}`)
                        }
                        if (kategori == "Data Pengembalian") {

                            $('#tglPenerimaanShowDis').val(dtDis.tgl_distribusi);
                            $('#tglDistribusiShowDis').val(dtDis.tgl_kembali);

                            document.getElementById('txDisPenerimaan').innerHTML =
                                "Tanggal Distribusi Tool";
                            document.getElementById('txTglDistribusi').innerHTML =
                                "Tanggal Pengembalian Tool";

                            $('#showgambarDistribusiShow').attr('src',
                                `/storage/image-pengembalian/${dtDis.foto_kembali}`)
                        }

                        if (kategori == "Data Pengecekan") {

                            $('#tglPenerimaanShowDis').val(dtDis.tgl_distribusi);
                            $('#tglDistribusiShowDis').val(dtDis.tgl_pengecekan);

                            document.getElementById('txDisPenerimaan').innerHTML =
                            "Tanggal Distribusi Tool";
                            document.getElementById('txTglDistribusi').innerHTML =
                            "Tanggal Pengecekan Tool";

                            $('#showgambarDistribusiShow').attr('src',
                            `/storage/image-laporan/${dtDis.foto_pengecekan}`)
                        }


                        $('#showRiwayatDistribusi').modal('show');

                    }

                    if(kategori == "Data Pengembalian GA") {
                        $('#namaToolidGAShow').val(dtDis.barang_id);
                        $('#namaToolGAShow').val(dtDis.nama_barang);

                        $('#merkGAShow').val(dtDis.merk_barang);
                        $('#satuanGAShow').val(dtDis.satuan);
                        $('#spesifikasiGAShow').val(dtDis.spesifikasi);

                        $('#tglPengadaanGAShow').val(dtDis.tgl_pengadaan);
                        $('#tglPengembalianGAShow').val(dtDis.tgl_kembali);

                        $('#kondisiGAShow').val(dtDis.kondisi);
                        $('#statPengembalianGAShow').val(dtDis.status_pengembalian);
                        $('#kodeAsetGAShow').val(dtDis.kode_aset);
                        $('#kodeGAGAShow').val(dtDis.kode_ga);
                        $('#nikPengembalianGAShow').val(dtDis.nik_pengembalian + "|" + dtDis.nama_pengembalian);

                        $('#keteranganGAShow').val(dtDis.keterangan);

                        $('#showgambarKembaliGAShow').attr('src',
                            `/storage/image-pengembalianGA/${dtDis.foto_kembali}`)

                        $('#showKembaliGA').modal('show');
                    }
                }
            })
        })


        // {{-- Start Part Callsign Tim  --}}
        let area;
        let leader;

        $(document).on('change', '#LeadCallsignTim', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let leadCallsignId = $('#LeadCallsignTim').val();

            $.ajax({
                url: "{{ route('getDataLeadCallsign') }}",
                type: "get",
                data: {
                    filLeadId: leadCallsignId,
                    _token: _token
                },
                success: function(dtLead) {

                    area = dtLead.callLead.branch_id;
                    leader = dtLead.callLead.nik_karyawan
                    $('#leaderTim').val(dtLead.callLead.nama_karyawan)
                    $('#areaTim').val(dtLead.callLead.nama_branch)
                    $('#posisiTim').val(dtLead.callLead.posisi)

                    selectTeknisi("baru", area, leader);

                }
            })
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
                    if (error.responseJSON.message) {
                        alert(error.responseJSON.message)
                    }

                }
            })
        })
        // {{-- End Part Callsign Tim  --}}

    })
</script>
