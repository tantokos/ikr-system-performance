<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-2 mb-3">
                        <div class="full-background" style="background: linear-gradient(to right, #112133, #21416d);">
                        </div>
                        <div class="card-body text-start p-3 w-100">
                            <h3 class="text-white mb-1">Daftar Root Cause</h3>
                            <p class="mb-3 font-weight-semibold">
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
                    <div class="card border shadow-xs mb-2">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">
                                            Data Root Cause</span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
                                    <button type="button"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                        data-bs-toggle="modal" data-bs-target="#tambahRootCause">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Tambah Root Cause</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="card-body px-2 py-2">
                            <div id="pageLoader" class="loader-overlay" style="display: none;">
                                <div class="loader"></div>
                            </div>

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0" id="tabelRootCause"
                                    style="font-size: 12px; border-color:#9ca0a7;">
                                    <thead class="bg-gray-100">
                                        <tr id="headRootCause" style="font-weight: bold">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Status WO</th>
                                            <th class="text-center text-xs font-weight-semibold">Cause Code</th>
                                            <th class="text-center text-xs font-weight-semibold">Root Cause</th>
                                            <th class="text-center text-xs font-weight-semibold">Action Taken</th>
                                            <th class="text-center text-xs font-weight-semibold">Rootcause Penagihan</th>
                                            <th class="text-center text-xs font-weight-semibold">#</th>

                                        </tr>
                                    </thead>
                                    <tbody id="bodyRootCause" style="font-weight: bold">

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

        {{-- Modal Tambah Rootcause --}}
        <div class="modal fade" id="tambahRootCause" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-l" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Root Cause</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('simpanRootCause') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- <div class="row"> --}}
                                <div class="col">

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Status WO</span>
                                        <select class="form-control form-control-sm" id="status_wo"
                                            name="status_wo" style="border-color:#9ca0a7;" required>
                                            <option value="">--Pilih--</option>
                                            <option value="Done">Done</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Cancel">Cancel</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Cause Code</span>
                                        <input class="form-control form-control-sm" type="text" id="causeCode"
                                            name="causeCode" style="border-color:#9ca0a7;" required>
                                    </div>


                                    <div class="form-group mb-1">
                                        {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                        <span class="text-xs">Root Cause</span>
                                        <input class="form-control form-control-sm" type="text" id="rootcause"
                                            name="rootcause" style="border-color:#9ca0a7;" required>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Action Taken</span>
                                        <input class="form-control form-control-sm" type="text" id="actionTaken"
                                            name="actionTaken" style="border-color:#9ca0a7;" required>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Root Cause Penagihan</span>
                                        <select class="form-control form-control-sm" type="text" id="penagihan"
                                            name="penagihan" style="border-color:#9ca0a7;" required>
                                            <option value="">--Pilih--</option>
                                            @if(isset($listPenagihan))
                                                @foreach ($listPenagihan as $list)
                                                    <option value="{{$list->penagihan}}">{{$list->penagihan}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>    
                                
                                {{-- </div>2 --}}
                                <hr>
                                <div class="row text-center mb-1">
                                    <div class="col">
                                        <button type="submit"
                                            class="btn btn-sm btn-dark align-items-center simpanRootCause"
                                            id="simpanRootCause">Simpan Data</button>
                                        <button type="button" value="close"
                                            class="btn btn-sm btn-dark align-items-center"
                                            data-bs-dismiss="modal">Batalkan</button>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </form>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                        {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Tambah Data Tool --}}

        {{-- Modal Show Detail Data Tool --}}
        <div class="modal fade" id="editRootCause" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-l" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Root Cause</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateRootCause') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- <div class="row"> --}}
                                <div class="col">

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Status WO</span>
                                        <select class="form-control form-control-sm" id="status_woEdit"
                                            name="status_woEdit" style="border-color:#9ca0a7;" required>
                                            <option value="">--Pilih--</option>
                                            <option value="Done">Done</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Cancel">Cancel</option>
                                        </select>
                                        <input type="hidden" id="detid" name="detid">
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Cause Code</span>
                                        <input class="form-control form-control-sm" type="text" id="causeCodeEdit"
                                            name="causeCodeEdit" style="border-color:#9ca0a7;" required>
                                    </div>


                                    <div class="form-group mb-1">
                                        {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                        <span class="text-xs">Root Cause</span>
                                        <input class="form-control form-control-sm" type="text" id="rootcauseEdit"
                                            name="rootcauseEdit" style="border-color:#9ca0a7;" required>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Action Taken</span>
                                        <input class="form-control form-control-sm" type="text" id="actionTakenEdit"
                                            name="actionTakenEdit" style="border-color:#9ca0a7;" required>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Root Cause Penagihan</span>
                                        <select class="form-control form-control-sm" type="text" id="penagihanEdit"
                                            name="penagihanEdit" style="border-color:#9ca0a7;" required>
                                            <option value="">--Pilih--</option>
                                            @if(isset($listPenagihan))
                                                @foreach ($listPenagihan as $list)
                                                    <option value="{{$list->penagihan}}">{{$list->penagihan}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>    
                                
                                {{-- </div>2 --}}
                                <hr>
                                <div class="row text-center mb-1">
                                    <div class="col">
                                        <button type="submit"
                                            class="btn btn-sm btn-dark align-items-center editRootCause"
                                            id="editRootCause">Update Data</button>
                                        <button type="button" value="close"
                                            class="btn btn-sm btn-dark align-items-center"
                                            data-bs-dismiss="modal">Batalkan</button>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </form>
                    </div>
                    {{-- <div class="modal-footer"> --}}
                        {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                        {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    {{-- </div> --}}
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

        $('#tabelRootCause').DataTable().ajax.reload();
    @elseif (session('error'))
        Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: "{{ session('error') }}",
            showConfirmButton: true,
            // timer: 2000
        });

        $('#tabelRootCause').DataTable().ajax.reload();
    @endif

    @if (session()->get('errors'))
        Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: "{{ session()->get('errors')->first() }}",
            showConfirmButton: true,
            // timer: 2000
        });

        $('#tabelRootCause').DataTable().ajax.reload();
    @endif
</script>

<script>
    $(document).ready(function() {

        var _token = $('meta[name=csrf-token]').attr('content');
        var dtDis;
        var dtTim;
        var firstDate;
        var lastDate;
        akses = $('#akses').val();

        $('#simpanRootCause').on('click', function (e) {
            // Cek apakah file sudah dipilih
            if ($('#status_wo').val() === '' || $('#causeCode').val() === '' || $('#rootcause').val() === '' || $('#actionTaken').val() === '' || $('#penagihan').val() === '' ) {
                alert('Silakan lengkapi pengisian terlebih dahulu!');
                e.preventDefault(); // Mencegah form dikirim
                return false;
            }

            $('#tambahRootCause').modal('hide');

            // Tampilkan loader di tengah halaman
            $('#pageLoader').fadeIn();
        });

        // function data_rootcause() {
            $('#tabelRootCause').DataTable({
                // dom: 'Bftip',
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
                // fixedColumns: true,

                // fixedColumns: {
                //     leftColumns: 3,
                //     // rightColumns: 1
                // },
                deferRender: true,
                scrollCollapse: true,
                scrollX: true,
                pageLength: 10,
                lengthChange: true,
                bFilter: true,
                destroy: true,
                processing: true,
                serverSide: false,
                ajax: {
                    url: "{{ route('getListRootCause') }}",
                    type: "get",
                    dataType: "json",
                    data: {
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
                        data: 'status_wo',
                        // width: '90'
                    },
                    {
                        data: 'couse_code'
                    },
                    {
                        data: 'root_couse'
                    },
                    {
                        data: 'action_taken'
                    },
                    {
                        data: 'rootcouse_penagihan'
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        // }
        

        $(document).on('click', '#detail-root', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let dis_id = $(this).data('id');

            $.ajax({
                url: "{{ route('getDetailRootCause') }}",
                type: "get",
                data: {
                    filDisId: dis_id,
                    _token: _token
                },
                success: function(dtRoot) {

                    $('#status_woEdit').val(dtRoot.status_wo)
                    $('#causeCodeEdit').val(dtRoot.couse_code)
                    $('#rootcauseEdit').val(dtRoot.root_couse)
                    $('#actionTakenEdit').val(dtRoot.action_taken)
                    $('#penagihanEdit').val(dtRoot.rootcouse_penagihan)
                    $('#detid').val(dtRoot.id)

                    $('#editRootCause').modal('show');

                }
            })
        })

    })
</script>
