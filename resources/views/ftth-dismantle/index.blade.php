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
                                            <th class="text-center text-xs font-weight-semibold">Status WO</th>

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
    $(document).ready(function() {
        var _token = $('meta[name=csrf-token]').attr('content');
        var firstDate;
        var lastDate;
        var stDate;
        var enDate;
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

        $(document).on('click', '#filAssignTim', function(e) {
            get_data_assignTim();
            stDate = $('.date-range').data('daterangepicker').startDate.format("DD-MMM-YYYY");
            enDate = $('.date-range').data('daterangepicker').endDate.format("DD-MMM-YYYY");
        })

        $('#filAssignTim').trigger("click");

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
                        data: 'status_wo'
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }

        $(document).on('click', '#detail-assign', function(e) {

            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let assign_id = $(this).data('id');


            $.ajax({
                url: "{{ route('getFtthDismantle') }}",
                type: "get",
                data: {
                    filAssignId: assign_id,
                    _token: _token
                },
                success: function(dtDis) {

                    function floatToTime(float) {
                        // Konversi float menjadi total menit
                        let totalMinutes = Math.floor(float * 60 * 24);
                        let hours = Math.floor(totalMinutes / 60);
                        let minutes = totalMinutes % 60;

                        // Format supaya jam dan menit memiliki dua digit
                        hours = hours < 10 ? '0' + hours : hours;
                        minutes = minutes < 10 ? '0' + minutes : minutes;

                        return `${hours}:${minutes}`;
                    }

                    // console.log(dtDis);
                    let checkinDate = new Date(dtDis.data.checkin_apk).toISOString().slice(0, 10);
                    let checkoutDate = new Date(dtDis.data.checkout_apk).toISOString().slice(0, 10);
                    let slotTimeLeader = floatToTime(dtDis.data.slot_time_leader);
                    // let timeValue = dtDis.data.slot_time_apk.replace('.', ':').slice(0, 5);
                    console.log(slotTimeLeader);

                    $('#detId').val(dtDis.data.id)
                    $('#noWoShow').val(dtDis.data.no_wo)
                    $('#statusWoShow').val(dtDis.data.status_wo).change()
                    $('#ticketNoShow').val(dtDis.data.no_ticket)
                    $('#woTypeShow').val(toTitleCase(dtDis.data.type_wo))
                    $('#jenisWoShow').val(dtDis.data.type_wo)
                    $('#WoDateShow').val(dtDis.data.wo_date)
                    $('#custIdShow').val(dtDis.data.cust_id)
                    $('#custNameShow').val(toTitleCase(dtDis.data.nama_cust))
                    // $('#custPhoneShow').val(dtDis.data.cust_phone)

                    // $('#custMobileShow').val(dtDis.data.cust_mobile);
                    $('#custAddressShow').val(toTitleCase(dtDis.data.cust_address1));
                    // $('#ikrDateApkShow').val(dtDis.data.ikr_date);
                    $('#timeApkShow').val(dtDis.data.time);
                    $('#fatCodeShow').val(dtDis.data.kode_fat);
                    $('#portFatShow').val(dtDis.data.port_fat);
                    $('#remarksShow').val(toTitleCase(dtDis.data.type_maintenance));

                    $('#branchShow').val(dtDis.data.branch);
                    $('#tglProgressShow').val(dtDis.data.visit_date);
                    $('#tglProgressStatusShow').val(dtDis.data.visit_date);
                    $('#tglProgressAPKShow').val(dtDis.data.visit_date);

                    $('#sesiShow').val(dtDis.data.sesi);
                    $('#slotTimeLeaderShow').val(slotTimeLeader);
                    $('#slotTimeAPKShow').val(dtDis.data.slot_time_apk);

                    $('#slotTimeLeaderStatusShow').val(slotTimeLeader);
                    // $('#slotTimeAPKStatusShow').val(timeValue);


                    $('#leaderShow').val(dtDis.data.leader);
                    $('#LeadCallsignShow').val(dtDis.data.leadcall_id);
                    $('#callsignTimidShow').val(dtDis.data.callsign_id);
                    // $('#teknisi1Show').val(toTitleCase(dtDis.data.teknisi1));
                    // $('#teknisi2Show').val(toTitleCase(dtDis.data.teknisi2));

                    $('#statusWo').val(dtDis.data.status_wo);
                    $('#statusWoApk').val(dtDis.data.status_apk);

                    $('#causeCode').val(dtDis.data.couse_code);
                    $('#rootCause').val(dtDis.data.root_couse);
                    $('#actionTaken').val(dtDis.data.action_taken);
                    $('#penagihanShow').val(dtDis.data.penagihan);

                    $('#actionTakenAPK').val(dtDis.data.action_taken);
                    $('#tglCheckinApk').val(checkinDate);
                    $('#tglCheckoutApk').val(checkoutDate);
                    $('#teknisi1Show').val(dtDis.data.teknisi1);
                    $('#merkStbIn').val(dtDis.data.stb_merk_in);
                    $('#merkStbOut').val(dtDis.data.stb_merk_out);
                    $('#merkOntOut').val(dtDis.data.ont_merk_out);
                    $('#snStbIn').val(dtDis.data.stb_sn_in);
                    $('#snStbOut').val(dtDis.data.stb_sn_out);
                    $('#kabelPrecon').val(dtDis.data.precon_out);
                    $('#kabelPreconBad').val(dtDis.data.bad_precon);


                    $('#showDetail').modal('show');

                }
            })
        })


    })
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
