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

    .qty-btn:disabled {
        background-color: #e9ecef;
        cursor: not-allowed;
        opacity: 0.65;
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
