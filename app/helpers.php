<?php

use Gloudemans\Shoppingcart\Facades\Cart;

function getDataCount() {

    $count = \Cart::count();

    return $count;
}

function presentPrice($price) {

    $formatPrice = sprintf('%01.2f', $price);

    return '$' . number_format($formatPrice, 2, '.', ',');
}

function getNewCalculations() {

    $tax = config('cart.tax') / 100;
    $discount = session()->get('coupon')['discount'] ?? 0;
    $code = session()->get('coupon')['name'] ?? null;
    $newSubtotal = (\Cart::subtotal() - $discount);
    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }
    $newTax = $newSubtotal * $tax;
    $newTotal = $newSubtotal * (1 + $tax);

    return collect([
        'tax' => $tax,
        'discount' => $discount,
        'code' => $code,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
    ]);
}

function getBillingCount() {

    $count= DB::table('billings')->where('user_id', '=', auth()->user()->id)->count();

    return $count;
}
