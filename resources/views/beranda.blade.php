@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <!-- Enhancing the bookshelf header section -->

<header class="bookshelf-header" id="bookshelfHeader">
    <div class="shelf"></div>
    <div class="container py-5 position-relative z-index-1">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-3 fw-bold text-white mb-4">Discover Your Next Literary Adventure</h1>
                <p class="lead text-white-80 mb-4 opacity-75">Explore our curated collection of literary treasures with immersive 3D previews</p>
                
                <!-- Enhanced Search with Typeahead.js -->
                <form action="{{ route('books.index') }}" method="GET">
                    <div class="search-container">
                        <input type="text" name="search" class="form-control typeahead" 
                               placeholder="Search by title, author, or genre..." 
                               value="{{ request('search') }}"
                               autocomplete="off">
                        <button type="submit" class="search-btn">
                            <i class="ti ti-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <!-- Enhanced Floating books with Tilt.js -->
                <div class="floating-books">
                    <div class="floating-book" data-tilt data-tilt-scale="1.05" data-tilt-glare data-tilt-max-glare="0.3">
                        <div class="book-cover" style="background-image: url('https://m.media-amazon.com/images/I/71X1p4TGlxL._AC_UF1000,1000_QL80_.jpg')"></div>
                    </div>
                    <div class="floating-book" data-tilt data-tilt-scale="1.05" data-tilt-glare data-tilt-max-glare="0.3">
                        <div class="book-cover" style="background-image: url('https://m.media-amazon.com/images/I/91B5Dh1jZLL._AC_UF1000,1000_QL80_.jpg')"></div>
                    </div>
                    <div class="floating-book" data-tilt data-tilt-scale="1.05" data-tilt-glare data-tilt-max-glare="0.3">
                        <div class="book-cover" style="background-image: url('https://m.media-amazon.com/images/I/81dQwQlmAXL._AC_UF1000,1000_QL80_.jpg')"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

    <!-- Enhanced filter & sort bar -->

