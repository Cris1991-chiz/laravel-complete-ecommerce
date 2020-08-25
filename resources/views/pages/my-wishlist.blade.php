@extends('layouts.app-layout')

@section('content')

 <!-- Search box-->
 <div class="search-box">
                        
    @include('partials.components.nav-search')            
</div>
<!-- End of search box-->
</header>
<!-- My Wishlist -->
<?php ?>
<span id="wishlistForm"></span>
@if(auth()->user())
<section class="account">
    <div class="btn-home"><a href="{{route('home.index')}}"><i class="fa fa-home"></i></a><span class="select">My Account</span></div>
    <div class="account-container">
        <div class="col-account">
            
             @include('partials.user.profile')
        </div>              
        <div class="account-nav">
            <ul>
                <li><a href="{{route('account.edit')}}"><i class="fas fa-user-circle"></i> Account</a></li>
                <li><a href="{{route('wishlist.index')}}" class=" highlight"><i class="fas fa-clipboard-list"></i> Wishlist</a></li>
                <li><a href="{{route('orders.index')}}"><i class="fas fa-th-list"></i> Orders</a></li>           
                <li><a href="#"><i class="fas fa-coins"></i> Rewards</a></li>
            </ul>
        </div>
        <div class="user-content" id="myWishlist">
            <div class="content-title"><i class="fa fa-heart icon"></i><span class="personal">My Wishlist</span></div>
            <div class="col-wishlist">
                <?php  ?>
                @forelse (Cart::instance('wishlist')->content() as $item)
                <div class="my-wishlist">
                    <div class="product-wishlist">           
                        <div class="wishlist-details">
                            <a href="product-view.html"><img src="{{asset('storage/images/'.$item->model->slug.'.jpg')}}" alt=""></a>
                            <div class="product-title">
                                <div class="wishlist-description">
                                    <a href="product-view.html">Phantom 3 Standard Quadcopter Drone with 2.7K HD Video Camera</a>
                                </div>
                            </div>      
                        </div>
                        <div class="wishlist-btn" id="wishlistBtn">
                            <div class="col-btn">
                                <div class="social-media-btn">
                                    <a  class="media-btn-cart to-cart" data-id="{{$item->rowId}}"><i class="fas fa-shopping-cart"></i></a>
                                    <a  class="media-btn-trash wishlist-item-remove" data-id="{{$item->rowId}}"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>    
                        </div> 
                    </div>
                </div>
                @empty
                    
                    <p>Wishlist Empty...</p>
                @endforelse
            </div>   
        </div>
    </div>
</section>
@endif
<!-- End of My Wishlist -->
@endsection

@section('extra-js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.to-cart', function(event){
            event.preventDefault();  
            var id = $(this).attr("data-id");
            var url = "{{url('/wishlist')}}/" + id;

            $.ajax(url, {
                type:"POST",       
                dataType: "json",
                success:function(response) {
                    if(response.success) {  
                        var success_html = '';
                        success_html += '<div class="success alertMsg" style="background-color: #edf9f0; color: #287d3c; text-align: center;">'
                        +response.success+'</div>';
                        $('#wishlistForm').html(success_html);
                        $("#cartCount").html(response.count);
                        $('#myWishlist').load(location.href+" #myWishlist>*","");
                    } 
                }      
            })           
        });

        $(document).on('click', '.wishlist-item-remove', function(event){
            event.preventDefault();  
            var id = $(this).attr("data-id");
            var url = "{{url('/wishlist')}}/" + id;

            if(confirm("Are you sure you want to remove this item?")) {
                $.ajax(url, {
                    type:"DELETE",       
                    dataType: "json",
                    success:function(response) {
                        if(response.success) {  
                            var success_html = '';
                            success_html += '<div class="success alertMsg" style="background-color: #edf9f0; color: #287d3c; text-align: center;">'
                            +response.success+'</div>';
                            $('#wishlistForm').html(success_html);
                            $('#myWishlist').load(location.href+" #myWishlist>*","");
                        } 
                    }      
                })
            }
        });

    </script>
@endsection