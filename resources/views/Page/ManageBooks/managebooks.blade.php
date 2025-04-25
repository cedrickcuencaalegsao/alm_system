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
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('view.manage.books') }}" method="GET" class="input-group">
                                    <input type="text" name="query" class="form-control"
                                        placeholder="Search books by title, author, or category..."
                                        value="{{ $search ?? '' }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                    @if ($search)
                                        <a href="{{ route('view.manage.books') }}" class="btn btn-outline-danger">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                    @endif
                                </form>
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
                    </div>
                    <div class="card-body">
                        <div id="booksGridView">
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">

                                @foreach ($books['allBooks'] as $book)
                                    <div class="col-md-5 mb-4">
                                        <div class="card h-100 shadow-sm rounded-4 overflow-hidden">
                                            <div class="position-relative">
                                                <img src="{{ $book->getImage() ? asset('storage/' . $book->getBookImage()) : route('default.image') }}"
                                                    class="card-img-top book-cover object-fit-cover" alt="Book Cover"
                                                    style="height: 180px; width: 100%;">
                                                <span
                                                    class="badge
                                                    position-absolute top-0 end-0 m-2
                                                    {{ $book->getStock() >= 100 ? 'bg-success' : ($book->getStock() >= 50 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                                    {{ $book->getStock() >= 100 ? 'Stock is Good' : ($book->getStock() >= 50 ? 'Moderate Stock' : 'Low Stock') }}
                                                </span>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title text-truncate" title="{{ $book->getBookName() }}">
                                                    {{ $book->getBookName() }}
                                                </h5>
                                                <p class="card-text text-muted mb-1">{{ $book->getAuthor() }}</p>
                                                <p class="card-text">
                                                    <small class="text-muted">Category: {{ $book->getCategory() }}</small>
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center mt-3">
                                                    <span
                                                        class="fw-bold text-primary">${{ number_format($book->getPrice(), 2) }}</span>
                                                    <span class="text-muted">
                                                        <i class="bi bi-box-seam me-1"></i>{{ $book->getStock() }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="card-footer bg-transparent border-top-0">
                                                <div class="d-flex justify-content-between">
                                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.edit.book', encrypt($book->getBookID())) }}">
                                                        <i class="bi bi-pencil me-1"></i>Edit
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
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
