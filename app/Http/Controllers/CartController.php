<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        return view('cart.cart-detail');
    }
    public function show(){

        // $userId = auth()->user()->user_id;
        $carts = Cart::where('user_id', 1)
        ->with('product.firstImage')
        ->get();

        // die($carts);
        return view('cart.cart-detail',['carts'=>$carts]);


    }
    public function updateStock(Request $request){
    $cart = Cart::find($request->cart_id);
    if ($cart) {
        $cart->stock = $request->stock;
        $previousStock = $cart->stock;
        $cart->save();


        return response()->json([
            'success' => true,
            'cartId' => $cart->cart_id,
            'price' => $cart->product->price,
            'previous_stock' => $previousStock]);
    }

    return response()->json(['success' => false], 400);
    }

    public function removeItem(Request $request){
        $cart = Cart::find($request->cart_id);
        if ($cart) {
            $cart->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }


}
