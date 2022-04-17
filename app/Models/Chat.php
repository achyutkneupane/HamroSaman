<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['direction','user'];
    public function chatBox()
    {
        return $this->belongsTo(ChatBox::class);
    }
    public function getDirectionAttribute()
    {
        if(auth()->user()->id == $this->user->id) {
            $direction = 'right';
        }
        else{
            $direction = 'left';
        }
        return $direction;
    }
    public function getUserAttribute()
    {
        if($this->sender == 'buyer') {
            $user = $this->chatBox->buyer;
        }
        else {
            $user = $this->chatBox->product->user;
        }
        return $user;
    }
}
