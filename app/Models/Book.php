<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model // Renamed from Books to Book
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = ['title', 'author_id' , 'category_id', 'publisher_id', 'genre_id', 'type_id', 'shelf_id', 'isbn_issn', 'publish_date', 'pages', 'description', 'book_cover', 'quantity', 'language', 'version'];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Book_categories::class);
    }

    public function author()
    {
        return $this->belongsTo(Authors::class);
    }

    public function shelf()
    {
        return $this->belongsTo(Book_shelves::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Book_publishers::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genres::class);
    }

    public function type()
    {
        return $this->belongsTo(Book_types::class);
    }

    public function borrow()
    {
        return $this->hasMany(Borrows::class);
    }

    public function damaged()
    {
        return $this->hasMany(Damaged_books::class);
    }

    public function waiting_list()
    {
        return $this->hasMany(Waiting_lists::class);
    }

    public function bookmark()
    {
        return $this->hasMany(Bookmarks::class);
    }

}