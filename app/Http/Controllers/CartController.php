<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cartItems = \Cart::session(auth()->id())->getContent();
        return view('cart.index', compact('cartItems'));
    }

    public function add($productId){
        $product = Product::find($productId);

        \Cart::session(auth()->id())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 4,
            'attributes' => array(),
            'associatedModel' => $product
        ));

        return redirect()->route('cart.index');
    }

    public function destroy($itemId){
        \Cart::session(auth()->id())->remove($itemId);

        return back();
    }

    public function update($itemId){
        \Cart::session(auth()->id())->update($itemId, array(
            'quantity' => array(
                'relative' => false,
                'value' => request('quantity')
            ),
        ));

        return back();
    }

    public function checkout(){
        return view('cart.checkout');
    }
}
