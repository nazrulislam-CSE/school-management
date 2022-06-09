<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamType; 
use Session;

class ExamTypeController extends Controller
{
    /* ================= Start ViewExamType Method ================= */
    public function ViewExamType(){
        $data['allData'] = ExamType::all();
        return view('backend.setup.exam_type.view_exam_type',$data);
 
    }
    /* ================= End ViewExamType Method ================= */

    /* ================= Start ExamTypeAdd Method ================= */
    public function ExamTypeAdd(){
        return view('backend.setup.exam_type.add_exam_type');
    }
    /* ================= End ExamTypeAdd Method ================= */

    /* ================= Start ViewExamType Method ================= */
    public function ExamTypeStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:exam_types,name',
            
        ]);

        $data = new ExamType();
        $data->name = $request->name;
        $data->save();

        Session::flash('success','Exam Type Inserted Successfully');
        return redirect()->route('exam.type.view');

        }
    /* ================= Start ViewExamType Method ================= */

    /* ================= Start ViewExamType Method ================= */
    public function ExamTypeEdit($id){
        $editData = ExamType::find($id);
        return view('backend.setup.exam_type.edit_exam_type',compact('editData'));

    }
    /* ================= Start ViewExamType Method ================= */

    /* ================= Start ViewExamType Method ================= */
    public function ExamTypeUpdate(Request $request,$id){

        $data = ExamType::find($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:exam_types,name,'.$data->id
            
        ]);

        $data->name = $request->name;
        $data->save();

        Session::flash('success','Exam Type Updated Successfully');
        return redirect()->route('exam.type.view');
    }
    /* ================= Start ViewExamType Method ================= */

    /* ================= Start ViewExamType Method ================= */
    public function ExamTypeDelete($id){

        $user = ExamType::find($id);
        $user->delete();

        Session::flash('error','Exam Type Deleted Successfully');
        return redirect()->route('exam.type.view');

    }
        /* ================= Start ViewExamType Method ================= */

}
