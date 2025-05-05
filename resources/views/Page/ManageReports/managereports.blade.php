@extends('shared.layout.admin')

@section('title', 'Reports')

@section('page-title', 'Manage Reports')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('view.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Reports</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Hidden input to track active section -->
        <input type="hidden" id="activeSection" value="{{ request()->input('section', 'salesReport') }}">


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
                    <div class="col-md-6">
                        <label for="reportType" class="form-label">Report Type</label>
                        <select class="form-select" id="reportType">
                            <option value="salesReport"
                                {{ request()->input('section') == 'salesReport' || !request()->has('section') ? 'selected' : '' }}>
                                Sales Reports</option>
                            <option value="bookReport" {{ request()->input('section') == 'bookReport' ? 'selected' : '' }}>
                                Book Performance</option>
                            <option value="customerReport"
                                {{ request()->input('section') == 'customerReport' ? 'selected' : '' }}>Customer Analytics
                            </option>
                        </select>
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
                                <th>User ID</th>
                                <th>Book ID</th>
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
                            <label for="sales_per_page" class="me-2">Show:</label>
                            <select id="sales_per_page" class="form-select form-select-sm" style="width: 80px;">
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
                    {{ $tableData['sales']->appends(request()->query())->appends(['section' => 'salesReport'])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

        <!-- Book Performance -->
        <div class="card mb-4 report-section d-none" id="bookReport">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Book Performance</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-7">
                        <div class="chart-container" style="position: relative; height:300px;">
                            <canvas id="bookPerformanceChart"></canvas>
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
                                <th>Book ID</th>
                                <th>Book Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Units Sold</th>
                                <th>Total Sales</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tableData['books'] as $book)
                                <tr>
                                    <td>{{ $book->getBookID() }}</td>
                                    <td>{{ $book->getBookName() }}</td>
                                    <td>{{ $book->getBookCategory() }}</td>
                                    <td>${{ number_format($book->getBookPrice(), 2) }}</td>
                                    <td>{{ $book->getQuantity() }}</td>
                                    <td>${{ number_format($book->getTotalSales(), 2) }}</td>

                                    <td>{{ $book->getCreatedAt() }}</td>
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
                        <p class="mb-0 me-3">Showing {{ $tableData['books']->firstItem() ?? 0 }} to
                            {{ $tableData['books']->lastItem() ?? 0 }} of {{ $tableData['books']->total() ?? 0 }} entries
                        </p>
                        <div class="d-flex align-items-center">
                            <label for="sales_per_page" class="me-2">Show:</label>
                            <select id="sales_per_page" class="form-select form-select-sm" style="width: 80px;">
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
                    {{ $tableData['books']->appends(request()->query())->appends(['section' => 'bookReport'])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

        <!-- Customer Analytics -->
        <div class="card mb-4 report-section d-none" id="customerReport">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Customer Analytics</h5>

            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <h5 class="text-center mb-3">Average Amount Spent Per Customer</h5>
                        <div class="chart-container" style="position: relative; height:400px;">
                            <canvas id="customerPerformanceChart"></canvas>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h5 class="text-center mb-3">New Customer Acquisition</h5>
                        <div class="chart-container" style="position: relative; height:400px;">
                            <canvas id="customerAcquisition"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Handle per-page selector change for all per-page selectors
        document.querySelectorAll('select[id$="per_page"]').forEach(function(selector) {
            selector.addEventListener('change', function() {
                const perPage = this.value;
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('per_page', perPage);
                window.location.href = currentUrl.toString();
            });
        });

        // Handle report type filter change
        document.getElementById('reportType').addEventListener('change', function() {
            const reportType = this.value;
            const currentUrl = new URL(window.location.href);

            // Set the section parameter to the selected report type
            currentUrl.searchParams.set('section', reportType);

            // Store the selected report type in localStorage for persistence
            localStorage.setItem('activeSection', reportType);

            // Navigate to the URL with the updated section parameter
            window.location.href = currentUrl.toString();
        });

        // Initialize active section on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Get the active section from URL parameter or localStorage
            const urlParams = new URLSearchParams(window.location.search);
            const activeSection = urlParams.get('section') || localStorage.getItem('activeSection') ||
                'salesReport';

            console.log('Active section:', activeSection);

            // Show the active section
            showSection(activeSection);

            // Attach event listeners to pagination links with a slight delay to ensure they're loaded
            setTimeout(attachPaginationListeners, 100);

            // Toggle date range inputs
            document.getElementById('dateRange').addEventListener('change', function() {
                const customDateFields = document.querySelectorAll('.custom-date-range');
                if (this.value === 'custom') {
                    customDateFields.forEach(field => field.classList.remove('d-none'));
                } else {
                    customDateFields.forEach(field => field.classList.add('d-none'));
                }
            });
        });

        // Function to attach event listeners to pagination links
        function attachPaginationListeners() {
            // Add click event listeners to all pagination links
            document.querySelectorAll('.pagination .page-link').forEach(link => {
                // Remove any existing listeners to prevent duplicates
                const newLink = link.cloneNode(true);
                link.parentNode.replaceChild(newLink, link);

                newLink.addEventListener('click', function(e) {
                    // Prevent the default action temporarily
                    e.preventDefault();

                    // Get the current active section
                    const currentActiveSection = document.querySelector('.report-section:not(.d-none)')
                        ?.id || 'salesReport';
                    console.log('Current active section:', currentActiveSection);

                    // Store the active section in localStorage
                    localStorage.setItem('activeSection', currentActiveSection);

                    // Modify the URL to include the section parameter
                    let targetUrl = this.href;
                    try {
                        const url = new URL(targetUrl);
                        url.searchParams.set('section', currentActiveSection);
                        targetUrl = url.toString();
                        console.log('Navigating to:', targetUrl);

                        // Navigate to the modified URL
                        window.location.href = targetUrl;
                    } catch (error) {
                        console.error('Error updating pagination URL:', error);
                        // Fallback to original link if there's an error
                        window.location.href = this.href;
                    }
                });
            });

            console.log('Pagination listeners attached to', document.querySelectorAll('.pagination .page-link').length,
                'links');
        }

        // Function to show a specific section
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.report-section').forEach(section => {
                section.classList.add('d-none');
            });

            // Show the selected section
            const targetSection = document.getElementById(sectionId);
            if (targetSection) {
                targetSection.classList.remove('d-none');

                // Update active tab
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('data-target') === sectionId) {
                        link.classList.add('active');
                    }
                });
            }
        }

        // Additional initialization code for charts and other components
        document.addEventListener('DOMContentLoaded', function() {
            // Handle report type selection
            document.getElementById('reportType').addEventListener('change', function() {
                const sections = document.querySelectorAll('.report-section');
                sections.forEach(section => section.classList.add('d-none'));

                switch (this.value) {
                    case 'salesReport':
                        document.getElementById('salesReport').classList.remove('d-none');
                        break;
                    case 'bookReport':
                        document.getElementById('bookReport').classList.remove('d-none');
                        break;
                    case 'customerReport':
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

            // Book Performance Chart
            const bookPerformanceChart = new Chart(
                document.getElementById('bookPerformanceChart'), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($chartData['bookPerformance']['labels']) !!},
                        datasets: [{
                            label: 'Units Sold',
                            data: {!! json_encode($chartData['bookPerformance']['unitsSold']) !!},
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

            // Customer Average Spending Chart
            const customerPerformanceChart = new Chart(
                document.getElementById('customerPerformanceChart'), {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartData['customerPerformance']['labels']) !!},
                        datasets: [{
                            label: 'Avg. Amount Spent Per Customer',
                            data: {!! json_encode($chartData['customerPerformance']['data']) !!},
                            borderColor: 'rgb(255, 99, 132)',
                            tension: 0.1,
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Amount (PHP)'
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return 'PHP ' + context.raw.toFixed(2);
                                    }
                                }
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
