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
