<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settlement;
use App\Models\Customer;

class SettlementController extends Controller
{
    public function save(Request $request)
    {
        $data = $request->except(['_token']);
        
        Settlement::create($data);

        $customer = Customer::find($request->customer_id);

        if ($customer->balance < $request->paid) {
            $residual = $request->paid - $customer->balance;

            $customer->residual = $customer->residual + $residual;

            $customer->balance = 0;

            $customer->save();
        } else {
            $customer->balance = $customer->balance - $request->paid;

            $customer->save();
        }

    }
}
