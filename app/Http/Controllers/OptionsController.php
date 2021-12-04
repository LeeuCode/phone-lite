<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OptionsController extends Controller
{
  use \App\Traits\UploderImages;

  public function index()
  {
    return view('options.index');
  }

  public function update(Request $request)
  {
    $option = [];

    foreach ($request->except('_token') as $key => $value) {
        if (is_array($value)) {
            foreach ($value as $ky => $val) {
                if (is_array($val)) {
                    foreach ($val as $k => $v) {

                        if (is_object($v)) {
                            $file = $v;
                            $destinationPath = public_path('/images/'); // upload path
                            $imageName = date('YmdHis') . $file->getClientOriginalName();
                            $file->move($destinationPath, $imageName);

                            $option[$key][$ky][$k] =  $imageName;
                        } else {
                            $option[$key][$ky][$k] = $v;
                        }
                    }
                } else {
                    $option[$key][$ky] = $val;
                }
            }
        } else {
            if (is_object($value)) {
                $file = $value;
                $destinationPath = public_path('/images/'); // upload path
                $imageName = date('YmdHis') . $file->getClientOriginalName();
                $file->move($destinationPath, $imageName);
                $option[$key] = $imageName;
            } else {
                $option[$key] = $value;
            }
        }

        if (isset($option[$key])) {
            addOption($key, $option[$key]);
        }
        $option = [];
    }

    return redirect()->back()->with('success', __('تم تحديث البيانات بنجاح!'));
  }
}
