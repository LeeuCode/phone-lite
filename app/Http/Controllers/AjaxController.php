<?php

namespace App\Http\Controllers;

use App\Models\InstallmentMonth;
use Illuminate\Http\Request;
use App\Models\Installment;
use App\Models\ItemPrice;
use App\Models\Taxonomy;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Item;

class AjaxController extends Controller
{
    public function getCustomers(Request $request)
    {
        /* ====== Get value from search input. ====== */
        $search = $request->get('search');

        /* ====== Get all categories name where like search input value. ====== */
        $data = Customer::where('type', 'customer')->paginate(7);

        /* ====== Return store names as json. ====== */
        return response()->json(
            [
                'items' => $data->toArray()['data'],
                'pagination' => $data->nextPageUrl() ? true : false
            ]
        );
    }

    public function getSuppliers(Request $request)
    {
        /* ====== Get value from search input. ====== */
        $search = $request->get('search');

        /* ====== Get all categories name where like search input value. ====== */
        $data = Customer::where('type', 'suppliers')->paginate(7);

        /* ====== Return store names as json. ====== */
        return response()->json(
            [
                'items' => $data->toArray()['data'],
                'pagination' => $data->nextPageUrl() ? true : false
            ]
        );
    }

    public function getCategories(Request $request)
    {
        /* ====== Get value from search input. ====== */
        $search = $request->get('search');

        /* ====== Get all categories name where like search input value. ====== */
        $data = Taxonomy::select(['id', 'title'])
            ->where('type', 'category')
            ->where('publish', 1)
            ->where('title', 'like', '%' . $search . '%')
            ->orderBy('title')
            ->paginate(7);

        /* ====== Return store names as json. ====== */
        return response()->json(
            [
                'items' => $data->toArray()['data'],
                'pagination' => $data->nextPageUrl() ? true : false
            ]
        );
    }

    public function getModels(Request $request)
    {
        /* ====== Get value from search input. ====== */
        $search = $request->get('search');

        /* ====== Get all categories name where like search input value. ====== */
        $data = Taxonomy::select(['id', 'title'])
            ->where('type', 'model')
            ->where('publish', 1)
            ->where('title', 'like', '%' . $search . '%')
            ->orderBy('title')
            ->paginate(7);

        /* ====== Return store names as json. ====== */
        return response()->json(
            [
                'items' => $data->toArray()['data'],
                'pagination' => $data->nextPageUrl() ? true : false
            ]
        );
    }

    public function getunities(Request $request)
    {
        /* ====== Get value from search input. ====== */
        $search = $request->get('search');

        /* ====== Get all categories name where like search input value. ====== */
        $data = Taxonomy::select(['id', 'title'])
            ->where('type', 'unity')
            ->where('publish', 1)
            ->where('title', 'like', '%' . $search . '%')
            ->orderBy('title')
            ->paginate(7);

        /* ====== Return store names as json. ====== */
        return response()->json(
            [
                'items' => $data->toArray()['data'],
                'pagination' => $data->nextPageUrl() ? true : false
            ]
        );
    }

    public function getDamges(Request $request)
    {
        /* ====== Get value from search input. ====== */
        $search = $request->get('search');

        /* ====== Get all categories name where like search input value. ====== */
        $data = Taxonomy::select(['id', 'title'])
            ->where('type', 'damage')
            ->where('publish', 1)
            ->where('title', 'like', '%' . $search . '%')
            ->orderBy('title')
            ->paginate(7);

        /* ====== Return store names as json. ====== */
        return response()->json(
            [
                'items' => $data->toArray()['data'],
                'pagination' => $data->nextPageUrl() ? true : false
            ]
        );
    }

    public function getDvices(Request $request)
    {
        /* ====== Get value from search input. ====== */
        $search = $request->get('search');

        /* ====== Get all categories name where like search input value. ====== */
        $data = Taxonomy::select(['id', 'title'])
            ->where('type', 'devices')
            ->where('publish', 1)
            ->where('title', 'like', '%' . $search . '%')
            ->orderBy('title')
            ->paginate(7);

        /* ====== Return store names as json. ====== */
        return response()->json(
            [
                'items' => $data->toArray()['data'],
                'pagination' => $data->nextPageUrl() ? true : false
            ]
        );
    }

