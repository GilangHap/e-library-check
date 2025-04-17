<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class announcements extends Model
{
    protected $table = 'announcements';
    protected $fillable = ['title', 'content', 'created_at'];
    public $timestamps = false;
}
