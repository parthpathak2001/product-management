<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        return view('home', compact('categories'));
    }

    public function categoryDetails($cat_id)
    {
        $category = Category::with('products')->where('id', $cat_id)->first();
        return view('category-details', compact('category'));
    }

    public function productDetails($product_id)
    {
        $product = Product::find($product_id);
        return view('product-details', compact('product'));
    }
}
