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
                                <img src="{{ route('book.image', $book->getImage() ?? 'default.jpg') }}" class="card-img-top"
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
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($books['allBooks'] as $book)
                    <div class="col">
                        <div class="card book-card h-100" data-bs-toggle="tooltip" data-bs-html="true"
                            title="<div class='tooltip-content'><p><strong>Author:</strong> {{ $book->getAuthor() }}</p><p><strong>Details:</strong> {{ Str::limit($book->getBookDetails(), 150) }}</p><p><strong>Price:</strong> ₱{{ number_format($book->getPrice(), 2) }}</p><p><strong>Stock:</strong> {{ $book->getStock() }}</p></div>">
                            <div class="book-image-wrapper">
                                <img src="{{ route('book.image', $book->getImage() ?? 'default.jpg') }}" class="card-img-top"
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
                                    <img src="{{ route('book.image', $book->getImage() ?? 'default.jpg') }}" class="card-img-top"
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

    <!-- Include JavaScript and CSS -->
    @include('shared.js.home')
    @include('shared.css.home')
@endsection
