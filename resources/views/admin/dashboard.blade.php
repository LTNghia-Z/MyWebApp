@extends('admin.layouts')

@section('title', 'Dashboard Chính')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">
        <!-- Thống kê tổng số khách hàng -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <i class="fas fa-users me-1"></i> Khách hàng</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCustomers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thống kê tổng số đơn hàng -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <i class="fas fa-shopping-cart me-1"></i> Đơn hàng</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thống kê tổng doanh thu -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                <i class="fas fa-chart-line me-1"></i> Doanh thu</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ number_format($totalRevenue) }} VNĐ</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-area fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thống kê tổng số món ăn -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                <i class="fas fa-pizza-slice me-1"></i> Món ăn</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalFoods }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hamburger fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ doanh thu -->
    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Tiêu đề biểu đồ -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-bar me-2"></i> Doanh thu theo tháng</h6>
                </div>
                <!-- Thân biểu đồ -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Thêm thư viện Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('revenueChart').getContext('2d');
        var revenueData = <?php echo json_encode($revenueData, JSON_UNESCAPED_UNICODE); ?>;

        
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: revenueData.labels,
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: revenueData.data,
                    borderColor: '#2e59d9', // Màu xanh đậm hơn, hài hòa hơn
                    backgroundColor: 'rgba(54, 85, 189, 0.08)', // Màu nền nhạt hơn, tinh tế hơn
                    borderWidth: 2,
                    pointRadius: 4, // Điểm dữ liệu lớn hơn chút
                    pointBackgroundColor: '#2e59d9', // Màu điểm đồng bộ với đường line
                    pointBorderColor: '#fff',
                    pointHoverRadius: 6, // Hover point lớn hơn
                    pointHoverBackgroundColor: '#2e59d9',
                    pointHoverBorderColor: 'rgba(46, 89, 217, 0.8)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 15,
                        right: 25,
                        top: 20,
                        bottom: 5
                    }
                },
                scales: {
                    x: {
                        time: {
                            unit: 'month'
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 12
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            callback: function(value, index, values) {
                                return number_format(value) + ' VNĐ';
                            }
                        },
                        grid: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2, 2],
                            zeroLineBorderDash: [2, 2]
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                    }
                }
            }
        });
    });


    function number_format(number, decimals, dec_point, thousands_sep) {
        // ... (function number_format giữ nguyên)
         number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>

<style>
    .card {
        border: 0;
        margin-bottom: 1.5rem;
        border-radius: .35rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
    }

    .card-header {
        padding: .75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid #e3e6f0;
    }

    .card-body {
        flex: 1 1 auto;
        padding: 1.25rem;
    }

    .card-title {
        margin-bottom: .75rem;
    }

    .text-gray-800 {
        color: #5a5c69 !important;
    }

    .text-gray-300 {
        color: #dddfeb !important;
    }

    .text-xs {
        font-size: .8rem; /* Slightly increased font size for "text-xs" */
    }

    .font-weight-bold {
        font-weight: 700 !important;
    }

    .mb-1,
    .my-1 {
        margin-bottom: .3rem !important; /* Slightly increased vertical spacing */
    }

    .mb-0,
    .my-0 {
        margin-bottom: 0 !important;
    }

    .mr-2,
    .mx-2 {
        margin-right: .6rem !important; /* Slightly increased horizontal spacing */
    }

    .mr-3,
    .mx-3 {
        margin-right: 1.1rem !important; /* Slightly increased horizontal spacing */
    }

    .text-uppercase {
        text-transform: uppercase !important;
    }

    .border-left-primary {
        border-left: .3rem solid #4e73df !important; /* Slightly thicker border */
    }

    .border-left-success {
        border-left: .3rem solid #1cc88a !important;
    }

    .border-left-info {
        border-left: .3rem solid #36b9cc !important;
    }

    .border-left-warning {
        border-left: .3rem solid #f6c23e !important;
    }

    .shadow {
        box-shadow: 0 0.2rem 2rem 0 rgba(58, 59, 69, 0.18) !important; /* Slightly stronger shadow */
    }

    .h5 {
        font-size: 1.3rem; /* Slightly increased "h5" font size */
    }

    .py-2 {
        padding-top: .6rem !important; /* Slightly reduced vertical padding */
        padding-bottom: .6rem !important;
    }

    .h3 {
        font-size: 2.6rem; /* Slightly increased "h3" font size */
    }
</style>