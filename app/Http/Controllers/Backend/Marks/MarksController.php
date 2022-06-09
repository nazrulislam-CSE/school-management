<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;

use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use DB;
use PDF;

use App\Models\StudentMarks;
use App\Models\ExamType;
use Session;

class MarksController extends Controller
{
    /* ================= Start MarksAdd Method ================= */
    public function MarksAdd(){
        $data['years'] = StudentYear::latest()->get();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();

        return view('backend.marks.marks_add',$data);

    }
    /* ================= End MarksAdd Method ================= */

    /* ================= Start MarksStore Method ================= */
    public function MarksStore(Request $request){

        $studentcount = $request->student_id;
        if ($studentcount) {
            for ($i=0; $i < count($request->student_id) ; $i++) { 
            $data = New StudentMarks();
            $data->year_id = $request->year_id;
            $data->class_id = $request->class_id;
            $data->assign_subject_id = $request->assign_subject_id;
            $data->exam_type_id = $request->exam_type_id;
            $data->student_id = $request->student_id[$i];
            $data->id_no = $request->id_no[$i];
            $data->marks = $request->marks[$i];
            $data->save();

            } // end for loop
        }// end if conditon

        Session::flash('success','Student Marks Inserted Successfully');
        return redirect()->back();

    }// end method
    /* ================= End MarksStore Method ================= */

    /* ================= Start MarksEdit Method ================= */
    public function MarksEdit(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();

        return view('backend.marks.marks_edit',$data);
    }
    /* ================= End MarksEdit Method ================= */

    /* ================= Start MarksEditGetStudents Method ================= */
    public function MarksEditGetStudents(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type_id = $request->exam_type_id;

        $getStudent = StudentMarks::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)->where('assign_subject_id',$assign_subject_id)->where('exam_type_id',$exam_type_id)->get();

        return response()->json($getStudent);

    }
    /* ================= End MarksEditGetStudents Method ================= */

    /* ================= Start MarksUpdate Method ================= */
    public function MarksUpdate(Request $request){

        StudentMarks::where('year_id',$request->year_id)->where('class_id',$request->class_id)->where('assign_subject_id',$request->assign_subject_id)->where('exam_type_id',$request->exam_type_id)->delete();

        $studentcount = $request->student_id;
        if ($studentcount) {
            for ($i=0; $i <count($request->student_id) ; $i++) { 
            $data = New StudentMarks();
            $data->year_id = $request->year_id;
            $data->class_id = $request->class_id;
            $data->assign_subject_id = $request->assign_subject_id;
            $data->exam_type_id = $request->exam_type_id;
            $data->student_id = $request->student_id[$i];
            $data->id_no = $request->id_no[$i];
            $data->marks = $request->marks[$i];
            $data->save();

            } // end for loop
        }// end if conditon

        Session::flash('success','Student Marks Updated Successfully');
        return redirect()->back();


    } // end marks
    /* ================= End MarksUpdate Method ================= */
}
