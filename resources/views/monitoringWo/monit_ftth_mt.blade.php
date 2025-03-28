<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-1 px-5">
            {{-- <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-1 mb-3">
                        <div class="full-background" style="background: linear-gradient(to right, #112133, #21416d);">
                        </div>
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-1">Monitoring WO FTTH Maintenance</h3>
                            <p class="mb-2 font-weight-semibold">
                                PT. Mitra Sinergi Telematika.
                            </p>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-2">
                        <div class="card-header border-bottom pb-0 pt-0" style="background: linear-gradient(to right, #4e0808, #6d2121);">

                            {{-- <div class="row"> --}}
                                {{-- <div class="col-12"> --}}
                                    {{-- <div class="card card-background card-background-after-none align-items-start mt-0 mb-0"> --}}
                                        <div class="full-background" style="background: linear-gradient(to right, #112133, #21416d);">
                                        </div>
                                        <div class="text-start p-2 w-100">
                                            <h4 class="text-white mb-1">Monitoring WO FTTH Maintenance</h3>
                                            {{-- <p class="mb-1 font-weight-semibold">
                                                PT. Mitra Sinergi Telematika.
                                            </p> --}}

                                            {{-- <img src="../assets/img/3d-cube.png" alt="3d-cube"
                                                class="position-absolute top-0 end-1 w-25 max-width-200 mt-n6 d-sm-block d-none" /> --}}
                                        </div>
                                    {{-- </div> --}}
                                {{-- </div> --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                        </div>

                        <div class="card-body px-2 py-2">
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
                                </div>

                                <div class="col">
                                    <div class="form-group mb-1">
                                        <span class="text-xs">Area</span>
                                        <select class="form-control form-control-sm select2" type="text" id="filarea"
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

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Nama Leader</span>
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

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Status WO</span>
                                        <select class="form-control form-control-sm" type="text" id="filstatusWo"
                                            name="filstatusWo" style="border-color:#9ca0a7;">
                                            <option value="" selected>Pilih Status WO</option>
                                            <option value="REQUESTED">Requested</option>
                                            <option value="CHECKIN">Checkin</option>
                                            <option value="CHECKOUT">Checkout</option>
                                            <option value="DONE">Done</option>
                                            <option value="PENDING">Pending</option>
                                            <option value="CANCEL">Cancelled</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col">

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Group Area</span>
                                        <select class="form-control form-control-sm select2" id="filGroup" name="filGroup" style="border-color:#9ca0a7;">
                                            <option value="">Pilih Grup</option>
                                            <option value="Jakarta">Jakarta</option>
                                            <option value="Regional">Regional</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Callsign Tim</span>
                                        <select class="form-control form-control-sm" type="text" id="filcallsignTimid"
                                            name="filcallsignTimid" style="border-color:#9ca0a7;"
                                            placeholder="Isi Callsign Tim">
                                            <option value="">Pilih Callsign Tim</option>
                                            @if (isset($callTim))
                                                @foreach ($callTim as $cTim)
                                                    <option
                                                        value="{{ $cTim->callsign_tim_id . '|' . $cTim->callsign_tim }}">
                                                        {{ $cTim->callsign_tim }}
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                </div>

                                <div class="col">

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Cluster</span>
                                        <select class="form-control form-control-sm" type="text" id="filcluster"
                                            name="filcluster" style="border-color:#9ca0a7;">
                                            <option value="">Pilih Cluster</option>
                                            @if (isset($cluster))
                                                @foreach ($cluster as $cl)
                                                    <option value="{{ $cl->cluster }}">
                                                        {{ $cl->cluster }}
                                                @endforeach
                                            @endif
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
                                        <span class="text-xs">FAT Code</span>
                                        <input type="text" class="form-control form-control-sm" id="filfatCode"
                                            name="filfatCode" style="border-color:#9ca0a7;">
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Slot Time</span>
                                        <select class="form-control form-control-sm" type="text" id="filslotTime"
                                            name="filslotTime" style="border-color:#9ca0a7;" disabled>
                                            <option value="">Pilih SlotTime</option>
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

                                <hr>
                                <div class="row text-center mb-1">
                                    <div class="col">
                                        <button type="button"
                                            class="btn btn-sm btn-dark align-items-center filAssignTim mb-0"
                                            id="filAssignTim">Tampilkan</button>
                                        <button type="button" value="close"
                                            class="btn btn-sm btn-dark align-items-center mb-0"
                                            data-bs-dismiss="modal">Reset</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-2 col-sm-2">
                    <div class="card border shadow-lg mb-2">
                        <div class="card-body text-start p-2 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100 text-center">
                                        <p class="text-sm text-secondary mb-1">Total WO MT</p>
                                        <h4 class="mb-2 font-weight-bold" id="totTotal"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-2">
                    <div class="card border shadow-lg mb-2">
                        <div class="card-body text-start p-2 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100 text-center">
                                        <p class="text-secondary mb-1" style="font-size: 0.82rem;">Checkout/Done</p>
                                        <h4 class="mb-2 font-weight-bold" id="totDone"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-2">
                    <div class="card border shadow-lg mb-2">
                        <div class="card-body text-start p-2 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100 text-center">
                                        <p class="text-sm text-secondary mb-1">Pending</p>
                                        <h4 class="mb-2 font-weight-bold" id="totPending"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-2">
                    <div class="card border shadow-lg mb-2">
                        <div class="card-body text-start p-2 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100 text-center">
                                        <p class="text-sm text-secondary mb-1">Cancel</p>
                                        <h4 class="mb-2 font-weight-bold" id="totCancel"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-2">
                    <div class="card border shadow-lg mb-2">
                        <div class="card-body text-start p-2 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100 text-center">
                                        <p class="text-sm text-secondary mb-1">Checkin</p>
                                        <h4 class="mb-2 font-weight-bold" id="totCheckin"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-2">
                    <div class="card border shadow-lg mb-2">
                        <div class="card-body text-start p-2 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100 text-center">
                                        <p class="text-sm text-secondary mb-1">Requested</p>
                                        <h4 class="mb-2 font-weight-bold" id="totRequested"></h4>
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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Data FTTH Maintenance</span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
                                    <a href="#" id="exportButton">
                                        <button type="button"
                                            class="btn btn-sm btn-icon d-flex align-items-center me-2"
                                            style="background-color: #1abd64; border-color: #1abd64; color: white; padding: 5px 12px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 50 50" style="margin-right: 8px;">
                                                <path fill="white" d="M 28.875 0 C 28.855469 0.0078125 28.832031 0.0195313 28.8125 0.03125 L 0.8125 5.34375 C 0.335938 5.433594 -0.0078125 5.855469 0 6.34375 L 0 43.65625 C -0.0078125 44.144531 0.335938 44.566406 0.8125 44.65625 L 28.8125 49.96875 C 29.101563 50.023438 29.402344 49.949219 29.632813 49.761719 C 29.859375 49.574219 29.996094 49.296875 30 49 L 30 44 L 47 44 C 48.09375 44 49 43.09375 49 42 L 49 8 C 49 6.90625 48.09375 6 47 6 L 30 6 L 30 1 C 30.003906 0.710938 29.878906 0.4375 29.664063 0.246094 C 29.449219 0.0546875 29.160156 -0.0351563 28.875 0 Z M 28 2.1875 L 28 6.53125 C 27.867188 6.808594 27.867188 7.128906 28 7.40625 L 28 42.8125 C 27.972656 42.945313 27.972656 43.085938 28 43.21875 L 28 47.8125 L 2 42.84375 L 2 7.15625 Z M 30 8 L 47 8 L 47 42 L 30 42 L 30 37 L 34 37 L 34 35 L 30 35 L 30 29 L 34 29 L 34 27 L 30 27 L 30 22 L 34 22 L 34 20 L 30 20 L 30 15 L 34 15 L 34 13 L 30 13 Z M 36 13 L 36 15 L 44 15 L 44 13 Z M 6.6875 15.6875 L 12.15625 25.03125 L 6.1875 34.375 L 11.1875 34.375 L 14.4375 28.34375 C 14.664063 27.761719 14.8125 27.316406 14.875 27.03125 L 14.90625 27.03125 C 15.035156 27.640625 15.160156 28.054688 15.28125 28.28125 L 18.53125 34.375 L 23.5 34.375 L 17.75 24.9375 L 23.34375 15.6875 L 18.65625 15.6875 L 15.6875 21.21875 C 15.402344 21.941406 15.199219 22.511719 15.09375 22.875 L 15.0625 22.875 C 14.898438 22.265625 14.710938 21.722656 14.5 21.28125 L 11.8125 15.6875 Z M 36 20 L 36 22 L 44 22 L 44 20 Z M 36 27 L 36 29 L 44 29 L 44 27 Z M 36 35 L 36 37 L 44 37 L 44 35 Z"></path>
                                            </svg>
                                            <span class="btn-inner--text">Export Report</span>
                                        </button>
                                    </a>

                                    <a href="{{ route('importDataFtthMtApk') }}" id="importApkButton">
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
                                            <span class="btn-inner--text">Import Data WO APK</span>
                                        </button>
                                    </a>
                                    <a href="{{ route('importDataMaterial') }}" id="importApkMaterialButton">
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
                                            <span class="btn-inner--text">Import Data Material APK</span>
                                        </button>
                                    </a>
                                    <a href="{{ route('importDataKonfCst') }}" id="importKonfCstButton">
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
                                            <span class="btn-inner--text">Import Data Konfirmasi Cst</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">
                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="tabelAssignTim" style="font-size: 12px; border-color:#9ca0a7;">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool" style="font-weight: bold">
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
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 4</th>
                                            <th class="text-center text-xs font-weight-semibold">Status APK</th>
                                            <th class="text-center text-xs font-weight-semibold">Status WO</th>
                                            <th class="text-center text-xs font-weight-semibold">RootCause Penagihan</th>
                                            <th class="text-center text-xs font-weight-semibold">Status Check</th>

                                            <th class="text-center text-xs font-weight-semibold">#</th>

                                        </tr>
                                    </thead>
                                    <tbody id="bodyTool" style="font-weight: bold">

                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="border-top py-3 px-3 d-flex align-items-center">

                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-sm-6 mt-3 mb-3">
                    <h6>5 Cause Code Terbanyak</h6>
                    <div class="table-responsive p-0">
                        <table id="summaryAssignTeam" class="table table-striped table-sm table-bordered align-items-center mb-0" style="font-size: 0.85rem;">
                            <thead class="bg-gray-600">
                                <tr id="headStatusProgresWo">
                                    <th class="text-white text-sm font-weight-semibold p-1">No</th>
                                    <th class="text-white text-sm font-weight-semibold p-1">Cause Code</th>
                                    <th class="text-white text-sm font-weight-semibold p-1">Total Cause Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($mostCauseCode))
                                    @foreach ($mostCauseCode as $causeCode)
                                    <tr>
                                        <td class="text-sm p-1">{{ $loop->iteration }}</td>
                                        <td class="text-sm p-1">{{ $causeCode->couse_code }}</td>
                                        <td class="text-sm p-1">{{ $causeCode->qtyCauseCode }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-sm-6 mt-3 mb-3">
                    <h6>5 Root Cause Terbanyak</h6>
                    <div class="table-responsive p-0">
                        <table id="summaryAssignTeam" class="table table-striped table-bordered table-sm align-items-center mb-0" style="font-size: 0.85rem;">
                            <thead class="bg-gray-600">
                                <tr id="headStatusProgresWo">
                                    <th class="text-white text-sm font-weight-semibold p-1">No</th>
                                    <th class="text-white text-sm font-weight-semibold p-1">Root Cause</th>
                                    <th class="text-white text-sm font-weight-semibold p-1">Total Root Cause</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($mostRootCause))
                                    @foreach ($mostRootCause as $root_cause)
                                    <tr>
                                        <td class="text-sm p-1">{{ $loop->iteration }}</td>
                                        <td class="text-sm p-1">{{ $root_cause->root_couse }}</td>
                                        <td class="text-sm p-1">{{ $root_cause->qtyRootCause }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="row">
                <div class="col-sm-12 mt-3 mb-3">
                    <h6>5 Action Taken Terbanyak</h6>
                    <div class="table-responsive p-0">
                        <table id="summaryAssignTeam" class="table table-striped table-bordered table-sm align-items-center mb-0" style="font-size: 0.85rem;">
                            <thead class="bg-gray-600">
                                <tr id="headStatusProgresWo">
                                    <th class="text-white text-sm font-weight-semibold p-1">No</th>
                                    <th class="text-white text-sm font-weight-semibold p-1">Action Taken</th>
                                    <th class="text-white text-sm font-weight-semibold p-1">Total Action Taken</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($mostActionTaken))
                                    @foreach ($mostActionTaken as $actionTaken)
                                    <tr>
                                        <td class="text-sm p-1">{{ $loop->iteration }}</td>
                                        <td class="text-sm p-1">{{ $actionTaken->action_taken }}</td>
                                        <td class="text-sm p-1">{{ $actionTaken->qtyActionTaken }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}

            {{-- <x-app.footer /> --}}
        </div>

        {{-- Modal Show Detail Data Tool --}}
        <div class="modal fade" id="showDetail" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleModalMT">Detail Progress WO FTTH Maintenance</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="{{ route('updateSignTim') }}" method="post" enctype="multipart/form-data"> --}}
                        {{-- <form action="{{ route('updateFtthMt') }}" method="post" enctype="multipart/form-data"> --}}
                        <form class="updateFtthMt" method="get" enctype="multipart/form-data" id="formDetailWoMT">

                            {{-- @method('PUT') --}}
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
                                        <!-- Jangan Dihapus -->
                                        {{-- <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                                href="#StatusMaterial" role="tab" aria-controls="StatusMaterial"
                                                aria-selected="false">Status Material
                                            </a>
                                        </li> --}}

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
                                                            style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="col-4 form-group mb-1">
                                                        <span class="text-xs">Ticket No</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                            id="ticketNoShow" name="ticketNoShow"
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
                                                            <span class="text-xs">WO Type APK</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="woTypeShow" name="woTypeShow"
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">WO Type</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="jenisWoShow" name="jenisWoShow"
                                                                style="border-color:#9ca0a7;">
                                                                {{-- <option value="FTTH New Installation">FTTH New Installation</option> --}}
                                                                <option value="FTTH Maintenance">FTTH Maintenance</option>
                                                                <option value="Additional">Additional</option>
                                                                <option value="Dismantle">Dismantle</option>
                                                                {{-- <option value="FTTX/B New Installation">FTTX/B New Installation</option> --}}
                                                                {{-- <option value="FTTX/B Maintenance">FTTX/B Maintenance</option> --}}
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">WO Date</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="WoDateShow" name="WoDateShow"
                                                        style="border-color:#9ca0a7;" readonly>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Address</span>
                                                    <textarea class="form-control form-control-sm" type="text" id="custAddressShow" name="custAddressShow"
                                                        style="border-color:#9ca0a7;" readonly></textarea>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">FAT Code</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="fatCodeShow" name="fatCodeShow"
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                        <div class="col-4 form-group mb-1">
                                                            <span class="text-xs">Port FAT</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="portFatShow" name="portFatShow"
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Remarks</span>
                                                    <textarea class="form-control form-control-sm" type="text" id="remarkStatus" name="remarkStatus"
                                                        style="border-color:#9ca0a7;" readonly></textarea>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Branch</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="branchShow" name="branchShow"
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Kotamadya</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="kotamadyaShow" name="kotamadyaShow"
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Area/Cluster</span>
                                                            <input type="text" class="form-control form-control-sm"
                                                                type="text" id="cluster" name="cluster"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Kotamadya Penagihan</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="kotaPenagihanShow" name="kotaPenagihanShow"
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Site Penagihan</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                value="" id="sitePenagihan"
                                                                name="sitePenagihan" style="border-color:#9ca0a7;">
                                                                <option value=""></option>
                                                                <option value="Retail">Retail</option>
                                                                <option value="Apartemen">Apartemen</option>
                                                                <option value="Underground">Underground</option>
                                                                <option value="Retail / Underground Kalau Perumahan Grand Cibubur">Retail / Underground Kalau Perumahan Grand Cibubur</option>
                                                                <option value="Retail / Underground Kalau Perumahan Anabuki">Retail / Underground Kalau Perumahan Anabuki</option>
                                                                <option value="Retail / Underground Kalau Perumahan Esense Park">Retail / Underground Kalau Perumahan Esense Park</option>
                                                            </select>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Sesi</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="sesiDetShow" name="sesiDetShow"
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
                                                            <span class="text-xs">Callsign Tim</span>
                                                            <select class="form-control form-control-sm" id="callsignTimidShow" name="callsignTimidShow" style="border-color:#9ca0a7;">
                                                                <option value="">Pilih Callsign Tim</option>
                                                            </select>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Lead Callsign | Leader</span>
                                                            <select class="form-control form-control-sm" id="LeadCallsignShow" name="LeadCallsignShow" style="border-color:#9ca0a7;">
                                                                <option value="">Pilih Lead Callsign</option>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Teknisi 1</span>
                                                    <select class="form-control form-control-sm" type="text"
                                                             id="teknisi1Show"
                                                            name="teknisi1Show"
                                                            style="border-color:#9ca0a7;">

                                                    </select>
                                                </div>
                                                
                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Teknisi 2</span>
                                                    <select class="form-control form-control-sm" type="text"
                                                             id="teknisi2Show"
                                                            name="teknisi2Show"
                                                            style="border-color:#9ca0a7;">
                                                    </select>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Teknisi 3</span>
                                                    <select class="form-control form-control-sm" type="text"
                                                             id="teknisi3Show"
                                                            name="teknisi3Show"
                                                            style="border-color:#9ca0a7;">
                                                    </select>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Teknisi 4</span>
                                                    <select class="form-control form-control-sm" type="text" id="teknisi4Show"
                                                        name="teknisi4Show" style="border-color:#9ca0a7;">
                                                    </select>
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

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Checkin Aplikasi</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="tglCheckinApk"
                                                                name="tglCheckinApk"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Checkout Aplikasi</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="tglCheckoutApk"
                                                                name="tglCheckoutApk"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Status WO Aplikasi</span>
                                                        <select class="form-control form-control-sm" type="text"
                                                            id="statusWoApk" name="statusWoApk"
                                                            style="border-color:#9ca0a7;">
                                                                <option value="">Pilih Status WO</option>
                                                                <option value="REQUESTED">Requested</option>
                                                                <option value="CHECKIN">Checkin</option>
                                                                <option value="CHECKOUT">Checkout</option>
                                                                <option value="DONE">Done</option>
                                                                <option value="PENDING">Pending</option>
                                                                <option value="CANCELLED">Cancelled</option>
                                                        </select>
                                                    </div>

                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Status WO</span>
                                                        <span class="text-danger">*</span>
                                                        <select class="form-control form-control-sm" type="text"
                                                            id="statusWo" name="statusWo"
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
                                                        {{-- <div class="col form-group mb-1">
                                                            <span class="text-xs">Cause Code</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="causeCodeOld"
                                                                name="causeCodeOld" style="border-color:#9ca0a7;">
                                                                <option value="" disabled selected>--Pilih Cause Code--</option>

                                                            </select>
                                                        </div> --}}

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Cause Code</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="causeCode" list="causeCodeList" autocomplete="off"
                                                                name="causeCode" style="border-color:#9ca0a7;">

                                                            <datalist id="causeCodeList"
                                                                name="causeCodeList">
                                                                <option value="" selected>--Pilih Cause Code--</option>

                                                            </datalist>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Root Cause</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="rootCause" list="rootCauseList" autocomplete="off"
                                                                name="rootCause" style="border-color:#9ca0a7;">

                                                            <datalist id="rootCauseList"
                                                                name="rootCauseList">
                                                                <option value="" selected>--Pilih Root Cause--</option>
                                                            </datalist>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Action Taken</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="actionTaken" list="actionTakenList" autocomplete="off"
                                                                name="actionTaken" style="border-color:#9ca0a7;">

                                                            <datalist id="actionTakenList"name="actionTakenList">
                                                                <option value="" selected>--Pilih Action Taken--</option>
                                                            </datalist>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">                                                        
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Rootcause Penagihan</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="penagihanShow" list="penagihanShowList" autocomplete="off"
                                                                name="penagihanShow" style="border-color:#9ca0a7;">
                                                            <datalist id="penagihanShowList" name="penagihanShowList">
                                                                <option value="" selected>--Pilih Penagihan--</option>
                                                            </datalist>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Report Teknisi</span>
                                                    <span class="text-danger">*</span>
                                                    <textarea class="form-control form-control-sm" type="text" id="reportTeknisi" name="reportTeknisi"
                                                        style="border-color:#9ca0a7;"></textarea>
                                                </div>

                                            </div>

                                            <div class="col">

                                                <div class="form-group mb-1">
                                                    <div class="row">

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Status Checkin</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="statusCheckin"
                                                                name="statusCheckin" style="border-color:#9ca0a7;" readonly>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Menit</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="statusCheckinMenit"
                                                                name="statusCheckinMenit" style="border-color:#9ca0a7;" readonly>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Waktu Instalasi</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="waktuInstallation"
                                                                name="waktuInstallation" style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                    </div>
                                                </div>                                               

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Status Visit</span>
                                                            <span class="text-danger">*</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="statusVisit" name="statusVisit" style="border-color:#9ca0a7;">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="Team Visit">Team Visit</option>
                                                                <option value="No VIsit">No Visit</option>
                                                            </select>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Action Status</span>
                                                            <span class="text-danger">*</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="actionStatus" name="actionStatus"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="Sudah dikerjakan MST">Sudah dikerjakan MST</option>
                                                                <option value="Sign Ulang">Sign Ulang</option>
                                                                <option value="Tunggu Konfirmasi">Tunggu Konfirmasi</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Precon Bad</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="preconBad" name="preconBad"
                                                                style="border-color:#9ca0a7;">                                                                
                                                        </div>

                                                        {{-- <div class="col form-group mb-1">
                                                            <span class="text-xs">Alasan Tidak Ganti Precon</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="alasanTidakGantiPrecon" name="alasanTidakGantiPrecon"
                                                                style="border-color:#9ca0a7;">
                                                        </div> --}}
                                                        
                                                    </div>
                                                </div>                                                

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Tanggal Reschedule</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="date"
                                                                id="tglReschedule" name="tglReschedule"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Jam Reschedule</span>
                                                            <span class="text-danger">*</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="tglJamReschedule"
                                                                name="tglJamReschedule" style="border-color:#9ca0a7;">
                                                                <option value="" disabled selected>--Pilih Slot Time--</option>
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
                                                            <span class="text-xs">Permintaan Rsch.</span>
                                                            <span class="text-danger">*</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                    id="permintaanReschedule" name="permintaanReschedule" 
                                                                    style="border-color:#9ca0a7;">
                                                                    <option value="">-- Pilih --</option>
                                                                    <option value="Customer">Customer</option>
                                                                    <option value="Teknisi">Teknisi</option>
                                                                    <option value="Leader">Leader</option>
                                                                    <option value="Dispatch">Dispatch</option>
                                                            </select>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Respon Cst</span>
                                                            <span class="text-danger">*</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="responKonfCst" name="responKonfCst" 
                                                                style="border-color:#9ca0a7;">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="Respon">Respon</option>
                                                                <option value="Tidak Respon">Tidak Respon</option>
                                                            </select>
                                                        </div>

                                                        
                                                    </div>
                                                    
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        

                                                        

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Jawaban Cst</span>
                                                            <span class="text-danger">*</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="jwbKonfCst" name="jwbKonfCst" 
                                                                style="border-color:#9ca0a7;">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="Setuju">Setuju</option>
                                                                <option value="Tidak Setuju">Tidak Setuju</option>
                                                                <option value="Tidak Respon">Tidak Respon</option>
                                                            </select>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Kondisi Cuaca</span>
                                                            <span class="text-danger">*</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="weatherShow" name="weatherShow"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="" disabled selected>--Pilih Kondisi Cuaca--</option>
                                                                <option value="Cerah">Cerah</option>
                                                                <option value="Hujan">Hujan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">PIC Dispatch</span>
                                                            <span class="text-danger">*</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="picDispatch" name="picDispatch"
                                                                style="border-color:#9ca0a7;">
                                                                <option value=""></option>
                                                            </select>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Telp Dispatch</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="telpDispatch" name="telpDispatch" 
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                

                                                {{-- <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Alasan Pending</span>
                                                            <textarea class="form-control form-control-sm" type="text"
                                                                id="alasanPending" name="alasan_pending"
                                                                style="border-color:#9ca0a7;"></textarea>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Alasan Cancel</span>
                                                            <textarea class="form-control form-control-sm" type="text"
                                                                id="alasanCancel" name="alasan_cancel"
                                                                style="border-color:#9ca0a7;"></textarea>
                                                        </div>
                                                        
                                                    </div>
                                                </div> --}}

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Detail Alasan</span>
                                                    <span class="text-danger">*</span>
                                                    <textarea class="form-control form-control-sm" type="text" id="detailAlasan" name="detailAlasan"
                                                        style="border-color:#9ca0a7;"></textarea>
                                                </div>

                                            </div>

                                            <div class="col">

                                                {{-- <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Start IKR (WA)</span>
                                                            <input class="form-control form-control-sm" type="time"
                                                                value="{{ date('H:i') }}" id="statusStartIkrWa" name="statusStartIkrWa"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">End IKR (WA)</span>
                                                            <input class="form-control form-control-sm" type="time"
                                                                value="{{ date('H:i') }}" id="statusEndIkrWa" name="statusEndIkrWa" 
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Validasi Start</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="time"
                                                                value="{{ date('H:i') }}" id="validasiStart"
                                                                name="validasiStart" style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Validasi End</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="time"
                                                                value="{{ date('H:i') }}" id="validasiEnd"
                                                                name="validasiEnd" style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Foto Rumah</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="fotoRumah" name="fotoRumah" style="border-color:#9ca0a7;">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="Sesuai">Sesuai</option>
                                                                <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                <option value="Tidak Ada">Tidak Ada</option>
                                                            </select>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Foto Selfie</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="fotoSelfie" name="fotoSelfie" style="border-color:#9ca0a7;">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="Ada">Ada</option>
                                                                <option value="Tidak Ada">Tidak Ada</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Regist Start</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="time"
                                                                value="{{ date('H:i') }}" id="registStart"
                                                                name="registStart" style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Regist End</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="time"
                                                                value="{{ date('H:i') }}" id="registEnd"
                                                                name="registEnd" style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Kode OTP</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="kodeOtp" name="kodeOtp" style="border-color:#9ca0a7;">                                                                
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            {{-- <span class="text-xs">Kondisi FAT</span>
                                                            <span class="text-danger">*</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="kondisiFat" name="kondisiFat" style="border-color:#9ca0a7;">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="FAT Full Marker">FAT Full Marker</option>
                                                                <option value="FAT Sebagian Tidak Bermarker">FAT Sebagian Tidak Bermarker</option>
                                                            </select> --}}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Cek Telebot</span>
                                                            <span class="text-danger">*</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="cekTelebot" name="cekTelebot"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="Cek Telebot">Cek Telebot</option>
                                                                <option value="Tidak Cek Telebot">Tidak Cek Telebot</option>
                                                                <option value="Tidak Perlu Cek Telebot">Tidak Perlu Cek Telebot</option>
                                                            </select>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Hasil Cek</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="hasilCekTelebot" name="hasilCekTelebot" 
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">MTTR All</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="mttrAll" name="mttrAll"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">MTTR Pending</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="mttrPending" name="mttrPending" 
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">MTTR Progress</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="mttrProgress" name="mttrProgress"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">MTTR Technician</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="mttrTeknisi" name="mttrTeknisi" 
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">SLA Over</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="slaOver" name="slaOver" 
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>                                                

                                                <div class="form-group mb-1">
                                                    <div class="row">

                                                        <div class="col form-group  mb-1">
                                                            <span class="text-xs">Penggunaan Material</span>
                                                            <div class="input-group input-group-sm">
                                                                <input id="statusMaterial" name="statusMaterial" style="border-color:#9ca0a7;" 
                                                                    type="text" class="form-control form-control-sm" readonly>
                                                                <button class="btn btn-sm btn-outline-secondary mb-0" type="button" 
                                                                id="detail-materialStatus">...</button>
                                                              </div>
                                                            <input type="hidden" id="materialOut" name="materialOut"/>
                                                            <input type="hidden" id="materialIn" name="materialIn"/>

                                                        </div>
                                                        

                                                        {{-- <div class="col form-group mb-1">
                                                            <span class="text-xs">Penggunaan Material</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                value="" id="statusMaterial"
                                                                name="statusMaterial" style="border-color:#9ca0a7;" disabled>
                                                                <option value="Ada">Ada</option>
                                                                <option value="Tidak Ada">Tidak Ada</option>
                                                            </select>

                                                        </div> --}}

                                                        
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group form-check">
                                                            <input type="hidden" name="is_checked" id="is_checked" value="0"> <!-- Default jika tidak dicentang -->
                                                            <div class="form-check">                                                                
                                                                <input class="form-check-input" type="checkbox" name="isChecked" id="isChecked" value="1">
                                                                <label class="form-check-label" for="isChecked" id="picName" name="picName">
                                                                    Sudah Dicek (PIC. {{Auth::user()->name}} )
                                                                </label>
                                                            </div>
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

                                        <input type="hidden" name="id_material" id="id_material">

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
                                                                id="snOntOut" name="snOntOut"
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
                                                            <span class="text-xs">Remote Terpasang</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="remoteOut"
                                                                name="remoteOut" style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Remote Terambil</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="remoteTerambil" name="remoteTerambil"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

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
                                                            <span class="text-xs">PVC Pipe</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="pvcPipe" name="pvcPipe"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Socket Pipe</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="socketPipe" name="socketPipe"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Kabel UTP</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="kabelUtp" name="kabelUtp"
                                                                style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">RJ-45</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="rj45" name="rj45"
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
                            id="updateAssign">Simpan</button>
                        <button type="button" value="close" class="btn btn-sm btn-dark align-items-center"
                            data-bs-dismiss="modal">Kembali</button>
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
                                        <th scope="col">Cause Code</th>
                                        <th scope="col">Root Cause</th>
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

        @include('monitoringWo.modal-mt.detail-material')
        @include('monitoringWo.modal-mt.edit-material')

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
        var dtCouseCode = {!! $dtCouseCode !!};
        var dtRootCouse = {!! $dtRootCouse !!};
        var dtActionTaken = {!! $dtActionTaken !!};
        var dtPenagihan = {!! $dtPenagihan !!};
        var dtPenagihanAll = {!! $dtPenagihanAll !!};
        var dtDispatch = {!! $dtDispatch !!}

        akses = $('#akses').val();
        var callTim;
        // get_data_assignTim()

        function toTitleCase(str) {
            return str.replace(
                /\w\S*/g,
                text => text.charAt(0).toUpperCase() + text.substring(1).toLowerCase()
            );
        }

        $('#causeCode').find('option').remove();
        $('#rootCause').find('option').remove();
        $('#actionTaken').find('option').remove();
        $('#penagihanShow').find('option').remove();

        $('#causeCode').append(`
            <option value="" disabled selected>--Pilih Cause Code--</option>`
        );
        $('#rootCause').append(`
            <option value="" disabled selected>--Pilih Root Cause--</option>`
        );
        $('#actionTaken').append(`
            <option value="" disabled selected>--Pilih Action Taken--</option>`
        );
        $('#penagihanShow').append(`
            <option value="" disabled selected>--Pilih Penagihan--</option>`
        );

        $.each(dtCouseCode, function(k, cc) {
            $('#causeCode').append(
                `<option value="${cc.couse_code}">${cc.couse_code}</option>`
            )
        })
        $.each(dtRootCouse, function(k, cc) {
            $('#rootCause').append(
                `<option value="${cc.root_couse}">${cc.root_couse}</option>`
            )
        })
        $.each(dtActionTaken, function(k, cc) {
            $('#actionTaken').append(
                `<option value="${cc.action_taken}">${cc.action_taken}</option>`
            )
        })
        $.each(dtPenagihan, function(k, cc) {
            $('#penagihanShow').append(
                `<option value="${cc.rootcouse_penagihan}">${cc.rootcouse_penagihan}</option>`
            )
        })

        $(document).on('change', '#tglProgressAPKShow', function(e) {
            tgl = $('#tglProgressAPKShow').val();
            jm = $('#slotTimeAPKStatusShow').val();
            status="";

            tglJmCheckin = new Date($('#tglCheckinApk').val());
            tglJmCheckOut = new Date($('#tglCheckoutApk').val());
            tglJmSlotTime = new Date(tgl.concat(" ", jm));

            const timeDistance = (date1, date2) => {
                let distance = Math.abs(date1 - date2);
                const hours = Math.floor(distance / 3600000);
                distance -= hours * 3600000;
                const minutes = Math.floor(distance / 60000);
                distance -= minutes * 60000;
                const seconds = Math.floor(distance / 1000);
                return `${hours}:${('0' + minutes).slice(-2)}:${('0' + seconds).slice(-2)}`;
            };

            if(!isNaN(tglJmCheckin)) {
                stat=(tglJmCheckin-tglJmSlotTime)/60000;

                if(stat <= -1) {
                    status="On Time"
                } else if(stat>0) {
                    status="Terlambat"
                }

            } else {
                stat = 0;
            }            

            if(!isNaN(tglJmCheckOut) && !isNaN(tglJmCheckin)) {
                wktInstall = timeDistance(tglJmCheckOut, tglJmCheckin);
            } else {
                wktInstall = "0"
            }
            
            $('#statusCheckin').val(status);
            $('#statusCheckinMenit').val(stat.toFixed(0));
            $('#waktuInstallation').val(wktInstall);

        })

        $(document).on('change', '#tglCheckinApk', function(e) {
            $('#tglProgressAPKShow').trigger('change');
        })

        $('.date-range').daterangepicker({
            startDate: moment(),
            endDate: moment(),
        });        

        $(document).on('click', '#filAssignTim', function(e) {

            stDate = $('.date-range').data('daterangepicker').startDate.format("DD-MM-YYYY");
            enDate = $('.date-range').data('daterangepicker').endDate.format("DD-MM-YYYY");

            get_data_assignTim();
            get_summary();

            //link inport apk default
            let newLink = "{{ route('importDataFtthMtApk') }}"      
            let newLinkMaterial = "{{ route('importDataMaterial') }}"      
            let newLinkKonfCst = "{{ route('importDataKonfCst') }}"

            let params = {
                filTgl: $('#filtglProgress').val(),
                areaFill: $('#filarea').val(),
                areagroup: $('#filGroup').val()
            };

            let queryString = Object.keys(params)
                .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(params[key]))
                .join('&');
            
            // let fullUrl = newLinkKonfCst + '?' + queryString;

            document.getElementById('importApkButton').href = newLink + '?' + queryString
            document.getElementById('importApkMaterialButton').href = newLinkMaterial + '?' + queryString
            document.getElementById('importKonfCstButton').href = newLinkKonfCst + '?' + queryString
                        
            //otomati ganti link jika ada filter area / group area
            // if($('#filarea').val() != ""){
            //     area = $('#filarea').val();
            //     newLink = "{{ route('importDataFtthMtApk', 'areaFill=areagroup=') }}"
            //     newLink = newLink.replace('areaFill=', 'areaFill='+area+'&');

            //     newLinkMaterial = "{{ route('importDataMaterial', 'areaFill=areagroup=') }}"  
            //     newLinkMaterial = newLinkMaterial.replace('areaFill=', 'areaFill='+area+'&');

            //     newLinkKonfCst = "{{ route('importDataKonfCst', 'areaFill=areagroup=') }}"
            //     newLinkKonfCst = newLinkKonfCst.replace('areaFill=', 'areaFill='+area+'&');

            //     document.getElementById('importApkButton').href = newLink
            //     document.getElementById('importApkMaterialButton').href = newLinkMaterial
            //     document.getElementById('importKonfCstButton').href = newLinkKonfCst
            // }
            // if($('#filGroup').val() != ""){
            //     area = $('#filGroup').val();
            //     newLink = "{{ route('importDataFtthMtApk', 'areaFill=areagroup=') }}"
            //     newLink = newLink.replace('areagroup=', '&areagroup='+area);

            //     newLinkMaterial = "{{ route('importDataMaterial', 'areaFill=areagroup=') }}"
            //     newLinkMaterial = newLinkMaterial.replace('areagroup=', '&areagroup='+area);

            //     newLinkKonfCst = "{{ route('importDataKonfCst', 'areaFill=areagroup=') }}"
            //     newLinkKonfCst = newLinkKonfCst.replace('areagroup=', '&areagroup='+area);

            //     document.getElementById('importApkButton').href = newLink
            //     document.getElementById('importApkMaterialButton').href = newLinkMaterial
            //     document.getElementById('importKonfCstButton').href = newLinkKonfCst
            // }

            
        })

        $('#filAssignTim').trigger("click");

        $(document).on('change', '#filarea', function() {
            $('#filGroup').val('');
        })

        $(document).on('change', '#filGroup', function() {
            $('#filarea').val('');
        })

        $(document).on('change','#statusWo', function(e) {
            // console.log($(this).val());
            $('#causeCode').val('');
            $('#rootCause').val('');
            $('#actionTaken').val('');
            $('#penagihanShow').val('');

            $('#causeCodeList').find('option').remove();
            $('#causeCodeList').append(`
                <option value="" disabled selected>--Pilih Cause Code--</option>`
            );

            filCouseCode = dtCouseCode.filter(k => k.status_wo === $(this).val());

            $.each(filCouseCode, function(k, cc) {
                // $('#causeCodeOld').append(
                //     `<option value="${cc.couse_code}">${cc.couse_code}</option>`
                // )
                $('#causeCodeList').append(
                    `<option value="${cc.couse_code}">${cc.couse_code}</option>`
                )
            })

            console.log('statusWo : , ', $('#statusWo').val() )
            if ($('#statusWo').val() === "Done") {
                if($('#woTypeShow').val().toUpperCase() === "REMOVE DEVICE") {
                    $('#jenisWoShow').val("Dismantle"); //1
                } else if($('#woTypeShow').val().toUpperCase() === "ADD DEVICE" || $('#woTypeShow').val().toUpperCase() === "PENDING DEVICE") {
                    $('#jenisWoShow').val("Additional"); //1
                }                
            } else {
                $('#jenisWoShow').val("FTTH Maintenance"); //1
            }
        })

        function isiCousecode() {
            $('#causeCodeList').find('option').remove();
            $('#causeCodeList').append(`
                <option value="" disabled selected>--Pilih Cause Code--</option>`
            );

            filCouseCode = dtCouseCode.filter(k => k.status_wo === $('#statusWo').val());

            $.each(filCouseCode, function(k, cc) {
                // $('#causeCodeOld').append(
                //     `<option value="${cc.couse_code}">${cc.couse_code}</option>`
                // )
                $('#causeCodeList').append(
                    `<option value="${cc.couse_code}">${cc.couse_code}</option>`
                )
            })            
        }

        function isiDispatch() {
            $('#picDispatch').find('option').remove();
            $('#picDispatch').append(`
                <option value="">--Pilih--</option>`
            );

            $.each(dtDispatch, function(k,cc) {
                $('#picDispatch').append(
                    `<option value="${cc.nama_dispatch}">${cc.nama_dispatch}</option>`
                )
            })
        }

        $(document).on('change', '#picDispatch', function(e) {
            filDispatch = dtDispatch.filter(k => k.nama_dispatch === $(this).val());
            
            $('#telpDispatch').val(filDispatch[0].telp_dispatch);       
        })

        $(document).on('change','#causeCode', function(e) {
            e.preventDefault();
            // alert('status change');
            $('#rootCause').val('');
            $('#actionTaken').val('');
            $('#penagihanShow').val('');

            $('#rootCauseList').find('option').remove();
            $('#rootCauseList').append(`
                <option value="" selected>--Pilih Root Cause--</option>`
            );

            filRootCouse = dtRootCouse.filter(k => k.couse_code === $(this).val());

            $.each(filRootCouse, function(k, cc) {                
                $('#rootCauseList').append(
                    `<option value="${cc.root_couse}">${cc.root_couse}</option>`
                )

                if(filRootCouse.length == 1) {
                    $('#rootCause').val(cc.root_couse)
                    $('#rootCause').trigger('change')
                }
            })
        })

        $(document).on('change','#rootCause', function(e) {
            // alert('status change');
            // $('#rootCause').val('');
            $('#actionTaken').val('');
            $('#penagihanShow').val('');

            $('#actionTakenList').find('option').remove();
            $('#actionTakenList').append(`
                <option value="" selected>--Pilih Action Taken--</option>`
            );

            filActionTaken = dtActionTaken.filter(k => k.root_couse === $(this).val());

            $.each(filActionTaken, function(k, cc) {
                $('#actionTakenList').append(
                    `<option value="${cc.action_taken}">${cc.action_taken}</option>`
                )

                if(filActionTaken.length == 1) {
                    $('#actionTaken').val(cc.action_taken)
                    $('#actionTaken').trigger('change')
                }
            })

        })

        $(document).on('change','#actionTaken', function(e) {
            // alert('status change');
            // $('#rootCause').val('');
            // $('#actionTaken').val('');
            // $('#penagihanShow').val('');

            $('#penagihanShowList').find('option').remove();
            $('#penagihanShowList').append(`
                <option value="">--Pilih Penagihan--</option>`
            );

            filPenagihan = dtPenagihan.filter(k => k.status_wo === $('#statusWo').val() && k.couse_code === $('#causeCode').val() && k.root_couse === $('#rootCause').val() && k.action_taken === $('#actionTaken').val() );
            console.log('statusWo : ', $('#statusWo').val())
            console.log('causeCode : ', $('#causeCode').val())
            console.log('rootCause : ', $('#rootCause').val())
            console.log('actionTaken : ', $('#actionTaken').val())

            if(filPenagihan.length == 0) {
                filPenagihan = dtPenagihanAll.filter(k => k.status_wo === $('#statusWo').val() );
            }
            console.log('filPenagihan : ', filPenagihan);

            $.each(filPenagihan, function(k, cc) {
                $('#penagihanShowList').append(
                    `<option value="${cc.rootcouse_penagihan}">${cc.rootcouse_penagihan}</option>`
                )

                if(filPenagihan.length === 1) {
                    $('#penagihanShow').val(cc.rootcouse_penagihan)
                    // $('#penagihanShow').trigger('change')
                }
            })

        })

        $(document).on('change', '#isChecked', function(e) {
            if ($(this).prop("checked")) 
            {
                $('#is_checked').val('1');
            } else {
                $('#is_checked').val('0');
            }
        })

        //Export Excel
        $(document).on('click', '#exportButton', function(e) {
            e.preventDefault();
            var url = '{{ route("ftth-mt.export") }}';
            var params = {
                filtglProgress: $('#filtglProgress').val(),
                filnoWo: $('#filnoWo').val(),
                filcustId: $('#filcustId').val(),
                filstatusWo: $('#filstatusWo').val(),
                filarea: $('#filarea').val(),
                filleaderTim: $('#filleaderTim').val(),
                filcallsignTimid: $('#filcallsignTimid').val(),
                filteknisi: $('#filteknisi').val(),
                filcluster: $('#filcluster').val(),
                filfatCode: $('#filfatCode').val(),
                filslotTime: $('#filslotTime').val(),
                filGroup: $('#filGroup').val()
            };

            window.location.href = url + '?' + $.param(params);
        });

        function get_summary() {
            var _token = $('meta[name=csrf-token]').attr('content');
            let typeSum = "Ftth MT"

            $.ajax({
                url: "{{ route('getSummaryWO') }}",
                type: "get",
                data: {
                    filTgl: $('#filtglProgress').val(),
                    filarea: $('#filarea').val(),
                    filcluster: $('#filcluster').val(),
                    filGroup: $('#filGroup').val(),
                    filtype: typeSum,
                    _token: _token
                },
                success: function(response) {
                    console.log(response);
                    console.log(response.length);

                    $.each(response, function(k,sum) {
                        $('#totTotal').html(sum.total);
                        $('#totDone').html(sum.done);
                        $('#totPending').html(sum.pending);
                        $('#totCancel').html(sum.cancel);
                        $('#totCheckin').html(sum.checkin);
                        $('#totRequested').html(sum.requested);
                    })
                    // $('#totTotal').text(response.total);

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Failed to fetch data. Please try again.');
                }
            });
        }

        function get_data_assignTim() {
            var data_assignTim = $('#tabelAssignTim').DataTable({
                // dom: 'Bftip',
                // layout: {
                //     topStart: {
                //         buttons: ['excel']
                //     },
                // },
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
                        filstatusWo: $('#filstatusWo').val(),
                        filarea: $('#filarea').val(),
                        filleaderTim: $('#filleaderTim').val(),
                        filcallsignTimid: $('#filcallsignTimid').val(),
                        filteknisi: $('#filteknisi').val(),
                        filcluster: $('#filcluster').val(),
                        filfatCode: $('#filfatCode').val(),
                        filslotTime: $('#filslotTime').val(),
                        filGroup: $('#filGroup').val(),
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
                        data: 'slot_time_apk'
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
                        data: 'teknisi4'
                    },
                    {
                        data: 'status_apk'
                    },
                    {
                        data: 'status_wo'
                    },
                    {
                        data: 'penagihan'
                    },
                    {
                        data: 'is_checked',
                        render: function(data, type, row) {
                            if (data == 1) {
                                // Jika sudah dicek, tampilkan badge hijau
                                return '<span class="badge text-bg-success text-white">Sudah Dicek</span>';
                            } else {
                                // Jika belum dicek, tampilkan badge kuning
                                return '<span class="badge text-bg-warning text-white">Belum Dicek</span>';
                            }
                        }
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }

        $(document).on('change','#callsignTimidShow', function(e) {
            
            ctim = $(this).val().split("|");
            ctimTeknisi = callTim.find(k=>k.callsign === ctim[1] );
            console.log('ctimTeknisi : ', ctimTeknisi);

            let selectTek1 = $('#teknisi1Show');
            let selectTek2 = $('#teknisi2Show');
            let selectTek3 = $('#teknisi3Show');
            let selectTek4 = $('#teknisi4Show');

            selectTek1.val(ctimTeknisi.tek1_nik+"|"+ctimTeknisi.teknisi1 || "");
            selectTek2.val(ctimTeknisi.tek2_nik+"|"+ctimTeknisi.teknisi2 || "");
            selectTek3.val(ctimTeknisi.tek3_nik+"|"+ctimTeknisi.teknisi3 || "");
            selectTek4.val(ctimTeknisi.tek4_nik+"|"+ctimTeknisi.teknisi4 || "");

        });

        

        $(document).on('click', '#detail-assign', function (e) {
            var _token = $('meta[name=csrf-token]').attr('content');

            $('#formDetailWoMT').find('input, textarea').val('');
            let assign_id = $(this).data('id');

            $.ajax({
                url: "{{ route('getDetailWOFtthMT') }}",
                type: "get",
                data: {
                    filAssignId: assign_id,
                    _token: _token
                },
                success: function (response) {

                    $('#showDetail').modal('show');
                    isiDispatch();


                    let dtDis = response.data;
                    let material = response.ftth_material;
                    let callsignTims = response.callsign_tims;
                    let callsignLeads = response.callsign_leads;
                    let teknisiOn = response.teknisiOn;
                    callTim = response.assignTim;
                    
                    if(response.ftth_material.length > 0) {
                        materialOut = response.ftth_material.filter(k => k.status_item == "OUT");
                        materialIn = response.ftth_material.filter(i => i.status_item == "IN");

                        //mengisi nilai ke input materialOut dan materialIn
                        $('input[name="materialOut"]').val(materialOut.length);
                        $('input[name="materialIn"]').val(materialIn.length);

                        // statMaterial = "Ada | " + response.ftth_material.length
                        statMaterial = "Terpasang = " + materialOut.length + " | Dikembalikan = " + materialIn.length

                    } else {
                        statMaterial = "Tidak Ada"
                        $('input[name="materialOut"]').val(0);
                        $('input[name="materialIn"]').val(0);
                    };

                    //Tab Detail WO/////////////////////////////
                    $('#titleModalMT').html('Detail Progress WO FTTH Maintenance - ' + dtDis.no_wo + ' | ' + dtDis.cust_id + ' | ' + dtDis.nama_cust)

                    $('#detId').val(dtDis.id);
                    $('#noWoShow').val(dtDis.no_wo); //1
                    $('#ticketNoShow').val(dtDis.no_ticket); //1
                    $('#custIdShow').val(dtDis.cust_id); //1
                    $('#custNameShow').val(toTitleCase(dtDis.nama_cust || "")); //1
                    $('#woTypeShow').val(toTitleCase(dtDis.wo_type_apk || "")); //1
                    $('#jenisWoShow').val(dtDis.type_wo); //1
                    $('#WoDateShow').val(dtDis.wo_date_apk); //1
                    $('#custAddressShow').val(toTitleCase(dtDis.cust_address1 || "")); //1
                    $('#fatCodeShow').val(dtDis.kode_fat); //1
                    $('#portFatShow').val(dtDis.port_fat); //1
                    $('#remarkStatus').val(toTitleCase(dtDis.type_maintenance || "")); //1
                    $('#branchShow').val(dtDis.branch); //1
                    $('#kotamadyaShow').val(dtDis.kotamadya); //1
                    $('#cluster').val(dtDis.cluster); //1
                    $('#kotaPenagihanShow').val(dtDis.kotamadya_penagihan);  //1
                    $('#sitePenagihan').val(dtDis.site_penagihan); //1
                    $('#sesiDetShow').val(toTitleCase(dtDis.sesi || "")); //1                   

                    // Populasi dropdown Lead Callsign
                    let selectLead = $('#LeadCallsignShow');
                    selectLead.empty().append('<option value="">Pilih Lead Callsign</option>');
                    callsignLeads.forEach(item => {
                        selectLead.append(`<option value="${item.id}|${item.lead_callsign}|${item.leader_id}|${item.nama_karyawan}">${item.lead_callsign} | ${item.nama_karyawan} </option>`);
                    });

                    // Atur nilai dropdown Lead Callsign sesuai dengan `leadcall_id`
                    if (dtDis.leadcall_id) {
                        selectLead.val(dtDis.leadcall_id+"|"+dtDis.leadcall+"|"+dtDis.leader_id+"|"+dtDis.leader); //1
                    }

                    // Populasi dropdown Callsign Tim
                    let selectTim = $('#callsignTimidShow');
                    selectTim.empty().append('<option value="">Pilih Callsign Tim</option>');
                    callsignTims.forEach(item => {
                        selectTim.append(`<option value="${item.id}|${item.callsign_tim}">${item.callsign_tim}</option>`);
                    });
                    selectTim.val(dtDis.callsign_id+"|"+dtDis.callsign); //1

                    let selectTek1 = $('#teknisi1Show');
                    let selectTek2 = $('#teknisi2Show');
                    let selectTek3 = $('#teknisi3Show');
                    let selectTek4 = $('#teknisi4Show');

                    selectTek1.empty().append('<option value="">Pilih Teknisi</option>');
                    selectTek2.empty().append('<option value="">Pilih Teknisi</option>');
                    selectTek3.empty().append('<option value="">Pilih Teknisi</option>');
                    selectTek4.empty().append('<option value="">Pilih Teknisi</option>');

                    teknisiOn.forEach(item => {
                        selectTek1.append(`<option value="${item.nik_karyawan}|${item.nama_karyawan}">${item.nama_karyawan}</option>`);
                        selectTek2.append(`<option value="${item.nik_karyawan}|${item.nama_karyawan}">${item.nama_karyawan}</option>`);
                        selectTek3.append(`<option value="${item.nik_karyawan}|${item.nama_karyawan}">${item.nama_karyawan}</option>`);
                        selectTek4.append(`<option value="${item.nik_karyawan}|${item.nama_karyawan}">${item.nama_karyawan}</option>`);
                    });

                    console.log('dtDis : ', dtDis );
                    selectTek1.val(dtDis.tek1_nik+"|"+dtDis.teknisi1 || ""); //1
                    selectTek2.val(dtDis.tek2_nik+"|"+dtDis.teknisi2 || ""); //1
                    selectTek3.val(dtDis.tek3_nik+"|"+dtDis.teknisi3 || ""); //1
                    selectTek4.val(dtDis.tek4_nik+"|"+dtDis.teknisi4 || ""); //1

                    //End Tab Detail WO//////////////////////////////

                    //Tab Status Progress
                    $('#tglProgressAPKShow').val(dtDis.tgl_ikr); //1
                    $('#slotTimeAPKStatusShow').val(dtDis.slot_time_apk); //1
                    $('#statusWo').val(dtDis.status_wo || ""); //1
                    isiCousecode();
                    // $('#statusWo').trigger("change");
                    // $('#causeCode').trigger("change");
                    // $('#rootCause').trigger("change");
                    

                    // $('#causeCodeOld').val(dtDis.couse_code);
                    $('#causeCode').val(dtDis.couse_code); //1

                    $('#rootCause').val(dtDis.root_couse); //1

                    $('#actionTaken').val(dtDis.action_taken); //1
                    $('#actionTaken').trigger("change");

                    $('#penagihanShow').val(dtDis.penagihan); //

                    $('#reportTeknisi').val(toTitleCase(dtDis.keterangan || "")); //1
                    $('#statusVisit').val(dtDis.visit_novisit); //1
                    $('#actionStatus').val(dtDis.action_status); //1

                    $('#preconBad').val(dtDis.bad_precon);  //1
                    $('#tglReschedule').val(dtDis.tgl_reschedule); //
                    $('#tglJamReschedule').val(dtDis.tgl_jam_reschedule); //1
                    

                    $('#permintaanReschedule').val(toTitleCase(dtDis.permintaan_rsch || "")); //1
                    $('#responKonfCst').val(toTitleCase(dtDis.respon_cst || "")); //1
                    $('#jwbKonfCst').val(toTitleCase(dtDis.jawaban_cst || "")); //1
                    $('#weatherShow').val(dtDis.weather); //1
                    $('#picDispatch').val(toTitleCase(dtDis.dispatch || "")); //1
                    $('#telpDispatch').val(dtDis.telp_dispatch || ""); //1
                    $('#detailAlasan').val(toTitleCase(dtDis.detail_alasan || "")); //1
                    $('#statusWoApk').val(dtDis.status_apk || ""); //1
                    $('#tglCheckinApk').val(dtDis.checkin_apk); //1
                    $('#tglCheckoutApk').val(dtDis.checkout_apk); //1

                    $('#validasiStart').val(dtDis.validasi_start); //1
                    $('#validasiEnd').val(dtDis.validasi_end); //1
                    $('#registStart').val(dtDis.regist_start); //1
                    $('#registEnd').val(dtDis.regist_end); //1
                    $('#kodeOtp').val(dtDis.kode_otp); //1
                    $('#cekTelebot').val(dtDis.cek_telebot); //1
                    $('#hasilCekTelebot').val(dtDis.hasil_cek_telebot); //1
                    $('#mttrAll').val(dtDis.mttr_all); //1
                    $('#mttrPending').val(dtDis.mttr_pending); //1
                    $('#mttrProgress').val(dtDis.mttr_progress); //1
                    $('#mttrTeknisi').val(dtDis.mttr_teknisi); //1
                    $('#slaOver').val(dtDis.sla_over); //1
                    $('#statusMaterial').val(statMaterial); //1
                    $('input[name="materialOut"]').val(0); //1
                    $('input[name="materialIn"]').val(0); //1

                    if(dtDis.is_checked == 1) {
                        $('#isChecked').prop('checked', true); //1
                        $('#is_checked').val(dtDis.is_checked);
                        $('#picName').html('Sudah dicek (PIC. ' + dtDis.pic_monitoring + ')');
                    } else {
                        $('#isChecked').prop('checked', false); //1
                        $('#is_checked').val(dtDis.is_checked);
                        $('#picName').html('Sudah dicek (PIC. ' + response.akses + ')');
                    }
                    
                    $('#tglProgressAPKShow').trigger('change');
                    //End Tab Status Progress

                    //Start Tab Material
                    $('#id_material').val(dtDis.id_material);
                    $('#merkOntOut').val(material.merk_ont_out);
                    $('#snOntOut').val(material.sn_ont_out);
                    $('#macOntOut').val(material.mac_ont_out);
                    $('#merkOntIn').val(material.merk_ont_in);
                    $('#snOntIn').val(material.sn_ont_in);
                    $('#macOntIn').val(material.mac_ont_in);

                    $('#merkStbOut').val(material.merk_stb_out);
                    $('#snStbOut').val(material.sn_stb_out);
                    $('#macStbOut').val(material.mac_stb_out);
                    $('#merkStbIn').val(material.merk_stb_in);
                    $('#snStbIn').val(material.sn_stb_in);
                    $('#macStbIn').val(material.mac_stb_in);

                    $('merkRouterOut').val(material.merk_router_out);
                    $('snRouterOut').val(material.sn_router_out);
                    $('macRouterOut').val(material.mac_router_out);
                    $('merkRouterIn').val(material.merk_router_in);
                    $('snRouterIn').val(material.sn_router_in);
                    $('macRouterIn').val(material.mac_router_in);

                    $('#remoteOut').val(material.remote_out);
                    $('#remoteIn').val(material.remote_in);
                    $('#kabelDw').val(material.dw_out);
                    $('#kabelPrecon').val(material.precon_out);
                    $('#kabelPreconBad').val(material.bad_precon);

                    $('#fastConnector').val(material.fastcon_out);
                    $('#patchCord').val(material.patchcord_out);
                    $('#terminalBox').val(material.tb_out);
                    $('#pvcPipe').val(material.pvc_out);
                    $('#socketPipe').val(material.socket_out);
                    $('#kabelUtp').val(material.utp_out);
                    $('#rj45').val(material.rj45_out);
                    
                },
                error: function (xhr, status, error) {
                    console.error('Gagal memuat data:', error);
                }
            });
        });

        $(document).on('click', '#detail-materialStatus', function(e) {
            e.preventDefault();

            $('#detail-material').trigger('click', [$('#detId').val()]);
        })

        $(document).on('click', '#detail-material', function(e,detid) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let assign_id
            if(!detid){
                assign_id = $(this).data('id');
            } else {
                assign_id = detid;
            }

            $.ajax({
                url: "{{ route('getMaterialFtthMt') }}",
                type: "get",
                data: {
                    filAssignId: assign_id,
                    _token: _token
                },
                success: function(response) {
                    console.log('Respons dari API:', response);
                    // Ambil data material dari response
                    let materials = response.data;

                    // Filter data untuk menghapus duplikat berdasarkan kolom tertentu (misalnya description + SN)
                    let uniqueMaterials = materials.filter((value, index, self) =>
                        index === self.findIndex((t) => (
                            t.description === value.description && t.sn === value.sn
                        ))
                    );

                    // Kosongkan tabel sebelum mengisi data baru
                    $('#bodyStatusProgresWo').empty();

                    // Iterasi data unik dan buat baris baru
                    if (uniqueMaterials && uniqueMaterials.length > 0) {
                        uniqueMaterials.forEach((item, index) => {
                            let row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.status_item}</td>
                                    <td>${item.item_code}</td>
                                    <td>${item.description}</td>
                                    <td>${item.qty}</td>
                                    <td>${item.sn ? item.sn : '-'}</td>
                                    <td>${item.mac_address ? item.mac_address : '-'}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            id="edit-material"
                                            data-id="${item.id}"
                                            class="btn btn-sm btn-secondary edit-material mb-0 tooltip-info p-1"
                                            data-rel="tooltip"
                                            title="Edit Material" data-bs-toggle="modal" data-bs-target="#editMaterial" data-bs-whatever="Edit Material">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                width="20"
                                                height="20"
                                                viewBox="0 0 50 50">
                                                <path d="M 43.125 2 C 41.878906 2 40.636719 2.488281 39.6875 3.4375 L 38.875 4.25 L 45.75 11.125 C 45.746094 11.128906 46.5625 10.3125 46.5625 10.3125 C 48.464844 8.410156 48.460938 5.335938 46.5625 3.4375 C 45.609375 2.488281 44.371094 2 43.125 2 Z M 37.34375 6.03125 C 37.117188 6.0625 36.90625 6.175781 36.75 6.34375 L 4.3125 38.8125 C 4.183594 38.929688 4.085938 39.082031 4.03125 39.25 L 2.03125 46.75 C 1.941406 47.09375 2.042969 47.457031 2.292969 47.707031 C 2.542969 47.957031 2.90625 48.058594 3.25 47.96875 L 10.75 45.96875 C 10.917969 45.914063 11.070313 45.816406 11.1875 45.6875 L 43.65625 13.25 C 44.054688 12.863281 44.058594 12.226563 43.671875 11.828125 C 43.285156 11.429688 42.648438 11.425781 42.25 11.8125 L 9.96875 44.09375 L 5.90625 40.03125 L 38.1875 7.75 C 38.488281 7.460938 38.578125 7.011719 38.410156 6.628906 C 38.242188 6.246094 37.855469 6.007813 37.4375 6.03125 C 37.40625 6.03125 37.375 6.03125 37.34375 6.03125 Z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            `;
                            // Tambahkan baris ke tabel
                            $('#bodyStatusProgresWo').append(row);
                        });
                    } else {
                        // Jika tidak ada data, tambahkan baris kosong
                        $('#bodyStatusProgresWo').append(`
                            <tr>
                                <td colspan="6" class="text-center">No data available</td>
                            </tr>
                        `);
                    }

                    // Tampilkan modal
                    $('#showMaterial').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Failed to fetch data. Please try again.');
                }
            });

        });


        $('.updateFtthMt').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('updateFtthMt') }}",
                type: "get",
                data: $(this).serialize(),
                success: function(obj) {
                    if(obj=="success"){
                        $('#showDetail').modal('hide');

                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Berhasil update Data Monitoring",
                            showConfirmButton: true,
                            // timer: 2000
                        });

                        $('#tabelAssignTim').DataTable().ajax.reload();
                    } else {
                        $('#showDetail').modal('hide');

                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: obj,
                            showConfirmButton: true,
                            // timer: 2000
                        });

                        $('#tabelAssignTim').DataTable().ajax.reload();
                    }
                }
            });
        });

        $(document).on('click', '#edit-material', function (e) {
            var _token = $('meta[name=csrf-token]').attr('content');
            let assign_id = $(this).data('id');

            $.ajax({
                url: "{{ route('editMaterialFtthMt') }}",
                type: "get",
                data: {
                    filAssignId: assign_id,
                    _token: _token
                },
                success: function (response) {
                    console.log('Respons dari API:', response);
                    console.log('Material ID:', assign_id);

                    let dtDis = response;

                    $('#det_id').val(dtDis.id);
                    $('#status_item').val(dtDis.status_item);
                    $('#item_code').val(dtDis.item_code);
                    $('#qty').val(dtDis.qty);
                    $('#sn').val(dtDis.sn);
                    $('#mac_address').val(dtDis.mac_address);
                    $('#description').val(dtDis.description);
                },
                error: function (xhr, status, error) {
                    console.error('Gagal memuat data:', error);
                }
            });
        });

    });
</script>

