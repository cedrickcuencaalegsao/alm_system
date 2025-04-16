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
        :root {
            --primary: #8B4513;
            --primary-light: #A0522D;
            --secondary: #FDF5E6;
            --text-dark: #333;
            --text-muted: #6c757d;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --radius: 12px;
        }

        body {
            background-color: var(--secondary);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
            padding-bottom: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.5rem 1rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .back-btn {
            color: var(--primary);
            border-color: var(--primary);
            border-radius: 50px;
            padding: 0.5rem 1.25rem;
            transition: all 0.2s;
            font-weight: 500;
        }

        .back-btn:hover,
        .back-btn:focus {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
            box-shadow: var(--shadow);
        }

        .section-title {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary);
            border-radius: 3px;
        }

        .order-tracker {
            margin-bottom: 3rem;
        }

        .tracker-wrapper {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
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
            height: 3px;
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
            padding: 0 10px;
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
            color: var(--text-muted);
            font-size: 1.2rem;
            transition: all 0.3s;
        }

        .step.active .icon {
            background-color: var(--primary);
            color: white;
            transform: scale(1.1);
            box-shadow: 0 2px 8px rgba(139, 69, 19, 0.3);
        }

        .step .text {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
            text-align: center;
        }

        .step.active .text {
            color: var(--primary);
            font-weight: 600;
        }

        .order-item {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
            border-left: 4px solid var(--primary);
        }

        .order-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .order-item img {
            width: 65px;
            height: 90px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .badge {
            padding: 0.5rem 1rem;
            font-weight: 500;
            border-radius: 50px;
        }

        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-processing {
            background-color: #fff3cd;
            color: #856404;
        }

        .track-btn {
            color: var(--primary);
            border-color: var(--primary);
            border-radius: 50px;
            padding: 0.4rem 1rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .track-btn:hover,
        .track-btn:focus {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .order-detail-wrapper {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .order-detail-info h6 {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .order-price {
            font-weight: 600;
            color: var(--primary);
            font-size: 1.15rem;
            margin-bottom: 0.75rem;
        }

        .timeline-item {
            position: relative;
            padding-left: 28px;
            margin-bottom: 1.25rem;
        }

        .timeline-item:before {
            content: '';
            position: absolute;
            left: 0;
            top: 6px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: var(--primary);
        }

        .timeline-item:after {
            content: '';
            position: absolute;
            left: 5px;
            top: 18px;
            width: 2px;
            height: calc(100% + 14px);
            background-color: #e9ecef;
        }

        .timeline-item:last-child:after {
            display: none;
        }

        .timeline-date {
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--primary);
        }

        .timeline-content strong {
            display: block;
            margin-bottom: 0.25rem;
        }

        .modal-content {
            border-radius: var(--radius);
            border: none;
        }

        .modal-header {
            border-bottom: none;
            padding: 1.5rem 1.5rem 0.5rem;
        }

        .modal-footer {
            border-top: none;
            padding: 0.5rem 1.5rem 1.5rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-title {
            font-weight: 600;
            color: var(--text-dark);
        }

        .current-status {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem 0;
        }

        .current-status .badge {
            font-size: 0.95rem;
            padding: 0.6rem 1.5rem;
            margin-bottom: 0.5rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        .empty-state h5 {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        /* Responsive Styles */
        @media (max-width: 767px) {
            .container {
                padding: 1rem;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .progress-track {
                padding: 0 10px;
            }

            .step .text {
                font-size: 0.75rem;
            }

            .step .icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .order-detail-wrapper {
                flex-direction: column;
                align-items: flex-start;
            }

            .order-item {
                padding: 1.25rem;
            }

            .order-actions {
                margin-top: 1rem;
                display: flex;
                justify-content: space-between;
                width: 100%;
            }

            .timeline-item {
                padding-left: 24px;
            }
        }

        @media (max-width: 991px) {
            .modal-xl .modal-dialog {
                max-width: 95%;
                margin: 0.5rem auto;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <a href="/" class="btn back-btn">
                <i class="bi bi-arrow-left me-2"></i>Back to Home
            </a>
            <h1 class="section-title mb-0">My Orders</h1>
        </div>

        <!-- Recent Orders Section -->
        <div class="recent-orders">
            <div class="orders-list">
                <!-- Sample Order Items -->
                <div class="order-item">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-1">Order #12345</h5>
                            <p class="text-muted mb-0">Placed on Jan 15, 2024</p>
                        </div>
                        <span class="badge badge-success">Delivered</span>
                    </div>
                    <hr>
                    <div class="order-details">
                        <div class="row align-items-center">
                            <div class="col-md-8 col-sm-12 mb-3 mb-md-0">
                                <div class="order-detail-wrapper">
                                    <img src="https://via.placeholder.com/65x90" alt="Book cover" class="me-3">
                                    <div class="order-detail-info">
                                        <h6>The Great Gatsby</h6>
                                        <p class="mb-0 text-muted">Quantity: 1</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 d-flex justify-content-between align-items-center">
                                <div class="order-price">$24.99</div>
                                <button class="btn track-btn" data-bs-toggle="modal" data-bs-target="#trackModal12345">
                                    <i class="bi bi-geo-alt"></i>Track Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-item">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-1">Order #12344</h5>
                            <p class="text-muted mb-0">Placed on Jan 10, 2024</p>
                        </div>
                        <span class="badge badge-success">Delivered</span>
                    </div>
                    <hr>
                    <div class="order-details">
                        <div class="row align-items-center">
                            <div class="col-md-8 col-sm-12 mb-3 mb-md-0">
                                <div class="order-detail-wrapper">
                                    <img src="https://via.placeholder.com/65x90" alt="Book cover" class="me-3">
                                    <div class="order-detail-info">
                                        <h6>1984</h6>
                                        <p class="mb-0 text-muted">Quantity: 2</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 d-flex justify-content-between align-items-center">
                                <div class="order-price">$39.98</div>
                                <button class="btn track-btn" data-bs-toggle="modal" data-bs-target="#trackModal12344">
                                    <i class="bi bi-geo-alt"></i>Track Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Example of an In-Progress Order -->
                <div class="order-item">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-1">Order #12346</h5>
                            <p class="text-muted mb-0">Placed on Jan 22, 2024</p>
                        </div>
                        <span class="badge badge-processing">Processing</span>
                    </div>
                    <hr>
                    <div class="order-details">
                        <div class="row align-items-center">
                            <div class="col-md-8 col-sm-12 mb-3 mb-md-0">
                                <div class="order-detail-wrapper">
                                    <img src="https://via.placeholder.com/65x90" alt="Book cover" class="me-3">
                                    <div class="order-detail-info">
                                        <h6>To Kill a Mockingbird</h6>
                                        <p class="mb-0 text-muted">Quantity: 1</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 d-flex justify-content-between align-items-center">
                                <div class="order-price">$19.99</div>
                                <button class="btn track-btn" data-bs-toggle="modal" data-bs-target="#trackModal12346">
                                    <i class="bi bi-geo-alt"></i>Track Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty state (only shown when no orders) -->
                <!--
                <div class="empty-state">
                    <i class="bi bi-bag"></i>
                    <h5>No orders yet</h5>
                    <p class="text-muted">When you place an order, it will appear here</p>
                    <a href="/" class="btn back-btn mt-3">Browse Books</a>
                </div>
                -->
            </div>
        </div>
    </div>

    <!-- Order Tracking Modals -->
    <div class="modal fade" id="trackModal12345" tabindex="-1" aria-labelledby="trackModalLabel12345"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trackModalLabel12345">Track Order #12345</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="progress-track">
                        <div class="step active">
                            <span class="icon"><i class="bi bi-check-circle-fill"></i></span>
                            <span class="text">Order Placed</span>
                        </div>
                        <div class="step active">
                            <span class="icon"><i class="bi bi-box-seam"></i></span>
                            <span class="text">Processing</span>
                        </div>
                        <div class="step active">
                            <span class="icon"><i class="bi bi-truck"></i></span>
                            <span class="text">Shipped</span>
                        </div>
                        <div class="step active">
                            <span class="icon"><i class="bi bi-house-check"></i></span>
                            <span class="text">Delivered</span>
                        </div>
                    </div>
                    <div class="current-status mt-3 text-center">
                        <span class="badge badge-success">Delivered</span>
                        <p class="text-muted small mt-2">Delivered on Jan 20, 2024</p>
                    </div>
                    <div class="tracking-details mt-4">
                        <h6>Tracking History</h6>
                        <div class="tracking-timeline mt-4">
                            <div class="timeline-item">
                                <div class="timeline-date">Jan 20, 2024</div>
                                <div class="timeline-content">
                                    <strong>Delivered</strong>
                                    <p class="mb-0 small">Package was delivered at the doorstep</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">Jan 18, 2024</div>
                                <div class="timeline-content">
                                    <strong>Out for Delivery</strong>
                                    <p class="mb-0 small">Package is out for delivery</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">Jan 17, 2024</div>
                                <div class="timeline-content">
                                    <strong>Shipped</strong>
                                    <p class="mb-0 small">Package has been shipped</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">Jan 15, 2024</div>
                                <div class="timeline-content">
                                    <strong>Order Placed</strong>
                                    <p class="mb-0 small">Your order has been confirmed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="trackModal12344" tabindex="-1" aria-labelledby="trackModalLabel12344"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trackModalLabel12344">Track Order #12344</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="progress-track">
                        <div class="step active">
                            <span class="icon"><i class="bi bi-check-circle-fill"></i></span>
                            <span class="text">Order Placed</span>
                        </div>
                        <div class="step active">
                            <span class="icon"><i class="bi bi-box-seam"></i></span>
                            <span class="text">Processing</span>
                        </div>
                        <div class="step active">
                            <span class="icon"><i class="bi bi-truck"></i></span>
                            <span class="text">Shipped</span>
                        </div>
                        <div class="step active">
                            <span class="icon"><i class="bi bi-house-check"></i></span>
                            <span class="text">Delivered</span>
                        </div>
                    </div>
                    <div class="current-status mt-3 text-center">
                        <span class="badge badge-success">Delivered</span>
                        <p class="text-muted small mt-2">Delivered on Jan 15, 2024</p>
                    </div>
                    <div class="tracking-details mt-4">
                        <h6>Tracking History</h6>
                        <div class="tracking-timeline mt-4">
                            <div class="timeline-item">
                                <div class="timeline-date">Jan 15, 2024</div>
                                <div class="timeline-content">
                                    <strong>Delivered</strong>
                                    <p class="mb-0 small">Package was delivered at the doorstep</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">Jan 13, 2024</div>
                                <div class="timeline-content">
                                    <strong>Out for Delivery</strong>
                                    <p class="mb-0 small">Package is out for delivery</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">Jan 12, 2024</div>
                                <div class="timeline-content">
                                    <strong>Shipped</strong>
                                    <p class="mb-0 small">Package has been shipped</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">Jan 10, 2024</div>
                                <div class="timeline-content">
                                    <strong>Order Placed</strong>
                                    <p class="mb-0 small">Your order has been confirmed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Modal for the Processing Order -->
    <div class="modal fade" id="trackModal12346" tabindex="-1" aria-labelledby="trackModalLabel12346"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trackModalLabel12346">Track Order #12346</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                        <span class="badge badge-processing">Processing</span>
                        <p class="text-muted small mt-2">Estimated delivery: Jan 29, 2024</p>
                    </div>
                    <div class="tracking-details mt-4">
                        <h6>Tracking History</h6>
                        <div class="tracking-timeline mt-4">
                            <div class="timeline-item">
                                <div class="timeline-date">Jan 23, 2024</div>
                                <div class="timeline-content">
                                    <strong>Processing</strong>
                                    <p class="mb-0 small">Your order is being prepared for shipping</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">Jan 22, 2024</div>
                                <div class="timeline-content">
                                    <strong>Order Placed</strong>
                                    <p class="mb-0 small">Your order has been confirmed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

</html>
