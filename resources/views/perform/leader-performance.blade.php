<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-2 mb-5">
                        <div class="full-background"
                        style="background: linear-gradient(to right, #112133, #21416d);"></div>
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">Penilaian Bulanan Leader IKR 🔥</h3>
                            <p class="mb-4 font-weight-semibold">
                                PT. Mitra Sinergi Telematika.
                            </p>
                            
                            <img src="../assets/img/3d-cube.png" alt="3d-cube"
                                class="position-absolute top-0 end-1 w-25 max-width-200 mt-n6 d-sm-block d-none" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-frame mb-3">

                <div class="card-header border pb-0">
                    <div class="d-sm-flex align-items-center">
                        <div>
                            {{-- <h6 class="font-weight-semibold text-lg mb-0">Absence Attendance</h6> --}}
                            <p class="text-sm">Penilaian Leader IKR</p>
                        </div>
                        
                    </div>
                </div>

                <div class="card-body shadow-sm border border-radius-sm">

                    {{-- <form> --}}
                    <div class="row">

                        <div class="col-md-12">
                           
                                <div class="row">
                                    
                                    <div class="col form-group">
                                        <label>Pilih Bulan</label>
                                        <select class="form-control form-control-sm" id="bulanReport"
                                            name="bulanReport" required>
                                            {{-- <option value="All">All</option> --}}
                                            @if (isset($bulanTahun))
                                                @foreach ($bulanTahun as $bulan )
                                                    <option value="{{ $bulan->bulan}}">{{ $bulan->bulan}}</option>
                                                @endforeach
                                                
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col form-group">
                                        <label>Pilih Area</label>
                                        <select class="form-control form-control-sm" id="area"
                                            name="area" required>
                                            <option value="-">-</option>
                                            @if (isset($areaList))
                                                @foreach ($areaList as $area )
                                                    <option value="{{ $area->nama_branch }}">{{ $area->nama_branch }}</option>
                                                @endforeach                                                
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col form-group">
                                        <label>Pilih Nama IKR Leader</label>
                                        <select class="form-control form-control-sm" id="namaKaryawan"
                                            name="namaKaryawan" required>
                                            <option value="All">All</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                
                        </div>

                        
                    </div>
                    <hr>
                    <div class="col text-center">
                        <button id="showPerform" name="showPerform" type="button" class="btn btn-sm btn-dark align-items-center" >
                            
                            Tampilkan Laporan
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spin" style="display:none"></span>
                        </button>
                        
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Rekap Absensi Leader Perbulan - <span id="titleMonthly"></span></h6>
                                    <p class="text-sm" id="absensiNameMonthly">Employee Name</p>
                                </div>
                                
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0">
                                    <thead class="bg-gray-600">
                                        <tr id="headAbsenMonthly">
                                            <th class="text-secondary text-xs text-white font-weight-semibold opacity-7">Status Absensi 
                                            </th>
 
                                        </tr>
                                    </thead>
                                    <tbody id="bodyAbsenMonthly">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
                                
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
                                    <h6 class="font-weight-semibold text-lg mb-0">Absensi Leader - <span id="title"></span></h6>
                                    <p class="text-sm" id="absensiName">Employee Name</p>
                                </div>
                                
                            </div>
                        </div>                        

                        <div class="card-body px-2 py-2">

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0">
                                    <thead class="bg-gray-600">
                                        <tr id="headAbsen">
                                            <th class="text-secondary text-xs text-white font-weight-semibold opacity-7">Status Absensi 
                                            </th>
 
                                        </tr>
                                    </thead>
                                    <tbody id="bodyAbsen">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
                                
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
                                    <h6 class="font-weight-semibold text-lg mb-0">Absensi Tim - <span id="titleTim"></span></h6>
                                    <p class="text-sm" id="absensiNameTim">Employee Name</p>
                                </div>
                                
                            </div>
                        </div>

                        <div class="card-body px-2 py-2">

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0">
                                    <thead class="bg-gray-600">
                                        <tr id="headAbsenTim">
                                            <th class="text-white text-xs font-weight-semibold">Status Absensi 
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyAbsenTim">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
                                
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
                                    <h6 class="font-weight-semibold text-lg mb-0">Total WO  - <span id="totalWO"></span></h6>
                                    <p class="text-sm" id="totalWoTim">Employee Name</p>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="card-body px-2 py-2">                            

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0">
                                    <thead class="bg-gray-600">
                                        <tr id="headTotalWo">
                                            <th class="text-white text-xs font-weight-semibold">Tipe WO 
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyTotalWo">
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
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
                                    <h6 class="font-weight-semibold text-lg mb-0">Progres WO Tim - <span id="progresWO"></span></h6>
                                    <p class="text-sm" id="progresWoTim">Employee Name</p>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="card-body px-2 py-2">                            

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0">
                                    <thead class="bg-gray-600">
                                        <tr id="headProgresWo">
                                            <th class="text-white text-xs font-weight-semibold">Tipe WO 
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyProgresWo">
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
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
                                    <h6 class="font-weight-semibold text-lg mb-0">Tipe WO Ganti Precon (Remark WO)   - <span id="remarkWO"></span></h6>
                                    <p class="text-sm" id="remarkWoTim">Employee Name</p>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="card-body px-2 py-2">                            

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0">
                                    <thead class="bg-gray-600">
                                        <tr id="headRemarkWo">
                                            <th class="text-white text-xs font-weight-semibold">Jenis WO Perbaikan 
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyRemarkWo">
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
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
                                    <h6 class="font-weight-semibold text-lg mb-0">Progres Replace Precon - <span id="rPreconWO"></span></h6>
                                    <p class="text-sm" id="rPreconWOTim">Employee Name</p>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="card-body px-2 py-2">                            

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0">
                                    <thead class="bg-gray-600">
                                        <tr id="headPreconWo">
                                            <th class="text-white text-xs font-weight-semibold">Jenis WO Perbaikan 
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyPreconWo">
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
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
                                    <h6 class="font-weight-semibold text-lg mb-0">Alasan Tidak Replace Precon - <span id="StatusPreconWO"></span></h6>
                                    <p class="text-sm" id="StatusPreconWOTim">Employee Name</p>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="card-body px-2 py-2">                            

                            <div class="table-responsive p-0">
                                <table class="table table-striped table-bordered align-items-center mb-0">
                                    <thead class="bg-gray-600">
                                        <tr id="headStatusPreconWo">
                                            <th class="text-white text-xs font-weight-semibold">Jenis WO Perbaikan 
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyStatusPreconWo">
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
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
                                    <h6 class="font-weight-semibold text-lg mb-0">Status Jadwal Kunjungan WO Jam 09:00 - <span id="checkin09"></span></h6>
                                    <p class="text-sm" id="checkin09Tim">Employee Name</p>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="card-body px-2 py-2">                            

                            <div class="table-responsive p-0">
                                <table class="table table-bordered align-items-center mb-0">
                                    <thead class="bg-gray-600">
                                        <tr id="headCheckin09">
                                            <th class="text-white text-xs font-weight-semibold">Status Checkin 
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyCheckin09">
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
                                
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
                                    <h6 class="font-weight-semibold text-lg mb-0">Status Jadwal Kunjungan WO - <span id="checkinAll"></span></h6>
                                    <p class="text-sm" id="checkinAllTim">Employee Name</p>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="card-body px-2 py-2">                            

                            <div class="table-responsive p-0">
                                <table class="table table-bordered align-items-center mb-0">
                                    <thead class="bg-gray-600">
                                        <tr id="headCheckinAll">
                                            <th class="text-white text-xs font-weight-semibold">Status Checkin 
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyCheckinAll">
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <x-app.footer />
        </div>
    </main>

