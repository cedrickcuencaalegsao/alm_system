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
            --primary-dark: #5D2906;
            --primary-very-light: #D2B48C;
            --secondary: #FDF5E6;
            --text-dark: #4A3728;
            --text-muted: #8D7B6C;
            --shadow: 0 4px 12px rgba(139, 69, 19, 0.15);
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
            background-color: transparent;
        }

        .back-btn:hover,
        .back-btn:focus {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
            box-shadow: var(--shadow);
        }

        .section-title {
            font-weight: 700;
            color: var(--primary-dark);
            font-size: 1.6rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
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
            border-left: 5px solid var(--primary);
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

        .orders-list .row {
            margin-right: -12px;
            margin-left: -12px;
        }

        .orders-list .col {
            padding-right: 12px;
            padding-left: 12px;
        }

        .order-item {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
            border-left: 5px solid var(--primary);
            overflow: hidden;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .order-item:before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 120px;
            height: 120px;
            background-color: var(--primary-very-light);
            opacity: 0.15;
            border-radius: 0 0 0 120px;
        }

        .order-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(139, 69, 19, 0.2);
        }

        .order-item img {
            width: 75px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            border: 2px solid var(--primary-very-light);
        }

        .badge {
            padding: 0.5rem 1.15rem;
            font-weight: 600;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .badge-success {
            background-color: #2E7D32;
        }

        .badge-processing {
            background-color: #FF8F00;
            color: #212529;
        }

        .badge-delivering {
            background-color: #1976D2;
        }

        .badge-pending {
            background-color: #757575;
        }

        .badge i {
            font-size: 0.9rem;
        }

        .track-btn {
            color: var(--primary);
            border-color: var(--primary);
            border-radius: 50px;
            padding: 0.4rem 1.25rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .track-btn:hover,
        .track-btn:focus {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
            box-shadow: var(--shadow);
        }

        .order-details {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .order-detail-wrapper {
            display: flex;
            gap: 1.25rem;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .order-detail-info {
            flex-grow: 1;
        }

        .order-detail-info h6 {
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: var(--primary-dark);
            font-size: 1.05rem;
        }

        .order-price {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            position: relative;
        }

        .order-price:after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: var(--primary-light);
            border-radius: 2px;
        }

        .order-actions {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            color: var(--primary-dark);
        }

        .modal-content {
            border-radius: var(--radius);
            border: none;
            background-color: var(--secondary);
        }

        .modal-header {
            border-bottom: none;
            padding: 1.5rem 1.5rem 0.5rem;
            background-color: white;
            border-radius: var(--radius) var(--radius) 0 0;
        }

        .modal-footer {
            border-top: none;
            padding: 0.5rem 1.5rem 1.5rem;
            background-color: white;
            border-radius: 0 0 var(--radius) var(--radius);
        }

        .modal-body {
            padding: 1.5rem;
            background-color: white;
        }

        .modal-title {
            font-weight: 700;
            color: var(--primary-dark);
        }

        .current-status {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem 0;
            background-color: var(--secondary);
            border-radius: var(--radius);
        }

        .current-status .badge {
            font-size: 0.95rem;
            padding: 0.6rem 1.5rem;
            margin-bottom: 0.5rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border-left: 5px solid var(--primary);
        }

        .empty-state i {
            font-size: 3.5rem;
            color: var(--primary-light);
            margin-bottom: 1.5rem;
        }

        .empty-state h5 {
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary-dark);
        }

        /* Improved responsive layout */
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
                align-items: center;
                text-align: center;
            }

            .order-detail-info {
                width: 100%;
                margin-top: 1rem;
            }

            .order-actions {
                flex-direction: column;
                gap: 1rem;
                align-items: center;
            }

            .order-price {
                margin-bottom: 0;
            }

            .order-price:after {
                left: 50%;
                transform: translateX(-50%);
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
                @if (isset($sales) && count($sales) > 0)
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @foreach ($sales as $index => $sale)
                            <div class="col">
                                <div class="order-item">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h5 class="mb-1">Order #{{ $sale->getSalesID() }}</h5>
                                            <p class="text-muted mb-0">Placed on
                                                {{ date('M d, Y', strtotime($sale->getCreatedAt())) }}</p>
                                        </div>
                                        <span
                                            class="badge badge-{{ $sale->getStatus() === 'delivered' ? 'success' : ($sale->getStatus() === 'processing' ? 'processing' : ($sale->getStatus() === 'delivering' ? 'delivering' : 'pending')) }}">
                                            @if ($sale->getStatus() === 'delivered')
                                                <i class="bi bi-check-circle"></i>
                                            @elseif ($sale->getStatus() === 'processing')
                                                <i class="bi bi-gear-fill"></i>
                                            @elseif ($sale->getStatus() === 'delivering')
                                                <i class="bi bi-truck"></i>
                                            @else
                                                <i class="bi bi-clock-history"></i>
                                            @endif
                                            {{ ucfirst($sale->getStatus()) }}
                                        </span>
                                    </div>
                                    <hr>
                                    <div class="order-details">
                                        <div class="order-detail-wrapper">
                                            <img src="#" alt="{{ $sale->getBookName() }} cover">
                                            <div class="order-detail-info">
                                                <h6>{{ $sale->getBookName() }}</h6>
                                                <p class="mb-0 text-muted">Quantity: {{ $sale->getQuantity() }}</p>
                                                <p class="mb-0 text-muted">Author: {{ $sale->getAuthor() }}</p>
                                                <p class="mb-0 text-muted">Category: {{ $sale->getBookCategory() }}</p>
                                            </div>
                                        </div>
                                        <div class="order-actions">
                                            <div class="order-price">${{ number_format($sale->getTotalSales(), 2) }}
                                            </div>
                                            <button class="btn track-btn" data-bs-toggle="modal"
                                                data-bs-target="#trackModal{{ $sale->getId() }}">
                                                <i class="bi bi-geo-alt"></i>Track Order
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-bag-x"></i>
                        <h5>No Orders Found</h5>
                        <p class="text-muted">You haven't placed any orders yet.</p>
                        <a href="/home" class="btn back-btn mt-3">Start Shopping</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- {{ dd($sales) }} --}}

    <!-- Overall Order Progress Section -->
    @if (isset($sales) && count($sales) > 0)
        <div class="container order-tracker mt-4 mb-5">
            <h2 class="section-title">Order Progress</h2>
            <div class="tracker-wrapper">
                <div class="progress-track">
                    <div class="step active">
                        <span class="icon"><i class="bi bi-check-circle-fill"></i></span>
                        <span class="text">Orders Placed</span>
                    </div>
                    <div
                        class="step {{ collect($sales)->contains(function ($sale) {return $sale->getStatus() === 'processing';})? 'active': '' }}">
                        <span class="icon"><i class="bi bi-box-seam"></i></span>
                        <span class="text">Processing</span>
                    </div>
                    <div
                        class="step {{ collect($sales)->contains(function ($sale) {return $sale->getStatus() === 'delivering';})? 'active': '' }}">
                        <span class="icon"><i class="bi bi-truck"></i></span>
                        <span class="text">Delivering</span>
                    </div>
                    <div
                        class="step {{ collect($sales)->contains(function ($sale) {return $sale->getStatus() === 'delivered';})? 'active': '' }}">
                        <span class="icon"><i class="bi bi-house-check"></i></span>
                        <span class="text">Delivered</span>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <p class="text-muted">This tracker shows the status of your most recent orders</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Order Tracking Modals -->
    @if (isset($sales) && count($sales) > 0)
        @foreach ($sales as $index => $sale)
            <div class="modal fade" id="trackModal{{ $sale->getId() }}" tabindex="-1"
                aria-labelledby="trackModalLabel{{ $sale->getId() }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="trackModalLabel{{ $sale->getId() }}">Track Order
                                #{{ $sale->getSalesID() }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="progress-track">
                                <div class="step active">
                                    <span class="icon"><i class="bi bi-check-circle-fill"></i></span>
                                    <span class="text">Order Placed</span>
                                </div>
                                <div
                                    class="step {{ in_array($sale->getStatus(), ['processing', 'delivering', 'delivered']) ? 'active' : '' }}">
                                    <span class="icon"><i class="bi bi-box-seam"></i></span>
                                    <span class="text">Processing</span>
                                </div>
                                <div
                                    class="step {{ in_array($sale->getStatus(), ['delivering', 'delivered']) ? 'active' : '' }}">
                                    <span class="icon"><i class="bi bi-truck"></i></span>
                                    <span class="text">Delivering</span>
                                </div>
                                <div class="step {{ $sale->getStatus() === 'delivered' ? 'active' : '' }}">
                                    <span class="icon"><i class="bi bi-house-check"></i></span>
                                    <span class="text">Delivered</span>
                                </div>
                            </div>
                            <div class="current-status mt-3 text-center">

                                <span
                                    class="badge badge-{{ $sale->getStatus() === 'delivered' ? 'success' : ($sale->getStatus() === 'processing' ? 'processing' : ($sale->getStatus() === 'delivering' ? 'delivering' : 'pending')) }}">
                                    @if ($sale->getStatus() === 'delivered')
                                        <i class="bi bi-check-circle"></i>
                                    @elseif ($sale->getStatus() === 'processing')
                                        <i class="bi bi-gear-fill"></i>
                                    @elseif ($sale->getStatus() === 'delivering')
                                        <i class="bi bi-truck"></i>
                                    @else
                                        <i class="bi bi-clock-history"></i>
                                    @endif
                                    {{ ucfirst($sale->getStatus()) }}
                                </span>
                                @if ($sale->getStatus() === 'pending')
                                    <p class="text-muted small mt-2">Your order is being reviewed</p>
                                @elseif($sale->getStatus() === 'processing')
                                    <p class="text-muted small mt-2">Estimated delivery:
                                        {{ date('M d, Y', strtotime($sale->getCreatedAt() . ' + 7 days')) }}</p>
                                @elseif($sale->getStatus() === 'delivering')
                                    <p class="text-muted small mt-2">Estimated delivery:
                                        {{ date('M d, Y', strtotime($sale->getCreatedAt() . ' + 3 days')) }}</p>
                                @elseif($sale->getStatus() === 'delivered')
                                    <p class="text-muted small mt-2">Delivered on
                                        {{ date('M d, Y', strtotime($sale->getUpdatedAt())) }}</p>
                                @endif
                            </div>
                            <div class="tracking-details mt-4">
                                <h6>Tracking History</h6>
                                <div class="tracking-timeline mt-4">
                                    @if ($sale->getStatus() === 'delivered')
                                        <div class="timeline-item">
                                            <div class="timeline-date">
                                                {{ date('M d, Y', strtotime($sale->getUpdatedAt())) }}</div>
                                            <div class="timeline-content">
                                                <strong>Delivered</strong>
                                                <p class="mb-0 small">Package was delivered at the doorstep</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="timeline-date">
                                                {{ date('M d, Y', strtotime($sale->getCreatedAt() . ' + 4 days')) }}
                                            </div>
                                            <div class="timeline-content">
                                                <strong>Out for Delivery</strong>
                                                <p class="mb-0 small">Package is out for delivery</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="timeline-date">
                                                {{ date('M d, Y', strtotime($sale->getCreatedAt() . ' + 2 days')) }}
                                            </div>
                                            <div class="timeline-content">
                                                <strong>Delivering</strong>
                                                <p class="mb-0 small">Package has been shipped</p>
                                            </div>
                                        </div>
                                    @elseif($sale->getStatus() === 'delivering')
                                        <div class="timeline-item">
                                            <div class="timeline-date">
                                                {{ date('M d, Y', strtotime($sale->getUpdatedAt())) }}</div>
                                            <div class="timeline-content">
                                                <strong>Delivering</strong>
                                                <p class="mb-0 small">Package has been shipped</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="timeline-date">
                                                {{ date('M d, Y', strtotime($sale->getCreatedAt() . ' + 1 day')) }}
                                            </div>
                                            <div class="timeline-content">
                                                <strong>Processing</strong>
                                                <p class="mb-0 small">Your order is being prepared for shipping</p>
                                            </div>
                                        </div>
                                    @elseif($sale->getStatus() === 'processing')
                                        <div class="timeline-item">
                                            <div class="timeline-date">
                                                {{ date('M d, Y', strtotime($sale->getUpdatedAt())) }}</div>
                                            <div class="timeline-content">
                                                <strong>Processing</strong>
                                                <p class="mb-0 small">Your order is being prepared for shipping</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="timeline-item">
                                        <div class="timeline-date">
                                            {{ date('M d, Y', strtotime($sale->getCreatedAt())) }}
                                        </div>
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
        @endforeach
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