    public function getItem(Request $request)
    {
        $id = $request->id;
        $data['item'] = Item::where('publish', 1)->where('id', $id)->orWhere('barcode', $id)->first();
        // $data['itemPrice'] = ItemPrice::where('item_id', $data['item']->id)->where('quantity','>',0)->first();

        return response()->json($data);
    }

    public function getItems(Request $request)
    {
        /* ====== Get value from search input. ====== */
        $search = $request->get('search');

        /* ====== Get all categories name where like search input value. ====== */
        $data = Item::where('publish', 1)
            ->where('title', 'like', '%' . $search . '%')
            ->where('store_balance', '>', 0)
            ->paginate(7);

        /* ====== Return store names as json. ====== */
        return response()->json(
            [
                'items' => $data->toArray()['data'],
                'pagination' => $data->nextPageUrl() ? true : false
            ]
        );
    }

    public function createCategory(Request $request)
    {
        $request = $request->except(['_token']);
        $cat = Taxonomy::create($request);

        return response()->json([
            'id' => $cat->id,
            'status' => 200
        ]);
    }

    public function createUser(Request $request)
    {
        $request = $request->except(['_token']);
        $cat = Customer::create($request);

        return response()->json([
            'id' => $cat->id,
            'status' => 200
        ]);
    }

    public function getInstallmentByCustomer(Request $request)
    {
        echo '<option value="">' . __('اختر من الاجهزة') . '</option>';

        $installments = Installment::where('customer_id', $request->id)->get();

        foreach ($installments as $installment) {
            echo '<option value="' . $installment->id . '">' . $installment->item->title . '</option>';
        }
    }

    public function getMonthsByInstallment(Request $request)
    {
        echo '<option value="">' . __('اختار الشهر') . '</option>';

        $months = InstallmentMonth::where('installment_id', $request->id)
            ->where('state', 0)
            ->get();

        foreach ($months as $month) {
            echo '<option value="' . $month->id . '">' . $month->renewal_date . '</option>';
        }
    }

    public function getInvoiceRemainingAmount(Request $request)
    {
        $invoice = Invoice::where('id', $request->id)->first();

        return response()->json([
            'remaining_amount' => ($invoice->total_bill - $invoice->paid),
            'status' => 200
        ]);
    }

    public function getInvoicesDues(Request $request)
    {
        /* ====== Get value from search input. ====== */
        $search = $request->get('search');

        /* ====== Get all categories name where like search input value. ====== */
        $data = Invoice::where('movement_type', 'dues')
            ->where('id', 'like', '%' . $search . '%')
            ->paginate(7);

        /* ====== Return store names as json. ====== */
        return response()->json(
            [
                'items' => $data->toArray()['data'],
                'pagination' => $data->nextPageUrl() ? true : false
            ]
        );
    }

    public function checkBrcode($id)
    {
        // code...
    }

    public function getDuesCustomers(Request $request)
    {
        /* ====== Get value from search input. ====== */
        $search = $request->get('search');

        /* ====== Get all categories name where like search input value. ====== */
        $data = Customer::where('type', 'customer')
            ->where('balance','!=',0)
            ->paginate(7);

        /* ====== Return store names as json. ====== */
        return response()->json(
            [
                'items' => $data->toArray()['data'],
                'pagination' => $data->nextPageUrl() ? true : false
            ]
        );
    }

    public function getDuesSuppliers(Request $request)
    {
        /* ====== Get value from search input. ====== */
        $search = $request->get('search');

        /* ====== Get all categories name where like search input value. ====== */
        $data = Customer::where('type', 'suppliers')
        ->where('balance','!=',0)
        ->paginate(7);

        /* ====== Return store names as json. ====== */
        return response()->json(
            [
                'items' => $data->toArray()['data'],
                'pagination' => $data->nextPageUrl() ? true : false
            ]
        );
    }

    public function getCustomerBalance($id)
    {
        $customer = Customer::find($id);

        return response()->json(
            [
                'balance' => $customer->balance
            ]
        );
    }
}
