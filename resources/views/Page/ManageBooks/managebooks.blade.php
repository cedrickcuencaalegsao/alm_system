@extends('shared.layout.admin')

@section('title', 'Manage Books')

@section('page-title', 'Book Management')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('view.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Manage Books</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Action Bar -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body py-3">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6 d-flex gap-2">
                                <a href="{{ route('view.new.book') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-1"></i> Add New Book
                                </a>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                    data-bs-target="#importBooksModal">
                                    <i class="bi bi-file-earmark-arrow-up me-1"></i> Import
                                </button>
                                <button type="button" class="btn btn-outline-secondary" id="exportBooks">
                                    <i class="bi bi-file-earmark-arrow-down me-1"></i> Export
                                </button>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchBooks"
                                        placeholder="Search books by title, author, or ISBN...">
                                    <button class="btn btn-outline-secondary" type="button" id="advancedSearchBtn"
                                        data-bs-toggle="collapse" data-bs-target="#advancedSearch">
                                        <i class="bi bi-sliders"></i>
                                    </button>
                                    <button class="btn btn-primary" type="button" id="searchBtn">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Advanced Search Options (Collapsed by default) -->
                        <div class="collapse mt-3" id="advancedSearch">
                            <div class="card card-body bg-light">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label for="categoryFilter" class="form-label">Category</label>
                                        <select class="form-select" id="categoryFilter">
                                            <option value="">All Categories</option>
                                            <option value="fiction">Fiction</option>
                                            <option value="non-fiction">Non-Fiction</option>
                                            <option value="science">Science</option>
                                            <option value="history">History</option>
                                            <option value="biography">Biography</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="stockFilter" class="form-label">Stock Status</label>
                                        <select class="form-select" id="stockFilter">
                                            <option value="">All</option>
                                            <option value="in-stock">In Stock</option>
                                            <option value="low-stock">Low Stock (< 10)</option>
                                            <option value="out-of-stock">Out of Stock</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="priceMin" class="form-label">Min Price</label>
                                        <input type="number" class="form-control" id="priceMin" placeholder="Min">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="priceMax" class="form-label">Max Price</label>
                                        <input type="number" class="form-control" id="priceMax" placeholder="Max">
                                    </div>
                                    <div class="col-12 text-end">
                                        <button type="button" class="btn btn-secondary" id="resetFilters">Reset
                                            Filters</button>
                                        <button type="button" class="btn btn-primary" id="applyFilters">Apply
                                            Filters</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Books Display Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-primary">Book Inventory</h6>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary active" id="viewGrid">
                                <i class="bi bi-grid"></i>
                            </button>
                            <button type="button" class="btn btn-outline-primary" id="viewList">
                                <i class="bi bi-list-ul"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Grid View (Default) -->
                        <div id="booksGridView">
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                                <!-- Book Card Template - Will be populated dynamically -->
                                @for ($i = 1; $i <= 8; $i++)
                                    <div class="col">
                                        <div class="card h-100 book-card">
                                            <div class="position-relative">
                                                <img src="{{ asset('assets/images/books/book-placeholder.jpg') }}"
                                                    class="card-img-top book-cover" alt="Book Cover">
                                                <div class="position-absolute top-0 end-0 p-2">
                                                    <span class="badge bg-success">In Stock</span>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title text-truncate">Book Title {{ $i }}</h5>
                                                <p class="card-text text-muted mb-1">Author Name</p>
                                                <p class="card-text"><small class="text-muted">Category: Fiction</small>
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="fw-bold text-primary">$19.99</span>
                                                    <span class="text-muted"><i class="bi bi-box-seam me-1"></i> 25</span>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-white border-top-0">
                                                <div class="d-flex justify-content-between">
                                                    <div class="btn-group dropup">
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="#"><i
                                                                        class="bi bi-pencil me-2"></i>Edit</a></li>
                                                            <li><a class="dropdown-item" href="#"><i
                                                                        class="bi bi-box-arrow-in-down me-2"></i>Restock</a>
                                                            </li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li><a class="dropdown-item text-danger" href="#"><i
                                                                        class="bi bi-trash me-2"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal" data-bs-target="#bookDetailsModal">
                                                        <i class="bi bi-eye"></i> View
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <!-- List View (Hidden by default) -->
                        <div id="booksListView" class="d-none">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 60px;">#</th>
                                            <th scope="col">Book Info</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col" style="width: 150px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 1; $i <= 8; $i++)
                                            <tr>
                                                <th scope="row">{{ $i }}</th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('assets/images/books/book-placeholder.jpg') }}"
                                                            class="me-3" alt="Book Cover"
                                                            style="width: 50px; height: 70px; object-fit: cover;">
                                                        <div>
                                                            <h6 class="mb-0">Book Title {{ $i }}</h6>
                                                            <small class="text-muted">Author Name</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Fiction</td>
                                                <td class="fw-bold">$19.99</td>
                                                <td>
                                                    <span class="badge bg-success">25 in stock</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal" data-bs-target="#bookDetailsModal">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-success">
                                                            <i class="bi bi-box-arrow-in-down"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <span class="text-muted">Showing 1-8 of 24 books</span>
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1"
                                            aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
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
    </div>

    <!-- Book Details Modal -->
    <div class="modal fade" id="bookDetailsModal" tabindex="-1" aria-labelledby="bookDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="bookDetailsModalLabel">Book Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('assets/images/books/book-placeholder.jpg') }}"
                                class="img-fluid rounded book-cover-lg mb-3" alt="Book Cover">
                            <div class="d-grid gap-2">
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-box-arrow-in-down me-1"></i> Restock
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4 class="mb-2">Book Title</h4>
                            <p class="text-muted mb-3">by Author Name</p>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-muted me-2">ISBN:</span>
                                        <span>978-3-16-148410-0</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-muted me-2">Category:</span>
                                        <span>Fiction</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-muted me-2">Published:</span>
                                        <span>January 2023</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-muted me-2">Price:</span>
                                        <span class="fw-bold text-primary">$19.99</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-muted me-2">Stock:</span>
                                        <span class="badge bg-success">25 Available</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-muted me-2">Total Sold:</span>
                                        <span>142 copies</span>
                                    </div>
                                </div>
                            </div>

                            <h6 class="fw-bold mb-2">Description</h6>
                            <p class="mb-3">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus
                                hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend
                                nibh porttitor. Ut in nulla enim.
                            </p>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-outline-secondary me-2"
                                    data-bs-dismiss="modal">Close</button>
                                <a href="#" class="btn btn-primary">
                                    <i class="bi bi-pencil me-1"></i> Edit Book
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Books Modal -->
    <div class="modal fade" id="importBooksModal" tabindex="-1" aria-labelledby="importBooksModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="importBooksModalLabel">Import Books</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="importFile" class="form-label">Select CSV or Excel File</label>
                            <input class="form-control" type="file" id="importFile"
                                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            <div class="form-text">File must follow the template format. <a href="#">Download
                                    template</a></div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="overwriteExisting">
                                <label class="form-check-label" for="overwriteExisting">
                                    Overwrite existing books with matching ISBN
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">
                        <i class="bi bi-upload me-1"></i> Upload and Import
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteBookModal" tabindex="-1" aria-labelledby="deleteBookModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteBookModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="bi bi-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                    <p class="mt-3">Are you sure you want to delete this book?</p>
                    <p class="text-muted small">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // View toggle functionality
            const viewGrid = document.getElementById('viewGrid');
            const viewList = document.getElementById('viewList');
            const booksGridView = document.getElementById('booksGridView');
            const booksListView = document.getElementById('booksListView');

            viewGrid.addEventListener('click', function() {
                booksGridView.classList.remove('d-none');
                booksListView.classList.add('d-none');
                viewGrid.classList.add('active');
                viewList.classList.remove('active');
            });

            viewList.addEventListener('click', function() {
                booksGridView.classList.add('d-none');
                booksListView.classList.remove('d-none');
                viewGrid.classList.remove('active');
                viewList.classList.add('active');
            });

            // Reset filters button
            document.getElementById('resetFilters').addEventListener('click', function() {
                document.getElementById('categoryFilter').value = '';
                document.getElementById('stockFilter').value = '';
                document.getElementById('priceMin').value = '';
                document.getElementById('priceMax').value = '';
            });

            // Book card hover effect
            const bookCards = document.querySelectorAll('.book-card');
            bookCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.classList.add('shadow');
                });
                card.addEventListener('mouseleave', function() {
                    this.classList.remove('shadow');
                });
            });
        });
    </script>
@endsection

@section('styles')
    <style>
        .book-card {
            transition: all 0.3s ease;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-cover {
            height: 200px;
            object-fit: cover;
        }

        .book-cover-lg {
            max-height: 300px;
            object-fit: cover;
        }

        .dropdown-item i {
            width: 20px;
        }
    </style>
@endsection
