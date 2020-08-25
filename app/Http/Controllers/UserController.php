<?php

namespace App\Http\Controllers;

use App\User;
use App\Billing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddressRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function edit(Request $request) {
     
        $accountBillingAdd = auth()->user() ? auth()->user()->billing()->get() : "";
      
        return view('pages.user-account', compact('user', auth()->user(), 'accountBillingAdd'));
    }

    public function logout() {
        
        session_unset();
        
        return view('pages.user-account');
    }
   
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(),
            'password' => 'sometimes|nullable|string|min:6|confirmed',
            'confirm_password' => '',
            'image' => '',
        ]);

        $user = auth()->user();
       
        $input =$request->except('new_password', 'confirm_password');  
      
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('profile', $fileName, 'public');

            $input['image'] = $fileName;
        }
        
        if(!$request->filled('new_password')) {
   
            $user->fill($input)->save();

            return back()->with('message', 'Your profile is successfully updated!');
        }
      
        if($request['new_password'] == $request['confirm_password']) {

            $user->password = Hash::make($request['new_password']);

        } else {

            return redirect()->back()->with('error', 'Password confirmation do not match');
        }

        $user->save();

        return back()->with('message', 'Your credential is successfully updated!');
    }

    public function fetchData(Request $request, $id) {
       
        $addressId = DB::table('billings')->find($id);
        
        $count= getBillingCount();

        if($count == 0) {
            $request->input();
            
        } else {       
            $dataAddress = ([
                'name' => $addressId->name,
                'lastname' => $addressId->lastname,
                'phone' => $addressId->phone,
                'address' => $addressId->address,
                'country' => $addressId->country,
                'region' => $addressId->region,
                'postcode' => $addressId->postcode,
                'city' => $addressId->city,
            ]);
           
            echo json_encode($dataAddress); 
        }       
    }

    public function updateBilling(AddressRequest $request) {
       
        $inputBilling = $request->validated();

        $inputBilling['user_id'] = auth()->user() ? auth()->user()->id : null;

        $count= getBillingCount();

        if($count == 0) {

            Billing::create($inputBilling);

            return response()->json([
                'success' => 'Your billing address is successfully created.'
            ]);   

        } elseif($request->get('button_action') == 'update') {
            
            $billingAddress = Billing::find($request->get('id'));
        
            $billingAddress->name = $request->get('name');
            $billingAddress->lastname = $request->get('lastname');
            $billingAddress->phone = $request->get('phone');
            $billingAddress->address = $request->get('address');
            $billingAddress->country = $request->get('country');
            $billingAddress->region = $request->get('region');
            $billingAddress->postcode = $request->get('postcode');
            $billingAddress->city = $request->get('city');

            $billingAddress->save();

            return response()->json([
                'success' => 'Your billing address is successfully updated.'
            ]);          
        }
    }
}
