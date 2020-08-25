<?php

namespace App;

use App\Order;
use App\Billing;
use App\Shipping;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'lastname', 'email', 'password', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profileImage() {
       
        $imagePath = $this->image ? $this->image : 'no_profile_image.png';

        return 'storage/profile/' .$imagePath;
    }

    public function billing() {

        return $this->hasMany(Billing::class);
    }

    public function shipping() {

        return $this->hasMany(Shipping::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
