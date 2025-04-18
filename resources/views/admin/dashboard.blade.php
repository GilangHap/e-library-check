@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mt-4 fw-bold display-6 mb-1 text-gradient">Dashboard</h1>
            <p class="text-muted">Welcome back, {{ Auth::user()->name ?? 'Administrator' }}</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary btn-glow rounded-pill shadow px-4">
                <i class="bi bi-plus-circle me-1"></i> Add New Book
            </button>
            <button class="btn btn-glass rounded-pill">
                <i class="bi bi-gear"></i>
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4 g-3">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 card-glass h-100 rounded-4 overflow-hidden">
                <div class="card-body position-relative p-4">
                    <div class="position-absolute top-0 end-0 mt-3 me-3 bg-icon bg-primary p-3 rounded-circle">
                        <i class="bi bi-book text-primary fs-4"></i>
                    </div>
                    <h6 class="text-muted mb-2">Total Books</h6>
                    <h3 class="mb-0 fw-bold">1,248</h3>
                    <div class="progress mt-3 progress-thin">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                            <i class="bi bi-arrow-up me-1"></i> 12% from last month
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 card-glass h-100 rounded-4 overflow-hidden">
                <div class="card-body position-relative p-4">
                    <div class="position-absolute top-0 end-0 mt-3 me-3 bg-icon bg-warning p-3 rounded-circle">
                        <i class="bi bi-arrow-repeat text-warning fs-4"></i>
                    </div>
                    <h6 class="text-muted mb-2">Active Loans</h6>
                    <h3 class="mb-0 fw-bold">187</h3>
                    <div class="progress mt-3 progress-thin">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">
                            <i class="bi bi-arrow-down me-1"></i> 5% from last week
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 card-glass h-100 rounded-4 overflow-hidden">
                <div class="card-body position-relative p-4">
                    <div class="position-absolute top-0 end-0 mt-3 me-3 bg-icon bg-info p-3 rounded-circle">
                        <i class="bi bi-people text-info fs-4"></i>
                    </div>
                    <h6 class="text-muted mb-2">Registered Users</h6>
                    <h3 class="mb-0 fw-bold">542</h3>
                    <div class="progress mt-3 progress-thin">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                            <i class="bi bi-arrow-up me-1"></i> 8% from last month
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 card-glass h-100 rounded-4 overflow-hidden">
                <div class="card-body position-relative p-4">
                    <div class="position-absolute top-0 end-0 mt-3 me-3 bg-icon bg-danger p-3 rounded-circle">
                        <i class="bi bi-exclamation-triangle text-danger fs-4"></i>
                    </div>
                    <h6 class="text-muted mb-2">Overdue Books</h6>
                    <h3 class="mb-0 fw-bold">23</h3>
                    <div class="progress mt-3 progress-thin">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                            <i class="bi bi-arrow-down me-1"></i> 15% from last week
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- Most Borrowed Books -->
        <div class="col-lg-8">
            <div class="card border-0 card-glass h-100 rounded-4 overflow-hidden">
                <div class="card-header bg-transparent border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Most Borrowed Books</h5>
                    <button class="btn btn-outline-primary btn-sm btn-floating rounded-pill px-3">View All</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle custom-table">
                            <thead>
                                <tr>
                                    <th class="ps-4">Book</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Borrow Count</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-row">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="https://m.media-amazon.com/images/I/71aLultW5EL._AC_UF1000,1000_QL80_.jpg" 
                                                 class="rounded-3 me-3 shadow-sm book-cover" width="45" height="65">
                                            <span class="fw-medium">Atomic Habits</span>
                                        </div>
                                    </td>
                                    <td>James Clear</td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">Self-Improvement</span></td>
                                    <td><span class="fw-semibold">142</span></td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Available</span></td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-outline-primary btn-sm btn-floating rounded-pill px-3">View</button>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="https://m.media-amazon.com/images/I/81bsw6fnUiL._AC_UF1000,1000_QL80_.jpg" 
                                                 class="rounded-3 me-3 shadow-sm book-cover" width="45" height="65">
                                            <span class="fw-medium">Rich Dad Poor Dad</span>
                                        </div>
                                    </td>
                                    <td>Robert Kiyosaki</td>
                                    <td><span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3">Finance</span></td>
                                    <td><span class="fw-semibold">128</span></td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Available</span></td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-outline-primary btn-sm btn-floating rounded-pill px-3">View</button>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="https://m.media-amazon.com/images/I/71X1p4TGlxL._AC_UF1000,1000_QL80_.jpg" 
                                                 class="rounded-3 me-3 shadow-sm book-cover" width="45" height="65">
                                            <span class="fw-medium">The Psychology of Money</span>
                                        </div>
                                    </td>
                                    <td>Morgan Housel</td>
                                    <td><span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3">Finance</span></td>
                                    <td><span class="fw-semibold">115</span></td>
                                    <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Borrowed</span></td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-outline-primary btn-sm btn-floating rounded-pill px-3">View</button>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="https://m.media-amazon.com/images/I/71QKQ9mwV7L._AC_UF1000,1000_QL80_.jpg" 
                                                 class="rounded-3 me-3 shadow-sm book-cover" width="45" height="65">
                                            <span class="fw-medium">Deep Work</span>
                                        </div>
                                    </td>
                                    <td>Cal Newport</td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">Self-Improvement</span></td>
                                    <td><span class="fw-semibold">98</span></td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Available</span></td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-outline-primary btn-sm btn-floating rounded-pill px-3">View</button>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="https://m.media-amazon.com/images/I/61tqfa+xbFL._AC_UF1000,1000_QL80_.jpg" 
                                                 class="rounded-3 me-3 shadow-sm book-cover" width="45" height="65">
                                            <span class="fw-medium">Ikigai</span>
                                        </div>
                                    </td>
                                    <td>Héctor García</td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">Self-Improvement</span></td>
                                    <td><span class="fw-semibold">87</span></td>
                                    <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Borrowed</span></td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-outline-primary btn-sm btn-floating rounded-pill px-3">View</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: New Arrivals & Top Users -->
        <div class="col-lg-4 d-flex flex-column gap-4">
            <!-- New Arrivals -->
            <div class="card border-0 card-glass rounded-4 overflow-hidden">
                <div class="card-header bg-transparent border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">New Arrivals</h5>
                    <span class="badge bg-primary rounded-pill px-3">15 new</span>
                </div>
                <div class="card-body">
                    <div class="d-flex mb-3 p-2 hover-item rounded-3">
                        <img src="https://m.media-amazon.com/images/I/71CrUJkMD5L._AC_UF1000,1000_QL80_.jpg" 
                             class="rounded-3 me-3 shadow-sm book-cover" width="65" height="90">
                        <div>
                            <h6 class="fw-bold mb-1">The Creative Act</h6>
                            <p class="text-muted small mb-1">Rick Rubin</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Just Added</span>
                                <div class="ms-2 small">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-3 p-2 hover-item rounded-3">
                        <img src="https://m.media-amazon.com/images/I/71geVx6dR8L._AC_UF1000,1000_QL80_.jpg" 
                             class="rounded-3 me-3 shadow-sm book-cover" width="65" height="90">
                        <div>
                            <h6 class="fw-bold mb-1">Outlive</h6>
                            <p class="text-muted small mb-1">Peter Attia</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">3 days ago</span>
                                <div class="ms-2 small">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-half text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex p-2 hover-item rounded-3">
                        <img src="https://m.media-amazon.com/images/I/71kxa1-0mfL._AC_UF1000,1000_QL80_.jpg" 
                             class="rounded-3 me-3 shadow-sm book-cover" width="65" height="90">
                        <div>
                            <h6 class="fw-bold mb-1">Build the Life You Want</h6>
                            <p class="text-muted small mb-1">Arthur C. Brooks</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">5 days ago</span>
                                <div class="ms-2 small">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 py-3">
                    <button class="btn btn-outline-primary btn-sm w-100 rounded-pill btn-hoverable">Browse New Arrivals</button>
                </div>
            </div>

            <!-- Top Users -->
            <div class="card border-0 card-glass rounded-4 overflow-hidden">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="fw-bold mb-0">Top Readers This Month</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3 p-2 rounded-3 hover-item">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" 
                             class="rounded-circle me-3 shadow-sm user-avatar" width="50" height="50">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-0">Sarah Johnson</h6>
                            <div class="d-flex align-items-center">
                                <small class="text-muted">12 books this month</small>
                                <div class="ms-2">
                                    <i class="bi bi-book-fill text-primary small"></i>
                                    <i class="bi bi-book-fill text-primary small"></i>
                                    <i class="bi bi-book-fill text-primary small"></i>
                                </div>
                            </div>
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">Gold</span>
                    </div>
                    <div class="d-flex align-items-center mb-3 p-2 rounded-3 hover-item">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                             class="rounded-circle me-3 shadow-sm user-avatar" width="50" height="50">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-0">Michael Chen</h6>
                            <div class="d-flex align-items-center">
                                <small class="text-muted">9 books this month</small>
                                <div class="ms-2">
                                    <i class="bi bi-book-fill text-info small"></i>
                                    <i class="bi bi-book-fill text-info small"></i>
                                </div>
                            </div>
                        </div>
                        <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3">Silver</span>
                    </div>
                    <div class="d-flex align-items-center p-2 rounded-3 hover-item">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" 
                             class="rounded-circle me-3 shadow-sm user-avatar" width="50" height="50">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-0">Emily Rodriguez</h6>
                            <div class="d-flex align-items-center">
                                <small class="text-muted">7 books this month</small>
                                <div class="ms-2">
                                    <i class="bi bi-book-fill text-warning small"></i>
                                </div>
                            </div>
                        </div>
                        <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Bronze</span>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 py-3">
                    <button class="btn btn-outline-primary btn-sm w-100 rounded-pill btn-hoverable">View All Readers</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="card border-0 shadow-sm mb-4 mt-4 rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-0">Recent Transactions</h5>
                <p class="text-muted small mb-0 mt-1">Last 5 book loans and returns</p>
            </div>
            <a href="#" class="btn btn-primary btn-sm rounded-pill px-3">View All</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">User</th>
                            <th>Book</th>
                            <th>Date Borrowed</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/men/75.jpg" 
                                         class="rounded-circle me-3 shadow-sm" width="40" height="40" style="object-fit: cover">
                                    <span class="fw-medium">David Wilson</span>
                                </div>
                            </td>
                            <td>The Psychology of Money</td>
                            <td>May 15, 2023</td>
                            <td>May 29, 2023</td>
                            <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Borrowed</span></td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-outline-success rounded-pill px-3">Return</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/women/63.jpg" 
                                         class="rounded-circle me-3 shadow-sm" width="40" height="40" style="object-fit: cover">
                                    <span class="fw-medium">Lisa Park</span>
                                </div>
                            </td>
                            <td>Atomic Habits</td>
                            <td>May 18, 2023</td>
                            <td>Jun 1, 2023</td>
                            <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Borrowed</span></td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-outline-success rounded-pill px-3">Return</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/men/22.jpg" 
                                         class="rounded-circle me-3 shadow-sm" width="40" height="40" style="object-fit: cover">
                                    <span class="fw-medium">James Miller</span>
                                </div>
                            </td>
                            <td>Deep Work</td>
                            <td>May 10, 2023</td>
                            <td>May 24, 2023</td>
                            <td><span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">Overdue</span></td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-danger rounded-pill px-3">Remind</button>
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Fine">
                                        <i class="bi bi-cash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/women/34.jpg" 
                                         class="rounded-circle me-3 shadow-sm" width="40" height="40" style="object-fit: cover">
                                    <span class="fw-medium">Anna Garcia</span>
                                </div>
                            </td>
                            <td>Rich Dad Poor Dad</td>
                            <td>May 20, 2023</td>
                            <td>Jun 3, 2023</td>
                            <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Borrowed</span></td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-outline-success rounded-pill px-3">Return</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/men/45.jpg" 
                                         class="rounded-circle me-3 shadow-sm" width="40" height="40" style="object-fit: cover">
                                    <span class="fw-medium">Robert Taylor</span>
                                </div>
                            </td>
                            <td>Ikigai</td>
                            <td>May 22, 2023</td>
                            <td>Jun 5, 2023</td>
                            <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Borrowed</span></td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-outline-success rounded-pill px-3">Return</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Copyright Footer -->
    <footer class="mt-5 mb-3 text-center text-muted small">
        <p>© 2025 E-Library Management System • All rights reserved</p>
    </footer>
