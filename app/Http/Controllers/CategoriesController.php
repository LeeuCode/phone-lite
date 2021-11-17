<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taxonomy;

class CategoriesController extends Controller
{
    public function index()
    {
      $categories = Taxonomy::where('type', 'category')->where('publish', 1)->paginate(20);
      return view('categories.index', ['categories' => $categories]);
    }

    public function unities()
    {
      $categories = Taxonomy::where('type', 'unity')->where('publish', 1)->paginate(20);
      return view('categories.unities', ['categories' => $categories]);
    }

    public function models()
    {
      $categories = Taxonomy::where('type', 'model')->where('publish', 1)->paginate(20);
      return view('categories.models', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
      $request = $request->except(['_token']);
      Taxonomy::create($request);

      return redirect()->back()->with('success', __('تم أضافة العنصر بنجاح !'));
    }

    public function update(Request $request, $id)
    {
      $request = $request->except(['_token']);
      Taxonomy::where('id', $id)->update($request);
      return redirect()->back()->with('success', __('تم تعديل العنصر بنجاح !'));
    }

    public function status(Request $request,$id)
    {
      $request = $request->except(['_token']);
      Taxonomy::where('id', $id)->update($request);
      return redirect()->back()->with('success', __('تم حذف العنصر بنجاح !'));
    }
}
