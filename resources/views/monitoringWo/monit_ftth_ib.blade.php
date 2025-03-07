<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-2 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-2 mb-2">
                        <div class="full-background" style="background: linear-gradient(to right, #112133, #21416d);">
                        </div>
                        <div class="card-body text-start p-3 w-100">
                            <h3 class="text-white mb-2">Monitoring WO FTTH New Installation</h3>
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
                    <div class="card border shadow-xs mb-2">
                        <div class="card-header border-bottom pb-0">
                            {{-- <div class="d-sm-flex align-items-center"> --}}
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
                                                    @if(isset($areaFill))
                                                        <option value="{{ $b->id . '|' . $b->nama_branch }}" {{ $b->id . '|' . $b->nama_branch == $areaFill ? 'selected' : ''}}>{{ $b->nama_branch }}</option>
                                                    @else
                                                        <option value="{{ $b->id . '|' . $b->nama_branch }}">{{ $b->nama_branch }}</option>
                                                    @endif
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
                                            <option value="" disabled selected>Pilih Status WO</option>
                                            <option value="Requested">Requested</option>
                                            <option value="Checkin">Checkin</option>
                                            <option value="Checkout">Checkout</option>
                                            <option value="Done">Done</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col">

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Grup</span>
                                        <select class="form-control form-control-sm select2" id="filGroup" name="filGroup" style="border-color:#9ca0a7;">
                                            @if (isset($areagroup))
                                                <option value="" {{ "" == $areagroup ? 'selected' : ''}}>Pilih Grup</option>
                                                <option value="Jakarta" {{ "Jakarta" == $areagroup ? 'selected' : ''}}>Jakarta</option>
                                                <option value="Jabota" {{ "Jabota" == $areagroup ? 'selected' : ''}}>Jabota</option>
                                                <option value="Regional" {{ "Regional" == $areagroup ? 'selected' : ''}}>Regional</option>
                                            @else
                                                <option value="">Pilih Grup</option>
                                                <option value="Jakarta">Jakarta</option>
                                                <option value="Jabota">Jabota</option>
                                                <option value="Regional">Regional</option>
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
                <div class="col-xl-2 col-sm-2">
                    <div class="card border shadow-lg mb-2">
                        <div class="card-body text-start p-3 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100 text-center">
                                        <p class="text-sm text-secondary mb-1">Total WO IB</p>
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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Data FTTH New Installation</span></h6>
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

                                    <a href="{{ route('importDataFtthIbApk') }}" id="importApkButton">
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
                                    <a href="{{ route('importIbMaterial') }}" id="importIbMaterialButton">
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
                                            <span class="btn-inner--text">Import Data Material</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">
                            <button id="get-selected" class="btn btn-sm btn-primary">Konfirmasi Pengecekan</button><br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="select-all">
                                <label class="form-check-label" for="select-all">
                                  Pilih Semua
                                </label>
                            </div>
                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="tabelAssignTim" style="font-size: 12px; border-color:#9ca0a7;">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs">#</th>
                                            <th class="text-center text-xs">Tanggal</th>
                                            <th class="text-center text-xs">No WO</th>
                                            <th class="text-center text-xs">WO Date</th>
                                            <th class="text-center text-xs">Cust Id</th>
                                            <th class="text-center text-xs">Cust Name</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">Cust Address</th> --}}
                                            <th class="text-center text-xs">Type WO</th>
                                            <th class="text-center text-xs">Fat Code</th>
                                            <th class="text-center text-xs">Cluster</th>
                                            <th class="text-center text-xs">Area</th>
                                            <th class="text-center text-xs">Slot Time</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">Lead Callsign</th> --}}
                                            <th class="text-center text-xs">Callsign Tim</th>
                                            <th class="text-center text-xs">Leader</th>
                                            <th class="text-center text-xs">Teknisi 1</th>
                                            <th class="text-center text-xs">Teknisi 2</th>
                                            <th class="text-center text-xs">Teknisi 3</th>
                                            <th class="text-center text-xs">Teknisi 4</th>
                                            {{-- <th class="text-center text-xs font-weight-semibold">Teknisi 4</th> --}}
                                            <th class="text-center text-xs">Status APK</th>
                                            <th class="text-center text-xs">Status WO</th>
                                            <th class="text-center text-xs">Reason Status</th>
                                            <th class="text-center text-xs">Status Check</th>
                                            <th class="text-center text-xs">Status Konfirmasi</th>

                                            <th class="text-center text-xs">#</th>

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

            {{-- <x-app.footer /> --}}
        </div>

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

        {{-- Modal Show Detail Data Tool --}}
        <div class="modal fade" id="showAssignTim" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-keyboard="false"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Progress WO FTTH New Installation</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="{{ route('updateSignTim') }}" method="post" enctype="multipart/form-data"> --}}
                        {{-- <form action="{{ route('updateFtthIb') }}" method="post" enctype="multipart/form-data" id="formDetailWoIB"> --}}
                        <form class="updateFtthIb" method="get" enctype="multipart/form-data" id="formDetailWoIB">
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
                                                    <span class="text-xs">Area/Cluster</span>
                                                    <input type="text" class="form-control form-control-sm"
                                                        type="text" id="areaShow" name="areaShow"
                                                        style="border-color:#9ca0a7;" readonly>
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
                                                    <textarea class="form-control form-control-sm" type="text" id="remarksShow" name="remarksShow"
                                                        style="border-color:#9ca0a7;" readonly></textarea>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <div class="col form-group mb-1">
                                                    <span class="text-xs">Branch</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="branchShow" name="branchShow"
                                                        style="border-color:#9ca0a7;" readonly>
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
                                                            <span class="text-xs">Lead Callsign | Leader</span>
                                                            <select class="form-control form-control-sm" id="LeadCallsignShow" name="LeadCallsignShow"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="">Pilih Lead Callsign</option>
                                                            </select>
                                                        </div>
                                                        {{-- <div class="col form-group mb-1">
                                                            <span class="text-xs">Nama Leader</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="leaderShow" name="leaderShow"
                                                                style="border-color:#9ca0a7;" readonly>
                                                            <input type="hidden" id="leaderidShow"
                                                                name="leaderidShow" readonly>
                                                        </div> --}}
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
                                                        <select class="form-control form-control-sm" type="text" id="teknisi1Show" name="teknisi1Show"
                                                            style="border-color:#9ca0a7;">
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <span class="text-xs">Teknisi 2</span>
                                                        <select class="form-control form-control-sm" type="text" id="teknisi2Show" name="teknisi2Show"
                                                            style="border-color:#9ca0a7;">
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <span class="text-xs">Teknisi 3</span>
                                                        <select class="form-control form-control-sm" type="text" id="teknisi3Show" name="teknisi3Show"
                                                            style="border-color:#9ca0a7;">
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <span class="text-xs">Teknisi 4</span>
                                                        <select class="form-control form-control-sm" type="text" id="teknisi4Show" name="teknisi4Show"
                                                            style="border-color:#9ca0a7;">
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
                                                            <input class="form-control form-control-sm" type="date" value="{{ date('Y-m-d') }}" id="tglProgressStatusShow"
                                                                name="tglProgressStatusShow" style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Slot Time Aplikasi</span>
                                                            <select class="form-control form-control-sm" type="text" id="slotTimeAPKStatusShow" disabled
                                                                name="slotTimeAPKStatusShow" style="border-color:#9ca0a7;">
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
                                                                <option value="20:30">20:30</option>
                                                                <option value="21:00">21:00</option>
                                                                <option value="21:30">21:30</option>
                                                                <option value="22:00">22:00</option>
                                                                <option value="22:30">22:30</option>
                                                                <option value="23:00">23:00</option>
                                                                <option value="23:30">23:30</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Checkin Aplikasi</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="text" id="tglCheckinApk" name="tglCheckinApk"
                                                                style="border-color:#9ca0a7;" required>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Checkout Aplikasi</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="text" id="tglCheckoutApk" name="tglCheckoutApk"
                                                                style="border-color:#9ca0a7;" required oninvalid="this.setCustomValidity('Wajib diisi')"
                                                                oninput="this.setCustomValidity('')"/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Status WO Aplikasi</span>
                                                        <span class="text-danger">*</span>
                                                        <select class="form-control form-control-sm" type="text" id="statusWoApk" name="statusWoApk"
                                                            style="border-color:#9ca0a7;">
                                                            <option value="" disabled selected>Pilih Status WO</option>
                                                            <option value="Requested">Requested</option>
                                                            <option value="Checkin">Checkin</option>
                                                            <option value="Checkout">Checkout</option>
                                                            <option value="Done">Done</option>
                                                            <option value="Pending">Pending</option>
                                                            <option value="Cancelled">Cencelled</option>
                                                        </select>
                                                    </div>

                                                    <div class="col form-group mb-1">
                                                        <span class="text-xs">Status WO</span>
                                                        <span class="text-danger">*</span>
                                                        <select class="form-control form-control-sm" type="text"
                                                            id="statusWo" name="statusWo"
                                                            style="border-color:#9ca0a7;" required oninvalid="this.setCustomValidity('Wajib diisi')" oninput="this.setCustomValidity('')">
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
                                                            <span class="text-xs">Penagihan</span>
                                                            <select class="form-control form-control-sm"
                                                                type="text" id="penagihanShow"
                                                                name="penagihanShow" style="border-color:#9ca0a7;">
                                                                <option value="New Installation" selected>New Installation</option>
                                                            </select>
                                                        </div> --}}

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Rootcause Penagihan</span>
                                                            <span class="text-danger">*</span>
                                                            <select type="text" class="form-control form-control-sm" id="rootCausePenagihan" name="rootCausePenagihan"
                                                                style="border-color:#9ca0a7;" required oninvalid="this.setCustomValidity('Wajib diisi')"
                                                                oninput="this.setCustomValidity('')">
                                                            </select>
                                                        </div>

                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Reason Status</span>
                                                            <span class="text-danger">*</span>
                                                            <input type="text" class="form-control form-control-sm" id="reasonStatus" name="reasonStatus"
                                                                style="border-color:#9ca0a7;" readonly>
                                                            {{-- </select> --}}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Permintaan Reschedule</span>
                                                            <select class="form-control form-control-sm" type="text" id="permintaan_reschedule" name="permintaan_reschedule"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="" disabled selected>Pilih Permintaan Reschedule</option>
                                                                <option value="Customer">Customer</option>
                                                                <option value="Dispatch">Dispatch</option>
                                                                <option value="Leader">Leader</option>
                                                                <option value="Teknisi">Teknisi</option>
                                                            </select>
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
                                                            <span class="text-xs">Respon Konfirmasi Customer</span>
                                                            <span class="text-danger">*</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="respon_konf_cst" name="respon_konf_cst"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="" disabled selected>Pilih Respon Konfirmasi Cst</option>
                                                                <option value="Respon">Respon</option>
                                                                <option value="Tidak Respon">Tidak Respon</option>
                                                            </select>
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Jawaban Konfirmasi Customer</span>
                                                            <span class="text-danger">*</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="jawaban_konf_cst" name="jawaban_konf_cst"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="" disabled selected>Pilih Jawaban Konfirmasi Cst</option>
                                                                <option value="Setuju">Setuju</option>
                                                                <option value="Tidak Setuju">Tidak Setuju</option>
                                                                <option value="Tidak Respon">Tidak Respon</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Tanggal Penjadwalan
                                                                Ulang</span>
                                                            <input class="form-control form-control-sm" type="date" id="tglReschedule" name="tglReschedule"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Jam Penjadwalan Ulang</span>
                                                            <select class="form-control form-control-sm" type="text" id="jamReschedule" name="jamReschedule"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="" disabled selected>Pilih Jam</option>
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
                                                    <span class="text-xs">Detail Alasan</span>
                                                    <textarea class="form-control form-control-sm" type="text" id="detailAlasan" name="detailAlasan" rows="4"
                                                        style="border-color:#9ca0a7;"></textarea>
                                                </div>
                                            </div>

                                            <div class="col">

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
                                                                id="telp_dispatch" name="telp_dispatch"
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Status Checkin</span>
                                                            <input class="form-control form-control-sm" type="text" id="statusCheckin" name="statusCheckin"
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">+/- Menit</span>
                                                            <input class="form-control form-control-sm" type="text" id="statusCheckinMenit" name="statusCheckinMenit"
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Waktu Instalasi</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="text" id="waktuInstallation" name="waktuInstallation"
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Start IKR (WA)</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="start_ikr_wa" name="start_ikr_wa"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">End IKR (WA)</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="end_ikr_wa" name="end_ikr_wa"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                {{-- <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Jam Teknisi Foto Rumah</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="jam_tek_foto_rmh" name="jam_tek_foto_rmh"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Jam Respon Dispatch</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="jam_dispatch_respon_foto" name="jam_dispatch_respon_foto"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Durasi Respon Foto Rumah</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="durasi_dispatch_respon_foto" name="durasi_dispatch_respon_foto"
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Jam Aktivasi Perangkat</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="jam_teknisi_aktifasi_perangkat" name="jam_teknisi_aktifasi_perangkat"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Jam Respon Aktivasi</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="jam_dispatch_respon_aktifasi_perangkat" name="jam_dispatch_respon_aktifasi_perangkat"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Durasi Respon Aktivasi</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="durasi_dispatch_respon_aktifasi_perangkat" name="durasi_dispatch_respon_aktifasi_perangkat"
                                                                style="border-color:#9ca0a7;" readonly>
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                {{-- <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">OTP Start</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="otp_start" name="otp_start"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">OTP End</span>
                                                            <input class="form-control form-control-sm" type="text"
                                                                id="otp_end" name="otp_end"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Port FAT</span>
                                                            <span class="text-danger">*</span>
                                                            <input class="form-control form-control-sm" type="text" id="portFATProgress" name="portFATProgress"
                                                                style="border-color:#9ca0a7;" required oninvalid="this.setCustomValidity('Wajib diisi')"
                                                                oninput="this.setCustomValidity('')">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <div class="row">
                                                                <div class="col form-group  mb-1">
                                                                    <span class="text-xs">Penggunaan Material</span>
                                                                    <div class="input-group input-group-sm">
                                                                        <input id="statusMaterial" name="statusMaterial" style="border-color:#9ca0a7;" type="text"
                                                                            class="form-control form-control-sm" readonly>
                                                                        <button class="btn btn-sm btn-outline-secondary mb-0" type="button" id="detail-materialStatus">...</button>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="materialOut">
                                                                <input type="hidden" name="materialIn">
                                                                {{-- <div class="col form-group mb-1">
                                                                    <span class="text-xs">Jumlah Material</span>
                                                                    <span class="text-danger"></span>
                                                                    <input class="form-control form-control-sm" type="text" id="jumlahMaterial" name="jumlahMaterial"
                                                                        style="border-color:#9ca0a7;" readonly>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Validasi Start</span>
                                                            <input class="form-control form-control-sm" type="time" value="{{ date('H:i') }}"
                                                                id="validasi_start" name="validasi_start"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Validasi End</span>
                                                            <input class="form-control form-control-sm" type="time" value="{{ date('H:i') }}"
                                                                id="validasi_end" name="validasi_end"
                                                                style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Start Regist</span>
                                                            <input class="form-control form-control-sm" type="time" value="{{ date('H:i') }}" id="start_regist"
                                                                name="start_regist" style="border-color:#9ca0a7;">
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">End Regist</span>
                                                            <input class="form-control form-control-sm" type="time" value="{{ date('H:i') }}" id="end_regist"
                                                                name="end_regist" style="border-color:#9ca0a7;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Report Teknisi</span>
                                                    <textarea class="form-control form-control-sm" type="text" id="remarksTeknisi" name="remarksTeknisi" rows="4"
                                                        style="border-color:#9ca0a7;"></textarea>
                                                </div>

                                                <div class="form-group mt-3">
                                                    <div class="form-check">
                                                        <input type="hidden" name="is_checked" value="0"> <!-- Default jika tidak dicentang -->
                                                        <input class="form-check-input" type="checkbox" name="is_checked" value="1" id="isChecked">
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
                                                                value="" id="merkStbIn" name="merkStbIn"
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

        @include('monitoringWo.modal-ib.detail-material')
        @include('monitoringWo.modal-ib.edit-material')

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

<script type="text/javascript">
    let firstDate;
    let lastDate;
    let dataFtthIB = "";

    $('.date-range').daterangepicker();
    //set date rangepicker value empty after load
    $('.date-range').val("");
</script>


<script>
    $(document).ready(function() {
        var _token = $('meta[name=csrf-token]').attr('content');
        var firstDate;
        var lastDate;
        var stDate;
        var enDate;
        var listPenagihan = {!! $penagihanIB !!};
        var dtDispatch = {!! $dtDispatch !!}

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

            $('#telp_dispatch').val(filDispatch[0].telp_dispatch);
        })

        $(document).on('change', '#filarea', function() {
            $('#filGroup').val('');
        })

        $(document).on('change', '#filGroup', function() {
            $('#filarea').val('');
        })

        $(document).on('change', '#statusWo', function(e) {
            $('#rootCausePenagihan').find('option').remove();
            $('#rootCausePenagihan').append(`
                <option value="">--Pilih Rootcause Penagihan--</option>`
            );

            filListPenagihan = listPenagihan.filter(k => k.status == $(this).val());

            $.each(filListPenagihan, function(k,cc) {
                $('#rootCausePenagihan').append(
                    `<option value="${cc.penagihan}">${cc.penagihan}</option>`
                );
            })
        })

        $(document).on('change', '#rootCausePenagihan', function(e) {
            if($('#statusWo').val() == "Done") {
                $('#reasonStatus').val("Close");
            } else {
                $('#reasonStatus').val($('#rootCausePenagihan').val());
            }

        })

        $(document).on('click', '#filAssignTim', function(e) {

            stDate = $('.date-range').data('daterangepicker').startDate.format("DD-MMM-YYYY");
            enDate = $('.date-range').data('daterangepicker').endDate.format("DD-MMM-YYYY");

            get_summary();
            get_data_assignTim_ib();

            //link import apk default
            let newLink = "{{ route('importDataFtthIbApk') }}"
            let newLinkMaterial = "{{ route('importIbMaterial') }}"
            // document.getElementById('importApkButton').href = newlink

            let params = {
                filTgl: $('#filtglProgress').val(),
                areaFill: $('#filarea').val(),
                areagroup: $('#filGroup').val()
            };

            let queryString = Object.keys(params)
                .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(params[key]))
                .join('&');

            document.getElementById('importApkButton').href = newLink + '?' + queryString
            document.getElementById('importIbMaterialButton').href = newLinkMaterial + '?' + queryString

        })

        $('#filAssignTim').trigger("click");

        //Export Excel
        $(document).on('click', '#exportButton', function(e) {
            e.preventDefault();
            var url = '{{ route("ftth-ib.export") }}';
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
                url: "{{ route('getSummaryWOIb') }}",
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

        function get_data_assignTim_ib() {
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
                    url: "{{ route('getDataIBOris') }}",
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
                        data: 'reason_status'
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
                        data: "is_confirmation", // Gunakan data dari server
                        render: function (data, type, row) {
                            // Jika is_confirmation = 1, checkbox dicentang
                            var checked = data == 1 ? "checked" : "";
                            return `<div class="form-check">
                                    <input type="checkbox" id="pilih" class="form-check-input mx-1 confirmation-checkbox"
                                    name="chkbx" data-id="${row.id}" ${checked}>
                            </div>`;
                        }
                    },

                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })

            // Event listener untuk "Pilih Semua"
            $('#select-all').on('change', function () {
                var checked = $(this).prop('checked');

                // Update semua checkbox di dalam DataTables
                $('#tabelAssignTim tbody input[name="chkbx"]').prop('checked', checked);
            });

            // Event listener untuk tombol "Konfirmasi Pengecekan"
            $('#get-selected').on('click', function () {
                var selectedData = [];

                $('#tabelAssignTim tbody input[name="chkbx"]').each(function () {
                    var row = $(this).closest('tr');
                    var data = data_assignTim.row(row).data();
                    var isChecked = $(this).prop('checked') ? 1 : 0; // 1 jika checked, 0 jika unchecked

                    selectedData.push({
                        id: data.id,
                        is_confirmation: isChecked
                    });
                });

                console.log(selectedData); // Pastikan data benar sebelum dikirim

                $.ajax({
                    url: "/update-confirmation", // Ganti dengan URL update Laravel
                    type: "POST",
                    contentType: "application/json", // Pastikan dikirim sebagai JSON
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}" // Kirim token di header
                    },
                    data: JSON.stringify({ data: selectedData }), // Kirim seluruh array dalam format JSON
                    success: function (response) {
                        console.log("Update berhasil!", response);
                        data_assignTim.ajax.reload(null, false); // Reload DataTables
                    },
                    error: function (xhr, status, error) {
                        console.error("Gagal memperbarui data:", xhr.responseText);
                    }
                });
            });

        }


        $(document).on('change', '#callsignTimidShow', function (e) {

            ctim = $(this).val().split("|");
            ctimTeknisi = callTim.find(k => k.callsign === ctim[1]);

            let selectTek1 = $('#teknisi1Show');
            let selectTek2 = $('#teknisi2Show');
            let selectTek3 = $('#teknisi3Show');
            let selectTek4 = $('#teknisi4Show');

            selectTek1.val(ctimTeknisi.tek1_nik + "|" + ctimTeknisi.teknisi1 || "");
            selectTek2.val(ctimTeknisi.tek2_nik + "|" + ctimTeknisi.teknisi2 || "");
            selectTek3.val(ctimTeknisi.tek3_nik + "|" + ctimTeknisi.teknisi3 || "");
            selectTek4.val(ctimTeknisi.tek4_nik + "|" + ctimTeknisi.teknisi4 || "");

        });

        $(document).on('click', '#detail-assign', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let assign_id = $(this).data('id');


            $.ajax({
                url: "{{ route('getDetailWOFtthIB') }}",
                type: "get",
                data: {
                    filAssignId: assign_id,
                    _token: _token
                },
                success: function(response) {
                    console.log('Respons dari API:', response);

                    let dtDis = response.data;
                    let material = response.ftth_ib_material;
                    let callsignTims = response.callsign_tims;
                    let callsignLeads = response.callsign_leads;
                    let teknisiOn = response.teknisiOn;
                    callTim = response.assignTim;
                    isiDispatch();

                    if (response.ftth_ib_material.length > 0) {
                        materialOut = response.ftth_ib_material.filter(k => k.status_item == "OUT");
                        materialIn = response.ftth_ib_material.filter(i => i.status_item == "IN");

                        // Mengisi nilai ke input materialOut dan materialIn
                        $('input[name="materialOut"]').val(materialOut.length || 0); // Default 0 jika materialOut kosong
                        $('input[name="materialIn"]').val(materialIn.length || 0);   // Default 0 jika materialIn kosong

                        // statMaterial = "Ada | " + response.ftth_ib_material.length
                        statMaterial = "Terpasang = " + materialOut.length + " | Dikembalikan = " + materialIn.length;

                    } else {
                        statMaterial = "Tidak Ada";
                        // Jika tidak ada data, isi input dengan nilai default 0
                        $('input[name="materialOut"]').val(0);
                        $('input[name="materialIn"]').val(0);
                    }

                    // Populasi dropdown Lead Callsign
                    let selectLead = $('#LeadCallsignShow');
                    selectLead.empty().append('<option value="">Pilih Lead Callsign</option>');

                    callsignLeads.forEach(item => {
                        selectLead.append(`<option value="${item.id}|${item.lead_callsign}|${item.leader_id}|${item.nama_karyawan}">${item.lead_callsign} | ${item.nama_karyawan} </option>`);
                    });

                    // Atur nilai dropdown Lead Callsign sesuai dengan `leadcall_id`
                    if (dtDis.leadcall_id) {
                        selectLead.val(dtDis.leadcall_id + "|" + dtDis.leadcall + "|" + dtDis.leader_id + "|" + dtDis.leader);
                    }

                    // Populasi dropdown Callsign Tim
                    let selectTim = $('#callsignTimidShow');
                    selectTim.empty().append('<option value="">Pilih Callsign Tim</option>');
                    callsignTims.forEach(item => {
                        selectTim.append(`<option value="${item.id}|${item.callsign_tim}">${item.callsign_tim}</option>`);
                    });
                    selectTim.val(dtDis.callsign_id + "|" + dtDis.callsign);

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

                    selectTek1.val(dtDis.tek1_nik + "|" + dtDis.teknisi1 || "");
                    selectTek2.val(dtDis.tek2_nik + "|" + dtDis.teknisi2 || "");
                    selectTek3.val(dtDis.tek3_nik + "|" + dtDis.teknisi3 || "");
                    selectTek4.val(dtDis.tek4_nik + "|" + dtDis.teknisi4 || "");


                    $('#detId').val(dtDis.id)
                    $('#noWoShow').val(dtDis.no_wo);
                    $('#ticketNoShow').val(dtDis.no_ticket)
                    $('#woTypeShow').val(toTitleCase(dtDis.wo_type_apk || ""));
                    $('#jenisWoShow').val(dtDis.type_wo);
                    $('#WoDateShow').val(dtDis.wo_date_apk)
                    $('#custIdShow').val(dtDis.cust_id)
                    $('#custNameShow').val(toTitleCase(dtDis.nama_cust))
                    // $('#custPhoneShow').val(dtDis.cust_phone)

                    // $('#custMobileShow').val(dtDis.cust_mobile);
                    $('#custAddressShow').val(toTitleCase(dtDis.cust_address1 || "" ));
                    $('#areaShow').val(toTitleCase(dtDis.cluster || "" ));
                    // $('#ikrDateApkShow').val(dtDis.ikr_date);
                    $('#timeApkShow').val(dtDis.time);
                    $('#fatCodeShow').val(dtDis.kode_fat);
                    $('#portFatShow').val(dtDis.port_fat);
                    $('#portFATProgress').val(dtDis.port_fat);
                    $('#remarksShow').val(toTitleCase(dtDis.type_maintenance || "" ));

                    $('#branchShow').val(dtDis.branch);
                    $('#tglProgressStatusShow').val(dtDis.tgl_ikr);

                    $('#sesiShow').val(toTitleCase(dtDis.sesi || ""));
                    $('#slotTimeLeaderShow').val(dtDis.slot_time_leader);
                    $('#slotTimeAPKShow').val(dtDis.slot_time_apk);

                    $('#slotTimeLeaderStatusShow').val(dtDis.slot_time_leader);
                    $('#slotTimeAPKStatusShow').val(dtDis.slot_time_apk);
                    $('#weatherShow').val(dtDis.weather);

                    $('#tglCheckinApk').val(dtDis.checkin_apk);
                    $('#tglCheckoutApk').val(dtDis.checkout_apk);
                    $('#tglProgressStatusShow').trigger("change");
                    $('#jamReschedule').val(dtDis.tgl_jam_reschedule);
                    $('#tglReschedule').val(dtDis.tgl_reschedule);

                    if(dtDis.is_checked == 1) {
                        $('#isChecked').prop('checked', true); //1
                        $('#is_checked').val(dtDis.is_checked);
                        $('#picName').html('Sudah dicek (PIC. ' + dtDis.pic_monitoring + ')');
                    } else {
                        $('#isChecked').prop('checked', false); //1
                        $('#is_checked').val(dtDis.is_checked);
                        $('#picName').html('Sudah dicek (PIC. ' + response.akses + ')');
                    }

                    $('#remarksTeknisi').val(dtDis.remarks_teknisi);
                    $('#detailAlasan').val(dtDis.detail_alasan);
                    $('#alasanCancel').val(dtDis.alasan_cancel);
                    $('#alasanPending').val(dtDis.alasan_pending);

                    $('#telp_dispatch').val(dtDis.telp_dispatch);
                    $('#picDispatch').val(toTitleCase(dtDis.nama_dispatch || ""));
                    $('#validasi_start').val(dtDis.validasi_start);
                    $('#validasi_end').val(dtDis.validasi_end);

                    $('#start_regist').val(dtDis.start_regist);
                    $('#end_regist').val(dtDis.end_regist);
                    $('#statusMaterial').val(statMaterial);

                    $('#respon_konf_cst').val(dtDis.respon_konf_cst);
                    $('#jawaban_konf_cst').val(dtDis.jawaban_konf_cst);
                    $('#permintaan_reschedule').val(dtDis.permintaan_reschedule);
                    $('#start_ikr_wa').val(dtDis.start_ikr_wa);
                    $('#end_ikr_wa').val(dtDis.end_ikr_wa);

                    $('#jam_teknisi_aktifasi_perangkat').val(dtDis.jam_teknisi_aktifasi_perangkat);
                    $('#jam_dispatch_respon_aktifasi_perangkat').val(dtDis.jam_dispatch_respon_aktifasi_perangkat);
                    $('#jam_tek_foto_rmh').val(dtDis.jam_tek_foto_rmh);
                    $('#jam_dispatch_respon_foto').val(dtDis.jam_dispatch_respon_foto);

                    $('#otp_start').val(dtDis.otp_start);
                    $('#otp_end').val(dtDis.otp_end);
                    $('#status_checkin').val(dtDis.status_checkin);

                    $('#leaderShow').val(dtDis.leader);
                    $('#statusWo').val(toTitleCase(dtDis.status_wo || ""));
                    $('#statusWo').trigger("change");
                    $('#reasonStatus').val(dtDis.reason_status);
                    $('#statusWoApk').val(toTitleCase(dtDis.status_apk || ""));
                    $('#isChecked').prop('checked', dtDis.is_checked == 1);

                    $('#causeCode').val(dtDis.couse_code);
                    $('#rootCause').val(dtDis.root_couse);
                    $('#actionTaken').val(dtDis.action_taken);
                    $('#rootCausePenagihan').val(dtDis.penagihan);

                    $('#snOntOut').val(material.sn_ont_out);
                    $('#macOntOut').val(material.mac_ont_out);
                    $('#macOntIn').val(material.mac_ont_in);
                    $('#merkOntIn').val(material.merk_ont_in);
                    $('#merkStbOut').val(material.stb_merk_out);
                    $('#merkStbIn').val(material.stb_merk_in);
                    $('#kabelPrecon').val(material.precon_out);
                    $('#snOntIn').val(material.sn_ont_in);

                    $('#showAssignTim').modal('show');


                }
            })
        })

        $(document).on('change', '#tglProgressStatusShow', function (e) {
            tgl = $('#tglProgressStatusShow').val();
            jm = $('#slotTimeAPKStatusShow').val();
            status = "";

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

            if (!isNaN(tglJmCheckin)) {
                stat = (tglJmCheckin - tglJmSlotTime) / 60000;

                if (stat < -15) {
                    status = "Lebih Awal"
                } else if (stat <= -1 && stat >= -15) {
                    status = "On Time"
                } else if (stat > 0) {
                    status = "Terlambat"
                }

            } else {
                stat = 0;
            }

            if (!isNaN(tglJmCheckOut) && !isNaN(tglJmCheckin)) {
                wktInstall = timeDistance(tglJmCheckOut, tglJmCheckin);
            } else {
                wktInstall = "0"
            }

            $('#statusCheckin').val(status);
            $('#statusCheckinMenit').val(stat.toFixed(0));
            $('#waktuInstallation').val(wktInstall);

        })

        $(document).on('click', '#detail-materialStatus', function (e) {
            e.preventDefault();
            $('#detail-material').trigger('click', [$('#detId').val()]);
        })

        $('.updateFtthIb').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('updateFtthIb') }}",
                type: "get",
                data: $(this).serialize(),
                success: function(obj) {
                    console.log('obj : ', obj);
                    if(obj=="success"){
                        $('#showAssignTim').modal('hide');

                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Berhasil update Data Monitoring",
                            showConfirmButton: true,
                            // timer: 2000
                        });

                        $('#tabelAssignTim').DataTable().ajax.reload();
                        // $('#filAssignTim').trigger("click");
                    } else {
                        $('#showAssignTim').modal('hide');

                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: obj,
                            showConfirmButton: true,
                            // timer: 2000
                        });

                        $('#tabelAssignTim').DataTable().ajax.reload();
                        // $('#filAssignTim').trigger("click");
                    }
                }
            });
        });

        $(document).on('click', '#detail-material', function(e, detid) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let assign_id
            if (!detid) {
                assign_id = $(this).data('id');
            } else {
                assign_id = detid;
            }

            $.ajax({
                url: "{{ route('getMaterialFtthIb') }}",
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

        $(document).on('click', '#edit-material', function (e) {
            var _token = $('meta[name=csrf-token]').attr('content');
            let assign_id = $(this).data('id');

            $.ajax({
                url: "{{ route('editMaterialFtthIb') }}",
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
    })
</script>
