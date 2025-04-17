<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book_categories extends Model
{
    protected $table = 'book_categories';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function books()
    {
        return $this->hasMany(Books::class);
    }
}