</x-app-layout>

<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous">
</script>

<script>

    $(document).on('change', '#area', function(){
        let filArea = $('#area').val()

        $.ajax({
            url: "{{ route('getNamaLeader') }}",
            type: "GET",
            data: {
                area: filArea 
            },
            success: function(resData) {
                $('#namaKaryawan').find('option').remove();
                $('#namaKaryawan').append(
                    `<option value="All">All</option>`);

                $.each(resData, function(key, nama) {
                    $('#namaKaryawan').append(
                        `<option value="${nama.nama_karyawan}">${nama.nama_karyawan}</option>`
                    )
                })
            }
        })
    });

</script>

<script>

    $(document).on('click', '#showPerform', function(e){
        e.preventDefault()

        let filBulanTahun = $('#bulanReport').val()
        let filArea = $('#area').val()
        let filNama = $('#namaKaryawan').val() 
        let day;

        let bln = new Date(filBulanTahun);
        let firstDay = new Date(bln.getFullYear(), bln.getMonth(),1);
        let lastDay = new Date(bln.getFullYear(), bln.getMonth() +1 ,0);

        $.ajax({
            url: "{{ route('getAbsensiMonthly') }}",
            type: "GET",
            data: {
                bulanTahun: filBulanTahun,
                area: filArea,
                nama: filNama
            },
            // beforeSend: () => {
            //     $("#spin").show();
            // },
            // complete: () => {
            //     $("#smWOTrend").hide();
            // },
            success: function(dbMonthly){

                
                let stotal
                let total = [];
                let totMon = [];

                document.getElementById('title').innerText = filBulanTahun
                document.getElementById('absensiNameMonthly').innerText = filNama

                $('#headAbsenMonthly').find("th").remove();
                $('#headAbsenMonthly').append(`
                    <th class="text-white text-xs font-weight-semibold">Status Masuk-Pulang</th>
                `)

                $('#bodyAbsenMonthly').find("td").remove();
                $('#bodyAbsenMonthly').find("th").remove();
                $('#bodyAbsenMonthly').find("tr").remove();

                
                for(x=0; x<dbMonthly.monthly.length; x++){

                    // bln = new Date(dbMonthly.monthly[x].bulan).getDate().toString().padStart(2, "0");
                    $('#headAbsenMonthly').append(`
                                <th class="text-center text-white text-sm px-1">${dbMonthly.monthly[x].bulan}</th>  
                                <th class="text-center text-white text-sm px-1">%</th>                              
                    `);

                    total.push(0);
                    totMon.push(0);
                    
                    
                }

                $('#headAbsenMonthly').append(`<th class="text-center text-white text-sm px-1">Subtotal</th>`);

                $.each(dbMonthly.absensi, function(k, t) {

                    for(bl=0; bl<t.bulanan.length; bl++) {
                        totMon[bl] = totMon[bl] + t.bulanan[bl];
                    }
                })


                $.each(dbMonthly.absensi, function(key, status) {
                    bAbsen = `
                        <tr><th class="text-secondary text-sm font-weight-semibold">${status.status_absen}</th>
                        `;

                    stotal = 0;
                    
                    for(d=0; d<status.bulanan.length; d++) {
                    
                        stotal=stotal + status.bulanan[d];
                        total[d] = total[d] + status.bulanan[d];

                        persen = parseFloat((status.bulanan[d] * 100) / Number(totMon[d])).toFixed(1).replace(/\.0$/, '') 
                        if(persen == 0){
                            monPersen = "-";
                        }else{
                            monPersen = persen + "%";
                        }

                        if(status.bulanan[d] == 0){
                            stday = "-";
                        }else{
                            stday = status.bulanan[d];
                        }

                        bAbsen = bAbsen + `
                                <th class="text-center text-sm">${stday}</th>
                                <th class="text-center text-sm">${monPersen}</th>`;
                    }

                    bAbsen = bAbsen + `<th class="text-center text-sm">${stotal.toLocaleString()}</th>`;

                    $('#bodyAbsenMonthly').append(bAbsen + `</tr>`);
                })

                bdayTotal = `<tr><th class="bg-gray-600 text-white text-sm font-weight-semibold">Total</th>`;

                gtotal = 0;
                for(t=0; t < total.length; t++){
                    bdayTotal = bdayTotal + `
                        <th class="bg-gray-600 text-center text-white text-sm px-1">${total[t]}</th>
                        <th class="bg-gray-600 text-center text-white text-sm px-1"></th>
                    `;

                    gtotal = gtotal + total[t];
                }

                $('#bodyAbsenMonthly').append(bdayTotal + 
                        `<th class="bg-gray-600 text-center text-white text-sm px-1">${gtotal.toLocaleString()}</th></tr>`);

            }
        })

        $.ajax({
            url: "{{ route('getAbsensi') }}",
            type: "GET",
            data: {
                bulanTahun: filBulanTahun,
                area: filArea,
                nama: filNama
            },
            // beforeSend: () => {
            //     $("#spin").show();
            // },
            // complete: () => {
            //     $("#smWOTrend").hide();
            // },
            success: function(db){

                let stotal
                let total = [];

                document.getElementById('absensiName').innerText = filNama
                document.getElementById('title').innerText = filBulanTahun

                $('#headAbsen').find("th").remove();
                $('#headAbsen').append(`
                    <th class="text-white text-xs font-weight-semibold">Status Masuk-Pulang</th>
                `)

                $('#bodyAbsen').find("td").remove();
                $('#bodyAbsen').find("th").remove();
                $('#bodyAbsen').find("tr").remove();

                for(x=0; x<db.tgl.length; x++){

                    day = new Date(db.tgl[x].tanggal).getDate().toString().padStart(2, "0");
                    $('#headAbsen').append(`
                                <th class="text-center text-white text-sm px-1">${day}</th>
                    `);

                    total.push(0);
                }

                $('#headAbsen').append(`<th class="text-center text-white text-sm px-1">Subtotal</th>`);

                $.each(db.absensi, function(key, status) {
                    bAbsen = `
                        <tr><th class="text-secondary text-sm font-weight-semibold">${status.status_absen}</th>
                        `;

                    stotal = 0;
                    for(d=0; d<status.day.length; d++) {
                        
                        stotal=stotal + status.day[d];
                        total[d] = total[d] + status.day[d];
                        if(status.day[d] == 0){
                            stday = "-";
                        }else{
                            stday = status.day[d];
                        }

                        bAbsen = bAbsen + `
                                <th class="text-center text-sm">${stday}</th>`;
                    }

                    bAbsen = bAbsen + `<th class="text-center text-sm">${stotal.toLocaleString()}</th>`;

                    $('#bodyAbsen').append(bAbsen + `</tr>`);
                })

                bdayTotal = `<tr><th class="bg-gray-600 text-white text-sm font-weight-semibold">Total</th>`;

                gtotal = 0;
                for(t=0; t < total.length; t++){
                    bdayTotal = bdayTotal + `
                        <th class="bg-gray-600 text-center text-white text-sm px-1">${total[t]}</th>
                    `;

                    gtotal = gtotal + total[t];
                }

                $('#bodyAbsen').append(bdayTotal + 
                        `<th class="bg-gray-600 text-center text-white text-sm px-1">${gtotal.toLocaleString()}</th></tr>`);

            }
        })


        $.ajax({
            url: "{{ route('getAbsensiTim') }}",
            type: "GET",
            data: {
                bulanTahun: filBulanTahun,
                area: filArea,
                nama: filNama
            },
            success: function(db){

                let stotal
                let total = [];

                document.getElementById('absensiNameTim').innerText = filNama
                document.getElementById('titleTim').innerText = filBulanTahun
                $('#headAbsenTim').find("th").remove();
                $('#headAbsenTim').append(`
                    <th class="text-white text-xs font-weight-semibold">Status Masuk-Pulang</th>
                `)

                $('#bodyAbsenTim').find("td").remove();
                $('#bodyAbsenTim').find("th").remove();
                $('#bodyAbsenTim').find("tr").remove();

                for(x=0; x<db.tgl.length; x++){

                    day = new Date(db.tgl[x].tanggal).getDate().toString().padStart(2, "0");
                    $('#headAbsenTim').append(`
                                <th class="text-center text-white text-sm px-1">${day}</th>
                    `);

                    total.push(0);
                }

                $('#headAbsenTim').append(`<th class="text-center text-white text-sm px-1">Subtotal</th>`);

                $.each(db.absensi, function(key, status) {
                    bAbsen = `
                        <tr><th class="text-secondary text-sm font-weight-semibold">${status.status_absen}</th>
                        `;

                    stotal = 0;
                    for(d=0; d<status.day.length; d++) {
                        
                        stotal=stotal + status.day[d];
                        total[d] = total[d] + status.day[d];
                        if(status.day[d] == 0){
                            stday = "-";
                        }else{
                            stday = status.day[d];
                        }

                        bAbsen = bAbsen + `
                                <th class="text-center text-sm">${stday}</th>`;
                    }

                    bAbsen = bAbsen + `<th class="text-center text-sm">${stotal.toLocaleString()}</th>`;

                    $('#bodyAbsenTim').append(bAbsen + `</tr>`);
                })

                bdayTotal = `<tr><th class="bg-gray-600 text-white text-sm font-weight-semibold">Total</th>`;

                gtotal = 0;
                for(t=0; t < total.length; t++){
                    bdayTotal = bdayTotal + `
                        <th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${total[t]}</th>
                    `;

                    gtotal = gtotal + total[t];
                }

                $('#bodyAbsenTim').append(bdayTotal + 
                        `<th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${gtotal.toLocaleString()}</th></tr>`);

            }
        })

        $.ajax({
            url: "{{ route('getTotalWO') }}",
            type: "GET",
            data: {
                bulanTahun: filBulanTahun,
                area: filArea,
                nama: filNama
            },
            success: function(pWO){
                
                let stotal
                let totalType
                let total = [];

                document.getElementById('totalWO').innerText = filBulanTahun
                document.getElementById('totalWoTim').innerText = filNama
                
                $('#headTotalWo').find("th").remove();
                $('#headTotalWo').append(`
                    <th class="text-white text-xs font-weight-semibold">Tipe WO</th>
                `)

                $('#bodyTotalWo').find("td").remove();
                $('#bodyTotalWo').find("th").remove();
                $('#bodyTotalWo').find("tr").remove();

                for(pw=0; pw<pWO.tgl.length; pw++){

                    days = new Date(pWO.tgl[pw].tanggal).getDate().toString().padStart(2, "0");
                    $('#headTotalWo').append(`
                                <th class="text-center text-white text-xs px-1">${days}</th>
                    `);

                    total.push(0);
                }

                $('#headTotalWo').append(`<th class="text-center text-white text-xs px-1">Subtotal</th>`);


                for (tp=0; tp < pWO.dataWO.length; tp++)
                {


                    bType = `
                        <tr id="HeadTypeTot${pWO.dataWO[tp].type.replaceAll(" ","")}" >
                            <th class="text-secondary text-xs font-weight-semibold">${pWO.dataWO[tp].type}</th>
                        </tr>`;

                    $('#bodyTotalWo').append(bType);

                    bstatD ="";
                    
                    stotD = 0;
                    stotType = 0;
                    totalType = "";
                    // total.fill(0);
                    for (st=0; st < pWO.dataWO[tp].harian.length; st++){
                        
                        
                        if(pWO.dataWO[tp].harian[st] == 0){
                            stday = "-";
                        }else{
                            stday = pWO.dataWO[tp].harian[st];
                        }

                        bstatD = bstatD + `
                            <th class="text-center text-xs">${stday}</th>`;

                        stotD= stotD + pWO.dataWO[tp].harian[st]
                        total[st] = total[st] + pWO.dataWO[tp].harian[st]
                        stotType = stotType + total[st]
                        totalType = totalType +  `<th class="text-center text-sm">${total[st]}</th>`;

                    }

                    $(`#HeadTypeTot${pWO.dataWO[tp].type.replaceAll(" ","")}`).append(bstatD + `<th class="text-center text-xs">${stotD.toLocaleString()}</th></tr>`);

                    // $(`#HeadType${pWO.dataWO[tp].type.replaceAll(" ","")}`).append(totalType + `<th class="text-center text-xs">${stotType.toLocaleString()}</th>`)

                }

                bdayTotal = `<tr><th class="bg-gray-600 text-white text-sm font-weight-semibold">Total</th>`;

                gtotal = 0;
                for(t=0; t < total.length; t++){
                    bdayTotal = bdayTotal + `
                        <th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${total[t]}</th>
                    `;

                    gtotal = gtotal + total[t];
                }

                $('#bodyTotalWo').append(bdayTotal + 
                        `<th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${gtotal.toLocaleString()}</th></tr>`);

            }
        })

        $.ajax({
            url: "{{ route('getProgresWO') }}",
            type: "GET",
            data: {
                bulanTahun: filBulanTahun,
                area: filArea,
                nama: filNama
            },
            success: function(pWO){
                
                let totType = []
                let subTotType = []
                let totalType
                let total = [];

                document.getElementById('progresWO').innerText = filBulanTahun
                document.getElementById('progresWoTim').innerText = filNama
                
                $('#headProgresWo').find("th").remove();
                $('#headProgresWo').append(`
                    <th class="text-white text-xs font-weight-semibold">Tipe WO</th>
                    <th class="text-white text-xs font-weight-semibold">Status WO</th>
                `)

                $('#bodyProgresWo').find("td").remove();
                $('#bodyProgresWo').find("th").remove();
                $('#bodyProgresWo').find("tr").remove();

                for(pw=0; pw<pWO.tgl.length; pw++){

                    days = new Date(pWO.tgl[pw].tanggal).getDate().toString().padStart(2, "0");
                    $('#headProgresWo').append(`
                                <th class="text-center text-white text-xs px-1">${days}</th>
                    `);

                    total.push(0);
                    totType.push(0);
                }

                $('#headProgresWo').append(`<th class="text-center text-white text-xs px-1">Subtotal</th>`);


                for (tp=0; tp < pWO.dataProgress.length; tp++)
                {


                    bType = `
                        <tr id="HeadType${pWO.dataProgress[tp].type.replaceAll(" ","")}" class="table-info">
                            <th class="text-secondary text-xs font-weight-semibold">${pWO.dataProgress[tp].type}</th>
                            <th class="text-secondary text-xs font-weight-semibold"></th>                             
                        `;

                    $('#bodyProgresWo').append(bType + `</tr>`);

                    bstatD = `
                        <tr><th class="text-secondary text-xs font-weight-semibold"></th>
                            <th class="text-secondary text-xs font-weight-semibold">Done</th>                             
                        `;
                    
                    stotD = 0;
                    stotType = 0;
                    totalType = "";
                    totType.fill(0);
                    for (st=0; st < pWO.dataProgress[tp].status.done.length; st++){
                        
                        
                        if(pWO.dataProgress[tp].status.done[st] == 0){
                            stday = "-";
                        }else{
                            stday = pWO.dataProgress[tp].status.done[st];
                        }

                        bstatD = bstatD + `
                            <th class="text-center text-xs">${stday}</th>`;

                        stotD= stotD + pWO.dataProgress[tp].status.done[st]
                        totType[st] = totType[st] + pWO.dataProgress[tp].status.done[st]
                        total[st] = total[st] + pWO.dataProgress[tp].status.done[st]

                    }

                    $('#bodyProgresWo').append(bstatD + `<th class="text-center text-xs">${stotD.toLocaleString()}</th></tr>`);


                    bstatP = `
                        <tr><th class="text-secondary text-xs font-weight-semibold"></th>
                            <th class="text-secondary text-xs font-weight-semibold">Pending</th>                             
                        `;

                    stotP = 0;
                    for (st=0; st < pWO.dataProgress[tp].status.pending.length; st++){
                        
                        if(pWO.dataProgress[tp].status.pending[st] == 0){
                            stday = "-";
                        }else{
                            stday = pWO.dataProgress[tp].status.pending[st];
                        }

                        bstatP = bstatP + `
                            <th class="text-center text-xs">${stday}</th>`;

                        stotP = stotP + pWO.dataProgress[tp].status.pending[st]
                        totType[st] = totType[st] + pWO.dataProgress[tp].status.pending[st]
                        total[st] = total[st] + pWO.dataProgress[tp].status.pending[st]

                    }

                    $('#bodyProgresWo').append(bstatP + `<th class="text-center text-sm">${stotP.toLocaleString()}</th></tr>`);

                    bstatC = `
                        <tr><th class="text-secondary text-xs font-weight-semibold"></th>
                            <th class="text-secondary text-xs font-weight-semibold">Cancel</th>                             
                        `;
                    
                    stotC = 0;
                    for (st=0; st < pWO.dataProgress[tp].status.cancel.length; st++){
                        
                        if(pWO.dataProgress[tp].status.cancel[st] == 0){
                            stday = "-";
                        }else{
                            stday = pWO.dataProgress[tp].status.cancel[st];
                        }

                        bstatC = bstatC + `
                            <th class="text-center text-xs">${stday}</th>`;

                        stotC = stotC + pWO.dataProgress[tp].status.cancel[st]
                        totType[st] = totType[st] + pWO.dataProgress[tp].status.cancel[st]
                        total[st] = total[st] + pWO.dataProgress[tp].status.cancel[st]
                        stotType = stotType + totType[st]
                        totalType = totalType +  `<th class="text-center text-sm">${totType[st]}</th>`;
                        
                    }

                    $('#bodyProgresWo').append(bstatC + `<th class="text-center text-xs">${stotC.toLocaleString()}</th></tr>`);

                    $(`#HeadType${pWO.dataProgress[tp].type.replaceAll(" ","")}`).append(totalType + `<th class="text-center text-xs">${stotType.toLocaleString()}</th>`)

                }

                bdayTotal = `<tr>
                    <th class="bg-gray-600 text-white text-sm font-weight-semibold">Total</th>
                    <th class="bg-gray-600 text-white text-sm font-weight-semibold"></th>`;

                gtotal = 0;
                for(t=0; t < total.length; t++){
                    bdayTotal = bdayTotal + `
                    <th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${total[t]}</th>
                    
                    `;

                    gtotal = gtotal + total[t];
                }

                $('#bodyProgresWo').append(bdayTotal + 
                        `<th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${gtotal.toLocaleString()}</th></tr>`);
            
            }
        })


        $.ajax({
            url: "{{ route('getRemarkWO') }}",
            type: "GET",
            data: {
                bulanTahun: filBulanTahun,
                area: filArea,
                nama: filNama
            },
            success: function(dRemarkWo){
                
                let stotal
                let totalType
                let total = [];

                document.getElementById('remarkWO').innerText = filBulanTahun
                document.getElementById('remarkWoTim').innerText = filNama
                
                $('#headRemarkWo').find("th").remove();
                $('#headRemarkWo').append(`
                    <th class="text-white text-xs font-weight-semibold">Tipe WO</th>
                `)

                $('#bodyRemarkWo').find("td").remove();
                $('#bodyRemarkWo').find("th").remove();
                $('#bodyRemarkWo').find("tr").remove();

                for(pw=0; pw<dRemarkWo.tgl.length; pw++){

                    days = new Date(dRemarkWo.tgl[pw].tanggal).getDate().toString().padStart(2, "0");
                    $('#headRemarkWo').append(`
                                <th class="text-center text-white text-xs px-1">${days}</th>
                    `);

                    total.push(0);
                }

                $('#headRemarkWo').append(`<th class="text-center text-white text-xs px-1">Subtotal</th>`);


                for (tp=0; tp < dRemarkWo.dataRemarkWO.length; tp++)
                {


                    bType = `
                        <tr id="HeadTypeRemark${dRemarkWo.dataRemarkWO[tp].remark.replaceAll(" ","")}" >
                            <th class="text-secondary text-xs font-weight-semibold">${dRemarkWo.dataRemarkWO[tp].remark}</th>
                        </tr>`;

                    $('#bodyRemarkWo').append(bType);

                    bstatD ="";
                    
                    stotD = 0;
                    stotType = 0;
                    totalType = "";
                    // total.fill(0);
                    for (st=0; st < dRemarkWo.dataRemarkWO[tp].harian.length; st++){
                        
                        
                        if(dRemarkWo.dataRemarkWO[tp].harian[st] == 0){
                            stday = "-";
                        }else{
                            stday = dRemarkWo.dataRemarkWO[tp].harian[st];
                        }

                        bstatD = bstatD + `
                            <th class="text-center text-xs">${stday}</th>`;

                        stotD= stotD + dRemarkWo.dataRemarkWO[tp].harian[st]
                        total[st] = total[st] + dRemarkWo.dataRemarkWO[tp].harian[st]
                        stotType = stotType + total[st]
                        // totalType = totalType +  `<th class="text-center text-sm">${total[st]}</th>`;

                    }

                    $(`#HeadTypeRemark${dRemarkWo.dataRemarkWO[tp].remark.replaceAll(" ","")}`).append(bstatD + `<th class="text-center text-xs">${stotD.toLocaleString()}</th></tr>`);

                    // $(`#HeadType${pWO.dataWO[tp].type.replaceAll(" ","")}`).append(totalType + `<th class="text-center text-xs">${stotType.toLocaleString()}</th>`)

                }

                bdayTotal = `<tr>
                    <th class="bg-gray-600 text-white text-sm font-weight-semibold">Total</th>`;

                gtotal = 0;
                for(t=0; t < total.length; t++){
                    bdayTotal = bdayTotal + `
                    <th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${total[t]}</th>
                    
                    `;

                    gtotal = gtotal + total[t];
                }

                $('#bodyRemarkWo').append(bdayTotal + 
                        `<th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${gtotal.toLocaleString()}</th></tr>`);
            

            }
        })


        $.ajax({
            url: "{{ route('getPreconWO') }}",
            type: "GET",
            data: {
                bulanTahun: filBulanTahun,
                area: filArea,
                nama: filNama
            },
            success: function(dPreconWo){
                
                let stotal
                let totalType
                let total = [];

                document.getElementById('rPreconWO').innerText = filBulanTahun
                document.getElementById('rPreconWOTim').innerText = filNama
                
                $('#headPreconWo').find("th").remove();
                $('#headPreconWo').append(`
                    <th class="text-white text-xs font-weight-semibold">Tipe Progres</th>
                `)

                $('#bodyPreconWo').find("td").remove();
                $('#bodyPreconWo').find("th").remove();
                $('#bodyPreconWo').find("tr").remove();

                for(pw=0; pw<dPreconWo.tgl.length; pw++){

                    days = new Date(dPreconWo.tgl[pw].tanggal).getDate().toString().padStart(2, "0");
                    $('#headPreconWo').append(`
                                <th class="text-center text-white text-xs px-1">${days}</th>
                    `);

                    total.push(0);
                }

                $('#headPreconWo').append(`<th class="text-center text-white text-xs px-1">Subtotal</th>`);


                for (tp=0; tp < dPreconWo.dataPreconWO.length; tp++)
                {


                    bType = `
                        <tr id="HeadTypePrecon${dPreconWo.dataPreconWO[tp].penagihan.replaceAll(" ","")}" >
                            <th class="text-secondary text-xs font-weight-semibold">${dPreconWo.dataPreconWO[tp].penagihan}</th>
                        </tr>`;

                    $('#bodyPreconWo').append(bType);

                    bstatD ="";
                    
                    stotD = 0;
                    stotType = 0;
                    totalType = "";
                    // total.fill(0);
                    for (st=0; st < dPreconWo.dataPreconWO[tp].harian.length; st++){
                        
                        
                        if(dPreconWo.dataPreconWO[tp].harian[st] == 0){
                            stday = "-";
                        }else{
                            stday = dPreconWo.dataPreconWO[tp].harian[st];
                        }

                        bstatD = bstatD + `
                            <th class="text-center text-xs">${stday}</th>`;

                        stotD= stotD + dPreconWo.dataPreconWO[tp].harian[st]
                        total[st] = total[st] + dPreconWo.dataPreconWO[tp].harian[st]

                    }

                    $(`#HeadTypePrecon${dPreconWo.dataPreconWO[tp].penagihan.replaceAll(" ","")}`).append(bstatD + `<th class="text-center text-xs">${stotD.toLocaleString()}</th></tr>`);

                    // $(`#HeadType${pWO.dataWO[tp].type.replaceAll(" ","")}`).append(totalType + `<th class="text-center text-xs">${stotType.toLocaleString()}</th>`)

                }

                bdayTotal = `<tr>
                    <th class="bg-gray-600 text-white text-sm font-weight-semibold">Total</th>`;

                gtotal = 0;
                for(t=0; t < total.length; t++){
                    bdayTotal = bdayTotal + `
                    <th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${total[t]}</th>
                    
                    `;

                    gtotal = gtotal + total[t];
                }

                $('#bodyPreconWo').append(bdayTotal + 
                        `<th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${gtotal.toLocaleString()}</th></tr>`);
            
            }
        })

        $.ajax({
            url: "{{ route('getStatusPrecon') }}",
            type: "GET",
            data: {
                bulanTahun: filBulanTahun,
                area: filArea,
                nama: filNama
            },
            success: function(dStatusPrecon){
                
                let stotal
                let totalType
                let total = [];

                document.getElementById('StatusPreconWO').innerText = filBulanTahun
                document.getElementById('StatusPreconWOTim').innerText = filNama
                
                $('#headStatusPreconWo').find("th").remove();
                $('#headStatusPreconWo').append(`
                    <th class="text-white text-xs font-weight-semibold">Tipe WO</th>
                `)

                $('#bodyStatusPreconWo').find("td").remove();
                $('#bodyStatusPreconWo').find("th").remove();
                $('#bodyStatusPreconWo').find("tr").remove();

                for(pw=0; pw<dStatusPrecon.tgl.length; pw++){

                    days = new Date(dStatusPrecon.tgl[pw].tanggal).getDate().toString().padStart(2, "0");
                    $('#headStatusPreconWo').append(`
                                <th class="text-center text-white text-xs px-1">${days}</th>
                    `);

                    total.push(0);
                }

                $('#headStatusPreconWo').append(`<th class="text-center text-white text-xs px-1">Subtotal</th>`);


                for (tp=0; tp < dStatusPrecon.dataStatusPrecon.length; tp++)
                {
                    bType = `
                        <tr id="HeadStatusRemark${dStatusPrecon.dataStatusPrecon[tp].remark_status.replaceAll(" ","")}" >
                            <th class="text-secondary text-xs font-weight-semibold">${dStatusPrecon.dataStatusPrecon[tp].remark_status}</th>
                        </tr>`;

                    $('#bodyStatusPreconWo').append(bType);

                    bstatD ="";
                    
                    stotD = 0;
                    stotType = 0;
                    totalType = "";
                    // total.fill(0);
                    for (st=0; st < dStatusPrecon.dataStatusPrecon[tp].harian.length; st++){
                        
                        
                        if(dStatusPrecon.dataStatusPrecon[tp].harian[st] == 0){
                            stday = "-";
                        }else{
                            stday = dStatusPrecon.dataStatusPrecon[tp].harian[st];
                        }

                        bstatD = bstatD + `
                            <th class="text-center text-xs">${stday}</th>`;

                        stotD= stotD + dStatusPrecon.dataStatusPrecon[tp].harian[st]
                        total[st] = total[st] + dStatusPrecon.dataStatusPrecon[tp].harian[st]

                    }

                    $(`#HeadStatusRemark${dStatusPrecon.dataStatusPrecon[tp].remark_status.replaceAll(" ","")}`).append(bstatD + `<th class="text-center text-xs">${stotD.toLocaleString()}</th></tr>`);

                    // $(`#HeadType${pWO.dataWO[tp].type.replaceAll(" ","")}`).append(totalType + `<th class="text-center text-xs">${stotType.toLocaleString()}</th>`)

                }

                bdayTotal = `<tr>
                    <th class="bg-gray-600 text-white text-sm font-weight-semibold">Total</th>`;

                gtotal = 0;
                for(t=0; t < total.length; t++){
                    bdayTotal = bdayTotal + `
                    <th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${total[t]}</th>
                    
                    `;

                    gtotal = gtotal + total[t];
                }

                $('#bodyStatusPreconWo').append(bdayTotal + 
                        `<th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${gtotal.toLocaleString()}</th></tr>`);
            
            }
        })


        

        $.ajax({
            url: "{{ route('getCheckin09') }}",
            type: "GET",
            data: {
                bulanTahun: filBulanTahun,
                area: filArea,
                nama: filNama
            },
            success: function(chk9){
                
                let stotal
                let totStatus = [];
                let total = [];

                document.getElementById('checkin09').innerText = filBulanTahun
                document.getElementById('checkin09Tim').innerText = filNama
                
                //Head Section///////////////////////////////////////////////////////////////////////////////////////////
                $('#headCheckin09').find("th").remove();
                $('#headCheckin09').append(`
                    <th class="text-white text-xs font-weight-semibold">Status Kunjungan</th>
                    <th class="text-white text-xs font-weight-semibold">Tipe WO</th>
                `)

                $('#bodyCheckin09').find("td").remove();
                $('#bodyCheckin09').find("th").remove();
                $('#bodyCheckin09').find("tr").remove();

                for(pw=0; pw<chk9.tgl.length; pw++){

                    days = new Date(chk9.tgl[pw].tanggal).getDate().toString().padStart(2, "0");
                    $('#headCheckin09').append(`
                                <th class="text-center text-white text-xs px-1">${days}</th>
                    `);

                    total.push(0);
                    totStatus.push(0);
                }

                $('#headCheckin09').append(`<th class="text-center text-white text-xs px-1">Subtotal</th>`);
                //End Head Section//////////////////////////////////////////////////////////////////////////////////////


                //Detail Section Status/////////////////////////////////////////////////////////////////////////////////
                $.each(chk9.dataStatus, function(k, v) {
                    
                    tbStatus = `
                        <tr id="headType${v.status.replaceAll(" ","")}" class="table-info">
                            <th class="text-secondary text-xs font-weight-semibold">${v.status}</th>
                            <th class="text-secondary text-xs font-weight-semibold"></th>                             
                        `;

                    $('#bodyCheckin09').append(tbStatus + `</tr>`);
                    
                    totStatus.fill(0);
                    // stotal = 0
                    $.each(chk9.dataCheckin9, function(ky, wo) {

                        if(v.status == wo.status) {

                            stotal = 0
                            tbTipe = `
                                <tr id="bodyType${wo.tipe}" >
                                <td class="text-secondary text-xs font-weight-semibold"></td>
                                <td class="text-secondary text-xs font-weight-semibold">${wo.tipe}</td>                             
                            `;

                            for(h=0; h < wo.harian.length; h++){

                                let day = (wo.harian[h] === 0 ? "-" : wo.harian[h] );
                                tbTipe = tbTipe + `
                                    <td class="text-secondary text-xs text-center font-weight-semibold">${day}</td>`;
                             
                                totStatus[h] = totStatus[h] + wo.harian[h];
                                total[h] = total[h] + wo.harian[h];
                                stotal = stotal + wo.harian[h];
                            }

                            $(`#bodyCheckin09`).append(tbTipe + `
                            <td class="text-secondary text-xs text-center">${stotal.toLocaleString()}</td></tr>`);
                        }
                    })

                    gtotalType = 0
                    for (t=0; t < totStatus.length; t++) {

                        $(`#headType${v.status.replaceAll(" ","")}`).append(`
                            <th class="text-xs text-center">${totStatus[t]}</th>`);

                        gtotalType = gtotalType + totStatus[t];


                    }

                    $(`#headType${v.status.replaceAll(" ","")}`).append(`
                            <th class="text-xs text-center">${gtotalType.toLocaleString()}</th>`);
                })

                //End Detail Section Status/////////////////////////////////////////////////////////////////////////////

                bdayTotal = `<tr>
                    <th class="bg-gray-600 text-white text-sm font-weight-semibold">Total</th>
                    <th class="bg-gray-600 text-white text-sm font-weight-semibold"></th>`;

                gtotal = 0;
                for(t=0; t < total.length; t++){
                    bdayTotal = bdayTotal + `
                    <th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${total[t]}</th>                    
                    `;

                    gtotal = gtotal + total[t];
                }

                $('#bodyCheckin09').append(bdayTotal + 
                        `<th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${gtotal.toLocaleString()}</th></tr>`);

            }
        })

        $.ajax({
            url: "{{ route('getCheckinAll') }}",
            type: "GET",
            data: {
                bulanTahun: filBulanTahun,
                area: filArea,
                nama: filNama
            },
            success: function(chk9){
                
                let stotal
                let totStatus = [];
                let total = [];

                document.getElementById('checkinAll').innerText = filBulanTahun
                document.getElementById('checkinAllTim').innerText = filNama
                
                //Head Section///////////////////////////////////////////////////////////////////////////////////////////
                $('#headCheckinAll').find("th").remove();
                $('#headCheckinAll').append(`
                    <th class="text-white text-xs font-weight-semibold">Status Kunjungan</th>
                    <th class="text-white text-xs font-weight-semibold">Tipe WO</th>
                `)

                $('#bodyCheckinAll').find("td").remove();
                $('#bodyCheckinAll').find("th").remove();
                $('#bodyCheckinAll').find("tr").remove();

                for(pw=0; pw<chk9.tgl.length; pw++){

                    days = new Date(chk9.tgl[pw].tanggal).getDate().toString().padStart(2, "0");
                    $('#headCheckinAll').append(`
                                <th class="text-center text-white text-xs px-1">${days}</th>
                    `);

                    total.push(0);
                    totStatus.push(0);
                }

                $('#headCheckinAll').append(`<th class="text-center text-white text-xs px-1">Subtotal</th>`);
                //End Head Section//////////////////////////////////////////////////////////////////////////////////////


                //Detail Section Status/////////////////////////////////////////////////////////////////////////////////
                $.each(chk9.dataStatus, function(k, v) {
                    
                    tbStatus = `
                        <tr id="headTypeAll${v.status.replaceAll(" ","")}" class="table-info">
                            <th class="text-secondary text-xs font-weight-semibold">${v.status}</th>
                            <th class="text-secondary text-xs font-weight-semibold"></th>                             
                        `;

                    $('#bodyCheckinAll').append(tbStatus + `</tr>`);
                    
                    totStatus.fill(0);
                    
                    $.each(chk9.dataCheckin9, function(ky, wo) {

                        if(v.status == wo.status) {
                            stotal = 0
                            tbTipe = `
                                <tr id="bodyTypeAll${wo.tipe}" >
                                <td class="text-secondary text-xs font-weight-semibold"></td>
                                <td class="text-secondary text-xs font-weight-semibold">${wo.tipe}</td>                             
                            `;

                            for(h=0; h < wo.harian.length; h++){

                                let day = (wo.harian[h] === 0 ? "-" : wo.harian[h] );
                                tbTipe = tbTipe + `
                                    <td class="text-secondary text-xs text-center font-weight-semibold">${day}</td>`;
                             
                                total[h] = total[h] + wo.harian[h];
                                totStatus[h] = totStatus[h] + wo.harian[h];
                                stotal = stotal + wo.harian[h];
                            }

                            $(`#bodyCheckinAll`).append(tbTipe + `
                            <td class="text-secondary text-xs text-center">${stotal.toLocaleString()}</td></tr>`);
                        }
                    })

                    gtotalType = 0
                    for (t=0; t < totStatus.length; t++) {

                        $(`#headTypeAll${v.status.replaceAll(" ","")}`).append(`
                            <th class="text-secondary text-xs text-center">${totStatus[t]}</th>`);

                        gtotalType = gtotalType + totStatus[t];


                    }

                    $(`#headTypeAll${v.status.replaceAll(" ","")}`).append(`
                            <th class="text-secondary text-xs text-center">${gtotalType.toLocaleString()}</th>`);
                })

                //End Detail Section Status/////////////////////////////////////////////////////////////////////////////

                bdayTotal = `<tr>
                    <th class="bg-gray-600 text-white text-sm font-weight-semibold">Total</th>
                    <th class="bg-gray-600 text-white text-sm font-weight-semibold"></th>`;

                gtotal = 0;
                for(t=0; t < total.length; t++){
                    bdayTotal = bdayTotal + `
                        <th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${total[t]}</th>
                        `;

                    gtotal = gtotal + total[t];
                }

                $('#bodyCheckinAll').append(bdayTotal + 
                        `<th class="bg-gray-600 text-center text-white text-sm font-weight-semibold">${gtotal.toLocaleString()}</th></tr>`);

            }

            
        })

        $('#spin').hide();
    })
</script>
