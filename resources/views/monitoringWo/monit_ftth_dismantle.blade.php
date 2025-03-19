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
                            <h3 class="text-white mb-2">Monitoring WO FTTH Dismantle</h3>
                            <p class="mb-4 font-weight-semibold">
                                PT. Mitra Sinergi Telematika.
                            </p>
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

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Grup</span>
                                        <select class="form-control form-control-sm select2" id="filGroup" name="filGroup" style="border-color:#9ca0a7;">
                                            @if (isset($areagroup))
                                                <option value="" {{ "" == $areagroup ? 'selected' : ''}}>Pilih Grup</option>
                                                <option value="Jakarta" {{ "Jakarta" == $areagroup ? 'selected' : ''}}>Jakarta</option>
                                                <option value="Jabo" {{ "Jabo" == $areagroup ? 'selected' : ''}}>Jabo</option>
                                                <option value="Regional" {{ "Regional" == $areagroup ? 'selected' : ''}}>Regional</option>
                                            @else
                                                <option value="">Pilih Grup</option>
                                                <option value="Jakarta">Jakarta</option>
                                                <option value="Jabo">Jabo</option>
                                                <option value="Regional">Regional</option>
                                            @endif

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
                                        <p class="text-sm text-secondary mb-0" style="font-size: 0.65rem;">Total Dismantle</p>
                                        <h5 class="mb-2 font-weight-bold" id="totTotal"></h5>
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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Data FTTH Dismantle</span>
                                    </h6>
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
                                    <a href="{{ route('importFtthDismantle') }}">
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
                                    <a href="{{ route('importMaterialDismantle') }}">
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
                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="tableDismantle" style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Tanggal</th>
                                            <th class="text-center text-xs font-weight-semibold">No WO</th>
                                            <th class="text-center text-xs font-weight-semibold">WO Date</th>
                                            <th class="text-center text-xs font-weight-semibold">Cust Id</th>
                                            <th class="text-center text-xs font-weight-semibold">Cust Name</th>
                                            <th class="text-center text-xs font-weight-semibold">Type WO</th>
                                            <th class="text-center text-xs font-weight-semibold">Fat Code</th>
                                            <th class="text-center text-xs font-weight-semibold">Cluster</th>
                                            <th class="text-center text-xs font-weight-semibold">Area</th>
                                            <th class="text-center text-xs font-weight-semibold">Slot Time</th>
                                            <th class="text-center text-xs font-weight-semibold">Callsign Tim</th>
                                            <th class="text-center text-xs font-weight-semibold">Leader</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 1</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 2</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 3</th>
                                            <th class="text-center text-xs font-weight-semibold">Status APK</th>
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
            <div class="modal fade" id="showDetail" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
                data-bs-backdrop="static">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="titleModalIB">Detail Progress WO FTTH Dismantle</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- <form action="{{ route('updateSignTim') }}" method="post" enctype="multipart/form-data"> --}}
                            <form action="{{ route('updateFtthDismantle') }}" method="post" enctype="multipart/form-data">

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
                                                                    <option value="FTTH Dismantle">FTTH Dismantle</option>
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
                                                            type="text" id="cluster" name="cluster"
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
                                                        <textarea class="form-control form-control-sm" type="text" id="remarkStatus" name="remarkStatus"
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
                                                                    id="tglProgressShow"
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
                                                                <select class="form-control form-control-sm" id="callsignTimidShow" name="callsignTimidShow"
                                                                    style="border-color:#9ca0a7;">
                                                                    <option value="">Pilih Callsign Tim</option>
                                                                </select>
                                                                <input type="hidden" id="callsignTimShow" name="callsignTimShow">
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
                                                                <span class="text-xs">Tanggal Progress Aplikasi</span>
                                                                <input class="form-control form-control-sm" type="date" id="tglProgressAPKShow"
                                                                    name="tglProgressAPKShow" style="border-color:#9ca0a7;">
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
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-1" style="display: none;">
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
                                                                    type="text" id="slotTimeLeaderStatusShow" disabled
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

                                                    <div class="form-group mb-1">
                                                        <div class="row">
                                                            <div class="col form-group mb-1">
                                                                <span class="text-xs">Checkin Aplikasi</span>
                                                                <input class="form-control form-control-sm" type="text" value="" id="tglCheckinApk" name="tglCheckinApk"
                                                                    style="border-color:#9ca0a7;">
                                                            </div>

                                                            <div class="col form-group mb-1">
                                                                <span class="text-xs">Checkout Aplikasi</span>
                                                                <input class="form-control form-control-sm" type="text" value="" id="tglCheckoutApk" name="tglCheckoutApk"
                                                                    style="border-color:#9ca0a7;">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Status WO Aplikasi</span>
                                                            <select class="form-control form-control-sm" type="text" id="statusWoApk" name="statusWoApk"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="">Pilih Status WO APK</option>
                                                                <option value="Requested">Requested</option>
                                                                <option value="Checkin">Checkin</option>
                                                                <option value="Checkout">Checkout</option>
                                                                <option value="Done">Done</option>
                                                                <option value="Pending">Pending</option>
                                                                <option value="Cancelled">Cancelled</option>
                                                            </select>
                                                        </div>
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Status WO</span>
                                                            <select class="form-control form-control-sm" type="text" id="statusWo" name="statusWo"
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
                                                                <span class="text-xs">Rootcause Penagihan</span>
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
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <div class="row">
                                                            <div class="col form-group mb-1">
                                                                <span class="text-xs">Tanggal Dismantle Port</span>
                                                                <input type="date" class="form-control form-control-sm" id="tglDismantlePort" name="tglDismantlePort"
                                                                    style="border-color:#9ca0a7;">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <div class="row">
                                                            <div class="col form-group mb-1">
                                                                <span class="text-xs">Tarik Kabel DW</span>
                                                                <select class="form-control form-control-sm" type="text" id="tarik_cable" name="tarik_cable"
                                                                    style="border-color:#9ca0a7;">
                                                                    <option value="" disabled selected>Pilih Tarik Kabel DW</option>
                                                                    <option value="Ditarik">Ditarik</option>
                                                                    <option value="Tidak Ditarik">Tidak Ditarik</option>
                                                                </select>
                                                            </div>
                                                            <div class="col form-group mb-1">
                                                                <span class="text-xs">Alasan Tidak Rollback</span>
                                                                <input class="form-control form-control-sm" type="text" id="alasan_no_rollback" name="alasan_no_rollback"
                                                                    style="border-color:#9ca0a7;">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <div class="row">
                                                            <div class="col form-group mb-1">
                                                                <span class="text-xs">Action Status</span>
                                                                <select class="form-control form-control-sm" type="text" id="actionStatus" name="actionStatus"
                                                                    style="border-color:#9ca0a7;">
                                                                    <option value="" disabled selected>-- Pilih --</option>
                                                                    <option value="Sudah dikerjakan MST">Sudah dikerjakan MST</option>
                                                                    <option value="Sign Ulang">Sign Ulang</option>
                                                                    <option value="Tunggu Konfirmasi">Tunggu Konfirmasi</option>
                                                                </select>
                                                            </div>
                                                            <div class="col form-group mb-1">
                                                                <span class="text-xs">Kondisi Cuaca</span>
                                                                <select class="form-control form-control-sm" type="text" id="weatherShow" name="weatherShow"
                                                                    style="border-color:#9ca0a7;">
                                                                    <option value="" disabled selected>Pilih Cuaca</option>
                                                                    <option value="Cerah">Cerah</option>
                                                                    <option value="Hujan">Hujan</option>
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
                                                    <div class="col form-group mb-1">
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

                                                    <div class="form-group mb-1">
                                                        <div class="row">
                                                            <div class="col form-group mb-1">
                                                                <span class="text-xs">Start</span>
                                                                <input class="form-control form-control-sm" type="text" id="start" name="start"
                                                                    style="border-color:#9ca0a7;">
                                                            </div>
                                                            <div class="col form-group mb-1">
                                                                <span class="text-xs">Finish</span>
                                                                <input class="form-control form-control-sm" type="text" id="finish" name="finish"
                                                                    style="border-color:#9ca0a7;">
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
                                                                <span class="text-xs">MS Reguler</span>
                                                                <input class="form-control form-control-sm" readonly value="Manage Service" type="text" id="ms_regular" name="ms_regular"
                                                                    style="border-color:#9ca0a7;">
                                                            </div>
                                                            <div class="col form-group mb-1">
                                                                <span class="text-xs">Takeout/No Takeout Port</span>
                                                                <select class="form-control form-control-sm" type="text" id="takeout_notakeout" name="takeout_notakeout"
                                                                    style="border-color:#9ca0a7;">
                                                                    <option value="" disabled selected>Pilih Takeout/No Takeout</option>
                                                                    <option value="Takeout">Takeout</option>
                                                                    <option value="No Takeout">No Takeout</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <div class="row">
                                                            <div class="col form-group mb-1">
                                                                <span class="text-xs">PIC Dispatch</span>
                                                                <select class="form-control form-control-sm" type="text" id="picDispatch" name="picDispatch"
                                                                    style="border-color:#9ca0a7;">
                                                                    <option value=""></option>
                                                                </select>
                                                            </div>
                                                            <div class="col form-group mb-1">
                                                                <span class="text-xs">Telp Dispatch</span>
                                                                <input class="form-control form-control-sm" type="text" id="telp_dispatch" name="telp_dispatch"
                                                                    style="border-color:#9ca0a7;" readonly>
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
                                                                            <button class="btn btn-sm btn-outline-secondary mb-0" type="button"
                                                                                id="detail-materialStatus">...</button>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="materialOut">
                                                                    <input type="hidden" name="materialIn">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-1">
                                                        <div class="row">
                                                            <div class="col form-group mb-1">
                                                                <span class="text-xs">Detail Alasan</span>
                                                                <textarea class="form-control form-control-sm" type="text" id="detailAlasan" name="detailAlasan"
                                                                    style="border-color:#9ca0a7;"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mt-4 float-end">
                                                        <div class="form-check">
                                                            <input type="hidden" name="is_checked" value="0"> <!-- Default jika tidak dicentang -->
                                                            <input class="form-check-input" type="checkbox" name="is_checked" value="1" id="isChecked">
                                                            <label class="form-check-label" for="isChecked">
                                                                Sudah Dicek
                                                            </label>
                                                        </div>

                                                        <span class="text-xs text-bold">
                                                            ( {{Auth::user()->name}} )
                                                        </span>
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

            @include('monitoringWo.modal-dismantle.detail-material')
            @include('monitoringWo.modal-dismantle..edit-material')


            {{-- <x-app.footer /> --}}
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
                        data: 'main_branch'
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
        var listPenagihan = {!! $penagihanDismantle !!};
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

            $.each(dtDispatch, function (k, cc) {
                $('#picDispatch').append(
                    `<option value="${cc.nama_dispatch}">${cc.nama_dispatch}</option>`
                )
            })
        }

        $(document).on('change', '#picDispatch', function (e) {
            filDispatch = dtDispatch.filter(k => k.nama_dispatch === $(this).val());

            $('#telp_dispatch').val(filDispatch[0].telp_dispatch);
        })

        $(document).on('change', '#statusWo', function (e) {
            $('#rootCausePenagihan').find('option').remove();
            $('#rootCausePenagihan').append(`
                <option value="">--Pilih Rootcause Penagihan--</option>`
            );

            filListPenagihan = listPenagihan.filter(k => k.status == $(this).val());

            $.each(filListPenagihan, function (k, cc) {
                $('#rootCausePenagihan').append(
                    `<option value="${cc.penagihan}">${cc.penagihan}</option>`
                );
            })
        })

        $(document).on('change', '#rootCausePenagihan', function (e) {
            $('#reasonStatus').val($('#rootCausePenagihan').val());
        });

        $(document).on('click', '#filAssignTim', function(e) {
            get_data_assignTim();
            get_summary();
            stDate = $('.date-range').data('daterangepicker').startDate.format("DD-MMM-YYYY");
            enDate = $('.date-range').data('daterangepicker').endDate.format("DD-MMM-YYYY");

            let params = {
                filTgl: $('#filtglProgress').val(),
                areaFill: $('#filarea').val(),
                areagroup: $('#filGroup').val()
            };
        })

        $('#filAssignTim').trigger("click");

        //Export Excel
        $(document).on('click', '#exportButton', function(e) {
            e.preventDefault();
            var url = '{{ route("ftth-dismantle.export") }}';
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
            let typeSum = "Ftth Dismantle";

            $.ajax({
                url: "{{ route('getSummaryWODismantle') }}",
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
            var data_assignTim = $('#tableDismantle').DataTable({
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
                    url: "{{ route('getFtthDismantle') }}",
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
                        data: 'visit_date',
                        // width: '90'
                    },
                    {
                        data: 'no_wo'
                    },
                    {
                        data: 'wo_date'
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
                        data: 'main_branch'
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
                        data: 'status_wo'
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
                url: "{{ route('getDetailFtthDismantle') }}",
                type: "get",
                data: {
                    filAssignId: assign_id,
                    _token: _token
                },
                success: function (response) {
                    console.log('Respons dari API:', response);

                    let dtDis = response.data;
                    let material = response.ftth_dismantle_material;
                    let callsignTims = response.callsign_tims;
                    let callsignLeads = response.callsign_leads;
                    let teknisiOn = response.teknisiOn;
                    callTim = response.assignTim;
                    isiDispatch();

                    if (response.ftth_dismantle_material.length > 0) {
                        materialIn = response.ftth_dismantle_material.filter(i => i.status_item == "IN");

                        // Mengisi nilai ke input materialOut dan materialIn
                        $('input[name="materialIn"]').val(materialIn.length || 0);   // Default 0 jika materialIn kosong

                        // statMaterial = "Ada | " + response.ftth_dismantle_material.length
                        statMaterial = "Dikembalikan = " + materialIn.length;

                    } else {
                        statMaterial = "Tidak Ada";
                        // Jika tidak ada data, isi input dengan nilai default 0
                        $('input[name="materialIn"]').val(0);
                    }

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

                    $('#titleModalIB').html('Detail Progress WO FTTH Dismantle - ' + dtDis.no_wo + ' | ' + dtDis.cust_id + ' | ' + dtDis.nama_cust)

                    $('#detId').val(dtDis.id);
                    $('#id_material').val(dtDis.id_material);
                    $('#noWoShow').val(dtDis.no_wo);
                    $('#tglProgressAPKShow').val(dtDis.visit_date);
                    $('#tglProgressShow').val(dtDis.visit_date);
                    $('#statusWo').val(toTitleCase(dtDis.status_wo || ""));
                    $('#statusWo').trigger("change");
                    $('#ticketNoShow').val(dtDis.no_ticket);
                    $('#woTypeShow').val(toTitleCase(dtDis.wo_type_apk || ""));
                    $('#jenisWoShow').val(dtDis.type_wo);
                    $('#WoDateShow').val(dtDis.wo_date);
                    $('#custIdShow').val(dtDis.cust_id);
                    $('#custNameShow').val(toTitleCase(dtDis.nama_cust || ""));
                    $('#custAddressShow').val(toTitleCase(dtDis.cust_address1 || ""));
                    $('#timeApkShow').val(dtDis.time);
                    $('#fatCodeShow').val(dtDis.kode_fat);
                    $('#portFatShow').val(dtDis.port_fat);
                    $('#statusMaterial').val(statMaterial);
                    $('#remarkStatus').val(toTitleCase(dtDis.remarkStatus || ""));
                    $('#tglReschedule').val(dtDis.reschedule_date);
                    $('#jamReschedule').val(dtDis.reschedule_time);
                    $('#branchShow').val(dtDis.main_branch);
                    $('#tglProgressStatusShow').val(dtDis.visit_date);
                    $('#sesiShow').val(toTitleCase(dtDis.sesi || ""));
                    $('#slotTimeLeaderShow').val(dtDis.slot_time_leader);
                    $('#slotTimeLeaderStatusShow').val(dtDis.slot_time_leader);
                    $('#leaderShow').val(dtDis.leader);
                    $('#slotTimeAPKShow').val(dtDis.slot_time_apk);
                    $('#statusWoApk').val(toTitleCase(dtDis.status_apk || ""));
                    $('#isChecked').prop('checked', dtDis.is_checked == 1);
                    $('#causeCode').val(dtDis.couse_code);
                    $('#rootCause').val(dtDis.root_couse);
                    $('#actionTaken').val(dtDis.action_taken);
                    $('#rootCausePenagihan').val(dtDis.penagihan);
                    $('#tglDismantlePort').val(dtDis.tgl_dismantle_port);
                    $('#reasonStatus').val(dtDis.reason_status);
                    $('#tglCheckinApk').val(dtDis.checkin_apk);
                    $('#tglCheckoutApk').val(dtDis.checkout_apk);
                    $('#tglProgressStatusShow').trigger("change");
                    $('#teknisi1Show').val(toTitleCase(dtDis.teknisi1 || ""));
                    $('#teknisi2Show').val(toTitleCase(dtDis.teknisi2 || ""));
                    $('#teknisi3Show').val(toTitleCase(dtDis.teknisi3 || ""));
                    $('#teknisi4Show').val(toTitleCase(dtDis.teknisi4 || ""));
                    $('#merkStbIn').val(dtDis.stb_merk_in);
                    $('#merkStbOut').val(dtDis.stb_merk_out);
                    $('#merkOntOut').val(dtDis.ont_merk_out);
                    $('#snStbIn').val(dtDis.stb_sn_in);
                    $('#snStbOut').val(dtDis.stb_sn_out);
                    $('#kabelPrecon').val(dtDis.precon_out);
                    $('#kabelPreconBad').val(dtDis.bad_precon);
                    $('#cluster').val(dtDis.cluster);

                    $('#alasan_no_rollback').val(toTitleCase(dtDis.alasan_no_rollback || ""));
                    $('#weatherShow').val(dtDis.weather);

                    $('#start').val(dtDis.start);
                    $('#finish').val(dtDis.finish);
                    $('#tarik_cable').val(dtDis.tarik_cable);
                    // $('#ms_regular').val(dtDis.ms_regular);

                    $('#slotTimeAPKStatusShow').val(dtDis.slot_time_apk);

                    $('#alasanTidakGantiPrecon').val(toTitleCase(dtDis.alasan_tidak_ganti_precon || ""));
                    $('#alasanPending').val(toTitleCase(dtDis.alasan_pending || ""));

                    $('#takeout_notakeout').val(toTitleCase(dtDis.takeout_notakeout || ""));
                    $('#reportTeknisi').val(toTitleCase(dtDis.remarks || ""));
                    $('#actionStatus').val(dtDis.action_status);

                    $('#telp_dispatch').val(dtDis.telp_dispatch);
                    $('#detailAlasan').val(dtDis.detail_alasan);
                    $('#picDispatch').val(toTitleCase(dtDis.pic_dispatch || ""));

                    $('#showDetail').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error('Gagal memuat data:', error);
                }
            });
        });

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

        $(document).on('click', '#detail-material', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let assign_id = $(this).data('id');


            $.ajax({
                url: "{{ route('getMaterialFtthDismantle') }}",
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
                                    <td>${item.material_condition ? item.material_condition : '-'}</td>
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

        })


        $(document).on('click', '#edit-material', function (e) {
            var _token = $('meta[name=csrf-token]').attr('content');
            let assign_id = $(this).data('id');

            $.ajax({
                url: "{{ route('editMaterialFtthDismantle') }}",
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
