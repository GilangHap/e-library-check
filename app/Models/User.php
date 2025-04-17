<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nis',
        'name',
        'email',
        'password',
        'book_limit',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Override the default username field for authentication.
     *
     * @return string
     */
    public function username()
    {
        return 'nis';
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmarks::class);
    }

    public function user_logs()
    {
        return $this->hasMany(User_logs::class);
    }

    public function waiting_list()
    {
        return $this->hasMany(Waiting_lists::class);
    }

    public function borrowings()
    {
        return $this->hasMany(borrows::class);
    }


}
