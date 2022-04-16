<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function auction()
    {
        return $this->hasOne(Auction::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeCategorySearch($query, $category)
    {
        if ($category) {
            return $query->where('category_id', $category);
        }
    }
    public function scopeSearchTerm($query, $searchTerm)
    {
        if ($searchTerm) {
            return $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        }
    }
    public function scopeMinPrice($query, $minPrice)
    {
        if ($minPrice) {
            return $query->where('min_price', '>=', $minPrice);
        }
    }
    public function scopeMaxPrice($query, $maxPrice)
    {
        if ($maxPrice) {
            return $query->where('min_price', '<=', $maxPrice);
        }
    }
}
