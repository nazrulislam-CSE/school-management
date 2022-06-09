<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;
use Session;

class StudentYearController extends Controller
{
    /* ================= Start ViewStudent Method ================= */
    public function ViewYear(){
        $data['allData'] = StudentYear::latest()->get();
        return view('backend.setup.year.view_year',$data);

    }
    /* ================= End ViewStudent Method ================= */

    /* ================= Start StudentYearAdd Method ================= */
    public function StudentYearAdd(){
        return view('backend.setup.year.add_year');
    }
    /* ================= End StudentYearAdd Method ================= */

    /* ================= Start StudentYearAdd Method ================= */
    public function StudentYearStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name',
            
        ]);

        $data = new StudentYear();
        $data->name = $request->name;
        $data->save();

        Session::flash('success','Student Year Inserted Successfully');
        return redirect()->route('student.year.view');

    }
    /* ================= End StudentYearAdd Method ================= */

    /* ================= Start StudentYearEdit Method ================= */
    public function StudentYearEdit($id){
        $editData = StudentYear::find($id);
        return view('backend.setup.year.edit_year',compact('editData'));

    }
    /* ================= End StudentYearEdit Method ================= */

    /* ================= Start StudentYearUpdate Method ================= */
    public function StudentYearUpdate(Request $request,$id){

        $data = StudentYear::find($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name,'.$data->id
            
        ]);

        
        $data->name = $request->name;
        $data->save();

        Session::flash('success','Student Year Updated Successfully');
        return redirect()->route('student.year.view');
    }
    /* ================= End StudentYearUpdate Method ================= */

    /* ================= Start StudentYearDelete Method ================= */
    public function StudentYearDelete($id){
        $user = StudentYear::find($id);
        $user->delete();

        Session::flash('error','Student Year Deleted Successfully');
        return redirect()->route('student.year.view');

    }
    /* ================= End StudentYearDelete Method ================= */
}
