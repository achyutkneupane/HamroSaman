<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with('category','user')->orderByDesc('created_at')->paginate(9);
        return view('welcome',compact('products'));
    }
    public function dashboard() {
        return view('auth.dashboard.index');
    }
    public function products() {
        $products = auth()->user()->products()->with('category','user')->orderByDesc('created_at')->paginate(9);
        return view('auth.dashboard.products.index', compact('products'));
    }
    public function addProduct() {
        $categories = Category::all();
        return view('auth.dashboard.products.create',compact('categories'));
    }
    public function addProductSubmit(AddProductRequest $request) {
        $randomInt = random_int(1000000, 9999999);
        $randomHash = substr(md5($randomInt).md5(time()), 0, 12);
        $start_at = Carbon::parse($request->start_date . ' ' . $request->start_time);
        $end_at = Carbon::parse($request->end_date . ' ' . $request->end_time);
        $request->merge([
            'start_at' => $start_at,
            'end_at' => $end_at,
            'slug' => Str::slug($request->name)
        ]);
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = $request->slug . '-' . $randomHash . '.' . $extension;
            $imageStore = $request->file('image')->storeAs('public/product-image', $fileName);
            $request->merge([
                'imageLink' => $imageStore
            ]);
        }
        $product = auth()->user()->products()->create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->imageLink,
            'min_price' => $request->min_price,
            'category_id' => $request->category,
            'slug' => $request->slug
        ]);
        $product->auction()->create([
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);
        return redirect()->route('user.products.index');
    }
}
