<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if(!$coupon) {
            return redirect()->route('checkout.index')->withErrors('Coupon is invalid');
        }

        session()->put('coupon', [
            'name' => $coupon->code,
            'discount' => $coupon->discount(\Cart::subtotal()) //store it in session and discount will be apply at subtotal
        ]);

        return redirect()->route('checkout.index')->with('message', 'Coupon is already applied');
    }

    public function destroy()
    {
        session()->forget('coupon');
        
        return redirect()->route('checkout.index')->with('message', 'Coupon has been remove');
    }
}
