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
                            {{ is_current_route('dataTool') || is_current_route('distribusiTool') || is_current_route('dataKembaliTool') || is_current_route('dataKembaliToolGA') || is_current_route('laporanTool') || is_current_route('disposalTool') ? 'show' : '' }}"
                            aria-labelledby="headingToolsIKR" data-bs-parent="#toolsIKRAccordion">
                            <div class="accordion-body p-0">
                                <!-- Data Tools -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('dataTool') ? 'custom-active' : '' }}"
                                    href="{{ route('dataTool') }}">
                                    <span class="nav-link-text ms-1">Data Tools</span>
                                </a>            
                                <!-- Laporan Kondisi Tools -->
                                <a class="nav-link position-relative ms-3 ps-3 py-2 {{ is_current_route('laporanTool') ? 'custom-active' : '' }}"
                                    href="{{ route('laporanTool') }}">
                                    <span class="nav-link-text ms-1">Laporan Kondisi Tools</span>
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

            
        </ul>
    </div>
    
</aside>
