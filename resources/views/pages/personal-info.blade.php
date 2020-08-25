@extends('layouts.app-layout')

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
            <li class="list"><span class="step highlight">2</span>
                <span class="title highlight">PERSONAL-INFO</span>
            </li>
            <i class="fas fa-shipping-fast highlight"></i>
            <li class="list"><span class="step">3</span>
                <span class="title">CHECKOUT</span>
            </li>
        </ul>
    </div>
    <!-- End of Breadcrumbs-->
    </header>
    <span id="formMsg"></span>
    <!-- Personal-Info -->
    <div class="btn-home"><a href=""><i class="fa fa-home"></i></a><span class="select">Personal Information</span></div>
    <div class="col-personal-info" id="personalInfo">
        <div class="address-container">
        <div class="personal-info-content">
            <div class="personal-add">
                <div class="billing-title">
                    <i class="fas fa-check icon"></i><span class="personal"> Billing Address</span>
                    <div class="manage-drop-btn">
                        <a href="#" class="manage-add">Manage <i class="fas fa-chevron-down"></i></a>
                        <ul class="manage-content">
                            <li><a href="#" data-toggle="modal" data-target="#billingAdd" class="new-billing-add">Create</a></li>
                            <li><a href="{{route('account.edit')}}">Edit</a></li>
                        </ul>
                    </div>   
                </div>
                <?php  ?>
                @forelse($billingAdd as $billAdd)    
                <div class="address-form">     
                    <label class="btn-radio">
                        <input type="radio" data-id="{{$billAdd->id}}" name="selected" class="select-bill-add" value="">     
                        <tr>
                            <td>{{$billAdd->name }}</td>
                            <td>{{$billAdd->lastname }}</td>,
                            <td>{{$billAdd->address }}</td>,  
                            <td>{{$billAdd->city }}</td>
                            <td>{{$billAdd->postcode }}</td>,
                            <td>{{$billAdd->region}}</td>       
                        </tr>
                    </label>                     
                </div>         
                <div class="address-form">     
                    <label class="btn-radio">
                        <input type="checkbox" data-id="{{$billAdd->id}}" id="shippingBtnCheck" name="selected" class="select-shipping-add" value="">
                        Ship to this address?     
                    </label>                     
                </div>
                @empty
                <div class="address-form">     
                    <label class="btn-radio">
                        <input type="radio" name="selected" class="select-shipping-add" value="">
                        You have no billing address, Please create one!     
                    </label>                     
                </div>
                @endforelse
                
            </div>
            <div class="personal-add">
                <div class="billing-title">
                    <i class="fas fa-truck icon"></i><span class="personal"> Shipping Address</span>
                    <div class="manage-drop-btn">
                        <a href="#" class="manage-add">Manage <i class="fas fa-chevron-down"></i></a>
                        <ul class="manage-content">
                            <li><a href="#" data-toggle="modal" data-target="#shippingAdd" id="btnShippingAdd" class="new-shipping-add">New</a></li>
                            <li><a href="{{route('account.edit')}}">Edit</a></li>
                        </ul>
                    </div>
                </div>          
                @if(session()->has('shipping_add'))
                <div class="address-form">
                    <label class="btn-radio">
                        <input type="radio" class="select-shipping-add" value="" checked="checked" id="shippingBtn">       
                        <tr>
                            <td>{{$shippingAdd['name']}}</td>
                            <td>{{$shippingAdd['lastname'] }}</td>,
                            <td>{{$shippingAdd['address'] }}</td>,
                            <td>{{$shippingAdd['city'] }}</td>
                            <td>{{$shippingAdd['region'] }}</td>
                            <td>{{$shippingAdd['postcode'] }}</td>,   
                            <td>{{ucfirst($shippingAdd['country']) }}</td>      
                        </tr>
                    </label>
                </div>
                @endif   
            </div>                                                                                 
        </div>
        <div class="proceed-to">
            <div class="to-checkout">
                <a href="{{route('checkout.index')}}" class="check btn-checkout">PROCEED TO CHECKOUT</a> 
            </div>
        </div>
        </div>
    <div class="order-total">

        @include('partials.checkout.order-total')
    </div>
    </div>
    <!-- End of Personal Info-->
    </div>
    @include('partials.modal.user-billing-address')
    @include('partials.modal.checkout-shipping-address')
   
@endsection

@section('extra-js')

    <script>

        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#userBillingAdd').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    method: "POST",
                    url: "{{route('billing.store')}}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        if(data.success) {  
                            $('#cancel').text('Close');
                            localStorage.setItem("Billing", data.success);
                            window.location.reload();
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

            if(localStorage.getItem("Billing")) {
                var success_html = '';
                    success_html += '<div class="success alertMsg" style="background-color: #edf9f0; color: #287d3c; text-align: center;">'
                        +'Your new billing address is successfully created.'+'</div>';
                    $('#formMsg').html(success_html);
                localStorage.clear();
            }

            // $('#btnShippingAdd').on('click', function(e) {
            //     e.preventDefault();
            //     $('.modal-title').text('Create Shipping Address');
            //     $('#billingAdd').modal('show');
            // })

            $('#userShipInfo').submit(function (e) {
                e.preventDefault();
                
                $.ajax({
                    method: "POST",
                    url: "{{route('shipping.store')}}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    async: false,
                    success: function(data) {
                        if(data.success) {  
                            $('#cancel').text('Close');
                            localStorage.setItem("Shipping", data.success);
                            window.location.reload();
                        }   
                    },   
                    error: (response) => {
                        if(response.status === 422) {
                             let errors = response.responseJSON.errors;
                            Object.keys(errors).forEach(function (key) {
                                $("#" + key + "Ship").addClass("is-invalid");
                                $("#" + key + "ShipError").children("strong").text(errors[key][0]);
                            });
                        } else {
                            console.log('success');
                        }
                    }
                })
            });

            if(localStorage.getItem("Shipping")) {
                var success_html = '';
                    success_html += '<div class="success alertMsg" style="background-color: #edf9f0; color: #287d3c; text-align: center;">'
                        +'Your new shipping address is successfully created.'+'</div>';
                    $('#formMsg').html(success_html);
                localStorage.clear();
            }

            $(':radio').on('change', function(event) {
                
                event.preventDefault();
                const id = $(this).data('id');      
                 
                if(id) {
                    $.ajax({
                        type:"GET",
                        url:"{{url('/checkout')}}/" + id,
                        data: {id:id},
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success: function(response) {          
                                                                              
                        },                           
                    })
                    return false; 
                }           
            }).first().prop('checked', true).trigger('change');

            $('#shippingBtnCheck').on('change', function(event) {
                
                event.preventDefault();
                const id = $(this).data('id');       
                 
                if(this.checked) {
                    $.ajax({
                        type:"GET",
                        url:"{{url('/checkout/personalinfo')}}/" + id,
                        data: {id:id},
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success: function(response) {          
                                                                                
                        },                           
                    })
                    return false; 
                } else {
                    
                }
            });

            $('#shippingBtnCheck').on('change', function(event) {
                
                event.preventDefault();
                const id = $(this).data('id');       
                 
                if(this.checked == false) {
                    $.ajax({
                        type:"GET",
                        url:"{{url('/checkout/personalinfo/shipping')}}/" + id,
                        data: {id:id},
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success: function(response) {          
                                                                                
                        },                           
                    })

                    return false; 
                } 
            });
        });

    </script>

@endsection
