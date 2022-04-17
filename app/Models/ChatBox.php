<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatBox extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['user'];
    public function buyer()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function scopeGetChats($query)
    {
        return $query->where('user_id', auth()->user()->id)
                    ->orWhere(
                        function($chatBox) {
                            return $chatBox->whereHas('product', function($product) {
                                return $product->where('user_id', auth()->user()->id);
                            });
                        }
                    )
                    ->orderBy('updated_at', 'desc');
    }
    public function getUserAttribute()
    {
        if($this->product->user->id == auth()->user()->id) {
            $user = $this->buyer;
        }
        else {
            $user = $this->product->user;
        }
        return $user;
    }
}
