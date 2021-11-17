<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceItem;
use App\Models\ItemPrice;
use App\Models\Invoice;
use App\Models\Item;

class InvoicesController extends Controller
{
  public function invoices($type)
  {
    $invoices = Invoice::where('invoice_type', $type)->paginate(15);

    return view('invoices.all', ['invoices' => $invoices]);
  }

  public function sale()
  {
    $lastInvoice = Invoice::latest()->first();

    if (!is_null($lastInvoice)) {
      $id = $lastInvoice->id+1;
    } else {
      $id = 1;
    }

    return view('invoices.index', ['id' => $id]);
  }

  public function purchase()
  {
    $lastInvoice = Invoice::latest()->first();

    if (!is_null($lastInvoice)) {
      $id = $lastInvoice->id+1;
    } else {
      $id = 1;
    }

    return view('invoices.index', ['id' => $id]);
  }

  public function bounce()
  {
    $lastInvoice = Invoice::latest()->first();

    if (!is_null($lastInvoice)) {
      $id = $lastInvoice->id+1;
    } else {
      $id = 1;
    }

    return view('invoices.index', ['id' => $id]);
  }

  public function view($id)
  {
    $invoice = Invoice::where('id', $id)->first();

    return view('invoices.view', ['invoice' => $invoice]);
  }

  public function save(Request $request)
  {
    $invoiceData = $request->only('invoice_type','movement_type','total','discount_amount',
      'discount_percentage','total_discount','tax_rate', 'tax_value', 'total_tax', 'total_bill',
      'paid', 'residual'
    );

    $invoice = Invoice::create($invoiceData);

    $getItems = $request->only('item')['item'];
    $items = [];
    foreach ($getItems['id'] as $key => $value) {
      if (!is_null($value)) {

        $item = Item::find($value);

        if ($request->invoice_type == 'sale') {
          $totalBlance = ($item->store_balance-$getItems['qt'][$key]);
        } else {
          $totalBlance = ($item->store_balance+$getItems['qt'][$key]);
          // ItemPrice::create([
          //   'item_id' => $value,
          //   'purchasing_price' => $getItems['purchasing_price'][$key],
          //   'selling_price' => $getItems['selling_price'][$key],
          //   'quantity' => $getItems['qt'][$key],
          //   'item_total' => $getItems['item_total'][$key],
          // ]);
        }

        Item::where('id', $value)->update([
          'store_balance' => $totalBlance
        ]);

        InvoiceItem::create([
          'invoice_id' => $invoice->id,
          'item_id' => $value,
          'purchasing_price' => $getItems['purchasing_price'][$key],
          'selling_price' => $getItems['selling_price'][$key],
          'store_balance' => $getItems['store_balance'][$key],
          'quantity' => $getItems['qt'][$key],
          'total' => $getItems['item_total'][$key],
          'type' => $request->invoice_type
        ]);

      }
    }

    return response()->json(['id' => ($invoice->id+1)]);
  }
}
