<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'user_id', 'name', 'lastname', 'phone', 'company', 'address', 'city',
        'region', 'country', 'postcode', 
    ];

    public function user() {

        return $this->belongsTo(User::class);
    }
}
