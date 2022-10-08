<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;

class CustomersController extends Controller
{
    public function index()
    {
        $users = Customer::where('type', 'customer')
            ->where('publish', 1)
            ->paginate(15);

        return view('customers.index', ['users' => $users]);
    }

    public function purchases($id)
    {
        $user = Customer::find($id);
        $invoices = Invoice::where('customer_id', $id)->where('invoice_type', 'purchase')
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        return view('customers.sales', ['user' => $user, 'invoices' => $invoices]);
    }

    public function sales($id)
    {
        $user = Customer::find($id);
        
        $invoices = Invoice::where('customer_id', $id)
            ->where('invoice_type', 'sale')
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        return view('customers.sales', ['user' => $user, 'invoices' => $invoices]);
    }

    public function damages($id)
    {
        $user = Customer::find($id);

        $invoices = Invoice::where('customer_id', $id)
            ->where('invoice_type', 'bounce')
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        return view('customers.sales', ['user' => $user, 'invoices' => $invoices]);
    }

    public function bounces($id)
    {
        $user = Customer::find($id);
        $invoices = Invoice::where('customer_id', $id)
            ->where('invoice_type', 'bounce')
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        return view('customers.bounces', ['user' => $user, 'invoices' => $invoices]);
    }

    public function create()
    {
        return view('customers.create');
    }

    public function suppliers()
    {
        $users = Customer::where('type', 'suppliers')
            ->where('publish', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        return view('suppliers.index', ['users' => $users]);
    }


    // public function purchases ($id)
    // {
    //     $user = Customer::find($id);
    //     $invoices = Invoice::where('customer_id', $id)->where('invoice_type', 'sale')
    //         ->orderBy('created_at', 'DESC')
    //         ->paginate(15);

    //     return view('customers.sales', ['user' => $user, 'invoices' => $invoices]);
    // }

    public function supplierCreate()
    {
        return view('suppliers.create');
    }

    public function supplierEdit($id)
    {
        $user = Customer::find($id);

        return view('suppliers.edit', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        Customer::create($data);

        return redirect()->back()->with('success', __('تم أضافة مستخدم جديد بنجاح!'));
    }

    public function edit($id)
    {
        $user = Customer::find($id);

        return view('customers.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token']);
        Customer::where('id', $id)->update($data);

        return redirect()->back()->with('success', __('تم تعديل مستخدم جديد بنجاح!'));
    }

    public function searchCustomer($value = '')
    {
        // code...
    }

    public function destroy($id)
    {
        Customer::where('id', $id)->update([
            'publish' => 0
        ]);

        return redirect()->back()->with('success', __('تم حذف المستخدم بنجاح'));
    }
}
