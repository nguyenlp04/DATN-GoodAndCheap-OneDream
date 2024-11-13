<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {

        $productId = $request->input('productId');
        $data = $request->input('data');
        $stock = $request->input('stock');
        $product_data = $request->input('productData');
        $user_id = auth()->user()->user_id;

        $dataJson = json_encode($data);

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay chưa
        $cartItems = Cart::where('user_id', $user_id)
                         ->where('product_id', $productId)
                         ->get();

        $found = false;
        foreach ($cartItems as $cartItem) {
            $existingData = json_decode($cartItem->data, true);

            // Loại bỏ stock ra khỏi cả hai dữ liệu để so sánh các thuộc tính khác
            unset($existingData['stock']);
            $tempData = $data;
            unset($tempData['stock']);

            if ($existingData == $tempData) {
                // Nếu các thuộc tính khác giống nhau, cập nhật stock
                $found = true;

                // Cập nhật stock trong `data`
                $existingStock = $cartItem->stock;
                $existingData['stock'] = $existingStock + $stock;
                $cartItem->stock = $existingData['stock'];
                $cartItem->data = json_encode(array_merge($existingData, ['stock' => $existingData['stock']]));
                $cartItem->save();
                return response()->json(['message' => 'Sản phẩm đã được cập nhật']);
            }
        }

        if (!$found) {
            $data['stock'] = $stock;
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $productId,
                'data' => json_encode($data),
                'stock' => $stock
            ]);
            return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng']);
        }
    }
    public function show(){

        $userId = auth()->user()->user_id;
        $carts = Cart::where('user_id', $userId)
        ->with('product.firstImage')
        ->get();

        // die($carts);
        return view('cart.cart-detail',['carts'=>$carts]);


    }
    public function updateStock(Request $request){
    $cart = Cart::find($request->cart_id);
    if ($cart) {
        $existingData = json_decode($cart->data, true);

        $existingData['stock'] = $request->stock;
        $cart->stock = $request->stock;
        $previousStock = $cart->stock;
        $cart->save();


        return response()->json([
            'success' => true,
            'cartId' => $cart->cart_id,
            'price' => $existingData['price'],
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
