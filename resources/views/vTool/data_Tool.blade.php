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
                            <h3 class="text-white mb-2">Data Tool IKR</h3>
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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Data Tool</span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
                                    <button type="button"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                        data-bs-toggle="modal" data-bs-target="#tambahTool">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Tambah Tool Baru</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="card-body px-2 py-2">

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0" id="tabelTool"
                                    style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Nama</th>
                                            <th class="text-center text-xs font-weight-semibold">Merk</th>
                                            <th class="text-center text-xs font-weight-semibold">Kode Aset</th>
                                            <th class="text-center text-xs font-weight-semibold">Kode GA</th>
                                            <th class="text-center text-xs font-weight-semibold">Spesifikasi</th>
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

        {{-- Modal Tambah Data Tool --}}
        <div class="modal fade" id="tambahTool" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tool</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('simpanTool') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Nama Tool</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namaTool" name="namaTool" style="border-color:#9ca0a7;"
                                                    required>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Merk</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="merk" name="merk" style="border-color:#9ca0a7;"
                                                    required>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Satuan</span>
                                                <select class="form-control form-control-sm" id="satuan"
                                                    name="satuan" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Satuan</option>
                                                    <option value="Unit">Unit</option>
                                                    <option value="Pcs">Pcs</option>
                                                    <option value="Set">Set</option>

                                                </select>
                                            </div>



                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Spesifikasi</span>
                                                <textarea class="form-control form-control-sm" id="spesifikasi" name="spesifikasi" style="border-color:#9ca0a7;"></textarea>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group mb-1">
                                                <span class="text-xs">Tanggal Penerimaan Tool</span>
                                                <input class="form-control form-control-sm" type="date"
                                                    value="{{ date('Y-m-d') }}" id="tglPenerimaan"
                                                    name="tglPenerimaan" style="border-color:#9ca0a7;">
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kondisi</span>
                                                <select class="form-control form-control-sm" id="kondisi"
                                                    name="kondisi" style="border-color:#9ca0a7;">
                                                    <option value="">Pilih Kondisi</option>
                                                    <option value="Baik">Baik</option>
                                                    <option value="Rusak">Rusak</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kode Aset</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="kodeAset" name="kodeAset" style="border-color:#9ca0a7;"
                                                    required>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kode GA</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="kodeGA" name="kodeGA" style="border-color:#9ca0a7;"
                                                    required>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <span class="text-xs">Foto Tool</span>
                                            <div class="form-group mb-1 text-center">

                                                <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                    id="showgambar" alt="Card Image"
                                                    style="width:200px;height: 200px;" />
                                            </div>

                                            <div class="form-group mb-1">
                                                <input class="form-control form-control-sm" id="fotoTool"
                                                    name="fotoTool" type="file" style="border-color:#9ca0a7;">
                                            </div>



                                        </div>
                                    </div>


                                </div>
                            </div>
                            <hr>
                            <div class="row text-center mb-1">
                                <div class="col">
                                    <button type="submit"
                                        class="btn btn-sm btn-dark align-items-center simpanKaryawan"
                                        id="simpanKaryawan">Simpan Data</button>
                                    <button type="button" value="close"
                                        class="btn btn-sm btn-dark align-items-center"
                                        data-bs-dismiss="modal">Batalkan</button>
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
        {{-- End Modal Tambah Data Tool --}}

        {{-- Modal Show Detail Data Tool --}}
        <div class="modal fade" id="ShowTool" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Data Tool</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <input class="form-control form-control-sm" type="hidden"
                                                    id="namaToolShowId" name="namaToolShowId" readonly>

                                                <span class="text-xs">Nama Tool</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namaToolShow" name="namaToolShow"
                                                    style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Merk</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="merkShow" name="merkShow" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Satuan</span>
                                                <select class="form-control form-control-sm" id="satuanShow"
                                                    name="satuanShow" style="border-color:#9ca0a7;" disabled>
                                                    <option value="">Pilih Satuan</option>
                                                    <option value="Unit">Unit</option>
                                                    <option value="Pcs">Pcs</option>
                                                    <option value="Set">Set</option>

                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                <span class="text-xs">Spesifikasi</span>
                                                <textarea class="form-control form-control-sm" id="spesifikasiShow" name="spesifikasiShow"
                                                    style="border-color:#9ca0a7;" readonly></textarea>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group mb-1">
                                                <span class="text-xs">Tanggal Penerimaan Tool</span>
                                                <input class="form-control form-control-sm" type="date"
                                                    value="{{ date('Y-m-d') }}" id="tglPenerimaanShow"
                                                    name="tglPenerimaanShow" style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kondisi</span>
                                                <select class="form-control form-control-sm" id="kondisiShow"
                                                    name="kondisiShow" style="border-color:#9ca0a7;" disabled>
                                                    <option value="">Pilih Kondisi</option>
                                                    <option value="Baik">Baik</option>
                                                    <option value="Rusak">Rusak</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kode Aset</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="kodeAsetShow" name="kodeAsetShow"
                                                    style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="form-group mb-1">
                                                <span class="text-xs">Kode GA</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="kodeGAShow" name="kodeGAShow" style="border-color:#9ca0a7;"
                                                    readonly>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <span class="text-xs">Foto Tool</span>
                                            <div class="form-group mb-1 text-center">

                                                <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                    id="showgambarShow" alt="Card Image"
                                                    style="width:200px;height: 200px;" />
                                            </div>

                                            <div class="form-group mb-1">
                                                <input class="form-control form-control-sm" id="fotoToolShow"
                                                    name="fotoToolShow" type="file" style="border-color:#9ca0a7;"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <p>Riwayat Tool</p>
                            </div>

                            <div class="row">
                                <div class="table-responsive p-0">
                                    <table class="table table-striped table-bordered align-items-center mb-0"
                                        id="tabelRiwayatTool" style="font-size: 12px">
                                        <thead class="bg-gray-100">
                                            <tr id="headShowTool">
                                                <th class="text-xs font-weight-semibold">#</th>
                                                <th class="text-center text-xs font-weight-semibold">Tanggal</th>
                                                <th class="text-center text-xs font-weight-semibold">Status</th>
                                                <th class="text-center text-xs font-weight-semibold">Callsign Tim</th>
                                                <th class="text-center text-xs font-weight-semibold">Leader</th>
                                                <th class="text-center text-xs font-weight-semibold">Teknisi 1</th>
                                                <th class="text-center text-xs font-weight-semibold">Teknisi 2</th>
                                                <th class="text-center text-xs font-weight-semibold">Teknisi 3</th>
                                                <th class="text-center text-xs font-weight-semibold">Teknisi 4</th>
                                                <th class="text-center text-xs font-weight-semibold">Kondisi</th>
                                                <th class="text-center text-xs font-weight-semibold">#</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyShowTool">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center mb-1">
                                <div class="col ">
                                    {{-- <button type="submit" class="btn btn-sm btn-dark align-items-center showSimpan"
                                        id="showSimpan">Simpan Data</button> --}}
                                    <button type="button" value="close"
                                        class="btn btn-sm btn-dark align-items-center"
                                        data-bs-dismiss="modal">Kembali</button>
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
        {{-- End Modal Show Detail Tool --}}

        {{-- Modal Show Detail Riwayat Distribusi Tool --}}
        <div class="modal fade" id="showRiwayatDistribusi" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Distribusi Tool</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="{{ route('simpanDistribusi') }}" method="post" enctype="multipart/form-data"> --}}
                        {{-- @csrf --}}
                        <div class="row">
                            <div class="col">

                                <div class="form-group mb-1">
                                    <span class="text-xs">Lead Callsign</span>
                                    <input type="text" class="form-control form-control-sm"
                                        id="LeadCallsignTimShow" name="LeadCallsignTimShow"
                                        style="border-color:#9ca0a7;" readonly>
                                    <input type="hidden" id="leadCallsignShow" name="leadCallsignShow" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Nama Leader</span>
                                    <input class="form-control form-control-sm" type="text" id="leaderTimShow"
                                        name="leaderTimShow" style="border-color:#9ca0a7;" readonly>
                                    <input type="hidden" id="leaderidShow" name="leaderidShow" readonly>
                                </div>


                                <div class="form-group mb-1">
                                    <span class="text-xs">Posisi</span>
                                    <input class="form-control form-control-sm" type="text" id="posisiTimShow"
                                        name="posisiTimShow" style="border-color:#9ca0a7;" readonly>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group mb-1">
                                    <span class="text-xs">Callsign Tim</span>
                                    <input class="form-control form-control-sm" type="text" id="callsignTimidShow"
                                        name="callsignTimidShow" style="border-color:#9ca0a7;" readonly>
                                    <input type="hidden" id="callsignTimShow" name="callsignTim">
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 1</span>
                                    <input id="teknisi1NkShow" name="teknisi1NkShow" type="hidden" readonly>
                                    <input type="text" class="form-control form-control-sm" id="teknisi1Show"
                                        name="teknisi1Show" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 3</span>
                                    <input id="teknisi3NkShow" name="teknisi3NkShow" type="hidden" readonly>
                                    <input type="text" class="form-control form-control-sm" id="teknisi3Show"
                                        name="teknisi3Show" style="border-color:#9ca0a7;" readonly>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group mb-1">
                                    <span class="text-xs">Area</span>
                                    <input class="form-control form-control-sm" type="text" id="areaTimShow"
                                        name="areaTimShow" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 2</span>
                                    <input id="teknisi2NkShow" name="teknisi2NkShow" type="hidden" readonly>
                                    <input type="text" class="form-control form-control-sm" id="teknisi2Show"
                                        name="teknisi2Show" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 4</span>
                                    <input id="teknisi4NkShow" name="teknisi4NkShow" type="hidden" readonly>
                                    <input type="text" class="form-control form-control-sm" id="teknisi4Show"
                                        name="teknisi4Show" style="border-color:#9ca0a7;" readonly>
                                </div>
                            </div>

                            <hr>
                            {{-- </div>1 --}}

                            {{-- <div class="row">1 --}}
                            <div class="col">
                                {{-- <div class="form-group mb-1"> --}}
                                {{-- <span class="text-xs">Pilih Tool</span> --}}
                                {{-- <div class="input-group"> --}}
                                {{-- <input class="form-control form-control-sm" type="text" id="pilihToolShow" --}}
                                {{-- name="pilihToolShow" style="border-color:#9ca0a7;" readonly> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}

                                <div class="form-group mb-1">
                                    <span class="text-xs">Nama Tool</span>
                                    <input class="form-control form-control-sm" type="text" id="namaToolShowDis"
                                        name="namaToolShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Merk</span>
                                    <input class="form-control form-control-sm" type="text" id="merkShowDis"
                                        name="merkShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Satuan</span>
                                    <input type="text" class="form-control form-control-sm" id="satuanShowDis"
                                        name="satuanShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                    <span class="text-xs">Spesifikasi</span>
                                    <textarea class="form-control form-control-sm" id="spesifikasiShowDis" name="spesifikasiShowDis"
                                        style="border-color:#9ca0a7;" readonly></textarea>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-1">
                                    <span id="txDisPenerimaan" class="text-xs">Tanggal Penerimaan
                                        Tool</span>
                                    <input class="form-control form-control-sm" type="date"
                                        value="{{ date('Y-m-d') }}" id="tglPenerimaanShowDis"
                                        name="tglPenerimaanShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span id="txTglDistribusi" class="text-xs">Tanggal Distribusi Tool</span>
                                    <input class="form-control form-control-sm" type="date"
                                        value="{{ date('Y-m-d') }}" id="tglDistribusiShowDis"
                                        name="tglDistribusiShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>



                                <div class="form-group mb-1">
                                    <span class="text-xs">Kondisi</span>
                                    <input type="text" class="form-control form-control-sm" id="kondisiShowDis"
                                        name="kondisiShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Kode Aset</span>
                                    <input class="form-control form-control-sm" type="text" id="kodeAsetShowDis"
                                        name="kodeAsetShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Kode GA</span>
                                    <input class="form-control form-control-sm" type="text" id="kodeGAShowDis"
                                        name="kodeGAShowDis" style="border-color:#9ca0a7;" readonly>
                                </div>

                            </div>

                            {{-- </div>1 --}}

                            {{-- <div class="row">2 --}}


                            {{-- <div class="col"> --}}
                            {{-- <span class="text-xs">Foto Data Tool</span> --}}
                            {{-- <div class="form-group mb-1 text-center"> --}}
                            {{-- <img src="{{ asset('assets/img/default-150x150.png') }}" id="showgambar" --}}
                            {{-- alt="Card Image" style="width:200px;height: 200px;" /> --}}
                            {{-- </div> --}}

                            {{-- <div class="form-group mb-1"> --}}
                            {{-- </div> --}}

                            {{-- <div class="form-group mb-1"> --}}
                            {{-- <span class="text-xs">Keterangan</span> --}}
                            {{-- <textarea class="form-control form-control-sm" id="keteranganShow" name="keteranganShow" --}}
                            {{-- style="border-color:#9ca0a7;" readonly></textarea> --}}
                            {{-- </div> --}}
                            {{-- </div> --}}

                            <div class="col">
                                <span class="text-xs">Foto Distribusi Tool</span>
                                <div class="form-group mb-1 text-center">
                                    <img src="{{ asset('assets/img/default-150x150.png') }}"
                                        id="showgambarDistribusiShow" alt="Card Image"
                                        style="width:200px;height: 200px;" />
                                </div>

                                {{-- <div class="form-group mb-1"> --}}
                                {{-- <input class="form-control form-control-sm" id="fotoToolDistribusi" --}}
                                {{-- name="fotoToolDistribusi" type="file" style="border-color:#9ca0a7;"> --}}
                                {{-- </div> --}}

                                <div class="form-group mb-1">
                                    {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                    <span class="text-xs">Keterangan</span>
                                    <textarea class="form-control form-control-sm" id="keteranganShow" name="keteranganShow"
                                        style="border-color:#9ca0a7;" readonly></textarea>
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
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                        {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Show Detail Riwayat Distribusi Tool --}}

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
                $('#showgambar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fotoTool").change(function() {
        readURL(this);
    });
