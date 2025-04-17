<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class borrows extends Model
{
    protected $table = 'borrows';
    protected $fillable = ['user_id', 'book_id', 'status', 'borrow_date', 'borrow_end_date' ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Books::class);
    }

    public function return()
    {
        return $this->hasOne(returns::class);
    }
}
