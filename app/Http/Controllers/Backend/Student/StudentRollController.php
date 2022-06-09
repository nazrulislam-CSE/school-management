<?php

namespace App\Http\Controllers\Backend\Student;

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
use Session;

class StudentRollController extends Controller
{
    /* ================= Start StudentRollView Method ================= */
    public function StudentRollView(){
        $data['years'] = StudentYear::latest()->get();
        $data['classes'] = StudentClass::all();
        return view('backend.student.roll_generate.roll_generate_view',$data);
    }
    /* ================= End StudentRollView Method ================= */

    /* ================= Start GetStudents Method ================= */
    public function GetStudents(Request $request){
        //dd('ok done');
        $allData = AssignStudent::with(['student'])->where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
        // dd($allData->toArray());
        return response()->json($allData);

    }
    /* ================= End GetStudents Method ================= */

    /* ================= Start StudentRollStore Method ================= */
    public function StudentRollStore(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($request->student_id !=null) {
            for ($i=0; $i < count($request->student_id); $i++) { 
                AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->where('student_id',$request->student_id[$i])->update(['roll' => $request->roll[$i]]);
            } // end for loop
        }else{

            Session::flash('error','Sorry there are no student');
            return redirect()->back();
        } // End IF Condition

        Session::flash('success','Well Done Roll Generated Successfully');
        return redirect()->route('roll.generate.view');

    } // end Method 
    /* ================= End StudentRollStore Method ================= */
}
