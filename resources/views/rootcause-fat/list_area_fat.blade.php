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
                            <h3 class="text-white mb-1">Daftar Area FAT</h3>
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
                                            Data Area FAT</span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
                                    <button type="button"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                        data-bs-toggle="modal" data-bs-target="#tambahAreaFat">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Tambah Area FAT</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="card-body px-2 py-2">
                            <div id="pageLoader" class="loader-overlay" style="display: none;">
                                <div class="loader"></div>
                            </div>

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0" id="tabelAreaFat"
                                    style="font-size: 12px; border-color:#9ca0a7;">
                                    <thead class="bg-gray-100">
                                        <tr id="headAreaFat" style="font-weight: bold">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Kode Area</th>
                                            <th class="text-center text-xs font-weight-semibold">Cluster</th>
                                            <th class="text-center text-xs font-weight-semibold">Kotamadya</th>
                                            <th class="text-center text-xs font-weight-semibold">Kotamadya Penagihan</th>
                                            <th class="text-center text-xs font-weight-semibold">Branch</th>
                                            <th class="text-center text-xs font-weight-semibold">Site</th>
                                            <th class="text-center text-xs font-weight-semibold">Kategori Area</th>
                                            <th class="text-center text-xs font-weight-semibold">#</th>

                                        </tr>
                                    </thead>
                                    <tbody id="bodyAreaFat" style="font-weight: bold">

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
        <div class="modal fade" id="tambahAreaFat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-l" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Area FAT</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route("simpanAreaFat") }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- <div class="row"> --}}
                                <div class="col">

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Kode Area</span>
                                        <input class="form-control form-control-sm" type="text" id="kodeArea"
                                            name="kodeArea" style="border-color:#9ca0a7; text-transform: uppercase;" required>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Cluster</span>
                                        <input class="form-control form-control-sm" type="text" id="cluster"
                                            name="cluster" style="border-color:#9ca0a7;" required>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Branch</span>
                                        <select class="form-control form-control-sm" id="branch"
                                            name="branch" style="border-color:#9ca0a7;" required>
                                            <option value="">--Pilih--</option>
                                            @if(isset($listBranch))
                                                @foreach ($listBranch as $list)
                                                    <option value="{{$list->nama_branch}}">{{$list->nama_branch}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Kotamadya</span>
                                        <input class="form-control form-control-sm" type="text" id="kotamadya"
                                            name="kotamadya" style="border-color:#9ca0a7;" required>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Kotamadya Penagihan</span>
                                        <input class="form-control form-control-sm" type="text" id="kotaPenagihan"
                                            name="kotaPenagihan" style="border-color:#9ca0a7;" required>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Site Penagihan</span>
                                        <select class="form-control form-control-sm" id="sitePenagihan"
                                            name="sitePenagihan" style="border-color:#9ca0a7;" required>
                                            <option value="">--Pilih--</option>
                                            <option value="Retail">Retail</option>
                                            <option value="Apartemen">Apartemen</option>
                                            <option value="Underground">Underground</option>
                                            <option value="Retail / Underground">Retail / Underground</option>
                                            
                                        </select>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Kategori Area</span>
                                        <select class="form-control form-control-sm" type="text" id="kategoriArea"
                                            name="kategoriArea" style="border-color:#9ca0a7;" required>
                                            <option value="">--Pilih--</option>
                                            <option value="Jabotabek">Jabotabek</option>
                                            <option value="Regional">Regional</option>
                                        </select>
                                    </div>
                                </div>    
                                
                                {{-- </div>2 --}}
                                <hr>
                                <div class="row text-center mb-1">
                                    <div class="col">
                                        <button type="submit"
                                            class="btn btn-sm btn-dark align-items-center simpanAreaFat"
                                            id="simpanAreaFat">Simpan Data</button>
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
        <div class="modal fade" id="editAreaFat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-l" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Area FAT</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateAreaFat') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- <div class="row"> --}}
                                <div class="col">

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Kode Area</span>
                                        <input class="form-control form-control-sm" type="text" id="kodeAreaEdit"
                                            name="kodeAreaEdit" style="border-color:#9ca0a7;text-transform: uppercase;" required>

                                        <input type="hidden" id="detid" name="detid" value="" required>

                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Cluster</span>
                                        <input class="form-control form-control-sm" type="text" id="clusterEdit"
                                            name="clusterEdit" style="border-color:#9ca0a7;" required>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Branch</span>
                                        <select class="form-control form-control-sm" id="branchEdit"
                                            name="branchEdit" style="border-color:#9ca0a7;" required>
                                            <option value="">--Pilih--</option>
                                            @if(isset($listBranch))
                                                @foreach ($listBranch as $list)
                                                    <option value="{{$list->nama_branch}}">{{$list->nama_branch}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Kotamadya</span>
                                        <input class="form-control form-control-sm" type="text" id="kotamadyaEdit"
                                            name="kotamadyaEdit" style="border-color:#9ca0a7;" required>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Kotamadya Penagihan</span>
                                        <input class="form-control form-control-sm" type="text" id="kotaPenagihanEdit"
                                            name="kotaPenagihanEdit" style="border-color:#9ca0a7;" required>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Site Penagihan</span>
                                        <select class="form-control form-control-sm" id="sitePenagihanEdit"
                                            name="sitePenagihanEdit" style="border-color:#9ca0a7;" required>
                                            <option value="">--Pilih--</option>
                                            <option value="Retail">Retail</option>
                                            <option value="Apartemen">Apartemen</option>
                                            <option value="Underground">Underground</option>
                                            <option value="Retail / Underground">Retail / Underground</option>
                                            
                                        </select>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Kategori Area</span>
                                        <select class="form-control form-control-sm" type="text" id="kategoriAreaEdit"
                                            name="kategoriAreaEdit" style="border-color:#9ca0a7;" required>
                                            <option value="">--Pilih--</option>
                                            <option value="Jabotabek">Jabotabek</option>
                                            <option value="Regional">Regional</option>
                                        </select>
                                    </div>
                                </div>    
                                
                                {{-- </div>2 --}}
                                <hr>
                                <div class="row text-center mb-1">
                                    <div class="col">
                                        <button type="submit"
                                            class="btn btn-sm btn-dark align-items-center EditAreaFat"
                                            id="EditAreaFat">Simpan Data</button>
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

        $('#tabelAreaFat').DataTable().ajax.reload();
    @elseif (session('error'))
        Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: "{{ session('error') }}",
            showConfirmButton: true,
            // timer: 2000
        });

        $('#tabelAreaFat').DataTable().ajax.reload();
    @endif

    @if (session()->get('errors'))
        Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: "{{ session()->get('errors')->first() }}",
            showConfirmButton: true,
            // timer: 2000
        });

        $('#tabelAreaFat').DataTable().ajax.reload();
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

        $('#simpanAreaFat').on('click', function (e) {
            // Cek apakah file sudah dipilih
            if ($('#kodeArea').val() === '' || $('#cluster').val() === '' || $('#branch').val() === '' || $('#kotamadya').val() === '' || $('#kotaPenagihan').val() === '' || $('#sitePenagihan').val() === '' || $('#kategoriArea').val() === '' ) {
                alert('Silakan lengkapi pengisian terlebih dahulu!');
                e.preventDefault(); // Mencegah form dikirim
                return false;
            }

            $('#tambahAreaFat').modal('hide');

            // Tampilkan loader di tengah halaman
            $('#pageLoader').fadeIn();
        });

        $('#EditAreaFat').on('click', function (e) {
            // Cek apakah file sudah dipilih
            if ($('#kodeAreaEdit').val() === '' || $('#clusterEdit').val() === '' || $('#branchEdit').val() === '' || $('#kotamadyaEdit').val() === '' || $('#kotaPenagihanEdit').val() === '' || $('#sitePenagihanEdit').val() === '' || $('#kategoriAreaEdit').val() === '' ) {
                alert('Silakan lengkapi pengisian terlebih dahulu!');
                e.preventDefault(); // Mencegah form dikirim
                return false;
            }

            $('#editAreaFat').modal('hide');

            // Tampilkan loader di tengah halaman
            $('#pageLoader').fadeIn();
        });

        // function data_rootcause() {
            $('#tabelAreaFat').DataTable({
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
                    url: "{{ route('getListAreaFat') }}",
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
                        data: 'kode_area',
                        // width: '90'
                    },
                    {
                        data: 'cluster'
                    },
                    {
                        data: 'kotamadya'
                    },
                    {
                        data: 'kotamadya_penagihan'
                    },
                    {
                        data: 'branch'
                    },
                    {
                        data: 'site'
                    },                    
                    {
                        data: 'kategori_area'
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        // }
        

        $(document).on('click', '#detail-areaFat', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let dis_id = $(this).data('id');

            $.ajax({
                url: "{{ route('getDetailAreaFat') }}",
                type: "get",
                data: {
                    filDisId: dis_id,
                    _token: _token
                },
                success: function(dtFat) {
                    console.log('dtFat : ', dtFat);
                    $('#kodeAreaEdit').val(dtFat.kode_area)
                    $('#clusterEdit').val(dtFat.cluster)
                    $('#branchEdit').val(dtFat.branch)
                    $('#kotamadyaEdit').val(dtFat.kotamadya)
                    $('#kotaPenagihanEdit').val(dtFat.kotamadya_penagihan)
                    $('#sitePenagihanEdit').val(dtFat.site)
                    $('#kategoriAreaEdit').val(dtFat.kategori_area)
                    $('#detid').val(dtFat.id)

                    $('#editAreaFat').modal('show');

                }
            })
        })

    })
</script>