</div>

<style>
    /* Modern & Attractive Custom Styling */
    :root {
        --gradient-primary: linear-gradient(120deg, #4f46e5 0%, #0ea5e9 100%);
        --glass-bg: rgba(255, 255, 255, 0.7);
        --glass-border: rgba(255, 255, 255, 0.5);
        --hover-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    body {
        background-color: #f8fafc;
        background-image: 
            radial-gradient(at 10% 10%, rgba(79, 70, 229, 0.05) 0px, transparent 50%),
            radial-gradient(at 90% 90%, rgba(14, 165, 233, 0.05) 0px, transparent 50%);
        background-attachment: fixed;
    }
    
    .text-gradient {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .card-glass {
        backdrop-filter: blur(10px);
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
        transition: var(--hover-transition);
    }
    
    .card-glass:hover {
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    
    .bg-icon {
        background-opacity: 0.1;
        backdrop-filter: blur(5px);
    }
    
    .progress-thin {
        height: 4px;
        border-radius: 2px;
        overflow: hidden;
        background-color: rgba(0, 0, 0, 0.05);
    }
    
    .book-cover {
        object-fit: cover;
        transition: var(--hover-transition);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .book-cover:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.12);
    }
    
    .btn-glow {
        background: var(--gradient-primary);
        border: none;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
        transition: var(--hover-transition);
    }
    
    .btn-glow:hover {
        box-shadow: 0 6px 15px rgba(79, 70, 229, 0.5);
        transform: translateY(-1px);
    }
    
    .btn-glass {
        backdrop-filter: blur(10px);
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        color: #4b5563;
        transition: var(--hover-transition);
    }
    
    .btn-glass:hover {
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    
    .btn-floating {
        transition: var(--hover-transition);
    }
    
    .btn-floating:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }
    
    .btn-hoverable {
        transition: var(--hover-transition);
    }
    
    .btn-hoverable:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .badge {
        font-weight: 500;
        letter-spacing: 0.5px;
    }
    
    .hover-item {
        transition: var(--hover-transition);
        border: 1px solid transparent;
    }
    
    .hover-item:hover {
        background-color: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(226, 232, 240, 0.8);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .table-row {
        transition: var(--hover-transition);
    }
    
    .table-row:hover {
        background-color: rgba(255, 255, 255, 0.8);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.03);
    }
    
    .custom-table thead tr {
        background-color: rgba(249, 250, 251, 0.9);
        border-bottom: 1px solid #e5e7eb;
    }
    
    .custom-table thead th {
        font-weight: 600;
        color: #4b5563;
        padding: 0.75rem 0.5rem;
        letter-spacing: 0.5px;
    }
    
    .user-avatar {
        object-fit: cover;
        border: 3px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: var(--hover-transition);
    }
    
    .user-avatar:hover {
        transform: scale(1.05);
    }
</style>

@endsection