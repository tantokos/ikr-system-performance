<style>
    /* Efek pada tombol accordion */
    .accordion-button::after {
        filter: invert(1);
    }

    /* Background khusus untuk link aktif */
    .custom-active {
        background: linear-gradient(135deg, #007bff, #0056b3);
        /* Gradient biru */
        color: white !important;
        /* Warna teks putih */
        border-radius: 8px;
        /* Membuat sudut lebih halus */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        /* Bayangan lembut */
        padding-left: 1rem;
    }

    /* Hover effect agar lebih interaktif */
    .custom-active:hover {
        background: linear-gradient(135deg, #0056b3, #003c80);
        color: white !important;
    }
</style>


<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0" href="/">
            <span class="font-weight-bold text-md">PT. Mitra Sinergi Telematika</span>
        </a>
    </div>
    {{-- <div class="collapse navbar-collapse px-4  w-auto " id="sidenav-collapse-main"> --}}
    <div class="px-4  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            {{-- <li class="nav-item">
                <a
                    class="nav-link  {{ is_current_route('leader-performance') || is_current_route('technician-performance') ? 'active' : '' }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>table</title>
                            <g id="table" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="view-grid" transform="translate(12.000000, 12.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <path class="color-foreground"
                                        d="M3.42857143,0 C1.53502286,0 0,1.53502286 0,3.42857143 L0,6.85714286 C0,8.75069143 1.53502286,10.2857143 3.42857143,10.2857143 L6.85714286,10.2857143 C8.75069143,10.2857143 10.2857143,8.75069143 10.2857143,6.85714286 L10.2857143,3.42857143 C10.2857143,1.53502286 8.75069143,0 6.85714286,0 L3.42857143,0 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M3.42857143,13.7142857 C1.53502286,13.7142857 0,15.2492571 0,17.1428571 L0,20.5714286 C0,22.4650286 1.53502286,24 3.42857143,24 L6.85714286,24 C8.75069143,24 10.2857143,22.4650286 10.2857143,20.5714286 L10.2857143,17.1428571 C10.2857143,15.2492571 8.75069143,13.7142857 6.85714286,13.7142857 L3.42857143,13.7142857 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M13.7142857,3.42857143 C13.7142857,1.53502286 15.2492571,0 17.1428571,0 L20.5714286,0 C22.4650286,0 24,1.53502286 24,3.42857143 L24,6.85714286 C24,8.75069143 22.4650286,10.2857143 20.5714286,10.2857143 L17.1428571,10.2857143 C15.2492571,10.2857143 13.7142857,8.75069143 13.7142857,6.85714286 L13.7142857,3.42857143 Z"
                                        id="Path"></path>
                                    <path class="color-foreground"
                                        d="M13.7142857,17.1428571 C13.7142857,15.2492571 15.2492571,13.7142857 17.1428571,13.7142857 L20.5714286,13.7142857 C22.4650286,13.7142857 24,15.2492571 24,17.1428571 L24,20.5714286 C24,22.4650286 22.4650286,24 20.5714286,24 L17.1428571,24 C15.2492571,24 13.7142857,22.4650286 13.7142857,20.5714286 L13.7142857,17.1428571 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Monthly Performance</span>
                </a>
            </li>

            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link position-relative ms-0 ps-2 py-2 {{ is_current_route('leader-performance') ? 'active' : '' }}"
                    href="{{ route('leader-performance') }}">
                    <span class="nav-link-text ms-1">Leader Performance</span>
                </a>
            </li>
            <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link position-relative ms-0 ps-2 py-2 {{ is_current_route('users-management') ? 'active' : '' }}"
                    href="#">
                    <span class="nav-link-text ms-1">Technician Performance</span>
                </a>
            </li> --}}


            <li class="nav-item">
                <div class="accordion" id="karyawanTimAccordion">
                    <!-- Accordion Item: Karyawan & Tim -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingKaryawanTim">
                            <button
                                class="accordion-button nav-link {{ is_current_route('dataKaryawan') || is_current_route('dataTim') || is_current_route('importJadwalTim') || is_current_route('jadwalTim') ? 'active' : '' }}"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseKaryawanTim" aria-expanded="true"
                                aria-controls="collapseKaryawanTim">
                                <span class="nav-link-text ms-1">Karyawan & Tim</span>
                            </button>
                        </h2>
                        <div id="collapseKaryawanTim"
                            class="accordion-collapse collapse
                            {{ is_current_route('dataKaryawan') || is_current_route('dataTim') || is_current_route('importJadwalTim') || is_current_route('jadwalTim') ? 'show' : '' }}"
                            aria-labelledby="headingKaryawanTim" data-bs-parent="#karyawanTimAccordion">
                            <div class="accordion-body p-0">
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('dataKaryawan') ? 'custom-active' : '' }}"
                                    href="{{ route('dataKaryawan') }}">
                                    <span class="nav-link-text ms-1">Data Karyawan</span>
                                </a>
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('dataTim') ? 'custom-active' : '' }}"
                                    href="{{ route('dataTim') }}">
                                    <span class="nav-link-text ms-1">Data Tim</span>
                                </a>
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('jadwalTim') || is_current_route('importJadwalTim') ? 'custom-active' : '' }}"
                                    href="{{ route('jadwalTim') }}">
                                    <span class="nav-link-text ms-1">Jadwal Tim</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <div class="accordion" id="monitoringTimAccordion">
                    <!-- Accordion Item: Monitoring Tim -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingMonitoringTim">
                            <button
                                class="accordion-button nav-link {{ is_current_route('analisaWo') || is_current_route('assignTim') || is_current_route('rekapAssignTim') || is_current_route('importDataWo') || is_current_route('fttx-assign-team') || is_current_route('fttx.import.assign-team') || is_current_route('rescheduleWO') ? 'active' : '' }}"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseMonitoringTim" aria-expanded="true"
                                aria-controls="collapseMonitoringTim">
                                <span class="nav-link-text ms-1">Monitoring Tim</span>
                            </button>
                        </h2>
                        <div id="collapseMonitoringTim"
                            class="accordion-collapse collapse
                            {{ is_current_route('analisaWo') || is_current_route('assignTim') || is_current_route('importDataWo') || is_current_route('fttx.import.assign-team') || is_current_route('fttx-assign-team') || is_current_route('rekapAssignTim') || is_current_route('rescheduleWO') ? 'show' : '' }}"
                            aria-labelledby="headingMonitoringTim" data-bs-parent="#monitoringTimAccordion">
                            <div class="accordion-body p-0">
                                <!-- Rekap Assign Tim -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('rekapAssignTim') ? 'custom-active' : '' }}"
                                    href="{{ route('rekapAssignTim') }}">
                                    <span class="nav-link-text ms-1">Rekap Assign Tim</span>
                                </a>
                                {{-- <li class="nav-item border-start my-0 pt-2">
                                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ is_current_route('analisaWo') ? 'active' : '' }}"
                                        href="{{ route('analisaWo') }}">
                                        <span class="nav-link-text ms-1">Analisa WO</span>
                                    </a>
                                </li> --}}
                                <!-- Assign Tim -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('assignTim') || is_current_route('importDataWo') ? 'custom-active' : '' }}"
                                    href="{{ route('assignTim') }}">
                                    <span class="nav-link-text ms-1">Assign Tim</span>
                                </a>
                                <!-- Assign Tim FTTX -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('fttx-assign-team') || is_current_route('fttx.import.assign-team') ? 'custom-active' : '' }}"
                                    href="{{ route('fttx-assign-team') }}">
                                    <span class="nav-link-text ms-1">Assign Tim FTTX</span>
                                </a>
                                <!-- Penjadwalan Ulang WO -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('rescheduleWO') ? 'custom-active' : '' }}"
                                    href="{{ route('rescheduleWO') }}">
                                    <span class="nav-link-text ms-1">Penjadwalan Ulang WO</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <div class="accordion" id="FatAccordion">
                    <!-- Accordion Item: Monitoring WO -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFat">
                            <button
                                class="accordion-button nav-link {{ is_current_route('areaFat') || is_current_route('rootCause') ? 'active' : '' }}"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseFat" aria-expanded="true"
                                aria-controls="collapseFat">
                                <span class="nav-link-text ms-1">Rootcause & Area</span>
                            </button>
                        </h2>
                        <div id="collapseFat"
                            class="accordion-collapse collapse {{ is_current_route('areaFat') || is_current_route('rootCause') ? 'show' : '' }}"
                            aria-labelledby="headingFat" data-bs-parent="#FatAccordion">
                            <div class="accordion-body p-0">
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('areaFat') ? 'custom-active' : '' }}"
                                    href="{{ route('areaFat') }}">
                                    <span class="nav-link-text ms-1">Area FAT</span>
                                </a>
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('rootCause') ? 'custom-active' : '' }}"
                                    href="{{ route('rootCause') }}">
                                    <span class="nav-link-text ms-1">Root Cause</span>
                                </a>

                            </div>
                        </div>
                    </div>

                    {{-- <span class="nav-link-text ms-1">Monitoring WO</span> --}}
                </a>
            </li>

            {{-- @if (Auth::user()->name == "Tanto") --}}
            <li class="nav-item">
                <div class="accordion" id="monitoringWOAccordion">
                    <!-- Accordion Item: Monitoring WO -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingMonitoringWO">
                            <button
                                class="accordion-button nav-link {{ is_current_route('monitFtthIB') || is_current_route('monitFtthMT') || is_current_route('rekapProgressWO') || is_current_route('ftth-dismantle') || is_current_route('fttx-ib') ||
    is_current_route('importDataFtthIbApk') || is_current_route('importIbMaterial') || is_current_route('importDataFtthMtApk') || is_current_route('importDataMaterial') || is_current_route('importFtthDismantle') ||
    is_current_route('importMaterialDismantle') || is_current_route('fttx-mt') ? 'active' : '' }}"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseMonitoringWO" aria-expanded="true"
                                aria-controls="collapseMonitoringWO">
                                <span class="nav-link-text ms-1">Monitoring WO</span>
                            </button>
                        </h2>
                        <div id="collapseMonitoringWO"
                            class="accordion-collapse collapse
                            {{ is_current_route('monitFtthIB') || is_current_route('monitFtthMT') || is_current_route('rekapProgressWO') || is_current_route('ftth-dismantle') || is_current_route('importDataFtthIbApk') || is_current_route('importIbMaterial') || is_current_route('importDataFtthMtApk') || is_current_route('importDataMaterial') || is_current_route('importFtthDismantle') || is_current_route('importMaterialDismantle') || is_current_route('fttx-ib') || is_current_route('fttx-mt') ? 'show' : '' }}"
                            aria-labelledby="headingMonitoringWO" data-bs-parent="#monitoringWOAccordion">
                            <div class="accordion-body p-0">
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('rekapProgressWO') ? 'custom-active' : '' }}"
                                    href="{{ route('rekapProgressWO') }}">
                                    <span class="nav-link-text ms-1">Rekap Progress WO</span>
                                </a>
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('monitFtthIB') || is_current_route('importDataFtthIbApk') || is_current_route('importIbMaterial') ? 'custom-active' : '' }}"
                                    href="{{ route('monitFtthIB') }}">
                                    <span class="nav-link-text ms-1">FTTH New Installation</span>
                                </a>
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('monitFtthMT') || is_current_route('importDataFtthMtApk') || is_current_route('importDataMaterial') ? 'custom-active' : '' }}"
                                    href="{{ route('monitFtthMT') }}">
                                    <span class="nav-link-text ms-1">FTTH Maintenance</span>
                                </a>
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('ftth-dismantle') || is_current_route('importFtthDismantle') || is_current_route('importMaterialDismantle') ? 'custom-active' : '' }}"
                                    href="{{ route('ftth-dismantle') }}">
                                    <span class="nav-link-text ms-1">FTTH Dismantle</span>
                                </a>
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('fttx-ib') ? 'custom-active' : '' }}"
                                    href="{{ route('fttx-ib') }}">
                                    <span class="nav-link-text ms-1">FTTX New Installation</span>
                                </a>
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('fttx-mt') ? 'custom-active' : '' }}"
                                    href="{{ route('fttx-mt') }}">
                                    <span class="nav-link-text ms-1">FTTX Maintenance</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- <span class="nav-link-text ms-1">Monitoring WO</span> --}}
                </a>
            </li>

            <li class="nav-item">
                <div class="accordion" id="monitoringFotoAccordion">
                    <!-- Accordion Item: Monitoring Foto APK -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingMonitoringFoto">
                            <button
                                class="accordion-button nav-link {{ is_current_route('monitFotoFtthMT') || is_current_route('monitFotoFtthIB') || is_current_route('monitFotoFtthDismantle') ? 'active' : '' }}"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseMonitoringFoto"
                                aria-expanded="true" aria-controls="collapseMonitoringFoto">
                                <span class="nav-link-text ms-1">Monitoring Foto APK</span>
                            </button>
                        </h2>
                        <div id="collapseMonitoringFoto"
                            class="accordion-collapse collapse
                            {{ is_current_route('monitFotoFtthMT') || is_current_route('monitFotoFtthIB') || is_current_route('monitFotoFtthDismantle') ? 'show' : '' }}"
                            aria-labelledby="headingMonitoringFoto" data-bs-parent="#monitoringFotoAccordion">
                            <div class="accordion-body p-0">
                                <!-- Foto FTTH New Installation -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('monitFotoFtthIB') ? 'custom-active' : '' }}"
                                    href="#">
                                    <span class="nav-link-text ms-1">Foto FTTH New Installation</span>
                                </a>
                                <!-- Foto FTTH Maintenance -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('monitFotoFtthMT') ? 'custom-active' : '' }}"
                                    href="{{ route('monitFotoFtthMT') }}">
                                    <span class="nav-link-text ms-1">Foto FTTH Maintenance</span>
                                </a>
                                <!-- Foto FTTH Dismantle -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('monitFotoFtthDismantle') ? 'custom-active' : '' }}"
                                    href="#">
                                    <span class="nav-link-text ms-1">Foto FTTH Dismantle</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            {{-- <li class="nav-item">
                <a
                    class="nav-link  {{ is_current_route('dataSeragam') || is_current_route('distribusiSeragam') || is_current_route('penerimaanSeragam')  ? 'active' : '' }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>table</title>
                            <g id="table" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="view-grid" transform="translate(12.000000, 12.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <path class="color-foreground"
                                        d="M3.42857143,0 C1.53502286,0 0,1.53502286 0,3.42857143 L0,6.85714286 C0,8.75069143 1.53502286,10.2857143 3.42857143,10.2857143 L6.85714286,10.2857143 C8.75069143,10.2857143 10.2857143,8.75069143 10.2857143,6.85714286 L10.2857143,3.42857143 C10.2857143,1.53502286 8.75069143,0 6.85714286,0 L3.42857143,0 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M3.42857143,13.7142857 C1.53502286,13.7142857 0,15.2492571 0,17.1428571 L0,20.5714286 C0,22.4650286 1.53502286,24 3.42857143,24 L6.85714286,24 C8.75069143,24 10.2857143,22.4650286 10.2857143,20.5714286 L10.2857143,17.1428571 C10.2857143,15.2492571 8.75069143,13.7142857 6.85714286,13.7142857 L3.42857143,13.7142857 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M13.7142857,3.42857143 C13.7142857,1.53502286 15.2492571,0 17.1428571,0 L20.5714286,0 C22.4650286,0 24,1.53502286 24,3.42857143 L24,6.85714286 C24,8.75069143 22.4650286,10.2857143 20.5714286,10.2857143 L17.1428571,10.2857143 C15.2492571,10.2857143 13.7142857,8.75069143 13.7142857,6.85714286 L13.7142857,3.42857143 Z"
                                        id="Path"></path>
                                    <path class="color-foreground"
                                        d="M13.7142857,17.1428571 C13.7142857,15.2492571 15.2492571,13.7142857 17.1428571,13.7142857 L20.5714286,13.7142857 C22.4650286,13.7142857 24,15.2492571 24,17.1428571 L24,20.5714286 C24,22.4650286 22.4650286,24 20.5714286,24 L17.1428571,24 C15.2492571,24 13.7142857,22.4650286 13.7142857,20.5714286 L13.7142857,17.1428571 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Seragam IKR</span>
                </a>
            </li> --}}

            {{-- <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link position-relative ms-0 ps-2 py-2 {{ is_current_route('dataSeragam') ? 'active' : '' }}"
                    href="{{ route('dataSeragam') }}">
                    <span class="nav-link-text ms-1">Data Seragam</span>
                </a>
            </li> --}}

            {{-- <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link position-relative ms-0 ps-2 py-2 {{ is_current_route('penerimaanSeragam') ? 'active' : '' }}"
                    href="{{ route('penerimaanSeragam') }}">
                    <span class="nav-link-text ms-1">Penerimaan Seragam</span>
                </a>
            </li> --}}

            {{-- <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link position-relative ms-0 ps-2 py-2 {{ is_current_route('distribusiSeragam') ? 'active' : '' }}"
                    href="{{ route('distribusiSeragam') }}">
                    <span class="nav-link-text ms-1">Distribusi Seragam</span>
                </a>
            </li> --}}

            {{-- <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link position-relative ms-0 ps-2 py-2 {{ is_current_route('updateSeragam') ? 'active' : '' }}"
                    href="{{ route('updateSeragam') }}">
                    <span class="nav-link-text ms-1">Update Seragam IKR</span>
                </a>
            </li> --}}


            <li class="nav-item">
                <div class="accordion" id="toolsIKRAccordion">
                    <!-- Accordion Item: Tools IKR -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingToolsIKR">
                            <button
                                class="accordion-button nav-link {{ is_current_route('dataTool') || is_current_route('distribusiTool') || is_current_route('dataKembaliTool') || is_current_route('dataKembaliToolGA') || is_current_route('laporanTool') || is_current_route('disposalTool') ? 'active' : '' }}"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseToolsIKR" aria-expanded="true"
                                aria-controls="collapseToolsIKR">
                                <span class="nav-link-text ms-1">Tools IKR</span>
                            </button>
                        </h2>
                        <div id="collapseToolsIKR"
                            class="accordion-collapse collapse
                            {{ is_current_route('dataTool') || is_current_route('distribusiTool') || is_current_route('dataKembaliTool') || is_current_route('dataKembaliToolGA') || is_current_route('laporanTool') || is_current_route('disposalTool') || is_current_route('poTool') ? 'show' : '' }}"
                            aria-labelledby="headingToolsIKR" data-bs-parent="#toolsIKRAccordion">
                            <div class="accordion-body p-0">
                                <!-- Po Tools -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('poTool') ? 'custom-active' : '' }}"
                                    href="{{ route('poTool') }}">
                                    <span class="nav-link-text ms-1">PO Tools IKR</span>
                                </a>

                                <!-- Data Tools -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('dataTool') ? 'custom-active' : '' }}"
                                    href="{{ route('dataTool') }}">
                                    <span class="nav-link-text ms-1">Data Tools</span>
                                </a>
                                <!-- Distribusi Tools -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('distribusiTool') ? 'custom-active' : '' }}"
                                    href="{{ route('distribusiTool') }}">
                                    <span class="nav-link-text ms-1">Distribusi Tools</span>
                                </a>
                                <!-- Laporan Kondisi Tools -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('laporanTool') ? 'custom-active' : '' }}"
                                    href="{{ route('laporanTool') }}">
                                    <span class="nav-link-text ms-1">Laporan Kondisi Tools</span>
                                </a>
                                <!-- Pengembalian Tools -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('dataKembaliTool') ? 'custom-active' : '' }}"
                                    href="{{ route('dataKembaliTool') }}">
                                    <span class="nav-link-text ms-1">Pengembalian Tools</span>
                                </a>
                                <!-- Pengembalian Tools GA -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('dataKembaliToolGA') ? 'custom-active' : '' }}"
                                    href="{{ route('dataKembaliToolGA') }}">
                                    <span class="nav-link-text ms-1">Pengembalian Tools GA</span>
                                </a>
                                <!-- Disposal Tools -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('disposalTool') ? 'custom-active' : '' }}"
                                    href="{{ route('disposalTool') }}">
                                    <span class="nav-link-text ms-1">Disposal Tools</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link  {{ is_current_route('import-performance') ? 'active' : '' }}"
                    href="{{ route('import-performance') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>table</title>
                            <g id="table" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="view-grid" transform="translate(12.000000, 12.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <path class="color-foreground"
                                        d="M3.42857143,0 C1.53502286,0 0,1.53502286 0,3.42857143 L0,6.85714286 C0,8.75069143 1.53502286,10.2857143 3.42857143,10.2857143 L6.85714286,10.2857143 C8.75069143,10.2857143 10.2857143,8.75069143 10.2857143,6.85714286 L10.2857143,3.42857143 C10.2857143,1.53502286 8.75069143,0 6.85714286,0 L3.42857143,0 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M3.42857143,13.7142857 C1.53502286,13.7142857 0,15.2492571 0,17.1428571 L0,20.5714286 C0,22.4650286 1.53502286,24 3.42857143,24 L6.85714286,24 C8.75069143,24 10.2857143,22.4650286 10.2857143,20.5714286 L10.2857143,17.1428571 C10.2857143,15.2492571 8.75069143,13.7142857 6.85714286,13.7142857 L3.42857143,13.7142857 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M13.7142857,3.42857143 C13.7142857,1.53502286 15.2492571,0 17.1428571,0 L20.5714286,0 C22.4650286,0 24,1.53502286 24,3.42857143 L24,6.85714286 C24,8.75069143 22.4650286,10.2857143 20.5714286,10.2857143 L17.1428571,10.2857143 C15.2492571,10.2857143 13.7142857,8.75069143 13.7142857,6.85714286 L13.7142857,3.42857143 Z"
                                        id="Path"></path>
                                    <path class="color-foreground"
                                        d="M13.7142857,17.1428571 C13.7142857,15.2492571 15.2492571,13.7142857 17.1428571,13.7142857 L20.5714286,13.7142857 C22.4650286,13.7142857 24,15.2492571 24,17.1428571 L24,20.5714286 C24,22.4650286 22.4650286,24 20.5714286,24 L17.1428571,24 C15.2492571,24 13.7142857,22.4650286 13.7142857,20.5714286 L13.7142857,17.1428571 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Import Data Absensi</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link  {{ is_current_route('confirm-customer') ? 'active' : '' }}"
                    href="{{ route('confirm-customer') }}">
                    <span class="nav-link-text ms-1">Konfirmasi Customer</span>
                </a>
            </li>




            {{-- <li class="nav-item">
                <a class="nav-link  {{ is_current_route('tables') ? 'active' : '' }}" href="{{ route('tables') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>table</title>
                            <g id="table" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="view-grid" transform="translate(12.000000, 12.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <path class="color-foreground"
                                        d="M3.42857143,0 C1.53502286,0 0,1.53502286 0,3.42857143 L0,6.85714286 C0,8.75069143 1.53502286,10.2857143 3.42857143,10.2857143 L6.85714286,10.2857143 C8.75069143,10.2857143 10.2857143,8.75069143 10.2857143,6.85714286 L10.2857143,3.42857143 C10.2857143,1.53502286 8.75069143,0 6.85714286,0 L3.42857143,0 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M3.42857143,13.7142857 C1.53502286,13.7142857 0,15.2492571 0,17.1428571 L0,20.5714286 C0,22.4650286 1.53502286,24 3.42857143,24 L6.85714286,24 C8.75069143,24 10.2857143,22.4650286 10.2857143,20.5714286 L10.2857143,17.1428571 C10.2857143,15.2492571 8.75069143,13.7142857 6.85714286,13.7142857 L3.42857143,13.7142857 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M13.7142857,3.42857143 C13.7142857,1.53502286 15.2492571,0 17.1428571,0 L20.5714286,0 C22.4650286,0 24,1.53502286 24,3.42857143 L24,6.85714286 C24,8.75069143 22.4650286,10.2857143 20.5714286,10.2857143 L17.1428571,10.2857143 C15.2492571,10.2857143 13.7142857,8.75069143 13.7142857,6.85714286 L13.7142857,3.42857143 Z"
                                        id="Path"></path>
                                    <path class="color-foreground"
                                        d="M13.7142857,17.1428571 C13.7142857,15.2492571 15.2492571,13.7142857 17.1428571,13.7142857 L20.5714286,13.7142857 C22.4650286,13.7142857 24,15.2492571 24,17.1428571 L24,20.5714286 C24,22.4650286 22.4650286,24 20.5714286,24 L17.1428571,24 C15.2492571,24 13.7142857,22.4650286 13.7142857,20.5714286 L13.7142857,17.1428571 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Tables</span>
                </a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link {{ is_current_route('wallet') ? 'active' : '' }} " href="{{ route('wallet') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>wallet</title>
                            <g id="wallet" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="credit-card" transform="translate(12.000000, 15.000000)" fill="#FFFFFF">
                                    <path class="color-background"
                                        d="M3,0 C1.343145,0 0,1.343145 0,3 L0,4.5 L24,4.5 L24,3 C24,1.343145 22.6569,0 21,0 L3,0 Z"
                                        id="Path" fill-rule="nonzero"></path>
                                    <path class="color-foreground"
                                        d="M24,7.5 L0,7.5 L0,15 C0,16.6569 1.343145,18 3,18 L21,18 C22.6569,18 24,16.6569 24,15 L24,7.5 Z M3,13.5 C3,12.67155 3.67158,12 4.5,12 L6,12 C6.82842,12 7.5,12.67155 7.5,13.5 C7.5,14.32845 6.82842,15 6,15 L4.5,15 C3.67158,15 3,14.32845 3,13.5 Z M10.5,12 C9.67158,12 9,12.67155 9,13.5 C9,14.32845 9.67158,15 10.5,15 L12,15 C12.82845,15 13.5,14.32845 13.5,13.5 C13.5,12.67155 12.82845,12 12,12 L10.5,12 Z"
                                        id="Shape"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Wallet</span>
                </a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link  {{ is_current_route('RTL') ? 'active' : '' }}" href="{{ route('RTL') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>rtl</title>
                            <g id="rtl" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="menu-alt-3" transform="translate(12.000000, 14.000000)" fill="#FFFFFF">
                                    <path class="color-foreground"
                                        d="M0,1.71428571 C0,0.76752 0.76752,0 1.71428571,0 L22.2857143,0 C23.2325143,0 24,0.76752 24,1.71428571 C24,2.66105143 23.2325143,3.42857143 22.2857143,3.42857143 L1.71428571,3.42857143 C0.76752,3.42857143 0,2.66105143 0,1.71428571 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M0,10.2857143 C0,9.33894857 0.76752,8.57142857 1.71428571,8.57142857 L22.2857143,8.57142857 C23.2325143,8.57142857 24,9.33894857 24,10.2857143 C24,11.2325143 23.2325143,12 22.2857143,12 L1.71428571,12 C0.76752,12 0,11.2325143 0,10.2857143 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M10.2857143,18.8571429 C10.2857143,17.9103429 11.0532343,17.1428571 12,17.1428571 L22.2857143,17.1428571 C23.2325143,17.1428571 24,17.9103429 24,18.8571429 C24,19.8039429 23.2325143,20.5714286 22.2857143,20.5714286 L12,20.5714286 C11.0532343,20.5714286 10.2857143,19.8039429 10.2857143,18.8571429 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">RTL</span>
                </a>
            </li> --}}
            {{-- <li class="nav-item mt-2">
                <div class="d-flex align-items-center nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="ms-2"
                        viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-weight-normal text-md ms-2">Laravel Examples</span>
                </div>
            </li> --}}
            {{-- <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link position-relative ms-0 ps-2 py-2 {{ is_current_route('users.profile') ? 'active' : '' }}"
                    href="{{ route('users.profile') }}">
                    <span class="nav-link-text ms-1">User Profile</span>
                </a>
            </li> --}}
            {{-- <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link position-relative ms-0 ps-2 py-2 {{ is_current_route('users-management') ? 'active' : '' }}"
                    href="{{ route('users-management') }}">
                    <span class="nav-link-text ms-1">User Management</span>
                </a>
            </li> --}}
            {{-- <li class="nav-item mt-2">
                <div class="d-flex align-items-center nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="ms-2"
                        viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-weight-normal text-md ms-2">Account Pages</span>
                </div>
            </li> --}}
            {{-- <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link position-relative ms-0 ps-2 py-2 {{ is_current_route('profile') ? 'active' : '' }}"
                    href="{{ route('profile') }}">
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li> --}}
            {{-- <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link position-relative ms-0 ps-2 py-2 {{ is_current_route('signin') ? 'active' : '' }}"
                    href="{{ route('signin') }}">
                    <span class="nav-link-text ms-1">Sign In</span>
                </a>
            </li> --}}
            {{-- <li class="nav-item border-start my-0 pt-2">
                <a class="nav-link position-relative ms-0 ps-2 py-2 {{ is_current_route('signup') ? 'active' : '' }}"
                    href="{{ route('signup') }}">
                    <span class="nav-link-text ms-1">Sign Up</span>
                </a>
            </li> --}}
        </ul>
    </div>
    {{-- <div class="sidenav-footer mx-4 ">
        <a class="btn bg-gradient-primary inline-block px-5 py-3 mx-auto text-xs align-middle transition-all ease-in border-0 rounded-lg select-none" href="https://www.creative-tim.com/product/corporate-ui-dashboard-pro-laravel" target="_blank">
            UPGRADE TO PRO
        </a>
        <div class="card border-radius-md" id="sidenavCard">
            <div class="card-body  text-start  p-3 w-100">
                <div class="mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="text-primary"
                        viewBox="0 0 24 24" fill="currentColor" id="sidenavCardIcon">
                        <path
                            d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625z" />
                        <path
                            d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
                    </svg>
                </div>
                <div class="docs-info">
                    <h6 class="font-weight-bold up mb-2">Need help?</h6>
                    <p class="text-sm font-weight-normal">Please check our docs.</p>
                    <a href="https://www.creative-tim.com/learning-lab/bootstrap/installation-guide/corporate-ui-dashboard"
                        target="_blank" class="font-weight-bold text-sm mb-0 icon-move-right mt-auto w-100 mb-0">
                        Documentation
                        <i class="fas fa-arrow-right-long text-sm ms-1" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div> --}}
</aside>
