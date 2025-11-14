@extends('layouts.backend')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <!-- Dashboard Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h2 class="text-dark font-weight-bold mb-0">Dashboard</h2>
                        <p class="text-muted">Welcome back, {{ Auth::user()->name }}! Here's what's happening with your furniture store today.</p>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-2">Total Revenue</p>
                                        <h3 class="mb-0 text-dark font-weight-bold">$ 0</h3>
                                        {{-- <small class="text-success"><i class="mdi mdi-arrow-up"></i> 0% from last month</small> --}}
                                    </div>
                                    <div class="icon-md bg-primary text-white rounded-circle px-2 py-1">
                                        <i class="mdi mdi-currency-usd"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-2">Total Orders</p>
                                        <h3 class="mb-0 text-dark font-weight-bold">0</h3>
                                        {{-- <small class="text-success"><i class="mdi mdi-arrow-up"></i> 0% from last month</small> --}}
                                    </div>
                                    <div class="icon-md bg-success text-white rounded-circle px-2 py-1">
                                        <i class="mdi mdi-cart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-2">Total Products</p>
                                        <h3 class="mb-0 text-dark font-weight-bold">{{ number_format($totalProducts ?? 0) }}</h3>
                                        {{-- <small class="{{ ($productChange ?? 0) >= 0 ? 'text-success' : 'text-danger' }}">
                                            <i class="mdi mdi-arrow-{{ ($productChange ?? 0) >= 0 ? 'up' : 'down' }}"></i> 
                                            {{ abs($productChange ?? 0) }}% from last month
                                        </small> --}}
                                        <div class="mt-1">
                                            <small class="text-muted">{{ $activeProducts ?? 0 }} active</small>
                                        </div>
                                    </div>
                                    <div class="icon-md bg-info text-white rounded-circle px-2 py-1">
                                        <i class="mdi mdi-package-variant"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-2">Total Categories</p>
                                        <h3 class="mb-0 text-dark font-weight-bold">{{ number_format($totalCategories ?? 0) }}</h3>
                                        {{-- <small class="{{ ($categoryChange ?? 0) >= 0 ? 'text-success' : 'text-danger' }}">
                                            <i class="mdi mdi-arrow-{{ ($categoryChange ?? 0) >= 0 ? 'up' : 'down' }}"></i> 
                                            {{ abs($categoryChange ?? 0) }}% from last month
                                        </small> --}}
                                        <div class="mt-1">
                                            <small class="text-muted">{{ $activeCategories ?? 0 }} active</small>
                                        </div>
                                    </div>
                                    <div class="icon-md bg-warning text-white rounded-circle px-2 py-1">
                                        <i class="mdi mdi-folder-multiple"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sales Chart and Recent Orders -->
                <div class="row">
                    <div class="col-lg-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title mb-0">Sales Overview</h4>
                                    <div class="dropdown">
                                        <button class="btn p-0 text-dark dropdown-toggle" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuIconButton1">
                                            <a class="dropdown-item" href="#">Last 7 days</a>
                                            <a class="dropdown-item" href="#">Last 30 days</a>
                                            <a class="dropdown-item" href="#">Last 3 months</a>
                                        </div>
                                    </div>
                                </div>
                                <canvas id="sales-chart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Order Status</h4>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Pending</span>
                                        <span class="text-dark font-weight-bold">0</span>
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 0%"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Processing</span>
                                        <span class="text-dark font-weight-bold">0</span>
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 0%"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Shipped</span>
                                        <span class="text-dark font-weight-bold">0</span>
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Delivered</span>
                                        <span class="text-dark font-weight-bold">0</span>
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders and Top Products -->
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title mb-0">Recent Orders</h4>
                                    <a href="#" class="text-primary">View All</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Customer</th>
                                                <th>Product</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">
                                                    <i class="mdi mdi-information-outline"></i> No orders yet
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sales Chart (Chart.js v2.9.3 compatible)
        if (document.getElementById('sales-chart')) {
            var ctx = document.getElementById('sales-chart').getContext('2d');
            var salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Sales',
                        data: [0, 0, 0, 0, 0, 0, 0],
                        borderColor: '#4c84ff',
                        backgroundColor: 'rgba(76, 132, 255, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        lineTension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: {
                        display: false
                    }
                }
            });
        }
    </script>
@endsection
