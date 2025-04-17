<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Damaged_books extends Model
{
    protected $table = 'damaged_books';
    protected $fillable = ['book_id', 'description', 'quantity'];
    public $timestamps = false;

    public function book()
    {
        return $this->belongsTo(Books::class);
    }
}
