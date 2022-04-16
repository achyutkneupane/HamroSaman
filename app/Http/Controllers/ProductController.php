<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSearchRequest;
use App\Models\Category;
use App\Models\Product;
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
        $product = Product::with('user', 'category','comments')->where('slug', $slug)->firstOrFail();
        return view('products.show', compact('product'));
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
}
