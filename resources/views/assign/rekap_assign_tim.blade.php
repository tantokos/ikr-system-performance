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
                            <h3 class="text-white mb-2">Rekap Assign Tim IKR</h3>
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
                                    <span class="text-xs">PIC Assign Tim</span>
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
                            </div>

                            <div class="row">

                                {{-- <div class="col"> --}}



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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Rekap Data
                                            Assign Tim </span><span id="periode"></span></h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                {{-- <div class="ms-auto d-flex">
                                    <span class="text-xs">Periode : -</span>
                                </div> --}}
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">
                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="rekapAssignTim" style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Area</th>
                                            <th class="text-center text-xs font-weight-semibold">PIC Assign Tim</th>
                                            <th class="text-center text-xs font-weight-semibold">FTTH New Installation</th>
                                            <th class="text-center text-xs font-weight-semibold">FTTH Maintenance</th>
                                            <th class="text-center text-xs font-weight-semibold">Dismantle</th>
                                            <th class="text-center text-xs font-weight-semibold">FTTX New Installation</th>
                                            <th class="text-center text-xs font-weight-semibold">FTTX Maintenance</th>
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

        {{-- Modal Detail Assign Tim --}}
        <div class="modal fade" id="modalDataAssignTim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Assign Tim</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card border shadow-xs mb-4">
                                    <div class="card-body px-2 py-2">
                                        <div class="table-responsive p-0">
                                            <table class="table table-striped table-bordered align-items-center mb-0"
                                                id="tabelAssignTim" style="font-size: 12px">
                                                <thead class="bg-gray-100">
                                                    <tr id="headTool">
                                                        <th class="text-xs font-weight-semibold">#</th>
                                                        <th class="text-center text-xs font-weight-semibold">Tanggal
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">No WO</th>
                                                        <th class="text-center text-xs font-weight-semibold">WO Date
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Cust Id
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Cust Name
                                                        </th>
                                                        {{-- <th class="text-center text-xs font-weight-semibold">Cust Address</th> --}}
                                                        <th class="text-center text-xs font-weight-semibold">Type WO
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Fat Code
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Area</th>
                                                        <th class="text-center text-xs font-weight-semibold">Cluster
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Slot Time
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Lead
                                                            Callsign</th>
                                                        <th class="text-center text-xs font-weight-semibold">Leader
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Callsign
                                                            Tim</th>
                                                        <th class="text-center text-xs font-weight-semibold">Teknisi 1
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Teknisi 2
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Teknisi 3
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Teknisi 4
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold">Leader
                                                            Assign</th>
                                                        {{-- <th class="text-center text-xs font-weight-semibold">#</th> --}}

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
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Detail Assign Tim --}}

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
            $('#periode').text("Tanggal " + stDate + " s/d " + enDate);
        })

        $('#filAssignTim').trigger("click");

        function data_assignTim() {
            $('#rekapAssignTim').DataTable({
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
                    leftColumns: 6,
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
                    url: "{{ route('getTabelLeadAssignTim') }}",
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
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_Row_Index',
                        "className": "text-center",
                        // orderable: false,
                        searchable: false,
                        "width": '10'
                    },
                    {
                        data: 'branch',
                        // width: '90'
                    },
                    {
                        data: 'login'
                    },
                    {
                        data: 'ftth_ib',
                        "className": "text-center",
                    },
                    {
                        data: 'ftth_mt',
                        "className": "text-center",
                    },
                    {
                        data: 'dismantle',
                        "className": "text-center",
                    },
                    {
                        data: 'fttx_ib',
                        "className": "text-center",
                    },
                    {
                        data: 'fttx_mt',
                        "className": "text-center",
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }

        $(document).on('click', '#showDetAssignTim', function(e) {
            e.preventDefault();
            $('#modalDataAssignTim').modal('show');

            detail_assignTim($(this).data('id'));

        })


        function detail_assignTim(data) {
            $('#tabelAssignTim').DataTable({
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
                    leftColumns: 6,
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
                    url: "{{ route('getDetailLeadAssignTim') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        filTgl: $('#filtglProgress').val(),
                        filBrnchLead: data,
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
                        data: 'no_wo_apk'
                    },
                    {
                        data: 'wo_date_apk'
                    },
                    {
                        data: 'cust_id_apk'
                    },
                    {
                        data: 'name_cust_apk'
                    },
                    {
                        data: 'wo_type_apk'
                    },
                    {
                        data: 'fat_code_apk'
                    },
                    {
                        data: 'branch'
                    },
                    {
                        data: 'area_cluster_apk'
                    },
                    {
                        data: 'slot_time'
                    },
                    {
                        data: 'leadcall'
                    },
                    {
                        data: 'leader'
                    },
                    {
                        data: 'callsign'
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
                        data: 'login',
                    },
                    // {
                    //     data: 'action',
                    //     "className": "text-center",
                    // },
                ]
            })
        }


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
                    $('#noWoShow').val(dtDis.data.wo_no)
                    $('#ticketNoShow').val(dtDis.data.ticket_no)
                    $('#woTypeShow').val(toTitleCase(dtDis.data.wo_type))
                    $('#jenisWoShow').val(dtDis.data.jenis_wo)
                    $('#WoDateShow').val(dtDis.data.wo_date)
                    $('#custIdShow').val(dtDis.data.cust_id)
                    $('#custNameShow').val(toTitleCase(dtDis.data.name))
                    $('#custPhoneShow').val(dtDis.data.cust_phone)

                    $('#custMobileShow').val(dtDis.data.cust_mobile);
                    $('#custAddressShow').val(toTitleCase(dtDis.data.address));
                    $('#areaShow').val(toTitleCase(dtDis.data.area));
                    $('#ikrDateApkShow').val(dtDis.data.ikr_date);
                    $('#timeApkShow').val(dtDis.data.time);
                    $('#fatCodeShow').val(dtDis.data.fat_code);
                    $('#portFatShow').val(dtDis.data.fat_port);
                    $('#remarksShow').val(toTitleCase(dtDis.data.remarks));

                    $('#branchShow').val(dtDis.data.branch_id + '|' + dtDis.data.branch);
                    $('#tglProgressShow').val(dtDis.data.tgl_ikr);

                    $('#sesiShow').val(dtDis.data.batch_wo);

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


    })
</script>
