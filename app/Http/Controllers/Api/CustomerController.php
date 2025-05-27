<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Auto suggest vakkal number in inwards.
     */
    public function getCustomer(Request $request)
    {
        $customer_id = $request->filled('cid') ? $request->cid : 0 ;
        $customer = Customer::find($customer_id);

        if(isset($customer)){
            return response ()->json ($customer);
        }
        else{
            return response ()->json (["status"=>404]);
        }
    }
}
