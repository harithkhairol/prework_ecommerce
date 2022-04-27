<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $carts = Cart::all();

        return view('cart', compact('carts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cart = Cart::where('product_id', $request->id)->first();

        if($cart){

            $product_quantity = $cart->quantity;

            $cart->quantity = $product_quantity + $request->quantity;

        }

        else{

            $cart = new Cart;

            $cart->product_id = $request->id;
            $cart->name = $request->name;
            $cart->img = $request->img;
            $cart->quantity = $request->quantity;

        }

        $cart->save();

        return response()->json(['success'=>'Product add to cart successfully']);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $cart = Cart::where('product_id', $request->id)->first()->delete();

        return response()->json(['success'=>'Cart has been deleted successfully!']);
    }
}
