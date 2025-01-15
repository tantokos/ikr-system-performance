<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            @if(session('error'))
                <div class="alert alert-danger">
                    {!! session('error') !!}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-2 mb-2">
                        <div class="full-background" style="background: linear-gradient(to right, #112133, #21416d);">
                        </div>
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">Import Assign Tim FTTX</h3>
                            <p class="mb-2 font-weight-semibold">
                                {{-- Check all the advantages and choose the best. --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-frame mb-2">
                <div class="card-body shadow-sm border border-radius-sm">

                    {{-- <form> --}}
                    <div class="row">

                        <div id="pageLoader" class="loader-overlay" style="display: none;">
                            <div class="loader"></div>
                        </div>

                        <div class="col-md-6">
                            <form action="{{ route('fttx.import.proses-so') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" class="form-control form-control-sm" id="fileDataSO" name="fileDataSO" required>
                                </div>
                                <div class="form-group mb-1">
                                    <button type="submit" id="importButton" class="btn btn-dark btn-sm w-100">
                                        Import Data SO
                                    </button>
                                </div>
                            </form>
                        </div>


                        <div class="col-md-6">
                            <form action="{{ route('simpanImportWoFttx') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <label class="col-sm-3 col-form-label form-control-sm">Import By</label>
                                    <div class="col form-group">
                                        <input type="text" class="form-control form-control-sm" id="akses"
                                            name="akses" value="{{ $akses }}" readonly />
                                    </div>
                                </div>
                        </div>
                    </div>

                    <hr class="mt-1 mb-1">
                    <div class="col text-end">
                        <button onclick="return confirm('Simpan hasil import WO FTTX?')" type="submit" name="action"
                            value="simpan" class="btn btn-sm btn-dark align-items-center mb-1">Save Import
                            SO</button>
                        <button onclick="return confirm('Hapus hasil import Data FTTX?')"
                            onsubmit="this.disabled = true;" type="submit" name="action" value="batal"
                            class="btn btn-sm btn-danger align-items-center mb-1">Cancel Import
                            Data</button>
                    </div>
                    </form>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-xl-4 col-sm-6">
                    <div class="card border shadow-lg mb-1">
                        <div class="card-body text-start p-3 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100 text-center">
                                        <p class="text-sm text-secondary mb-1">Total FTTX</p>
                                        <h4 class="mb-2 font-weight-bold">{{ $totalFttx }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6">
                    <div class="card border shadow-lg mb-1">
                        <div class="card-body text-start p-3 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100 text-center">
                                        <p class="text-sm text-secondary mb-1">Total FTTX IB</p>
                                        <h4 class="mb-2 font-weight-bold">{{ $totalFttxIb }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6">
                    <div class="card border shadow-lg mb-1">
                        <div class="card-body text-start p-3 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100 text-center">
                                        <p class="text-sm text-secondary mb-1">Total FTTX MT</p>
                                        <h4 class="mb-2 font-weight-bold">{{ $totalFttxMt }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 mt-2 mb-2">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg">Rekap Import Assign SO</h6>
                                    {{-- <p class="text-sm">See information about all members</p> --}}
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">
                            <div class="table-responsive p-0">
                                <table id="summaryAssignTeam" class="table table-striped table-bordered align-items-center mb-0" style="font-size: 12px">
                                    <thead class="bg-gray-600">
                                        <tr id="headStatusProgresWo">
                                            <th class="text-white text-xs font-weight-semibold">No</th>
                                            <th class="text-white text-xs font-weight-semibold">Area</th>
                                            <th class="text-white text-xs font-weight-semibold">Callsign Tim</th>
                                            <th class="text-white text-xs text-center font-weight-semibold">FTTX New Installation</th>
                                            <th class="text-white text-xs text-center font-weight-semibold">FTTX Maintenance</th>
                                            <th class="text-white text-xs text-center font-weight-semibold">Total WO</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyStatusProgresWo">
                                        @foreach ($pivotData as $index => $data)
                                        <tr>
                                            <td class="text-xs text-center">{{ $loop->iteration }}</td>
                                            <td class="text-xs">{{ $data['area'] }}</td>
                                            <td class="text-xs">{{ $data['callsign'] }}</td>
                                            <td class="text-xs text-center">{{ $data['FTTX New Installation'] == "0" ? null : $data['FTTX New Installation'] }}</td>
                                            <td class="text-xs text-center">{{ $data['FTTX Maintenance'] == "0" ? null : $data['FTTX Maintenance'] }}</td>
                                            <td class="text-xs text-center">{{ $data['Total WO'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" style="text-align:right">Total WO:</th>
                                            <th style="text-align:center"></th>
                                            <th style="text-align:center"></th>
                                            <th style="text-align:center"></th>
                                            {{-- <th style="text-align:center"></th> --}}
                                        </tr>
                                    </tfoot>
                                </table>
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
                                    <h6 class="font-weight-semibold text-lg">Import Data list</h6>
                                    {{-- <p class="text-sm">See information about all members</p> --}}
                                </div>
                            </div>
                        </div>

                        <style>
                            .wrap-address {word-wrap: break-word;min-width: 160px;max-width: 160px;white-space: normal;}
                        </style>

                        <div class="card-body px-2 py-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered align-items-center mb-0" id="tabelDataWoImport" style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs">#</th>
                                            <th class="text-secondary text-xs ps-2">No SO</th>
                                            <th class="text-center text-secondary text-xs">SO Date</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                Cust Name</th>
                                            <th
                                                class="text-center text-secondary text-xs wrap-address">
                                                Cust Address</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                PIC Customer</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                Telp PIC Customer</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                WO Type</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                Product</th>
                                            <th
                                                class="text-center text-secondary text-xs wrap-address">
                                                Remark EWO</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                CID</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                Segment Sales</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                Area</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                Jadwa IKR</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                Slot time</th>
                                            <th
                                                class="text-center text-secondary text-xs wrap-address">
                                                Remark</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                Status Jadwal</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                Branch</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                Leader</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                Callsign</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                tim 1</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                tim 2</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                tim 3</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                tim 4</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                Nopol</th>
                                            <th
                                                class="text-center text-secondary text-xs">
                                                #</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <x-app.footer /> --}}
        </div>

        {{-- Modal Show Detail Import Wo --}}
        <div class="modal fade" id="showImportWo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail WO</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#" enctype="multipart/form-data">
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
                                                <span class="text-xs">WO Date</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="WoDateShow" name="WoDateShow" style="border-color:#9ca0a7;">
                                            </div>
                                        </div>
                                    </div>

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
                                    <div class="form-group mb-1">
                                        <div class="row">
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Tanggal Progress</span>
                                                <input class="form-control form-control-sm" type="date"
                                                    value="{{ date('Y-m-d') }}" id="tglProgressShow" name="tglProgressShow"
                                                    style="border-color:#9ca0a7;">
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
                                        <div class="row">
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Branch</span>
                                                <select class="form-control form-control-sm" type="text"
                                                    id="branchShow" name="branchShow" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Branch</option>
                                                    @if (isset($branches))
                                                        @foreach ($branches as $b)
                                                            <option value="{{ $b->id . '|' . $b->nama_branch }}">
                                                                {{ $b->nama_branch }}
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Sesi</span>
                                                <select class="form-control form-control-sm" type="text"
                                                    id="sesiShow" name="sesiShow" style="border-color:#9ca0a7;">
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
                                                                value="{{ $lead->lead_call_id . '|' . $lead->lead_callsign . '|' . $lead->leader_id . '|' . $lead->nama_leader }}">
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
                                            id="updateAssign">Update Data</button>
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



{{-- <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-html5-3.1.0/b-print-3.1.0/fc-5.0.1/r-3.0.2/sr-1.4.1/datatables.min.css" rel="stylesheet"> --}}
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
            html: "{{ session('error') }}",
            showConfirmButton: true,
            // timer: 2000
        });
    @endif

    @if (session()->get('errors'))
        Swal.fire({
            icon: "error",
            title: "Gagal!",
            html: "{{ session()->get('errors')->first() }}",
            showConfirmButton: true,
            // timer: 2000
        });
    @endif
</script>

<script>
    $(document).ready(function() {
        $('#summaryAssignTeam').DataTable({
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
            scrollX: true, // Aktifkan scroll horizontal
            pageLength: 10,
            lengthChange: true,
            bFilter: true,
            destroy: true,
            processing: true,
            serverSide: false,
            // fixedColumns: {
            //     leftColumns: 3 // Jumlah kolom di sebelah kiri yang di-"fix"
            // },
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string'
                        ? i.replace(/[\$,]/g, '') * 1
                        : typeof i === 'number'
                        ? i
                        : 0;
                };

                for(x=3;x<6;x++){
                    // Total over all pages
                    totalIb = api
                        .column(x)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total over this page
                    pageTotalIb = api
                        .column(x, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(x).footer()).html(
                        pageTotalIb + ' - ( ' + totalIb + ' total)'
                    );
                }
            }
        });
    });
</script>


<script>
    $(document).ready(function() {


        var _token = $('meta[name=csrf-token]').attr('content');

        var firstDate;
        var lastDate;
        var leadCallDt = {!! $leadCallsign !!};
        var branchImport;

        akses = $('#akses').val();
        data_import()

        function data_import() {
            $('#tabelDataWoImport').DataTable({
                paging: true,
                orderClasses: false,
                fixedColumns: true,

                fixedColumns: {
                    leftColumns: 2,
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
                    url: "{{ route('fttx.import.data') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        akses: akses,
                        _token: _token
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_Row_Index',
                        "className": "text-center",
                        searchable: false,
                        "width": '20'
                    },
                    {
                        data: 'no_so',
                        width: '90'
                    },
                    {
                        data: 'so_date'
                    },
                    {
                        data: 'customer_name'
                    },
                    {
                        data: 'address',
                        // "className": "wrap-address",
                        render: function (data, type, row)
                        {
                            return "<div class='text-wrap'>" + data + "</div>"
                        }
                    },
                    {
                        data: 'pic_customer'
                    },
                    {
                        data: 'phone_pic_cust'
                    },
                    {
                        data: 'wo_type'
                    },
                    {
                        data: 'product'
                    },
                    {
                        data: 'remark_ewo',
                        "width": '160',
                        // "className": "wrap-address"
                        render: function (data, type, row)
                        {
                            return "<div class='text-wrap'>" + data + "</div>"
                        }
                    },
                    {
                        data: 'cid',
                        render: function (data, type, row)
                        {
                            return "<div class='text-wrap'>" + data + "</div>"
                        }
                    },
                    {
                        data: 'segment_sales',
                        "className": "text-center",
                    },
                    {
                        data: 'area',
                        // "className": "text-center",
                    },
                    {
                        data: 'jadwal_ikr',
                        // "className": "text-center",
                    },
                    {
                        data: 'slot_time_jadwal',
                        // "className": "text-center",
                    },
                    {
                        data: 'remark_for_ikr',
                        // "className": "wrap-address",
                        render: function (data, type, row)
                        {
                            return "<div class='text-wrap'>" + data + "</div>"
                        }
                    },
                    {
                        data: 'status_penjadwalan',
                        // "className": "text-center",
                    },
                    {
                        data: 'branch',
                        // "className": "text-center",
                    },
                    {
                        data: 'leader',
                        "className": "text-center",
                    },
                    {
                        data: 'callsign',
                        "className": "text-center",
                    },
                    {
                        data: 'tim_1',
                        // "className": "text-center",
                    },
                    {
                        data: 'tim_2',
                        // "className": "text-center",
                    },
                    {
                        data: 'tim_3',
                        // "className": "text-center",
                    },
                    {
                        data: 'tim_4',
                        // "className": "text-center",
                    },
                    {
                        data: 'nopol',
                        // "className": "text-center",
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    }
                ]
            })
        }


        $(document).on('click', '#detail-importWo', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let wo_id = $(this).data('id');
            branchImport = $('#branchImport').val();
            // let leadCallDt = {!! $leadCallsign !!}

            function toTitleCase(str) {
                return str.replace(
                    /\w\S*/g,
                    text => text.charAt(0).toUpperCase() + text.substring(1).toLowerCase()
                );
            }

            $.ajax({
                url: "{{ route('getDetailImport') }}",
                type: "get",
                data: {
                    filWoId: wo_id,
                    _token: _token
                },
                success: function(dtDis) {
                    console.log('dtDis : ', dtDis);
                    $('#detId').val(dtDis.data.id)
                    $('#noWoShow').val(dtDis.data.no_wo_apk)
                    $('#ticketNoShow').val(dtDis.data.no_ticket_apk)
                    $('#woTypeShow').val(dtDis.data.wo_type_apk)
                    $('#jenisWoShow').val(dtDis.data.type_wo)
                    $('#WoDateShow').val(dtDis.data.wo_date_apk)
                    $('#custIdShow').val(dtDis.data.cust_id_apk)
                    $('#custNameShow').val(dtDis.data.name_cust_apk)
                    $('#custPhoneShow').val(dtDis.data.cust_phone_apk)

                    $('#custMobileShow').val(dtDis.data.cust_mobile_apk);
                    $('#custAddressShow').val(dtDis.data.address_apk);
                    $('#areaShow').val(dtDis.data.area_cluster_apk);
                    $('#ikrDateApkShow').val(dtDis.data.ikr_date_apk);
                    $('#timeApkShow').val(dtDis.data.time_apk);
                    $('#fatCodeShow').val(dtDis.data.fat_code_apk);
                    $('#portFatShow').val(dtDis.data.fat_port_apk);
                    $('#remarksShow').val(dtDis.data.remarks_apk);

                    // let br = branchImport.split('|');

                    // $('#branchShow').val(branchImport);
                    // $('#branchShowText').val(br[1]);

                    $('#branchShow').val(dtDis.data.branch_id + '|' + dtDis.data.branch);
                    console.log(dtDis.data.tgl_ikr);
                    $('#tglProgressShow').val(dtDis.data.tgl_ikr);

                    $('#sesiShow').val(toTitleCase(dtDis.data.batch_wo || ""));

                    leadCallsignDet = dtDis.data.leadcall_id + '|' + dtDis.data.leadcall +
                        '|' + dtDis.data.leader_id + '|' + dtDis.data.leader

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

                    $('#showImportWo').modal('show');
                }
            })
        })

        $(document).on('change', '#LeadCallsignShow', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');

            let lead = $('#LeadCallsignShow').val();
            lead_call = lead.split('|');

            $('#leaderShow').val(lead_call[3]);
            $('#leaderidShow').val(lead_call[2]);

        })

        $(document).on('click', '#updateAssign', function(e) {
            e.preventDefault();
            sesiShow = $('#sesiShow').val();
            tglProgressShow = $('#tglProgressShow').val();
            slotTimeShow = $('#slotTimeShow').val();
            jenisWoShow = $('#jenisWoShow').val();
            detId = $('#detId').val();
            branchShow = $('#branchShow').val();
            LeadCallsignShow = $('#LeadCallsignShow').val();
            leaderIdShow = $('#leaderidShow').val();
            leaderShow = $('#leaderShow').val();
            callsignTimidShow = $('#callsignTimidShow').val();
            teknisi1Show = $('#teknisi1Show').val();
            teknisi2Show = $('#teknisi2Show').val();
            teknisi3Show = $('#teknisi3Show').val();
            teknisi4Show = $('#teknisi4Show').val();

            $.ajax({
                url: "{{ route('updateImportWo') }}",
                type: "get",
                data: {
                    sesiShow: sesiShow,
                    tglProgressShow: tglProgressShow,
                    slotTimeShow: slotTimeShow,
                    jenisWoShow: jenisWoShow,
                    detId: detId,
                    branchShow: branchShow,
                    LeadCallsignShow: LeadCallsignShow,
                    leaderIdShow: leaderIdShow,
                    leaderShow: leaderShow,
                    callsignTimidShow: callsignTimidShow,
                    teknisi1Show: teknisi1Show,
                    teknisi2Show: teknisi2Show,
                    teknisi3Show: teknisi3Show,
                    teknisi4Show: teknisi4Show,
                    _token: _token,
                },
                success: function(resUp) {
                    console.log(resUp);
                    $('#showImportWo').modal('hide');
                    data_import();

                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "{{ session('success') }}",
                        showConfirmButton: true,
                        // timer: 2000
                    });
                }
            })
        })
    })


    $(document).on('click', '.filterAll', function() {
        $('#FilStatAbsensi').val('All');
        $('#FilNama').val('All');
        $('#FilArea').val('All');

        document.getElementById('filterPreview').click();

    })

    $(document).on('click', '.filterPreview', function() {
        var _token = $('meta[name=csrf-token]').attr('content');
        let fStatus = $('#FilStatAbsensi').val();
        let fNama = $('#FilNama').val();
        let fArea = $('#FilArea').val();

        $.ajax({
            url: "{{ route('getFilterPreview') }}",
            type: "get",
            data: {
                filStatus: fStatus,
                filNama: fNama,
                filArea: fArea,
                _token: _token
            },
            success: function(respon) {

                $('#HeadDay').find("th").remove();
                $('#HeadDay').append(
                    `<th class="text-secondary text-xs font-weight-semibold">Status Absensi</th>`
                )

                $('#bodyDay').find("td").remove();
                $('#bodyDay').find("th").remove();
                $('#bodyDay').find("tr").remove();

                let hday;
                let bday;
                let bdayTotal;
                let total = [];

                $.each(respon.tgl, function(key, item) {

                    hday = `
                        <th class="text-center px-1">${new Date(item).getDate()}</th>
                    `;

                    $('#HeadDay').append(hday);

                    total.push(0);
                })

                $('#HeadDay').append(`<th>Subtotal</th>`);

                $.each(respon.tblPreview, function(ky, absen) {

                    bday = `
                        <tr><th class="text-secondary text-xs font-weight-semibold">${absen.status_absen}</th>
                    `;
                    stotal = 0

                    for (x = 0; x < absen.day.length; x++) {
                        bday = bday + `
                            <td class="text-center">${absen.day[x]}</td>
                        `;

                        stotal = stotal + absen.day[x];
                        total[x] = total[x] + absen.day[x];
                    }

                    bday = bday + `<th class="text-center">${stotal.toLocaleString()}</th>`;

                    $('#bodyDay').append(bday + `</tr>`);
                })

                bdayTotal =
                    `<tr><th class="text-secondary text-xs font-weight-semibold">Total</th>`;

                gtotal = 0;
                for (t = 0; t < total.length; t++) {
                    bdayTotal = bdayTotal + `
                        <th class="text-center">${total[t]}</th>
                    `;

                    gtotal = gtotal + total[t];
                }

                $('#bodyDay').append(bdayTotal +
                    `<th class="text-center">${gtotal.toLocaleString()}</th></tr>`);

            }
        })
    })
</script>
<script>
    $(document).ready(function () {
        $('#importButton').on('click', function (e) {
            // Cek apakah file sudah dipilih
            if ($('#fileDataSO').val() === '') {
                alert('Silakan pilih file terlebih dahulu!');
                e.preventDefault(); // Mencegah form dikirim
                return false;
            }

            // Tampilkan loader di tengah halaman
            $('#pageLoader').fadeIn();
        });
    });

</script>
