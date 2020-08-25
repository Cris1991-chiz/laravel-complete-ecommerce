<!-- Edit Billing Address-->
<div class="user-add">
    <div class="modal fade" id="bil"> 
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="edit-add">
                    <h2 class="modal-title">Billing Address</h2>
                    <p>Your account information</p>
                </div>
                <span class="close" title="Close Modal" data-dismiss="modal" aria-label="Close">&times;</span>                
            </div>
            <form method="POST" id="userBillInfo">
            @csrf
            <div class="modal-body">
                <div class="container-1">
                    <input type="text" placeholder="Name" name="name" id="nameBill" value="">
                    
                    <span class="invalid-feedback" role="alert" id="nameError">
                        <strong></strong>
                    </span>

                    <input type="text" placeholder="Lastname"  class="@error('lastname') is-invalid @enderror" name="lastname" id="lastnameBill" value="">
                   
                    <span class="invalid-feedback" role="alert" id="lastnameError">
                        <strong></strong>
                    </span> 
                      
                    <input type="text" placeholder="Phone" name="phone" id="phoneBill" value="">

                    <span class="invalid-feedback" role="alert" id="phoneError">
                        <strong></strong>
                    </span>

                    <input type="text" placeholder="Address" name="address" id="addressBill" value="">

                    <span class="invalid-feedback" role="alert" id="addressError">
                        <strong></strong>
                    </span>

                    <select id="countryBill" name="country" value="" placeholder="Country">
                        <option value="australia">Philippines</option>
                        <option value="canada">Singapore</option>
                        <option value="usa">Canada</option>
                    </select>

                    <input type="text" placeholder="Region/State" name="region" id="regionBill" value="">
                        
                    <input type="text" placeholder="Postal Code" name="postcode" id="postcodeBill" value="">
                                       
                    <input type="text" placeholder="City" name="city" id="cityBill" value="">

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
    <!-- End of Edit Billing Address -->
</div>
