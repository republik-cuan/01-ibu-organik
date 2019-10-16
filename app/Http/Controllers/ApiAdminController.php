<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAdminController extends Controller
{
  public function index() {
    return User::all();
  }

  public function store(Request $request) {
    return User::create([
      'name' => $request->name,
      'email' => $request->email,
      'role' => $request->role,
      'password' => Hash::make($request->password),
    ]);
  }
}
