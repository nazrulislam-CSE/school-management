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

use App\Models\MarksGrade;
use Session;

class GradeController extends Controller
{
    /* ================= Start MarksGradeView Method ================= */
    public function MarksGradeView(){

        $data['allData'] = MarksGrade::all();
        return view('backend.marks.grade_marks_view',$data);

    }
    /* ================= End MarksGradeView Method ================= */

    /* ================= Start MarksGradeAdd Method ================= */
    public function MarksGradeAdd(){
        return view('backend.marks.grade_marks_add');
    }
    /* ================= End MarksGradeAdd Method ================= */

    /* ================= Start MarksGradeStore Method ================= */
    public function MarksGradeStore(Request $request){

        $data = new MarksGrade();
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        Session::flash('success','Grade Marks Inserted Successfully');
        return redirect()->route('marks.entry.grade');


    } // end Method
    /* ================= End MarksGradeStore Method ================= */

    /* ================= Start MarksGradeEdit Method ================= */
    public function MarksGradeEdit($id){
        $data['editData'] = MarksGrade::find($id);
        return view('backend.marks.grade_marks_edit',$data);

    }
    /* ================= End MarksGradeEdit Method ================= */

    /* ================= Start MarksGradeUpdate Method ================= */
    public function MarksGradeUpdate(Request $request, $id){

        $data = MarksGrade::find($id);
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        Session::flash('success','Grade Marks Updated Successfully');
        return redirect()->route('marks.entry.grade');

    }
    /* ================= End MarksGradeUpdate Method ================= */

}
