<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
    public function winning_bid()
    {
        return $this->hasOne(Bid::class)->where('is_winner', true);
    }
    public function isEnded()
    {
        return $this->end_at < Carbon::now();
    }
}
