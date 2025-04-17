<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bookmarks extends Model
{
    protected $table = 'bookmarks';
    protected $fillable = ['user_id', 'book_id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Books::class);
    }
}
