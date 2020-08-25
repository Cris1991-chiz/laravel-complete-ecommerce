@extends('layouts.app-layout')

@section('content')
    <!-- Search box-->
    <div class="search-box">
                            
        @include('partials.components.nav-search')            
    </div>
    <!-- End of search box-->

    <!-- Drop Menu-->
        <div class="nav-bar" id="nav">
            
            @include('partials.components.drop-menu')          
        </div>
    <!-- End of Drop Menu-->
    </header>  
     <!-- Product Details-->
     <section>
         <?php ?>
        <div class="product-view-container">
            <h4>DJI Phantom 4 Pro Version 2.0 - <span class="product-features">The Phantom 4 Pro V2.0 features new low-noise propellers, 
                OcuSync, and a redesigned controller.</span></h4>
            <div class="col-product">
                <div class="product-details">
                    <div class="img-container">
                        <img id="featured" src="{{asset('storage/images/'.$product->image)}}" alt="drone">
                        <div class="sale"><p>Sale</p></div>
                    </div>
                    <div class="product-thumbnails">
                        <i class="fa fa-chevron-left" id="slideleft"></i>
                        <div id="productslider"> 
                            <img class="thumbnail active" src="{{asset('storage/images/'.$product->image)}}" alt="">
                            <img class="thumbnail" src="/storage/images/drone1.jpg" alt="">
                            <img class="thumbnail" src="/storage/images/drone2.jpg" alt="">
                            <img class="thumbnail" src="/storage/images/drone3.jpg" alt="">
                            <img class="thumbnail" src="/storage/images/drone5.jpg" alt="">
                            <img class="thumbnail" src="/storage/images/drone6.jpg" alt="">           
                        </div>
                        <i class="fa fa-chevron-right" id="slideright"></i>
                    </div>
                </div>
                <div class="product-details">
                    <div class="brand">             
                        <p><b>Brand: DJI</b></p>
                    </div> 
                    <p>Produt Code: HASYTWFD62</p>                  
                    <h3 class="price">USD $1,500.00<span class="price-sale">USD $1,799.00</span> </h3>
                    <p><b>Availability:<span class="stock"> In Stock</span></b></p>
                    <div class="product-qty">
                        <button class="qty-up" data-id="{{$product->id}}"><i class="fa fa-angle-up"></i></button>
                        <input type="text" class="qty-input" name="qty" id="qty" data-id="{{$product->id}}" value="{{$product->qty}}">
                        <button class="qty-down" data-id="{{$product->id}}"><i class="fa fa-angle-down"></i></button>
                    </div>        
                    <button class="btn btn-secondary add to-cart" data-id="{{$product->id}}">Add to Cart</button>   
                    <button type="button" class="btn btn-secondary wishlist">Add to Wishlist</button>
                    <hr>
                    <p>Share:</p>
                    <div class="social-media-btn">
                        <a class="media-btn-fb" href=""><i class="fab fa-facebook"></i></a>
                        <a class="media-btn-insta" href=""><i class="fab fa-instagram"></i></a>
                        <a class="media-btn-twit" href=""><i class="fab fa-twitter"></i></a>
                        <a class="media-btn-app" href=""><i class="fab fa-whatsapp"></i></a>
                    </div>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    0 reviews / Write a review
                    <hr>
                    <div class="free-shipping">
                        <p>Want a free shipping? Click<a href="#"> here</a> to find out more!</p>
                    </div>       
                </div>
            </div>
        </div>
    </section>
    <section>
    <div class="more-details">
        @include('products.more-details') 
    </div>
    </section>
    <!-- End of Product Details-->
    <!--Products also bought-->
    <section class="products-also-bought">
        <div class="products-container">
            
            @include('products.also-bought') 
        </div>
    </section>
    <!--Products also bought-->

    @include('partials.addtocart-modal')
        
@endsection

@section('extra-js')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $('.to-cart').on('click', function(event) {
            $('#add-ToCart').modal('show');
            event.preventDefault();        
            const id = $(this).data('id');
            
            if(id) {
                $.ajax({
                    type:"get",
                    url:"{{url('/cart/')}}/" + id,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(response) {          
                        $("#cartCount").html(response.count);
                        $("#msg-response").html(response.message);                                                         
                    },                           
                })
                return false; 
            }           
        });
         
        const up = $('.qty-up');
        const down  = $('.qty-down');
        down.on('click', function(e) {
            e.preventDefault();
            const id = $(this).attr('data-id');
            var qty = parseInt($('#qty').val());
            if (qty >= 1) {
            qty--;
            }
            var quantity = $('#qty').val(qty);           
            var url = "{{url('/product')}}/" + id + "/" + qty;
            $.ajax(url, {
                type: 'PATCH',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response){

                },
            });
            return false; 
        });

       
        up.on('click', function(e) {
            e.preventDefault();
            const id = $(this).attr('data-id');
            var qty = parseInt($('#qty').val());
            qty++;
            var quantity = $('#qty').val(qty);           
            var url = "{{url('/product')}}/" + id + "/" + qty;

            $.ajax(url, {
                type: 'PATCH', 
                contentType: false,
                cache: false,
                processData: false,
                success: function(response){
                   
                }
            });
            return false; 
        })
          
        //Drop-down Menu
        const iconBars = document.querySelector('.bars-icon');
        const dropMenu = document.querySelector('.drop-menu-container');
        const btnBars = document.getElementById('btn-bars');

        iconBars.addEventListener('click', () => {
            
            dropMenu.classList.toggle('responsive');
        });

        //Product hover images
        const thumbnails = document.getElementsByClassName('thumbnail')

        const activeImages = document.getElementsByClassName('active')

        for(var i=0; i < thumbnails.length; i++) {
            thumbnails[i].addEventListener('mouseover', function() {

                if(activeImages.length > 0) {
                    activeImages[0].classList.remove('active')
                }

                this.classList.add('active');
                document.getElementById('featured').src = this.src;
            });
        };

        //Product image slider arrow buttons
        const btnLeft = document.getElementById('slideleft');
        const btnRight = document.getElementById('slideright');

        btnLeft.addEventListener('click', function() {
            document.getElementById('productslider').scrollLeft -= 110;
        });

        btnRight.addEventListener('click', function() {
            document.getElementById('productslider').scrollLeft += 110;
        });
    });
</script>

@endsection

