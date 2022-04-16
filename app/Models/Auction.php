<?php

namespace App\Models;

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
}
