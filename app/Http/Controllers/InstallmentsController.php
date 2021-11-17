<?php

namespace App\Http\Controllers;

use App\Models\InstallmentMonth;
use Illuminate\Http\Request;
use App\Models\Installment;

class InstallmentsController extends Controller
{
    public function index()
    {
      $installments = Installment::paginate(15);
      return view('installments.index', ['installments' => $installments]);
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
}
