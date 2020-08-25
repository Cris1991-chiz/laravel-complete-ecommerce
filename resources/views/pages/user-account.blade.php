@extends('layouts.app-layout')

@section('content')

 <!-- Search box-->
 <div class="search-box">
                        
    @include('partials.components.nav-search')            
</div>
<!-- End of search box-->
    
</header>
    <!-- My Account -->
    <x-alert/>  
    @if(auth()->user())
    <section class="account" id="account">
        <div class="btn-home"><a href="{{route('home.index')}}"><i class="fa fa-home"></i></a><span class="select">My Account</span></div>      
        <div class="account-container" id="account">
            <div class="col-account">
                
                @include('partials.user.profile')
            </div>              
            <div class="account-nav">
                <ul>
                    <li><a href="{{route('account.edit')}}" class=" highlight"><i class="fas fa-user-circle"></i> Account</a></li>
                    <li><a href="{{route('wishlist.index')}}"><i class="fas fa-clipboard-list"></i> Wishlist</a></li>
                    <li><a href="{{route('orders.index')}}"><i class="fas fa-th-list"></i> Orders</a></li>           
                    <li><a href="#"><i class="fas fa-coins"></i> Rewards</a></li>
                </ul>
            </div>
            <?php  ?>
            <div class="user-content" id="accountInfo">
                <div class="content-title"><i class="fa fa-user icon"></i><span class="personal">Personal Information</span></div>        
                <div class="address-info">
                    <strong class="billing-add">Billing Address</strong>
                    @forelse ($accountBillingAdd as $billing)
                    <div class="acct-address">
                        <address class="add">{{$billing->address}} <br>{{$billing->city}}, {{$billing->region}}, 
                            {{$billing->postcode}}, {{ucfirst($billing->country)}},</address>
                        <a href="#" data-id="{{$billing->id}}" class="edit-billing-add btn-a">EDIT</a> 
                    </div>
                    @empty
                    <div class="acct-address">
                        <address class="add">You have no billing address, <br>Please create one!</address>
                        <a href="#" data-id="0" class="edit-billing-add btn-a">EDIT</a>
                    </div>
                    @endforelse      
                </div>    
                <hr>
                <div class="address-info" >
                    <strong class="billing-add">Shipping Address</strong>
                    @forelse ($accountBillingAdd as $billing)
                    <div class="acct-address">
                        <address class="add">{{$billing->address}} <br>{{$billing->city}}, {{$billing->region}}, 
                            {{$billing->postcode}}, {{ucfirst($billing->country)}},</address>
                        <a href="#" data-id="{{$billing->id}}" class="edit-billing-add btn-a">EDIT</a> 
                    </div>
                    @empty
                    <div class="acct-address">
                        <address class="add">You have no shipping address, <br>Please create one!</address>
                        <a href="#" data-id="0" class="edit-billing-add btn-a">EDIT</a>
                    </div>
                    @endforelse              
                </div>    
            </div>
        </div>
    </section>
    @endif
    <!-- End of My Account -->
    <!-- Modal -->
    <section class="edit-info no-display"> 
       
    </section>
    @include('partials.modal.profile-info')
    @include('partials.modal.user-billing-address')
    <!-- End of Modal -->
       
@endsection

@section('extra-js')    
    <script>

        $(document).ready(function() {
            ('#accountInfo');
            window.location;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#pwdCheck").click(function() {
                if ($('#pwdCheck' == true)) {
                    $('.change-pwd').toggle();
                }
            });
                
            $("#imgCheck").click(function() {
                if ($('#imgCheck' == true)) {
                    $('.img-file').toggle();
                }
            });
        
            $('#userBillingAdd').on('submit', function(event){
                event.preventDefault();
                
                $.ajax({
                    url:"{{ url('/myaccount/update/billing') }}",
                    method:"POST",
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType:"json",
                    success: function(data) {
                        if(data.success) {  
                            var success_html = '';
                            success_html += '<div class="alert alert-success">'+data.success+'</div>';
                            $('#formOutput').html(success_html);
                            $('#cancel').text('Close');
                            $('#accountInfo').load(location.href+" #accountInfo>*","");
                        }                     
                    },
                    error: (response) => {
                        if(response.status === 422) {
                             let errors = response.responseJSON.errors;
                            Object.keys(errors).forEach(function (key) {
                                $("#" + key + "Input").addClass("is-invalid");
                                $("#" + key + "Error").children("strong").text(errors[key][0]);
                            });
                        } else {
                            console.log('success');
                        }
                    }                  
                })
            });

            $('.cancel').on('click', function(e) {
                window.location.reload();
            });

            $('.btn-edit').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id')
                if(id == 0) {
                    $('.modal-title').text('Create Billing Address');
                } else {
                    $('.modal-title').text('Edit Billing Address');
                }
                $('#billingAdd').modal('show');

                $.ajax({
                    method: "GET",
                    url: "{{url('myaccount/fetchdata')}}/" + id ,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        if(data) {
                            $('#nameInput').val(data.name);
                            $('#lastnameInput').val(data.lastname);
                            $('#phoneInput').val(data.phone);
                            $('#addressInput').val(data.address);
                            $('#cityInput').val(data.city);
                            $('#postcodeInput').val(data.postcode);
                            $('#regionInput').val(data.region);
                            $('#countryInput').val(data.country);
                            $('#id').val(id);
                            $('#button_action').val('update');
                        }                      
                    }                      
                })
            });
        });

    </script>
@endsection