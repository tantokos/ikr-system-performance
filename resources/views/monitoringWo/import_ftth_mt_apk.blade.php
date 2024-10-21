<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-2 mb-2">
                        <div class="full-background" style="background: linear-gradient(to right, #112133, #21416d);">
                        </div>
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">Import Data WO FTTH MT APK</h3>
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

                        <div class="col-md-6">
                            <form action="{{ route('importProsesDataWoApk') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" class="form-control form-control-sm" id="fileDataWO"
                                        name="fileDataWO" required>
                                </div>
                                <div class="form-group mb-1">
                                    <button type="submit" class="btn btn-dark btn-sm w-100" onclick="cek()">
                                        <span class="spinner-border spinner-border-sm" style="display: none"
                                            role="status" aria-hidden="true"></span>
                                        Import Data Work Order</button>
                                    {{-- </div> --}}
                                    {{-- <div class="form-group"> --}}
                                    {{-- <label class="col-form-label form-control-sm">Information of Data Import :</label> --}}
                                    {{-- <div class="col-form-label form-control-sm"> --}}
                                    {{-- @if (isset($croscekData)) --}}
                                    {{-- @if ($croscekData != '-') --}}
                                    {{-- <span class="error">{{ $croscekData }}</span> --}}
                                    {{-- @else --}}
                                    {{-- <span class="error">-</span> --}}
                                    {{-- @endif --}}
                                    {{-- @endif --}}
                                    {{-- </div> --}}
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <form action="{{ route('updateFtthMtApk') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <label class="col-sm-3 col-form-label form-control-sm">Import By</label>
                                    <div class="col form-group">
                                        <input type="text" class="form-control form-control-sm" id="akses"
                                            name="akses" value="{{ $akses }}" readonly />
                                    </div>
                                </div>

                                {{-- <div class="row">
                                    <label class="col-sm-3 col-form-label form-control-sm">Branch</label>
                                    <div class="col form-group">
                                        <select class="form-control form-control-sm" type="text" id="branchImport"
                                            name="branchImport" style="border-color:#9ca0a7;">
                                            <option value="">Pilih Branch</option>
                                            @if (isset($branches))
                                                @foreach ($branches as $b)
                                                    <option value="{{ $b->id . '|' . $b->nama_branch }}">
                                                        {{ $b->nama_branch }}
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div> --}}

                                {{-- <div class="row">
                                    <label class="col-sm-3 col-form-label form-control-sm">Number of Rows</label>
                                    <div class="col form-group">
                                        <input type="text" class="form-control form-control-sm" id="jmlData"
                                            name="jmlData" value=""" readonly />
                                    </div>
                                </div> --}}

                                {{-- <div class="row">
                                    <label class="col-sm-3 col-form-label form-control-sm">Periode of Rows</label>
                                    <div class="col form-group">
                                        <input type="text" class="form-control form-control-sm" id="periode"
                                            name="periode" value="" readonly />
                                    </div>
                                </div> --}}
                        </div>
                    </div>
                    <hr>
                    <div class="col text-end">
                        {{-- <button type="button" class="btn btn-sm btn-dark align-items-center" data-bs-toggle="modal"
                            data-bs-target="#previewModal">Show Preview</button> --}}
                        <button onclick="return confirm('Simpan hasil import WO?')" type="submit" name="action"
                            value="simpan" class="btn btn-sm btn-dark align-items-center">Save Import
                            WO</button>
                        <button onclick="return confirm('Hapus hasil import Data Work Order?')"
                            onsubmit="this.disabled = true;" type="submit" name="action" value="batal"
                            class="btn btn-sm btn-dark align-items-center">Cancel Import
                            Data</button>
                    </div>
                    </form>
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

                        <div class="card-body px-2 py-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0" id="tabelDataWoImportApk" name="tabelDataWoImportApk"
                                    style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold">#</th>
                                            <th class="text-secondary text-xs font-weight-semibold ps-2">WO No</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Ticket No
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                WO Date
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Installation Date
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Time
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Vendor Installer
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Callsign
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Cust Id
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Name
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Cust Phone
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Cust Mobile
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Address
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Area
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                WO Type
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Cause Code
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Root Cause
                                            </th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Action Taken
                                            </th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Fat Code
                                            </th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Fat Port
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Remarks
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Status
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Pending
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Reason
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Check In
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Check Out
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                MTTR All
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                MTTR Pending
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                MTTR Progress
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                MTTR Technician
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                SLA Over
                                            </th>
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
                                                <span class="text-xs">IKR Date APK</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="ikrDateApkShow" name="ikrDateApkShow"
                                                    style="border-color:#9ca0a7;">
                                            </div>

                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Time APK</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="timeApkShow" name="timeApkShow"
                                                    style="border-color:#9ca0a7;">
                                            </div>
                                        </div>
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
        var leadCallDt = {!! $leadCallsign !!};
        var branchImport;

        akses = $('#akses').val();
        data_import()

        // bln = new Date($('#periodeMin').val()).getMonth();
        // thn = new Date($('#periodeMin').val()).getFullYear();

        // firstDate = moment([thn, bln]);
        // lastDate = moment(firstDate).endOf('month');

        function data_import() {
            $('#tabelDataWoImportApk').DataTable({
                // dom: 'Bftip',
                // layout: {
                //     topStart: {
                //         buttons: ['excel']
                //     },
                // },
                paging: true,
                orderClasses: false,
                fixedColumns: true,

                fixedColumns: {
                    leftColumns: 2,
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
                    url: "{{ route('getFtthMtApk') }}",
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
                        // orderable: false,
                        searchable: false,
                        "width": '20'
                    },
                    {
                        data: 'wo_no',
                        width: '90'
                    },
                    {
                        data: 'ticket_no'
                    },
                    {
                        data: 'wo_date'
                    },
                    {
                        data: 'installation_date'
                    },
                    {
                        data: 'time'
                    },
                    {
                        data: 'vendor_installer'
                    },
                    {
                        data: 'callsign'
                    },
                    {
                        data: 'cust_id',
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'cust_phone',
                    },
                    {
                        data: 'cust_mobile',
                    },
                    {
                        data: 'address',
                    },
                    {
                        data: 'area',
                    },
                    {
                        data: 'wo_type',
                    },
                    {
                        data: 'cause_code',
                    },
                    {
                        data: 'root_cause',
                    },
                    {
                        data: 'action_taken',
                    },
                    {
                        data: 'fat_code',
                    },
                    {
                        data: 'fat_port',
                    },
                    {
                        data: 'remarks',
                    },
                    {
                        data: 'status',
                    },
                    {
                        data: 'pending',
                    },
                    {
                        data: 'reason',
                    },
                    {
                        data: 'check_in',
                    },
                    {
                        data: 'check_out',
                    },
                    {
                        data: 'mttr_all',
                    },
                    {
                        data: 'mttr_pending',
                    },
                    {
                        data: 'mttr_progress',
                    },
                    {
                        data: 'mttr_technician',
                    },
                    {
                        data: 'sla_over',
                    },
                ]
            })
        }


        $(document).on('click', '#detail-importWo', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let wo_id = $(this).data('id');
            branchImport = $('#branchImport').val();
            // let leadCallDt = {!! $leadCallsign !!}

            $.ajax({
                url: "{{ route('getDetailImport') }}",
                type: "get",
                data: {
                    filWoId: wo_id,
                    _token: _token
                },
                success: function(dtDis) {
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

                    $('#sesiShow').val(dtDis.data.batch_wo);

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
