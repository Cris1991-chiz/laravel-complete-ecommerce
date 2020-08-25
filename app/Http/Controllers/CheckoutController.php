<?php

namespace App\Http\Controllers;
use App\User;
use App\Order;
use App\Billing;
use App\Orderproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Session;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function index(Request $request)
    {    
        if(session()->has('shipping_add')) {

            session()->forget('billing_as_shipping');
        }
         
        $userBillAdd = session()->get('billing_add');

        $userShipAdd = session()->get('shipping_add');

        $billingAsShipping = session()->get('billing_as_shipping');

        return view('pages.checkout', compact('userBillAdd', 'userShipAdd', 'billingAsShipping'))->with([
            'tax' => $this->getNewCalculations()->get('tax'), 
            'discount' => $this->getNewCalculations()->get('discount'),
            'newSubtotal' => $this->getNewCalculations()->get('newSubtotal'),
            'newTax' => $this->getNewCalculations()->get('newTax'),
            'newTotal' => $this->getNewCalculations()->get('newTotal')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request)
    {
        $contents = \Cart::content()->map(function ($item) {
            return $item->options->image. ',' .$item->qty;
        })->values()->toJson();

        try {
            $charge = Stripe::charges()->create([
                'amount' => $this->getNewCalculations()->get('newTotal'),
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    //change to order ID after we start using DB
                     'contents' => $contents,
                     'quantity' => \Cart::instance('default')->count(),
                     'discount' => collect(session()->get('coupon'))->toJson()
                ]
            ]);

            $this->addOrdersTable($request, null);

            \Cart::instance('default')->destroy();
            session()->forget('coupon');
        
            return redirect()->route('confirmation.index')->with('message', 'Payment Successful');

        } catch(CardErrorException $e) {
            $this->addOrdersTable($request, $e->getMessage());

            return back()->withErrors('Errors!'. $e->getMessage());

        };
    }

    protected function addOrdersTable($request, $error) {

        // Insert into orders table

        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_email' => $request->email,
            'billing_phone' => $request->phone,
            'shipping_name' => $request->shipping_name,
            'shipping_address' => $request->shipping_address,
            'shipping_email' => $request->shipping_email,
            'shipping_phone' => $request->shipping_phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => $this->getNewCalculations()->get('discount'),
            'billing_discount_code' => $this->getNewCalculations()->get('code'),
            'billing_subtotal' => $this->getNewCalculations()->get('newSubtotal'),
            'billing_tax' => $this->getNewCalculations()->get('newTax'),
            'billing_total' => $this->getNewCalculations()->get('newTotal'),
            'error' => $error,
        ]);

        // Insert into order_product_table

        foreach(\Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty
            ]);
        }
    }

    public function storeBillingAdd(AddressRequest $request) {

        $input = $request->validated();
        $input['user_id'] = auth()->user() ? auth()->user()->id : null;
       
        $billingAdd = Billing::create($input);

        return response()->json([     
            'success' => 'Your new billing address is successfully created.'
        ]); 
    }

    public function selectBillingAdd($id) {

        $billAdd = DB::table('billings')->where('id', $id)->get();

        session()->put('billing_add', $billAdd);
    }

    public function checkShippingAdd($id) {

        if(session()->has('shipping_add')) {
            session()->forget('shipping_add');
        }
        
        $shipAdd = DB::table('billings')->where('id', $id)->get();

        session()->put('billing_as_shipping', $shipAdd);        
    }

    public function uncheckShippingAdd() {
        
        session()->forget('billing_as_shipping');
         
    }

    function getNewCalculations() {
        $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $code = session()->get('coupon')['name'] ?? null;
        $newSubtotal = (\Cart::subtotal() - $discount);
        if ($newSubtotal < 0) {
            $newSubtotal = 0;
        }
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1 + $tax);

        return collect([
            'tax' => $tax,
            'discount' => $discount,
            'code' => $code,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
        ]);
    }
}
