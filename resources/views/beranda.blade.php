@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <!-- Animated Bookshelf Header with Tilt.js -->
    <header class="bookshelf-header" id="bookshelfHeader">
        <div class="shelf"></div>
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-3 fw-bold text-white mb-4 animate__animated animate__fadeInDown">Discover Your Next Adventure</h1>
                    <p class="lead text-white-80 mb-4 animate__animated animate__fadeInDown animate__delay-1s">Browse our collection with realistic 3D book previews</p>
                    
                    <!-- Search with Typeahead.js -->
                    <form action="{{ route('books.index') }}" method="GET" class="animate__animated animate__fadeInDown animate__delay-2s">
                        <div class="search-container">
                            <input type="text" name="search" class="form-control typeahead" 
                                   placeholder="Search by title, author, or ISBN..." value="{{ request('search') }}"
                                   autocomplete="off">
                            <button type="submit" class="search-btn">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <!-- Floating books with Tilt.js -->
                    <div class="floating-books">
                        <div class="floating-book" data-tilt data-tilt-scale="1.05" data-tilt-glare data-tilt-max-glare="0.2">
                            <div class="book-cover" style="background-image: url('https://m.media-amazon.com/images/I/71X1p4TGlxL._AC_UF1000,1000_QL80_.jpg')"></div>
                        </div>
                        <div class="floating-book" data-tilt data-tilt-scale="1.05" data-tilt-glare data-tilt-max-glare="0.2">
                            <div class="book-cover" style="background-image: url('https://m.media-amazon.com/images/I/91B5Dh1jZLL._AC_UF1000,1000_QL80_.jpg')"></div>
                        </div>
                        <div class="floating-book" data-tilt data-tilt-scale="1.05" data-tilt-glare data-tilt-max-glare="0.2">
                            <div class="book-cover" style="background-image: url('https://m.media-amazon.com/images/I/81dQwQlmAXL._AC_UF1000,1000_QL80_.jpg')"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Filter & Sort Bar with GSAP animations -->
    <div class="container-fluid bg-white py-3 sticky-top filter-bar shadow-sm" id="filterBar">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div class="mb-3 mb-md-0">
                    <h2 class="h5 fw-bold mb-0">Book Collection</h2>
                    <p class="text-muted small">{{ $books->total() }} titles available</p>
                </div>
                <div class="d-flex gap-2">
                    <!-- Multi-select dropdown with Select2 -->
                    <select class="form-select select2-multiple" multiple="multiple" name="categories[]" style="width: 200px;">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, (array)request('categories')) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    
                    <!-- Range slider with noUiSlider -->
                    <div class="year-range-slider" style="width: 200px;">
                        <div id="yearSlider" class="slider"></div>
                        <div class="d-flex justify-content-between mt-1">
                            <small class="text-muted" id="yearMin">{{ request('min_year', $minYear) }}</small>
                            <small class="text-muted" id="yearMax">{{ request('max_year', $maxYear) }}</small>
                        </div>
                    </div>
                    
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-light border view-grid active" data-view="grid">
                            <i class="bi bi-grid-3x3-gap"></i>
                        </button>
                        <button type="button" class="btn btn-light border view-list" data-view="list">
                            <i class="bi bi-list-ul"></i>
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

