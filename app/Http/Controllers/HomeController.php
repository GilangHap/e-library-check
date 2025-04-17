<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Authors;
use App\Models\Book_categories;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        // Apply filters
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhereHas('author', function($authorQuery) use ($request) {
                      $authorQuery->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        // Category filter
        if ($request->has('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        // Year range filter
        $minYear = Book::min('publish_date') ? date('Y', strtotime(Book::min('publish_date'))) : (date('Y') - 50);
        $maxYear = Book::max('publish_date') ? date('Y', strtotime(Book::max('publish_date'))) : date('Y');

        if ($request->has('min_year')) {
            $query->whereYear('publish_date', '>=', $request->min_year);
        }

        if ($request->has('max_year')) {
            $query->whereYear('publish_date', '<=', $request->max_year);
        }

        $books = $query->with(['author', 'category', 'genre'])
                       ->orderBy('publish_date', 'desc')
                       ->paginate(12);

        $categories = Book_categories::orderBy('name')->get();
        $authors = Authors::orderBy('name')->get();

        return view('beranda', compact('books', 'categories', 'authors', 'minYear', 'maxYear'));
    }
}
