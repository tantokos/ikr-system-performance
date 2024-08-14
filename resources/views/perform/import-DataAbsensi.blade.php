<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-4 mb-5">
                        <div class="full-background" style="background: linear-gradient(to right, #112133, #21416d);">
                        </div>
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">Import Absence Data</h3>
                            <p class="mb-4 font-weight-semibold">
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
                            <form action="{{ route('import-dataAbsensi') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" class="form-control form-control-sm" id="fileDataAbsensi"
                                        name="fileDataAbsensi" required>
                                </div>
                                <div class="form-group mb-1">
                                    <button type="submit" class="btn btn-dark btn-sm w-100" onclick="cek()" >
                                        <span class="spinner-border spinner-border-sm" style="display: none" role="status" aria-hidden="true"></span>
                                        Import Data Absence</button>
                                    {{-- </div> --}}
                                    {{-- <div class="form-group"> --}}
                                    <label class="col-form-label form-control-sm">Information of Data Import :</label>
                                    <div class="col-form-label form-control-sm">
                                        @if ($croscekData != '-')
                                            <span class="error">{{ $croscekData }}</span>
                                        @else
                                            <span class="error">-</span>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <form action="{{ route('saveImportAbsensi') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <label class="col-sm-3 col-form-label form-control-sm">Import By</label>
                                    <div class="col form-group">
                                        <input type="text" class="form-control form-control-sm" id="akses"
                                            name="akses" value="{{ $akses }}" readonly />
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label form-control-sm">Number of Rows</label>
                                    <div class="col form-group">
                                        <input type="text" class="form-control form-control-sm" id="jmlData"
                                            name="jmlData" value="{{ number_format($jmlData) }}" readonly />
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label form-control-sm">Periode of Rows</label>
                                    <div class="col form-group">
                                        <input type="text" class="form-control form-control-sm" id="periode"
                                            name="periode"
                                            value="{{ $periode->min('tanggal') }} - {{ $periode->max('tanggal') }}"
                                            readonly />
                                    </div>
                                </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col text-center">
                        <button type="button" class="btn btn-sm btn-dark align-items-center" data-bs-toggle="modal"
                            data-bs-target="#previewModal">Show Preview</button>
                        <button onclick="return confirm('Simpan hasil import Data Absensi?')" type="submit" 
                            name="action" value="simpan" class="btn btn-sm btn-dark align-items-center">Save Import Data</button>
                        <button onclick="return confirm('Hapus hasil import Data Absensi?')" onsubmit="this.disabled = true;" type="submit"
                            name="action" value="batal" class="btn btn-sm btn-dark align-items-center">Cancel Import
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
                                <table class="table align-items-center mb-0" id="tabelDataAbsensiImport"
                                    style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold">No</th>
                                            <th class="text-secondary text-xs font-weight-semibold ps-2">Tanggal</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold ">Nama
                                                Karyawan</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                No. Karyawan</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Posisi</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Unit Organisasi</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Shift</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Jam Masuk</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Jam Keluar</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Absen Masuk</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Absen Keluar</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Tipe Hari</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Status</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Status Absensi</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Status Masuk-Keluar</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Keterangan</th>
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

        <!-- Modal -->
        <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg mw-100 w-75" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Preview Import Result</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="col form-group">
                                            <label class="form-control-label">Filter Status Absensi</label>
                                            <select class="form-control form-control-sm" id="FilStatAbsensi"
                                                name="FilStatAbsensi">
                                                <option value="All">All</option>
                                                @foreach ($dataAbsen as $statAbsen )
                                                    <option value="{{ $statAbsen->status_masuk_keluar }}">{{ $statAbsen->status_masuk_keluar }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col form-group">
                                            <label class="form-control-label">Filter Name</label>
                                            <select class="form-control form-control-sm" id="FilNama"
                                                name="FilNama">
                                                <option value="All">All</option>
                                                @foreach ($dataNama as $nama )
                                                    <option value="{{ $nama->nama_karyawan }}">{{ $nama->nama_karyawan }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col form-group">
                                            <label class="form-control-label">Filter Area</label>
                                            <select class="form-control form-control-sm" id="FilArea"
                                                name="FilArea">
                                                <option value="All">All</option>
                                                @foreach ($dataArea as $area )
                                                    <option value="{{ $area->area }}">{{ $area->area }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <hr>
                        </div>

                        <div class="col text-center">
                            <button type="button" class="btn btn-sm btn-dark align-items-center filterPreview" id="filterPreview">Show Filter</button>
                            <button type="button" class="btn btn-sm btn-dark align-items-center filterAll" id="filterAll">Show ALL</button>
                            <button type="button" value="close" class="btn btn-sm btn-dark align-items-center"
                                data-bs-dismiss="modal">Close Preview</button>
                        </div>
                        </form>


                        <div class="row">
                            <div class="col-12">
                                <div class="card border shadow-xs mb-4">
                                    <div class="card-body px-2 py-2">
                                        <div class="table-responsive">
                                            <table class="table align-items-center mb-0" id="tabelDataPreview"
                                                style="font-size: 12px">
                                                <thead class="bg-gray-100">
                                                    <tr id="HeadDay">
                                                        <th class="text-secondary text-xs font-weight-semibold">Status Absensi</th>
                                                        {{-- <th class="text-secondary text-xs font-weight-semibold ps-2">1</th> --}}
                                                        {{-- <th class="text-center text-secondary text-xs font-weight-semibold ">2</th> --}}
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody id="bodyDay">
                                                    {{-- <tr > --}}
                                                        
                                                    {{-- </tr> --}}

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                        {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </main>


</x-app-layout>



{{-- <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-html5-3.1.0/b-print-3.1.0/fc-5.0.1/r-3.0.2/sr-1.4.1/datatables.min.css" rel="stylesheet"> --}}

<script
    src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-html5-3.1.0/fc-5.0.1/r-3.0.2/datatables.min.js">
</script>

<script>
    $(document).ready(function() {


        var _token = $('meta[name=csrf-token]').attr('content');

        var firstDate;
        var lastDate;

        akses = $('#akses').val();
        data_absen()

        // bln = new Date($('#periodeMin').val()).getMonth();
        // thn = new Date($('#periodeMin').val()).getFullYear();

        // firstDate = moment([thn, bln]);
        // lastDate = moment(firstDate).endOf('month');

        function data_absen() {
            $('#tabelDataAbsensiImport').DataTable({
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
                    url: "{{ route('getdataAbsensi') }}",
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
                        data: 'tanggal',
                        width: '90'
                    },
                    {
                        data: 'nama_karyawan'
                    },
                    {
                        data: 'no_karyawan'
                    },
                    {
                        data: 'posisi'
                    },
                    {
                        data: 'unit_organisasi'
                    },
                    {
                        data: 'shift'
                    },
                    {
                        data: 'masuk'
                    },
                    {
                        data: 'keluar'
                    },
                    {
                        data: 'jam_masuk'
                    },
                    {
                        data: 'jam_keluar'
                    },
                    {
                        data: 'tipe_hari'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'status_absensi'
                    },
                    {
                        data: 'status_masuk_keluar'
                    },
                    {
                        data: 'keterangan'
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
                _token : _token
            },
            success: function(respon) {

                $('#HeadDay').find("th").remove();
                $('#HeadDay').append(`<th class="text-secondary text-xs font-weight-semibold">Status Absensi</th>`)

                
                $('#bodyDay').find("td").remove();
                $('#bodyDay').find("th").remove();
                $('#bodyDay').find("tr").remove();

                let hday;
                let bday;
                let bdayTotal;
                let total = [];

                $.each(respon.tgl, function(key,item){

                    hday = `
                        <th class="text-center px-1">${new Date(item).getDate()}</th>
                    `;

                    $('#HeadDay').append(hday);

                    total.push(0);
                })

                $('#HeadDay').append(`<th>Subtotal</th>`);


                $.each(respon.tblPreview, function(ky, absen){

                    bday = `
                        <tr><th class="text-secondary text-xs font-weight-semibold">${absen.status_absen}</th>
                    `;
                    stotal = 0
                    
                    for (x=0; x < absen.day.length; x++){
                        bday = bday + `
                            <td class="text-center">${absen.day[x]}</td>
                        `;

                        stotal = stotal + absen.day[x];
                        total[x]= total[x] + absen.day[x];
                    }
                 
                    bday = bday + `<th class="text-center">${stotal.toLocaleString()}</th>`;

                    $('#bodyDay').append(bday + `</tr>`);
                })

                bdayTotal = `<tr><th class="text-secondary text-xs font-weight-semibold">Total</th>`;

                gtotal = 0;
                for(t=0; t < total.length; t++){
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
