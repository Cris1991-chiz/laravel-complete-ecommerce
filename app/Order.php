<?php

namespace App;

use App\User;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'billing_name', 'billing_email', 'billing_address', 'billing_phone', 'shipping_name', 
    'shipping_email', 'shipping_address', 'shipping_phone', 'billing_name_on_card', 'billing_discount', 'billing_discount_code', 
    'billing_subtotal', 'billing_tax', 'billing_total', 'billing_shipped', 'billing_error'];


    public function user() {

        return $this->belongsTo(User::class);
    }   

    public function products() {

        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
