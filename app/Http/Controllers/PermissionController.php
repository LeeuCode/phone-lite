<?php

namespace App\Http\Controllers;

use App\Models\groupPermission;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
      $permissions = groupPermission::paginate(15);
      return view('permissions.index', ['permissions'=> $permissions]);
    }

    public function create()
    {
      return view('permissions.create');
    }

    public function edit($id)
    {
      $groupPermission = groupPermission::find($id);
      return view('permissions.edit', ['groupPermission' => $groupPermission]);
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

    public function update(Request $request, $id)
    {
      $permissions = $request->except(['_token', 'title']);

      $groupPermissionID = groupPermission::where('id', $id)->update([
        'title' => $request->title
      ]);

      Permission::where('group_permission_id', $id)->delete();

      foreach ($permissions as $key => $value) {
        Permission::create([
          'group_permission_id' => $id,
          'key' => $key,
          'value' => $value,
        ]);
      }

      return redirect()->back()->with('success', __('تم تعديل الصلاحيه بنجاح!'));
    }
}
