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
                            <h3 class="text-white mb-2">Assign Tim IKR</h3>
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
                                    <span class="text-xs">No WO</span>
                                    <input type="text" class="form-control form-control-sm" type="text"
                                        id="filnoWo" name="filnoWo" style="border-color:#9ca0a7;">
                                </div>

                                <div class="col form-group mb-1">
                                    <span class="text-xs">Cust Id</span>
                                    <input type="text" class="form-control form-control-sm" id="filcustId"
                                        name="filcustId" style="border-color:#9ca0a7;">
                                </div>

                                <div class="col form-group mb-1">
                                    <span class="text-xs">Type WO</span>
                                    <select class="form-control form-control-sm" type="text" id="filtypeWo"
                                        name="filtypeWo" style="border-color:#9ca0a7;">
                                        <option value="">Pilih Type WO</option>
                                        <option value="FTTH New Installation">FTTH New Installation</option>
                                        <option value="FTTH Maintenance">FTTH Maintenance</option>
                                        <option value="Dismantle">Dismantle/option>
                                    </select>
                                </div>
                                {{-- </div> --}}
                            </div>

                            <div class="row">

                                {{-- <div class="col"> --}}
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

                                <div class="col form-group mb-1">
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

                                <div class="col form-group mb-1">
                                    <span class="text-xs">Teknisi</span>
                                    <select class="form-control form-control-sm" type="text" id="filteknisi"
                                        name="filteknisi" style="border-color:#9ca0a7;">
                                        <option value="">Pilih Teknisi</option>
                                        @if (isset($tim))
                                            @foreach ($tim as $tm)
                                                <option value="{{ $tm->nik_karyawan . '|' . $tm->nama_karyawan }}">
                                                    {{ $tm->nama_karyawan }}
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group mb-1">
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

                                <div class="col form-group mb-1">
                                    <span class="text-xs">FAT Code</span>
                                    <input type="text" class="form-control form-control-sm" id="filfatCode"
                                        name="filfatCode" style="border-color:#9ca0a7;">
                                </div>

                                <div class="col form-group mb-1">
                                    <span class="text-xs">Slot Time</span>
                                    <select class="form-control form-control-sm" type="text" id="filslotTime"
                                        name="filslotTime" style="border-color:#9ca0a7;">
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

                                <div class="col form-group mb-1">
                                    {{-- <span class="text-xs">Slot Time</span>
                                        <select class="form-control form-control-sm" type="text" id="filslotTime"
                                            name="filslotTime" style="border-color:#9ca0a7;">
                                            <option value="">Pilih SlotTime</option>
                                        </select> --}}
                                </div>

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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Data Assign
                                            Tim</span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
                                    <a href="{{ route('exportTemplateAssignTimFtth') }}" id="exportTemplateAssignTimFTTH">
                                        <button type="button"
                                            class="btn btn-sm btn-icon d-flex align-items-center me-2"
                                            style="background-color: #1abd64; border-color: #1abd64; color: white; padding: 5px 12px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 50 50" style="margin-right: 8px;">
                                                <path fill="white" d="M 28.875 0 C 28.855469 0.0078125 28.832031 0.0195313 28.8125 0.03125 L 0.8125 5.34375 C 0.335938 5.433594 -0.0078125 5.855469 0 6.34375 L 0 43.65625 C -0.0078125 44.144531 0.335938 44.566406 0.8125 44.65625 L 28.8125 49.96875 C 29.101563 50.023438 29.402344 49.949219 29.632813 49.761719 C 29.859375 49.574219 29.996094 49.296875 30 49 L 30 44 L 47 44 C 48.09375 44 49 43.09375 49 42 L 49 8 C 49 6.90625 48.09375 6 47 6 L 30 6 L 30 1 C 30.003906 0.710938 29.878906 0.4375 29.664063 0.246094 C 29.449219 0.0546875 29.160156 -0.0351563 28.875 0 Z M 28 2.1875 L 28 6.53125 C 27.867188 6.808594 27.867188 7.128906 28 7.40625 L 28 42.8125 C 27.972656 42.945313 27.972656 43.085938 28 43.21875 L 28 47.8125 L 2 42.84375 L 2 7.15625 Z M 30 8 L 47 8 L 47 42 L 30 42 L 30 37 L 34 37 L 34 35 L 30 35 L 30 29 L 34 29 L 34 27 L 30 27 L 30 22 L 34 22 L 34 20 L 30 20 L 30 15 L 34 15 L 34 13 L 30 13 Z M 36 13 L 36 15 L 44 15 L 44 13 Z M 6.6875 15.6875 L 12.15625 25.03125 L 6.1875 34.375 L 11.1875 34.375 L 14.4375 28.34375 C 14.664063 27.761719 14.8125 27.316406 14.875 27.03125 L 14.90625 27.03125 C 15.035156 27.640625 15.160156 28.054688 15.28125 28.28125 L 18.53125 34.375 L 23.5 34.375 L 17.75 24.9375 L 23.34375 15.6875 L 18.65625 15.6875 L 15.6875 21.21875 C 15.402344 21.941406 15.199219 22.511719 15.09375 22.875 L 15.0625 22.875 C 14.898438 22.265625 14.710938 21.722656 14.5 21.28125 L 11.8125 15.6875 Z M 36 20 L 36 22 L 44 22 L 44 20 Z M 36 27 L 36 29 L 44 29 L 44 27 Z M 36 35 L 36 37 L 44 37 L 44 35 Z"></path>
                                            </svg>
                                            <span class="btn-inner--text">Download Template Assign Tim FTTH</span>
                                        </button>
                                    </a>                            

                                    <button type="button"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                        data-bs-toggle="modal" data-bs-target="#tambahAssignTim">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                </path>
                                            </svg>
                                        </span>
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
                                            <span class="btn-inner--text">Import Data Assign Tim</span>
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
                                            <th class="text-center text-xs font-weight-semibold">Area</th>
                                            <th class="text-center text-xs font-weight-semibold">Cluster</th>
                                            <th class="text-center text-xs font-weight-semibold">Slot Time</th>
                                            <th class="text-center text-xs font-weight-semibold">Lead Callsign</th>
                                            <th class="text-center text-xs font-weight-semibold">Leader</th>
                                            <th class="text-center text-xs font-weight-semibold">Callsign Tim</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 1</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 2</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 3</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 4</th>
                                            <th class="text-center text-xs font-weight-semibold">Leader Assign</th>
                                            <th class="text-center text-xs font-weight-semibold">#</th>

                                        </tr>
                                    </thead>
                                    <tbody id="bodyTool">

                                    </tbody>
                                </table>
                            </div>
                            <div id="emptyDataLottie" style="display: flex; justify-content: center; align-items: center; text-align: center;">
                                <lottie-player
                                    src="{{ asset('assets/animate/empty.json') }}"
                                    background="transparent"
                                    speed="1"
                                    style="width: 180px; height: 180px;"
                                    loop
                                    autoplay>
                                </lottie-player>
                                <p class="text-muted">Tidak ada data untuk ditampilkan</p>
                            </div>

                            <div class="border-top py-3 px-3 d-flex align-items-center">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <x-app.footer /> --}}
        </div>

        {{-- Modal Tambah Assign Tim --}}
        <div class="modal fade" id="tambahAssignTim" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Assign Tim</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('simpanSignTim') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col form-group mb-1">
                                            <span class="text-xs">WO No</span>
                                            <input class="form-control form-control-sm" value="{{ old('noWo') }}" type="text" id="noWo"
                                                name="noWo" style="border-color:#9ca0a7;" required>
                                        </div>

                                        <div class="col-4 form-group mb-1">
                                            <span class="text-xs">Ticket No</span>
                                            <input class="form-control form-control-sm" type="text" value="{{ old('noWo') }}" id="ticketNo"
                                                name="ticketNo" style="border-color:#9ca0a7;">
                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <div class="row">
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">WO Type</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="woType" name="woType" value="{{ old('woType') }}" style="border-color:#9ca0a7;">
                                            </div>
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Type</span>
                                                <select class="form-control form-control-sm" type="text"
                                                    id="jenisWo" name="jenisWo" style="border-color:#9ca0a7;" value="{{ old('jenisWo') }}" required>
                                                    <option value="FTTH New Installation">FTTH New Installation
                                                    </option>
                                                    <option value="FTTH Maintenance">FTTH Maintenance</option>
                                                    <option value="FTTH Dismantle">Dismantle</option>
                                                    <option value="FTTX/B New Installation">FTTX/B New Installation
                                                    </option>
                                                    <option value="FTTX/B Maintenance">FTTX/B Maintenance</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">WO Date</span>
                                        <input class="form-control form-control-sm" type="text" id="WoDate"
                                            name="WoDate" style="border-color:#9ca0a7;" required value="{{ old('WoDate') }}">
                                    </div>


                                    {{-- </div> --}}

                                    {{-- <div class="col"> --}}

                                    <div class="form-group mb-1">
                                        <div class="row">
                                            <div class="col-4 form-group mb-1">
                                                <span class="text-xs">Cust Id</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="custId" name="custId" style="border-color:#9ca0a7;" required value="{{ old('custId') }}">
                                            </div>

                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Cust Name</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="custName" name="custName" style="border-color:#9ca0a7;" required value="{{ old('custName') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <div class="row">
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Cust Phone</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="custPhone" name="custPhone" style="border-color:#9ca0a7;" required value="{{ old('custPhone') }}">
                                            </div>

                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Cust Mobile</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="custMobile" name="custMobile" style="border-color:#9ca0a7;" required value="{{ old('custMobile') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Address</span>
                                        <textarea class="form-control form-control-sm" type="text" id="custAddress" name="custAddress"
                                            style="border-color:#9ca0a7;" required></textarea>
                                    </div>
                                    <div class="form-group mb-1">
                                        <span class="text-xs">Area/Cluster</span>
                                        <input type="text" class="form-control form-control-sm" type="text"
                                            id="area" name="area" style="border-color:#9ca0a7;" required value="{{ old('area') }}">
                                    </div>

                                    <div class="form-group mb-1">
                                        <div class="row">
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">IKR Date APK</span>
                                                <input class="form-control form-control-sm" type="date"
                                                    id="ikrDateApk" name="ikrDateApk" style="border-color:#9ca0a7;" required value="{{ old('ikrDateApk') }}">
                                            </div>

                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Time APK</span>
                                                <select class="form-control form-control-sm"
                                                        id="timeApk"
                                                        name="timeApk"
                                                        style="border-color:#9ca0a7;"
                                                        placeholder="Isi Callsign Tim" required>
                                                    <option value="">Pilih Time APK</option>
                                                    <option value="09:00" {{ old('timeApk') == '09:00' ? 'selected' : '' }}>09:00</option>
                                                    <option value="09:30" {{ old('timeApk') == '09:30' ? 'selected' : '' }}>09:30</option>
                                                    <option value="10:00" {{ old('timeApk') == '10:00' ? 'selected' : '' }}>10:00</option>
                                                    <option value="10:30" {{ old('timeApk') == '10:30' ? 'selected' : '' }}>10:30</option>
                                                    <option value="11:00" {{ old('timeApk') == '11:00' ? 'selected' : '' }}>11:00</option>
                                                    <option value="11:30" {{ old('timeApk') == '11:30' ? 'selected' : '' }}>11:30</option>
                                                    <option value="12:00" {{ old('timeApk') == '12:00' ? 'selected' : '' }}>12:00</option>
                                                    <option value="12:30" {{ old('timeApk') == '12:30' ? 'selected' : '' }}>12:30</option>
                                                    <option value="13:00" {{ old('timeApk') == '13:00' ? 'selected' : '' }}>13:00</option>
                                                    <option value="13:30" {{ old('timeApk') == '13:30' ? 'selected' : '' }}>13:30</option>
                                                    <option value="14:00" {{ old('timeApk') == '14:00' ? 'selected' : '' }}>14:00</option>
                                                    <option value="14:30" {{ old('timeApk') == '14:30' ? 'selected' : '' }}>14:30</option>
                                                    <option value="15:00" {{ old('timeApk') == '15:00' ? 'selected' : '' }}>15:00</option>
                                                    <option value="15:30" {{ old('timeApk') == '15:30' ? 'selected' : '' }}>15:30</option>
                                                    <option value="16:00" {{ old('timeApk') == '16:00' ? 'selected' : '' }}>16:00</option>
                                                    <option value="16:30" {{ old('timeApk') == '16:30' ? 'selected' : '' }}>16:30</option>
                                                    <option value="17:00" {{ old('timeApk') == '17:00' ? 'selected' : '' }}>17:00</option>
                                                    <option value="17:30" {{ old('timeApk') == '17:30' ? 'selected' : '' }}>17:30</option>
                                                    <option value="18:00" {{ old('timeApk') == '18:00' ? 'selected' : '' }}>18:00</option>
                                                    <option value="18:30" {{ old('timeApk') == '18:30' ? 'selected' : '' }}>18:30</option>
                                                    <option value="19:00" {{ old('timeApk') == '19:00' ? 'selected' : '' }}>19:00</option>
                                                    <option value="19:30" {{ old('timeApk') == '19:30' ? 'selected' : '' }}>19:30</option>
                                                    <option value="20:00" {{ old('timeApk') == '20:00' ? 'selected' : '' }}>20:00</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <div class="row">
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">FAT Code</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="fatCode" name="fatCode" style="border-color:#9ca0a7;" required value="{{ old('fatCode') }}">
                                            </div>
                                            <div class="col-4 form-group mb-1">
                                                <span class="text-xs">Port FAT</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="portFat" name="portFat" style="border-color:#9ca0a7;" required value="{{ old('portFat') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Remarks</span>
                                        <textarea class="form-control form-control-sm" type="text" id="remarks" name="remarks"
                                            style="border-color:#9ca0a7;"></textarea>
                                    </div>

                                </div>

                                <div class="col">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Branch</span>
                                        <select class="form-control form-control-sm" type="text" id="branch"
                                            name="branch" style="border-color:#9ca0a7;"
                                            placeholder="Isi Callsign Tim">
                                            <option value="">Pilih Branch</option>
                                            @if (isset($branches))
                                                @foreach ($branches as $b)
                                                    <option value="{{ $b->id . '|' . $b->nama_branch }}">
                                                        {{ $b->nama_branch }}
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group mb-1">
                                        <div class="row">
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Tanggal Progress</span>
                                                <input class="form-control form-control-sm" type="date"
                                                    value="{{ date('Y-m-d') }}" id="tglProgress" name="tglProgress"
                                                    style="border-color:#9ca0a7;" value="{{ old('tglProgress') }}">
                                            </div>

                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Sesi</span>
                                                <select class="form-control form-control-sm" type="text"
                                                    id="sesiShowAdd" name="sesiShowAdd" style="border-color:#9ca0a7;"
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
                                                <span class="text-xs">Lead Callsign</span>
                                                <select class="form-control form-control-sm" id="LeadCallsign"
                                                    name="LeadCallsign" style="border-color:#9ca0a7;" required>
                                                    <option value="">Pilih Lead Callsign</option>
                                                    @if (isset($leadCallsign))
                                                        @foreach ($leadCallsign as $lead)
                                                            <option
                                                                value="{{ $lead->lead_call_id . '|' . $lead->lead_callsign }}">
                                                                {{ $lead->lead_callsign }}
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Nama Leader</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="leader" name="leader" style="border-color:#9ca0a7;"
                                                    readonly>
                                                <input type="hidden" id="leaderid" name="leaderid" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <div class="row">
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Slot Time</span>
                                                <select class="form-control form-control-sm" type="text"
                                                    id="slotTime" name="slotTime" style="border-color:#9ca0a7;"
                                                    placeholder="Isi Callsign Tim" required>
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

                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Callsign Tim</span>
                                                <select class="form-control form-control-sm" id="callsignTimid"
                                                    name="callsignTimid" style="border-color:#9ca0a7;"
                                                    placeholder="Isi Callsign Tim" required>
                                                    <option value="">Pilih Callsign Tim</option>
                                                </select>
                                                <input type="hidden" id="callsignTim" name="callsignTim">
                                            </div>
                                        </div>

                                        <div class="form-group mb-1">
                                            <span class="text-xs">Teknisi 1</span>
                                            <select class="form-control form-control-sm" id="teknisi1"
                                                name="teknisi1" style="border-color:#9ca0a7;" required>
                                                <option value="">Teknisi 1</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-1">
                                            <span class="text-xs">Teknisi 2</span>
                                            <select class="form-control form-control-sm" id="teknisi2"
                                                name="teknisi2" style="border-color:#9ca0a7;" required>
                                                <option value="">Teknisi 2</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-1">
                                            <span class="text-xs">Teknisi 3</span>
                                            <select class="form-control form-control-sm" id="teknisi3"
                                                name="teknisi3" style="border-color:#9ca0a7;">
                                                <option value="">Teknisi 3</option>
                                            </select>
                                        </div>
                                        {{-- </div> --}}
                                        {{-- <div class="col"> --}}


                                        <div class="form-group mb-1">
                                            <span class="text-xs">Teknisi 4</span>
                                            <select class="form-control form-control-sm" id="teknisi4"
                                                name="teknisi4" style="border-color:#9ca0a7;">
                                                <option value="">Teknisi 4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="row text-center mb-0">
                                    <div class="col">
                                        <button type="submit"
                                            class="btn btn-sm btn-dark align-items-center simpanDistribusi"
                                            id="simpanDistribusi">Simpan Data</button>
                                        <button type="button" value="close"
                                            class="btn btn-sm btn-dark align-items-center"
                                            data-bs-dismiss="modal">Batalkan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Tambah Assign Tim --}}

        {{-- Modal Show Detail Data Tool --}}
        <div class="modal fade" id="showAssignTim" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Assign Tim</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateSignTim') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col form-group mb-1">
                                            <input type="hidden" id="detId" name="detId">
                                            <span class="text-xs">WO No</span>
                                            <input class="form-control form-control-sm" type="text" id="noWoShow"
                                                name="noWoShow" style="border-color:#9ca0a7;">
                                        </div>

                                        <div class="col-4 form-group mb-1">
                                            <span class="text-xs">Ticket No</span>
                                            <input class="form-control form-control-sm" type="text"
                                                id="ticketNoShow" name="ticketNoShow" style="border-color:#9ca0a7;">
                                        </div>


                                    </div>



                                    <div class="form-group mb-1">
                                        <div class="row">
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">WO Type</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="woTypeShow" name="woTypeShow" style="border-color:#9ca0a7;">
                                            </div>
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Type</span>
                                                <select class="form-control form-control-sm" type="text"
                                                    id="jenisWoShow" name="jenisWoShow"
                                                    style="border-color:#9ca0a7;">
                                                    <option value="FTTH New Installation">FTTH New Installation
                                                    </option>
                                                    <option value="FTTH Maintenance">FTTH Maintenance</option>
                                                    <option value="Dismantle">Dismantle</option>
                                                    <option value="FTTX/B New Installation">FTTX/B New Installation
                                                    </option>
                                                    <option value="FTTX/B Maintenance">FTTX/B Maintenance</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">WO Date</span>
                                        <input class="form-control form-control-sm" type="text" id="WoDateShow"
                                            name="WoDateShow" style="border-color:#9ca0a7;">
                                    </div>


                                    {{-- </div> --}}

                                    {{-- <div class="col"> --}}

                                    <div class="form-group mb-1">
                                        <div class="row">
                                            <div class="col-4 form-group mb-1">
                                                <span class="text-xs">Cust Id</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="custIdShow" name="custIdShow" style="border-color:#9ca0a7;">
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
                                                <span class="text-xs">Cust Phone</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="custPhoneShow" name="custPhoneShow"
                                                    style="border-color:#9ca0a7;">
                                            </div>

                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Cust Mobile</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="custMobileShow" name="custMobileShow"
                                                    style="border-color:#9ca0a7;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Address</span>
                                        <textarea class="form-control form-control-sm" type="text" id="custAddressShow" name="custAddressShow"
                                            style="border-color:#9ca0a7;"></textarea>
                                    </div>
                                    <div class="form-group mb-1">
                                        <span class="text-xs">Area/Cluster</span>
                                        <input type="text" class="form-control form-control-sm" type="text"
                                            id="areaShow" name="areaShow" style="border-color:#9ca0a7;">
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
                                        <select class="form-control form-control-sm" type="text" id="branchShow"
                                            name="branchShow" style="border-color:#9ca0a7;"
                                            placeholder="Isi Callsign Tim">
                                            <option value="">Pilih Branch</option>
                                            @if (isset($branches))
                                                @foreach ($branches as $b)
                                                    <option value="{{ $b->id . '|' . $b->nama_branch }}">
                                                        {{ $b->nama_branch }}
                                                @endforeach
                                            @endif
                                        </select>
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
                                                <select class="form-control form-control-sm" type="text"
                                                    id="sesiShow" name="sesiShow" style="border-color:#9ca0a7;"
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
                                                <span class="text-xs">Lead Callsign</span>
                                                <select class="form-control form-control-sm" id="LeadCallsignShow"
                                                    name="LeadCallsignShow" style="border-color:#9ca0a7;" required>
                                                    <option value="">Pilih Lead Callsign</option>
                                                    @if (isset($leadCallsign))
                                                        @foreach ($leadCallsign as $lead)
                                                            <option
                                                                value="{{ $lead->lead_call_id . '|' . $lead->lead_callsign }}">
                                                                {{ $lead->lead_callsign }}
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Nama Leader</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="leaderShow" name="leaderShow" style="border-color:#9ca0a7;"
                                                    readonly>
                                                <input type="hidden" id="leaderidShow" name="leaderidShow" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <div class="row">
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Slot Time</span>
                                                <select class="form-control form-control-sm" type="text"
                                                    id="slotTimeShow" name="slotTimeShow"
                                                    style="border-color:#9ca0a7;" placeholder="Isi Callsign Tim">
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

                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Callsign Tim</span>
                                                <select class="form-control form-control-sm" id="callsignTimidShow"
                                                    name="callsignTimidShow" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Callsign Tim</option>
                                                </select>
                                                <input type="hidden" id="callsignTimShow" name="callsignTimShow">
                                            </div>
                                        </div>

                                        <div class="form-group mb-1">
                                            <span class="text-xs">Teknisi 1</span>
                                            <select class="form-control form-control-sm" id="teknisi1Show"
                                                name="teknisi1Show" style="border-color:#9ca0a7;">
                                                <option value="">Teknisi 1</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-1">
                                            <span class="text-xs">Teknisi 2</span>
                                            <select class="form-control form-control-sm" id="teknisi2Show"
                                                name="teknisi2Show" style="border-color:#9ca0a7;">
                                                <option value="">Teknisi 2</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-1">
                                            <span class="text-xs">Teknisi 3</span>
                                            <select class="form-control form-control-sm" id="teknisi3Show"
                                                name="teknisi3Show" style="border-color:#9ca0a7;">
                                                <option value="">Teknisi 3</option>
                                            </select>
                                        </div>
                                        {{-- </div> --}}
                                        {{-- <div class="col"> --}}


                                        <div class="form-group mb-1">
                                            <span class="text-xs">Teknisi 4</span>
                                            <select class="form-control form-control-sm" id="teknisi4Show"
                                                name="teknisi4Show" style="border-color:#9ca0a7;">
                                                <option value="">Teknisi 4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="row text-center mb-0">
                                    <div class="col">
                                        <button type="submit"
                                            class="btn btn-sm btn-dark align-items-center updateAssign"
                                            id="updateAssign">Edit Data</button>
                                        <button type="button" value="close"
                                            class="btn btn-sm btn-dark align-items-center"
                                            data-bs-dismiss="modal">Batalkan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                        {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    </div>
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
    @elseif (session('warning'))
        Swal.fire({
            icon: "warning",
            title: "Gagal!",
            text: "{{ session('warning') }}",
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
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

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
            data_assignTim();
            stDate = $('.date-range').data('daterangepicker').startDate.format("DD-MMM-YYYY");
            enDate = $('.date-range').data('daterangepicker').endDate.format("DD-MMM-YYYY");
        })

        $('#filAssignTim').trigger("click");

        function data_assignTim() {
            $('#tabelAssignTim').DataTable({
                layout: {
                    topStart: {
                        buttons: ['excel']
                    },
                },
                paging: true,
                orderClasses: false,
                fixedColumns: {
                    leftColumns: 3,
                },
                deferRender: true,
                scrollCollapse: true,
                scrollX: true,
                pageLength: 10,
                lengthChange: false,
                bFilter: true,
                destroy: true,
                processing: true,
                serverSide: false, // Ubah ke serverSide jika memang menggunakan serverside
                ajax: {
                    url: "{{ route('getTabelAssignTim') }}",
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
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_Row_Index', "className": "text-center", searchable: false, "width": '10' },
                    { data: 'tgl_ikr' },
                    { data: 'no_wo_apk' },
                    { data: 'wo_date_apk' },
                    { data: 'cust_id_apk' },
                    { data: 'name_cust_apk' },
                    { data: 'wo_type_apk' },
                    { data: 'fat_code_apk' },
                    { data: 'branch' },
                    { data: 'area_cluster_apk' },
                    { data: 'slot_time' },
                    { data: 'leadcall' },
                    { data: 'leader' },
                    { data: 'callsign' },
                    { data: 'teknisi1' },
                    { data: 'teknisi2' },
                    { data: 'teknisi3' },
                    { data: 'teknisi4' },
                    { data: 'login' },
                    { data: 'action', "className": "text-center" },
                ],
                drawCallback: function(settings) {
                    let api = this.api();
                    let dataCount = api.rows({ page: 'current' }).count();

                    if (dataCount === 0) {
                        // Jika data kosong
                        $('#tabelAssignTim').parent().hide(); // Sembunyikan tabel beserta wrapping div
                        $('#emptyDataLottie').show(); // Tampilkan animasi
                    } else {
                        // Jika ada data
                        $('#tabelAssignTim').parent().show(); // Tampilkan tabel beserta wrapping div
                        $('#emptyDataLottie').hide(); // Sembunyikan animasi
                    }
                }
            });
        }
        

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
                    $('#noWoShow').val(dtDis.data.no_wo_apk)
                    $('#ticketNoShow').val(dtDis.data.no_ticket_apk)
                    $('#woTypeShow').val(toTitleCase(dtDis.data.wo_type_apk))
                    $('#jenisWoShow').val(dtDis.data.type_wo)
                    $('#WoDateShow').val(dtDis.data.wo_date_apk)
                    $('#custIdShow').val(dtDis.data.cust_id_apk)
                    $('#custNameShow').val(toTitleCase(dtDis.data.name_cust_apk))
                    $('#custPhoneShow').val(dtDis.data.cust_phone_apk)

                    $('#custMobileShow').val(dtDis.data.cust_mobile_apk);
                    $('#custAddressShow').val(toTitleCase(dtDis.data.address_apk));
                    $('#areaShow').val(toTitleCase(dtDis.data.area_cluster_apk));
                    $('#ikrDateApkShow').val(dtDis.data.ikr_date_apk);
                    $('#timeApkShow').val(dtDis.data.time_apk);
                    $('#fatCodeShow').val(dtDis.data.fat_code_apk);
                    $('#portFatShow').val(dtDis.data.fat_port_apk);
                    $('#remarksShow').val(toTitleCase(dtDis.data.remarks_apk || ""));

                    $('#branchShow').val(dtDis.data.branch_id + '|' + dtDis.data.branch);
                    $('#tglProgressShow').val(dtDis.data.tgl_ikr);

                    $('#sesiShowAdd').val(toTitleCase(dtDis.data.batch_wo || ""));
                    $('#sesiShow').val(toTitleCase(dtDis.data.batch_wo || ""));
                    console.log(dtDis.data.batch_wo);


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

    })
</script>
