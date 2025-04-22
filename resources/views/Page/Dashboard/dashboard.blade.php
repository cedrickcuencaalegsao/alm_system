@extends('shared.layout.admin')

@section('title', 'Bookstore Dashboard')

@section('page-title', 'Bookstore Dashboard')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    {{-- {{ dd($data) }} --}}
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
                            <div class="h3 mb-0 fw-bold">{{ $data['booksInStockCount']['booksInStock'] }}</div>
                            <div class="small
                                @if ($data['booksInStockCount']['percentage'] > 0) text-success
                                @elseif($data['booksInStockCount']['percentage'] < 0)
                                    text-danger
                                @else
                                    text-secondary @endif
                            ">
                                {{ $data['booksInStockCount']['percentage'] }}%
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
                            <div class="h3 mb-0 fw-bold">{{ $data['userActivity']['totalUsers'] }}</div>
                            <div class="small
                                @if ($data['userActivity']['percentage'] > 0) text-success
                                @elseif($data['userActivity']['percentage'] < 0)
                                    text-danger
                                @else
                                    text-secondary @endif
                            ">
                                {{ $data['userActivity']['percentage'] }}%
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
                            {{-- <a href="#"
                                class="btn btn-primary w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="bi bi-plus-circle me-2"></i> Add New Book
                            </a> --}}
                            <button type="button" class="btn btn-primary w-100 d-flex align-items-center justify-content-center py-3" data-bs-toggle="modal" data-bs-target="#addBookModal">
                                <i class="bi bi-plus-circle me-2"></i> Add New Book
                            </button>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('view.manage.user') }}"
                                class="btn btn-success w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="bi bi-people me-2"></i> User Management
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('view.manage.books') }}"
                                class="btn btn-info w-100 d-flex align-items-center justify-content-center py-3 text-white">
                                <i class="bi bi-book me-2"></i> Manage Books
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('view.manage.reports') }}"
                                class="btn btn-warning w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="bi bi-file-earmark-text me-2"></i> Sales Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Book Modal -->
    <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addBookModalLabel">Add New Book</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addBookForm" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="bookname" class="form-label">Book Title</label>
                                <input type="text" class="form-control" id="bookname" name="bookname" required>
                            </div>
                            <div class="col-md-6">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control" id="author" name="author" required>
                            </div>
                            <div class="col-md-6">
                                <label for="bookcategory" class="form-label">Category</label>
                                <select class="form-select" id="bookcategory" name="bookcategory" required>
                                    <option value="" selected disabled>Select category</option>
                                    <option value="Fiction">Fiction</option>
                                    <option value="Non-Fiction">Non-Fiction</option>
                                    <option value="Science">Science</option>
                                    <option value="History">History</option>
                                    <option value="Biography">Biography</option>
                                    <option value="Technology">Technology</option>
                                    <option value="Self-Help">Self-Help</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="datepublish" class="form-label">Publish Date</label>
                                <input type="date" class="form-control" id="datepublish" name="datepublish" required>
                            </div>
                            <div class="col-md-6">
                                <label for="stocks" class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" id="stocks" name="stocks" min="0" required>
                            </div>
                            <div class="col-md-6">
                                <label for="bookprice" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="bookprice" name="bookprice" min="0" step="0.01" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="bookdetails" class="form-label">Description</label>
                                <textarea class="form-control" id="bookdetails" name="bookdetails" rows="3" required></textarea>
                            </div>
                            <div class="col-12">
                                <label for="image" class="form-label">Book Cover Image</label>
                                <input class="form-control" type="file" id="image" name="image" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Book</button>
                    </div>
                </form>
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
                    <a href="{{ route('view.manage.orders') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3">Ref. ID</th>
                                    <th class="px-4 py-3">Customer ID</th>
                                    <th class="px-4 py-3">Items</th>
                                    <th class="px-4 py-3">Total</th>
                                    <th class="px-4 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['latestSales'] as $sale)
                                    <tr>
                                        <td class="px-4 py-3">{{ $sale->getSalesID() }}</td>
                                        <td class="px-4 py-3">{{ $sale->getUserID() }}</td>
                                        <td class="px-4 py-3">{{ $sale->getQuantity() }}</td>
                                        <td class="px-4 py-3">{{ $sale->getTotalSales() }}</td>
                                        <td class="px-4 py-3"><span class="badge
                                            @if($sale->getStatus() == 'pending') bg-warning
                                            @elseif($sale->getStatus() == 'processing') bg-info
                                            @elseif($sale->getStatus() == 'delivering') bg-primary
                                            @elseif($sale->getStatus() == 'delivered') bg-success
                                            @elseif($sale->getStatus() == 'cancelled') bg-danger
                                            @endif">{{ $sale->getStatus() }}</span></td>
                                    </tr>
                                @endforeach
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
                    {{-- <a href="#" class="btn btn-sm btn-primary">View All</a> --}}
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach ($data['topSellingBook'] as $book)
                            <div class="list-group-item list-group-item-action border-0 px-4 py-3">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 fw-bold">{{ $book->getBookName() }}</h6>
                                        <p class="mb-1 text-muted">{{ $book->getAuthor() }}</p>
                                        <div class="small">
                                            <span class="badge bg-light text-dark me-1">{{ $book->getCategory() }}</span>
                                            <span class="badge bg-light text-dark">{{ $book->getDatePublish() }}</span>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-primary rounded-pill">{{ $book->getTotalSold() }}</span>
                                        <div class="small text-muted mt-1">copies sold</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                                @foreach($data['get5lowStockBooks']['get5lowStockBooks'] as $book)
                                <tr class="table-danger">
                                    <td class="px-4 py-3">{{ $book->getBookName() }}</td>
                                    <td class="px-4 py-3">{{ $book->getBookID() }}</td>
                                    <td class="px-4 py-3">{{ $book->getAuthor() }}</td>
                                    <td class="px-4 py-3">{{ $book->getCategory() }}</td>
                                    <td class="px-4 py-3"><span class="badge bg-danger">{{ $book->getStock() }}</span></td>
                                    <td class="px-4 py-3">
                                        <button class="btn btn-sm btn-outline-primary me-1"><i
                                                class="bi bi-plus-circle"></i> Restock</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white py-3 d-flex justify-content-between align-items-center">
                    <div class="small text-muted">Showing 5 of 12 items with low stock</div>
                    <div>
                        <button class="btn btn-sm btn-primary">View All</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('shared.js.script')
@endsection
