<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Hash;
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
      return view('users.create');
    }

    public function store(CreateUserRequest $request)
    {
      return back();
    }

    public function edit($id)
    {
      $user = User::find($id);
      return view('users.edit', ['user' => $user]);
    }
}
