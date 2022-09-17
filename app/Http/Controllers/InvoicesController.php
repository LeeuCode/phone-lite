<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceItem;
use App\Models\ItemPrice;
use App\Models\Invoice;
use App\Models\Item;

class InvoicesController extends Controller
{
    public function invoice_purchases()
    {
        $invoices = Invoice::where('invoice_type', 'purchase')
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        return view('invoices.purchases', ['invoices' => $invoices]);
    }

    public function invoice_sales()
    {
        $invoices = Invoice::where('invoice_type', 'sale')
        ->orderBy('created_at', 'DESC')
        ->paginate(15);

        return view('invoices.sales', ['invoices' => $invoices]);
    }

    public function invoice_bounce()
    {
        $invoices = Invoice::where('invoice_type', 'bounce')
        ->orderBy('created_at', 'DESC')
        ->paginate(15);

        return view('invoices.slaes', ['invoices' => $invoices]);
    }

    public function sale()
    {
        $lastInvoice = Invoice::latest()->first();

        (!is_null($lastInvoice)) ? $id = $lastInvoice->id + 1 : $id = 1;

        return view('invoices.index', ['id' => $id]);
    }

    public function purchase()
    {
        // Get the last item in Invoices table.
        $lastInvoice = Invoice::latest()->first();

        // Check if has invoices in system or not.
        (!is_null($lastInvoice)) ?  $id = $lastInvoice->id + 1 : $id = 1;

        return view('invoices.index', ['id' => $id]);
    }

    public function bounce()
    {
        // Get the last item in Invoices table.
        $lastInvoice = Invoice::latest()->first();

        // Check if has invoices in system or not.
        (!is_null($lastInvoice)) ?  $id = $lastInvoice->id + 1 : $id = 1;

        return view('invoices.index', ['id' => $id]);
    }

    public function view($id)
    {
        $invoice      = Invoice::find($id);

        $invoiceItem  = InvoiceItem::where('invoice_id', $id)->get();

        return view('invoices.view', ['invoice' => $invoice, 'invoiceItem' => $invoiceItem, 'id' => $id]);
    }

    public function save(Request $request)
    {
        $invoiceData = $request->only(
            'invoice_type',
            'movement_type',
            'total',
            'discount_amount',
            'discount_percentage',
            'total_discount',
            'tax_rate',
            'tax_value',
            'total_tax',
            'total_bill',
            'paid',
            'residual',
            'customer_id'
        );

        $invoiceData['user_id'] = auth()->id();

        $invoice = Invoice::create($invoiceData);

        if ($invoiceData['total_bill'] > $invoiceData['paid']) {
            Invoice::where('id', $invoice->id)->update([
                'movement_type' => 'dues'
            ]);
        } else {
            Invoice::where('id', $invoice->id)->update([
                'movement_type' => 'cash'
            ]);
        }

        $getItems = $request->only('item')['item'];

        $items = [];

        foreach ($getItems['id'] as $key => $value) {
            if (!is_null($value)) {

                $item = Item::find($value);

                if ($request->invoice_type == 'sale') {
                    $totalBlance = ($item->store_balance - $getItems['qt'][$key]);
                } else {
                    $totalBlance = ($item->store_balance + $getItems['qt'][$key]);
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
                    'type' => $request->invoice_type,
                    'date' => date('Y-m-d')
                ]);
            }
        }

        return response()->json(['id' => ($invoice->id + 1)]);
    }

    public function invoiceDuesPay(Request $request)
    {
        $invoice = Invoice::find($request->id);
        $movementType = $invoice->movement_type;
        $piad = ($invoice->paid + $request->paid);

        if ($invoice->total_bill <= $piad) {
            $movementType = 'cash';
        }

        invoice::where('id', $request->id)->update([
            'paid' => $piad,
            'movement_type' => $movementType
        ]);
    }

    public function edit($id)
    {
        $invoice      = Invoice::find($id);
        $invoiceItem  = InvoiceItem::where('invoice_id', $id)->get();

        return view('invoices.edit', ['invoice' => $invoice, 'invoiceItem' => $invoiceItem, 'id' => $id]);
    }

    public function update(Request $request)
    {
        # code...
    }
}
