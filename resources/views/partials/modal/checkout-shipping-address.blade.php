<!-- Edit Shipping Address-->
<div class="user-add">
    <div class="modal fade" id="shippingAdd"> 
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="edit-add">
                    <h2 class="modal-title">Create Shipping Address</h2>
                    <p>Your account information</p>
                </div>
                <span class="close" title="Close Modal" data-dismiss="modal" aria-label="Close">&times;</span>                
            </div>
            <form method="POST" id="userShipInfo">
                @csrf
            <div class="modal-body">
                <div class="container-1">
                    <input type="text" name="name" id="nameShip" placeholder="Name" value="" required>

                    <span class="invalid-feedback" role="alert" id="nameShipError">
                        <strong></strong>
                    </span>
                    
                    <input type="text" name="lastname" id=lastnameShip placeholder="Lastname"  value="" required>
        
                    <span class="invalid-feedback" role="alert" id="lastnameShipError">
                        <strong></strong>
                    </span>                    
                    
                    <input type="text" name="phone" id="phoneShip" placeholder="Phone"  value="" required>
                    
                    <span class="invalid-feedback" role="alert" id="phoneShipError">
                        <strong></strong>
                    </span>

                    <input type="text" placeholder="Address" name="address" id="addressShip" value="" required>

                    <span class="invalid-feedback" role="alert" id="addressShipError">
                        <strong></strong>
                    </span>

                    <select id="countryShip" name="country" value="" placeholder="Country" >
                        <option value="Philippines">Philippines</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Canada">Canada</option>
                    </select>

                    <input type="text" name="region" id="regionShip" placeholder="Region/State"  value="" required>

                    <span class="invalid-feedback" role="alert" id="regionShipError">
                        <strong></strong>
                    </span>

                    <input type="text" name="postcode" id="postcodeShip" placeholder="Postal Code" value="" required>
                    
                    <span class="invalid-feedback" role="alert" id="postcodeShipError">
                        <strong></strong>
                    </span>

                    <input type="text" name="city" id="cityShip" placeholder="City" value="" required>

                    <span class="invalid-feedback" role="alert" id="cityShipError">
                        <strong></strong>
                    </span>

                    <button type="submit" class="save-info">Save</button>                                   
                </div>
            </div>
            </form>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- End of Edit Billing Address -->