<?php

namespace App\Http\Controllers;

use App\Models\groupPermission;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function create()
    {
      return view('permissions.create');
    }

    public function store(Request $request)
    {
      $permissions = $request->except(['_token', 'title']);

      $groupPermissionID = groupPermission::create([
        'title' => $request->title
      ]);

      foreach ($permissions as $key => $value) {
        Permission::create([
          'group_permission_id' => $groupPermissionID->id,
          'key' => $key,
          'value' => $value,
        ]);
      }

      return redirect()->back()->with('success', __('تم أضافة جروب الصلاحيه بنجاح!'));
    }
}
