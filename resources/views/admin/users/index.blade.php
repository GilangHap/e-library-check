@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">User Management</h2>
        <button class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="bi bi-plus-circle"></i> Add User
        </button>
    </div>
    
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">Users List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="usersTable" class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>NIS</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->nis }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2 bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                        <span class="text-primary fw-bold">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-medium">{{ $user->name }}</h6>
                                        <small class="text-muted">{{ $user->email ?? 'No email' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($user->role === 'admin')
                                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">Admin</span>
                                @elseif ($user->role === 'siswa')
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Siswa</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill">N/A</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Edit User">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Delete User">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" class="form-control" id="nis" placeholder="Enter NIS">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter full name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role">
                            <option selected disabled>Select role</option>
                            <option value="admin">Admin</option>
                            <option value="siswa">Siswa</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password">
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add User</button>
            </div>
        </div>
    </div>
</div>
@endsection