<div class="container-fluid sticky-top filter-bar" id="filterBar">
    <div class="container py-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
            <div class="mb-3 mb-md-0 d-flex align-items-center">
                <i class="ti ti-books text-primary me-2 fs-4"></i>
                <div>
                    <h2 class="h5 fw-bold mb-0">Book Collection</h2>
                    <p class="text-muted small mb-0">{{ $books->total() }} titles available</p>
                </div>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <!-- Category swiper -->
                <div class="category-swiper-container" style="width: 250px">
                    <div class="swiper category-swiper">
                        <div class="swiper-wrapper">
                            @foreach ($categories as $category)
                            <div class="swiper-slide" style="width: auto">
                                <a href="{{ route('books.index', ['category_id' => $category->id]) }}" 
                                   class="btn btn-sm {{ request('category_id') == $category->id ? 'btn-primary' : 'btn-outline-secondary' }}">
                                    {{ $category->name }}
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Enhanced year range slider -->
                <div class="year-range-slider ms-md-2" style="width: 200px;">
                    <div id="yearSlider" class="slider"></div>
                    <div class="d-flex justify-content-between mt-1">
                        <small class="text-muted" id="yearMin">{{ request('min_year', $minYear) }}</small>
                        <small class="text-muted" id="yearMax">{{ request('max_year', $maxYear) }}</small>
                    </div>
                </div>
                
                <!-- Enhanced view toggle buttons -->
                <div class="btn-group ms-md-2" role="group">
                    <button type="button" class="btn btn-light border view-grid active" data-view="grid">
                        <i class="ti ti-layout-grid"></i>
                    </button>
                    <button type="button" class="btn btn-light border view-list" data-view="list">
                        <i class="ti ti-layout-list"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Main Content -->
    <main class="container py-5">
        <!-- Books Grid View with Masonry -->
        <div class="row g-4 book-collection masonry-grid" id="gridView">
            @forelse ($books as $book)
            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 masonry-item">
                <div class="book-card h-100" data-tilt data-tilt-scale="1.02" data-tilt-glare data-tilt-max-glare="0.1">
                    <!-- 3D Book with improved perspective -->
                    <div class="book-3d">
                        <div class="book-cover" style="background-image: url('{{ asset('storage/' . $book->book_cover) }}')">
                            <div class="book-spine"></div>
                            <div class="book-pages"></div>
                            <div class="book-top"></div>
                            <div class="book-shadow"></div>
                        </div>
                        <div class="book-actions">
                            <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="modal" data-bs-target="#bookModal{{ $book->id }}">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-light rounded-circle">
                                <i class="bi bi-bookmark"></i>
                            </button>
                        </div>
                        @if($book->quantity > 0)
                        <span class="badge bg-success position-absolute bottom-0 start-0 m-2">
                            Available
                        </span>
                        @else
                        <span class="badge bg-danger position-absolute bottom-0 start-0 m-2">
                            Checked Out
                        </span>
                        @endif
                    </div>
                    <div class="book-info mt-3">
                        <h5 class="book-title fw-bold mb-1">{{ Str::limit($book->title, 30) }}</h5>
                        <p class="text-muted small mb-2">by {{ $book->author->name }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-light text-dark">{{ $book->category->name }}</span>
                            <small class="text-muted">{{ $book->publish_date}}</small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="py-5">
                    <i class="bi bi-book text-muted" style="font-size: 48px;"></i>
                    <h5 class="mt-3">No books found</h5>
                    <p class="text-muted">Try adjusting your search or filter to find what you're looking for.</p>
                    @if(request()->hasAny(['search', 'category_id', 'author_id']))
                        <a href="{{ route('books.index') }}" class="btn btn-outline-primary">Clear all filters</a>
                    @endif
                </div>
            </div>
            @endforelse
        </div>

        <!-- Books List View -->
        <div class="book-list-collection d-none" id="listView">
            @foreach ($books as $book)
            <div class="book-list-item" data-tilt data-tilt-reverse="true" data-tilt-scale="1.01">
                <div class="book-list-cover" style="background-image: url('{{ asset('storage/' . $book->book_cover) }}')"></div>
                <div class="book-list-info">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $book->title }}</h5>
                        <p class="text-muted mb-2">by {{ $book->author->name }}</p>
                        <div class="d-flex gap-2 mb-2">
                            <span class="badge bg-light text-dark">{{ $book->category->name }}</span>
                            <span class="badge bg-light text-dark">{{ $book->genre->name }}</span>
                            <span class="badge bg-light text-dark">{{ $book->pages }} pages</span>
                        </div>
                        <p class="text-muted small mb-0">{{ Str::limit($book->description, 200) }}</p>
                    </div>
                    <div class="book-list-actions">
                        @if($book->quantity > 0)
                        <button class="btn btn-sm btn-primary">
                            <i class="bi bi-cart-plus me-1"></i> Borrow
                        </button>
                        @else
                        <button class="btn btn-sm btn-secondary disabled">
                            Unavailable
                        </button>
                        @endif
                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#bookModal{{ $book->id }}">
                            <i class="bi bi-eye me-1"></i> Details
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination with Infinite Scroll Option -->
        <div class="d-flex justify-content-center mt-5" id="paginationContainer">
            {{ $books->links('pagination::bootstrap-5') }}
        </div>
    </main>
</div>

