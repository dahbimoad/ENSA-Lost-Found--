<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */    protected $fillable = [
        'name',
        'email',
        'password',
        'student_id',
        'whatsapp',
        'show_email',
        'show_whatsapp',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'show_email' => 'boolean',
        'show_whatsapp' => 'boolean',
        'is_admin' => 'boolean'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function lostItems()
    {
        return $this->hasMany(Item::class)->where('type', 'lost');
    }

    public function foundItems()
    {
        return $this->hasMany(Item::class)->where('type', 'found');
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }
}
