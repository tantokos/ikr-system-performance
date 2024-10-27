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
                            <h3 class="text-white mb-2">Data Tim IKR</h3>
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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Data Lead
                                            Callsign</span></h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
                                    <button type="button"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                        data-bs-toggle="modal" data-bs-target="#tambahLead">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Tambah Lead Callsign</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="card-body px-2 py-2">

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0" id="tabelLead"
                                    style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headLead">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Area</th>
                                            <th class="text-center text-xs font-weight-semibold">Callsign Lead</th>
                                            <th class="text-center text-xs font-weight-semibold">Leader</th>
                                            <th class="text-center text-xs font-weight-semibold">Posisi</th>
                                            <th class="text-center text-xs font-weight-semibold">Jml Callsign Tim</th>
                                            <th class="text-center text-xs font-weight-semibold">Jml Teknisi</th>
                                            <th class="text-center text-xs font-weight-semibold">#</th>

                                        </tr>
                                    </thead>
                                    <tbody id="bodyLead">

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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Data Callsign
                                            Tim</span></h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
                                    <button type="button"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                        data-bs-toggle="modal" data-bs-target="#tambahTim">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Tambah Callsign Tim</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="card-body px-2 py-2">

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0" id="tabelTim"
                                    style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headTim1">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Area</th>
                                            <th class="text-center text-xs font-weight-semibold">Callsign Lead</th>
                                            <th class="text-center text-xs font-weight-semibold">Leader</th>
                                            <th class="text-center text-xs font-weight-semibold">Callsign Tim</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 1</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 2</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 3</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 4</th>
                                            <th class="text-center text-xs font-weight-semibold">#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyTim1">

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

        {{-- Modal Tambah Data Lead Callsign --}}
        <div class="modal fade" id="tambahLead" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Lead Callsign</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('simpanLead') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Lead Callsign</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="leadCallsign" name="leadCallsign"
                                                    style="border-color:#9ca0a7;" required>
                                            </div>

                                            <div class="form-group mb-1">
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

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Nama Leader</span>
                                                <select class="form-control form-control-sm" id="namaLeader"
                                                    name="namaLeader" style="border-color:#9ca0a7;" required>
                                                    {{-- <option value="">Pilih Leader</option> --}}
                                                    {{-- @foreach ($namaLeader as $leader)
                                                        <option value="{{ $leader->nik_karyawan }}">
                                                            {{ $leader->nama_karyawan }}</option>
                                                     @endforeach --}}

                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Posisi</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="posisi" name="posisi" style="border-color:#9ca0a7;"
                                                    required>
                                            </div>

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
        {{-- End Modal Tambah Data Lead Callsign --}}

        {{-- Modal Tambah Data Callsign Tim --}}
        <div class="modal fade" id="tambahTim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Callsign Tim</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('simpanTim') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-1">
                                                <span class="text-xs">Lead Callsign</span>
                                                <select class="form-control form-control-sm" id="LeadCallsignTim"
                                                    name="LeadCallsignTim" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Lead Callsign</option>
                                                    @foreach ($dtLeadCallsign as $listLead)
                                                        <option value="{{ $listLead->id }}">
                                                            {{ $listLead->lead_callsign }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Nama Leader</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="leaderTim" name="leaderTim" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Area</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="areaTim" name="areaTim" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Posisi</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="posisiTim" name="posisiTim" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-1">
                                                <span class="text-xs">Callsign Tim</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="callsignTim" name="callsignTim" style="border-color:#9ca0a7;"
                                                    placeholder="Isi Callsign Tim" required>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Teknisi 1</span>
                                                <select class="form-control form-control-sm" id="teknisi1"
                                                    name="teknisi1" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Teknisi 1</option>

                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Teknisi 2</span>
                                                <select class="form-control form-control-sm" id="teknisi2"
                                                    name="teknisi2" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Teknisi 2</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Teknisi 3</span>
                                                <select class="form-control form-control-sm" id="teknisi3"
                                                    name="teknisi3" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Teknisi 3</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Teknisi 4</span>
                                                <select class="form-control form-control-sm" id="teknisi4"
                                                    name="teknisi4" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Teknisi 4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center mb-1">
                                <div class="col">
                                    <button type="submit" class="btn btn-sm btn-dark align-items-center simpanTim"
                                        id="simpanTim">Simpan Data Tim</button>
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
        {{-- End Modal Tambah Data Callsign Tim --}}

        {{-- Modal Detail Data Lead Callsign --}}
        <div class="modal fade" id="showDetailLead" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Data Lead Callsign</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">

                                            <div class="form-group mb-0">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <input type="hidden" id="leadCallsignIdShow"
                                                    name="leadCallsignIdShow">
                                            </div>

                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Lead Callsign</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="leadCallsignEditShow" name="leadCallsignEditShow"
                                                    style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Area</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="areaEditShow" name="areaEditShow"
                                                    style="border-color:#9ca0a7;" readonly>
                                            </div>
                                        </div>

                                        <div class="col">

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Nama Leader</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namaLeaderEditShow" name="namaLeaderEditShow"
                                                    style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Posisi</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="posisiEditShow" name="posisiEditShow"
                                                    style="border-color:#9ca0a7;" readonly>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="border-top py-3 px-3 d-flex align-items-center">

                                    </div>

                                    <div class="row">

                                        <div class="table-responsive p-1">
                                            <table class="table table-striped table-bordered align-items-center mb-0"
                                                id="showTim" style="font-size: 12px">
                                                <thead class="bg-gray-100">
                                                    <tr id="headShowTim">
                                                        <th class="text-xs font-weight-semibold">#</th>
                                                        <th class="text-center text-xs font-weight-semibold">
                                                            Callsign Tim</th>
                                                        <th class="text-center text-xs font-weight-semibold">
                                                            Teknisi 1</th>
                                                        <th class="text-center text-xs font-weight-semibold">
                                                            Teknisi 2</th>
                                                        <th class="text-center text-xs font-weight-semibold">
                                                            Teknisi 3</th>
                                                        <th class="text-center text-xs font-weight-semibold">
                                                            Teknisi 4</th>
                                                        <th class="text-center text-xs font-weight-semibold">#</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="bodyShowTim">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <hr>
                            <div class="row text-center mb-1">
                                <div class="col">
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
        {{-- End Modal Detail Data Lead Callsign --}}

        {{-- Modal Edit Data Lead Callsign --}}
        <div class="modal fade" id="detailEditLead" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">>
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Lead Callsign</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">

                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <input type="hidden" id="leadCallsignId" name="leadCallsignId">
                                            </div>

                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Lead Callsign</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="leadCallsignEdit" name="leadCallsignEdit"
                                                    style="border-color:#9ca0a7;">
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Area</span>
                                                <select class="form-control form-control-sm" id="areaEdit"
                                                    name="areaEdit" style="border-color:#9ca0a7;">
                                                    {{-- <option value="">Pilih Area</option>
                                                    @foreach ($area as $listArea)
                                                        <option value="{{ $listArea->id }}">
                                                            {{ $listArea->nama_branch }}</option>
                                                    @endforeach --}}

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Nama Leader</span>
                                                <select class="form-control form-control-sm" id="namaLeaderEdit"
                                                    name="namaLeaderEdit" style="border-color:#9ca0a7;">
                                                    {{-- <option value="">Pilih Leader</option> --}}
                                                    {{-- @foreach ($namaLeader as $leader)
                                                        <option value="{{ $leader->nik_karyawan }}">
                                                            {{ $leader->nama_karyawan }}</option>
                                                     @endforeach --}}

                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Posisi</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="posisiEdit" name="posisiEdit" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <div class="row text-center mb-1">
                                <div class="col">
                                    <button type="button" class="btn btn-sm btn-dark align-items-center updateLead"
                                        id="updateLead">Update Data</button>
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
        {{-- End Modal Edit Data Lead Callsign --}}

        {{-- Modal Edit Data Callsign Tim --}}
        <div class="modal fade" id="editTim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Tim</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-1">
                                                <input type="hidden" id="callTimEdit" name="callTimEdit" readonly>
                                                <span class="text-xs">Lead Callsign</span>
                                                {{-- <input class="form-control form-control-sm" id="LeadTimEdit"
                                                    name="LeadTimEdit" style="border-color:#9ca0a7;" readonly> --}}
                                                <select class="form-control form-control-sm" id="LeadTimEdit"
                                                    name="LeadTimEdit" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Lead Callsign</option>
                                                    @foreach ($dtLeadCallsign as $listLead)
                                                        <option value="{{ $listLead->id }}">
                                                            {{ $listLead->lead_callsign }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Nama Leader</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="TimLeaderEdit" name="TimLeaderEdit"
                                                    style="border-color:#9ca0a7;" readonly>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Area</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="areaTimEdit" name="areaTimEdit" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Posisi</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="posisiTimEdit" name="posisiTimEdit"
                                                    style="border-color:#9ca0a7;" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-1">
                                                <span class="text-xs">Callsign Tim</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="callsignTimEdit" name="callsignTimEdit"
                                                    style="border-color:#9ca0a7;" placeholder="Isi Callsign Tim"
                                                    readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Teknisi 1</span>
                                                <select class="form-control form-control-sm" id="teknisi1Edit"
                                                    name="teknisi1Edit" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Teknisi 1</option>

                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Teknisi 2</span>
                                                <select class="form-control form-control-sm" id="teknisi2Edit"
                                                    name="teknisi2Edit" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Teknisi 2</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Teknisi 3</span>
                                                <select class="form-control form-control-sm" id="teknisi3Edit"
                                                    name="teknisi3Edit" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Teknisi 3</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Teknisi 4</span>
                                                <select class="form-control form-control-sm" id="teknisi4Edit"
                                                    name="teknisi4Edit" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Teknisi 4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center mb-1">
                                <div class="col">
                                    <button type="button" class="btn btn-sm btn-dark align-items-center updateTim"
                                        id="updateTim">Update Data Tim</button>
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
        {{-- End Modal Edit Data Callsign Tim --}}

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

                        <div class="row">
                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="tabelListTool" style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headShowTool">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Nama Tool</th>
                                            <th class="text-center text-xs font-weight-semibold">Merk</th>
                                            <th class="text-center text-xs font-weight-semibold">Kode Aset</th>
                                            <th class="text-center text-xs font-weight-semibold">Kode GA</th>
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
                                <button type="button" value="close" id="detail-tool-close"
                                    class="btn btn-sm btn-dark align-items-center"
                                    data-bs-dismiss="modal">Kembali</button>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="modal-footer"> --}}
                    {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                    {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        {{-- End Modal Show Detail Tool --}}

        {{-- Modal Show Detail Data Tool --}}
        <div class="modal fade" id="showDistribusi" tabindex="-1" role="dialog"
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
                                    <input type="hidden" id="namaToolidShow" name="namaToolidShow" readonly>
                                    <input class="form-control form-control-sm" type="text" id="namaToolShow"
                                        name="namaToolShow" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Merk</span>
                                    <input class="form-control form-control-sm" type="text" id="merkShow"
                                        name="merkShow" style="border-color:#9ca0a7; text-transform:lowercase;"
                                        readonly>
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
                                        style="border-color:#9ca0a7; text-transform:lowercase;" readonly></textarea>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-1">
                                    <span class="text-xs">Tanggal Distribusi Tool</span>
                                    <input class="form-control form-control-sm" type="date"
                                        value="{{ date('Y-m-d') }}" id="tglDistribusiShow" name="tglDistribusiShow"
                                        style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Tanggal Penerimaan Tool</span>
                                    <input class="form-control form-control-sm" type="date"
                                        value="{{ date('Y-m-d') }}" id="tglPenerimaanShow" name="tglPenerimaanShow"
                                        style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Kondisi</span>
                                    <input type="text" class="form-control form-control-sm" id="kondisiShow"
                                        name="kondisiShow" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Kode Aset</span>
                                    <input class="form-control form-control-sm" type="text" id="kodeAsetShow"
                                        name="kodeAsetShow" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Kode GA</span>
                                    <input class="form-control form-control-sm" type="text" id="kodeGAShow"
                                        name="kodeGAShow" style="border-color:#9ca0a7;" readonly>
                                </div>

                            </div>

                            <div class="col">
                                <span class="text-xs">Foto Distribusi Tool</span>
                                <div class="form-group mb-1 text-center">
                                    <img src="{{ asset('assets/img/default-150x150.png') }}"
                                        id="showgambarDistribusiShow" alt="Card Image"
                                        style="width:200px;height: 200px;" />
                                </div>

                                <div class="form-group mb-1">
                                    {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                    <span class="text-xs">Keterangan</span>
                                    <textarea class="form-control form-control-sm" id="keteranganShow" name="keteranganShow"
                                        style="border-color:#9ca0a7;" readonly></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center mb-1">
                                <div class="col">
                                    <button type="button" value="close"
                                        class="btn btn-sm btn-dark align-items-center"
                                        data-bs-dismiss="modal">Kembali</button>
                                </div>

                                <div class="col-4">
                                    <div class="input-group mb-3">
                                        <button class="btn btn-sm btn-dark mb-0" type="button"
                                            id="persetujuanSpv">Persetujuan
                                            SPV</button>
                                        <input type="text" class="form-control form-control-sm" id="approveSpv"
                                            name="approveSpv" readonly>
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
        </div>
        {{-- End Modal Show Detail Tool --}}

        {{-- Modal Show Detail Data Tool --}}
        <div class="modal fade" id="ShowWo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Data WO</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="tabelAssignTim" style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Tanggal</th>
                                            <th class="text-center text-xs font-weight-semibold">No WO</th>
                                            <th class="text-center text-xs font-weight-semibold">WO Date</th>
                                            <th class="text-center text-xs font-weight-semibold">Cust Id</th>
                                            <th class="text-center text-xs font-weight-semibold">Cust Name</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">Cust Address</th> --}}
                                            <th class="text-center text-xs font-weight-semibold">Type WO</th>
                                            <th class="text-center text-xs font-weight-semibold">Fat Code</th>
                                            <th class="text-center text-xs font-weight-semibold">Cluster</th>
                                            <th class="text-center text-xs font-weight-semibold">Area</th>
                                            <th class="text-center text-xs font-weight-semibold">Slot Time</th>
                                            <th class="text-center text-xs font-weight-semibold">Lead Callsign</th>
                                            <th class="text-center text-xs font-weight-semibold">Leader</th>
                                            <th class="text-center text-xs font-weight-semibold">Callsign Tim</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 1</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 2</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 3</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 4</th>
                                            <th class="text-center text-xs font-weight-semibold">#</th>

                                        </tr>
                                    </thead>
                                    <tbody id="bodyTool">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center mb-1">
                            <div class="col ">
                                {{-- <button type="submit" class="btn btn-sm btn-dark align-items-center showSimpan"
                                        id="showSimpan">Simpan Data</button> --}}
                                <button type="button" value="close" id="detail-wo-close"
                                    class="btn btn-sm btn-dark align-items-center"
                                    data-bs-dismiss="modal">Kembali</button>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="modal-footer"> --}}
                    {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                    {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        {{-- End Modal Show Detail Tool --}}

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
    $(document).ready(function() {

        var _token = $('meta[name=csrf-token]').attr('content');
        var firstDate;
        var lastDate;
        var approval;
        akses = $('#akses').val();
        data_lead()
        data_tim()

        function data_lead() {
            $('#tabelLead').DataTable({
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
                    url: "{{ route('getDataLead') }}",
                    type: "get",
                    dataType: "json",
                    data: {
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
                        data: 'nama_branch',
                        width: '90'
                    },
                    {
                        data: 'lead_callsign'
                    },
                    {
                        data: 'nama_leader'
                    },
                    {
                        data: 'posisi'
                    },
                    {
                        data: 'jml_tim',
                        "className": "text-center",
                    },
                    {
                        data: 'jml_teknisi',
                        "className": "text-center",
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }


        function data_tim() {
            $('#tabelTim').DataTable({
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
                    url: "{{ route('getDataTim') }}",
                    type: "get",
                    dataType: "json",
                    data: {
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
                        data: 'nama_branch',
                        width: '90'
                    },
                    {
                        data: 'lead_callsign'
                    },
                    {
                        data: 'nama_leader'
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
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }

        $(document).on('change', '#area', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let branch = $('#area').val();

            $.ajax({
                url: "{{ route('getLeader') }}",
                type: "get",
                data: {
                    filArea: branch,
                    _token: _token
                },
                success: function(respon) {

                    $('#namaLeader').find('option').remove();
                    $('#namaLeader').append(
                        `<option value="">Pilih Leader</option>`);

                    $.each(respon.leadName, function(key, nama) {
                        $('#namaLeader').append(
                            `<option value="${nama.nik_karyawan}">${nama.nama_karyawan}</option>`
                        )
                    })
                }
            })
        })

        $(document).on('change', '#areaEdit', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let branch = $('#areaEdit').val();

            $.ajax({
                url: "{{ route('getLeader') }}",
                type: "get",
                data: {
                    filArea: branch,
                    _token: _token
                },
                success: function(respon) {

                    $('#namaLeaderEdit').find('option').remove();
                    $('#namaLeaderEdit').append(
                        `<option value="">Pilih Leader</option>`);

                    $.each(respon.leadName, function(key, nama) {
                        $('#namaLeaderEdit').append(
                            `<option value="${nama.nik_karyawan}">${nama.nama_karyawan}</option>`
                        )
                    })
                }
            })
        })


        $(document).on('change', '#namaLeader', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let branch = $('#area').val();
            let nikLeader = $(this).val();

            $.ajax({
                url: "{{ route('getPosisi') }}",
                type: "get",
                data: {
                    filArea: branch,
                    filNikLead: nikLeader,
                    _token: _token
                },
                success: function(respon) {
                    $('#posisi').val(respon.posisi);
                }
            })
        })

        $(document).on('change', '#namaLeaderEdit', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let branch = $('#area').val();
            let nikLeader = $(this).val();

            $.ajax({
                url: "{{ route('getPosisi') }}",
                type: "get",
                data: {
                    filArea: branch,
                    filNikLead: nikLeader,
                    _token: _token
                },
                success: function(respon) {
                    $('#posisiEdit').val(respon.posisi);
                }
            })
        })

        $(document).on('click', '#detail-lead', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let lead = $(this).data('id').split('|');
            let c_id = lead[0];
            let b_id = lead[1];
            let l_nk = lead[2];

            $.ajax({
                url: "{{ route('getDetailLead') }}",
                type: "get",
                data: {
                    filCallsignId: c_id,
                    filBranchId: b_id,
                    filLead: l_nk,
                    _token: _token
                },
                success: function(respon) {

                    $('#leadCallsignId').val(respon.callsignLead.id);
                    $('#leadCallsignEdit').val(respon.callsignLead.lead_callsign);
                    // $('#leadCallsignEdit').val(respon.callsign.lead_callsign);

                    $('#areaEdit').find('option').remove();
                    $('#areaEdit').append(
                        `<option value="">Pilih Area</option>`);

                    $.each(respon.area, function(key, dt) {
                        $('#areaEdit').append(
                            `<option value="${dt.id}" ${dt.id == respon.callsignLead.branch_id ? 'selected' : ''}>${dt.nama_branch}</option>`
                        )
                    })

                    $('#namaLeaderEdit').find('option').remove();
                    $('#namaLeaderEdit').append(
                        `<option value="">Pilih Leader</option>`);

                    $.each(respon.leaderName, function(key, nama) {
                        $('#namaLeaderEdit').append(
                            `<option value="${nama.nik_karyawan}" ${nama.nik_karyawan == respon.callsignLead.leader_id ? 'selected' : ''}>${nama.nama_karyawan}</option>`
                        )
                    })
                    $('#posisiEdit').val(respon.callsignLead.posisi);
                    $('#detailEditLead').modal('show');

                }
            })
        })

        $(document).on('click', '#showDetail-lead', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let lead = $(this).data('id').split('|');
            let cl_id = lead[0];
            let b_id = lead[1];
            let l_nk = lead[2];

            $.ajax({
                url: "{{ route('showDetailLead') }}",
                type: "get",
                data: {
                    filCallsignId: cl_id,
                    filBranchId: b_id,
                    filLead: l_nk,
                    _token: _token
                },
                success: function(respon) {

                    $('#leadCallsignIdShow').val(respon.showLead.lead_call_id)
                    $('#leadCallsignEditShow').val(respon.showLead.lead_callsign)
                    $('#areaEditShow').val(respon.showLead.nama_branch)
                    $('#namaLeaderEditShow').val(respon.showLead.nama_leader)
                    $('#posisiEditShow').val(respon.showLead.posisi)

                    $('#showDetailLead').modal('show');
                    showDetail_tim(cl_id);

                }
            })
        })

        function showDetail_tim(leadCallsign) {
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
                    url: "{{ route('getDataShowTim') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        leadCall: leadCallsign,
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
                    {
                        data: 'tools',
                        "className": "text-center",
                    },
                ]
            })
        }

        $(document).on('click', '#detail-tool', function() {
            // console.log($(this).data('id'))
            $('#showDetailLead').modal('hide');
            $('#ShowTool').modal('show');

            showListTool($(this).data('id'));
        })

        $(document).on('click', '#detail-tool-close', function() {
            $('#showDetailLead').modal('show');
            $('#ShowTool').modal('hide');
        })
        $(document).on('click', '#detail-wo-close', function() {
            $('#showDetailLead').modal('show');
            $('#ShowWo').modal('hide');
        })

        function showListTool(detTool) {
            $('#tabelListTool').DataTable({
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
                    url: "{{ route('getListTool') }}",
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
                        data: 'kondisi'
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }

        $(document).on('click', '#detail-distribusi', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let dis_id = $(this).data('id');

            $.ajax({
                url: "{{ route('getDetailDistribusi') }}",
                type: "get",
                data: {
                    filDisId: dis_id,
                    _token: _token
                },
                success: function(dtDis) {
                    if (dtDis.approval != "-") {
                        approval = dtDis.approve;
                        console.log(approval);
                    }

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

                    $('#namaToolidShow').val(dtDis.nama_barang);
                    $('#namaToolShow').val(dtDis.nama_barang);

                    $('#merkShow').val(dtDis.merk_barang);
                    $('#satuanShow').val(dtDis.satuan);
                    $('#spesifikasiShow').val(dtDis.spesifikasi);

                    $('#tglDistribusiShow').val(dtDis.tgl_distribusi);
                    $('#tglPenerimaanShow').val(dtDis.tgl_pengadaan);

                    $('#kondisiShow').val(dtDis.kondisi);
                    $('#kodeAsetShow').val(dtDis.kode_aset);
                    $('#kodeGAShow').val(dtDis.kode_ga);

                    $('#keteranganShow').val(dtDis.keterangan);

                    $('#showgambarDistribusiShow').attr('src',
                        `/storage/image-distribusi/${dtDis.foto_distribusi}`)

                    if (dtDis.approve_spv === null) {
                        // console.log("isi null")
                        approve = "-"
                        $(persetujuanSpv).prop('disabled', false);
                    } else {
                        approve = dtDis.approve_spv
                        $(persetujuanSpv).prop('disabled', true);
                    }

                    $('#approveSpv').val(approve);

                    $('#showDistribusi').modal('show');
                    // $('#showDetailLead').modal('hide');
                    $('#ShowTool').modal('hide');


                }
            })
        })

        $(document).on('click', '#persetujuanSpv', function() {
            $('#showDistribusi').modal('hide');

            dApproval = approval.split('|');
            approvalNik = dApproval[1];
            approvalNama = dApproval[2];

            Swal.fire({
                title: "Persetujuan dari SPV",
                html: `NIK : ${approvalNik} </br>,
                    Nama : ${approvalNama}`,
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Setujui",
                cancelButtonText: "Batal",
                // denyButtonText: `Don't save`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('approveDistribusi') }}",
                        type: "get",
                        data: {
                            approve: approval,
                            _token: _token
                        },
                        success: function(res) {
                            console.log('res : ', res)
                            Swal.fire("Persetujuan!", "", "success");
                            const absoluteURL = new URL('/distribusiTool', window
                                .location.href)
                            window.location.href = absoluteURL.href;
                        }

                    })
                } else if (result.isDismissed) {
                    // Swal.fire("Changes are not saved", "", "info");
                    $('#showDistribusi').modal('show');
                }
            });


        })

        $(document).on('click', '#detail-wo', function() {
            // console.log("detail-wo click");
            $('#showDetailLead').modal('hide');
            $('#ShowWo').modal('show');
            data_assignTim($(this).data('id'));
        })

        function data_assignTim(callTim) {
            $('#tabelAssignTim').DataTable({
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
                    url: "{{ route('getListWo') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        reqCallTim: callTim,
                        _token: _token
                    }
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
                        data: 'tgl_ikr',
                        // width: '90'
                    },
                    {
                        data: 'wo_no'
                    },
                    {
                        data: 'wo_date'
                    },
                    {
                        data: 'cust_id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'wo_type'
                    },
                    {
                        data: 'fat_code'
                    },
                    {
                        data: 'area'
                    },
                    {
                        data: 'branch'
                    },
                    {
                        data: 'slot_time'
                    },
                    {
                        data: 'leadcall'
                    },
                    {
                        data: 'leader'
                    },
                    {
                        data: 'callsign'
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
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }


        $('#updateLead').click(function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let callLeadId = $('#leadCallsignId').val();
            let leadCallsign = $('#leadCallsignEdit').val();
            let areaId = $('#areaEdit').val();
            let leaderId = $('#namaLeaderEdit').val();

            $.ajax({
                url: `/updateLead/${callLeadId}`,
                type: 'PUT',
                data: {
                    idCallsignLead: callLeadId,
                    idArea: areaId,
                    leadCallsign: leadCallsign,
                    idLeader: leaderId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(hasil) {

                    $('#detailEditLead').modal('hide');
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "{{ session('success') }}",
                        showConfirmButton: true,
                        // timer: 2000
                    });

                    data_lead();

                },
                error: function(error) {
                    if (error.responseJSON.message) {
                        alert(error.responseJSON.message)
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

        $(document).on('change', '#LeadTimEdit', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let leadCallsignId = $('#LeadTimEdit').val();

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
                    $('#TimLeaderEdit').val(dtLead.callLead.nama_karyawan)
                    $('#areaTimEdit').val(dtLead.callLead.nama_branch)
                    $('#posisiTimEdit').val(dtLead.callLead.posisi)

                    // selectTeknisi("baru", area, leader);

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
                    // $('#LeadTimEdit').val(responEdit.lead_callsign);
                    $('#LeadTimEdit').val(responEdit.lead_call_id);
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
            
            let ledTimId = $('#LeadTimEdit').val();
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
                    idLeadTim: ledTimId,
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
