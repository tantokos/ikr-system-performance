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
                            <h3 class="text-white mb-2">Laporan Tool IKR</h3>
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
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">
                                            Data Laporan Tool</span>
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
                                        <span class="btn-inner--text">Tambah Laporan Tool</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="card-body px-2 py-2">

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0" id="tabelCek"
                                    style="font-size: 12px">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Tanggal</th>
                                            <th class="text-center text-xs font-weight-semibold">Nama Tool</th>
                                            <th class="text-center text-xs font-weight-semibold">Merk</th>
                                            <th class="text-center text-xs font-weight-semibold">Kode Aset</th>
                                            <th class="text-center text-xs font-weight-semibold">Kode GA</th>
                                            <th class="text-center text-xs font-weight-semibold">Kondisi</th>
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
                            <div class="border-top py-3 px-3 d-flex align-items-center">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <x-app.footer /> --}}
        </div>

        {{-- Modal Tambah Distribusi Tool --}}
        <div class="modal fade" id="tambahDistribusi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengecekan Tool</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('simpanPengecekan') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Lead Callsign</span>
                                        <select class="form-control form-control-sm" id="LeadCallsignTim"
                                            name="LeadCallsignTim" style="border-color:#9ca0a7;" required>
                                            <option value="">Pilih Lead Callsign</option>
                                            @if (isset($leadCallsign))
                                                @foreach ($leadCallsign as $lead)
                                                    <option value="{{ $lead->leadcall_id }}">{{ $lead->lead_callsign }}
                                                @endforeach
                                            @endif

                                        </select>
                                        <input type="hidden" id="leadCallsign" name="leadCallsign" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Nama Leader</span>
                                        <input class="form-control form-control-sm" type="text" id="leaderTim"
                                            name="leaderTim" style="border-color:#9ca0a7;" readonly>
                                        <input type="hidden" id="leaderid" name="leaderid" readonly>
                                    </div>


                                    <div class="form-group mb-1">
                                        {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                        <span class="text-xs">Posisi</span>
                                        <input class="form-control form-control-sm" type="text" id="posisiTim"
                                            name="posisiTim" style="border-color:#9ca0a7;" readonly>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group mb-1">
                                        <span class="text-xs">Callsign Tim</span>
                                        <select class="form-control form-control-sm" type="text"
                                            id="callsignTimid" name="callsignTimid" style="border-color:#9ca0a7;"
                                            placeholder="Isi Callsign Tim">
                                            <option value="">Pilih Callsign Tim</option>
                                        </select>
                                        <input type="hidden" id="callsignTim" name="callsignTim">
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Teknisi 1</span>
                                        <input id="teknisi1Nk" name="teknisi1Nk" type="hidden" readonly>
                                        <input type="text" class="form-control form-control-sm" id="teknisi1"
                                            name="teknisi1" style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Teknisi 3</span>
                                        <input id="teknisi3Nk" name="teknisi3Nk" type="hidden" readonly>
                                        <input type="text" class="form-control form-control-sm" id="teknisi3"
                                            name="teknisi3" style="border-color:#9ca0a7;"@readonly(true)>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group mb-1">
                                        <span class="text-xs">Area</span>
                                        <input type="text" class="form-control form-control-sm" type="text"
                                            id="areaTim" name="areaTim" style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Teknisi 2</span>
                                        <input id="teknisi2Nk" name="teknisi2Nk" type="hidden" readonly>
                                        <input type="text" class="form-control form-control-sm" id="teknisi2"
                                            name="teknisi2" style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Teknisi 4</span>
                                        <input id="teknisi4Nk" name="teknisi4Nk" type="hidden" readonly>
                                        <input type="text" class="form-control form-control-sm" id="teknisi4"
                                            name="teknisi4" style="border-color:#9ca0a7;" readonly>
                                    </div>
                                </div>

                                <hr>
                                {{-- </div>1 --}}

                                {{-- <div class="row">1 --}}
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
                                        <span class="text-xs">Tanggal Distribusi Tool</span>
                                        <input class="form-control form-control-sm" type="date"
                                            value="{{ date('Y-m-d') }}" id="tglDistribusi" name="tglDistribusi"
                                            style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Tanggal Pengecekan Tool</span>
                                        <input class="form-control form-control-sm" type="date"
                                            value="{{ date('Y-m-d') }}" id="tglPengecekan" name="tglPengecekan"
                                            style="border-color:#9ca0a7;" readonly>
                                    </div>



                                    <div class="form-group mb-1">
                                        <span class="text-xs">Kondisi</span>
                                        <select type="text" class="form-control form-control-sm" id="kondisi"
                                            name="kondisi" style="border-color:#9ca0a7;">
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Kode Aset</span>
                                        <input class="form-control form-control-sm" type="text" id="kodeAset"
                                            name="kodeAset" style="border-color:#9ca0a7;" readonly>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Kode GA</span>
                                        <input class="form-control form-control-sm" type="text" id="kodeGA"
                                            name="kodeGA" style="border-color:#9ca0a7;" readonly>
                                    </div>

                                </div>

                                {{-- </div>1 --}}

                                {{-- <div class="row">2 --}}


                                {{-- <div class="col"> --}}
                                {{-- <span class="text-xs">Foto Data Tool</span> --}}
                                {{-- <div class="form-group mb-1 text-center"> --}}
                                {{-- <img src="{{ asset('assets/img/default-150x150.png') }}" id="showgambar" --}}
                                {{-- alt="Card Image" style="width:200px;height: 200px;" /> --}}
                                {{-- <input type="hidden" id="showgambartool" name="showgambartool"> --}}
                                {{-- </div> --}}

                                {{-- <div class="form-group mb-1"> --}}

                                {{-- </div> --}}

                                {{-- <div class="form-group mb-1"> --}}
                                {{-- <span class="text-xs">Keterangan</span> --}}
                                {{-- <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" style="border-color:#9ca0a7;"></textarea> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}

                                <div class="col">
                                    <div class="row">

                                        <div class="col form-group mb-1 text-center">
                                            <span class="text-xs">Foto Terakhir Pengecekan</span>
                                            <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                id="showgambarDistribusi" alt="Card Image"
                                                style="width:160px;height: 160px;" />
                                        </div>

                                        <div class="col form-group mb-1 text-center">
                                            <span class="text-xs">Foto Pengecekan Tool</span>
                                            <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                id="showgambarCek" alt="Card Image"
                                                style="width:160px;height: 160px;" />
                                        </div>


                                    </div>

                                    <div class="form-group mb-1">
                                        <input class="form-control form-control-sm" id="fotoKembaliTool"
                                            name="fotoCekTool" type="file" style="border-color:#9ca0a7;">
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
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                        {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Tambah Data Tool --}}

        {{-- Modal Show Detail Data Tool --}}
        <div class="modal fade" id="showCek" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Pengembalian Tool</h5>
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
                                    <input type="hidden" id="namaToolidShow" name="namaToolidShow" readonly>
                                    <input class="form-control form-control-sm" type="text" id="namaToolShow"
                                        name="namaToolShow" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Merk</span>
                                    <input class="form-control form-control-sm" type="text" id="merkShow"
                                        name="merkShow" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Satuan</span>
                                    <input type="text" class="form-control form-control-sm" id="satuanShow"
                                        name="satuanShow" style="border-color:#9ca0a7;" readonly>
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
                                    <span class="text-xs">Tanggal Distribusi Tool</span>
                                    <input class="form-control form-control-sm" type="date"
                                        value="{{ date('Y-m-d') }}" id="tglDistribusiShow" name="tglDistribusiShow"
                                        style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Tanggal Pengembalian Tool</span>
                                    <input class="form-control form-control-sm" type="date"
                                        value="{{ date('Y-m-d') }}" id="tglPenerimaanShow" name="tglPenerimaanShow"
                                        style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Kondisi</span>
                                    <input type="text" class="form-control form-control-sm" id="kondisiShow"
                                        name="kondisiShow" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Kode Aset</span>
                                    <input class="form-control form-control-sm" type="text" id="kodeAsetShow"
                                        name="kodeAsetShow" style="border-color:#9ca0a7;" readonly>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Kode GA</span>
                                    <input class="form-control form-control-sm" type="text" id="kodeGAShow"
                                        name="kodeGAShow" style="border-color:#9ca0a7;" readonly>
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
                                {{-- <div class="row"> --}}

                                {{-- <div class="col form-group mb-1 text-center">
                                        <span class="text-xs">Foto Distribusi Tool</span>
                                        <img src="{{ asset('assets/img/default-150x150.png') }}"
                                            id="showgambarDistribusiShow" alt="Card Image"
                                            style="width:160px;height: 160px;" />
                                    </div> --}}
                                <span class="text-xs text-center">Foto Pengecekan Tool</span>
                                <div class="col form-group mb-1 text-center">
                                    {{-- <span class="text-xs">Foto Pengembalian Tool</span> --}}
                                    <img src="{{ asset('assets/img/default-150x150.png') }}"
                                        id="showgambarPengecekanShow" alt="Card Image"
                                        style="width:160px;height: 160px;" />
                                </div>


                                {{-- </div> --}}

                                <div class="form-group mb-1">
                                    <input class="form-control form-control-sm" id="fotoKembaliTool"
                                        name="fotoKembaliToolShow" type="file" style="border-color:#9ca0a7;">
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Keterangan</span>
                                    <textarea class="form-control form-control-sm" id="keteranganShow" name="keteranganShow"
                                        style="border-color:#9ca0a7;"></textarea>
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
        data_pengecekan()

        function data_pengecekan() {
            $('#tabelCek').DataTable({
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
                    url: "{{ route('getDataPengecekan') }}",
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
                        data: 'tgl_pengecekan',
                        // width: '90'
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
                        data: 'lead_callsign'
                    },
                    {
                        data: 'leader'
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
                    {
                        data: 'action',
                        "className": "text-center",
                    },
                ]
            })
        }

        let area;
        let leader;

        $(document).on('change', '#LeadCallsignTim', function(e) {

            var _token = $('meta[name=csrf-token]').attr('content');
            let leadCallsignId = $('#LeadCallsignTim').val();

            $.ajax({
                url: "{{ route('getRawDistribusi') }}",
                type: "get",
                data: {
                    filLeadId: leadCallsignId,
                    _token: _token
                },
                success: function(dtLead) {
                    dtDis = dtLead.dataDis;
                    dtTim = dtLead.listTim;

                    area = dtLead.callLead.branch_id;
                    leader = dtLead.callLead.nik_karyawan

                    $('#leadCallsign').val(dtLead.callLead.lead_callsign)
                    $('#leaderid').val(dtLead.callLead.leader_id)
                    $('#leaderTim').val(dtLead.callLead.leader)
                    $('#areaTim').val(dtLead.callLead.area)
                    $('#posisiTim').val(dtLead.callLead.posisi)

                    $('#callsignTimid').find('option').remove();
                    $('#callsignTimid').append(
                        `<option value="">Pilih Callsign Tim</option>`);

                    $.each(dtLead.listTim, function(key, tim) {
                        $('#callsignTimid').append(
                            `<option value="${tim.callsign_tim_id}">${tim.callsign_tim}</option>`
                        )
                    })

                    get_select_tool("lead");
                }
            })
        })


        $(document).on('change', '#callsignTimid', function(t) {
            t.preventDefault();
            let tm = dtTim.find(k => k.callsign_tim_id === $(this).val())

            $('#callsignTim').val(tm.callsign_tim)
            $('#teknisi1Nk').val(tm.nik_tim1);
            $('#teknisi1').val(tm.teknisi1);
            $('#teknisi2Nk').val(tm.nik_tim2);
            $('#teknisi2').val(tm.teknisi2);
            $('#teknisi3Nk').val(tm.nik_tim3);
            $('#teknisi3').val(tm.teknisi3);
            $('#teknisi4Nk').val(tm.nik_tim4);
            $('#teknisi4').val(tm.teknisi4);

            get_select_tool("tim");
        })

        function get_select_tool(leadTim) {

            if (leadTim == "lead") {
                listTool = dtDis.filter(k => k.leadcall_id == $('#LeadCallsignTim').val() &&
                    k.callsign_tim_id == null)
            }
            if (leadTim == "tim") {
                listTool = dtDis.filter(k => k.callsign_tim_id == $('#callsignTimid').val())
            }
            console.log('listToolLead : ', listTool);
            console.log('listToolTim : ', listTool);

            $('#pilihTool').find('option').remove();
            $('#pilihTool').append(
                `<option value="">Pilih Nama Tool</option>`);

            $.each(listTool, function(ky, tl) {
                val = tl.barang_id + "|" + tl.nama_barang + "|" + tl.merk_barang + "|" + tl
                    .satuan + "|" + tl.spesifikasi + "|" + tl.tgl_distribusi + "|" +
                    tl.kondisi +
                    "|" + tl.kode_aset + "|" + tl.kode_ga + "|" + tl.foto_distribusi + "|" + tl.id;

                tex = tl.nama_barang + "|" + tl.merk_barang + "|" + tl.satuan +
                    "|" + tl.kode_aset + "|" + tl.kode_ga;

                $('#pilihTool').append(
                    `<option value="${val}">${tex}</option>`
                )

                $('#namaTool').val('');
                $('#merk').val('');
                $('#satuan').val('');
                $('#spesifikasi').val('');
                $('#tglPenerimaan').val('')
                $('#kondisi').val('');
                $('#kodeAset').val('');
                $('#kodeGA').val('');
                $('#keterangan').val('');

                $('#showgambar').attr('src',
                    `/storage/image-tool/foto-blank.jpg`)
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
            $('#tglDistribusi').val(pilih[5])
            $('#kondisi').val(pilih[6]);
            $('#kodeAset').val(pilih[7]);
            $('#kodeGA').val(pilih[8]);
            $('#showgambartool').val(pilih[9]);
            $('#showgambarDistribusi').attr('src',
                `/storage/image-distribusi/${pilih[9]}`)
            $('#disId').val(pilih[10])
        })

        $(document).on('click', '#detail-cek', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let dis_id = $(this).data('id');

            $.ajax({
                url: "{{ route('getDetailCek') }}",
                type: "get",
                data: {
                    filDisId: dis_id,
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

                    $('#namaToolidShow').val(dtDis.nama_barang);
                    $('#namaToolShow').val(dtDis.nama_barang);

                    $('#merkShow').val(dtDis.merk_barang);
                    $('#satuanShow').val(dtDis.satuan);
                    $('#spesifikasiShow').val(dtDis.spesifikasi);

                    $('#tglDistribusiShow').val(dtDis.tgl_distribusi);
                    $('#tglPenerimaanShow').val(dtDis.tgl_pengecekan);

                    $('#kondisiShow').val(dtDis.kondisi);
                    $('#kodeAsetShow').val(dtDis.kode_aset);
                    $('#kodeGAShow').val(dtDis.kode_ga);

                    $('#keteranganShow').val(dtDis.keterangan);

                    $('#showgambarPengecekanShow').attr('src',
                        `/storage/image-laporan/${dtDis.foto_pengecekan}`)

                    $('#showCek').modal('show');


                }
            })
        })

    })
</script>
