@extends('shared.layout.admin')

@section('title', 'User Management')

@section('page-title', 'User Management')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('view.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">User Management</li>
@endsection

@section('content')
    <!-- User Management Interface -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-primary">Users Overview</h6>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="bi bi-person-plus me-1"></i> Add New User
                    </button>
                </div>
                <div class="card-body">
                    <!-- Search and Filter -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search users..."
                                    aria-label="Search users">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-md-end mt-3 mt-md-0">
                            <select class="form-select w-auto">
                                <option selected>All Roles</option>
                                <option>Admin</option>
                                <option>Customer</option>
                            </select>
                        </div>
                    </div>

                    <!-- Users Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="px-4 py-3" style="width: 60px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAll">
                                        </div>
                                    </th>
                                    <th scope="col" class="px-4 py-3">User</th>
                                    <th scope="col" class="px-4 py-3">Role</th>
                                    <th scope="col" class="px-4 py-3">Email</th>
                                    <th scope="col" class="px-4 py-3">Last Login</th>
                                    <th scope="col" class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- User 1 -->
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-primary text-white me-3">JD</div>
                                            <div>
                                                <h6 class="mb-0">John Doe</h6>
                                                <small class="text-muted">Joined Apr 2023</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3"><span class="badge bg-info text-white">Admin</span></td>
                                    <td class="px-4 py-3">john.doe@example.com</td>
                                    <td class="px-4 py-3">2 hours ago</td>
                                    <td class="px-4 py-3">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu shadow">
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-eye me-2"></i>View Profile</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editUserModal"><i
                                                            class="bi bi-pencil me-2"></i>Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-lock me-2"></i>Reset Password</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-danger" href="#"><i
                                                            class="bi bi-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <!-- User 2 -->
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-success text-white me-3">JS</div>
                                            <div>
                                                <h6 class="mb-0">Jane Smith</h6>
                                                <small class="text-muted">Joined Dec 2022</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3"><span class="badge bg-secondary">Customer</span></td>
                                    <td class="px-4 py-3">jane.smith@example.com</td>
                                    <td class="px-4 py-3">Yesterday</td>
                                    <td class="px-4 py-3">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu shadow">
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-eye me-2"></i>View Profile</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editUserModal"><i
                                                            class="bi bi-pencil me-2"></i>Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-lock me-2"></i>Reset Password</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-danger" href="#"><i
                                                            class="bi bi-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <!-- User 3 -->
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-danger text-white me-3">RJ</div>
                                            <div>
                                                <h6 class="mb-0">Robert Johnson</h6>
                                                <small class="text-muted">Joined Jan 2023</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3"><span class="badge bg-secondary">Customer</span></td>
                                    <td class="px-4 py-3">robert.j@example.com</td>
                                    <td class="px-4 py-3">3 days ago</td>
                                    <td class="px-4 py-3">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu shadow">
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-eye me-2"></i>View Profile</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editUserModal"><i
                                                            class="bi bi-pencil me-2"></i>Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-lock me-2"></i>Reset Password</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-danger" href="#"><i
                                                            class="bi bi-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <!-- User 4 -->
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-info text-white me-3">EB</div>
                                            <div>
                                                <h6 class="mb-0">Emily Brown</h6>
                                                <small class="text-muted">Joined Nov 2022</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3"><span class="badge bg-secondary">Customer</span></td>
                                    <td class="px-4 py-3">emily.brown@example.com</td>
                                    <td class="px-4 py-3">1 week ago</td>
                                    <td class="px-4 py-3">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu shadow">
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-eye me-2"></i>View Profile</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editUserModal"><i
                                                            class="bi bi-pencil me-2"></i>Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-lock me-2"></i>Reset Password</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-danger" href="#"><i
                                                            class="bi bi-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <!-- User 5 -->
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-warning text-dark me-3">MW</div>
                                            <div>
                                                <h6 class="mb-0">Michael Wilson</h6>
                                                <small class="text-muted">Joined Mar 2023</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3"><span class="badge bg-secondary">Customer</span></td>
                                    <td class="px-4 py-3">michael.w@example.com</td>
                                    <td class="px-4 py-3">2 weeks ago</td>
                                    <td class="px-4 py-3">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu shadow">
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-eye me-2"></i>View Profile</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editUserModal"><i
                                                            class="bi bi-pencil me-2"></i>Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-lock me-2"></i>Reset Password</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-danger" href="#"><i
                                                            class="bi bi-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>
                            <span class="text-muted">Showing 1 to 5 of 24 entries</span>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Statistics -->
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-start border-primary border-4 shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-uppercase fw-bold text-primary mb-1">Total Users</div>
                            <div class="h3 mb-0 fw-bold">246</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fs-1 text-primary opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-start border-info border-4 shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-uppercase fw-bold text-info mb-1">Admins</div>
                            <div class="h3 mb-0 fw-bold">8</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-person-gear fs-1 text-info opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-start border-warning border-4 shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-uppercase fw-bold text-warning mb-1">New This Month</div>
                            <div class="h3 mb-0 fw-bold">24</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-person-plus fs-1 text-warning opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" required>
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Add User</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editFirstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="editFirstName" value="John" required>
                            </div>
                            <div class="col-md-6">
                                <label for="editLastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="editLastName" value="Doe" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="editEmail" value="john.doe@example.com"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="editPhone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="editPhone" value="(123) 456-7890">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editRole" class="form-label">Role</label>
                            <select class="form-select" id="editRole" required>
                                <option value="">Select Role</option>
                                <option value="admin" selected>Admin</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="resetPassword">
                                <label class="form-check-label" for="resetPassword">
                                    Reset Password
                                </label>
                            </div>
                        </div>
                        <div class="row mb-3 password-fields d-none">
                            <div class="col-md-6">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="newPassword">
                            </div>
                            <div class="col-md-6">
                                <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirmNewPassword">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    @include('shared.css.style')
    @include('shared.js.script')
@endsection
