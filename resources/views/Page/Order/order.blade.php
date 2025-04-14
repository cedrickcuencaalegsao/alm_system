<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookHaven | My Orders</title>
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

        .order-tracker {
            margin-bottom: 3rem;
        }

        .tracker-wrapper {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .progress-track {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            padding: 0 40px;
        }

        .progress-track::before {
            content: '';
            position: absolute;
            top: 25px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #e9ecef;
            z-index: 1;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            background-color: white;
            padding: 0 20px;
        }

        .step .icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            color: #6c757d;
            font-size: 1.2rem;
        }

        .step.active .icon {
            background-color: #8B4513;
            color: white;
        }

        .step .text {
            font-size: 0.85rem;
            color: #6c757d;
            font-weight: 500;
        }

        .step.active .text {
            color: #8B4513;
        }

        .order-item {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: transform 0.2s;
        }

        .order-item:hover {
            transform: translateY(-2px);
        }

        .order-item img {
            width: 60px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        .badge {
            padding: 0.5rem 1rem;
            font-weight: 500;
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

        .current-status .badge {
            background-color: #8B4513;
            padding: 0.5rem 1.5rem;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Back to Home Button -->
        <div class="mb-4">
            <a href="/" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-2"></i>Back to Home
            </a>
        </div>

        <!-- Order Tracker Section -->
        <div class="order-tracker">
            <h4 class="mb-4">Track Your Current Order</h4>
            <div class="tracker-wrapper">
                <div class="progress-track">
                    <div class="step active">
                        <span class="icon"><i class="bi bi-check-circle-fill"></i></span>
                        <span class="text">Order Placed</span>
                    </div>
                    <div class="step active">
                        <span class="icon"><i class="bi bi-box-seam"></i></span>
                        <span class="text">Processing</span>
                    </div>
                    <div class="step">
                        <span class="icon"><i class="bi bi-truck"></i></span>
                        <span class="text">Shipped</span>
                    </div>
                    <div class="step">
                        <span class="icon"><i class="bi bi-house-check"></i></span>
                        <span class="text">Delivered</span>
                    </div>
                </div>
                <div class="current-status mt-3 text-center">
                    <span class="badge">Processing</span>
                    <p class="text-muted small mt-2">Estimated delivery: 3-5 business days</p>
                </div>
            </div>
        </div>

        <!-- Recent Orders Section -->
        <div class="recent-orders">
            <h4 class="mb-4">Recent Orders</h4>
            <div class="orders-list">
                <!-- Sample Order Items -->
                <div class="order-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Order #12345</h6>
                            <p class="text-muted mb-0 small">Placed on Jan 15, 2024</p>
                        </div>
                        <span class="badge bg-success">Delivered</span>
                    </div>
                    <hr>
                    <div class="order-details">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/60x80" alt="Book cover" class="me-3">
                                    <div>
                                        <h6 class="mb-1">The Great Gatsby</h6>
                                        <p class="mb-0 text-muted small">Quantity: 1</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <h6 class="mb-1">$24.99</h6>
                                <button class="btn btn-sm btn-outline-primary">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Order #12344</h6>
                            <p class="text-muted mb-0 small">Placed on Jan 10, 2024</p>
                        </div>
                        <span class="badge bg-success">Delivered</span>
                    </div>
                    <hr>
                    <div class="order-details">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/60x80" alt="Book cover" class="me-3">
                                    <div>
                                        <h6 class="mb-1">1984</h6>
                                        <p class="mb-0 text-muted small">Quantity: 2</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <h6 class="mb-1">$39.98</h6>
                                <button class="btn btn-sm btn-outline-primary">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
