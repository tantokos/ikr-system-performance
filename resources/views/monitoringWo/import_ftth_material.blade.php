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
                            <h3 class="text-white mb-2">Import Data Material APK</h3>
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
                            <form action="{{ route('importProsesMaterial') }}" method="post"
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
                                        Import Data Material</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <form action="{{ route('storeFtthMaterial') }}" method="post" enctype="multipart/form-data">
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
                    <hr>
                    <div class="col text-end">
                        <button onclick="return confirm('Simpan hasil import WO?')" type="submit" name="action"
                            value="simpan" class="btn btn-sm btn-dark align-items-center">Save Import
                            Material</button>
                        <button onclick="return confirm('Hapus hasil import Data Work Order?')"
                            onsubmit="this.disabled = true;" type="submit" name="action" value="batal"
                            class="btn btn-sm btn-dark align-items-center">Cancel Import
                            Material</button>
                    </div>
                    </form>
                </div>
            </div>

            <div class="col-sm-12 mt-3 mb-3">
                <div class="table-responsive p-0">
                    <table id="summaryMaterial" class="table table-striped table-bordered align-items-center mb-0">
                        <thead class="bg-gray-600">
                            <tr id="headStatusProgresWo">
                                <th class="text-white text-sm font-weight-semibold">No</th>
                                <th class="text-white text-sm font-weight-semibold">Area</th>
                                <th class="text-white text-sm font-weight-semibold">Description</th>
                                <th class="text-white text-sm font-weight-semibold">Total Out</th>
                                <th class="text-white text-sm font-weight-semibold">Total In</th>
                            </tr>
                        </thead>
                        <tbody id="statusMaterial">
                            @foreach ($processedData as $index => $data)
                            <tr>
                                <td class="text-sm">{{ $loop->iteration }}</td>
                                <td class="text-sm">{{ $data['area'] }}</td>
                                <td class="text-sm">{{ $data['description'] }}</td>
                                <td class="text-sm">{{ $data['out'] }}</td>
                                <td class="text-sm">{{ $data['in'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg">Import Data list</h6>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0" id="tableImportMaterial" name="tableImportMaterial"
                                    style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold">#</th>
                                            <th class="text-secondary text-xs font-weight-semibold ps-2">WO No</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                WO Date
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Installation Date
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Vendor Installer
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Callsign
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Area
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Warehouse
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Cust Id
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Nama Customer
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Type WO
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Remarks
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Status
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Status Item
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Item Code
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Description
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Qty
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                SN
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Mac Address
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Material Condition
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">
                                                Login
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
        $('#summaryMaterial').DataTable();
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
            $('#tableImportMaterial').DataTable({
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
                    url: "{{ route('getDataImportMaterial') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        akses: akses,
                        _token: _token
                    },
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
                    },
                    {
                        data: 'wo_date'
                    },
                    {
                        data: 'installation_date'
                    },
                    {
                        data: 'vendor_installer'
                    },
                    {
                        data: 'callsign'
                    },
                    {
                        data: 'area'
                    },
                    {
                        data: 'warehouse'
                    },
                    {
                        data: 'cust_id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'wo_type'
                    },
                    {
                        data: 'remarks'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'status_item'
                    },
                    {
                        data: 'item_code'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'qty'
                    },
                    {
                        data: 'sn'
                    },
                    {
                        data: 'mac_address'
                    },
                    {
                        data: 'material_condition'
                    },
                    {
                        data: 'login_id'
                    },
                ]
            })
        }
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
