<style>
    body {
        background-color: #FDF5E6;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding-bottom: 2rem;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Book Card Styles */
    .book-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 1.25rem;
        margin-bottom: 1rem;
        transition: transform 0.2s;
        height: 100%;
        position: relative;
    }

    .book-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 69, 19, 0.15);
    }

    .book-card-content {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .book-image-container {
        margin-bottom: 1rem;
    }

    .book-image-wrapper {
        width: 100%;
        height: 160px;
        position: relative;
        margin-bottom: 0.75rem;
        overflow: hidden;
        border-radius: 5px;
    }

    .book-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 5px;
        transition: transform 0.3s ease;
    }

    .book-card:hover .book-image-wrapper img {
        transform: scale(1.05);
    }

    .book-details {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .book-title {
        font-weight: 600;
        margin-bottom: 0.25rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        color: #5D4037;
    }

    .book-description {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 0.75rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex-grow: 1;
    }

    .book-footer {
        margin-top: auto;
        padding-top: 0.75rem;
        border-top: 1px solid rgba(139, 69, 19, 0.1);
    }

    .book-price {
        font-weight: 600;
        color: #8B4513;
    }

    .stock-badge {
        position: absolute;
        top: 5px;
        left: 5px;
        font-size: 0.65rem;
        padding: 0.15rem 0.35rem;
        background-color: rgba(220, 53, 69, 0.9);
        color: white;
        border-radius: 3px;
        z-index: 1;
    }

    .action-buttons {
        display: flex;
    }

    .cart-btn,
    .buy-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        padding: 0;
    }

    .buy-btn {
        width: 36px;
        height: 36px;
    }

    .filter-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        position: sticky;
        top: 2rem;
    }

    .btn-outline-primary {
        color: #8B4513;
        border-color: #8B4513;
    }

    .btn-outline-primary:hover,
    .btn-outline-primary.active {
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

    .form-select:focus,
    .form-control:focus {
        border-color: #8B4513;
        box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.25);
    }

    .empty-results {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 3rem 2rem;
        text-align: center;
    }

    .empty-results i {
        color: #8B4513;
        opacity: 0.2;
    }

    /* List view styles */
    .book-container.list-view .book-item {
        width: 100%;
        max-width: 100%;
        flex: 0 0 100%;
    }

    .book-container.list-view .book-card-content {
        flex-direction: row;
    }

    .book-container.list-view .book-image-container {
        width: 100px;
        min-width: 100px;
        margin-right: 1.25rem;
        margin-bottom: 0;
    }

    .book-container.list-view .book-image-wrapper {
        height: 130px;
        width: 100%;
    }

    .book-container.list-view .book-details {
        padding-right: 1rem;
    }

    .book-container.list-view .book-description {
        -webkit-line-clamp: 2;
    }

    .book-container.list-view .book-footer {
        border-top: none;
        padding-top: 0;
    }

    /* For grid view on mobile */
    @media (max-width: 767.98px) {
        .filter-card {
            margin-bottom: 1.5rem;
            position: static;
        }

        .book-image-wrapper {
            height: 140px;
        }
    }

    @media (max-width: 575.98px) {
        .book-container.list-view .book-card-content {
            flex-direction: column;
        }

        .book-container.list-view .book-image-container {
            width: 100%;
            margin-right: 0;
            margin-bottom: 1rem;
        }

        .book-container.list-view .book-image-wrapper {
            height: 160px;
        }
    }
</style>
