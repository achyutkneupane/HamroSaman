<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceOrderRequest;
use App\Http\Requests\ProductSearchRequest;
use App\Models\Category;
use App\Models\Product;
use App\Notifications\BidNotification;
use App\Notifications\BidNotificationToOwner;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(ProductSearchRequest $request)
    {
        $searchData = $request->all();
        // dd($searchData);
        $searchTerm = $request->search_term;
        $searchCategory = $request->search_category != 'all' ? $request->search_category : '';
        $minPrice = $request->min_price;
        $maxPrice = $request->max_price;
        $sortTerm = $request->sort_by;

        $categories = Category::all();
        $products = Product::with('user', 'category')
                            ->searchterm($searchTerm)
                            ->categorySearch($searchCategory)
                            ->minPrice($minPrice)
                            ->maxPrice($maxPrice)
                            ->sortByTerm($sortTerm)
                            ->paginate(21);
        return view('products.index', compact(
                                    'products',
                                    'categories',
                                    'searchTerm',
                                    'searchCategory',
                                    'minPrice',
                                    'maxPrice',
                                    'sortTerm',
                                    'searchData'
                                ));
    }
    public function show($slug)
    {
        $product = Product::with('user', 'category','comments','auction.bids')->where('slug', $slug)->firstOrFail();
        $auctionStatus = false;
        $auctionTimeDiff = "Not Started";
        $min_price = $product->min_price;
        if($product->auction) {
            $min_price = $product->auction->highest_bid ? $product->auction->highest_bid->amount : $product->min_price;
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
        return view('products.show', compact('product','auctionStatus','auctionTimeDiff','min_price'));
    }
    public function delete($slug) {
        $product = Product::where('slug', $slug)->firstOrFail();
        $product->delete();
        return redirect()->route('admin.products.index');
    }
    public function placeOrder(PlaceOrderRequest $request) {
        $product = Product::findOrFail($request->product_id);
        $bid = $product->auction->bids()->create([
            'user_id' => auth()->id(),
            'amount' => $request->amount
        ]);
        $product->user->notify(new BidNotificationToOwner($bid));
        auth()->user()->notify(new BidNotification($bid));
        return redirect()->route('products.show', $product->slug);
    }
    public function cancelBid(Request $request) {
        $product = Product::findOrFail($request->product_id);
        $product->auction->bids()->where('user_id', auth()->id())->delete();
        return redirect()->route('products.show', $product->slug);
    }
}
