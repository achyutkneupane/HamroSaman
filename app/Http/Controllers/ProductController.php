<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceOrderRequest;
use App\Http\Requests\ProductSearchRequest;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('user', 'category')->orderByDesc('created_at')->paginate(21);
        return view('products.index', compact('products', 'categories'));
    }
    public function show($slug)
    {
        $product = Product::with('user', 'category','comments','auction.bids')->where('slug', $slug)->firstOrFail();
        $auctionStatus = false;
        $auctionTimeDiff = "Not Started";
        if($product->auction) {
            if (Carbon::parse($product->auction->start_at)->isFuture()) {
                $auctionStatus = 'upcoming';
                $auctionTimeDiff = 'Starting in '.Carbon::parse($product->auction->start_at)->diffForHumans();
            } elseif (Carbon::parse($product->auction->end_at)->isFuture()) {
                $auctionStatus = 'active';
                $auctionTimeDiff = 'Ending in '.Carbon::parse($product->auction->end_at)->diffForHumans();
            } else {
                $auctionStatus = 'ended';
                $auctionTimeDiff = 'Ended '.Carbon::parse($product->auction->end_at)->diffForHumans();
            }
        }
        return view('products.show', compact('product','auctionStatus','auctionTimeDiff'));
    }
    public function search(ProductSearchRequest $request)
    {
        $categories = Category::all();
        $products = Product::with('user', 'category')
                           ->searchterm($request->search_term)
                           ->categorySearch($request->search_category)
                           ->minPrice($request->min_price)
                            ->maxPrice($request->max_price)
                           ->paginate(21);
        return view('products.index', compact('products', 'categories'));
    }
    public function placeOrder(PlaceOrderRequest $request) {
        $product = Product::findOrFail($request->product_id);
        $product->auction->bids()->create([
            'user_id' => auth()->id(),
            'amount' => $request->amount
        ]);
        return redirect()->route('products.show', $product->slug);
    }
    public function cancelBid(Request $request) {
        $product = Product::findOrFail($request->product_id);
        $product->auction->bids()->where('user_id', auth()->id())->delete();
        return redirect()->route('products.show', $product->slug);
    }
}
