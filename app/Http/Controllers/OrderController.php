<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order');
    }

    public function getOrder(){

        $orders = Order::all();

        return json_encode($orders);

    }

    public function getCart(){

        $carts = Cart::all();

        return json_encode($carts);

    }


    public function received(Request $request)
    {

        $order = Order::where('id', $request->id)->first();

        $order->status = "Received";

        $order->save();

        return response()->json(['success'=>'Order has been received!']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;

        $order->status = "Pending";

        $order->save();

        $order_id = $order->id;

        $carts = Cart::all();

        foreach ($carts as $cart) {

            $order_details = new OrderDetails;

            $order_details->order_id = $order_id;

            $order_details->product_id = $cart->product_id;

            $order_details->name = $cart->name;

            $order_details->img = $cart->img;

            $order_details->quantity = $cart->quantity;

            $order_details->save();

        }

        $carts = Cart::truncate();

        return response()->json(['success'=>'Order has been submitted!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $order = Order::where('id' , $request->id)->first();

        $order_details = OrderDetails::where('order_id' , $request->id)->get();

        return view('order_view', compact('order_details', 'order'));
    }

}