<!-- Book Detail Modal with 3D Flip Effect -->
@foreach ($books as $book)
<div class="modal fade" id="bookModal{{ $book->id }}" tabindex="-1" aria-labelledby="bookModalLabel{{ $book->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden">
            <div class="modal-header border-bottom-0 position-relative">
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-lg-5">
                        <!-- 3D Book with Flip Effect -->
                        <div class="book-3d-modal-container">
                            <div class="book-3d-modal">
                                <div class="book-cover-modal" style="background-image: url('{{ asset('storage/' . $book->book_cover) }}')">
                                    <div class="book-spine-modal"></div>
                                    <div class="book-pages-modal"></div>
                                    <div class="book-top-modal"></div>
                                </div>
                            </div>
                            <button class="btn btn-dark btn-flip rounded-pill mt-4">
                                <i class="bi bi-arrow-repeat me-2"></i> Flip Book
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-7 p-5">
                        <h2 class="fw-bold mb-3">{{ $book->title }}</h2>
                        <p class="lead text-muted">by {{ $book->author->name }}</p>
                        
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            <span class="badge bg-light text-dark">{{ $book->category->name }}</span>
                            <span class="badge bg-light text-dark">{{ $book->genre->name }}</span>
                            <span class="badge bg-light text-dark">{{ $book->pages }} pages</span>
                            <span class="badge bg-light text-dark">{{ $book->language }}</span>
                        </div>
                        
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Description</h6>
                            <p class="text-muted">{{ $book->description }}</p>
                        </div>
                        
                        <!-- Rating with RateYo -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Community Rating</h6>
                            <div class="rateyo-readonly" data-rateyo-rating="{{ rand(3,5) }}"></div>
                            <small class="text-muted">Based on {{ rand(10,100) }} reviews</small>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex mb-4">
                            @if($book->quantity > 0)
                            <button class="btn btn-primary rounded-pill px-4 py-2 me-md-2">
                                <i class="bi bi-cart-plus me-2"></i> Borrow This Book
                            </button>
                            @else
                            <button class="btn btn-secondary rounded-pill px-4 py-2 me-md-2 disabled">
                                Currently Unavailable
                            </button>
                            @endif
                            <button class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                <i class="bi bi-bookmark me-2"></i> Add to Reading List
                            </button>
                        </div>
                        
                        <!-- Book Details Accordion -->
                        <div class="accordion" id="bookAccordion{{ $book->id }}">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="detailsHeading{{ $book->id }}">
                                    <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#detailsCollapse{{ $book->id }}" aria-expanded="false" aria-controls="detailsCollapse{{ $book->id }}">
                                        <i class="bi bi-info-circle me-2"></i> Detailed Information
                                    </button>
                                </h2>
                                <div id="detailsCollapse{{ $book->id }}" class="accordion-collapse collapse" aria-labelledby="detailsHeading{{ $book->id }}" data-bs-parent="#bookAccordion{{ $book->id }}">
                                    <div class="accordion-body p-0 pt-3">
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="bi bi-building text-primary me-2"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Publisher</small>
                                                        <span>{{ $book->publisher->name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="bi bi-calendar text-primary me-2"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Published</small>
                                                        <span>{{ $book->publish_date }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="bi bi-upc-scan text-primary me-2"></i>
                                                    <div>
                                                        <small class="text-muted d-block">ISBN/ISSN</small>
                                                        <span>{{ $book->isbn_issn }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="bi bi-bookshelf text-primary me-2"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Shelf Location</small>
                                                        <span>{{ $book->shelf->name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- CSS Libraries -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.css">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">

<style>
    /* Modern Color Theme */
    :root {
        --primary-color: #6366f1;
        --primary-hover: #4f46e5;
        --secondary-color: #8b5cf6;
        --dark-color: #1e293b;
        --light-color: #f8fafc;
        --accent-color: #f97316;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --neutral-50: #f9fafb;
        --neutral-100: #f3f4f6;
        --neutral-200: #e5e7eb;
        --neutral-300: #d1d5db;
        --neutral-400: #9ca3af;
        --book-shadow: rgba(0, 0, 0, 0.15);
    }
    
    body {
        background-color: var(--neutral-50);
        font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
        color: var(--dark-color);
        overflow-x: hidden;
    }
    
    /* Animated Bookshelf Header */
    .bookshelf-header {
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
        padding: 100px 0 120px;
        position: relative;
        overflow: hidden;
    }
    
    /* Glass-like effect on header */
    .bookshelf-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3Cpath d='M6 5V0H5v5H0v1h5v94h1V6h94V5H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        z-index: 1;
    }
    
    .bookshelf-header::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 60px;
        background: url("data:image/svg+xml,%3Csvg viewBox='0 0 1440 70' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 40L48 35C96 30 192 20 288 15C384 10 480 10 576 20C672 30 768 50 864 50C960 50 1056 30 1152 25C1248 20 1344 30 1392 35L1440 40V0H1392C1344 0 1248 0 1152 0C1056 0 960 0 864 0C768 0 672 0 576 0C480 0 384 0 288 0C192 0 96 0 48 0H0V40Z' fill='%23f8fafc'/%3E%3C/svg%3E") bottom center no-repeat;
        background-size: cover;
        z-index: 3;
    }
    
    .shelf {
        position: absolute;
        bottom: 60px;
        left: 0;
        width: 100%;
        height: 20px;
        background: linear-gradient(to bottom, #8b5cf6, #7c3aed);
        border-radius: 2px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        z-index: 2;
        transform: perspective(1000px) rotateX(5deg);
    }
    
    /* Modern Search Bar */
    .search-container {
        position: relative;
        max-width: 600px;
    }
    
    .search-container .form-control {
        height: 60px;
        padding-left: 25px;
        padding-right: 70px;
        border-radius: 30px;
        border: none;
        font-size: 1.1rem;
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    .search-container .form-control:focus {
        box-shadow: 0 10px 40px rgba(99, 102, 241, 0.2);
        transform: translateY(-2px);
    }
    
    .search-btn {
        position: absolute;
        right: 6px;
        top: 6px;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: var(--primary-color);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 3px 15px rgba(99, 102, 241, 0.3);
    }
    
    .search-btn:hover {
        background: var(--primary-hover);
        transform: rotate(15deg) scale(1.1);
        box-shadow: 0 5px 20px rgba(79, 70, 229, 0.4);
    }
    
    /* Enhanced Floating Books */
    .floating-books {
        display: flex;
        gap: 30px;
        justify-content: flex-end;
        perspective: 1500px;
    }
    
    .floating-book {
        width: 110px;
        height: 160px;
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
    }
    
    .floating-book:hover {
        transform: translateY(-10px);
    }
    
    .floating-book .book-cover {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        border-radius: 4px 12px 12px 4px;
        transform-style: preserve-3d;
        transform: rotateY(-20deg);
        position: relative;
        box-shadow: 
            5px 5px 20px rgba(0,0,0,0.3),
            1px 1px 5px rgba(0,0,0,0.2),
            15px 15px 30px rgba(0,0,0,0.1);
        transition: transform 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    .floating-book .book-cover::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            135deg, 
            rgba(255,255,255,0.1) 0%, 
            rgba(255,255,255,0) 50%,
            rgba(0,0,0,0.1) 100%
        );
        border-radius: 4px 12px 12px 4px;
        z-index: 1;
    }
    
    .floating-book .book-cover::after {
        content: '';
        position: absolute;
        left: -12px;
        top: 1%;
        height: 98%;
        width: 12px;
        background: linear-gradient(to right, #2d2d2d, #111);
        transform: rotateY(90deg) translateZ(-12px);
        border-radius: 3px 0 0 3px;
        box-shadow: inset -2px 0 5px rgba(0,0,0,0.5);
    }
    
    /* Enhanced Book Cards */
    .book-card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        perspective: 1500px;
        background: white;
        border-radius: 16px;
        box-shadow: 
            0 4px 20px rgba(0,0,0,0.05),
            0 1px 3px rgba(0,0,0,0.05);
        padding: 20px;
        height: 100%;
    }
    
    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 
            0 8px 30px rgba(0,0,0,0.1),
            0 2px 5px rgba(0,0,0,0.05);
    }
    
    .book-3d {
        position: relative;
        height: 260px;
        perspective: 1500px;
        margin-bottom: 25px;
        transform-style: preserve-3d;
    }
    
    .book-cover {
        position: absolute;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        border-radius: 4px 12px 12px 4px;
        transform-style: preserve-3d;
        transform: rotateY(-20deg);
        transition: transform 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        backface-visibility: hidden;
        box-shadow: 
            8px 8px 20px rgba(0,0,0,0.2),
            2px 2px 5px rgba(0,0,0,0.1);
    }
    
    .book-cover:hover {
        transform: rotateY(0deg);
    }
    
    .book-spine {
        position: absolute;
        left: -10px;
        top: 2%;
        height: 96%;
        width: 10px;
        background: linear-gradient(to right, #2d2d2d, #111);
        transform: rotateY(90deg) translateZ(-10px);
        border-radius: 2px 0 0 2px;
        box-shadow: inset -2px 0 5px rgba(0,0,0,0.5);
    }
    
    .book-pages {
        position: absolute;
        right: -6px;
        top: 2%;
        height: 96%;
        width: 6px;
        background-image: 
            linear-gradient(to right, 
                var(--neutral-100) 0px, 
                var(--neutral-100) 2px, 
                var(--neutral-200) 2px, 
                var(--neutral-200) 4px);
        transform: rotateY(90deg) translateZ(calc(100% - 6px));
        border-radius: 0 2px 2px 0;
        box-shadow: 1px 0 3px rgba(0,0,0,0.1);
    }
    
    .book-top {
        position: absolute;
        top: -5px;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(to bottom, var(--neutral-200), var(--neutral-300));
        transform: rotateX(90deg) translateZ(-5px);
    }
    
    .book-shadow {
        position: absolute;
        bottom: -15px;
        left: 5%;
        width: 90%;
        height: 20px;
        background: radial-gradient(ellipse at center, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0) 80%);
        filter: blur(10px);
        transform: rotateX(90deg) translateZ(20px);
        z-index: -1;
        opacity: 0.8;
    }
    
    /* Rest of styles remain with improved aesthetics */
    
    /* Book Actions & Info */
    .book-actions {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        z-index: 5;
        opacity: 0;
        transform: translateX(10px);
        transition: all 0.3s ease;
    }
    
    .book-card:hover .book-actions {
        opacity: 1;
        transform: translateX(0);
    }
    
    .book-actions .btn {
        width: 36px;
        height: 36px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(5px);
        background-color: rgba(255, 255, 255, 0.8);
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        border: none;
        transition: all 0.2s ease;
    }
    
    .book-actions .btn:hover {
        background-color: var(--primary-color);
        color: white;
        transform: scale(1.1);
    }
    
    .book-info {
        padding: 5px;
    }
    
    .book-title {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 48px;
        font-weight: 700;
        margin-bottom: 8px;
        font-size: 1.1rem;
        line-height: 1.3;
        color: var(--dark-color);
    }
    
    /* Enhanced Book List View */
    .book-list-collection {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .book-list-item {
        display: flex;
        gap: 25px;
        padding: 25px;
        background-color: white;
        border-radius: 16px;
        box-shadow: 
            0 4px 15px rgba(0,0,0,0.05),
            0 1px 2px rgba(0,0,0,0.03);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    .book-list-item:hover {
        box-shadow: 
            0 8px 30px rgba(0,0,0,0.1),
            0 3px 5px rgba(0,0,0,0.05);
        transform: translateY(-3px);
    }
    
    .book-list-cover {
        width: 90px;
        height: 135px;
        background-size: cover;
        background-position: center;
        border-radius: 6px;
        box-shadow: 
            5px 5px 15px rgba(0,0,0,0.1),
            2px 2px 5px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        position: relative;
        transform-style: preserve-3d;
        transform: rotateY(-10deg);
    }
    
    .book-list-item:hover .book-list-cover {
        transform: rotateY(-15deg) translateX(-5px);
    }
    
    .book-list-cover::before {
        content: '';
        position: absolute;
        left: -5px;
        top: 2%;
        height: 96%;
        width: 5px;
        background: linear-gradient(to right, #2d2d2d, #111);
        transform: rotateY(90deg) translateZ(-5px);
        border-radius: 2px 0 0 2px;
    }
    
    .book-list-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    /* Filter Bar enhancements */
    .filter-bar {
        background: rgba(255,255,255,0.9);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border-bottom: 1px solid var(--neutral-200);
        z-index: 1000;
    }
    
    .filter-bar.scrolled {
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    /* Responsive improvements */
    @media (max-width: 991.98px) {
        .bookshelf-header {
            padding: 60px 0 100px;
        }
        
        .book-3d {
            height: 220px;
        }
        
        .floating-books {
            justify-content: center;
            margin-top: 40px;
        }
    }
    
    @media (max-width: 767.98px) {
        .bookshelf-header {
            padding: 40px 0 80px;
        }
        
        .book-3d {
            height: 200px;
        }
        
        .book-list-item {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .book-list-cover {
            width: 120px;
            height: 180px;
            margin-bottom: 15px;
        }
    }
    
    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        :root {
            --light-color: #1e293b;
            --dark-color: #f8fafc;
            --neutral-50: #0f172a;
            --neutral-100: #1e293b;
            --neutral-200: #334155;
            --neutral-300: #475569;
            --neutral-400: #64748b;
            --book-shadow: rgba(0, 0, 0, 0.5);
        }
        
        body {
            background-color: var(--neutral-50);
        }
        
        .book-card, .book-list-item, .filter-bar {
            background-color: var(--neutral-100);
            color: var(--dark-color);
        }
        
        .search-container .form-control {
            background-color: rgba(255,255,255,0.1);
            color: var(--dark-color);
        }
        
        .book-pages {
            background-image: linear-gradient(to right, 
                var(--neutral-300) 0px, 
                var(--neutral-300) 2px,
                var(--neutral-200) 2px, 
                var(--neutral-200) 4px);
        }
    }
</style>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/split-type@0.3.3/umd/index.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@barba/core@2.9.7/dist/barba.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS animations
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true
    });
    
    // Initialize GSAP animations
    gsap.registerPlugin(ScrollTrigger);
    
    // Animated header text with SplitType
    const headerTitle = new SplitType('.bookshelf-header h1', { types: 'chars' });
    gsap.from(headerTitle.chars, {
        opacity: 0,
        y: 50,
        rotateX: -90,
        stagger: 0.02,
        duration: 1,
        ease: "back.out(1.7)"
    });
    
    gsap.from(".bookshelf-header p", {
        opacity: 0,
        y: 30,
        duration: 1,
        delay: 0.5
    });
    
    gsap.from(".search-container", {
        opacity: 0,
        y: 30,
        duration: 1,
        delay: 0.8
    });
    
    // Animated floating books with enhanced 3D rotation
    gsap.from(".floating-books .floating-book", {
        y: 100,
        opacity: 0,
        rotationY: -40,
        stagger: 0.2,
        duration: 1,
        delay: 1
    });
    
    // Initialize Tilt.js with improved settings
    $('.floating-book').tilt({
        glare: true,
        maxGlare: 0.3,
        scale: 1.05,
        perspective: 1000,
        maxTilt: 15,
        speed: 1000
    });
    
    $('.book-card').tilt({
        glare: true,
        maxGlare: 0.2,
        scale: 1.03,
        perspective: 1500,
        maxTilt: 10,
        speed: 1000
    });
    
    $('.book-list-item').tilt({
        glare: true,
        maxGlare: 0.1,
        scale: 1.01,
        perspective: 2000,
        maxTilt: 5,
        speed: 800
    });
    
    // Enhanced filter bar behavior
    const filterBar = document.querySelector('.filter-bar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            filterBar.classList.add('scrolled');
        } else {
            filterBar.classList.remove('scrolled');
        }
    });
    
    // Initialize particles.js for ambient background in the header
    particlesJS('bookshelfHeader', {
        particles: {
            number: { value: 20, density: { enable: true, value_area: 800 } },
            color: { value: "#ffffff" },
            shape: { type: "circle" },
            opacity: { value: 0.15, random: true },
            size: { value: 5, random: true },
            line_linked: { enable: false },
            move: { enable: true, speed: 1, direction: "none", random: true, out_mode: "out" }
        },
        interactivity: {
            detect_on: "canvas",
            events: { onhover: { enable: true, mode: "bubble" } },
            modes: { bubble: { distance: 200, size: 6, opacity: 0.2 } }
        }
    });
    
    // Book category carousel with Swiper
    const categorySwiper = new Swiper('.category-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 10,
        freeMode: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    });
    
    // Initialize Select2 with custom styling
    $('.select2-multiple').select2({
        placeholder: "Filter by category",
        allowClear: true,
        theme: "modern",
        dropdownCssClass: "select2-dropdown-modern",
        selectionCssClass: "select2-selection-modern"
    });
    
    // Initialize Masonry with improved settings
    const $grid = $('.masonry-grid').masonry({
        itemSelector: '.masonry-item',
        percentPosition: true,
        transitionDuration: '0.6s',
        stagger: 30,
        gutter: 20
    });
    
    // Ensure Masonry layout updates after images load
    $grid.imagesLoaded().progress(() => {
        $grid.masonry('layout');
    });
    
    // Enhanced RateYo for ratings
    $(".rateyo-readonly").each(function() {
        const rating = $(this).data('rateyo-rating') || 0;
        $(this).rateYo({
            rating: rating,
            starWidth: "20px",
            normalFill: "rgba(0,0,0,0.2)",
            ratedFill: "#fbbf24",
            fullStar: true,
            readOnly: true,
            spacing: "2px"
        });
    });
    
    // Enhanced toggle between grid and list view
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    const viewGridBtn = document.querySelector('.view-grid');
    const viewListBtn = document.querySelector('.view-list');
    
    viewGridBtn.addEventListener('click', function() {
        gsap.to(gridView, { opacity: 1, display: 'flex', duration: 0.3 });
        gsap.to(listView, { opacity: 0, display: 'none', duration: 0.3 });
        viewGridBtn.classList.add('active');
        viewListBtn.classList.remove('active');
        setTimeout(() => $grid.masonry('layout'), 100);
    });
    
    viewListBtn.addEventListener('click', function() {
        gsap.to(gridView, { opacity: 0, display: 'none', duration: 0.3 });
        gsap.to(listView, { opacity: 1, display: 'flex', duration: 0.3 });
        viewGridBtn.classList.remove('active');
        viewListBtn.classList.add('active');
    });
    
    // Enhanced book flip animation with 3D effects
    $('.btn-flip').on('click', function() {
        const bookCover = $(this).siblings('.book-3d-modal').find('.book-cover-modal');
        
        if (!bookCover.hasClass('flipped')) {
            gsap.to(bookCover, {
                duration: 1,
                rotateY: 180,
                ease: "power2.inOut",
                onStart: function() {
                    bookCover.addClass('flipping');
                },
                onComplete: function() {
                    bookCover.removeClass('flipping').addClass('flipped');
                }
            });
        } else {
            gsap.to(bookCover, {
                duration: 1,
                rotateY: 0,
                ease: "power2.inOut",
                onStart: function() {
                    bookCover.addClass('flipping');
                },
                onComplete: function() {
                    bookCover.removeClass('flipping').removeClass('flipped');
                }
            });
        }
    });
    
    // Animate on scroll for book cards
    gsap.utils.toArray('.masonry-item').forEach((item, i) => {
        ScrollTrigger.create({
            trigger: item,
            start: "top bottom-=100px",
            onEnter: () => {
                gsap.to(item, {
                    y: 0,
                    opacity: 1,
                    duration: 0.6,
                    delay: i * 0.1 % 0.5
                });
            },
            once: true
        });
    });
    
    // Parallax effect for bookshelf header with improved physics
    ScrollTrigger.create({
        trigger: "#bookshelfHeader",
        start: "top top",
        end: "bottom top",
        scrub: true,
        onUpdate: (self) => {
            gsap.to(".floating-books .floating-book:nth-child(1)", {
                y: self.progress * 80,
                rotateZ: self.progress * -8,
                rotateY: -15 + (self.progress * -10),
                ease: "none"
            });
            
            gsap.to(".floating-books .floating-book:nth-child(2)", {
                y: self.progress * 120,
                rotateZ: self.progress * 10,
                rotateY: -15 + (self.progress * 5),
                ease: "none"
            });
            
            gsap.to(".floating-books .floating-book:nth-child(3)", {
                y: self.progress * 60,
                rotateZ: self.progress * -5,
                rotateY: -15 + (self.progress * -8),
                ease: "none"
            });
            
            gsap.to(".bookshelf-header h1", {
                y: self.progress * 50,
                opacity: 1 - self.progress * 0.8,
                ease: "none"
            });
        }
    });
    
    // Book hover animations
    document.querySelectorAll('.book-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            const cover = this.querySelector('.book-cover');
            gsap.to(cover, {
                rotateY: -10,
                duration: 0.5,
                ease: "power2.out"
            });
        });
        
        card.addEventListener('mouseleave', function() {
            const cover = this.querySelector('.book-cover');
            gsap.to(cover, {
                rotateY: -20,
                duration: 0.5,
                ease: "power2.out"
            });
        });
    });

    // Rest of your existing JavaScript...
});

