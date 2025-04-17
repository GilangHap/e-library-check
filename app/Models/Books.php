<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Import HasFactory
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory; // Add HasFactory trait

    protected $table = 'books';
    protected $fillable = ['title', 'book_cover', 'description', 'publish_date', 'version', 'isbn_issn', 'quantity', 'language', 'pages', 'author_id', 'category_id', 'shelf_id', 'publisher_id', 'genre_id', 'type_id'];
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
