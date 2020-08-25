@extends('layouts.app-layout')

@section('content')
<!-- Search box-->
<div class="search-box">
               
    @include('partials.components.nav-search')            
</div>
<!-- End of search box-->   
<!-- Breadcrumbs-->
<div class="breadcrumbs-container">
    <ul class="breadcrumbs-row">
        <li class="list"><span class="step highlight">1</span>
            <span class="title  highlight">SHOPPING CART</span>        
        </li>
        <i class="fas fa-shipping-fast highlight"></i>
        <li class="list"><span class="step">2</span>
            <span class="title">PERSONAL-INFO</span>
        </li>
        <i class="fas fa-shipping-fast"></i>
        <li class="list"><span class="step">3</span>
            <span class="title">CHECKOUT</span>
        </li>
    </ul>
</div>
<!-- End of Breadcrumbs-->
</header>
<span id="formCart"></span>
<!-- Cart Section-->
<div class="btn-home"><a href="{{route('home.index')}}"><i class="fa fa-home"></i></a><span class="select">Shopping Cart</span></div>
<div class="cart-view-container" id="cartView">   
    <div class="cart-content">         
        <div class="cart-details">
            @if(Cart::count() > 0)
            <button type="button" class="btn-clear" id="clearCart">Clear</button> 
            @endif  
            <div class="incart-container">
                @forelse(Cart::content() as $item)
                <div class="cart" id="cart-item">
                    <ul class="cart-nav-tag">
                        <li>Item Price</li>                
                        <li class="qty">Quantity</li>
                        <li class="name">Product Name</li>                         
                    </ul>              
                    <div class="product-incart">           
                        <div class="incart-details">
                            <a href="{{route('product.show', $item->model->slug)}}"><img src="{{asset('storage/images/'.$item->options->image)}}" alt=""></a>
                            <div class="product-title">          
                                <div class="incart-description">
                                <a href="{{route('product.show', $item->model->slug)}}">{{$item->name}}</a>
                                </div>
                                <div class="incart-btn">
                                    <div class="social-media-btn">
                                        <a href="#" class="media-btn-heart to-wishlist" data-id="{{$item->rowId}}"><i class="fas fa-heart"></i></a>
                                        <a href="#" class="media-btn-trash removeItem" id="btn_cart" data-id="{{$item->rowId}}"><i class="fas fa-trash-alt"></i></a>
                                    </div>                                                                             
                                </div>
                            </div>      
                        </div>
                        <div class="row-price-qty">
                            <div class="col-price-qty">
                                <div class="product-qty">
                                    <button class="qty-up" data-id="{{$item->rowId}}"><i class="fa fa-angle-up"></i></button>
                                    <input type="" class="quantity" id="quantity{{$item->rowId}}" data-id="{{$item->rowId}}" data-productQuantity="{{ $item->model->quantity }}" value="{{$item->qty}}">
                                    <button class="qty-down" data-id="{{$item->rowId}}"><i class="fa fa-angle-down"></i></button>
                                </div>  
                            
                            <span class="price">{{presentPrice($item->price)}}</span>
                            </div>    
                        </div> 
                    </div>
                </div>
                @empty

                @include('partials.components.emptyCart')

                @endforelse          
            </div>                  
        </div>
        <div class="cart-summary" id="cartSummary">
            <div class="figures">
                <div class="title"><p>Order Summary</p></div>
                <div class="item"><strong>{{Cart::count()}}</strong> - Item(s)</div>
                <div class="calculation">
                    <table class="table item-calc">
                        <tbody>
                            <tr>
                                <td><strong>Subtotal:</strong></td>
                                <td>{{presentPrice(Cart::subtotal())}}</td>
                            </tr>
                            <tr>
                                <td><strong>Tax(12%):</strong></td>
                                <td>{{presentPrice(Cart::tax())}}</td>
                            </tr>
                            <tr class="cart-total">
                                <td><strong>Cart Total:</strong></td>
                                <td><strong>{{presentPrice(Cart::total())}}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="checkout-btn-col">
                <div class="cart-btn-checkout">
                    @if(auth()->user())
                    <a href="{{route('personalinfo.index')}}" class="check btn-checkout">CHECKOUT</a> 
                    @else
                    <a href="{{route('checkout.index')}}" class="check btn-checkout">CHECKOUT</a>
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Cart Section-->
@endsection

