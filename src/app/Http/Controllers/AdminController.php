<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $admins = User::where('role', 'admin')->get();

      return view('pages.admin.index', [
        'admins' => $admins,
      ]);
    }

    public function create()
    {
      return view('pages.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try {
        $verifiedData = $request->validate([
          'name' => 'required',
          'email' => 'required|email',
          'role' => 'admin',
          'password' => 'required',
        ]);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        User::create([
          'name' => $verifiedData['name'],
          'email' => $verifiedData['email'],
          'password' => Hash::make($verifiedData['password']),
        ]);
      }

      return redirect()->route('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $admin = User::find($id);

      return view('pages.admin.edit', [
        'admin' => $admin,
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $admin = User::find($id);
      try {
        $verifiedData = $request->validate([
          'name' => 'required',
          'email' => 'required|email',
          'password' => 'required',
        ]);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        $admin->update($verifiedData);
      }

      return redirect()->route('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        User::where('id', $id)->delete();
      } catch (Exception $e) {
        return abort(404, $e);
      }

      return redirect()->route('admin');
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function trash()
    {
      $admins = User::onlyTrashed()->get();
      return view('pages.admin.trash', ['admins' => $admins]);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function restore($id)
    {
      $admin = User::onlyTrashed()->findOrfail($id);
      $admin->restore();
      return redirect('admin')->with('message', 'Success restoring admin');
    }
    
    /**
     * undocumented function
     *
     * @return void
     */
    public function destroypermanent($id)
    {
      $admin = User::onlyTrashed()->where('id', $id)->delete();
      return redirect('admin')->with('message', 'Success removing admin permanently');
    }
    
}
