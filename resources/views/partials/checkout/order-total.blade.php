<div class="cart-summary">
    <div class="figures">
        <div class="title"><p>Order Summary</p></div>
        <div class="item"><strong>{{Cart::count()}}</strong> - Item(s)</div>
        <div class="calculation">
            <table class="table item-calc">
                <tbody>
                    <tr>
                        <td><strong>Subtotal:</strong></td>
                        <td>{{presentPrice(Cart::subtotal())}}</td>
                    </tr>
                    <tr>
                        <td><strong>Tax(12%):</strong></td>
                        <td>{{presentPrice(Cart::tax())}}</td>
                    </tr>
                    <tr class="cart-total">
                        <td><strong>Cart Total:</strong></td>
                        <td><strong>{{presentPrice(Cart::total())}}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
