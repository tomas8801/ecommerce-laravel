<?php

namespace App\Http\Controllers;

use App\Order;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_fullname' => 'required',
            'shipping_province' => 'required',
            'shipping_location' => 'required',
            'shipping_address' => 'required',
            'shipping_zipcode' => 'required',
            'shipping_phone' => 'required'
        ]);

        $order = new Order();

        $order->order_number = uniqid('OrderNumber-');
        $order->user_id = auth()->id();

        $order->shipping_fullname = $request->input('shipping_fullname');
        $order->shipping_province = $request->input('shipping_province');
        $order->shipping_location = $request->input('shipping_location');
        $order->shipping_address = $request->input('shipping_address');
        $order->shipping_zipcode = $request->input('shipping_zipcode');
        $order->shipping_phone = $request->input('shipping_phone');

        if(!$request->has('billing_fullname')){
            $order->billing_fullname = $request->input('shipping_fullname');
            $order->billing_province = $request->input('shipping_province');
            $order->billing_location = $request->input('shipping_location');
            $order->billing_address = $request->input('shipping_address');
            $order->billing_zipcode = $request->input('shipping_zipcode');
            $order->billing_phone = $request->input('shipping_phone');
        }else {
            $order->billing_fullname = $request->input('billing_fullname');
            $order->billing_province = $request->input('billing_province');
            $order->billing_location = $request->input('billing_location');
            $order->billing_address = $request->input('billing_address');
            $order->billing_zipcode = $request->input('billing_zipcode');
            $order->billing_phone = $request->input('billing_phone');
        }

        $order->grand_total = \Cart::session(auth()->id())->getTotal();
        $order->item_count = \Cart::session(auth()->id())->getContent()->count();

        if($request->input('payment_method') == 'paypal'){
            $order->payment_method = 'PayPal';
        }

        $order->save();

        // save order items relation
        $cartItems = \Cart::session(auth()->id())->getContent();
        foreach ($cartItems as $item) {
            $order->items()->attach($item->id, ['price' => $item->price, 'quantity'=> $item->quantity]);
        }

        // payment
        if($request->input('payment_method') == 'paypal'){
            $order->payment_method = 'PayPal';
            // redirect pp
            return redirect()->route('paypal.checkout', $order->id);
        }

        // empty cart
        \Cart::session(auth()->id())->clear();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
