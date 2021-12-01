<?php

namespace App\Http\Controllers;

use App\Models\InstallmentMonth;
use Illuminate\Http\Request;
use App\Models\Installment;
use App\Models\Item;

class InstallmentsController extends Controller
{
    public function index()
    {
      $installments = Installment::where('remaining_installments', '!=', 0)->paginate(15);
      return view('installments.index', ['installments' => $installments]);
    }

    public function installmentPaids()
    {
      $installments = Installment::where('remaining_installments', 0)->paginate(15);
      return view('installments.index', ['installments' => $installments]);
    }

    public function search(Request $request)
    {
      $installments = Installment::where('remaining_installments', '!=', 0);

      if (isset($request->agent_name)) {
        $installments->join('customers as name', function($join){
            $join->on('installments.customer_id','=' , 'name.id');
        })
        ->where('name.title', 'like', '%'.$request->agent_name.'%' );
      }

      if (isset($request->agent_phone)) {
        $installments->join('customers as phone', function($join){
            $join->on('installments.customer_id','=' , 'phone.id');
        })
        ->where('phone.phone', $request->agent_phone );
      }

      if (isset($request->item_id)) {
        $installments->join('items', function($join){
            $join->on('installments.item_id','=' , 'items.id');
        })
        ->where('items.id', $request->item_id );
      }

      if (isset($request->number_months)) {
        $installments->where('number_months', $request->number_months );
      }

      return view('installments.index', ['installments' => $installments->paginate(15)]);
    }

    public function create()
    {
      return view('installments.create');
    }

    public function store(Request $request)
    {
      $data = $request->except(['_token']);

      $data['user_id'] = 1;
      $installment = Installment::create($data);
      Item::where('id', $installment->item_id)->update([
        'store_balance' => $installment->balance,
      ]);

      for ($i=0; $i < $request->number_months; $i++) {
        $getNextDate = '+'.($i+1) .' month';
        InstallmentMonth::create([
          'installment_id' => $installment->id,
          'monthly_installment' => $request->monthly_installment,
          'renewal_date' => date('d-m-Y', strtotime($getNextDate))
        ]);
      }

      return redirect()->route('installments.view', ['id'=> $installment->id]);
    }

    public function view($id)
    {
      $installment = Installment::find($id);
      return view('installments.view', ['installment' => $installment]);
    }

    public function debtPayment($id)
    {
      $month = InstallmentMonth::find($id);

      $installment = Installment::find($month->installment_id);
      $remaining_installments = ($installment->remaining_installments-$installment->monthly_installment);
      $premiums_paid = ($installment->premiums_paid+1);

      Installment::where('id', $month->installment_id)->update([
        'remaining_installments' => $remaining_installments,
        'premiums_paid' => $premiums_paid,
        'date' => date('Y-m-d')
      ]);

      InstallmentMonth::where('id',$id)->update([
        'state' =>1
      ]);

      return response()->json([
        'renewal_date' => $month->renewal_date,
        'remaining_installments' => $remaining_installments,
        'premiums_paid' => $premiums_paid,
      ]);
    }
}
