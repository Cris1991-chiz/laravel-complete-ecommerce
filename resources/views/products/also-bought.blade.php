<div class="also-bought-title"><p>Customers also bought..</p></div>             
<div class="column">
    @foreach($alsoBought as $product)
    <div class="products">
        <div class="img-container">
        <a href="product-view.html"><img src="{{asset('storage/images/'.$product->image)}}" alt=""></a>
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

