<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookHaven | checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
@include('shared.css.checkout')
<body>
    <div class="container">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="/" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-2"></i>Back to Home
            </a>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Checkout</h4>
        </div>

        <div class="row">
            <!-- Left Column - Book Details -->
            <div class="col-lg-8 mb-4">
                <div class="checkout-card">
                    <h5 class="section-title">Book Details</h5>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ route('login.image') }}" alt="{{ $book->getBookName() }}" class="book-img">
                        </div>
                        <div class="col-md-8">
                            <div class="book-info-item">
                                <span class="book-info-label">Title:</span>
                                <span>{{ $book->getBookName() }}</span>
                            </div>
                            <div class="book-info-item">
                                <span class="book-info-label">Author:</span>
                                <span>{{ $book->getAuthor() }}</span>
                            </div>
                            <div class="book-info-item">
                                <span class="book-info-label">Category:</span>
                                <span>{{ $book->getCategory() }}</span>
                            </div>
                            <div class="book-info-item">
                                <span class="book-info-label">Overview:</span>
                                <p class="mt-1">{{ $book->getBookDetails() }}</p>
                            </div>

                            <div class="mt-3">
                                <span class="book-info-label me-3">Quantity:</span>
                                <div class="qty-control">
                                    <button type="button" class="qty-btn decrease-qty"
                                        onclick="updateQuantity(-1)">-</button>
                                    <input type="number" id="quantity" class="qty-input" value="1" min="1"
                                        max="10" readonly>
                                    <button type="button" class="qty-btn increase-qty"
                                        onclick="updateQuantity(1)">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cash-delivery-badge">
                        <i class="bi bi-cash-coin"></i> Cash on Delivery Only
                    </div>
                </div>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="col-lg-4">
                <div class="order-summary">
                    <h5 class="section-title">Order Summary</h5>
                    <div class="order-items">
                        <div class="order-item">
                            <img src="{{ route('login.image') }}" alt="Book cover">
                            <div class="order-item-details">
                                <h6 class="order-item-title">{{ $book->getBookName() }}</h6>
                                <p class="mb-1 text-muted">{{ $book->getAuthor() }}</p>
                                <div class="d-flex justify-content-between">
                                    <span>Qty: <span id="summary-qty">1</span></span>
                                    <span class="fw-bold">${{ $book->getPrice() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span id="subtotal">${{ $book->getPrice() }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Tax</span>
                            <span id="tax">${{ number_format($book->getPrice() * 0.1, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold"
                                id="total">${{ number_format($book->getPrice() + $book->getPrice() * 0.1, 2) }}</span>
                        </div>
                    </div>

                    <form action="{{ route('checkout.item.directly') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->getBookID() }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->userID }}">
                        <input type="hidden" name="quantity" id="form-quantity" value="1">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-credit-card me-2"></i>Checkout Now
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @include('shared.js.checkout')
</body>

</html>
