@extends('shared.layout.admin')

@section('title', 'Order Management')

@section('page-title', 'Order Management')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('view.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Order Management</li>
@endsection

@section('content')
    <!-- Order Management Interface -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-primary">Orders Overview</h6>
                    <div>
                        <a href="{{ route('view.manage.reports') }}" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#orderReportModal">
                            <i class="bi bi-graph-up me-1"></i>Report
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Order statistics cards -->
                    <div class="row mb-4">
                        <!-- Pending Orders -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['pending'] }} out
                                                of {{ $data['totalSales'] }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-clock-history fa-2x text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Processing Orders -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Processing</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['processing'] }}
                                                out of {{ $data['totalSales'] }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-gear-fill fa-2x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delivering Orders -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Delivering</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['delivering'] }}
                                                out of {{ $data['totalSales'] }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-truck fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Completed Orders -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Completed</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['completed'] }} out
                                                of {{ $data['totalSales'] }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-check-circle fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search and Filter -->
                    <div class="row mb-4">
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    placeholder="Search orders by ID, customer, or product..." id="orderSearchInput">
                                <button class="btn btn-outline-secondary" type="button" id="orderSearchBtn">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-7 d-flex justify-content-md-end mt-3 mt-md-0 gap-2">
                            <select class="form-select w-auto" id="orderStatusFilter">
                                <option selected value="all">All Statuses</option>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="delivering">Delivering</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            <select class="form-select w-auto" id="dateRangeFilter">
                                <option selected value="all">All Time</option>
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="this_week">This Week</option>
                                <option value="last_week">Last Week</option>
                                <option value="this_month">This Month</option>
                                <option value="last_month">Last Month</option>
                                <option value="custom">Custom Range</option>
                            </select>
                            <select class="form-select w-auto" id="orderSortBy">
                                <option selected value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                                <option value="total_high">Total (High-Low)</option>
                                <option value="total_low">Total (Low-High)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Orders Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="px-4 py-3" style="width: 60px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAllOrders">
                                        </div>
                                    </th>
                                    <th scope="col" class="px-4 py-3">Order ID</th>
                                    <th scope="col" class="px-4 py-3">Customer</th>
                                    <th scope="col" class="px-4 py-3">Items</th>
                                    <th scope="col" class="px-4 py-3">Date</th>
                                    <th scope="col" class="px-4 py-3">Total</th>
                                    <th scope="col" class="px-4 py-3">Status</th>
                                    <th scope="col" class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['sales'] as $sale)
                                    {{-- {{ dd($sales) }} --}}
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="form-check">
                                                <input class="form-check-input order-checkbox" type="checkbox"
                                                    value="order1">
                                            </div>
                                        </td>
                                        <td class="px-4 py-3"><a href="#" class="fw-bold text-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#orderDetailsModal">{{$sale->getSalesID()}}</a></td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-2">
                                                    <div class="avatar-initial bg-primary rounded">JD</div>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">John Doe</div>
                                                    <div class="small text-muted">john.doe@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">3 items</td>
                                        <td class="px-4 py-3">Apr 15, 2023</td>
                                        <td class="px-4 py-3 fw-bold">$129.95</td>
                                        <td class="px-4 py-3">
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                    type="button" data-bs-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu shadow">
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#orderDetailsModal"><i
                                                                class="bi bi-eye me-2"></i>View Details</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#updateStatusModal"><i
                                                                class="bi bi-arrow-repeat me-2"></i>Update Status</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i
                                                                class="bi bi-x-circle me-2"></i>Cancel Order</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <!-- Bulk Actions and Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
                        <div class="bulk-actions mb-3 mb-md-0">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary" id="bulkActionBtn" disabled>
                                    Bulk Actions
                                </button>
                                <button type="button"
                                    class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-truck me-2"></i>Mark as
                                            Processing</a></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-check-circle me-2"></i>Mark as Delivered</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item text-danger" href="#"><i
                                                class="bi bi-x-circle me-2"></i>Cancel Orders</a></li>
                                </ul>
                            </div>
                        </div>
                        <nav aria-label="Orders pagination">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
