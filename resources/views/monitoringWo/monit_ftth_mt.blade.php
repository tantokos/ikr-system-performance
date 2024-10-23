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
                            <h3 class="text-white mb-2">Monitoring WO FTTH Maintenance</h3>
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
                                        <span class="text-xs">No WO</span>
                                        <input type="text" class="form-control form-control-sm" type="text"
                                            id="filnoWo" name="filnoWo" style="border-color:#9ca0a7;">
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Cust Id</span>
                                        <input type="text" class="form-control form-control-sm" id="filcustId"
                                            name="filcustId" style="border-color:#9ca0a7;">
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
                                        <span class="text-xs">Area</span>
                                        <select class="form-control form-control-sm" type="text" id="filarea"
                                            name="filarea" style="border-color:#9ca0a7;">
                                            <option value="">Pilih Area</option>
                                        </select>
                                        <input type="hidden" id="filareaId" name="filareaId">
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Nama Leader</span>
                                        <select class="form-control form-control-sm" type="text" id="filleaderTim"
                                            name="filleaderTim" style="border-color:#9ca0a7;">
                                            <option value="">Pilih Leader</option>
                                        </select>
                                        <input type="hidden" id="filleaderid" name="filleaderid" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Callsign Tim</span>
                                        <select class="form-control form-control-sm" type="text"
                                            id="filcallsignTimid" name="filcallsignTimid" style="border-color:#9ca0a7;"
                                            placeholder="Isi Callsign Tim">
                                            <option value="">Pilih Callsign Tim</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Teknisi</span>
                                        <select class="form-control form-control-sm" type="text" id="filteknisi"
                                            name="filteknisi" style="border-color:#9ca0a7;">
                                            <option value="">Pilih Teknisi</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col">

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Cluster</span>
                                        <select class="form-control form-control-sm" type="text" id="filcluster"
                                            name="filcluster" style="border-color:#9ca0a7;">
                                            <option value="">Pilih Cluster</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">FAT Code</span>
                                        <input type="text" class="form-control form-control-sm" id="filfatCode"
                                            name="filfatCode" style="border-color:#9ca0a7;">
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Slot Time</span>
                                        <select class="form-control form-control-sm" type="text" id="filslotTime"
                                            name="filslotTime" style="border-color:#9ca0a7;">
                                            <option value="">Pilih SlotTime</option>
                                        </select>
                                    </div>

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

            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Data FTTH Maintenance</span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
                                    <a href="{{ route('importDataFtthMtApk') }}">
                                        <button type="button"
                                            class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                            <span class="btn-inner--icon">
                                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                    <path
                                                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <span class="btn-inner--text">Import Data WO</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-header border-bottom pb-0"> --}}
                        {{-- <div class="d-sm-flex align-items-center"> --}}
                        {{-- <div> --}}
                        {{-- <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Data WO</span></h6> --}}
                        {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                        {{-- </div> --}}

                        {{-- <div class="ms-auto d-flex">
                                    <button type="button"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                        data-bs-toggle="modal" data-bs-target="#tambahAssignTim">
                                        <span class="fa fa-pencil"></span>

                                        <span class="btn-inner--text">Tambah Assign Tim</span>
                                    </button>

                                    <a href="{{ route('importDataWo') }}">
                                        <button type="button"
                                            class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                            <span class="btn-inner--icon">
                                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                    <path
                                                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <span class="btn-inner--text">Import Data WO</span>
                                        </button>
                                    </a>
                                </div> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}

                        <div class="card-body px-2 py-2">
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
                                            {{-- <th class="text-center text-xs font-weight-semibold">Lead Callsign</th> --}}
                                            <th class="text-center text-xs font-weight-semibold">Callsign Tim</th>
                                            <th class="text-center text-xs font-weight-semibold">Leader</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 1</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 2</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 3</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">Teknisi 4</th> --}}
                                            <th class="text-center text-xs font-weight-semibold">Status WO</th>

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

        {{-- Modal Show Detail Data Tool --}}
        <div class="modal fade" id="showDetail" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Progress WO FTTH Maintenance</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="{{ route('updateSignTim') }}" method="post" enctype="multipart/form-data"> --}}
                        <form action="{{ route('updateFtthMt') }}" method="post" enctype="multipart/form-data">

                            @method('PUT')
                            @csrf

                            <div class="card-body px-1 py-1">
                                <div class="nav-wrapper position-relative end-0">
                                    <ul class="nav nav-tabs nav-fill p-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab"
                                                href="#DetailWo" role="tab" aria-controls="DetailWo"
                                                aria-selected="true">
                                                Detail WO
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                                href="#StatusProgress" role="tab" aria-controls="StatusProgress"
                                                aria-selected="true">Status Progress
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                                href="#StatusMaterial" role="tab" aria-controls="StatusMaterial"
                                                aria-selected="false">Status Material
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane active" id="DetailWo" role="tabpanel" aria-expanded="true">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col form-group mb-1">
                                                        <input type="hidden" id="detId" name="detId">
                                                        <span class="text-xs">WO No</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="noWoShow" name="noWoShow"
                                                            style="border-color:#9ca0a7;">
                                                    </div>

                                                    <div class="col-4 form-group mb-1">
                                                        <span class="text-xs">Ticket No</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="ticketNoShow" name="ticketNoShow"
                                                            style="border-color:#9ca0a7;">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col-4 form-group mb-1">
                                                            <span class="text-xs">Cust Id</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="custIdShow" name="custIdShow"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Cust Name</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="custNameShow" name="custNameShow"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">WO Type</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="woTypeShow" name="woTypeShow"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Type</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="jenisWoShow" name="jenisWoShow"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="FTTH New Installation">FTTH New
                                                                    Installation
                                                                </option>
                                                                <option value="FTTH Maintenance">FTTH Maintenance
                                                                </option>
                                                                <option value="Dismantle">Dismantle</option>
                                                                <option value="FTTX/B New Installation">FTTX/B New
                                                                    Installation
                                                                </option>
                                                                <option value="FTTX/B Maintenance">FTTX/B Maintenance
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">WO Date</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="WoDateShow" name="WoDateShow"
                                                        style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Address</span>
                                                    <textarea class="form-control form-control-sm" type="text" id="custAddressShow" name="custAddressShow"
                                                        style="border-color:#9ca0a7;"></textarea>
                                                </div>
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Area/Cluster</span>
                                                    <input type="text" class="form-control form-control-sm"
                                                        type="text" id="areaShow" name="areaShow"
                                                        style="border-color:#9ca0a7;">
                                                </div>



                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">FAT Code</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="fatCodeShow" name="fatCodeShow"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col-4 form-group mb-1">
                                                            <span class="text-xs">Port FAT</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="portFatShow" name="portFatShow"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Remarks</span>
                                                    <textarea class="form-control form-control-sm" type="text" id="remarksShow" name="remarksShow"
                                                        style="border-color:#9ca0a7;"></textarea>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <div class="col form-group mb-1">
                                                    <span class="text-xs">Branch</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="branchShow" name="branchShow"
                                                        style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Tanggal Progress</span>
                                                            <input class="form-control form-control-sm" type="date"
                                                                value="{{ date('Y-m-d') }}" id="tglProgressShow"
                                                                name="tglProgressShow" style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Sesi</span>
                                                            <select class="form-control form-control-sm"
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

                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Slot Time Leader</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="slotTimeLeaderShow"
                                                                name="slotTimeLeaderShow"
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

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Slot Time APK</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="slotTimeAPKShow"
                                                                name="slotTimeAPKShow" style="border-color:#9ca0a7;">
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
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">


                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Lead Callsign</span>
                                                            <select class="form-control form-control-sm"
                                                                id="LeadCallsignShow" name="LeadCallsignShow"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="">Pilih Lead Callsign</option>
                                                                @if (isset($leadCallsign))
                                                                    @foreach ($leadCallsign as $lead)
                                                                        <option
                                                                            value="{{ $lead->leadcall_id }}">
                                                                            {{ $lead->leadcall_id }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
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
                                                            <select class="form-control form-control-sm"
                                                                id="callsignTimidShow" name="callsignTimidShow"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="">Pilih Callsign Tim</option>
                                                            </select>
                                                            <input type="hidden" id="callsignTimShow"
                                                                name="callsignTimShow">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <span class="text-xs">Teknisi 1</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                                 id="teknisi1Show"
                                                                name="teknisi1Show"
                                                                style="border-color:#9ca0a7;">
                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <span class="text-xs">Teknisi 2</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                                 id="teknisi2Show"
                                                                name="teknisi2Show"
                                                                style="border-color:#9ca0a7;">
                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <span class="text-xs">Teknisi 3</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                                 id="teknisi3Show"
                                                                name="teknisi3Show"
                                                                style="border-color:#9ca0a7;">
                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <span class="text-xs">Teknisi 4</span>
                                                        <select class="form-control form-control-sm" type="text" id="teknisi4Show"
                                                            name="teknisi4Show" style="border-color:#9ca0a7;">
                                                            <option value="">Teknisi 4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane" id="StatusProgress" role="tabpanel" aria-expanded="true">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Tanggal Progress</span>
                                                            <input class="form-control form-control-sm" type="date"
                                                                value="{{ date('Y-m-d') }}" id="tglProgressStatusShow"
                                                                name="tglProgressStatusShow"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Slot Time Leader</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="slotTimeLeaderStatusShow"
                                                                name="slotTimeLeaderStatusShow"
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
                                                        </div>



                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Status WO</span>
                                                        <select class="form-control form-control-sm" type="text"
                                                            id="statusWoShow" name="statusWo"
                                                            style="border-color:#9ca0a7;">
                                                            <option value="">Pilih Status WO</option>
                                                            <option value="Done">Done</option>
                                                            <option value="Pending">Pending</option>
                                                            <option value="Cancel">Cancel</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Cause Code</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="causeCode" name="causeCode"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Root Cause</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="rootCause" name="rootCause"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Action Taken</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="actionTaken" name="actionTaken"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Penagihan</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="penagihanShow"
                                                                name="penagihanShow" style="border-color:#9ca0a7;">
                                                                <option value="Migrasi Dw To Precon">Migrasi Dw To Precon</option>
                                                                <option value="Replace Precon To Precon">Replace Precon To Precon</option>
                                                                <option value="No Customer">No Customer</option>
                                                                <option value="Connector">Connector</option>
                                                                <option value="Cancel by Dispatcher">Cancel by Dispatcher</option>
                                                                <option value="Reconfig">Reconfig</option>
                                                                <option value="ONT">ONT</option>
                                                                <option value="Bad Cable Splice">Bad Cable Splice</option>
                                                                <option value="Reschedule">Reschedule</option>
                                                                <option value="STB">STB</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Alasan Tidak Ganti Precon</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="remarkStatus" name="remarkStatus"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Kondisi Cuaca</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="weatherShow" name="weatherShow"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="Cerah">Cerah</option>
                                                                <option value="Hujan">Hujan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Tanggal Penjadwalan
                                                                Ulang</span>
                                                            <input class="form-control form-control-sm" type="date"
                                                                id="tglReschedule" name="tglReschedule"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Jam Penjadwalan Ulang</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="jamReschedule"
                                                                name="jamReschedule" style="border-color:#9ca0a7;">
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
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Alasan Pending</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="alasanPending" name="alasanPending"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">PIC Dispatch</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="picDispatch" name="picDispatch"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Alasan Cancel</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="alasanCancel" name="alasanCancel"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Report Teknisi</span>
                                                    <textarea class="form-control form-control-sm" type="text" id="remarksTeknisi" name="remarksTeknisi"
                                                        style="border-color:#9ca0a7;"></textarea>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Tanggal Progress Aplikasi</span>
                                                            <input class="form-control form-control-sm" type="date"
                                                                value="{{ date('Y-m-d') }}" id="tglProgressAPKShow"
                                                                name="tglProgressAPKShow"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Slot Time Aplikasi</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="slotTimeAPKStatusShow"
                                                                name="slotTimeAPKStatusShow"
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
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col form-group mb-1">
                                                    <span class="text-xs">Status WO Aplikasi</span>
                                                    <select class="form-control form-control-sm" type="text"
                                                        id="statusWoApk" name="statusWoApk"
                                                        style="border-color:#9ca0a7;">
                                                        <option value="">Pilih Status WO</option>
                                                        <option value="Checkout">Checkout</option>
                                                        <option value="Done">Done</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Cancel">Cancel</option>
                                                    </select>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Cause Code Aplikasi</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="causeCodeAPK" name="causeCodeAPK"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Root Cause Aplikasi</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="rootCauseAPK" name="rootCauseAPK"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Action Taken Aplikasi</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="actionTakenAPK" name="actionTakenAPK"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Checkin Aplikasi</span>
                                                            <input class="form-control form-control-sm" type="date"
                                                                value="{{ date('Y-m-d') }}" id="tglCheckinApk"
                                                                name="checkin_apk"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Checkout Aplikasi</span>
                                                            <input class="form-control form-control-sm" type="date"
                                                                value="{{ date('Y-m-d') }}" id="tglCheckoutApk"
                                                                name="checkout_apk"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane" id="StatusMaterial" role="tabpanel" aria-expanded="true">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Merk ONT Terpasang</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="merkOntOut" name="merkOntOut"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">SN ONT Terpasang</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="snOntOut" name="snOntOut"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">MAC ONT Terpasang</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="macOntOut" name="macOntOut"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Merk ONT Terambil</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="merkOntIn" name="merkOntIn"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">SN ONT Terambil</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="snOntIn" name="snOntIn"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">MAC ONT Terambil</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="macOntIn" name="macOntIn"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Merk STB Terpasang</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="merkStbOut" name="merkStbOut"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">SN STB Terpasang</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="snStbOut" name="snStbOut"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">MAC STB Terpasang</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="macStbOut" name="macStbOut"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Merk STB Terambil</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="merkStbIn" name="merkStbIn"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">SN STB Terambil</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="snStbIn" name="snStbIn"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">MAC STB Terambil</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="macStbIn" name="macStbIn"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Merk Router Terpasang</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="merkRouterOut"
                                                                name="merkRouterOut" style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">SN Router Terpasang</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="snRouterOut" name="snRouterOut"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">MAC Router Terpasang</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="macRouterOut" name="macRouterOut"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Merk Router Terambil</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="merkRouterIn" name="merkRouterIn"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">SN Router Terambil</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="snRouterIn" name="snRouterIn"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">MAC Router Terambil</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="macRouterIn" name="macRouterIn"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Kabel Drop Wire</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="kabelDw" name="kabelDw"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Kabel Precon</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="kabelPrecon" name="kabelPrecon"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Kabel Precon Bad</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="kabelPreconBad"
                                                                name="kabelPreconBad" style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Fast Connector</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="fastConnector"
                                                                name="fastConnector" style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Patch Cord</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="patchCord" name="patchCord"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Terminal Box</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="terminalBox" name="terminalBox"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Remote Fiberhome</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="remoteFiberhome"
                                                                name="remoteFiberhome" style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Remote Extrem</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="remoteExtrem" name="remoteExtrem"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-dark align-items-center updateAssign"
                            id="updateAssign">Edit Data</button>
                        <button type="button" value="close" class="btn btn-sm btn-dark align-items-center"
                            data-bs-dismiss="modal">Batalkan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Modal Show Detail Tool --}}

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

        $(document).on('click', '#filAssignTim', function(e) {
            get_data_assignTim();
            stDate = $('.date-range').data('daterangepicker').startDate.format("DD-MMM-YYYY");
            enDate = $('.date-range').data('daterangepicker').endDate.format("DD-MMM-YYYY");
        })

        $('#filAssignTim').trigger("click");

        // $.ajax({
        //     url: "{{ route('getDataMTOris') }}",
        //     type: "get",
        //     dataType: "json",
        //     success: function(dtRes) {
        //         console.log(dtRes);
        //     }
        // })

        function get_data_assignTim() {
            var data_assignTim = $('#tabelAssignTim').DataTable({
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
                    url: "{{ route('getDataMTOris') }}",
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
                        data: 'tgl_ikr',
                        // width: '90'
                    },
                    {
                        data: 'no_wo'
                    },
                    {
                        data: 'wo_date_apk'
                    },
                    {
                        data: 'cust_id',
                        render: function (data, type, row) {
                            return `<a href="javascript:void(0);" data-id="${data}" id="detail-history" onclick="detailHistory(${data})" class="text-primary">${data}</a>`;

                        }
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
                        data: 'cluster'
                    },
                    {
                        data: 'branch'
                    },
                    {
                        data: 'slot_time_leader'
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
                    {
                        data: 'status_wo'
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }

        $(document).on('click', '#detail-assign', function(e) {

            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let assign_id = $(this).data('id');


            $.ajax({
                url: "{{ route('getDetailWOFtthMT') }}",
                type: "get",
                data: {
                    filAssignId: assign_id,
                    _token: _token
                },
                success: function(dtDis) {

                    function floatToTime(float) {
                        // Konversi float menjadi total menit
                        let totalMinutes = Math.floor(float * 60 * 24);
                        let hours = Math.floor(totalMinutes / 60);
                        let minutes = totalMinutes % 60;

                        // Format supaya jam dan menit memiliki dua digit
                        hours = hours < 10 ? '0' + hours : hours;
                        minutes = minutes < 10 ? '0' + minutes : minutes;

                        return `${hours}:${minutes}`;
                    }

                    // console.log(dtDis);
                    let checkinDate = new Date(dtDis.data.checkin_apk).toISOString().slice(0, 10);
                    let checkoutDate = new Date(dtDis.data.checkout_apk).toISOString().slice(0, 10);
                    let slotTimeLeader = floatToTime(dtDis.data.slot_time_leader);
                    // let timeValue = dtDis.data.slot_time_apk.replace('.', ':').slice(0, 5);
                    console.log(slotTimeLeader);

                    $('#detId').val(dtDis.data.id)
                    $('#noWoShow').val(dtDis.data.no_wo)
                    $('#statusWoShow').val(dtDis.data.status_wo).change()
                    $('#ticketNoShow').val(dtDis.data.no_ticket)
                    $('#woTypeShow').val(toTitleCase(dtDis.data.type_wo))
                    $('#jenisWoShow').val(dtDis.data.type_wo)
                    $('#WoDateShow').val(dtDis.data.wo_date_apk)
                    $('#custIdShow').val(dtDis.data.cust_id)
                    $('#custNameShow').val(toTitleCase(dtDis.data.nama_cust))
                    // $('#custPhoneShow').val(dtDis.data.cust_phone)

                    // $('#custMobileShow').val(dtDis.data.cust_mobile);
                    $('#custAddressShow').val(toTitleCase(dtDis.data.cust_address1));
                    // $('#ikrDateApkShow').val(dtDis.data.ikr_date);
                    $('#timeApkShow').val(dtDis.data.time);
                    $('#fatCodeShow').val(dtDis.data.kode_fat);
                    $('#portFatShow').val(dtDis.data.port_fat);
                    $('#remarksShow').val(toTitleCase(dtDis.data.type_maintenance));

                    $('#branchShow').val(dtDis.data.branch);
                    $('#tglProgressShow').val(dtDis.data.tgl_ikr);
                    $('#tglProgressStatusShow').val(dtDis.data.tgl_ikr);
                    $('#tglProgressAPKShow').val(dtDis.data.tgl_ikr);

                    $('#sesiShow').val(dtDis.data.sesi);
                    $('#slotTimeLeaderShow').val(slotTimeLeader);
                    $('#slotTimeAPKShow').val(dtDis.data.slot_time_apk);

                    $('#slotTimeLeaderStatusShow').val(slotTimeLeader);
                    // $('#slotTimeAPKStatusShow').val(timeValue);


                    $('#leaderShow').val(dtDis.data.leader);
                    $('#LeadCallsignShow').val(dtDis.data.leadcall_id);
                    $('#callsignTimidShow').val(dtDis.data.callsign_id);
                    // $('#teknisi1Show').val(toTitleCase(dtDis.data.teknisi1));
                    // $('#teknisi2Show').val(toTitleCase(dtDis.data.teknisi2));

                    $('#statusWo').val(dtDis.data.status_wo);
                    $('#statusWoApk').val(dtDis.data.status_apk);

                    $('#causeCode').val(dtDis.data.couse_code);
                    $('#rootCause').val(dtDis.data.root_couse);
                    $('#actionTaken').val(dtDis.data.action_taken);
                    $('#penagihanShow').val(dtDis.data.penagihan);

                    $('#actionTakenAPK').val(dtDis.data.action_taken);
                    $('#tglCheckinApk').val(checkinDate);
                    $('#tglCheckoutApk').val(checkoutDate);
                    $('#teknisi1Show').val(dtDis.data.teknisi1);
                    $('#merkStbIn').val(dtDis.data.stb_merk_in);
                    $('#merkStbOut').val(dtDis.data.stb_merk_out);
                    $('#merkOntOut').val(dtDis.data.ont_merk_out);
                    $('#snStbIn').val(dtDis.data.stb_sn_in);
                    $('#snStbOut').val(dtDis.data.stb_sn_out);
                    $('#kabelPrecon').val(dtDis.data.precon_out);
                    $('#kabelPreconBad').val(dtDis.data.bad_precon);


                    $('#showDetail').modal('show');

                }
            })
        })


    })
</script>
