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
                            <h3 class="text-white mb-2">Monitoring Foto WO FTTH Maintenance</h3>
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
                                            {{-- <th class="text-center text-xs font-weight-semibold">WO Date</th> --}}
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
                                            {{-- <th class="text-center text-xs font-weight-semibold">Leader</th> --}}
                                            {{-- <th class="text-center text-xs font-weight-semibold">Teknisi 1</th> --}}
                                            {{-- <th class="text-center text-xs font-weight-semibold">Teknisi 2</th> --}}
                                            {{-- <th class="text-center text-xs font-weight-semibold">Teknisi 3</th> --}}
                                            {{-- <th class="text-center text-xs font-weight-semibold">Teknisi 4</th> --}}
                                            <th class="text-center text-xs font-weight-semibold">Status WO</th>
                                            <th class="text-center text-xs font-weight-semibold">Validasi Input Material</th>
                                            <th class="text-center text-xs font-weight-semibold">Validasi SN/Mac Address</th>
                                            <th class="text-center text-xs font-weight-semibold">Validasi Root Cause & Action Taken</th>
                                            <th class="text-center text-xs font-weight-semibold">Validasi Input Foto</th>
                                            <th class="text-center text-xs font-weight-semibold">Validasi Tanda Tangan</th>
                                            <th class="text-center text-xs font-weight-semibold">Pengecekan FAT</th>
                                            <th class="text-center text-xs font-weight-semibold">Pengecekan Marker</th>
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
        <div class="modal fade" id="showValidasi" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {{-- <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Progress WO FTTH Maintenance</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> --}}
                    <div class="modal-body">
                        <form action="{{ route('saveValidasi') }}" method="post" enctype="multipart/form-data">
                        {{-- <form action="#" method="post" enctype="multipart/form-data"> --}}
                            @csrf

                            

                            {{-- <div class="tab-content"> --}}
                                {{-- <div class="tab-pane active" id="DetailWo" role="tabpanel" aria-expanded="true"> --}}
                                    {{-- <div class="card-body"> --}}

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
                                                <hr>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Validasi Input Material</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="valMaterial" name="valMaterial"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="">Pilih</option>
                                                                <option value="Sesuai">Sesuai</option>
                                                                <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                            </select>
                                                        </div>                                                        
                                                    </div>

                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Validasi SN/Mac Address Perangkat</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="valSnMac" name="valSnMac"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="">Pilih</option>
                                                                <option value="Sesuai">Sesuai</option>
                                                                <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                            </select>
                                                        </div>                                                        
                                                    </div>

                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Validasi Rootcause</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="valRootCause" name="valRootCause"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="">Pilih</option>
                                                                <option value="Sesuai">Sesuai</option>
                                                                <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                            </select>
                                                        </div>                                                        
                                                    </div>

                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Validasi Foto Aplikasi</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="valfoto" name="valfoto"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="">Pilih</option>
                                                                <option value="Sesuai">Sesuai</option>
                                                                <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                            </select>
                                                        </div>                                                        
                                                    </div>

                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Validasi Tanda Tangan</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="valTtd" name="valTtd"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="">Pilih</option>
                                                                <option value="Sesuai">Sesuai</option>
                                                                <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                            </select>
                                                        </div>                                                        
                                                    </div>

                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Pengecekan FAT</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="cekFat" name="cekFat"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="">Pilih</option>
                                                                <option value="Sesuai">Sesuai</option>
                                                                <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                            </select>
                                                        </div>                                                        
                                                    </div>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <div class="row">
                                                        <div class="col form-group mb-1">
                                                            <span class="text-xs">Pengecekan Marker</span>
                                                            <select class="form-control form-control-sm" type="text"
                                                                id="cekMarker" name="cekMarker"
                                                                style="border-color:#9ca0a7;">
                                                                <option value="">Pilih</option>
                                                                <option value="Sesuai">Sesuai</option>
                                                                <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                            </select>
                                                        </div>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- </div> --}}
                                {{-- </div> --}}
                            {{-- </div> --}}

                            
                            
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-dark align-items-center simpanValidasi"
                            id="simpanValidasi">Simpan Data</button>
                        <button type="button" value="close" class="btn btn-sm btn-dark align-items-center"
                            data-bs-dismiss="modal">Batalkan</button>
                    </div>
                    </form>
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
    $(document).ready(function() {
        var _token = $('meta[name=csrf-token]').attr('content');
        var firstDate;
        var lastDate;
        akses = $('#akses').val();
        get_data_assignTim()

        function toTitleCase(str) {
            return str.replace(
                /\w\S*/g,
                text => text.charAt(0).toUpperCase() + text.substring(1).toLowerCase()
            );
        }

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
                    url: "{{ route('getMonitFotoFtthMT') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        _token: _token,
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
                        data: 'wo_no'
                    },
                    // {
                    //     data: 'wo_date_apk'
                    // },
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
                        data: 'fat_code'
                    },
                    {
                        data: 'area'
                    },
                    {
                        data: 'branch'
                    },
                    {
                        data: 'slot_time'
                    },
                    {
                        data: 'callsign'
                    },
                    {
                        data: 'status_wo'
                    },
                    {
                        data: 'val_material'
                    },
                    {
                        data: 'val_sn_mac'
                    },
                    {
                        data: 'val_rootcause'
                    },
                    {
                        data: 'val_input_foto'
                    },
                    {
                        data: 'val_ttd'
                    },
                    {
                        data: 'cek_fat'
                    },
                    {
                        data: 'cek_marker'
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }

        $(document).on('click', '#detail-validasi', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let assign_id = $(this).data('id');


            $.ajax({
                url: "{{ route('getDetailFotoFtthMT') }}",
                type: "get",
                data: {
                    filAssignId: assign_id,
                    _token: _token
                },
                success: function(dtDis) {
                    console.log(dtDis);
                    $('#detId').val(dtDis.data.id)
                    $('#noWoShow').val(dtDis.data.wo_no)
                    $('#ticketNoShow').val(dtDis.data.no_ticket)
                    $('#custIdShow').val(dtDis.data.cust_id)
                    $('#custNameShow').val(toTitleCase(dtDis.data.name))

                    $('#valMaterial').val(dtDis.data.val_material);
                    $('#valSnMac').val(dtDis.data.val_sn_mac);
                    $('#valRootCause').val(dtDis.data.val_rootcause);
                    $('#valfoto').val(dtDis.data.val_input_foto);
                    $('#valTtd').val(dtDis.data.val_ttd);
                    $('#cekFat').val(dtDis.data.cek_fat);
                    $('#cekMarker').val(dtDis.data.cek_marker);

                    $('#showValidasi').modal('show');

                }
            })
        })

    })
</script>
