<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentShift;
use Session;

class StudentShiftController extends Controller
{
    /* ================= Start ViewShift Method ================= */
    public function ViewShift(){
        $data['allData'] = StudentShift::all();
        return view('backend.setup.shift.view_shift',$data);

    }
    /* ================= End ViewShift Method ================= */

    /* ================= Start StudentShiftAdd Method ================= */
    public function StudentShiftAdd(){
        return view('backend.setup.shift.add_shift');
    }
    /* ================= End StudentShiftAdd Method ================= */

    /* ================= Start StudentShiftStore Method ================= */
    public function StudentShiftStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:student_shifts,name',
            
        ]);

        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();

        Session::flash('success','Student Shift Inserted Successfully');
        return redirect()->route('student.shift.view');

    }
    /* ================= End StudentShiftStore Method ================= */

    /* ================= Start StudentShiftEdit Method ================= */
    public function StudentShiftEdit($id){
        $editData = StudentShift::find($id);
        return view('backend.setup.shift.edit_shift',compact('editData'));
    }
    /* ================= End StudentShiftEdit Method ================= */

    /* ================= Start StudentShiftUpdate Method ================= */
    public function StudentShiftUpdate(Request $request,$id){

        $data = StudentShift::find($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_shifts,name,'.$data->id
            
        ]);

        
        $data->name = $request->name;
        $data->save();

        Session::flash('success','Student Shift Updated Successfully');
        return redirect()->route('student.shift.view');
    }
    /* ================= End StudentShiftUpdate Method ================= */

    /* ================= Start StudentShiftDelete Method ================= */
    public function StudentShiftDelete($id){
        $user = StudentShift::find($id);
        $user->delete();

        Session::flash('error','Student Shift Deleted Successfully');
        return redirect()->route('student.shift.view');
    }
    /* ================= End StudentShiftDelete Method ================= */


}
