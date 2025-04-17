<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class returns extends Model
{
    protected $table = 'returns';
    protected $fillable = ['borrow_id', 'return_date'];
    public $timestamps = false;

    public function borrow()
    {
        return $this->belongsTo(borrows::class);
    }
}
