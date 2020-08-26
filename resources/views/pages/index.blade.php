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
<x-alert/>
<!-- End of Navigation Bar-->
<!-- Carousel Slider-->
<div class="slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

        @include('partials.components.carousel-slider')
    </div>
</div>  
<!-- End of Carousel Slider-->
<!-- Category Container-->
<div class="category-container">
    <li class="active"><i class="fa fa-shopping-cart"></i></li>
    <li>SHOP BY CATEGORY</li>
</div>
<div class="col-category-btn">
    <div class="row-category-btn">

        @include('category.btn-category')
    </div>
</div>
<!-- End of Category Container-->
<!--Products Section-->
<section >
    <div class="col-product-container">
        <div class="vertical-banner">
            <ul> <li class="active">JUST ARRIVED</li></ul>               
            <img src="/storage/images/v-banner1.png" alt="">
            <img src="/storage/images/v-banner2.jpg" alt="">
        </div>      
        <div class="products-container">
            <div class="column">
               
                @foreach ($products as $product)
                <div class="products">
                    <div class="img-container">
                    <a href="{{route('product.show', $product->slug)}}"><img src="{{asset('storage/images/'.$product->image)}}" alt=""></a>
                    </div>
                    <div class="details">
                        <h5>{{$product->brand}}</h5>
                        <div class="description">
                            <a href=""><p>{{$product->name}}</p></a>
                        </div> 
                        <div class="btn-price">
                            <h5><span class="price">{{presentPrice($product->price)}}</span></h5>                                          
                            <button class="btn btn-secondary add to-cart" data-id="{{$product->id}}">Add to Cart</button>                          
                        </div>
                    </div>
                </div>  
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--End of Products Section-->
@endsection

@section('extra-js')

<script>

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
                    $("#cartContent").load(location.href+" #cartContent>*","");
                    $("#msg-response").html(response.message);                                                         
                },                           
            })
            return false; 
        }           
    });

    //Drop-down Menu
    const iconBars = document.querySelector('.bars-icon');
    const dropMenu = document.querySelector('.drop-menu-container');
    const btnBars = document.getElementById('btn-bars');

    iconBars.addEventListener('click', () => {
        
        dropMenu.classList.toggle('responsive');
    });

</script>

@endsection

