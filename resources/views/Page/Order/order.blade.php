<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookHaven | My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
@include('shared.css.userOrder')

<body>
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <a href="/" class="btn back-btn">
                <i class="bi bi-arrow-left me-2"></i>Back to Home
            </a>
            <h1 class="section-title mb-0">My Orders</h1>
        </div>

        <!-- Category Buttons -->
        <div class="category-buttons mb-4">
            <div class="d-flex flex-wrap gap-2" id="filter-buttons-container">
                <button class="btn filter-btn" data-filter="all" id="filter-all">
                    <i class="bi bi-grid-3x3-gap me-2"></i>All Orders
                </button>
                <button class="btn filter-btn" data-filter="pending" id="filter-pending">
                    <i class="bi bi-clock-history me-2"></i>Pending
                </button>
                <button class="btn filter-btn" data-filter="processing" id="filter-processing">
                    <i class="bi bi-gear-fill me-2"></i>Processing
                </button>
                <button class="btn filter-btn" data-filter="delivering" id="filter-delivering">
                    <i class="bi bi-truck me-2"></i>Delivering
                </button>
                <button class="btn filter-btn" data-filter="delivered" id="filter-delivered">
                    <i class="bi bi-check-circle me-2"></i>Delivered
                </button>
            </div>
        </div>

        <!-- Recent Orders Section -->
        <div class="recent-orders">
            <div class="orders-list">
                @if (isset($sales) && count($sales) > 0)
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @foreach ($sales as $index => $sale)
                            <div class="col order-item-col" data-status="{{ $sale->getStatus() }}">
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
                                            <img src="{{ route('book.image', $sale->getBookImage() ?? 'default.jpg') }}"
                                                alt="{{ $sale->getBookName() }} cover">
                                            <div class="order-detail-info">
                                                <h6>{{ $sale->getBookName() }}</h6>
                                                <p class="mb-0 text-muted">Quantity: {{ $sale->getQuantity() }}</p>
                                                <p class="mb-0 text-muted">Author: {{ $sale->getAuthor() }}</p>
                                                <p class="mb-0 text-muted">Category: {{ $sale->getBookCategory() }}</p>
                                            </div>
                                        </div>
                                        // api update.order.status

                                        <div class="order-actions">
                                            <div class="order-price">${{ number_format($sale->getTotalSales(), 2) }}
                                            </div>
                                            @if ($sale->getStatus() === 'processing')
                                                <form action="{{route('mark.as.delivered')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="saleID"
                                                        value="{{ $sale->getSalesID() }}">
                                                    <input type="hidden" name="status" value="delivered">
                                                    <button type="submit" class="btn delivered-btn">
                                                        <i class="bi bi-check2-circle"></i>Mark As Delivered
                                                    </button>
                                                </form>
                                            @endif
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
                    <div class="empty-state" id="empty-state"
                        style="{{ isset($sales) && count($sales) > 0 ? 'display: none;' : '' }}">
                        <i class="bi bi-bag-x"></i>
                        <h5 id="empty-state-title">No Orders Found</h5>
                        <p class="text-muted" id="empty-state-message">You haven't placed any orders yet.</p>
                        <a href="/home" class="btn back-btn mt-3">Start Shopping</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
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
    @include('shared.js.userOrder')
</body>

</html>
