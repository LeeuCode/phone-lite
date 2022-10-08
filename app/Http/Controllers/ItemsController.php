<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taxonomy;
use App\Models\Item;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Item::where('publish', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
        return view('items.index', ['items' => $items]);
    }

    function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request = $request->except(['_token']);

        Item::create($request);

        return redirect()->back()->with('success', __('تم أضافةالصنف بنجاح !'));
    }

    public function edit($id)
    {
        return view('items.edit', ['item' => Item::find($id)]);
    }

    public function update(Request $request, $id)
    {
        $request = $request->except(['_token']);

        Item::where('id', $id)->update($request);

        return redirect()->back()->with('success', __('تم تعديل الصنف بنجاح !'));
    }

    public function balance()
    {
        return view('items.balance');
    }

    public function balanceStore(Request $request)
    {
        $item = Item::find($request->item_id);
        Item::where('id', $request->item_id)->update([
            'store_balance' => ($item->store_balance + $request->store_balance)
        ]);

        return redirect()->back()->with('success', __('تم أضافة رصيد اول المده بنجاخ!'));
    }

    public function status($id)
    {
        Item::where('id', $id)->update([
            'publish' => 0
        ]);

        return redirect()->back()->with('success', __('تم حذف الصنف بنجاح !'));
    }

    public function search(Request $request)
    {
        $items = Item::where('publish', 1);

        if (isset($request->title)) {
            $items->where('title', 'like', '%' . $request->title . '%');
        }

        $request = $request->except(['title']);

        // Get all request and loop to search
        foreach ($request as $key => $value) {
            if (!is_null($value))
                $items->where($key, $value);
        }

        return view('items.index', ['items' => $items->paginate(20)]);
    }

    public function outOfStock()
    {
        $items = Item::where('store_balance', '<=', 5)
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('items.out-of-stock', ['items' => $items]);
    }
}
