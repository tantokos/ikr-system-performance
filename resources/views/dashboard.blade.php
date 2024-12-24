<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Hello, {{ auth()->user()->name }}</h3>
                        </div>
                        <button type="button"
                            class="btn btn-sm btn-white btn-icon d-flex align-items-center mb-0 ms-md-auto mb-sm-0 mb-2 me-2">
                            <span class="btn-inner--icon">
                                <span class="p-1 bg-success rounded-circle d-flex ms-auto me-2">
                                    <span class="visually-hidden">New</span>
                                </span>
                            </span>
                            <span class="btn-inner--text">Messages</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0">
                            <span class="btn-inner--icon">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-block me-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                            </span>
                            <span class="btn-inner--text">Sync</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-10"></div>
                <div class="col-2">
                    <div class="filter-section">
                        <form method="GET" action="{{ url('/dashboard') }}" class="form-inline">
                            <label for="filter">Filter: </label>
                            <select name="filter" id="filter" class="form-control" onchange="this.form.submit()">
                                <option value="daily" {{ request('filter') == 'daily' ? 'selected' : '' }}>Daily</option>
                                <option value="weekly" {{ request('filter') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                <option value="monthly" {{ request('filter') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                                    <path fill-rule="evenodd"
                                        d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">FTTH New Installation</p>
                                        <h4 class="mb-2 font-weight-bold">{{ $ftth_ib }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M7.5 5.25a3 3 0 013-3h3a3 3 0 013 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0112 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 017.5 5.455V5.25zm7.5 0v.09a49.488 49.488 0 00-6 0v-.09a1.5 1.5 0 011.5-1.5h3a1.5 1.5 0 011.5 1.5zm-3 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M3 18.4v-2.796a4.3 4.3 0 00.713.31A26.226 26.226 0 0012 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 01-6.477-.427C4.047 21.128 3 19.852 3 18.4z" />
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">FTTH Maintenance</p>
                                        <h4 class="mb-2 font-weight-bold">{{ $ftth_mt }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 6a3 3 0 013-3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm4.5 7.5a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0v-2.25a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0v4.5a.75.75 0 001.5 0V12zm2.25-3a.75.75 0 01.75.75v6.75a.75.75 0 01-1.5 0V9.75A.75.75 0 0113.5 9zm3.75-1.5a.75.75 0 00-1.5 0v9a.75.75 0 001.5 0v-9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">FTTH Dismantle</p>
                                        <h4 class="mb-2 font-weight-bold">{{ $ftth_dismantle }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.122-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">FTTX</p>
                                        <h4 class="mb-2 font-weight-bold">0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-xs border">
                        <div class="card-header pb-0">
                            <div class="d-sm-flex align-items-center mb-4">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Grafik FTTH</h6>
                                </div>
                                <div class="ms-auto d-flex">
                                    <button type="button" class="btn btn-sm btn-white mb-0 me-2">
                                        View report
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="card-body p-3 mt-4">
                            <div class="chart mt-n6">
                                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let filter = "daily"; // Default filter

            // Fungsi untuk mengambil data dari API
            async function fetchFtthData() {
                try {
                    const response = await fetch(`{{ route('getFtthData') }}?filter=${filter}`);
                    const data = await response.json();

                    if (data.status) {
                        updateChart(data.results);
                    } else {
                        console.error('Error fetching data:', data.message || 'Unknown error');
                    }
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            }

            // Fungsi untuk memperbarui dataset pada chart
            function updateChart(results) {
                // Gabungkan semua tanggal unik dari semua dataset
                const allDates = [...new Set([
                    ...results.ftth_ib.map(item => item.dateKey),
                    ...results.ftth_mt.map(item => item.dateKey),
                    ...results.ftth_dismantle.map(item => item.dateKey)
                ])].filter(date => date !== null).sort();

                // Fungsi untuk mengambil total data berdasarkan tanggal
                const getDataByDate = (data, dates) => {
                    return dates.map(date => {
                        const record = data.find(item => item.dateKey === date);
                        return record ? record.total : 0;
                    });
                };

                // Update data chart berdasarkan tanggal yang unik
                chart.data.labels = allDates;
                chart.data.datasets[0].data = getDataByDate(results.ftth_ib, allDates);
                chart.data.datasets[1].data = getDataByDate(results.ftth_mt, allDates);
                chart.data.datasets[2].data = getDataByDate(results.ftth_dismantle, allDates);

                chart.update();
            }

            // Fungsi untuk memperbarui filter dan mengambil data baru
            window.updateFilter = function () {
                const filterDropdown = document.getElementById("filter");
                filter = filterDropdown.value; // Perbarui filter
                fetchFtthData(); // Ambil data baru
            };

            var ctx2 = document.getElementById("chart-line").getContext("2d");

            // Membuat chart dengan dataset awal kosong
            var chart = new Chart(ctx2, {
                type: "line",
                data: {
                    labels: [],
                    datasets: [
                        {
                            label: "FTTH New Installation",
                            tension: 0.4,
                            borderWidth: 2,
                            pointRadius: 3,
                            borderColor: "#2ca8ff",
                            backgroundColor: "rgba(45,168,255,0.2)",
                            fill: true,
                            data: [],
                        },
                        {
                            label: "FTTH Maintenance",
                            tension: 0.4,
                            borderWidth: 2,
                            pointRadius: 3,
                            borderColor: "#ffc000",
                            backgroundColor: "rgba(119,77,211,0.4)",
                            fill: true,
                            data: [],
                        },
                        {
                            label: "FTTH Dismantle",
                            tension: 0.4,
                            borderWidth: 2,
                            pointRadius: 3,
                            borderColor: "#eb1414",
                            backgroundColor: "rgba(119,77,211,0.4)",
                            fill: true,
                            data: [],
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: "top",
                            align: 'end',
                            labels: {
                                boxWidth: 6,
                                boxHeight: 6,
                                padding: 20,
                                pointStyle: 'circle',
                                borderRadius: 50,
                                usePointStyle: true,
                                font: {
                                    size: 12,
                                    family: "Noto Sans",
                                },
                            },
                        },
                        tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#1e293b',
                        bodyColor: '#1e293b',
                        borderColor: '#e9ecef',
                        borderWidth: 1,
                        pointRadius: 2,
                        usePointStyle: true,
                        boxWidth: 8,
                    }
                    },
                    interaction: {
                        intersect: false,
                        mode: "index",
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                borderDash: [4, 4],
                            },
                            ticks: {
                                callback: (value) => value.toLocaleString(),
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                            },
                        },
                    },
                },
            });

            // Ambil data API dan perbarui chart saat halaman dimuat
            fetchFtthData();
        });

    </script>

</x-app-layout>
