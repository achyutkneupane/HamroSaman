<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('home');
    }
    public function products() {
        $products = Product::with('category','user')->orderByDesc('created_at')->paginate(9);
        return view('admin.products.index', compact('products'));
    }
    public function categories() {
        $categories = Category::with('products')->paginate(9);
        return view('admin.categories.index', compact('categories'));
    }
}
