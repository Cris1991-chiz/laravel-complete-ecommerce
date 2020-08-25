 <!-- Checkout Details -->
 <div class="btn-home"><a href="index.html"><i class="fa fa-home"></i></a><span class="select">Checkout</span></div>
 <div class="checkout-view-container">
     <div class="checkout-content">                     
         <div class="checkout-details">
             <div class="cart-nav-title">     
                 <li class="item-qty-title"><i class="fa fa-shopping-cart"></i><b>2 -</b> Item(s) in Cart</li>
                 <li class="subtotal"><span>Subtotal: </span>$ 2,400.00 <i class="fa fa-chevron-circle-down" id="arrow-down"></i></li>
             </div>
             <div class="checkout-incart-container">
                 <div class="cart" id="cart-item">
                     <ul class="cart-nav-tag">
                         <li>Item Price</li>                
                         <li class="qty">Quantity</li>
                         <li class="name">Product Name</li>                         
                     </ul>
                     <div class="product-incart">           
                         <div class="incart-details">
                             <a href="product-view.html"><img src="images/drone3.jpg" alt=""></a>
                             <div class="product-title">
                                 <p><b>DJI - Phatom 4</b></p>
                                 <p>This is the description, you have to put it here. Thank you.</p>
                             </div>      
                         </div>
                         <div class="row-price-qty">
                             <div class="col-price-qty">
                             <select class="quantity" name="" id="qty">
                                 <option value="">1</option>
                                 <option value="">2</option>
                                 <option value="">3</option>
                             </select>
                             <span class="price">$1,200</span>
                             </div>    
                         </div> 
                     </div>
                 </div>          
                 <div class="cart" id="cart-item">
                     <ul class="cart-nav-tag">
                         <li>Item Price</li>                
                         <li class="qty">Quantity</li>
                         <li class="name">Product Name</li>                         
                     </ul>
                     <div class="product-incart">           
                         <div class="incart-details">
                             <a href="product-view.html"><img src="images/drone3.jpg" alt=""></a>
                             <div class="product-title">
                                 <h5>Brand</h5>
                                 <p>This is the description, you have to put it here. Thank you.</p>
                             </div>      
                         </div>
                         <div class="row-price-qty">
                             <div class="col-price-qty">
                             <select class="quantity" name="" id="qty">
                                 <option value="">1</option>
                                 <option value="">2</option>
                                 <option value="">3</option>
                             </select>
                             <span class="price">$1,200</span>
                             </div>    
                         </div> 
                     </div>
                 </div>
             </div>
             <form action="">
                 <div class="options">
                     <div class="option-title"><i class="fa fa-plane"></i><span class="select">Select Shipping Method:</span></div>
                     <div class="btn-option">
                         <input type="radio" id="ups" name="ups" value="ups">
                         <span id="ups">UPS Express</span><br></input>
                         <input type="radio" id="ems" name="ems" value="ems">
                         <span id="ems">EMS Express</span>- 5~10 days<br></input>
                     </div>      
                 </div>
                 <div class="options">
                     <div class="option-title"><i class="fa fa-credit-card"></i><span class="select">Select Payment Method:</span></div>
                     <div class="btn-payment-option">
                         <div class="btn-radio">
                             <input type="radio" id="stripe1" name="stripe" value="stripe">          
                             <span id="stripe"><i class="fa fa-cc-stripe" id="stripe1" style="color: #666ee8;"></i></span></input>
                         </div>
                         <div class="btn-radio">
                             <input type="radio" id="paypal1" name="paypal" value="paypal">
                             <span id="paypal"><i class="fa fa-cc-paypal" style="color: #003087;"></i></span></input>
                         </div>
                         <div class="btn-radio">
                             <input type="radio" id="discover1" name="discover" value="discover">
                             <span id="discover"><i class="fa fa-cc-discover" style="color: #ffa500;"></i></span></input>
                         </div>
                     </div>           
                 </div>
                 <div class="options">
                 <div class="option-title"><i class="fa fa-credit-card"></i><span class="select">Card Information:</span></div>
                 <div class="card-info">
                     <label for="cname">Name on Card</label>
                     <input type="text" id="cname" name="cardname" placeholder="Cris Panaligan">
                 </div> 
                 <div class="card-number">
                     <div class="card-info">
                         <label for="cnum">Card number</label>
                         <input class="card-no" type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444"> 
                     </div>
                     <div class="card-info"> 
                         <label for="expyear">Exp Year</label>
                         <input type="text" id="expyear" name="expyear" placeholder="2020">
                     </div>
                     <div class="card-info"> 
                         <label for="cvv">CVV</label>
                         <input type="text" id="cvv" name="cvv" placeholder="123">
                     </div>
                 </div>
                 </div>   
                 <div class="options">              
                     <div class="option-title"><span class="select">Confirm:</span></i></div>
                     <input type="checkbox" id="confirm" name="confirm" value="confirm"> 
                     I have read and accepted the policies of return, refund, 
                     cancellation and all <a href="">terms and conditions.</a></input>         
                 </div>
                 <button type="submit" class="btn btn-secondary add">Checkout</button> 
             </form>                                                    
         </div>
         <div class="checkout-summary">
             <div class="title"><p>Shipping Information</p></div>
             <div class="info">
                 <div class="name">
                     <p><span><b>Cris Panaligan</b></span></p>
                 </div>
                 <div class="information">
                     <p><span>Billing Address :</span>Blk 127, Lot 27, 29th Ave. East Rembo Makati City Metro Manila Philippines, 1216</p>
                 </div>
                 <div class="information">
                     <p><span>Shipping Address :</span>Blk 127, Lot 27, 29th Ave. East Rembo Makati City Metro Manila Philippines, 1216</p>
                 </div>
                 <div class="information">
                     <p><span>Shipping Method :</span>USPS Express - Saver</p>
                 </div>
                 <hr>
                 <div class="information">
                     <p><span>Subtotal :</span>$ 2,400.00</p>
                 </div>
                 <div class="information">
                     <p><span>Tax(12%) :</span>$ 288.00</p>
                 </div>
                 <div class="information">
                     <p><span>Discount :</span>$ 10.99</p>
                 </div>
                 <hr>
                 <div class="btn-checkout-row">
                     <a href="#" class="check btn-checkout">Total : $ 2,677.01</a> 
                 </div>
             </div>
             <div class="btn-col">
                 <div class="coupon">
                     <input type="text" name="" id="" placeholder="coupon">
                     <button type="button" class="btn btn-secondary">Submit</button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Checkout Details -->