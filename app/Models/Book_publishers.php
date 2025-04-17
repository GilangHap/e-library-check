<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book_publishers extends Model
{
    protected $table = 'book_publishers';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function books()
    {
        return $this->hasMany(Books::class);
    }
}