@section('extra-js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.to-wishlist', function(event){
            event.preventDefault();  
            var id = $(this).data("id");
            var url = "{{url('/cart/wishlist')}}/" + id;

            $.ajax(url, {
                type:"POST",
                contentType: false,
                cache: false,
                processData: false,       
                dataType: "json",
                success:function(response) {
                    if(response.success) {  
                        var success_html = '';
                        success_html += '<div class="success alertMsg" style="background-color: #edf9f0; color: #287d3c; text-align: center;">'
                        +response.success+'</div>';
                        $('#formCart').html(success_html);
                        $("#cartCount").html(response.count);
                        $('#cartView').load(location.href+" #cartView>*","");
                        $("#cartContent").load(location.href+" #cartContent>*","");
                    } 
                }      
            })           
        });

        $(document).on('click', '.removeItem', function(event){
            event.preventDefault();  
            var id = $(this).attr("data-id");
            var url = "{{url('/cart/')}}/" + id;

            if(confirm("Are you sure you want to remove this item?")) {
                $.ajax(url, {
                    type:"DELETE",       
                    dataType: "json",
                    success:function(response) {
                        if(response.success) {  
                            var success_html = '';
                            success_html += '<div class="success alertMsg" style="background-color: #edf9f0; color: #287d3c; text-align: center;">'
                            +response.success+'</div>';
                            $('#formCart').html(success_html);
                            $("#cartCount").html(response.count);
                            $('#cartView').load(location.href+" #cartView>*","");
                            $("#cartContent").load(location.href+" #cartContent>*","");
                        } 
                    }      
                })
            }
        });

        $(document).on('click', '#clearCart', function(event){
            event.preventDefault();  
            var url = "{{url('/cart')}}";

            if(confirm("Are you sure you want to clear your cart?")) {
                $.ajax(url, {
                    type:"DELETE",       
                    dataType: "json",
                    success:function(response) {
                        if(response.success) {  
                            var success_html = '';
                            success_html += '<div class="success alertMsg" style="background-color: #edf9f0; color: #287d3c; text-align: center;">'
                            +response.success+'</div>';
                            $('#formCart').html(success_html);
                            $("#cartCount").html(response.count);
                            $('#cartView').load(location.href+" #cartView>*","");
                            $("#cartContent").load(location.href+" #cartContent>*","");
                        }           
                    }      
                })
            }
        });
  
        $(document).on('click', '.qty-down',function() {    
            const id = $(this).attr('data-id'); 
            var qtyElement = $('#quantity'+id);
            if (qtyElement.val() > 1) {
                var qty = parseInt($(qtyElement).val())-1;
            }    
            var quantity = $('#quantity').val(qty);
            const productQuantity = $(this).attr('data-productQuantity')
            var url = "{{url('/cart/')}}/" + id; 

            $.ajax(url, {
                type:"PATCH",
                data:{quantity:qty, productQuantity:productQuantity},       
                success:function(response) {
                    $(qtyElement).val(response.qty);
                    $("#cartCount").html(response.count);       
                    $('#cartSummary').load(location.href+" #cartSummary>*","");
                    $("#cartContent").load(location.href+" #cartContent>*","");
                    $("#msg-response").html(response.message);
                },
                error:function(response) {
                    window.location.reload();
                }      
            })                     
        });
   
        $(document).on('click', '.qty-up', function() { 
            const id = $(this).attr('data-id'); 
            var qtyElement = $('#quantity'+id);  
            var qty = parseInt($(qtyElement).val())+1;
            var quantity = $('#quantity').val(qty);
            
            const productQuantity = $(this).attr('data-productQuantity')
            var url = "{{url('/cart/')}}/" + id; 
    
            $.ajax(url, {
                type:"PATCH",
                data:{quantity:qty, productQuantity:productQuantity},       
                success:function(response) {
                    $(qtyElement).val(response.qty);
                    $("#cartCount").html(response.count);       
                    $('#cartSummary').load(location.href+" #cartSummary>*","");
                    $("#cartContent").load(location.href+" #cartContent>*","");
                    $("#msg-response").html(response.message);
                }      
            })                          
        })
   
    </script>
@endsection