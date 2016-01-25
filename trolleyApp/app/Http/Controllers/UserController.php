<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Sentinel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admin = Sentinel::findRoleBySlug('admin');
        $customer = Sentinel::findRoleBySlug('customer');
        $staff = Sentinel::findRoleBySlug('staff');
        $customers =  $customer->users()->get();
        $admins =  $admin->users()->get();
        $staffs =  $staff->users()->get();
        
        return view('admin/user/user', compact('customers', 'staffs', 'admins'));
    }

    public function addStaff()
    {
        return view('admin.user.addstaff');
    }
    public function showStaff($id)
    {
        $staff = User::findorfail($id);
        return view('admin.user.editstaff', compact('staff'));
    }

    public function storeStaff(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|email|unique:users,email|max:255', 
            'password'=>'required|min:6|max:32',
        ]);

        $new_user = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        $registered = Sentinel::registerAndActivate($new_user);
        if($registered){
          $user = User::find($registered->id);
          $user->name = $requset->name;
          $user->type = 'native';
          $user->active = 1;
          $user->save();
          $role = Sentinel::findRoleBySlug('staff');
          $role->users()->attach($user);
          //return $registered;
        }
        else{
            return redirect()->back()->withInput();
        }
        if($request->ajax())
        {
          return response()->json($registered);
        }
        return redirect()->route('admin.user');
    }
    public function storeAdmin(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|email|unique:users,email|max:255', 
            'password'=>'required|min:6|max:32',
        ]);

        $new_user = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        $registered = Sentinel::registerAndActivate($new_user);
        if($registered){
          $user = User::find($registered->id);
          $user->name = $requset->name;
          $user->type = 'native';
          $user->active = 1;
          $user->save();
          $role = Sentinel::findRoleBySlug('admin');
          $role->users()->attach($user);
          //return $registered;
        }
        else{
            return redirect()->back()->withInput();
        }
        if($request->ajax())
        {
          return response()->json($registered);
        }
        return redirect()->route('admin.user');
    }

    public function updateStaff(Request $request, $id)
    {
        //dd('goind to update');
        $this->validate($request, [
            'email'=> 'required|email|max:255'
        ]);

        //dd($request);
        $user = User::findorfail($id);

        if($user){
          $user->name = $request->name;
          $user->email = $request->email;
          $user->save();
        }

        return redirect()->route('admin.user');
    }
    public function updateAdmin(Request $request, $id)
    {
        //dd('goind to update');
        $this->validate($request, [
            'email'=> 'required|email|max:255'
        ]);

        //dd($request);
        $user = User::findorfail($id);

        if($user){
          $user->name = $request->name;
          $user->email = $request->email;
          $user->save();
        }

        return redirect()->route('admin.user');
    }

    public function addAdmin()
    {
        return view('admin.user.addadmin');
    }

    public function suspend($id)
    {
        $user = User::find($id);
        $user->active = 0;
        $user->save();
        return back();
    }   
    public function activate($id)
    {
        $user = User::find($id);
        $user->active = 1;
        $user->save();
        return back();
    }

    public function allowcod($id)
    {
        $user = User::findOrFail($id);
        $user->cod = 0;
        $user->save();
        return back();
    }
    public function blockcod($id)
    {
        $user = User::findOrFail($id);
        $user->cod = 1;
        $user->save();
        return back();
    }
}
