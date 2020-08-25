<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index() {

        return view('pages.my-wishlist');     
    }

    public function destroy($id) {
    
        \Cart::instance('wishlist')->remove($id);
  
        return response()->json([  
            'success' => 'Item is successfully removed.'
        ]);   
    }

     public function itemMoveToCart($id) {
    
        $item = \Cart::instance('wishlist')->get($id);

        \Cart::instance('wishlist')->remove($id);

        \Cart::instance('default')->add($item->id, $item->name, 1, $item->price)->associate('App\Product');

        $cartCount = \Cart::count();

        return response()->json([  
            'success' => 'Item is added to your cart.',
            'count' => $cartCount
        ]);   
    }

    public function clearWishlist() {
        
        \Cart::instance('wishlist')->destroy();

        return response()->json([
            'count' => getDataCount(),     
            'message' => 'Your cart is clear'
        ]);   
    }
}
