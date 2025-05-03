<style>
    :root {
        --primary-brown: #8B4513;
        --light-brown: #DEB887;
        --dark-brown: #654321;
        --subtle-brown: #F5DEB3;
    }

    .bg-light {
        background-color: var(--subtle-brown) !important;
    }

    .card {
        border-radius: 1rem;
    }

    .btn-primary {
        background-color: var(--primary-brown);
        border-color: var(--primary-brown);
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: var(--dark-brown);
        border-color: var(--dark-brown);
    }

    .btn-secondary {
        background-color: #E9ECEF;
        border-color: #E9ECEF;
        color: var(--dark-brown);
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        font-weight: 500;
    }

    .btn-secondary:hover {
        background-color: #DDE0E3;
        border-color: #DDE0E3;
    }

    .form-section {
        opacity: 1;
        transition: opacity 0.3s ease-in-out;
    }

    .form-section.d-none {
        opacity: 0;
    }

    .login-image {
        min-height: 500px;
        max-height: 100%;
        transition: transform 0.3s ease;
    }

    .w-45 {
        width: 45% !important;
    }

    .form-control:focus {
        border-color: var(--primary-brown);
        box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.1);
    }

    a {
        color: var(--primary-brown);
    }

    a:hover {
        color: var(--dark-brown);
    }

    .form-check-input:checked {
        background-color: var(--primary-brown);
        border-color: var(--primary-brown);
    }

    .notification-container {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1050;
        width: 100%;
        max-width: 400px;
    }

    .notification-toast {
        position: relative;
        min-width: 300px;
        max-width: 100%;
        background: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 8px;
        opacity: 0;
        transition: all 0.3s ease;
        margin-bottom: 10px;
        transform: translateY(-20px);
        pointer-events: none;
    }

    .notification-toast.show {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .toast-header {
        padding: 12px 16px;
        display: flex;
        align-items: center;
        background: transparent;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .toast-body {
        padding: 12px 16px;
        color: #333;
    }

    .toast-message {
        margin-bottom: 8px;
    }

    .toast-message:last-child {
        margin-bottom: 0;
    }

    .btn-close-custom {
        background: transparent;
        border: none;
        padding: 0;
        margin: 0;
        cursor: pointer;
        display: flex;
        align-items: center;
        font-size: 0.875rem;
    }

    .btn-close-custom span {
        font-weight: 500;
    }

    .btn-close-custom:hover {
        opacity: 0.7;
    }

    .error-toast {
        border-left: 4px solid #dc3545;
    }

    .success-toast {
        border-left: 4px solid #198754;
    }

    /* Theme specific colors */
    .success-toast {
        border-left: 4px solid var(--primary-brown);
    }

    .success-toast .text-success {
        color: var(--primary-brown) !important;
    }

    .success-toast .bi-check-circle-fill {
        color: var(--primary-brown) !important;
    }
</style>
