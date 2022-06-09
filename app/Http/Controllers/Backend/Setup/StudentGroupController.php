<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;
use Session;

class StudentGroupController extends Controller
{
    /* ================= Start ViewGroup Method ================= */
    public function ViewGroup(){
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.group.view_group',$data);

    }
    /* ================= End ViewGroup Method ================= */

    /* ================= Start ViewGroup Method ================= */
    public function StudentGroupAdd(){
        return view('backend.setup.group.add_group');
    }
    /* ================= End ViewGroup Method ================= */

    /* ================= Start ViewGroup Method ================= */
    public function StudentGroupStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:student_groups,name',
        ]);

        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();

        Session::flash('success','Student Group Inserted Successfully.');
        return redirect()->route('student.group.view');

    }
    /* ================= End ViewGroup Method ================= */

    /* ================= Start StudentGroupEdit Method ================= */
    public function StudentGroupEdit($id){
        $editData = StudentGroup::find($id);
        return view('backend.setup.group.edit_group',compact('editData'));

    }
    /* ================= Start StudentGroupEdit Method ================= */

    /* ================= Start StudentGroupUpdate Method ================= */ 
    public function StudentGroupUpdate(Request $request,$id){

        $data = StudentGroup::find($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_groups,name,'.$data->id
            
        ]);

        $data->name = $request->name;
        $data->save();

        Session::flash('success','Student Group Updated Successfully');
        return redirect()->route('student.group.view');
    }
    /* ================= Start StudentGroupUpdate Method ================= */

    /* ================= Start StudentGroupDelete Method ================= */ 
    public function StudentGroupDelete($id){
        $user = StudentGroup::find($id);
        $user->delete();

        Session::flash('error','Student Group Deleted Successfully');
        return redirect()->route('student.group.view');

    }
    /* ================= Start StudentGroupDelete Method ================= */ 

}
