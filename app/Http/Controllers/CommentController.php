<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCommentRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(AddCommentRequest $request) {
        $request->user()->comments()->create([
            'content' => $request->content,
            'product_id' => $request->product_id
        ]);
        $product = Product::find($request->product_id);
        return redirect()->route('products.show', $product->slug);
    }
}
