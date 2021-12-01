<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceItem;
use App\Models\Installment;
use App\Models\Item;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function itemsInventory(Request $request)
    {
      $items = Item::where('publish', 1);

      if(isset($request->cat_id)) {
        $items->where('cat_id', $request->cat_id);
      }

      if(isset($request->model)) {
        $items->where('model', $request->model);
      }

      if(isset($request->unit_id)) {
        $items->where('unit_id', $request->unit_id);
      }

      $allItems = [];

      if (isset($request->result)) {
        $allItems = $items->orderby('store_balance', 'DESC')->paginate(15);
      }
      return view('reports.items-inventory', ['items' => $allItems]);
    }

    public function saleInvoice(Request $request)
    {

      $start= date("Y-m-d",strtotime($request->from));
      $end= date("Y-m-d",strtotime($request->to));

      $items = InvoiceItem::select(
        'invoice_items.item_id',
        \DB::raw('sum(store_balance) as balances'),
        \DB::raw('sum(quantity) as quantities'),
        \DB::raw('sum(total) as totals')
      )
      ->where('type', 'sale')
      ->whereBetween('date', [$start, $end])
      ->groupby('item_id');

      $allItems = [];

      if (isset($request->result)) {
        $allItems = $items->paginate(50);
      }

      return view('reports.sales', ['items' => $allItems]);
    }

    public function daily(Request $request)
    {
      $start= date("Y-m-d",strtotime($request->from));

      $itemCash = InvoiceItem::join('invoices', function ($join) {
        $join->on('invoices.id', '=', 'invoice_items.invoice_id');
      })
      ->select(
        'invoice_items.item_id',
        \DB::raw('sum(invoice_items.store_balance) as balances'),
        \DB::raw('sum(invoice_items.quantity) as quantities'),
        \DB::raw('sum(invoice_items.total) as totals')
      )
      ->where('invoice_items.type', 'sale')
      ->where('invoices.movement_type', 'cash')
      ->where('date',$start)
      ->groupby('item_id');

      $itemDues = InvoiceItem::join('invoices', function ($join) {
        $join->on('invoices.id', '=', 'invoice_items.invoice_id');
      })
      ->select(
        'invoice_items.item_id',
        \DB::raw('sum(invoice_items.store_balance) as balances'),
        \DB::raw('sum(invoice_items.quantity) as quantities'),
        \DB::raw('sum(invoice_items.total) as totals')
      )
      ->where('invoice_items.type', 'sale')
      ->where('invoices.movement_type', 'dues')
      ->where('date',$start)
      ->groupby('item_id');

      $itemsCash = [];
      $itemsDues = [];
      $installments = [];

      if (isset($request->result)) {
        $itemsCash = $itemCash->get();
        $itemsDues = $itemDues->get();
        $installments = Installment::where('date',$start)->get();
      }

      return view('reports.daily', [
        'itemsCash' => $itemsCash,
        'itemsDues' => $itemsDues,
        'installments' => $installments
      ]);
    }
}
