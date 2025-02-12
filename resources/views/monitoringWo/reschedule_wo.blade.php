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
                            <h3 class="text-white mb-2">Penjadwalan Ulang WO</h3>
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
                            <div class="row">
                                <div class="col">

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Tanggal Progress</span>
                                        <input class="form-control form-control-sm date-range" type="text"
                                            id="filtglProgress" name="filtglProgress" style="border-color:#9ca0a7;">
                                    </div>

                                    

                                    

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Type WO</span>
                                        <select class="form-control form-control-sm" type="text" id="filtypeWo"
                                            name="filtypeWo" style="border-color:#9ca0a7;">
                                            <option value="">Pilih Type WO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">

                                    <div class="form-group mb-1">
                                        <span class="text-xs">No WO</span>
                                        <input type="text" class="form-control form-control-sm" type="text"
                                            id="filnoWo" name="filnoWo" style="border-color:#9ca0a7;">
                                    </div>

                                    

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Area</span>
                                        <select class="form-control form-control-sm" type="text" id="filarea"
                                            name="filarea" style="border-color:#9ca0a7;">
                                            <option value="">Pilih Area</option>
                                        </select>
                                        <input type="hidden" id="filareaId" name="filareaId">
                                    </div>

                                    {{-- <div class="form-group mb-1">
                                        <span class="text-xs">Nama Leader</span>
                                        <select class="form-control form-control-sm" type="text" id="filleaderTim"
                                            name="filleaderTim" style="border-color:#9ca0a7;">
                                            <option value="">Pilih Leader</option>
                                        </select>
                                        <input type="hidden" id="filleaderid" name="filleaderid" readonly>
                                    </div> --}}

                                    {{-- <div class="form-group mb-1">
                                        <span class="text-xs">Callsign Tim</span>
                                        <select class="form-control form-control-sm" type="text"
                                            id="filcallsignTimid" name="filcallsignTimid" style="border-color:#9ca0a7;"
                                            placeholder="Isi Callsign Tim">
                                            <option value="">Pilih Callsign Tim</option>
                                        </select>
                                    </div> --}}

                                    {{-- <div class="form-group mb-1">
                                        <span class="text-xs">Teknisi</span>
                                        <select class="form-control form-control-sm" type="text" id="filteknisi"
                                            name="filteknisi" style="border-color:#9ca0a7;">
                                            <option value="">Pilih Teknisi</option>
                                        </select>
                                    </div> --}}

                                </div>

                                <div class="col">

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Cust Id</span>
                                        <input type="text" class="form-control form-control-sm" id="filcustId"
                                            name="filcustId" style="border-color:#9ca0a7;">
                                    </div>
                                    
                                    {{-- <div class="form-group mb-1">
                                        <span class="text-xs">Cluster</span>
                                        <select class="form-control form-control-sm" type="text" id="filcluster"
                                            name="filcluster" style="border-color:#9ca0a7;">
                                            <option value="">Pilih Cluster</option>
                                        </select>
                                    </div> --}}

                                    <div class="form-group mb-1">
                                        <span class="text-xs">FAT Code</span>
                                        <input type="text" class="form-control form-control-sm" id="filfatCode"
                                            name="filfatCode" style="border-color:#9ca0a7;">
                                    </div>

                                    {{-- <div class="form-group mb-1">
                                        <span class="text-xs">Slot Time</span>
                                        <select class="form-control form-control-sm" type="text" id="filslotTime"
                                            name="filslotTime" style="border-color:#9ca0a7;">
                                            <option value="">Pilih SlotTime</option>
                                        </select>
                                    </div> --}}

                                </div>
                                <hr>
                                <div class="row text-center mb-1">
                                    <div class="col">
                                        <button type="button"
                                            class="btn btn-sm btn-dark align-items-center filAssignTim"
                                            id="filAssignTim">Tampilkan</button>
                                        <button type="button" value="close"
                                            class="btn btn-sm btn-dark align-items-center"
                                            data-bs-dismiss="modal">Reset</button>
                                    </div>
                                </div>
                            </div>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" hidden>
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Rekap Penjadwalan Ulang WO</span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>                                
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">
                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="rekapPenjadwalanUlang" style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">Tanggal</th> --}}
                                            <th class="text-xs font-weight-semibold">Area</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">WO Date</th> --}}
                                            <th class="text-center text-xs font-weight-semibold">WO FTTH IB</th>
                                            <th class="text-center text-xs font-weight-semibold">WO FTTH MT</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">Cust Address</th> --}}
                                            <th class="text-center text-xs font-weight-semibold">Dismantle</th>
                                            <th class="text-center text-xs font-weight-semibold">WO FTTX IB</th>
                                            <th class="text-center text-xs font-weight-semibold">WO FTTX MT</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">Status WO</th> --}}
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

            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Data Penjadwalan Ulang WO</span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                {{-- <div class="ms-auto d-flex"> --}}
                                    {{-- <a href="javascript:void(0)"> --}}
                                        {{-- <button type="button" id="tambahPenjadwalanWO" name="tmbahPenjadwalanWO" --}}
                                            {{-- class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"> --}}
                                            {{-- <span class="btn-inner--icon">
                                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                    <path
                                                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                    </path>
                                                </svg>
                                            </span> --}}
                                            {{-- <span class="btn-inner--text">+ Penjadwalan Ulang WO</span> --}}
                                        {{-- </button> --}}
                                    {{-- </a> --}}

                                {{-- </div> --}}
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">
                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="tabelDataPending" style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">Tanggal</th> --}}
                                            <th class="text-center text-xs font-weight-semibold">No WO</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">WO Date</th> --}}
                                            <th class="text-center text-xs font-weight-semibold">Cust Id</th>
                                            <th class="text-center text-xs font-weight-semibold">Cust Name</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">Cust Address</th> --}}
                                            <th class="text-center text-xs font-weight-semibold">Type WO</th>
                                            <th class="text-center text-xs font-weight-semibold">Fat Code</th>
                                            <th class="text-center text-xs font-weight-semibold">Area</th>
                                            <th class="text-center text-xs font-weight-semibold">Tanggal Progress</th>
                                            <th class="text-center text-xs font-weight-semibold">Jam Progress</th>
                                            <th class="text-center text-xs font-weight-semibold">Status WO</th>
                                            <th class="text-center text-xs font-weight-semibold">Couse Code</th>
                                            <th class="text-center text-xs font-weight-semibold">Callsign</th>
                                            <th class="text-center text-xs font-weight-semibold">Tanggal Progress Ulang</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">Lead Callsign</th> --}}
                                            <th class="text-center text-xs font-weight-semibold">Jam Progress Ulang</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 1</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 2</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 3</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 4</th>
                                            <th class="text-center text-xs font-weight-semibold">Alasan Pending</th>
                                            
                                            {{-- <th class="text-center text-xs font-weight-semibold">Status WO</th> --}}

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

        {{-- Modal Tambah Penjadwalan Ulang --}}
        <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Penjadwalan Ulang WO</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="{{ route('updateSignTim') }}" method="post" enctype="multipart/form-data"> --}}
                        <form action="{{ route('simpanReschedule')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body px-1 py-1">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col form-group mb-1">
                                                    <input type="hidden" id="detId" name="detId"  class="form-control form-control-sm"  value="" readonly>
                                                    <span class="text-xs">WO No</span>
                                                    {{-- <div class="input-group mb-1"> --}}
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="noWoShow" name="noWoShow"
                                                            style="border-color:#9ca0a7;" required>

                                                        <button class="btn btn-sm btn-dark" type="button" id="cariWO">Cari</button>
                                                    {{-- </div> --}}
                                                </div>

                                                <div class="col-4 form-group mb-1">
                                                    <span class="text-xs">Status WO</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="statusWOShow" name="statusWOShow"
                                                        style="border-color:#9ca0a7;" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <div class="row">
                                                    <div class="col-4 form-group mb-1">
                                                        <span class="text-xs">Cust Id</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="custIdShow" name="custIdShow"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Cust Name</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="custNameShow" name="custNameShow"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <div class="row">
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">WO Type</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="woTypeApkShow" name="woTyepApkShow"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Type</span>
                                                        <input class="form-control form-control-sm"
                                                            type="text" id="woTypeShow" name="woTypeShow"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Remarks WO</span>
                                                <textarea class="form-control form-control-sm" type="text" id="remarksShow" name="remarksShow"
                                                    style="border-color:#9ca0a7;" readonly></textarea>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <div class="col form-group mb-1">
                                                <div class="row">
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Branch</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="branchShow" name="branchShow"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Sesi</span>
                                                        <input class="form-control form-control-sm"
                                                            type="text" id="sesiShow" name="sesiShow"
                                                            style="border-color:#9ca0a7;"
                                                            placeholder="Isi Callsign Tim" readonly>
                                                            
                                                        {{-- <select class="form-control form-control-sm"
                                                            type="text" id="sesiShow" name="sesiShow"
                                                            style="border-color:#9ca0a7;"
                                                            placeholder="Isi Callsign Tim">
                                                            <option value="Regular">Regular</option>
                                                            <option value="Batch 1">Batch 1</option>
                                                            <option value="Batch 2">Batch 2</option>
                                                            <option value="Batch 3">Batch 3</option>
                                                            <option value="Batch 4">Batch 4</option>
                                                            <option value="Batch 5">Batch 5</option>
                                                            <option value="Batch 6">Batch 6</option>
                                                            <option value="Pendingan">Pendingan</option>
                                                            <option value="Sameday">Sameday</option>

                                                        </select> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <div class="row">
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Tanggal Progress</span>
                                                        <input class="form-control form-control-sm" type="date"
                                                            id="tglProgressShow"
                                                            name="tglProgressShow" style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Slot Time Leader</span>
                                                        <input class="form-control form-control-sm"
                                                            type="text" id="slotTimeLeaderShow"
                                                            name="slotTimeLeaderShow"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <div class="row">
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Lead Callsign</span>
                                                        <input class="form-control form-control-sm"
                                                            id="LeadCallsignShow" name="LeadCallsignShow"
                                                            style="border-color:#9ca0a7;" readonly>
                                                            
                                                    </div>
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Nama Leader</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="leaderShow" name="leaderShow"
                                                            style="border-color:#9ca0a7;" readonly>
                                                        <input type="hidden" id="leaderidShow"
                                                            name="leaderidShow" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <div class="row">
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Callsign Tim</span>
                                                        <input class="form-control form-control-sm"
                                                            id="callsignTimShow" name="callsignTimShow"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Teknisi 1</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="teknisi1Show"
                                                                name="teknisi1Show"
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Teknisi 2</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                             id="teknisi2Show"
                                                            name="teknisi2Show"
                                                            style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Teknisi 3</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                             id="teknisi3Show"
                                                            name="teknisi3Show"
                                                            style="border-color:#9ca0a7;" readonly>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Teknisi 4</span>
                                                    <input class="form-control form-control-sm" type="text" id="teknisi4Show"
                                                        name="teknisi4Show" style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group mb-1">
                                                <div class="row">
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Tanggal Penjadwalan Ulang</span>
                                                        <input class="form-control form-control-sm" type="date"
                                                            id="tglReschedule"
                                                            name="tglReschedule" style="border-color:#9ca0a7;">
                                                    </div>

                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Slot Time</span>
                                                        <select class="form-control form-control-sm"
                                                            type="text" id="slotTimeReschedule"
                                                            name="slotTimeReschedule"
                                                            style="border-color:#9ca0a7;">
                                                            <option value="">Pilih Slot Time</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                            <option value="13:00">13:00</option>
                                                            <option value="13:30">13:30</option>
                                                            <option value="14:00">14:00</option>
                                                            <option value="14:30">14:30</option>
                                                            <option value="15:00">15:00</option>
                                                            <option value="15:30">15:30</option>
                                                            <option value="16:00">16:00</option>
                                                            <option value="16:30">16:30</option>
                                                            <option value="17:00">17:00</option>
                                                            <option value="17:30">17:30</option>
                                                            <option value="18:00">18:00</option>
                                                            <option value="18:30">18:30</option>
                                                            <option value="19:00">19:00</option>
                                                            <option value="19:30">19:30</option>
                                                            <option value="20:00">20:00</option>
                                                        </select>
                                                        {{-- <input class="form-control form-control-sm" type="text"
                                                            id="slotTimeLeaderShow" name="slotTimeLeaderShow"
                                                            style="border-color:#9ca0a7;"> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Keterangan Penjadwalan Ulang</span>
                                                    <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" style="border-color:#9ca0a7;"></textarea>
                                                </div>

                                                <div class="row">
            
                                                    <div class="col form-group mb-1 text-center">
                                                        <span class="text-xs">Foto Konfirmasi Cst</span>
                                                        <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                            id="showgambarKonfirmCst" alt="Card Image"
                                                            style="width:160px;height: 160px;" />
                                                            
                                                        <div class="form-group mb-1">
                                                                <input class="form-control form-control-sm" id="fotoKonfirmCst"
                                                                    name="fotoKonfirmCst" type="file" style="border-color:#9ca0a7;" required>
                                                        </div>
                                                    </div>
            
                                                    <div class="col form-group mb-1 text-center">
                                                        <span class="text-xs">Foto Konfirmasi Dispatch</span>
                                                        <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                            id="showgambarKonfirmDispatch" alt="Card Image"
                                                            style="width:160px;height: 160px;" />

                                                        <div class="form-group mb-1">
                                                            <input class="form-control form-control-sm" id="fotoKonfirmDispatch"
                                                                name="fotoKonfirmDispatch" type="file" style="border-color:#9ca0a7;" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-dark align-items-center simpanReschedule"
                            id="simpanReschedule">Simpan</button>
                        <button type="button" value="close" class="btn btn-sm btn-dark align-items-center"
                            data-bs-dismiss="modal">Batalkan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Modal Tambah Pending --}}

        {{-- Modal Show Pending Ulang --}}
        <div class="modal fade" id="modalDetailPending" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Penjadwalan Ulang WO</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="{{ route('updateSignTim') }}" method="post" enctype="multipart/form-data"> --}}
                        <form action="#" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body px-1 py-1">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col form-group mb-1">
                                                    <input type="hidden" id="detIdPending" name="detIdPending"  class="form-control form-control-sm"  value="" readonly>
                                                    <span class="text-xs">WO No</span>
                                                    {{-- <div class="input-group mb-1"> --}}
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="noWoDetail" name="noWoDetail"
                                                            style="border-color:#9ca0a7;" readonly>

                                                        {{-- <button class="btn btn-sm btn-dark" type="button" id="cariWO">Cari</button> --}}
                                                    {{-- </div> --}}
                                                </div>

                                                <div class="col-4 form-group mb-1">
                                                    <span class="text-xs">Status WO</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="statusWODetail" name="statusWODetail"
                                                        style="border-color:#9ca0a7;" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <div class="row">
                                                    <div class="col-4 form-group mb-1">
                                                        <span class="text-xs">Cust Id</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="custIdDetail" name="custIdDetail"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Cust Name</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="custNameDetail" name="custNameDetail"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <div class="row">
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">WO Type</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="woTypeApkDetail" name="woTypeApkDetail"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Type</span>
                                                        <input class="form-control form-control-sm"
                                                            type="text" id="woTypeDetail" name="woTypeDetail"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Remarks WO</span>
                                                <textarea class="form-control form-control-sm" type="text" id="remarksDetail" name="remarksDetail"
                                                    style="border-color:#9ca0a7;" readonly></textarea>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <div class="col form-group mb-1">
                                                <div class="row">
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Branch</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="branchDetail" name="branchDetail"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    {{-- <div class="col form-group mb-1"> --}}
                                                        {{-- <span class="text-xs">Sesi</span> --}}
                                                        {{-- <input class="form-control form-control-sm"
                                                            type="text" id="sesiShow" name="sesiShow"
                                                            style="border-color:#9ca0a7;"
                                                            placeholder="Isi Callsign Tim" readonly> --}}
                                                            
                                                        {{-- <select class="form-control form-control-sm"
                                                            type="text" id="sesiShow" name="sesiShow"
                                                            style="border-color:#9ca0a7;"
                                                            placeholder="Isi Callsign Tim">
                                                            <option value="Regular">Regular</option>
                                                            <option value="Batch 1">Batch 1</option>
                                                            <option value="Batch 2">Batch 2</option>
                                                            <option value="Batch 3">Batch 3</option>
                                                            <option value="Batch 4">Batch 4</option>
                                                            <option value="Batch 5">Batch 5</option>
                                                            <option value="Batch 6">Batch 6</option>
                                                            <option value="Pendingan">Pendingan</option>
                                                            <option value="Sameday">Sameday</option>

                                                        </select> --}}
                                                    {{-- </div> --}}
                                                </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <div class="row">
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Tanggal Progress</span>
                                                        <input class="form-control form-control-sm" type="date"
                                                            id="tglProgressDetail"
                                                            name="tglProgressDetail" style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Slot Time Leader</span>
                                                        <input class="form-control form-control-sm"
                                                            type="text" id="slotTimeLeaderDetail"
                                                            name="slotTimeLeaderDetail"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <div class="row">
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Lead Callsign</span>
                                                        <input class="form-control form-control-sm"
                                                            id="LeadCallsignDetail" name="LeadCallsignDetail"
                                                            style="border-color:#9ca0a7;" readonly>
                                                            
                                                    </div>
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Nama Leader</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="leaderDetail" name="leaderDetail"
                                                            style="border-color:#9ca0a7;" readonly>
                                                        {{-- <input type="hidden" id="leaderidShow"
                                                            name="leaderidShow" readonly> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <div class="row">
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Callsign Tim</span>
                                                        <input class="form-control form-control-sm"
                                                            id="callsignTimDetail" name="callsignTimDetail"
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Teknisi 1</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="teknisi1Detail"
                                                                name="teknisi1Detail"
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Teknisi 2</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                             id="teknisi2Detail"
                                                            name="teknisi2Detail"
                                                            style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Teknisi 3</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                             id="teknisi3Detail"
                                                            name="teknisi3Detail"
                                                            style="border-color:#9ca0a7;" readonly>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Teknisi 4</span>
                                                    <input class="form-control form-control-sm" type="text" id="teknisi4Detail"
                                                        name="teknisi4Detail" style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group mb-1">
                                                <div class="row">
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Tanggal Penjadwalan Ulang</span>
                                                        <input class="form-control form-control-sm" type="date"
                                                            id="tglRescheduleDetail"
                                                            name="tglRescheduleDetail" style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Slot Time</span>
                                                        <select class="form-control form-control-sm"
                                                            type="text" id="slotTimeRescheduleDetail"
                                                            name="slotTimeRescheduleDetail"
                                                            style="border-color:#9ca0a7;" disabled>
                                                            <option value="">Pilih Slot Time</option>
                                                            <option value="09:00:00">09:00:00</option>
                                                            <option value="09:30:00">09:30:00</option>
                                                            <option value="10:00:00">10:00:00</option>
                                                            <option value="10:30:00">10:30:00</option>
                                                            <option value="11:00:00">11:00:00</option>
                                                            <option value="11:30:00">11:30:00</option>
                                                            <option value="12:00:00">12:00:00</option>
                                                            <option value="12:30:00">12:30:00</option>
                                                            <option value="13:00:00">13:00:00</option>
                                                            <option value="13:30:00">13:30:00</option>
                                                            <option value="14:00:00">14:00:00</option>
                                                            <option value="14:30:00">14:30:00</option>
                                                            <option value="15:00:00">15:00:00</option>
                                                            <option value="15:30:00">15:30:00</option>
                                                            <option value="16:00:00">16:00:00</option>
                                                            <option value="16:30:00">16:30:00</option>
                                                            <option value="17:00:00">17:00:00</option>
                                                            <option value="17:30:00">17:30:00</option>
                                                            <option value="18:00:00">18:00:00</option>
                                                            <option value="18:30:00">18:30:00</option>
                                                            <option value="19:00:00">19:00:00</option>
                                                            <option value="19:30:00">19:30:00</option>
                                                            <option value="20:00:00">20:00:00</option>
                                                        </select>
                                                        {{-- <input class="form-control form-control-sm" type="text"
                                                            id="slotTimeLeaderShow" name="slotTimeLeaderShow"
                                                            style="border-color:#9ca0a7;"> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Keterangan Penjadwalan Ulang</span>
                                                    <textarea class="form-control form-control-sm" id="keteranganDetail" name="keteranganDetail" style="border-color:#9ca0a7;" readonly></textarea>
                                                </div>

                                                <div class="row">
            
                                                    <div class="col form-group mb-1 text-center">
                                                        <span class="text-xs">Foto Konfirmasi Cst</span>
                                                        <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                            id="showgambarKonfirmCstDetail" alt="Card Image"
                                                            style="width:160px;height: 160px;" />
                                                            
                                                        <div class="form-group mb-1">
                                                                <input class="form-control form-control-sm" id="fotoKonfirmCst"
                                                                    name="fotoKonfirmCstDetail" type="file" style="border-color:#9ca0a7;" disabled>
                                                        </div>
                                                    </div>
            
                                                    <div class="col form-group mb-1 text-center">
                                                        <span class="text-xs">Foto Konfirmasi Dispatch</span>
                                                        <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                            id="showgambarKonfirmDispatchDetail" alt="Card Image"
                                                            style="width:160px;height: 160px;" />

                                                        <div class="form-group mb-1">
                                                            <input class="form-control form-control-sm" id="fotoKonfirmDispatch"
                                                                name="fotoKonfirmDispatchDetail" type="file" style="border-color:#9ca0a7;" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        {{-- <button type="submit" class="btn btn-sm btn-dark align-items-center EditReschedule"
                            id="editReschedule">Edit</button> --}}
                        <button type="button" value="close" class="btn btn-sm btn-dark align-items-center"
                            data-bs-dismiss="modal">Kembali</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Modal Show Detail pending --}}

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl"> <!-- Tambahkan modal-xl -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Gunakan table-responsive agar tabel bisa di-scroll -->
                        <div class="table-responsive">
                            <table class="table table-bordered" id="detailHistoryuWo">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">No WO</th>
                                        <th scope="col">Cust Id</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Tanggal Ikr</th>
                                        <th scope="col">Status Wo</th>
                                        <th scope="col">Couse Code</th>
                                        <th scope="col">Root Couse</th>
                                        <th scope="col">Action Taken</th>
                                        <th scope="col">Kode Fat</th>
                                        <th scope="col">Branch</th>
                                        <th scope="col">Cluster</th>
                                        <th scope="col">Kotamadya</th>
                                        <th scope="col">Callsign</th>
                                        <th scope="col">Leader</th>
                                        <th scope="col">Teknisi1</th>
                                        <th scope="col">Teknisi2</th>
                                        <th scope="col">Teknisi3</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

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
    function readURL(input, kategori) {
        if(kategori === "cst"){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showgambarKonfirmCst').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        if(kategori === "dispatch"){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showgambarKonfirmDispatch').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    }

    $("#fotoKonfirmCst").change(function() {
        readURL(this, "cst");
    });

    $("#fotoKonfirmDispatch").change(function() {
        readURL(this, "dispatch");
    });

</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">
    let firstDate;
    let lastDate;
    let dataFtthIB = "";

    $('.date-range').daterangepicker();
    //set date rangepicker value empty after load
    $('.date-range').val("");


    // $(function() {
    //     $('input[name="filtglProgress"]').daterangepicker({
    //         opens: 'right'
    //     }, function(start, end, label) {
    //         firstDate = start.format('YYYY-MM-DD')
    //         lastDate = end.format('YYYY-MM-DD')
    //         // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

    //         // console.log("firstDate: " + firstDate)
    //         // console.log("lastDate: " + lastDate);

    //         starting = moment(start.format('YYYY-MM-DD'))
    //         ending = moment(end.format('YYYY-MM-DD'))
    //         let dif = ending.diff(starting, 'days');
    //         // console.log(dif);

    //     });
    // });
</script>

<script>
    function detailHistory(id) {
        var _token = $('meta[name=csrf-token]').attr('content');
        console.log(id); // Debugging ID yang dikirim

            var data_assignTim = $('#detailHistoryuWo').DataTable({
                // dom: 'Bftip',
                layout: {
                    topStart: {
                        buttons: ['excel']
                    },
                },
                paging: true,
                orderClasses: false,
                // fixedColumns: true,

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
                    url: "{{ route('getDetailCustId') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        cust_id: id,
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
                        data: 'no_wo',
                        // width: '90'
                    },
                    {
                        data: 'cust_id'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'tgl_ikr',
                    },
                    {
                        data: 'status_wo'
                    },
                    {
                        data: 'couse_code'
                    },
                    {
                        data: 'root_couse'
                    },
                    {
                        data: 'action_taken'
                    },
                    {
                        data: 'kode_fat'
                    },
                    {
                        data: 'branch'
                    },
                    {
                        data: 'cluster'
                    },
                    {
                        data: 'kotamadya'
                    },
                    {
                        data: 'callsign'
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
                    // {
                    //     data: 'action',
                    //     "className": "text-center",
                    // },
                ]
            })
            $('#exampleModal').modal('show'); // Tampilkan modal
        }

</script>

<script>
    $(document).ready(function() {
        var _token = $('meta[name=csrf-token]').attr('content');
        var firstDate;
        var lastDate;
        var stDate;
        var enDate;
        akses = $('#akses').val();
        // get_data_assignTim()

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

        $(document).on('click', '#tambahPenjadwalanWO', function(e) {
            $('#modalTambah').modal('show');

            $('#showgambarKonfirmCst').attr('src',
                    `/storage/image-tool/foto-blank.jpg`)

            $('#showgambarKonfirmDispatch').attr('src',
                    `/storage/image-tool/foto-blank.jpg`)
            
            $('#noWoShow').val("")
            $('#detId').val("")
            $('#statusWOShow').val("")
            $('#woTypeApkShow').val("")
            $('#woTypeShow').val("")
            $('#custIdShow').val("")
            $('#custNameShow').val("")
            $('#remarksShow').val("");

            $('#branchShow').val("");
            $('#tglProgressShow').val("");

            $('#sesiShow').val("");
            $('#slotTimeLeaderShow').val("");

            $('#leaderShow').val("");
            $('#LeadCallsignShow').val("");
            $('#callsignTimShow').val("");

            $('#teknisi1Show').val("");
            $('#teknisi2Show').val("");
            $('#teknisi3Show').val("");
            $('#teknisi4Show').val("");

            $('#tglReschedule').val("");
            $('#slotTimeReschedule').val("");
            $('#keterangan').val("");
            $('#fotoKonfirmCst').val("");
            $('#fotoKonfirmDispatch').val("");

        })

        $(document).on('click', '#filAssignTim', function(e) {
            get_rekap_pending();
            get_data_pending();
            stDate = $('.date-range').data('daterangepicker').startDate.format("DD-MMM-YYYY");
            enDate = $('.date-range').data('daterangepicker').endDate.format("DD-MMM-YYYY");
        })

        $('#filAssignTim').trigger("click");

        function get_data_pending() {
            var data_pending = $('#tabelDataPending').DataTable({
                // dom: 'Bftip',
                layout: {
                    topStart: {
                        buttons: ['excel']
                    },
                },
                paging: true,
                orderClasses: false,
                // fixedColumns: true,

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
                    url: "{{ route('getDataPendingReschedule') }}",
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
                        data: 'no_wo',
                        // width: '90'
                    },
                    // {
                    //     data: 'cust_id',
                    //     render: function (data, type, row) {
                    //         return `<a href="javascript:void(0);" data-id="${data}" id="detail-history" onclick="detailHistory(${data})" class="text-primary">${data}</a>`;

                    //     }
                    // },
                    {
                        data: 'cust_id'
                    },
                    {
                        data: 'nama_cust'
                    },
                    {
                        data: 'type_wo'
                    },
                    {
                        data: 'kode_fat'
                    },
                    {
                        data: 'branch'
                    },
                    {
                        data: 'tgl_ikr'
                    },                   
                    {
                        data: 'slot_time_apk'
                    },
                    {
                        data: 'status_wo'
                    },
                    {
                        data: 'couse_code'
                    },
                    {
                        data: 'callsign'
                    },
                    {
                        data: 'tgl_reschedule'
                    },
                    {
                        data: 'tgl_jam_reschedule'
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
                        data: 'detail_alasan',
                        "width": 150
                    },
                    
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }

        function get_rekap_pending() {
            var data_pending = $('#rekapPenjadwalanUlang').DataTable({
                // dom: 'Bftip',
                layout: {
                    topStart: {
                        buttons: ['excel']
                    },
                },
                paging: true,
                orderClasses: false,
                // fixedColumns: true,

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
                    url: "{{ route('getRekapPendingReschedule') }}",
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
                    //     data: 'cust_id',
                    //     render: function (data, type, row) {
                    //         return `<a href="javascript:void(0);" data-id="${data}" id="detail-history" onclick="detailHistory(${data})" class="text-primary">${data}</a>`;

                    //     }
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

        $(document).on('click', '#cariWO', function(e) {

            e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let filWO = $('#noWoShow').val();

            $.ajax({
                url: "{{ route('getDetailWORsch') }}",
                type: "get",
                data: {
                    filWO: filWO,
                    _token: _token
                },
                success: function(dtDis) {
                    console.log(dtDis)
                    if(dtDis === "NoData")
                    {
                        window.alert("Data WO tidak ditemukan");        
                    }

                    $('#showgambarKonfirmCst').attr('src',
                    `/storage/image-tool/foto-blank.jpg`)

                    $('#showgambarKonfirmDispatch').attr('src',
                    `/storage/image-tool/foto-blank.jpg`)
                    
                    $('#detId').val(dtDis.id)
                    $('#statusWOShow').val(toTitleCase(dtDis.status_wo || ""))
                    $('#woTypeApkShow').val(toTitleCase(dtDis.wo_type_apk || ""))
                    $('#woTypeShow').val(toTitleCase(dtDis.type_wo || ""))
                    $('#custIdShow').val(dtDis.cust_id)
                    $('#custNameShow').val(toTitleCase(dtDis.nama_cust || ""))
                    $('#remarksShow').val(toTitleCase(dtDis.type_maintenance || "" ));

                    $('#branchShow').val(dtDis.branch);
                    $('#tglProgressShow').val(dtDis.tgl_ikr);

                    $('#sesiShow').val(dtDis.sesi);
                    $('#slotTimeLeaderShow').val(dtDis.slot_time_leader);

                    $('#leaderShow').val(dtDis.leader);
                    $('#LeadCallsignShow').val(dtDis.leadcall);
                    $('#callsignTimShow').val(dtDis.callsign);

                    $('#teknisi1Show').val(toTitleCase(dtDis.teknisi1 || "" ));
                    $('#teknisi2Show').val(toTitleCase(dtDis.teknisi2 || "" ));
                    $('#teknisi3Show').val(toTitleCase(dtDis.teknisi3 || "" ));
                    $('#teknisi4Show').val(toTitleCase(dtDis.teknisi4 || "" ));


                }
            })
        })

        $(document).on('click', '#detail-pending', function(e) {

            e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let filPendingID = $(this).data('id');

            $.ajax({
                url: "{{ route('getDetailPending') }}",
                type: "get",
                data: {
                    filPendingID: filPendingID,
                    _token: _token
                },
                success: function(dtDis) {
                    console.log(dtDis)

                    $('#modalDetailPending').modal('show');

                    $('#showgambarKonfirmCstDetail').attr('src',
                        `/storage/image-pending/${dtDis.konfirmasi_cst}`);

                    $('#showgambarKonfirmDispatchDetail').attr('src',
                        `/storage/image-pending/${dtDis.konfirmasi_dispatch}`);
        
                    $('#detIdPending').val(dtDis.id)
                    $('#noWoDetail').val(dtDis.wo_no)
                    $('#statusWODetail').val(toTitleCase(dtDis.status_wo || ""))
                    $('#custIdDetail').val(dtDis.cust_id)
                    $('#custNameDetail').val(toTitleCase(dtDis.nama_cust || ""))
                    $('#woTypeApkDetail').val(toTitleCase(dtDis.type_wo || ""))
                    $('#woTypeDetail').val(toTitleCase(dtDis.type_wo || ""))
            
                    $('#remarksDetail').val(toTitleCase(dtDis.remark_wo || "" ));

                    $('#branchDetail').val(dtDis.branch);
                    $('#tglProgressDetail').val(dtDis.tgl_ikr);

                    // $('#sesiShow').val(dtDis.sesi);
                    $('#slotTimeLeaderDetail').val(dtDis.slot_time_leader);
            
                    $('#LeadCallsignDetail').val(dtDis.leadcall);
                    $('#leaderDetail').val(dtDis.leader);
                    $('#callsignTimDetail').val(dtDis.callsign);

                    $('#teknisi1Detail').val(toTitleCase(dtDis.teknisi1 || "" ));
                    $('#teknisi2Detail').val(toTitleCase(dtDis.teknisi2 || "" ));
                    $('#teknisi3Detail').val(toTitleCase(dtDis.teknisi3 || "" ));
                    $('#teknisi4Detail').val(toTitleCase(dtDis.teknisi4 || "" ));

                    $('#tglRescheduleDetail').val(dtDis.reschedule_date);
                    $('#slotTimeRescheduleDetail').val(dtDis.reschedule_time);
                    $('#keteranganDetail').val(dtDis.keterangan);

                }
            })
        })


    })
</script>
