<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookHaven | checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #FDF5E6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .btn-outline-primary {
            color: #8B4513;
            border-color: #8B4513;
        }

        .btn-outline-primary:hover {
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

        .section-title {
            font-weight: 500;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            color: #8B4513;
        }

        .checkout-card,
        .order-summary {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: transform 0.2s;
        }

        .checkout-card:hover {
            transform: translateY(-2px);
        }

        .book-img {
            width: 100%;
            max-width: 180px;
            height: auto;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .book-info-item {
            margin-bottom: 0.75rem;
        }

        .book-info-label {
            font-weight: 500;
            color: #8B4513;
        }

        .order-item {
            display: flex;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .order-item img {
            width: 80px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        .order-item-details {
            flex-grow: 1;
            margin-left: 1rem;
        }

        .order-item-title {
            color: #8B4513;
            font-weight: 500;
        }

        .order-total {
            font-weight: 500;
            margin-top: 1rem;
            display: flex;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid #f0f0f0;
            color: #8B4513;
        }

        .qty-control {
            display: flex;
            align-items: center;
            border: 1px solid #8B4513;
            border-radius: 5px;
            width: fit-content;
        }

        .qty-btn {
            background: none;
            border: none;
            padding: 0.5rem 1rem;
            color: #8B4513;
        }

        .qty-input {
            width: 50px;
            text-align: center;
            border: none;
            border-left: 1px solid #8B4513;
            border-right: 1px solid #8B4513;
            padding: 0.5rem;
        }

        .qty-input:focus {
            outline: none;
        }

        .cash-delivery-badge {
            background-color: rgba(139, 69, 19, 0.1);
            color: #8B4513;
            border-radius: 5px;
            padding: 0.75rem;
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cash-delivery-badge i {
            margin-right: 0.5rem;
        }

        @media (max-width: 767px) {
            .container {
                padding: 1rem;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
    </style>
</head>

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
                            <img src="https://via.placeholder.com/180x250" alt="{{ $book->getBookName() }}"
                                class="book-img">
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
                            <img src="https://via.placeholder.com/80x100" alt="Book cover">
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

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-credit-card me-2"></i>Complete Purchase
                    </button>

                    <div class="mt-3 text-center">
                        <small class="text-muted">
                            <i class="bi bi-shield-lock me-1"></i>Secure transaction
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateQuantity(change) {
            const quantityInput = document.getElementById('quantity');
            const currentQty = parseInt(quantityInput.value);
            const newQty = Math.max(1, Math.min(10, currentQty + change));

            if (newQty !== currentQty) {
                quantityInput.value = newQty;
                updateOrderSummary(newQty);
            }
        }

        function updateOrderSummary(qty) {
            // Update quantity in summary
            document.getElementById('summary-qty').textContent = qty;

            // Get book price
            const bookPrice = {{ $book->getPrice() }};

            // Calculate and update subtotal
            const subtotal = bookPrice * qty;
            document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);

            // Calculate and update tax
            const tax = subtotal * 0.1;
            document.getElementById('tax').textContent = '$' + tax.toFixed(2);

            // Calculate and update total
            const total = subtotal + tax;
            document.getElementById('total').textContent = '$' + total.toFixed(2);
        }
    </script>
</body>

</html>
