<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookHaven | Shopping Cart</title>
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

        .cart-item {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: transform 0.2s;
        }

        .cart-item:hover {
            transform: translateY(-2px);
        }

        .cart-item img {
            width: 80px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid #8B4513;
            border-radius: 5px;
            width: fit-content;
        }

        .quantity-btn {
            background: none;
            border: none;
            padding: 0.5rem 1rem;
            color: #8B4513;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            border: none;
            border-left: 1px solid #8B4513;
            border-right: 1px solid #8B4513;
            padding: 0.5rem;
        }

        .quantity-input:focus {
            outline: none;
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

        .order-summary {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            position: sticky;
            top: 2rem;
        }

        .form-check-input:checked {
            background-color: #8B4513;
            border-color: #8B4513;
        }

        .delete-btn {
            color: #dc3545;
            background: none;
            border: none;
            padding: 0.5rem;
            transition: color 0.2s;
        }

        .delete-btn:hover {
            color: #c82333;
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
            <h4 class="mb-0">Shopping Cart</h4>
            <span class="text-muted">{{ count($carts) }} items</span>
        </div>

        <div class="row">
            <!-- Cart Items -->
            <div class="col-md-8">
                @foreach ($carts as $cart)
                    <div class="cart-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" checked>
                                </div>
                                <img src="{{ route('login.image') }}" alt="Book cover" class="me-3">
                                <div>
                                    <h6 class="mb-1">{{ $cart->getBookName() }}</h6>
                                    <p class="text-muted small mb-2">{{ $cart->getAuthor() }} - {{ $cart->getBookCategory() }}</p>
                                    <div class="quantity-control">
                                        <button class="quantity-btn decrease">-</button>
                                        <input type="number" class="quantity-input" value="1" min="1">
                                        <button class="quantity-btn increase">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <h6 class="mb-2">{{ $cart->getPrice() }}</h6>
                                <button class="delete-btn">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="col-md-4">
                <div class="order-summary">
                    <h5 class="mb-4">Order Summary</h5>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Selected Items ({{ count($carts) }})</span>
                            <span>$64.97</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Shipping</span>
                            <span>$5.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Tax</span>
                            <span>$5.20</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold">$75.17</span>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100">
                        <i class="bi bi-credit-card me-2"></i>Checkout Now
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInputs = document.querySelectorAll('.quantity-input');
            const quantityButtons = document.querySelectorAll('.quantity-btn');
            const checkboxes = document.querySelectorAll('.form-check-input');

            // Update quantity
            function updateQuantity(input, change) {
                let value = parseInt(input.value) + change;
                if (value < 1) value = 1;
                input.value = value;
                updateOrderSummary();
            }

            // Event listeners for quantity buttons
            quantityButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('.quantity-input');
                    const change = this.classList.contains('increase') ? 1 : -1;
                    updateQuantity(input, change);
                });
            });

            // Event listeners for quantity inputs
            quantityInputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (this.value < 1) this.value = 1;
                    updateOrderSummary();
                });
            });

            // Event listeners for checkboxes
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateOrderSummary);
            });

            // Update order summary
            function updateOrderSummary() {
                // This would be implemented based on your actual cart logic
                console.log('Order summary updated');
            }
        });
    </script>
</body>

</html>
