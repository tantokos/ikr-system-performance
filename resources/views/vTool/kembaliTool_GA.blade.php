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
                            <h3 class="text-white mb-2">Pengembalian Tool ke GA</h3>
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
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Data
                                            Pengembalian Tool ke GA</span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
                                    <button type="button"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                        data-bs-toggle="modal" data-bs-target="#tambahDistribusi">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">+ Pengembalian Tool ke GA</span>
                                    </button>
                                    
                                </div>

                            </div>
                        </div>

                        <div class="card-body px-2 py-2">

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="tabelKembali" style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Tanggal</th>
                                            <th class="text-center text-xs font-weight-semibold">Nama Tool</th>
                                            <th class="text-center text-xs font-weight-semibold">Merk</th>
                                            <th class="text-center text-xs font-weight-semibold">Kode Aset</th>
                                            <th class="text-center text-xs font-weight-semibold">Kode GA</th>
                                            <th class="text-center text-xs font-weight-semibold">Kondisi</th>

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

        {{-- Modal Tambah Pengembalian GA Tool --}}
        <div class="modal fade" id="tambahDistribusi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengembalian Tool ke GA</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('simpanPengembalianGA') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                
                                <div class="col">
                                    <div class="form-group mb-1">
                                        {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                        <span class="text-xs">Pilih Tool</span>
                                        <div class="input-group">
                                            <select class="form-control form-control-sm" type="text"
                                                id="pilihTool" name="pilihTool" style="border-color:#9ca0a7;"
                                                required>
                                                <option value="">Pilih Tool</option>
                                            </select>
                                        </div>
                                        <input type="hidden" id="disId" name="disId" readonly required>
                                    </div>

                                    <div class="form-group mb-1">
                                        {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                        <span class="text-xs">Nama Tool</span>
                                        <input type="hidden" id="namaToolid" name="namaToolid" readonly required>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm" type="text" id="namaTool"
                                                name="namaTool" style="border-color:#9ca0a7;" readonly required>
                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Merk</span>
                                        <input class="form-control form-control-sm" type="text" id="merk"
                                            name="merk" style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Satuan</span>
                                        <input type="text" class="form-control form-control-sm" id="satuan"
                                            name="satuan" style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                        <span class="text-xs">Spesifikasi</span>
                                        <textarea class="form-control form-control-sm" id="spesifikasi" name="spesifikasi" style="border-color:#9ca0a7;"
                                            readonly></textarea>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group mb-1">
                                        <span class="text-xs">Tanggal Penerimaan Tool dari GA</span>
                                        <input class="form-control form-control-sm" type="date"
                                            value="{{ date('Y-m-d') }}" id="tglPengadaan" name="tglPengadaan"
                                            style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Tanggal Pengembalian Tool ke GA</span>
                                        <input class="form-control form-control-sm" type="date"
                                            value="{{ date('Y-m-d') }}" id="tglPengembalian" name="tglPengembalian"
                                            style="border-color:#9ca0a7;" readonly>
                                    </div>



                                    <div class="row form-group mb-1">
                                        <div class="col">
                                            <span class="text-xs">Kondisi</span>
                                            <select type="text" class="form-control form-control-sm" id="kondisi"
                                                name="kondisi" style="border-color:#9ca0a7;">
                                                <option value="Baik">Baik</option>
                                                <option value="Rusak">Rusak</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <span class="text-xs">Status Pengembalian</span>
                                            <input class="form-control form-control-sm" type="text"
                                                value="Dikembalikan ke GA" id="statPengembalian" name="statPengembalian"
                                                style="border-color:#9ca0a7;" readonly>
                                        </div>
                                    </div>

                                    <div class="row form-group mb-1">
                                        <div class="col">
                                            <span class="text-xs">Kode Aset</span>
                                            <input class="form-control form-control-sm" type="text" id="kodeAset"
                                                name="kodeAset" style="border-color:#9ca0a7;" readonly>
                                        </div>
                                        <div class="col">
                                            <span class="text-xs">Kode GA</span>
                                            <input class="form-control form-control-sm" type="text" id="kodeGA"
                                                name="kodeGA" style="border-color:#9ca0a7;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Dikembalikan Oleh</span>
                                        <input class="form-control form-control-sm" type="text"
                                            id="nikPengembalian" name="nikPengembalian"
                                            style="border-color:#9ca0a7;"
                                            value="{{ isset($dtlog) ? $dtlog->nik_karyawan .'|'. $dtlog->nama_karyawan : ''}}" readonly>
                                    </div>

                                </div>

                                <div class="col">
                                    <div class="row">

                                        <div class="col form-group mb-1 text-center">
                                            <span class="text-xs">Foto Penerimaan Tool</span>
                                            <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                id="showgambarPenerimaan" alt="Card Image"
                                                style="width:160px;height: 160px;" />
                                        </div>

                                        <div class="col form-group mb-1 text-center">
                                            <span class="text-xs">Foto Pengembalian Tool</span>
                                            <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                id="showgambarKembali" alt="Card Image"
                                                style="width:160px;height: 160px;" />
                                        </div>


                                    </div>

                                    <div class="form-group mb-1">
                                        <input class="form-control form-control-sm" id="fotoKembaliTool"
                                            name="fotoKembaliTool" type="file" style="border-color:#9ca0a7;">
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Keterangan</span>
                                        <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" style="border-color:#9ca0a7;"></textarea>
                                    </div>
                                </div>
                                {{-- </div>2 --}}
                                <hr>
                                <div class="row text-center mb-1">
                                    <div class="col">
                                        <button type="submit"
                                            class="btn btn-sm btn-dark align-items-center simpanDistribusi"
                                            id="simpanDistribusi">Simpan Data</button>
                                        <button type="button" value="close"
                                            class="btn btn-sm btn-dark align-items-center"
                                            data-bs-dismiss="modal">Batalkan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="modal-footer"> --}}
                        {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                        {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        {{-- End Modal Tambah pengembalian GA Tool --}}

        {{-- Modal Detail Pengembalian GA Tool --}}
        <div class="modal fade" id="showKembaliGA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Pengembalian Tool ke GA</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="{{ route('simpanPengembalianGA') }}" method="post" enctype="multipart/form-data"> --}}
                            {{-- @csrf --}}
                            <div class="row">
                                
                                <div class="col">
                                    {{-- <div class="form-group mb-1">
                                        <span class="text-xs">Pilih Tool</span>
                                        <div class="input-group">
                                            <select class="form-control form-control-sm" type="text"
                                                id="pilihTool" name="pilihTool" style="border-color:#9ca0a7;"
                                                required>
                                                <option value="">Pilih Tool</option>
                                            </select>
                                        </div>
                                        <input type="hidden" id="disId" name="disId" readonly required>
                                    </div> --}}

                                    <div class="form-group mb-1">
                                        {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                        <span class="text-xs">Nama Tool</span>
                                        <input type="hidden" id="namaToolidGAShow" name="namaToolidGAShow" readonly required>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm" type="text" id="namaToolGAShow"
                                                name="namaToolGAShow" style="border-color:#9ca0a7;" readonly required>
                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Merk</span>
                                        <input class="form-control form-control-sm" type="text" id="merkGAShow"
                                            name="merkGAShow" style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Satuan</span>
                                        <input type="text" class="form-control form-control-sm" id="satuanGAShow"
                                            name="satuanGAShow" style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                        <span class="text-xs">Spesifikasi</span>
                                        <textarea class="form-control form-control-sm" id="spesifikasiGAShow" name="spesifikasiGAShow" style="border-color:#9ca0a7;"
                                            readonly></textarea>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group mb-1">
                                        <span class="text-xs">Tanggal Penerimaan Tool dari GA</span>
                                        <input class="form-control form-control-sm" type="date"
                                            value="{{ date('Y-m-d') }}" id="tglPengadaanGAShow" name="tglPengadaanGAShow"
                                            style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Tanggal Pengembalian Tool ke GA</span>
                                        <input class="form-control form-control-sm" type="date"
                                            value="{{ date('Y-m-d') }}" id="tglPengembalianGAShow" name="tglPengembalianGAShow"
                                            style="border-color:#9ca0a7;" readonly>
                                    </div>



                                    <div class="row form-group mb-1">
                                        <div class="col">
                                            <span class="text-xs">Kondisi</span>
                                            <input type="text" class="form-control form-control-sm" id="kondisiGAShow"
                                                name="kondisiGAShow" style="border-color:#9ca0a7;" readonly>
                                        </div>
                                        <div class="col">
                                            <span class="text-xs">Status Pengembalian</span>
                                            <input class="form-control form-control-sm" type="text"
                                                value="Dikembalikan ke GA" id="statPengembalianGAShow" name="statPengembalianGAShow"
                                                style="border-color:#9ca0a7;" readonly>
                                        </div>
                                    </div>

                                    <div class="row form-group mb-1">
                                        <div class="col">
                                            <span class="text-xs">Kode Aset</span>
                                            <input class="form-control form-control-sm" type="text" id="kodeAsetGAShow"
                                                name="kodeAsetGAShow" style="border-color:#9ca0a7;" readonly>
                                        </div>
                                        <div class="col">
                                            <span class="text-xs">Kode GA</span>
                                            <input class="form-control form-control-sm" type="text" id="kodeGAGAShow"
                                                name="kodeGAGAShow" style="border-color:#9ca0a7;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Dikembalikan Oleh</span>
                                        <input class="form-control form-control-sm" type="text"
                                            id="nikPengembalianGAShow" name="nikPengembalianGAShow"
                                            style="border-color:#9ca0a7;" readonly>
                                    </div>

                                </div>

                                <div class="col">
                                    {{-- <div class="row"> --}}

                                        {{-- <div class="col form-group mb-1 text-center">
                                            <span class="text-xs">Foto Penerimaan Tool</span>
                                            <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                id="showgambarPenerimaanGAShow" alt="Card Image"
                                                style="width:160px;height: 160px;" />
                                        </div> --}}
                                        <span class="text-xs">Foto Pengembalian Tool</span>
                                        <div class="form-group mb-1 text-center">
                                            
                                            <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                id="showgambarKembaliGAShow" alt="Card Image"
                                                style="width:160px;height: 160px;" />
                                        </div>


                                    {{-- </div> --}}

                                    <div class="form-group mb-1">
                                        <input class="form-control form-control-sm" id="fotoKembaliToolGAShow"
                                            name="fotoKembaliToolGAShow" type="file" style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Keterangan</span>
                                        <textarea class="form-control form-control-sm" id="keteranganGAShow" name="keteranganGAShow" style="border-color:#9ca0a7;" readonly></textarea>
                                    </div>
                                </div>
                                {{-- </div>2 --}}
                                <hr>
                                <div class="row text-center mb-1">
                                    <div class="col">
                                        <button type="button" value="close"
                                            class="btn btn-sm btn-dark align-items-center"
                                            data-bs-dismiss="modal">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        {{-- </form> --}}
                    </div>
                    {{-- <div class="modal-footer"> --}}
                        {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                        {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        {{-- End Modal Detail pengembalian GA Tool --}}

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
                $('#showgambarKembali').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fotoKembaliTool").change(function() {
        readURL(this);
    });
</script>

<script>
    $(document).ready(function() {

        var _token = $('meta[name=csrf-token]').attr('content');
        var dtDis;
        var dtTim;
        var firstDate;
        var lastDate;
        akses = $('#akses').val();
        data_kembali_GA()
        data_tool()

        function data_kembali_GA() {
            $('#tabelKembali').DataTable({
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
                    url: "{{ route('getDataKembaliGA') }}",
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
                        data: 'tgl_kembali',
                        "className": "text-center",
                    },
                    {
                        data: 'nama_barang'
                    },
                    {
                        data: 'merk_barang'
                    },
                    {
                        data: 'kode_aset'
                    },
                    {
                        data: 'kode_ga'
                    },
                    {
                        data: 'kondisi'
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }

        let area;
        let leader;


        function data_tool() {

            $.ajax({
                url: "{{ route('getRawTool') }}",
                type: "get",
                data: {
                    _token: _token
                },
                success: function(dtLead) {
                    dtDis = dtLead.dataDis;

                    $('#pilihTool').find('option').remove();
                    $('#pilihTool').append(
                            `<option value="">Pilih Nama Tool</option>`);

                    $.each(dtDis, function(ky, tl) {
                        val = tl.id + "|" + tl.nama_barang + "|" + tl.merk_barang + "|" + tl.satuan + "|" + tl.spesifikasi + "|" + tl.tgl_pengadaan + "|" +
                            tl.kondisi + "|" + tl.kode_aset + "|" + tl.kode_ga + "|" + tl.foto_barang + "|" + tl.id;

                        tex = tl.nama_barang + "|" + tl.merk_barang + "|" + tl.satuan +
                            "|" + tl.kode_aset + "|" + tl.kode_ga;

                        $('#pilihTool').append(
                            `<option value="${val}">${tex}</option>`
                        )

                        $('#namaTool').val('');
                        $('#merk').val('');
                        $('#satuan').val('');
                        $('#spesifikasi').val('');
                        $('#tglPengadaan').val('')
                        $('#kondisi').val('');
                        $('#kodeAset').val('');
                        $('#kodeGA').val('');
                        $('#keterangan').val('');

                        $('#showgambarPenerimaan').attr('src',
                            `/storage/image-tool/foto-blank.jpg`)
                    })
                }
        
            })
        }

        $(document).on('change', '#pilihTool', function(t) {
            t.preventDefault();
            let pilih = $(this).val().split('|');
            $('#namaToolid').val(pilih[0]);
            $('#namaTool').val(pilih[1]);
            $('#merk').val(pilih[2]);
            $('#satuan').val(pilih[3]);
            $('#spesifikasi').val(pilih[4]);
            $('#tglPengadaan').val(pilih[5])
            $('#kondisi').val(pilih[6]);
            $('#kodeAset').val(pilih[7]);
            $('#kodeGA').val(pilih[8]);
            $('#showgambartool').val(pilih[9]);
            $('#showgambarPenerimaan').attr('src',
                `/storage/image-tool/${pilih[9]}`)
            $('#disId').val(pilih[10])
        })

        $(document).on('click', '#detail-kembaliGA', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let dis_id = $(this).data('id');

            $.ajax({
                url: "{{ route('getDetailKembaliGA') }}",
                type: "get",
                data: {
                    filDisId: dis_id,
                    _token: _token
                },
                success: function(dtDis) {
                    
                    $('#namaToolidGAShow').val(dtDis.barang_id);
                    $('#namaToolGAShow').val(dtDis.nama_barang);

                    $('#merkGAShow').val(dtDis.merk_barang);
                    $('#satuanGAShow').val(dtDis.satuan);
                    $('#spesifikasiGAShow').val(dtDis.spesifikasi);

                    $('#tglPengadaanGAShow').val(dtDis.tgl_pengadaan);
                    $('#tglPengembalianGAShow').val(dtDis.tgl_kembali);

                    $('#kondisiGAShow').val(dtDis.kondisi);
                    $('#statPengembalianGAShow').val(dtDis.status_pengembalian);
                    $('#kodeAsetGAShow').val(dtDis.kode_aset);
                    $('#kodeGAGAShow').val(dtDis.kode_ga);
                    $('#nikPengembalianGAShow').val(dtDis.nik_pengembalian + "|" + dtDis.nama_pengembalian);

                    $('#keteranganGAShow').val(dtDis.keterangan);

                    $('#showgambarKembaliGAShow').attr('src',
                        `/storage/image-pengembalianGA/${dtDis.foto_kembali}`)

                    $('#showKembaliGA').modal('show');


                }
            })
        })

    })
</script>
