<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book_types extends Model
{
    protected $table = 'book_types';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function books()
    {
        return $this->hasMany(Books::class);
    }
}
