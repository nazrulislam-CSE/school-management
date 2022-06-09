<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;

class UserController extends Controller
{

	/* ================= Start UserView Method ================= */
    public function UserView(){
    	// $allData = User::all();
    	$data['allData'] = User::where('usertype','Admin')->get();
    	return view('backend.user.view_user',$data);

    }
    /* ================= End UserView Method =================== */

    /* ================= Start UserAdd Method ================= */
    public function UserAdd(){
    	return view('backend.user.add_user');
    }
    /* ================= Start UserAdd Method ================= */

    /* ================= Start UserStore Method ================= */
    public function UserStore(Request $request){

    	$validatedData = $request->validate([
    		'email' => 'required|unique:users',
    		'name' => 'required',
    	]);

    	$data = new User();
        $code = rand(000,9999);
    	$data->usertype = 'Admin';
    	$data->role = $request->role;
        $data->name = $request->name;
    	$data->email = $request->email;
    	$data->password = bcrypt($code);
        $data->code = $code;
    	$data->save();

    
    	Session::flash('success','User Inserted Successfully');
    	return redirect()->route('user.view');

    }
    /* ================= Start UserStore Method ================= */

    /* ================= Start UserEdit Method ================= */
    public function UserEdit($id){
    	$editData = User::find($id);
    	return view('backend.user.edit_user',compact('editData'));

    }
    /* ================= End UserEdit Method ================= */

    /* ================= Start UserUpdate Method ================= */
    public function UserUpdate(Request $request, $id){

    	$data = User::find($id);
    	$data->name = $request->name;
    	$data->email = $request->email;
        $data->role = $request->role;
        $data->usertype = $request->usertype;
    	$data->save();

    	Session::flash('success','User Updated Successfully');
    	return redirect()->route('user.view');

    }
    /* ================= End UserUpdate Method ================= */

    /* ================= Start UserDelete Method ================= */
    public function UserDelete($id){
    	$user = User::find($id);
    	$user->delete();

    	Session::flash('error','User Deleted Successfully');
    	return redirect()->route('user.view');

    }
    /* ================= End UserDelete Method ================= */
}
