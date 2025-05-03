<style>
    .book-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        height: 100%;
        background-color: #fff;
        max-width: 280px;
        margin: 0 auto;
        cursor: pointer;
    }

    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .book-image-wrapper {
        height: 160px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background-color: #f8f9fa;
    }

    .book-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-title {
        font-size: 0.95rem;
        font-weight: 600;
        line-height: 1.3;
        margin-bottom: 0.5rem;
        color: #2c3e50;
        min-height: 2.4rem;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        white-space: normal;
        text-overflow: ellipsis;
    }

    .card-text.text-muted {
        font-size: 0.85rem;
        color: #666 !important;
        margin-bottom: 0.5rem;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        text-overflow: ellipsis;
    }

    .book-description {
        font-size: 0.8rem;
        line-height: 1.4;
        color: #666;
        min-height: 2.2rem;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        text-overflow: ellipsis;
        margin-bottom: 0.75rem;
    }

    .card-body {
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .price-badge {
        background-color: #8B4513;
        color: white;
        padding: 0.3rem 0.8rem;
        font-size: 0.85rem;
        font-weight: 500;
        border-radius: 20px;
        display: inline-block;
        box-shadow: 0 2px 5px rgba(139, 69, 19, 0.2);
    }

    .stock-badge {
        padding: 0.25rem 0.6rem;
        font-size: 0.7rem;
        border-radius: 20px;
        font-weight: 500;
        color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .stock-low {
        background-color: #dc3545;
        border: none;
    }

    .stock-medium {
        background-color: #ffc107;
        color: #212529;
        border: none;
    }

    .stock-high {
        background-color: #28a745;
        border: none;
    }

    .text-truncate {
        max-width: 100%;
    }

    .add-to-cart-btn,
    .buy-now-btn {
        border-color: #8B4513;
        padding: 0.5rem 0.75rem;
        font-size: 0.8rem;
        height: 38px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        min-width: 120px;
        max-width: 100%;
        margin: 0 auto;
        border-radius: 5px;
    }

    .add-to-cart-form {
        width: 100%;
        margin-bottom: 0.4rem;
    }

    .add-to-cart-btn {
        color: #8B4513;
        background-color: white;
    }

    .add-to-cart-btn:hover {
        background-color: #8B4513;
        border-color: #8B4513;
        color: white;
    }

    .add-to-cart-btn:disabled {
        background-color: #e9ecef;
        border-color: #ced4da;
        color: #6c757d;
        cursor: not-allowed;
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

    .buy-now-btn[aria-disabled=true] {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
        opacity: 0.65;
        pointer-events: none;
    }

    .tooltip {
        position: absolute;
        z-index: 1070;
        display: block;
        margin: 0;
        font-family: var(--bs-font-sans-serif);
        font-style: normal;
        font-weight: 400;
        line-height: 1.5;
        text-align: left;
        text-decoration: none;
        text-shadow: none;
        text-transform: none;
        letter-spacing: normal;
        word-break: normal;
        word-spacing: normal;
        white-space: normal;
        line-break: auto;
        font-size: 0.875rem;
        word-wrap: break-word;
        opacity: 0;
    }

    .tooltip.show {
        opacity: 0.9;
    }

    .tooltip .tooltip-inner {
        max-width: 280px;
        padding: 0.5rem 0.8rem;
        color: #fff;
        text-align: left;
        background-color: #333;
        border-radius: 0.25rem;
    }

    .tooltip-content {
        padding: 5px;
        font-size: 0.8rem;
    }

    .tooltip-content p {
        margin-bottom: 0.5rem;
    }

    .tooltip-content p:last-child {
        margin-bottom: 0;
    }

    .filter-controls {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .sort-select {
        min-width: 180px;
        border-color: #dee2e6;
        color: #495057;
        font-size: 0.9rem;
    }

    .section-header {
        position: relative;
        margin-bottom: 2rem;
    }

    .section-title {
        position: relative;
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    .section-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -10px;
        width: 50px;
        height: 3px;
        background-color: #8B4513;
    }

    /* Mobile Responsive Styles */
    @media (max-width: 992px) {
        .row-cols-md-3>* {
            flex: 0 0 auto;
            width: 33.33333%;
        }

        .book-image-wrapper {
            height: 150px;
        }

        .book-card {
            max-width: 250px;
        }
    }

    @media (max-width: 768px) {
        .book-card {
            margin-bottom: 1rem;
            max-width: 230px;
        }

        .book-image-wrapper {
            height: 140px;
        }

        .card-title {
            font-size: 0.9rem;
            min-height: 2.2rem;
        }

        .card-text.text-muted {
            font-size: 0.75rem;
        }

        .book-description {
            font-size: 0.7rem;
            min-height: 2rem;
        }

        .price-badge,
        .stock-badge {
            padding: 0.2rem 0.5rem;
            font-size: 0.7rem;
        }

        .add-to-cart-btn,
        .buy-now-btn {
            padding: 0.4rem 0.6rem;
            font-size: 0.75rem;
            height: 36px;
        }

        .section-title {
            font-size: 1.3rem;
        }

        .section-header p {
            font-size: 0.85rem;
        }

        .container-fluid {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        .filter-controls {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .sort-select {
            min-width: 150px;
        }
    }

    @media (max-width: 576px) {
        .book-card {
            max-width: 100%;
        }

        .book-image-wrapper {
            height: 130px;
        }

        .card-title {
            font-size: 0.85rem;
            min-height: 2rem;
        }

        .card-text.text-muted {
            font-size: 0.7rem;
        }

        .book-description {
            font-size: 0.65rem;
            min-height: 1.8rem;
        }

        .price-badge,
        .stock-badge {
            padding: 0.15rem 0.5rem;
            font-size: 0.65rem;
        }

        .add-to-cart-btn,
        .buy-now-btn {
            padding: 0.35rem 0.5rem;
            font-size: 0.7rem;
            height: 34px;
        }

        .section-title {
            font-size: 1.2rem;
        }

        .section-header p {
            font-size: 0.8rem;
        }
    }
</style>
