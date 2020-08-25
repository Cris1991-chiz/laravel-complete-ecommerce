<div class="logo">
    <h1 >Shop<span class="highlight"> 'n' Go..</span></h1>
</div>
<form>
    <input type="text" placeholder="search">
    <button type="Submit" class="btn btn-secondary add"><i class="fa fa-search"></i></button>
</form>
<div class="cart-btn">     
    <a href="{{route('cart.index')}}"><i class="fas fa-shopping-cart"></i></a>
    <a class="cart-count"><span class="count-no" id="cartCount">{{getDataCount()}}</span></a>
    <label for="btn">Shopping Cart<i class="fa fa-caret-down"></i></label>  
    <ul class="cart-content" id="cartContent"> 
        @forelse (Cart::content() as $item)
        <div class="incart-item">
            <li><a href=""><img src="{{asset('storage/images/'.$item->options->image)}}" alt="">{{($item->name)}}</a></li>    
            <table>
                <tr>
                    <td><b>Price:</b> {{presentPrice($item->price)}}</td>
                    <td><b>Quantity:</b> x {{$item->qty}}</td>
                </tr>
            </table>                           
            <li class="itemRemove" data-id="{{$item->rowId}}"><a href=""><b>Remove</b></a></li>
        </div> 
        @empty
            
            <p class="empty-cart">Your shopping cart is empty..</p>
           
        @endforelse
        @if(Cart::count() > 0)
        <div class="cart-total">
            <table class="cart-total">
                <tr>
                  <td><b>Subtotal: </b><br>{{presentPrice(Cart::subtotal())}}</td>
                  <td><b>Total: </b><br> {{presentPrice(Cart::total())}}</td>
                </tr>
            </table>                      
        </div>
            @if(auth()->user())
            <a href="{{route('personalinfo.index')}}" class="btn-show-cart btn-a">Checkout</a>           
            @else
            <a href="{{route('checkout.index')}}" class="btn-show-cart btn-a">Checkout</a>
            @endif                     
        @endif 
    </ul>
</div> 
