<?php

namespace App\Http\Controllers;

use App\User;
use App\Billing;
use App\Shipping;
use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;

class BillingController extends Controller
{
    
    public function storeShippingAdd(AddressRequest $request) {
        //dd($request->all());
        $input = $request->validated();
        $input['user_id'] = auth()->user() ? auth()->user()->id : null;
        
        //$shippingAdd = auth()->user()->shipping->session()->put($input);
        $request->session()->put('shipping_add', $request->input());

        return response()->json([     
            'success' => 'Your new shipping address is successfully created.'
        ]); 
    }

    public function getBillingAdd(Request $request){

        $billingAdd = auth()->user() ? auth()->user()->billing()->get() : "";

        $billingToShipping = session()->get('billing_add');
       
        $shippingAdd = $request->session()->get('shipping_add');
        
        return view('pages.personal-info', compact('billingAdd', 'shippingAdd', 'billingToShipping'));
    }
}
