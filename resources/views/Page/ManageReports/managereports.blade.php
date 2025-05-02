@extends('shared.layout.admin')

@section('title', 'Reports')

@section('page-title', 'Manage Reports')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Reports</li>
@endsection

@section('content')
    <div class="container-fluid">


        <!-- Report Dashboard Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Revenue</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">₱
                                    {{ number_format($cardData['totalRevenue'], 2) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-currency-dollar fs-2 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Orders</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cardData['totalOrders'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-cart-check fs-2 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Conversion Rate</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($cardData['conversionRate'], 2) }}%</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-percent fs-2 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Average Order Value
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">₱
                                    {{ number_format($cardData['avgOrderValue'], 2) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-receipt fs-2 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Filter Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Filter Reports</h5>
            </div>
            <div class="card-body">
                <form id="reportFilterForm" class="row g-3">
                    <div class="col-md-4">
                        <label for="reportType" class="form-label">Report Type</label>
                        <select class="form-select" id="reportType">
                            <option value="sales">Sales Reports</option>
                            <option value="products">Product Performance</option>
                            <option value="customers">Customer Analytics</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="dateRange" class="form-label">Date Range</label>
                        <select class="form-select" id="dateRange">
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="thisWeek">This Week</option>
                            <option value="lastWeek">Last Week</option>
                            <option value="thisMonth" selected>This Month</option>
                            <option value="lastMonth">Last Month</option>
                            <option value="thisYear">This Year</option>
                            <option value="custom">Custom Range</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="exportFormat" class="form-label">Export Format</label>
                        <select class="form-select" id="exportFormat">
                            <option value="pdf">PDF</option>
                            <option value="csv">CSV</option>
                            <option value="excel">Excel</option>
                        </select>
                    </div>
                    <div class="col-md-6 custom-date-range d-none">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="startDate">
                    </div>
                    <div class="col-md-6 custom-date-range d-none">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="endDate">
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" id="generateReport" class="btn btn-primary">Generate Report</button>
                        <button type="button" id="exportReport" class="btn btn-success"><i class="bi bi-download me-1"></i>
                            Export</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sales Report -->
        <div class="card mb-4 report-section" id="salesReport">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Sales Report</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="chart-container" style="position: relative; height:300px;">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="chart-container" style="position: relative; height:300px;">
                            <canvas id="salesDistribution"></canvas>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Sales ID</th>
                                <th>Date</th>
                                <th>Customer ID</th>
                                <th>Product ID</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tableData['sales'] as $sale)
                                <tr>
                                    <td>{{ $sale->getSalesID() }}</td>
                                    <td>{{ $sale->getCreatedAt() }}</td>
                                    <td>{{ $sale->getUserID() }}</td>
                                    <td>{{ $sale->getBookID() }}</td>
                                    <td>{{ $sale->getQuantity() }}</td>
                                    <td>${{ number_format($sale->getBookPrice(), 2) }}</td>
                                    <td>${{ number_format($sale->getTotalSales(), 2) }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $sale->getStatus() == 'delivered'
                                                ? 'success'
                                                : ($sale->getStatus() == 'processing'
                                                    ? 'warning'
                                                    : ($sale->getStatus() == 'delivering'
                                                        ? 'info'
                                                        : ($sale->getStatus() == 'cancelled'
                                                            ? 'danger'
                                                            : 'secondary'))) }}">
                                            {{ $sale->getStatus() }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 me-3">Showing {{ $tableData['sales']->firstItem() ?? 0 }} to
                            {{ $tableData['sales']->lastItem() ?? 0 }} of {{ $tableData['sales']->total() ?? 0 }} entries
                        </p>
                        <div class="d-flex align-items-center">
                            <label for="per_page" class="me-2">Show:</label>
                            <select id="per_page" class="form-select form-select-sm" style="width: 80px;">
                                <option value="5" {{ request()->input('per_page', 5) == 5 ? 'selected' : '' }}>5
                                </option>
                                <option value="10" {{ request()->input('per_page') == 10 ? 'selected' : '' }}>10
                                </option>
                                <option value="25" {{ request()->input('per_page') == 25 ? 'selected' : '' }}>25
                                </option>
                                <option value="50" {{ request()->input('per_page') == 50 ? 'selected' : '' }}>50
                                </option>
                                <option value="100" {{ request()->input('per_page') == 100 ? 'selected' : '' }}>100
                                </option>
                            </select>
                        </div>
                    </div>
                    {{ $tableData['sales']->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

        <!-- Product Performance -->
        <div class="card mb-4 report-section d-none" id="productReport">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Product Performance</h5>
                <div>
                    <button class="btn btn-sm btn-outline-primary refresh-section" data-section="productPerformance">
                        <i class="bi bi-arrow-repeat"></i> Refresh
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-7">
                        <div class="chart-container" style="position: relative; height:300px;">
                            <canvas id="productPerformanceChart"></canvas>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="chart-container" style="position: relative; height:300px;">
                            <canvas id="categoryDistribution"></canvas>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Units Sold</th>
                                <th>Revenue</th>
                                <th>Stock</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tableData['products'] as $product)
                                <tr>
                                    <td>{{ $product['id'] }}</td>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ $product['category'] }}</td>
                                    <td>${{ number_format($product['price'], 2) }}</td>
                                    <td>{{ $product['units_sold'] }}</td>
                                    <td>${{ number_format($product['revenue'], 2) }}</td>
                                    <td>{{ $product['stock'] }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $product['status'] == 'In Stock' ? 'success' : ($product['status'] == 'Low Stock' ? 'warning' : 'danger') }}">
                                            {{ $product['status'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <span class="text-muted">Showing 5 of 42 entries</span>
                    </div>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Customer Analytics -->
        <div class="card mb-4 report-section d-none" id="customerReport">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Customer Analytics</h5>
                <div>
                    <button class="btn btn-sm btn-outline-secondary me-2">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <button class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-arrow-repeat"></i> Refresh
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="chart-container" style="position: relative; height:300px;">
                            <canvas id="customerRetentionChart"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="chart-container" style="position: relative; height:300px;">
                            <canvas id="customerAcquisition"></canvas>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Customer ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Orders</th>
                                <th>Total Spent</th>
                                <th>Avg. Order Value</th>
                                <th>First Purchase</th>
                                <th>Last Purchase</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tableData['customers'] as $customer)
                                <tr>
                                    <td>{{ $customer['id'] }}</td>
                                    <td>{{ $customer['name'] }}</td>
                                    <td>{{ $customer['email'] }}</td>
                                    <td>{{ $customer['orders'] }}</td>
                                    <td>${{ number_format($customer['total_spent'], 2) }}</td>
                                    <td>${{ number_format($customer['avg_order'], 2) }}</td>
                                    <td>{{ $customer['first_purchase'] }}</td>
                                    <td>{{ $customer['last_purchase'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <span class="text-muted">Showing 5 of 125 entries</span>
                    </div>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Handle per-page selector change
        document.getElementById('per_page').addEventListener('change', function() {
            const perPage = this.value;
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('per_page', perPage);
            window.location.href = currentUrl.toString();
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Toggle date range inputs
            document.getElementById('dateRange').addEventListener('change', function() {
                const customDateFields = document.querySelectorAll('.custom-date-range');
                if (this.value === 'custom') {
                    customDateFields.forEach(field => field.classList.remove('d-none'));
                } else {
                    customDateFields.forEach(field => field.classList.add('d-none'));
                }
            });

            // Handle report type selection
            document.getElementById('reportType').addEventListener('change', function() {
                const sections = document.querySelectorAll('.report-section');
                sections.forEach(section => section.classList.add('d-none'));

                switch (this.value) {
                    case 'sales':
                        document.getElementById('salesReport').classList.remove('d-none');
                        break;
                    case 'products':
                        document.getElementById('productReport').classList.remove('d-none');
                        break;
                    case 'customers':
                        document.getElementById('customerReport').classList.remove('d-none');
                        break;
                }
            });

            // Initialize Charts
            // Sales Chart
            const salesChart = new Chart(
                document.getElementById('salesChart'), {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartData['salesChart']['labels']) !!},
                        datasets: [{
                            label: 'Sales Revenue',
                            data: {!! json_encode($chartData['salesChart']['data']) !!},
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                }
            );

            // Sales Distribution Chart
            const salesDistribution = new Chart(
                document.getElementById('salesDistribution'), {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($chartData['salesDistribution']['labels']) !!},
                        datasets: [{
                            data: {!! json_encode($chartData['salesDistribution']['data']) !!},
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(153, 102, 255, 0.7)'
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                }
            );

            // Product Performance Chart
            const productPerformanceChart = new Chart(
                document.getElementById('productPerformanceChart'), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($chartData['productPerformance']['labels']) !!},
                        datasets: [{
                            label: 'Units Sold',
                            data: {!! json_encode($chartData['productPerformance']['unitsSold']) !!},
                            backgroundColor: 'rgba(54, 162, 235, 0.7)'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                }
            );

            // Category Distribution Chart
            const categoryDistribution = new Chart(
                document.getElementById('categoryDistribution'), {
                    type: 'pie',
                    data: {
                        labels: {!! json_encode($chartData['categoryDistribution']['labels']) !!},
                        datasets: [{
                            data: {!! json_encode($chartData['categoryDistribution']['data']) !!},
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(153, 102, 255, 0.7)'
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                }
            );

            // Customer Retention Chart
            const customerRetentionChart = new Chart(
                document.getElementById('customerRetentionChart'), {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartData['customerRetention']['labels']) !!},
                        datasets: [{
                            label: 'Customer Retention Rate',
                            data: {!! json_encode($chartData['customerRetention']['data']) !!},
                            borderColor: 'rgb(255, 99, 132)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                min: 80,
                                max: 100
                            }
                        }
                    }
                }
            );

            // Customer Acquisition Chart
            const customerAcquisition = new Chart(
                document.getElementById('customerAcquisition'), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($chartData['customerAcquisition']['labels']) !!},
                        datasets: [{
                            label: 'New Customers',
                            data: {!! json_encode($chartData['customerAcquisition']['data']) !!},
                            backgroundColor: 'rgba(153, 102, 255, 0.7)'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                }
            );
        });
    </script>
@endsection
