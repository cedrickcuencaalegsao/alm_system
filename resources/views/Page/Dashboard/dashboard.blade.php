@extends('shared.layout.admin')

@section('title', 'Bookstore Dashboard')

@section('page-title', 'Bookstore Dashboard')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <!-- Dashboard Overview -->
    <div class="row mb-4">
        <!-- Total Sales Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-primary border-4 shadow h-100">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="small text-primary text-uppercase fw-bold mb-1">
                                Total Sales (Monthly)
                            </div>
                            <div class="h5 mb-0 fw-bold">$ {{ $data['MonthlySales'] }}</div>
                            <div
                                class="small
                                @if ($data['MonthlySalesPercentage']['type'] == 'increase') text-success
                                @elseif($data['MonthlySalesPercentage']['type'] == 'decrease')
                                    text-danger
                                @else
                                    text-secondary @endif
                                mt-2">
                                <i
                                    class="bi
                                @if ($data['MonthlySalesPercentage']['type'] == 'increase') bi-arrow-up
                                @elseif($data['MonthlySalesPercentage']['type'] == 'decrease')
                                    bi-arrow-down
                                @else
                                    bi-dash @endif"></i>
                                {{ $data['MonthlySalesPercentage']['value'] }}%
                                {{ $data['MonthlySalesPercentage']['type'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-currency-dollar fs-1 text-primary opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Orders Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-success border-4 shadow h-100">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="small text-success text-uppercase fw-bold mb-1">
                                Total Orders (Monthly)
                            </div>
                            <div class="h3 mb-0 fw-bold">{{ $data['MonthlyOrders'] }}</div>
                            <div
                                class="small
                                @if ($data['MonthlySalesPercentage']['type'] == 'increase') text-success
                                @elseif($data['MonthlySalesPercentage']['type'] == 'decrease')
                                    text-danger
                                @else
                                    text-secondary @endif
                                mt-2">
                                <i
                                    class="bi
                                @if ($data['MonthlySalesPercentage']['type'] == 'increase') bi-arrow-up
                                @elseif($data['MonthlySalesPercentage']['type'] == 'decrease')
                                    bi-arrow-down
                                @else
                                    bi-dash @endif"></i>
                                {{ $data['MonthlySalesPercentage']['value'] }}%
                                {{ $data['MonthlySalesPercentage']['type'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cart fs-1 text-success opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Books in Stock Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-info border-4 shadow h-100">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="small text-info text-uppercase fw-bold mb-1">
                                Books in Stock
                            </div>
                            <div class="h3 mb-0 fw-bold">1,500</div>
                            <div class="small text-info mt-2">
                                <i class="bi bi-arrow-up"></i> 32 new titles
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-book fs-1 text-info opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Customers Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-warning border-4 shadow h-100">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="small text-warning text-uppercase fw-bold mb-1">
                                Active Customers
                            </div>
                            <div class="h3 mb-0 fw-bold">780</div>
                            <div class="small text-success mt-2">
                                <i class="bi bi-arrow-up"></i> 15 new today
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fs-1 text-warning opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Row -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body py-4">
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-6">
                            <a href="#"
                                class="btn btn-primary w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="bi bi-plus-circle me-2"></i> Add New Book
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('view.manage.user') }}"
                                class="btn btn-success w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="bi bi-people me-2"></i> User Management
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="#"
                                class="btn btn-info w-100 d-flex align-items-center justify-content-center py-3 text-white">
                                <i class="bi bi-box me-2"></i> Manage Inventory
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="#"
                                class="btn btn-warning w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="bi bi-file-earmark-text me-2"></i> Sales Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders and Top Selling Books -->
    <div class="row mb-4">
        <!-- Recent Orders -->
        <div class="col-lg-7">
            <div class="card shadow h-100">
                <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-primary">Recent Orders</h6>
                    <a href="#" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3">Order ID</th>
                                    <th class="px-4 py-3">Customer</th>
                                    <th class="px-4 py-3">Items</th>
                                    <th class="px-4 py-3">Total</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 py-3">#ORD-2023</td>
                                    <td class="px-4 py-3">John Smith</td>
                                    <td class="px-4 py-3">3</td>
                                    <td class="px-4 py-3">$85.99</td>
                                    <td class="px-4 py-3"><span class="badge bg-success">Delivered</span></td>
                                    <td class="px-4 py-3"><a href="#" class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">#ORD-2022</td>
                                    <td class="px-4 py-3">Emily Johnson</td>
                                    <td class="px-4 py-3">1</td>
                                    <td class="px-4 py-3">$24.99</td>
                                    <td class="px-4 py-3"><span class="badge bg-warning text-dark">Processing</span></td>
                                    <td class="px-4 py-3"><a href="#" class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">#ORD-2021</td>
                                    <td class="px-4 py-3">Robert Brown</td>
                                    <td class="px-4 py-3">5</td>
                                    <td class="px-4 py-3">$137.45</td>
                                    <td class="px-4 py-3"><span class="badge bg-primary">Shipped</span></td>
                                    <td class="px-4 py-3"><a href="#" class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">#ORD-2020</td>
                                    <td class="px-4 py-3">Sarah Davis</td>
                                    <td class="px-4 py-3">2</td>
                                    <td class="px-4 py-3">$49.98</td>
                                    <td class="px-4 py-3"><span class="badge bg-danger">Cancelled</span></td>
                                    <td class="px-4 py-3"><a href="#" class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">#ORD-2019</td>
                                    <td class="px-4 py-3">Michael Wilson</td>
                                    <td class="px-4 py-3">4</td>
                                    <td class="px-4 py-3">$112.96</td>
                                    <td class="px-4 py-3"><span class="badge bg-success">Delivered</span></td>
                                    <td class="px-4 py-3"><a href="#" class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-eye"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Selling Books -->
        <div class="col-lg-5">
            <div class="card shadow h-100">
                <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-primary">Top Selling Books</h6>
                    <a href="#" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action border-0 px-4 py-3">
                            <div class="d-flex w-100 justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1 fw-bold">The Great Gatsby</h6>
                                    <p class="mb-1 text-muted">F. Scott Fitzgerald</p>
                                    <div class="small">
                                        <span class="badge bg-light text-dark me-1">Fiction</span>
                                        <span class="badge bg-light text-dark">Classic</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-primary rounded-pill">245</span>
                                    <div class="small text-muted mt-1">copies sold</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0 px-4 py-3">
                            <div class="d-flex w-100 justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1 fw-bold">To Kill a Mockingbird</h6>
                                    <p class="mb-1 text-muted">Harper Lee</p>
                                    <div class="small">
                                        <span class="badge bg-light text-dark me-1">Fiction</span>
                                        <span class="badge bg-light text-dark">Classic</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-primary rounded-pill">198</span>
                                    <div class="small text-muted mt-1">copies sold</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0 px-4 py-3">
                            <div class="d-flex w-100 justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1 fw-bold">1984</h6>
                                    <p class="mb-1 text-muted">George Orwell</p>
                                    <div class="small">
                                        <span class="badge bg-light text-dark me-1">Science Fiction</span>
                                        <span class="badge bg-light text-dark">Dystopian</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-primary rounded-pill">187</span>
                                    <div class="small text-muted mt-1">copies sold</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0 px-4 py-3">
                            <div class="d-flex w-100 justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1 fw-bold">Harry Potter and the Sorcerer's Stone</h6>
                                    <p class="mb-1 text-muted">J.K. Rowling</p>
                                    <div class="small">
                                        <span class="badge bg-light text-dark me-1">Fantasy</span>
                                        <span class="badge bg-light text-dark">Young Adult</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-primary rounded-pill">176</span>
                                    <div class="small text-muted mt-1">copies sold</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0 px-4 py-3">
                            <div class="d-flex w-100 justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1 fw-bold">The Hobbit</h6>
                                    <p class="mb-1 text-muted">J.R.R. Tolkien</p>
                                    <div class="small">
                                        <span class="badge bg-light text-dark me-1">Fantasy</span>
                                        <span class="badge bg-light text-dark">Adventure</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-primary rounded-pill">154</span>
                                    <div class="small text-muted mt-1">copies sold</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Analytics Chart -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-primary">Monthly Sales Analytics</h6>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Last 30 Days
                        </button>
                        <ul class="dropdown-menu shadow dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item active" href="#">Last 30 Days</a></li>
                            <li><a class="dropdown-item" href="#">Last Quarter</a></li>
                            <li><a class="dropdown-item" href="#">Last Year</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Custom Range</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
                <div class="card-footer bg-white py-3">
                    <div class="row text-center">
                        <div class="col-md-3 col-6 border-end">
                            <div class="small text-muted mb-1">Total Revenue</div>
                            <div class="h5 mb-0">$42,389</div>
                        </div>
                        <div class="col-md-3 col-6 border-end">
                            <div class="small text-muted mb-1">Avg. Order Value</div>
                            <div class="h5 mb-0">$86.24</div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="small text-muted mb-1">Conversion Rate</div>
                            <div class="h5 mb-0">3.28%</div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="small text-muted mb-1">Growth Rate</div>
                            <div class="h5 mb-0">+12.5%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Alert -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-primary">Low Stock Alert</h6>
                    <a href="#" class="btn btn-sm btn-primary">Restock All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3">Book Title</th>
                                    <th class="px-4 py-3">ISBN</th>
                                    <th class="px-4 py-3">Author</th>
                                    <th class="px-4 py-3">Category</th>
                                    <th class="px-4 py-3">Current Stock</th>
                                    <th class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-danger">
                                    <td class="px-4 py-3">Pride and Prejudice</td>
                                    <td class="px-4 py-3">978-0141439518</td>
                                    <td class="px-4 py-3">Jane Austen</td>
                                    <td class="px-4 py-3">Classic</td>
                                    <td class="px-4 py-3"><span class="badge bg-danger">Out of Stock</span></td>
                                    <td class="px-4 py-3">
                                        <button class="btn btn-sm btn-outline-primary me-1"><i
                                                class="bi bi-plus-circle"></i> Restock</button>
                                    </td>
                                </tr>
                                <tr class="table-warning">
                                    <td class="px-4 py-3">The Catcher in the Rye</td>
                                    <td class="px-4 py-3">978-0316769488</td>
                                    <td class="px-4 py-3">J.D. Salinger</td>
                                    <td class="px-4 py-3">Fiction</td>
                                    <td class="px-4 py-3"><span class="badge bg-warning text-dark">2 left</span></td>
                                    <td class="px-4 py-3">
                                        <button class="btn btn-sm btn-outline-primary me-1"><i
                                                class="bi bi-plus-circle"></i> Restock</button>
                                    </td>
                                </tr>
                                <tr class="table-warning">
                                    <td class="px-4 py-3">Brave New World</td>
                                    <td class="px-4 py-3">978-0060850524</td>
                                    <td class="px-4 py-3">Aldous Huxley</td>
                                    <td class="px-4 py-3">Science Fiction</td>
                                    <td class="px-4 py-3"><span class="badge bg-warning text-dark">3 left</span></td>
                                    <td class="px-4 py-3">
                                        <button class="btn btn-sm btn-outline-primary me-1"><i
                                                class="bi bi-plus-circle"></i> Restock</button>
                                    </td>
                                </tr>
                                <tr class="table-warning">
                                    <td class="px-4 py-3">The Lord of the Rings</td>
                                    <td class="px-4 py-3">978-0544003415</td>
                                    <td class="px-4 py-3">J.R.R. Tolkien</td>
                                    <td class="px-4 py-3">Fantasy</td>
                                    <td class="px-4 py-3"><span class="badge bg-warning text-dark">5 left</span></td>
                                    <td class="px-4 py-3">
                                        <button class="btn btn-sm btn-outline-primary me-1"><i
                                                class="bi bi-plus-circle"></i> Restock</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">Animal Farm</td>
                                    <td class="px-4 py-3">978-0451526342</td>
                                    <td class="px-4 py-3">George Orwell</td>
                                    <td class="px-4 py-3">Fiction</td>
                                    <td class="px-4 py-3"><span class="badge bg-info">8 left</span></td>
                                    <td class="px-4 py-3">
                                        <button class="btn btn-sm btn-outline-primary me-1"><i
                                                class="bi bi-plus-circle"></i> Restock</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white py-3 d-flex justify-content-between align-items-center">
                    <div class="small text-muted">Showing 5 of 12 items with low stock</div>
                    <div>
                        <button class="btn btn-sm btn-outline-secondary me-2">Export List</button>
                        <button class="btn btn-sm btn-primary">View All</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('shared.js.script')
@endsection
