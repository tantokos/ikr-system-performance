<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
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
                    <div class="card border shadow-xs mb-3">
                        <div class="card-header border-bottom pb-0" style="background: linear-gradient(to right, #4e0808, #6d2121);">
                            
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
                                            @if (isset($cluster))
                                                @foreach ($cluster as $cl)
                                                    <option value="{{ $cl->cluster }}">
                                                        {{ $cl->cluster }}
                                                @endforeach
                                            @endif
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

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Status WO</span>
                                        <select class="form-control form-control-sm" type="text" id="filstatusWo"
                                            name="filstatusWo" style="border-color:#9ca0a7;">
                                            <option value="" selected>Pilih Status WO</option>
                                            <option value="Requested">Requested</option>
                                            <option value="Checkin">Checkin</option>
                                            <option value="Checkout">Checkout</option>
                                            <option value="Done">Done</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Cancel">Cancelled</option>
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
                                            class="btn btn-sm btn-dark align-items-center filAssignTim"
                                            id="filAssignTim">Tampilkan</button>
                                        <button type="button" value="close"
                                            class="btn btn-sm btn-dark align-items-center"
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
                        <div class="card-body text-start p-3 w-100">
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
                        <div class="card-body text-start p-3 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100 text-center">
                                        <p class="text-sm text-secondary mb-1">Checkout/Done</p>
                                        <h4 class="mb-2 font-weight-bold" id="totDone"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-2">
                    <div class="card border shadow-lg mb-2">
                        <div class="card-body text-start p-3 w-100">
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
                        <div class="card-body text-start p-3 w-100">
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
                        <div class="card-body text-start p-3 w-100">
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
                        <div class="card-body text-start p-3 w-100">
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
                                            <span class="btn-inner--text">Export</span>
                                        </button>
                                    </a>

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
                                            <span class="btn-inner--text">Import Data WO APK</span>
                                        </button>
                                    </a>
                                    <a href="{{ route('importDataMaterial') }}">
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
                                </div>
                            </div>
                        </div>

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
                                            <th class="text-center text-xs font-weight-semibold">Status WO</th>
                                            <th class="text-center text-xs font-weight-semibold">Status Check</th>

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
                                @foreach ($mostCauseCode as $causeCode)
                                <tr>
                                    <td class="text-sm p-1">{{ $loop->iteration }}</td>
                                    <td class="text-sm p-1">{{ $causeCode->couse_code }}</td>
                                    <td class="text-sm p-1">{{ $causeCode->qtyCauseCode }}</td>
                                </tr>
                                @endforeach
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
                                @foreach ($mostRootCause as $root_cause)
                                <tr>
                                    <td class="text-sm p-1">{{ $loop->iteration }}</td>
                                    <td class="text-sm p-1">{{ $root_cause->root_couse }}</td>
                                    <td class="text-sm p-1">{{ $root_cause->qtyRootCause }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
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
                                @foreach ($mostActionTaken as $actionTaken)
                                <tr>
                                    <td class="text-sm p-1">{{ $loop->iteration }}</td>
                                    <td class="text-sm p-1">{{ $actionTaken->action_taken }}</td>
                                    <td class="text-sm p-1">{{ $actionTaken->qtyActionTaken }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                        {{-- <form action="{{ route('updateFtthMt') }}" method="post" enctype="multipart/form-data"> --}}
                        <form class="updateFtthMt" method="post" enctype="multipart/form-data">

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
                                                            <span class="text-xs">WO Type</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="woTypeShow" name="woTypeShow"
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Type</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="jenisWoShow" name="jenisWoShow"
                                                                style="border-color:#9ca0a7;" readonly>
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
                                                    <span class="text-xs">Area/Cluster</span>
                                                    <input type="text" class="form-control form-control-sm"
                                                        type="text" id="cluster" name="cluster"
                                                        style="border-color:#9ca0a7;" readonly>
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
                                                            <span class="text-xs">Tanggal Progress</span>
                                                            <input class="form-control form-control-sm" type="date"
                                                                value="{{ date('Y-m-d') }}" id="tglProgressShow"
                                                                name="tglProgressShow" style="border-color:#9ca0a7;" readonly>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Sesi</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="sesiShow" name="sesiShow"
                                                                style="border-color:#9ca0a7;"
                                                                placeholder="Isi Callsign Tim" readonly>
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
                                                                style="border-color:#9ca0a7;" readonly>
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
                                                                name="slotTimeAPKShow" style="border-color:#9ca0a7;" readonly>
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
                                                            <select class="form-control form-control-sm" id="LeadCallsignShow" name="LeadCallsignShow" style="border-color:#9ca0a7;" readonly>
                                                                <option value="">Pilih Lead Callsign</option>
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
                                                            <select class="form-control form-control-sm" id="callsignTimidShow" name="callsignTimidShow" style="border-color:#9ca0a7;" readonly>
                                                                <option value="">Pilih Callsign Tim</option>
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <span class="text-xs">Teknisi 1</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                                 id="teknisi1Show"
                                                                name="teknisi1Show"
                                                                style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <span class="text-xs">Teknisi 2</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                                 id="teknisi2Show"
                                                                name="teknisi2Show"
                                                                style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <span class="text-xs">Teknisi 3</span>
                                                        <input class="form-control form-control-sm" type="text"
                                                                 id="teknisi3Show"
                                                                name="teknisi3Show"
                                                                style="border-color:#9ca0a7;" readonly>
                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <span class="text-xs">Teknisi 4</span>
                                                        <input class="form-control form-control-sm" type="text" id="teknisi4Show"
                                                            name="teknisi4Show" style="border-color:#9ca0a7;" readonly>
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
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Cause Code</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="causeCode"
                                                                name="causeCode" style="border-color:#9ca0a7;">
                                                                <option value="" disabled selected>--Pilih Cause Code--</option>
                                                                
                                                            </select>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Root Cause</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="rootCause"
                                                                name="rootCause" style="border-color:#9ca0a7;">
                                                                <option value="" disabled selected>--Pilih Cause Code--</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Action Taken</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="actionTaken"
                                                                name="actionTaken" style="border-color:#9ca0a7;">
                                                                <option value="" disabled selected>--Pilih Action Taken--</option>

                                                            </select>
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Penagihan</span>
                                                            <select class="form-control form-control-sm"
                                                                id="penagihanShow"
                                                                name="penagihanShow"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="" disabled selected>--Pilih Penagihan--</option>
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
                                                    <span class="text-xs">Report Teknisi</span>
                                                    <textarea class="form-control form-control-sm" type="text" id="reportTeknisi" name="report_teknisi"
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
                                                        <option value="Requested">Requested</option>
                                                        <option value="Checkin">Checkin</option>
                                                        <option value="Checkout">Checkout</option>
                                                        <option value="Done">Done</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Cancelled">Cancelled</option>
                                                    </select>
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
                                                                name="checkout_apk"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Alasan Tidak Ganti Precon</span>
                                                            <textarea class="form-control form-control-sm" type="text"
                                                                id="alasanTidakGantiPrecon" name="alasan_tidak_ganti_precon"
                                                                style="border-color:#9ca0a7;"></textarea>
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Kondisi Cuaca</span>
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
                                                            <span class="text-xs">Alasan Pending</span>
                                                            <textarea class="form-control form-control-sm" type="text"
                                                                id="alasanPending" name="alasan_pending"
                                                                style="border-color:#9ca0a7;"></textarea>
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
                                                            <textarea class="form-control form-control-sm" type="text"
                                                                id="alasanCancel" name="alasan_cancel"
                                                                style="border-color:#9ca0a7;"></textarea>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <div class="col form-group mb-1">
                                                    <span class="text-xs">Status Visit</span>
                                                    <select class="form-control form-control-sm" type="text"
                                                        id="statusVisit" name="statusVisit" style="border-color:#9ca0a7;">
                                                        <option value="Team Visit">Team Visit</option>
                                                        <option value="No VIsit">No Visit</option>
                                                    </select>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Validasi Start</span>
                                                            <input class="form-control form-control-sm" type="time"
                                                                value="{{ date('H:i') }}" id="validasiStart"
                                                                name="validasiStart" style="border-color:#9ca0a7;">
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Validasi End</span>
                                                            <input class="form-control form-control-sm" type="time"
                                                                value="{{ date('H:i') }}" id="validasiEnd"
                                                                name="validasiEnd" style="border-color:#9ca0a7;">
                                                        </div>                                                        
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Status Checkin Slot Time</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="statusCheckin"
                                                                name="statusCheckin" style="border-color:#9ca0a7;" readonly>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Penggunaan Material</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                value="" id="statusMaterial"
                                                                name="statusMaterial" style="border-color:#9ca0a7;">
                                                                <option value=""></option>
                                                                <option value="Ada">Ada</option>
                                                                <option value="Tidak Ada">Tidak Ada</option>
                                                            </select>

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
                                                                <option value="Retail / Underground">Retail / Underground</option>
                                                            </select>
                                                        </div>

                                                        {{-- <div class="col form-group mb-1">
                                                            <span class="text-xs">Status Penggunaan Material</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                value="" id="statusMaterial"
                                                                name="statusMaterial" style="border-color:#9ca0a7;" readonly>
                                                        </div> --}}
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group">
                                                            <div class="form-check">
                                                                <input type="hidden" name="is_checked" value="0"> <!-- Default jika tidak dicentang -->
                                                                <input class="form-check-input" type="checkbox" name="is_checked" value="1" id="isChecked">
                                                                <label class="text-xs" for="isChecked">
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

        {{-- Modal Detail Material --}}
        <div class="modal fade" id="showMaterial" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel2" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Detail Material</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12 mt-3 mb-3">
                            <div class="table-responsive p-0">
                                <table id="summaryAssignTeam" class="table table-sm table-striped table-bordered align-items-center mb-0">
                                    <thead class="bg-gray-600">
                                        <tr id="headStatusProgresWo">
                                            <th class="text-white text-sm font-weight-semibold">No</th>
                                            <th class="text-white text-sm font-weight-semibold">Status Item</th>
                                            <th class="text-white text-sm font-weight-semibold">Item Code</th>
                                            <th class="text-white text-sm font-weight-semibold">Description</th>
                                            <th class="text-white text-sm font-weight-semibold">Qty</th>
                                            <th class="text-white text-sm font-weight-semibold">SN</th>
                                            <th class="text-white text-sm font-weight-semibold">Mac Address</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyStatusProgresWo">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" value="close" class="btn btn-sm btn-dark align-items-center"
                            data-bs-dismiss="modal">Tutup</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Modal Detail Material --}}

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
        akses = $('#akses').val();
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

            tglJmCheckin = new Date($('#tglCheckinApk').val());
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

            console.log('timeDistance : ', timeDistance(tglJmCheckin, tglJmSlotTime));

            stat=(tglJmCheckin-tglJmSlotTime)/60000;           
            
            if(stat < -15){
                status="Lebih Awal"
            }else if(stat <= -1 && stat >= -15) {
                status="On Time"
            } else if(stat>0) {
                status="Terlambat"
            }
            $('#statusCheckin').val(status);
            
        })

        $(document).on('change', '#tglCheckinApk', function(e) {
            $('#tglProgressAPKShow').trigger('change');
        })


        $('.date-range').daterangepicker({
            startDate: moment(),
            endDate: moment(),
        });

        $(document).on('click', '#filAssignTim', function(e) {
            get_data_assignTim();
            get_summary();
            stDate = $('.date-range').data('daterangepicker').startDate.format("DD-MMM-YYYY");
            enDate = $('.date-range').data('daterangepicker').endDate.format("DD-MMM-YYYY");
        })

        $('#filAssignTim').trigger("click");

        $(document).on('change','#statusWo', function(e) {
            console.log($(this).val());
            $('#causeCode').val('');
            $('#rootCause').val('');
            $('#actionTaken').val('');
            $('#penagihanShow').val('');

            $('#causeCode').find('option').remove();
            $('#causeCode').append(`
                <option value="" disabled selected>--Pilih Cause Code--</option>`
            );

            filCouseCode = dtCouseCode.filter(k => k.status_wo === $(this).val());

            $.each(filCouseCode, function(k, cc) {
                $('#causeCode').append(
                    `<option value="${cc.couse_code}">${cc.couse_code}</option>`
                )
            })
                

        })

        $(document).on('change','#causeCode', function(e) {
            // alert('status change');
            // $('#rootCause').val('');
            // $('#actionTaken').val('');
            // $('#penagihanShow').val('');

            $('#rootCause').find('option').remove();
            $('#rootCause').append(`
                <option value="" disabled selected>--Pilih Root Cause--</option>`
            );

            filRootCouse = dtRootCouse.filter(k => k.couse_code === $(this).val());

            $.each(filRootCouse, function(k, cc) {
                $('#rootCause').append(
                    `<option value="${cc.root_couse}">${cc.root_couse}</option>`
                )
            })               

        })

        $(document).on('change','#rootCause', function(e) {
            // alert('status change');
            // $('#rootCause').val('');
            // $('#actionTaken').val('');
            // $('#penagihanShow').val('');

            $('#actionTaken').find('option').remove();
            $('#actionTaken').append(`
                <option value="" disabled selected>--Pilih Action Taken--</option>`
            );

            filActionTaken = dtActionTaken.filter(k => k.root_couse === $(this).val());

            $.each(filActionTaken, function(k, cc) {
                $('#actionTaken').append(
                    `<option value="${cc.action_taken}">${cc.action_taken}</option>`
                )
            })               

        })

        $(document).on('change','#actionTaken', function(e) {    
            // alert('status change');
            // $('#rootCause').val('');
            // $('#actionTaken').val('');
            // $('#penagihanShow').val('');

            $('#penagihanShow').find('option').remove();
            $('#penagihanShow').append(`
                <option value="" disabled selected>--Pilih Penagihan--</option>`
            );

            filPenagihan = dtPenagihan.filter(k => k.status_wo === $('#statusWo').val() && k.couse_code === $('#causeCode').val() && k.root_couse === $('#rootCause').val() && k.action_taken === $('#actionTaken').val() );

            $.each(filPenagihan, function(k, cc) {
                $('#penagihanShow').append(
                    `<option value="${cc.rootcouse_penagihan}">${cc.rootcouse_penagihan}</option>`
                )
            })               

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
                filslotTime: $('#filslotTime').val()
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
                        filstatusWo: $('#filstatusWo').val(),
                        filarea: $('#filarea').val(),
                        filleaderTim: $('#filleaderTim').val(),
                        filcallsignTimid: $('#filcallsignTimid').val(),
                        filteknisi: $('#filteknisi').val(),
                        filcluster: $('#filcluster').val(),
                        filfatCode: $('#filfatCode').val(),
                        filslotTime: $('#filslotTime').val(),
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
                        data: 'status_apk'
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

        $(document).on('click', '#detail-assign', function (e) {
            var _token = $('meta[name=csrf-token]').attr('content');
            let assign_id = $(this).data('id');

            $.ajax({
                url: "{{ route('getDetailWOFtthMT') }}",
                type: "get",
                data: {
                    filAssignId: assign_id,
                    _token: _token
                },
                success: function (response) {
                    console.log('Respons dari API:', response);

                    console.log('Respons Material length:', response.ftth_material.count);
                    let dtDis = response.data;
                    let material = response.ftth_material;
                    let callsignTims = response.callsign_tims;
                    let callsignLeads = response.callsign_leads;    
                    
                    if(response.ftth_material.length > 0) {
                        statMaterial = "Ada"
                    } else {
                        statMaterial = "Tidak Ada"
                    };
                    console.log('statMaterial : ', statMaterial)

                    //Tab Detail WO/////////////////////////////
                    $('#detId').val(dtDis.id);
                    $('#noWoShow').val(dtDis.no_wo);
                    $('#ticketNoShow').val(dtDis.no_ticket);
                    $('#custIdShow').val(dtDis.cust_id);
                    $('#custNameShow').val(toTitleCase(dtDis.nama_cust || ""));
                    $('#woTypeShow').val(toTitleCase(dtDis.wo_type_apk || ""));
                    $('#jenisWoShow').val(dtDis.type_wo);
                    $('#WoDateShow').val(dtDis.wo_date_apk);                   
                    $('#custAddressShow').val(toTitleCase(dtDis.cust_address1 || ""));
                    $('#fatCodeShow').val(dtDis.kode_fat);
                    $('#portFatShow').val(dtDis.port_fat);
                    $('#cluster').val(dtDis.cluster);
                    $('#remarkStatus').val(toTitleCase(dtDis.type_maintenance || ""));
                    $('#branchShow').val(dtDis.branch);
                    $('#kotamadyaShow').val(dtDis.kotamadya);
                    $('#tglProgressShow').val(dtDis.tgl_ikr);
                    $('#sesiShow').val(toTitleCase(dtDis.sesi || ""));
                    $('#slotTimeLeaderShow').val(dtDis.slot_time_leader);
                    $('#slotTimeAPKShow').val(dtDis.slot_time_apk);                    
                    
                    // Populasi dropdown Lead Callsign
                    let selectLead = $('#LeadCallsignShow');
                    selectLead.empty().append('<option value="">Pilih Lead Callsign</option>');
                    callsignLeads.forEach(item => {
                        selectLead.append(`<option value="${item.id}">${item.lead_callsign}</option>`);
                    });

                    // Atur nilai dropdown Lead Callsign sesuai dengan `leadcall_id`
                    if (dtDis.leadcall_id) {
                        selectLead.val(dtDis.leadcall_id);
                    }

                    $('#leaderShow').val(dtDis.leader);
                    // Populasi dropdown Callsign Tim
                    let selectTim = $('#callsignTimidShow');
                    selectTim.empty().append('<option value="">Pilih Callsign Tim</option>');
                    callsignTims.forEach(item => {
                        selectTim.append(`<option value="${item.id}">${item.callsign_tim}</option>`);
                    });
                    selectTim.val(dtDis.callsign_id);

                    $('#teknisi1Show').val(toTitleCase(dtDis.teknisi1 || ""));
                    $('#teknisi2Show').val(toTitleCase(dtDis.teknisi2 || ""));
                    $('#teknisi3Show').val(toTitleCase(dtDis.teknisi3 || ""));
                    $('#teknisi4Show').val(toTitleCase(dtDis.teknisi4 || ""));
                    //End Tab Detail WO//////////////////////////////

                    //Tab Status Progress
                    $('#tglProgressStatusShow').val(dtDis.tgl_ikr);
                    $('#slotTimeLeaderStatusShow').val(dtDis.slot_time_leader);
                    $('#statusWo').val(toTitleCase(dtDis.status_wo || ""));
                    $('#statusWo').trigger("change");

                    $('#causeCode').val(dtDis.couse_code);
                    $('#causeCode').trigger("change");

                    $('#rootCause').val(dtDis.root_couse);
                    $('#rootCause').trigger("change");

                    $('#actionTaken').val(dtDis.action_taken);
                    $('#actionTaken').trigger("change");

                    $('#penagihanShow').val(dtDis.penagihan);
                    $('#tglReschedule').val(dtDis.tgl_reschedule);
                    $('#tglJamReschedule').val(dtDis.tgl_jam_reschedule);
                    $('#reportTeknisi').val(toTitleCase(dtDis.keterangan || ""));

                    $('#tglProgressAPKShow').val(dtDis.tgl_ikr);
                    $('#slotTimeAPKStatusShow').val(dtDis.slot_time_apk);
                    $('#statusWoApk').val(toTitleCase(dtDis.status_apk || ""));
                    $('#tglCheckinApk').val(dtDis.checkin_apk);
                    $('#tglCheckoutApk').val(dtDis.checkout_apk);
                    $('#alasanTidakGantiPrecon').val(toTitleCase(dtDis.alasan_tidak_ganti_precon || ""));
                    $('#weatherShow').val(dtDis.weather);
                    $('#alasanPending').val(toTitleCase(dtDis.alasan_pending || ""));                    
                    $('#picDispatch').val(toTitleCase(dtDis.pic_dispatch || ""));
                    $('#alasanCancel').val(toTitleCase(dtDis.alasan_cancel || ""));

                    $('#statusVisit').val(dtDis.visit_novisit);
                    $('#validasiStart').val(dtDis.validasi_start);
                    $('#validasiEnd').val(dtDis.validasi_end);
                    $('#statusMaterial').val(statMaterial);
                    $('#sitePenagihan').val(dtDis.site_penagihan);

                    $('#isChecked').prop('checked', dtDis.is_checked == 1);
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


                    $('#tglProgressAPKShow').trigger('change');
                    $('#showDetail').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error('Gagal memuat data:', error);
                }
            });
        });

        $(document).on('click', '#detail-material', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let assign_id = $(this).data('id');


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
                type: "post",
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

    });
</script>

