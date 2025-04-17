<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{
    protected $table = 'genres';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function books()
    {
        return $this->hasMany(Books::class);
    }
}
