@extends('shared.layout.admin')

@section('title', 'Add New Book')

@section('page-title', 'Add New Book')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('view.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('view.manage.books') }}">Manage Books</a></li>
    <li class="breadcrumb-item active">Add New Book</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <!-- Main Form Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h6 class="m-0 fw-bold">Book Information</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('create.new.book') }}" method="POST" enctype="multipart/form-data"
                            id="newBookForm">
                            @csrf

                            <!-- Title and Author Row -->
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label for="bookname" class="form-label fw-bold">Book Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('bookname') is-invalid @enderror"
                                        id="bookname" name="bookname" value="{{ old('bookname') }}">
                                    @error('bookname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="author" class="form-label fw-bold">Author <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('author') is-invalid @enderror"
                                        id="author" name="author" value="{{ old('author') }}">
                                    @error('author')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Category and Publication Date Row -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="bookcategory" class="form-label fw-bold">Category <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('bookcategory') is-invalid @enderror"
                                        id="bookcategory" name="bookcategory">
                                        <option value="" disabled {{ old('bookcategory') ? '' : 'selected' }}>Select a
                                            category</option>
                                        <option value="Fiction" {{ old('bookcategory') == 'Fiction' ? 'selected' : '' }}>
                                            Fiction</option>
                                        <option value="Non-Fiction"
                                            {{ old('bookcategory') == 'Non-Fiction' ? 'selected' : '' }}>Non-Fiction
                                        </option>
                                        <option value="Science Fiction"
                                            {{ old('bookcategory') == 'Science Fiction' ? 'selected' : '' }}>Science
                                            Fiction</option>
                                        <option value="Mystery" {{ old('bookcategory') == 'Mystery' ? 'selected' : '' }}>
                                            Mystery</option>
                                        <option value="Biography"
                                            {{ old('bookcategory') == 'Biography' ? 'selected' : '' }}>Biography</option>
                                        <option value="History" {{ old('bookcategory') == 'History' ? 'selected' : '' }}>
                                            History</option>
                                        <option value="Self-Help"
                                            {{ old('bookcategory') == 'Self-Help' ? 'selected' : '' }}>Self-Help</option>
                                        <option value="Children" {{ old('bookcategory') == 'Children' ? 'selected' : '' }}>
                                            Children</option>
                                    </select>
                                    @error('bookcategory')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="datepublish" class="form-label fw-bold">Publication Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('datepublish') is-invalid @enderror"
                                        id="datepublish" name="datepublish" value="{{ old('datepublish') }}">
                                    @error('datepublish')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Stock and Price Row -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="stocks" class="form-label fw-bold">Initial Stock <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('stocks') is-invalid @enderror"
                                        id="stocks" name="stocks" min="1" value="{{ old('stocks', 1) }}">
                                    @error('stocks')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="bookprice" class="form-label fw-bold">Price ($) <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" min="0"
                                            class="form-control @error('bookprice') is-invalid @enderror" id="bookprice"
                                            name="bookprice" value="{{ old('bookprice') }}">
                                        @error('bookprice')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Book Details -->
                            <div class="mb-4">
                                <label for="bookdetails" class="form-label fw-bold">Book Description <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('bookdetails') is-invalid @enderror" id="bookdetails" name="bookdetails"
                                    rows="4">{{ old('bookdetails') }}</textarea>
                                @error('bookdetails')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Provide a brief description of the book (max 255 characters).</div>
                            </div>

                            <!-- Form Actions -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('view.manage.books') }}" class="btn btn-outline-secondary me-2">
                                    <i class="bi bi-x-circle me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-1"></i> Add Book
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Book Cover Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h6 class="m-0 fw-bold">Book Cover</h6>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <img id="coverPreview" src="{{ asset('assets/images/books/book-placeholder.jpg') }}"
                                class="img-fluid rounded book-cover-preview mb-3" alt="Book Cover Preview">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold d-block text-start">Upload Cover Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                id="image" name="image" accept="image/*" form="newBookForm">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-start">Recommended size: 600x900 pixels (JPG, PNG)</div>
                        </div>
                    </div>
                </div>

                <!-- Tips Card -->
                <div class="card shadow-sm mb-4 border-start border-info border-4">
                    <div class="card-body">
                        <h6 class="fw-bold text-info"><i class="bi bi-lightbulb me-2"></i>Tips</h6>
                        <ul class="small mb-0">
                            <li class="mb-2">All fields marked with <span class="text-danger">*</span> are required.
                            </li>
                            <li class="mb-2">Book titles should be entered exactly as they appear on the cover.</li>
                            <li class="mb-2">For multiple authors, separate names with commas.</li>
                            <li class="mb-2">Set accurate initial stock to maintain inventory integrity.</li>
                            <li>Book covers help customers identify books more easily.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <!-- Success Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                        </div>
                        <p class="text-center mb-0">{{ session('success') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{ route('view.manage.books') }}" class="btn btn-primary">View All Books</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <style>
        .book-cover-preview {
            width: 100%;
            max-height: 300px;
            object-fit: contain;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f8f9fa;
        }

        .form-label {
            color: #495057;
        }

        .card {
            transition: all 0.3s ease;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image preview functionality
            const imageInput = document.getElementById('image');
            const coverPreview = document.getElementById('coverPreview');

            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        coverPreview.src = e.target.result;
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Real-time total calculation
            const stocks = document.getElementById('stocks');
            const price = document.getElementById('bookprice');
            const total = document.getElementById('totalCost');

            if (stocks && price && total) {
                const calculateTotal = () => {
                    const qty = parseFloat(stocks.value) || 0;
                    const prc = parseFloat(price.value) || 0;
                    total.value = (qty * prc).toFixed(2);
                };

                stocks.addEventListener('input', calculateTotal);
                price.addEventListener('input', calculateTotal);
                calculateTotal(); // Initial calculation
            }

            // Show modal if there are validation errors
            @if ($errors->any() && session('show_modal'))
                if (document.getElementById('importBooksModal')) {
                    try {
                        const importModal = new bootstrap.Modal(document.getElementById('importBooksModal'));
                        importModal.show();
                    } catch (e) {
                        console.error("Error showing import modal:", e);
                    }
                }
            @endif

            @if (session('success'))
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            @endif
        });
    </script>
@endsection
