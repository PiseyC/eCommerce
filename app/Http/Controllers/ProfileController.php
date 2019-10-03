<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|editor|author|contributor|supporter|subscriber');
    }
    
    public function profile(){
        $user = User::where('id', Auth::user()->id )->first();
        return view('manage.users.profile')->withUser($user);
      }
  
    public function updateProfile(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
        ]);
        
        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        
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
            $notification = array('message'=>'Profile updated!', 'alert-type'=>'success');
            \LogActivity::addToLog($request->name);
            return redirect()->route('manage.profile')->with($notification);
        } else {
            $notification = array('message' => 'There was a problem saving the updated user info to the database. Try again later.','alert-type'=>'error');
            return redirect()->route('manage.profile')->with($notification);
        }
    }
}
