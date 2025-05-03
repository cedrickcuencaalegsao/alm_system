<style>
    :root {
        --primary-brown: #8B4513;
        --secondary-brown: #A0522D;
        --light-brown: #DEB887;
        --lightest-brown: #F5EBE0;
        --dark-brown: #654321;
        --accent-brown: #CD853F;
    }

    body {
        background-color: var(--lightest-brown);
        color: #333;
        font-family: 'Poppins', sans-serif;
        background-image: linear-gradient(to bottom, rgba(245, 235, 224, 0.7), rgba(245, 235, 224, 0.9)),
            url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23a0522d' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
    }

    .btn-brown {
        background-color: var(--primary-brown);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 30px;
        transition: all 0.3s ease;
        font-weight: 500;
        box-shadow: 0 4px 8px rgba(139, 69, 19, 0.2);
    }

    .btn-brown:hover {
        background-color: var(--dark-brown);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(139, 69, 19, 0.3);
    }

    .btn-outline-secondary {
        color: var(--secondary-brown);
        border-color: var(--secondary-brown);
        border-radius: 30px;
        padding: 10px 25px;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background-color: var(--secondary-brown);
        color: white;
    }

    .profile-header {
        background: linear-gradient(135deg, var(--light-brown), var(--accent-brown));
        padding: 4rem 0 5rem;
        border-bottom: none;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: -50px;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .form-control {
        border: 1px solid rgba(206, 212, 218, 0.7);
        border-radius: 10px;
        padding: 12px 15px;
        transition: all 0.3s ease;
        background-color: rgba(255, 255, 255, 0.9);
    }

    .form-control:focus {
        border-color: var(--accent-brown);
        box-shadow: 0 0 0 0.25rem rgba(205, 133, 63, 0.25);
        background-color: white;
    }

    .form-label {
        font-weight: 500;
        color: var(--dark-brown);
        margin-bottom: 8px;
    }

    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        background-color: rgba(255, 255, 255, 0.95);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
    }

    .card:hover {
        box-shadow: 0 20px 40px rgba(139, 69, 19, 0.12);
        transform: translateY(-5px);
    }

    .card-body {
        padding: 2.5rem;
    }

    .section-title {
        color: var(--primary-brown);
        font-weight: 600;
        position: relative;
        padding-bottom: 12px;
        margin-bottom: 25px;
        font-size: 1.4rem;
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(to right, var(--primary-brown), var(--accent-brown));
        border-radius: 3px;
    }

    .profile-image-container {
        position: relative;
        width: 160px;
        height: 160px;
        margin: 0 auto;
        z-index: 1;
    }

    .profile-image {
        width: 160px;
        height: 160px;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .profile-image:hover {
        transform: scale(1.03);
    }

    .image-upload-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background-color: var(--primary-brown);
        color: white;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 2;
    }

    .image-upload-btn:hover {
        background-color: var(--accent-brown);
        transform: scale(1.1) rotate(15deg);
    }

    .input-group-text {
        background-color: var(--light-brown);
        color: var(--dark-brown);
        border: 1px solid rgba(206, 212, 218, 0.7);
        border-radius: 10px 0 0 10px;
    }

    .input-group .form-control {
        border-radius: 0 10px 10px 0;
    }

    .password-toggle {
        cursor: pointer;
        color: var(--primary-brown);
        border-radius: 0 10px 10px 0;
    }

    .form-floating .form-control {
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
        border-radius: 10px;
    }

    .form-floating label {
        padding: 1rem 0.75rem;
    }

    .alert-feedback {
        display: none;
        font-size: 14px;
        margin-top: 8px;
        padding: 8px 12px;
        border-radius: 8px;
    }

    .alert-success {
        color: #0f5132;
        background-color: #d1e7dd;
        border-color: #badbcc;
    }

    .alert {
        border-radius: 10px;
        padding: 1rem;
        border-left: 4px solid;
    }

    .alert-success {
        border-left-color: #0f5132;
    }

    .row g-3 {
        --bs-gutter-y: 1rem;
    }

    /* Animation for section entries */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .mb-4 {
        animation: fadeInUp 0.5s ease forwards;
    }

    .mb-4:nth-child(2) {
        animation-delay: 0.1s;
    }

    .mb-4:nth-child(3) {
        animation-delay: 0.2s;
    }

    .mb-4:nth-child(4) {
        animation-delay: 0.3s;
    }
</style>
