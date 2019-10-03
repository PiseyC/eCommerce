<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use DB;
use Session;
use Hash;
use Input;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $roles = Role::all();
        $users = User::orderBy('id', 'desc')->with('roles')->paginate(10);
        return view('manage.users.index')->withUsers($users)->withRoles($roles); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view("manage.users.create")->withRoles($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users'
          ]);

          if (!empty($request->password)) {
            $password = trim($request->password);
          } else {
            # set the manual password
            $length = 10;
            $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $str .= $keyspace[random_int(0, $max)];
            }
            $password = $str;
          }
    
          $user = new User();
          $user->name = $request->name;
          $user->email = $request->email;
          $user->password = Hash::make($password);

          if ($user->save()) {
              if ($request->roles) {
                $user->syncRoles(explode(',', $request->roles));
              }
              \LogActivity::addToLog($request->name);
  			      $notification = array('message' => 'User created successfully!','alert-type' => 'success');
              return redirect()->route('users.show', $user->id)->with($notification);
          } else {
              $notification = array('message' => 'Sorry a problem occurred while creating this user','alert-type' => 'error');
              return redirect()->route('users.create')->with($notification);
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
        $user = User::where('id',$id)->with('roles')->first();
        return view("manage.users.show")->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::where('id',$id)->with('roles')->first();
        return view("manage.users.edit")->withUser($user)->withRoles($roles);
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
          $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'status' => 'required|integer'
          ]);
    
          $user = User::findOrFail($id);
          $user->name = $request->name;
          $user->email = $request->email;
          $user->status = $request->status;
          if ($request->password_options == 'auto') {
            $length = 10;
            $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $str .= $keyspace[random_int(0, $max)];
            }
            $user->password = Hash::make($str);
          } elseif ($request->password_options == 'manual') {
            $user->password = Hash::make($request->password);
          }
          
          if ($user->save()) {
            $user->syncRoles(explode(',', $request->roles));
            $notification = array('message'=>'User updated!', 'alert-type'=>'success');
            \LogActivity::addToLog($request->name);
            return redirect()->route('users.index')->with($notification);
          } else {
            $notification = array('message' => 'There was a problem saving the updated user info to the database. Try again later.','alert-type'=>'error');
            return redirect()->route('users.edit', $id)->with($notification);
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        \LogActivity::addToLog($request->name);
        $notification= array('message' => 'User deleted!', 'alert-type' => 'success');
        return redirect()->route('users.index')->with($notification);
    }
}
