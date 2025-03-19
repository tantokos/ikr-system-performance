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
                            <h3 class="text-white mb-2">Konfirmasi Customer</h3>
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
                                        <input type="text" class="form-control form-control-sm" type="text" id="filnoWo"
                                            name="filnoWo" style="border-color:#9ca0a7;">
                                    </div>
                                </div>

                                <div class="col">

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Cust Id</span>
                                        <input type="text" class="form-control form-control-sm" id="filcustId" name="filcustId"
                                            style="border-color:#9ca0a7;">
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

            <div class="row mb-3">
                <div class="col-xl-3 col-sm-3">
                    <div class="card border shadow-lg mb-2">
                        <div class="card-body text-start p-3 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100 text-center">
                                        <p class="text-secondary mb-1" style="font-size: 0.82rem;">Total Data</p>
                                        <h5 class="mb-2 font-weight-bold" id="totTotal"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-3">
                    <div class="card border shadow-lg mb-2">
                        <div class="card-body text-start p-3 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100 text-center">
                                        <p class="text-secondary mb-1" style="font-size: 0.82rem;">Total Tidak Respon</p>
                                        <h4 class="mb-2 font-weight-bold" id="totDone"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-3">
                    <div class="card border shadow-lg mb-2">
                        <div class="card-body text-start p-3 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100 text-center">
                                        <p class="text-sm text-secondary mb-1">Total Pending</p>
                                        <h4 class="mb-2 font-weight-bold" id="totPending"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-3">
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
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Data Konfirmasi Customer</span>
                                    </h6>
                                </div>

                                {{-- <div class="ms-auto d-flex">
                                    <a href="#" id="exportButton">
                                        <button type="button" class="btn btn-sm btn-icon d-flex align-items-center me-2"
                                            style="background-color: #1abd64; border-color: #1abd64; color: white; padding: 5px 12px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20"
                                                height="20" viewBox="0 0 50 50" style="margin-right: 8px;">
                                                <path fill="white"
                                                    d="M 28.875 0 C 28.855469 0.0078125 28.832031 0.0195313 28.8125 0.03125 L 0.8125 5.34375 C 0.335938 5.433594 -0.0078125 5.855469 0 6.34375 L 0 43.65625 C -0.0078125 44.144531 0.335938 44.566406 0.8125 44.65625 L 28.8125 49.96875 C 29.101563 50.023438 29.402344 49.949219 29.632813 49.761719 C 29.859375 49.574219 29.996094 49.296875 30 49 L 30 44 L 47 44 C 48.09375 44 49 43.09375 49 42 L 49 8 C 49 6.90625 48.09375 6 47 6 L 30 6 L 30 1 C 30.003906 0.710938 29.878906 0.4375 29.664063 0.246094 C 29.449219 0.0546875 29.160156 -0.0351563 28.875 0 Z M 28 2.1875 L 28 6.53125 C 27.867188 6.808594 27.867188 7.128906 28 7.40625 L 28 42.8125 C 27.972656 42.945313 27.972656 43.085938 28 43.21875 L 28 47.8125 L 2 42.84375 L 2 7.15625 Z M 30 8 L 47 8 L 47 42 L 30 42 L 30 37 L 34 37 L 34 35 L 30 35 L 30 29 L 34 29 L 34 27 L 30 27 L 30 22 L 34 22 L 34 20 L 30 20 L 30 15 L 34 15 L 34 13 L 30 13 Z M 36 13 L 36 15 L 44 15 L 44 13 Z M 6.6875 15.6875 L 12.15625 25.03125 L 6.1875 34.375 L 11.1875 34.375 L 14.4375 28.34375 C 14.664063 27.761719 14.8125 27.316406 14.875 27.03125 L 14.90625 27.03125 C 15.035156 27.640625 15.160156 28.054688 15.28125 28.28125 L 18.53125 34.375 L 23.5 34.375 L 17.75 24.9375 L 23.34375 15.6875 L 18.65625 15.6875 L 15.6875 21.21875 C 15.402344 21.941406 15.199219 22.511719 15.09375 22.875 L 15.0625 22.875 C 14.898438 22.265625 14.710938 21.722656 14.5 21.28125 L 11.8125 15.6875 Z M 36 20 L 36 22 L 44 22 L 44 20 Z M 36 27 L 36 29 L 44 29 L 44 27 Z M 36 35 L 36 37 L 44 37 L 44 35 Z">
                                                </path>
                                            </svg>
                                            <span class="btn-inner--text">Export</span>
                                        </button>
                                    </a>
                                </div> --}}

                                <div class="ms-auto d-flex">
                                    <a href="{{ route('send-broadcast') }}" class="btn btn-success" id="sendBroadcast">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 50 50"
                                            style="margin-right: 8px;">
                                            <path fill="white" d="M25.002,2.002C12.745,2.002,2.48,12.268,2.48,24.524c0,4.073,1.08,8.052,3.12,11.513l-3.64,10.724
                                            l11.035-3.603c3.33,1.812,7.067,2.76,10.952,2.76c12.257,0,22.522-10.265,22.522-22.521S37.259,2.002,25.002,2.002z
                                            M25.002,42.506c-3.532,0-6.984-0.939-10.002-2.72l-0.718-0.426l-6.564,2.145l2.165-6.379l-0.465-0.734
                                            c-1.95-3.083-2.98-6.615-2.98-10.176c0-10.398,8.462-18.86,18.86-18.86s18.86,8.462,18.86,18.86
                                            C43.862,34.044,35.4,42.506,25.002,42.506z M35.052,30.39c-0.553,1.545-3.021,2.926-4.167,3.123c-1.097,0.191-2.5,0.273-4.057-0.35
                                            c-0.933-0.37-2.125-0.69-3.514-1.591c-1.586-1.035-2.793-2.34-3.885-3.728c-1.093-1.39-2.007-2.937-2.646-4.47
                                            c-0.74-1.745-1.201-3.688-1.184-4.905c0.016-1.221,0.309-2.595,0.862-3.302c0.553-0.707,1.216-0.856,1.641-0.856
                                            s0.821-0.016,1.186,0.994c0.48,1.314,1.626,4.109,1.768,4.411c0.144,0.301,0.24,0.64,0.048,1.035
                                            c-0.191,0.395-0.289,0.64-0.577,1.005c-0.288,0.366-0.607,0.652-0.877,0.937c-0.288,0.309-0.59,0.607-0.24,1.203
                                            c0.347,0.595,1.527,2.521,3.27,4.07c2.251,2.017,4.144,2.647,4.742,2.937c0.596,0.288,0.939,0.24,1.281-0.145
                                            c0.367-0.395,1.523-1.535,1.928-2.058c0.395-0.523,0.82-0.438,1.363-0.264c0.543,0.174,3.436,1.621,3.686,1.752
                                            C34.646,28.425,35.606,28.845,35.052,30.39z" />
                                        </svg>
                                        Kirim Konfirmasi Whatsapp
                                    </a>
                                </div>

                            </div>
                        </div>

                        <div class="card-body px-2 py-2">
                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="tabelAssignTim">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Tanggal IKR</th>
                                            <th class="text-center text-xs font-weight-semibold">No WO</th>
                                            <th class="text-center text-xs font-weight-semibold">WO Date</th>
                                            <th class="text-center text-xs font-weight-semibold">Cust Id</th>
                                            <th class="text-center text-xs font-weight-semibold">Cust Phone</th>
                                            <th class="text-center text-xs font-weight-semibold">Cust Name</th>
                                            <th class="text-center text-xs font-weight-semibold">Type WO</th>
                                            <th class="text-center text-xs font-weight-semibold">Branch</th>
                                            <th class="text-center text-xs font-weight-semibold">Slot Time</th>
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

    </main>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-html5-3.1.0/fc-5.0.1/r-3.0.2/datatables.min.js">
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


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">

    $(document).ready(function () {
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

        $(document).on('click', '#filAssignTim', function (e) {
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
                    url: "{{ route('getDataCustomer') }}",
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
                    { data: 'cust_phone_apk' },
                    { data: 'name_cust_apk' },
                    { data: 'wo_type_apk' },
                    { data: 'branch' },
                    { data: 'slot_time' },

                ],
                drawCallback: function (settings) {
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

    })
</script>
