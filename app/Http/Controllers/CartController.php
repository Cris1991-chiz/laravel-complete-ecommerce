<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index(Request $request)
    {     
        return view('pages.cart')->with([
            'discount' => getNewCalculations()->get('discount'),
            'newSubtotal' => getNewCalculations()->get('newSubtotal'),
            'newTax' => getNewCalculations()->get('newTax'),
            'newTotal' => getNewCalculations()->get('newTotal'),
        ]);
    }

    public function addtocart(Request $request, $id)
    {     
        $product = DB::table('products')->where('id', $id)->first();

        $data = ([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $product->qty,
            'price' => $product->price,
            'weight' => 1,
            'options' => ['image' => $product->image],
        ]);
       
        $cart = \Cart::add($data)->associate('App\Product');
                 
        return response()->json([
            'count' => getDataCount(),
            'status' => (bool) $data,
            'data' => $data,
            'message' => $data ? 'Product added to your cart' : 'Error Creating Product'
        ]);     
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,20'
        ]);

        if($validator->fails()) {

            session()->flash('error', 'Quantity must be between 1 to 20');

            return response()->json(['success '=> false], 400); 
        }
       
        $item = \Cart::update($id, $request->quantity);

        session()->flash('message', 'Your Cart Updated Successfully');

        //dd($request->quantity);

        return response()->json([
            'qty' => $request->quantity,
            'count' => getDataCount(),
            'success '=> true
        ]); 
    }

    public function destroy($id)
    {       
        \Cart::remove($id);

        return response()->json([
            'count' => getDataCount(),     
            'success' => 'Item is successfully removed.'
        ]);   
    }

    public function clearCart()
    {    
        \Cart::destroy();

        return response()->json([
            'count' => getDataCount(),     
            'success' => 'Your cart is clear.'
        ]);   
    }

    public function addToWishlist($id) {

        $item = \Cart::get($id);

        \Cart::remove($id);

        $cartCount = \Cart::count();

        $wish = \Cart::instance('wishlist')->add($item->id, $item->name, 1, $item->price)->associate('App\Product');
        //dd($cartCount);
        return response()->json([
            'count' => $cartCount,     
            'success' => 'Item successfully added to your wishlist.'
        ]);   
    }
}
