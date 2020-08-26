@extends('layouts.app-layout')

@section('title', 'Checkout')

@section('stripe-css')

    <script src="https://js.stripe.com/v3/"></script>
    
@endsection

@section('content')
<!-- Search box-->
<div class="search-box">
               
    @include('partials.components.nav-search')            
</div>
<!-- End of search box-->  
<!-- Breadcrumbs-->
<div class="breadcrumbs-container">
    <ul class="breadcrumbs-row">
        <li class="list"><span class="step">1</span>
            <span class="title">SHOPPING CART</span>        
        </li>
        <i class="fas fa-shipping-fast"></i>
        <li class="list"><span class="step">2</span>
            <span class="title">PERSONAL-INFO</span>
        </li>
        <i class="fas fa-shipping-fast"></i>
        <li class="list"><span class="step highlight">3</span>
            <span class="title highlight">CHECKOUT</span>
        </li>
    </ul>
</div>
<!-- End of Breadcrumbs-->
</header>
    
<!-- Checkout Details -->
<div class="btn-home"><a href="{{route('home.index')}}"><i class="fa fa-home"></i></a><span class="select">Checkout</span></div>
<div class="checkout-view-container">
    <div class="checkout-content">                     
        <div class="checkout-details">
            <div class="cart-nav-title">     
                <li class="item-qty-title"><i class="fa fa-shopping-cart"></i><b>{{Cart::count()}} -</b> Item(s) in Cart</li>
                <li class="subtotal"><span>Subtotal: </span>{{presentPrice(Cart::subtotal())}} <i class="fa fa-chevron-circle-down" id="arrow-down"></i></li>
            </div>
            <div class="checkout-incart-container">
                @include('partials.checkout.checkout-incart')
            </div> 
            <div class="options">
                <div class="option-title"><i class="fa fa-plane"></i><span class="select">Select Shipping Method:</span></div>
                <div class="btn-option">
                    <input type="radio" id="ups" name="ups" value="ups">
                    <span id="ups">UPS Express</span><br>
                    <input type="radio" id="ems" name="ems" value="ems">
                    <span id="ems">EMS Express</span>- 5~10 days<br>
                </div>      
            </div>
            <div class="options">
                <div class="option-title"><i class="fa fa-credit-card"></i><span class="select">Select Payment Method:</span></div>
                <div class="btn-payment-option">
                    <div class="btn-radio">
                        <input type="radio" id="stripe1" name="stripe" value="stripe">          
                        <span id="stripe"><i class="fab fa-cc-stripe" id="stripe1" style="color: #666ee8;"></i></span>
                    </div>
                    <div class="btn-radio">
                        <input type="radio" id="paypal1" name="paypal" value="paypal">
                        <span id="paypal"><i class="fab fa-cc-paypal" style="color: #003087;"></i></span>
                    </div>
                </div>           
            </div>
            <?php ?>
            <div class="options">
            <div class="option-title"><i class="fa fa-credit-card"></i><span class="select">Card Information:</span></div>
            <form action="{{route('checkout.store')}}" method="post" id="payment-form">
                @csrf

                @if(auth()->user())

                    @if(session()->has('billing_add'))
                        @foreach($userBillAdd as $billAdd)
                        <div class="card-info">
                            <input type="hidden" id="name" name="name" value="{{$billAdd->name}} {{$billAdd->lastname}}"> 
                        </div>
                        <div class="card-info">    
                            <input type="hidden" id="address" name="address" 
                            value="{{$billAdd->address}}, {{$billAdd->city}} {{$billAdd->postcode}}, {{$billAdd->region}}, {{ucfirst($billAdd->country)}}">
                        </div>  
                        <div class="info">
                            <div class="card-info"> 
                                <input type="hidden" id="billingEmail" name="email" value="{{auth()->user()->email}}" readonly>
                            </div>
                            <div class="card-info"> 
                                <input type="hidden" id="phone" name="phone" value="{{$billAdd->phone}}">
                            </div>
                        </div>
                        @endforeach
                    @endif
                    @if(session()->has('billing_as_shipping'))
                        @foreach($billingAsShipping as $shippingAddress)
                        <div class="card-info">
                            <input type="hidden" id="name" name="shipping_name" value="{{$shippingAddress->name}} {{$shippingAddress->lastname}}"> 
                        </div>
                        <div class="card-info">    
                            <input type="hidden" id="address" name="shipping_address" 
                            value="{{$shippingAddress->address}}, {{$shippingAddress->city}} {{$shippingAddress->postcode}}, {{$shippingAddress->region}}, {{ucfirst($shippingAddress->country)}}">
                        </div>  
                        <div class="info">
                            <div class="card-info"> 
                                <input type="hidden" id="billingEmail" name="shipping_email" value="{{auth()->user()->email}}" readonly>
                            </div>
                            <div class="card-info"> 
                                <input type="hidden" id="phone" name="shipping_phone" value="{{$shippingAddress->phone}}">
                            </div>
                        </div>
                        @endforeach
                    @endif
                   
                    @if(session()->has('shipping_add'))          
                        <div class="card-info">
                            <input type="hidden" id="shippingName" name="shipping_name" value="{{$userShipAdd['name']}} {{$userShipAdd['lastname']}}"> 
                        </div>
                        <div class="card-info">    
                            <input type="hidden" id="shippingAddress" name="shipping_address" 
                            value="{{$userShipAdd['address']}}, {{$userShipAdd['city']}} {{$userShipAdd['postcode']}}, {{$userShipAdd['region'] }}, {{ucfirst($userShipAdd['country'])}}">
                        </div>  
                        <div class="info">
                            <div class="card-info"> 
                                <input type="hidden" id="shippingEmail" name="shipping_email" value="{{auth()->user()->email}}" readonly>
                            </div>
                            <div class="card-info"> 
                                <input type="hidden" id="shippingPhone" name="shipping_phone" value="{{$userShipAdd['phone']}}">
                            </div>
                        </div>
                    @endif
                @else
                    <div class="card-info"> 
                        <label for="cvv">Name</label>
                        <input type="text" id="name" name="name" value="{{old('name')}}">
                    </div>
                    <div class="card-info"> 
                        <label for="add">Billing Address</label>
                        <input type="text" id="address" name="address" value="{{old('address')}}">
                    </div>   
                    <div class="info">
                        <div class="card-info"> 
                            <label for="cvv">Email Address</label>
                            <input type="text" id="billingEmail" name="email" value="{{old('email')}}">
                        </div>             
                        <div class="card-info"> 
                            <label for="phone">Telephone No./Mobile No.</label>
                            <input type="text" id="phone" name="phone" value="{{old('phone')}}">
                        </div>
                    </div>
                    
                    <input type="checkbox" id="sameAsBilling" name="same-as-billing" value=""> Ship to this address?
                    <div class="guest-shipping-add"> 
                        <div class="card-info"> 
                            <label for="cvv">Name</label>
                            <input type="text" id="shippingName" name="shipping_name" value="{{old('name')}}">
                        </div>
                        <div class="card-info"> 
                            <label for="add">Billing Address</label>
                            <input type="text" id="shippingAddress" name="shipping_address" value="{{old('address')}}">
                        </div>   
                        <div class="info">
                            <div class="card-info"> 
                                <label for="cvv">Email Address</label>
                                <input type="text" id="shippingEmail" name="shipping_email" value="{{old('email')}}">
                            </div>             
                            <div class="card-info"> 
                                <label for="telno">Telephone No./Mobile No.</label>
                                <input type="text" id="shippingPhone" name="shipping_phone" value="{{old('phone')}}">
                            </div>
                        </div>
                    </div>
                @endif
                <div class="info">
                    <div class="card-info">
                        <label for="cname">Name on Card</label>
                        <input class="card-name" type="text" id="name_on_card" name="name_on_card" value="" required> 
                    </div>
                </div>
                <div class="card-number">    
                                
                    <label for="card-element">Credit or debit card</label>
                    <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                    </div>
                    
                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                
                </div> 
                </div>   
                <div class="options">              
                    <div class="option-title"><span class="select">Confirm:</span></i></div>
                    <input type="checkbox" id="confirm" name="confirm" value="confirm"> 
                    I have read and accepted the policies of return, refund, 
                    cancellation and all <a href="">terms and conditions.</a>        
                </div>
                <button type="submit" id="payment-completed" class="btn btn-secondary add">Checkout</button> 
            </form>                                                   
        </div>
        <div class="checkout-summary">
            
            @include('partials.checkout.checkout-summary')
        </div>
    </div>
