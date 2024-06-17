<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Session;
use Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = new Cart();
        $cart->quantity = $request->qty;
        $cart->product_id = $request->product_id;
        $cart->user_id = Auth::id();
        $cart->save();
        Session::flash('alert-message', 'Item addded to cart!');
        Session::flash('alert-class', 'success');
        return redirect()->back();
    }

    public function cart()
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('cart', compact('cart'));
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);

        if ($cart->delete()) {
            Session::flash('alert-message', 'Cart item deleted successfully!');
            Session::flash('alert-class', 'success');
            return redirect()->back();    
        } else {
            Session::flash('alert-message', 'Cart item not deleted!');
            Session::flash('alert-class', 'error');
            return redirect()->back();
        }
    }
}
