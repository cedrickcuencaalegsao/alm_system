@extends('shared.layout.admin')

@section('title', 'Reports')

@section('page-title', 'Manage Reports')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Reports</li>
@endsection

@section('content')
<div class="container-fluid">
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
                    <button type="button" id="exportReport" class="btn btn-success"><i class="bi bi-download me-1"></i> Export</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Report Dashboard Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$10,000</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">215</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">4.5%</div>
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Average Order Value</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$45.80</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-receipt fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Report -->
    <div class="card mb-4 report-section" id="salesReport">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Sales Report</h5>
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
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ORD-001</td>
                            <td>2023-06-15</td>
                            <td>John Doe</td>
                            <td>Book Title 1</td>
                            <td>2</td>
                            <td>$24.99</td>
                            <td>$49.98</td>
                            <td><span class="badge bg-success">Completed</span></td>
                        </tr>
                        <tr>
                            <td>ORD-002</td>
                            <td>2023-06-15</td>
                            <td>Jane Smith</td>
                            <td>Book Title 2</td>
                            <td>1</td>
                            <td>$19.99</td>
                            <td>$19.99</td>
                            <td><span class="badge bg-success">Completed</span></td>
                        </tr>
                        <tr>
                            <td>ORD-003</td>
                            <td>2023-06-16</td>
                            <td>Robert Johnson</td>
                            <td>Book Title 3</td>
                            <td>3</td>
                            <td>$15.99</td>
                            <td>$47.97</td>
                            <td><span class="badge bg-warning">Processing</span></td>
                        </tr>
                        <tr>
                            <td>ORD-004</td>
                            <td>2023-06-16</td>
                            <td>Emily Davis</td>
                            <td>Book Title 1</td>
                            <td>1</td>
                            <td>$24.99</td>
                            <td>$24.99</td>
                            <td><span class="badge bg-success">Completed</span></td>
                        </tr>
                        <tr>
                            <td>ORD-005</td>
                            <td>2023-06-17</td>
                            <td>Michael Wilson</td>
                            <td>Book Title 4</td>
                            <td>2</td>
                            <td>$29.99</td>
                            <td>$59.98</td>
                            <td><span class="badge bg-info">Shipped</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <span class="text-muted">Showing 5 of 215 entries</span>
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

    <!-- Product Performance -->
    <div class="card mb-4 report-section d-none" id="productReport">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Product Performance</h5>
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
                        <tr>
                            <td>P001</td>
                            <td>Book Title 1</td>
                            <td>Fiction</td>
                            <td>$24.99</td>
                            <td>45</td>
                            <td>$1,124.55</td>
                            <td>23</td>
                            <td><span class="badge bg-success">In Stock</span></td>
                        </tr>
                        <tr>
                            <td>P002</td>
                            <td>Book Title 2</td>
                            <td>Non-Fiction</td>
                            <td>$19.99</td>
                            <td>38</td>
                            <td>$759.62</td>
                            <td>15</td>
                            <td><span class="badge bg-success">In Stock</span></td>
                        </tr>
                        <tr>
                            <td>P003</td>
                            <td>Book Title 3</td>
                            <td>Science</td>
                            <td>$15.99</td>
                            <td>52</td>
                            <td>$831.48</td>
                            <td>8</td>
                            <td><span class="badge bg-warning">Low Stock</span></td>
                        </tr>
                        <tr>
                            <td>P004</td>
                            <td>Book Title 4</td>
                            <td>Fiction</td>
                            <td>$29.99</td>
                            <td>29</td>
                            <td>$869.71</td>
                            <td>0</td>
                            <td><span class="badge bg-danger">Out of Stock</span></td>
                        </tr>
                        <tr>
                            <td>P005</td>
                            <td>Book Title 5</td>
                            <td>Biography</td>
                            <td>$22.99</td>
                            <td>33</td>
                            <td>$758.67</td>
                            <td>12</td>
                            <td><span class="badge bg-success">In Stock</span></td>
                        </tr>
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
                        <tr>
                            <td>C001</td>
                            <td>John Doe</td>
                            <td>john.doe@example.com</td>
                            <td>5</td>
                            <td>$249.95</td>
                            <td>$49.99</td>
                            <td>2023-01-15</td>
                            <td>2023-06-12</td>
                        </tr>
                        <tr>
                            <td>C002</td>
                            <td>Jane Smith</td>
                            <td>jane.smith@example.com</td>
                            <td>3</td>
                            <td>$89.97</td>
                            <td>$29.99</td>
                            <td>2023-02-28</td>
                            <td>2023-05-19</td>
                        </tr>
                        <tr>
                            <td>C003</td>
                            <td>Robert Johnson</td>
                            <td>robert.j@example.com</td>
                            <td>8</td>
                            <td>$399.92</td>
                            <td>$49.99</td>
                            <td>2022-11-05</td>
                            <td>2023-06-16</td>
                        </tr>
                        <tr>
                            <td>C004</td>
                            <td>Emily Davis</td>
                            <td>emily.d@example.com</td>
                            <td>2</td>
                            <td>$49.98</td>
                            <td>$24.99</td>
                            <td>2023-04-22</td>
                            <td>2023-06-02</td>
                        </tr>
                        <tr>
                            <td>C005</td>
                            <td>Michael Wilson</td>
                            <td>michael.w@example.com</td>
                            <td>7</td>
                            <td>$349.93</td>
                            <td>$49.99</td>
                            <td>2022-12-15</td>
                            <td>2023-06-17</td>
                        </tr>
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

            switch(this.value) {
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
            document.getElementById('salesChart'),
            {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Sales Revenue',
                        data: [1500, 1800, 1200, 2500, 2000, 2800],
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
            document.getElementById('salesDistribution'),
            {
                type: 'doughnut',
                data: {
                    labels: ['Fiction', 'Non-Fiction', 'Science', 'Biography', 'Others'],
                    datasets: [{
                        data: [35, 25, 15, 15, 10],
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
            document.getElementById('productPerformanceChart'),
            {
                type: 'bar',
                data: {
                    labels: ['Book 1', 'Book 2', 'Book 3', 'Book 4', 'Book 5'],
                    datasets: [{
                        label: 'Units Sold',
                        data: [45, 38, 52, 29, 33],
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
            document.getElementById('categoryDistribution'),
            {
                type: 'pie',
                data: {
                    labels: ['Fiction', 'Non-Fiction', 'Science', 'Biography', 'Others'],
                    datasets: [{
                        data: [40, 20, 15, 15, 10],
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
            document.getElementById('customerRetentionChart'),
            {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Customer Retention Rate',
                        data: [95, 92, 94, 90, 93, 96],
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
            document.getElementById('customerAcquisition'),
            {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'New Customers',
                        data: [25, 32, 18, 27, 35, 30],
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
