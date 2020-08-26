@extends('layouts.app-layout')

@section('title', 'My Orders')

@section('content')

 <!-- Search box-->
 <div class="search-box">
                        
    @include('partials.components.nav-search')            
</div>
<!-- End of search box-->
    
</header>
<?php ?>
<span id="wishlistForm"></span>
@if(auth()->user())
<section class="account">
    <div class="btn-home"><a href="{{route('home.index')}}"><i class="fa fa-home"></i></a><span class="select">My Account</span></div>
    <div class="account-container">
        <div class="col-account">
            <div class="profile">
                @if(auth()->user()->profileImage())
                <img src="{{asset(auth()->user()->profileImage())}}" alt="">
                @else
                <img src="{{asset('storage/profile/no_profile_image.png')}}" alt="">
                @endif
                <p><b>{{auth()->user()->name}}</b></p>
                <p>{{auth()->user()->email}}</p>
                <a href="{{route('account.edit')}}" id="edit-profile">EDIT</a> 
            </div>

            @include('partials.user.profile')
        </div>              
        <div class="account-nav">
            <ul>
                <li><a href="{{route('account.edit')}}"><i class="fas fa-user-circle"></i> Account</a></li>
                <li><a href="{{route('wishlist.index')}}"><i class="fas fa-clipboard-list"></i> Wishlist</a></li>
                <li><a href="{{route('orders.index')}}" class=" highlight"><i class="fas fa-th-list"></i> Orders</a></li>           
                <li><a href="#"><i class="fas fa-coins"></i> Rewards</a></li>
            </ul>
        </div>
        <!-- My order -->
        <div class="user-content">
            <div class="content-title"><i class="fa fa-th-list icon"></i><span class="personal">My Order</span></div>
            <div class="col-order">
                @forelse($orders as $order)
                <div class="order-nav-title">     
                    <li class="item-qty-title"><b>Order ID:</b> {{$order->id}}</li>
                    <li class="subtotal"><strong>Total: </strong>{{presentPrice($order->billing_total)}}</li>
                </div>
                <div class="my-order">
                    <div class="order" id="order-item" data-id="{{$order->id}}">
                        <ul class="order-nav-tag">
                            <li class="name">Product Name</li>                 
                            <li class="billing-name">Billing Address</li>
                            <li class="shipping-name">Shipping Address</li>                                                   
                        </ul>
                       
                        @foreach($order->products as $product)
                        <div class="product-order">           
                            <div class="order-details">
                                <a href="product-view.html"><img src="{{asset('storage/images/'.$product->image)}}" alt=""></a>
                                <div class="product-title">
                                    <div class="order-description">
                                    <a href="product-view.html">{{$product->name}}</a>
                                    </div>
                                    <div class="order-amount">                                              
                                        <table class="order-table">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Qty :</strong></td>
                                                    <td>x1</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Subtotal :</strong></td>
                                                    <td>{{presentPrice($order->billing_subtotal)}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Discount :</strong></td>
                                                    <td>{{presentPrice($order->billing_discount)}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tax(12%):</strong></td>
                                                    <td>{{presentPrice($order->billing_tax)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>      
                            </div>
                            <div class="order-address">
                                <div class="col-address">
                                    <div class="shipping-add">
                                        <strong class="shipping">Shipping Address</strong>
                                        <address><strong>{{$order->shipping_name}}</strong>, <br>{{$order->shipping_address}}, <br>{{$order->shipping_phone}}</address>
                                    </div>
                                    <div class="billing-add">
                                        <strong class="billing">Billing Address</strong>
                                        <address><strong>{{$order->billing_name}}</strong>, <br>{{$order->billing_address}}, <br>{{$order->billing_phone}}</address>
                                    </div>
                                </div>    
                            </div> 
                        </div>
                        @endforeach
                    </div>          
                </div>
                @empty


                @endforelse
            </div>   
        </div>
        <!-- End of My order -->
    </div>
</section>
@endif

@endsection
