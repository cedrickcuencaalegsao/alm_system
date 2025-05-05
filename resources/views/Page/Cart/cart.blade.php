<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookHaven | Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
@include('shared.css.cart')
<body>
    <div class="container">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="/" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-2"></i>Back to Home
            </a>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Shopping Cart</h4>
            <span class="text-muted">{{ count($carts) }} items</span>
        </div>

        <form id="checkout-form" method="POST" action="{{ route('checkout.multiple.items') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->userID }}">
            <div class="row">
                <!-- Cart Items -->
                <div class="col-md-6">
                    @foreach ($carts as $cart)
                        <div class="cart-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex">
                                    <div class="form-check me-3">
                                        <input class="form-check-input item-checkbox" type="checkbox"
                                            name="selected_items[]" value="{{ $cart->getCartID() }}" checked>
                                        <input type="hidden" name="book_id[{{ $cart->getCartID() }}]"
                                            value="{{ $cart->getBookID() }}">
                                    </div>
                                    <img src="{{ route('book.image', $cart->getImage() ?? 'default.jpg') }}" alt="Book cover" class="me-3">
                                    <div>
                                        <h6 class="mb-1">{{ $cart->getBookName() }}</h6>
                                        <p class="text-muted small mb-2">{{ $cart->getAuthor() }} -
                                            {{ $cart->getBookCategory() }}</p>
                                            <div class="quantity-control">
                                                <button type="button" class="quantity-btn decrease" disabled>-</button>
                                                <input type="number"
                                                    class="quantity-input"
                                                    name="quantity[{{ $cart->getCartID() }}]"
                                                    value="1"
                                                    min="1"
                                                    max="{{ $cart->getStocks() }}"
                                                    data-max-stock="{{ $cart->getStocks() }}"
                                                    readonly>
                                                <button type="button"
                                                    class="quantity-btn increase"
                                                    {{ 1 >= $cart->getStocks() ? 'disabled' : '' }}>+</button>
                                            </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="mb-2">{{ $cart->getPrice() }}</h6>
                                    <input type="hidden" name="price[{{ $cart->getCartID() }}]"
                                        value="{{ $cart->getPrice() }}">
                                    <form method="POST" action="{{ route('remove.from.cart', $cart->getCartID()) }}"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="delete-btn">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="col-md-6">
                    <div class="order-summary">
                        <h5 class="mb-4">Order Summary</h5>
                        <div class="mb-3">
                            <div id="item-calculations">
                                <!-- Individual item calculations will be inserted here -->
                            </div>
                            <div class="d-flex justify-content-between my-3">
                                <span class="text-muted">Shipping</span>
                                <span id="shipping-cost">$5.00</span>
                                <input type="hidden" name="shipping_cost" value="5.00">
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total</span>
                                <span class="fw-bold" id="order-total">$0.00</span>
                                <input type="hidden" name="order_total" id="order-total-input" value="0.00">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-credit-card me-2"></i>Checkout Now
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @include('shared.js.cart')
</body>

</html>
