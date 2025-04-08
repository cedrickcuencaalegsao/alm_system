@extends('shared.layout.authenticated')
@section('title', 'Home')

@section('content')
    <section class="py-5" id="books">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach ($books as $book)
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
                                <div class="price-section d-flex align-items-center mb-3">
                                    <span class="price-badge">
                                        @if ($book->getPrice())
                                            ${{ number_format($book->getPrice(), 2) }}
                                        @else
                                            Price not set
                                        @endif
                                    </span>
                                </div>
                                <div class="mt-auto">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-outline-primary add-to-cart-btn"
                                            data-book-id="{{ $book->getBookID() }}">
                                            <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                        </button>
                                        <button class="btn btn-primary buy-now-btn">
                                            <i class="bi bi-lightning-fill me-2"></i>Buy Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

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
            height: 1.2rem;
            margin-bottom: 0.3rem;
            font-size: 1rem;
        }


        .book-description {
            height: 3rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .card-body {
            padding: 1rem;
        }

        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .price-section {
            margin-top: auto;
        }

        .price-badge {
            background-color: #8B4513;
            color: white;
            padding: 0.3rem 0.8rem;
            font-size: 0.875rem;
            border-radius: 20px;
        }

        .add-to-cart-btn {
            border-color: #8B4513;
            color: #8B4513;
            transition: all 0.3s ease;
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
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add to Cart functionality
            const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const bookId = this.dataset.bookId;
                    // Add loading state
                    this.innerHTML =
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding...';
                    this.disabled = true;

                    // Simulate API call
                    setTimeout(() => {
                        this.innerHTML = '<i class="bi bi-check2"></i> Added to Cart';
                        this.classList.add('btn-success');
                        setTimeout(() => {
                            this.innerHTML =
                                '<i class="bi bi-cart-plus me-2"></i>Add to Cart';
                            this.classList.remove('btn-success');
                            this.disabled = false;
                        }, 2000);
                    }, 1000);
                });
            });

            // Buy Now functionality
            const buyNowButtons = document.querySelectorAll('.buy-now-btn');
            buyNowButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Redirect to checkout page
                    window.location.href = '/checkout';
                });
            });
        });
    </script>
@endsection
