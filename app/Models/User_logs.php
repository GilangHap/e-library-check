<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_logs extends Model
{
    protected $table = 'user_logs';
    protected $fillable = ['user_id', 'action'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
