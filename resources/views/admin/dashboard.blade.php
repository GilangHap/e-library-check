@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4 fw-bold">Dashboard Admin</h1>
        <div class="d-flex gap-2">
            <button class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add Book
            </button>
            <button class="btn btn-outline-secondary">
                <i class="bi bi-gear"></i>
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Books</h6>
                            <h3 class="mb-0 fw-bold">1,248</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="bi bi-book text-primary fs-4"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-success bg-opacity-10 text-success">
                            <i class="bi bi-arrow-up"></i> 12% from last month
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Active Loans</h6>
                            <h3 class="mb-0 fw-bold">187</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="bi bi-arrow-repeat text-warning fs-4"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-danger bg-opacity-10 text-danger">
                            <i class="bi bi-arrow-down"></i> 5% from last week
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Registered Users</h6>
                            <h3 class="mb-0 fw-bold">542</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="bi bi-people text-info fs-4"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-success bg-opacity-10 text-success">
                            <i class="bi bi-arrow-up"></i> 8% from last month
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Overdue Books</h6>
                            <h3 class="mb-0 fw-bold">23</h3>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded">
                            <i class="bi bi-exclamation-triangle text-danger fs-4"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-success bg-opacity-10 text-success">
                            <i class="bi bi-arrow-down"></i> 15% from last week
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Most Borrowed Books -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0">Most Borrowed Books</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Book</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Borrow Count</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://m.media-amazon.com/images/I/71aLultW5EL._AC_UF1000,1000_QL80_.jpg" 
                                                 class="rounded me-3" width="40" height="60" style="object-fit: cover">
                                            <span>Atomic Habits</span>
                                        </div>
                                    </td>
                                    <td>James Clear</td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary">Self-Improvement</span></td>
                                    <td>142</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success">Available</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://m.media-amazon.com/images/I/81bsw6fnUiL._AC_UF1000,1000_QL80_.jpg" 
                                                 class="rounded me-3" width="40" height="60" style="object-fit: cover">
                                            <span>Rich Dad Poor Dad</span>
                                        </div>
                                    </td>
                                    <td>Robert Kiyosaki</td>
                                    <td><span class="badge bg-info bg-opacity-10 text-info">Finance</span></td>
                                    <td>128</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success">Available</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://m.media-amazon.com/images/I/71X1p4TGlxL._AC_UF1000,1000_QL80_.jpg" 
                                                 class="rounded me-3" width="40" height="60" style="object-fit: cover">
                                            <span>The Psychology of Money</span>
                                        </div>
                                    </td>
                                    <td>Morgan Housel</td>
                                    <td><span class="badge bg-info bg-opacity-10 text-info">Finance</span></td>
                                    <td>115</td>
                                    <td><span class="badge bg-warning bg-opacity-10 text-warning">Borrowed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://m.media-amazon.com/images/I/71QKQ9mwV7L._AC_UF1000,1000_QL80_.jpg" 
                                                 class="rounded me-3" width="40" height="60" style="object-fit: cover">
                                            <span>Deep Work</span>
                                        </div>
                                    </td>
                                    <td>Cal Newport</td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary">Self-Improvement</span></td>
                                    <td>98</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success">Available</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://m.media-amazon.com/images/I/61tqfa+xbFL._AC_UF1000,1000_QL80_.jpg" 
                                                 class="rounded me-3" width="40" height="60" style="object-fit: cover">
                                            <span>Ikigai</span>
                                        </div>
                                    </td>
                                    <td>Héctor García</td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary">Self-Improvement</span></td>
                                    <td>87</td>
                                    <td><span class="badge bg-warning bg-opacity-10 text-warning">Borrowed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities & Top Users -->
        <div class="col-lg-4 mb-4">
            <!-- New Arrivals -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0">New Arrivals</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex mb-3">
                        <img src="https://m.media-amazon.com/images/I/71CrUJkMD5L._AC_UF1000,1000_QL80_.jpg" 
                             class="rounded me-3" width="60" height="90" style="object-fit: cover">
                        <div>
                            <h6 class="fw-bold mb-1">The Creative Act</h6>
                            <p class="text-muted small mb-1">Rick Rubin</p>
                            <span class="badge bg-success bg-opacity-10 text-success small">Just Added</span>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <img src="https://m.media-amazon.com/images/I/71geVx6dR8L._AC_UF1000,1000_QL80_.jpg" 
                             class="rounded me-3" width="60" height="90" style="object-fit: cover">
                        <div>
                            <h6 class="fw-bold mb-1">Outlive</h6>
                            <p class="text-muted small mb-1">Peter Attia</p>
                            <span class="badge bg-success bg-opacity-10 text-success small">3 days ago</span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <img src="https://m.media-amazon.com/images/I/71kxa1-0mfL._AC_UF1000,1000_QL80_.jpg" 
                             class="rounded me-3" width="60" height="90" style="object-fit: cover">
                        <div>
                            <h6 class="fw-bold mb-1">Build the Life You Want</h6>
                            <p class="text-muted small mb-1">Arthur C. Brooks</p>
                            <span class="badge bg-success bg-opacity-10 text-success small">5 days ago</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Users -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0">Top Users</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" 
                             class="rounded-circle me-3" width="45" height="45" style="object-fit: cover">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-0">Sarah Johnson</h6>
                            <small class="text-muted">12 books this month</small>
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary">Gold</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                             class="rounded-circle me-3" width="45" height="45" style="object-fit: cover">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-0">Michael Chen</h6>
                            <small class="text-muted">9 books this month</small>
                        </div>
                        <span class="badge bg-info bg-opacity-10 text-info">Silver</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" 
                             class="rounded-circle me-3" width="45" height="45" style="object-fit: cover">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-0">Emily Rodriguez</h6>
                            <small class="text-muted">7 books this month</small>
                        </div>
                        <span class="badge bg-warning bg-opacity-10 text-warning">Bronze</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Recent Transactions</h5>
            <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Book</th>
                            <th>Date Borrowed</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/men/75.jpg" 
                                         class="rounded-circle me-2" width="30" height="30" style="object-fit: cover">
                                    <span>David Wilson</span>
                                </div>
                            </td>
                            <td>The Psychology of Money</td>
                            <td>May 15, 2023</td>
                            <td>May 29, 2023</td>
                            <td><span class="badge bg-warning bg-opacity-10 text-warning">Borrowed</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-success">Return</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/women/63.jpg" 
                                         class="rounded-circle me-2" width="30" height="30" style="object-fit: cover">
                                    <span>Lisa Park</span>
                                </div>
                            </td>
                            <td>Atomic Habits</td>
                            <td>May 18, 2023</td>
                            <td>Jun 1, 2023</td>
                            <td><span class="badge bg-warning bg-opacity-10 text-warning">Borrowed</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-success">Return</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/men/22.jpg" 
                                         class="rounded-circle me-2" width="30" height="30" style="object-fit: cover">
                                    <span>James Miller</span>
                                </div>
                            </td>
                            <td>Deep Work</td>
                            <td>May 10, 2023</td>
                            <td>May 24, 2023</td>
                            <td><span class="badge bg-danger bg-opacity-10 text-danger">Overdue</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-danger">Remind</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/women/34.jpg" 
                                         class="rounded-circle me-2" width="30" height="30" style="object-fit: cover">
                                    <span>Anna Garcia</span>
                                </div>
                            </td>
                            <td>Rich Dad Poor Dad</td>
                            <td>May 20, 2023</td>
                            <td>Jun 3, 2023</td>
                            <td><span class="badge bg-warning bg-opacity-10 text-warning">Borrowed</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-success">Return</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/men/45.jpg" 
                                         class="rounded-circle me-2" width="30" height="30" style="object-fit: cover">
                                    <span>Robert Taylor</span>
                                </div>
                            </td>
                            <td>Ikigai</td>
                            <td>May 22, 2023</td>
                            <td>Jun 5, 2023</td>
                            <td><span class="badge bg-warning bg-opacity-10 text-warning">Borrowed</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-success">Return</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection