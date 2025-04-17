<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Authors;
use App\Models\Book_categories;
use App\Models\Book_publishers;
use App\Models\Book_shelves;
use App\Models\Genres;
use App\Models\Book_types;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // Get all the related data for dropdowns
        $categories = Book_categories::orderBy('name')->get();
        $authors = Authors::orderBy('name')->get();
        $publishers = Book_publishers::orderBy('name')->get();
        $genres = Genres::orderBy('name')->get();
        $shelves = Book_shelves::orderBy('name')->get();
        $types = Book_types::orderBy('name')->get();

        // Start building the query
        $query = Book::with(['author', 'category', 'publisher', 'genre', 'shelf', 'type']);

        // Apply search if provided
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhereHas('author', function($q) use ($searchTerm) {
                      $q->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // Apply category filter if provided
        if ($request->has('category_id') && !empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }

        // Apply author filter if provided
        if ($request->has('author_id') && !empty($request->author_id)) {
            $query->where('author_id', $request->author_id);
        }

        // Get paginated results
        $books = $query->orderBy('publish_date', 'desc')->paginate(12);

        // Append query parameters to pagination links
        $books->appends($request->all());

        return view('admin.books.index', compact(
            'books',
            'categories',
            'authors',
            'publishers',
            'genres',
            'shelves',
            'types'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'version' => 'nullable|string|max:255',
            'publisher_id' => 'required|exists:book_publishers,id',
            'publish_date' => 'required|date',
            'isbn_issn' => 'nullable|string|max:255',
            'pages' => 'nullable|integer',
            'language' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:book_categories,id',
            'shelf_id' => 'required|exists:book_shelves,id',
            'genre_id' => 'required|exists:genres,id',
            'type_id' => 'required|exists:book_types,id',
            'book_cover' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('book_cover')) {
            $validated['book_cover'] = $request->file('book_cover')->store('book_covers', 'public');
        } else {
            $validated['book_cover'] = 'default_cover.png'; // Provide a default cover image
        }

        Book::create([
            'title' => $validated['title'],
            'author_id' => $validated['author_id'],
            'version' => $validated['version'],
            'publisher_id' => $validated['publisher_id'],
            'publish_date' => $validated['publish_date'],
            'isbn_issn' => $validated['isbn_issn'],
            'pages' => $validated['pages'],
            'language' => $validated['language'],
            'description' => $validated['description'],
            'quantity' => $validated['quantity'],
            'category_id' => $validated['category_id'],
            'shelf_id' => $validated['shelf_id'],
            'genre_id' => $validated['genre_id'],
            'type_id' => $validated['type_id'],
            'book_cover' => $validated['book_cover'],
        ]);

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }
}
