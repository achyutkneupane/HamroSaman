<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use App\Models\ChatBox;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function create(ChatRequest $request)
    {
        $chatBox = ChatBox::where('id', $request->chat_box_id)
                          ->where(function($chatbox) {
                                return $chatbox->where('user_id', auth()->user()->id)
                                        ->orWhereHas('product', function($product) {
                                            return $product->where('user_id', auth()->user()->id);
                                        });
                            })
                          ->first();
        $chatBox->chats()->create([
            'message' => $request->message,
            'sender' => (auth()->user()->id == $chatBox->user_id) ? 'buyer' : 'seller',
        ]);
        return redirect()->route('user.messages.show', $chatBox->id);
    }
}
