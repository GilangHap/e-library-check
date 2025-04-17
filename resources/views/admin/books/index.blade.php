@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Book Management</h2>
        <button class="btn btn-sm btn-primary rounded-pill px-3 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addBookModal">
            <i class="bi bi-plus-circle-fill"></i> Add Book
        </button>
    </div>
    
    <!-- Search and filter -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body py-3">
            <form action="{{ route('books.index') }}" method="GET" id="searchFilterForm">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search books..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex gap-2 justify-content-md-end">
                            <select name="category_id" class="form-select form-select-sm" style="max-width: 150px;" onchange="document.getElementById('searchFilterForm').submit()">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <select name="author_id" class="form-select form-select-sm" style="max-width: 150px;" onchange="document.getElementById('searchFilterForm').submit()">
                                <option value="">All Authors</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                            @if(request()->hasAny(['search', 'category_id', 'author_id']))
                                <a href="{{ route('books.index') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Books Grid View -->
    <div class="mb-4">
        <ul class="nav nav-pills mb-3">
            <li class="nav-item">
                <a class="nav-link active px-3 rounded-pill" id="gridViewTab" href="#"><i class="bi bi-grid-3x3-gap-fill me-1"></i> Grid</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-3 rounded-pill" id="listViewTab" href="#"><i class="bi bi-list me-1"></i> List</a>
            </li>
        </ul>
        
        <div id="gridView" class="row g-4">
            @forelse ($books as $book)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm transition-hover">
                    <div class="position-relative book-cover-container">
                        <img src="{{ asset('storage/' . $book->book_cover) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 220px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-light text-dark">{{ $book->quantity }} copies</span>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <h6 class="card-title fw-bold text-truncate mb-1">{{ $book->title }}</h6>
                        <p class="text-muted small mb-2">{{ $book->author->name }}</p>
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-light text-dark me-2">{{ $book->category->name }}</span>
                            <small class="text-muted">{{ $book->publish_date }}</small>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 p-3">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#viewBookModal{{ $book->id }}">
                                <i class="bi bi-eye"></i> View
                            </button>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('admin.books.edit', $book->id) }}"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                    <li>
                                        <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash me-2"></i>Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
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
                        <a href="{{ route('admin.books.index') }}" class="btn btn-outline-primary">Clear all filters</a>
                    @endif
                </div>
            </div>
            @endforelse
        </div>
        
        <div id="listView" class="d-none">
            <div class="table-responsive">
                <table id="booksTable" class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author->name }}</td>
                            <td>{{ $book->category->name }}</td>
                            <td>{{ $book->quantity }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewBookModal{{ $book->id }}">
                                        <i class="bi bi-eye"></i> View
                                    </button>
                                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="bi bi-book text-muted d-block mb-2" style="font-size: 24px;"></i>
                                <p class="mb-0">No books found. Try adjusting your search or filter.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Simple pagination -->
    <nav class="mt-4">
        {{ $books->links('pagination::bootstrap-5') }}
    </nav>
</div>

<!-- The rest of your modals remain the same -->
<!-- View Book Modal (Redesigned) -->
@foreach ($books as $book)
<div class="modal fade" id="viewBookModal{{ $book->id }}" tabindex="-1" aria-labelledby="viewBookModalLabel{{ $book->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold" id="viewBookModalLabel{{ $book->id }}">Book Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $book->book_cover) }}" alt="Book Cover" class="img-fluid rounded shadow-sm" style="width: 100%; height: auto; object-fit: cover;">
                        
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil me-1"></i> Edit Book
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash me-1"></i> Delete Book
                            </button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="fw-bold mb-3">{{ $book->title }}</h4>
                        
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge bg-light text-dark">{{ $book->category->name }}</span>
                            <span class="badge bg-light text-dark">{{ $book->genre->name }}</span>
                            <span class="badge bg-light text-dark">{{ $book->quantity }} copies</span>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-muted small d-block">Author</label>
                                    <div>{{ $book->author->name }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-muted small d-block">Publisher</label>
                                    <div>{{ $book->publisher->name }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-muted small d-block">Version</label>
                                    <div>{{ $book->version }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-muted small d-block">Publish Date</label>
                                    <div>{{ $book->publish_date }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-muted small d-block">ISBN/ISSN</label>
                                    <div>{{ $book->isbn_issn }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-muted small d-block">Pages</label>
                                    <div>{{ $book->pages }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-muted small d-block">Language</label>
                                    <div>{{ $book->language }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-muted small d-block">Shelf</label>
                                    <div>{{ $book->shelf->name }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-muted small d-block">Type</label>
                                    <div>{{ $book->type->name }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <label class="text-muted small d-block">Description</label>
                            <p class="text-muted">{{ $book->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-sm btn-light rounded-pill px-3" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Add Book Modal (Redesigned) -->
<div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold" id="addBookModalLabel">Add New Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="mb-3 text-center">
                                <div class="position-relative mb-3">
                                    <div class="book-preview bg-light rounded d-flex align-items-center justify-content-center" style="height: 280px; border: 2px dashed #dee2e6;">
                                        <div class="text-center p-4">
                                            <i class="bi bi-image text-muted" style="font-size: 48px;"></i>
                                            <p class="text-muted small mt-2">Click to upload cover image</p>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control visually-hidden" id="cover" name="cover">
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-secondary mb-3" onclick="document.getElementById('cover').click()">
                                    <i class="bi bi-upload me-1"></i> Upload Cover
                                </button>
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter book title">
                                        <label for="title">Title</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="author" name="author_id">
                                            <option selected disabled>Select author</option>
                                            @foreach ($authors as $author)
                                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="author">Author</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="publisher" name="publisher_id">
                                            <option selected disabled>Select publisher</option>
                                            @foreach ($publishers as $publisher)
                                                <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="publisher">Publisher</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="version" name="version" placeholder="Enter version">
                                        <label for="version">Version</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" id="publish_date" name="publish_date">
                                        <label for="publish_date">Publish Date</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="isbn_issn" name="isbn_issn" placeholder="Enter ISBN/ISSN">
                                        <label for="isbn_issn">ISBN/ISSN</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity">
                                        <label for="quantity">Quantity</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="category" name="category_id">
                                    <option selected disabled>Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <label for="category">Category</label>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="genre" name="genre_id">
                                    <option selected disabled>Select genre</option>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                    @endforeach
                                </select>
                                <label for="genre">Genre</label>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="shelf" name="shelf_id">
                                    <option selected disabled>Select shelf</option>
                                    @foreach ($shelves as $shelf)
                                        <option value="{{ $shelf->id }}">{{ $shelf->name }}</option>
                                    @endforeach
                                </select>
                                <label for="shelf">Shelf</label>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="type" name="type_id">
                                    <option selected disabled>Select type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <label for="type">Type</label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="pages" name="pages" placeholder="Enter pages">
                                <label for="pages">Pages</label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="language" name="language" placeholder="Enter language">
                                <label for="language">Language</label>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="description" name="description" style="height: 100px" placeholder="Enter description"></textarea>
                                <label for="description">Description</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add JS for view toggling and other interactions -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cover image preview functionality
        const coverInput = document.getElementById('cover');
        const previewContainer = document.querySelector('.book-preview');
        
        if (coverInput && previewContainer) {
            coverInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewContainer.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" style="max-height: 280px;">`;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
        
        // Grid and list view toggle
        const gridViewTab = document.getElementById('gridViewTab');
        const listViewTab = document.getElementById('listViewTab');
        const gridView = document.getElementById('gridView');
        const listView = document.getElementById('listView');
        
        if (gridViewTab && listViewTab && gridView && listView) {
            gridViewTab.addEventListener('click', function(e) {
                e.preventDefault();
                gridViewTab.classList.add('active');
                listViewTab.classList.remove('active');
                gridView.classList.remove('d-none');
                listView.classList.add('d-none');
                
                // Save preference to localStorage
                localStorage.setItem('bookViewPreference', 'grid');
            });
            
            listViewTab.addEventListener('click', function(e) {
                e.preventDefault();
                listViewTab.classList.add('active');
                gridViewTab.classList.remove('active');
                listView.classList.remove('d-none');
                gridView.classList.add('d-none');
                
                // Save preference to localStorage
                localStorage.setItem('bookViewPreference', 'list');
            });
            
            // Load user preference on page load
            const viewPreference = localStorage.getItem('bookViewPreference');
            if (viewPreference === 'list') {
                listViewTab.click();
            }
        }
        
        // Delete confirmation
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this book? This action cannot be undone.')) {
                    this.submit();
                }
            });
        });
        
        // Form validation for the add book form
        const addBookForm = document.querySelector('#addBookModal form');
        if (addBookForm) {
            addBookForm.addEventListener('submit', function(e) {
                let hasError = false;
                
                // Check required fields
                const requiredInputs = this.querySelectorAll('input[required], select[required], textarea[required]');
                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('is-invalid');
                        hasError = true;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });
                
                if (hasError) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                }
            });
        }
        
        // Search input submission on enter key
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    document.getElementById('searchFilterForm').submit();
                }
            });
        }
    });
    </script>
    @endsection