<style>
    /* Base Styles */
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --dark-color: #1a1a2e;
        --light-color: #f8f9fa;
    }
    
    body {
        background-color: #f5f7fa;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    }
    
    /* Bookshelf Header */
    .bookshelf-header {
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
        padding: 80px 0 120px;
        position: relative;
        overflow: hidden;
    }
    
    .bookshelf-header::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 40px;
        background: url("data:image/svg+xml,%3Csvg viewBox='0 0 1440 70' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 40L48 35C96 30 192 20 288 15C384 10 480 10 576 20C672 30 768 50 864 50C960 50 1056 30 1152 25C1248 20 1344 30 1392 35L1440 40V0H1392C1344 0 1248 0 1152 0C1056 0 960 0 864 0C768 0 672 0 576 0C480 0 384 0 288 0C192 0 96 0 48 0H0V40Z' fill='%23f5f7fa'/%3E%3C/svg%3E") bottom center no-repeat;
        background-size: cover;
        z-index: 2;
    }
    
    .shelf {
        position: absolute;
        bottom: 40px;
        left: 0;
        width: 100%;
        height: 16px;
        background: linear-gradient(to bottom, #e0e0e0, #c0c0c0);
        border-radius: 2px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        z-index: 1;
    }
    
    /* Search Bar */
    .search-container {
        position: relative;
        max-width: 600px;
    }
    
    .search-container .form-control {
        height: 56px;
        padding-left: 20px;
        padding-right: 60px;
        border-radius: 50px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    .search-btn {
        position: absolute;
        right: 5px;
        top: 5px;
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: var(--primary-color);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .search-btn:hover {
        background: var(--secondary-color);
        transform: rotate(15deg);
    }
    
    /* Floating Books */
    .floating-books {
        display: flex;
        gap: 20px;
        justify-content: flex-end;
        perspective: 1000px;
    }
    
    .floating-book {
        width: 100px;
        height: 150px;
        transition: transform 0.5s ease;
    }
    
    .floating-book .book-cover {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        border-radius: 3px 8px 8px 3px;
        transform-style: preserve-3d;
        transform: rotateY(-15deg);
        position: relative;
        box-shadow: 5px 10px 30px rgba(0,0,0,0.3);
        transition: transform 0.5s ease;
    }
    
    .floating-book .book-cover::after {
        content: '';
        position: absolute;
        left: -8px;
        top: 2%;
        height: 96%;
        width: 8px;
        background-color: #222;
        transform: rotateY(90deg) translateZ(-8px);
        border-radius: 2px 0 0 2px;
    }
    
    /* Book Cards */
    .book-card {
        transition: all 0.3s ease;
        perspective: 1000px;
    }
    
    .book-3d {
        position: relative;
        height: 260px;
        perspective: 1000px;
        margin-bottom: 20px;
    }
    
    .book-cover {
        position: absolute;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        border-radius: 3px 8px 8px 3px;
        transform-style: preserve-3d;
        transform: rotateY(-15deg);
        transition: transform 0.5s ease;
        box-shadow: 5px 10px 20px rgba(0,0,0,0.2);
    }
    
    .book-spine {
        position: absolute;
        left: -10px;
        top: 2%;
        height: 96%;
        width: 10px;
        background-color: #222;
        transform: rotateY(90deg) translateZ(-10px);
        border-radius: 2px 0 0 2px;
    }
    
    .book-pages {
        position: absolute;
        right: -6px;
        top: 2%;
        height: 96%;
        width: 6px;
        background: repeating-linear-gradient(to right, 
            #f8f9fa 0px, 
            #f8f9fa 2px, 
            #e9ecef 2px, 
            #e9ecef 4px);
        transform: rotateY(90deg) translateZ(calc(100% - 6px));
        border-radius: 0 2px 2px 0;
    }
    
    .book-top {
        position: absolute;
        top: -5px;
        left: 0;
        width: 100%;
        height: 5px;
        background-color: rgba(255,255,255,0.3);
        transform: rotateX(90deg) translateZ(-5px);
    }
    
    .book-shadow {
        position: absolute;
        bottom: -10px;
        left: 10px;
        width: 90%;
        height: 10px;
        background: radial-gradient(ellipse at center, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0) 70%);
        filter: blur(5px);
        transform: rotateX(90deg) translateZ(10px);
    }
    
    .book-actions {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        flex-direction: column;
        gap: 5px;
        z-index: 2;
    }
    
    .book-info {
        padding: 0 10px;
    }
    
    .book-title {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 48px;
    }
    
    /* Book List View */
    .book-list-collection {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .book-list-item {
        display: flex;
        gap: 20px;
        padding: 20px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .book-list-cover {
        width: 80px;
        height: 120px;
        background-size: cover;
        background-position: center;
        border-radius: 4px;
        box-shadow: 3px 3px 10px rgba(0,0,0,0.1);
    }
    
    .book-list-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .book-list-actions {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }
    
    /* Modal Styles */
    .book-3d-modal-container {
        padding: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
        background: linear-gradient(to bottom, #f8f9fa, #e9ecef);
        height: 100%;
    }
    
    .book-3d-modal {
        width: 100%;
        height: 400px;
        position: relative;
        perspective: 2000px;
    }
    
    .book-cover-modal {
        position: absolute;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        border-radius: 5px 15px 15px 5px;
        transform-style: preserve-3d;
        transform: rotateY(-20deg);
        transition: transform 1s ease;
        box-shadow: 15px 20px 40px rgba(0,0,0,0.3);
    }
    
    .book-spine-modal {
        position: absolute;
        left: -15px;
        top: 2%;
        height: 96%;
        width: 15px;
        background-color: #111;
        transform: rotateY(90deg) translateZ(-15px);
        border-radius: 3px 0 0 3px;
    }
    
    .book-pages-modal {
        position: absolute;
        right: -10px;
        top: 2%;
        height: 96%;
        width: 10px;
        background: repeating-linear-gradient(to right, 
            #f8f9fa 0px, 
            #f8f9fa 3px, 
            #e9ecef 3px, 
            #e9ecef 6px);
        transform: rotateY(90deg) translateZ(calc(100% - 10px));
        border-radius: 0 3px 3px 0;
    }
    
    .book-top-modal {
        position: absolute;
        top: -8px;
        left: 0;
        width: 100%;
        height: 8px;
        background-color: rgba(255,255,255,0.3);
        transform: rotateX(90deg) translateZ(-8px);
    }
    
    .btn-flip {
        transition: all 0.3s ease;
    }
    
    .btn-flip:hover {
        transform: rotate(15deg);
    }
    
    /* Filter Bar */
    .filter-bar {
        transition: all 0.3s ease;
        z-index: 1000;
    }
    
    /* Responsive Styles */
    @media (max-width: 991.98px) {
        .bookshelf-header {
            padding: 60px 0 100px;
        }
        
        .book-3d {
            height: 220px;
        }
        
        .floating-books {
            justify-content: center;
            margin-top: 30px;
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
        }
        
        .book-list-cover {
            width: 100%;
            height: 180px;
            margin-bottom: 15px;
        }
        
        .book-3d-modal-container {
            padding: 20px;
        }
        
        .book-3d-modal {
            height: 300px;
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize GSAP animations
    gsap.registerPlugin(ScrollTrigger);
    
    // Animate bookshelf header elements
    gsap.from(".bookshelf-header h1", {
        scrollTrigger: {
            trigger: ".bookshelf-header",
            start: "top center"
        },
        y: 50,
        opacity: 0,
        duration: 1
    });
    
    gsap.from(".bookshelf-header p", {
        scrollTrigger: {
            trigger: ".bookshelf-header",
            start: "top center"
        },
        y: 50,
        opacity: 0,
        duration: 1,
        delay: 0.3
    });
    
    gsap.from(".search-container", {
        scrollTrigger: {
            trigger: ".bookshelf-header",
            start: "top center"
        },
        y: 50,
        opacity: 0,
        duration: 1,
        delay: 0.6
    });
    
    gsap.from(".floating-books .floating-book", {
        scrollTrigger: {
            trigger: ".bookshelf-header",
            start: "top center"
        },
        y: 100,
        opacity: 0,
        duration: 1,
        stagger: 0.2,
        delay: 0.9
    });
    
    // Initialize Tilt.js for 3D effects
    $('.floating-book, .book-card, .book-list-item').tilt({
        glare: true,
        maxGlare: 0.2,
        scale: 1.02
    });
    
    // Initialize Typeahead.js for search
    const books = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/api/books/search?query=%QUERY%',
            wildcard: '%QUERY%'
        }
    });
    
    $('.typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 2
    }, {
        name: 'books',
        source: books,
        templates: {
            suggestion: function(data) {
                return '<div class="search-suggestion">' +
                    '<strong>' + data.title + '</strong>' +
                    '<div class="text-muted small">by ' + data.author + '</div>' +
                    '</div>';
            }
        }
    });
    
    // Initialize noUiSlider for year range
    const yearSlider = document.getElementById('yearSlider');
    noUiSlider.create(yearSlider, {
        start: [{{ request('min_year', $minYear) }}, {{ request('max_year', $maxYear) }}],
        connect: true,
        range: {
            'min': {{ $minYear }},
            'max': {{ $maxYear }}
        },
        step: 1,
        tooltips: [true, true],
        format: {
            to: function(value) {
                return Math.round(value);
            },
            from: function(value) {
                return Number(value);
            }
        }
    });
    
    yearSlider.noUiSlider.on('update', function(values, handle) {
        const value = values[handle];
        if (handle) {
            document.getElementById('yearMax').textContent = Math.round(value);
        } else {
            document.getElementById('yearMin').textContent = Math.round(value);
        }
    });
    
    // Initialize Select2 for multi-select
    $('.select2-multiple').select2({
        placeholder: "Filter by category",
        allowClear: true
    });
    
    // Initialize Masonry for grid layout
    const $grid = $('.masonry-grid').masonry({
        itemSelector: '.masonry-item',
        percentPosition: true,
        gutter: 20
    });
    
    $grid.imagesLoaded().progress(function() {
        $grid.masonry('layout');
    });
    
    // Initialize RateYo for ratings
    $(".rateyo-readonly").rateYo({
        rating: 0,
        starWidth: "20px",
        fullStar: true,
        readOnly: true
    });
    
    // View toggle functionality
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    const viewGridBtn = document.querySelector('.view-grid');
    const viewListBtn = document.querySelector('.view-list');
    
    viewGridBtn.addEventListener('click', function() {
        gridView.classList.remove('d-none');
        listView.classList.add('d-none');
        viewGridBtn.classList.add('active');
        viewListBtn.classList.remove('active');
        $grid.masonry('layout');
    });
    
    viewListBtn.addEventListener('click', function() {
        gridView.classList.add('d-none');
        listView.classList.remove('d-none');
        viewGridBtn.classList.remove('active');
        viewListBtn.classList.add('active');
    });
    
    // Book flip animation in modal
    $('.btn-flip').on('click', function() {
        const bookCover = $(this).siblings('.book-3d-modal').find('.book-cover-modal');
        const currentRotate = bookCover.css('transform');
        
        if (currentRotate.includes('-20deg')) {
            gsap.to(bookCover, {
                duration: 1,
                rotateY: '20deg',
                ease: "power2.inOut"
            });
        } else {
            gsap.to(bookCover, {
                duration: 1,
                rotateY: '-20deg',
                ease: "power2.inOut"
            });
        }
    });
    
    // Parallax effect for bookshelf header
    ScrollTrigger.create({
        trigger: "#bookshelfHeader",
        start: "top top",
        end: "bottom top",
        scrub: true,
        onUpdate: (self) => {
            gsap.to(".floating-books .floating-book:nth-child(1)", {
                y: self.progress * 50,
                rotateZ: self.progress * -5,
                ease: "none"});
        }
    });
    
    // Parallax for additional floating books
    gsap.to(".floating-books .floating-book:nth-child(2)", {
        y: self.progress * 70,
        rotateZ: self.progress * 5,
        ease: "none"
    });
    
    gsap.to(".floating-books .floating-book:nth-child(3)", {
        y: self.progress * 40,
        rotateZ: self.progress * -3,
        ease: "none"
    });
});

// Existing code from previous script remains the same...

// Additional features to enhance user interaction
const filterForm = document.querySelector('.filter-bar form');
if (filterForm) {
    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(filterForm);
        const searchParams = new URLSearchParams(formData).toString();
        
        fetch(`{{ route('books.index') }}?${searchParams}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            updateBookCollection(data);
        })
        .catch(error => {
            console.error('Error filtering books:', error);
        });
    });
}

// Book modal interaction enhancements
document.querySelectorAll('.book-modal-trigger').forEach(trigger => {
    trigger.addEventListener('click', function() {
        const bookId = this.dataset.bookId;
        const modal = document.getElementById(`bookModal${bookId}`);
        
        // Add 3D flip effect to modal book
        const bookCover = modal.querySelector('.book-cover-modal');
        const flipButton = modal.querySelector('.btn-flip');
        
        flipButton.addEventListener('click', () => {
            bookCover.classList.toggle('flipped');
        });
        
        // Preload related book recommendations
        fetchRelatedBooks(bookId);
    });
});

function fetchRelatedBooks(bookId) {
    fetch(`/api/books/${bookId}/related`)
    .then(response => response.json())
    .then(relatedBooks => {
        const relatedBooksContainer = document.getElementById('relatedBooksContainer');
        relatedBooksContainer.innerHTML = ''; // Clear previous recommendations
        
        relatedBooks.forEach(book => {
            const bookElement = document.createElement('div');
            bookElement.classList.add('related-book');
            bookElement.innerHTML = `
                <img src="${book.cover}" alt="${book.title}">
                <div class="related-book-info">
                    <h6>${book.title}</h6>
                    <p>${book.author}</p>
                </div>
            `;
            relatedBooksContainer.appendChild(bookElement);
        });
    })
    .catch(error => {
        console.error('Error fetching related books:', error);
    });
}

// Accessibility improvements
document.addEventListener('keydown', function(event) {
    // Close modal on Escape key
    if (event.key === 'Escape') {
        const openModals = document.querySelectorAll('.modal.show');
        openModals.forEach(modal => {
            const closeButton = modal.querySelector('.btn-close');
            if (closeButton) {
                closeButton.click();
            }
        });
    }
    
    // Quick navigation between grid and list view
    if (event.ctrlKey) {
        switch(event.key) {
            case 'g':
                document.querySelector('.view-grid').click();
                break;
            case 'l':
                document.querySelector('.view-list').click();
                break;
        }
    }
});

// Performance monitoring and analytics (optional)
window.addEventListener('load', function() {
    if (window.performance) {
        const timing = window.performance.timing;
        const loadTime = timing.loadEventEnd - timing.navigationStart;
        
        // Send performance data to analytics service
        sendPerformanceMetrics({
            loadTime: loadTime,
            pageType: 'book-library'
        });
    }
});

function sendPerformanceMetrics(metrics) {
    // Implement your analytics tracking here
    // Example with fetch API
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
    // Reinitialize any components that might need refresh
    $('.select2-multiple').select2({
        placeholder: "Filter by category",
        allowClear: true
    });
    
    // Rebind tilt effects
    $('.floating-book, .book-card, .book-list-item').tilt({
        glare: true,
        maxGlare: 0.2,
        scale: 1.02
    });
});
</script>