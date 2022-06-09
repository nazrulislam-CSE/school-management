<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use Session;


class StudentClassController extends Controller
{
	/* ================= Start ViewStudent Method ================= */
    public function ViewStudent(){
    	$data['allData'] = StudentClass::all();
    	return view('backend.setup.student_class.view_class',$data);

    }
    /* ================= End ViewStudent Method ================= */

    /* ================= Start StudentClassAdd Method ================= */
    public function StudentClassAdd(){
    	return view('backend.setup.student_class.add_class');
    }
    /* ================= End StudentClassAdd Method ================= */

    /* ================= Start StudentClassStore Method ================= */
    public function StudentClassStore(Request $request){

    	$validatedData = $request->validate([
    		'name' => 'required|unique:student_classes,name',
    		
    	]);

        $data = StudentClass::create([
            'name' => $request->name
        ]);

        // dd($request->all());

    	// $data = new StudentClass;
    	// $data->name = $request->name;
    	// $data->save();

    	Session::flash('success','Student Class Inserted Successfully');
    	return redirect()->route('student.class.view');

    }
    /* ================= Start StudentClassStore Method ================= */

    /* ================= Start StudentClassEdit Method ================= */
    public function StudentClassEdit($id){
    	$editData = StudentClass::find($id);
    	return view('backend.setup.student_class.edit_class',compact('editData'));

    }
    /* ================= End StudentClassEdit Method ================= */

    /* ================= Start StudentClassUpdate Method ================= */
    public function StudentClassUpdate(Request $request,$id){

		$data = StudentClass::find($id);

		$validatedData = $request->validate([
    		'name' => 'required|unique:student_classes,name,'.$data->id
    		
    	]);

    	
    	$data->name = $request->name;
    	$data->save();

    	Session::flash('success','Student Class Updated Successfully');
    	return redirect()->route('student.class.view');
    }
    /* ================= End StudentClassUpdate Method ================= */

    /* ================= Start StudentClassDelete Method ================= */
    public function StudentClassDelete($id){
    	$user = StudentClass::find($id);
    	$user->delete();

    	Session::flash('error','Student Class Deleted Successfully');
    	return redirect()->route('student.class.view');

    }
    /* ================= End StudentClassDelete Method ================= */

}
