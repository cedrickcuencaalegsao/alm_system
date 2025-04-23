@extends('shared.layout.admin')

@section('title', 'Restock Book')

@section('page-title', 'Restock Book Inventory')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('view.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('view.manage.books') }}">Manage Books</a></li>
    <li class="breadcrumb-item active">Restock Book</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h6 class="m-0 fw-bold">Book Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-3 text-center">
                                @if ($book->getImage())
                                    <img src="{{ asset('assets/images/books/' . $book->getImage()) }}"
                                        alt="{{ $book->getBookName() }}" class="img-fluid rounded book-cover-lg mb-3"
                                        style="max-height: 200px; object-fit: contain;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                        style="height: 200px;">
                                        <i class="bi bi-book text-secondary" style="font-size: 4rem;"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-9">
                                <h4 class="mb-1">{{ $book->getBookName() }}</h4>
                                <p class="text-muted mb-3">by {{ $book->getAuthor() }}</p>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <span class="text-muted">ID:</span>
                                            <span class="fw-bold ms-2">{{ $book->getID() }}</span>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-muted">Book ID:</span>
                                            <span class="fw-bold ms-2">{{ $book->getBookID() }}</span>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-muted">Category:</span>
                                            <span class="fw-bold ms-2">{{ $book->getCategory() }}</span>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-muted">Publication Date:</span>
                                            <span class="fw-bold ms-2">{{ $book->getDatePublish() }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <span class="text-muted">Current Stock:</span>
                                            <span
                                                class="fw-bold ms-2 {{ $book->getStock() > 10 ? 'text-success' : ($book->getStock() > 0 ? 'text-warning' : 'text-danger') }}">
                                                {{ $book->getStock() }}
                                            </span>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-muted">Price:</span>
                                            <span class="fw-bold ms-2">${{ number_format($book->getPrice(), 2) }}</span>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-muted">Last Updated:</span>
                                            <span class="fw-bold ms-2">{{ $book->updatedAt() }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <span class="text-muted">Description:</span>
                                    <p class="mt-1">{{ $book->getBookDetails() }}</p>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('restock.book') }}" method="POST" id="restockForm">
                            @csrf
                            <input type="hidden" name="bookID" value="{{ $book->getBookID() }}">
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3">Restock Information</h6>

                                            <div class="form-group mb-0">
                                                <label for="quantity" class="form-label fw-bold">Restock Quantity <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" id="quantity" name="quantity" value="1"
                                                    min="1" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4 border-top pt-4">
                                <a href="{{ route('view.manage.books') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Back to Books
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="bi bi-box-arrow-in-down me-2"></i> Process Restock
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
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
@endsection
@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
    </script>
@endif
@section('styles')
    <style>
        .form-label {
            color: #495057;
        }

        .card {
            transition: all 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .book-cover-lg {
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }
    </style>
@endsection
