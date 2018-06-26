<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Blade;
use Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('admin')->user()->role != 1) { return view('errors.404'); }
        $users = Admin::all();
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if (Auth::guard('admin')->user()->role != 1) { return view('errors.404'); }

        $roles = Role::all();
        return view('admin.user.create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::guard('admin')->user()->role != 1) { return view('errors.404'); }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try{
            $user = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $roles = $request['roles']; //Retrieving the roles field
            //Checking if a role was selected
            if (isset($roles)) {

              foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
              }
            }

            return redirect('admin/user-lists')->with('success','Successfully add new user!');
        }catch(Exception $e){
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::guard('admin')->user()->role != 1) { return view('errors.404'); }
        $user = Admin::find($id);
        $roles = Role::all();
        return view('admin.user.edit',compact('user','roles'));
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',            
            'email' => 'unique:users,email,'.$id.'',      
        ]);
        $user = Admin::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            if ($request->password === $request->password_confirmation) {
                $user->password = bcrypt($request->password);
            }else{
                return back()->with('message','Plase check confirmation password.');
            }
        }
        $user->role = $request->role;
        $user->save();

        return redirect('admin/user-lists')->with('success','Successfully Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::guard('admin')->user()->role != 1) { return view('errors.404'); }
        $user = Admin::find($id)->delete();
        return back()->with('success','Successfully deleted!');
    }

    public function chaneUserStatus(Request $request)
    {
        $user = Admin::find($request->id);
        $user->role = $request->role;
        $user->save();

        return $user;
    }
}