</div>
<!-- Checkout Details -->
@endsection

@section('extra-js')
<script>

    //Click to view cart items
    const cartNav = document.querySelector('.cart-nav-title');
    const cartItems = document.querySelector('.checkout-incart-container');
    const arrowBtn = document.getElementById('arrow-down');

    cartNav.addEventListener('click', () => {

        cartItems.classList.toggle('cart-active');
        arrowBtn.classList.toggle('arrow-up');   
    });

    // Create a Stripe client.
    var stripe = Stripe('pk_test_51Gw5FBG81njHJtGRdih7al8U2gET5OGW5J7gt2mWIjQ6cbCTdEQ4AZ3gS7cCuxkrvxFXszsVgv68Vu5TiOQXzJB700iMACRyyr');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
        color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style, hidePostalCode: true});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.on('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
    event.preventDefault();

    document.getElementById('payment-completed').disabled = true;

    var sourceData = {
        name: document.getElementById('name_on_card').value,
        address: document.getElementById('address').value,
        phone: document.getElementById('phone').value,
        email: document.getElementById('billingEmail').value       
    }

    stripe.createToken(card, sourceData).then(function(result) {
        if (result.error) {
        // Inform the user if there was an error.
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;

        document.getElementById('payment-completed').disabled = false;

        } else {
        // Send the token to your server.
        stripeTokenHandler(result.token);
        }
        });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
    }

    //Billing address as shipping addres
    $('#sameAsBilling').click(function(){
        
        if(this.checked){
            $('#shippingName').val($('#name').val());
            $('#shippingAddress').val($('#address').val());         
            $('#shippingPhone').val($('#phone').val());
            $('#shippingEmail').val($('#billingEmail').val());
            $(".guest-shipping-add").hide();
        } else { 
            $('#shippingName').val($('').val());
            $('#shippingAddress').val($('').val());         
            $('#shippingPhone').val($('').val());
            $('#shippingEmail').val($('').val());
            $(".guest-shipping-add").show();
        };
    });

</script>
@endsection
