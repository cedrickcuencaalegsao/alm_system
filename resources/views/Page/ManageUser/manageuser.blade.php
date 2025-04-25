@extends('shared.layout.admin')

@section('title', 'User Management')

@section('page-title', 'User Management')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('view.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">User Management</li>
@endsection

@section('content')
    <!-- Add User Statistics -->
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-start border-primary border-4 shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-uppercase fw-bold text-primary mb-1">Total Users</div>
                            <div class="h3 mb-0 fw-bold">{{ $stats['totalUsers'] }}</div>
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
                            <div class="h3 mb-0 fw-bold">{{ $stats['totalAdmins'] }}</div>
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
                            <div class="h3 mb-0 fw-bold">{{ $stats['totalNewThisMonth'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-person-plus fs-1 text-warning opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Management Interface -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-primary">Users Overview</h6>
                    <a href="{{ route('view.admin.create.user') }}" class="btn btn-primary">
                        <i class="bi bi-person-plus me-1"></i> Add New User
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Search -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <form action="{{ route('view.manage.user') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                        placeholder="Search users by name or email..." name="search"
                                        value="{{ $search ?? '' }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                    @if ($search)
                                        <a href="{{ route('view.manage.user') }}" class="btn btn-outline-danger">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Users Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="px-4 py-3">User</th>
                                    <th scope="col" class="px-4 py-3">Role</th>
                                    <th scope="col" class="px-4 py-3">Email</th>
                                    <th scope="col" class="px-4 py-3">Last Updated</th>
                                    <th scope="col" class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="avatar-circle {{ $user->getIsAdmin() ? 'bg-primary' : 'bg-warning' }} text-white me-3">
                                                    {{ $user->getFirstName()[0] . $user->getLastName()[0] }}
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $user->getFirstName() }}
                                                        {{ $user->getLastName() }}</h6>
                                                    <small class="text-muted">Joined:
                                                        {{ \Carbon\Carbon::parse($user->createdAt())->format('M d, Y h:i A') }}</small>

                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-4 py-3"><span
                                                class="badge {{ $user->getIsAdmin() ? 'bg-info' : 'bg-warning' }} text-white">
                                                {{ $user->getIsAdmin() ? 'Admin' : 'Customer' }}
                                            </span></td>
                                        <td class="px-4 py-3">{{ $user->getEmail() }}</td>
                                        <td class="px-4 py-3">
                                            <h6 class="mb-0">
                                                {{ \Carbon\Carbon::parse($user->updatedAt())->format('M d, Y') }}
                                            </h6>
                                            <small
                                                class="text-muted">{{ \Carbon\Carbon::parse($user->createdAt())->format('h:i A') }}</small>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="btn-group" role="group" aria-label="User actions">
                                                {{-- <a href="#" class="btn btn-sm btn-outline-secondary"
                                                    data-bs-toggle="tooltip" title="View Profile">
                                                    <i class="bi bi-eye"></i>
                                                </a> --}}
                                                <a href="{{ route('admin.edit.user', encrypt($user->getUserID())) }}"
                                                    class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip"
                                                    title="Edit User">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                @if (!$user->getIsAdmin())
                                                    <form action="{{ route('delete.user', encrypt($user->getUserID())) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            data-bs-toggle="tooltip" title="Delete this Account.">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" disabled
                                                        data-bs-toggle="tooltip" title="Admin accounts cannot be deleted">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <nav aria-label="Page navigation">
                            {{ $users->appends(['search' => $search ?? ''])->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('shared.css.style')
    @include('shared.js.script')
@endsection
