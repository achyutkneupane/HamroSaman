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
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }
    public function chatBoxes()
    {
        return $this->hasMany(ChatBox::class);
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
            $resultQuery = $query->where('min_price', '>=', $minPrice)
                                 ->orWhere(function($query) use ($minPrice) {
                                    $query->WhereHas('auction', function ($query) use ($minPrice) {
                                        $query->whereHas('bids', function ($query) use ($minPrice) {
                                            $query->orderByDesc('amount')->where('amount', '>=', $minPrice)->limit(1);
                                        });
                                    });
                                 });
            return $resultQuery;
        }
    }
    public function scopeMaxPrice($query, $maxPrice)
    {
        if ($maxPrice) {
            $resultQuery = $query->where('min_price', '<=', $maxPrice)
                                 ->orWhere(function($query) use ($maxPrice) {
                                    $query->whereHas('auction', function ($query) use ($maxPrice) {
                                        $query->whereHas('bids', function ($query) use ($maxPrice) {
                                            $query->orderByDesc('amount')->where('amount', '<=', $maxPrice)->limit(1);
                                        });
                                    });
                                 });
            return $resultQuery;
        }
    }
    public function scopeSortByTerm($query,$sortTerm) {
        if($sortTerm == 'price_asc') {
            return $query->orderBy('min_price', 'asc');
        }
        elseif($sortTerm == 'price_desc') {
            return $query->orderBy('min_price', 'desc');
        }
        elseif($sortTerm == 'alpha_asc') {
            return $query->orderBy('name', 'asc');
        }
        elseif($sortTerm == 'alpha_desc') {
            return $query->orderBy('name', 'desc');
        }
        else {
            return $query->orderBy('created_at', 'desc');
        }
    }
}
