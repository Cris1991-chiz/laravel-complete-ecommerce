@forelse(Cart::content() as $item)
    <div class="cart" id="cart-item">
        <ul class="cart-nav-tag">
            <li>Item Price</li>                
            <li class="qty">Quantity</li>
            <li class="name">Product Name</li>                         
        </ul>
        <div class="product-incart">           
            <div class="incart-details">
                <a href="product-view.html"><img src="{{asset('storage/images/'.$item->options->image)}}" alt=""></a>
                <div class="product-title">
                    <div class="incart-description">
                        <a href="product-view.html">{{$item->name}}</a>
                    </div>
                </div>      
            </div>
            <div class="row-price-qty">
                <div class="col-price-qty">
                    <div class="product-qty">  
                        <input type="" class="quantity" data-productQuantity="{{ $item->model->quantity }}" value="{{$item->qty}}">
                    </div>            
                <span class="price">{{presentPrice($item->price)}}</span>
                </div>    
            </div> 
        </div>
    </div>          
@endforeach