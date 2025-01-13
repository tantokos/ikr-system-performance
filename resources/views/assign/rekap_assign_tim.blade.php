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
                            <h3 class="text-white mb-2">Rekap Assign Tim IKR</h3>
                            <p class="mb-2 font-weight-semibold">
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
                            {{-- <div class="d-sm-flex align-items-center"> --}}
                            <div class="row">
                                {{-- <div class="col"> --}}
                                <div class="col form-group mb-1">
                                    <span class="text-xs">Tanggal Progress</span>
                                    <input class="form-control form-control-sm date-range" type="text"
                                        id="filtglProgress" name="filtglProgress" style="border-color:#9ca0a7;">
                                </div>
                                <div class="col form-group mb-1">
                                    <span class="text-xs">Area</span>
                                    <select class="form-control form-control-sm" type="text" id="filarea"
                                        name="filarea" style="border-color:#9ca0a7;">
                                        <option value="">Pilih Area</option>
                                        @if (isset($branches))
                                            @foreach ($branches as $b)
                                                <option value="{{ $b->id . '|' . $b->nama_branch }}">
                                                    {{ $b->nama_branch }}
                                            @endforeach
                                        @endif
                                    </select>
                                    <input type="hidden" id="filareaId" name="filareaId">
                                </div>

                                <div class="col form-group mb-1">
                                    <span class="text-xs">PIC Assign Tim</span>
                                    <select class="form-control form-control-sm" type="text" id="filleaderTim"
                                        name="filleaderTim" style="border-color:#9ca0a7;">
                                        <option value="">Pilih Leader</option>
                                        @if (isset($leader))
                                            @foreach ($leader as $ld)
                                                <option value="{{ $ld->leader_id . '|' . $ld->nama_leader }}">
                                                    {{ $ld->nama_leader }}
                                            @endforeach
                                        @endif
                                    </select>
                                    <input type="hidden" id="filleaderid" name="filleaderid" readonly>
                                </div>
                            </div>

                            <div class="row">

                                {{-- <div class="col"> --}}



                            </div>


                            <hr>
                            <div class="row text-center mb-1">
                                <div class="col">
                                    <button type="button" class="btn btn-sm btn-dark align-items-center filAssignTim"
                                        id="filAssignTim">Tampilkan</button>
                                    <button type="button" value="close"
                                        class="btn btn-sm btn-dark align-items-center">Reset</button>
                                </div>
                            </div>
                            {{-- </div> --}}
                            {{-- </div> --}}
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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Rekap Monitoring Tim </span></h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                {{-- <div class="ms-auto d-flex">
                                    <span class="text-xs">Periode : -</span>
                                </div> --}}
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">
                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="rekapTim" style="font-size: 12px; border-color:#9ca0a7;">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs">#</th>
                                            <th class="text-xs text-secondary">Area</th>
                                            <th class="text-xs text-secondary">Dept</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">PIC Assign Tim</th> --}}
                                            <th class="text-center text-xs text-secondary">Jml Tim</th>
                                            <th class="text-center text-xs text-secondary">Jml Assign Tim</th>
                                            <th class="text-center text-xs text-secondary">Jml Assign Teknisi</th>
                                            <th class="text-center text-xs text-secondary">Standby</th>
                                            <th class="text-center text-xs text-secondary">ON</th>
                                            <th class="text-center text-xs text-secondary">OFF</th>
                                            <th class="text-center text-xs text-secondary">Cuti</th>
                                            <th class="text-center text-xs text-secondary">Sakit</th>
                                            <th class="text-center text-xs text-secondary">ABS</th>
                                            <th class="text-center text-xs text-secondary">Total Teknisi</th>
                                            {{-- <th class="text-center text-xs">FTTH Maintenance</th>
                                            <th class="text-center text-xs">Dismantle</th>
                                            <th class="text-center text-xs">FTTX New Installation</th>
                                            <th class="text-center text-xs">FTTX Maintenance</th> --}}
                                            {{-- <th class="text-center text-xs">#</th> --}}

                                        </tr>
                                    </thead>
                                    <tbody id="bodyTool" style="font-weight: bold">

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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Rekap Data
                                            Assign Tim </span><span id="periode"></span></h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                {{-- <div class="ms-auto d-flex">
                                    <span class="text-xs">Periode : -</span>
                                </div> --}}
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">
                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="rekapAssignTim" style="font-size: 12px; border-color:#9ca0a7;">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Area</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">PIC Assign Tim</th> --}}
                                            <th class="text-center text-xs font-weight-semibold">FTTH New Installation</th>
                                            <th class="text-center text-xs font-weight-semibold">FTTH Maintenance</th>
                                            <th class="text-center text-xs font-weight-semibold">Dismantle</th>
                                            <th class="text-center text-xs font-weight-semibold">FTTX New Installation</th>
                                            <th class="text-center text-xs font-weight-semibold">FTTX Maintenance</th>
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

        {{-- Modal Detail Edit Assign Tim --}}
        <div class="modal fade" id="modalEditAssignTim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Assign Tim</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="updateEditAssign" method="post" enctype="multipart/form-data">
                        {{-- @method('post') --}}
                        @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-1">
                                            <span class="text-xs">Tanggal Progress</span>
                                            <input class="form-control form-control-sm" type="date" id="EdittglProgressTim"
                                                    name="EdittglProgressTim" style="border-color:#9ca0a7;" readonly>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group mb-1">
                                            <span class="text-xs">Area</span>
                                            <input class="form-control form-control-sm" type="text" id="EditArea"
                                                    name="EditArea" style="border-color:#9ca0a7;" readonly>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-1">
                                            <span class="text-xs">Lead Callsign</span>
                                            <input class="form-control form-control-sm" type="text" value="" id="EditLeadCallsign"
                                                    name="EditLeadCallsign" style="border-color:#9ca0a7;" readonly>
                                            <input type="hidden" id="EditLeadCallsignId" name="EditLeadCallsignId" readonly>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group mb-1">
                                            <span class="text-xs">Leader</span>
                                            <input class="form-control form-control-sm" type="text" value="" id="EditLeader"
                                                    name="EditLeader" style="border-color:#9ca0a7;" readonly>
                                            <input type="hidden" id="EditLeaderId" name="EditLeaderId" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Callsign Tim</span>
                                    <input class="form-control form-control-sm" type="text" value="" id="EditcallsignTim"
                                            name="EditcallsignTim" style="border-color:#9ca0a7;" readonly>
                                    <input type="hidden" id="EditCallsignTimId" name="EditCallsignTimId" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 1</span>
                                    <select class="form-control form-control-sm" type="text" value="" id="EditTeknisi1"
                                            name="EditTeknisi1" style="border-color:#9ca0a7;">
                                        <option value="">Pilih Teknisi</option>
                                    </select>                                    
                                </div>
                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 2</span>
                                    <select class="form-control form-control-sm" type="text" value="" id="EditTeknisi2"
                                            name="EditTeknisi2" style="border-color:#9ca0a7;">
                                        <option value="">Pilih Teknisi</option>
                                    </select>                                    
                                </div>
                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 3</span>
                                    <select class="form-control form-control-sm" type="text" value="" id="EditTeknisi3"
                                            name="EditTeknisi3" style="border-color:#9ca0a7;">
                                        <option value="">Pilih Teknisi</option>
                                    </select>                                    
                                </div>
                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 4</span>
                                    <select class="form-control form-control-sm" type="text" value="" id="EditTeknisi4"
                                            name="EditTeknisi4" style="border-color:#9ca0a7;">
                                        <option value="">Pilih Teknisi</option>
                                    </select>                                    
                                </div>

                            </div>
                        </div>
                    </div>
                
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                        {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                        <button type="submit" class="btn btn-sm btn-dark align-items-center"
                            id="updateEditRekapAssign">Update Tim</button>
                        <button type="button" value="close" class="btn btn-sm btn-dark align-items-center"
                            data-bs-dismiss="modal">Batalkan</button>
                    </div>

                </form>

                </div>
            </div>
        </div>
        {{-- End Modal Edit Assign Tim --}}

        {{-- Modal Detail Rekap Assign Tim --}}
        <div class="modal fade" id="modalRekapAssignTim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Assign Tim</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card border shadow-xs mb-4">
                                    <div class="card-body px-2 py-2">
                                        <div class="table-responsive p-0">
                                            <table class="table table-striped table-bordered align-items-center mb-0"
                                                id="tabelDetailRekapAssignTim" style="font-size: 12px">
                                                <thead class="bg-gray-100">
                                                    <tr id="headAssTim">
                                                        <th class="text-xs font-weight-semibold">#</th>
                                                        <th class="text-center text-xs font-weight-semibold">Tanggal
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Leader
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Callsign
                                                            Tim</th>
                                                        <th class="text-center text-xs font-weight-semibold">Teknisi 1
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Teknisi 2
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Teknisi 3
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Teknisi 4
                                                        </th>
                                                        {{-- <th class="text-center text-xs font-weight-semibold">#</th> --}}

                                                    </tr>
                                                </thead>
                                                <tbody id="bodyAssTim">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="border-top py-3 px-3 d-flex align-items-center">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Detail Rekap Assign Tim --}}

        {{-- Modal Detail Rekap Absensi On Off Cuti Sakit ABS --}}
        <div class="modal fade" id="modalRekapAbsenAssignTim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Status Absensi</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="#" method="post" enctype="multipart/form-data">
                            @csrf --}}
                            <div class="row">
                                <div class="table-responsive p-0">
                                    <table class="table table-bordered align-items-center mb-0"
                                        id="tabelDetailRekapStatusAbsensi" style="font-size: 12px;border-color:#9ca0a7;">
                                        <thead class="bg-gray-300">
                                            <tr id="headDetailRekapStatusAbsensi">
                                                <th class="text-xs font-weight-semibold">#</th>
                                                <th class="text-xs font-weight-semibold">Tanggal</th>
                                                <th class="text-center text-xs">Area</th>
                                                <th class="text-center text-xs">Nik Karyawan</th>
                                                <th class="text-center text-xs">Nama karyawan</th>
                                                <th class="text-center text-xs">Posisi</th>
                                                <th class="text-center text-xs">Status</th>
                                                <th class="text-center text-xs">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyDetailRekapStatusAbsensi">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="row text-center mb-0">
                                    <div class="col">
                                        <button type="button" value="close"
                                            class="btn btn-sm btn-dark align-items-center"
                                            data-bs-dismiss="modal">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Detail Rekap Absensi On Off Cuti Sakit ABS --}}

        {{-- Modal Detail Rekap Assign Jml Assign Teknisi --}}
        <div class="modal fade" id="modalRekapJmlTeknisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Teknisi Progress</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="#" method="post" enctype="multipart/form-data">
                            @csrf --}}
                            <div class="row">
                                <div class="table-responsive p-0">
                                    <table class="table table-bordered align-items-center mb-0"
                                        id="tabelDetailRekapJmlTeknisi" style="font-size: 12px;border-color:#9ca0a7;">
                                        <thead class="bg-gray-300">
                                            <tr>
                                                <th class="text-xs font-weight-semibold">#</th>
                                                <th class="text-xs font-weight-semibold">Tanggal</th>
                                                <th class="text-center text-xs">Area</th>
                                                <th class="text-center text-xs">callsign</th>
                                                <th class="text-center text-xs">Nik Karyawan</th>
                                                <th class="text-center text-xs">Nama Karyawan</th>
                                                <th class="text-center text-xs">Posisi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="row text-center mb-0">
                                    <div class="col">
                                        <button type="button" value="close"
                                            class="btn btn-sm btn-dark align-items-center"
                                            data-bs-dismiss="modal">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Detail Rekap Assign Jml Assign Teknisi --}}

        {{-- Modal Detail Rekap Assign Jml Standby --}}
        <div class="modal fade" id="modalRekapJmlStandby" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Teknisi Standby</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="#" method="post" enctype="multipart/form-data">
                            @csrf --}}
                            <div class="row">
                                <div class="table-responsive p-0">
                                    <table class="table table-bordered align-items-center mb-0"
                                        id="tabelDetailRekapJmlStandby" style="font-size: 12px;border-color:#9ca0a7;">
                                        <thead class="bg-gray-300">
                                            <tr>
                                                <th class="text-xs font-weight-semibold">#</th>
                                                <th class="text-xs font-weight-semibold">Tanggal</th>
                                                <th class="text-center text-xs">Area</th>
                                                <th class="text-center text-xs">Nik Karyawan</th>
                                                <th class="text-center text-xs">Nama Karyawan</th>
                                                <th class="text-center text-xs">Posisi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="row text-center mb-0">
                                    <div class="col">
                                        <button type="button" value="close"
                                            class="btn btn-sm btn-dark align-items-center"
                                            data-bs-dismiss="modal">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Detail Rekap Assign Jml Standby --}}

        {{-- Modal Detail Assign Tim --}}
        <div class="modal fade" id="modalDataAssignTim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Assign Tim</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card border shadow-xs mb-4">
                                    <div class="card-body px-2 py-2">
                                        <div class="table-responsive p-0">
                                            <table class="table table-striped table-bordered align-items-center mb-0"
                                                id="tabelAssignTim" style="font-size: 12px">
                                                <thead class="bg-gray-100">
                                                    <tr id="headTool">
                                                        <th class="text-xs font-weight-semibold">#</th>
                                                        <th class="text-center text-xs font-weight-semibold">Tanggal
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">No WO</th>
                                                        <th class="text-center text-xs font-weight-semibold">WO Date
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Cust Id
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Cust Name
                                                        </th>
                                                        {{-- <th class="text-center text-xs font-weight-semibold">Cust Address</th> --}}
                                                        <th class="text-center text-xs font-weight-semibold">Type WO
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Fat Code
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Area</th>
                                                        <th class="text-center text-xs font-weight-semibold">Cluster
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Slot Time
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Lead
                                                            Callsign</th>
                                                        <th class="text-center text-xs font-weight-semibold">Leader
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Callsign
                                                            Tim</th>
                                                        <th class="text-center text-xs font-weight-semibold">Teknisi 1
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Teknisi 2
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Teknisi 3
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Teknisi 4
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Leader
                                                            Assign</th>
                                                        {{-- <th class="text-center text-xs font-weight-semibold">#</th> --}}

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
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Detail Assign Tim --}}

    </main>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script
    src="{{ asset('assets/dttable2_1/dttable.min.css')}}">
    // src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-html5-3.1.0/fc-5.0.1/r-3.0.2/datatables.min.js">
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
                $('#showgambarDistribusi').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fotoToolDistribusi").change(function() {
        readURL(this);
    });
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">
    
    $(document).ready(function() {
        var _token = $('meta[name=csrf-token]').attr('content');
        var firstDate;
        var lastDate;
        var stDate;
        var enDate;

        akses = $('#akses').val();

        function toTitleCase(str) {
            return str.replace(
                /\w\S*/g,
                text => text.charAt(0).toUpperCase() + text.substring(1).toLowerCase()
            );
        }

        $('.date-range').daterangepicker({
            startDate: moment(),
            endDate: moment(),
        });

        $(document).on('click', '#filAssignTim', function(e) {
            rekap_assignTim();
            data_assignTim();
            stDate = $('.date-range').data('daterangepicker').startDate.format("DD-MMM-YYYY");
            enDate = $('.date-range').data('daterangepicker').endDate.format("DD-MMM-YYYY");
            $('#periode').text("Tanggal " + stDate + " s/d " + enDate);
        })

        $('#filAssignTim').trigger("click");

        $(document).on('click', '#detail-jml_assign', function(e) {
            fil = $(this).data('id') + "|" + $('#filtglProgress').val();

            $('#modalRekapAssignTim').modal('show');

            $('#tabelDetailRekapAssignTim').DataTable({
                // dom: 'Bftip',
                layout: {
                    topStart: {
                        pageLength: {
                            menu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                        } ,
                        buttons: ['excel'],
                    },
                    
                },
                paging: true,
                orderClasses: false,
                // fixedColumns: true,
                // fixedColumns: {
                //     leftColumns: 6,
                //     // rightColumns: 1
                // },
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
                    url: "{{ route('getDetailRekapAssignTim') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        fil: fil,
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
                        data: 'leader',
                    },
                    {
                        data: 'callsign',
                    },
                    {
                        data: 'teknisi1',
                    },
                    {
                        data: 'teknisi2',
                    },
                    {
                        data: 'teknisi3',
                    },
                    {
                        data: 'teknisi4',
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })

        });


        $(document).on('click', '#editSignTim', function(e) {
            fil = $(this).data('id') + "|" + $('#filtglProgress').val();
            edt = fil.split("|");

            $.ajax({
                url: "{{ route('getTimEditCallsign') }}",
                type: "get",
                data: {
                    fil: fil,
                    _token: _token
                },
                success: function(dtTim) {
                    console.log('dtTim : ', dtTim)
                    $('#EdittglProgressTim').val(edt[0]);
                    $('#EditArea').val(edt[1]);
                    $('#EditLeadCallsign').val(edt[2]);
                    $('#EditLeader').val(edt[3]);
                    $('#EditcallsignTim').val(edt[4]);

                    $('#EditTeknisi1').find('option').remove();
                    $('#EditTeknisi1').append(
                        `<option value="">Pilih Teknisi 1</option>`);

                    $('#EditTeknisi2').find('option').remove();
                    $('#EditTeknisi2').append(
                        `<option value="">Pilih Teknisi 2</option>`);

                    $('#EditTeknisi3').find('option').remove();
                    $('#EditTeknisi3').append(
                        `<option value="">Pilih Teknisi 3</option>`);

                    $('#EditTeknisi4').find('option').remove();
                    $('#EditTeknisi4').append(
                        `<option value="">Pilih Teknisi 4</option>`);


                    $.each(dtTim, function(key, t1) {
                        $('#EditTeknisi1').append(
                            `<option value="${t1.nik_karyawan+'|'+t1.nama_karyawan}">${t1.nama_karyawan}</option>`
                        )
                    })
                    $.each(dtTim, function(key, t2) {
                        $('#EditTeknisi2').append(
                            `<option value="${t2.nik_karyawan+'|'+t2.nama_karyawan}">${t2.nama_karyawan}</option>`
                        )
                    })
                    $.each(dtTim, function(key, t3) {
                        $('#EditTeknisi3').append(
                            `<option value="${t3.nik_karyawan+'|'+t3.nama_karyawan}">${t3.nama_karyawan}</option>`
                        )
                    })
                    $.each(dtTim, function(key, t4) {
                        $('#EditTeknisi4').append(
                            `<option value="${t4.nik_karyawan+'|'+t4.nama_karyawan}">${t4.nama_karyawan}</option>`
                        )
                    })

                    $('#EditTeknisi1').val(edt[5]+'|'+edt[6]);

                    $('#EditTeknisi2').val(edt[7]+'|'+edt[8]);

                    $('#EditTeknisi3').val(edt[9]+'|'+edt[10]);

                    $('#EditTeknisi4').val(edt[11]+'|'+edt[12]);
                }
            })

            $('#modalRekapAssignTim').modal('hide');
            $('#modalEditAssignTim').modal('show');           

        });

        $(document).on('click', '#updateEditRekapAssign', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('updateRekapCallTim') }}",
                type: "get",
                data: $('.updateEditAssign').serialize(),
                success: function(obj) {
                    if(obj=="success"){
                        $('#modalEditAssignTim').modal('hide');
                        
                        

                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Berhasil update Data Callsign Tim",
                            showConfirmButton: true,
                            // timer: 2000
                        });
                        
                        $('#rekapTim').DataTable().ajax.reload();
                    } else {
                        $('#modalEditAssignTim').modal('hide');

                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: obj,
                            showConfirmButton: true,
                            // timer: 2000
                        });

                        $('#rekapTim').DataTable().ajax.reload();
                    }
                }
            })
            
        })


        function data_assignTim() {
            $('#rekapAssignTim').DataTable({
                // dom: 'Bftip',
                layout: {
                    topStart: {
                        pageLength: {
                            menu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                        } ,
                        buttons: ['excel'],
                    },
                    
                },
                paging: true,
                orderClasses: false,
                // fixedColumns: true,
                // fixedColumns: {
                //     leftColumns: 6,
                //     // rightColumns: 1
                // },
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
                    url: "{{ route('getTabelLeadAssignTim') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        filTgl: $('#filtglProgress').val(),
                        filNoWo: $('#filnoWo').val(),
                        filcustId: $('#filcustId').val(),
                        filtypeWo: $('#filtypeWo').val(),
                        filarea: $('#filarea').val(),
                        filleaderTim: $('#filleaderTim').val(),
                        filcallsignTimid: $('#filcallsignTimid').val(),
                        filteknisi: $('#filteknisi').val(),
                        filcluster: $('#filcluster').val(),
                        filfatCode: $('#filfatCode').val(),
                        filslotTime: $('#filslotTime').val(),
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
                        data: 'branch',
                        // width: '90'
                    },
                    // {
                    //     data: 'login'
                    // },
                    {
                        data: 'ftth_ib',
                        "className": "text-center",
                    },
                    {
                        data: 'ftth_mt',
                        "className": "text-center",
                    },
                    {
                        data: 'dismantle',
                        "className": "text-center",
                    },
                    {
                        data: 'fttx_ib',
                        "className": "text-center",
                    },
                    {
                        data: 'fttx_mt',
                        "className": "text-center",
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }

        function rekap_assignTim() {
            $('#rekapTim').DataTable({
                // dom: 'Bftip',
                layout: {
                    topStart: {
                        pageLength: {
                            menu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                        } ,
                        buttons: ['excel'],
                    },
                    
                },
                paging: true,
                orderClasses: false,
                // fixedColumns: true,
                // fixedColumns: {
                //     leftColumns: 6,
                //     // rightColumns: 1
                // },
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
                    url: "{{ route('getTabelRekapAssignTim') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        filTgl: $('#filtglProgress').val(),
                        filNoWo: $('#filnoWo').val(),
                        filcustId: $('#filcustId').val(),
                        filtypeWo: $('#filtypeWo').val(),
                        filarea: $('#filarea').val(),
                        filleaderTim: $('#filleaderTim').val(),
                        filcallsignTimid: $('#filcallsignTimid').val(),
                        filteknisi: $('#filteknisi').val(),
                        filcluster: $('#filcluster').val(),
                        filfatCode: $('#filfatCode').val(),
                        filslotTime: $('#filslotTime').val(),
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
                        data: 'branch',
                        // width: '90'
                    },
                    {
                        data: 'departement',
                        // width: '90'
                    },
                    {
                        data: 'j_tim',
                        "className": "text-center",
                    },
                    {
                        data: 'j_assign',
                        "className": "text-center",
                        "render": function (cellData, rowData, row, col, index) {
                            return `<a href="javascript:void(0);" id="detail-jml_assign" data-id="${row.branch}|${row.departement}"  class="text-primary">${cellData}</a>`;
                        }
                    },
                    {
                        data: 'j_teknisi',
                        "className": "text-center",
                        "render": function (cellData, rowData, row, col, index) {
                            return `<a href="javascript:void(0);" id="det-jml_teknisi" data-id="${cellData==null ? "0" : cellData}|JmlTeknisi|${row.branch}|${row.departement}"  class="text-primary">${cellData==null ? "0" : cellData }</a>`;
                        }
                    
                    },
                    {
                        data: null, //'jmStandby',
                        "className": "text-center",
                        "render": function(data,type,row) { 
                            jml = Number(data["j_on"]) - Number(data["j_teknisi"]);

                            return `<a href="javascript:void(0);" id="det-jml_standby" data-id="${jml==null ? "0" : jml}|JmlStandby|${row.branch}|${row.departement}"  class="text-primary">${jml==null ? "0" : jml }</a>`;
                            // return (Number(data["j_on"]) - Number(data["j_teknisi"]))
                        },
                    },
                    // {
                    //     data: null,
                    //     "render": function(data,type,row) { 
                    //         jml = Number(data["j_on"]) - Number(data["j_teknisi"]);

                    //         return `<a href="javascript:void(0);" id="det-jml_standby" data-id="${jml==null ? "0" : jml}|JmlStandby|${row.branch}|${row.departement}"  class="text-primary">${jml==null ? "0" : jml }</a>`;
                    //         // return (Number(data["j_on"]) - Number(data["j_teknisi"]))
                    //     },
                    //     "className": "text-center",
                    // },
                    {
                        data: 'j_on',
                        "className": "text-center",
                        "render": function (cellData, rowData, row, col, index) {
                            return `<a href="javascript:void(0);" id="det-rekap" data-id="${cellData}|Absensi|${row.branch}|${row.departement}|ON"  class="text-primary">${cellData}</a>`;
                        }
                    },
                    {
                        data: 'j_off',
                        "className": "text-center",
                        "render": function (cellData, rowData, row, col, index) {
                            return `<a href="javascript:void(0);" id="det-rekap" data-id="${cellData}|Absensi|${row.branch}|${row.departement}|OFF"  class="text-primary">${cellData}</a>`;
                        }
                    },
                    {
                        data: 'j_cuti',
                        "className": "text-center",
                        "render": function (cellData, rowData, row, col, index) {
                            return `<a href="javascript:void(0);" id="det-rekap" data-id="${cellData}|Absensi|${row.branch}|${row.departement}|Cuti"  class="text-primary">${cellData}</a>`;
                        }
                    },
                    {
                        data: 'j_sakit',
                        "className": "text-center",
                        "render": function (cellData, rowData, row, col, index) {
                            return `<a href="javascript:void(0);" id="det-rekap" data-id="${cellData}|Absensi|${row.branch}|${row.departement}|Sakit"  class="text-primary">${cellData}</a>`;
                        }
                    },
                    {
                        data: 'j_abs',
                        "className": "text-center",
                        "render": function (cellData, rowData, row, col, index) {
                            return `<a href="javascript:void(0);" id="det-rekap" data-id="${cellData}|Absensi|${row.branch}|${row.departement}|Absen"  class="text-primary">${cellData}</a>`;
                        }
                    },                    
                    {
                        data: null,
                        "render": function(data,type,row) { return (Number(data["j_on"]) + Number(data["j_off"]) + Number(data["j_cuti"]) + Number(data["j_sakit"]) + Number(data["j_abs"]))},
                        "className": "text-center",
                    },
                    // {
                    //     data: 'action',
                    //     "className": "text-center",
                    // },
                    
                    
                ]
            })
        }

        //klik tabel rekap Assign Jml Assign Teknisi
        $(document).on('click', '#det-jml_teknisi', function(e) {
            e.preventDefault();
            klik = $(this).data('id').split('|');
            tbl = klik[1];
            isi = klik[0];        
            
            if(isi != "0") {

                $('#modalRekapJmlTeknisi').modal('show');

                tableDetRekap = 
                $('#tabelDetailRekapJmlTeknisi').DataTable({
                        layout: {
                            topStart: {
                                pageLength: {
                                    menu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                                } ,
                            buttons: ['excel'],
                            },
                        },
                        paging: true,
                        orderClasses: false,
                        fixedColumns: false,

                        // fixedColumns: {
                        //     leftColumns: 5,
                        //     rightColumns: 1
                        // },
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
                            url: "{{ route('getPopUpRekapJmlAssignTeknisi') }}",
                            type: "get",
                            dataType: "json",
                            data: {
                                detail: $(this).data('id'),
                                tglClick: $('#filtglProgress').val(),
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
                            {data: 'tgl_ikr'},
                            {data: 'branch', "className": "text-center",},
                            {data: 'callsign',"className": "text-center",},
                            {data: 'tek_nik', "className": "text-center",},                    
                            {data: 'teknisi'},
                            {data: 'posisi'},
                                
                        ],
                        
                    })

            }
        })

        //klik tabel rekap Assign Jml Standby
        $(document).on('click', '#det-jml_standby', function(e) {
            e.preventDefault();
            klik = $(this).data('id').split('|');
            tbl = klik[1];
            isi = klik[0];        
            
            if(isi != "0") {

                $('#modalRekapJmlStandby').modal('show');

                tableDetRekap = 
                $('#tabelDetailRekapJmlStandby').DataTable({
                        layout: {
                            topStart: {
                                pageLength: {
                                    menu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                                } ,
                            buttons: ['excel'],
                            },
                        },
                        paging: true,
                        orderClasses: false,
                        fixedColumns: false,

                        // fixedColumns: {
                        //     leftColumns: 5,
                        //     rightColumns: 1
                        // },
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
                            url: "{{ route('getPopUpRekapJmlAssignTeknisi') }}",
                            type: "get",
                            dataType: "json",
                            data: {
                                detail: $(this).data('id'),
                                tglClick: $('#filtglProgress').val(),
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
                            {data: 'tgl_ikr'},
                            {data: 'branch', "className": "text-center",},
                            {data: 'tek_nik', "className": "text-center",},                    
                            {data: 'teknisi'},
                            {data: 'posisi'},
                                
                        ],
                        
                    })

            }
        })

        //klik tabel rekap Assign Segment Absensi
        $(document).on('click', '#det-rekap', function(e) {
            e.preventDefault();
            klik = $(this).data('id').split('|');
            tbl = klik[1];
            isi = klik[0];        

            if(isi != "0") {

                $('#modalRekapAbsenAssignTim').modal('show');

                tableDetRekap = 
                $('#tabelDetailRekapStatusAbsensi').DataTable({
                        layout: {
                            topStart: {
                                pageLength: {
                                    menu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                                } ,
                            buttons: ['excel'],
                            },
                        },
                        paging: true,
                        orderClasses: false,
                        fixedColumns: false,

                        // fixedColumns: {
                        //     leftColumns: 5,
                        //     rightColumns: 1
                        // },
                        deferRender: true,
                        scrollCollapse: true,
                        scrollX: true,
                        pageLength: 10,
                        lengthChange: true,
                        bFilter: true,
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "{{ route('getPopUpRekapAssignTim') }}",
                            type: "get",
                            dataType: "json",
                            data: {
                                detail: $(this).data('id'),
                                tglClick: $('#filtglProgress').val(),
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
                            {data: 'tgl'},
                            {data: 'branch'},
                            {data: 'nik_karyawan'},
                            {data: 'nama_karyawan'},                    
                            {data: 'posisi'},
                            {data: 'status', "className": "text-center",},
                            {data: 'keterangan'},
                                
                        ],
                        
                    })

            }
        })

        $(document).on('click', '#showDetAssignTim', function(e) {
            e.preventDefault();
            $('#modalDataAssignTim').modal('show');

            detail_assignTim($(this).data('id'));

        })

        function detail_assignTim(data) {
            $('#tabelAssignTim').DataTable({
                // dom: 'Bftip',
                layout: {
                    topStart: {
                        pageLength: {
                            menu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                        } ,
                        buttons: ['excel'],
                    },
                    
                },
                paging: true,
                orderClasses: false,
                // fixedColumns: true,
                fixedColumns: {
                    leftColumns: 6,
                    // rightColumns: 1
                },
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
                    url: "{{ route('getDetailLeadAssignTim') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        filTgl: $('#filtglProgress').val(),
                        filBrnchLead: data,
                        filNoWo: $('#filnoWo').val(),
                        filcustId: $('#filcustId').val(),
                        filtypeWo: $('#filtypeWo').val(),
                        filarea: $('#filarea').val(),
                        filleaderTim: $('#filleaderTim').val(),
                        filcallsignTimid: $('#filcallsignTimid').val(),
                        filteknisi: $('#filteknisi').val(),
                        filcluster: $('#filcluster').val(),
                        filfatCode: $('#filfatCode').val(),
                        filslotTime: $('#filslotTime').val(),
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
                        data: 'no_wo_apk'
                    },
                    {
                        data: 'wo_date_apk'
                    },
                    {
                        data: 'cust_id_apk'
                    },
                    {
                        data: 'name_cust_apk'
                    },
                    {
                        data: 'wo_type_apk'
                    },
                    {
                        data: 'fat_code_apk'
                    },
                    {
                        data: 'branch'
                    },
                    {
                        data: 'area_cluster_apk'
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
                        data: 'login',
                    },
                    // {
                    //     data: 'action',
                    //     "className": "text-center",
                    // },
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

        // {{-- Start Part Callsign Tim  --}}
        let area;
        let leader;

        $(document).on('change', '#LeadCallsign', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');

            let leadCallsignId = $('#LeadCallsign').val();

            $.ajax({
                url: "{{ route('getLeadCallsign') }}",
                type: "get",
                data: {
                    filLeadId: leadCallsignId,
                    _token: _token
                },
                success: function(dtLead) {
                    area = dtLead.callLead.branch_id;
                    leader = dtLead.callLead.nik_karyawan
                    $('#leadCallsign').val(dtLead.callLead.lead_callsign)
                    $('#leaderid').val(dtLead.callLead.leader_id)
                    $('#leader').val(dtLead.callLead.nama_karyawan)
                    $('#areaTim').val(dtLead.callLead.nama_branch)
                    $('#posisiTim').val(dtLead.callLead.posisi)

                    $('#callsignTimid').find('option').remove();
                    $('#callsignTimid').append(
                        `<option value="">Pilih Callsign Tim</option>`);

                    $.each(dtLead.callTim, function(key, tim) {
                        $('#callsignTimid').append(
                            `<option value="${tim.callsign_tim_id+'|'+tim.callsign_tim}">${tim.callsign_tim}</option>`
                        )
                    })

                    // get_select_tool();
                }
            })
        })


        $(document).on('change', '#callsignTimid', function(t) {
            // t.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let leadCallsignId = $('#LeadCallsign').val();

            $.ajax({
                url: "{{ route('getTeknisi') }}",
                type: "get",
                data: {
                    leadCall: leadCallsignId,
                    callTim: $(this).val(),
                    _token: _token
                },
                success: function(dtTek) {

                    callTim = $('#callsignTimid').val().split('|');
                    $('#callsignTim').val(callTim[1]);

                    $('#teknisi1').find('option').remove();
                    $('#teknisi1').append(
                        `<option value="">Pilih Teknisi 1</option>`);

                    $('#teknisi2').find('option').remove();
                    $('#teknisi2').append(
                        `<option value="">Pilih Teknisi 2</option>`);

                    $('#teknisi3').find('option').remove();
                    $('#teknisi3').append(
                        `<option value="">Pilih Teknisi 3</option>`);

                    $('#teknisi4').find('option').remove();
                    $('#teknisi4').append(
                        `<option value="">Pilih Teknisi 4</option>`);


                    $.each(dtTek, function(key, t1) {
                        $('#teknisi1').append(
                            `<option value="${t1.nik_karyawan+'|'+t1.nama_karyawan}">${t1.nama_karyawan}</option>`
                        )
                    })
                    $.each(dtTek, function(key, t2) {
                        $('#teknisi2').append(
                            `<option value="${t2.nik_karyawan+'|'+t2.nama_karyawan}">${t2.nama_karyawan}</option>`
                        )
                    })
                    $.each(dtTek, function(key, t3) {
                        $('#teknisi3').append(
                            `<option value="${t3.nik_karyawan+'|'+t3.nama_karyawan}">${t3.nama_karyawan}</option>`
                        )
                    })
                    $.each(dtTek, function(key, t4) {
                        $('#teknisi4').append(
                            `<option value="${t4.nik_karyawan+'|'+t4.nama_karyawan}">${t4.nama_karyawan}</option>`
                        )
                    })

                }
            })
        })

        $(document).on('change', '#LeadCallsignShow', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');

            let leadCallsignIdShow = $('#LeadCallsignShow').val();

            $.ajax({
                url: "{{ route('getLeadCallsign') }}",
                type: "get",
                data: {
                    filLeadId: leadCallsignIdShow,
                    _token: _token
                },
                success: function(dtLead) {
                    console.log('dtLead : ', dtLead);
                    area = dtLead.callLead.branch_id;
                    leader = dtLead.callLead.nik_karyawan
                    // $('#leadCallsignShow').val(dtLead.callLead.lead_callsign)
                    // $('#leaderid').val(dtLead.callLead.leader_id)
                    // $('#leader').val(dtLead.callLead.nama_karyawan)
                    // $('#areaTim').val(dtLead.callLead.nama_branch)
                    // $('#posisiTim').val(dtLead.callLead.posisi)

                    $('#callsignTimidShow').find('option').remove();
                    $('#callsignTimidShow').append(
                        `<option value="">Pilih Callsign Tim</option>`);

                    $.each(dtLead.callTim, function(key, tim) {
                        $('#callsignTimidShow').append(
                            `<option value="${tim.callsign_tim_id+'|'+tim.callsign_tim}">${tim.callsign_tim}</option>`
                        )
                    })

                    // get_select_tool();
                }
            })
        })


        $(document).on('change', '#callsignTimidShow', function(t) {
            // t.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let leadCallsignId = $('#LeadCallsignShow').val();

            $.ajax({
                url: "{{ route('getTeknisi') }}",
                type: "get",
                data: {
                    leadCall: leadCallsignId,
                    callTim: $(this).val(),
                    _token: _token
                },
                success: function(dtTek) {

                    callTim = $('#callsignTimidShow').val().split('|');
                    $('#callsignTimShow').val(callTim[1]);

                    $('#teknisi1Show').find('option').remove();
                    $('#teknisi1Show').append(
                        `<option value="">Pilih Teknisi 1</option>`);

                    $('#teknisi2Show').find('option').remove();
                    $('#teknisi2Show').append(
                        `<option value="">Pilih Teknisi 2</option>`);

                    $('#teknisi3Show').find('option').remove();
                    $('#teknisi3Show').append(
                        `<option value="">Pilih Teknisi 3</option>`);

                    $('#teknisi4Show').find('option').remove();
                    $('#teknisi4Show').append(
                        `<option value="">Pilih Teknisi 4</option>`);


                    $.each(dtTek, function(key, t1) {
                        $('#teknisi1Show').append(
                            `<option value="${t1.nik_karyawan+'|'+t1.nama_karyawan}">${t1.nama_karyawan}</option>`
                        )
                    })
                    $.each(dtTek, function(key, t2) {
                        $('#teknisi2Show').append(
                            `<option value="${t2.nik_karyawan+'|'+t2.nama_karyawan}">${t2.nama_karyawan}</option>`
                        )
                    })
                    $.each(dtTek, function(key, t3) {
                        $('#teknisi3Show').append(
                            `<option value="${t3.nik_karyawan+'|'+t3.nama_karyawan}">${t3.nama_karyawan}</option>`
                        )
                    })
                    $.each(dtTek, function(key, t4) {
                        $('#teknisi4Show').append(
                            `<option value="${t4.nik_karyawan+'|'+t4.nama_karyawan}">${t4.nama_karyawan}</option>`
                        )
                    })

                }
            })
        })



        $(document).on('click', '#detail-assign', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let assign_id = $(this).data('id');

            $.ajax({
                url: "{{ route('getDetailAssign') }}",
                type: "get",
                data: {
                    filAssignId: assign_id,
                    _token: _token
                },
                success: function(dtDis) {
                    console.log(dtDis);
                    $('#detId').val(dtDis.data.id)
                    $('#noWoShow').val(dtDis.data.wo_no)
                    $('#ticketNoShow').val(dtDis.data.ticket_no)
                    $('#woTypeShow').val(toTitleCase(dtDis.data.wo_type))
                    $('#jenisWoShow').val(dtDis.data.jenis_wo)
                    $('#WoDateShow').val(dtDis.data.wo_date)
                    $('#custIdShow').val(dtDis.data.cust_id)
                    $('#custNameShow').val(toTitleCase(dtDis.data.name))
                    $('#custPhoneShow').val(dtDis.data.cust_phone)

                    $('#custMobileShow').val(dtDis.data.cust_mobile);
                    $('#custAddressShow').val(toTitleCase(dtDis.data.address));
                    $('#areaShow').val(toTitleCase(dtDis.data.area));
                    $('#ikrDateApkShow').val(dtDis.data.ikr_date);
                    $('#timeApkShow').val(dtDis.data.time);
                    $('#fatCodeShow').val(dtDis.data.fat_code);
                    $('#portFatShow').val(dtDis.data.fat_port);
                    $('#remarksShow').val(toTitleCase(dtDis.data.remarks));

                    $('#branchShow').val(dtDis.data.branch_id + '|' + dtDis.data.branch);
                    $('#tglProgressShow').val(dtDis.data.tgl_ikr);

                    $('#sesiShow').val(dtDis.data.batch_wo);

                    leadCallsignDet = dtDis.data.leadcall_id + '|' + dtDis.data.leadcall
                    // document.getElementById("LeadCallsignShow").value = leadCallsignDet;
                    $('#LeadCallsignShow').val(leadCallsignDet);
                    // $('#LeadCallsignShow').trigger('change');

                    $('#leaderShow').val(dtDis.data.leader);
                    $('#leaderidShow').val(dtDis.data.leader_id);
                    $('#slotTimeShow').val(dtDis.data.slot_time);

                    $('#callsignTimidShow').find('option').remove();
                    $('#callsignTimidShow').append(
                        `<option value="">Pilih Callsign Tim</option>`);

                    $.each(dtDis.callTim, function(key, tim) {
                        $('#callsignTimidShow').append(
                            `<option value="${tim.callsign_tim_id+'|'+tim.callsign_tim}">${tim.callsign_tim}</option>`
                        )
                    })

                    callsignTImidDet = dtDis.data.callsign_id + '|' + dtDis.data.callsign;
                    $('#callsignTimidShow').val(callsignTImidDet);
                    // $('#callsignTimidShow').trigger('change');
                    $('#callsignTimShow').val(dtDis.data.callsign);

                    $('#teknisi1Show').find('option').remove();
                    $('#teknisi1Show').append(
                        `<option value="">Pilih Teknisi 1</option>`);

                    $('#teknisi2Show').find('option').remove();
                    $('#teknisi2Show').append(
                        `<option value="">Pilih Teknisi 2</option>`);

                    $('#teknisi3Show').find('option').remove();
                    $('#teknisi3Show').append(
                        `<option value="">Pilih Teknisi 3</option>`);

                    $('#teknisi4Show').find('option').remove();
                    $('#teknisi4Show').append(
                        `<option value="">Pilih Teknisi 4</option>`);


                    $.each(dtDis.tim, function(key, t1) {
                        $('#teknisi1Show').append(
                            `<option value="${t1.nik_karyawan+'|'+t1.nama_karyawan}">${t1.nama_karyawan}</option>`
                        )
                    })
                    $.each(dtDis.tim, function(key, t2) {
                        $('#teknisi2Show').append(
                            `<option value="${t2.nik_karyawan+'|'+t2.nama_karyawan}">${t2.nama_karyawan}</option>`
                        )
                    })
                    $.each(dtDis.tim, function(key, t3) {
                        $('#teknisi3Show').append(
                            `<option value="${t3.nik_karyawan+'|'+t3.nama_karyawan}">${t3.nama_karyawan}</option>`
                        )
                    })
                    $.each(dtDis.tim, function(key, t4) {
                        $('#teknisi4Show').append(
                            `<option value="${t4.nik_karyawan+'|'+t4.nama_karyawan}">${t4.nama_karyawan}</option>`
                        )
                    })
                    // $('#callsignTimShow').val(dtDis.callsign);
                    $('#teknisi1Show').val(dtDis.data.tek1_nik + '|' + dtDis.data.teknisi1);
                    $('#teknisi2Show').val(dtDis.data.tek2_nik + '|' + dtDis.data.teknisi2);
                    $('#teknisi3Show').val(dtDis.data.tek3_nik + '|' + dtDis.data.teknisi3);
                    $('#teknisi4Show').val(dtDis.data.tek4_nik + '|' + dtDis.data.teknisi4);

                    $('#showAssignTim').modal('show');


                }
            })
        })




    })
</script>
