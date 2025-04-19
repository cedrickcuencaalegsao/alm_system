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

    <style>
        body {
            background-color: #FDF5E6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-bottom: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Book Card Styles */
        .book-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1.25rem;
            margin-bottom: 1rem;
            transition: transform 0.2s;
            height: 100%;
            position: relative;
        }

        .book-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 69, 19, 0.15);
        }

        .book-card-content {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .book-image-container {
            margin-bottom: 1rem;
        }

        .book-image-wrapper {
            width: 100%;
            height: 160px;
            position: relative;
            margin-bottom: 0.75rem;
            overflow: hidden;
            border-radius: 5px;
        }

        .book-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }

        .book-card:hover .book-image-wrapper img {
            transform: scale(1.05);
        }

        .book-details {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .book-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            color: #5D4037;
        }

        .book-description {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 0.75rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex-grow: 1;
        }

        .book-footer {
            margin-top: auto;
            padding-top: 0.75rem;
            border-top: 1px solid rgba(139, 69, 19, 0.1);
        }

        .book-price {
            font-weight: 600;
            color: #8B4513;
        }

        .stock-badge {
            position: absolute;
            top: 5px;
            left: 5px;
            font-size: 0.65rem;
            padding: 0.15rem 0.35rem;
            background-color: rgba(220, 53, 69, 0.9);
            color: white;
            border-radius: 3px;
            z-index: 1;
        }

        .action-buttons {
            display: flex;
        }

        .cart-btn,
        .buy-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            padding: 0;
        }

        .buy-btn {
            width: 36px;
            height: 36px;
        }

        .filter-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            position: sticky;
            top: 2rem;
        }

        .btn-outline-primary {
            color: #8B4513;
            border-color: #8B4513;
        }

        .btn-outline-primary:hover,
        .btn-outline-primary.active {
            background-color: #8B4513;
            border-color: #8B4513;
            color: white;
        }

        .btn-primary {
            background-color: #8B4513;
            border-color: #8B4513;
        }

        .btn-primary:hover {
            background-color: #693310;
            border-color: #693310;
        }

        .form-select:focus,
        .form-control:focus {
            border-color: #8B4513;
            box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.25);
        }

        .empty-results {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 3rem 2rem;
            text-align: center;
        }

        .empty-results i {
            color: #8B4513;
            opacity: 0.2;
        }

        /* List view styles */
        .book-container.list-view .book-item {
            width: 100%;
            max-width: 100%;
            flex: 0 0 100%;
        }

        .book-container.list-view .book-card-content {
            flex-direction: row;
        }

        .book-container.list-view .book-image-container {
            width: 100px;
            min-width: 100px;
            margin-right: 1.25rem;
            margin-bottom: 0;
        }

        .book-container.list-view .book-image-wrapper {
            height: 130px;
            width: 100%;
        }

        .book-container.list-view .book-details {
            padding-right: 1rem;
        }

        .book-container.list-view .book-description {
            -webkit-line-clamp: 2;
        }

        .book-container.list-view .book-footer {
            border-top: none;
            padding-top: 0;
        }

        /* For grid view on mobile */
        @media (max-width: 767.98px) {
            .filter-card {
                margin-bottom: 1.5rem;
                position: static;
            }

            .book-image-wrapper {
                height: 140px;
            }
        }

        @media (max-width: 575.98px) {
            .book-container.list-view .book-card-content {
                flex-direction: column;
            }

            .book-container.list-view .book-image-container {
                width: 100%;
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .book-container.list-view .book-image-wrapper {
                height: 160px;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // View switching (grid/list)
            const viewOptions = document.querySelectorAll('.view-option');
            const bookContainer = document.querySelector('.book-container');

            viewOptions.forEach(option => {
                option.addEventListener('click', function() {
                    viewOptions.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    const viewType = this.getAttribute('data-view');
                    if (viewType === 'grid') {
                        bookContainer.classList.remove('list-view');
                        bookContainer.classList.add('grid-view');
                    } else {
                        bookContainer.classList.remove('grid-view');
                        bookContainer.classList.add('list-view');
                    }
                });
            });

            // Sorting functionality
            const sortSelect = document.getElementById('sortSelect');
            const bookItems = document.querySelectorAll('.book-item');

            sortSelect.addEventListener('change', function() {
                const sortType = this.value;
                const bookItemsArray = Array.from(bookItems);

                // Sort the books based on the selected option
                bookItemsArray.sort((a, b) => {
                    if (sortType === 'title-asc') {
                        return a.querySelector('.book-title').textContent.trim().localeCompare(
                            b.querySelector('.book-title').textContent.trim()
                        );
                    } else if (sortType === 'title-desc') {
                        return b.querySelector('.book-title').textContent.trim().localeCompare(
                            a.querySelector('.book-title').textContent.trim()
                        );
                    } else if (sortType === 'price-asc') {
                        const priceA = parseFloat(a.querySelector('.book-price').textContent.trim()
                            .replace('₱', '').replace(',', '')) || 0;
                        const priceB = parseFloat(b.querySelector('.book-price').textContent.trim()
                            .replace('₱', '').replace(',', '')) || 0;
                        return priceA - priceB;
                    } else if (sortType === 'price-desc') {
                        const priceA = parseFloat(a.querySelector('.book-price').textContent.trim()
                            .replace('₱', '').replace(',', '')) || 0;
                        const priceB = parseFloat(b.querySelector('.book-price').textContent.trim()
                            .replace('₱', '').replace(',', '')) || 0;
                        return priceB - priceA;
                    }
                    return 0;
                });

                // Remove all existing items
                bookItemsArray.forEach(item => {
                    item.remove();
                });

                // Add them back in the sorted order
                bookItemsArray.forEach(item => {
                    bookContainer.appendChild(item);
                });
            });
        });
    </script>
</body>

</html>
