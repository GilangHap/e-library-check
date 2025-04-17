<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book_shelves extends Model
{
    protected $table = 'book_shelves';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function books()
    {
        return $this->hasMany(Books::class);
    }
}
