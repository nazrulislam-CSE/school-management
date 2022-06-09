<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;

class ProfileController extends Controller
{
	/* ================= Start ProfileView Method ================= */
    public function ProfileView(){
    	$id = Auth::user()->id;
    	$user = User::find($id);

    	return view('backend.user.view_profile',compact('user'));
    }
    /* ================= End ProfileView Method =================== */

    /* ================= Start ProfileEdit Method ================= */
    public function ProfileEdit(){
    	$id = Auth::user()->id;
    	$editData = User::find($id);
    	return view('backend.user.edit_profile',compact('editData'));
    }
    /* ================= End ProfileEdit Method =================== */

    /* ================= Start ProfileStore Method ================= */
    public function ProfileStore(Request $request){

    	$data = User::find(Auth::user()->id);
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->mobile = $request->mobile;
    	$data->address = $request->address;
    	$data->gender = $request->gender;

    	if ($request->file('image')) {
    		$file = $request->file('image');
    		@unlink(public_path('upload/user_images/'.$data->image));
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/user_images'),$filename);
    		$data['image'] = $filename;
    	}

    	$data->save();

    	Session::flash('success','User Profile Updated Successfully.');
    	return redirect()->route('profile.view');

    } // End Method 
    /* ================= End ProfileStore Method ================= */

    /* ================= Start PasswordView Method ================= */
    public function PasswordView(){
        return view('backend.user.edit_password');
    }
 	/* ================= End PasswordView Method ================= */

 	/* ================= Start PasswordUpdate Method ================= */
    public function PasswordUpdate(Request $request){
        $validatedData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);


        $hashedPassword = Auth::user()->password;
        
        if (Hash::check($request->oldpassword,$hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('error','Password Updated Successfully.');
        }else{
            return redirect()->back();
        }


    } // End Metod 
    /* ================= End PasswordUpdate Method ================= */

}
