<!-- Edit Billing Address-->
<div class="user-add">
    <div class="modal fade" id="billingAdd"> 
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="edit-add">
                    <h2 class="modal-title">Create Billing Address</h2>
                    <p>Your account information</p>
                    <span id="formOutput"></span>                  
                </div>             
                <span class="close cancel" id="close" title="Close Modal" data-dismiss="modal" aria-label="Close">&times;</span>                
            </div>
            <form method="POST" id="userBillingAdd">
                @csrf
                
                <div class="modal-body">
                    <div class="container-1">
                        <input type="text" name="name" id="nameInput" placeholder="Name" value="" required>

                        <span class="invalid-feedback" role="alert" id="nameError">
                            <strong></strong>
                        </span>
                       
                        <input type="text" name="lastname" id=lastnameInput placeholder="Lastname"  value="" required>
         
                        <span class="invalid-feedback" role="alert" id="lastnameError">
                            <strong></strong>
                        </span>                    
                        
                        <input type="text" name="phone" id="phoneInput" placeholder="Phone"  value="" required>
                        
                        <span class="invalid-feedback" role="alert" id="phoneError">
                            <strong></strong>
                        </span>

                        <input type="text" placeholder="Address" name="address" id="addressInput" value="" required>

                        <span class="invalid-feedback" role="alert" id="addressError">
                            <strong></strong>
                        </span>

                        <select id="userCountry" name="country" value="" placeholder="Country" required>
                            <option value="Philippines">Philippines</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Canada">Canada</option>
                        </select>

                        <input type="text" name="region" id="regionInput" placeholder="Region/State"  value="" required>

                        <span class="invalid-feedback" role="alert" id="regionError">
                            <strong></strong>
                        </span>

                        <input type="text" name="postcode" id="postcodeInput" placeholder="Postal Code" value="" required>
                        
                        <span class="invalid-feedback" role="alert" id="postcodeError">
                            <strong></strong>
                        </span>

                        <input type="text" name="city" id="cityInput" placeholder="City" value="" required>

                        <span class="invalid-feedback" role="alert" id="cityError">
                            <strong></strong>
                        </span>
                    
                        <input type="hidden" name="id" id="id" value="" />                     
                        <input type="hidden" name="button_action" id="button_action" value="" />
                        <button type="submit" class="save-info close-modal">Save</button>                                   
                    </div>
                </div>
            </form>
            <div class="modal-footer"> 
                <button type="button" id="cancel" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        </div>
    </div>
    <!-- End of Edit Billing Address -->
</div>
