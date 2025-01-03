<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-0 mb-2">
                        <div class="full-background" style="background: linear-gradient(to right, #112133, #21416d);">
                        </div>
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">Jadwal Kehadiran Tim IKR</h3>
                            <p class="mb-1 font-weight-semibold">
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
                                    <span class="text-xs">Tahun</span>
                                    <select class="form-control form-control-sm"
                                        id="filTahun" name="filTahun" style="border-color:#9ca0a7;">
                                        @if (isset($tahun))
                                            @foreach ($tahun as $thn)
                                                <option value="{{ $thn->tahun }}">{{ $thn->tahun}}</option>
                                            @endforeach                                            
                                        @endif
                                    </select>
                                </div>

                                <div class="col form-group mb-1">
                                    <span class="text-xs">Bulan</span>
                                    <select class="form-control form-control-sm"
                                        id="filBulan" name="filBulan" style="border-color:#9ca0a7;">
                                        {{-- @if (isset($bulan))
                                            @foreach ($bulan as $bln)
                                                <option value="{{ $bln->bulan }}">{{ $bln->bulan}}</option>
                                            @endforeach                                            
                                        @endif --}}
                                    </select>
                                </div>

                                <div class="col form-group mb-1" hidden>
                                    <span class="text-xs">Tanggal</span>
                                    <input class="form-control form-control-sm date-range" type="text"
                                        id="filtglProgress" name="filtglProgress" style="border-color:#9ca0a7;">
                                </div>


                                <div class="col form-group mb-1">
                                    <span class="text-xs">Area</span>
                                    <select class="form-control form-control-sm" type="text" id="filarea"
                                        name="filarea" style="border-color:#9ca0a7;">
                                        <option value="All|All">All</option>
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
                                    <span class="text-xs">Nama Karyawan</span>
                                    <select class="form-control form-control-sm" type="text" id="filNama"
                                        name="filNama" style="border-color:#9ca0a7;">
                                        <option value="All|ALl">All</option>
                                        @if (isset($kry))
                                            @foreach ($kry as $b)
                                                <option value="{{ $b->nik_karyawan . '|' . $b->nama_karyawan }}">
                                                    {{ $b->nama_karyawan }}
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col form-group mb-1">
                                    <span class="text-xs">Status Kehadiran</span>
                                    <select class="form-control form-control-sm" type="text" id="filStatusHadir"
                                        name="filStatusHadir" style="border-color:#9ca0a7;">
                                        <option value="All">All</option>
                                        <option value="ON">ON</option>
                                        <option value="OFF">OFF</option>
                                        <option value="Cuti">Cuti</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Absen">Absen</option>
                                    </select>
                                </div>

                                
                                {{-- </div> --}}
                            </div>

                            <hr>
                            <div class="row text-center mb-0">
                                <div class="col">
                                    <button type="button" class="btn btn-sm btn-dark align-items-center filKehadiran"
                                        id="filKehadiran">Tampilkan</button>
                                    {{-- <button type="button" value="close"
                                        class="btn btn-sm btn-dark align-items-center">Reset</button> --}}
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
                                    <h6 class="font-weight-semibold text-lg">Rekap Jadwal Kehadiran</h6>
                                    {{-- <p class="text-sm">See information about all members</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
                                    <button type="button" id="editStatusHadir"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        {{-- data-bs-toggle="modal" data-bs-target="#updateStatusHadir"> --}}
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Edit Status Kehadiran</span>
                                    </button>
    
                                    <a href="{{ route('importJadwalTim') }}">
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
                                            <span class="btn-inner--text">Import Jadwal IKR</span>
                                        </button>
                                    </a>
                                </div>

                            </div>

                            
                        </div>

                        <div class="card-body px-2 py-2">
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-tabs nav-fill p-1" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab"
                                            href="#DetailTeknisi" data-id="DetailTeknisi" role="tab" aria-controls="DetailTeknisi"
                                            aria-selected="true">
                                            Teknisi
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#DetailStaff"
                                            role="tab" data-id="DetailStaff" aria-selected="true">
                                            Staff
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                            href="#DetailLeader" data-id="DetailLeader" role="tab" aria-controls="DetailLeader"
                                            aria-selected="false">
                                            Leader
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                            href="#DetailSpv" data-id="DetailSpv" role="tab" aria-controls="DetaliSpv"
                                            aria-selected="false">
                                            Supervisor
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <style>
                            .fw-500 { font-weight: 500; };
                            .red ( backgound-color: "red");
                        </style>

                        <div class="tab-content">
                            <div class="tab-pane active" id="DetailTeknisi" role="tabpanel" aria-expanded="true">

                                <div class="card-body px-2 py-2">
                                    <div class="table-responsive">
                                        <table class="table table-bordered align-items-center mb-0" id="tabelRekapJadwalTeknisi"
                                            style="font-size: 12px; border-color:#9ca0a7;">
                                            <thead class="bg-gray-200">
                                                <tr>
                                                    <th class="text-secondary text-xs">#</th>
                                                    <th class="text-secondary text-xs">Area</th>
                                                    <th class="text-secondary text-xs">Departement</th>
                                                    <th class="text-center text-secondary text-xs">Bulan</th>
                                                    <th class="text-center text-secondary text-xs">Tahun</th>
                                                    <th class="text-center text-secondary text-xs">Status</th>
                                                    <th
                                                        class="text-center text-secondary text-xs">01</th>
                                                    <th
                                                        class="text-center text-secondary text-xs">02</th>
                                                    <th
                                                        class="text-center text-secondary text-xs">03</th>
                                                    <th
                                                        class="text-center text-secondary text-xs">04</th>
                                                    <th
                                                        class="text-center text-secondary text-xs">05</th>
                                                    <th
                                                        class="text-center text-secondary text-xs">06</th>
                                                    <th
                                                        class="text-center text-secondary text-xs">07</th>
                                                    <th
                                                        class="text-center text-secondary text-xs">08</th>
                                                    <th
                                                        class="text-center text-secondary text-xs">09</th>
                                                    <th class="text-center text-secondary text-xs">10</th>
                                                    <th class="text-center text-secondary text-xs">11</th>
                                                    <th class="text-center text-secondary text-xs">12</th>
                                                    <th class="text-center text-secondary text-xs">13</th>
                                                    <th class="text-center text-secondary text-xs">14</th>
                                                    <th class="text-center text-secondary text-xs">15</th>
                                                    <th class="text-center text-secondary text-xs">16</th>
                                                    <th class="text-center text-secondary text-xs">17</th>
                                                    <th class="text-center text-secondary text-xs">18</th>
                                                    <th class="text-center text-secondary text-xs">19</th>
                                                    <th class="text-center text-secondary text-xs">20</th>
                                                    <th class="text-center text-secondary text-xs">21</th>
                                                    <th class="text-center text-secondary text-xs">22</th>
                                                    <th class="text-center text-secondary text-xs">23</th>
                                                    <th class="text-center text-secondary text-xs">24</th>
                                                    <th class="text-center text-secondary text-xs">25</th>
                                                    <th class="text-center text-secondary text-xs">26</th>
                                                    <th class="text-center text-secondary text-xs">27</th>
                                                    <th class="text-center text-secondary text-xs">28</th>
                                                    <th class="text-center text-secondary text-xs">29</th>
                                                    <th class="text-center text-secondary text-xs">30</th>
                                                    <th class="text-center text-secondary text-xs">31</th>
                                                    <th class="text-center text-xs">Total</th>

                                                </tr>
                                            </thead>
                                            <tbody style="font-weigth:700">

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

                        <div class="tab-content">
                            <div class="tab-pane" id="DetailStaff" role="tabpanel" aria-expanded="true">

                                <div class="card-body px-2 py-2">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered align-items-center mb-0" id="tabelRekapJadwalStaff"
                                            style="font-size: 12px; border-color:#9ca0a7;">
                                            <thead class="bg-gray-200">
                                                <tr>
                                                    <th class="text-secondary text-xs font-weight-semibold">#</th>
                                                    <th class="text-secondary text-xs font-weight-semibold ps-2">Area</th>
                                                    <th class="text-secondary text-xs">Departement</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold ">Bulan</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold">Tahun</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold">Status</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">01</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">02</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">03</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">04</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">05</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">06</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">07</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">08</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">09</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">10</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">11</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">12</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">13</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">14</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">15</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">16</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">17</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">18</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">19</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">20</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">21</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">22</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">23</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">24</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">25</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">26</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">27</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">28</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">29</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">30</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">31</th>
                                                    <th class="text-center text-xs font-weight-semibold">Total</th>

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

                        <div class="tab-content">
                            <div class="tab-pane" id="DetailLeader" role="tabpanel" aria-expanded="true">

                                <div class="card-body px-2 py-2">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered align-items-center mb-0" id="tabelRekapJadwalLeader"
                                            style="font-size: 12px; border-color:#9ca0a7;">
                                            <thead class="bg-gray-200">
                                                <tr>
                                                    <th class="text-secondary text-xs font-weight-semibold">#</th>
                                                    <th class="text-secondary text-xs font-weight-semibold ps-2">Area</th>
                                                    <th class="text-secondary text-xs">Departement</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold ">Bulan</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold">Tahun</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold">Status</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">01</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">02</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">03</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">04</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">05</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">06</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">07</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">08</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">09</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">10</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">11</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">12</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">13</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">14</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">15</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">16</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">17</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">18</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">19</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">20</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">21</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">22</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">23</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">24</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">25</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">26</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">27</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">28</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">29</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">30</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">31</th>
                                                    <th class="text-center text-xs font-weight-semibold">Total</th>

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

                        <div class="tab-content">
                            <div class="tab-pane" id="DetailSpv" role="tabpanel" aria-expanded="true">

                                <div class="card-body px-2 py-2">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered align-items-center mb-0" id="tabelRekapJadwalSpv"
                                            style="font-size: 12px; border-color:#9ca0a7;">
                                            <thead class="bg-gray-200">
                                                <tr>
                                                    <th class="text-secondary text-xs font-weight-semibold">#</th>
                                                    <th class="text-secondary text-xs font-weight-semibold ps-2">Area</th>
                                                    <th class="text-secondary text-xs">Departement</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold ">Bulan</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold">Tahun</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold">Status</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">01</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">02</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">03</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">04</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">05</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">06</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">07</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">08</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">09</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">10</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">11</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">12</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">13</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">14</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">15</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">16</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">17</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">18</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">19</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">20</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">21</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">22</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">23</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">24</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">25</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">26</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">27</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">28</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">29</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">30</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">31</th>
                                                    <th class="text-center text-xs font-weight-semibold">Total</th>

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
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0"> <span id="titleLead">Data Jadwal Kerja Tim</span>
                                    </h6>
                                    {{-- <p class="text-sm" id="absensiNameMonthly">Employee Name</p> --}}
                                </div>

                                <div class="ms-auto d-flex">
                                    <button type="button" id="editStatusHadir"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        {{-- data-bs-toggle="modal" data-bs-target="#updateStatusHadir"> --}}
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Edit Status Kehadiran</span>
                                    </button>

                                    <a href="{{ route('importJadwalTim') }}">
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
                                            <span class="btn-inner--text">Import Jadwal IKR</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">
                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0"
                                    id="tabelJadwalTim" style="font-size: 12px; border-color:#9ca0a7;">
                                    <thead class="bg-gray-100">
                                        <tr id="headTool">
                                            <th class="text-xs font-weight-semibold">#</th>
                                            <th class="text-center text-xs font-weight-semibold">Area</th>
                                            <th class="text-secondary text-xs">Departement</th>
                                            <th class="text-center text-xs font-weight-semibold">NIK Karyawan</th>
                                            <th class="text-center text-xs font-weight-semibold">Nama Karyawan</th>
                                            <th class="text-center text-xs font-weight-semibold">Bulan</th>
                                            <th class="text-center text-xs font-weight-semibold">Tahun</th>
                                            <th class="text-center text-xs font-weight-semibold">01</th>
                                            <th class="text-center text-xs font-weight-semibold">02</th>
                                            <th class="text-center text-xs font-weight-semibold">03</th>
                                            <th class="text-center text-xs font-weight-semibold">04</th>
                                            <th class="text-center text-xs font-weight-semibold">05</th>
                                            <th class="text-center text-xs font-weight-semibold">06</th>
                                            <th class="text-center text-xs font-weight-semibold">07</th>
                                            <th class="text-center text-xs font-weight-semibold">08</th>
                                            <th class="text-center text-xs font-weight-semibold">09</th>
                                            <th class="text-center text-xs font-weight-semibold">10</th>
                                            <th class="text-center text-xs font-weight-semibold">11</th>
                                            <th class="text-center text-xs font-weight-semibold">12</th>
                                            <th class="text-center text-xs font-weight-semibold">13</th>
                                            <th class="text-center text-xs font-weight-semibold">14</th>
                                            <th class="text-center text-xs font-weight-semibold">15</th>
                                            <th class="text-center text-xs font-weight-semibold">16</th>
                                            <th class="text-center text-xs font-weight-semibold">17</th>
                                            <th class="text-center text-xs font-weight-semibold">18</th>
                                            <th class="text-center text-xs font-weight-semibold">19</th>
                                            <th class="text-center text-xs font-weight-semibold">20</th>
                                            <th class="text-center text-xs font-weight-semibold">21</th>
                                            <th class="text-center text-xs font-weight-semibold">22</th>
                                            <th class="text-center text-xs font-weight-semibold">23</th>
                                            <th class="text-center text-xs font-weight-semibold">24</th>
                                            <th class="text-center text-xs font-weight-semibold">25</th>
                                            <th class="text-center text-xs font-weight-semibold">26</th>
                                            <th class="text-center text-xs font-weight-semibold">27</th>
                                            <th class="text-center text-xs font-weight-semibold">28</th>
                                            <th class="text-center text-xs font-weight-semibold">29</th>
                                            <th class="text-center text-xs font-weight-semibold">30</th>
                                            <th class="text-center text-xs font-weight-semibold">31</th>
                                            

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

        {{-- Modal Edit Keharidan Tim --}}
        <div class="modal fade" id="updateStatusHadir" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Status Kehadiran IKR</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('simpanEditKehadiran') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-6 form-group mb-1">
                                            <span class="text-xs">Tanggal</span>
                                                <input class="form-control form-control-sm" type="date"
                                                    value="{{ date('Y-m-d') }}" id="tglProgress" name="tglProgress"
                                                    style="border-color:#9ca0a7;" required>
                                        </div>

                                        <div class="col form-group mb-1">
                                            <span class="text-xs">Area</span>
                                            <select class="form-control form-control-sm" type="text" id="branch"
                                                name="branch" style="border-color:#9ca0a7;">
                                                <option value="">Pilih Branch</option>
                                                    @if (isset($branches))
                                                        @foreach ($branches as $b)
                                                            <option value="{{ $b->id . '|' . $b->nama_branch }}">
                                                            {{ $b->nama_branch }}</option>
                                                        @endforeach
                                                    @endif
                                            </select>
                                        </div>                                        
                                    </div>

                                    <div class="form-group mb-1">
                                        <div class="row">
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">NIK Karyawan</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="nikKaryawan" name="nikKaryawan" style="border-color:#9ca0a7;" readonly>
                                            </div>
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Nama Karyawan</span>
                                                <select class="form-control form-control-sm" type="text"
                                                    id="namaKaryawan" name="namaKaryawan" style="border-color:#9ca0a7;" required>
                                                    <option value="">Pilih Karyawan</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group mb-1">
                                        <div class="row">
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Jadwal Karyawan</span>
                                                <input class="form-control form-control-sm" type="text" id="jadwalKaryawan"
                                                    name="jadwalKaryawan" style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Edit Status Kehadiran</span>
                                                <select class="form-control form-control-sm" type="text" id="statusKehadiran"
                                                    name="statusKehadiran" style="border-color:#9ca0a7;"
                                                    placeholder="Pilih Status Kehadiran">
                                                    <option value="ON">ON</option>
                                                    <option value="OFF">OFF</option>
                                                    <option value="OD">OD</option>
                                                    <option value="Cuti">Cuti</option>
                                                    <option value="Sakit">Sakit</option>
                                                    <option value="Absen">Absen</option>
                                                </select>
                                            </div>

                                            
                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Remarks</span>
                                        <textarea class="form-control form-control-sm" type="text" id="remarks" name="remarks"
                                            style="border-color:#9ca0a7;"></textarea>
                                    </div>

                                    

                                </div>

                                <div class="col">

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Foto Pengajuan Greatday</span>
                                        {{-- <textarea class="form-control form-control-sm" type="text" id="remarks" name="remarks"
                                            style="border-color:#9ca0a7;"></textarea> --}}
                                    </div>

                                    <div class="form-group mb-1 text-center">
                                            {{-- <span class="text-xs">Foto Konfirmasi Cst</span> --}}
                                            <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                id="showgambarPengajuan" alt="Card Image"
                                                style="width:160px;height: 160px;" />
                                    </div>

                                    <div class="form-group mb-1">
                                            <input class="form-control form-control-sm" id="fotoPengajuanGD"
                                                name="fotoPengajuanGD" type="file" style="border-color:#9ca0a7;">
                                    </div>
                                    
                                </div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="row text-center mb-0">
                                    <div class="col">
                                        <button type="submit"
                                            class="btn btn-sm btn-dark align-items-center simpanDistribusi"
                                            id="simpanEditKehadiran">Update Data</button>
                                        <button type="button" value="close"
                                            class="btn btn-sm btn-dark align-items-center"
                                            data-bs-dismiss="modal">Batalkan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Edit Kehadiran Tim --}}

        {{-- Modal Detail Keharidan Tim --}}
        <div class="modal fade" id="detailRekapStatus" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Status Kehadiran IKR</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="#" method="post" enctype="multipart/form-data">
                            @csrf --}}
                            <div class="row">
                                <div class="table-responsive p-0">
                                    <table class="table table-bordered align-items-center mb-0"
                                        id="tabelRekapDetailStatus" style="font-size: 12px;border-color:#9ca0a7;">
                                        <thead class="bg-gray-300">
                                            <tr id="headRekapDetailStatus">
                                                <th class="text-xs font-weight-semibold">#</th>
                                                <th class="text-xs font-weight-semibold">Tanggal</th>
                                                <th class="text-center text-xs">Area</th>
                                                <th class="text-center text-xs">Nik Karyawan</th>
                                                <th class="text-center text-xs">Nama karyawan</th>
                                                <th class="text-center text-xs">Posisi</th>
                                                <th class="text-center text-xs">Status</th>
                                                <th class="text-center text-xs">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyRekapDetailStatus">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="row text-center mb-0">
                                    <div class="col">
                                        <button type="button" value="close"
                                            class="btn btn-sm btn-dark align-items-center"
                                            data-bs-dismiss="modal">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Detail Kehadiran Tim --}}

        {{-- Modal Detail Rekap Status --}}
        <div class="modal fade" id="detailStatusHadir" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Rekap Status Kehadiran IKR</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="{{ route('simpanEditKehadiran') }}" method="post" enctype="multipart/form-data">
                            @csrf --}}
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-6 form-group mb-1">
                                            <span class="text-xs">Tanggal</span>
                                                <input class="form-control form-control-sm" type="date"
                                                    value="{{ date('Y-m-d') }}" id="tglProgressShow" name="tglProgressShow"
                                                    style="border-color:#9ca0a7;" readonly>
                                        </div>

                                        <div class="col form-group mb-1">
                                            <span class="text-xs">Area</span>
                                            <input class="form-control form-control-sm" type="text" id="branchShow"
                                                name="branchShow" style="border-color:#9ca0a7;" readonly>
                                                
                                        </div>                                        
                                    </div>

                                    <div class="form-group mb-1">
                                        <div class="row">
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">NIK Karyawan</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="nikKaryawanShow" name="nikKaryawanShow" style="border-color:#9ca0a7;" readonly>
                                            </div>
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Nama Karyawan</span>
                                                <input class="form-control form-control-sm" type="text"
                                                    id="namaKaryawanShow" name="namaKaryawanShow" style="border-color:#9ca0a7;" readonly>
                                                
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group mb-1">
                                        <div class="row">
                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Jadwal Karyawan</span>
                                                <input class="form-control form-control-sm" type="text" id="jadwalBeforeShow"
                                                    name="jadwalBeforeShow" style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            <div class="col form-group mb-1">
                                                <span class="text-xs">Edit Status Kehadiran</span>
                                                <input class="form-control form-control-sm" type="text" id="statusKehadiranShow"
                                                    name="statusKehadiranShow" style="border-color:#9ca0a7;" readonly>
                                            </div>

                                            
                                        </div>
                                    </div>

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Remarks</span>
                                        <textarea class="form-control form-control-sm" type="text" id="remarksShow" name="remarksShow"
                                            style="border-color:#9ca0a7;" readonly></textarea>
                                    </div>

                                    

                                </div>

                                <div class="col">

                                    <div class="form-group mb-1">
                                        <span class="text-xs">Foto Pengajuan Greatday</span>
                                        {{-- <textarea class="form-control form-control-sm" type="text" id="remarks" name="remarks"
                                            style="border-color:#9ca0a7;"></textarea> --}}
                                    </div>

                                    <div class="form-group mb-1 text-center">
                                            {{-- <span class="text-xs">Foto Konfirmasi Cst</span> --}}
                                            <img src="{{ asset('assets/img/default-150x150.png') }}"
                                                id="showgambarPengajuanShow" alt="Card Image"
                                                style="width:160px;height: 160px;" />
                                    </div>

                                    <div class="form-group mb-1">
                                            <input class="form-control form-control-sm" id="fotoPengajuanGD"
                                                name="fotoPengajuanGD" type="file" style="border-color:#9ca0a7;" disabled>
                                    </div>
                                    
                                </div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="row text-center mb-0">
                                    <div class="col">
                                        {{-- <button type="submit"
                                            class="btn btn-sm btn-dark align-items-center simpanDistribusi"
                                            id="simpanEditKehadiran">Update Data</button> --}}
                                        <button type="button" value="close"
                                            class="btn btn-sm btn-dark align-items-center"
                                            data-bs-dismiss="modal">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Detail Rekap Status --}}

    </main>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script
    src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-html5-3.1.0/fc-5.0.1/r-3.0.2/datatables.min.js">
