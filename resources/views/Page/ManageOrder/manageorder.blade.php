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
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 fw-bold text-primary">Orders Overview</h5>
                    <div>
                        <a href="{{ route('view.manage.reports') }}" class="btn btn-primary btn-sm rounded-pill">
                            <i class="bi bi-graph-up me-1"></i>Reports
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Order statistics cards -->
                    <div class="row g-3 mb-4">
                        <!-- Pending Orders -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card h-100 border-0 shadow-sm rounded-lg overflow-hidden">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 p-3 rounded-circle me-3 bg-warning bg-opacity-10">
                                            <i class="bi bi-clock-history text-warning fs-3"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-uppercase fw-semibold text-muted small mb-1">Pending Orders</h6>
                                            <h4 class="fw-bold mb-0">{{ $data['pending'] }}
                                                <small class="text-muted fs-6">of {{ $data['totalSales'] }}</small>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-warning bg-opacity-10 py-2 text-center">
                                    <a href="{{ route('view.manage.orders') }}?search=pending"
                                        class="text-warning text-decoration-none small stretched-link">View
                                        Pending</a>
                                </div>
                            </div>
                        </div>

                        <!-- Processing Orders -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card h-100 border-0 shadow-sm rounded-lg overflow-hidden">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 p-3 rounded-circle me-3 bg-info bg-opacity-10">
                                            <i class="bi bi-gear-fill text-info fs-3"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-uppercase fw-semibold text-muted small mb-1">Processing</h6>
                                            <h4 class="fw-bold mb-0">{{ $data['processing'] }}
                                                <small class="text-muted fs-6">of {{ $data['totalSales'] }}</small>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-info bg-opacity-10 py-2 text-center">
                                    <a href="{{ route('view.manage.orders') }}?search=processing"
                                        class="text-info text-decoration-none small stretched-link">View
                                        Processing</a>
                                </div>
                            </div>
                        </div>

                        <!-- Delivering Orders -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card h-100 border-0 shadow-sm rounded-lg overflow-hidden">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 p-3 rounded-circle me-3 bg-primary bg-opacity-10">
                                            <i class="bi bi-truck text-primary fs-3"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-uppercase fw-semibold text-muted small mb-1">Delivering</h6>
                                            <h4 class="fw-bold mb-0">{{ $data['delivering'] ?? 0 }}
                                                <small class="text-muted fs-6">of {{ $data['totalSales'] }}</small>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-primary bg-opacity-10 py-2 text-center">
                                    <a href="{{ route('view.manage.orders') }}?search=delivering"
                                        class="text-primary text-decoration-none small stretched-link">View
                                        Delivering</a>
                                </div>
                            </div>
                        </div>

                        <!-- Completed Orders -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card h-100 border-0 shadow-sm rounded-lg overflow-hidden">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 p-3 rounded-circle me-3 bg-success bg-opacity-10">
                                            <i class="bi bi-check-circle-fill text-success fs-3"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-uppercase fw-semibold text-muted small mb-1">Completed</h6>
                                            <h4 class="fw-bold mb-0">{{ $data['completed'] }}
                                                <small class="text-muted fs-6">of {{ $data['totalSales'] }}</small>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-success bg-opacity-10 py-2 text-center">
                                    <a href="{{ route('view.manage.orders') }}?search=delivered"
                                        class="text-success text-decoration-none small stretched-link">View
                                        Completed</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search and Filter -->
                    <div class="card mb-4 border-0 shadow-sm rounded-lg">
                        <div class="card-body p-3">
                            <div class="row g-3">
                                <div class="col-md-12 mb-3">
                                    <h6 class="fw-semibold text-muted mb-0">Search</h6>
                                </div>

                                <!-- Search Bar (Full Width) -->
                                <div class="col-md-12 mb-3">
                                    <form action="{{ route('view.manage.orders') }}" method="GET" id="searchForm">
                                        @csrf
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="bi bi-search text-muted"></i>
                                            </span>
                                            <input type="text" class="form-control border-start-0"
                                                placeholder="Search by ID, Customer ID, Reference ID, or Status..."
                                                aria-label="Search orders" name="search" value="{{ $search ?? '' }}">
                                            @if ($search)
                                                <a href="{{ route('view.manage.orders') }}"
                                                    class="btn btn-outline-danger border-start-0">
                                                    <i class="bi bi-x-lg"></i>
                                                </a>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-search me-1"></i>Search
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-search me-1"></i>Search
                                                </button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Orders Table -->
        <div class="card border-0 shadow-sm rounded-lg">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary">
                            <tr>
                                <th class="px-4 py-3 fw-semibold border-0">Sales ID</th>
                                <th class="px-4 py-3 fw-semibold border-0">Customer</th>
                                <th class="px-4 py-3 fw-semibold border-0">Ref. ID</th>
                                <th class="px-4 py-3 fw-semibold border-0">Book ID</th>
                                <th class="px-4 py-3 fw-semibold text-center border-0">Quantity</th>
                                <th class="px-4 py-3 fw-semibold border-0" style="min-width: 150px;">Date</th>
                                <th class="px-4 py-3 fw-semibold border-0">Total</th>
                                <th class="px-4 py-3 fw-semibold border-0">Status</th>
                                <th class="px-4 py-3 fw-semibold text-end border-0"style="min-width: 500px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                                <tr class="border-top">
                                    <td class="px-4 py-3 fw-medium text-primary">
                                        {{ $sale->getSalesID() }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <span>{{ $sale->getUserID() }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-muted">{{ $sale->getRefID() }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-muted">{{ $sale->getBookID() }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="badge rounded-pill bg-info bg-opacity-10 text-info px-3 py-2">
                                            {{ $sale->getQuantity() }} items
                                        </span>
                                    </td>
                                    <td class="px-4 py-3" style="min-width: 120px;">
                                        <div class="d-flex flex-column">
                                            <span>
                                                {{ \Carbon\Carbon::parse($sale->getCreatedAt())->format('M d, Y') }}
                                            </span>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($sale->getCreatedAt())->format('h:i A') }}
                                            </small>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 fw-bold text-success">
                                        ${{ number_format($sale->getTotalSales(), 2) }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @php
                                            $status = strtolower($sale->getStatus());
                                            $statusClass = match ($status) {
                                                'pending' => 'warning',
                                                'processing' => 'info',
                                                'delivering' => 'primary',
                                                'completed' => 'success',
                                                'cancelled' => 'danger',
                                                default => 'secondary',
                                            };
                                            $statusIcon = match ($status) {
                                                'pending' => 'clock-history',
                                                'processing' => 'gear',
                                                'delivering' => 'truck',
                                                'completed' => 'check-circle',
                                                'cancelled' => 'x-circle',
                                                default => 'circle',
                                            };
                                        @endphp
                                        <span
                                            class="badge rounded-pill bg-{{ $statusClass }} bg-opacity-10 text-{{ $statusClass }} px-3 py-2">
                                            <i class="bi bi-{{ $statusIcon }} me-1"></i>
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-end">
                                        <div class="d-flex gap-2 justify-content-end">
                                            <!-- Pending Button -->
                                            <form action="{{ route('update.order.status') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="pending">
                                                <input type="hidden" name="saleID" value="{{ $sale->getSalesID() }}">
                                                <button type="submit"
                                                    class="btn btn-sm rounded-pill
                                                    {{ $sale->getStatus() === 'pending' ? 'btn-warning text-white' : 'btn-outline-warning' }}"
                                                    data-bs-toggle="modal" data-bs-target="#updateStatusModal"
                                                    data-status="pending">
                                                    Pending
                                                </button>
                                            </form>

                                            <!-- Processing Button -->
                                            <form action="{{ route('update.order.status') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="processing">
                                                <input type="hidden" name="saleID" value="{{ $sale->getSalesID() }}">
                                                <button type="submit"
                                                    class="btn btn-sm rounded-pill
                                                    {{ $sale->getStatus() === 'processing' ? 'btn-info text-white' : 'btn-outline-info' }}"
                                                    data-bs-toggle="modal" data-bs-target="#updateStatusModal"
                                                    data-status="processing">
                                                    Processing
                                                </button>
                                            </form>

                                            <!-- Delivering Button -->
                                            <form action="{{ route('update.order.status') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="delivering">
                                                <input type="hidden" name="saleID" value="{{ $sale->getSalesID() }}">
                                                <button type="submit"
                                                    class="btn btn-sm rounded-pill
                                                        {{ $sale->getStatus() === 'delivering' ? 'btn-primary text-white' : 'btn-outline-primary' }}"
                                                    data-bs-toggle="modal" data-bs-target="#updateStatusModal"
                                                    data-status="delivering">
                                                    Delivering
                                                </button>
                                            </form>

                                            <!-- Delivered Button -->
                                            <form action="{{ route('update.order.status') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="delivered">
                                                <input type="hidden" name="saleID" value="{{ $sale->getSalesID() }}">
                                                <button type="submit"
                                                    class="btn btn-sm rounded-pill
                                                        {{ $sale->getStatus() === 'delivered' ? 'btn-success text-white' : 'btn-outline-success' }}"
                                                    data-bs-toggle="modal" data-bs-target="#updateStatusModal"
                                                    data-status="delivered">
                                                    Delivered
                                                </button>
                                            </form>

                                            <!-- Cancelled Button -->
                                            <form action="{{ route('update.order.status') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="cancelled">
                                                <input type="hidden" name="saleID" value="{{ $sale->getSalesID() }}">
                                                <button type="submit"
                                                    class="btn btn-sm rounded-pill
                                                        {{ $sale->getStatus() === 'cancelled' ? 'btn-danger text-white' : 'btn-outline-danger' }}"
                                                    data-bs-toggle="modal" data-bs-target="#updateStatusModal"
                                                    data-status="cancelled">
                                                    Cancelled
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Success Modal -->
                @if (session('success'))
                    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
                        aria-hidden="true" data-bs-show="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="successModalLabel">Success!</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle fa-3x text-success me-3"></i>
                                        <p class="mb-0">{{ session('success') }}</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Empty state (will only show when there are no orders) -->
                @if (count($sales) === 0)
                    <form action="{{ route('view.manage.orders') }}" method="GET">
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="fw-bold text-muted">No Orders Found</h5>
                            <p class="text-muted">Try adjusting your search or filter to find what you're
                                looking
                                for.</p>
                            <input type="hidden" name="search" value="">
                            <button class="btn btn-outline-primary rounded-pill">Clear Filters</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>



        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <nav aria-label="Page navigation">
                {{ $sales->appends(['search' => $search ?? ''])->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </div>
@endsection
@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show the success modal if it exists
            const successModal = document.getElementById('successModal');
            if (successModal) {
                const modal = new bootstrap.Modal(successModal);
                modal.show();
            }
        });
    </script>
@endif