</script>

<script>
    $(document).ready(function() {

        var _token = $('meta[name=csrf-token]').attr('content');
        var firstDate;
        var lastDate;
        akses = $('#akses').val();
        data_tool()

        function data_tool() {
            $('#tabelTool').DataTable({
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
                    url: "{{ route('getDataTool') }}",
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
                        "width": '90'
                    },
                    {
                        data: 'nama_barang',
                        // width: '90'
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
                        data: 'spesifikasi'
                    },
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }

        $(document).on('click', '#detail-tool', function(e) {
            e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let t_id = $(this).data('id');

            $.ajax({
                url: "{{ route('showDetailTool') }}",
                type: "get",
                data: {
                    filToolId: t_id,
                    _token: _token
                },
                success: function(respon) {

                    $('#namaToolShowId').val('')
                    $('#namaToolShow').val('')
                    $('#merkShow').val('')
                    $('#satuanShow').val('')
                    $('#spesifikasiShow').val('')
                    $('#tglPenerimaanShow').val('')
                    $('#kondisiShow').val('')
                    $('#kodeAsetShow').val('')
                    $('#kodeGAShow').val('')
                    $('#showgambarShow').val('')
                    $('#fotoToolShow').val('')

                    $('#namaToolShowId').val(respon.id)
                    $('#namaToolShow').val(respon.nama_barang)
                    $('#merkShow').val(respon.merk_barang)
                    $('#satuanShow').val(respon.satuan)
                    $('#spesifikasiShow').val(respon.spesifikasi)
                    $('#tglPenerimaanShow').val(respon.tgl_pengadaan)
                    $('#kondisiShow').val(respon.kondisi)
                    $('#kodeAsetShow').val(respon.kode_aset)
                    $('#kodeGAShow').val(respon.kode_ga)
                    $('#showgambarShow').attr('src',
                        `/storage/image-tool/${respon.foto_barang}`)

                    $('#ShowTool').modal('show');
                    // showDetail_tool(t_id);
                    showRiwayatTool(t_id);

                }
            })
        })

        function showRiwayatTool(detTool) {
            $('#tabelRiwayatTool').DataTable({
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
                    url: "{{ route('getRiwayatTool') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        tid: detTool,
                        _token: _token
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_Row_Index',
                        "className": "text-center",
                        // orderable: false,
                        searchable: false,
                        // "width": '90'
                    },
                    {
                        data: 'tgl',
                        // width: '90'
                    },
                    {
                        data: 'status_distribusi'
                    },
                    {
                        data: 'callsign_tim'
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
                        data: 'teknisi4'
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

        $('#updateLead').click(function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let callLeadId = $('#leadCallsignId').val();
            let leadCallsign = $('#leadCallsignEdit').val();
            let areaId = $('#areaEdit').val();
            let leaderId = $('#namaLeaderEdit').val();

            $.ajax({
                url: `/updateLead/${callLeadId}`,
                type: 'PUT',
                data: {
                    idCallsignLead: callLeadId,
                    idArea: areaId,
                    leadCallsign: leadCallsign,
                    idLeader: leaderId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(hasil) {

                    $('#detailEditLead').modal('hide');
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "{{ session('success') }}",
                        showConfirmButton: true,
                        // timer: 2000
                    });

                    data_lead();

                },
                error: function(error) {
                    if (error.responseJSON.message) {
                        alert(error.responseJSON.message)
                    }

                }
            })
        })

        $(document).on('click', '#dis-detail', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let dt_Dis = $(this).data('id').split('|');
            let dis_id = dt_Dis[0];
            let kategori = dt_Dis[1];

            //tambah detail pengembalian disini//

            if (kategori == "Data Distribusi") {
                url = "{{ route('getDetailDistribusi') }}"
            }
            if (kategori == "Data Pengembalian") {
                url = "{{ route('getDetailKembali') }}"
            }

            $.ajax({
                url: url,
                type: "get",
                data: {
                    filDisId: dis_id,
                    filKategori: kategori,
                    _token: _token
                },
                success: function(dtDis) {

                    $('#LeadCallsignTimShow').val(dtDis.lead_callsign)
                    $('#leadCallsignShow').val(dtDis.lead_callsign)
                    $('#leaderidShow').val(dtDis.leader_id)
                    $('#leaderTimShow').val(dtDis.leader)
                    $('#posisiTimShow').val(dtDis.posisi)
                    $('#callsignTimidShow').val(dtDis.callsign_tim)
                    $('#callsignTimShow').val(dtDis.callsign_tim_id)
                    $('#areaTimShow').val(dtDis.area)

                    $('#teknisi1NkShow').val(dtDis.nik_tim1);
                    $('#teknisi1Show').val(dtDis.teknisi1);
                    $('#teknisi2NkShow').val(dtDis.nik_tim2);
                    $('#teknisi2Show').val(dtDis.teknisi2);
                    $('#teknisi3NkShow').val(dtDis.nik_tim3);
                    $('#teknisi3Show').val(dtDis.teknisi3);
                    $('#teknisi4NkShow').val(dtDis.nik_tim4);
                    $('#teknisi4Show').val(dtDis.teknisi4);

                    $('#namaToolShowDis').val(dtDis.nama_barang);

                    $('#merkShowDis').val(dtDis.merk_barang);
                    $('#satuanShowDis').val(dtDis.satuan);
                    $('#spesifikasiShowDis').val(dtDis.spesifikasi);



                    $('#kondisiShowDis').val(dtDis.kondisi);
                    $('#kodeAsetShowDis').val(dtDis.kode_aset);
                    $('#kodeGAShowDis').val(dtDis.kode_ga);

                    $('#keteranganShow').val(dtDis.keterangan);

                    if (kategori == "Data Distribusi") {

                        $('#tglPenerimaanShowDis').val(dtDis.tgl_pengadaan);
                        $('#tglDistribusiShowDis').val(dtDis.tgl_distribusi);

                        document.getElementById('txDisPenerimaan').innerHTML =
                            "Tanggal Penerimaan Tool";
                        document.getElementById('txTglDistribusi').innerHTML =
                            "Tanggal Distribusi Tool";

                        $('#showgambarDistribusiShow').attr('src',
                            `/storage/image-distribusi/${dtDis.foto_distribusi}`)
                    }
                    if (kategori == "Data Pengembalian") {

                        $('#tglPenerimaanShowDis').val(dtDis.tgl_distribusi);
                        $('#tglDistribusiShowDis').val(dtDis.tgl_kembali);

                        document.getElementById('txDisPenerimaan').innerHTML =
                            "Tanggal Distribusi Tool";
                        document.getElementById('txTglDistribusi').innerHTML =
                            "Tanggal Pengembalian Tool";

                        $('#showgambarDistribusiShow').attr('src',
                            `/storage/image-pengembalian/${dtDis.foto_kembali}`)
                    }


                    $('#showRiwayatDistribusi').modal('show');


                }
            })
        })


        // {{-- Start Part Callsign Tim  --}}
        let area;
        let leader;

        $(document).on('change', '#LeadCallsignTim', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let leadCallsignId = $('#LeadCallsignTim').val();

            $.ajax({
                url: "{{ route('getDataLeadCallsign') }}",
                type: "get",
                data: {
                    filLeadId: leadCallsignId,
                    _token: _token
                },
                success: function(dtLead) {

                    area = dtLead.callLead.branch_id;
                    leader = dtLead.callLead.nik_karyawan
                    $('#leaderTim').val(dtLead.callLead.nama_karyawan)
                    $('#areaTim').val(dtLead.callLead.nama_branch)
                    $('#posisiTim').val(dtLead.callLead.posisi)

                    selectTeknisi("baru", area, leader);

                }
            })
        })

        function selectTeknisi(vstatus, vArea, vLeader) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let leadCallsignId = $('#LeadCallsignTim').val();

            $.ajax({
                url: "{{ route('getTeknisi') }}",
                type: "get",
                data: {
                    area: vArea,
                    leader: vLeader,
                    _token: _token
                },
                success: function(dtTim) {

                    if (vstatus === "baru") {
                        $('#teknisi1').find('option').remove();
                        $('#teknisi1').append(`<option value="">Pilih Teknisi 1</option>`);
                        $('#teknisi2').find('option').remove();
                        $('#teknisi2').append(`<option value="">Pilih Teknisi 2</option>`);
                        $('#teknisi3').find('option').remove();
                        $('#teknisi3').append(`<option value="">Pilih Teknisi 3</option>`);
                        $('#teknisi4').find('option').remove();
                        $('#teknisi4').append(`<option value="">Pilih Teknisi 4</option>`);

                        $.each(dtTim, function(key, tim) {
                            $('#teknisi1').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                            $('#teknisi2').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                            $('#teknisi3').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                            $('#teknisi4').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                        })
                    }
                    if (vstatus === "edit") {


                        $.each(dtTim, function(key, tim) {
                            $('#teknisi1Edit').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                            $('#teknisi2Edit').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                            $('#teknisi3Edit').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                            $('#teknisi4Edit').append(
                                `<option value="${tim.nik_karyawan}">${tim.nama_karyawan}</option>`
                            )
                        })
                    }

                }
            })
        }

        $(document).on('click', '#detail-tim', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let cTim = $(this).data('id').split('|');
            let ct_id = cTim[0];
            let cl_id = cTim[1];
            let l_id = cTim[2];
            let b_id = cTim[3];

            $.ajax({
                url: "{{ route('getDetailTim') }}",
                type: "get",
                data: {
                    callTimEdit: ct_id,
                    callLeadEdit: cl_id,
                    branch_edit: b_id,
                    _token: _token
                },
                success: function(responEdit) {
                    $('#teknisi1Edit').find('option').remove();
                    $('#teknisi1Edit').append(`<option value="">Pilih Teknisi 1</option>`);
                    $('#teknisi2Edit').find('option').remove();
                    $('#teknisi2Edit').append(`<option value="">Pilih Teknisi 2</option>`);
                    $('#teknisi3Edit').find('option').remove();
                    $('#teknisi3Edit').append(`<option value="">Pilih Teknisi 3</option>`);
                    $('#teknisi4Edit').find('option').remove();
                    $('#teknisi4Edit').append(`<option value="">Pilih Teknisi 4</option>`);

                    $('#editTim').modal('show');

                    $('#callTimEdit').val('');
                    $('#LeadTimEdit').val('');
                    $('#TimLeaderEdit').val('');
                    $('#areaTimEdit').val('');
                    $('#posisiTimEdit').val('');
                    $('#callsignTimEdit').val('');

                    selectTeknisi("edit", b_id, l_id);

                    $('#editTim').modal('show');
                    $('#callTimEdit').val(responEdit.callsign_tim_id);
                    $('#LeadTimEdit').val(responEdit.lead_callsign);
                    $('#TimLeaderEdit').val(responEdit.nama_leader);
                    $('#areaTimEdit').val(responEdit.nama_branch);
                    $('#posisiTimEdit').val(responEdit.posisi);
                    $('#callsignTimEdit').val(responEdit.callsign_tim);


                    if (responEdit.nik_tim1 === null) {
                        document.getElementById('teknisi1Edit').value = "";
                    } else {
                        $('#teknisi1Edit').append(
                            `<option value="${responEdit.nik_tim1}" selected>${responEdit.teknisi1}</option>`
                        )
                    }

                    if (responEdit.nik_tim2 === null) {
                        document.getElementById('teknisi2Edit').value = "";
                    } else {
                        $('#teknisi2Edit').append(
                            `<option value="${responEdit.nik_tim2}" selected>${responEdit.teknisi2}</option>`
                        )
                    }

                    if (responEdit.nik_tim3 === null) {
                        document.getElementById('teknisi3Edit').value = "";
                    } else {
                        $('#teknisi3Edit').append(
                            `<option value="${responEdit.nik_tim3}" selected>${responEdit.teknisi3}</option>`
                        )
                    }

                    if (responEdit.nik_tim4 === null) {
                        document.getElementById('teknisi4Edit').value = "";
                    } else {
                        $('#teknisi4Edit').append(
                            `<option value="${responEdit.nik_tim4}" selected>${responEdit.teknisi4}</option>`
                        )
                    }

                }
            })
        })

        $('#updateTim').click(function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let callTimId = $('#callTimEdit').val();
            let tek1 = $('#teknisi1Edit').val();
            let tek2 = $('#teknisi2Edit').val();
            let tek3 = $('#teknisi3Edit').val();
            let tek4 = $('#teknisi4Edit').val();

            console.log(tek1, tek2, tek3, tek4)
            $.ajax({
                url: `/updateTim/${callTimId}`,
                type: 'get',
                data: {
                    idCallTim: callTimId,
                    tim1: tek1,
                    tim2: tek2,
                    tim3: tek3,
                    tim4: tek4,
                    _token: '{{ csrf_token() }}'
                },
                success: function(hasil) {

                    $('#editTim').modal('hide');
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "{{ session('success') }}",
                        showConfirmButton: true,
                        // timer: 2000
                    });

                    data_lead();
                    data_tim();

                },
                error: function(error) {
                    console.log(error);
                    if (error.responseJSON.message) {
                        alert(error.responseJSON.message)
                    }

                }
            })
        })
        // {{-- End Part Callsign Tim  --}}

    })
</script>
