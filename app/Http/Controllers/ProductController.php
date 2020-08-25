<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    
    public function show(REQUEST $request, $slug) {

        $product = Product::where('slug', $slug)->firstorFail();

        $alsoBought = Product::where('slug', '!=', $slug)->inRandomOrder()->take(4)->get();

        return view('pages.product-view', compact('product', 'alsoBought'));
    }

    public function update(Request $request)
    {
        if($request->id && $request->qty) {
            $product = session()->get('products');
           
            //dd($request->qty);
            $product[$request->id]['qty'] = $request->qty;
            dd($request->qty);
            session()->push('products', $product);
            
            session()->flash('success', 'Cart updated successfully');
        }  
    }
}
