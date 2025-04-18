@extends('shared.layout.authenticated')
@section('title', 'Home')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <section class="py-5" id="best-selling">
        <div class="container">
            <h2 class="mb-4">Best Selling Books</h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($books['bestSelling'] as $book)
                    <div class="col">
                        <div class="card book-card h-100" data-bs-toggle="tooltip" data-bs-html="true"
                            title="<div class='tooltip-content'><p><strong>Author:</strong> {{ $book->getAuthor() }}</p><p><strong>Details:</strong> {{ Str::limit($book->getBookDetails(), 150) }}</p><p><strong>Price:</strong> ₱{{ number_format($book->getPrice(), 2) }}</p><p><strong>Stock:</strong> {{ $book->getStock() }}</p></div>">
                            <div class="book-image-wrapper">
                                <img src="{{ route('default.image') }}" class="card-img-top"
                                    alt="{{ $book->getBookName() }} Cover">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-truncate" title="{{ $book->getBookName() }}">
                                    {{ $book->getBookName() }}</h5>
                                <p class="card-text text-muted text-truncate" title="{{ $book->getAuthor() }}">
                                    {{ $book->getAuthor() }}</p>
                                <p class="card-text small book-description">{{ Str::limit($book->getBookDetails(), 100) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="price-badge">
                                        @if ($book->getPrice())
                                            ₱ {{ number_format($book->getPrice(), 2) }}
                                        @else
                                            Price not set
                                        @endif
                                    </span>
                                    @php
                                        $stockClass = '';
                                        $stock = $book->getStock();
                                        if ($stock < 20) {
                                            $stockClass = 'stock-low';
                                        } elseif ($stock >= 20 && $stock < 100) {
                                            $stockClass = 'stock-medium';
                                        } else {
                                            $stockClass = 'stock-high';
                                        }
                                    @endphp
                                    <span class="stock-badge {{ $stockClass }}">
                                        {{ $stock > 0 ? $stock . ' in stock' : 'Out of stock' }}
                                    </span>
                                </div>
                                <div class="mt-auto">
                                    <div class="d-grid gap-2">
                                        <form action="{{ route('add.to.cart') }}" method="POST"
                                            class="add-to-cart-form w-100">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->userID }}">
                                            <input type="hidden" name="book_id" value="{{ $book->getBookID() }}">
                                            <button type="submit" class="btn btn-outline-primary add-to-cart-btn"
                                                data-book-id="{{ $book->getBookID() }}"
                                                {{ $stock <= 0 ? 'disabled' : '' }}>
                                                <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                            </button>
                                        </form>
                                        <a href="{{ route('view.checkout', ['bookID' => $book->getBookID()]) }}"
                                            class="btn btn-primary buy-now-btn"
                                            {{ $stock <= 0 ? 'aria-disabled=true tabindex=-1' : '' }}>
                                            <i class="bi bi-lightning-fill me-2"></i>Buy Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="py-4" id="all-books">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>All Books</h2>
                <div class="filter-controls">
                    <select class="form-select form-select-sm sort-select">
                        <option value="popular">Sort by: Popularity</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="newest">Newest Arrivals</option>
                    </select>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($books['allBooks'] as $book)
                    <div class="col">
                        <div class="card book-card h-100" data-bs-toggle="tooltip" data-bs-html="true"
                            title="<div class='tooltip-content'><p><strong>Author:</strong> {{ $book->getAuthor() }}</p><p><strong>Details:</strong> {{ Str::limit($book->getBookDetails(), 150) }}</p><p><strong>Price:</strong> ₱{{ number_format($book->getPrice(), 2) }}</p><p><strong>Stock:</strong> {{ $book->getStock() }}</p></div>">
                            <div class="book-image-wrapper">
                                <img src="{{ route('default.image') }}" class="card-img-top"
                                    alt="{{ $book->getBookName() }} Cover">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-truncate" title="{{ $book->getBookName() }}">
                                    {{ $book->getBookName() }}</h5>
                                <p class="card-text text-muted text-truncate" title="{{ $book->getAuthor() }}">
                                    {{ $book->getAuthor() }}</p>
                                <p class="card-text small book-description">{{ Str::limit($book->getBookDetails(), 100) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="price-badge">
                                        @if ($book->getPrice())
                                            ₱ {{ number_format($book->getPrice(), 2) }}
                                        @else
                                            Price not set
                                        @endif
                                    </span>
                                    @php
                                        $stockClass = '';
                                        $stock = $book->getStock();
                                        if ($stock < 20) {
                                            $stockClass = 'stock-low';
                                        } elseif ($stock >= 20 && $stock < 100) {
                                            $stockClass = 'stock-medium';
                                        } else {
                                            $stockClass = 'stock-high';
                                        }
                                    @endphp
                                    <span class="stock-badge {{ $stockClass }}">
                                        {{ $book->getStock() }} in stock
                                    </span>
                                </div>
                                <div class="mt-auto">
                                    <div class="d-grid gap-2">
                                        <form action="{{ route('add.to.cart') }}" method="POST"
                                            class="add-to-cart-form w-100">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->userID }}">
                                            <input type="hidden" name="book_id" value="{{ $book->getBookID() }}">
                                            <button type="submit" class="btn btn-outline-primary add-to-cart-btn"
                                                data-book-id="{{ $book->getBookID() }}">
                                                <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                            </button>
                                        </form>
                                        <a href="{{ route('view.checkout', ['bookID' => $book->getBookID()]) }}"
                                            class="btn btn-primary buy-now-btn">
                                            <i class="bi bi-lightning-fill me-2"></i>Buy Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @foreach ($books['byCategory'] as $categoryName => $categoryBooks)
        <section class="py-4 mb-5" id="category-{{ Str::slug($categoryName) }}">
            <div class="container-fluid">
                <div class="section-header mb-4">
                    <h2 class="section-title">{{ $categoryName }}</h2>
                    <p class="text-muted">Explore our {{ $categoryName }} collection</p>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach ($categoryBooks as $book)
                        <div class="col">
                            <div class="card book-card h-100" data-bs-toggle="tooltip" data-bs-html="true"
                                title="<div class='tooltip-content'><p><strong>Author:</strong> {{ $book->getAuthor() }}</p><p><strong>Details:</strong> {{ Str::limit($book->getBookDetails(), 150) }}</p><p><strong>Price:</strong> ₱{{ number_format($book->getPrice(), 2) }}</p><p><strong>Stock:</strong> {{ $book->getStock() }}</p></div>">
                                <div class="book-image-wrapper">
                                    <img src="{{ route('default.image') }}" class="card-img-top"
                                        alt="{{ $book->getBookName() }} Cover">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-truncate" title="{{ $book->getBookName() }}">
                                        {{ $book->getBookName() }}</h5>
                                    <p class="card-text text-muted text-truncate" title="{{ $book->getAuthor() }}">
                                        {{ $book->getAuthor() }}</p>
                                    <p class="card-text small book-description">
                                        {{ Str::limit($book->getBookDetails(), 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="price-badge">
                                            @if ($book->getPrice())
                                                ₱ {{ number_format($book->getPrice(), 2) }}
                                            @else
                                                Price not set
                                            @endif
                                        </span>
                                        @php
                                            $stockClass = '';
                                            $stock = $book->getStock();
                                            if ($stock < 20) {
                                                $stockClass = 'stock-low';
                                            } elseif ($stock >= 20 && $stock < 100) {
                                                $stockClass = 'stock-medium';
                                            } else {
                                                $stockClass = 'stock-high';
                                            }
                                        @endphp
                                        <span class="stock-badge {{ $stockClass }}">
                                            {{ $book->getStock() }} in stock
                                        </span>
                                    </div>
                                    <div class="mt-auto">
                                        <div class="d-grid gap-2">
                                            <form action="{{ route('add.to.cart') }}" method="POST"
                                                class="add-to-cart-form w-100">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->userID }}">
                                                <input type="hidden" name="book_id" value="{{ $book->getBookID() }}">
                                                <button type="submit" class="btn btn-outline-primary add-to-cart-btn"
                                                    data-book-id="{{ $book->getBookID() }}">
                                                    <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                                </button>
                                            </form>
                                            <a href="{{ route('view.checkout', ['bookID' => $book->getBookID()]) }}"
                                                class="btn btn-primary buy-now-btn">
                                                <i class="bi bi-lightning-fill me-2"></i>Buy Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach

    <style>
        .book-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            height: 100%;
            background-color: #fff;
            max-width: 280px;
            margin: 0 auto;
            cursor: pointer;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .book-image-wrapper {
            height: 160px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background-color: #f8f9fa;
        }

        .book-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-title {
            font-size: 0.95rem;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 0.5rem;
            color: #2c3e50;
            min-height: 2.4rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            white-space: normal;
            text-overflow: ellipsis;
        }

        .card-text.text-muted {
            font-size: 0.85rem;
            color: #666 !important;
            margin-bottom: 0.5rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
        }

        .book-description {
            font-size: 0.8rem;
            line-height: 1.4;
            color: #666;
            min-height: 2.2rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
            margin-bottom: 0.75rem;
        }

        .card-body {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .price-badge {
            background-color: #8B4513;
            color: white;
            padding: 0.3rem 0.8rem;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 20px;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(139, 69, 19, 0.2);
        }

        .stock-badge {
            padding: 0.25rem 0.6rem;
            font-size: 0.7rem;
            border-radius: 20px;
            font-weight: 500;
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .stock-low {
            background-color: #dc3545;
            border: none;
        }

        .stock-medium {
            background-color: #ffc107;
            color: #212529;
            border: none;
        }

        .stock-high {
            background-color: #28a745;
            border: none;
        }

        .text-truncate {
            max-width: 100%;
        }

        .add-to-cart-btn,
        .buy-now-btn {
            border-color: #8B4513;
            padding: 0.5rem 0.75rem;
            font-size: 0.8rem;
            height: 38px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            min-width: 120px;
            max-width: 100%;
            margin: 0 auto;
            border-radius: 5px;
        }

        .add-to-cart-form {
            width: 100%;
            margin-bottom: 0.4rem;
        }

        .add-to-cart-btn {
            color: #8B4513;
            background-color: white;
        }

        .add-to-cart-btn:hover {
            background-color: #8B4513;
            border-color: #8B4513;
            color: white;
        }

        .add-to-cart-btn:disabled {
            background-color: #e9ecef;
            border-color: #ced4da;
            color: #6c757d;
            cursor: not-allowed;
        }

        .buy-now-btn {
            background-color: #8B4513;
            border-color: #8B4513;
            color: white;
            transition: all 0.3s ease;
        }

        .buy-now-btn:hover {
            background-color: #693310;
            border-color: #693310;
        }

        .buy-now-btn[aria-disabled=true] {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
            opacity: 0.65;
            pointer-events: none;
        }

        .tooltip {
            position: absolute;
            z-index: 1070;
            display: block;
            margin: 0;
            font-family: var(--bs-font-sans-serif);
            font-style: normal;
            font-weight: 400;
            line-height: 1.5;
            text-align: left;
            text-decoration: none;
            text-shadow: none;
            text-transform: none;
            letter-spacing: normal;
            word-break: normal;
            word-spacing: normal;
            white-space: normal;
            line-break: auto;
            font-size: 0.875rem;
            word-wrap: break-word;
            opacity: 0;
        }

        .tooltip.show {
            opacity: 0.9;
        }

        .tooltip .tooltip-inner {
            max-width: 280px;
            padding: 0.5rem 0.8rem;
            color: #fff;
            text-align: left;
            background-color: #333;
            border-radius: 0.25rem;
        }

        .tooltip-content {
            padding: 5px;
            font-size: 0.8rem;
        }

        .tooltip-content p {
            margin-bottom: 0.5rem;
        }

        .tooltip-content p:last-child {
            margin-bottom: 0;
        }

        .filter-controls {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .sort-select {
            min-width: 180px;
            border-color: #dee2e6;
            color: #495057;
            font-size: 0.9rem;
        }

        .section-header {
            position: relative;
            margin-bottom: 2rem;
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -10px;
            width: 50px;
            height: 3px;
            background-color: #8B4513;
        }

        /* Mobile Responsive Styles */
        @media (max-width: 992px) {
            .row-cols-md-3>* {
                flex: 0 0 auto;
                width: 33.33333%;
            }

            .book-image-wrapper {
                height: 150px;
            }

            .book-card {
                max-width: 250px;
            }
        }

        @media (max-width: 768px) {
            .book-card {
                margin-bottom: 1rem;
                max-width: 230px;
            }

            .book-image-wrapper {
                height: 140px;
            }

            .card-title {
                font-size: 0.9rem;
                min-height: 2.2rem;
            }

            .card-text.text-muted {
                font-size: 0.75rem;
            }

            .book-description {
                font-size: 0.7rem;
                min-height: 2rem;
            }

            .price-badge,
            .stock-badge {
                padding: 0.2rem 0.5rem;
                font-size: 0.7rem;
            }

            .add-to-cart-btn,
            .buy-now-btn {
                padding: 0.4rem 0.6rem;
                font-size: 0.75rem;
                height: 36px;
            }

            .section-title {
                font-size: 1.3rem;
            }

            .section-header p {
                font-size: 0.85rem;
            }

            .container-fluid {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }

            .filter-controls {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .sort-select {
                min-width: 150px;
            }
        }

        @media (max-width: 576px) {
            .book-card {
                max-width: 100%;
            }

            .book-image-wrapper {
                height: 130px;
            }

            .card-title {
                font-size: 0.85rem;
                min-height: 2rem;
            }

            .card-text.text-muted {
                font-size: 0.7rem;
            }

            .book-description {
                font-size: 0.65rem;
                min-height: 1.8rem;
            }

            .price-badge,
            .stock-badge {
                padding: 0.15rem 0.5rem;
                font-size: 0.65rem;
            }

            .add-to-cart-btn,
            .buy-now-btn {
                padding: 0.35rem 0.5rem;
                font-size: 0.7rem;
                height: 34px;
            }

            .section-title {
                font-size: 1.2rem;
            }

            .section-header p {
                font-size: 0.8rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
            const forms = document.querySelectorAll('.add-to-cart-form');

            // Initialize tooltips with custom options
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    placement: 'auto',
                    html: true,
                    container: 'body',
                    delay: {
                        show: 200,
                        hide: 100
                    },
                    boundary: 'window'
                });
            });

            // Prevent form submission and use JavaScript instead
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (form.querySelector('.add-to-cart-btn')) {
                        e.preventDefault();
                        const button = form.querySelector('.add-to-cart-btn');
                        const bookId = button.dataset.bookId;

                        // Create and submit a form to add to cart
                        if (bookId) {
                            const dynamicForm = document.createElement('form');
                            dynamicForm.method = 'POST';
                            dynamicForm.action = '{{ route('add.to.cart') }}';

                            // Add CSRF token
                            const csrfToken = document.createElement('input');
                            csrfToken.type = 'hidden';
                            csrfToken.name = '_token';
                            csrfToken.value = document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content');
                            dynamicForm.appendChild(csrfToken);

                            // Add user ID
                            const userIdInput = document.createElement('input');
                            userIdInput.type = 'hidden';
                            userIdInput.name = 'user_id';
                            userIdInput.value = '{{ Auth::user()->userID }}';
                            dynamicForm.appendChild(userIdInput);

                            // Add book ID
                            const bookIdInput = document.createElement('input');
                            bookIdInput.type = 'hidden';
                            bookIdInput.name = 'book_id';
                            bookIdInput.value = bookId;
                            dynamicForm.appendChild(bookIdInput);

                            // Append to body and submit
                            document.body.appendChild(dynamicForm);

                            button.innerHTML =
                                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding...';
                            button.disabled = true;

                            dynamicForm.submit();
                        } else {
                            console.error('Book ID not found');
                            button.innerHTML = '<i class="bi bi-exclamation-triangle"></i> Error';
                            setTimeout(() => {
                                button.innerHTML =
                                    '<i class="bi bi-cart-plus me-2"></i>Add to Cart';
                                button.disabled = false;
                            }, 2000);
                        }
                    }
                });
            });

            // Prevent tooltips from interfering with buttons
            document.querySelectorAll('.book-card .btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });

            // Sort functionality (placeholder - would need backend implementation)
            document.querySelector('.sort-select')?.addEventListener('change', function() {
                console.log(`Sorting by: ${this.value}`);
                // TODO: Implement sorting functionality
            });
        });
    </script>
@endsection
