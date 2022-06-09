<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class AdminController extends Controller
{
	/* ================ Admin Logout Method =============== */
    public function Logout(){
 
    	Auth::logout();
        Session::flash('success','Admin Logout Successfully.');
    	return Redirect()->route('login');

    }

}
