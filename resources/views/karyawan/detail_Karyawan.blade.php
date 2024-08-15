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
                            <h3 class="text-white mb-2">Detail Data Karyawan</h3>
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
<<<<<<< HEAD
                        <form id='editForm' action="{{ route('updateKaryawan', $karyawan)}}" method="POST" enctype="multipart/form-data" >
=======
                        <form id='editForm' action="{{ route('updateKaryawan', $karyawan) }}" method="POST"
                            enctype="multipart/form-data">
>>>>>>> ad8ffde (CRU karyawan & callsignlead)
                            @csrf
                            @method('PUT')
                            <div class="card-header border-bottom pb-0">
                                <div class="d-sm-flex align-items-center">
                                    <div>
                                        <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleMonthly"></span>
                                        </h6>
                                        {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                    </div>

                                    <div class="ms-auto d-flex">
                                        <button type="submit"
                                            class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                            id="updateData" disabled>
                                            {{-- <span class="btn-inner--icon">
                                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                    <path
                                                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                    </path>
                                                </svg>
                                            </span> --}}
                                            <span class="btn-inner--text">Update Data</span>
                                        </button>

                                        <button type="button"
                                            class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                            id="editData">
                                            <span class="btn-inner--icon">
                                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                    <path
                                                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <span class="btn-inner--text">Edit Data</span>
                                        </button>
                                    </div>

                                </div>
                            </div>

                            <div class="card-body px-2 py-2">
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group mb-1">
                                                    {{-- <label class="form-control-label">Nik Karyawan</label> --}}
                                                    <span class="text-xs">Nik Karyawan</span>
                                                    <input class="form-control form-control-sm" type="text"
                                                        id="nik" name="nik"
                                                        value="{{ $karyawan->nik_karyawan }}"
                                                        style="border-color:#9ca0a7;" readonly>
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Nama Karyawan</span>
                                                    <input class="form-control form-control-sm" id="namaKaryawan"
                                                        name="namaKaryawan" value="{{ $karyawan->nama_karyawan }}"
                                                        style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Alamat Lengkap</span>
<<<<<<< HEAD
                                                    <textarea class="form-control form-control-sm" id="alamat" name="alamat"
                                                        value="{{ is_null($karyawan->alamat) ? '-' : $karyawan->alamat }}" style="border-color:#9ca0a7;"></textarea>
=======
                                                    <textarea class="form-control form-control-sm" id="alamat" name="alamat" style="border-color:#9ca0a7;">{{ is_null($karyawan->alamat) ? '-' : $karyawan->alamat }}</textarea>
>>>>>>> ad8ffde (CRU karyawan & callsignlead)
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Tempat Lahir</span>
                                                        <input class="form-control form-control-sm" id="tmptLahir"
                                                            value="{{ is_null($karyawan->tempat_lahir) ? '-' : $karyawan->tempat_lahir }}"
                                                            name="tmptLahir" style="border-color:#9ca0a7;">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-xs">Tanggal Lahir</span>
                                                        <Input class="form-control form-control-sm" type="date"
                                                            value="{{ date($karyawan->tgl_lahir) }}" id="tglLahir"
                                                            name="tglLahir" style="border-color:#9ca0a7;">
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Jenis Kelamin</span>
                                                        <select class="form-control form-control-sm" id="jenisKelamin"
                                                            name="jenisKelamin" style="border-color:#9ca0a7;">
                                                            <option value="">Pilih Jenis kelamin</option>
                                                            <option value="Laki-laki"
                                                                {{ $karyawan->jenis_karyawan == 'Laki-laki' ? 'selected' : '' }}>
                                                                Laki-laki</option>
                                                            <option value="Perempuan"
                                                                {{ $karyawan->jenis_karyawan == 'Perempuan' ? 'selected' : '' }}>
                                                                Perempuan</option>

                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Agama</span>
                                                        <select class="form-control form-control-sm" id="agama"
                                                            name="agama" style="border-color:#9ca0a7;">
                                                            <option value="">Pilih Agama</option>
                                                            <option value="Islam"
                                                                {{ $karyawan->agama == 'Islam' ? 'selected' : '' }}>
                                                                Islam</option>
                                                            <option value="Kristen"
                                                                {{ $karyawan->agama == 'Kristen' ? 'selected' : '' }}>
                                                                Kristen</option>
                                                            <option value="Hindu"
                                                                {{ $karyawan->agama == 'Hindu' ? 'selected' : '' }}>
                                                                Hindu</option>
                                                            <option value="Budha"
                                                                {{ $karyawan->agama == 'Budha' ? 'selected' : '' }}>
                                                                Budha</option>
                                                        </select>
                                                    </div>
                                                </div>



                                            </div>

                                            <div class="col">

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No Telepon/Hp</span>
                                                    <input class="form-control form-control-sm" id="noTelp"
                                                        value="{{ $karyawan->no_telp }}" name="noTelp"
                                                        style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Tanggal Bergabung</span>
                                                        <Input class="form-control form-control-sm" type="date"
                                                            value="{{ $karyawan->tgl_gabung }}"id="tglGabung"
                                                            name="tglGabung" style="border-color:#9ca0a7;">
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Status Kepegawaian</span>
                                                        <select class="form-control form-control-sm"
                                                            id="statusPegawai"
                                                            value="{{ $karyawan->status_pegawai }}"
                                                            name="statusPegawai" style="border-color:#9ca0a7;">
                                                            <option value="Kontrak">Kontrak</option>
                                                            <option value="Tetap">Tetap</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Status Karyawan</span>
                                                        <select class="form-control form-control-sm"
                                                            id="statusKaryawan"
                                                            value="{{ $karyawan->status_active }}"
                                                            name="statusKaryawan" style="border-color:#9ca0a7;">
                                                            <option value="Aktif">Aktif</option>
                                                            <option value="Tidak Aktif">Tidak Aktif</option>

                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Tanggal Keluar</span>
                                                        <Input class="form-control form-control-sm" type="date"
                                                            value="{{ $karyawan->tgl_nonactive == null ? '' : $karyawan->tgl_nonactive }}"
                                                            id="tglKeluar" name="tglKeluar"
                                                            style="border-color:#9ca0a7;">
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Area</span>
                                                        <select class="form-control form-control-sm" id="area"
                                                            name="area" style="border-color:#9ca0a7;">

                                                            @foreach ($area as $listArea)
                                                                <option value="{{ $listArea->id }}"
                                                                    {{ $listArea->id == $karyawan->branch_id ? 'selected' : '' }}>
                                                                    {{ $listArea->nama_branch }}</option>
                                                            @endforeach
                                                            {{-- <option value="1">Jakarta Timur</option>
                                                                <option value="2">Jakarta Selatan</option>
                                                                <option value="3">Bekasi</option>
                                                                <option value="4">Bogor</option>
                                                                <option value="5">Tangerang</option>
                                                                <option value="6">Medan</option>
                                                                <option value="7">Pangkal Pinang</option>
                                                                <option value="8">Pontianak</option>
                                                                <option value="9">Jambi</option>
                                                                <option value="10">Bali</option> --}}

                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Divisi</span>
                                                        <select class="form-control form-control-sm" id="divisi"
                                                            value="{{ $karyawan->divisi }}" name="divisi"
                                                            style="border-color:#9ca0a7;">
                                                            <option value="IKR">IKR</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form-group mb-1">
                                                    <div class="col">
                                                        <span class="text-xs">Departemen</span>
                                                        <select class="form-control form-control-sm" id="departemen"
                                                            name="departemen" style="border-color:#9ca0a7;">
                                                            <option value="FTTH"
                                                                {{ $karyawan->departemen == 'FTTH' ? 'selected' : '' }}>
                                                                FTTH</option>
                                                            <option value="FTTX/FTTB"
                                                                {{ $karyawan->departemen == 'FTTX/FTTB' ? 'selected' : '' }}>
                                                                FTTX/FTTB</option>
                                                            <option value="Dokumen Kontrol"
                                                                {{ $karyawan->departemen == 'Dokumen Kontrol' ? 'selected' : '' }}>
                                                                Dokumen Kontrol</option>
                                                            <option value="Traffic"
                                                                {{ $karyawan->departemen == 'Traffic' ? 'selected' : '' }}>
                                                                Traffic</option>
                                                            <option value="System IKR"
                                                                {{ $karyawan->departemen == 'System IKR' ? 'selected' : '' }}>
                                                                System IKR</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <span class="text-xs">Posisi</span>
                                                        <select class="form-control form-control-sm" id="posisi"
                                                            name="posisi" style="border-color:#9ca0a7;">
                                                            <option value="Installer"
                                                                {{ $karyawan->posisi == 'Installer' ? 'selected' : '' }}>
                                                                Installer</option>
                                                            <option value="Maintenance"
                                                                {{ $karyawan->posisi == 'Maintenance' ? 'selected' : '' }}>
                                                                Maintenance</option>
                                                            <option value="Leader Instalasi FTTH"
                                                                {{ $karyawan->posisi == 'Leader' ? 'selected' : '' }}>
                                                                Leader Instalasi FTTH
                                                            </option>
                                                            {{-- <option value="Leader Maintenance FTTH"
                                                                {{ $karyawan->posisi == 'Leader Maintenance FTTH' ? 'selected' : '' }}>
                                                                Leader Maintenance FTTH
                                                            </option> --}}
                                                            {{-- <option value="Leader FTTX/FTTB"
                                                                {{ $karyawan->posisi == 'Leader FTTX/FTTB' ? 'selected' : '' }}>
                                                                Leader FTTX/FTTB</option> --}}
                                                            <option value="Supervisor"
                                                                {{ $karyawan->posisi == 'Supervisor' ? 'selected' : '' }}>
                                                                Supervisor</option>
                                                            <option value="Staff"
                                                                {{ $karyawan->posisi == 'Staff' ? 'selected' : '' }}>
                                                                Staff</option>
                                                            <option value="Ast. Manager"
                                                                {{ $karyawan->posisi == 'Ast. Manager' ? 'selected' : '' }}>
                                                                Ast. Manager</option>

                                                        </select>
                                                    </div>



                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">Email</span>
                                                    <input class="form-control form-control-sm" id="email"
                                                        value="{{ $karyawan->email }}" name="email"
                                                        style="border-color:#9ca0a7;">
                                                </div>

                                            </div>

                                            <div class="col">

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No. KTP</span>
                                                    <input class="form-control form-control-sm" id="noKTP"
                                                        value="{{ $karyawan->no_ktp }}" name="noKTP"
                                                        style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No. NPWP</span>
                                                    <input class="form-control form-control-sm" id="noNPWP"
                                                        value="{{ $karyawan->no_npwp }}" name="noNPWP"
                                                        style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No. Rekening Bank</span>
                                                    <input class="form-control form-control-sm" id="noRek"
                                                        value="{{ $karyawan->no_rek }}" name="noRek"
                                                        style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No. BPJS</span>
                                                    <input class="form-control form-control-sm" id="noBpjs"
                                                        value="{{ $karyawan->no_bpjs }}" name="noBpjs"
                                                        style="border-color:#9ca0a7;">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <span class="text-xs">No. Jamsostek</span>
                                                    <input class="form-control form-control-sm" id="noJamsostek"
                                                        value="{{ $karyawan->no_jamsostek }}" name="noJamsostek"
                                                        style="border-color:#9ca0a7;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                </div>
                            </div>
                        </form>
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
    var form = document.getElementById('editForm');
    var elemen = form.elements;
    for (var i = 0, len = elemen.length; i < len; ++i) {
        if (elemen[i].tagName === "INPUT" || elemen[i].tagName === "TEXTAREA") {
            elemen[i].readOnly = true;
        }

        if (elemen[i].tagName === "SELECT") {
            elemen[i].disabled = true;
        }

    }

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
</script>

<script>
    $(document).on('click', '#editData', function(e) {
        e.preventDefault();

        var form = document.getElementById('editForm');
        var elemen = form.elements;

        $('#updateData').prop('disabled', false);
        $('#editData').prop('disabled', true);

        for (var i = 0, len = elemen.length; i < len; ++i) {
            if (elemen[i].tagName === "INPUT" || elemen[i].tagName === "TEXTAREA") {
                elemen[i].readOnly = false;
            }

            if (elemen[i].tagName === "SELECT") {
                elemen[i].disabled = false;
            }

        }

    })
</script>
