<style>
    :root {
        --primary-color: #3b7ddd;
        --primary-hover: #326abc;
        --primary-text: #ffffff;
        --sidebar-bg: #222e3c;
        --sidebar-text: #e9ecef;
        --sidebar-width: 250px;
        --header-height: 60px;
        --content-bg: #f5f7fb;
        --card-bg: #ffffff;
        --border-radius: 0.35rem;
        --box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        background-color: var(--content-bg);
        color: #495057;
        overflow-x: hidden;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: var(--sidebar-width);
        height: 100vh;
        background-color: var(--sidebar-bg);
        color: var(--sidebar-text);
        overflow-y: auto;
        transition: all 0.3s;
        z-index: 1040;
    }

    .sidebar-header {
        padding: 1.5rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-brand {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--sidebar-text);
        text-decoration: none;
    }

    .sidebar-nav {
        padding: 1rem 0;
    }

    .sidebar-item {
        position: relative;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        color: rgba(233, 236, 239, 0.8);
        text-decoration: none;
        transition: all 0.2s;
    }

    .sidebar-link:hover,
    .sidebar-link.active {
        color: var(--sidebar-text);
        background-color: rgba(255, 255, 255, 0.075);
    }

    .sidebar-link i {
        margin-right: 0.75rem;
        width: 20px;
        text-align: center;
    }

    .main-content {
        margin-left: var(--sidebar-width);
        min-height: 100vh;
        transition: all 0.3s;
    }

    .header {
        height: var(--header-height);
        background-color: var(--card-bg);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: var(--box-shadow);
        padding: 0 1.5rem;
        position: sticky;
        top: 0;
        z-index: 1030;
    }

    .content {
        padding: 2rem;
    }

    .card {
        background-color: var(--card-bg);
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        margin-bottom: 1.5rem;
    }

    .card-header {
        background-color: transparent;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.25rem 1.5rem;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover,
    .btn-primary:focus {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
    }

    .user-dropdown .dropdown-toggle::after {
        display: none;
    }

    .user-dropdown .dropdown-toggle {
        background: transparent;
        border: none;
        color: #495057;
    }

    .user-dropdown .dropdown-menu {
        min-width: 14rem;
        right: 0;
        left: auto;
        padding: 0.5rem 0;
    }

    .user-dropdown .dropdown-item {
        padding: 0.5rem 1.5rem;
        color: #495057;
    }

    .user-dropdown .dropdown-item:hover {
        background-color: rgba(59, 125, 221, 0.1);
    }

    .toggle-sidebar {
        background: transparent;
        border: none;
        color: #495057;
        margin-right: 1rem;
    }

    @media (max-width: 768px) {
        .sidebar {
            margin-left: calc(var(--sidebar-width) * -1);
        }

        .sidebar.collapsed {
            margin-left: 0;
        }

        .main-content {
            margin-left: 0;
        }

        .main-content.expanded {
            margin-left: var(--sidebar-width);
        }
    }

    .sidebar-badge {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        background-color: rgba(59, 125, 221, 0.2);
        color: #e9ecef;
        border-radius: 10px;
        margin-left: auto;
    }

    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .sidebar-link.text-danger {
        transition: all 0.3s ease;
    }

    .sidebar-link.text-danger:hover {
        background-color: transparent;
        color: transparent;
        transform: translateX(5px);
        box-shadow: none;
        border-radius: 4px;
    }

    /* Icon transition */
    .sidebar-link.text-danger i {
        transition: transform 0.3s ease;
    }

    .sidebar-link.text-danger:hover i {
        transform: translateX(2px);
    }

    Styling for the category tags .category-tag {
        margin-bottom: 0.25rem;
    }

    .category-radio {
        position: absolute;
        opacity: 0;
    }

    .category-label {
        cursor: pointer;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        transition: all 0.2s ease;
    }

    .category-radio:checked+.category-label {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }

    .category-radio:focus+.category-label {
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .category-label:hover {
        background-color: #dde2e6;
    }

    .category-radio:checked+.category-label:hover {
        background-color: #0b5ed7;
    }
</style>
