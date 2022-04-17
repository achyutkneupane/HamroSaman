<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUsersBid($query)
    {
        return $query->where('user_id', auth()->id());
    }
    public function scopeGetBid($query) {
        return $query->usersBid()->first();
    }
    public function scopeBidPlaced($query)
    {
        return $query->usersBid()->count() ? true : false;
    }
}
