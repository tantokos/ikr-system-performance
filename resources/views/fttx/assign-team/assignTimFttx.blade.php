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
                            <h3 class="text-white mb-2">Assign Tim FTTX</h3>
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
                                    <span class="text-xs">No SO</span>
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
                                        <option value="FTTX New Installation">FTTX New Installation</option>
                                        <option value="FTTX Maintenance">FTTX Maintenance</option>
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
                                    <h6 class="font-weight-semibold text-lg mb-0">
                                        <span id="titleLead">Data Assign Tim FTTX</span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
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

                                    <a href="{{ route('fttx.import.assign-team') }}">
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
                                            <th class="text-center text-xs font-weight-semibold">No SO</th>
                                            <th class="text-center text-xs font-weight-semibold">Cust Name</th>
                                            <th class="text-center text-xs font-weight-semibold">Cust Address</th>
                                            <th class="text-center text-xs font-weight-semibold">PIC Customer</th>
                                            <th class="text-center text-xs font-weight-semibold">WO Type</th>
                                            <th class="text-center text-xs font-weight-semibold">Area</th>
                                            <th class="text-center text-xs font-weight-semibold">Branch</th>
                                            <th class="text-center text-xs font-weight-semibold">Slot Time</th>
                                            <th class="text-center text-xs font-weight-semibold">Lead Callsign</th>
                                            <th class="text-center text-xs font-weight-semibold">Leader</th>
                                            <th class="text-center text-xs font-weight-semibold">Callsign Tim</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 1</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 2</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 3</th>
                                            <th class="text-center text-xs font-weight-semibold">Teknisi 4</th>
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

        @include('fttx.assign-team.modal.add-assign-team');
        @include('fttx.assign-team.modal.detail-assign-team');

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
                        pageLength: {
                            menu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                        } ,
                        buttons: ['excel'],
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
                lengthChange: true,
                bFilter: true,
                destroy: true,
                processing: true,
                serverSide: false, // Ubah ke serverSide jika memang menggunakan serverside
                ajax: {
                    url: "{{ route('getTabelAssignTimFttx') }}",
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
                    { data: 'jadwal_ikr' },
                    { data: 'no_so' },
                    { data: 'customer_name' },
                    { data: 'address',
                        render: function (data, type, row)
                        {
                            return "<div class='text-wrap'>" + data + "</div>"
                        }
                    },
                    { data: 'pic_customer' },
                    { data: 'wo_type' },
                    { data: 'area' },
                    { data: 'branch' },
                    { data: 'slot_time_jadwal' },
                    { data: 'leadcall' },
                    { data: 'leader' },
                    { data: 'callsign' },
                    { data: 'tim_1' },
                    { data: 'tim_2' },
                    { data: 'tim_3' },
                    { data: 'tim_4' },
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
                url: "{{ route('getDetailAssignFttx') }}",
                type: "get",
                data: {
                    filAssignId: assign_id,
                    _token: _token
                },
                success: function(dtDis) {
                    console.log(dtDis);
                    $('#detId').val(dtDis.data.id)
                    $('#noSo').val(dtDis.data.no_so)
                    $('#woType').val(dtDis.data.wo_type)
                    $('#picCustomer').val(dtDis.data.pic_customer)
                    $('#soDate').val(dtDis.data.so_date)
                    $('#customerName').val(toTitleCase(dtDis.data.customer_name))
                    $('#phonePicCust').val(dtDis.data.phone_pic_cust)
                    $('#productShow').val(toTitleCase(dtDis.data.product))
                    $('#branchShow').val(dtDis.data.branch_id + '|' + dtDis.data.branch);
                    $('#teknisi1').val(dtDis.data.tim_1)
                    $('#teknisi2').val(dtDis.data.tim_2)
                    $('#teknisi3').val(dtDis.data.tim_3)
                    $('#teknisi4').val(dtDis.data.tim_4)
                    $('#addressShow').val(dtDis.data.address)
                    $('#remarkEwo').val(dtDis.data.remark_ewo)
                    $('#cidShow').val(dtDis.data.cid)
                    $('#segmentSales').val(dtDis.data.segment_sales)
                    $('#checkinShow').val(dtDis.data.checkin)
                    $('#checkoutShow').val(dtDis.data.checkout)
                    $('#statusWo').val(dtDis.data.status_wo)
                    $('#areaShow').val(dtDis.data.area)
                    $('#statusPenjadwalan').val(dtDis.data.status_penjadwalan)
                    $('#jadwalIkr').val(dtDis.data.jadwal_ikr)
                    $('#slotTimeJadwal').val(dtDis.data.slot_time_jadwal)
                    $('#nopolShow').val(dtDis.data.nopol)
                    $('#perubahanSlotTimeTele').val(dtDis.data.perubahan_slot_time_tele)
                    $('#keteranganWo').val(dtDis.data.keterangan_wo)
                    $('#remarkForIkr').val(dtDis.data.remark_for_ikr)

                    leadCallsignDet = dtDis.data.leadcall_id + '|' + dtDis.data.leadcall
                    // document.getElementById("LeadCallsignShow").value = leadCallsignDet;
                    $('#LeadCallsignShow').val(leadCallsignDet);
                    // $('#LeadCallsignShow').trigger('change');

                    $('#leaderShow').val(dtDis.data.leader);
                    $('#leaderidShow').val(dtDis.data.leader_id);
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
                    $('#teknisi1Show').val(dtDis.data.tek1_nik + '|' + dtDis.data.tim_1);
                    $('#teknisi2Show').val(dtDis.data.tek2_nik + '|' + dtDis.data.tim_2);
                    $('#teknisi3Show').val(dtDis.data.tek3_nik + '|' + dtDis.data.tim_3);
                    $('#teknisi4Show').val(dtDis.data.tek4_nik + '|' + dtDis.data.tim_4);

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
                    $('#leaderidShow').val(dtLead.callLead.leader_id)
                    $('#leaderShow').val(dtLead.callLead.nama_karyawan)
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
