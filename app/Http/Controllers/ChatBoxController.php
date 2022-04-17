<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatBoxCreateRequest;
use App\Models\ChatBox;
use Illuminate\Http\Request;

class ChatBoxController extends Controller
{
    public function index()
    {
        $chatBoxes = ChatBox::with('chats', 'buyer', 'product.user')
                            ->getChats()
                            ->get();
        return view('auth.dashboard.chats.index',compact('chatBoxes'));
    }
    public function show($id)
    {
        $chatBoxes = ChatBox::with('chats', 'buyer', 'product.user')
                            ->getChats()
                            ->get();
        $active = ChatBox::findOrFail($id);
        $chats = $active->chats()->orderBy('created_at', 'desc')->paginate(10);
        return view('auth.dashboard.chats.show',compact('chatBoxes','active','chats'));
    }

    public function create(ChatBoxCreateRequest $request)
    {
        $chatBox = auth()->user()->chatBoxes()->create([
            'product_id' => $request->product_id,
        ]);
        $chat = $chatBox->chats()->create([
            'message' => $request->message,
            'sender' => 'buyer',
        ]);
        return redirect()->route('user.messages.show',$chatBox->id);
    }
}