// Additional features for enhanced user interaction remain the same
// Book modal interaction enhancements, accessibility improvements, etc.

// Performance monitoring with enhanced metrics
window.addEventListener('load', function() {
    if (window.performance) {
        const timing = window.performance.timing;
        const loadTime = timing.loadEventEnd - timing.navigationStart;
        const domReady = timing.domContentLoadedEventEnd - timing.navigationStart;
        const firstPaint = performance.getEntriesByType('paint')[0]?.startTime || 0;
        
        // Send enhanced performance data
        sendPerformanceMetrics({
            loadTime: loadTime,
            domReady: domReady,
            firstPaint: firstPaint,
            pageType: 'book-library',
            viewport: {
                width: window.innerWidth,
                height: window.innerHeight
            }
        });
    }
});

function sendPerformanceMetrics(metrics) {
    // Enhanced analytics tracking
    fetch('/api/performance-metrics', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(metrics)
    });
}

// Initialize all interactive components on page load
document.addEventListener('DOMContentLoaded', function() {
    // Reinitialize components with enhanced settings
    $('.select2-multiple').select2({
        placeholder: "Filter by category",
        allowClear: true,
        theme: "modern"
    });
    
    // Rebind tilt effects with improved parameters
    $('.floating-book').tilt({
        glare: true,
        maxGlare: 0.3,
        scale: 1.05,
        perspective: 1000
    });
    
    $('.book-card, .book-list-item').tilt({
        glare: true,
        maxGlare: 0.2,
        scale: 1.02,
        perspective: 1500
    });
});
</script>