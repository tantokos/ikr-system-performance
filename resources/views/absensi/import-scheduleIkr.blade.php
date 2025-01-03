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
                            <h3 class="text-white mb-2">Import Jadwal IKR</h3>
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
                            <form action="{{ route('importProsesJadwalIkr') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                {{-- <div class=row> --}}
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label form-control-sm">Tahun</label>
                                        <div class="col form-group">
                                            <select class="form-control form-control-sm" id="tahun"
                                                name="tahun" style="border-color:#9ca0a7;" required>
                                                <option value="">Pilih Tahun</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>

                                            </select>
                                        </div>

                                        <label class="col-sm-2 col-form-label form-control-sm">Bulan</label>
                                        <div class="col form-group">
                                            <select class="form-control form-control-sm" id="bulan"
                                                name="bulan" style="border-color:#9ca0a7;" required>
                                                <option value="">Pilih Bulan</option>
                                                <option value="01">Januari</option>
                                                <option value="02">Februari</option>
                                                <option value="03">Maret</option>
                                                <option value="04">April</option>
                                                <option value="05">Mei</option>
                                                <option value="06">Juni</option>
                                                <option value="07">Juli</option>
                                                <option value="08">Agustus</option>
                                                <option value="09">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>

                                            </select>
                                        </div>
                                    </div>
                                    
                                {{-- </div> --}}

                                <div class="form-group">
                                    <input type="file" class="form-control form-control-sm" id="fileDataJadwal"
                                        name="fileDataJadwal" style="border-color:#9ca0a7;" required>
                                </div>
                                <div class="form-group mb-1">
                                    <button type="submit" class="btn btn-dark btn-sm w-100" onclick="cek()">
                                        <span class="spinner-border spinner-border-sm" style="display: none"
                                            role="status" aria-hidden="true"></span>
                                        Import Data Jadwal IKR</button>
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
                            <form action="{{ route('simpanImportJadwal') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <label class="col-sm-3 col-form-label form-control-sm">Import By</label>
                                    <div class="col form-group">
                                        <input type="text" class="form-control form-control-sm" id="akses"
                                            name="akses" value="{{ $akses }}" readonly />
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- <div class="form-group"> --}}
                                        <label class="col form-control-sm">Information of Data Import :</label>
                                            <div class="form-group">
                                                @if (isset($double))
                                                    @if ($double > 0)
                                                        <span class="error" style="color: red;">Data sudah pernah di import</span>
                                                    @else
                                                        <span class="error">-</span>
                                                    @endif
                                                @endif
                                            </div>
                                    {{-- </div> --}}
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
                        

                            <button onclick="return confirm('Simpan hasil import?')" type="submit" name="action"
                                value="simpan" class="btn btn-sm btn-dark align-items-center">Simpan Import
                                Jadwal IKR</button>
                            <button onclick="return confirm('Hapus hasil import Jadwal IKR?')"
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
                                    <h6 class="font-weight-semibold text-lg">Nama Karyawan Tidak Terdaftar</h6>
                                    {{-- <p class="text-sm">See information about all members</p> --}}
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">
                            <div class="table-responsive">
                                <table class="table table-bordered align-items-center mb-0" id="tabelKaryawanTidakTerdaftar"
                                    style="font-size: 12px; border-color:#9ca0a7;">
                                    <thead class="bg-gray-400">
                                        <tr>
                                            <th class="text-secondary text-xs">#</th>
                                            {{-- <th class="text-center text-secondary text-xs font-weight-semibold">Nik Karyawan</th> --}}
                                            <th class="text-secondary text-xs">Nama Karyawan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="border-top py-3 px-3 d-flex align-items-center">
                                <p class="font-weight-semibold mb-0 text-dark text-sm">Page 1 of 10</p>
                                <div class="ms-auto">
                                    <button class="btn btn-sm btn-white mb-0">Previous</button>
                                    <button class="btn btn-sm btn-white mb-0">Next</button>
                                </div>
                            </div> --}}
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
                                    <h6 class="font-weight-semibold text-lg">Rekap Import Jadwal IKR</h6>
                                    {{-- <p class="text-sm">See information about all members</p> --}}
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">
                            <div class="table-responsive">
                                <table class="table table-bordered align-items-center mb-0" id="tabelRekapJadwalImport"
                                    style="font-size: 12px; border-color:#9ca0a7;">
                                    <thead class="bg-gray-300">
                                        <tr>
                                            <th class="text-secondary text-xs">#</th>
                                            <th class="text-secondary text-xs ps-2">Area</th>
                                            <th class="text-center text-secondary text-xs ">Bulan</th>
                                            <th class="text-center text-secondary text-xs ">Tahun</th>
                                            <th class="text-center text-secondary text-xs ">Status</th>
                                            <th
                                                class="text-center text-secondary text-xs">01</th>
                                            <th
                                                class="text-center text-secondary text-xs">02</th>
                                            <th
                                                class="text-center text-secondary text-xs">03</th>
                                            <th
                                                class="text-center text-secondary text-xs">04</th>
                                            <th
                                                class="text-center text-secondary text-xs">05</th>
                                            <th
                                                class="text-center text-secondary text-xs">06</th>
                                            <th
                                                class="text-center text-secondary text-xs">07</th>
                                            <th
                                                class="text-center text-secondary text-xs">08</th>
                                            <th
                                                class="text-center text-secondary text-xs">09</th>
                                            <th class="text-center text-secondary text-xs">10</th>
                                            <th class="text-center text-secondary text-xs">11</th>
                                            <th class="text-center text-secondary text-xs">12</th>
                                            <th class="text-center text-secondary text-xs">13</th>
                                            <th class="text-center text-secondary text-xs">14</th>
                                            <th class="text-center text-secondary text-xs">15</th>
                                            <th class="text-center text-secondary text-xs">16</th>
                                            <th class="text-center text-secondary text-xs">17</th>
                                            <th class="text-center text-secondary text-xs">18</th>
                                            <th class="text-center text-secondary text-xs">19</th>
                                            <th class="text-center text-secondary text-xs">20</th>
                                            <th class="text-center text-secondary text-xs">21</th>
                                            <th class="text-center text-secondary text-xs">22</th>
                                            <th class="text-center text-secondary text-xs">23</th>
                                            <th class="text-center text-secondary text-xs">24</th>
                                            <th class="text-center text-secondary text-xs">25</th>
                                            <th class="text-center text-secondary text-xs">26</th>
                                            <th class="text-center text-secondary text-xs">27</th>
                                            <th class="text-center text-secondary text-xs">28</th>
                                            <th class="text-center text-secondary text-xs">29</th>
                                            <th class="text-center text-secondary text-xs">30</th>
                                            <th class="text-center text-secondary text-xs">31</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="border-top py-3 px-3 d-flex align-items-center">
                                <p class="font-weight-semibold mb-0 text-dark text-sm">Page 1 of 10</p>
                                <div class="ms-auto">
                                    <button class="btn btn-sm btn-white mb-0">Previous</button>
                                    <button class="btn btn-sm btn-white mb-0">Next</button>
                                </div>
                            </div> --}}
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

                        <div class="card-body px-2 py-2">
                            <div class="table-responsive">
                                <table class="table table-bordered align-items-center mb-0" id="tabelJadwalImport"
                                    style="font-size: 12px; border-color:#9ca0a7;">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th class="text-xs">#</th>
                                            <th class="text-secondary text-xs ps-2">Area</th>
                                            <th class="text-secondary text-xs ps-2">NIK Karyawan</th>
                                            <th class="text-secondary text-xs ps-2">Nama Karyawan</th>
                                            <th class="text-center text-secondary text-xs">Bulan</th>
                                            <th class="text-center text-secondary text-xs">Tahun</th>
                                            <th
                                                class="text-center text-secondary text-xs">01</th>
                                            <th
                                                class="text-center text-secondary text-xs">02</th>
                                            <th
                                                class="text-center text-secondary text-xs">03</th>
                                            <th
                                                class="text-center text-secondary text-xs">04</th>
                                            <th
                                                class="text-center text-secondary text-xs">05</th>
                                            <th
                                                class="text-center text-secondary text-xs">06</th>
                                            <th
                                                class="text-center text-secondary text-xs">07</th>
                                            <th
                                                class="text-center text-secondary text-xs">08</th>
                                            <th
                                                class="text-center text-secondary text-xs">09</th>
                                            <th class="text-center text-secondary text-xs">10</th>
                                            <th class="text-center text-secondary text-xs">11</th>
                                            <th class="text-center text-secondary text-xs">12</th>
                                            <th class="text-center text-secondary text-xs">13</th>
                                            <th class="text-center text-secondary text-xs">14</th>
                                            <th class="text-center text-secondary text-xs">15</th>
                                            <th class="text-center text-secondary text-xs">16</th>
                                            <th class="text-center text-secondary text-xs">17</th>
                                            <th class="text-center text-secondary text-xs">18</th>
                                            <th class="text-center text-secondary text-xs">19</th>
                                            <th class="text-center text-secondary text-xs">20</th>
                                            <th class="text-center text-secondary text-xs">21</th>
                                            <th class="text-center text-secondary text-xs">22</th>
                                            <th class="text-center text-secondary text-xs">23</th>
                                            <th class="text-center text-secondary text-xs">24</th>
                                            <th class="text-center text-secondary text-xs">25</th>
                                            <th class="text-center text-secondary text-xs">26</th>
                                            <th class="text-center text-secondary text-xs">27</th>
                                            <th class="text-center text-secondary text-xs">28</th>
                                            <th class="text-center text-secondary text-xs">29</th>
                                            <th class="text-center text-secondary text-xs">30</th>
                                            <th class="text-center text-secondary text-xs">31</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="border-top py-3 px-3 d-flex align-items-center">
                                <p class="font-weight-semibold mb-0 text-dark text-sm">Page 1 of 10</p>
                                <div class="ms-auto">
                                    <button class="btn btn-sm btn-white mb-0">Previous</button>
                                    <button class="btn btn-sm btn-white mb-0">Next</button>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- <x-app.footer /> --}}
        </div>

        

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
        var leadCallDt;
        var branchImport;

        akses = $('#akses').val();
        data_import()
        karyawan_tidakTerdaftar()
        rekap_data_import()

        // bln = new Date($('#periodeMin').val()).getMonth();
        // thn = new Date($('#periodeMin').val()).getFullYear();

        // firstDate = moment([thn, bln]);
        // lastDate = moment(firstDate).endOf('month');

        function data_import() {
            $('#tabelJadwalImport').DataTable({
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
                    leftColumns: 4,
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
                serverSide: true,
                ajax: {
                    url: "{{ route('getdataImportJadwal') }}",
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
                    {data: 'branch'},
                    {
                        data: 'nik_karyawan',
                        width: '90'
                    },
                    {
                        data: 'nama_karyawan'
                    },
                    {
                        data: 'bulanname'
                    },
                    {
                        data: 'tahun'
                    },
                    {data: 't01'},{data: 't02'},{data: 't03'},{data: 't04'},{data: 't05'},{data: 't06'},{data: 't07'},{data: 't08'},{data: 't09'},{data: 't10'},
                    {data: 't11'},{data: 't12'},{data: 't13'},{data: 't14'},{data: 't15'},{data: 't16'},{data: 't17'},{data: 't18'},{data: 't19'},{data: 't20'},
                    {data: 't21'},{data: 't22'},{data: 't23'},{data: 't24'},{data: 't25'},{data: 't26'},{data: 't27'},{data: 't28'},{data: 't29'},{data: 't30'},
                    {data: 't31'},
                    
                ],
            })
        }

        function rekap_data_import() {
            $('#tabelRekapJadwalImport').DataTable({
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
                    leftColumns: 4,
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
                serverSide: true,
                ajax: {
                    url: "{{ route('getRekapDataImportJadwal') }}",
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
                    {data: 'branch'},
                    {
                        data: 'bulanname'
                    },
                    {
                        data: 'tahun'
                    },                    
                    {
                        data: 'status'
                    },
                    {data: 't01'},{data: 't02'},{data: 't03'},{data: 't04'},{data: 't05'},{data: 't06'},{data: 't07'},{data: 't08'},{data: 't09'},{data: 't10'},
                    {data: 't11'},{data: 't12'},{data: 't13'},{data: 't14'},{data: 't15'},{data: 't16'},{data: 't17'},{data: 't18'},{data: 't19'},{data: 't20'},
                    {data: 't21'},{data: 't22'},{data: 't23'},{data: 't24'},{data: 't25'},{data: 't26'},{data: 't27'},{data: 't28'},{data: 't29'},{data: 't30'},
                    {data: 't31'},
                    
                ],
            })
        }

        function karyawan_tidakTerdaftar() {
            $('#tabelKaryawanTidakTerdaftar').DataTable({
                // dom: 'Bftip',
                // layout: {
                //     topStart: {
                //         buttons: ['excel']
                //     },
                // },
                paging: true,
                orderClasses: false,
                // fixedColumns: true,

                // fixedColumns: {
                    // leftColumns: 4,
                    // rightColumns: 1
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
                    url: "{{ route('getKaryawanTidakTerdaftar') }}",
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
                        "width": '10'
                    },
                    // {data: 'nik_karyawan'},
                    {data: 'nama_karyawan', "classNmae": "text-center",
                    }
                ],
            })
        }

        $(document).on('click', '#detail-importWo', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let wo_id = $(this).data('id');
            branchImport = $('#branchImport').val();

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
