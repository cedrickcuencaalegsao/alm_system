<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookHaven | Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Back Button -->
        <div class="mb-4 mt-4">
            <a href="{{ route('view.home') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-2"></i>Back to Home
            </a>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Search Results</h4>
            <div class="d-flex align-items-center">
                <form action="{{ route('search') }}" method="GET" class="me-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="query"
                            value="{{ request()->input('query') }}" placeholder="Search books...">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
                <span class="text-muted">{{ count($books) }} {{ Str::plural('item', count($books)) }}</span>
            </div>
        </div>

        <div class="row">
            <!-- Filters Column -->
            <div class="col-md-3 mb-4">
                <div class="filter-card">
                    <h5 class="mb-3">View Options</h5>
                    <div class="btn-group w-100 mb-3" role="group" aria-label="View options">
                        <button type="button" class="btn btn-outline-primary view-option active" data-view="grid">
                            <i class="bi bi-grid-3x3-gap-fill"></i> Grid
                        </button>
                        <button type="button" class="btn btn-outline-primary view-option" data-view="list">
                            <i class="bi bi-list-ul"></i> List
                        </button>
                    </div>

                    <h5 class="mb-3">Sort By</h5>
                    <select class="form-select mb-4" id="sortSelect">
                        <option value="title-asc">Title (A-Z)</option>
                        <option value="title-desc">Title (Z-A)</option>
                        <option value="price-asc">Price (Low to High)</option>
                        <option value="price-desc">Price (High to Low)</option>
                    </select>

                    <div class="d-grid">
                        <a href="{{ route('view.cart', encrypt(Auth::user()->userID)) }}" class="btn btn-primary">
                            <i class="bi bi-cart me-2"></i>View Cart
                        </a>
                    </div>
                </div>
            </div>

            <!-- Results Column -->
            <div class="col-md-9">
                @if (count($books) > 0)
                    <div class="row row-cols-1 row-cols-md-3 g-4 book-container grid-view">
                        @foreach ($books as $book)
                            <div class="col book-item">
                                <div class="book-card h-100">
                                    <div class="book-card-content">
                                        <div class="book-image-container">
                                            <div class="book-image-wrapper">
                                                <img src="{{ route('default.image') }}"
                                                    alt="{{ $book->getBookName() }} Cover">
                                                @if ($book->getStock() < 20)
                                                    <span class="stock-badge">Only {{ $book->getStock() }} left</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="book-details">
                                            <h6 class="book-title">{{ $book->getBookName() }}</h6>
                                            <p class="text-muted small mb-1">{{ $book->getAuthor() }} -
                                                {{ $book->getCategory() }}</p>
                                            <p class="book-description">{{ Str::limit($book->getBookDetails(), 80) }}
                                            </p>
                                        </div>
                                        <div class="book-footer">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="book-price mb-0">
                                                    @if ($book->getPrice())
                                                        ₱{{ number_format($book->getPrice(), 2) }}
                                                    @else
                                                        Price not set
                                                    @endif
                                                </h6>
                                                <div class="action-buttons">
                                                    <form action="{{ route('add.to.cart') }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="book_id"
                                                            value="{{ $book->getBookID() }}">
                                                        <input type="hidden" name="user_id"
                                                            value="{{ auth()->user()->userID }}">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-primary cart-btn"
                                                            title="Add to Cart">
                                                            <i class="bi bi-cart-plus"></i>
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('view.checkout', $book->getBookID()) }}"
                                                        class="btn btn-sm btn-primary buy-btn ms-1" title="Buy Now">
                                                        <i class="bi bi-bag"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-results">
                        <i class="bi bi-search display-1"></i>
                        <h5 class="mt-4">No books found</h5>
                        <p class="text-muted">We couldn't find any books matching "{{ request()->input('query') }}"
                        </p>
                        <a href="{{ route('view.home') }}" class="btn btn-primary mt-2">
                            Browse All Books
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('shared.css.search')
    @include('shared.js.search')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
