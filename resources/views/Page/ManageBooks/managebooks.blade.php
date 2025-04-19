@extends('shared.layout.admin')

@section('title', 'Book Management')

@section('page-title', 'Book Management')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('view.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Book Management</li>
@endsection

@section('content')
<!-- Book Management Interface -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 fw-bold text-primary">Books Inventory</h6>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookModal">
                    <i class="bi bi-plus-circle me-1"></i> Add New Book
                </button>
            </div>
            <div class="card-body">
                <!-- Search and Filter -->
                <div class="row mb-4">
                    <div class="col-md-5">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search books..." aria-label="Search books">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-7 d-flex justify-content-md-end mt-3 mt-md-0 gap-2">
                        <select class="form-select w-auto">
                            <option selected>All Categories</option>
                            <option>Fiction</option>
                            <option>Non-Fiction</option>
                            <option>Science Fiction</option>
                            <option>Mystery</option>
                            <option>Biography</option>
                        </select>
                        <select class="form-select w-auto">
                            <option selected>All Authors</option>
                            <option>J.K. Rowling</option>
                            <option>George Orwell</option>
                            <option>Jane Austen</option>
                            <option>Stephen King</option>
                        </select>
                        <select class="form-select w-auto">
                            <option selected>Sort By</option>
                            <option>Title (A-Z)</option>
                            <option>Title (Z-A)</option>
                            <option>Price (Low-High)</option>
                            <option>Price (High-Low)</option>
                            <option>Stock (Low-High)</option>
                        </select>
                    </div>
                </div>

                <!-- Books Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="px-4 py-3" style="width: 60px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3">Book</th>
                                <th scope="col" class="px-4 py-3">Author</th>
                                <th scope="col" class="px-4 py-3">ISBN</th>
                                <th scope="col" class="px-4 py-3">Category</th>
                                <th scope="col" class="px-4 py-3">Price</th>
                                <th scope="col" class="px-4 py-3">Stock</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Book 1 -->
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x60" class="book-cover me-3" alt="Book cover">
                                        <div>
                                            <h6 class="mb-0">To Kill a Mockingbird</h6>
                                            <small class="text-muted">Published 1960</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">Harper Lee</td>
                                <td class="px-4 py-3">978-0446310789</td>
                                <td class="px-4 py-3"><span class="badge bg-info">Fiction</span></td>
                                <td class="px-4 py-3">$12.99</td>
                                <td class="px-4 py-3"><span class="badge bg-success">In Stock (45)</span></td>
                                <td class="px-4 py-3">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu shadow">
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Details</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editBookModal"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- Book 2 -->
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x60" class="book-cover me-3" alt="Book cover">
                                        <div>
                                            <h6 class="mb-0">1984</h6>
                                            <small class="text-muted">Published 1949</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">George Orwell</td>
                                <td class="px-4 py-3">978-0451524935</td>
                                <td class="px-4 py-3"><span class="badge bg-info">Fiction</span></td>
                                <td class="px-4 py-3">$9.99</td>
                                <td class="px-4 py-3"><span class="badge bg-success">In Stock (28)</span></td>
                                <td class="px-4 py-3">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu shadow">
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Details</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editBookModal"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- Book 3 -->
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x60" class="book-cover me-3" alt="Book cover">
                                        <div>
                                            <h6 class="mb-0">The Great Gatsby</h6>
                                            <small class="text-muted">Published 1925</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">F. Scott Fitzgerald</td>
                                <td class="px-4 py-3">978-0743273565</td>
                                <td class="px-4 py-3"><span class="badge bg-info">Fiction</span></td>
                                <td class="px-4 py-3">$14.50</td>
                                <td class="px-4 py-3"><span class="badge bg-warning text-dark">Low Stock (3)</span></td>
                                <td class="px-4 py-3">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu shadow">
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Details</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editBookModal"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- Book 4 -->
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x60" class="book-cover me-3" alt="Book cover">
                                        <div>
                                            <h6 class="mb-0">Pride and Prejudice</h6>
                                            <small class="text-muted">Published 1813</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">Jane Austen</td>
                                <td class="px-4 py-3">978-0141439518</td>
                                <td class="px-4 py-3"><span class="badge bg-info">Fiction</span></td>
                                <td class="px-4 py-3">$8.99</td>
                                <td class="px-4 py-3"><span class="badge bg-danger">Out of Stock</span></td>
                                <td class="px-4 py-3">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu shadow">
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Details</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editBookModal"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                            <li><a class="dropdown-item text-success" href="#"><i class="bi bi-plus-circle me-2"></i>Restock</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- Book 5 -->
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x60" class="book-cover me-3" alt="Book cover">
                                        <div>
                                            <h6 class="mb-0">The Catcher in the Rye</h6>
                                            <small class="text-muted">Published 1951</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">J.D. Salinger</td>
                                <td class="px-4 py-3">978-0316769488</td>
                                <td class="px-4 py-3"><span class="badge bg-info">Fiction</span></td>
                                <td class="px-4 py-3">$10.99</td>
                                <td class="px-4 py-3"><span class="badge bg-warning text-dark">Low Stock (5)</span></td>
                                <td class="px-4 py-3">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu shadow">
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Details</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editBookModal"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Bulk Actions and Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="d-flex align-items-center">
                        <select class="form-select form-select-sm me-2" style="width: auto;">
                            <option selected>Bulk Actions</option>
                            <option>Delete Selected</option>
                            <option>Update Stock</option>
                            <option>Change Price</option>
                        </select>
                        <button class="btn btn-sm btn-outline-secondary">Apply</button>
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Book Stats -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-start border-primary border-4 shadow h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs text-uppercase fw-bold text-primary mb-1">Total Books</div>
                        <div class="h3 mb-0 fw-bold">1,458</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-book fs-1 text-primary opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-start border-success border-4 shadow h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs text-uppercase fw-bold text-success mb-1">Books in Stock</div>
                        <div class="h3 mb-0 fw-bold">1,245</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-box-seam fs-1 text-success opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-start border-warning border-4 shadow h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs text-uppercase fw-bold text-warning mb-1">Low Stock</div>
                        <div class="h3 mb-0 fw-bold">28</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-exclamation-triangle fs-1 text-warning opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-start border-danger border-4 shadow h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs text-uppercase fw-bold text-danger mb-1">Out of Stock</div>
                        <div class="h3 mb-0 fw-bold">42</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-x-circle fs-1 text-danger opacity-50"></i>
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
            <div class="modal-header">
                <h5 class="modal-title" id="addBookModalLabel">Add New Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="title" class="form-label">Book Title</label>
                            <input type="text" class="form-control" id="title" required>
                        </div>
                        <div class="col-md-4">
                            <label for="publishYear" class="form-label">Year Published</label>
                            <input type="number" class="form-control" id="publishYear">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" required>
                        </div>
                        <div class="col-md-6">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" class="form-control" id="isbn" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="price" class="form-label">Price ($)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="price" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="stock" class="form-label">Stock Quantity</label>
                            <input type="number" class="form-control" id="stock" min="0" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" required>
                                <option value="">Select Category</option>
                                <option>Fiction</option>
                                <option>Non-Fiction</option>
                                <option>Science Fiction</option>
                                <option>Mystery</option>
                                <option>Biography</option>
                                <option>History</option>
                                <option>Children's</option>
                                <option>Young Adult</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="publisher" class="form-label">Publisher</label>
                            <input type="text" class="form-control" id="publisher">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="coverImage" class="form-label">Cover Image</label>
                        <input class="form-control" type="file" id="coverImage" accept="image/*">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add Book</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Book Modal -->
<div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBookModalLabel">Edit Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="editTitle" class="form-label">Book Title</label>
                            <input type="text" class="form-control" id="editTitle" value="To Kill a Mockingbird" required>
                        </div>
                        <div class="col-md-4">
                            <label for="editPublishYear" class="form-label">Year Published</label>
                            <input type="number" class="form-control" id="editPublishYear" value="1960">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editAuthor" class="form-label">Author</label>
                            <input type="text" class="form-control" id="editAuthor" value="Harper Lee" required>
                        </div>
                        <div class="col-md-6">
                            <label for="editIsbn" class="form-label">ISBN</label>
                            <input type="text" class="form-control" id="editIsbn" value="978-0446310789" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editPrice" class="form-label">Price ($)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="editPrice" value="12.99" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="editStock" class="form-label">Stock Quantity</label>
                            <input type="number" class="form-control" id="editStock" value="45" min="0" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editCategory" class="form-label">Category</label>
                            <select class="form-select" id="editCategory" required>
                                <option>Fiction</option>
                                <option>Non-Fiction</option>
                                <option>Science Fiction</option>
                                <option>Mystery</option>
                                <option>Biography</option>
                                <option>History</option>
                                <option>Children's</option>
                                <option>Young Adult</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="editPublisher" class="form-label">Publisher</label>
                            <input type="text" class="form-control" id="editPublisher" value="Grand Central Publishing">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editDescription" rows="3">The unforgettable novel of a childhood in a sleepy Southern town and the crisis of conscience that rocked it. Compassionate, dramatic, and deeply moving, To Kill A Mockingbird takes readers to the roots of human behavior - to innocence and experience, kindness and cruelty, love and hatred.</textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-9">
                            <label for="editCoverImage" class="form-label">Cover Image</label>
                            <input class="form-control" type="file" id="editCoverImage" accept="image/*">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Current Cover</label>
                            <div class="text-center">
                                <img src="https://via.placeholder.com/100x150" class="img-thumbnail" alt="Book cover">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<style>
.book-cover {
    width: 40px;
    height: 60px;
    object-fit: cover;
}
</style>

@include('shared.css.style')
@include('shared.js.script')
@endsection
