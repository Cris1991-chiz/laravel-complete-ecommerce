@if(auth()->user())
    <div class="title"><p>Order Information</p></div>
    <div class="checkout-info">
        <div class="name">
            <p><span><b>{{auth()->user()->name}}</b></span></p>
        </div>
        <div class="information">
            <table class="table item-calc">
                <tbody>
                    @if(session()->has('billing_add'))
                        @foreach($userBillAdd as $billAdd)
                        <tr>
                            <td class="table-d"><strong>Billing Address :</strong></td>
                            <td>{{$billAdd->name }} {{$billAdd->lastname }}, {{$billAdd->address }}, {{$billAdd->city }}
                            {{$billAdd->region}} {{$billAdd->postcode }}, {{ucfirst($billAdd->country)}}</td>
                        </tr>
                        @endforeach
                    @endif
                    @if(session()->has('shipping_add'))
                    <tr>
                        <td class="table-d"><strong>Shipping Address :</strong></td>
                        <td>{{$userShipAdd['name']}} {{$userShipAdd['lastname']}}, {{$userShipAdd['address']}}, {{$userShipAdd['city']}}
                            {{$userShipAdd['region']}} {{$userShipAdd['postcode']}}, {{ucfirst($userShipAdd['country'])}}</td>
                    </tr>
                    @else
                        @if(session()->has('billing_as_shipping'))
                            @foreach($billingAsShipping as $shippingAddress)
                            <tr>
                                <td class="table-d"><strong>Shipping Address :</strong></td>
                                <td>{{$shippingAddress->name}} {{$shippingAddress->lastname}}, {{$shippingAddress->address}}, {{$shippingAddress->city}}
                                    {{$shippingAddress->region}} {{$shippingAddress->postcode}}, {{ucfirst($shippingAddress->country)}}</td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td class="table-d"><strong>Shipping Address :</strong></td>
                            <td>You have no shipping address, please select <a href="{{route('personalinfo.index')}}">one.</a></td>
                        </tr>
                        @endif
                    @endif
                    <tr>
                        <td class="table-d shipping-method"><strong>Shipping Method :</strong></td>
                        <td class="shipping-method"><strong>USPS Express - Saver</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="checkout-bill">
            <table class="table item-bill">
                <tbody>
                    <tr>
                        <td><strong>Subtotal :</strong></td>
                        <td>{{presentPrice($newSubtotal)}}</td>
                    </tr>
                    <tr>
                        <td><strong>Discount({{session()->get('coupon')['name']}}) :</strong></td>
                        <td>{{presentPrice($discount)}}</td>
                    </tr>
                    <tr>
                        <td><strong>Tax(12%):</strong></td>
                        <td>{{presentPrice($newTax)}}</td>
                    </tr>
                    <tr class="total">
                        <td><strong>Total:</strong></td>
                        <td><strong>{{presentPrice($newTotal)}}</strong></td>
                    </tr>
                </tbody>
            </table>
        <hr>
    </div>
    <div class="btn-col">
        <div class="coupon">
            <input type="text" name="" id="" placeholder="coupon">
            <button type="button" class="btn btn-secondary">Submit</button>
        </div>
    </div>
@else
    <div class="title"><p>Order Information</p></div>
    <div class="checkout-info">
        <div class="information">
            <table class="table item-calc">
                <tbody>
                    <tr>
                        <td class="table-d shipping-method"><strong>Shipping Method :</strong></td>
                        <td class="shipping-method"><strong>USPS Express - Saver</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="checkout-bill">
            <table class="table item-bill">
                <tbody>
                    <tr>
                        <td><strong>Subtotal :</strong></td>
                        <td>{{presentPrice($newSubtotal)}}</td>
                    </tr>
                    <tr>
                        <td><strong>Discount({{session()->get('coupon')['name']}}) :</strong></td>
                        <td>{{presentPrice($discount)}}</td>
                    </tr>
                    <tr>
                        <td><strong>Tax(12%):</strong></td>
                        <td>{{presentPrice($newTax)}}</td>
                    </tr>
                    <tr class="total">
                        <td><strong>Total:</strong></td>
                        <td><strong>{{presentPrice($newTotal)}}</strong></td>
                    </tr>
                </tbody>
            </table>
        <hr>
    </div>
    <div class="btn-col">
        <div class="coupon">
            <input type="text" name="" id="" placeholder="coupon">
            <button type="button" class="btn btn-secondary">Submit</button>
        </div>
    </div>
@endif