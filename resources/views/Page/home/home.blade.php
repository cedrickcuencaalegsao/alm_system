@extends('shared.layout.authenticated')
@section('title', 'Home')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <section class="py-5" id="best-selling">
        <div class="container">
            <h2 class="mb-4">Best Selling Books</h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                @foreach ($books['bestSelling'] as $book)
                    <div class="col">
                        <div class="card book-card h-100">
                            <div class="book-image-wrapper">
                                <img src="{{ route('login.image') }}" class="card-img-top" alt="Book Cover">
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
    <section class="py-4" id="all-books">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>All Books</h2>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                @foreach ($books['allBooks'] as $book)
                    <div class="col">
                        <div class="card book-card h-100">
                            <div class="book-image-wrapper">
                                <img src="{{ route('login.image') }}" class="card-img-top" alt="Book Cover">
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
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                    @foreach ($categoryBooks as $book)
                        <div class="col">
                            <div class="card book-card h-100">
                                <div class="book-image-wrapper">
                                    <img src="{{ route('login.image') }}" class="card-img-top" alt="Book Cover">
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
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-image-wrapper {
            height: 150px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .book-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 0.5rem;
            color: #2c3e50;
            height: auto;
            min-height: 2.6rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            white-space: normal;
            text-overflow: ellipsis;
        }

        .card-text.text-muted {
            font-size: 0.9rem;
            color: #666 !important;
            margin-bottom: 0.5rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
        }

        .book-description {
            font-size: 0.85rem;
            line-height: 1.4;
            color: #666;
            height: auto;
            min-height: 2.4rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
            margin-bottom: 0.75rem;
        }

        .card-body {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .price-badge {
            background-color: #8B4513;
            color: white;
            padding: 0.4rem 1rem;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 20px;
            display: inline-block;
        }

        .stock-badge {
            padding: 0.3rem 0.6rem;
            font-size: 0.75rem;
            border-radius: 20px;
            font-weight: 500;
            color: white;
        }

        .stock-low {
            background-color: #dc3545;
            border: none;
        }

        .stock-medium {
            background-color: #ffc107;
            border: none;
        }

        .stock-high {
            background-color: #28a745;
            border: none;
        }

        .text-truncate {
            max-width: 100%;
        }

        .price-badge {
            background-color: #8B4513;
            color: white;
            padding: 0.3rem 0.8rem;
            font-size: 0.875rem;
            border-radius: 20px;
        }

        .add-to-cart-btn,
        .buy-now-btn {
            border-color: #8B4513;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            height: 42px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            min-width: 150px;
            max-width: 100%;
            margin: 0 auto;
        }

        .add-to-cart-form {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .add-to-cart-btn {
            color: #8B4513;
        }

        .add-to-cart-btn:hover {
            background-color: #8B4513;
            border-color: #8B4513;
            color: white;
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

        .card-body {
            padding: 1.5rem;
        }

        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .book-card {
                margin-bottom: 1rem;
            }

            .book-image-wrapper {
                height: 180px;
            }

            .card-title {
                font-size: 0.95rem;
                min-height: 2.2rem;
            }

            .card-text.text-muted {
                font-size: 0.8rem;
            }

            .book-description {
                font-size: 0.75rem;
                min-height: 2rem;
            }

            .price-badge,
            .stock-badge {
                padding: 0.2rem 0.6rem;
                font-size: 0.75rem;
            }

            .add-to-cart-btn,
            .buy-now-btn {
                padding: 0.4rem 0.6rem;
                font-size: 0.85rem;
                height: 38px;
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
        }

        @media (max-width: 576px) {
            .book-image-wrapper {
                height: 160px;
            }

            .card-title {
                font-size: 0.9rem;
                min-height: 2rem;
            }

            .card-text.text-muted {
                font-size: 0.75rem;
            }

            .book-description {
                font-size: 0.7rem;
                min-height: 1.8rem;
            }

            .price-badge,
            .stock-badge {
                padding: 0.15rem 0.5rem;
                font-size: 0.7rem;
            }

            .add-to-cart-btn,
            .buy-now-btn {
                padding: 0.35rem 0.5rem;
                font-size: 0.75rem;
                height: 36px;
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
        });
    </script>
@endsection
