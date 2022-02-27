<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\GroupPermission;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
      $users = User::paginate(15);

      return view('users.index', ['users' => $users]);
    }

    public function create()
    {
      $permissions = GroupPermission::all();
      return view('users.create', ['permissions' => $permissions]);
    }

    public function store(CreateUserRequest $request)
    {
      $data = $request->except(['_token', 'password_confirmation', 'password']);
      $data['password'] = Hash::make($request->password);

      User::create($data);

      return redirect()->back()->with('success', __('تم أضافة مستخدم جديد بنجاح!'));
    }

    public function edit($id)
    {
      $user = User::find($id);
      $permissions = GroupPermission::all();
      return view('users.edit', ['user' => $user, 'permissions' => $permissions]);
    }

    public function update(Request $request, $id)
    {
      $data = $request->except(['_token', 'password_confirmation', 'password', 'change_password']);

      if(!is_null($request->change_password)){
        $data['password'] = Hash::make($request->password);
      }

      User::where('id', $id)->update($data);

      return redirect()->back()->with('success', __('تم تحديث المستخدم بنجاح!'));
    }
}