</script>


<script type="text/javascript">
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
                $('#showgambarPengajuan').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fotoPengajuanGD").change(function() {
        readURL(this);
    });
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">

    $(document).ready(function() {
        var _token = $('meta[name=csrf-token]').attr('content');
        var firstDate;
        var lastDate;
        var stDate;
        var enDate;
        var dtkrywan;
        var tableJT;
        var bln = {!! $bulan !!}
        akses = $('#akses').val();        

        function toTitleCase(str) {
            return str.replace(
                /\w\S*/g,
                text => text.charAt(0).toUpperCase() + text.substring(1).toLowerCase()
            );
        }
        

        $(document).on('change', '#filTahun', function() {

            $('#filBulan').find('option').remove();
            dtBln = bln.filter(k=> k.tahun === $(this).val());
            $.each(dtBln, function(key, bl) {
                $('#filBulan').append(
                    `<option value="${bl.bulan}">${bl.bulanname}</option>`
                )
            })
        })

        $('#filTahun').trigger("change");
        
        $('#tabelJadwalTim').on('click', 'td', function(e) {
            var columns = tableJT.settings().init().columns;
            var colIndex = tableJT.cell(this).index().column;
            tglClick = columns[colIndex].name;
            console.log(tglClick);
            $.ajax({
                url: "{{ route('getDetailStatus') }}",
                type: "get",
                data: {
                    detail: $(this).data('id'),
                    tglClick: tglClick,
                    _token: _token
                },
                success: function(dtStatus) {

                    if(Object.keys(dtStatus).length > 0) {
                        $('#detailStatusHadir').modal('show');

                        $('#tglProgressShow').val('');
                        $('#branchShow').val('');
                        $('#nikKaryawanShow').val('');
                        $('#namaKaryawanShow').val('');
                        $('#jadwalKaryawanShow').val('');
                        $('#remarksShow').val('');
                        $('#showgambarPengajuanShow').attr('src',
                            `/storage/image-jadwal/default-150x150.png`
                        );

                        $('#tglProgressShow').val(dtStatus.tgl_jadwal);
                        $('#branchShow').val(dtStatus.branch);
                        $('#nikKaryawanShow').val(dtStatus.nik_karyawan);
                        $('#namaKaryawanShow').val(dtStatus.nama_karyawan);
                        $('#jadwalBeforeShow').val(dtStatus.jadwal_before);
                        $('#statusKehadiranShow').val(dtStatus.status_jadwal);
                        $('#remarksShow').val(dtStatus.keterangan);
                        $('#showgambarPengajuanShow').attr('src',
                            `/storage/image-jadwal/${dtStatus.foto_lampiran}`
                        );
                    }
                }
            })

        })

        $('.date-range').daterangepicker({
            startDate: moment().startOf("month"),
            endDate: moment(),
            
        });

        $(document).on('click', '#filKehadiran', function(e) {
            data_jadwalTim();
            rekap_jadwal_ikr();
            rekap_jadwal_leader();
            rekap_jadwal_staff();
            rekap_jadwal_spv();
            stDate = $('.date-range').data('daterangepicker').startDate.format("DD-MMM-YYYY");
            enDate = $('.date-range').data('daterangepicker').endDate.format("DD-MMM-YYYY");
        })
        

        $('#filKehadiran').trigger("click");

        function data_jadwalTim() {
            tableJT = $('#tabelJadwalTim').DataTable({
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
                fixedColumns: {
                    leftColumns: 4,
                    // rightColumns: 1
                },
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
                    url: "{{ route('getdataJadwalIkr') }}",
                    type: "get",
                    dataType: "json",
                    data: {
                        filTgl: $('#filtglProgress').val(),
                        filTahun: $('#filTahun').val(),
                        filBulan: $('#filBulan').val(),
                        filarea: $('#filarea').val(),
                        filNama: $('#filNama').val(),
                        filStatusHadir: $('#filStatusHadir').val(),
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
                    {data: 'branch'},
                    {data: 'departement'},
                    {
                        data: 'nik_karyawan',
                        className: 'text-center'
                    },
                    {
                        data: 'nama_karyawan'
                    },
                    {
                        data: 'bulanname'
                    },
                    {
                        data: 'tahun', className: 'text-center'
                    },
                    {data: 't01', name:'01'},{data: 't02', name:'02'},{data: 't03', name:'03'},{data: 't04', name:'04'},{data: 't05', name:'05'},{data: 't06', name:'06'},{data: 't07', name:'07'},{data: 't08', name:'08'},{data: 't09', name:'09'},{data: 't10', name:'10'},
                    {data: 't11', name:'11'},{data: 't12', name:'12'},{data: 't13', name:'13'},{data: 't14', name:'14'},{data: 't15', name:'15'},{data: 't16', name:'16'},{data: 't17', name:'17'},{data: 't18', name:'18'},{data: 't19', name:'19'},{data: 't20', name:'20'},
                    {data: 't21', name:'21'},{data: 't22', name:'22'},{data: 't23', name:'23'},{data: 't24', name:'24'},{data: 't25', name:'25'},{data: 't26', name:'26'},{data: 't27', name:'27'},{data: 't28', name:'28'},{data: 't29', name:'29'},{data: 't30', name:'30'},
                    {data: 't31', name:'31'},
                ],
                columnDefs: [
                    { targets: [6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36], 
                            render: function(data, type, row, col, index) {
                                var color = 'black';

                                if (data == 'ON') {
                                    color = 'blue';                                    
                                } 
                                if (data == 'OFF') {
                                    color = 'red';                                    
                                }
                                if (data == 'Sakit' || data == 'Cuti' || data == 'Absen') {
                                    color = 'red';

                                }
                                return '<span style="cursor:pointer; color:' + color + '">' + data + '</span>';
                            },
                            'createdCell': function(td, cellData, rowData, row, col) {
                                // this will give each cell an ID
                                $(td).attr('data-id', 'jdwlId-' + rowData.dtid +'|'+ cellData +'|'+ rowData.branch +'|'+ rowData.nik_karyawan +'|'+ rowData.bulan +'|'+ rowData.tahun);
                            }
                    },
                ]
            })
        }        

        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            // console.log($(this).data("id"));
            if($(this).data("id") === "DetailTeknisi") {
                // rekap_jadwal_ikr();
                $('#tabelRekapJadwalTeknisi').DataTable().columns.adjust().draw();
            }
            if($(this).data("id") === "DetailStaff") {
                // rekap_jadwal_staff();
                $('#tabelRekapJadwalStaff').DataTable().columns.adjust().draw();
            }
            if($(this).data("id") === "DetailLeader") {
                // rekap_jadwal_leader();
                $('#tabelRekapJadwalLeader').DataTable().columns.adjust().draw();
            }
            if($(this).data("id") === "DetailSpv") {
                // rekap_jadwal_spv();
                $('#tabelRekapJadwalSpv').DataTable().columns.adjust().draw();
            }
            
        })

        //klik tabel rekap
        $(document).on('click', '.det-rekap', function(e) {
            e.preventDefault();
            klik = $(this).data('id').split('|');
            tbl = klik[0];
            isi = klik[7];            

            if(tbl == "Teknisi" && isi != "0") {
                columns = tableTk.settings().init().columns;
                colIndex = tableTk.cell(this).index().column;
                tglClick = columns[colIndex].name;
            }
            if(tbl == "Staff" && isi != "0") {
                columns = tableSt.settings().init().columns;
                colIndex = tableSt.cell(this).index().column;
                tglClick = columns[colIndex].name;
            }
            if(tbl == "Leader" && isi != "0") {
                columns = tableLead.settings().init().columns;
                colIndex = tableLead.cell(this).index().column;
                tglClick = columns[colIndex].name;
            }
            if(tbl == "Supervisor" && isi != "0") {
                columns = tableSpv.settings().init().columns;
                colIndex = tableSpv.cell(this).index().column;
                tglClick = columns[colIndex].name;
            }

            if(isi != "0") {

                $('#detailRekapStatus').modal('show');

                tableDetRekap = 
                $('#tabelRekapDetailStatus').DataTable({
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
                        fixedColumns: false,

                        // fixedColumns: {
                        //     leftColumns: 5,
                        //     rightColumns: 1
                        // },
                        deferRender: true,
                        scrollCollapse: true,
                        scrollX: true,
                        pageLength: 10,
                        lengthChange: true,
                        bFilter: true,
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "{{ route('getDetailRekapStatus') }}",
                            type: "get",
                            dataType: "json",
                            data: {
                                detail: $(this).data('id'),
                                tglClick: tglClick,
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
                            {data: 'tgl'},
                            {data: 'branch'},
                            {data: 'nik_karyawan'},
                            {data: 'nama_karyawan'},                    
                            {data: 'posisi'},
                            {data: 'status'},
                            {data: 'keterangan'},
                                
                        ],
                        
                    })

            }
        })

        function rekap_jadwal_ikr() {
            tableTk = $('#tabelRekapJadwalTeknisi').DataTable({
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
                fixedColumns: true,

                fixedColumns: {
                    leftColumns: 5,
                    rightColumns: 1
                },
                deferRender: true,
                scrollCollapse: true,
                scrollX: true,
                pageLength: 10,
                lengthChange: true,
                bFilter: true,
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('getRekapDataJadwalTeknisi') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        _token: '{!! csrf_token() !!}',
                        filTgl: $('#filtglProgress').val(),
                        filTahun: $('#filTahun').val(),
                        filBulan: $('#filBulan').val(),
                        filarea: $('#filarea').val(),
                        filNama: $('#filNama').val(),
                        filStatusHadir: $('#filStatusHadir').val(),
                        akses: akses,
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
                    {data: 'branch'},
                    {data: 'departement'},
                    {
                        data: 'bulanname'
                    },
                    {
                        data: 'tahun'
                    },                    
                    {
                        data: 'status'
                    },
                    {data: 't01', name:'01'},{data: 't02', name:'02'},{data: 't03', name:'03'},{data: 't04', name:'04'},{data: 't05', name:'05'},{data: 't06', name:'06'},{data: 't07', name:'07'},{data: 't08', name:'08'},{data: 't09', name:'09'},{data: 't10', name:'10'},
                    {data: 't11', name:'11'},{data: 't12', name:'12'},{data: 't13', name:'13'},{data: 't14', name:'14'},{data: 't15', name:'15'},{data: 't16', name:'16'},{data: 't17', name:'17'},{data: 't18', name:'18'},{data: 't19', name:'19'},{data: 't20', name:'20'},
                    {data: 't21', name:'21'},{data: 't22', name:'22'},{data: 't23', name:'23'},{data: 't24', name:'24'},{data: 't25', name:'25'},{data: 't26', name:'26'},{data: 't27', name:'27'},{data: 't28', name:'28'},{data: 't29', name:'29'},{data: 't30', name:'30'},
                    {data: 't31', name:'31'},
                    {data: 'total', name:'total', "className": "text-center", render: DataTable.render.number()}
                    
                ],
                columnDefs: [
                    { targets: [5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36], 
                            render: function(data, type, row, col, index) {
                                var color = 'black';
                                var v;

                                if (data == '0') {
                                    v = ''; 
                                } 
                                if (data > '0') {
                                    v = '<span style="cursor:pointer; color:' + color + '">' + data + '</span>';                                    
                                }
                                return v;
                            },
                            'createdCell': function(td, cellData, rowData, row, col) {
                                // this will give each cell an ID
                                $(td).attr('data-id',rowData.dtid + "|" + $('#filNama').val() + "|" + cellData + "|" + rowData.departement);
                                $(td).attr('class', 'det-rekap');
                            }
                    },
                ]
            })
        }

        function rekap_jadwal_staff() {

            tableSt =$('#tabelRekapJadwalStaff').DataTable({
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
                fixedColumns: true,

                fixedColumns: {
                    leftColumns: 5,
                    rightColumns: 1
                },
                deferRender: true,
                scrollCollapse: true,
                scrollX: true,
                pageLength: 10,
                lengthChange: true,
                bFilter: true,
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('getRekapDataJadwalStaff') }}",
                    type: "post",
                    dataType: "json",
                    data: {
                        _token: '{!! csrf_token() !!}',
                        filTgl: $('#filtglProgress').val(),
                        filTahun: $('#filTahun').val(),
                        filBulan: $('#filBulan').val(),
                        filarea: $('#filarea').val(),
                        filNama: $('#filNama').val(),
                        filStatusHadir: $('#filStatusHadir').val(),
                        akses: akses,
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
                    {data: 'branch'},
                    {data: 'departement'},
                    {
                        data: 'bulanname'
                    },
                    {
                        data: 'tahun'
                    },                    
                    {
                        data: 'status'
                    },
                    {data: 't01', name:'01'},{data: 't02', name:'02'},{data: 't03', name:'03'},{data: 't04', name:'04'},{data: 't05', name:'05'},{data: 't06', name:'06'},{data: 't07', name:'07'},{data: 't08', name:'08'},{data: 't09', name:'09'},{data: 't10', name:'10'},
                    {data: 't11', name:'11'},{data: 't12', name:'12'},{data: 't13', name:'13'},{data: 't14', name:'14'},{data: 't15', name:'15'},{data: 't16', name:'16'},{data: 't17', name:'17'},{data: 't18', name:'18'},{data: 't19', name:'19'},{data: 't20', name:'20'},
                    {data: 't21', name:'21'},{data: 't22', name:'22'},{data: 't23', name:'23'},{data: 't24', name:'24'},{data: 't25', name:'25'},{data: 't26', name:'26'},{data: 't27', name:'27'},{data: 't28', name:'28'},{data: 't29', name:'29'},{data: 't30', name:'30'},
                    {data: 't31', name:'31'},
                    {data: 'total', name:'total', "className": "text-center", render: DataTable.render.number()}
                    
                ],
                columnDefs: [
                    { targets: [5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36], 
                            render: function(data, type, row, col, index) {
                                var color = 'black';
                                var v;

                                if (data == '0') {
                                    v = ''; 
                                } 
                                if (data > '0') {
                                    v = '<span style="cursor:pointer; color:' + color + '">' + data + '</span>';                                    
                                }
                                return v;
                            },
                            'createdCell': function(td, cellData, rowData, row, col) {
                                // this will give each cell an ID
                                $(td).attr('data-id',rowData.dtid + "|" + $('#filNama').val() + "|" + cellData + "|" + rowData.departement);
                                $(td).attr('class', 'det-rekap');
                            }
                    },
                ]
            })
        }

        function rekap_jadwal_leader() {

            tableLead = $('#tabelRekapJadwalLeader').DataTable({
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
                fixedColumns: true,

                fixedColumns: {
                    leftColumns: 5,
                    rightColumns: 1
                },
                deferRender: true,
                scrollCollapse: true,
                scrollX: true,
                pageLength: 10,
                lengthChange: true,
                bFilter: true,
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('getRekapDataJadwalLeader') }}",
                    type: "post",
                    dataType: "json",
                    data: {
                        _token: '{!! csrf_token() !!}',
                        filTgl: $('#filtglProgress').val(),
                        filTahun: $('#filTahun').val(),
                        filBulan: $('#filBulan').val(),
                        filarea: $('#filarea').val(),
                        filNama: $('#filNama').val(),
                        filStatusHadir: $('#filStatusHadir').val(),
                        akses: akses,
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
                    {data: 'branch'},
                    {data: 'departement'},
                    {
                        data: 'bulanname'
                    },
                    {
                        data: 'tahun'
                    },                    
                    {
                        data: 'status'
                    },
                    {data: 't01', name:'01'},{data: 't02', name:'02'},{data: 't03', name:'03'},{data: 't04', name:'04'},{data: 't05', name:'05'},{data: 't06', name:'06'},{data: 't07', name:'07'},{data: 't08', name:'08'},{data: 't09', name:'09'},{data: 't10', name:'10'},
                    {data: 't11', name:'11'},{data: 't12', name:'12'},{data: 't13', name:'13'},{data: 't14', name:'14'},{data: 't15', name:'15'},{data: 't16', name:'16'},{data: 't17', name:'17'},{data: 't18', name:'18'},{data: 't19', name:'19'},{data: 't20', name:'20'},
                    {data: 't21', name:'21'},{data: 't22', name:'22'},{data: 't23', name:'23'},{data: 't24', name:'24'},{data: 't25', name:'25'},{data: 't26', name:'26'},{data: 't27', name:'27'},{data: 't28', name:'28'},{data: 't29', name:'29'},{data: 't30', name:'30'},
                    {data: 't31', name:'31'},
                    {data: 'total', name:'total', "className": "text-center", render: DataTable.render.number()}
                    
                ],
                columnDefs: [
                    { targets: [5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36], 
                            render: function(data, type, row, col, index) {
                                var color = 'black';
                                var v;

                                if (data == '0') {
                                    v = ''; 
                                } 
                                if (data > '0') {
                                    v = '<span style="cursor:pointer; color:' + color + '">' + data + '</span>';                                    
                                }
                                return v;
                            },
                            'createdCell': function(td, cellData, rowData, row, col) {
                                // this will give each cell an ID
                                $(td).attr('data-id',rowData.dtid + "|" + $('#filNama').val() + "|" + cellData + "|" + rowData.departement);
                                $(td).attr('class', 'det-rekap');
                            }
                    },
                ]
            })

        }

        function rekap_jadwal_spv() {

            tableSpv =$('#tabelRekapJadwalSpv').DataTable({
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
                fixedColumns: true,

                fixedColumns: {
                    leftColumns: 5,
                    rightColumns: 1
                },
                deferRender: true,
                scrollCollapse: true,
                scrollX: true,
                pageLength: 10,
                lengthChange: true,
                bFilter: true,
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('getRekapDataJadwalSpv') }}",
                    type: "post",
                    dataType: "json",
                    data: {
                        _token: '{!! csrf_token() !!}',
                        filTgl: $('#filtglProgress').val(),
                        filTahun: $('#filTahun').val(),
                        filBulan: $('#filBulan').val(),
                        filarea: $('#filarea').val(),
                        filNama: $('#filNama').val(),
                        filStatusHadir: $('#filStatusHadir').val(),
                        akses: akses,
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
                    {data: 'branch'},
                    {data: 'departement'},
                    {
                        data: 'bulanname'
                    },
                    {
                        data: 'tahun'
                    },                    
                    {
                        data: 'status'
                    },
                    {data: 't01', name:'01'},{data: 't02', name:'02'},{data: 't03', name:'03'},{data: 't04', name:'04'},{data: 't05', name:'05'},{data: 't06', name:'06'},{data: 't07', name:'07'},{data: 't08', name:'08'},{data: 't09', name:'09'},{data: 't10', name:'10'},
                    {data: 't11', name:'11'},{data: 't12', name:'12'},{data: 't13', name:'13'},{data: 't14', name:'14'},{data: 't15', name:'15'},{data: 't16', name:'16'},{data: 't17', name:'17'},{data: 't18', name:'18'},{data: 't19', name:'19'},{data: 't20', name:'20'},
                    {data: 't21', name:'21'},{data: 't22', name:'22'},{data: 't23', name:'23'},{data: 't24', name:'24'},{data: 't25', name:'25'},{data: 't26', name:'26'},{data: 't27', name:'27'},{data: 't28', name:'28'},{data: 't29', name:'29'},{data: 't30', name:'30'},
                    {data: 't31', name:'31'},
                    {data: 'total', name:'total', "className": "text-center", render: DataTable.render.number()}
                    
                ],
                columnDefs: [
                    { targets: [5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36], 
                            render: function(data, type, row, col, index) {
                                var color = 'black';
                                var v;

                                if (data == '0') {
                                    v = ''; 
                                } 
                                if (data > '0') {
                                    v = '<span style="cursor:pointer; color:' + color + '">' + data + '</span>';                                    
                                }
                                return v;
                            },
                            'createdCell': function(td, cellData, rowData, row, col) {
                                // this will give each cell an ID
                                $(td).attr('data-id',rowData.dtid + "|" + $('#filNama').val() + "|" + cellData + "|" + rowData.departement);
                                $(td).attr('class', 'det-rekap');
                            }
                    },
                ]
            })
        }

        // {{-- Start Part Callsign Tim  --}}
        let area;
        let leader;

        function get_stat_jadwal(){
            var _token = $('meta[name=csrf-token]').attr('content');
            let branch = $('#branch').val();
            let tgl = $('#tglProgress').val();

        }

        $(document).on('click', '#editStatusHadir', function(e) {
            $('#updateStatusHadir').modal('show');
            $('#branch').val('');
            // $('#tglProgress').val('');
            $('#namaKaryawan').val('');
            $('#nikKaryawan').val('');
            $('#jadwalKaryawan').val('');
            $('#showgambarPengajuan').attr('src',
                `assets/img/default-150x150.png`
            );
        })

        $(document).on('change', '#branch', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let branch = $(this).val();
            let tgl = $('#tglProgress').val();
            $.ajax({
                url: "{{ route('getKaryawan') }}",
                type: "get",
                data: {
                    branch: branch,
                    tgl: tgl,
                    _token: _token
                },
                success: function(dtKry) {
                    dtkrywan = dtKry;
                    // $('#namaKaryawan').val('');
                    $('#nikKaryawan').val('');
                    $('#jadwalKaryawan').val('');
                    $('#namaKaryawan').find('option').remove();
                    $('#namaKaryawan').append(
                        `<option value="">Pilih Karyawan</option>`);

                    $.each(dtKry, function(key, kry) {
                        $('#namaKaryawan').append(
                            `<option value="${kry.id}">${kry.nama_karyawan}</option>`
                        )
                    })

                }
            })
        })        

        $(document).on('change', '#namaKaryawan', function(t) {
            // t.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            
            let day = 't' + new Date($('#tglProgress').val()).getDate().toString().padStart(2, "0");
            console.log('dy : ', day)
            let kr = dtkrywan.find(o => o.id === Number($(this).val()));

            console.log('kr.length : ', kr==null);
            $('#nikKaryawan').val(kr.nik_karyawan)
            $('#jadwalKaryawan').val(kr[day])

        })

        $(document).on('change', '#tglProgress', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let branch = $('#branch').val();
            let tgl = $(this).val();
            $.ajax({
                url: "{{ route('getKaryawan') }}",
                type: "get",
                data: {
                    branch: branch,
                    tgl: tgl,
                    _token: _token
                },
                success: function(dtKry) {
                    dtkrywan = dtKry;

                    $('#nikKaryawan').val('');
                    $('#jadwalKaryawan').val('');
                    $('#namaKaryawan').find('option').remove();
                    $('#namaKaryawan').append(
                        `<option value="">Pilih Karyawan</option>`);

                    $.each(dtKry, function(key, kry) {
                        $('#namaKaryawan').append(
                            `<option value="${kry.id}">${kry.nama_karyawan}</option>`
                        )
                    })

                    $('#namaKaryawan').trigger('change');

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
                    // $('#leaderid').val(dtLead.callLead.leader_id)
                    // $('#leader').val(dtLead.callLead.nama_karyawan)
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



        $(document).on('click', '#detail-assign', function(e) {
            // e.preventDefault();
            var _token = $('meta[name=csrf-token]').attr('content');
            let assign_id = $(this).data('id');

            $.ajax({
                url: "{{ route('getDetailAssign') }}",
                type: "get",
                data: {
                    filAssignId: assign_id,
                    _token: _token
                },
                success: function(dtDis) {
                    console.log(dtDis);
                    $('#detId').val(dtDis.data.id)
                    $('#noWoShow').val(dtDis.data.no_wo_apk)
                    $('#ticketNoShow').val(dtDis.data.no_ticket_apk)
                    $('#woTypeShow').val(toTitleCase(dtDis.data.wo_type_apk))
                    $('#jenisWoShow').val(dtDis.data.type_wo)
                    $('#WoDateShow').val(dtDis.data.wo_date_apk)
                    $('#custIdShow').val(dtDis.data.cust_id_apk)
                    $('#custNameShow').val(toTitleCase(dtDis.data.name_cust_apk))
                    $('#custPhoneShow').val(dtDis.data.cust_phone_apk)

                    $('#custMobileShow').val(dtDis.data.cust_mobile_apk);
                    $('#custAddressShow').val(toTitleCase(dtDis.data.address_apk));
                    $('#areaShow').val(toTitleCase(dtDis.data.area_cluster_apk));
                    $('#ikrDateApkShow').val(dtDis.data.ikr_date_apk);
                    $('#timeApkShow').val(dtDis.data.time_apk);
                    $('#fatCodeShow').val(dtDis.data.fat_code_apk);
                    $('#portFatShow').val(dtDis.data.fat_port_apk);
                    $('#remarksShow').val(toTitleCase(dtDis.data.remarks_apk));

                    $('#branchShow').val(dtDis.data.branch_id + '|' + dtDis.data.branch);
                    $('#tglProgressShow').val(dtDis.data.tgl_ikr);

                    $('#sesiShowAdd').val(toTitleCase(dtDis.data.batch_wo || ""));
                    $('#sesiShow').val(toTitleCase(dtDis.data.batch_wo || ""));
                    console.log(dtDis.data.batch_wo);


                    leadCallsignDet = dtDis.data.leadcall_id + '|' + dtDis.data.leadcall
                    // document.getElementById("LeadCallsignShow").value = leadCallsignDet;
                    $('#LeadCallsignShow').val(leadCallsignDet);
                    // $('#LeadCallsignShow').trigger('change');

                    $('#leaderShow').val(dtDis.data.leader);
                    $('#leaderidShow').val(dtDis.data.leader_id);
                    $('#slotTimeShow').val(dtDis.data.slot_time);

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
                    $('#teknisi1Show').val(dtDis.data.tek1_nik + '|' + dtDis.data.teknisi1);
                    $('#teknisi2Show').val(dtDis.data.tek2_nik + '|' + dtDis.data.teknisi2);
                    $('#teknisi3Show').val(dtDis.data.tek3_nik + '|' + dtDis.data.teknisi3);
                    $('#teknisi4Show').val(dtDis.data.tek4_nik + '|' + dtDis.data.teknisi4);

                    $('#showAssignTim').modal('show');
                }
            })
        })


    })
</script>
