<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id', 
        'type',
        'title',
        'description',
        'location',
        'date_found',
        'reward',
        'status',
        'images',
        'expires_at'
    ];

    protected $casts = [
        'date_found' => 'datetime',
        'expires_at' => 'datetime',
        'reward' => 'decimal:2',
        'images' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where(function($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>', Carbon::now());
                    });
    }

    public function scopeLost($query)
    {
        return $query->where('type', 'lost');
    }

    public function scopeFound($query)
    {
        return $query->where('type', 'found');
    }

    public function isLost()
    {
        return $this->type === 'lost';
    }

    public function isFound()
    {
        return $this->type === 'found';
    }

    public function isActive()
    {
        return $this->status === 'active' && 
               (!$this->expires_at || $this->expires_at->isFuture());
    }

    public function hasImages()
    {
        return !empty($this->images);
    }
}
